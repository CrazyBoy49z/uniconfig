<?php

class uniConfigStatusDisableProcessor extends modObjectProcessor
{
    public $objectType = 'uniOrderStatus';
    public $classKey = 'uniOrderStatus';
    public $languageTopics = ['uniconfig'];
    //public $permission = 'save';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('uniconfig_status_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var uniConfigItem $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('uniconfig_status_err_nf'));
            }

            $object->set('active', false);
            $object->save();
        }

        return $this->success();
    }

}

return 'uniConfigStatusDisableProcessor';
