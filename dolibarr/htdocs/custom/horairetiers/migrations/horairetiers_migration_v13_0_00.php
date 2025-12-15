<?php

dol_include_once('h2g2/class/abstractmigration.class.php');

/**
 * Class ModuleHoraireTiersMigrationV13_0_00 Class to manage migration for version 13.0.00
 */
class HoraireTiersMigrationV13_0_00 extends AbstractMigration
{
	public $version = "13.0.00"; // Version of execution
	public $description = 'Migration for the version 13.0.00 of HoraireTiers module'; // Description
	public $name = 'HoraireTiersMigration_13.0.00'; // Migration name

	/**
	 * Method executed when we up the migration
	 *
	 * @return 	void
	 */
	public function up()
	{
		$creationQuery = 'CREATE TABLE '.MAIN_DB_PREFIX.'horairetiers_hours(
                       rowid integer AUTO_INCREMENT PRIMARY KEY NOT NULL,
                       fk_soc integer,
                       day varchar(10),
                       work boolean,
                       h1_start varchar(10),
                       h1_end varchar(10),
                       h2_start varchar(10),
                       h2_end varchar(10),
                       entity integer DEFAULT 1,
                       user_edit integer,
                       tms timestamp
                   )';
		$this->addQuery($creationQuery);
	}

	/**
	 * Method executed when we rollback the migration
	 *
	 * @return 	void
	 */
	public function down()
	{
		$this->addQuery('DROP TABLE '.MAIN_DB_PREFIX.'horairetiers_hours');
	}
}
