<div class="panel panel-default">
  {$_modx->runSnippet('!OfficeProfile',[
  'tplProfile' => '@FILE chunks/login/_profile.tpl',
  'requiredFields' => 'phone',
  'HybridAuth' => 0,
  ])}
</div>