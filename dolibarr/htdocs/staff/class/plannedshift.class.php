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
dol_include_once('/staff/class/timesheet.class.php');

/**
 * Put your class' description here
 */
class PlannedShift extends Timesheet
{

    /** @var DoliDb Database handler */
	//public $db;
    /** @var string Error code or message */
	//public $error;
    /** @var array Several error codes or messages */
	//public $errors = array();
    /** @var string Id to identify managed object */
	public $element='plannedshift';
    /** @var string Name of table without prefix where object is stored */
	//public $table_element='staff_timesheet';
    /** @var string Id to identify managed object */
	public $picto='plannedshift-48@staff';
    /** @var int An example ID */
	//public $id;
    /** @var mixed An example property */
	//public $entity;
    /** @var mixed An example property */
	//public $ref;
	/** @var mixed An example property */
	//public $day;
        /** @var mixed An example property */
	//public $start_time;
        /** @var mixed An example property */
	//public $end_time;
        /** @var mixed An example property */
	//public $time_diff;
        /** @var mixed An example property */
	//public $fk_user;
        /** @var mixed An example property */
	//public $created_by;
        /** @var mixed An example property */
	//public $note;
        /** @var mixed An example property */
	//public $status;
        /** @var mixed An example property */
        //public $labelstatut;
        /** @var mixed An example property */
        //public $labelstatut_short;
        /** @var mixed An example property */
        //public $labelstatut_css;
        /**
	 * Waiting to confirm status
	 */
	const STATUS_WAITING_TO_CONFIRM = 5;
	/**
	 * Confirmed status
	 */
	//const STATUS_CONFIRMED = 6;
        /**
	 * Waiting to submit status
	 */
	const STATUS_WAITING_TO_SUBMIT = 6;
        
        

	/**
	 * Constructor
	 *
	 * @param DoliDb $db Database handler
	 */
	public function __construct($db)
	{
                global $langs;
                
		$this->db = $db;
                
                $langs->load("staff@staff");
                
                $this->labelstatut[5]=$langs->trans("StatusWatingToConfirm");
                //$this->labelstatut[6]=$langs->trans("StatusConfirmed");
                $this->labelstatut[6]=$langs->trans("StatusWaitingToSubmit");
                
                $this->labelstatut_short[5]=$langs->trans("StatusWatingToConfirmShort");
                //$this->labelstatut_short[6]=$langs->trans("StatusConfirmedShort");
                $this->labelstatut_short[6]=$langs->trans("StatusWaitingToSubmitShort");
                
                $this->labelstatut_class[5]=" labeled status waiting_to_confirm";
                $this->labelstatut_class[6]=" labeled status waiting_to_submit";

		return 1;
	}
        
        /**
	 * Create object into database
	 *
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, Id of created object if OK
	 */
	public function submit($log_action='LogCreatePlannedShiftAction',$notrigger=0,$type='planned_shift')
	{
            if ($this->status != PlannedShift::STATUS_WAITING_TO_CONFIRM) {
                $this->status = PlannedShift::STATUS_WAITING_TO_CONFIRM;
            }
            
            return parent::submit($log_action, $notrigger, $type);
	}
        
        /**
	 * Create object into database
	 *
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, Id of created object if OK
	 */
	public function createFromClone($log_action='LogCreateFromClonePlannedShiftAction',$type='planned_shift')
	{
		return parent::createFromClone($log_action, $type);
	}
        
        /**
	 * Update object into database
	 *
	 * @param User $user User that modify
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, >0 if OK
	 */
	public function update($log_action='LogUpdatePlannedShiftAction',$reset_status=0,$notrigger = 0,$type='planned_shift')
	{
            return parent::update($log_action, $reset_status, $notrigger, 'planned_shift');
	}
        
        /**
	 * Update object into database
	 *
	 * @param User $user User that modify
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, >0 if OK
	 */
	public function set_status($id, $status, $log_action='LogChangePlannedShiftStatusAction', $check_status = true, $notrigger = 0)
	{
            return parent::set_status($id, $status, $log_action, $check_status, $notrigger);
        }
        
        /**
	 * Load object in memory from database
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function fetch($id, $ref='')
	{
            global $conf;
            
            $res = parent::fetch($id, $ref);
            //$this->ref = preg_replace('/^[a-zA-Z]*/i', $conf->global->PLANNED_SHIFT_REF_PREFIX, $this->ref); // @ if ON the dol_banner_tab will not work.
            
            return $res;
	}

        /**
         *    	Return label of a status (draft, validated, ...)
         *
         *    	@param      int			$statut		id statut
         *    	@param      int			$mode      	0=long label, 1=short label, 2=Picto + short label, 3=Picto, 4=Picto + long label, 5=Short label + Picto
         *    	@return     string		Label
         */
        function LibStatut($statut,$mode=1)
        {
            global $langs;
            $langs->load("staff@staff");
            
            if ($statut==self::STATUS_WAITING_TO_CONFIRM) $statuttrans='statut7';
            //if ($statut==self::STATUS_CONFIRMED) $statuttrans='statut6';
            if ($statut==self::STATUS_WAITING_TO_SUBMIT) $statuttrans='statut1';

            if ($mode == 0)	return $this->labelstatut[$statut];
            if ($mode == 1)	return $this->labelstatut_short[$statut];
            if ($mode == 2)	return img_picto($this->labelstatut_short[$statut], $statuttrans).' '.$this->labelstatut_short[$statut];
            if ($mode == 3)	return img_picto($this->labelstatut[$statut], $statuttrans);
            if ($mode == 4)	return img_picto($this->labelstatut[$statut],$statuttrans).' '.$this->labelstatut[$statut];
            if ($mode == 5)	return '<span class="hideonsmartphone">'.$this->labelstatut_short[$statut].' </span>'.img_picto($this->labelstatut_short[$statut],$statuttrans);
            if ($mode == 6)	return '<span class="hideonsmartphone'.$this->labelstatut_class[$statut].'">'.$this->labelstatut_short[$statut].' </span>'.img_picto($this->labelstatut_short[$statut],$statuttrans);
        }
        
        /**
        *	Return clicable name (with picto eventually)
        *
        *	@param		int		$withpicto		0=No picto, 1=Include picto into link, 2=Only picto
        *	@param		string	$option			On what the link points
        *	@return		string					Chain with URL
        */
        function getNomUrl($path,$withpicto=0,$option='',$title='',$type='planned_shift')
        {
            global $conf;
            
            if (! empty($this->ref)) {
                $this->ref = preg_replace('/^[a-zA-Z]*/i', $conf->global->PLANNED_SHIFT_REF_PREFIX, $this->ref);
            }
            
            return parent::getNomUrl($path, $withpicto, $option, $title, 'planned_shift');
        }
        
        /**
	 * Create object into database
	 *
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, Id of created object if OK
	 */
	public function massClone($start_period, $end_period, $useridfrom, $useridto, $cloneoption, $includeoriginshifts, $ignorepaidshifts, $soc)
	{
                global $user;
                
		$sql = "SELECT t.rowid, t.entity, t.ref, t.origin, t.day, t.start_time, t.end_time, t.time_diff, t.fk_user, t.created_by, t.note, t.status";
		$sql.= " FROM " . MAIN_DB_PREFIX . "staff_timesheet as t";
                $sql.= " WHERE t.entity IN (".getEntity('user', 1).")";
		$sql.= " AND t.day BETWEEN " . $this->db->idate($start_period) . " AND " . $this->db->idate($end_period);
                $sql.= " AND t.fk_user = " . $useridfrom;
                $sql.= " AND ";
                if ($includeoriginshifts) {
                    $sql.= "(";
                }
                $sql.= "t.status BETWEEN " . PlannedShift::STATUS_WAITING_TO_CONFIRM . " AND " . PlannedShift::STATUS_WAITING_TO_SUBMIT;
                if ($includeoriginshifts) {
                    $sql.= " OR t.origin = 'planned_shift'";
                    $sql.= ")";
                }
                if ($ignorepaidshifts) {
                    $sql.= " AND t.status != " . Timesheet::STATUS_PAID;
                }
                
		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			$i = 0;
                        $num = $this->db->num_rows($resql);
			while ($i < $num) {
				$obj = $this->db->fetch_object($resql);
                                
                                // Load source object
                                $objFrom = clone $this;
                                
                                if ($cloneoption == 3) { // clone for next month
                                    $date = strtotime("+1 month", $this->db->jdate($obj->day));
                                }
                                else if ($cloneoption == 2) { // clone for next week
                                    $date = strtotime("+1 week", $this->db->jdate($obj->day));
                                }
                                else { // same date
                                    $date = $obj->day;
                                }
                                
				$objFrom->entity = $obj->entity;
                                $objFrom->ref = $this->getNextNumRef($soc);
                                $objFrom->origin = $obj->origin;
                                $objFrom->day = $date;
                                $objFrom->start_time = $obj->start_time;
                                $objFrom->end_time = $obj->end_time;
                                $objFrom->time_diff = $obj->time_diff;
                                $objFrom->fk_user = $useridto;
                                $objFrom->created_by = $user->id;
                                $objFrom->note = $obj->note;
                                $objFrom->status = PlannedShift::STATUS_WAITING_TO_CONFIRM;
                                
                                $objFrom->createFromClone();
                                
                                $i++;
			}
			$this->db->free($resql);

                        if ($num > 0)
                        {
                            return $i;//1;
                        }
                        else
                        {
                            return 0;
                        }
		} else {
			$this->error = "Error " . $this->db->lasterror();
			dol_syslog(__METHOD__ . " " . $this->error, LOG_ERR);

			return -1;
		}
	}
}
