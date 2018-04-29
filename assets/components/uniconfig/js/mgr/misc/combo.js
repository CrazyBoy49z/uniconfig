uniConfig.combo.Search = function (config) {
  config = config || {};
  Ext.applyIf(config, {
    xtype: 'twintrigger',
    ctCls: 'x-field-search',
    allowBlank: true,
    msgTarget: 'under',
    emptyText: _('search'),
    name: 'query',
    triggerAction: 'all',
    clearBtnCls: 'x-field-search-clear',
    searchBtnCls: 'x-field-search-go',
    onTrigger1Click: this._triggerSearch,
    onTrigger2Click: this._triggerClear,
  });
  uniConfig.combo.Search.superclass.constructor.call(this, config);
  this.on('render', function () {
    this.getEl().addKeyListener(Ext.EventObject.ENTER, function () {
      this._triggerSearch();
    }, this);
  });
  this.addEvents('clear', 'search');
};
Ext.extend(uniConfig.combo.Search, Ext.form.TwinTriggerField, {

  initComponent: function () {
    Ext.form.TwinTriggerField.superclass.initComponent.call(this);
    this.triggerConfig = {
      tag: 'span',
      cls: 'x-field-search-btns',
      cn: [
        {tag: 'div', cls: 'x-form-trigger ' + this.searchBtnCls},
        {tag: 'div', cls: 'x-form-trigger ' + this.clearBtnCls}
      ]
    };
  },

  _triggerSearch: function () {
    this.fireEvent('search', this);
  },

  _triggerClear: function () {
    this.fireEvent('clear', this);
  },

});
Ext.reg('uniconfig-combo-search', uniConfig.combo.Search);
Ext.reg('uniconfig-field-search', uniConfig.combo.Search);
uniConfig.combo.Location = function (config) {
  config = config || {};
  Ext.applyIf(config, {
    name: 'location'
    , hiddenName: 'location'
    , displayField: 'name'
    , valueField: 'id'
    , fields: ['id', 'name']
    , pageSize: 10
    , url: uniConfig.config.connector_url
    , baseParams: {
      action: 'mgr/location/getlist',
      combo: true
    }
  });
  uniConfig.combo.Location.superclass.constructor.call(this, config);
};

Ext.extend(uniConfig.combo.Location, MODx.combo.ComboBox);
Ext.reg('uniconfig-combo-location', uniConfig.combo.Location);

uniConfig.combo.Specialization = function (config) {
  config = config || {};
  Ext.applyIf(config, {
    name: 'specialization'
    , hiddenName: 'specialization'
    , displayField: 'name'
    , valueField: 'id'
    , fields: ['id', 'name']
    , pageSize: 10
    , url: uniConfig.config.connector_url
    , baseParams: {
      action: 'mgr/specialization/getlist',
      combo: true
    }
  });
  uniConfig.combo.Specialization.superclass.constructor.call(this, config);
};
Ext.extend(uniConfig.combo.Specialization, MODx.combo.ComboBox);
Ext.reg('uniconfig-combo-specialization', uniConfig.combo.Specialization);

uniConfig.combo.User = function (config) {
  config = config || {};
  Ext.applyIf(config, {
    name: 'user'
    , hiddenName: 'user'
    , displayField: 'fullname'
    , valueField: 'id'
    , fields: ['id', 'fullname']
    , pageSize: 10
    , url: uniConfig.config.connector_url
    , baseParams: {
      action: 'mgr/executor/users/getlist',
      combo: true
    }
  });
  uniConfig.combo.User.superclass.constructor.call(this, config);
};
Ext.extend(uniConfig.combo.User, MODx.combo.ComboBox);
Ext.reg('uniconfig-combo-user', uniConfig.combo.User);


uniConfig.combo.ManagerLocation = function (config) {
  config = config || {};
  Ext.applyIf(config, {
    name: 'user'
    , hiddenName: 'user'
    , displayField: 'fullname'
    , valueField: 'id'
    , fields: ['id', 'fullname']
    , pageSize: 10
    , url: uniConfig.config.connector_url
    , baseParams: {
      action: 'mgr/manager_location/users/getlist',
      combo: true
    }
  });
  uniConfig.combo.ManagerLocation.superclass.constructor.call(this, config);
};
Ext.extend(uniConfig.combo.ManagerLocation, MODx.combo.ComboBox);
Ext.reg('uniconfig-combo-manager-location', uniConfig.combo.ManagerLocation);

uniConfig.combo.ManagerExecutor = function (config) {
  config = config || {};
  Ext.applyIf(config, {
    name: 'user'
    , hiddenName: 'user'
    , displayField: 'fullname'
    , valueField: 'id'
    , fields: ['id', 'fullname']
    , pageSize: 10
    , url: uniConfig.config.connector_url
    , baseParams: {
      action: 'mgr/manager_executor/users/getlist',
      combo: true
    }
  });
  uniConfig.combo.ManagerExecutor.superclass.constructor.call(this, config);
};
Ext.extend(uniConfig.combo.ManagerExecutor, MODx.combo.ComboBox);
Ext.reg('uniconfig-combo-manager-executor', uniConfig.combo.ManagerExecutor);
