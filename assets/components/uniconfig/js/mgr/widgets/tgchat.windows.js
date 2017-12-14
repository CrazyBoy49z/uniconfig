uniConfig.window.CreateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'uniconfig-tgchat-window-create';
    }
    Ext.applyIf(config, {
        title: _('uniconfig_tgchat_create'),
        width: 550,
        autoHeight: true,
        url: uniConfig.config.connector_url,
        action: 'mgr/tgchat/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    uniConfig.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(uniConfig.window.CreateItem, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'textfield',
            fieldLabel: _('uniconfig_tgchat_chat_id'),
            name: 'chat_id',
            id: config.id + '-chat_id',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'uniconfig-combo-loc',
            fieldLabel: _('uniconfig_tgchat_theme_id'),
            name: 'theme_id',
            id: config.id + '-theme_id',
            anchor: '99%',
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('uniconfig-tgchat-window-create', uniConfig.window.CreateItem);


uniConfig.window.UpdateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'uniconfig-tgchat-window-update';
    }
    Ext.applyIf(config, {
        title: _('uniconfig_tgchat_update'),
        width: 550,
        autoHeight: true,
        url: uniConfig.config.connector_url,
        action: 'mgr/tgchat/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    uniConfig.window.UpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(uniConfig.window.UpdateItem, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-id',
        }, {
            xtype: 'textfield',
            fieldLabel: _('uniconfig_tgchat_chat_id'),
            name: 'chat_id',
            id: config.id + '-chat_id',
            anchor: '99%',
            allowBlank: false,
        },  {
            xtype: 'uniconfig-combo-loc',
            fieldLabel: _('uniconfig_tgchat_theme_id'),
            name: 'theme_id',
            id: config.id + '-theme_id',
            anchor: '99%',
            allowBlank: false,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('uniconfig-tgchat-window-update', uniConfig.window.UpdateItem);