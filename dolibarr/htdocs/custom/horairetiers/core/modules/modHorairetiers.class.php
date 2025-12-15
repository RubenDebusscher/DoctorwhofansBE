<?php
/* Copyright (C) 2021  Ayoub Bayed     <ayoub@code42.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * 	\defgroup   horairetiers     Module Horairetiers
 *  \brief      Horairetiers module descriptor.
 *
 *  \file       htdocs/horairetiers/core/modules/modHorairetiers.class.php
 *  \ingroup    horairetiers
 *  \brief      Description and activation file for module Horairetiers
 */
include_once DOL_DOCUMENT_ROOT.'/core/modules/DolibarrModules.class.php';

dol_include_once('/h2g2/class/thegalaxy.class.php');
dol_include_once('/h2g2/core/modules/modH2G2.class.php');

// Verify if the class exists to instantiate the class
if (!class_exists('TheGalaxy')) {
	/**
	 *  Creation of dummy TheGalaxy module to avoid errors
	 */
	class TheGalaxy extends DolibarrModules
	{

		/**
		 * Variable used to prompt "missing H2G2' error
		 */
		public $dummy;

		/**
		 * TheGalaxy constructor
		 */
		public function __construct()
		{
			$this->dummy = 1;
		}

		/**
		 * Dummy addTable function
		 *
		 * @param 	int 		$objectType			dummy
		 * @param 	int			$tabId				dummy
		 * @param 	int			$title				dummy
		 * @param 	int			$right				dummy
		 * @param 	int			$url				dummy
		 * @return void
		 */
		public function addTab($objectType, $tabId, $title, $right, $url): void
		{
		}

		/**
		 * Dummy addRight function
		 *
		 * @param 	int 		$label				dummy
		 * @param 	int			$level1				dummy
		 * @param 	int			$level2				dummy
		 * @param 	int			$type				dummy
		 * @param 	int			$enabledByDefault	dummy
		 * @return void
		 */
		public function addRight($label, $level1, $level2, $type = '', $enabledByDefault = 0): void
		{
		}

		/**
		 * Dummy addMenu function
		 *
		 * @param 	int			$type				dummy
		 * @param 	int			$fkMenu				dummy
		 * @param 	int			$mainMenu			dummy
		 * @param 	int			$leftMenu			dummy
		 * @param 	int			$title				dummy
		 * @param 	int			$url				dummy
		 * @param 	int			$position			dummy
		 * @param 	int			$perms				dummy
		 * @param 	int			$enabled			dummy
		 * @param 	int			$target				dummy
		 * @param 	int			$user				dummy
		 * @param 	int			$icon				dummy
		 * @return void
		 */
		public function addMenu($type, $fkMenu, $mainMenu, $leftMenu, $title, $url, $position, $perms, $enabled, $target, $user, $icon): void
		{
		}

		/**
		 * Dummy addTopMenu function
		 *
		 * @param 	int			$mainMenu			dummy
		 * @param 	int			$title				dummy
		 * @param 	int			$url				dummy
		 * @param 	int			$icon				dummy
		 * @param 	int			$position			dummy
		 * @param 	int			$perms				dummy
		 * @param 	int			$enabled			dummy
		 * @param 	int			$target				dummy
		 * @param 	int			$user				dummy
		 * @return void
		 */
		public function addTopMenu($mainMenu, $title, $url, $icon = '', $position = 0, $perms = '1', $enabled = '', $target = '', $user = 2): void
		{
		}

		/**
		 * Dummy addLeftMenu function
		 *
		 * @param 	int			$mainMenu			dummy
		 * @param 	int			$leftMenu			dummy
		 * @param 	int			$title				dummy
		 * @param 	int			$url				dummy
		 * @param 	int			$icon				dummy
		 * @param 	int			$position			dummy
		 * @param 	int			$perms				dummy
		 * @param 	int			$enabled			dummy
		 * @param 	int			$target				dummy
		 * @param 	int			$user				dummy
		 * @return void
		 */
		public function addLeftMenu($mainMenu, $leftMenu, $title, $url, $icon = '', $position = 0, $perms = '1', $enabled = '', $target = '', $user = 2): void
		{
		}

		/**
		 * Dummy addLeftSubMenu function
		 *
		 * @param 	int			$mainMenu			dummy
		 * @param 	int			$leftMenu			dummy
		 * @param 	int			$subMenuName		dummy
		 * @param 	int			$title				dummy
		 * @param 	int			$url				dummy
		 * @param 	int			$icon				dummy
		 * @param 	int			$position			dummy
		 * @param 	int			$perms				dummy
		 * @param 	int			$enabled			dummy
		 * @param 	int			$target				dummy
		 * @param 	int			$user				dummy
		 * @return void
		 */
		public function addLeftSubMenu($mainMenu, $leftMenu, $subMenuName, $title, $url, $icon = '', $position = 0, $perms = '1', $enabled = '', $target = '', $user = 2): void
		{
		}

		/**
		 * Dummy addConstant function
		 *
		 * @param 	int			$name				dummy
		 * @param 	int			$type				dummy
		 * @param 	int			$value				dummy
		 * @param 	int			$desc				dummy
		 * @param 	int			$visible			dummy
		 * @param 	int			$entity				dummy
		 * @param 	int			$deleteonunactive	dummy
		 * @return void
		 */
		public function addConstant($name, $type, $value, $desc = '', $visible = 0, $entity = 'current', $deleteonunactive = 0): void
		{
		}

		/**
		 * Dummy addWidget function
		 *
		 * @param 	int			$file				dummy
		 * @param 	int			$note				dummy
		 * @param 	int			$enabledbydefaulton	dummy
		 * @return void
		 */
		public function addWidget($file, $note = '', $enabledbydefaulton = 'Home'): void
		{
		}
	}
}

// We declare the module only if TheGalaxy is included

/**
 *  Description and activation class for module Horairetiers
 */
class modHorairetiers extends TheGalaxy
{
	/**
	 * Constructor. Define names, constants, directories, boxes, permissions
	 *
	 * @param DoliDB $db Database handler
	 */
	public function __construct($db)
	{
		global $langs, $conf;
		$this->db = $db;
		$this->defaultLangFile = 'horairetiers@horairetiers';
		parent::__construct();

		$this->migrationPath = '/horairetiers/migrations';
		$this->numero = 448440;
		$this->rights_class = 'horairetiers';
		$this->family = "Code 42";
		$this->module_position = '90';
		$this->name = preg_replace('/^mod/i', '', get_class($this));
		$this->description = "HorairetiersDescription";
		$this->descriptionlong = "HorairetiersDescription (Long)";
		$this->editor_name = 'Code 42';
		$this->editor_url = 'https://www.code42.fr';
		$this->version = '16.0.00';
		// Liste des versions
		$this->versionList = array(
			'13.0.00',
			'13.0.01',
			'13.2.00',
			'13.2.01',
			'13.2.02',
			'14.0.00',
			'14.0.01',
			'14.0.02',
			'16.0.00'
		);

		$this->const_name = 'MAIN_MODULE_' . strtoupper($this->name);
		$this->picto = 'horairetiers@horairetiers';
		$this->module_parts = array(
			'triggers' => 0,
			'login' => 0,
			'substitutions' => 0,
			'menus' => 0,
			'tpl' => 0,
			'barcode' => 0,
			'models' => 0,
			'printing' => 0,
			'theme' => 0,
			'css' => array(),
			'js' => array(),
			'hooks' => array('h2g2'),
			'moduleforexternal' => 0,
		);

		$this->dirs = array("/horairetiers/temp");
		$this->config_page_url = array(dol_buildpath('horairetiers/admin/setup.php', 1));
		$this->hidden = false;
		$this->depends = array();
		$this->requiredby = array(); // List of module class names as string to disable if this one is disabled. Example: array('modModuleToDisable1', ...)
		$this->conflictwith = array(); // List of module class names as string this module is in conflict with. Example: array('modModuleToDisable1', ...)
		$this->langfiles = array("horairetiers@horairetiers");
		$this->phpmin = array(5, 5); // Minimum version of PHP required by module
		$this->need_dolibarr_version = array(11, -3); // Minimum version of Dolibarr required by module
		$this->warnings_activation = array(); // Warning to show when we activate module. array('always'='text') or array('FR'='textfr','ES'='textes'...)
		$this->warnings_activation_ext = array(); // Warning to show when we activate an external module. array('always'='text') or array('FR'='textfr','ES'='textes'...)
		$this->const = array();

		if (!isset($conf->horairetiers) || !isset($conf->horairetiers->enabled)) {
			$conf->horairetiers = new stdClass();
			$conf->horairetiers->enabled = 0;
		}

		// Add new const
		$langs->load('horairetiers@horairetiers');
		$this->addConstant('HORAIRETIERS_WIZARD', 'chaine', $langs->trans('HoraireTiersWizard'));

		// Add new pages in new tabs
		$this->addTab('thirdparty', 'openinghours', "HoraireTiersHours", '', '/horairetiers/openinghours.php?id=__ID__');
		$this->addTab('ticket', 'openinghours', "HoraireTiersHours", '', '/horairetiers/openinghours.php?id=__ID__&origin=ticket');
		$this->addTab('intervention', 'openinghours', "HoraireTiersHours", '', '/horairetiers/openinghours.php?id=__ID__&origin=interventions');

		// Dictionaries
		$this->dictionaries = array();

		$this->boxes = array();
		$this->cronjobs = array();
		$this->menu = array();
	}

	/**
	 *  Function called when module is enabled.
	 *  The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
	 *  It also creates data directories
	 *
	 * @param string $options Options when enabling module ('', 'noboxes')
	 * @return     int                1 if OK, 0 if KO
	 */
	public function init($options = '')
	{
		global $langs;

		$langs->load("horairetiers@horairetiers");
		// [#90] If dummy is true, we print "Missing H2G2" error
		if ($this->dummy > 0) {
			setEventMessage($langs->trans("HoraireTiersModuleH2G2Missing", $this->name), 'errors');
			return 0;
		}


		// Module h2g2 must be in version 15.0.00 minimum
		$error = true;
		$minVersion = '15.0.00';
		if (class_exists('modH2G2')) {
			$h2g2 = new modH2G2($this->db);
			if (version_compare($h2g2->version, $minVersion, '>='))
				$error = false;
		}

		if ($error) {
			$message = $langs->trans('H2G2MinimumVersionRequired', $minVersion);
			setEventMessage($message, 'errors');
			return 0;
		}

		// Permissions
		$this->remove($options);

		$sql = array();

		return $this->_init($sql, $options);
	}

	/**
	 *  Function called when module is disabled.
	 *  Remove from database constants, boxes and permissions from Dolibarr database.
	 *  Data directories are not deleted
	 *
	 * @param string $options Options when enabling module ('', 'noboxes')
	 * @return     int                 1 if OK, 0 if KO
	 */
	public function remove($options = '')
	{
		$sql = array();
		return $this->_remove($sql, $options);
	}
}
