<?php
if ($transport->xpdo) {
$modx =& $transport->xpdo;

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
  case xPDOTransport::ACTION_INSTALL:
  case xPDOTransport::ACTION_UPGRADE:
    $uniCorePath = MODX_CORE_PATH . 'components/uniconfig/';
    $metaFile = $uniCorePath . 'model/uniconfig/metadata.mysql.php';
    $code = file_get_contents($metaFile);
    $neededCode = <<<'CODE'
/* generated from resolver */
$this->map['modUser']['aggregates']['Orders'] = array(
'class' => 'uniOrder',
'local' => 'id',
'foreign' => 'created_by',
'cardinality' => 'many',
'owner' => 'local',
);
$this->map['modUser']['composites']['Executor'] = array(
'class' => 'uniExecutor',
'local' => 'id',
'foreign' => 'user',
'cardinality' => 'one',
'owner' => 'local',
);
$this->map['modUser']['composites']['ManagerLocation'] = array(
'class' => 'uniManagerLocation',
'local' => 'id',
'foreign' => 'user',
'cardinality' => 'one',
'owner' => 'local',
);
$this->map['modUser']['composites']['ManagerExecutor'] = array(
'class' => 'uniManagerExecutor',
'local' => 'id',
'foreign' => 'user',
'cardinality' => 'one',
'owner' => 'local',
);
$this->map['modUser']['aggregates']['Comments'] = array(
'class' => 'uniComment',
'local' => 'id',
'foreign' => 'user_id',
'cardinality' => 'many',
'owner' => 'local',
);
CODE;
    if (strpos($code, $neededCode) === FALSE) {
      file_put_contents($metaFile, $neededCode, FILE_APPEND);
    }
    break;
}
}