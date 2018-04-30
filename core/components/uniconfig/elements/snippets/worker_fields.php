<?php
//возвращает доп. поля текущего сотрудника, а именно исполнителя, упр. спец и упр. локацией
$user_id = $modx->getOption('user_id', $scriptProperties, '', true);
$class = $modx->getOption('class', $scriptProperties, '', true);
$pdo = $modx->getService('pdoFetch');
$fields = $pdo->getArray($class, ['user'=> $user_id]);

return $fields;