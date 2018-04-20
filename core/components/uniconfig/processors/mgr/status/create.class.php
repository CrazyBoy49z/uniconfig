<?php

class uniConfigStatusCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'uniOrderStatus';
    public $classKey = 'uniOrderStatus';
    public $languageTopics = ['uniconfig'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('uniconfig_status_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('uniconfig_status_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'uniConfigStatusCreateProcessor';