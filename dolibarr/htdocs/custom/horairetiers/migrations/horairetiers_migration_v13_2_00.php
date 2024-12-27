<?php

dol_include_once('h2g2/class/abstractmigration.class.php');

/**
 * Class ModuleHoraireTiersMigrationV13_0_02 Class to manage migration for version 13.2.00
 */
class HoraireTiersMigrationV13_2_00 extends AbstractMigration
{
	public $version = "13.2.00"; // Version of execution
	public $description = 'Migration for the version 13.2.00 of HoraireTiers module'; // Description
	public $name = 'HoraireTiersMigration_13.2.00'; // Migration name

	/**
	 * Method executed when we up the migration
	 *
	 * @return 	void
	 */
	public function up()
	{
		//Queries to up
	}

	/**
	 * Method executed when we rollback the migration
	 *
	 * @return 	void
	 */
	public function down()
	{
		//Queries to down
	}
}
