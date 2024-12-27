<?php
/* Copyright (C) 2021		Ayoub Bayed	<ayoub@code42.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 *      \file       horairetiers/horairetiers/openinghours.php
 *      \ingroup    horairetiers
 *      \brief      Onglet d'affichage des horaires de disponibilité pour les tiers
 */
$res = 0;
// Try main.inc.php into web root known defined into CONTEXT_DOCUMENT_ROOT (not always defined)
if (!$res && !empty($_SERVER["CONTEXT_DOCUMENT_ROOT"])) $res = @include $_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/main.inc.php";
// Try main.inc.php into web root detected using web root calculated from SCRIPT_FILENAME
$tmp = empty($_SERVER['SCRIPT_FILENAME']) ? '' : $_SERVER['SCRIPT_FILENAME'];
$tmp2 = realpath(__FILE__);
$i = strlen($tmp) - 1;
$j = strlen($tmp2) - 1;
while ($i > 0 && $j > 0 && isset($tmp[$i]) && isset($tmp2[$j]) && $tmp[$i] == $tmp2[$j]) {
	$i--;
	$j--;
}
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1)) . "/main.inc.php")) $res = @include substr($tmp, 0, ($i + 1)) . "/main.inc.php";
if (!$res && $i > 0 && file_exists(dirname(substr($tmp, 0, ($i + 1))) . "/main.inc.php")) $res = @include dirname(substr($tmp, 0, ($i + 1))) . "/main.inc.php";
// Try main.inc.php using relative path
if (!$res && file_exists("../main.inc.php")) $res = @include "../main.inc.php";
if (!$res && file_exists("../../main.inc.php")) $res = @include "../../main.inc.php";
if (!$res && file_exists("../../../main.inc.php")) $res = @include "../../../main.inc.php";
if (!$res) die("Include of main fails");

require_once DOL_DOCUMENT_ROOT . '/core/class/html.form.class.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/company.lib.php';
require_once DOL_DOCUMENT_ROOT . '/fichinter/class/fichinter.class.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/fichinter.lib.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/ticket.lib.php';
require_once DOL_DOCUMENT_ROOT . '/ticket/class/ticket.class.php';
dol_include_once('horairetiers/lib/horairetiers.lib.php');

// Include
$action = GETPOST('action', 'aZ09');
if (empty($action)) $action = 'view';

$origin = GETPOST('origin', 'none');
if (empty($origin)) $origin = 'thirdparty';

$ref = GETPOST('ref', 'aZ09');

$langs->load("horairetiers@horairetiers");
$langs->load("companies");

// Security check
$id = GETPOST('id', 'int');

$permissionnote = $user->rights->societe->creer; // Used by the include of actions_setnotes.inc.php

// Initialize technical object to manage hooks of page. Note that conf->hooks_modules contains array of hook context
$hookmanager->initHooks(array('thirdpartynote', 'globalcard'));

// Array for different days of the week
$days = array (
	'monday' => $langs->trans('HoraireTiersMonday'),
	'tuesday' => $langs->trans('HoraireTiersTuesday'),
	'wednesday' => $langs->trans('HoraireTiersWednesday'),
	'thursday' => $langs->trans('HoraireTiersThursday'),
	'friday' => $langs->trans('HoraireTiersFriday'),
	'saturday' => $langs->trans('HoraireTiersSaturday'),
	'sunday' => $langs->trans('HoraireTiersSunday')
);
switch ($origin) {
	//Dans le cas où origin = interventions
	case 'interventions':
		$object = new Fichinter($db);
		$soc = new Societe($db);
		if ($id > 0) $object->fetch($id);
		$soc->fetch_thirdparty($object->socid);
		$head = fichinter_prepare_head($object);
		$fk_soc = $object->socid;
		$picto = 'intervention';
		$param = 'id';
		$urlRef = '&origin=interventions';
		$morehtmlref = '<div class="refidno">';
		// Thirdparty
		$morehtmlref .= $langs->trans('ThirdParty').' : '.$soc->thirdparty->getNomUrl(1);
		$morehtmlref .= '</div>';
		$url_page_current = DOL_URL_ROOT.'/fichinter/card.php';
		break;

	//Dans le cas où origin = ticket
	case 'ticket':
		$object = new Ticket($db);
		$form = new Form($db);
		if ($id > 0) $object->fetch($id);
		$head = ticket_prepare_head($object);
		$fk_soc = $object->fk_soc;
		$trackId = $object->track_id;
		$picto = 'ticket';
		$param = 'id';
		$urlRef = '&origin=ticket';
		$url_page_current = DOL_URL_ROOT.'/ticket/card.php';

		$morehtmlref = '<div class="refidno">';
		$morehtmlref .= $object->subject;
		if ($object->fk_user_create > 0) {
			$morehtmlref .= '<br>'.$langs->trans("CreatedBy").' : ';
			$langs->load("users");
			$fuser = new User($db);
			$fuser->fetch($object->fk_user_create);
			$morehtmlref .= $fuser->getNomUrl(0);
		}
		if (!empty($object->origin_email)) {
			$morehtmlref .= '<br>'.$langs->trans("CreatedBy").' : ';
			$morehtmlref .= dol_escape_htmltag($object->origin_email).' <small>('.$langs->trans("TicketEmailOriginIssuer").')</small>';
		}
		if (!empty($conf->societe->enabled)) {
			$morehtmlref .= '<br>'.$langs->trans('ThirdParty').' : ';

				$morehtmlref .= $form->form_thirdparty($url_page_current.'?track_id='.$object->track_id, $object->socid, 'none', '', 1, 0, 0, array(), 1);
		}
		$morehtmlref .= '</div>';
		break;

	default:
		global $db;
		$object = new Societe($db);
		if ($id > 0) $object->fetch($id);
		$head = societe_prepare_head($object);
		$fk_soc = $id;
		$picto = 'company';
		$param = 'id';
		$urlRef = '&origin=thirdparty';
		break;
}

/*
 * Actions
 */
include DOL_DOCUMENT_ROOT . '/core/actions_setnotes.inc.php'; // Must be include, not includ_once

if ($action == 'confirm_add' || $action == 'confirm_modify') {
	$editMode = ($action == 'confirm_modify');
	$dataSend = GETPOST('openingHours', 'none');
	$actionRedirect = ($editMode ? 'modify' : 'view');
	if ($dataSend) {
		foreach ($dataSend as $key => $value) {
			// Check when the day is worked if h1_start @ h1_end are not null
			if ($value['ck'] == 'on' && ($value["h1_start"] == null || $value["h1_end"] == null)) {
				setEventMessage($langs->trans('HoraireTiersDayInvalid'), $style = "errors");
				header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $fk_soc . "&action=" . $actionRedirect . "&origin=" . $origin);
				exit;
			}
			// Check when it's a continuous day if h2_start @ h2_end are not null
			if ($value['continuous_day'] == null && ($value["h2_start"] == null || $value["h2_end"] == null)) {
				setEventMessage($langs->trans('HoraireTiersInvalidHoursContinuousDay'), $style = "errors");
				header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $fk_soc . "&action=" . $actionRedirect . "&origin=" . $origin);
				exit;
			}
			// Check when it's a continuous day if one of h2_start or h2_end are not null
			if ($value['continuous_day'] == null && (($value["h2_start"] != null && $value["h2_end"] == null) || ($value["h2_start"] == null && $value["h2_end"] != null))) {
				setEventMessage($langs->trans('HoraireTiersNoH2End'), $style = "errors");
				header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $fk_soc . "&action=" . $actionRedirect . "&origin=" . $origin);
				exit;
			}
			//check h1_start < h2_start < h2_end < h1_end in term of values if continuous_day = null
			if ($value["continuous_day"] == null && ($value["h1_start"] && $value["h1_end"] || $value["h2_start"] && $value["h2_end"])) {
				if (!($value["h1_start"] < $value["h1_end"])) {
					setEventMessage($langs->trans('HoraireTiersh1StartNotInferiorh1end'), $style = "errors");
					header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $fk_soc . "&action=" . $actionRedirect . "&origin=" . $origin);
					exit;
				}
				if (!($value["h1_start"] < $value["h2_start"])) {
					setEventMessage($langs->trans('HoraireTiersh1StartNotInferiorh2Start'), $style = "errors");
					header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $fk_soc . "&action=" . $actionRedirect . "&origin=" . $origin);
					exit;
				}
				if (!($value["h1_start"] < $value["h2_start"] && $value["h2_start"] < $value["h2_end"])) {
					setEventMessage($langs->trans('HoraireTiersh2StartNotInferiorh2End'), $style = "errors");
					header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $fk_soc . "&action=" . $actionRedirect . "&origin=" . $origin);
					exit;
				}
				if (!($value["h1_start"] < $value["h2_start"] && $value["h2_start"] < $value["h2_end"] && $value["h2_end"] < $value["h1_end"])) {
					setEventMessage($langs->trans('HoraireTiersh2EndNotInferiorh1End'), $style = "errors");
					header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $fk_soc . "&action=" . $actionRedirect . "&origin=" . $origin);
					exit;
				}
			} elseif ($value["continuous_day"] == "on" && ($value["h1_end"] < $value["h1_start"])) { //check h1_start < h1_end in term of values if continuous_day = on
				setEventMessage($langs->trans('HoraireTiersInvalidContinuousDay'), $style = "errors");
				header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $fk_soc . "&action=" . $actionRedirect . "&origin=" . $origin);
				exit;
			}
		}
	}

	if ($dataSend && $editMode) {
		upsert($fk_soc, $days, $dataSend);
	}

	header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $fk_soc . "&action=view&origin=" . $origin);
	exit;
}

/*
 *	View
 */
$title = $langs->trans("ThirdParty") . ' - ' . $langs->trans("Notes");
if (!empty($conf->global->MAIN_HTML_TITLE) && preg_match('/thirdpartynameonly/', $conf->global->MAIN_HTML_TITLE) && $object->name) $title = $object->name . ' - ' . $langs->trans("Notes");
$help_url = 'EN:Module_Third_Parties|FR:Module_Tiers|ES:Empresas';
$arrayofjs = array('/horairetiers/js/horairetiers.js.php');
$arrayofcss = array('/horairetiers/css/horairetiers.css');



if ($object->id > 0) {
	/*
	 * Display tab and header infos
	 */
	llxHeader('', $title, $help_url, '', 0, 0, $arrayofjs, $arrayofcss);
	print dol_get_fiche_head($head, 'openinghours', $langs->trans("HoraireTiersHours"), -1, $picto);
	dol_banner_tab($object, $param, '', 1, '', '', $morehtmlref, $urlRef);

	$hours = setThirdpartyHoursKey($days, $fk_soc);

	// Display wizard for thirdparty view
	if ($conf->global->HORAIRETIERS_WIZARD != '' && $origin == 'thirdparty' && $action == 'modify') {
				print info_admin($conf->global->HORAIRETIERS_WIZARD);
	}
	//Check if a company is linked to the object
	if ($fk_soc < 0 || $fk_soc === null) {
		print '<div class="info"><span class="fa fa-info-circle"></span> '.$langs->trans("HoraireTiersNoTiers").'<a href="'.dol_buildpath('/ticket/card.php?track_id='.$trackId.'&action=editcustomer', 1).'"> ' . $langs->trans("HoraireTiersEdit") . '</a></div>';
	} else {
		if ($action == 'view') {
			if (!$hours['empty']) {
				// Display of opening hours
				openingHoursTableForView($days, $hours, $origin, $fk_soc);
				// Display edit button only on thirdparty card
			} else {
				openingHoursTableForCreateModify($id, $days, false, array(), $origin, $fk_soc);
			}
		} else {
			$editable = ($action == 'modify'); // Check if the table is in edit or create mode
			openingHoursTableForCreateModify($id, $days, $editable, $hours, $origin, $fk_soc);
		}
	}
} else {
	print '<div>'.$langs->trans("HoraireTiersErrorSql").'</div>';
}

// End of page
llxFooter();
$db->close();
