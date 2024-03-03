<?php

namespace Kanboard\Plugin\ICalConfig\Helper;

use Kanboard\Core\Base;

class ICalHelper extends Base
{
    /**
     * Check if a plugin is installed
     * @param string $pluginId
     * @return bool
     */
    public function isInstalled($pluginId): bool
    {
        $pluginFile = PLUGINS_DIR.DIRECTORY_SEPARATOR . basename($pluginId)
            . DIRECTORY_SEPARATOR . 'Plugin.php';

        return file_exists($pluginFile);
    }
}
