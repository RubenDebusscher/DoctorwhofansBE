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

global $db, $langs, $user;

if ($user->rights->staff->perms->full) $user->admin = 1;

require_once DOL_DOCUMENT_ROOT.'/core/lib/date.lib.php';
//dol_include_once('/staff/class/timesheet.class.php');
dol_include_once('/staff/class/plannedshift.class.php');
dol_include_once('/staff/lib/staff.lib.php');

// Load translation files required by the page
$langs->load("errors");
$langs->load("staff@staff");

// Get parameters
$action=GETPOST('action','alpha');
$year=GETPOST("year","int")?GETPOST("year","int"):date("Y");
$month=GETPOST("month","int")?GETPOST("month","int"):date("m");
$week=GETPOST("week","int")?GETPOST("week","int"):date("W");
$day=GETPOST("day","int")?GETPOST("day","int"):date("d");
$status=GETPOST("status");
$userid=GETPOST("userid","int");
$socid = GETPOST('socid', 'int');
$optioncss = GETPOST('optioncss','alpha');

$start_period=GETPOST('sp') ? dol_mktime(0, 0, 0, GETPOST('spmonth'), GETPOST('spday'), GETPOST('spyear')) : '';
$end_period=GETPOST('ep') ? dol_mktime(0, 0, 0, GETPOST('epmonth'), GETPOST('epday'), GETPOST('epyear')) : '';
$useridfrom=GETPOST('useridfrom','int');
$useridto=GETPOST('useridto','int');
$cloneoption=GETPOST('cloneoption','int');
$includeoriginshifts=GETPOST('include_origin_shifts','int');
$ignorepaidshifts=GETPOST('ignore_paid_shifts','int');

$dateselect=dol_mktime(0, 0, 0, GETPOST('dateselectmonth'), GETPOST('dateselectday'), GETPOST('dateselectyear'));
if ($dateselect > 0)
{
	$day=GETPOST('dateselectday');
	$month=GETPOST('dateselectmonth');
	$year=GETPOST('dateselectyear');
}

//$tmp=empty($conf->global->MAIN_DEFAULT_WORKING_DAYS)?'1-5':$conf->global->MAIN_DEFAULT_WORKING_DAYS;
$tmp='1-7';
$tmparray=explode('-',$tmp);
$begin_d = GETPOST('begin_d')?GETPOST('begin_d','int'):($tmparray[0] != '' ? $tmparray[0] : 1);
$end_d   = GETPOST('end_d')?GETPOST('end_d'):($tmparray[1] != '' ? $tmparray[1] : 5);
if ($begin_d < 1 || $begin_d > 7) $begin_d = 1;
if ($end_d < 1 || $end_d > 7) $end_d = 7;
if ($end_d < $begin_d) $end_d = $begin_d + 1;

// Access control
if (!$user->admin) {//!$user->rights->staff->timesheet->submit) {
	// External user
	accessforbidden();
}

// Default action
if (empty($action)) {
	$action='create';
}

// Load soc object if id is provided as parameter
$soc = new Societe($db);

if ($socid > 0) {
    $res = $soc->fetch($socid);
}

// Calculated values
$now=dol_now();

$nowarray=dol_getdate($now);
$nowyear=$nowarray['year'];
$nowmonth=$nowarray['mon'];
$nowday=$nowarray['mday'];

$param='';
if ($status || isset($_GET['status']) || isset($_POST['status'])) $param.="&status=".$status;
//if ($action) $param.='&action='.$action;
if ($userid) $param.="&userid=".$userid;
if ($begin_d) $param.="&begin_d=".$begin_d;
if ($end_d) $param.="&end_d=".$end_d;
if (! empty($optioncss)) $param.='&optioncss='.$optioncss;

$prev = dol_get_first_day_week($day, $month, $year);
//print "day=".$day." month=".$month." year=".$year;
//var_dump($prev); exit;
$prev_year  = $prev['prev_year'];
$prev_month = $prev['prev_month'];
$prev_day   = $prev['prev_day'];
$first_day  = $prev['first_day'];
$first_month= $prev['first_month'];
$first_year = $prev['first_year'];

$week = $prev['week'];

$day = (int) $day;
$next = dol_get_next_week($first_day, $week, $first_month, $first_year);
$next_year  = $next['year'];
$next_month = $next['month'];
$next_day   = $next['day'];

// Define firstdaytoshow and lastdaytoshow (warning: lastdaytoshow is last second to show + 1)
$firstdaytoshow=dol_mktime(0,0,0,$first_month,$first_day,$first_year);
$lastdaytoshow=dol_time_plus_duree($firstdaytoshow, 7, 'd');
//print $firstday.'-'.$first_month.'-'.$first_year;
//print dol_print_date($firstdaytoshow,'dayhour');
//print dol_print_date($lastdaytoshow,'dayhour');

$max_day_in_month = date("t",dol_mktime(0,0,0,$month,1,$year));

$tmpday = $first_day;

$lines_number = empty($conf->global->PS_FORM_SHIFTS_NUMBER) ? 4 : $conf->global->PS_FORM_SHIFTS_NUMBER * 2; // x2 => 2 lines per shift

/*
 * Actions
 */

// mass_add
if ($action == 'mass_add' && $user->admin) {// $user->rights->staff->timesheet->submit) {
    // fetch start/end times
    $plannedshiftsarray = array();
    
    $var = false;
    $error = 0;
    
    for ($line = 0; $line < $lines_number; $line+=2)
    {
        $var = !$var;
        $i = 0;

        while ($i < 7)
        {
            $start_time = get_time_value('st', $i, $line);
            $end_time = get_time_value('et', $i, $line + 1); // $line+1 => end time row position (2)

            if (empty($start_time) && empty($end_time)) {
                $i++;
                continue;
            }
            
            $plannedshift = new PlannedShift($db);
            if (! empty($start_time)) {
                $plannedshift->start_time = $start_time;
            }
            if (! empty($end_time)) {
                $plannedshift->end_time = $end_time;
            }
            
            //$daycursor=dol_time_plus_duree($firstdaytoshow, $i, 'd');
            $daycursor = strtotime('+'.$i.' day', $firstdaytoshow);
            $annee = date('Y',$daycursor);
            $mois = date('m',$daycursor);
            $jour = date('d',$daycursor);

            $daykey = dol_mktime(0,0,0,$mois,$jour,$annee);
            
            $plannedshiftsarray[$daykey][$line] = $plannedshift;

            $i++;
        }
    }
    
    // checks
    
    // user id
    if ($userid <= 0) {
        setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("Staff")), 'errors');
        $error++;
    }
    
    // start/end time
    if (count($plannedshiftsarray) == 0) { // No start-end time entry (0)
        setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("StartTime")), 'errors');
        setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("EndTime")), 'errors');
        $error++;
    }
    else {
        foreach ($plannedshiftsarray as $daykey => $notused)
        {
            foreach ($plannedshiftsarray[$daykey] as $index => $plannedshift)
            {
                $col_and_row = ' '.$langs->trans("InCol", dol_print_date($daykey, 'daytextshort'));

                if (isset($plannedshift->end_time) && ! isset($plannedshift->start_time)) {
                    $col_and_row.= ' '.$langs->trans("InRow", $index + 1); // start time row position (1)
                    setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("StartTime")).$col_and_row, 'errors');
                    $error++;
                }
                if (isset($plannedshift->start_time) && ! isset($plannedshift->end_time)) {
                    $col_and_row.= ' '.$langs->trans("InRow", $index + 2); // end time row position (2)
                    setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("EndTime")).$col_and_row, 'errors');
                    $error++;
                }
            }
        }
    }
    
    // mass add
    
    if (! $error)
    {
        foreach ($plannedshiftsarray as $daykey => $notused)
        {
            foreach ($plannedshiftsarray[$daykey] as $index => $plannedshift)
            {
                if (! $error)
                {
                    $plannedshift->ref = $plannedshift->getNextNumRef($soc);
                    $plannedshift->day = $daykey;
                    //$plannedshift->start_time = ; // already setted
                    //$plannedshift->end_time = ; // already setted
                    $plannedshift->time_diff = $plannedshift->calcTimeDiff();
                    //$plannedshift->note = ; // not needed
                    $plannedshift->fk_user = $userid;
                    $plannedshift->created_by = $user->id;
                    $plannedshift->status = PlannedShift::STATUS_WAITING_TO_CONFIRM;

                    $id = $plannedshift->submit();
                    if ($id > 0) {
                            // Creation OK
                            //..
                    }
                    else {
                            // Creation KO
                            setEventMessage($myobject->error, 'errors');
                            $error++;
                    }
                }
                else
                {
                    break 2; // break the 2 foreach loops
                }
            }
        }
        
        // redirection
        if (! $error)
        {
            $param='';
            $param.="&day=".$day;
            $param.="&month=".$month;
            $param.="&year=".$year;
            $param.="&begin_d=".$begin_d;
            $param.="&end_d=".$end_d;
            $param.="&userid=".$userid;
            $param.="&status=".PlannedShift::STATUS_WAITING_TO_CONFIRM;

            header('Location: '.DOL_URL_ROOT.$mod_path.'/staff/timesheet/peruser.php?type=planned_shift'.$param);
            exit();
        }
    } // end 1st if (! $error)
    
    $action = 'create';
}

// mass_clone
else if ($action == 'mass_clone' && $user->admin) {// $user->rights->staff->timesheet->clone) {
    $error = 0;
    
    // Start period
    if (empty($start_period)) {
        setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("CloneStartPeriod")), 'errors');
        $error++;
    }
    
    // End period
    if (empty($end_period)) {
        setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("CloneEndPeriod")), 'errors');
        $error++;
    }
    else if ($start_period > $end_period) {
        setEventMessage($langs->transnoentities("StartPeriodBiggerThenEndPeriod"), 'errors');
        $error++;
    }
    
    // Staff from
    if ($useridfrom <= 0) {
        setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("StaffFrom")), 'errors');
        $error++;
    }
    
    // Staff to
    if ($useridto <= 0) {
        setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("StaffTo")), 'errors');
        $error++;
    }
    
    // Clone option
    if ($cloneoption <= 0) {
        setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("CloneOption")), 'errors');
        $error++;
    }
    
    // mass clone
    
    if (! $error)
    {
        $plannedshift = new PlannedShift($db);
        
        $result = $plannedshift->massClone($start_period, $end_period, $useridfrom, $useridto, $cloneoption, $includeoriginshifts, $ignorepaidshifts, $soc);
        
        if ($result == 0)
        {
            setEventMessage($langs->trans('CloneError'), 'errors');
        }
        else if ($result > 0)
        {
            // Redirection to the appropriate view (month view)
            if ($cloneoption == 3) { // clone for next month
                $date = strtotime("+1 month", $start_period);
            }
            else if ($cloneoption == 2) { // clone for next week
                $date = strtotime("+1 week", $start_period);
            }
            else { // same date
                $date = $start_period;
            }
            
            $datearray=dol_getdate($date);
            
            $param='';
            $param.="&day=".$datearray['mday'];
            $param.="&month=".$datearray['mon'];
            $param.="&year=".$datearray['year'];
            $param.="&userid=".$useridto;
            $param.="&status=".PlannedShift::STATUS_WAITING_TO_CONFIRM;
            
            setEventMessage($langs->trans('CloneSuccess', $result), 'mesgs'); // Success message
            
            header('Location: '.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?action=show_month&type=planned_shift'.$param);
            exit();
        }
        else
        {
            setEventMessages($plannedshift->error, $plannedshift->errors, 'errors');
        }
    }
    
    $action = 'clone';
}

/*
 * VIEW
 *
 * Put here all code to build page
 */

$moreheadcss = '<link rel="stylesheet" type="text/css" href="'.DOL_URL_ROOT.$mod_path.'/staff/css/timesheet.css.php">';

$headjs=empty($conf->use_javascript_ajax) || $action == "clone" ? "
<script type=\"text/javascript\">
    $(document).ready(function () {
        $('#include_origin_shifts').change(function () {
            if ($(this).is(':checked')) {
                $('#ignore_paid_shifts').prop('disabled', false);
                $('#ignore_paid_shifts').removeClass('buttonRefused');
            }
            else {
                $('#ignore_paid_shifts').prop('checked', false);
                $('#ignore_paid_shifts').prop('disabled', true);
                $('#ignore_paid_shifts').addClass('buttonRefused');
            }
        });
    });
</script>" : "";

llxHeader($moreheadcss.$headjs, $langs->trans('PlannedShift'), '');

$form=new Form($db);

/**
 * *******************************************************************
 *
 * Creation mode
 *
 * *******************************************************************
 */
if ($action == 'create')
{
    print load_fiche_titre($langs->trans('NewPlannedShift'), '', 'object_plannedshift-48@staff');

    dol_fiche_head();
    
    // Plannedshift create summary
    print $langs->trans('PlannedShiftSummary');
    
    $nav ="<a href=\"?year=".$prev_year."&amp;month=".$prev_month."&amp;day=".$prev_day.$param."\">".img_previous($langs->trans("Previous"), 'class="valignbottom"')."</a>\n";
    $nav.=" <span id=\"month_name\">".dol_print_date(dol_mktime(0,0,0,$first_month,$first_day,$first_year),"%Y").", ".$langs->trans("Week")." ".$week;
    $nav.=" </span>\n";
    $nav.="<a href=\"?year=".$next_year."&amp;month=".$next_month."&amp;day=".$next_day.$param."\">".img_next($langs->trans("Next"), 'class="valignbottom"')."</a>\n";
    $nav.=" &nbsp; (<a href=\"?year=".$nowyear."&amp;month=".$nowmonth."&amp;day=".$nowday.$param."\">".$langs->trans("Today")."</a>)";
    $picto='calendarweek';
    
    // Legend
    $s = '';
    $s.=' &nbsp; <form style="display: inline-block;" name="dateselect" action="'.$_SERVER["PHP_SELF"].'?action=create'.$param.'">';
    $s.='<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
    $s.='<input type="hidden" name="action" value="' . $action . '">';
    $s.='<input type="hidden" name="status" value="' . $status . '">';
    $s.='<input type="hidden" name="userid" value="' . $userid . '">';
    $s.='<input type="hidden" name="begin_d" value="' . $begin_d . '">';
    $s.='<input type="hidden" name="end_d" value="' . $end_d . '">';

    $s.=$form->select_date($dateselect, 'dateselect', 0, 0, 1, '', 1, 0, 1);
    $s.=' <input type="submit" name="submitdateselect" class="button" value="'.$langs->trans("Refresh").'">';
    $s.='</form>';

    // Must be after the nav definition
    $param.='&year='.$year.'&month='.$month.($day?'&day='.$day:'');
    //print 'x'.$param;

    /*
     * Calendar View
     */

    // Define the legend/list of calendard to show
    $link='';

    print load_fiche_titre($s, $link.' &nbsp; &nbsp; '.$nav, '');

    // Line header with list of days

    //print "begin_d=".$begin_d." end_d=".$end_d;
    
    print '<form name="addplannedshift" action="' . $_SERVER["PHP_SELF"] . '" method="POST">';
    print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
    print '<input type="hidden" name="action" value="mass_add">';
    print '<input type="hidden" name="begin_d" value="' . $begin_d . '">';
    print '<input type="hidden" name="end_d" value="' . $end_d . '">';
    print '<input type="hidden" name="day" value="' . $day . '">';
    print '<input type="hidden" name="month" value="' . $month . '">';
    print '<input type="hidden" name="year" value="' . $year . '">';

    //echo '<div class="div-table-responsive">';
    echo '<table width="100%" class="noborder nocellnopadd cal_month">';

    echo '<tr class="liste_titre">';
    echo '<td></td>';
    $i=0;	// 0 = sunday,
    while ($i < 7)
    {
            if (($i + 1) < $begin_d || ($i + 1) > $end_d)
            {
                    $i++;
                    continue;
            }

            echo '<td align="center">';
            echo $langs->trans("Day".(($i+(isset($conf->global->MAIN_START_WEEK)?$conf->global->MAIN_START_WEEK:1)) % 7));
            print "<br>";
            //if ($i) print dol_print_date(dol_time_plus_duree($firstdaytoshow, $i, 'd'),'daytextshort');
            if ($i) print dol_print_date(strtotime('+'.$i.' day', $firstdaytoshow),'daytextshort');
            else print dol_print_date($firstdaytoshow,'daytextshort');
            echo "</td>\n";
            $i++;
    }
    echo "</tr>\n";

    // Loop on each line to show calendar
    $todayarray=dol_getdate($now,'fast');
    $sav = $tmpday;
    $var = false;
    for ($line = 0; $line < $lines_number; $line++)
    {
            $var = ! $var;
            echo "<tr>";
            echo '<td class="cal_current_month cal_peruserviewname'.($var?' cal_impair':'').'">';
            print $langs->trans($var ? "StartTime" : "EndTime").':';
            print '</td>';
            $tmpday = $sav;

            // Loop on each day of week
            $i = 0;
            for ($iter_day = 0; $iter_day < 8; $iter_day++)
            {
                    if (($i + 1) < $begin_d || ($i + 1) > $end_d)
                    {
                            $i++;
                            continue;
                    }

                    // Show days of the current week
                    //$curtime = dol_time_plus_duree($firstdaytoshow, $iter_day, 'd');
                    $curtime = strtotime('+'.$iter_day.' day', $firstdaytoshow);
                    $tmparray = dol_getdate($curtime,'fast');
                    $tmpday = $tmparray['mday'];
                    $tmpmonth = $tmparray['mon'];
                    $tmpyear = $tmparray['year'];

                    $style='cal_current_month';
                    //if ($iter_day == 6) $style.=' cal_other_month';
                    $today=0;
                    if ($todayarray['mday']==$tmpday && $todayarray['mon']==$tmpmonth && $todayarray['year']==$tmpyear) $today=1;
                    if ($today) $style='cal_today_peruser';

                    $name = ($var ? 'st_' : 'et_').$i.'_'.$line.'_';
                    $hour = GETPOST($name.'hour');
                    $min = GETPOST($name.'min');
                    $value = $hour != -1 && $min != -1 ? strtotime($hour.':'.$min) : '';
                    print_time_input($form, $name, $value, $style, $var);

                    $i++;
            }
            echo "</tr>\n";
            
            // print empty line (in the middle)
            if ($line % 2 == 1 && $line + 1 < $lines_number)
            {
                print_empty_line();
            }
    }
    
    // User/Staff
    print '<tr class="liste_titre total_hours">';
    print '<td align="left" class="fieldrequired">'.$langs->trans('Staff').': </td>';
    print '<td align="left" colspan="7"> &nbsp; ';
    print $form->select_dolusers($userid, 'userid', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1');
    print '</td>';
    print '</tr>';

    echo "</table>\n";
    //echo '</div>';
    
    echo '<br>';
    
    print '<div class="center">';
    print '<input type="submit" class="button" value="' . $langs->trans("Submit") . '">';
    print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    print '<input type="button" class="button" value="' . $langs->trans("Cancel") . '" onClick="javascript:history.go(-1)">';
    print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    print '<input type="reset" class="button" value="' . $langs->trans("Reset") . '">';
    print '</div>';
    
    print "</form>";
    
    dol_fiche_end();
    
    // Plannedshift instructions
    print '<div class="info hideonsmartphone">';
    print get_info_picto();
    print $langs->trans('PlannedShiftInstructions');
    print '</div>';
}

/**
 * *******************************************************************
 *
 * Clone mode
 *
 * *******************************************************************
 */

else if ($action == 'clone')
{
    print load_fiche_titre($langs->trans('ClonePlannedShifts'), '', 'object_plannedshift-48@staff');
    
    print '<form name="cloneshifts" action="' . $_SERVER["PHP_SELF"] . '" method="POST">';
    print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
    print '<input type="hidden" name="action" value="mass_clone">';
    
    dol_fiche_head();
    
    // Plannedshift clone summary
    print $langs->trans('ClonePlannedShiftSummary');
    
    print '<table class="border" width="100%">';
    
    // Date Start Period
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('CloneStartPeriod') . '</td><td colspan="2">';
    print $form->select_date($start_period, 'sp', 0, 0, 1, '', 1, 1, 1);
    print '</td></tr>';
    
    // Date End Period
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('CloneEndPeriod') . '</td><td colspan="2">';
    print $form->select_date($end_period, 'ep', 0, 0, 1, '', 1, 1, 1);
    print '</td></tr>';
    
    // Staff from
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('StaffFrom') . '</td><td colspan="2">';
    print $form->select_dolusers($useridfrom, 'useridfrom', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1');
    print '</td></tr>';
    
    // Staff to
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('StaffTo') . '</td><td colspan="2">';
    print $form->select_dolusers($useridto, 'useridto', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1');
    print '</td></tr>';
    
    // Clone options
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('CloneOptions') . '</td><td colspan="2">';
    print '<label for="clone_otpion_same"><input type="radio" id="clone_otpion_same" name="cloneoption" value="1"'.($cloneoption == 1 || empty($cloneoption) ?' checked':'').'> '.$langs->trans('UseTheSameDates').'</label>';
    print '<br>';
    print '<label for="clone_otpion_week"><input type="radio" id="clone_otpion_week" name="cloneoption" value="2"'.($cloneoption == 2 ?' checked':'').'> '.$langs->trans('CloneForNextWeek').'</label>';
    print '<br>';
    print '<label for="clone_otpion_month"><input type="radio" id="clone_otpion_month" name="cloneoption" value="3"'.($cloneoption == 3 ?' checked':'').'> '.$langs->trans('CloneForNextMonth').'</label>';
    print '</td></tr>';
    
    // More options
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('MoreOptions') . '</td><td colspan="2">';
    print '<input type="hidden" name="include_origin_shifts" value="0">';
    print '<input type="checkbox" id="include_origin_shifts" name="include_origin_shifts" value="1"'.($includeoriginshifts == '0' ? '' : ' checked').'> ' . $langs->trans("IncludeOriginShifts");
    print '<br>';
    print '<input type="hidden" name="ignore_paid_shifts" value="0">';
    print '<input type="checkbox" id="ignore_paid_shifts" name="ignore_paid_shifts" value="1"'.(empty($ignorepaidshifts) || $includeoriginshifts == '0' ? ($includeoriginshifts == '0' ? ' class="buttonRefused" disabled' : '') : ' checked').'> ' . $langs->trans("IgnorePaidShifts");
    print '</td></tr>';
    
    print '</table>';
    
    dol_fiche_end();
    
    print '<div class="center">';
    print '<input type="submit" class="button" value="' . $langs->trans("Clone") . '">';
    print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    print '<input type="button" class="button" value="' . $langs->trans("Cancel") . '" onClick="javascript:history.go(-1)">';
    print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    print '<input type="reset" class="button" value="' . $langs->trans("Reset") . '">';
    print '</div>';
    
    print "</form>";
}

// End of page
llxFooter();

$db->close();

/**
 * print time input
 *
 * @param   string	$style          Style to use for this day
 * @param	bool	$var			true or false for alternat style on tr/td
 * @return	void
 */
function print_time_input($form, $name, $value, $style, $var=false)
{
        print '<td class="center '.$style.' cal_peruser'.($var?' cal_impair '.$style.'_impair':'').'">';
        
	print $form->select_date($value,$name,1,1,1,'',0,0);
        
        print '</td>';
}

/**
 * print empty line
 *
 * @return	void
 */
function print_empty_line($bold=false)
{
    print '<tr class="liste_titre total_hours">';
    print '<td>'.($bold ? '<br><br>' : '').'</td>';
    
    $i=0;
    
    while ($i < 7)
    {
            print '<td align="center">'.($bold ? '<br><br>' : '').'</td>';
            
            $i++;
    }
    
    print "</tr>\n";
}

/**
 * get time value
 *
 * @return	string      $value
 */
function get_time_value($prefix, $i, $line)
{
    $name = $prefix.'_'.$i.'_'.$line.'_';
    $hour = GETPOST($name.'hour');
    $min = GETPOST($name.'min');
    $value = $hour != -1 && $min != -1 ? $hour.':'.$min : '';
    
    return $value;
}
