<div class="col-sm-4 col-lg-3">
  <div class="panel panel-default executor">
    <div class="panel-body">
      <div class="user-info">
        <div class="user-img">
          <a href="users/{$id}">
            <img class="center-block img-circle" style="width: 150px" src="{$_modx->runSnippet('@FILE snippets/avatar.php', ['user_id' => $id])}" alt="Аватарка"></a>
        </div>
        <hr>
        <a href="users/{$id}"><h4>{$fullname}</h4></a>
        <p>Локация: {$location_name}</p>
        <p>Специализация: {$specialization_name}</p>
      </div>
    </div>
  </div>
</div>