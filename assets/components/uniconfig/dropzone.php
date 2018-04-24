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
$uploadUrl = MODX_ASSETS_URL . 'uploads';

if (!empty($_FILES)) {

  $fileTempName = $_FILES['file']['tmp_name'];
  $imageinfo = getimagesize($fileTempName);
  if ($imageinfo['mime'] != 'image/png' && $imageinfo['mime'] != 'image/jpeg') {
    http_response_code(401);
    echo $out['message'] = "Файл имеет неверный формат. Поддерживаются изображения только JPEG и PNG.";
    exit();
  }
  define('KB', 1024);
  define('MB', 1048576);
  if($_FILES['file']['size'] > 2*MB){
    http_response_code(401);
    echo $out['message'] = "Файл слишком большой. Максимальный размер файла: 2 МБ.";
    exit();
  }
  $fileName = $_FILES['file']['name'];
  $newFileName = newFilename($fileName);
  $destination = $uploadPath . $ds . $newFileName;
  if (is_uploaded_file($fileTempName)) {
    //Перемещаем файл из временной папки в указанную
    if (move_uploaded_file($fileTempName, $destination)) {
      $out['url'] = $uploadUrl . $ds . $newFileName;
      http_response_code(200);
      echo json_encode($out);
      exit();
    } else {
      http_response_code(401);
      echo $out['message'] = "Не удалось осуществить сохранение файла!";
      exit();
    }
  }
}else{
  http_response_code(401);
  echo $out['message'] = "Нет файла!";
  exit();
}

/**
 * @param $file
 * @return string
 *
 */
function newFileName($file)
{
  $type = substr($file, strpos($file, '.') + 1, strlen($file));
  $file = substr($file, 0, strpos($file, '.'));
  $newname = $file . time();
  $newname = md5($newname);
  $newname = $newname . '.'.$type;
  return $newname;
}