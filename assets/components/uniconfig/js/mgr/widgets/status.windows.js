uniConfig.window.CreateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'uniconfig-status-window-create';
    }
    Ext.applyIf(config, {
        title: _('uniconfig_status_create'),
        width: 550,
        autoHeight: true,
        url: uniConfig.config.connector_url,
        action: 'mgr/status/create',
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
            fieldLabel: _('uniconfig_item_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('uniconfig_item_active'),
            name: 'active',
            id: config.id + '-active',
            checked: true,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('uniconfig-status-window-create', uniConfig.window.CreateItem);


uniConfig.window.UpdateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'uniconfig-status-window-update';
    }
    Ext.applyIf(config, {
        title: _('uniconfig_status_update'),
        width: 550,
        autoHeight: true,
        url: uniConfig.config.connector_url,
        action: 'mgr/status/update',
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
            fieldLabel: _('uniconfig_item_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        },  {
            xtype: 'xcheckbox',
            boxLabel: _('uniconfig_item_active'),
            name: 'active',
            id: config.id + '-active',
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('uniconfig-status-window-update', uniConfig.window.UpdateItem);