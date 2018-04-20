<div class="panel panel-default">
  {$_modx->runSnippet('!OfficeProfile',[
    'tplProfile' => '@FILE chunks/login/_profile.tpl',
    'profileFields' => 'phone:18, fullname',
    'requiredFields' => 'phone',
    'HybridAuth' => 0,
  ])}
</div>