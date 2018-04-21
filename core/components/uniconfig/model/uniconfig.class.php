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
    if ($response) {
      $data = $response->getResponse();
      $this->modx->log(1, $data);
      if (is_string($data)) {
        $data = json_decode($data, true);
      }
      return $data;
    }
    return false;
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
   * @return boolean|string
   */
  public function changeOrderStatus($order_id, $status_id)
  {
    $error = '';
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
      return $this->modx->lexicon($error);
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
        $emails = implode(",", $emails);
        if (!$this->sendEmail($emails, $subject, $body)) {
          $error = 'uniconfig_send_email_err';
        };
      };
      if ($status->get('email_location_manager')) {
        $emails = $this->getUserEmails('ManagerLocation');
        $emails = implode(",", $emails);
        if (!$this->sendEmail($emails, $subject, $body)) {
          $error = 'uniconfig_send_email_err';
        };
      };
      if ($status->get('email_chief')) {
        $emails = $this->getUserEmails('ManagerSpecialization');
        $emails = implode(",", $emails);
        if (!$this->sendEmail($emails, $subject, $body)) {
          $error = 'uniconfig_send_email_err';
        };
      };

      if (!empty($error)) {
        return $this->modx->lexicon($error);
      }
    }
    return true;
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
    return 'true';
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
    $message = '';
    switch ($action) {
      case 'status':
        $message = 'Изменен статус заказа на ' . $entry;
        break;
    }

    $log = $this->modx->newObject('uniOrderHistory', array(
      'order_id' => $order_id,
      'date' => time(),
      'message' => $message,
      'action' => $action,
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
}