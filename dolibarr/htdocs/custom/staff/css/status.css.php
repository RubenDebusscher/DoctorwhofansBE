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
 * Some colors HEX code:
 *
 * light grey: #e8e6e7
 * grey: #777
 * light blue: #428bca
 * light green: #5cb85c
 * sky blue: #5bc0de
 * light orange: #f0ad4e
 * light red: #d9534f
 *
 */

.pending {
    background-color: #777;
}

.validated {
    background-color: #5cb85c;
}

.refused {
    background-color: #d9534f;
}

.paid {
    background-color: #f0ad4e;
}

.waiting_to_confirm {
    background-color: #777;
}

.waiting_to_submit {
    background-color: #f0ad4e;
}

.status {
    float: left;
    margin-top: -4px;
    margin-right: 5px;
}

.labeled {
    color: #fff;
    font-weight: bold;
    font-size: 12px;
    padding: 5px;
    border-radius: 4px;
    display: inline-block;
}

.origin {
    font-size: 13px;
}

.light-blue {
    background-color: #428bca;
}

.light-grey {
    background-color: #e8e6e7;
    color: #777;
}

<?php
