uniConfig.grid.Executors = function (config) {
  config = config || {};
  if (!config.id) {
    config.id = 'uniconfig-grid-executor';
  }
  Ext.applyIf(config, {
    url: uniConfig.config.connector_url,
    fields: this.getFields(config),
    columns: this.getColumns(config),
    tbar: this.getTopBar(config),
    sm: new Ext.grid.CheckboxSelectionModel(),
    baseParams: {
      action: 'mgr/executor/getlist'
    },
    listeners: {
      rowDblClick: function (grid, rowIndex, e) {
        var row = grid.store.getAt(rowIndex);
        this.updateExecutor(grid, e, row);
      }
    },
    viewConfig: {
      forceFit: true,
      enableRowBody: true,
      autoFill: true,
      showPreview: true,
      scrollOffset: 0
    },
    paging: true,
    remoteSort: true,
    autoHeight: true
  });
  uniConfig.grid.Executors.superclass.constructor.call(this, config);

  // Clear selection on grid refresh
  this.store.on('load', function () {
    if (this._getSelectedIds().length) {
      this.getSelectionModel().clearSelections();
    }
  }, this);
};
Ext.extend(uniConfig.grid.Executors, MODx.grid.Grid, {
  windows: {},

  getMenu: function (grid, rowIndex) {
    var ids = this._getSelectedIds();

    var row = grid.getStore().getAt(rowIndex);
    var menu = uniConfig.utils.getMenu(row.data['actions'], this, ids);

    this.addContextMenuItem(menu);
  },

  createItem: function (btn, e) {
    var w = MODx.load({
      xtype: 'uniconfig-executor-window-create',
      id: Ext.id(),
      listeners: {
        success: {
          fn: function () {
            this.refresh();
          }, scope: this
        }
      }
    });
    w.reset();
    w.show(e.target);
  },

  updateItem: function (btn, e, row) {
    if (typeof(row) != 'undefined') {
      this.menu.record = row.data;
    }
    else if (!this.menu.record) {
      return false;
    }
    var id = this.menu.record.id;

    MODx.Ajax.request({
      url: this.config.url,
      params: {
        action: 'mgr/executor/get',
        id: id
      },
      listeners: {
        success: {
          fn: function (r) {
            var w = MODx.load({
              xtype: 'uniconfig-executor-window-update',
              id: Ext.id(),
              record: r,
              listeners: {
                success: {
                  fn: function () {
                    this.refresh();
                  }, scope: this
                }
              }
            });
            w.reset();
            w.setValues(r.object);
            w.show(e.target);
          }, scope: this
        }
      }
    });
  },

  removeItem: function () {
    var ids = this._getSelectedIds();
    if (!ids.length) {
      return false;
    }
    MODx.msg.confirm({
      title: ids.length > 1
        ? _('uniconfig_executors_remove')
        : _('uniconfig_executor_remove'),
      text: ids.length > 1
        ? _('uniconfig_executors_remove_confirm')
        : _('uniconfig_executor_remove_confirm'),
      url: this.config.url,
      params: {
        action: 'mgr/executor/remove',
        ids: Ext.util.JSON.encode(ids),
      },
      listeners: {
        success: {
          fn: function () {
            this.refresh();
          }, scope: this
        }
      }
    });
    return true;
  },


  getFields: function () {
    return ['id', 'user', 'location', 'specialization', 'actions'];
  },

  getColumns: function () {
    return [{
      header: _('uniconfig_item_id'),
      dataIndex: 'id',
      sortable: true,
      width: 70
    },
      {
      header: _('uniconfig_executor_user'),
      dataIndex: 'user',
      sortable: true,
      width: 200,
      editor: {xtype: 'uniconfig-combo-user', renderer: true}
    },
      {
        header: _('uniconfig_executor_location'),
        dataIndex: 'location',
        sortable: true,
        width: 200,
        editor: {xtype: 'uniconfig-combo-location', renderer: true}
      },
      {
        header: _('uniconfig_executor_specialization'),
        dataIndex: 'specialization',
        sortable: true,
        width: 200,
        editor: {xtype: 'uniconfig-combo-specialization', renderer: true}
      },
      {
        header: _('uniconfig_grid_actions'),
        dataIndex: 'actions',
        renderer: uniConfig.utils.renderActions,
        sortable: false,
        width: 100,
        id: 'actions'
      }];
  },

  getTopBar: function () {
    return [{
      text: '<i class="icon icon-plus"></i>&nbsp;' + _('uniconfig_executor_create'),
      handler: this.createItem,
      scope: this
    }, '->', {
      xtype: 'uniconfig-field-search',
      width: 250,
      listeners: {
        search: {
          fn: function (field) {
            this._doSearch(field);
          }, scope: this
        },
        clear: {
          fn: function (field) {
            field.setValue('');
            this._clearSearch();
          }, scope: this
        },
      }
    }];
  },

  onClick: function (e) {
    var elem = e.getTarget();
    if (elem.nodeName == 'BUTTON') {
      var row = this.getSelectionModel().getSelected();
      if (typeof(row) != 'undefined') {
        var action = elem.getAttribute('action');
        if (action == 'showMenu') {
          var ri = this.getStore().find('id', row.id);
          return this._showMenu(this, ri, e);
        }
        else if (typeof this[action] === 'function') {
          this.menu.record = row.data;
          return this[action](this, e);
        }
      }
    }
    return this.processEvent('click', e);
  },

  _getSelectedIds: function () {
    var ids = [];
    var selected = this.getSelectionModel().getSelections();

    for (var i in selected) {
      if (!selected.hasOwnProperty(i)) {
        continue;
      }
      ids.push(selected[i]['id']);
    }

    return ids;
  },

  _doSearch: function (tf) {
    this.getStore().baseParams.query = tf.getValue();
    this.getBottomToolbar().changePage(1);
  },

  _clearSearch: function () {
    this.getStore().baseParams.query = '';
    this.getBottomToolbar().changePage(1);
  },
});
Ext.reg('uniconfig-grid-executors', uniConfig.grid.Executors);
