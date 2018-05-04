{if $.get['user_id']}
  {$_modx->runSnippet('pdoUsers',[
  'users' => $.get['user_id'],
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
{else}
{$_modx->runSnippet('!pdoPage',[
  'element' => 'pdoUsers',
  'groups' => 'Executors',
  'tpl' => '@FILE chunks/users/_executor.tpl',
  'sortdir' => 'asc',
  'leftJoin' => [
    'Executor' => [
      'class' => 'uniExecutor',
      'on' => 'modUser.id = Executor.user'
    ],
  ],
  'rightJoin' => [
    'Location' => [
      'class' => 'uniLocation',
      'on' => 'Executor.location = Location.id',
    ],
    'Specialization' => [
      'class' => 'uniSpecialization',
      'on' => 'Executor.specialization = Specialization.id'
    ],
  ],
  'select' => [
    'modUser' => '*',
    'Location' => 'Location.name as location_name',
    'Specialization' => 'Specialization.name as specialization_name',
  ],
])}
<div class="clearfix"></div>
{/if}