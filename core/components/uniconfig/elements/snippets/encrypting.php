<?php
$string = $modx->getOption('string', $scriptProperties, '', true);
$action = $modx->getOption('action', $scriptProperties, 'encode', true);
$key = $modx->getOption('key', $scriptProperties, 'rlkgerjgsdgwerg', true);
/** @var uniConfig $uniConfig */
$uniConfig = $modx->getService('uniConfig');
if ($action == 'decode'){
  return $uniConfig->decode($string, $key);
}
else {
  return $uniConfig->encode($string, $key);
}