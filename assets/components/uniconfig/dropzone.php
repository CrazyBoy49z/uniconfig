<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
  /** @noinspection PhpIncludeInspection */
  require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
  require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}

require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
/** @var modX $modx */
$modx = new modX();
$modx->initialize('web');

//С Ajax это или нет
if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
  $modx->sendRedirect($modx->makeUrl($modx->getOption('site_start'), '', '', 'full'));
}
$uniConfig = $modx->getService('uniconfig', 'uniconfig', MODX_CORE_PATH . 'components/uniconfig/model/');
$modx->lexicon->load('uniConfig:default');
$corePath = $modx->getOption('uniconfig_core_path', null, MODX_CORE_PATH . 'components/uniconfig/');

$out = array();

$ds = DIRECTORY_SEPARATOR;
$uploadPath = MODX_ASSETS_PATH . 'uploads';

if (!empty($_FILES)) {

  $fileTempName = $_FILES['file']['tmp_name'];
  $imageinfo = getimagesize($fileTempName);
  if ($imageinfo['mime'] != 'image/png' && $imageinfo['mime'] != 'image/jpeg') {
    http_response_code(401);
    echo $out['message'] = "Изображение имеет неверный формат. Поддерживаются изображения только JPEG и PNG.";
    exit();
  }
  $fileName = $_FILES['file']['name'];
  $newFileName = newFilename($fileName);
  $newFileName = $uploadPath . $ds . $newFileName . substr($fileName, strpos($fileName, '=') + 1, strlen($fileName));
  $modx->log(1, $newFileName);
  if (is_uploaded_file($fileTempName)) {
    //Перемещаем файл из временной папки в указанную
    if (move_uploaded_file($fileTempName, $newFileName)) {
      $out['url'] = $newFileName;
      http_response_code(200);
      echo json_encode($out);
      exit();
    } else {
      http_response_code(401);
      echo $out['message'] = "Не удалось осуществить сохранение файла!";
      exit();
    }
  }
}

/**
 * @param $file
 * @return string
 *
 */
function newFileName($file)
{
  $newname = $file . time();
  return md5($newname);
}