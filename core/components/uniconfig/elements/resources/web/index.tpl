{*Новые, исплняются, отложены, на согласование*}
{set $impl = json_decode($_modx->runSnippet('!pdoResources',[
'class' => 'uniOrder',
'disableConditions' => 1,
'where' => ["status" => 2],
'return' => 'json',
'sortby' => 'id',
'sortdir' => 'ASC',
]))
}

{set $agr = json_decode($_modx->runSnippet('!pdoResources',[
'class' => 'uniOrder',
'disableConditions' => 1,
'where' => ["status" => 6],
'return' => 'json',
'sortby' => 'id',
'sortdir' => 'ASC',
]))
}

{set $defer = json_decode($_modx->runSnippet('!pdoResources',[
'class' => 'uniOrder',
'disableConditions' => 1,
'where' => ["status" => 5],
'return' => 'json',
'sortby' => 'id',
'sortdir' => 'ASC',
]))
}

{set $new = json_decode($_modx->runSnippet('!pdoResources',[
'class' => 'uniOrder',
'disableConditions' => 1,
'where' => ["status" => 1],
'return' => 'json',
'sortby' => 'id',
'sortdir' => 'ASC',
]))
}
{set $check = json_decode($_modx->runSnippet('!pdoResources',[
'class' => 'uniOrder',
'disableConditions' => 1,
'where' => ["status" => 3],
'return' => 'json',
'sortby' => 'id',
'sortdir' => 'ASC',
]))
}
<div class="col-sm-12">
  <div class="row">
    <div class="col-sm-3 col-lg-2">
      <div class="panel panel-default statuses">
        <div class="bg-success">
          <div class="panel-body text-center text-success">
            <h2><i class="fa fa-clock-o"></i></h2>
            <h3>{$impl | length}</h3>
            <p class="small">Выполняются</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-3 col-lg-2">
      <div class="panel panel-default statuses">
        <div>
          <div class="panel-body text-center">
            <h2><i class="fa fa-hourglass-half"></i></h2>
            <h3>{$check | length}</h3>
            <p class="small">Проверяются</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-3 col-lg-2">
      <div class="panel panel-default statuses">
        <div class="bg-info">
          <div class="panel-body text-center text-info">
            <h2><i class="fa fa-bell-o"></i></h2>
            <h3>{$agr | length}</h3>
            <p class="small">На согласовании</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-3 col-lg-2">
      <div class="panel panel-default statuses">
        <div class="bg-warning">
          <div class="panel-body text-center text-warning">
            <h2><i class="fa fa-thumb-tack"></i></h2>
            <h3>{$defer | length}</h3>
            <p class="small">Отложены</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-3 col-lg-2">
      <div class="panel panel-default statuses">
        <div class="bg-danger">
          <div class="panel-body text-center text-danger">
            <h2><i class="fa fa-user-times"></i></h2>
            <h3>{$new | length}</h3>
            <p class="small">Без исполнителя</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>