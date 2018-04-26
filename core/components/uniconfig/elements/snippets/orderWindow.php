<?php
$order_id = $modx->getOption('order_id', $scriptProperties, $_GET['order'], true);
$tpl = $modx->getOption('tpl', $scriptProperties, 'tpl', true);
/** @var uniOrder $order */
if ($order_id && $order = $modx->getObject('uniOrder', $order_id)) {

    if ($modx->user->isMember('Users')) {
      if ($order->get('created_by') != $modx->user->id) {
        $url = $modx->makeUrl(3);
        $modx->sendRedirect($url);
      }
    }
    /** @var modUser $user */
    $user = $order->getOne('CreatedUser');
    /** @var modUserProfile $profile */
    $profile = $user->getOne('Profile');
    /** @var uniSpecialization $specialization */
    $specialization = $order->getOne('Specialization');
    /** @var uniLocation $location */
    $location = $order->getOne('Locations');
    /** @var uniOrderStatus $status */
    $status = $order->getOne('Status');
    /** @var uniOrderHistory $history */
    $histories = $order->getMany('History');
    foreach ($histories as $k => $v) {
      $histories[$k] = $v->toArray();
    }
    #Создаем массив
    $arr = array(
      "id" => $order->get('id'),
      "date" => $order->get('date'),
      "profile" => $profile->toArray(),
      "specialization" => $specialization->toArray(),
      "photo" => $order->get('photo'),
      "description" => $order->get('description'),
      "location" => $location->toArray(),
      "status" => $status->toArray(),
      "histories" => $histories,
    );

    $pdoTools = $modx->getService('pdoTools');
    $output = $pdoTools->getChunk($tpl, $arr);


    return $output;
}