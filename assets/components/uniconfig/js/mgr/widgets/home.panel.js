uniConfig.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'uniconfig-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('uniconfig') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('uniconfig_location_items'),
                layout: 'anchor',
                items: [{
                    html: _('uniconfig_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'uniconfig-grid-locations',
                    cls: 'main-wrapper',
                }]
            },
                {
                    title: _('uniconfig_status_items'),
                    layout: 'anchor',
                    items: [{
                        html: _('uniconfig_intro_msg'),
                        cls: 'panel-desc',
                    }, {
                        xtype: 'uniconfig-grid-statuses',
                        cls: 'main-wrapper',
                    }]

                },
                {
                    title: _('uniconfig_specialization_items'),
                    layout: 'anchor',
                    items: [{
                        html: _('uniconfig_intro_msg'),
                        cls: 'panel-desc',
                    }, {
                        xtype: 'uniconfig-grid-specializations',
                        cls: 'main-wrapper',
                    }]

                },
                {
                    title: _('uniconfig_executor_items'),
                    layout: 'anchor',
                    items: [{
                        html: _('uniconfig_intro_msg'),
                        cls: 'panel-desc',
                    }, {
                        xtype: 'uniconfig-grid-executors',
                        cls: 'main-wrapper',
                    }]

                },
                {
                    title: _('uniconfig_managerLocation_items'),
                    layout: 'anchor',
                    items: [{
                        html: _('uniconfig_intro_msg'),
                        cls: 'panel-desc',
                    }, {
                        xtype: 'uniconfig-grid-managerLocation',
                        cls: 'main-wrapper',
                    }]

                },
                {
                    title: _('uniconfig_managerExecutor_items'),
                    layout: 'anchor',
                    items: [{
                        html: _('uniconfig_intro_msg'),
                        cls: 'panel-desc',
                    }, {
                        xtype: 'uniconfig-grid-managerExecutor',
                        cls: 'main-wrapper',
                    }]

                },
            ]
        }]
    });
    uniConfig.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(uniConfig.panel.Home, MODx.Panel);
Ext.reg('uniconfig-panel-home', uniConfig.panel.Home);
