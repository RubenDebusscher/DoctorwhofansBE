<?php

namespace Kanboard\Plugin\ICalConfig;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\ICalConfig\Formatter\ICalFormatter;

class Plugin extends Base
{
    public function initialize()
    {
        $this->template->hook->attach('template:config:application', 'ICalConfig:config/config');
        $this->container['taskICalFormatter'] = $this->container->factory(function ($c) {
            return new ICalFormatter($c);
        });
        $this->helper->register('icalHelper', '\Kanboard\Plugin\ICalConfig\Helper\ICalHelper');
        // Assets
        $this->hook->on('template:layout:js', array('template' => 'plugins/ICalConfig/Assets/js/ICalConfig.js'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/ICalConfig/Assets/css/ICalConfig.css'));
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }

    public function getPluginName()
    {
        return 'ICalConfig';
    }

    public function getPluginAuthor()
    {
        return 'Alfred Bühler';
    }

    public function getPluginVersion()
    {
        return '0.4.0';
    }

    public function getPluginDescription()
    {
        return 'Allow some configuration of the iCal calendar feeds.';
    }

    public function getPluginHomepage()
    {
        return 'https://codeberg.org/abu/ICalConfig';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.20';
    }
}
