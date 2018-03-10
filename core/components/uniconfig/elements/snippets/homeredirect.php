<?php
if ($modx->user->isAuthenticated()) {
	$url = $modx->makeUrl(8);
	$modx->sendRedirect($url);
};