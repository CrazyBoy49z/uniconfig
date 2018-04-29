<?php

class uniConfigOrdersUpdateProcessor extends modObjectUpdateProcessor
{

  public $objectType = 'uniOrder';
  public $classKey = 'uniOrder';
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

    if($this->modx->user->isMember('Users')) {
      if ($this->object->get('created_by') != $this->modx->user->id)
        return 'Вы не можете редактировать чужие записи';
    }
    $id = (int)$this->getProperty('id');
    if (empty($id)) {
      return $this->modx->lexicon('uniconfig_order_err_ns');
    }
    $status_id = $this->getProperty('status_id');
    if($specialization = $this->getProperty('specialization')){
      if ($this->object->get('specialization') == $specialization){
        return 'Вы меняете специализацию на такую же!';
      }
    }
    switch ($status_id){
      case 1:
        //Статус Новая
        //Нужно удалить текущего исполнителя
        if(!$this->uniConfig->deleteExecutor($id)){
          return 'Не удалось изменить заявку';
        }
        break;
      case 3:
        //Статус Проверка
        $message = $this->uniConfig->createMessage($this->getProperties());
        if(!$message['success']){
          return $message['message'];
        }
        break;
      case 5:
        //Статус Отложена
        $message = $this->uniConfig->createMessage($this->getProperties());
        if(!$message['success']){
          return $message['message'];
        }
        break;
      case 6:
        //Статус Согласование
        $message = $this->uniConfig->createMessage($this->getProperties());
        if(!$message['success']){
          return $message['message'];
        }
        break;
    }
    $this->unsetProperty('action');

    return true;
  }

  public function afterSave(){
    /** @var array $change_status */
    $change_status = $this->uniConfig->changeOrderStatus($this->object->get('id'), $this->getProperty('status_id'));
    if (!$change_status['success']) {
      return $this->failure($change_status['message']);
    }
    return $this->success('Заявка успешно изменена');
  }
}

return 'uniConfigOrdersUpdateProcessor';