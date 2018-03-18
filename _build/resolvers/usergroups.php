<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
  $modx =& $transport->xpdo;
  /*
  Policy
    id 3 = Load Only;
    id 4 = Load, List and View;
  --
  Authority
   0 - SuperUser
  9999 - Member
  */
  $user_groups = [
    'Users' => [
      'description' => 'Зарегистрированные пользователи',
      'parent' => 0,
      'rank' => 0,
      'dashboard' => 1,
      'rgroups'=>[
        [
          'name' => 'Users',
          'authority' => 9999,
          'policy' => 4,
        ],
        [
          'name' => 'Dispatchers',
          'authority' => 9999,
          'policy' => 3,
        ],
      ],
    ],
    'Dispatchers' => [
      'description' => 'Диспетчеры',
      'parent' => 0,
      'rank' => 0,
      'dashboard' => 1,
      'rgroups'=>[
        [
          'name' => 'Dispatchers',
          'authority' => 9999,
          'policy' => 4,
        ],
        [
          'name' => 'Users',
          'authority' => 9999,
          'policy' => 4,
        ],
      ],
    ],
  ];
  $uGroupsIds = [];
  switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
      //Сначала создаем или обновляем группы пользователей
    foreach ($user_groups as $user_group => $v) {
        /** @var modUserGroup $uGroup */
      $uGroup = $modx->getObject('modUserGroup', array('name' => $user_group));
      if (!$uGroup) {
        $uGroup = $modx->newObject('modUserGroup');
      }
      $uGroup->fromArray([
        'name' => $user_group,
        'description' => $v['description'],
        'rank' => $v['rank'],
        'dashboard' => $v['dashboard'],
      ]);
      $uGroup->save();
      $uGroupsIds[] = $uGroup->get('id');
    }
    //Теперь создаем группы ресурсов
    $i = 0;
    foreach ($user_groups as $user_group) {
      $resource_groups = $user_group['rgroups'];
        foreach ($resource_groups as $resource_group) {
          /** @var modResourceGroup $rGroup */
          $rGroup = $modx->getObject('modResourceGroup', array('name' => $resource_group['name']));
          if (!$rGroup) {
            $rGroup = $modx->newObject('modResourceGroup');
          }
          $rGroup->set('name', $resource_group['name']);
          $rGroup->save();
          $rGroupId = $rGroup->get('id');
          /** @var modAccessResourceGroup $arg */
          $arg = $modx->getObject('modAccessResourceGroup', array('principal' => $uGroupsIds[$i], 'target' => $rGroupId));
          if (!$arg){
            $arg = $modx->newObject('modAccessResourceGroup');
          }
          $arg->fromArray(array(
            'principal' => $uGroupsIds[$i],
            'principal_class' => 'modUserGroup',
            'target' => $rGroupId,
            'authority' => $resource_group['authority'], // some authority level
            'policy' => $resource_group['policy'],  // some policy ID
            'context_key' => 'web',
          ));
          $arg->save();
        }
    $i++;
    }

      break;
    case xPDOTransport::ACTION_UNINSTALL:
      //При деинсталяции компонента
      foreach ($user_groups as $k => $v) {
        $ugroup = $modx->getObject('modUserGroup', array('name' => $k));
        if($ugroup){
          $ugroup->remove();
          foreach ($v['rgroups'] as $rg){
            $rgroup = $modx->getObject('modResourceGroup', array('name' => $rg['name']));
            if($rgroup){
              $rgroup->remove();
            }
          }
        }
      }
      break;
  }
}
return true;