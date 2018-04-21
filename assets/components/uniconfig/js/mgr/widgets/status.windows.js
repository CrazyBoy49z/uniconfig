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
      boxLabel: _('uniconfig_status_email_customer'),
      name: 'email_customer',
      id: config.id + '-email_customer',
      checked: false,
    },
      {
        xtype: 'xcheckbox',
        boxLabel: _('uniconfig_status_email_dispatcher'),
        name: 'email_dispatcher',
        id: config.id + '-email_dispatcher',
        checked: false,
      },
      {
        xtype: 'xcheckbox',
        boxLabel: _('uniconfig_status_email_location_manager'),
        name: 'email_location_manager',
        id: config.id + '-email_location_manager',
        checked: false,
      },
      {
        xtype: 'xcheckbox',
        boxLabel: _('uniconfig_status_email_chief'),
        name: 'email_chief',
        id: config.id + '-email_chief',
        checked: false,
      },
    ];
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
    },
      {
        xtype: 'textfield',
        fieldLabel: _('uniconfig_item_name'),
        name: 'name',
        id: config.id + '-name',
        anchor: '99%',
        allowBlank: false,
      }, {
        xtype: 'xcheckbox',
        boxLabel: _('uniconfig_status_email_customer'),
        name: 'email_customer',
        id: config.id + '-email_customer',
        checked: false,
      },
      {
        xtype: 'xcheckbox',
        boxLabel: _('uniconfig_status_email_dispatcher'),
        name: 'email_dispatcher',
        id: config.id + '-email_dispatcher',
        checked: false,
      },
      {
        xtype: 'xcheckbox',
        boxLabel: _('uniconfig_status_email_location_manager'),
        name: 'email_location_manager',
        id: config.id + '-email_location_manager',
        checked: false,
      },
      {
        xtype: 'xcheckbox',
        boxLabel: _('uniconfig_status_email_chief'),
        name: 'email_chief',
        id: config.id + '-email_chief',
        checked: false,
      },
    ];
  },

  loadDropZones: function () {
  }

});
Ext.reg('uniconfig-status-window-update', uniConfig.window.UpdateItem);