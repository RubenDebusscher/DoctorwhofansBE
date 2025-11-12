-- <one line to give the program's name and a brief idea of what it does.>
-- Copyright (C) <year>  <name of author>
--
-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.

CREATE TABLE llx_staff_timesheet(
	rowid INTEGER AUTO_INCREMENT PRIMARY KEY,
        entity INTEGER DEFAULT 1 NOT NULL,
        ref VARCHAR(30) NOT NULL,
        origin VARCHAR(255) DEFAULT NULL,
        day DATE NOT NULL,
        start_time TIME NOT NULL,
        end_time TIME NULL,
        time_diff INT DEFAULT 0 NOT NULL, -- time diff in minutes
        fk_user INTEGER NOT NULL, -- staff/user
        created_by INTEGER NOT NULL, -- user who submit the timesheet
        note TEXT DEFAULT NULL,
        payment_id INTEGER DEFAULT NULL, -- do not link to the payment table rowid, because if staff module is disabled, deleting existing payments will give fk errors..
        status INTEGER DEFAULT 0 NOT NULL
);

CREATE TABLE llx_staff_timesheet_log(
	rowid INTEGER AUTO_INCREMENT PRIMARY KEY,
        fk_timesheet INTEGER NOT NULL, -- timesheet id
        action VARCHAR(255) NOT NULL,
        datec DATETIME NOT NULL,
        fk_author INTEGER NOT NULL
);
