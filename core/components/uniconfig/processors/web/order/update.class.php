<?php
class uniConfigOrdersUpdateProcessor extends modObjectUpdateProcessor {

	public $objectType = 'uniOrder';
	public $classKey = 'uniOrder';

	public function beforeSet() {
		if (!$this->modx->user->id) return 'Вам нужно авторизоваться';
		if ($this->object->get('created_by') != $this->modx->user->id)
			return 'Вы не можете редактировать чужие записи';
		return true;
	}


}

return 'uniConfigOrdersUpdateProcessor';