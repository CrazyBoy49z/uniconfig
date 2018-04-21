+<?php

/** @var uniOrder $order */
if ($_GET['order'] && $order = $modx->getObject('uniOrder', $_GET['order'])) {
    if ($modx->user->isMember('Users')){
        if ($order->get('created_by') != $modx->user->get('id')){
            $url = $modx->makeUrl(3);
            $modx->sendRedirect($url);
        }
    }

    $tpl = $modx->getOption('tpl', $scriptProperties, 'tpl', true);
    /** @var modUser $user */
    $user = $order->getOne('CreatedUser');
    /** @var modUserProfile $profile */
    $profile = $user->getOne('Profile');
    $specialization = $order->getOne('Specialization');
    $location = $order->getOne('Locations');
    $status = $order->getOne('Status');

    #Создаем массив
    $arr = array(
        "id" => $order->get('id'),
        "date" => $order->get('date'),
        "profile" => $profile,
        "specialization" => $specialization,
        "description" => $order->get('description'),
        "location" => $location,
        "status" => $status,
    );

    $pdoTools = $modx->getService('pdoTools');
    $output = $pdoTools->getChunk($tpl, $arr);


    return $output;
}