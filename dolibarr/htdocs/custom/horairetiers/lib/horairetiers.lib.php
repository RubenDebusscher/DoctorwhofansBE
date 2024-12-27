<?php
/* Copyright (C) 2021 Ayoub Bayed <ayoub@code42.fr>
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
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * \file    horairetiers/lib/horairetiers.lib.php
 * \ingroup horairetiers
 * \brief   Library files with common functions for Horairetiers
 */
// Include
use h2g2\QueryBuilder;
dol_include_once('h2g2/class/querybuilder.class.php');
dol_include_once('h2g2/class/querybuilderexception.class.php');
require_once DOL_DOCUMENT_ROOT . '/core/class/html.form.class.php';

/**
 * Prepare admin pages header
 *
 * @return array
 */
function horairetiersAdminPrepareHead()
{
	global $langs, $conf, $user;

	$langs->load("horairetiers@horairetiers");

	$h = 0;
	$head = array();

	// Verify if the module is activated
	if ($conf->h2g2->enabled) {
		// We include the h2g2 lib to use the function isH2G2InstalledWithMinVersion
		dol_include_once('/h2g2/lib/h2g2.lib.php');

		// Verify if the user is admin and that the minimal required version 13.1.10 is installed
		if ($user->admin && isH2G2InstalledWithMinVersion('13.1.10')) {
			// H2G2 migration page only for admin
			$head[$h][0] = dol_buildpath('/h2g2/admin/migration_page.php?module=modHorairetiers&modulePath=/horairetiers/core/modules/modHorairetiers.class.php', 1);
			$head[$h][1] = '<i class="fas fa-wrench"></i>&nbsp;' . $langs->trans("MigrationPageTitle");
			$head[$h][2] = 'migration';
			$h++;
		}

		// H2G2 information page
		$langs->load('h2g2@h2g2');
		$head[$h][0] = dol_buildpath('/h2g2/admin/information_page.php?module=modHorairetiers&modulePath=/horairetiers/core/modules/modHorairetiers.class.php', 1);
		$head[$h][1] = $langs->trans("InformationPage");
		$head[$h][2] = 'information';
		$h++;
	}

	complete_head_from_modules($conf, $langs, null, $head, $h, 'horairetiers');

	return $head;
}

/**
 * Display opening hours table for view only
 *
 * @param 	array 		$days			Week days. Example : array('monday' => 'label')
 * @param 	array 		$data			Opening hours datas. Example : array("monday" {["work"]=> "1",["continuous_day"]=>"1", ["h1_start"]=>"01:30", ["h1_end"]=>"02:30", ["h2_start"]=>"",["h2_end"]=>""})
 * @param 	array 		$origin			Origin
 * @param 	array 		$id				Id
 * @return 	void
 */
function openingHoursTableForView($days, $data, $origin, $id)
{
	global $langs, $user;

	print '<table class="noborder centpercent">';
	print '<tbody>';
	print '<tr class="liste_titre">';
	print '<th>' . $langs->trans("HoraireTiersDay") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersWork") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersStartWork") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersEndWork") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersStartLunch") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersEndLunch") . '</th>';
	print '</tr>';

	// check if data
	$is_empty = true;
	foreach ($data['days'] as $info) {
		if ($info->h1_start || $info->h2_start) {
			$is_empty = false;
			break;
		}
	}

	if (!$is_empty) {
		foreach ($data['days'] as $info) {
			if ($days[$info->day]) {
				print '<tr>';
				// Display the day name
				print '<td>' . $days[$info->day] . '</td>';
				// Display if it's a working day
				print '<td>';
				if ($info->work == "1") {
					print '<i class="fas fa-check-square" style="color: green"></i>';
				} else {
					print '<i class="far fa-square"></i>';
				}
				print '</td>';
				// Display hours
				print '<td>' . $info->h1_start . '</td>';
				print '<td>' . $info->h1_end . '</td>';
				print '<td>' . $info->h2_start . '</td>';
				print '<td>' . $info->h2_end . '</td>';
				print '</tr>';
			}
		}
		print '</tbody>';
		print '</table>';
		if ($origin == 'thirdparty' && $user->rights->societe->creer) {
			print '<div class="center"><a class="butAction" href="' . dol_buildpath('/horairetiers/openinghours.php?id=' . $id, 1) . '&action=modify&origin=' . $origin . '">' . $langs->trans("HoraireTiersModify") . '</a></div>';
		}
	} else {
		print '<table class="noborder centpercent">';
		print '<tr>';
		print '<td align="center">'.$langs->trans("HoraireTiersNoData");
		print '</td>';
		print '</tr>';
		print '</tbody>';
		print '</table>';
		// It's only possible to edit opening hours on thirdparty card
		if ($origin == "thirdparty") {
			print '<div class="center"><a class="butAction" href="' . dol_buildpath('/horairetiers/openinghours.php?id=' . $id, 1) . '&action=modify&origin=' .$origin. '">' . $langs->trans("HoraireTiersAdd") . '</a></div>';
		}
	}
}

/**
 *
 * Get thirdparty hours by sql query
 *
 * @param 		int						$id			thirdparty id
 * @return 		array
 * @usedBy 		setThirdpartyHoursKey
 */
function getThirdpartyHours($id)
{
	$hours = array();

	try {
		$hours = QueryBuilder::table('horairetiers_hours')
			->select('day', 'work', 'continuous_day', 'h1_start', 'h1_end', 'h2_start', 'h2_end')
			->where('fk_soc', '=', $id)
			->disableEntityCheck()
			->get();
	} catch (\h2g2\QueryBuilderException $e) {
		// We only return an empty array
	}
	return $hours;
}

/**
 * Set key per day on different data for Third Party Hours
 *
 * @param 	array			$days		 Days of the week
 * @param	int 			$id   		 Thirdparty id
 * @return 	array
 * @see getThirdpartyHours
 */
function setThirdpartyHoursKey($days, $id)
{
	$thirdpartyHours = getThirdpartyHours($id);
	$hoursFormated = array();

	foreach ($days as $key => $label) {
		$hoursFormated['days'][$key] = null;
	}

	if (!empty($thirdpartyHours)) {
		$hoursFormated['empty'] = false;
		foreach ($thirdpartyHours as $hour) {
			$hoursFormated['days'][$hour->day] = $hour;
		}
	} else {
		$hoursFormated['empty'] = true;
	}
	return $hoursFormated;
}


/**
 * Display opening hours table on action create or modify
 *
 * @param	int 			$id			thirdparty id
 * @param   array			$days		days of the week
 * @param 	boolean 		$editable	true if confirm_modify, false if confirm_add
 * @param 	array			$data		data from db
 * @param 	string			$origin		add param url. Example(&origin=view)
 * @param 	int				$fk_soc		Id of society
 * @return 	void
 */
function openingHoursTableForCreateModify($id, $days, $editable, $data, $origin, $fk_soc)
{
	global $langs, $db;
	$action = ($editable ? 'confirm_modify' : 'confirm_add');

	print '<form method="POST" action="'.$_SERVER["PHP_SELF"].'?id='.$id.'&action='.$action.'&origin='.$origin.'">';
	if ((float) DOL_VERSION >= 11) {
		print '<input type="hidden" name="token" value="' . newToken() . '">';
	} else {
		print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
	}
	print '<table class="noborder centpercent">';
	print '<tbody>';
	print '<tr class="liste_titre">';
	print '<th>' . $langs->trans("HoraireTiersDay") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersWork") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersStartWork") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersEndWork") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersContinueDay") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersStartLunch") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersEndLunch") . '</th>';
	print '<th>' . $langs->trans("HoraireTiersDelete") . '</th>';
	print '</tr>';
	if (!empty($data)) {
		$sql = "SELECT count(rowid) as count FROM ".MAIN_DB_PREFIX."horairetiers_hours WHERE fk_soc = ".$fk_soc;
		$resql = $db->query($sql);
		$count = intval($db->fetch_object($resql)->count);
		foreach ($data['days'] as $key => $value) {
			if ($days[$key]) {
				print '<tr class="lineDisplay">';
				print '<td>' . $days[$key] . '</td>';
				print '<td>';
				print '<label class="switch"><input type="checkbox" checked name="openingHours[' . $key . '][ck]" class="checkboxWorkDay" data-workDay="' . $key . '" data-label="' . $langs->trans($key) . '" >';
				print '<div class="slider round"><span class="on"></span>';
				print '<span class="off"></span>';
				print '</div></label>';
				print '</td>';
				$inputClassName = $key . 'InputTime';
				print '<td><input title="'.$langs->trans("HoraireTiersStartDayHours").'" placeholder="HH:MM" type="text" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" name="openingHours[' . $key . '][h1_start]" value ="' . $value->h1_start . '" class="' . $inputClassName . '"></td>';
				print '<td><input title="'.$langs->trans("HoraireTiersEndDayHours").'" placeholder="HH:MM" type="text" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" name="openingHours[' . $key . '][h1_end]" value ="' . $value->h1_end . '" class="' . $inputClassName . '"></td>';
				if ($count > 0) {
					if ($data['continuous_day'] == 1) {
						print '<td><input checked type="checkbox"  name="openingHours[' . $key . '][continuous_day]" class="continuousDay" data-day="' . $key . '"  ' . (($value->continuous_day == '1') ? 'checked' : "") . '></td>';
					} else {
						print '<td><input type="checkbox"  name="openingHours[' . $key . '][continuous_day]" class="continuousDay" data-day="' . $key . '"  ' . (($value->continuous_day == '1') ? 'checked' : "") . '></td>';
					}
				} else {
					print '<td><input checked type="checkbox"  name="openingHours[' . $key . '][continuous_day]" class="continuousDay" data-day="' . $key . '"  ' . (($value->continuous_day == '1') ? 'checked' : "") . '></td>';
				}
				print '<td><input title="'.$langs->trans("HoraireTiersStartLunchHours").'" placeholder="HH:MM" type="text" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" name="openingHours[' . $key . '][h2_start]" value ="' . $value->h2_start . '" class="' . $key . 'LunchTime ' . $inputClassName . '"></td>';
				print '<td><input title="'.$langs->trans("HoraireTiersEndLunchHours").'" placeholder="HH:MM" type="text" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" name="openingHours[' . $key . '][h2_end]" value ="' . $value->h2_end . '" class="' . $key . 'LunchTime ' . $inputClassName . '"></td>';
				print '<td class="openingHours[' . $key . ']"><i class="fas fa-solid fa-trash deleteline"></i></td>';
				print '</tr>';
			}
		}
		print '</tbody>';
		print '</table>';

		// It's only possible to edit opening hours on thirdparty card
		if ($origin == "thirdparty") {
			print '<div class="center"><input type="submit" class="button" name="save" value="' . $langs->trans("Save") . '"></div>';
		}
	} else {
		print '<table class="noborder centpercent">';
		print '<tr>';
		print '<td align="center">'.$langs->trans("HoraireTiersNoData");
		print '</td>';
		print '</tr>';
		print '</tbody>';
		print '</table>';

		// It's only possible to edit opening hours on thirdparty card
		if ($origin == "thirdparty") {
			print '<div class="center"><a class="butAction" href="' . dol_buildpath('/horairetiers/openinghours.php?id=' . $id, 1) . '&action=modify&origin=' .$origin. '">' . $langs->trans("HoraireTiersAdd") . '</a></div>';
		}
	}
	print '</form>';
}

/**
 *  Insert or update horairetiers_hours table for id
 *
 * @param int 		$fk_soc     id of the thirdparty
 * @param array 	$days		days of the week
 * @param array     $dataSend   array sent from the form
 * @return void
 */
function upsert($fk_soc, $days, $dataSend)
{
	global $db, $conf, $user;
	$sql = "SELECT rowid FROM ".MAIN_DB_PREFIX."horairetiers_hours WHERE fk_soc = ".$fk_soc;
	$resql = $db->query($sql);
	foreach ($days as $key => $value) {
		if ($resql->num_rows > 0) {
			$sql = "UPDATE " . MAIN_DB_PREFIX . "horairetiers_hours SET";
			$sql .= " day = '" . $key . "', work= " . ($dataSend[$key]['ck'] == 'on' ? 1 : 0) . " , h1_start = '" . $dataSend[$key]['h1_start'] . "', h1_end =  '" . $dataSend[$key]['h1_end'] . "', continuous_day= " . ($dataSend[$key]['continuous_day'] == 'on' ? 1 : 0) . ", h2_start = '" . $dataSend[$key]['h2_start'] . "', h2_end = '" . $dataSend[$key]['h2_end'] . "', entity = " . $conf->entity . ", user_edit = " . $user->id . " WHERE fk_soc = " . $fk_soc . " AND day = '" . $key . "'";
			$db->query($sql);
		} else {
			$sql = "INSERT INTO " . MAIN_DB_PREFIX . "horairetiers_hours (fk_soc, day, work, h1_start, h1_end, continuous_day, h2_start, h2_end, entity, user_edit)";
			$sql .= " VALUES (" . $fk_soc . ", '" . $key . "', " . ($dataSend[$key]['ck'] == 'on' ? 1 : 0).",";
			$sql .= " '" . $dataSend[$key]['h1_start'] . "', '" . $dataSend[$key]['h1_end'] . "', " . ($dataSend[$key]['continuous_day'] == 'on' ? 1 : 0) . ", '" . $dataSend[$key]['h2_start'] . "', '" . $dataSend[$key]['h2_end'] . "', " . $conf->entity . ", " . $user->id . ")";
			$db->query($sql);
		}
	}
}
