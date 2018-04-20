uniConfig.window.CreateItem = function (config) {
  config = config || {};
  if (!config.id) {
    config.id = 'uniconfig-managerLocation-window-create';
  }
  Ext.applyIf(config, {
    title: _('uniconfig_managerLocation_create'),
    width: 550,
    autoHeight: true,
    url: uniConfig.config.connector_url,
    action: 'mgr/manager_location/create',
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
      fieldLabel: _('uniconfig_managerLocation_user'),
      name: 'user',
      id: config.id + '-user',
      anchor: '99%',
      allowBlank: false,
    },
      {
        xtype: 'uniconfig-combo-location',
        fieldLabel: _('uniconfig_managerLocation_location'),
        name: 'location',
        id: config.id + '-location',
        anchor: '99%',
        allowBlank: false,
      },
    ];
  },

  loadDropZones: function () {
  }

});
Ext.reg('uniconfig-managerLocation-window-create', uniConfig.window.CreateItem);


uniConfig.window.UpdateItem = function (config) {
  config = config || {};
  if (!config.id) {
    config.id = 'uniconfig-managerLocation-window-update';
  }
  Ext.applyIf(config, {
    title: _('uniconfig_managerLocation_update'),
    width: 550,
    autoHeight: true,
    url: uniConfig.config.connector_url,
    action: 'mgr/manager_location/update',
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
      fieldLabel: _('uniconfig_managerLocation_user'),
      name: 'user',
      id: config.id + '-user',
      anchor: '99%',
      allowBlank: false,
    },
      {
        xtype: 'uniconfig-combo-location',
        fieldLabel: _('uniconfig_managerLocation_location'),
        name: 'location',
        id: config.id + '-location',
        anchor: '99%',
        allowBlank: false,
      },
    ];
  },

  loadDropZones: function () {
  }

});
Ext.reg('uniconfig-managerLocation-window-update', uniConfig.window.UpdateItem);