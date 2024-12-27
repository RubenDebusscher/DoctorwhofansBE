<?php

dol_include_once('/h2g2/class/abstractmigration.class.php');

/**
 * Class ModuleHoraireTiersMigrationV16_0_00 Class to manage migration for version 16.0.00
 */
class HoraireTiersMigrationV16_0_00 extends AbstractMigration
{
	public $version = "16.0.00"; // Version of execution
	public $description = 'Migration for the version 16.0.00 of HoraireTiers module'; // Description
	public $name = 'HoraireTiersMigration_16.0.00'; // Migration name

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
