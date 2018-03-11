<?php
$site_url = $modx->getOption('site_url');
$assets_url = $modx->getOption('assets_url');
$no_pic_url = $site_url.$assets_url.'components/uniconfig/img/nopic.png';

$size = $modx->getOption('size', $scriptProperties, '100');
$no_pic = $modx->getOption('no_pic', $scriptProperties, $no_pic_url);


/** @var modUserProfile $profile */
$profile = $modx->user->getOne('Profile');
$photo = $profile->get('photo');

if (empty($photo)){
  $email  = $modx->user->get('email');
  $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $no_pic ) . "&s=" . $size;
  return $grav_url;
}else{
  return $photo;
}