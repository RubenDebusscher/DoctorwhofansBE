<?php
/* Copyright (C) 2021 SuperAdmin
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

//if (!defined('NOREQUIREUSER'))  define('NOREQUIREUSER', '1');
//if (!defined('NOREQUIREDB'))    define('NOREQUIREDB', '1');
//if (!defined('NOREQUIRESOC'))   define('NOREQUIRESOC', '1');
//if (!defined('NOREQUIRETRAN'))  define('NOREQUIRETRAN', '1');
//if (!defined('NOCSRFCHECK'))    define('NOCSRFCHECK', 1);
//if (!defined('NOTOKENRENEWAL')) define('NOTOKENRENEWAL', 1);
//if (!defined('NOLOGIN'))        define('NOLOGIN', 1);
if (!defined('NOREQUIREMENU'))  define('NOREQUIREMENU', 1);
if (!defined('NOREQUIREHTML'))  define('NOREQUIREHTML', 1);
if (!defined('NOREQUIREAJAX'))  define('NOREQUIREAJAX', '1');


/**
 * \file    takeposcashiers/js/takeposcashiers.js.php
 * \ingroup takeposcashiers
 * \brief   JavaScript file for module TakeposCashiers.
 */

// Load Dolibarr environment
$res = 0;
// Try main.inc.php into web root known defined into CONTEXT_DOCUMENT_ROOT (not always defined)
if (!$res && !empty($_SERVER["CONTEXT_DOCUMENT_ROOT"])) $res = @include $_SERVER["CONTEXT_DOCUMENT_ROOT"]."/main.inc.php";
// Try main.inc.php into web root detected using web root calculated from SCRIPT_FILENAME
$tmp = empty($_SERVER['SCRIPT_FILENAME']) ? '' : $_SERVER['SCRIPT_FILENAME']; $tmp2 = realpath(__FILE__); $i = strlen($tmp) - 1; $j = strlen($tmp2) - 1;
while ($i > 0 && $j > 0 && isset($tmp[$i]) && isset($tmp2[$j]) && $tmp[$i] == $tmp2[$j]) { $i--; $j--; }
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1))."/main.inc.php")) $res = @include substr($tmp, 0, ($i + 1))."/main.inc.php";
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1))."/../main.inc.php")) $res = @include substr($tmp, 0, ($i + 1))."/../main.inc.php";
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
?>

/* Javascript library of module TakeposCashiers */

<?php
if ($conf->userswitcher->enabled==1) {
?>
function Login(login){
	$.ajax({
		type: "GET",
		url: "<?php print dol_buildpath('custom/userswitcher/set_user.php', 1).'?login='; ?>"+login,
	});
	window.location.reload();
}
<?php
}
else {
	?>
function Login(login){
	$( "#cashiercontent" ).html("<label class=\"block\">Password:</label><input class=\"block\" type=\"text\" id=\"password\" name=\"password\"><br><input onclick=\"SetUser('"+login+"');\" class=\"block\" type=\"submit\" value=\"Submit\">");
}
<?php
}
?>

function SetUser(user){
	$.ajax({
		type: "GET",
		url: "<?php print dol_buildpath('custom/takeposcashiers/login.php', 1);?>?user="+user+"&password="+$('#password').val(),
	});
	window.location.reload();
}

$( document ).ready(function() {
$( "#customerandsales" ).before("<div class=\"inline-block valignmiddle\"><a class=\"topnav-terminalhour\" onclick=\"ModalBox('ModalCashier');\"><span class=\"fa fa-user\"></span><span class=\"hideonsmartphone\"> Cashier</span></a></div>");
$( "#ModalTerminal" ).before("<div id=\"ModalCashier\" class=\"modal\"><div class=\"modal-content\"><div class=\"modal-header\"><span class=\"close\" href=\"#\" onclick=\"document.getElementById('ModalCashier').style.display = 'none';\">&times;</span><h3>Cashier</h3></div><div id=\"cashiercontent\" class=\"modal-body\"><?php
			$sql = 'SELECT rowid, lastname, login FROM '.MAIN_DB_PREFIX.'user';
			$sql .= " WHERE entity = 0 or entity = ".getEntity('multicurrency');
			//echo $sql;
			//$sql .= " AND pos_cashier=1";
			$resql = $db->query($sql);
			if ($resql) {
				while ($obj = $db->fetch_object($resql)) {
					print '<button type=\"button\" class=\"block\" onclick=\"Login(\''.$obj->login.'\')\">'.$obj->lastname.'</button>';
				}
			}
			?></div></div></div>");
});


