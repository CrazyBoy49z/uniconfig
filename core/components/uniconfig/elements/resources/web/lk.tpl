{$_modx->runSnippet('pdoUsers',[
'users' => $_modx->user.id,
'tpl' => '@FILE chunks/users/_user_info.tpl',
'leftJoin' => [
'UserGroup' => [
'class' => 'modUserGroup',
'on' => 'modUser.primary_group = UserGroup.id'
],
],
'select' => [
'modUser' => '*',
'UserGroup' => 'UserGroup.name as group_name',
],
])}