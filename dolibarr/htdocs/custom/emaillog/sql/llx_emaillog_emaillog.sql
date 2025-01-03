-- Copyright (C) ---Put here your own copyright and developer email---
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
-- along with this program.  If not, see https://www.gnu.org/licenses/.


CREATE TABLE llx_emaillog_emaillog(
	-- BEGIN MODULEBUILDER FIELDS
	rowid integer AUTO_INCREMENT PRIMARY KEY NOT NULL, 
	ref varchar(255) NOT NULL, 
	msg_id varchar(255), 
	send_context varchar(128), 
	send_mode varchar(128), 
	subject varchar(255), 
	addr_from varchar(255), 
	addr_reply_to varchar(255), 
	addr_errors_to varchar(255), 
	addr_to varchar(255), 
	addr_cc varchar(255), 
	addr_bcc varchar(255), 
	msg text, 
	is_html boolean, 
	delivery_receipt boolean, 
	error text, 
	send_log text, 
	date_creation datetime NOT NULL, 
	tms timestamp, 
	fk_user_creat integer NOT NULL, 
	fk_user_modif integer, 
	import_key varchar(14)
	-- END MODULEBUILDER FIELDS
) ENGINE=innodb;
