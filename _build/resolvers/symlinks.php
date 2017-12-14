<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/uniConfig/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/uniconfig')) {
            $cache->deleteTree(
                $dev . 'assets/components/uniconfig/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/uniconfig/', $dev . 'assets/components/uniconfig');
        }
        if (!is_link($dev . 'core/components/uniconfig')) {
            $cache->deleteTree(
                $dev . 'core/components/uniconfig/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/uniconfig/', $dev . 'core/components/uniconfig');
        }
    }
}

return true;