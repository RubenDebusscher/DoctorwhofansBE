<?php
/* Copyright (C) 2005-2014 Laurent Destailleur	<eldy@users.sourceforge.net>
 * Copyright (C) 2005-2014 Regis Houssin		<regis.houssin@capnetworks.com>
 * Copyright (C) 2014      Marcos García		<marcosgdf@gmail.com>
 * Copyright (C) 2015      Bahfir Abbes        <bafbes@gmail.com>
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
 */

/**
 *  \file       htdocs/core/triggers/interface_90_all_Demo.class.php
 *  \ingroup    core
 *  \brief      Fichier de demo de personalisation des actions du workflow
 *  \remarks    Son propre fichier d'actions peut etre cree par recopie de celui-ci:
 *              - Le nom du fichier doit etre: interface_99_modMymodule_Mytrigger.class.php
 *				                           ou: interface_99_all_Mytrigger.class.php
 *              - Le fichier doit rester stocke dans core/triggers
 *              - Le nom de la classe doit etre InterfaceMytrigger
 *              - Le nom de la propriete name doit etre Mytrigger
 */

require_once DOL_DOCUMENT_ROOT.'/core/triggers/dolibarrtriggers.class.php';
dol_include_once('/staff/class/staff.class.php');


/**
 *  Class of triggers for demo module
 */
class InterfacePaySalary extends DolibarrTriggers
{

	public $family = 'staff';
	public $picto = 'payment';
	public $description = "Triggers of this module allows to pay salary of staff";
	public $version = self::VERSION_DOLIBARR;

	/**
     * Function called when a Dolibarrr business event is done.
	 * All functions "runTrigger" are triggered if file is inside directory htdocs/core/triggers or htdocs/module/code/triggers (and declared)
     *
     * @param string		$action		Event action code
     * @param Object		$object     Object concerned. Some context information may also be provided into array property object->context.
     * @param User		    $user       Object user
     * @param Translate 	$langs      Object langs
     * @param conf		    $conf       Object conf
     * @return int         				<0 if KO, 0 if no triggered ran, >0 if OK
     */
    public function runTrigger($action, $object, User $user, Translate $langs, Conf $conf)
    {
        // Put here code you want to execute when a Dolibarr business events occurs.
        // Data and type of action are stored into $object and $action
        
        global $db;
        
	if ($action == 'USER_CREATE' || $action == 'USER_MODIFY')
        {
            dol_syslog("Trigger '".$this->name."' for action '$action' launched by ".__FILE__.". id=".$object->id);
            
            $staff_hourly_rate = GETPOST('staffhourlyrate');
            $hourly_rate = is_numeric($staff_hourly_rate) ? $staff_hourly_rate : ($action == 'USER_MODIFY' ? 'null' : '');
            
            if (! empty($hourly_rate) || $action == 'USER_MODIFY')
            {
                $act = $action == 'USER_CREATE' ? 'set' : 'update';
                
                $staff = new Staff($db);
                
                $result = $staff->setHourlyRate($object->id, $hourly_rate, $act);
                
                if ($result)
                {
                    return 1;
                }
            }
        }
        else if ($action == 'PAYMENT_SALARY_CREATE')
        {
            $caller = GETPOST('caller', 'alpha');
            
            if ($caller == 'staffpaysalary')
            {
                $datesp = dol_mktime(0, 0, 0, GETPOST('datespmonth'), GETPOST('datespday'), GETPOST('datespyear'));
                $dateep = dol_mktime(0, 0, 0, GETPOST('dateepmonth'), GETPOST('dateepday'), GETPOST('dateepyear'));

                $staff = new Staff($db);

                $result = $staff->setTimesheetsToPayed($datesp, $dateep, $object->id, $object->fk_user);

                if ($result)
                {
                    return 1;
                }
            }
        }
        else if ($action == 'PAYMENT_SALARY_DELETE')
        {
            //global $id; //$id = GETPOST('id', 'int');
            
            if ($conf->global->STAFF_RESET_TIMESHEETS_ON_PAYMENT_DELETE)
            {
                $staff = new Staff($db);

                $result = $staff->resetTimesheets($object->id, $object->fk_user);

                if ($result)
                {
                    return 1;
                }
            }
        }
        
        return 0;
    }

}
