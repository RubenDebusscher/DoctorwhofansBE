<?php
/* Copyright (C) 2000-2005 Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2003      Jean-Louis Bergamo   <jlb@j1b.org>
 * Copyright (C) 2004-2009 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2005-2009 Regis Houssin        <regis.houssin@inodbox.com>
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
 * or see https://www.gnu.org/
 */

/**
 *      \file       htdocs/core/class/antivir.class.php
 *      \brief      File of class to scan viruses
 */

require_once DOL_DOCUMENT_ROOT.'/core/class/extrafields.class.php';
require_once DOL_DOCUMENT_ROOT.'/projet/class/project.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formprojet.class.php';

/**
 * Class Actionsprojectincontractlist
 */
class Actionsprojectincontractlist
{
	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * @var array Errors
	 */
	public $errors = array();


	/**
	 * Constructor
	 */
	public function __construct()
	{

	}

	public function printFieldListSelect($parameters=false, &$object, &$action='', $hookmanager)
	{
		global $conf, $langs, $form;

		if (empty($conf->projectincontractlist->enabled)) return 0;

		$currentpage = (explode(':', $parameters['context']));

		if(in_array('contractlist', $currentpage)) {

			$hookmanager->resPrint .= " , c.fk_projet";

			global $search_project_ref;

			$search_project_ref = GETPOST('search_project_ref', 'alpha');

			if (GETPOST('button_removefilter_x', 'alpha') || GETPOST('button_removefilter', 'alpha') || GETPOST('button_removefilter.x', 'alpha')) {
				$search_project_ref = '';
			}
		}
	}



	public function printFieldListOption($parameters, &$object, &$action, $hookmanager){
		global $conf, $langs, $form, $user, $db, $search_project_ref;

		if (empty($conf->projectincontractlist->enabled)) return 0;

		$currentpage = (explode(':', $parameters['context']));

		if(in_array('contractlist', $currentpage)) {

			$formproject = new FormProjets($db);

			$socid = 0;
			if ($user->socid) {
				$socid = $user->socid;
			}
			$moreforfilter .= '<td class="liste_titre">';
			$moreforfilter .= $formproject->select_projects(($socid > 0 ? $socid : -1), $search_project_ref, 'search_project_ref', 0, 0, 1, 0, 0, 0, 0, '', 1, 0, 'maxwidth200');
			// $moreforfilter .= '<input class="flat maxwidth50imp" type="text" name="search_project_ref" value="'.$search_project_ref.'">';
			$moreforfilter .= '</td>';

			print $moreforfilter;
		}
	}

	public function printFieldListTitle($parameters=false, &$object, &$action='', $hookmanager)
	{
		global $conf, $langs, $form;

		if (empty($conf->projectincontractlist->enabled)) return 0;

		$currentpage = (explode(':', $parameters['context']));

		if(in_array('contractlist', $currentpage)) {

			global $param, $sortfield, $sortorder;

			print_liste_field_titre($langs->trans('ProjectRef'), $_SERVER['PHP_SELF'], "p.ref", '', $param, '', $sortfield, $sortorder);
		}
	}

	public function printFieldListValue($parameters=false)
	{
		global $conf, $user, $db;

		$currentpage = array_pop(explode(':', $parameters['context']));

		if (empty($conf->projectincontractlist->enabled)) return 0;

		if($currentpage == 'contractlist') {

			$obj = $parameters['obj'];
			$sc = '';

			$sc .= '<td class="nocellnopadd nowraponall">';
			if ($obj->fk_projet > 0) {
				$projectstatic = new Project($db);
				$res = $projectstatic->fetch($obj->fk_projet);
				if($res)
					$sc .= $projectstatic->getNomUrl(1);
			}
			$sc .= '</td>';

			$this->resprints = $sc;
		}
	}

	public function printFieldListWhere($parameters=false, &$object, &$action='', $hookmanager)
	{
		global $conf, $langs, $form, $db, $search_project_ref;

		if (empty($conf->projectincontractlist->enabled)) return 0;

		$currentpage = (explode(':', $parameters['context']));

		if(in_array('contractlist', $currentpage)) {
			if ($search_project_ref) {
				$sql .= natural_search('c.fk_projet', $search_project_ref);
			}
			$hookmanager->resPrint = $sql;
		}
	}
	
}
