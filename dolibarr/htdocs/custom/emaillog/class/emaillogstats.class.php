<?php
/* Copyright (C) 2003      Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (c) 2005-2013 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2005-2009 Regis Houssin        <regis.houssin@inodbox.com>
 * Copyright (c) 2011      Juanjo Menent		<jmenent@2byte.es>
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
 *	\file       emaillog/class/emaillogstats.class.php
 *	\ingroup    emaillog
 *	\brief      File of class to manage email log statistics
 */

include_once DOL_DOCUMENT_ROOT . '/core/class/stats.class.php';
include_once 'emaillog.class.php';
include_once DOL_DOCUMENT_ROOT . '/core/lib/date.lib.php';


/**
 *	Class to manage statistics of email logs
 */
class EmailLogStats extends Stats
{
    /**
     * @var string Name of table without prefix where object is stored
     */
    public $table_element;

    public $userid;

    public $from;
    public $field;
    public $where;


	/**
	 *	Constructor
	 *
	 *	@param 		DoliDB		$db			Database handler
     * 	@param   	int			$userid    	Id user for filter
	 */
	public function __construct($db, $userid = 0)
	{
		global $user, $conf;

		$this->db = $db;
        $this->userid = $userid;

		$object=new EmailLog($this->db);

		$this->from = MAIN_DB_PREFIX.$object->table_element." as l";

		$this->field='msg_id';

		//$this->where.= " m.statut != 0";
		//$this->where.= " AND p.fk_adherent = m.rowid AND m.entity IN (".getEntity('adherent').")";
	}

	/**
	 * Return the number of emails by month for a given year
	 *
     * @param   int		$year       Year
     *	@param	int		$format		0=Label of abscissa is a translated text, 1=Label of abscissa is month number, 2=Label of abscissa is first letter of month
     * @return	array				Array of nb each month
	 */
	public function getNbEmailsByMonth($year, $format = 0)
	{
		global $user;

		$sql = "SELECT date_format(l.date_creation,'%m') as dm, count(*)";
		$sql.= " FROM ".$this->from;
		//if (!$user->rights->societe->client->voir && !$user->socid) $sql.= ", ".MAIN_DB_PREFIX."societe_commerciaux as sc";
		$sql.= " WHERE date_format(l.date_creation,'%Y') = '".$year."'";
		//$sql.= " AND ".$this->where;
		$sql.= " GROUP BY dm";
        $sql.= $this->db->order('dm', 'DESC');

		return $this->_getNbByMonth($year, $sql, $format);
    }
    
    public function getNbErrorsByMonth($year, $format = 0)
	{
		global $user;

		$sql = "SELECT date_format(l.date_creation,'%m') as dm, count(*)";
		$sql.= " FROM ".$this->from;
		//if (!$user->rights->societe->client->voir && !$user->socid) $sql.= ", ".MAIN_DB_PREFIX."societe_commerciaux as sc";
        $sql.= " WHERE date_format(l.date_creation,'%Y') = '".$year."'";
        $sql.= " AND error IS NOT NULL AND error <> ''";
		//$sql.= " AND ".$this->where;
		$sql.= " GROUP BY dm";
        $sql.= $this->db->order('dm', 'DESC');

		return $this->_getNbByMonth($year, $sql, $format);
	}

}
