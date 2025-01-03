-- Copyright (C) 2024 Johnson
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


CREATE TABLE llx_preopportunity_preopportunity(
	-- BEGIN MODULEBUILDER FIELDS
	rowid integer AUTO_INCREMENT PRIMARY KEY NOT NULL, 
	ref varchar(128) DEFAULT '(PROV)' NOT NULL, 
	firstname varchar(50) NOT NULL, 
	lastname varchar(50), 
	companyname varchar(128), 
	status integer NOT NULL, 
	email varchar(128) NOT NULL, 
	phone varchar(20), 
	phonemobile varchar(20), 
	fax varchar(30), 
	address text, 
	zip varchar(25), 
	town varchar(50), 
	fk_pays integer, 
	fk_departement integer, 
	source integer NOT NULL, 
	fk_soc integer, 
	fk_contacts integer, 
	fk_project integer, 
	description text, 
	note_public text, 
	note_private text, 
	date_creation datetime NOT NULL, 
	tms timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
	fk_user_creat integer NOT NULL, 
	fk_user_modif integer, 
	import_key varchar(14)
	-- END MODULEBUILDER FIELDS
) ENGINE=innodb;

ALTER TABLE llx_preopportunity_preopportunity ADD COLUMN entity integer DEFAULT 1 NOT NULL AFTER rowid;
ALTER TABLE llx_preopportunity_preopportunity CHANGE `date_creation` `date_creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE llx_preopportunity_preopportunity CHANGE `source` `source` INT NULL;
