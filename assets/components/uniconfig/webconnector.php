<?php

if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
  /** @noinspection PhpIncludeInspection */
  require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
  require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}

require_once MODX_CORE_PATH.'model/modx/modx.class.php';
/** @var modX $modx */
$modx = new modX();
$modx->initialize('web');

//С Ajax это или нет
if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
  $modx->sendRedirect($modx->makeUrl($modx->getOption('site_start'),'','','full'));
}
$uniConfig = $modx->getService('uniconfig', 'uniconfig', MODX_CORE_PATH . 'components/uniconfig/model/');
$modx->lexicon->load('uniConfig:default');
$corePath = $modx->getOption('uniconfig_core_path', null, MODX_CORE_PATH . 'components/uniconfig/');



$path = $corePath . 'processors/web/';

/** @var modProcessorResponse $response */
$response = $modx->runProcessor($_POST['action'], $_POST, [
  'processors_path' => $path,
]);

$json = $modx->toJSON($response->response);
echo $json;

exit();
