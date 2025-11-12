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
 * \file    css/mycss.css.php
 * \ingroup mymodule
 * \brief   Example CSS.
 *
 * Put detailed description here.
 */

header('Content-Type: text/css');

define('NOLOGIN', 1);
define('NOREDIRECTBYMAINTOLOGIN', 1);
define('NOTOKENRENEWAL', 1);

// Load Dolibarr environment
if (false === (@include '../../main.inc.php')) {  // From htdocs directory
	require '../../../main.inc.php'; // From "custom" directory
}

global $conf;

if ($conf->global->ENABLE_TIMESHEET_QUICK_SHORTCUT && $conf->theme != 'md') // login_block is pulled to left in md theme, so we dont need to override the css
{

?>

/*
 * Staff CSS
 *
 */

/*----- override dolibarr css -----*/

div.login_block {
    max-width: 150px;
}

<?php

}
