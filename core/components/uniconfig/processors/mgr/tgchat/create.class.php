<?php

class uniConfigTgchatCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'orderTgchatItem';
    public $classKey = 'orderTgchatItem';
    public $languageTopics = ['uniconfig'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('chat_id'));
        if (empty($name)) {
            $this->modx->error->addField('chat_id', $this->modx->lexicon('uniconfig_tgchat_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('chat_id', $this->modx->lexicon('uniconfig_tgchat_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'uniConfigTgchatCreateProcessor';