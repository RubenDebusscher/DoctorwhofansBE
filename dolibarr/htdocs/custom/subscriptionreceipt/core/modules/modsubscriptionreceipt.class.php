<?php
 /* Copyright (C) 2012-2015	Charlie BENKE	 <charlie@patas-monkey.com>
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
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * or see http://www.gnu.org/
 */

/**
 *	\defgroup   subscriptionreceipt	 Module subscriptionreceipt cards
 *	\brief	  Module to manage subscriptionreceipt cards
 *	\file	   htdocs/core/modules/modsubscriptionreceipt.class.php
 *	\ingroup	Matériels
 *	\brief	  Fichier de description et activation du module subscriptionreceipt
 */

include_once(DOL_DOCUMENT_ROOT ."/core/modules/DolibarrModules.class.php");


/**
 *	\class	  modsubscriptionreceipt
 *	\brief	  Classe de description et activation du module subscriptionreceipt
 */
class modsubscriptionreceipt extends DolibarrModules
{
	/**
	*   Constructor. Define names, constants, directories, boxes, permissions
	*
	*   @param	  DoliDB		$db	  Database handler
	*/
    function __construct($db) {
		global $conf;

		$this->db = $db;
		$this->numero = 161130;
		$this->rights_class = 'subscriptionreceipt';//nécessaire pour compatibilité avec gma

		$this->family = "Ab1 Consulting";
		$this->name = preg_replace('/^mod/i','',get_class($this));
		$this->description = "Gestion des documents de paiement de cotisations d'adhérents";

		$this->version = '3.0';

		$this->const_name = 'MAIN_MODULE_'.strtoupper($this->name);
		$this->special = 0;
        $this->picto = 'subscriptionreceipt@subscriptionreceipt';

		// Dependencies
		$this->depends = array("modAdherent","modNumberWords");
		$this->requiredby = array();
		$this->conflictwith = array();
		$this->langfiles = array("subscriptionreceipt@subscriptionreceipt");

		// Config pages
		$this->config_page_url = array("setup.php@subscriptionreceipt");

		$this->module_parts = array(
            'models' => 1,
//            'js' => 'subscriptionreceipt/js/subscriptionreceipt.js.php'
        );
        $this->menu=array();

        // Constantes
		$this->const = array();
        $r=0;
		$this->const[$r][0] = "SUBSCRIPTION_RECEIPT_ADDON_PDF";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "cesame";
		$this->const[$r][4] = 1;

        // Permissions
        $this->rights = array();
        $r = 0;

        $r++;
        $this->rights[$r][0] = 51201;
        $this->rights[$r][1] = 'lire les pdf';
        $this->rights[$r][2] = 'r';
        $this->rights[$r][3] = 1;
        $this->rights[$r][4] = 'lire';

        // Additionnals subscriptionreceipt tabs in other modules
        $this->tabs = array(
				'subscription:+subscriptionreceipt:subscriptionreceipt:subscriptionreceipt@subscriptionreceipt:/subscriptionreceipt/tabs/subscriptionreceipt.php?id=__ID__'
			);

	}

	/**
	 *		Function called when module is enabled.
	 *		The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
	 *		It also creates data directories
	 *
	 *	  @param	  string	$options	Options when enabling module ('', 'noboxes')
	 *	  @return	 int			 	1 if OK, 0 if KO
	 */
	function init($options='')
	{
		global $conf;
		// Permissions
		$this->remove($options);

		$sql = array();

		$result=$this->load_tables();

		return $this->_init($sql,$options);
	}

	/**
	 *		Function called when module is disabled.
	 *	  Remove from database constants, boxes and permissions from Dolibarr database.
	 *		Data directories are not deleted
	 *
	 *	  @param	  string	$options	Options when enabling module ('', 'noboxes')
	 *	  @return	 int			 	1 if OK, 0 if KO
	 */
	function remove($options='')
	{
		$sql = array();
		return $this->_remove($sql,$options);
	}

	/**
	 *		Create tables, keys and data required by module
	 * 		Files llx_table1.sql, llx_table1.key.sql llx_data.sql with create table, create keys
	 * 		and create data commands must be stored in directory /mymodule/sql/
	 *		This function is called by this->init.
	 *
	 * 		@return		int		<=0 if KO, >0 if OK
	 */
	function load_tables()
	{
		return $this->_load_tables('');
	}
}
?>
