<?php
//возвращает доп. поля текущего сотрудника, а именно исполнителя, упр. спец и упр. локацией
$user_id = (int)$modx->getOption('user_id', $scriptProperties, '', true);
$tpl = $modx->getOption('tpl', $scriptProperties, '', true);
/** @var pdoFetch $pdo */
$pdo = $modx->getService('pdoFetch');
/** @var modUser $user */
$user = $modx->getObject('modUser', $user_id);
$out = [];
/** @var modUserGroup $pg */
$pg = $user->getUserGroupNames();

switch ($pg[0]) {
  case 'Executors':
    $out = $pdo->getArray('uniExecutor', ['uniExecutor.user'=> $user_id],[
      'leftJoin' => [
        'Location' => [
          'class' => 'uniLocation',
          'on' => 'uniExecutor.location = Location.id',
        ],
        'Specialization' => [
          'class' => 'uniSpecialization',
          'on' => 'uniExecutor.specialization = Specialization.id'
        ],
      ],
      'select' => [
        'uniExecutor' => '*',
        'Location' => 'Location.name as location_name',
        'Specialization' => 'Specialization.name as specialization_name',
      ],
    ]);
    $out['position'] = 'Исполнитель';
    break;
  case 'Dispatchers':
    $out['position'] = 'Диспетчер';
    break;
  case 'ManagerLocation':
    $out = $pdo->getArray('uniManagerLocation', ['uniManagerLocation.user'=> $user_id],[
      'leftJoin' => [
        'Location' => [
          'class' => 'uniLocation',
          'on' => 'uniManagerLocation.location = Location.id',
        ],
      ],
      'select' => [
        'uniManagerLocation' => '*',
        'Location' => 'Location.name as location_name',
      ],
    ]);
    $out['position'] = 'Управляющий локацией';
    break;
  case 'ManagerExecutor':
    $out = $pdo->getArray('uniManagerExecutor', ['uniManagerExecutor.user'=> $user_id],[
      'leftJoin' => [
        'Specialization' => [
          'class' => 'uniSpecialization',
          'on' => 'uniManagerExecutor.specialization = Specialization.id'
        ],
      ],
      'select' => [
        'uniManagerExecutor' => '*',
        'Specialization' => 'Specialization.name as specialization_name',
      ],
    ]);
    $out['position'] = 'Управляющий специализацией';
    break;
}
if ($tpl) {
  $out = $pdo->getChunk($tpl, $out);
}
  return $out;