<?php
namespace Kanboard\Plugin\TimeMachine;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\TimeMachine\Action\SubtaskTimerMoveTaskColumn;
use Kanboard\Plugin\TimeMachine\Model\SubtaskTimeTrackingModel;

class Plugin extends Base
{
    /**
     *
     */
    public function initialize()
    {
        /***** AnalyticTimes *****/
        $this->hook->on('template:layout:js',
            array(
                'template' => 'plugins/TimeMachine/Assets/js/components/chart-project-time-machine.js'
            )
        );
        $this->template->hook->attach('template:analytic:sidebar', 'TimeMachine:analytic/sidebar');
        $this->helper->register('analyticsTimes', '\Kanboard\Plugin\TimeMachine\Helper\AnalyticsTimes');

        /***** SubTaskTimeTracking *****/
        $this->helper->register('subTaskTimeTracking', '\Kanboard\Plugin\TimeMachine\Helper\SubTaskTimeTracking');
        $this->helper->register('subTaskTimeTrackingValidator', '\Kanboard\Plugin\TimeMachine\Validator\SubTaskTimeTrackingValidator');
        // Sub task time tracking Model extended
        $this->container['subtaskTimeTrackingModel'] = $this->container->factory(function ($c) {
            return new SubtaskTimeTrackingModel($c);
        });

        $this->template->setTemplateOverride('subtask/menu', 'TimeMachine:subtask/menu');
        $this->template->setTemplateOverride('subtask/edit', 'TimeMachine:subtask/edit');
        
        // Override SubTaskTimerMoveTaskColumn to create subTask with user connected (User who move card)
        $this->actionManager->register(new SubtaskTimerMoveTaskColumn($this->container));
    }

    /**
     *
     */
    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    /**
     * @return string
     */
    public function getPluginName()
    {
        return 'TimeMachine';
    }

    /**
     * @return string
     */
    public function getPluginDescription()
    {
        return t('Plugin to add time machine : Back to the Future (more analytics datas, edit form on subtask time tracking)');
    }

    /**
     * @return string
     */
    public function getPluginAuthor()
    {
        return 'yvalentin';
    }

    /**
     * @return string
     */
    public function getPluginVersion()
    {
        return '1.0.1';
    }

    /**
     * @return string
     */
    public function getPluginHomepage()
    {
        return 'https://gitlab.com/yv-kanboard-plugin/time-machine';
    }

    /**
     * @return string
     */
    public function getCompatibleVersion()
    {
        return '>=1.2.6';
    }
}
