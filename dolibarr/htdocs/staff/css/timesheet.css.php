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

define('NOTOKENRENEWAL', 1);

?>

/*
 * Timesheets / Plannedshifts CSS
 *
 */

/*----- index.php / peruser.php -----*/

li.cal_event {
    margin-bottom: 5px;
}

.cal_event a:hover {
    color: #111;
}
.cal_event a {
    font-size: 13px !important;
}
.rotate {
    display: inline-block;
    margin: 15px 0px 15px;
    font-size: 13px;
    -webkit-transform: rotate(-20deg);
    -moz-transform: rotate(-20deg);
    -o-transform: rotate(-20deg);
    transform: rotate(-20deg);
}

.justify_detail {
    margin-top: 2px;
    display: inline-block;
}

/*----- peruser.php / plannedshift.php -----*/

.cal_today_peruser {
    border-left: solid 1px #E0E0E0;
    border-right: none;
}

/*----- card.php / log.php -----*/

img.photorefcenter {
    width: auto !important;
}

/*----- fix for dolibarr 6.0 -----*/

ul.cal_event {
    list-style: none;
    padding: 0px;
}

<?php
