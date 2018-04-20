<?php

class uniConfigManagerLocationUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'uniManagerLocation';
    public $classKey = 'uniManagerLocation';
    public $languageTopics = ['uniconfig'];
    //public $permission = 'save';


    /**
     * We doing special check of permission
     * because of our objects is not an instances of modAccessibleObject
     *
     * @return bool|string
     */
    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $id = (int)$this->getProperty('id');
        $user = trim($this->getProperty('user'));
        if (empty($id)) {
            return $this->modx->lexicon('uniconfig_ManagerLocation_err_ns');
        }

        if (empty($user)) {
            $this->modx->error->addField('user', $this->modx->lexicon('uniconfig_ManagerLocation_err_user'));
        } elseif ($this->modx->getCount($this->classKey, ['user' => $user, 'id:!=' => $id])) {
            $this->modx->error->addField('user', $this->modx->lexicon('uniconfig_ManagerLocation_err_ae'));
        }

        return parent::beforeSet();
    }
}

return 'uniConfigManagerLocationUpdateProcessor';
