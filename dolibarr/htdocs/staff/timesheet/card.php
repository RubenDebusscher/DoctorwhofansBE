<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <year>  <name of author>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Load Dolibarr environment
$mod_path = "";
if (false === (@include '../../main.inc.php')) {  // From htdocs directory
	require '../../../main.inc.php'; // From "custom" directory
        $mod_path = "/custom";
}

global $db, $langs, $user, $conf;

if ($user->rights->staff->perms->full) $user->admin = 1;

//dol_include_once('/staff/class/timesheet.class.php');
dol_include_once('/staff/class/plannedshift.class.php');
dol_include_once('/staff/lib/staff.lib.php');
require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/doleditor.class.php';
if (false === (@include_once DOL_DOCUMENT_ROOT.'/compta/salaries/class/paymentsalary.class.php')) {
    require_once DOL_DOCUMENT_ROOT.'/salaries/class/paymentsalary.class.php';
}

// Load translation files required by the page
$langs->load("errors");
$langs->load("staff@staff");

// Get parameters
$id = GETPOST('id', 'int');
$action = GETPOST('action', 'alpha');
$ref = GETPOST('ref', 'alpha');
$confirm = GETPOST('confirm', 'alpha');
$datep=GETPOST("aphour") != -1 && GETPOST("apmin") != -1 ? GETPOST("aphour").':'.GETPOST("apmin") : '';
$datef=GETPOST("efhour") != -1 && GETPOST("efmin") != -1 ? GETPOST("efhour").':'.GETPOST("efmin") : '';
$datepa=GETPOST("apahour") != -1 && GETPOST("apamin") != -1 ? GETPOST("apahour").':'.GETPOST("apamin") : '';
$datefa=GETPOST("efahour") != -1 && GETPOST("efamin") != -1 ? GETPOST("efahour").':'.GETPOST("efamin") : '';
$note=GETPOST('note');
$date=GETPOST('date') ? dol_mktime(0, 0, 0, GETPOST('datemonth'), GETPOST('dateday'), GETPOST('dateyear')) : '';
$userid=GETPOST('userid','int');
$socid = GETPOST('socid', 'int');
$type=GETPOST('type','alpha');
$caller = GETPOST('caller', 'alpha');
$line = GETPOST('line', 'int');
$status = GETPOST('status', 'int');

// Access control
if (!$user->rights->staff->timesheet->read || ($type == 'planned_shift' && !$user->rights->staff->plannedshift->read)) {
	// External user
	accessforbidden();
}
else if (!$user->employee) {
        // Non staff user
        accessforbidden($langs->trans('AccessDeniedToNonStaffUser'));
}

// Default action
if (empty($action) && empty($id) && empty($ref)) {
	$action='create';
}

// Load object if id or ref is provided as parameter
$object = $type == 'planned_shift' ? new PlannedShift($db) : new Timesheet($db);

if (($id > 0 || ! empty($ref)) && $action != 'create') {
	$result = $object->fetch($id, $ref);
	if ($result < 0) {
		dol_print_error($db);
	}
}

$soc = new Societe($db);

if ($socid > 0) {
    $res = $soc->fetch($socid);
}

$now = dol_now();

/*
 * ACTIONS
 *
 * Put here all code to do according to value of "action" parameter
 */

// allow actions
$allow_delete = $type == 'planned_shift' ? $user->admin : $user->rights->staff->timesheet->delete;

// add
if ($action == 'add' && $user->rights->staff->timesheet->submit) {
    // check ref first
    $numref = $object->getNextNumRef($soc);
    $error = 0;
    
    if (empty($numref))
    {
            $error ++;
            setEventMessages($object->error, $object->errors, 'errors');
    }
    else
    {
        if (empty($date)) {
            setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("Date")), 'errors');
            $error++;
        }
        else if (! $user->admin && ! is_date_in_this_week($date)) {
            setEventMessage($langs->transnoentities("DateMustBeInTheCurrentWeek"), 'warnings');
            $error++;
        }
        if ($user->admin && (empty($userid) || $userid <= 0)) {
            setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("Staff")), 'errors');
            $error++;
        }
        if (empty($conf->global->TIMESHEET_ADD_AFTERNOON_TIME_ON_CREATION)) {
            if (empty($datep)) {
                setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("StartTime")), 'errors');
                $error++;
            }
            if (empty($datef)) {
                setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("EndTime")), 'errors');
                $error++;
            }
        }
        else {
            if (empty($datep)) {
                setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("StartTimeMorning")), 'errors');
                $error++;
            }
            if (empty($datef)) {
                setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("EndTimeMorning")), 'errors');
                $error++;
            }
            if (empty($datepa)) {
                setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("StartTimeAfternoon")), 'errors');
                $error++;
            }
            if (empty($datefa)) {
                setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("EndTimeAfternoon")), 'errors');
                $error++;
            }
        }
        if (! empty($datep) && $datep == $datef) {
            setEventMessage($langs->transnoentities("ErrorStartTimeIsTheSameAsEndTime"), 'errors');
            $error++;
        }
    }
    
    if (! $error)
    {
        $myobject = new Timesheet($db);
        $myobject->ref = $numref;
        $myobject->day = $date;
        $myobject->start_time = $datep;
        $myobject->end_time = $datef;
        $myobject->time_diff = $myobject->calcTimeDiff();
        $myobject->note = GETPOST('note');
        $myobject->fk_user = $user->admin && $userid > 0 ? $userid : $user->id;
        $myobject->created_by = $user->id;
        $myobject->status = isset($_POST['validate_timesheet']) ? Timesheet::STATUS_VALIDATED : Timesheet::STATUS_PENDING;

        $id = $myobject->submit();
        if (! empty($conf->global->TIMESHEET_ADD_AFTERNOON_TIME_ON_CREATION) && $id > 0) {
            $numref = $object->getNextNumRef($soc);
            $myobject->ref = $numref;
            $myobject->start_time = $datepa;
            $myobject->end_time = $datefa;
            $id = $myobject->submit();
        }

        if ($id > 0) {
                // Creation OK
                header('Location: ' . $_SERVER["PHP_SELF"] . '?id=' . $id);
                exit();
        }
        else {
                // Creation KO
                setEventMessage($myobject->error, 'errors');
        }
    }
    
    $action = 'create';
}

// Validate
else if ($action == 'confirm_validate' && $confirm == 'yes' && $user->rights->staff->timesheet->validate)
{
    if ($caller == 'list') {
        $object->id = $id;
    }
    
    $result = $object->set_status($object->id, Timesheet::STATUS_VALIDATED, 'LogValidateAction');
    if ($result > 0) {
            if ($caller == 'list')
            {
                header('Location: '.DOL_URL_ROOT.$mod_path.'/staff/timesheet/list.php?type='.$type.'&status='.$status.'#line'.$line);
                exit();
            }
            else
            {
                $object->status = Timesheet::STATUS_VALIDATED;
            }
    }
    else {
            //dol_print_error($db, $object->error);
            setEventMessages($object->error, $object->errors, 'errors');
    }
}

// Reopen (admin only)
else if ($action == 'confirm_reopen' && $confirm == 'yes' && $user->admin)
{
    $result = $object->set_status($object->id, Timesheet::STATUS_PENDING, 'LogReopenAction');
    if ($result > 0) {
            $object->status = Timesheet::STATUS_PENDING;
    }
    else {
            //dol_print_error($db, $object->error);
            setEventMessages($object->error, $object->errors, 'errors');
    }
}

// Refuse (admin only)
else if ($action == 'confirm_refuse' && $confirm == 'yes' && $user->admin)
{
    $result = $object->set_status($object->id, Timesheet::STATUS_REFUSED, 'LogRefuseAction');
    if ($result > 0) {
            $object->status = Timesheet::STATUS_REFUSED;
    }
    else {
            //dol_print_error($db, $object->error);
            setEventMessages($object->error, $object->errors, 'errors');
    }
}

// Delete
else if ($action == 'confirm_delete' && $confirm == 'yes' && $allow_delete)
{
        // Delete logs first
        $log = new TimesheetLog($db);
        $log->fk_timesheet = $object->id;
        $result = $log->delete();
        if ($result > 0) {
            // Next, delete the timesheet or planned shift
            $result = $object->delete();
            if ($result > 0) {
                    header('Location: ' . DOL_URL_ROOT . $mod_path . '/staff/timesheet/list.php?type='.$type);
                    exit();
            } else {
                    setEventMessages($object->error, $object->errors, 'errors');
            }
        } else {
            setEventMessages($log->error, $log->errors, 'errors');
        }
}

// Delete payment (admin only)
else if ($action == 'confirm_delete_payment' && $confirm == 'yes' && $user->admin)
{
    $result = $object->delete_payment();
    if ($result > 0) {
            $object->status = Timesheet::STATUS_VALIDATED;
            $object->payment_id = null;
    }
    else {
            //dol_print_error($db, $object->error);
            setEventMessages($object->error, $object->errors, 'errors');
    }
}

// Update start time
else if ($action == 'setstarttime' && $user->rights->staff->timesheet->modify)
{
        if (! empty($datep)) {
            if ($caller == 'list') {
                $object->id = $id;
            }
            
            $object->start_time = $datep;
            $object->time_diff = $object->calcTimeDiff();
            $result = $object->update('LogChangeStartTimeAction', 1);
            
            if ($result > 0) {
                if ($caller == 'list')
                {
                    header('Location: '.DOL_URL_ROOT.$mod_path.'/staff/timesheet/list.php?type='.$type.'&status='.$status.'#line'.$line);
                    exit();
                }
            }
            else {
                    //dol_print_error($db, $object->error);
                    setEventMessages($object->error, $object->errors, 'errors');
            }
        }
}

// Update end time
else if ($action == 'setendtime' && $user->rights->staff->timesheet->modify)
{
        if (! empty($datef)) {
            if ($caller == 'list') {
                $object->id = $id;
            }
            
            $object->end_time = $datef;
            $object->time_diff = $object->calcTimeDiff();
            $result = $object->update('LogChangeEndTimeAction', 1);
            
            if ($result > 0) {
                if ($caller == 'list')
                {
                    header('Location: '.DOL_URL_ROOT.$mod_path.'/staff/timesheet/list.php?type='.$type.'&status='.$status.'#line'.$line);
                    exit();
                }
            }
            else {
                    //dol_print_error($db, $object->error);
                    setEventMessages($object->error, $object->errors, 'errors');
            }
        }
}

// Update note
else if ($action == 'setnote' && $user->rights->staff->timesheet->modify)
{
        $object->note = GETPOST('note');
        $result = $object->update('LogChangeNoteAction');
        if ($result < 0) {
                //dol_print_error($db, $object->error);
                setEventMessages($object->error, $object->errors, 'errors');
        }
}

// Recalculate total hours
else if ($action == 'recalctotalhours' && $user->admin)//&& $user->rights->staff->timesheet->modify)
{
    $object->time_diff = $object->calcTimeDiff();
    $result = $object->update('');
    if ($result > 0) {
            setEventMessage($langs->trans('RecalculateTotalHoursSuccess'));
    }
    else {
            //dol_print_error($db, $object->error);
            setEventMessages($object->error, $object->errors, 'errors');
    }
}

// Confirm planned shift
else if ($type == 'planned_shift' && $action == 'confirm_plannedshift' && $confirm == 'yes' && $user->rights->staff->timesheet->read)
{
    if ($caller == 'list') {
        $object->id = $id;
    }
    
    $result = $object->set_status($object->id, PlannedShift::STATUS_WAITING_TO_SUBMIT, 'LogConfirmPlannedShiftAction');
    if ($result > 0) {
            if ($caller == 'list')
            {
                header('Location: '.DOL_URL_ROOT.$mod_path.'/staff/timesheet/list.php?type='.$type.'&status='.$status.'#line'.$line);
                exit();
            }
            else
            {
                $object->status = PlannedShift::STATUS_WAITING_TO_SUBMIT;
            }
    }
    else {
            //dol_print_error($db, $object->error);
            setEventMessages($object->error, $object->errors, 'errors');
    }
}

// Submit a 'waiting to submit' plannedshift
else if ($type == 'planned_shift' && $action == 'confirm_submit' && $confirm == 'yes' && $user->rights->staff->timesheet->submit)
{
    if ($caller == 'list') {
        $object->id = $id;
    }
    
    $result = $object->set_status($object->id, Timesheet::STATUS_PENDING, 'LogSubmitPlannedShiftAction');
    if ($result > 0) {
            if ($caller == 'list')
            {
                header('Location: '.DOL_URL_ROOT.$mod_path.'/staff/timesheet/list.php?type='.$type.'&status='.$status.'#line'.$line);
                exit();
            }
            else
            {
                $object->status = Timesheet::STATUS_PENDING;
                $type = ''; // set to timesheet
            }
    }
    else {
            //dol_print_error($db, $object->error);
            setEventMessages($object->error, $object->errors, 'errors');
    }
}

// Clone timesheet/plannedshift
else if ($action == 'confirm_clone' && $confirm == 'yes' && $user->rights->staff->timesheet->clone)
{
    $cloneuserid = GETPOST('cloneuserid', 'int');
    $clonedate = GETPOST('clonedate') ? dol_mktime(0, 0, 0, GETPOST('clonedatemonth'), GETPOST('clonedateday'), GETPOST('clonedateyear')) : '';
    $numref = $object->getNextNumRef($soc);
    $error = 0;
    
    if (empty($numref))
    {
            $error ++;
            setEventMessages($object->error, $object->errors, 'errors');
    }
    else
    {
        if ($cloneuserid <= 0) {
            setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("Staff")), 'errors');
            $error++;
        }

        if (empty($clonedate)) {
            setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("CloneDate")), 'errors');
            $error++;
        }
    }
    
    if (! $error)
    {
        // Load source object
        $objFrom = clone $object;
        
        $objFrom->ref = $numref;
        $objFrom->day = $clonedate;
        $objFrom->fk_user = $cloneuserid;
        $objFrom->created_by = $user->id;
        $objFrom->status = $type == 'planned_shift' ? PlannedShift::STATUS_WAITING_TO_CONFIRM : Timesheet::STATUS_PENDING;
        
        $id = $objFrom->createFromClone();
        if ($id > 0) {
                // Clone OK
                header('Location: ' . $_SERVER["PHP_SELF"] . '?id=' . $id . '&type=' . $type);
                exit();
        }
        else {
                //dol_print_error($db, $object->error);
                setEventMessages($objFrom->error, $objFrom->errors, 'errors');
        }
    }
}

/*
 * VIEW
 *
 * Put here all code to build page
 */

$title = $type == 'planned_shift' ? $langs->trans('PlannedShift') : $langs->trans('Timesheet');

$headcss = '<link rel="stylesheet" type="text/css" href="'.DOL_URL_ROOT.$mod_path.'/staff/css/status.css.php">'."\n";

$moreheadcss = '<link rel="stylesheet" type="text/css" href="'.DOL_URL_ROOT.$mod_path.'/staff/css/timesheet.css.php">'."\n";

$headjs=empty($conf->use_javascript_ajax) || $action == "create" ? "" : "
<script type=\"text/javascript\">
    $(document).ready(function () {
        $(\"img[src$='nophoto.png']\").attr('src', '".DOL_URL_ROOT.$mod_path.'/staff/img/object_'.(empty($type) ? 'timesheet' : 'plannedshift').'-48.png'."');
    });
</script>";

llxHeader($headcss.$moreheadcss.$headjs,$title,'');

$form = new Form($db);

/**
 * *******************************************************************
 *
 * Creation mode
 *
 * *******************************************************************
 */
if ($action == 'create' && $user->rights->staff->timesheet->submit)
{
    print load_fiche_titre($langs->trans('SubmitTimesheet'), '', 'object_timesheet-48@staff');
    
    print '<form name="addtimesheet" action="' . $_SERVER["PHP_SELF"] . '" method="POST">';
    print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
    print '<input type="hidden" name="action" value="add">';

    dol_fiche_head();
    
    // Timesheet create summary
    print $langs->trans('TimesheetCreateSummary');
    
    print '<table class="border" width="100%">';
    
    // Date
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('Date') . '</td><td colspan="2">';
    print $form->select_date($date, 'date', 0, 0, 1, '', 1, 1, 1);
    print '</td></tr>';
    
    if ($user->admin) {
        // Staff
        print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('Staff') . '</td><td colspan="2">';
        print $form->select_dolusers($userid, 'userid', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1');
        print '</td></tr>';
    }

    if (! empty($conf->global->TIMESHEET_ADD_AFTERNOON_TIME_ON_CREATION))
    {
        // Start time (Morning)
        print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('StartTimeMorning') . '</td><td colspan="2">';
        print $form->select_date(strtotime($datep),'ap',1,1,1,'',0,1);
        print '</td></tr>';
        
        // End time (Morning)
        print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('EndTimeMorning') . '</td><td colspan="2">';
        print $form->select_date(strtotime($datef),'ef',1,1,1,'',0,1);
        print '</td></tr>';

        // Start time (Afternoon)
        print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('StartTimeAfternoon') . '</td><td colspan="2">';
        print $form->select_date(strtotime($datepa),'apa',1,1,1,'',0,1);
        print '</td></tr>';
        
        // End time (Afternoon)
        print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('EndTimeAfternoon') . '</td><td colspan="2">';
        print $form->select_date(strtotime($datefa),'efa',1,1,1,'',0,1);
        print '</td></tr>';
    }
    else
    {
        // Start time
        print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('StartTime') . '</td><td colspan="2">';
        print $form->select_date(strtotime($datep),'ap',1,1,1,'',0,1);
        print '</td></tr>';
        
        // End time
        print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('EndTime') . '</td><td colspan="2">';
        print $form->select_date(strtotime($datef),'ef',1,1,1,'',0,1);
        print '</td></tr>';
    }

    // Valdiate timesheet
    if ($user->rights->staff->timesheet->validate)
    {
        print '<tr><td width="25%">' . $langs->trans('ValidateTimesheet') . '</td><td colspan="2">';
        print '<input type="checkbox" name="validate_timesheet"'.(isset($_POST['validate_timesheet']) ? ' checked' : '').'/>';
        print '</td></tr>';
    }

    // Note
    print '<tr><td width="25%">' . $langs->trans('Note') . '</td><td colspan="2">';
    $doleditor=new DolEditor('note',$note,'',180,'dolibarr_notes','In',true,true,$conf->fckeditor->enabled,ROWS_3,'90%');
    $doleditor->Create();
    print '</td></tr>';
    
    print '</table>';
    
    dol_fiche_end();
    
    print '<div class="center">';
    print '<input type="submit" class="button" value="' . $langs->trans("Submit") . '">';
    print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    print '<input type="button" class="button" value="' . $langs->trans("Cancel") . '" onClick="javascript:history.go(-1)">';
    print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    print '<input type="reset" class="button" value="' . $langs->trans("Reset") . '">';
    print '</div>';

    print "</form>";
}

/**
 * *******************************************************************
 *
 * View/Edition mode
 *
 * *******************************************************************
 */
else if ($object->id > 0 || ! empty($object->ref))
{
    $head = timesheet_card_prepare_head($object, $mod_path, $type);
    dol_fiche_head($head, 'card', $title, 0, empty($type) ? 'timesheet@staff' : 'plannedshift@staff');
    
    $formconfirm = '';
    
    /*
     * View actions
     */
    
    // Confirm clone
    if ($action == 'clone') {
        $formquestion = array(
                            array('label' => $langs->trans('CloneDate'), 'type' => 'date', 'name' => 'clonedate', 'value' => $object->day),
                            array('label' => $langs->trans('Staff'), 'type' => 'other', 'name' => 'cloneuserid', 'value' => $form->select_dolusers('', 'cloneuserid', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1'))
                        );
        $question = $type == 'planned_shift' ? $langs->trans('ConfirmClonePlannedShift') : $langs->trans('ConfirmCloneTimesheet');
        $formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $object->id . '&type=' . $type, $langs->trans('Clone'), $question, 'confirm_clone', $formquestion, 0, 1);
    }
    else if ($type == 'planned_shift')
    {
        $reftoshow = $type == 'planned_shift' ? preg_replace('/^[a-zA-Z]*/i', $conf->global->PLANNED_SHIFT_REF_PREFIX, $object->ref) : $object->ref;
        
        // Confirm Planned Shift
        if ($action == 'confirm') {
            $formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $object->id . '&type=' . $type, $langs->trans('Confirm'), $langs->trans('ConfirmPlannedShift', $reftoshow), 'confirm_plannedshift', '', 0, 1);
        }
        // Confirm submit
        else if ($action == 'submit') {
            $formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $object->id . '&type=' . $type, $langs->trans('Submit'), $langs->trans('ConfirmSubmitPlannedShift', $reftoshow), 'confirm_submit', '', 0, 1);
        }
        // Confirm delete
        else if ($action == 'delete') {
            $formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $object->id . '&type=' . $type, $langs->trans('Delete'), $langs->trans('ConfirmDeletePlannedShift', $reftoshow), 'confirm_delete', '', 0, 1);
        }
    }
    else
    {
        // Confirm validate
        if ($action == 'validate') {
            $formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $object->id, $langs->trans('Validate'), $langs->trans('ConfirmValidateTimesheet', $object->ref), 'confirm_validate', '', 0, 1);
        }
        // Confirm reopen
        else if ($action == 'reopen') {
            $formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $object->id, $langs->trans('Reopen'), $langs->trans('ConfirmReopenTimesheet', $object->ref), 'confirm_reopen', '', 0, 1);
        }
        // Confirm refuse
        else if ($action == 'refuse') {
            $formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $object->id, $langs->trans('Refuse'), $langs->trans('ConfirmRefuseTimesheet', $object->ref), 'confirm_refuse', '', 0, 1);
        }
        // Confirm delete payment
        else if ($action == 'delete_payment') {
            $formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $object->id, $langs->trans('DeletePayment'), $langs->trans('ConfirmDeletePayment', $object->ref), 'confirm_delete_payment', '', 0, 1);
        }
        // Confirm delete
        else if ($action == 'delete') {
            $formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $object->id, $langs->trans('Delete'), $langs->trans('ConfirmDeleteTimesheet', $object->ref), 'confirm_delete', '', 0, 1);
        }
    }
    
    // Print form confirm
    print $formconfirm;
    
    $linkback =img_picto($langs->trans("BackToList"),'object_list','class="hideonsmartphone pictoactionview"');
    $linkback.= '<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/list.php?type='.$type.'">'.$langs->trans("BackToList").'</a>';

    // Link to other timesheet views
    $out='';
    if ($user->admin) {
        $out.=img_picto($langs->trans("StaffViewPerUser"),'object_calendarperuser','class="hideonsmartphone pictoactionview"');
        $out.='<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/peruser.php?action=show_peruser&type='.$type.'&year='.dol_print_date($object->day,'%Y').'&month='.dol_print_date($object->day,'%m').'&day='.dol_print_date($object->day,'%d').'">'.$langs->trans("StaffViewPerUser").'</a>';
        //$out.='<br>';
    }
    $out.=img_picto($langs->trans("StaffViewDay"),'object_calendarday','class="hideonsmartphone pictoactionview"');
    $out.='<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?action=show_day&type='.$type.'&year='.dol_print_date($object->day,'%Y').'&month='.dol_print_date($object->day,'%m').'&day='.dol_print_date($object->day,'%d').'">'.$langs->trans("StaffViewDay").'</a>';
    $out.=img_picto($langs->trans("StaffViewWeek"),'object_calendarweek','class="hideonsmartphone pictoactionview"');
    $out.='<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?action=show_week&type='.$type.'&year='.dol_print_date($object->day,'%Y').'&month='.dol_print_date($object->day,'%m').'&day='.dol_print_date($object->day,'%d').'">'.$langs->trans("StaffViewWeek").'</a>';
    $out.=img_picto($langs->trans("StaffViewCal"),'object_calendar','class="hideonsmartphone pictoactionview"');
    $out.='<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?action=show_month&type='.$type.'&year='.dol_print_date($object->day,'%Y').'&month='.dol_print_date($object->day,'%m').'&day='.dol_print_date($object->day,'%d').'">'.$langs->trans("StaffViewCal").'</a>';
    $linkback.=$out;
    
    $object->next_prev_filter = $object->getFilter($type);
    $reftoshow = $type == 'planned_shift' ? preg_replace('/^[a-zA-Z]*/i', $conf->global->PLANNED_SHIFT_REF_PREFIX, $object->ref) : $object->ref;
    if (empty($type) && $object->origin == 'planned_shift') $reftoshow.= '<br><span class="origin">'.$langs->trans('Origin').': </span><span class="labeled light-grey">'.$langs->trans('PlannedShift').'</span>';
    
    $conf->unknown = new stdClass();
    $conf->unknown->dir_output = DOL_DOCUMENT_ROOT.$mod_path.'/staff/img'; // any string will do the trick, this is just to fix card image bug on dolibarr 3.9
    
    dol_banner_tab($object, 'ref', $linkback, ($user->societe_id?0:1), 'ref', 'none', $reftoshow, '&type='.$type);
    
    if (empty($type))
    {
        // Modify warning
        if ($object->status == Timesheet::STATUS_PENDING && ! $user->rights->staff->timesheet->validate) {
            print_warning($langs->trans('YouCannotModifyUntilGetValidated'));
        }
    }
    
    print '<div class="underbanner clearboth"></div>';
    
    print '<table class="border" width="100%">';
    
    // Day
    print '<tr><td>'.$langs->trans("Day").'</td><td colspan="3">';
    $day = date('w', $db->jdate($object->day)); // 0 (pour dimanche) à 6 (pour samedi) / (0 for Sunday, 6 for Saturday)
    print $langs->trans("Day".$day).' ';
    //print date('l', $db->jdate($object->day)).' ';
    print dol_print_date($object->day,'daytext');
    print '</td>';
    print '</tr>';
    
    if ($type == 'planned_shift')
    {
        $allow_modify = $user->admin || $object->status != PlannedShift::STATUS_WAITING_TO_CONFIRM;
    }
    else
    {
        $allow_modify = $user->admin || $object->status == Timesheet::STATUS_VALIDATED;
    }
    
    // Start time
    print '<tr><td><table class="nobordernopadding" width="100%"><tr>';
    print '<td>' . $langs->trans('StartTime') . '</td>';
    if ($action != 'editstarttime' && $allow_modify && $user->rights->staff->timesheet->modify) {
            print '<td align="right"><a href="' . $_SERVER["PHP_SELF"] . '?action=editstarttime&amp;id=' . $object->id . '&type=' . $type . '">' . img_edit($langs->trans('Modify'), 1) . '</a></td>';
    }
    print '</tr></table></td>';
    print '<td colspan="3">';
    if ($action == 'editstarttime' && $allow_modify && $user->rights->staff->timesheet->modify) {
        print '<form name="editstarttime" action="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '" method="post">';
        print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
        print '<input type="hidden" name="action" value="setstarttime">';
        print '<input type="hidden" name="type" value="'.$type.'">';
        print $form->select_date(strtotime($object->start_time),'ap',1,1,0,'',0,1);
        print ' <input type="submit" class="button" value="' . $langs->trans('Modify') . '">';
        print '</form>';
    }
    else {
        print date('H:i', strtotime($object->start_time));
    }
    print '</td></tr>';
    
    // End time
    print '<tr><td><table class="nobordernopadding" width="100%"><tr>';
    print '<td>' . $langs->trans('EndTime') . '</td>';
    if ($action != 'editendtime' && $allow_modify && $user->rights->staff->timesheet->modify) {
            print '<td align="right"><a href="' . $_SERVER["PHP_SELF"] . '?action=editendtime&amp;id=' . $object->id . '&type=' . $type . '">' . img_edit($langs->trans('Modify'), 1) . '</a></td>';
    }
    print '</tr></table></td>';
    print '<td colspan="3">';
    if ($action == 'editendtime' && $allow_modify && $user->rights->staff->timesheet->modify) {
        print '<form name="editendtime" action="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '" method="post">';
        print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
        print '<input type="hidden" name="action" value="setendtime">';
        print '<input type="hidden" name="type" value="'.$type.'">';
        print $form->select_date(strtotime($object->end_time),'ef',1,1,($object->end_time?0:1),'',0,1);
        print ' <input type="submit" class="button" value="' . $langs->trans('Modify') . '">';
        print '</form>';
    }
    else {
        if ($object->end_time) {
            print date('H:i', strtotime($object->end_time));
        }
        else {
            print '&nbsp;';
        }
    }
    print '</td></tr>';
    
    // Total hours
    print '<tr><td><table class="nobordernopadding" width="100%"><tr>';
    print '<td>' . $langs->trans('TotalHours') . '</td>';
    if ($object->end_time && $allow_modify && $user->admin) {//&& $user->rights->staff->timesheet->modify) {
            print '<td align="right"><a href="' . $_SERVER["PHP_SELF"] . '?action=recalctotalhours&amp;id=' . $object->id . '&type=' . $type . '">' . img_picto($langs->trans('Recalculate'), 'refresh') . '</a></td>';
    }
    print '</tr></table></td>';
    print '<td colspan="3">';
    if ($object->end_time) {
        print $object->getTotalHours();
    }
    else {
        print '&nbsp;';
    }
    print '</td></tr>';
    
    $userstatic = new User($db);
    
    // Staff
    print '<tr><td class="nowrap">'.$langs->trans("Staff").'</td><td colspan="3">';
    if ($object->fk_user > 0)
    {
        $userstatic->fetch($object->fk_user);
        print $userstatic->getNomUrl(1);
    }
    print '</td>';
    print '</tr>';
    
    if (empty($type))
    {
        // Submited By
        print '<tr><td class="nowrap">'.$langs->trans("SubmitedBy").'</td><td colspan="3">';
        if ($object->created_by > 0)
        {
            $userstatic->fetch($object->created_by);
            print $userstatic->getNomUrl(1);
        }
        print '</td>';
        print '</tr>';
    }
    
    if (empty($type))
    {
        // Note
        print '<tr><td><table class="nobordernopadding" width="100%"><tr>';
        print '<td>' . $langs->trans('Note') . '</td>';
        if ($action != 'editnote' && $allow_modify && $user->rights->staff->timesheet->modify) {
                print '<td align="right"><a href="' . $_SERVER["PHP_SELF"] . '?action=editnote&amp;id=' . $object->id . '&type=' . $type . '">' . img_edit($langs->trans('Modify'), 1) . '</a></td>';
        }
        print '</tr></table></td>';
        print '<td colspan="3">';
        if ($action == 'editnote' && $allow_modify && $user->rights->staff->timesheet->modify) {
            print '<form name="editnote" action="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '" method="post">';
            print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
            print '<input type="hidden" name="action" value="setnote">';
            print '<input type="hidden" name="type" value="'.$type.'">';
            $doleditor=new DolEditor('note',$object->note,'',180,'dolibarr_notes','In',true,true,$conf->fckeditor->enabled,ROWS_3,'90%');
            $doleditor->Create();
            print ' <input type="submit" class="button" value="' . $langs->trans('Modify') . '">';
            print '</form>';
        }
        else {
            if ($object->note) {
                print $object->note;
            }
            else {
                print '&nbsp;';
            }
        }
        print '</td></tr>';
        
        // Payment
        if ($user->rights->salaries->read && $object->payment_id > 0 && $object->status == Timesheet::STATUS_PAID)
        {
            print '<tr><td>'.$langs->trans("Payment").'</td><td colspan="3">';
            $payment = new PaymentSalary($db);
            $result = $payment->fetch($object->payment_id);
            if ($result && $payment->id > 0)
            {
                print $payment->getNomUrl(1);
            }
            else
            {
                print $langs->trans('PaymentNotExists');
            }
            print '</td>';
            print '</tr>';
        }
    }
    
    print '</table>';
    
    dol_fiche_end();
    
    /*
     * Actions Buttons
     */
    print '<div class="tabsAction">';
    
    // Send by email (admin only)
    if ($user->admin) {
            print '<div class="inline-block divButAction"><a class="butAction" href="' . DOL_URL_ROOT . $mod_path . '/staff/sendmail.php?id=' . $object->id . '&ref=' . $object->ref . '&type=' . $type . '&usertoid=' . $object->fk_user . '&mode=init&test=-1">' . $langs->trans('SendByEmail') . '</a></div>';
    }
    
    // Clone
    if ($user->rights->staff->timesheet->clone) {
            print '<div class="inline-block divButAction"><a class="butAction" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&type=' . $type . '&amp;action=clone">' . $langs->trans('Clone') . '</a></div>';
    }
    
    if ($type == 'planned_shift')
    {
        // Confirm
        if ($user->rights->staff->timesheet->read && $object->status == PlannedShift::STATUS_WAITING_TO_CONFIRM) {
                print '<div class="inline-block divButAction"><a class="butAction" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&type=' . $type . '&amp;action=confirm">' . $langs->trans('Confirm') . '</a></div>';
        }
        
        // Submit
        if ($object->status == PlannedShift::STATUS_WAITING_TO_SUBMIT && $user->rights->staff->timesheet->submit) {
                print '<div class="inline-block divButAction"><a class="butAction" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&type=' . $type . '&amp;action=submit">' . $langs->trans('Submit') . '</a></div>';
        }

        // Delete (only admin can delete a planned shift)
        if ($user->admin) {
                print '<div class="inline-block divButAction"><a class="butActionDelete" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&type=' . $type . '&amp;action=delete">' . $langs->trans('Delete') . '</a></div>';
        }
    }
    else
    {
        // Re-open
        if ($user->admin && $object->status > Timesheet::STATUS_PENDING && $object->status < Timesheet::STATUS_PAID) {
                print '<div class="inline-block divButAction"><a class="butAction" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&amp;action=reopen">' . $langs->trans('Reopen') . '</a></div>';
        }

        // Validate
        if ($user->rights->staff->timesheet->validate && $object->status == Timesheet::STATUS_PENDING) {
                print '<div class="inline-block divButAction"><a class="butAction" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&amp;action=validate">' . $langs->trans('Validate') . '</a></div>';
        }

        // Refuse
        if ($user->admin && $object->status != Timesheet::STATUS_REFUSED && $object->status < Timesheet::STATUS_PAID) {
                print '<div class="inline-block divButAction"><a class="butAction" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&amp;action=refuse">' . $langs->trans('Refuse') . '</a></div>';
        }
        
        // Delete payment
        if ($user->admin && $object->status == Timesheet::STATUS_PAID && $object->payment_id > 0) {
                print '<div class="inline-block divButAction"><a class="butAction" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&amp;action=delete_payment">' . $langs->trans('DeletePayment') . '</a></div>';
        }

        // Delete
        if ($user->rights->staff->timesheet->delete) {
                print '<div class="inline-block divButAction"><a class="butActionDelete" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&amp;action=delete">' . $langs->trans('Delete') . '</a></div>';
        }
    }
    
    print '</div>';
}

// End of page
llxFooter();

$db->close();
