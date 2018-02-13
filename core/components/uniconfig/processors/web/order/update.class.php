<?php
class uniConfigOrdersUpdateProcessor extends modObjectUpdateProcessor {

	public $objectType = 'OrdersSheet';
	public $classKey = 'OrdersSheet';

	public function beforeSet() {
		if (!$this->modx->user->id) return 'Вам нужно авторизоваться';
		if ($this->object->get('created_by') != $this->modx->user->id)
			return 'Вы не можете редактировать чужие записи';
		return true;
	}


}

return 'uniConfigOrdersUpdateProcessor';