<?php
/* Copyright (C) 2017	AXeL dev	<contact.axel.dev@gmail.com>
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
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *       \file       /staff/ajax/ajax.php
 *       \brief      File to do ajax actions
 */

define('NOTOKENRENEWAL', 1);

// Load Dolibarr environment
$mod_path = "";
if (false === (@include '../../main.inc.php')) {  // From htdocs directory
	require '../../../main.inc.php'; // From "custom" directory
	$mod_path = "/custom";
}

global $db, $langs, $user;

if ($user->rights->staff->perms->full) $user->admin = 1;

require_once DOL_DOCUMENT_ROOT."/core/lib/admin.lib.php";

dol_include_once('/staff/class/staff.class.php');

// Get parameters
$action	= GETPOST('action','alpha');
$userid = GETPOST('userid','int');

// Access control
if (!$user->admin) {
	// External user
	accessforbidden();
}

/*
 * View
 */

top_httphead();

//print '<!-- Ajax page called with url '.$_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"].' -->'."\n";

// Actions
if (isset($action) && ! empty($action))
{
	if ($action == 'get_hourly_rate')
	{
            if ($userid > 0)
            {
                $staff = new Staff($db);

                $staff->getHourlyRate($userid);
                
                print $staff->hourly_rate;
            }
            else
            {
                print '';
            }
        }
}
