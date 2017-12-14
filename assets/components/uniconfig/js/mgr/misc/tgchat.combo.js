uniConfig.combo.Loc = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        name: 'theme_id'
        ,hiddenName: 'theme_id'
        ,displayField: 'name'
        ,valueField: 'id'
        ,fields: ['id','name']
        ,pageSize: 10
        ,url: uniConfig.config.connector_url
        ,baseParams: {
            action: 'mgr/theme/getlist',
            combo: true
        }
    });
    uniConfig.combo.Loc.superclass.constructor.call(this,config);
};
Ext.extend(uniConfig.combo.Loc,MODx.combo.ComboBox);
Ext.reg('uniconfig-combo-loc',uniConfig.combo.Loc);