<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <year>  <name of author>
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
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file    class/myclass.class.php
 * \ingroup mymodule
 * \brief   Example CRUD (Create/Read/Update/Delete) class.
 *
 * Put detailed description here.
 */

/** Includes */
//require_once DOL_DOCUMENT_ROOT."/core/class/commonobject.class.php";
//require_once DOL_DOCUMENT_ROOT."/societe/class/societe.class.php";
include_once DOL_DOCUMENT_ROOT .'/admin/dolistore/class/dolistore.class.php';

/**
 * Put your class' description here
 */
class ActionsStaff
{
	/**
	 * Overloading the printTopRightMenu function
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function printTopRightMenu($parameters, &$object, &$action, $hookmanager)
	{
		global $langs, $conf, $user;
                
		$error = 0; // Error counter
		$myvalue = ''; // A result value
 
		//print_r($parameters);
		//echo "action: " . $action;
		//print_r($object);
 
		if (in_array('toprightmenu', explode(':', $parameters['context'])))
		{
            // do something only for the context 'toprightmenu'
            if ($conf->global->ENABLE_TIMESHEET_QUICK_SHORTCUT)
            {
                $this->results = array('myreturn' => $myvalue);
                // Waiting to submit planned shifts shortcut
                $text = '<a href="'.dol_buildpath('/staff/timesheet/list.php?mainmenu=hrm&leftmenu=plannedshift&type=planned_shift&status=6', 1).'">';
                $text.= img_picto($langs->trans("PlannedShift"), 'waiting_shifts_top@staff');
                $text.= '</a>';
                $this->resprints = @Form::textwithtooltip('',$langs->trans("WaitingToSubmitPlannedShiftQuickShortcut"),2,1,$text,'login_block_elem',2);
                
                if ($user->admin)
                {
                    // Submit Timesheet shortcut
                    $text = '<a href="'.dol_buildpath('/staff/timesheet/card.php?mainmenu=hrm&leftmenu=timesheet&action=create', 1).'">';
                    $text.= img_picto($langs->trans("Timesheet"), 'timesheet_top@staff');
                    $text.= '</a>';
                    $this->resprints.= @Form::textwithtooltip('',$langs->trans("TimesheetQuickShortcut"),2,1,$text,'login_block_elem',2);
                
                    // New Planned shift shortcut
                    $text = '<a href="'.dol_buildpath('/staff/timesheet/plannedshift.php?mainmenu=hrm&leftmenu=plannedshift&action=create', 1).'">';
                    $text.= img_picto($langs->trans("PlannedShift"), 'plannedshift_top@staff');
                    $text.= '</a>';
                    $this->resprints.= @Form::textwithtooltip('',$langs->trans("PlannedshiftQuickShortcut"),2,1,$text,'login_block_elem',2);
                }
            }
		}
 
		if (! $error)
		{
			return 0; // or return 1 to replace standard code
		}
		else
		{
			$this->errors[] = 'Error message';
			return -1;
		}
	}

	/**
	 * Overloading the formObjectOptions function
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function formObjectOptions($parameters, &$object, &$action, $hookmanager)
	{
		global $db, $langs, $conf, $user;
                
		$error = 0; // Error counter
		$myvalue = ''; // A result value
 
		//print_r($parameters);
		//echo "action: " . $action;
		//print_r($object);
 
		if (in_array('usercard', explode(':', $parameters['context'])))
		{
            // do something only for the context 'usercard'
            
            // Staff hourly rate
            if ($action == 'create')
            {
                print '<tr><td>'.$langs->trans("StaffHourlyRate").'</td>';
                print '<td>';
                print '<input size="8" type="text" name="staffhourlyrate" value="'.GETPOST('staffhourlyrate').'">';
                print '</td>';
                print "</tr>\n";
            }
            else
            {
                // fetch Staff hourly rate
                $sql = "SELECT u.staff_hourly_rate";
                $sql.= " FROM ".MAIN_DB_PREFIX."user as u";
                $sql.= " WHERE u.rowid = ".$object->id;
                $sql.= " AND u.employee = 1";
                
                dol_syslog("User::fetch staff hourly rate", LOG_DEBUG);
                $resql = $db->query($sql);
                if ($resql)
                {
                    if ($db->num_rows($resql)) {
                        $obj = $db->fetch_object($resql);
                    }
                }
                
                if ($action == 'edit' || $object->employee)
                {
                    print '<tr><td>'.$langs->trans("StaffHourlyRate").'</td>';
                    print '<td>';
                    if ($action == 'edit') {
                        print '<input size="8" type="text" name="staffhourlyrate" value="'.$obj->staff_hourly_rate.'">';
                    }
                    else {
                        print ($obj->staff_hourly_rate!=''?price($obj->staff_hourly_rate,'',$langs,1,-1,-1,$conf->currency):'');
                    }
                    print '</td>';
                    print "</tr>\n";
                }
            }
		}
        else if (in_array('salarycard', explode(':', $parameters['context'])))
        {
            print '<input type="hidden" name="caller" value="'.GETPOST('caller', 'alpha').'">';
        }
 
		if (! $error)
		{
            //$this->results = array('myreturn' => $myvalue);
            //$this->resprints = 'test';
            
            return 0; // or return 1 to replace standard code
		}
		else
		{
			$this->errors[] = 'Error message';
			return -1;
		}
	}

	/**
	 * Overloading the printFieldListSelect function
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function printFieldListSelect($parameters, &$object, &$action, $hookmanager)
	{
		global $langs, $conf, $user;
                
		$error = 0; // Error counter
		$myvalue = ''; // A result value
 
		//print_r($parameters);
		//echo "action: " . $action;
		//print_r($object);
 
		if (in_array('userlist', explode(':', $parameters['context'])))
		{
            if (function_exists('version_compare') && version_compare(DOL_VERSION, '13.0.0') < 0) {
                // do something only for the context 'userlist'
                $this->resprints = ', u.staff_hourly_rate';
            }
		}
 
		if (! $error)
		{
            //$this->results = array('myreturn' => $myvalue);
            
            return 0; // or return 1 to replace standard code
		}
		else
		{
			$this->errors[] = 'Error message';
			return -1;
		}
	}

	/**
	 * Overloading the printFieldListTitle function
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function printFieldListTitle($parameters, &$object, &$action, $hookmanager)
	{
		global $langs, $conf, $user;
                
		$error = 0; // Error counter
		$myvalue = ''; // A result value
 
		//print_r($parameters);
		//echo "action: " . $action;
		//print_r($object);
 
		if (in_array('userlist', explode(':', $parameters['context'])))
		{
            // do something only for the context 'userlist'
            global $mode, $param, $sortfield, $sortorder;
            
            if ($mode == 'employee') {
                $this->resprints = print_liste_field_titre($langs->trans("StaffHourlyRateListField"),$_SERVER['PHP_SELF'],"u.staff_hourly_rate",$param,"",'align="center"',$sortfield,$sortorder);
            }
		}
 
		if (! $error)
		{
            //$this->results = array('myreturn' => $myvalue);
            
            return 0; // or return 1 to replace standard code
		}
		else
		{
			$this->errors[] = 'Error message';
			return -1;
		}
	}

	/**
	 * Overloading the printFieldListOption function
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function printFieldListOption($parameters, &$object, &$action, $hookmanager)
	{
		global $langs, $conf, $user;
                
		$error = 0; // Error counter
		$myvalue = ''; // A result value
 
		//print_r($parameters);
		//echo "action: " . $action;
		//print_r($object);
 
		if (in_array('userlist', explode(':', $parameters['context'])))
		{
            // do something only for the context 'userlist'
            global $mode;
            
            if ($mode == 'employee') {
                $this->resprints = '<td class="liste_titre"></td>';
            }
		}
 
		if (! $error)
		{
            //$this->results = array('myreturn' => $myvalue);
            
            return 0; // or return 1 to replace standard code
		}
		else
		{
			$this->errors[] = 'Error message';
			return -1;
		}
	}

	/**
	 * Overloading the printFieldListValue function
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function printFieldListValue($parameters, &$object, &$action, $hookmanager)
	{
		global $db, $langs, $conf, $user;
                
		$error = 0; // Error counter
		$myvalue = ''; // A result value
 
		//print_r($parameters);
		//echo "action: " . $action;
		//print_r($object);
 
		if (in_array('userlist', explode(':', $parameters['context'])))
		{
            // do something only for the context 'userlist'
            global $mode;
            
            if ($mode == 'employee')
            {
                $this->resprints = '<td align="center">';
                
                // fetch Staff hourly rate
                $sql = "SELECT u.staff_hourly_rate";
                $sql.= " FROM ".MAIN_DB_PREFIX."user as u";
                $sql.= " WHERE u.rowid = ".$parameters['obj']->rowid;
                $sql.= " AND u.employee = 1";
                
                dol_syslog("User::List::fetch staff hourly rate", LOG_DEBUG);
                $resql = $db->query($sql);
                if ($resql)
                {
                    if ($db->num_rows($resql)) {
                        $obj = $db->fetch_object($resql);
                        
                        $this->resprints.= ($obj->staff_hourly_rate!=''?price($obj->staff_hourly_rate,'',$langs,1,-1,-1,$conf->currency):'');
                    }
                }
                
                $this->resprints.= '</td>';
            }
		}
 
		if (! $error)
		{
            //$this->results = array('myreturn' => $myvalue);
            
            return 0; // or return 1 to replace standard code
		}
		else
		{
			$this->errors[] = 'Error message';
			return -1;
		}
	}
}
