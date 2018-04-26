<?php
$img = $modx->getOption('img', $scriptProperties, '', true);

$url = $modx->getOption('site_url') . $img;

$size = getimagesize($url);
$width = $size[0];
$height = $size[1];
return $width.'x'.$height;