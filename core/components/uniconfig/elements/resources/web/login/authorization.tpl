{$_modx->runSnippet('!officeAuth',[
  'groups' => 'Users',
  'HybridAuth' => 0,
  'tplLogin' => '@FILE chunks/login/_login.tpl',
  'loginResourceId' => 8,
])}
{$_modx->runSnippet('!homeredirect')}