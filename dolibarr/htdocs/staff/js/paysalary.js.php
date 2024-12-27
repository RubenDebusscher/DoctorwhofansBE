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
 * \file    js/myjs.js.php
 * \ingroup mymodule
 * \brief   Example JavaScript.
 *
 * Put detailed description here.
 */

define('NOLOGIN', 1);
define('NOREDIRECTBYMAINTOLOGIN', 1);
define('NOTOKENRENEWAL', 1);

// Load Dolibarr environment
$mod_path = "";
if (false === (@include '../../main.inc.php')) {  // From htdocs directory
	require '../../../main.inc.php'; // From "custom" directory
	$mod_path = "/custom";
}

global $conf;

header('Content-Type: application/javascript');

if ($conf->use_javascript_ajax)
{

?>

$(document).ready(function() {

<?php

print "$('#userid').change(function() {
            if ($(this).val() > 0) {
                $.get('".DOL_URL_ROOT.$mod_path."/staff/ajax/ajax.php', {
                        action: \"get_hourly_rate\",
                        userid: $(this).val()
                },
                function(response) {
                    $('#amountperhour').val(response);
                });
            }
            else {
                $('#amountperhour').val('');
            }
        });
            
        ";

?>

});

<?php

} // fin if (! empty($conf->use_javascript_ajax))

