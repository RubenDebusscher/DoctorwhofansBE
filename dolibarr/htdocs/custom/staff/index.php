<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <2017>  <AXeL>
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
 * \file    index.php
 * \ingroup Staff
 * \brief   Index PHP page.
 *
 * Put detailed description here.
 */

// Load Dolibarr environment
$mod_path = "";
if (false === (@include '../main.inc.php')) {  // From htdocs directory
	require '../../main.inc.php'; // From "custom" directory
        $mod_path = "/custom";
}

global $user;

if ($user->rights->staff->perms->full) $user->admin = 1;

if ($user->admin) {
	$dol_version = explode('.', DOL_VERSION);
	$user_page = (int)$dol_version[0] >= 8 ? 'list' : 'index';
	header('Location: '.DOL_URL_ROOT.'/user/'.$user_page.'.php?mainmenu=hrm&leftmenu=staff&mode=employee');
}
else if ($user->rights->staff->plannedshift->read) {
	header('Location: '.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=plannedshift&type=planned_shift');
}
else {
	header('Location: '.DOL_URL_ROOT.$mod_path.'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=timesheet');
}
