uniConfig.window.CreateItem = function (config) {
  config = config || {};
  if (!config.id) {
    config.id = 'uniconfig-executor-window-create';
  }
  Ext.applyIf(config, {
    title: _('uniconfig_executor_create'),
    width: 550,
    autoHeight: true,
    url: uniConfig.config.connector_url,
    action: 'mgr/executor/create',
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
      xtype: 'uniconfig-combo-user',
      fieldLabel: _('uniconfig_executor_user'),
      name: 'user',
      id: config.id + '-user',
      anchor: '99%',
      allowBlank: false,
    },
      {
        xtype: 'uniconfig-combo-location',
        fieldLabel: _('uniconfig_executor_location'),
        name: 'location',
        id: config.id + '-location',
        anchor: '99%',
        allowBlank: false,
      },
      {
        xtype: 'uniconfig-combo-specialization',
        fieldLabel: _('uniconfig_executor_specialization'),
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
Ext.reg('uniconfig-executor-window-create', uniConfig.window.CreateItem);


uniConfig.window.UpdateItem = function (config) {
  config = config || {};
  if (!config.id) {
    config.id = 'uniconfig-executor-window-update';
  }
  Ext.applyIf(config, {
    title: _('uniconfig_executor_update'),
    width: 550,
    autoHeight: true,
    url: uniConfig.config.connector_url,
    action: 'mgr/executor/update',
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
      xtype: 'uniconfig-combo-user',
      fieldLabel: _('uniconfig_executor_user'),
      name: 'user',
      id: config.id + '-user',
      anchor: '99%',
      allowBlank: false,
    },
      {
        xtype: 'uniconfig-combo-location',
        fieldLabel: _('uniconfig_executor_location'),
        name: 'location',
        id: config.id + '-location',
        anchor: '99%',
        allowBlank: false,
      },
      {
        xtype: 'uniconfig-combo-specialization',
        fieldLabel: _('uniconfig_executor_specialization'),
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
Ext.reg('uniconfig-executor-window-update', uniConfig.window.UpdateItem);