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
//dol_include_once('/staff/class/timesheet_log.class.php');
dol_include_once('/staff/class/plannedshift.class.php');
dol_include_once('/staff/lib/staff.lib.php');
include_once DOL_DOCUMENT_ROOT.'/core/lib/date.lib.php';

// Load translation files required by the page
$langs->load("errors");
$langs->load("admin");
$langs->load("staff@staff");

// Get parameters
$id = GETPOST('id', 'int');
$ref = GETPOST('ref', 'alpha');
$type=GETPOST('type','alpha');

// Access control
if (!$user->rights->staff->timesheet->read || ($type == 'planned_shift' && !$user->rights->staff->plannedshift->read)) {
	// External user
	accessforbidden();
}
else if (!$user->employee) {
        // Non staff user
        accessforbidden($langs->trans('AccessDeniedToNonStaffUser'));
}

// Load object if id or ref is provided as parameter
$object = $type == 'planned_shift' ? new PlannedShift($db) : new Timesheet($db);

if ($id > 0 || ! empty($ref)) {
	$result = $object->fetch($id, $ref);
	if ($result < 0) {
		dol_print_error($db);
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

$headjs=empty($conf->use_javascript_ajax) ? "" : "
<script type=\"text/javascript\">
    $(document).ready(function () {
        $(\"img[src$='nophoto.png']\").attr('src', '".DOL_URL_ROOT.$mod_path.'/staff/img/object_'.(empty($type) ? 'timesheet' : 'plannedshift').'-48.png'."');
    });
</script>";

llxHeader($headcss.$moreheadcss.$headjs,$title,'');

if ($object->id > 0 || ! empty($object->ref))
{
        $head = timesheet_card_prepare_head($object, $mod_path, $type);
        dol_fiche_head($head, 'log', $title, 0, empty($type) ? 'timesheet@staff' : 'plannedshift@staff');
    
        $linkback =img_picto($langs->trans("BackToList"),'object_list','class="hideonsmartphone pictoactionview"');
        $linkback.= '<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/list.php">'.$langs->trans("BackToList").'</a>';

        // Link to other timesheet views
        $out='';
        if ($user->admin) {
            $out.=img_picto($langs->trans("StaffViewPerUser"),'object_calendarperuser','class="hideonsmartphone pictoactionview"');
            $out.='<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/peruser.php?action=show_peruser&year='.dol_print_date($object->day,'%Y').'&month='.dol_print_date($object->day,'%m').'&day='.dol_print_date($object->day,'%d').'">'.$langs->trans("StaffViewPerUser").'</a>';
            //$out.='<br>';
        }
        $out.=img_picto($langs->trans("StaffViewDay"),'object_calendarday','class="hideonsmartphone pictoactionview"');
        $out.='<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?action=show_day&year='.dol_print_date($object->day,'%Y').'&month='.dol_print_date($object->day,'%m').'&day='.dol_print_date($object->day,'%d').'">'.$langs->trans("StaffViewDay").'</a>';
        $out.=img_picto($langs->trans("StaffViewWeek"),'object_calendarweek','class="hideonsmartphone pictoactionview"');
        $out.='<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?action=show_week&year='.dol_print_date($object->day,'%Y').'&month='.dol_print_date($object->day,'%m').'&day='.dol_print_date($object->day,'%d').'">'.$langs->trans("StaffViewWeek").'</a>';
        $out.=img_picto($langs->trans("StaffViewCal"),'object_calendar','class="hideonsmartphone pictoactionview"');
        $out.='<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?action=show_month&year='.dol_print_date($object->day,'%Y').'&month='.dol_print_date($object->day,'%m').'&day='.dol_print_date($object->day,'%d').'">'.$langs->trans("StaffViewCal").'</a>';
        $linkback.=$out;

        $object->next_prev_filter = $object->getFilter($type);
        $reftoshow = $type == 'planned_shift' ? preg_replace('/^[a-zA-Z]*/i', $conf->global->PLANNED_SHIFT_REF_PREFIX, $object->ref) : $object->ref;
        if (empty($type) && $object->origin == 'planned_shift') $reftoshow.= '<br><span class="origin">'.$langs->trans('Origin').': </span><span class="labeled light-grey">'.$langs->trans('PlannedShift').'</span>';
        
        $conf->unknown = new stdClass();
        $conf->unknown->dir_output = DOL_DOCUMENT_ROOT.$mod_path.'/staff/img'; // any string will do the trick, this is just to fix card image bug on dolibarr 3.9
        
        dol_banner_tab($object, 'ref', $linkback, ($user->societe_id?0:1), 'ref', 'none', $reftoshow, '&type='.$type);
    
        print '<div class="underbanner clearboth"></div>';

        print '<br>';

        print '<table width="100%"><tr><td>';
        
        $deltadateforserver=getServerTimeZoneInt('now');
        $deltadateforclient=((int) $_SESSION['dol_tz'] + (int) $_SESSION['dol_dst']);
        //$deltadateforcompany=((int) $_SESSION['dol_tz'] + (int) $_SESSION['dol_dst']);
        $deltadateforuser=round($deltadateforclient-$deltadateforserver);
        //print "x".$deltadateforserver." - ".$deltadateforclient." - ".$deltadateforuser;
        
        $userstatic = new User($db);
        $log = new TimesheetLog($db);
        $log->fetch($object->id); // timesheet id
        
        // Print Logs
        foreach ($log->lines as $log)
        {
            // Log action
            print $langs->trans("StaffLogAction").': ';
            print $langs->trans($log->action);
            print '<br>';
            
            // Log date/tms
            $log->datec = $db->jdate($log->datec);
            print $langs->trans("StaffLogDate").': ';
            print dol_print_date($log->datec, 'dayhour');
            if ($deltadateforuser) print ' '.$langs->trans("CurrentHour").' &nbsp; / &nbsp; '.dol_print_date($log->datec+($deltadateforuser*3600),"dayhour").' &nbsp;'.$langs->trans("ClientHour");
            print '<br>';
            
            // Log author
            print $langs->trans("StaffLogUser").': ';
            $userstatic->fetch($log->fk_author);
            print $userstatic->getNomUrl(1, '', 0, 0, 0);
            print '<br>';
            
            print '<hr>';
        }
        
        print '</td></tr></table>';

        dol_fiche_end();
}

// End of page
llxFooter();

$db->close();
