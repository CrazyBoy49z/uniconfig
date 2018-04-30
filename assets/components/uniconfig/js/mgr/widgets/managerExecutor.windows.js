uniConfig.window.CreateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'uniconfig-managerExecutor-window-create';
    }
    Ext.applyIf(config, {
        title: _('uniconfig_managerExecutor_create'),
        width: 550,
        autoHeight: true,
        url: uniConfig.config.connector_url,
        action: 'mgr/manager_executor/create',
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
        return [
          {
            xtype: 'uniconfig-combo-manager-executor',
            fieldLabel: _('uniconfig_managerExecutor_user'),
            name: 'user',
            id: config.id + '-user',
            anchor: '99%',
            allowBlank: false,
        },
            {
                xtype: 'uniconfig-combo-specialization',
                fieldLabel: _('uniconfig_managerExecutor_specialization'),
                name: 'specialization',
                id: config.id + '-specialization',
                anchor: '99%',
                allowBlank: false,
            },
        ];
    },

    loadDropZones: function () {
    }

});
Ext.reg('uniconfig-managerExecutor-window-create', uniConfig.window.CreateItem);


uniConfig.window.UpdateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'uniconfig-managerExecutor-window-update';
    }
    Ext.applyIf(config, {
        title: _('uniconfig_managerExecutor_update'),
        width: 550,
        autoHeight: true,
        url: uniConfig.config.connector_url,
        action: 'mgr/manager_executor/update',
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
      },{
        xtype: 'uniconfig-combo-manager-executor',
        fieldLabel: _('uniconfig_managerExecutor_user'),
        name: 'user',
        id: config.id + '-user',
        anchor: '99%',
        allowBlank: false,
      },
        {
          xtype: 'uniconfig-combo-specialization',
          fieldLabel: _('uniconfig_managerExecutor_specialization'),
          name: 'specialization',
          id: config.id + '-specialization',
          anchor: '99%',
          allowBlank: false,
        },
      ];
    },

    loadDropZones: function () {
    }

});
Ext.reg('uniconfig-managerExecutor-window-update', uniConfig.window.UpdateItem);