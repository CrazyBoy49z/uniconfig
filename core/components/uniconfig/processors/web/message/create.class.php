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
    $order_id = (int)trim(htmlspecialchars($this->getProperty('order_id')));
    $photo = ($this->getProperty('photo'));
    if(!$message){
      return 'Вы не написали сообщение';
    }
    if(!$order_id || $order_id < 1){
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
    if ($photo && is_array($photo)){
      $this->setProperties([
        'photo' => json_encode($photo),
      ]);
    }
    return parent::beforeSet();
  }
}
return 'uniConfigMessageCreateProcessor';