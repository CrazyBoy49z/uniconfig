uniConfig.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'uniconfig-panel-home',
            renderTo: 'uniconfig-panel-home-div'
        }]
    });
    uniConfig.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(uniConfig.page.Home, MODx.Component);
Ext.reg('uniconfig-page-home', uniConfig.page.Home);