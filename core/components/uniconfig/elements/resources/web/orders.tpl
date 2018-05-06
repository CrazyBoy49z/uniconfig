{set $fields = $_modx->runSnippet('@FILE snippets/worker_fields.php', ['user_id' => $_modx->user.id])}
{switch $fields['position']}
{case 'Диспетчер'}
{set $where = ['status' => 6]}
{set $title = 'Список заявок'}
{case 'Управляющий локацией'}
{set $where = ['location' => $fields['location']]}
{set $title = 'Список заявок'}
{case 'Управляющий специализацией'}
{set $where = ['specialization' => $fields['specialization']]}
{set $title = 'Список заявок'}
{case 'Исполнитель'}
{set $where = ['specialization' => $fields['specialization'], 'location' => $fields['location'], 'status' => 1]}
{set $title = 'Список новых заявок'}
{/switch}
{if $where}
  {set $orders = $_modx->runSnippet('!pdoPage',[
  'class' => 'uniOrder',
  'tpl' => '@FILE chunks/order/_lk.orders.tpl',
  'where' => $where,
  'leftJoin' => '{
      "Status":{
        "class": "uniOrderStatus",
        "on": "uniOrder.status = Status.id"
      },
      "Specialization": {
        "class": "uniSpecialization",
        "on" : "uniOrder.specialization = Specialization.id"
      }
    }',
  'select' => '{
      "uniOrder": "*",
      "Status" : "Status.name as status_name",
      "Specialization" : "Specialization.name as specialization_name"
    }',
  'sortby' => 'id',
  'sortdir' => 'DESC',
  ])}
  <div class="col-md-4 col-lg-2">
    <div class="panel row panel-default">
      <div class="panel-body">
        <form action="" class="form-horizontal">
          <div class="form-group">
            <div class="col-md-12">
              <label for="status">Статус заявки</label>
              <select class="form-control" name="status" id="status">
                <option value="" selected>Все</option>
                {$_modx->runSnippet('!pdoResources',[
                'class' => 'uniOrderStatus',
                'select' => '{"uniOrderStatus":"id,name"}',
                'tpl' => '@INLINE <option value="{{+id}}" >{{+name}}</option>',
                'sortby' => 'id',
                'sortdir' => 'asc',
                'limit' => '0',
                ])}
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <label for="specialization">Специализация</label>
              <select class="form-control" name="specialization" id="specialization">
                <option value="" selected>Все</option>
                {$_modx->runSnippet('!pdoResources',[
                'class' => 'uniSpecialization',
                'select' => '{"uniSpecialization":"id,name"}',
                'tpl' => '@INLINE <option value="{{+id}}" >{{+name}}</option>',
                'where' => '{"active": "1"}',
                'sortby' => 'name',
                'sortdir' => 'asc',
                'limit' => '0',
                ])}
              </select>
            </div>
          </div>
          <hr>
          <div class="text-right">
            <button class="btn btn-primary">Подобрать</button>
            <button class="btn btn-default">Сбросить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8 col-lg-10">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 style="margin-bottom: 10px;" class="panel-title">{$title} ({$_modx->getPlaceholder('page.total')})</h3>
        <p>Сортировать по дате: <button class="btn btn-default" data-sort-by="price">По убыванию</button></p>
      </div>
      <div class="panel-body" style="padding-top: 0;">
        {if $orders}
          <div class="table-responsive">
            <table class="table req table-condensed table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th>Дата</th>
                <th>Специализация</th>
                <th>Статус</th>
              </tr>
              </thead>
              <tbody>
              {$orders}
              </tbody>
            </table>
          </div>
          {$_modx->getPlaceholder('page.nav')}
        {else}
          <div class="row">
            <div class="alert alert-warning">
              <p class="text-center">Нет заявок</p>
            </div>
          </div>
        {/if}
      </div>
    </div>
  </div>
{/if}