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

--ALTER TABLE llx_staff_timesheet ADD payment_id INTEGER DEFAULT NULL;

--ALTER TABLE llx_staff_timesheet ADD origin VARCHAR(255) DEFAULT NULL;

--UPDATE llx_staff_timesheet SET origin = 'planned_shift' WHERE status = 5 OR status = 6;

ALTER TABLE llx_user ADD staff_hourly_rate DOUBLE DEFAULT NULL; -- staff hourly rate -> llx_user table
