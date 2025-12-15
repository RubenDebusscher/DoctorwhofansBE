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

require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
//dol_include_once('/staff/class/plannedshift.class.php');
dol_include_once('/staff/class/fixmailbug.class.php');

// Load translation files required by the page
$langs->load("errors");
$langs->load("staff@staff");

// Get parameters
$action = GETPOST('action', 'alpha');
$objectid = GETPOST('id', 'int');
$ref = GETPOST('ref', 'alpha');
$type = GETPOST('type', 'alpha');
$usertoid = GETPOST('usertoid', 'int');
$test = GETPOST('test', 'int') ? GETPOST('test', 'int') : 1;
$day = GETPOST('day', 'int');
$month = GETPOST('month', 'int');
$year = GETPOST('year', 'int');

// Access control
if (!$user->admin) {
	// External user
	accessforbidden();
}

// Object(s) fetch
$userto = new User($db);

if ($usertoid > 0)
{
    $userto->fetch($usertoid);
}

if (in_array($action, array('show_day', 'show_week', 'show_month')))
{
    $url = DOL_MAIN_URL_ROOT.$mod_path.'/staff/timesheet/index.php?action='.$action.'&day='.$day.'&month='.$month.'&year='.$year;
}
else if ($objectid > 0)
{
    $url = DOL_MAIN_URL_ROOT.$mod_path.'/staff/timesheet/card.php?id='.$objectid.'&type='.$type;
}

$link = ! empty($url) ? '<a href="'.$url.'">'.$url.'</a>' : '';

if ($test > 0)
{
    $subject = $langs->trans("TestMailSubject");
    $message = $langs->transnoentities("TestMailTemplate");
}
else
{
    if ($type == 'planned_shift')
    {
        $subject = $langs->trans("PlannedShiftMailSubject");
        $message = $langs->transnoentities("PlannedShiftMailTemplate");
    }
    else
    {
        $subject = $langs->trans("TimesheetMailSubject");
        $message = $langs->transnoentities("TimesheetMailTemplate");
    }
}

$usersignature=$user->signature;
// For action = test or send, we ensure that content is not html, even for signature, because this we want a test with NO html.
if ($action == 'send')
{
	$usersignature=dol_string_nohtmltag($usersignature);
}

$substitutionarray=array(
'__ID__' => $objectid,
'__REF__' => $ref,
'__LOGIN__' => $userto->login,
'__EMAIL__' => $userto->email,
'__LASTNAME__' => $userto->lastname,
'__FIRSTNAME__' => $userto->firstname,
'__SIGNATURE__' => (($user->signature && empty($conf->global->MAIN_MAIL_DO_NOT_USE_SIGN))?$usersignature:''),
'__LINK__' => $link,
//'__PERSONALIZED__' => 'TESTPersonalized'	// Hiden because not used yet
);
complete_substitutions_array($substitutionarray, $langs);

/*
 * ACTIONS
 *
 * Put here all code to do according to value of "action" parameter
 */

// Actions to send emails
$id=0;
$actiontypecode='';
$trigger_name='';
$paramname='id';
$mode='emailforstaff';
$trackid='staff';
$object = new FixMailBug(); // fix bug on dolibarr 3.9
$_POST['receivercc'] = '-1'; // fix bug on dolibarr 3.9
include DOL_DOCUMENT_ROOT.'/core/actions_sendmails.inc.php';

/*
 * VIEW
 *
 * Put here all code to build page
 */

llxHeader('',$langs->trans('SendEmail'),'');

print load_fiche_titre($langs->trans('SendEmail'));

dol_fiche_head();

// Cree l'objet formulaire mail
include_once DOL_DOCUMENT_ROOT.'/core/class/html.formmail.class.php';
$formmail = new FormMail($db);
$formmail->fromtype = (GETPOST('fromtype')?GETPOST('fromtype'):(!empty($conf->global->MAIN_MAIL_DEFAULT_FROMTYPE)?$conf->global->MAIN_MAIL_DEFAULT_FROMTYPE:'user'));
if($formmail->fromtype === 'user') {
    $formmail->fromid = $user->id; // sender user id
    $formmail->frommail = $user->email; // fix for dolibarr 3.9
}
/*else {
    $formmail->fromname = (isset($_POST['fromname'])?$_POST['fromname']:$conf->global->MAIN_MAIL_EMAIL_FROM);
    $formmail->frommail = (isset($_POST['frommail'])?$_POST['frommail']:$conf->global->MAIN_MAIL_EMAIL_FROM);
    $formmail->withfromreadonly=0;
}*/
$formmail->trackid=$trackid;
$formmail->withsubstit=0;
$formmail->withfrom=1;
//$formmail->witherrorsto=1;
$formmail->withto=(! empty($_POST['sendto'])?$_POST['sendto']:($userto->email?$userto->email:1)); // recipient email
$formmail->withtocc=(! empty($_POST['sendtocc'])?$_POST['sendtocc']:1);       // ! empty to keep field if empty
$formmail->withtoccc=$conf->global->MAIN_EMAIL_USECCC;
$formmail->withtopic=(isset($_POST['subject'])?$_POST['subject']:$subject);
$formmail->withtopicreadonly=0;
$formmail->withfile=2;
$formmail->withbody=(isset($_POST['message'])?$_POST['message']:$message);
$formmail->withbodyreadonly=0;
$formmail->withcancel=1;
$formmail->withdeliveryreceipt=1;
$formmail->withfckeditor=1; // 1 => HTML , 0 => Text
$formmail->ckeditortoolbar='dolibarr_mailings';
// Tableau des substitutions
$formmail->substit=$substitutionarray;
// Tableau des parametres complementaires du post
$formmail->param["action"]="send";
$formmail->param["models"]="body";
$formmail->param["mailid"]=0;
$formmail->param["returnurl"]=$_SERVER["PHP_SELF"];

// Init list of files
if (GETPOST("mode")=='init')
{
        $formmail->clear_attached_files();
}

print $formmail->get_form();

//print '<br>';

dol_fiche_end();

// End of page
llxFooter();

$db->close();
