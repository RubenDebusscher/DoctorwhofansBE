<div class="page-header">
    <h2><?= t('Edit a sub-task') ?></h2>
</div>

<form method="post" action="<?= $this->url->href('SubtaskController', 'update', array('plugin' => 'TimeMachine', 'task_id' => $task['id'], 'project_id' => $task['project_id'], 'subtask_id' => $subtask['id'])) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>

    <?= $this->subtask->renderTitleField($values, $errors, array('autofocus')) ?>
    <?= $this->subtask->renderAssigneeField($users_list, $values, $errors) ?>
    <?= $this->subtask->renderTimeEstimatedField($values, $errors) ?>
    <?= $this->subtask->renderTimeSpentField($values, $errors) ?>
    <div class="subtask-time-tracking-edit form-inline">
        <h3><strong>Time Tracking details</strong></h3>
        <?php foreach ($sttts as $key => $sttt) :?>
            <?php $errorsSttt = isset($errorsSttts[$key]) ? $errorsSttts[$key]: []; ?>
            <div>
                <?= $sttt['username']?> :
                <?= $this->helper->form->datetime(t('Start Date'), 'start-'.$sttt['id'], $sttt, $errorsSttt) ?>
                <?= $this->helper->form->datetime(t('End Date'), 'end-'.$sttt['id'], $sttt, $errorsSttt) ?>
                / <?=t('Time spent')?> :  <?= $sttt['time_spent']?>
            </div>
        <?php endforeach; ?>
    </div>

    <?= $this->hook->render('template:subtask:form:edit', array('values' => $values, 'errors' => $errors)) ?>

    <?= $this->modal->submitButtons() ?>
</form>
