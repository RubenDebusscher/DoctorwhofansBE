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
 *
 * Library javascript to enable Browser notifications
 */

if (!defined('NOREQUIREUSER')) define('NOREQUIREUSER', '1');
if (!defined('NOREQUIREDB')) define('NOREQUIREDB', '1');
if (!defined('NOREQUIRESOC')) define('NOREQUIRESOC', '1');
if (!defined('NOCSRFCHECK')) define('NOCSRFCHECK', 1);
if (!defined('NOTOKENRENEWAL')) define('NOTOKENRENEWAL', 1);
if (!defined('NOLOGIN')) define('NOLOGIN', 1);
if (!defined('NOREQUIREMENU')) define('NOREQUIREMENU', 1);
if (!defined('NOREQUIREHTML')) define('NOREQUIREHTML', 1);
if (!defined('NOREQUIREAJAX')) define('NOREQUIREAJAX', '1');


/**
 * \file    horairetiers/js/horairetiers.js.php
 * \ingroup horairetiers
 * \brief   JavaScript file for module Horairetiers.
 */

// Load Dolibarr environment
$res = 0;
// Try main.inc.php into web root known defined into CONTEXT_DOCUMENT_ROOT (not always defined)
if (!$res && !empty($_SERVER["CONTEXT_DOCUMENT_ROOT"])) $res = @include $_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/main.inc.php";
// Try main.inc.php into web root detected using web root calculated from SCRIPT_FILENAME
$tmp = empty($_SERVER['SCRIPT_FILENAME']) ? '' : $_SERVER['SCRIPT_FILENAME']; $tmp2 = realpath(__FILE__); $i = strlen($tmp) - 1; $j = strlen($tmp2) - 1;
while ($i > 0 && $j > 0 && isset($tmp[$i]) && isset($tmp2[$j]) && $tmp[$i] == $tmp2[$j]) {
	$i--;
	$j--;
}
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1)) . "/main.inc.php")) $res = @include substr($tmp, 0, ($i + 1)) . "/main.inc.php";
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1)) . "/../main.inc.php")) $res = @include substr($tmp, 0, ($i + 1)) . "/../main.inc.php";
// Try main.inc.php using relative path
if (!$res && file_exists("../../main.inc.php")) $res = @include "../../main.inc.php";
if (!$res && file_exists("../../../main.inc.php")) $res = @include "../../../main.inc.php";
if (!$res) die("Include of main fails");

// Define js type
header('Content-Type: application/javascript');
// Important: Following code is to cache this file to avoid page request by browser at each Dolibarr page access.
// You can use CTRL+F5 to refresh your browser cache.
if (empty($dolibarr_nocache)) header('Cache-Control: max-age=3600, public, must-revalidate');
else header('Cache-Control: no-cache');
global $langs;
$langs->load("horairetiers@horairetiers");

/**
 * Translate and escape the string for the key
 *
 * @param Langs $langs Langs handler
 * @param string $key Translation key
 *
 * @return string                       Key translated and formated as json
 */
function transForJs($langs, $key)
{
	return json_encode(html_entity_decode($langs->trans($key)));
}

?>
/* Javascript library of module Horairetiers */


/**
 * Function that enable Inputs
 * @param input		inputList
 *
 */
function enableInputs(inputList) {
	for (let item of inputList) {
		item.disabled = true;
		item.value = null;
	}
}

/**
 * Function that disable Inputs
 * @param input						inputList
 * @param checkboxContinuousDay 	fullDay
 */
function disableInputs(inputList, fullDay) {
	let i = 0;
	for (let item of inputList) {
		// if continuous day is checked, we enabled only the first two fields
		if (i > 1 && fullDay)
			break;
		item.disabled = false;
		i++;
	}
}


/**
 * Disable Inputs time, clone button and when there is no data on h1_start or h1_end
 */
function disableInputTime() {
	var lineList = document.querySelectorAll('.lineDisplay');
	if (lineList) {
		lineList.forEach((line) => {
			let inputTextList = line.querySelectorAll('input[type=text]');
			if (inputTextList) {
				// Check if there is value on start time and end time
				if (inputTextList[0].value === "" || inputTextList[1].value === "") {
					//Loop on the two first input text (h1_start/h1_end)
					for (let i = 0; i < 2; i++) {
						let workDay = getParentByTagName(inputTextList[i]).querySelectorAll('input[class=checkboxWorkDay]')[0];
						if (workDay) {
							workDay.checked = false;
							let inputList = getParentByTagName(workDay).querySelectorAll('input[type=text]');
							inputList.forEach((item) => item.disabled = true)
						}
					}
				}
			}
		})
	}
}


/**
 * Function that disable 2 input time (h2_start/h2_end) if continuous day is checked
 */
function disableInputForContinuousDay() {
	var continuousDayList = document.querySelectorAll('input[class=continuousDay]');

	for (let i = 0; i < continuousDayList.length; i++) {
		//Check days where continuous day is checked
		if (continuousDayList[i].checked === true) {
			const inputTextList = getParentByTagName(continuousDayList[i]).querySelectorAll('input[type=text]');
			const h2StartInputPos = 2;
			const h2EndInputPos = 3;
			inputTextList[h2StartInputPos].disabled = true; // We disable the input time h2_start
			inputTextList[h2EndInputPos].disabled = true; // We disable the input time h2_end
		}
	}
	if (continuousDayList) {
		continuousDayList.forEach(item => item.addEventListener('click', function (e) {
			const continuousDay = e.target;
			var workDay = getParentByTagName(continuousDay).querySelectorAll('input[class=checkboxWorkDay]')[0].checked;
			const inputList = document.getElementsByClassName(continuousDay.dataset['day'] + 'LunchTime');
			if (inputList) {
				if (workDay === true && continuousDay.checked === true) {
					enableInputs(inputList);
				}
				if (workDay === true && continuousDay.checked === false) {
					disableInputs(inputList, false);
				}
				if (workDay === false && continuousDay.checked === true) {
					enableInputs(inputList);
				}
			}
		}))
	}
}

/**
 * function that check and executes event listener on click for Work Day
 */
function eventListenerForWorkDay() {
	var workDay = document.querySelectorAll('input[class=checkboxWorkDay]');

	if (workDay) {
		workDay.forEach(item => item.addEventListener('click', function (e) {
		const checkBox = e.target;
		const inputList = document.getElementsByClassName(checkBox.dataset['workday'] + 'InputTime');
			if (inputList) {
				//let buttonClone = getParentByTagName(item).querySelectorAll('input[name=clone]')[0];
				var stateContinuousDay = getParentByTagName(checkBox).querySelectorAll('input[class=continuousDay]')[0].checked;
				if (checkBox.checked === false && stateContinuousDay === true) {
					enableInputs(inputList);
					//buttonClone.disabled = true;
				} else if (checkBox.checked === false && stateContinuousDay === false){
					enableInputs(inputList);
				} else {
					disableInputs(inputList, stateContinuousDay);
					//buttonClone.disabled = false;
				}
			}
		}))
	}
}

/**
 * Function that delete the values of input text, checkboxes and button clone on click on trash icon
 *
 */
function deleteLine() {
	var getTrash = document.querySelectorAll('.deleteline');
	if (getTrash) {
		getTrash.forEach(item => item.addEventListener('click', function (e) {
			const element = e.target;
			//Clear the fields and disable inputs text
			getParentByTagName(element).querySelectorAll('input[type=text]')
				.forEach(item => {
					item.value = null,
					item.disabled = true
					})
			//Uncheck workDay checkbox
			getParentByTagName(element).querySelectorAll('input[class=checkboxWorkDay]')
				.forEach(item => item.checked = false)
			//Uncheck continuousDay checkbox
			getParentByTagName(element).querySelectorAll('input[class=continuousDay]')
				.forEach(item => item.checked = true)
		}))
	}
}

/**
 * Function to get parent of htmltag(element) until the tag is <tr>
 * @param HtmlTag 	element
 */
function getParentByTagName(element) {
	while (element.tagName !== "TR") {
		element = element.parentNode
	}
	return element;
}

$(document).ready(function () {
	eventListenerForWorkDay();
	disableInputForContinuousDay();
	disableInputTime();
	deleteLine();
})

