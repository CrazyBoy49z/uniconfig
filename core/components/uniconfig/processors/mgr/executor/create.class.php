<?php

class uniConfigExecutorCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'uniExecutor';
    public $classKey = 'uniExecutor';
    public $languageTopics = ['uniconfig'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $user = trim($this->getProperty('user'));
        if (empty($user)) {
            $this->modx->error->addField('user', $this->modx->lexicon('uniconfig_executor_err_user'));
        } elseif ($this->modx->getCount($this->classKey, ['user' => $user])) {
            $this->modx->error->addField('user', $this->modx->lexicon('uniconfig_executor_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'uniConfigExecutorCreateProcessor';