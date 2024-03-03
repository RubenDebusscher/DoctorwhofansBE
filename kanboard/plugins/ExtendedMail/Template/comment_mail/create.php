<div class="page-header">
    <h2><?= t('Create and send a comment by email') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('SendController', 'save', array('plugin' => 'ExtendedMail','task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>" autocomplete="off" class="js-mail-form">

    <?php
        $values['emails'] = isset ($values['emails'] ) ? $values['emails']: $this->MailTemplate->to($project,$task);
        $values['subject'] = isset ($values['subject'] ) ? $values['subject'] : $this->MailTemplate->subject($project,$task);
        $values['reply_to'] = isset ($values['reply_to'] ) ? $values['reply_to'] : $this->MailTemplate->reply_to($project,$task);
        $values['comment'] = isset ($values['comment'] ) ? $values['comment'] : $this->MailTemplate->body($project,$task);
    ?>
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('task_id', $values) ?>
    <?= $this->form->hidden('user_id', $values) ?>

    <?= $this->form->label(t('Email'), 'emails') ?>

    <?= $this->form->text('emails', $values, $errors, array('autofocus', 'required', 'tabindex="1"')) ?>

    <?php if (! empty($members)): ?>
        <div class="dropdown">
            <a href="#" class="dropdown-menu dropdown-menu-link-icon"><i class="fa fa-address-card-o"></i><i class="fa fa-caret-down"></i></a>
            <ul>
                <?php foreach ($members as $member): ?>
                    <li data-email="<?= $this->text->e($member['email']) ?>" class="js-autocomplete-email">
                        <?= $this->text->e($this->user->getFullname($member)) ?>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <?= $this->form->label(t('Subject'), 'subject') ?>
    <?= $this->form->text('subject', $values, $errors, array('required', 'tabindex="2"')) ?>
    <?php if (! empty($project['predefined_email_subjects'])): ?>
        <div class="dropdown">
            <a href="#" class="dropdown-menu dropdown-menu-link-icon"><i class="fa fa-archive"></i><i class="fa fa-caret-down"></i></a>
            <ul>
                <?php foreach (explode("\r\n", trim($project['predefined_email_subjects'])) as $subject): ?>
                    <?php $subject = trim($subject); ?>
                    <?php if (! empty($subject)): ?>
                        <li data-subject="<?= $this->text->e($subject) ?>" class="js-autocomplete-subject">
                            <?= $this->text->e($subject) ?>
                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <?= $this->form->label(t('Reply to'), 'Reply to') ?>
    <?= $this->form->text('reply_to', $values, $errors, array('required', 'tabindex="3"')) ?>

    <?= $this->form->textEditor('comment', $values, $errors, array('required' => true, 'tabindex' => 4, 'comment'=>'test')) ?>

    <?= $this->modal->submitButtons(array(
        'submitLabel' => t('Send by email'),
        'tabindex'    => 5,
    )) ?>
</form>
