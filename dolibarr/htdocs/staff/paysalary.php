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

/**
 * \file    mypage.php
 * \ingroup mymodule
 * \brief   Example PHP page.
 *
 * Put detailed description here.
 */

// Load Dolibarr environment
$mod_path = "";
if (false === (@include '../main.inc.php')) {  // From htdocs directory
	require '../../main.inc.php'; // From "custom" directory
        $mod_path = "/custom";
}

global $db, $langs, $user, $conf;

if ($user->rights->staff->perms->full) $user->admin = 1;

require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';
dol_include_once('/staff/class/staff.class.php');

// Load translation files required by the page
$langs->load("errors");
$langs->load("staff@staff");

// Get parameters
$action = GETPOST('action', 'alpha');
$start_period=GETPOST('sp') ? dol_mktime(0, 0, 0, GETPOST('spmonth'), GETPOST('spday'), GETPOST('spyear')) : '';
$end_period=GETPOST('ep') ? dol_mktime(0, 0, 0, GETPOST('epmonth'), GETPOST('epday'), GETPOST('epyear')) : '';
$userid=GETPOST('userid','int');
$amountperhour=GETPOST('amountperhour');

// Access control
if (!$user->admin) {
	// External user
	accessforbidden();
}

// Default action
if (empty($action)) {
	$action='create';
}

/*
 * ACTIONS
 *
 * Put here all code to do according to value of "action" parameter
 */

if ($action == 'pay')
{
    if (empty($start_period)) {
            setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("DateStartPeriod")), 'errors');
            $error++;
    }
    if (empty($end_period)) {
            setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("DateEndPeriod")), 'errors');
            $error++;
    }
    else if ($start_period == $end_period) {
            setEventMessage($langs->transnoentities("StartPeriodEqualEndPeriod"), 'errors');
            $error++;
    }
    else if ($start_period > $end_period) {
            setEventMessage($langs->transnoentities("StartPeriodBiggerThenEndPeriod"), 'errors');
            $error++;
    }
    if (empty($userid) || $userid <= 0) {
        setEventMessage($langs->transnoentities("ErrorFieldRequired",$langs->transnoentities("Staff")), 'errors');
        $error++;
    }
    
    if (! $error)
    {
        $staff = new Staff($db);

        $amount = $staff->getPaymentAmount($userid, $amountperhour, $start_period, $end_period);
        
        $datespday = GETPOST('spday');
        $datespmonth = GETPOST('spmonth');
        $datespyear = GETPOST('spyear');
        
        $dateepday = GETPOST('epday');
        $dateepmonth = GETPOST('epmonth');
        $dateepyear = GETPOST('epyear');
        
        $param = '&caller=staffpaysalary';
        $param.= '&datespday='.$datespday.'&datespmonth='.$datespmonth.'&datespyear='.$datespyear;
        $param.= '&dateepday='.$dateepday.'&dateepmonth='.$dateepmonth.'&dateepyear='.$dateepyear;
        $param.= '&fk_user='.$userid.'&amount='.$amount;
        $param.= '&label='.$langs->trans('Wages');
        
        $dol_version = explode('.', DOL_VERSION);
        $salary_path = (int)$dol_version[0] >= 11 ? '/salaries' : '/compta/salaries';
        header('Location: '.DOL_URL_ROOT.$salary_path.'/card.php?leftmenu=tax_salary&action=create'.$param);
        exit();
    }
    
    $action = 'create';
}

/*
 * VIEW
 *
 * Put here all code to build page
 */

$moreheadjs = '<script type="text/javascript" src="'.DOL_URL_ROOT.$mod_path.'/staff/js/paysalary.js.php"></script>';

llxHeader($moreheadjs,$langs->trans('PaySalary'),'');

$form = new Form($db);

/**
 * *******************************************************************
 *
 * Creation mode
 *
 * *******************************************************************
 */
if ($action == 'create')
{
    print load_fiche_titre($langs->trans('PaySalary'), '', 'title_accountancy');
    
    print '<form name="paysalary" action="' . $_SERVER["PHP_SELF"] . '" method="POST">';
    print '<input type="hidden" name="token" value="' . $_SESSION ['newtoken'] . '">';
    print '<input type="hidden" name="action" value="pay">';

    dol_fiche_head();
    
    // Pay salary summary
    print $langs->trans('PaySalarySummary');
    
    print '<table class="border" width="100%">';
    
    // Date Start Period
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('DateStartPeriod') . '</td><td colspan="2">';
    print $form->select_date($start_period, 'sp', 0, 0, 1, '', 1, 1, 1);
    print '</td></tr>';
    
    // Date End Period
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('DateEndPeriod') . '</td><td colspan="2">';
    print $form->select_date($end_period, 'ep', 0, 0, 1, '', 1, 1, 1);
    print '</td></tr>';
    
    // Staff
    print '<tr><td class="fieldrequired" width="25%">' . $langs->trans('Staff') . '</td><td colspan="2">';
    print $form->select_dolusers($userid, 'userid', 1, '', 0, '', '', 0, 0, 0, 'AND employee = 1');
    print '</td></tr>';
    
    // Amount Per Hour
    print '<tr><td width="25%">' . $langs->trans('AmountPerHour') . '</td><td colspan="2">';
    print '<input size="12" id="amountperhour" name="amountperhour" value="'.$amountperhour.'">';
    print ' '.info_admin($langs->trans("AmountPerHourSummary"),1);
    print '</td></tr>';
    
    print '</table>';
    
    dol_fiche_end();
    
    print '<div class="center">';
    print '<input type="submit" class="button" value="' . $langs->trans("ContinuePayment") . '">';
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
