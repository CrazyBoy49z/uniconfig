<?php

class uniConfigOrdersCreateProcessor extends modObjectCreateProcessor
{

  public $objectType = 'uniOrder';
  public $classKey = 'uniOrder';


  public function beforeSet()
  {
    $out = array(
      'success' => false,
      'message' => 'Неизвестная ошибка',
    );
    if (!$this->modx->user->id) {
      return $out['message']='Вы должны авторизоваться';
    }
    $theme = trim(htmlspecialchars($this->getProperty('theme')));
    $description = trim(htmlspecialchars($this->getProperty('description')));
    $location = trim(htmlspecialchars($this->getProperty('location')));


    if(!$theme || !$description || !$location){
      return $out['message']='Заполните все обязательные поля';
    }
    $this->unsetProperty('action');
    $this->setProperties([
      'created_by' => $this->modx->user->id,
      'status' => 1,
      'theme' => $theme,
      'description' => $description,
      'location' => $location,
    ]);
    return true;
  }
  public function afterSave(){
    return $this->success('Заявка успешно создана!');
  }
}

return 'uniConfigOrdersCreateProcessor';