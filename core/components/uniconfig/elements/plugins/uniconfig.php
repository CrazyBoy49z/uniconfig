<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var uniConfig $uniConfig */
switch ($modx->event->name) {
	case 'OnMODXInit':
		if ($uniConfig = $modx->getService('uniConfig', 'uniConfig', MODX_CORE_PATH . 'components/uniconfig/model/')) {
			$uniConfig->initialize();
		}
		break;
	default:
		if ($uniConfig = $modx->getService('uniConfig')) {
			$uniConfig->handleEvent($modx->event, $scriptProperties);
		}
}