<?php
if ($modx->user->isAuthenticated()) {
	$url = $modx->makeUrl(6);
	$modx->sendRedirect($url);
};