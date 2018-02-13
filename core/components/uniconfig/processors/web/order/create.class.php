<?php
class uniConfigOrdersCreateProcessor extends modObjectCreateProcessor {

	public $objectType = 'OrdersSheet';
	public $classKey = 'OrdersSheet';

	public function beforeSet() {
		if (!$this->modx->user->id) return 'Вам нужно авторизоваться';
		$this->setProperty('created_by', $this->modx->user->id);
		return true;
	}

}

return 'uniConfigOrdersCreateProcessor';