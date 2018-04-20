<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
  $modx =& $transport->xpdo;
  $statuses = [
    [
      'id' => 1,
      'name' => 'Новая',
      'active' => true,
      'email_customer' => true,
      'email_dispatcher' => true,
      'email_location_manager' => true,
      'email_chief' => true,
      'message' => 'Сообщение',
    ],
    [
      'id' => 2,
      'name' => 'Отправлена',
      'active' => true,
      'email_customer' => true,
      'email_dispatcher' => false,
      'email_location_manager' => false,
      'email_chief' => false,
      'message' => 'Сообщение',
    ],
  ];
}
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
  case xPDOTransport::ACTION_INSTALL:
  case xPDOTransport::ACTION_UPGRADE:
  foreach ($statuses as $status => $v) {
    $status = $modx->getObject('uniOrderStatus', array('id' => $v['id']));
    if (!$status){
      $status = $modx->newObject('uniOrderStatus');
    }
    $status->fromArray([
      'id' => $v['id'],
      'name' => $v['name'],
      'active' => $v['active'],
      'email_customer' => $v['email_customer'],
      'email_dispatcher' => $v['email_dispatcher'],
      'email_location_manager' => $v['email_location_manager'],
      'email_chief' => $v['email_chief'],
      'message' => $v['message'],
    ]);
    $status->save();
  }
  break;
  case xPDOTransport::ACTION_UNINSTALL:
    //При деинсталяции компонента
    foreach ($statuses as $status => $v) {
      $status = $modx->getObject('uniOrderStatus', array('id' => $v['id']));
      if ($status) {
        $status->remove();
      }
    }
    break;
}
return true;