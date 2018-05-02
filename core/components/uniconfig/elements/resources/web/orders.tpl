{set $fields = $_modx->runSnippet('@FILE snippets/worker_fields.php', ['user_id' => $_modx->user.id])}
{switch $fields['position']}
  {case 'Диспетчер'}
    {set $where = ['status' => 6]}
    {set $title = 'Список заявок со статусом "Согласование"'}
  {case 'Управляющий локацией'}
    {set $where = ['location' => $fields['location']]}
    {set $title = 'Список заявок, локация: '~$fields['location_name']}
  {case 'Управляющий специализацией'}
    {set $where = ['specialization' => $fields['specialization']]}
    {set $title = 'Список заявок, специализация: '~$fields['specialization_name']}
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
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{$title} ({$_modx->getPlaceholder('page.total')})</h3>
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
{/if}