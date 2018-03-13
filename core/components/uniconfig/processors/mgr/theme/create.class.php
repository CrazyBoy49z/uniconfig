<?php

class uniConfigThemeCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'uniOrderTheme';
    public $classKey = 'uniOrderTheme';
    public $languageTopics = ['uniconfig'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('uniconfig_theme_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('uniconfig_theme_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'uniConfigThemeCreateProcessor';