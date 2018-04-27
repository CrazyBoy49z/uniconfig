{set $fullname = $_modx->runSnippet('pdoUsers', ['users'=> $user_id, 'tpl' => '@INLINE {$fullname}'])}
<div class="comment">
  <div class="col-sm-1 hidden-xs">
    <div class="row">
      <div class="comment-avatar">
        <img src="{$_modx->runSnippet('@FILE snippets/avatar.php', ['user_id' => $user_id])}" alt="Аватарка"
             class="img-circle thumb-md">
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-11">
    <div class="row">
      <div class="comment-message">
        <div class="comment-meta">
          <div class="comment-author">{$fullname}</div>
          <div class="comment-date">{$date  | dateago}</div>
        </div>
        {$comment}
      </div>
    </div>
  </div>
</div>