{$_modx->runSnippet('!AjaxForm',[
'snippet' => 'login',
'form' => '@FILE chunks/_login.tpl'
])}
{$_modx->runSnippet('!homeredirect')}