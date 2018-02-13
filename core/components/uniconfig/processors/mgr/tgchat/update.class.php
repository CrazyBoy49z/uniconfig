<?php

class uniConfigTgchatUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'orderTgchatItem';
    public $classKey = 'orderTgchatItem';
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
        $name = trim($this->getProperty('chat_id'));
        if (empty($id)) {
            return $this->modx->lexicon('uniconfig_tgchat_err_ns');
        }

        if (empty($name)) {
            $this->modx->error->addField('chat_id', $this->modx->lexicon('uniconfig_tgchat_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['chat_id' => $name, 'id:!=' => $id])) {
            $this->modx->error->addField('chat_id', $this->modx->lexicon('uniconfig_tgchat_err_ae'));
        }

        return parent::beforeSet();
    }
}

return 'uniConfigTgchatUpdateProcessor';
