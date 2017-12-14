var uniConfig = function (config) {
    config = config || {};
    uniConfig.superclass.constructor.call(this, config);
};
Ext.extend(uniConfig, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('uniconfig', uniConfig);

uniConfig = new uniConfig();