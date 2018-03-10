{$_modx->runSnippet('!officeAuth',[
  'groups' => 'Users',
  'HybridAuth' => 0,
  'tplLogin' => '@FILE chunks/login/_registration.tpl',
  'loginResourceId' => 8,
])}