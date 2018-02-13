<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $ctx_settings = [
        'site_start' => 'index',
        'error_page' => '404',
        'service_id' => 'service',
	      'pdotools_fenom_parser' => 1,
        //'unauthorized_page' => '401',
    ];

    $user_groups = ['Users', 'Dispatchers'];

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $contexts = $modx->getIterator('modContext', ['key:!=' => 'mgr']);
            /** @var modContext $context */
            foreach ($contexts as $context) {
                foreach ($ctx_settings as $setting_key => $uri) {
                    $tmp = $modx->getObject('modResource', ['context_key' => $context->key, 'uri' => $uri]);
                    if ($tmp) {
                        $setting_key = ['context_key' => $context->key, 'key' => $setting_key];
                        if (!$tmp2 = $modx->getObject('modContextSetting', $setting_key)) {
                            $tmp2 = $modx->newObject('modContextSetting');
                            $tmp2->fromArray($setting_key, '', true, true);
                        }
                        $tmp2->set('value', $tmp->get('id'));
                        $tmp2->save();
                    }
                }
            }
	    /* Create User Group */
	    /*Доделать права modAccessResourceGroup
	    https://forums.modx.com/thread/?thread=92630
	    */
	    foreach ($user_groups as $uname) {
		    $ugroup = $modx->newObject('modUserGroup');
		    $ugroup->set('name', $uname);
		    $ugroup->save();

		    /* Create Resource Group */
		    $rgroup = $modx->newObject('modResourceGroup');
		    $rgroup->set('name', $uname);
		    $rgroup->save();
	    }
	    break;
    }

}

return true;