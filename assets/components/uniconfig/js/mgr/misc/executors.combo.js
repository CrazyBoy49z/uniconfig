uniConfig.combo.Location = function(config) {
  config = config || {};
  Ext.applyIf(config,{
    name: 'location'
    ,hiddenName: 'location'
    ,displayField: 'name'
    ,valueField: 'id'
    ,fields: ['id','name']
    ,pageSize: 10
    ,url: uniConfig.config.connector_url
    ,baseParams: {
      action: 'mgr/location/getlist',
      combo: true
    }
  });
  uniConfig.combo.Location.superclass.constructor.call(this,config);
};

Ext.extend(uniConfig.combo.Location,MODx.combo.ComboBox);
Ext.reg('uniconfig-combo-location',uniConfig.combo.Location);

uniConfig.combo.Specialization = function(config) {
  config = config || {};
  Ext.applyIf(config,{
    name: 'specialization'
    ,hiddenName: 'specialization'
    ,displayField: 'name'
    ,valueField: 'id'
    ,fields: ['id','name']
    ,pageSize: 10
    ,url: uniConfig.config.connector_url
    ,baseParams: {
      action: 'mgr/specialization/getlist',
      combo: true
    }
  });
  uniConfig.combo.Specialization.superclass.constructor.call(this,config);
};
Ext.extend(uniConfig.combo.Specialization,MODx.combo.ComboBox);
Ext.reg('uniconfig-combo-specialization',uniConfig.combo.Specialization);

uniConfig.combo.User = function(config) {
  config = config || {};
  Ext.applyIf(config,{
    name: 'user'
    ,hiddenName: 'user'
    ,displayField: 'fullname'
    ,valueField: 'id'
    ,fields: ['id','fullname']
    ,pageSize: 10
    ,url: uniConfig.config.connector_url
    ,baseParams: {
      action: 'mgr/executor/users/getlist',
      combo: true
    }
  });
  uniConfig.combo.User.superclass.constructor.call(this,config);
};
Ext.extend(uniConfig.combo.User,MODx.combo.ComboBox);
Ext.reg('uniconfig-combo-user',uniConfig.combo.User);