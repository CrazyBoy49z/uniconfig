<?php
class uniConfigCommentCreateProcessor extends modObjectCreateProcessor
{
  public $objectType = 'uniComment';
  public $classKey = 'uniComment';
  /** @var  uniConfig $uniConfig */
  protected $uniConfig;

  public function initialize()
  {
    $this->uniConfig = $this->modx->getService('uniConfig');
    if($this->modx->user->isMember('Users')){
      return $this->modx->lexicon('access_denied');
    }
    return parent::initialize();
  }
  public function beforeSet()
  {
    $comment = trim(htmlspecialchars($this->getProperty('comment')));
    $order_id = (int)trim(htmlspecialchars($this->getProperty('order_id')));

    if(!$comment){
      return 'Вы не написали комментарий';
    }
    if(!$order_id || $order_id < 1){
      return 'Ошибка!';
    }
    $comment = $this->uniConfig->Jevix($comment);

    $this->unsetProperty('action');
    $this->setProperties([
      'user_id' => $this->modx->user->id,
      'order_id' => $order_id,
      'comment' => $comment,
      'date' => time(),
    ]);
    return parent::beforeSet();
  }
}
return 'uniConfigCommentCreateProcessor';