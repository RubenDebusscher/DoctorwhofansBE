<?php if (! $is_ajax): ?>
    <div class="page-header">
        <h2><?= t('Estimated vs actual time / Categories') ?></h2>
    </div>
<?php endif ?>

<div class="panel">
    <?php foreach ($metrics as $categorieName => $metricByCategories) : ?>
        <p><strong><?= $categorieName ?></strong></p>
        <ul>
            <li>
                <?= t('Estimated hours: ') ?>
                <strong>
                    <?= $this->text->e($metricByCategories['open']['time_estimated'] + $metricByCategories['closed']['time_estimated']) ?>
                </strong>
                <i>(<?=t('Open').' : '.$this->text->e($metricByCategories['open']['time_estimated']) ?>
                    - <?= t('Closed').' : '.$metricByCategories['closed']['time_estimated'] ?>)</i>
            </li>
            <li>
                <?= t('Actual hours: ')?>
                <strong>
                    <?= $this->text->e($metricByCategories['open']['time_spent'] + $metricByCategories['closed']['time_spent']) ?>
                </strong>
                <i>(<?=t('Open').' : '.$this->text->e($metricByCategories['open']['time_spent']) ?>
                    - <?= t('Closed').' : '.$metricByCategories['closed']['time_spent'] ?>)</i>
            </li>
        </ul>
    <?php endforeach; ?>
</div>

<?php if (empty($metrics)): ?>
    <p class="alert"><?= t('Not enough data to show the graph.') ?></p>
<?php else: ?>
    <?php if ($paginator->isEmpty()): ?>
        <p class="alert"><?= t('No tasks found.') ?></p>
    <?php elseif (! $paginator->isEmpty()): ?>
        <?= $this->app->component('chart-project-analytics-time-comparison', array(
            'metrics' => $metrics,
            'labelSpent' => t('Hours Spent'),
            'labelEstimated' => t('Hours Estimated'),
            'labelClosed' => t('Closed'),
            'labelOpen' => t('Open'),
        )) ?>

        <table class="table-fixed table-small table-scrolling">
            <tr>
                <th class="column-5"><?= $paginator->order(t('Id'), 'tasks.id') ?></th>
                <th class="column-8"><?= $paginator->order(t('Categories'), 'tasks.category_id') ?></th>
                <th><?= $paginator->order(t('Title'), 'tasks.title') ?></th>
                <th class="column-10"><?= $paginator->order(t('Status'), 'tasks.is_active') ?></th>
                <th class="column-12"><?= $paginator->order(t('Estimated Time'), 'tasks.time_estimated') ?></th>
                <th class="column-12"><?= $paginator->order(t('Actual Time'), 'tasks.time_spent') ?></th>
            </tr>
            <?php foreach ($paginator->getCollection() as $task): ?>
            <tr>
                <td class="task-table color-<?= $task['color_id'] ?>">
                    <?= $this->url->link('#'.$this->text->e($task['id']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', t('View this task')) ?>
                </td>
                <td class="task-table swimlane-<?= $task['category_id'] ?>">
                    <?= $this->text->e($categories[$task['category_id']]) ?>
                </td>
                <td>
                    <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', t('View this task')) ?>
                </td>
                <td>
                    <?php if ($task['is_active'] == \Kanboard\Model\TaskModel::STATUS_OPEN): ?>
                        <?= t('Open') ?>
                    <?php else: ?>
                        <?= t('Closed') ?>
                    <?php endif ?>
                </td>
                <td>
                    <?= $this->text->e($task['time_estimated']) ?>
                </td>
                <td>
                    <?= $this->text->e($task['time_spent']) ?>
                </td>
            </tr>
            <?php endforeach ?>
        </table>

        <?= $paginator ?>
    <?php endif ?>
<?php endif ?>
