<?php
/** @var modUserProfile $profile */
$profile = $modx->user->getOne('Profile');
$fullname = $profile->get('fullname');
$arr = explode(" ", $fullname);
if (count($arr) == 3){
	for ($i = 1; $i<=2; $i++){
		$ini .=  mb_substr($arr[$i],0,1,'UTF-8').'.';
	}
	return $arr[0].' '.$ini;
}else
	return $fullname;