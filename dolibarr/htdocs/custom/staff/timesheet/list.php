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

// Load translation files required by the page
$langs->load("errors");
$langs->load("staff@staff");

// Get parameters
$search_ref=GETPOST('search_ref');
$userid=GETPOST('userid','int');
//$username = GETPOST('username','alpha');
$date=dol_mktime(0, 0, 0, GETPOST('datemonth'), GETPOST('dateday'), GETPOST('dateyear'));
$status = GETPOST('status','alpha');
$optioncss = GETPOST('optioncss','alpha');
$type=GETPOST('type','alpha');

$page  = GETPOST('page','int') ? GETPOST('page','int') : 0;
$socid = GETPOST('socid','int');
$sortorder = GETPOST('sortorder','alpha');
$sortfield = GETPOST('sortfield','alpha');
$limit = GETPOST("limit") ? GETPOST("limit","int") : $conf->liste_limit;

$action = GETPOST('action','alpha');
$id = GETPOST('id','int');

// Initialize technical object to manage hooks of thirdparties. Note that conf->hooks_modules contains array array
$hookmanager->initHooks(array('timesheetlist'));

// Access control
if (!$user->rights->staff->timesheet->read || ($type == 'planned_shift' && !$user->rights->staff->plannedshift->read)) {
	// External user
	accessforbidden();
}
else if (!$user->employee) {
        // Non staff user
        accessforbidden($langs->trans('AccessDeniedToNonStaffUser'));
}

// Purge search criteria
/*
//if (GETPOST("button_removefilter_x") || GETPOST("button_removefilter")) // Both test are required to be compatible with all browsers
if (isset($_POST["button_removefilter_x"]) || isset($_POST["button_removefilter"])) // Both test are required to be compatible with all browsers
{
    $search_ref='';
    $userid=-1;
    //$username='';
    $date='';
    $status='';
}
*/
$timesheetstatic = $type == 'planned_shift' ? new PlannedShift($db) : new Timesheet($db);

$now = dol_now();

/*
 * ACTIONS
 *
 * Put here all code to do according to value of "action" parameter
 */



/*
 * VIEW
 *
 * Put here all code to build page
 */

$form=new Form($db);

$title = $type == 'planned_shift' ? $langs->trans('PlannedShifts') : $langs->trans('Timesheets');
if ($status != '' && $status != '-1') {
    $title.= ' - ' . $timesheetstatic->labelstatut_short[$status];
}

$headjs=empty($conf->use_javascript_ajax) ? "" : "
<script type=\"text/javascript\">
    $(document).ready(function() {
        // Fix list limit
        $('.selectlimit').change(function(e) {
            e.stopPropagation();
            $('#listlimit').val($(this).val());
            $('form[name=listactionsfilter]').submit();
        });
    });
</script>";

llxHeader($headjs, $title, '');

$param="";
if ($type != '') $param.='&type='.$type;

$head = timesheet_prepare_head($param, $mod_path);

$tabactive='cardlist';

$tabtitle = $type == 'planned_shift' ? $langs->trans('PlannedShift') : $langs->trans('Timesheet');

if ($optioncss != 'print')
{
    dol_fiche_head($head, $tabactive, $tabtitle, 0, empty($type) ? 'timesheet@staff' : 'plannedshift@staff');
    print_list_filter($form, $search_ref, $userid, $date, $status, $type);
    dol_fiche_end();
}

if ($sortorder == "") $sortorder="DESC";
if ($sortfield == "") $sortfield="t.day, t.start_time, t.end_time";
$offset = $limit * $page;

/*
 * Mode list
 */

$sql = 'SELECT ';
$sql.= ' t.rowid, t.origin, t.ref, t.entity, t.day,';
$sql.= ' time_format(t.start_time,"%H:%i") as start_time,';
$sql.= ' time_format(t.end_time,"%H:%i") as end_time,';
$sql.= ' t.time_diff,';
$sql.= ' t.fk_user,';
$sql.= ' t.created_by,';
//if ($username) $sql.= ' u.lastname,';
$sql.= ' t.note,';
$sql.= ' t.payment_id,';
$sql.= ' t.status';
$sql.= ' FROM '.MAIN_DB_PREFIX.'staff_timesheet as t';
//if ($username) $sql.= " LEFT JOIN ".MAIN_DB_PREFIX."user as u ON u.rowid = t.fk_user";
$sql.= " WHERE t.entity IN(".getEntity('user', 1).")"; // t.entity = $conf->entity;
$sql.= $type == 'planned_shift' ? PlannedShift::getFilter($type) : Timesheet::getFilter($type);
if (! $user->admin)
{
        $sql.= " AND t.fk_user = ".$user->id;
}
if ($search_ref)
{
        $ref = $search_ref;
        $before_ref = '%';
        if ($type == 'planned_shift') {
            $ref = str_replace($conf->global->PLANNED_SHIFT_REF_PREFIX, '__', $search_ref);
            $before_ref = $ref != $search_ref ? '' : '%';
        }
	//$sql .= natural_search('t.ref', $ref);
        $sql.= " AND t.ref LIKE '".$before_ref.$ref."%'";
}
if ($userid > 0)
{
        $sql.= " AND t.fk_user = ".$userid;
}
/*if ($username)
{
        $sql .= natural_search('u.lastname', $username);
}*/
if ($date)
{
        $sql.= " AND t.day = date('".$db->idate($date)."')";
}
if ($status != '' && $status >= 0)
{
        if ($status == Timesheet::STATUS_NOT_PAID) {
            $sql .= " AND t.status IN (".Timesheet::STATUS_PENDING.", ".Timesheet::STATUS_VALIDATED.") AND t.payment_id IS NULL";
        }
        else {
            $sql .= " AND t.status IN (".$status.")";
        }
}

$sql.= $db->order($sortfield,$sortorder);

$nbtotalofrecords = 0;
if (empty($conf->global->MAIN_DISABLE_FULL_SCANLIST))
{
	$result = $db->query($sql);
	$nbtotalofrecords = $db->num_rows($result);
}

$sql.= $db->plimit($limit+1, $offset);

$resql = $db->query($sql);
if ($resql)
{

	$num = $db->num_rows($resql);
	$i = 0;
        
        if ($limit > 0 && $limit != $conf->liste_limit) $param.='&limit='.urlencode($limit);
	if ($search_ref) $param.="&search_ref=".$search_ref;
	//if ($userid > 0) $param.="&userid=".$userid;
        if ($username) $param.="&username=".$username;
	if ($status >= 0) $param.="&status=".$status;
	if ($optioncss != '') $param.='&optioncss='.$optioncss;
        
        /*
        print '<form action="'.$_SERVER["PHP_SELF"].'" method="POST">';
        if ($optioncss != '') print '<input type="hidden" name="optioncss" value="'.$optioncss.'">';
        print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
        print '<input type="hidden" name="action" value="list">';
	print '<input type="hidden" name="sortfield" value="'.$sortfield.'">';
	print '<input type="hidden" name="sortorder" value="'.$sortorder.'">';
        print '<input type="hidden" name="type" value="'.$type.'">';
        */
        
        print_barre_liste($title, $page, $_SERVER["PHP_SELF"], $param, $sortfield, $sortorder, '', $num, $nbtotalofrecords, empty($type) ? 'object_timesheet-48@staff' : 'object_plannedshift-48@staff', 0, '', '', $limit);
        
        print '<table class="liste noborder" width="100%">';
	print '<tr class="liste_titre">';
	print_liste_field_titre($langs->trans("Ref"),$_SERVER["PHP_SELF"],"t.ref","",$param,'',$sortfield,$sortorder);
	print_liste_field_titre($langs->trans("StartTime"),$_SERVER["PHP_SELF"],"t.start_time","",$param,'',$sortfield,$sortorder);
	print_liste_field_titre($langs->trans("EndTime"),$_SERVER["PHP_SELF"],"t.end_time","",$param,'',$sortfield,$sortorder);
	print_liste_field_titre($langs->trans("TotalHours"),$_SERVER["PHP_SELF"],"t.time_diff","",$param,'',$sortfield,$sortorder);
        if (empty($type)) print_liste_field_titre($langs->trans("Note"),$_SERVER["PHP_SELF"],"t.note","",$param,'',$sortfield,$sortorder);
        print_liste_field_titre($langs->trans("Staff"),$_SERVER["PHP_SELF"],"t.fk_user","",$param,'',$sortfield,$sortorder);
	print_liste_field_titre($langs->trans("Date"),$_SERVER["PHP_SELF"],"t.day, t.start_time, t.end_time","",$param,'align="center"',$sortfield,$sortorder);
        print_liste_field_titre($langs->trans('Status'),$_SERVER["PHP_SELF"],'t.status','',$param,'align="right"',$sortfield,$sortorder,'');
	print_liste_field_titre('',$_SERVER["PHP_SELF"],"",'','','',$sortfield,$sortorder,'maxwidthsearch ');
	print "</tr>\n";

        /*
        print '<tr class="liste_titre liste_titre_filter">';

        print '<td class="liste_titre"><input size="8" type="text" class="flat" name="search_ref" value="'.$search_ref.'"></td>';
        print '<td class="liste_titre"></td>';
        print '<td class="liste_titre"></td>';
        print '<td class="liste_titre"></td>';
        if (empty($type)) print '<td class="liste_titre"></td>';
        print '<td class="liste_titre">';
        //print print $form->select_dolusers($userid, 'userid', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1');
        print '<input size="8" type="text" class="flat" name="username" value="'.$username.'">';
        print '</td>';
        print '<td class="liste_titre" align="center">';
	print $form->select_date($date, 'date', 0, 0, 1, '', 1, 0, 1);
	print '</td>';
        print '<td class="liste_titre" align="right">';
        print '<select class="flat" name="status">';
        print '<option value="-1">&nbsp;</option>';
        $selected = $status != '' ? $status : -1;
        foreach($timesheetstatic->labelstatut_short as $key => $value)
        {
                print '<option value="'.$key.'"'.(($selected == $key || $selected == $value)?' selected':'').'>';
                print $value;
                print '</option>';
        }
        print '</select>';
        print '</td>';
        print '<td class="liste_titre" align="right"><input type="image" class="liste_titre" name="button_search" src="'.img_picto($langs->trans("Search"),'search.png','','',1).'" value="'.dol_escape_htmltag($langs->trans("Search")).'" title="'.dol_escape_htmltag($langs->trans("Search")).'">';
        print '<input type="image" class="liste_titre" name="button_removefilter" src="'.img_picto($langs->trans("Search"),'searchclear.png','','',1).'" value="'.dol_escape_htmltag($langs->trans("RemoveFilter")).'" title="'.dol_escape_htmltag($langs->trans("RemoveFilter")).'">';
        print "</td></tr>\n";
        */
        
        $var=true;
        
        $userstatic = new User($db);
        
        $compare_status = $type == 'planned_shift' ? PlannedShift::STATUS_WAITING_TO_CONFIRM : Timesheet::STATUS_PENDING;
        $nowarray=dol_getdate($now);
        $nowyear=$nowarray['year'];
        $nowmonth=$nowarray['mon'];
        $nowday=$nowarray['mday'];
        $now = dol_mktime(0, 0, 0, $nowmonth, $nowday, $nowyear);
        
        while ($i < min($num,$limit))
	{
                $obj = $db->fetch_object($resql);
                
                $var=!$var;
                
                print "<tr ".$bc[$var]." id=\"line".($i+1)."\">";
                
                // Ref
                $timesheetstatic->id = $obj->rowid;
                $timesheetstatic->ref = $obj->ref;
                $timesheetstatic->origin = $obj->origin;
                $timesheetstatic->created_by = $obj->created_by;
                print '<td class="nobordernopadding nowrap">';
                print $timesheetstatic->getNomUrl($mod_path, 1);
		print '</td>'."\n";
                
                if ($type == 'planned_shift')
                {
                    $allow_modify = $user->admin || ($obj->status != PlannedShift::STATUS_WAITING_TO_CONFIRM && $user->rights->staff->timesheet->modify);
                }
                else
                {
                    $allow_modify = $user->admin || ($obj->status == Timesheet::STATUS_VALIDATED && $user->rights->staff->timesheet->modify);
                }
                
                // Start time
		print '<td>';
                if ($action == 'editstarttime' && $id == $obj->rowid && $allow_modify) {
                    print '<form name="editstarttime" action="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/card.php" method="post">';
                    print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
                    print '<input type="hidden" name="action" value="setstarttime">';
                    print '<input type="hidden" name="id" value="'.$obj->rowid.'">';
                    print '<input type="hidden" name="type" value="'.$type.'">';
                    print '<input type="hidden" name="caller" value="list">';
                    print '<input type="hidden" name="line" value="'.($i+1).'">';
                    print '<input type="hidden" name="status" value="'.$status.'">';
                    print $form->select_date(strtotime($obj->start_time),'ap',1,1,0,'',0,0);
                    print ' <input type="submit" class="button" value="' . $langs->trans('Modify') . '">';
                    print '</form>';
                }
                else {
                    print $obj->start_time;
                    if ($allow_modify) {
                        print ' <a href="'.$_SERVER["PHP_SELF"].'?action=editstarttime&id='.$obj->rowid.'&type='.$type.'&status='.$status.'#line'.($i+1).'">'.img_edit($langs->trans('Modify')).'</a>';
                    }
                }
		print '</td>'."\n";
                
                // End time
		print '<td>';
                if ($action == 'editendtime' && $id == $obj->rowid && $allow_modify) {
                    print '<form name="editendtime" action="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/card.php" method="post">';
                    print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
                    print '<input type="hidden" name="action" value="setendtime">';
                    print '<input type="hidden" name="id" value="'.$obj->rowid.'">';
                    print '<input type="hidden" name="type" value="'.$type.'">';
                    print '<input type="hidden" name="caller" value="list">';
                    print '<input type="hidden" name="line" value="'.($i+1).'">';
                    print '<input type="hidden" name="status" value="'.$status.'">';
                    print $form->select_date(strtotime($obj->end_time),'ef',1,1,0,'',0,0);
                    print ' <input type="submit" class="button" value="' . $langs->trans('Modify') . '">';
                    print '</form>';
                }
                else {
                    if ($obj->end_time) {
                        print $obj->end_time;
                    }
                    else {
                        print '-';
                    }
                    
                    if ($allow_modify) {
                        print ' <a href="'.$_SERVER["PHP_SELF"].'?action=editendtime&id='.$obj->rowid.'&type='.$type.'&status='.$status.'#line'.($i+1).'">'.img_edit($langs->trans('Modify')).'</a>';
                    }
                }
		print '</td>'."\n";
                
                // Total hours
                $timesheetstatic->time_diff = $obj->time_diff;
		print '<td>';
		print $timesheetstatic->getTotalHours();
		print '</td>'."\n";
                
                if (empty($type))
                {
                    // Note
                    print '<td>';
                    if ($obj->note) {
                        print $obj->note;
                    }
                    else {
                        print '-';
                    }
                    print '</td>'."\n";
                }
                
                // Staff
                $userstatic->fetch($obj->fk_user);
		print "<td>";
		print $userstatic->getNomUrl(1);
		print "</td>";
                
                // Date
		print '<td align="center">';
                $day = date('w', $db->jdate($obj->day)); // 0 (pour dimanche) à 6 (pour samedi) / (0 for Sunday, 6 for Saturday)
                print $langs->trans("Day".$day).' ';
                print dol_print_date($db->jdate($obj->day),"day");
                //print ' {'.$db->jdate($obj->day).' - '.$now.'}';
                if ($obj->status == $compare_status && $db->jdate($obj->day) < $now)
                {
                    print img_warning($langs->trans('Late'));
                }
                print '</td>';
                
                // Status
		print '<td align="right">';
                print $timesheetstatic->LibStatut($obj->status, 5);
                print '</td>';
                
                // Authorise/Validate (only admin) - Confirm / Submit
                if ($type == 'planned_shift' || ($obj->status == Timesheet::STATUS_PENDING && ($user->admin || $user->rights->staff->timesheet->validate)))
                {
                    $act = $type == 'planned_shift' ? ($obj->status == PlannedShift::STATUS_WAITING_TO_CONFIRM ? 'confirm_plannedshift' : 'confirm_submit') : 'confirm_validate';
                    $title = $type == 'planned_shift' ? ($obj->status == PlannedShift::STATUS_WAITING_TO_CONFIRM ? $langs->trans("Confirm") : $langs->trans("Submit")) : $langs->trans("Validate");
                    print '<td align="right">';
                    print '<a href="'.DOL_URL_ROOT.$mod_path.'/staff/timesheet/card.php?id='.$obj->rowid.'&action='.$act.'&confirm=yes&type='.$type.'&status='.$status.'&caller=list&line='.($i+1).'">';
                    print img_picto($title, 'tick');
                    print '</a>';
                    print '</td>';
                }
                else
                {
                    print '<td></td>';
                }
                
                print "</tr>\n";
		$i++;
        }
        
        print "</table>\n";
	//print "</form>\n";
        
        $db->free($resql);
}
else
{
	dol_print_error($db);
}

// End of page
llxFooter();
$db->close();
