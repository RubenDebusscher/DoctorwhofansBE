<div id='icalconf-calendar'>
<legend><?= t('Calendar Settings') ?></legend>

<?= $this->form->label(t('Project calendar based on'), 'calendar_project_tasks') ?>
<?= $this->form->select('calendar_project_tasks', array(
    'date_started'  => t('Start date'),
    'date_creation' => t('Creation date'),
), $values) ?>

<?= $this->form->label(t('User calendar based on'), 'calendar_user_tasks') ?>
<?= $this->form->select('calendar_user_tasks', array(
    'date_started'  => t('Start date'),
    'date_creation' => t('Creation date'),
), $values) ?>
</div>
