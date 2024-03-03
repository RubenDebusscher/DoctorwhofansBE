<div id='icalconf-top-right' class='icalconf-custom-rem'>
  <?= $this->form->select('icalconf_remind', array(), array(), array(), array('size="4"') ) ?>
  <?= $this->form->hidden('icalconf_reminders', $values) ?>
  <div>
    <button id="add-reminder" class="btn btn-blue"><?= t('Add') ?></button>
    <button id="rm-reminder" class="btn btn-blue"><?= t('Remove') ?></button>
  </div>
</div>
<div id='icalconf-mid-right' class='icalconf-custom-rem' >
  <?= $this->form->label(t('Reminder details'), 'icalconf_offset') ?>
  <div>
    <?= $this->form->number('icalconf_offset', $values, array(), array('size="3"')) ?>
    <?= $this->form->select('icalconf_triggerunit', array(
      'M' => t('minutes'),
      'H' => t('hours'),
      'D' => t('days'),
      'W' => t('weeks'),
    ), $values) ?>
    <?= $this->form->select('icalconf_relation', array(
      '-S' => t('before the event starts'),
      '+S' => t('after the event starts'),
      '-E' => t('before the event ends'),
      '+E' => t('after the event ends'),
    ), $values) ?>
  </div>
</div>
