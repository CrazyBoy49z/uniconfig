<?php

class uniConfigUrgencyCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'orderUrgencyItem';
    public $classKey = 'orderUrgencyItem';
    public $languageTopics = ['uniconfig'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('uniconfig_urgency_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('uniconfig_urgency_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'uniConfigUrgencyCreateProcessor';