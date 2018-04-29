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
    if (!$this->modx->user->isAuthenticated()){
      return 'Вам нужно авторизоваться';
    };
    if (!$this->modx->hasPermission($this->permission)) {
      return $this->modx->lexicon('access_denied');
    }
    return parent::initialize();
  }
  public function beforeSet()
  {

    $message = trim(htmlspecialchars($this->getProperty('message')));
    $order_id = trim(htmlspecialchars($this->getProperty('order_id')));
    $files = htmlspecialchars($this->getProperty('files'));
    if(!$message){
      return 'Вы не написали сообщение';
    }
    if(!$order_id){
      return 'Не указана заявка';
    }

    $message = $this->uniConfig->Jevix($message);

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
    return parent::beforeSet();
  }
}
return 'uniConfigMessageCreateProcessor';