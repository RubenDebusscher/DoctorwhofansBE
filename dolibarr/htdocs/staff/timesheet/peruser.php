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
//$action=GETPOST('action','alpha');
$action='show_peruser';
$year=GETPOST("year","int")?GETPOST("year","int"):date("Y");
$month=GETPOST("month","int")?GETPOST("month","int"):date("m");
$week=GETPOST("week","int")?GETPOST("week","int"):date("W");
$day=GETPOST("day","int")?GETPOST("day","int"):date("d");
$status=GETPOST("status");
$userid=GETPOST("userid","int");
$type=GETPOST('type','alpha');
$optioncss = GETPOST('optioncss','alpha');

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

$now=dol_now();

// Access control
if (!$user->admin) {//!$user->rights->staff->timesheet->read || ($type == 'planned_shift' && !$user->rights->staff->plannedshift->read)) {
	// External user
	accessforbidden();
}

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

$param='';
//if ($status || isset($_GET['status']) || isset($_POST['status'])) $param.="&status=".$status;
//if ($action == 'show_day' || $action == 'show_week' || $action == 'show_month') $param.='&action='.$action;
//if ($userid) $param.="&userid=".$userid;
//if ($begin_d) $param.="&begin_d=".$begin_d;
//if ($end_d) $param.="&end_d=".$end_d;
if (! empty($type)) $param.='&type='.$type;
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

$nav ="<a accesskey=\"p\" title=\"$stringforfirstkey p\" class=\"classfortooltip\" href=\"?year=".$prev_year."&amp;month=".$prev_month."&amp;day=".$prev_day.$param."\">".img_previous($langs->trans("Previous"), 'class="valignbottom"')."</a>\n";
$nav.=" <span id=\"month_name\">".dol_print_date(dol_mktime(0,0,0,$first_month,$first_day,$first_year),"%Y").", ".$langs->trans("Week")." ".$week;
$nav.=" </span>\n";
$nav.="<a accesskey=\"n\" title=\"$stringforfirstkey n\" class=\"classfortooltip\" href=\"?year=".$next_year."&amp;month=".$next_month."&amp;day=".$next_day.$param."\">".img_next($langs->trans("Next"), 'class="valignbottom"')."</a>\n";
$nav.=" &nbsp; (<a href=\"?year=".$nowyear."&amp;month=".$nowmonth."&amp;day=".$nowday.$param."\">".$langs->trans("Today")."</a>)";
$picto='calendarweek';

// Must be after the nav definition
$param.='&year='.$year.'&month='.$month.($day?'&day='.$day:'');
//print 'x'.$param;


// Fiche head

$tabactive='';

if ($action == 'show_peruser') $tabactive='cardperuser';

$paramnoaction=preg_replace('/action=[a-z_]+/','',$param);

$head = timesheet_prepare_head($paramnoaction, $mod_path);

if ($optioncss != 'print')
{
    dol_fiche_head($head, $tabactive, $title, 0, empty($type) ? 'timesheet@staff' : 'plannedshift@staff');
    print_actions_filter($form, $status, $year, $month, $day, $userid, $dateselect, $action, $type);
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
// Sort on date
$sql.= ' ORDER BY day, start_time, end_time';
//print $sql;


//dol_syslog("staff/timesheet/peruser.php", LOG_DEBUG);
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

print load_fiche_titre($s, $link.' &nbsp; &nbsp; '.$nav, '');

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

// Line header with list of days

//print "begin_d=".$begin_d." end_d=".$end_d;


echo '<div class="div-table-responsive">';
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

// Define $usernames
$usernames = array(); //init
$usernamesid = array();

/* Use this list to have for all users */
$sql = "SELECT u.rowid, u.employee, u.lastname as lastname, u.firstname, u.statut, u.login, u.admin, u.entity";
$sql.= " FROM ".MAIN_DB_PREFIX."user as u";
//if ($usergroup > 0)	$sql.= " LEFT JOIN ".MAIN_DB_PREFIX."usergroup_user as ug ON u.rowid = ug.fk_user";
$sql.= " WHERE u.statut = 1 AND u.entity IN (".getEntity('user',1).")";
$sql.= " AND u.employee = 1";
if ($userid > 0) $sql.= " AND u.rowid = ".$userid;
//if ($usergroup > 0)	$sql.= " AND ug.fk_usergroup = ".$usergroup;
//if (GETPOST("usertodo","int",3) > 0) $sql.=" AND u.rowid = ".GETPOST("usertodo","int",3);
//print $sql;
$resql=$db->query($sql);
if ($resql)
{
    $num = $db->num_rows($resql);
    $i = 0;
    if ($num)
    {
        while ($i < $num)
        {
            $obj = $db->fetch_object($resql);

            $usernamesid[$obj->rowid]=$obj->rowid;
            $i++;
        }
    }
}
else dol_print_error($db);

//var_dump($usernamesid);
foreach($usernamesid as $id)
{
	$tmpuser=new User($db);
	$result=$tmpuser->fetch($id);
	$usernames[]=$tmpuser;
}

// Loop on each user to show calendar
$todayarray=dol_getdate($now,'fast');
$sav = $tmpday;
$showheader = true;
$var = false;
foreach ($usernames as $username)
{
	$var = ! $var;
	echo "<tr>";
	echo '<td class="cal_current_month cal_peruserviewname'.($var?' cal_impair':'').'">';
	print $username->getNomUrl(-1,'',0,0,24,1,'');
	print '</td>';
	$tmpday = $sav;

	// Lopp on each day of week
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

		show_day_timesheet2($username, $tmpday, $tmpmonth, $tmpyear, $monthshown, $style, $timesheetsarray, $maxnbofchar, $newparam, 1, 300, $showheader, $colorsbytype, $var);
                
		$i++;
	}
	echo "</tr>\n";
        
        show_total_hours2($username, $timesheetsarray);
        
	$showheader = false;
}

echo "</table>\n";
echo '</div>';

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
 * Show event line of a particular day for a user
 *
 * @param	string	$username		Login
 * @param   int		$day            Day
 * @param   int		$month          Month
 * @param   int		$year           Year
 * @param   int		$monthshown     Current month shown in calendar view
 * @param   string	$style          Style to use for this day
 * @param   array	$timesheetsarray    	Array of timesheets
 * @param   int		$maxnbofchar    Nb of characters to show for event line
 * @param   string	$newparam       Parameters on current URL
 * @param   int		$showinfo       Add extended information (used by day view)
 * @param   int		$minheight      Minimum height for each event. 60px by default.
 * @param	boolean	$showheader		Show header
 * @param	array	$colorsbytype	Array with colors by type
 * @param	bool	$var			true or false for alternat style on tr/td
 * @return	void
 */
function show_day_timesheet2($username, $day, $month, $year, $monthshown, $style, &$timesheetsarray, $maxnbofchar=16, $newparam='', $showinfo=0, $minheight=60, $showheader=false, $colorsbytype=array(), $var=false)
{
	global $db;
	global $user, $conf, $langs, $mod_path;//, $hookmanager;
	global $status, $action, $type;	// Filters used into search form
    global $theme_datacolor, $colorindexused;
        
	//$curtime = dol_mktime(0, 0, 0, $month, $day, $year);
    //print '<td class="'.$style.'_peruserleft cal_peruser'.($var?' cal_impair '.$style.'_impair':'').'">';
    print '<td class="'.$style.' cal_peruser'.($var?' cal_impair '.$style.'_impair':'').'">';

	$ymd=sprintf("%04d",$year).sprintf("%02d",$month).sprintf("%02d",$day);
        
    // @ related to multi colors
    $colorindexused[$user->id] = 0;         // Color index for current user (user->id) is always 0
    $nextindextouse=count($colorindexused);	// At first run this is 0, so fist user has 0, next 1, ...
    
    include dol_buildpath('/staff/tpl/timesheet.tpl.php');
    
    print '</td>';
}

/**
 * print the total hours of specified user
 *
 * @param	Object          $username           User
 * @param 	array		$timesheetsarray    Array of timesheets
 * @return	void
 */
function show_total_hours2($username, $timesheetsarray)
{
    global $langs;
    global $begin_d, $end_d;
    global $firstdaytoshow;
    global $type;
    
    // Total hours
    print '<tr class="liste_titre total_hours">';
    print '<td>'.$langs->trans('TotalHours').': <br><br></td>';
    
    $i=0;
    $total = 0;
    
    while ($i < 7)
    {
            if (($i + 1) < $begin_d || ($i + 1) > $end_d)
            {
                    $i++;
                    continue;
            }
            
            print '<td align="center">';
            
            $total_per_day = 0;
            $none = '';
            
            //$curtime = dol_time_plus_duree($firstdaytoshow, $i, 'd');
            $curtime = strtotime('+'.$i.' day', $firstdaytoshow);
            $tmparray = dol_getdate($curtime,'fast');
            $day = $tmparray['mday'];
            $month = $tmparray['mon'];
            $year = $tmparray['year'];
            
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
                                if ($username->id != $timesheet->fk_user) continue;
                                
                                $total_per_day += $timesheet->time_diff;
                                $total += $timesheet->time_diff;
                            }
                            
                            break;
                    }
            }
            
            // Total hours per day
            print $total_per_day > 0 ? timesheet_sum($total_per_day) : $none;
            
            if ($i + 1 == $end_d && $total > 0) {
                // Sum
                print "<br>";
                print $langs->trans("SumOfTotalHours").': '.timesheet_sum($total);
                print "</td>\n";
            }
            else {
                print "<br><br></td>\n";
            }
            
            $i++;
    }
    
    print "</tr>\n";
}
