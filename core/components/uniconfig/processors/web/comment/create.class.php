<?php
class uniConfigCommentCreateProcessor extends modObjectCreateProcessor
{
  public $objectType = 'uniComment';
  public $classKey = 'uniComment';
  /** @var  uniConfig $uniConfig */
  protected $uniConfig;
  protected $pdoTools;

  public function initialize()
  {
    $this->uniConfig = $this->modx->getService('uniConfig');
    if(!$this->modx->user->isMember('Users')){
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
    if (!$this->modx->user->id) {
      return $out['message'] = 'Вы должны авторизоваться';
    }
    $comment = trim(htmlspecialchars($this->getProperty('comment')));
    $order_id = trim(htmlspecialchars($this->getProperty('order_id')));
    //Дописать изображения
    if(!$comment){
      return $out['message'] = 'Вы не написали комментарий';
    }

    $comment = $this->uniConfig->Jevix($comment);
    $order_id = $this->uniConfig->Jevix($order_id);


    $this->unsetProperty('action');
    $this->setProperties([
      'user_id' => $this->modx->user->id,
      'order_id' => $order_id,
      'photo' => '',
      'comment' => $comment,
      'date' => time(),
    ]);
    return true;
  }
}
return 'uniConfigCommentCreateProcessor';