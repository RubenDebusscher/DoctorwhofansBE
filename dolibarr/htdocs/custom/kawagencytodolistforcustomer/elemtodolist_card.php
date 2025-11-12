<?php
/* Copyright (C) 2017 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2021 Paul LEPONT 		   <paul@kawagency.fr>
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
 *   	\file       elemtodolist_card.php
 *		\ingroup    kawagencytodolistforcustomer
 *		\brief      Page to create/edit/view elemtodolist
 */

//if (! defined('NOREQUIREDB'))              define('NOREQUIREDB', '1');				// Do not create database handler $db
//if (! defined('NOREQUIREUSER'))            define('NOREQUIREUSER', '1');				// Do not load object $user
//if (! defined('NOREQUIRESOC'))             define('NOREQUIRESOC', '1');				// Do not load object $mysoc
//if (! defined('NOREQUIRETRAN'))            define('NOREQUIRETRAN', '1');				// Do not load object $langs
//if (! defined('NOSCANGETFORINJECTION'))    define('NOSCANGETFORINJECTION', '1');		// Do not check injection attack on GET parameters
//if (! defined('NOSCANPOSTFORINJECTION'))   define('NOSCANPOSTFORINJECTION', '1');		// Do not check injection attack on POST parameters
//if (! defined('NOCSRFCHECK'))              define('NOCSRFCHECK', '1');				// Do not check CSRF attack (test on referer + on token if option MAIN_SECURITY_CSRF_WITH_TOKEN is on).
//if (! defined('NOTOKENRENEWAL'))           define('NOTOKENRENEWAL', '1');				// Do not roll the Anti CSRF token (used if MAIN_SECURITY_CSRF_WITH_TOKEN is on)
//if (! defined('NOSTYLECHECK'))             define('NOSTYLECHECK', '1');				// Do not check style html tag into posted data
//if (! defined('NOREQUIREMENU'))            define('NOREQUIREMENU', '1');				// If there is no need to load and show top and left menu
//if (! defined('NOREQUIREHTML'))            define('NOREQUIREHTML', '1');				// If we don't need to load the html.form.class.php
//if (! defined('NOREQUIREAJAX'))            define('NOREQUIREAJAX', '1');       	  	// Do not load ajax.lib.php library
//if (! defined("NOLOGIN"))                  define("NOLOGIN", '1');					// If this page is public (can be called outside logged session). This include the NOIPCHECK too.
//if (! defined('NOIPCHECK'))                define('NOIPCHECK', '1');					// Do not check IP defined into conf $dolibarr_main_restrict_ip
//if (! defined("MAIN_LANG_DEFAULT"))        define('MAIN_LANG_DEFAULT', 'auto');					// Force lang to a particular value
//if (! defined("MAIN_AUTHENTICATION_MODE")) define('MAIN_AUTHENTICATION_MODE', 'aloginmodule');	// Force authentication handler
//if (! defined("NOREDIRECTBYMAINTOLOGIN"))  define('NOREDIRECTBYMAINTOLOGIN', 1);		// The main.inc.php does not make a redirect if not logged, instead show simple error message
//if (! defined("FORCECSP"))                 define('FORCECSP', 'none');				// Disable all Content Security Policies
//if (! defined('CSRFCHECK_WITH_TOKEN'))     define('CSRFCHECK_WITH_TOKEN', '1');		// Force use of CSRF protection with tokens even for GET
//if (! defined('NOBROWSERNOTIF'))     		 define('NOBROWSERNOTIF', '1');				// Disable browser notification

// Load Dolibarr environment
$res = 0;
// Try main.inc.php into web root known defined into CONTEXT_DOCUMENT_ROOT (not always defined)
if (!$res && !empty($_SERVER["CONTEXT_DOCUMENT_ROOT"])) $res = @include $_SERVER["CONTEXT_DOCUMENT_ROOT"]."/main.inc.php";
// Try main.inc.php into web root detected using web root calculated from SCRIPT_FILENAME
$tmp = empty($_SERVER['SCRIPT_FILENAME']) ? '' : $_SERVER['SCRIPT_FILENAME']; $tmp2 = realpath(__FILE__); $i = strlen($tmp) - 1; $j = strlen($tmp2) - 1;
while ($i > 0 && $j > 0 && isset($tmp[$i]) && isset($tmp2[$j]) && $tmp[$i] == $tmp2[$j]) { $i--; $j--; }
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1))."/main.inc.php")) $res = @include substr($tmp, 0, ($i + 1))."/main.inc.php";
if (!$res && $i > 0 && file_exists(dirname(substr($tmp, 0, ($i + 1)))."/main.inc.php")) $res = @include dirname(substr($tmp, 0, ($i + 1)))."/main.inc.php";
// Try main.inc.php using relative path
if (!$res && file_exists("../main.inc.php")) $res = @include "../main.inc.php";
if (!$res && file_exists("../../main.inc.php")) $res = @include "../../main.inc.php";
if (!$res && file_exists("../../../main.inc.php")) $res = @include "../../../main.inc.php";
if (!$res) die("Include of main fails");

require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formcompany.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formprojet.class.php';
dol_include_once('/kawagencytodolistforcustomer/class/elemtodolist.class.php');

// Load translation files required by the page
$langs->load("kawagencytodolistforcustomer@kawagencytodolistforcustomer");
$langs->load("other");

// Get parameters
$socid = GETPOST('socid', 'int');
$elemId = GETPOST('elemId', 'int');
$action = GETPOST('action', 'aZ09');

// Initialize technical objects
$object = new Societe($db);
if($socid){
	$object->fetch($socid);
}
$elemtodolist = new ElemTodoList($db);

$hookmanager->initHooks(array('elemtodolistcard', 'globalcard')); // Note that conf->hooks_modules contains array

$permissiontoread = $user->rights->kawagencytodolistforcustomer->elemtodolist->read;
$permissiontoadd = $user->rights->kawagencytodolistforcustomer->elemtodolist->write;
$permissiontodelete = $user->rights->kawagencytodolistforcustomer->elemtodolist->delete;

if (!$permissiontoread) accessforbidden();

if($action == "customAdd"){
	if($permissiontoadd){
		if(GETPOST('myTitle')){
			if(strlen(GETPOST('myTitle')) > 255){
				setEventMessages($langs->trans('MaxLenghtElem255'), null, 'errors');
			}else{
				$elemtodolist->title = GETPOST('myTitle');
				$elemtodolist->fk_soc = $socid;
				$elemtodolist->create($user);
				$_POST['myTitle'] = '';
			}
		}else{
			setEventMessages($langs->trans('TitleCantBeNull'), null, 'errors');
		}
	}else{
		setEventMessages($langs->trans('YouCantDoThat'), null, 'errors');
	}
}
if($action == "updateElem"){
	if($permissiontoadd){
		$elemtodolist->fetch($elemId);
		if(GETPOST('myTitle')){
			if(strlen(GETPOST('myTitle')) > 255){
				setEventMessages($langs->trans('MaxLenghtElem255'), null, 'errors');
			}else{
				$elemtodolist->title = GETPOST('myTitle');
				$elemtodolist->update($user);
				$_POST['myTitle'] = '';
				$action = "";
				$elemId = "";
			}
		}else{
			$object = new ElemTodoList($db);
			$object->fetch($elemId);
			$elemtodolist->fetch($elemId);
			$elemtodolist->delete($user);
		}
	}else{
		setEventMessages($langs->trans('YouCantDoThat'), null, 'errors');
	}
}
if($action == "deleteElem"){
	if($permissiontodelete){
		$object = new ElemTodoList($db);
		$object->fetch($elemId);
		$elemtodolist->fetch($elemId);
		$elemtodolist->delete($user);
	}else{
		setEventMessages($langs->trans('YouCantDoThat'), null, 'errors');
	}
}

$object = new Societe($db);
if($socid){
	$object->fetch($socid);
}
$form = new Form($db);
$formfile = new FormFile($db);
$formproject = new FormProjets($db);

$title = $langs->trans("ElemTodoList");
$help_url = '';
llxHeader('', $title, $help_url);

$head = societe_prepare_head($object);

print dol_get_fiche_head($head, "todolist", $langs->trans("ThirdParty"), -1, 'company');
print '<div class="kawagencyTodolistContainer">';
if($action == "editElem"){
	$elemtodolist->fetch($elemId);
	print ' <div id="myDIV" class="header">
		<h2 style="margin:5px;padding-bottom:10px;">'.$langs->trans('MyTodoList', $object->name).'</h2>
		<form method="POST" action="'.$_SERVER["PHP_SELF"].'?socid='.$socid.'">
			<input type="hidden" name="action" value="updateElem">
			<input type="hidden" name="socid" value="'.$socid.'">
			<input type="hidden" name="elemId" value="'.$elemId.'">
	  		<input type="text" name="myTitle" id="myTitle" value="'.$elemtodolist->title.'">
			<input type="submit" class="addBtn" value="'.$langs->trans('Edit').'">
		</form>
	</div>';
}else{
	print ' <div id="myDIV" class="header">
		<h2 style="margin:5px;padding-bottom:10px;">'.$langs->trans('MyTodoList', $object->name).'</h2>
		<form method="POST" action="'.$_SERVER["PHP_SELF"].'?socid='.$socid.'">
			<input type="hidden" name="action" value="customAdd">
			<input type="hidden" name="socid" value="'.$socid.'">
	  		<input type="text" name="myTitle" id="myTitle" placeholder="'.$langs->trans('Title...').'" value="'.$_POST['myTitle'].'">
			<input type="submit" class="addBtn" value="'.$langs->trans('Add').'">
		</form>
	</div>';
}


$allItem = $elemtodolist->fetchAll('ASC', 'date_creation', 0, 0, array('fk_soc' => $socid));
if(count($allItem) > 0){
	print '<ul id="myCustomUL">';
	foreach ($allItem as $key => $value) {
		print '
			<li><span class="elemTitle" style="'.($value->id == $elemId ? "font-weight:bold" : "").'">'.$value->title.'</span>
				<div class="elemAction">
					<form method="POST" class="actionDelete" action="'.$_SERVER["PHP_SELF"].'?socid='.$socid.'">
						<input type="hidden" name="elemId" value="'.$value->id.'">
						<input type="hidden" name="action" value="deleteElem">
						<button><span>'.img_delete().'</span></button>
					</form>
					<form method="POST" action="'.$_SERVER["PHP_SELF"].'?socid='.$socid.'">
						<input type="hidden" name="elemId" value="'.$value->id.'">
						<input type="hidden" name="action" value="editElem">
						<button><span>'.img_edit().'</span></button>
					</form>
				</div>
			</li>';
	}
	print '</ul>';
}else{
	print '<ul><li><p>'.$langs->trans('NoItem').'</p></li></ul>';
}
print '</div>';

llxFooter();
$db->close();
