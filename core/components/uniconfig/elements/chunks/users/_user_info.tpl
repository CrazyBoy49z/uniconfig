<div class="col-sm-12">
  <div class="row">
    <div class="panel panel-default">
      <div class="pull-left">
        <img src="{$_modx->runSnippet('@FILE snippets/avatar.php', ['user_id' => $id])}" alt="" class="img-circle"
             style="width: 150px;padding: 15px 5px;">
      </div>
      <div class="pull-left  col-sm-8 col-md-9 col-lg-10">
        <div style="padding-left: 0;margin-top: 20px;">
          <h4>{$fullname}</h4>
        </div>
        <div class="panel-body" style="padding-left: 0;">
          <p>E-mail: <a href="mailto:{$email}">{$email}</a></p>
          <p>{if $phone == ''}{else}Телефон: {$phone}{/if}</p>
          {if $group_name != 'Users'}
            {set $fields = $_modx->runSnippet('@FILE snippets/worker_fields.php', [
            'user_id' => $id,
            'tpl' => '@INLINE
              {if $position}
                <p>Должность: {$position}</p>
              {/if}
              {if $specialization}
                <p>Специализация: {$specialization_name}</p>
              {/if}
              {if $location}
                <p>Локация: {$location_name}</p>
              {/if}
              '])}
            {if $fields}{$fields}{/if}
          {/if}
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
{if $group_name != 'Executors'}
  {set $orders = $_modx->runSnippet('!pdoPage',[
  'class' => 'uniOrder',
  'tpl' => '@FILE chunks/order/_lk.orders.tpl',
  'where' => '{"created_by": '~ $id ~ '}',
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
  <div class="col-sm-12">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Список созданных заявок ({$_modx->getPlaceholder('page.total')})</h3>
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
                <p class="text-center">Нет созданных заявок</p>
              </div>
            </div>
          {/if}
        </div>
      </div>
    </div>
  </div>
{else}
  {set $orders = $_modx->runSnippet('!pdoPage',[
  'class' => 'uniOrder',
  'tpl' => '@FILE chunks/order/_lk.orders.tpl',
  'where' => '{"executor": '~ $id ~ '}',
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
  <div class="col-sm-12">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Список назначенных заявок ({$_modx->getPlaceholder('page.total')})</h3>
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
                <p class="text-center">Нет назначенных заявок</p>
              </div>
            </div>
          {/if}
        </div>
      </div>
    </div>
  </div>
{/if}