<?php
/**
 * Created by yvalentin.
 * https://yohannvalentin.com
 *
 * Date: 12/11/18
 */
?>

<li <?= $this->app->checkMenuSelection('AnalyticsTimesController', 'timeComparisonBySwimlane') ?>>
    <?= $this->modal->replaceLink(
            t('Estimated vs actual time / Swimlanes'),
            'AnalyticsTimesController',
            'timeComparisonBySwimlane',
            array(
                'plugin' => 'TimeMachine',
                'project_id' => $project['id']
            )
        )
    ?>
</li>
<li <?= $this->app->checkMenuSelection('AnalyticsTimesController', 'timeComparisonByCategories') ?>>
    <?= $this->modal->replaceLink(
        t('Estimated vs actual time / Categories'),
        'AnalyticsTimesController',
        'timeComparisonByCategories',
        array(
            'plugin' => 'TimeMachine',
            'project_id' => $project['id']
        )
    )
    ?>
</li>
<!--TODO check if project has automatic action: task.move.column -  \Kanboard\Action\SubtaskTimerMoveTaskColumn -->
<li <?= $this->app->checkMenuSelection('AnalyticsTimesController', 'timeComparisonByDates') ?>>
    <?= $this->modal->replaceLink(
        t('Spent time / Dates'),
        'AnalyticsTimesController',
        'timeComparisonByDates',
        array(
            'plugin' => 'TimeMachine',
            'project_id' => $project['id']
        )
    )
    ?>
</li>