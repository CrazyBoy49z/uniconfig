<?php
class uniConfigMessageCreateProcessor extends modObjectCreateProcessor
{
  public $objectType = 'uniMessage';
  public $classKey = 'uniMessage';
  /** @var  uniConfig $uniConfig */
  protected $uniConfig;

  public function initialize()
  {
    $this->uniConfig = $this->modx->getService('uniConfig');
    if($this->modx->user->id < 1){
      return $this->modx->lexicon('access_denied');
    }
    if (!$this->modx->hasPermission($this->permission)) {
      return $this->modx->lexicon('access_denied');
    }
    return parent::initialize();
  }
  public function beforeSet()
  {

    $out = array(
      'success' => false,
      'message' => 'Неизвестная ошибка',
    );
    if ($this->modx->user->id < 1) {
      return $out['message'] = 'Вы должны авторизоваться';
    }
    $message = trim(htmlspecialchars($this->getProperty('message')));
    $order_id = trim(htmlspecialchars($this->getProperty('order_id')));
    $files = htmlspecialchars($this->getProperty('files'));
    if(!$message){
      return $out['message'] = 'Вы не написали сообщение';
    }

    $message = $this->uniConfig->Jevix($message);
    $order_id = $this->uniConfig->Jevix($order_id);


    $this->unsetProperty('action');
    $this->setProperties([
      'user_id' => $this->modx->user->id,
      'order_id' => $order_id,
      'photo' => '',
      'message' => $message,
      'date' => time(),
    ]);
    if ($files && is_array($files)){
      $this->setProperties([
        'photo' => json_encode($files),
      ]);
    }
    return true;
  }
}
return 'uniConfigMessageCreateProcessor';