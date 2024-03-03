<?php if (! $is_ajax): ?>
    <div class="page-header">
        <h2><?= t('Spent time / Dates') ?></h2>
    </div>
<?php endif ?>

<div class="panel">
    <?php $spentTime['total'] = 0; $spentTime['open'] = 0; $spentTime['closed'] = 0; ?>
    <?php foreach ($metrics as $taskId => $metric) : ?>
        <?php $spentTime['total'] += $metric['open']['stt_time_spent'] + $metric['closed']['stt_time_spent']?>
        <?php $spentTime['open'] += $metric['open']['stt_time_spent']?>
        <?php $spentTime['closed'] += $metric['closed']['stt_time_spent']?>
    <?php endforeach; ?>
    <?= t('Total spent time / Dates')?> : <?= $from->format($userFormat) ?> -> <?= $to->format($userFormat) ?>
    <ul>
        <li>
            <strong>
                <?= $this->text->e($spentTime['total']) ?>
            </strong>
            <i>(<?=t('Open').' : '.$this->text->e($spentTime['open']) ?>
                - <?= t('Closed').' : '.$spentTime['closed'] ?>)</i>
        </li>
    </ul>
</div>

<form method="post"
      class="form-inline"
      style="text-align: center"
      action="<?= $this->url->href(
          'AnalyticsTimesController',
          'timeComparisonByDates',
          array('plugin' => 'TimeMachine', 'project_id' => $project['id']))
      ?>"
      autocomplete="off">
    <?= $this->form->csrf() ?>
    <?php $values['from'] = $from->getTimestamp() ?>
    <?php $values['to'] = $to->getTimestamp() ?>
    <?= $this->form->date(t('Start date'), 'from', $values) ?>
    <?= $this->form->date(t('End date'), 'to', $values) ?>
    <?= $this->modal->submitButtons(array('submitLabel' => t('Execute'))) ?>
</form>
<?php if (empty($metrics)): ?>
    <p class="alert"><?= t('Not enough data to show the graph.') ?></p>
<?php else: ?>
    <?php if ($paginator->isEmpty()): ?>
        <p class="alert"><?= t('No tasks found.') ?></p>
    <?php elseif (! $paginator->isEmpty()): ?>
        <?= $this->app->component('chart-project-analytics-spent-time-by-dates', array(
            'metrics' => $spentTime,
            'labelSpent' => t('Hours Spent'),
            'labelClosed' => t('Closed'),
            'labelOpen' => t('Open'),
        )) ?>
        <table class="table-fixed table-small table-scrolling margin-top">
            <tr>
                <th class="column-5"><?= $paginator->order(t('Id'), 'tasks.id') ?></th>
                <th class="column-8"><?= $paginator->order(t('Categories'), 'tasks.category_id') ?></th>
                <th class="column-8"><?= $paginator->order(t('Swimlane'), 'tasks.swimlane_id') ?></th>
                <th><?= $paginator->order(t('Title'), 'tasks.title') ?></th>
                <th class="column-5"><?= $paginator->order(t('Status'), 'tasks.is_active') ?></th>
                <th class="column-13"><?= t('Spent time / Dates')?></th>
                <th class="column-9"><?= $paginator->order(t('Hours Spent'), 'tasks.time_spent') ?></th>
            </tr>
            <?php foreach ($paginator->getCollection() as $task): ?>
                <?php if (array_key_exists($task['id'], $metrics)) : ?>
                    <tr>
                        <td class="task-table color-<?= $task['color_id'] ?>">
                            <?= $this->url->link('#'.$this->text->e($task['id']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', t('View this task')) ?>
                        </td>
                        <td class="task-table category-<?= $task['category_id'] ?>">
                            <?= $this->text->e($categories[$task['category_id']]) ?>
                        </td>
                        <td class="task-table swimlane-<?= $task['swimlane_id'] ?>">
                            <?= $this->text->e($swimlanes[$task['swimlane_id']]) ?>
                        </td>
                        <td>
                            <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', t('View this task')) ?>
                        </td>
                        <td>
                            <?php if ($task['is_active'] == \Kanboard\Model\TaskModel::STATUS_OPEN): ?>
                                <?php $isActive = "open" ?>
                                <?= t('Open') ?>
                            <?php else: ?>
                                <?php $isActive = "closed" ?>
                                <?= t('Closed') ?>
                            <?php endif ?>
                        </td>
                        <td>
                            <?= $this->text->e($metrics[$task['id']][$isActive]['stt_time_spent']) ?>
                        </td>
                        <td>
                            <?= $this->text->e($metrics[$task['id']][$isActive]['time_spent']) ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach ?>
        </table>
        <?= $paginator ?>
    <?php endif ?>
<?php endif ?>
