<?php

dol_include_once('h2g2/class/abstractmigration.class.php');

/**
 * Class ModuleHoraireTiersMigrationV13_0_01 Class to manage migration for version 13.0.01
 */
class HoraireTiersMigrationV13_0_01 extends AbstractMigration
{
	public $version = "13.0.01"; // Version of execution
	public $description = 'Migration for the version 13.0.01 of HoraireTiers module'; // Description
	public $name = 'HoraireTiersMigration_13.0.01'; // Migration name

	/**
	 * Method executed when we up the migration
	 *
	 * @return 	void
	 */
	public function up()
	{
		$creationQuery = 'ALTER TABLE '.MAIN_DB_PREFIX.'horairetiers_hours ADD continuous_day boolean';
		$this->addQuery($creationQuery);
	}

	/**
	 * Method executed when we rollback the migration
	 *
	 * @return 	void
	 */
	public function down()
	{
		$removeQuery = 'ALTER TABLE '.MAIN_DB_PREFIX.'horairetiers_hours DROP COLUMN continuous_day';
		$this->addQuery($removeQuery);
	}
}
