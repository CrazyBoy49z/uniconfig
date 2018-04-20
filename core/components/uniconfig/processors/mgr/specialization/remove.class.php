<?php

class uniConfigSpecializationRemoveProcessor extends modObjectProcessor
{
    public $objectType = 'uniSpecialization';
    public $classKey = 'uniSpecialization';
    public $languageTopics = ['uniconfig'];
    //public $permission = 'remove';


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
            return $this->failure($this->modx->lexicon('uniconfig_specialization_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var uniConfigItem $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('uniconfig_specialization_err_nf'));
            }

            $object->remove();
        }

        return $this->success();
    }

}

return 'uniConfigSpecializationRemoveProcessor';