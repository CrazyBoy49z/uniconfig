{set $fullname = $_modx->user.fullname}
{set $email = $_modx->user.email}
{set $phone = $_modx->user.phone}
{set $user_id = $_modx->user.id}
<div class="col-sm-2">
    <div class="row">
        <div class="panel panel-default mr10">
            <div class="panel-body">
                <img src="{$_modx->runSnippet('!avatar',['no_pic' => 'https://uni.igamov.ru/assets/tpl/img/nopic.png'])}" alt="" style="width: 100%; height: 100%;">
            </div>
        </div>
    </div>
</div>
<div class="col-sm-10">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{$fullname}</h3>
            </div>
            <div class="panel-body">
                <p>E-mail: <a href="mailto:{$email}">{$email}</a></p>
                <p>{if $phone == ''}{else}Телефон: {$phone}{/if}</p>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
{set $orders = $_modx->runSnippet('!pdoPage',[
'class' => 'uniOrder',
'tpl' => '@FILE chunks/order/_lk.orders.tpl',
'where' => '{"created_by": '~ $user_id ~ '}',
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
'sortdir' => 'DESC'
])}

<div class="col-sm-12">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Список созданных заявок ({$_modx->getPlaceholder('page.total')})</h3>
            </div>
            <div class="panel-body">
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
                        {$orders ?: '<tr><td colspan="7" class="text-center">У Вас нет созданных заявок</td></tr>'}
                        </tbody>
                    </table>
                </div>
                {$_modx->getPlaceholder('page.nav')}
            </div>
        </div>
    </div>
</div>