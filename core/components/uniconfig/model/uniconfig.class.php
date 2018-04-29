<?php

class uniConfig
{
  /** @var modX $modx */
  public $modx;
  /** @var pdoFetch $pdo */
  public $pdoTools;
  public $config = [];
  const assets_version = '1.00';

  /**
   * @param modX $modx
   * @param array $config
   */
  function __construct(modX &$modx, array $config = [])
  {
    $this->modx =& $modx;
    $corePath = MODX_CORE_PATH . 'components/uniconfig/';
    $assetsUrl = MODX_ASSETS_URL . 'components/uniconfig/';

    $this->config = array_merge([
      'corePath' => $corePath,
      'modelPath' => $corePath . 'model/',
      'processorsPath' => $corePath . 'processors/',
      'connectorUrl' => $assetsUrl . 'connector.php',
      'assetsUrl' => $assetsUrl,
      'cssUrl' => $assetsUrl . 'css/',
      'jsUrl' => $assetsUrl . 'js/',
    ], $config);

    $this->modx->addPackage('uniconfig', $this->config['modelPath']);
    $this->modx->addExtensionPackage('uniconfig', $this->config['modelPath']);
    $this->modx->lexicon->load('uniconfig:default');
  }

  /**
   * Initialize App
   */
  public function initialize()
  {
    $this->pdoTools = $this->modx->getService('pdoFetch');
    if (!isset($_SESSION['csrf-token'])) {
      $_SESSION['csrf-token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
    //$this->modx->addPackage('app', $this->config['modelPath']);
    /** @noinspection PhpIncludeInspection */
    //require_once $this->config['corePath'] . 'vendor/autoload.php';
  }

  /**
   * @param $action
   * @param array $data
   *
   * @return array|bool|mixed
   */
  public function runProcessor($action, array $data = [])
  {
    $action = 'web/' . trim($action, '/');
    /** @var modProcessorResponse $response */
    $response = $this->modx->runProcessor($action, $data, ['processors_path' => $this->config['processorsPath']]);
    return $response;
  }

  /**
   * @param modSystemEvent $event
   * @param array $scriptProperties
   */
  public function handleEvent(modSystemEvent $event, array $scriptProperties)
  {
    extract($scriptProperties);
    switch ($event->name) {
      case 'pdoToolsOnFenomInit':
        /** @var Fenom|FenomX $fenom */
        $fenom->addAllowedFunctions([
          'array_keys',
          'array_values',
        ]);
        $fenom->addAccessorSmart('en', 'en', Fenom::ACCESSOR_PROPERTY);
        $fenom->en = $this->modx->getOption('cultureKey') == 'en';
        $fenom->addAccessorSmart('assets_version', 'assets_version', Fenom::ACCESSOR_PROPERTY);
        $fenom->assets_version = $this::assets_version;
        break;
      case 'OnHandleRequest':
        if ($this->modx->context->key == 'mgr') {
          return;
        }
        // Remove slash and question signs at the end of url
        $uri = $_SERVER['REQUEST_URI'];
        if ($uri != '/' && in_array(substr($uri, -1), ['/', '?'])) {
          $this->modx->sendRedirect(rtrim($uri, '/?'), ['responseCode' => 'HTTP/1.1 301 Moved Permanently']);
        }
        // Remove .html extension
        if (preg_match('#\.html$#i', $uri)) {
          $this->modx->sendRedirect(preg_replace('#\.html$#i', '', $uri),
            ['responseCode' => 'HTTP/1.1 301 Moved Permanently']
          );
        }
        // Switch context - uncomment it if you have more than one context
        /*
        $c = $this->modx->newQuery('modContextSetting', [
            'key' => 'http_host',
            'value' => $_SERVER['HTTP_HOST'],
        ]);
        $c->select('context_key');
        $tstart = microtime(true);
        if ($c->prepare() && $c->stmt->execute()) {
            $this->modx->queryTime += microtime(true) - $tstart;
            $this->modx->executedQueries++;
            if ($context = $c->stmt->fetch(PDO::FETCH_COLUMN)) {
                if ($context != 'web') {
                    $this->modx->switchContext($context);
                }
            }
        }
        */
        break;
      case 'OnWebPageInit':
        $this->modx->regClientScript($this->config['jsUrl'] . 'web/default.js');
        break;
      case 'OnPageNotFound':
        $alias = $this->modx->context->getOption('request_param_alias', 'q');
        if (!isset($_REQUEST[$alias])) {
          return false;
        }
        $request = $_REQUEST[$alias];
        $tmp = explode('/', $request);
        if ($tmp[0] == 'order-window' && count($tmp) >= 2) {
          if (!$section = $this->modx->findResource($tmp[0])) {
            return false;
          }
          $id = str_replace('.html', '', $tmp[1]);
          if ($tmp[1] != $id || (isset($tmp[2]) && $tmp[2] == '')) {
            $this->modx->sendRedirect($tmp[0] . '/' . $id);
          }
          if ($order = $this->modx->getObject('uniOrder', $id)) {
            $_GET['order'] = $_REQUEST['order'] = $id;
            $this->modx->sendForward($section);
          }
        }
        break;
      case 'OnWebPagePrerender':
        // Compress output html for Google
        $this->modx->resource->_output = preg_replace('#\s+#', ' ', $this->modx->resource->_output);
        break;
    }
  }

  /**
   * Switch order status
   *
   * @param integer $order_id The id of uniOrder
   * @param integer $status_id The id of uniOrderStatus
   *
   * @return array
   */
  public function changeOrderStatus($order_id, $status_id)
  {
    $out = [
      'success' => false,
      'message' => 'Неизвестная ошибка',
    ];
    /** @var uniOrder $order */
    if (!$order = $this->modx->getObject('uniOrder', $order_id)) {
      $error = 'uniconfig_order_nf';
    }
    /** @var uniOrderStatus $status */
    if (!$status = $this->modx->getObject('uniOrderStatus', $status_id)) {
      $error = 'uniconfig_status_err_ns';
    }
    if ($order->get('status') == $status_id) {
      $error = 'uniconfig_status_err_same';
    }
    if (!empty($error)) {
      $out['message'] = $this->modx->lexicon($error);
      return $out;
    }
    $order->set('status', $status_id);

    if ($order->save()) {
      /** @var modUser $created_by */
      $created_by = $order->getOne('CreatedUser');
      $pls = $order->toArray();
      //Add to OrderHistory
      if (!$this->orderHistory($order_id, 'status', $status->get('name'))) {
        $error = 'uniconfig_order_history_err_ns';
      }
      //Message
      $body = $this->pdoTools->getChunk('@FILE chunks/email/_email_sent_user.tpl', ['order' => $pls]);
      $subject = 'Статус заявки #' . $order_id . ' был изменен';

      if ($status->get('email_customer')) {
        $profile = $created_by->getOne('Profile');
        $email = $profile->get('email');
        if (!$this->sendEmail($email, $subject, $body)) {
          $error = 'uniconfig_send_email_err';
        };
      };
      if ($status->get('email_dispatcher')) {
        $emails = $this->getUserEmails('Dispatchers');
        if ($emails) {
          $emails = implode(",", $emails);
          if (!$this->sendEmail($emails, $subject, $body)) {
            $error = 'uniconfig_send_email_err';
          };
        }
      };
      if ($status->get('email_location_manager')) {
        $emails = $this->getUserEmails('ManagerLocation');
        if ($emails) {
          $emails = implode(",", $emails);
          if (!$this->sendEmail($emails, $subject, $body)) {
            $error = 'uniconfig_send_email_err';
          };
        }
      };
      if ($status->get('email_chief')) {
        $emails = $this->getUserEmails('ManagerSpecialization');
        if ($emails) {
          $emails = implode(",", $emails);
          if (!$this->sendEmail($emails, $subject, $body)) {
            $error = 'uniconfig_send_email_err';
          };
        }
      };

      if (!empty($error)) {
        $out['message'] = $this->modx->lexicon($error);
        return $out;
      }
      $out['success'] = true;
    }
    return $out;
  }

  /**
   * Send email
   * @param string $email The owner
   * @param string $subject The subject
   * @param string $body The body letter
   * @return boolean|string
   */
  public function sendEmail($email, $subject, $body = '')
  {
    //$email = str_replace(' ', '', $email);
    $email = explode(',', $email);
    $from = $this->modx->getOption('emailsender');
    $project_name = $this->modx->getOption('site_name');

    $this->modx->getService('mail', 'mail.modPHPMailer');
    $this->modx->mail->set(modMail::MAIL_FROM, $from);
    $this->modx->mail->set(modMail::MAIL_FROM_NAME, $project_name);
    foreach ($email as $item) {
      $this->modx->mail->address('to', $item);
    }
    $this->modx->mail->set(modMail::MAIL_SUBJECT, $subject);
    $this->modx->mail->set(modMail::MAIL_BODY, $this->pdoTools->getChunk('@FILE chunks/email/email.tpl', ['body' => $body]));
    $this->modx->mail->setHTML(true);
    if (!$this->modx->mail->send()) {
      $this->modx->log(modX::LOG_LEVEL_ERROR, 'An error occurred while trying to send the email: ' . $this->modx->mail->mailer->ErrorInfo);
    }
    $this->modx->mail->reset();
    return true;
  }

  /**
   * Function for logging changes of the order
   *
   * @param integer $order_id The id of the order
   * @param string $action The name of action made with order
   * @param string $entry The value of action
   *
   * @return boolean
   */
  public function orderHistory($order_id, $action = 'status', $entry)
  {
    /** @var uniOrder $order */
    if (!$order = $this->modx->getObject('uniOrder', $order_id)) {
      return false;
    }
    $message = [];
    switch ($action) {
      case 'status':
        switch ($entry) {
          case 'Новая':
            if ($this->modx->user->isMember('Executors')) {
              $message[] = 'Изменена специализация';
              $message[] = 'Статус заявки ' . $entry;
            } else {
              $message[] = 'Создана заявка';
              $message[] = 'Статус заявки ' . $entry;
            }
            break;
          default:
            $message[] = 'Изменен статус заявки на ' . $entry;
        }
        break;
    }
    $log = $this->modx->newObject('uniOrderHistory', array(
      'order_id' => $order_id,
      'date' => time(),
      'message' => json_encode($message),
      'action' => $action,
      'user_id' => $this->modx->user->id,
    ));
    return $log->save();
  }

  /**
   * Function for return email of users
   * @param string $group The group of user
   *
   * @return array
   */
  private function getUserEmails($group)
  {
    $query = $this->modx->newQuery('modUser');
    $query->innerJoin('modUserGroupMember', 'UserGroupMembers');
    $query->innerJoin('modUserGroup', 'UserGroup', '`UserGroupMembers`.`user_group` = `UserGroup`.`id`');
    $query->where(array(
      'UserGroup.name' => $group,
    ));
    $emails = [];
    /** @var modUser $users */
    /** @var modUser $user */
    $users = $this->modx->getCollection('modUser', $query);
    foreach ($users as $user) {
      $profile = $user->getOne('Profile');
      $emails[] = $profile->get('email');
    }
    return $emails;
  }


  /**
   * Sanitize any text through Jevix snippet
   *
   * @param string $text Text for sanitization
   * @param string $setName Name of property set for get parameters from
   * @param boolean $replaceTags Replace MODX tags?
   *
   * @return string
   */
  public function Jevix($text = null, $setName = 'Comment', $replaceTags = true)
  {
    if (empty($text)) {
      return ' ';
    }
    if (!$snippet = $this->modx->getObject('modSnippet', array('name' => 'Jevix'))) {
      return 'Could not load snippet Jevix';
    }
    // Loading parser if needed - it is for mgr context
    if (!is_object($this->modx->parser)) {
      $this->modx->getParser();
    }
    $params = array();
    if ($setName) {
      $params = $snippet->getPropertySet($setName);
    }
    $text = html_entity_decode($text, ENT_COMPAT, 'UTF-8');
    $params['input'] = str_replace(
      array('[', ']', '{', '}'),
      array('*(*(*(*(*(*', '*)*)*)*)*)*', '~(~(~(~(~(~', '~)~)~)~)~)~'),
      $text
    );
    $snippet->setCacheable(false);
    $filtered = $snippet->process($params);
    if ($replaceTags) {
      $filtered = str_replace(
        array('*(*(*(*(*(*', '*)*)*)*)*)*', '`', '~(~(~(~(~(~', '~)~)~)~)~)~'),
        array('&#91;', '&#93;', '&#96;', '&#123;', '&#125;'),
        $filtered
      );
    } else {
      $filtered = str_replace(
        array('*(*(*(*(*(*', '*)*)*)*)*)*', '~(~(~(~(~(~', '~)~)~)~)~)~'),
        array('[', ']', '{', '}'),
        $filtered
      );
    }
    return $filtered;
  }

  public function encode($unencoded, $key)
  {//Шифруем
    $string = base64_encode($unencoded);//Переводим в base64

    $arr = [];//Это массив
    $x = 0;
    $newstr = '';
    while ($x++ < strlen($string)) {//Цикл
      $arr[$x - 1] = md5(md5($key . $string[$x - 1]) . $key);//Почти чистый md5
      $newstr .= $arr[$x - 1][3] . $arr[$x - 1][6] . $arr[$x - 1][1] . $arr[$x - 1][2];//Склеиваем символы
    }
    return $newstr;//Вертаем строку
  }

  public function decode($encoded, $key)
  {//расшифровываем
    $strofsym = "qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM=";//Символы, с которых состоит base64-ключ
    $x = 0;
    while ($x++ <= strlen($strofsym)) {//Цикл
      $tmp = md5(md5($key . $strofsym[$x - 1]) . $key);//Хеш, который соответствует символу, на который его заменят.
      $encoded = str_replace($tmp[3] . $tmp[6] . $tmp[1] . $tmp[2], $strofsym[$x - 1], $encoded);//Заменяем №3,6,1,2 из хеша на символ
    }
    return base64_decode($encoded);//Вертаем расшифрованную строку
  }


  //Comments

  /**
   * Create Comment
   *
   * @param array $data section, pagetitle, comment, etc
   *
   * @return array
   */
  public function createComment($data)
  {
    $response = $this->runProcessor('comment/create', $data);
    $response = $response->response;
    if ($response['success']) {
      $comment = $response['object'];
      $commentTpl = $this->pdoTools->runSnippet('@FILE snippets/comment.php', ['comment_id' => $comment['id'], 'tpl' => '@FILE chunks/comments/_comment.tpl']);
      $response['comment'] = $commentTpl;
    }
    return $response;
  }

  /** Delete Executor on Order
   * @param int $order_id
   * @return boolean
   */
  public function deleteExecutor($order_id)
  {
    /** @var uniOrder $order */
    if (!$order = $this->modx->getObject('uniOrder', $order_id)) {
      return false;
    }
    $order->set('executor', '');
    if ($order->save()) {
      return true;
    }
  }

  /** Create Message
   * @param $data array
   * @return array
   */
  public function createMessage($data)
  {
    $data['user_id'] = $this->modx->user->id;
    $data['order_id'] = $data['id'];
    unset($data['id']);
    $response = $this->runProcessor('message/create', $data);
    $response = $response->response;
    return $response;
  }
}