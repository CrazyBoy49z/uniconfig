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



$ds = DIRECTORY_SEPARATOR;
$uploadPath = MODX_ASSETS_PATH . 'uploads/users';
$storeFolder = 'uploads';
if(isset($_POST['id'])){
  unlink($uploadPath . $ds . $storeFolder . $ds . $_POST['id']);
}
if (!empty($_FILES)) {
  $modx->log(1, print_r($_FILES));

  $tempFile = $_FILES['file']['tmp_name'];

  $targetPath = $uploadPath . $ds. $storeFolder . $ds;

  $targetFile =  $targetPath. $_FILES['file']['name'];

  move_uploaded_file($tempFile,$targetFile);

}