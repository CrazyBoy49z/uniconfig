<?php
$order_id = $modx->getOption('order_id', $scriptProperties, $_GET['order'], true);
$message_id = $modx->getOption('comment_id', $scriptProperties, '', true);
$tpl = $modx->getOption('tpl', $scriptProperties, 'tpl', true);
$pdo = $modx->getService('pdoFetch');
if(!$comment_id){
  $where = [
    'order_id' => $order_id,
  ];
}else{
  $where = [
    'id' => $message_id,
  ];
}
/** @var uniMessage $messages */
if ($messages = $pdo->getCollection('uniMessage', $where)) {
  foreach ($messages as $mes) {
    $mes['idx'] = $pdo->idx++;
    $output .= $pdo->getChunk($tpl, $mes);
  }
  return $output;
}
