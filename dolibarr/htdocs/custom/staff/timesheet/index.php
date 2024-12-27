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
$langs->load("staff@staff");

// Get parameters
$action=GETPOST('action','alpha');
$year=GETPOST("year","int")?GETPOST("year","int"):date("Y");
$month=GETPOST("month","int")?GETPOST("month","int"):date("m");
$week=GETPOST("week","int")?GETPOST("week","int"):date("W");
$day=GETPOST("day","int")?GETPOST("day","int"):0;
$status=GETPOST("status");
$userid=GETPOST('userid', 'int');
$socid = GETPOST('socid', 'int');
$type=GETPOST('type','alpha');
$optioncss = GETPOST('optioncss','alpha');
$wich_week = GETPOST('wich_week','alpha');

$dateselect=dol_mktime(0, 0, 0, GETPOST('dateselectmonth'), GETPOST('dateselectday'), GETPOST('dateselectyear'));
if ($dateselect > 0)
{
	$day=GETPOST('dateselectday');
	$month=GETPOST('dateselectmonth');
	$year=GETPOST('dateselectyear');
}

$now=dol_now();

// Access control
if (!$user->rights->staff->timesheet->read || ($type == 'planned_shift' && !$user->rights->staff->plannedshift->read)) {
	// External user
	accessforbidden();
}
else if (!$user->employee) {
        // Non staff user
        accessforbidden($langs->trans('AccessDeniedToNonStaffUser'));
}

$soc = new Societe($db);

if ($socid > 0) {
    $res = $soc->fetch($socid);
}

if (empty($action) && ! isset($_GET['action']) && ! isset($_POST['action'])) $action=(empty($conf->global->TIMESHEET_DEFAULT_VIEW)?'show_week':$conf->global->TIMESHEET_DEFAULT_VIEW);

if (GETPOST('viewcal') && $action != 'show_day' && $action != 'show_week')  {
    $action='show_month'; $day='';
} // View by month
if (GETPOST('viewweek') || $action == 'show_week') {
    $action='show_week'; $week=($week?$week:date("W")); $day=($day?$day:date("d"));
} // View by week
if (GETPOST('viewday') || $action == 'show_day')  {
    $action='show_day'; $day=($day?$day:date("d"));
} // View by day

/*
 * Actions
 */



/*
 * VIEW
 *
 * Put here all code to build page
 */

$title = $type == 'planned_shift' ? $langs->trans('PlannedShift') : $langs->trans('Timesheet');

$moreheadcss = '<link rel="stylesheet" type="text/css" href="'.DOL_URL_ROOT.$mod_path.'/staff/css/timesheet.css.php">';

llxHeader($moreheadcss, $title, '');

$form=new Form($db);

$nowarray=dol_getdate($now);
$nowyear=$nowarray['year'];
$nowmonth=$nowarray['mon'];
$nowday=$nowarray['mday'];

if (empty($action) || $action=='show_month')
{
    $prev = dol_get_prev_month($month, $year);
    $prev_year  = $prev['year'];
    $prev_month = $prev['month'];
    $next = dol_get_next_month($month, $year);
    $next_year  = $next['year'];
    $next_month = $next['month'];

    $max_day_in_prev_month = date("t",dol_mktime(0,0,0,$prev_month,1,$prev_year));  // Nb of days in previous month
    $max_day_in_month = date("t",dol_mktime(0,0,0,$month,1,$year));                 // Nb of days in next month
    // tmpday is a negative or null cursor to know how many days before the 1st to show on month view (if tmpday=0, 1st is monday)
    $tmpday = -date("w",dol_mktime(12,0,0,$month,1,$year,true))+2;		// date('w') is 0 fo sunday
    $tmpday+=((isset($conf->global->MAIN_START_WEEK)?$conf->global->MAIN_START_WEEK:1)-1);
    if ($tmpday >= 1) $tmpday -= 7;	// If tmpday is 0 we start with sunday, if -6, we start with monday of previous week.
    // Define firstdaytoshow and lastdaytoshow (warning: lastdaytoshow is last second to show + 1)
    $firstdaytoshow=dol_mktime(0,0,0,$prev_month,$max_day_in_prev_month+$tmpday,$prev_year);
    $next_day=7 - ($max_day_in_month+1-$tmpday) % 7;
    if ($next_day < 6) $next_day+=7;
    $lastdaytoshow=dol_mktime(0,0,0,$next_month,$next_day,$next_year);
    $tmpdaysave = $tmpday;
}
if ($action=='show_week')
{
    // wich week
    if ($wich_week == 'previous')
    {
        $prev = dol_get_first_day_week($day, $month, $year);
        $year  = $prev['prev_year'];
        $month = $prev['prev_month'];
        $day   = $prev['prev_day'];
        //print 'prev: '.$day.'/'.$month.'/'.$year;
    }
    else if ($wich_week == 'next') {
        $next = dol_get_next_week($day, $week, $month, $year);
        $year  = $next['year'];
        $month = $next['month'];
        $day   = $next['day'];
        //print 'next: '.$day.'/'.$month.'/'.$year;
    }
    
    $prev = dol_get_first_day_week($day, $month, $year);
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

    $max_day_in_month = date("t",dol_mktime(0,0,0,$month,1,$year));

    $tmpday = $first_day;
}
if ($action == 'show_day')
{
    $prev = dol_get_prev_day($day, $month, $year);
    $prev_year  = $prev['year'];
    $prev_month = $prev['month'];
    $prev_day   = $prev['day'];
    $next = dol_get_next_day($day, $month, $year);
    $next_year  = $next['year'];
    $next_month = $next['month'];
    $next_day   = $next['day'];

    // Define firstdaytoshow and lastdaytoshow (warning: lastdaytoshow is last second to show + 1)
    $firstdaytoshow=dol_mktime(0,0,0,$prev_month,$prev_day,$prev_year);
    $lastdaytoshow=dol_mktime(0,0,0,$next_month,$next_day,$next_year);
}
//print 'xx'.$prev_year.'-'.$prev_month.'-'.$prev_day;
//print 'xx'.$next_year.'-'.$next_month.'-'.$next_day;
//print dol_print_date($firstdaytoshow,'day');
//print dol_print_date($lastdaytoshow,'day');

$param='';

if ($action == 'show_day' || $action == 'show_week' || $action == 'show_month') $param.='&action='.$action;
if (! empty($type)) $param.='&type='.$type;
if (! empty($optioncss)) $param.='&optioncss='.$optioncss;
if (! empty($userid)) $param.='&userid='.$userid;
if (! empty($status)) $param.='&status='.$status;

// accesskey is for Windows or Linux:  ALT + key for chrome, ALT + SHIFT + KEY for firefox
// accesskey is for Mac:               CTRL + key for all browsers
$stringforfirstkey = 'CTL +';
if ($conf->browser->name == 'chrome')
{
    $stringforfirstkey = 'ALT +';
}
else if ($conf->browser->name == 'firefox')
{
    $stringforfirstkey = 'ALT + SHIFT +';
}

// Show navigation bar
if (empty($action) || $action=='show_month')
{
    $nav ="<a accesskey=\"p\" title=\"$stringforfirstkey p\" class=\"classfortooltip\" href=\"?year=".$prev_year."&amp;month=".$prev_month.$param."\">".img_previous($langs->trans("Previous"), 'class="valignbottom"')."</a>\n";
    $nav.=" <span id=\"month_name\">".dol_print_date(dol_mktime(0,0,0,$month,1,$year),"%b %Y");
    $nav.=" </span>\n";
    $nav.="<a accesskey=\"n\" title=\"$stringforfirstkey n\" class=\"classfortooltip\" href=\"?year=".$next_year."&amp;month=".$next_month.$param."\">".img_next($langs->trans("Next"), 'class="valignbottom"')."</a>\n";
    $nav.=" &nbsp; (<a href=\"?year=".$nowyear."&amp;month=".$nowmonth.$param."\">".$langs->trans("Today")."</a>)";
    $picto='calendar';
}
if ($action=='show_week')
{
    $nav ="<a accesskey=\"p\" title=\"$stringforfirstkey p\" class=\"classfortooltip\" href=\"?year=".$prev_year."&amp;month=".$prev_month."&amp;day=".$prev_day.$param."\">".img_previous($langs->trans("Previous"), 'class="valignbottom"')."</a>\n";
    $nav.=" <span id=\"month_name\">".dol_print_date(dol_mktime(0,0,0,$first_month,$first_day,$first_year),"%Y").", ".$langs->trans("Week")." ".$week;
    $nav.=" </span>\n";
    $nav.="<a accesskey=\"n\" title=\"$stringforfirstkey n\" class=\"classfortooltip\" href=\"?year=".$next_year."&amp;month=".$next_month."&amp;day=".$next_day.$param."\">".img_next($langs->trans("Next"), 'class="valignbottom"')."</a>\n";
    $nav.=" &nbsp; (<a href=\"?year=".$nowyear."&amp;month=".$nowmonth."&amp;day=".$nowday.$param."\">".$langs->trans("Today")."</a>)";
    $picto='calendarweek';
}
if ($action=='show_day')
{
    $nav ="<a accesskey=\"p\" title=\"$stringforfirstkey p\" class=\"classfortooltip\" href=\"?year=".$prev_year."&amp;month=".$prev_month."&amp;day=".$prev_day.$param."\">".img_previous($langs->trans("Previous"), 'class="valignbottom"')."</a>\n";
    $nav.=" <span id=\"month_name\">".dol_print_date(dol_mktime(0,0,0,$month,$day,$year),"daytextshort");
    $nav.=" </span>\n";
    $nav.="<a accesskey=\"n\" title=\"$stringforfirstkey n\" class=\"classfortooltip\" href=\"?year=".$next_year."&amp;month=".$next_month."&amp;day=".$next_day.$param."\">".img_next($langs->trans("Next"), 'class="valignbottom"')."</a>\n";
    $nav.=" &nbsp; (<a href=\"?year=".$nowyear."&amp;month=".$nowmonth."&amp;day=".$nowday.$param."\">".$langs->trans("Today")."</a>)";
    $picto='calendarday';
}

// Must be after the nav definition
$param.='&year='.$year.'&month='.$month.($day?'&day='.$day:'');
//print 'x'.$param;


// Fiche head

$tabactive='';
if ($action == 'show_month') $tabactive='cardmonth';
if ($action == 'show_week') $tabactive='cardweek';
if ($action == 'show_day')  $tabactive='cardday';
if ($action == 'show_list') $tabactive='cardlist';

$paramnoaction=preg_replace('/action=[a-z_]+/','',$param);

$head = timesheet_prepare_head($paramnoaction, $mod_path);

if ($optioncss != 'print')
{
    dol_fiche_head($head, $tabactive, $title, 0, empty($type) ? 'timesheet@staff' : 'plannedshift@staff');
    print_timesheet_form($form, $year, $month, $day, $action, $type);
    dol_fiche_end();
}

// Load timesheets from database into $timesheetsarray
$timesheetsarray=array();

$sql = 'SELECT ';
$sql.= ' t.rowid, t.origin, t.entity, t.day,';
$sql.= ' time_format(t.start_time,"%H:%i") as start_time,';
$sql.= ' time_format(t.end_time,"%H:%i") as end_time,';
$sql.= ' t.time_diff,';
$sql.= ' t.fk_user,';
$sql.= ' t.created_by,';
$sql.= ' t.note,';
$sql.= ' t.status';
$sql.= ' FROM '.MAIN_DB_PREFIX.'staff_timesheet as t';
$sql.= ' WHERE t.entity IN ('.getEntity('user', 1).')';
$sql.= $type == 'planned_shift' ? PlannedShift::getFilter($type) : Timesheet::getFilter($type);
if (! $user->admin) {
    $sql.= ' AND t.fk_user = '.$user->id;
}
if ($status != '' && $status >= 0)
{
    $sql .= " AND t.status IN (".$status.")";
}
if ($userid > 0)
{
    $sql.= " AND t.fk_user = ".$userid;
}
if ($action == 'show_day')
{
    $sql.= " AND (";
    $sql.= " (t.day BETWEEN '".$db->idate(dol_mktime(0,0,0,$month,$day,$year))."'";
    $sql.= " AND '".$db->idate(dol_mktime(23,59,59,$month,$day,$year))."')";
    $sql.= " OR ";
    $sql.= " (t.day BETWEEN '".$db->idate(dol_mktime(0,0,0,$month,$day,$year))."'";
    $sql.= " AND '".$db->idate(dol_mktime(23,59,59,$month,$day,$year))."')";
    $sql.= " OR ";
    $sql.= " (t.day < '".$db->idate(dol_mktime(0,0,0,$month,$day,$year))."'";
    $sql.= " AND t.day > '".$db->idate(dol_mktime(23,59,59,$month,$day,$year))."')";
    $sql.= ')';
}
else
{
    // To limit array
    $sql.= " AND (";
    $sql.= " (t.day BETWEEN '".$db->idate(dol_mktime(0,0,0,$month,1,$year)-(60*60*24*7))."'";   // Start 7 days before
    $sql.= " AND '".$db->idate(dol_mktime(23,59,59,$month,28,$year)+(60*60*24*10))."')";            // End 7 days after + 3 to go from 28 to 31
    $sql.= " OR ";
    $sql.= " (t.day BETWEEN '".$db->idate(dol_mktime(0,0,0,$month,1,$year)-(60*60*24*7))."'";
    $sql.= " AND '".$db->idate(dol_mktime(23,59,59,$month,28,$year)+(60*60*24*10))."')";
    $sql.= " OR ";
    $sql.= " (t.day < '".$db->idate(dol_mktime(0,0,0,$month,1,$year)-(60*60*24*7))."'";
    $sql.= " AND t.day > '".$db->idate(dol_mktime(23,59,59,$month,28,$year)+(60*60*24*10))."')";
    $sql.= ')';
}
// Sort on date
$sql.= ' ORDER BY day, start_time, end_time';
//print $sql;


//dol_syslog("staff/timesheet/index.php", LOG_DEBUG);
$resql=$db->query($sql);
if ($resql)
{
    $num = $db->num_rows($resql);
    $i=0;
    while ($i < $num)
    {
        $obj = $db->fetch_object($resql);

        // Create a new object
        $timesheet= $type == 'planned_shift' ? new PlannedShift($db) : new Timesheet($db);
        $timesheet->id=$obj->rowid;
        $timesheet->origin=$obj->origin;

        $timesheet->day=$db->jdate($obj->day);
        $timesheet->start_time=$obj->start_time;
        $timesheet->end_time=$obj->end_time;
        $timesheet->time_diff=$obj->time_diff;
        
        $timesheet->fk_user=$obj->fk_user;
        $timesheet->created_by=$obj->created_by;
        
        $timesheet->note=$obj->note;
        $timesheet->status=$obj->status;
        
        // Add an entry in timesheetarray for each day
        $daycursor=$timesheet->day;
        $annee = date('Y',$daycursor);
        $mois = date('m',$daycursor);
        $jour = date('d',$daycursor);
        
        $daykey=dol_mktime(0,0,0,$mois,$jour,$annee);
        $timesheetsarray[$daykey][]=$timesheet;
        
        $i++;
    }
}
else
{
    dol_print_error($db);
}

/*
 * Calendar View
 */

// Define the legend/list of calendard to show

// Legend
$s='';
if ($conf->use_javascript_ajax)
{
    $s ='<script type="text/javascript">' . "\n";
    $s.='jQuery(document).ready(function () {' . "\n";
    $s.='jQuery("#show_total_hours").click(function() { jQuery(".total_hours").toggle(); });' . "\n";
    $s.='});' . "\n";
    $s.='</script>' . "\n";
    $s.='<div class="nowrap clear float"><input type="checkbox" id="show_total_hours" name="show_total_hours" checked> ' . $langs->trans("ShowTotalHours").' &nbsp; </div>';
}

$link='';

print load_fiche_titre($s, $link.' &nbsp; &nbsp; '.$nav, '', 0, 0, 'tablelistofcalendars');

// Define theme_datacolor array
if ($conf->global->TIMESHEET_USE_MULTI_COLORS)
{
    $color_file = DOL_DOCUMENT_ROOT."/theme/".$conf->theme."/graph-color.php";
    if (is_readable($color_file))
    {
        include_once $color_file;
    }
    if (! is_array($theme_datacolor)) $theme_datacolor=array(array(120,130,150), array(200,160,180), array(190,190,220));
}

if (empty($action) || $action == 'show_month')      // View by month
{
    echo '<table width="100%" class="noborder nocellnopadd cal_pannel cal_month">';
    echo ' <tr class="liste_titre">';
    $i=0;
    while ($i < 7)
    {
        print '  <td align="center"'.($i == 0 ? ' colspan="2"': '').'>';
        $numdayinweek=(($i+(isset($conf->global->MAIN_START_WEEK)?$conf->global->MAIN_START_WEEK:1)) % 7);
        if (! empty($conf->dol_optimize_smallscreen))
        {
            $labelshort=array(0=>'SundayMin',1=>'MondayMin',2=>'TuesdayMin',3=>'WednesdayMin',4=>'ThursdayMin',5=>'FridayMin',6=>'SaturdayMin');
            print $langs->trans($labelshort[$numdayinweek]);
        }
        else print $langs->trans("Day".$numdayinweek);
        print "</td>\n";
        $i++;
    }
    echo " </tr>\n";

    $todayarray=dol_getdate($now,'fast');
    $todaytms=dol_mktime(0, 0, 0, $todayarray['mon'], $todayarray['mday'], $todayarray['year']);

    // In loops, tmpday contains day nb in current month (can be zero or negative for days of previous month)
    //var_dump($timesheetsarray);
    for ($iter_week = 0; $iter_week < 6 ; $iter_week++)
    {
        echo " <tr>\n";
        for ($iter_day = 0; $iter_day < 7; $iter_day++)
        {
            /* Show days before the beginning of the current month (previous month)  */
            if ($tmpday <= 0)
            {
                $style='cal_other_month cal_past';
        		if ($iter_day == 6) $style.=' cal_other_month_right';
                echo '  <td class="'.$style.' nowrap" width="14%" valign="top"'.($iter_day == 0 ? ' colspan="2"': '').'>';
                show_day_timesheet($db, $max_day_in_prev_month + $tmpday, $prev_month, $prev_year, $month, $style, $timesheetsarray, $maxnbofchar, $newparam);
                echo "  </td>\n";
            }
            /* Show days of the current month */
            elseif ($tmpday <= $max_day_in_month)
            {
                $curtime = dol_mktime(0, 0, 0, $month, $tmpday, $year);
                $style='cal_current_month';
                if ($iter_day == 6) $style.=' cal_current_month_right';
                $today=0;
                if ($todayarray['mday']==$tmpday && $todayarray['mon']==$month && $todayarray['year']==$year) $today=1;
                if ($today) $style='cal_today';
                if ($curtime < $todaytms) $style.=' cal_past';
				//var_dump($todayarray['mday']."==".$tmpday." && ".$todayarray['mon']."==".$month." && ".$todayarray['year']."==".$year.' -> '.$style);
                echo '  <td class="'.$style.' nowrap" width="14%" valign="top"'.($iter_day == 0 ? ' colspan="2"': '').'>';
                show_day_timesheet($db, $tmpday, $month, $year, $month, $style, $timesheetsarray, $maxnbofchar, $newparam);
                echo "  </td>\n";
            }
            /* Show days after the current month (next month) */
            else
            {
                $style='cal_other_month';
                if ($iter_day == 6) $style.=' cal_other_month_right';
                echo '  <td class="'.$style.' nowrap" width="14%" valign="top"'.($iter_day == 0 ? ' colspan="2"': '').'>';
                show_day_timesheet($db, $tmpday - $max_day_in_month, $next_month, $next_year, $month, $style, $timesheetsarray, $maxnbofchar, $newparam);
                echo "</td>\n";
            }
            $tmpday++;
        }
        echo " </tr>\n";
    }
    //echo "</table>\n";

}
elseif ($action == 'show_week') // View by week
{
    echo '<table width="100%" class="noborder nocellnopadd cal_pannel cal_month">';
    echo ' <tr class="liste_titre">';
    $i=0;
    while ($i < 7)
    {
        //$curtime = dol_time_plus_duree($firstdaytoshow, $i, 'd'); // this function is bugged on week view (when week start from Sunday 29 Oct 2017)
        $curtime = strtotime('+'.$i.' day', $firstdaytoshow);
        $tmparray = dol_getdate($curtime, true);
        $tmpday = $tmparray['mday'];
        $tmpmonth = $tmparray['mon'];
        $tmpyear = $tmparray['year'];
        
        echo '  <td align="center"'.($i == 0 ? ' colspan="2"': '').'>';
        echo $langs->trans("Day".(($i+(isset($conf->global->MAIN_START_WEEK)?$conf->global->MAIN_START_WEEK:1)) % 7));
        echo '<br>';
        echo dol_print_date(dol_mktime(0, 0, 0, $tmpmonth, $tmpday, $tmpyear),'daytextshort');
        echo "</td>\n";
        $i++;
    }
    echo " </tr>\n";

    echo " <tr>\n";

    for ($iter_day = 0; $iter_day < 7; $iter_day++)
    {
        // Show days of the current week
        //$curtime = dol_time_plus_duree($firstdaytoshow, $iter_day, 'd'); // this function is bugged on week view (when week start from Sunday 29 Oct 2017)
        $curtime = strtotime('+'.$iter_day.' day', $firstdaytoshow);
        $tmparray = dol_getdate($curtime, true);
        $tmpday = $tmparray['mday'];
        $tmpmonth = $tmparray['mon'];
        $tmpyear = $tmparray['year'];

        $style='cal_current_month';
        if ($iter_day == 6) $style.=' cal_other_month_right';
        $today=0;
        $todayarray=dol_getdate($now,'fast');
        if ($todayarray['mday']==$tmpday && $todayarray['mon']==$tmpmonth && $todayarray['year']==$tmpyear) $today=1;
        if ($today) $style='cal_today';

        echo '  <td class="'.$style.'" width="14%" valign="top"'.($iter_day == 0 ? ' colspan="2"': '').'>';
        show_day_timesheet($db, $tmpday, $tmpmonth, $tmpyear, $month, $style, $timesheetsarray, $maxnbofchar, $newparam, 0, 300);
        echo "  </td>\n";
    }
    echo " </tr>\n";
    //echo "</table>\n";
}
else    // View by day
{
    // Code to show just one day
    $style='cal_current_month cal_current_month_oneday';
    $today=0;
    $todayarray=dol_getdate($now,'fast');
    if ($todayarray['mday']==$day && $todayarray['mon']==$month && $todayarray['year']==$year) $today=1;
    //if ($today) $style='cal_today';

    $timestamp=dol_mktime(12,0,0,$month,$day,$year);
    $arraytimestamp=dol_getdate($timestamp);
    echo '<table width="100%" class="noborder nocellnopadd cal_pannel cal_month">';
    echo ' <tr class="liste_titre">';
    echo '  <td align="center" colspan="2">';
    echo $langs->trans("Day".$arraytimestamp['wday']);
    echo '<br>';
    echo dol_print_date(dol_mktime(0, 0, 0, $month, $day, $year),'daytextshort');
    echo "</td>\n";
    echo " </tr>\n";
    echo " <tr>\n";
    echo '  <td class="'.$style.'" width="14%" valign="top" colspan="2">';
    $maxnbofchar=80;
    show_day_timesheet($db, $day, $month, $year, $month, $style, $timesheetsarray, $maxnbofchar, $newparam, 0, 300);
    echo "</td>\n";
    echo " </tr>\n";
    //echo '</table>';
}

show_total_hours($timesheetsarray, $action);

echo '</table>';

if ($type == 'planned_shift' && $conf->global->SHOW_PLANNED_SHIFT_INSTRUCTIONS)
{
    print '<br>';
    // Plannedshift instructions
    print '<div class="info hideonsmartphone">';
    print get_info_picto();
    print $langs->trans('PlannedShiftInstructions');
    print '</div>';
}

// End of page
llxFooter();

$db->close();

/**
 * Show timesheet of a particular day
 *
 * @param	DoliDB	$db              Database handler
 * @param   int		$day             Day
 * @param   int		$month           Month
 * @param   int		$year            Year
 * @param   int		$monthshown      Current month shown in calendar view
 * @param   string	$style           Style to use for this day
 * @param   array	$timesheetsarray  Array of timesheet
 * @param   int		$maxnbofchar     Nb of characters to show for event line
 * @param   string	$newparam        Parameters on current URL
 * @param   int		$showinfo        Add extended information (used by month view)
 * @param   int		$minheight       Minimum height for each event. 60px by default.
 * @return	void
 */
function show_day_timesheet($db, $day, $month, $year, $monthshown, $style, &$timesheetsarray, $maxnbofchar=16, $newparam='', $showinfo=1, $minheight=60)
{
    global $user, $conf, $langs, $mod_path;
    global $action, $status, $type;	// Filters used into search form
    global $theme_datacolor, $colorindexused;
    
    print "\n".'<div id="daytimesheet_'.sprintf("%04d",$year).sprintf("%02d",$month).sprintf("%02d",$day).'" class="daytimesheet">';

    // Line with title of day
    $curtime = dol_mktime(0, 0, 0, $month, $day, $year);
    print '<table class="nobordernopadding" width="100%">'."\n";

    print '<tr><td align="left" class="nowrap">';
    print '<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?';
    print 'action=show_day&day='.str_pad($day, 2, "0", STR_PAD_LEFT).'&month='.str_pad($month, 2, "0", STR_PAD_LEFT).'&year='.$year;
    print $newparam;
    print '">';
    if ($showinfo) print dol_print_date($curtime,'%d');
    print '</a>';
    print '</td></tr>'."\n";

    // Line with td contains all div of each timesheet
    print '<tr height="'.$minheight.'"><td valign="top" colspan="2" class="sortable" style="padding-bottom: 2px;">';
    print '<div style="width: 100%; position: relative;">';
    
    $ymd=sprintf("%04d",$year).sprintf("%02d",$month).sprintf("%02d",$day);
    
    // @ related to multi colors
    $colorindexused[$user->id] = 0;         // Color index for current user (user->id) is always 0
    $nextindextouse=count($colorindexused); // At first run this is 0, so fist user has 0, next 1, ...
    
    include dol_buildpath('/staff/tpl/timesheet.tpl.php');
    
    print '</div>';
    print '</td></tr>';

    print '</table></div>'."\n";
}

/**
 * print the total hours
 *
 * @param 	array		$timesheetsarray    Array of timesheets
 * @return	void
 */
function show_total_hours($timesheetsarray, $action)
{
    global $langs;
    global $day, $month, $year, $type;
    
    // Total hours
    print '<tr class="liste_titre total_hours">';
    print '<td'.($action == 'show_day' ? ' width="14%"' : '').'>';
    print $langs->trans('TotalHours').': <br><br></td>';
    
    if ($action == 'show_month')
    {
        global $tmpdaysave, $max_day_in_month, $max_day_in_prev_month, $prev_month, $prev_year, $next_month, $next_year;
        
        $tmpday = $tmpdaysave;
        $total_per_day = array_fill(0, 7, 0);//array(); // init total_per_day (7 days) from index 0 to 6 with 0
        
        // Get total hours per day / per week
        for ($iter_week = 0; $iter_week < 6 ; $iter_week++)
        {
            for ($iter_day = 0; $iter_day < 7; $iter_day++)
            {
                /* days before the beginning of the current month (previous month)  */
                if ($tmpday <= 0)
                {
                    $total_per_day[$iter_day] += get_total_hours_per_day($timesheetsarray, $max_day_in_prev_month + $tmpday, $prev_month, $prev_year);
                }
                /* days of the current month */
                else if ($tmpday <= $max_day_in_month)
                {
                    $total_per_day[$iter_day] += get_total_hours_per_day($timesheetsarray, $tmpday, $month, $year);
                }
                /* days after the current month (next month) */
                else
                {
                    $total_per_day[$iter_day] += get_total_hours_per_day($timesheetsarray, $tmpday - $max_day_in_month, $next_month, $next_year);
                }
                $tmpday++;
            }
        }
        
        $total = 0;
        
        // Print Total hours
        for ($iter_day = 0; $iter_day < 7; $iter_day++)
        {
            $showsum = $iter_day == 6;
            $total += $total_per_day[$iter_day];
            print_total_hours_per_day($total_per_day[$iter_day], $showsum, $total);
        }
    }
    else if ($action == 'show_week')
    {
        global $firstdaytoshow;
        
        $total = 0;
        
        for ($iter_day = 0; $iter_day < 7; $iter_day++)
        {
            // Show days of the current week
            //$curtime = dol_time_plus_duree($firstdaytoshow, $iter_day, 'd'); // this function is bugged on week view (when week start from Sunday 29 Oct 2017)
            $curtime = strtotime('+'.$iter_day.' day', $firstdaytoshow);
            $tmparray = dol_getdate($curtime, true);
            $tmpday = $tmparray['mday'];
            $tmpmonth = $tmparray['mon'];
            $tmpyear = $tmparray['year'];
            
            $showsum = $iter_day == 6;
            $total_perd_day = get_total_hours_per_day($timesheetsarray, $tmpday, $tmpmonth, $tmpyear);
            $total += $total_perd_day;
            print_total_hours_per_day($total_perd_day, $showsum, $total);
        }
    }
    else// if ($action == 'show_day')
    {
        $total_perd_day = get_total_hours_per_day($timesheetsarray, $day, $month, $year);
        print_total_hours_per_day($total_perd_day);
    }
    
    print "</tr>\n";
}

/**
 * print the total hours per day
 *
 * @param 	int		$total_per_day    Total time diff per day in minutes
 * @return	void
 */
function print_total_hours_per_day($total_per_day, $showsum=0, $total=0)
{
    global $langs;
    
    print '<td align="center">';
    
    $none = '';

    // Total hours per day
    print $total_per_day > 0 ? timesheet_sum($total_per_day) : $none;

    if ($showsum && $total > 0) {
        // Sum
        print "<br>";
        print $langs->trans("SumOfTotalHours").': '.timesheet_sum($total);
        print "</td>\n";
    }
    else {
        print "<br><br></td>\n";
    }
}

/**
 * get the total hours per day
 *
 * @param 	array		$timesheetsarray    Array of timesheets
 * @return	void
 */
function get_total_hours_per_day($timesheetsarray, $day, $month, $year)
{
    $total_per_day = 0;

    foreach ($timesheetsarray as $daykey => $notused)
    {
            $annee = date('Y',$daykey);
            $mois = date('m',$daykey);
            $jour = date('d',$daykey);
            //print $annee.'-'.$mois.'-'.$jour.' '.$year.'-'.$month.'-'.$day."<br>\n";

            if ($day==$jour && $month==$mois && $year==$annee)	// Is it the day we are looking for when calling function ?
            {
                    // Scan all timesheet for this date
                    foreach ($timesheetsarray[$daykey] as $index => $timesheet)
                    {
                        $total_per_day += $timesheet->time_diff;
                    }

                    break;
            }
    }

    return $total_per_day;
}
