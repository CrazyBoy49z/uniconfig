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
  {set $orders = $_modx->runSnippet('@FILE snippets/orderFilter.php',[
  'tpl' => '@FILE chunks/order/_lk.orders.tpl',
  'where' => $where,
  'limit' => 10,
  ])}
  <div class="col-md-4 col-lg-2">
    <div class="panel row panel-default">
      <div class="panel-body">
        <form action="" class="form-horizontal ajax-form">
          <input type="hidden" name="sortby" value="id">
          <input type="hidden" name="sortdir" value="desc">
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
                'limit' => 0,
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
                'limit' => 0,
                ])}
              </select>
            </div>
          </div>
          <hr>
          <div class="text-right">
            <button class="ajax-start btn btn-primary">Подобрать</button>
            <button class="ajax-reset btn btn-default">Сбросить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8 col-lg-10">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 style="margin-bottom: 10px;" class="panel-title">{$title} <span class="ajax-count"></span></h3>
        <p>Сортировать по дате: <button class="btn btn-default" data-sort-by="date">По возрастанию</button></p>
      </div>
      <div class="panel-body" style="padding-top: 0;">
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
              <tbody class="ajax-container">
              {if $orders}
              {$orders}
              {/if}
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
{/if}