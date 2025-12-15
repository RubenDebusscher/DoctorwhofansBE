<?php

dol_include_once('/h2g2/class/abstractmigration.class.php');

/**
 * Class ModuleHoraireTiersMigrationV14_0_01 Class to manage migration for version 14.0.01
 */
class HoraireTiersMigrationV14_0_01 extends AbstractMigration
{
	public $version = "14.0.01"; // Version of execution
	public $description = 'Migration for the version 14.0.01 of HoraireTiers module'; // Description
	public $name = 'HoraireTiersMigration_14.0.01'; // Migration name

	/**
	 * Method executed when we up the migration
	 *
	 * @return 	void
	 */
	public function up()
	{
		// empty migration
	}

	/**
	 * Method executed when we rollback the migration
	 *
	 * @return 	void
	 */
	public function down()
	{
		// empty migration
	}
}
