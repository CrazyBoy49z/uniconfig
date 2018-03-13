<?php

/**
 * The home manager controller for uniConfig.
 *
 */
class uniConfigHomeManagerController extends modExtraManagerController
{
    /** @var uniConfig $uniConfig */
    public $uniConfig;


    /**
     *
     */
    public function initialize()
    {
        $this->uniConfig = $this->modx->getService('uniConfig', 'uniConfig', MODX_CORE_PATH . 'components/uniconfig/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['uniconfig:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('uniconfig');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->uniConfig->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/uniconfig.js');
        $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/widgets/locations.grid.js');
        $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/widgets/locations.windows.js');
	      $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/widgets/status.grid.js');
	      $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/widgets/status.windows.js');
	      $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/widgets/theme.grid.js');
	      $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/widgets/theme.windows.js');
        $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->uniConfig->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        uniConfig.config = ' . json_encode($this->uniConfig->config) . ';
        uniConfig.config.connector_url = "' . $this->uniConfig->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "uniconfig-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="uniconfig-panel-home-div"></div>';

        return '';
    }
}