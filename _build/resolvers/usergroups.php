<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
  $modx =& $transport->xpdo;
  $user_groups = [
    0 => [
      'name' => 'Users',
      'description' => 'Зарегистрированные пользователи',
      'parent' => 0,
      'rank' => 0,
      'dashboard' => 1,
      'authority' => 9999,
      'policy' => 4,
    ],
    1 => [
      'name' => 'Dispatchers',
      'description' => 'Диспетчеры',
      'parent' => 0,
      'rank' => 0,
      'dashboard' => 1,
      'authority' => 9999,
      'policy' => 4,
    ],
  ];
  switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
    foreach ($user_groups as $k => $v) {
      $ugroup = $modx->getObject('modUserGroup',  array('name' => $v['name']));
      if (!$ugroup) {
        $ugroup = $modx->newObject('modUserGroup');
      }
      $ugroup->set('name', $v['name']);
      $ugroup->set('description', $v['description']);
      $ugroup->Set('rank', $v['rank']); // optional
      $ugroup->set('dashboard', $v['dashboard']); // optional
      $ugroup->save();

      $rgroup = $modx->getObject('modResourceGroup', array('name' => $v['name']));
      if(!$rgroup) {
        $rgroup = $modx->newObject('modResourceGroup');
      }
      $rgroup->set('name', $v['name']);
      $rgroup->save();

      $ugroup = $modx->getObject('modUserGroup',  array('name' => $v['name']));
      $ugroupId = $ugroup->get('id');

      $rgroup = $modx->getObject('modResourceGroup', array('name' => $v['name']));
      $rgroupId = $rgroup->get('id');

      $arg = $modx->getObject('modAccessResourceGroup', array('principal' => $ugroupId, 'target' => $rgroupId));
      if (!$arg){
        $arg = $modx->newObject('modAccessResourceGroup');
      }
      $arg->fromArray(array(
        'principal' => $ugroupId,
        'principal_class' => 'modUserGroup',
        'target' => $rgroupId,
        'authority' => $v['authority'], // some authority level
        'policy' => $v['policy'],  // some policy ID
        'context_key' => 'web',
      ));
      $arg->save();
    }
      break;
    case xPDOTransport::ACTION_UNINSTALL:
      foreach ($user_groups as $k => $v) {
        $ugroup = $modx->getObject('modUserGroup', array('name' => $v['name']));
        if($ugroup){
          $ugroup->remove();
        }
        $rgroup = $modx->getObject('modResourceGroup', array('name' => $v['name']));
        if($rgroup){
          $rgroup->remove();
        }
      }
      break;
  }
}
return true;