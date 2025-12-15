<?php
/* Copyright (C) 2021 SuperAdmin
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * \file    horairetiers/class/actions_horairetiers.class.php
 * \ingroup horairetiers
 * \brief   Example hook overload.
 *
 * Put detailed description here.
 */

/**
 * Class ActionsHorairetiers
 */
class ActionsHorairetiers
{
	/**
	 * @var DoliDB Database handler.
	 */
	public $db;

	/**
	 * @var string Error code (or message)
	 */
	public $error = '';

	/**
	 * @var array Errors
	 */
	public $errors = array();


	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;


	/**
	 * Constructor
	 *
	 *  @param		DoliDB		$db      Database handler
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}

	/**
	 * Get the module header for information tab
	 *
	 * @param   array       $parameters         Array of parameter (we only use $parameters['module'] to check module header to display)
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function generateMigrationTabHeader($parameters)
	{
		dol_include_once('/horairetiers/lib/horairetiers.lib.php');

		// Check if we need to display watchman information header
		if ($parameters['module'] == 'modHorairetiers') {
			$this->results['head'] = horairetiersAdminPrepareHead();
			$this->results['active_tab'] = 'migration';
			$this->results['langs'] = 'horairetiers@horairetiers';
			$this->results['header_icon'] = '';
			return 1;
		}
	}

	/**
	 * Get the module header for information tab
	 *
	 * @param   array       $parameters         Array of parameter (we only use $parameters['module'] to check module header to display)
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function generateInformationTabHeader($parameters)
	{
		dol_include_once('/horairetiers/lib/horairetiers.lib.php');

		// Check if we need to display watchman information header
		if ($parameters['module'] == 'modHorairetiers') {
			$this->results['head'] = horairetiersAdminPrepareHead();
			$this->results['active_tab'] = 'information';
			$this->results['langs'] = 'horairetiers@horairetiers';
			$this->results['header_icon'] = '';
			return 1;
		}
	}
}
