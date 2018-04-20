<?php

/*
 * 1 - Resource
 * 3 - Load Only
 * 4 - Load, List and View
 */
$list = [
  2 => [
    'name' => 'Users',
    'description' => 'Зарегистрированные пользователи',
    'parent' => 0,
    'rank' => 0,
    'dashboard' => 1,
  ],
  3 => [
    'name' => 'Dispatchers',
    'description' => 'Диспетчеры',
    'parent' => 0,
    'rank' => 0,
    'dashboard' => 1,
  ],
];

$userGroups = [];
foreach ($list as $id => &$data) {
  /** @var modUserGroup $userGroup */
  $userGroup = $this->modx->newObject('modUserGroup');
  $userGroup->fromArray(array_merge([
    'id' => $id
  ], $data), '', true, true);
  $userGroups[] = $userGroup;
}

return $userGroups;






/*
 foreach ($user_groups as $k => $v) {

  $ugroup = $modx->newObject('modUserGroup');
  $ugroup->set('name', $k);
  $ugroup->save();

  // Create Resource Group
  $rgroup = $modx->newObject('modResourceGroup');
  $rgroup->set('name', $k);
  $rgroup->save();
  // Create User Group

  // Get the IDs of the User Group and Resource Group
  $ugroup = $modx->getObject('modUserGroup', array('name' => $k));
  $ugroupId = $ugroup->get('id');

  $rgroup = $modx->getObject('modResourceGroup', array('name' => $k));
  $rgroupId = $rgroup->get('id');
  // This part I'm not positive about, but I think it's right
  // Create ACL to connect the two
  $arg = $modx->newObject('modAccessResourceGroup');
  $arg->fromArray(array(
    'principal' => $ugroupId,
    'principal_class' => 'modUserGroup',
    'target' => $rgroupId,
    'authority' => $v['authority'], // some authority level
    'policy' => $v['policy'],  // some policy ID
    'context_key' => 'web',
  ));
  $arg->save();
}*/