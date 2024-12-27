<?php

dol_include_once('h2g2/class/abstractmigration.class.php');

/**
 * Class ModuleHoraireTiersMigrationV13_2_01 Class to manage migration for version 13.2.01
 */
class HoraireTiersMigrationV13_2_01 extends AbstractMigration
{
	public $version = "13.2.01"; // Version of execution
	public $description = 'Migration for the version 13.2.01 of HoraireTiers module'; // Description
	public $name = 'HoraireTiersMigration_13.2.01'; // Migration name

	/**
	 * Method executed when we up the migration
	 *
	 * @return 	void
	 */
	public function up()
	{
		//Queries to up
		$this->addQuery("ALTER TABLE ".MAIN_DB_PREFIX."horairetiers_hours ALTER COLUMN \"work\" TYPE integer USING \"work\"::integer");
		$this->addQuery("ALTER TABLE ".MAIN_DB_PREFIX."horairetiers_hours ALTER COLUMN \"continuous_day\" TYPE integer USING \"continuous_day\"::integer");
	}

	/**
	 * Method executed when we rollback the migration
	 *
	 * @return 	void
	 */
	public function down()
	{
		$this->addQuery("DELETE FROM ".MAIN_DB_PREFIX."const WHERE name = \"HORAIRETIERS_WIZARD\"");
	}
}
