{set $fullname = $_modx->runSnippet('pdoUsers', ['users'=> $user_id, 'tpl' => '@INLINE {$fullname}'])}
<div class="comment">
  <div class="col-sm-1 hidden-xs{if $_modx->user.id == $user_id} col-sm-push-11{/if}">
    <div class="row">
      <div class="comment-avatar">
        <img src="{$_modx->runSnippet('@FILE snippets/avatar.php', ['user_id' => $user_id])}" alt="Аватарка"
             class="img-circle thumb-md">
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-10{if $_modx->user.id == $user_id} col-sm-offset-1 col-sm-pull-1{/if}">
    <div class="row">
      <div class="comment-message {if $_modx->user.id == $user_id}dark{else}white{/if}">
        <div class="comment-meta">
          <div class="comment-author">{$fullname}</div>
          <div class="comment-date">{$date  | dateago}</div>
        </div>
        {$comment}
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>