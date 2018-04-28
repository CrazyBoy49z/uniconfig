<?php

class uniConfigOrdersCreateProcessor extends modObjectCreateProcessor
{

  public $objectType = 'uniOrder';
  public $classKey = 'uniOrder';
  /** @var  uniConfig $uniConfig */
  protected $uniConfig;

  public function initialize()
  {
    $this->uniConfig = $this->modx->getService('uniConfig');
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
      return $out['message']='Вы должны авторизоваться';
    }
    $specialization = trim(htmlspecialchars($this->getProperty('specialization')));

    $description = trim(htmlspecialchars($this->getProperty('description')));

    $location = trim(htmlspecialchars($this->getProperty('location')));

    $files = htmlspecialchars($this->getProperty('files'));

    if(!$specialization || !$description || !$location){
      return $out['message']='Заполните все обязательные поля';
    }
    $specialization = $this->uniConfig->Jevix($specialization);
    $description = $this->uniConfig->Jevix($description);
    $location = $this->uniConfig->Jevix($location);
    $this->unsetProperty('action');
    $this->setProperties([
      'created_by' => $this->modx->user->id,
      'status' => '',
      'specialization' => $specialization,
      'description' => $description,
      'location' => $location,
    ]);
    if ($files && is_array($files)){
      $this->setProperties([
        'photo' => json_encode($files),
      ]);
    }
    return true;
  }
  public function afterSave(){
    /** @var array $change_status */
    $change_status = $this->uniConfig->changeOrderStatus($this->object->get('id'), 1);
    if (!$change_status['success']) {
      return $this->failure($change_status['message']);
    }
    return $this->success('Заявка успешно создана!');
  }
}

return 'uniConfigOrdersCreateProcessor';