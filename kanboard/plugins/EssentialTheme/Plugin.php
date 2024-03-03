<?php

namespace Kanboard\Plugin\EssentialTheme;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
        global $themeEssentialConfig;

        if (file_exists('plugins/Essential/')) {
            die('To run EssentialTheme, the original Essential plugin must be uninstalled . Aborting for now.');
        }

        if (file_exists('plugins/EssentialTheme/config.php')) {
            require_once('plugins/EssentialTheme/config.php');
        }

        if (file_exists('plugins/Customizer')) {
            $this->template->setTemplateOverride('header/title', 'EssentialTheme:layout/header/customizerTitle');
            $this->template->setTemplateOverride('layout', 'EssentialTheme:layout');
        } elseif (isset($themeEssentialConfig['logo'])) {
            $this->template->setTemplateOverride('header/title', 'EssentialiTheme:layout/header/title');
            $this->template->setTemplateOverride('layout', 'EssentialTheme:layout');
        } else {
            $this->template->setTemplateOverride('layout', 'EssentialTheme:layout');
        }

        $this->hook->on("template:layout:css", array("template" => "plugins/EssentialTheme/Assets/css/essential.css"));
        $this->hook->on('template:layout:js', array('template' => 'plugins/EssentialTheme/Assets/js/essential.js'));
    }

    public function getPluginName()
    {
        return 'EssentialTheme';
    }

    public function getPluginDescription()
    {
        return t('EssentialTheme returns a new style to your kanboard.');
    }

    public function getPluginAuthor()
    {
        return 'Valentino Pesce, Alfred Bühler';
    }

    public function getPluginVersion()
    {
        return '1.1.4';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.48';
    }

    public function getPluginHomepage()
    {
        return 'https://codeberg.org/abu/EssentialTheme';
    }
}
