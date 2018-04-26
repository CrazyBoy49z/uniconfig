<?php
$order_id = $modx->getOption('order_id', $scriptProperties, $_GET['order'], true);
$comment_id = $modx->getOption('comment_id', $scriptProperties, '', true);
$tpl = $modx->getOption('tpl', $scriptProperties, 'tpl', true);
$pdo = $modx->getService('pdoFetch');
if(!$comment_id){
  $where = [
    'order_id' => $order_id,
  ];
}else{
  $where = [
    'id' => $comment_id,
  ];
}
/** @var uniComment $comments */
if ($comments = $pdo->getCollection('uniComment', $where)) {
  foreach ($comments as $comment) {
    $comment['idx'] = $pdo->idx++;
    $output .= $pdo->getChunk($tpl, $comment);
  }
  return $output;
}
