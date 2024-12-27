<?php

include_once DOL_DOCUMENT_ROOT .'/admin/dolistore/class/dolistore.class.php';

/**
 * Prepare array with list of tabs
 *
 * @param   object	$object		Object related to tabs
 * @return  array				Array of tabs to show
 */
function timesheet_card_prepare_head($object, $path, $type='')
{
	global $langs, $conf, $user;
	$langs->load("staff@staff");

	$h = 0;
	$head = array();

	$head[$h][0] = DOL_URL_ROOT.$path.'/staff/timesheet/card.php?id='.$object->id.'&type='.$type;
	$head[$h][1] = $langs->trans('Card');
	$head[$h][2] = 'card';
	$h++;

    $head[$h][0] = DOL_URL_ROOT.$path.'/staff/timesheet/log.php?id='.$object->id.'&type='.$type;
	$head[$h][1] = $langs->trans('Log');
	$head[$h][2] = 'log';
	$h++;

    // Show more tabs from modules
    // Entries must be declared in modules descriptor with line
    // $this->tabs = array('entity:+tabname:Title:@mymodule:/mymodule/mypage.php?id=__ID__');   to add new tab
    // $this->tabs = array('entity:-tabname);   												to remove a tab
    complete_head_from_modules($conf,$langs,$object,$head,$h,'timesheet');

	//complete_head_from_modules($conf,$langs,$object,$head,$h,'timesheet','remove');

	return $head;
}

/**
 *  Define head array for tabs of timesheet setup pages
 *
 *  @param	string	$param		Parameters to add to url
 *  @param	string	$path		Module path ('/custom' or '')
 *  @return array			    Array of head
 */
function timesheet_prepare_head($param, $path)
{
    global $langs, $conf, $user;

    $h = 0;
    $head = array();

    $head[$h][0] = DOL_URL_ROOT.$path.'/staff/timesheet/index.php?action=show_day'.($param?'&'.$param:'');
    $head[$h][1] = $langs->trans("StaffViewDay");
    $head[$h][2] = 'cardday';
    $h++;

    $head[$h][0] = DOL_URL_ROOT.$path.'/staff/timesheet/index.php?action=show_week'.($param?'&'.$param:'');
    $head[$h][1] = $langs->trans("StaffViewWeek");
    $head[$h][2] = 'cardweek';
    $h++;

    $head[$h][0] = DOL_URL_ROOT.$path.'/staff/timesheet/index.php?action=show_month'.($param?'&'.$param:'');
    $head[$h][1] = $langs->trans("StaffViewCal");
    $head[$h][2] = 'cardmonth';
    $h++;
    
    if ($user->admin)
    {
        $head[$h][0] = DOL_URL_ROOT.$path.'/staff/timesheet/peruser.php'.($param?'?'.$param:'');
        $head[$h][1] = $langs->trans("StaffViewPerUser");
        $head[$h][2] = 'cardperuser';
        $h++;
    }
    
    $head[$h][0] = DOL_URL_ROOT.$path.'/staff/timesheet/list.php'.($param?'?'.$param:'');
    $head[$h][1] = $langs->trans("StaffViewList");
    $head[$h][2] = 'cardlist';
    $h++;
    
    // Show more tabs from modules
    // Entries must be declared in modules descriptor with line
    // $this->tabs = array('entity:+tabname:Title:@mymodule:/mymodule/mypage.php?id=__ID__');   to add new tab
    // $this->tabs = array('entity:-tabname);   												to remove a tab
    $object=new stdClass();
    
    complete_head_from_modules($conf,$langs,$object,$head,$h,'timesheet');

    //complete_head_from_modules($conf,$langs,$object,$head,$h,'timesheet','remove');

    return $head;
}

/**
 * Show submit/modify form in timesheet view
 *
 * @param	Object	$form			Form object
 * @param 	int		$year			Year
 * @param 	int		$month			Month
 * @param 	int		$day			Day
 * @param	string	$action			Action string
 * @param	string	$type			'' (if timesheet) or 'planned_shift'
 * @return	void
 */
function print_timesheet_form($form, $year, $month, $day, $action, $type='')
{
	global $db, $conf, $user, $langs, $mod_path;//, $hookmanager;
        
    $userid = GETPOST('userid');
    
    print '<form name="listactionsfilter" class="listactionsfilter" action="' . $_SERVER["PHP_SELF"] . '" method="post">';
    print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
    print '<input type="hidden" name="year" value="' . $year . '">';
    print '<input type="hidden" name="month" value="' . $month . '">';
    print '<input type="hidden" name="day" value="' . $day . '">';
    print '<input type="hidden" name="action" value="' . $action . '">';
    print '<input type="hidden" name="type" value="' . $type . '">';

	print '<div class="fichecenter">';

	if (! empty($conf->browser->phone)) print '<div class="fichehalfleft">';
	else print '<table class="nobordernopadding" width="100%"><tr><td class="borderright">';

	print '<table class="nobordernopadding centpercent">';
        
        // Date
        print '<tr>';
        print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
        print $langs->trans("Date").' &nbsp; ';
        print '</td><td class="nowrap" style="padding-bottom: 2px;">';
        $dateselect = dol_mktime(0, 0, 0, GETPOST('dateselectmonth'), GETPOST('dateselectday'), GETPOST('dateselectyear'));
        print $form->select_date($dateselect, 'dateselect', 0, 0, 1, '', 1, 1, 1);
        print '</td></tr>';

        if ($user->admin)
        {
            // User / Staff
            print '<tr>';
            print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
            print $langs->trans("Staff").' &nbsp; ';
            print '</td><td class="nowrap" style="padding-bottom: 2px;">';
            print $form->select_dolusers($userid, 'userid', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1');
            print '</td></tr>';
        }

        // Status
        print '<tr>';
        print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
        print $langs->trans("Status").' &nbsp; ';
        print '</td><td class="nowrap" style="padding-bottom: 2px;">';
        print '<select class="flat" name="status">';
        print '<option value="-1">&nbsp;</option>';
        $status = GETPOST('status');
        $selected = $status != '' ? $status : -1;
        $timesheetstatic = $type == 'planned_shift' ? new PlannedShift($db) : new Timesheet($db);
        foreach($timesheetstatic->labelstatut_short as $key => $value)
        {
                print '<option value="'.$key.'"'.(($selected == $key || $selected == $value)?' selected':'').'>';
                print $value;
                print '</option>';
        }
        print '</select>';
        print '</td></tr>';
        
    	// Hooks
    	//$parameters = array('canedit'=>$canedit, 'pid'=>$pid, 'socid'=>$socid);
    	//$reshook = $hookmanager->executeHooks('submitTimesheetFrom', $parameters, $object, $action); // Note that $action and $object may have been

    	print '</table>';

    	if (! empty($conf->browser->phone)) print '</div>';
    	else print '</td>';

    	if (! empty($conf->browser->phone)) print '<div class="fichehalfright">';
    	else print '<td align="center" valign="middle" class="nowrap">';

        // Action buttons
        print '<table class="centpercent"><tr><td align="center">';
        print '<div class="formleftzone">';
        $morebuttons = '';
        if ($user->admin)
        {
            //$morebuttons.= '<br><br>';
            $morebuttons.= '<a class="butAction" style="min-width:100px" href="' . DOL_URL_ROOT . $mod_path . '/staff/sendmail.php?action=' . $action . '&type=' . $type . '&usertoid=' . $userid . '&day=' . $day . '&month=' . $month . '&year=' . $year . '&mode=init&test=-1">';
            $morebuttons.= img_picto('', 'email@staff', 'style="vertical-align: middle;"').' '.$langs->trans('SendByEmail');
            $morebuttons.= '</a>';
        }
        print_actions_button($action, $type, $morebuttons);
        print '</div>';
    	print '</td></tr>';
    	print '</table>';

    	if (! empty($conf->browser->phone)) print '</div>';
    	else print '</td></tr></table>';

    	print '</div>';	// Close fichecenter
    	print '<div style="clear:both"></div>';
        
        print '</form>';
}

/**
 * Show print button
 *
 * @param       $class          CSS class (ex: 'button', 'butAction')
 * @return	void
 */
function show_print_button($newline=1,$class='butAction')
{
    global $langs;
    
    $qs = dol_escape_htmltag($_SERVER["QUERY_STRING"]);

    foreach($_POST as $key => $value) {
        if (! is_array($value)) $qs.='&'.$key.'='.urlencode($value);
    }

    //$qs.=(($qs && $morequerystring)?'&':'').$morequerystring;

    if ($newline) print '<br><br>';
    print '<a class="'.$class.'" style="min-width: 120px; padding: 0.5em 0;" href="'.dol_escape_htmltag($_SERVER["PHP_SELF"]).'?'.$qs.($qs?'&':'').'optioncss=print" target="_blank">';
    print img_picto('', 'printer@staff', 'class="printer" style="vertical-align: middle;"');
    print ' '.$langs->trans("Print");
    print '</a>';
}

/**
 * Print actions button
 *
 * @return	void
 */
function print_actions_button($action, $type, $morebuttons='')
{
    global $langs;
    
    //print '<input type="submit" class="butAction" style="min-width:120px" name="refresh" value="' . $langs->trans("Refresh") . '">';
    print '<button type="submit" class="butAction" style="min-width:120px" name="refresh">';
    print img_picto('','search@staff', 'style="vertical-align: middle;"').' '.$langs->trans("Refresh");
    print '</button>';
    
    //print '<input type="submit" class="butAction" style="min-width:120px" name="button_removefilter" value="' . $langs->trans("Clear") . '">';
    /*print '<button type="submit" class="butAction" style="min-width:120px" name="button_removefilter">';
    print img_picto('','searchclear.png', 'style="vertical-align: middle;"').' '.$langs->trans("Clear");
    print '</button>';*/
    print '<a class="butAction" style="min-width:100px" href="'.$_SERVER["PHP_SELF"].'?action='.$action.'&type='.$type.'">';
    print img_picto('', 'searchclear@staff', 'style="vertical-align: middle;"').' '.$langs->trans('Clear');
    print '</a>';
    
    show_print_button();
    
    if (! empty($morebuttons)) {
        print $morebuttons;
    }
}

/**
 * Show filter form in agenda view
 *
 * @param	Object	$form			Form object
 * @param	int		$status			Status
 * @param 	int		$year			Year
 * @param 	int		$month			Month
 * @param 	int		$day			Day
 * @param 	string	$userid                 Filter by user
 * @param	string	$dateselect		Selected date string
 * @param	string	$action			Action string
 * @return	void
 */
function print_actions_filter($form, $status, $year, $month, $day, $userid, $dateselect, $action, $type)
{
	global $db, $conf, $user, $langs;//, $hookmanager;
	global $begin_d, $end_d;

	// Filters
	print '<form name="listactionsfilter" class="listactionsfilter" action="' . $_SERVER["PHP_SELF"] . '" method="post">';
	print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
	print '<input type="hidden" name="year" value="' . $year . '">';
	print '<input type="hidden" name="month" value="' . $month . '">';
	print '<input type="hidden" name="day" value="' . $day . '">';
	print '<input type="hidden" name="action" value="' . $action . '">';
        print '<input type="hidden" name="type" value="' . $type . '">';

	print '<div class="fichecenter">';

	if (! empty($conf->browser->phone)) print '<div class="fichehalfleft">';
	else print '<table class="nobordernopadding" width="100%"><tr><td class="borderright">';

	print '<table class="nobordernopadding centpercent">';

	if ($action == 'show_peruser')
	{
        // Date
        print '<tr>';
        print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
        print $langs->trans("Date").' &nbsp; ';
        print '</td><td class="nowrap" style="padding-bottom: 2px;">';
        print $form->select_date($dateselect, 'dateselect', 0, 0, 1, '', 1, 1, 1);
        print '</td></tr>';
        
        // User / Staff
        print '<tr>';
        print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
        print $langs->trans("Staff").' &nbsp; ';
        print '</td><td class="nowrap" style="padding-bottom: 2px;">';
        print $form->select_dolusers($userid, 'userid', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1');
        print '</td></tr>';
        
        // Status
        print '<tr>';
        print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
        print $langs->trans("Status").' &nbsp; ';
        print '</td><td class="nowrap" style="padding-bottom: 2px;">';
        print '<select class="flat" name="status">';
        print '<option value="-1">&nbsp;</option>';
        $selected = $status != '' ? $status : -1;
        $timesheetstatic = $type == 'planned_shift' ? new PlannedShift($db) : new Timesheet($db);
        foreach($timesheetstatic->labelstatut_short as $key => $value)
        {
                print '<option value="'.$key.'"'.(($selected == $key || $selected == $value)?' selected':'').'>';
                print $value;
                print '</option>';
        }
        print '</select>';
        print '</td></tr>';

		// Filter on days
		print '<tr>';
		print '<td class="nowrap">'.$langs->trans("VisibleDaysRange").'</td>';
		print "<td class='nowrap'>";
		print '<div class="ui-grid-a"><div class="ui-block-a">';
		print '<input type="number" class="short" name="begin_d" value="'.$begin_d.'" min="1" max="7">';
		if (empty($conf->dol_use_jmobile)) print ' - ';
		else print '</div><div class="ui-block-b">';
		print '<input type="number" class="short" name="end_d" value="'.$end_d.'" min="1" max="7">';
		print '</div></div>';
		print '</td></tr>';
	}

	// Hooks
	//$parameters = array('canedit'=>$canedit, 'pid'=>$pid, 'socid'=>$socid);
	//$reshook = $hookmanager->executeHooks('searchTimesheetFrom', $parameters, $object, $action); // Note that $action and $object may have been

	print '</table>';

	if (! empty($conf->browser->phone)) print '</div>';
	else print '</td>';

	if (! empty($conf->browser->phone)) print '<div class="fichehalfright">';
	else print '<td align="center" valign="middle" class="nowrap">';

	print '<table class="centpercent"><tr><td align="center">';
	print '<div class="formleftzone">';
	print_actions_button($action, $type);
        print '</div>';
	print '</td></tr>';
	print '</table>';

	if (! empty($conf->browser->phone)) print '</div>';
	else print '</td></tr></table>';

	print '</div>';	// Close fichecenter
	print '<div style="clear:both"></div>';

	print '</form>';
}

/**
 * Show filter form in list view
 *
 * @param	Object	$form			Form object
 * @param	string	$search_ref		Ref
 * @param 	string	$userid                 Filter by user
 * @param	string	$date                   Selected date string
 * @param	int	$status			Status
 * @param	string	$type			'planned_shift' or '' (timesheet)
 * @return	void
 */
function print_list_filter($form, $search_ref, $userid, $date, $status, $type)
{
	global $db, $conf, $user, $langs;//, $hookmanager;
	//global $begin_d, $end_d;
    global $action, $limit;

	// Filters
	print '<form name="listactionsfilter" class="listactionsfilter" action="' . $_SERVER["PHP_SELF"] . '" method="post">';
	print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
    print '<input type="hidden" name="type" value="' . $type . '">';
    print '<input type="hidden" name="limit" id="listlimit" value="' . $limit . '">';

	print '<div class="fichecenter">';

	if (! empty($conf->browser->phone)) print '<div class="fichehalfleft">';
	else print '<table class="nobordernopadding" width="100%"><tr><td class="borderright">';

	print '<table class="nobordernopadding centpercent">';

    // Ref
    print '<tr>';
    print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
    print $langs->trans("Ref").' &nbsp; ';
    print '</td><td class="nowrap" style="padding-bottom: 2px;">';
    print '<input type="text" class="flat" name="search_ref" value="'.$search_ref.'">';
    print '</td></tr>';
    
    if ($user->admin)
    {
        // User / Staff
        print '<tr>';
        print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
        print $langs->trans("Staff").' &nbsp; ';
        print '</td><td class="nowrap" style="padding-bottom: 2px;">';
        print $form->select_dolusers($userid, 'userid', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1');
        print '</td></tr>';
    }
    
    // Date
    print '<tr>';
    print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
    print $langs->trans("Date").' &nbsp; ';
    print '</td><td class="nowrap" style="padding-bottom: 2px;">';
    print $form->select_date($date, 'date', 0, 0, 1, '', 1, 1, 1);
    print '</td></tr>';

    // Status
    print '<tr>';
    print '<td class="nowrap" style="padding-bottom: 2px; padding-right: 4px;">';
    print $langs->trans("Status").' &nbsp; ';
    print '</td><td class="nowrap" style="padding-bottom: 2px;">';
    print '<select class="flat" name="status">';
    print '<option value="-1">&nbsp;</option>';
    $selected = $status != '' ? $status : -1;
    $timesheetstatic = $type == 'planned_shift' ? new PlannedShift($db) : new Timesheet($db);
    foreach($timesheetstatic->labelstatut_short as $key => $value)
    {
            print '<option value="'.$key.'"'.(($selected == $key || $selected == $value)?' selected':'').'>';
            print $value;
            print '</option>';
    }
    print '</select>';
    print '</td></tr>';

	// Hooks
	//$parameters = array('canedit'=>$canedit, 'pid'=>$pid, 'socid'=>$socid);
	//$reshook = $hookmanager->executeHooks('searchTimesheetFrom', $parameters, $object, $action); // Note that $action and $object may have been

	print '</table>';

	if (! empty($conf->browser->phone)) print '</div>';
	else print '</td>';

	if (! empty($conf->browser->phone)) print '<div class="fichehalfright">';
	else print '<td align="center" valign="middle" class="nowrap">';

	print '<table class="centpercent"><tr><td align="center">';
	print '<div class="formleftzone">';
    print_actions_button($action, $type);
    print '</div>';
	print '</td></tr>';
	print '</table>';

	if (! empty($conf->browser->phone)) print '</div>';
	else print '</td></tr></table>';

	print '</div>';	// Close fichecenter
	print '<div style="clear:both"></div>';

	print '</form>';
}

/**
 * Prepare admin pages header
 *
 * @return array
 */
function StaffAdminPrepareHead()
{
	global $langs, $conf;

	$langs->load("staff@staff");

	$h = 0;
	$head = array();

	$head[$h][0] = dol_buildpath("/staff/admin/setup.php", 1);
	$head[$h][1] = $langs->trans("Timesheet").' / '.$langs->trans("PlannedShift");
	$head[$h][2] = 'timesheet_settings';
	$h++;
	$head[$h][0] = dol_buildpath("/staff/admin/about.php", 1);
	$head[$h][1] = $langs->trans("About");
	$head[$h][2] = 'about';
	$h++;

	// Show more tabs from modules
	// Entries must be declared in modules descriptor with line
	//$this->tabs = array(
	//	'entity:+tabname:Title:@mymodule:/mymodule/mypage.php?id=__ID__'
	//); // to add new tab
	//$this->tabs = array(
	//	'entity:-tabname:Title:@mymodule:/mymodule/mypage.php?id=__ID__'
	//); // to remove a tab
	complete_head_from_modules($conf, $langs, $object, $head, $h, 'staff');

	return $head;
}

/**
 * Change color with a delta
 *
 * @param	string	$color		Color
 * @param 	int		$minus		Delta
 * @return	string				New color
 */
function dol_color_minus($color, $minus)
{
	$newcolor=$color;
	$newcolor[0]=((hexdec($newcolor[0])-$minus)<0)?0:dechex((hexdec($newcolor[0])-$minus));
	$newcolor[2]=((hexdec($newcolor[2])-$minus)<0)?0:dechex((hexdec($newcolor[2])-$minus));
	$newcolor[4]=((hexdec($newcolor[4])-$minus)<0)?0:dechex((hexdec($newcolor[4])-$minus));
	return $newcolor;
}

/**
 * Return Sum of total hours of a timesheet
 *
 * @param 	int		$total		Total in minutes
 * @return	string				Sum
 */
function timesheet_sum($total)
{
    global $conf;

	// Sum
    $hours = floor($total / 60);
    $minutes = $total % 60;
    $sum = '';
    if ($hours > 0) $sum.= $hours.$conf->global->TOTAL_HOURS_HOUR_SUFFIX;
    if ($minutes > 0) $sum.= $minutes.$conf->global->TOTAL_HOURS_MIN_SUFFIX;
    
    return $sum;
}

/**
 * Check if the specified date is in this week range (date must be a timestamp)
 *
 * @param 	timestamp		$date		Date to check
 * @return	boolean			true or false
 */
function is_date_in_this_week($date)
{
    $weekStartDate = strtotime('monday this week');
    $weekEndDate = strtotime('sunday this week');
    
    //print $weekStartDate.'----'.$weekEndDate.'----'.$date;
    
    if ($date >= $weekStartDate && $date <= $weekEndDate) {
        return true;
    }
    else {
        return false;
    }
}

/**
 * Print warning message
 *
 * @param 	string      $warning_message    Warning message
 * @return	void
 */
function print_warning($warning_message)
{
    print '<table class="valid" width="100%">';
    print '<tr class="validtitre"><td class="validtitre" colspan="3">';
    print img_picto('','user_warning@staff').' '.$warning_message;
    print '</td></tr>';
    print '<tr class="valid"><td class="valid" colspan="3"></td></tr>';
    print '</table>';
    print '<br>';
}

/**
 * Return info img
 * 
 * @return string info image HTML
 */
function get_info_picto() {
    if (function_exists('version_compare') && version_compare(DOL_VERSION, '13.0.0') >= 0) {
        return '<i class="fa fa-info fa-fw paddingright"></i>';
    } else {
        return img_picto($langs->trans('Note'), 'info_black', 'class="hideonsmartphone"');
    }
}
