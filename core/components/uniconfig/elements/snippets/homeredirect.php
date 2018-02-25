<?php
if ($modx->user->isAuthenticated()) {
	$url = $modx->makeUrl(7);
	$modx->sendRedirect($url);
};