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
dol_include_once('/staff/class/timesheet_log.class.php');

/**
 * Put your class' description here
 */
class Timesheet extends CommonObject
{

    /** @var DoliDb Database handler */
	public $db;
    /** @var string Error code or message */
	public $error;
    /** @var array Several error codes or messages */
	public $errors = array();
    /** @var string Id to identify managed object */
	public $element='timesheet';
    /** @var string Name of table without prefix where object is stored */
	public $table_element='staff_timesheet';
    /** @var string Id to identify managed object */
	public $picto='timesheet-48@staff';
    /** @var int An example ID */
	public $id;
    /** @var mixed An example property */
	public $entity;
    /** @var mixed An example property */
	public $ref;
        /** @var mixed An example property */
	public $origin;
	/** @var mixed An example property */
	public $day;
        /** @var mixed An example property */
	public $start_time;
        /** @var mixed An example property */
	public $end_time;
        /** @var mixed An example property */
	public $time_diff;
        /** @var mixed An example property */
	public $fk_user;
        /** @var mixed An example property */
	public $created_by;
        /** @var mixed An example property */
	public $note;
        /** @var mixed An example property */
	public $payment_id;
        /** @var mixed An example property */
	public $status;
        /** @var mixed An example property */
        public $labelstatut;
        /** @var mixed An example property */
        public $labelstatut_short;
        /** @var mixed An example property */
        public $labelstatut_class;
        /**
	 * Pending/Draft status
	 */
	const STATUS_PENDING = 0;
	/**
	 * Validated status
	 */
	const STATUS_VALIDATED = 1;
        /**
	 * Refused status
	 */
	const STATUS_REFUSED = 2;
        /**
	 * Paid status
	 */
	const STATUS_PAID = 3;
        /**
	 * Not Paid status
	 */
	const STATUS_NOT_PAID = 4;
        

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
                
                $this->labelstatut[0]=$langs->trans("StatusPending");
                $this->labelstatut[1]=$langs->trans("StatusValidated");
                $this->labelstatut[2]=$langs->trans("StatusRefused");
                $this->labelstatut[3]=$langs->trans("StatusPaid");
                $this->labelstatut[4]=$langs->trans("StatusNotPaid");
                
                $this->labelstatut_short[0]=$langs->trans("StatusPendingShort");
                $this->labelstatut_short[1]=$langs->trans("StatusValidatedShort");
                $this->labelstatut_short[2]=$langs->trans("StatusRefusedShort");
                $this->labelstatut_short[3]=$langs->trans("StatusPaidShort");
                $this->labelstatut_short[4]=$langs->trans("StatusNotPaidShort");
                
                $this->labelstatut_class[0]=" labeled status pending";
                $this->labelstatut_class[1]=" labeled status validated";
                $this->labelstatut_class[2]=" labeled status refused";
                $this->labelstatut_class[3]=" labeled status paid";
                $this->labelstatut_class[4]=" labeled status notpaid";

		return 1;
	}
        
        /**
	 * Create object into database
	 *
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, Id of created object if OK
	 */
	public function submit($log_action='LogCreateAction',$notrigger=0,$type='')
	{
		global $conf, $langs;
		$error = 0;

		// Clean parameters
		if (isset($this->ref)) {
			$this->ref = trim($this->ref);
		}
                if (isset($this->note)) {
			$this->note = trim($this->note);
		}

		// Check parameters
		// Put here code to add control on parameters values
		// Insert request
		$sql = "INSERT INTO " . MAIN_DB_PREFIX . "staff_timesheet(";
		$sql.= " entity,";
		$sql.= " ref,";
                if ($type == 'planned_shift') $sql.= " origin,";
                $sql.= " day,";
                $sql.= " start_time,";
                $sql.= " end_time,";
                $sql.= " time_diff,";
                $sql.= " fk_user,";
                $sql.= " created_by,";
                $sql.= " note,";
		$sql.= " status";

		$sql.= ") VALUES (";
		$sql.= " '" . $conf->entity . "',";
		$sql.= " '" . $this->ref . "',";
                if ($type == 'planned_shift') $sql.= " 'planned_shift',";
                $sql.= " " . (isset($this->day) ? "'" . $this->db->idate($this->day) . "'" : "null") . ",";
                $sql.= " " . (isset($this->start_time) ? "'" . $this->start_time . "'" : "null") . ",";
                $sql.= " " . (isset($this->end_time) ? "'" . $this->end_time . "'" : "null") . ",";
                $sql.= " '" . (isset($this->time_diff) ? $this->time_diff : "0") . "',";
                $sql.= " '" . $this->fk_user . "',";
                $sql.= " '" . $this->created_by . "',";
                $sql.= " " . (isset($this->note) && ! empty($this->note) ? "'" . $this->db->escape($this->note) . "'" : "null") . ",";
		$sql.= " '" . $this->status . "'";

		$sql.= ")";

		$this->db->begin();

		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if (! $resql) {
			$error ++;
			$this->errors[] = "Error " . $this->db->lasterror();
		}

		if (! $error) {
			$this->id = $this->db->last_insert_id(MAIN_DB_PREFIX . "staff_timesheet");

			if (! $notrigger) {
				// Uncomment this and change MYOBJECT to your own tag if you
				// want this action call a trigger.
				//// Call triggers
				//include_once DOL_DOCUMENT_ROOT . "/core/class/interfaces.class.php";
				//$interface=new Interfaces($this->db);
				//$result=$interface->run_triggers('MYOBJECT_CREATE',$this,$user,$langs,$conf);
				//if ($result < 0) { $error++; $this->errors=$interface->errors; }
				//// End call triggers
			}
                        
                        $log = new TimesheetLog($this->db);
                        $log->fk_timesheet = $this->id;
                        $log->action = $log_action;
                        $res = $log->create();
                        
                        if (! $res) {
                                $error ++;
                                $this->errors = $log->errors;
                        }
		}

		// Commit or rollback
		if ($error) {
			foreach ($this->errors as $errmsg) {
				dol_syslog(__METHOD__ . " " . $errmsg, LOG_ERR);
				$this->error.=($this->error ? ', ' . $errmsg : $errmsg);
			}
			$this->db->rollback();

			return -1 * $error;
		} else {
			$this->db->commit();

			return $this->id;
		}
	}
        
        /**
	 * Create object into database
	 *
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, Id of created object if OK
	 */
	public function createFromClone($log_action='LogCreateFromCloneAction',$type='')
	{
                // Load source object
                //$objFrom = clone $this;
                
		return $this->submit($log_action, 0, $type);
	}
        
        /**
	 * Load object in memory from database
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function fetch($id, $ref='')
	{
		global $langs;
                
		$sql = "SELECT t.rowid, t.entity, t.ref, t.origin, t.day, t.start_time, t.end_time, t.time_diff, t.fk_user, t.created_by, t.note, t.payment_id, t.status";
		$sql.= " FROM " . MAIN_DB_PREFIX . "staff_timesheet as t";
                $sql.= " WHERE t.entity IN (".getEntity('user', 1).")";
		if ($id) $sql.= " AND t.rowid = " . $id;
                if ($ref) $sql.= " AND t.ref = '" . $ref . "'";

		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			if ($this->db->num_rows($resql)) {
				$obj = $this->db->fetch_object($resql);

				$this->id = $obj->rowid;
				$this->entity = $obj->entity;
                                $this->ref = $obj->ref;
                                $this->origin = $obj->origin;
                                $this->day = $obj->day;
                                $this->start_time = $obj->start_time;
                                $this->end_time = $obj->end_time;
                                $this->time_diff = $obj->time_diff;
                                $this->fk_user = $obj->fk_user;
                                $this->created_by = $obj->created_by;
                                $this->note = $obj->note;
                                $this->payment_id = $obj->payment_id;
                                $this->status = $obj->status;
			}
			$this->db->free($resql);

			return 1;
		} else {
			$this->error = "Error " . $this->db->lasterror();
			dol_syslog(__METHOD__ . " " . $this->error, LOG_ERR);

			return -1;
		}
	}
        
        /**
        *    	Return label of status of proposal (draft, validated, ...)
        *
        *    	@param      int			$mode        0=long label, 1=short label, 2=Picto + short label, 3=Picto, 4=Picto + long label, 5=Short label + Picto
        *    	@return     string		Label
        */
        function getLibStatut($mode=0)
        {
            return $this->LibStatut($this->status,$mode);
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
            
            if ($statut==self::STATUS_PENDING) $statuttrans='statut0';
            if ($statut==self::STATUS_VALIDATED) $statuttrans='statut4';
            if ($statut==self::STATUS_REFUSED) $statuttrans='statut5';
            if ($statut==self::STATUS_PAID) $statuttrans='statut1';

            if ($mode == 0)	return $this->labelstatut[$statut];
            if ($mode == 1)	return $this->labelstatut_short[$statut];
            if ($mode == 2)	return img_picto($this->labelstatut_short[$statut], $statuttrans).' '.$this->labelstatut_short[$statut];
            if ($mode == 3)	return img_picto($this->labelstatut[$statut], $statuttrans);
            if ($mode == 4)	return img_picto($this->labelstatut[$statut],$statuttrans).' '.$this->labelstatut[$statut];
            if ($mode == 5)	return '<span class="hideonsmartphone">'.$this->labelstatut_short[$statut].' </span>'.img_picto($this->labelstatut_short[$statut],$statuttrans);
            if ($mode == 6)	return '<span class="hideonsmartphone'.$this->labelstatut_class[$statut].'">'.$this->labelstatut_short[$statut].' </span>'.img_picto($this->labelstatut_short[$statut],$statuttrans);
        }
        
        /**
        *    	Return time difference between start_time & end_time in '..h..m' default format
        *
        *    	@param      string		$format        time diff format (ex: '%H:%I', '%hh%im')
        *    	@return     string		time diff
        */
        function getTotalHours($format='')
        {
            global $conf;
            
            if (empty($format)) {
                $format = '%h'.$conf->global->TOTAL_HOURS_HOUR_SUFFIX;
                $format.= '%i'.$conf->global->TOTAL_HOURS_MIN_SUFFIX;
            }
            
            if ($this->time_diff > 0) {
                $zero    = new DateTime('@0');
                $offset  = new DateTime('@' . $this->time_diff * 60);
                $time_diff = $zero->diff($offset);
                //$time_diff = new DateTime();
                //$time_diff->h = floor($this->time_diff / 60);
                //$time_diff->i = $this->time_diff % 60;
            }
            /*else {
                $time_diff = $this->calcTimeDiff(false);
            }*/
            
            if ($time_diff > 0) {
                //if (split(':', $this->start_time)[1] == '00' && split(':', $this->end_time)[1] == '00') {
                if ($time_diff->format('%i') == 0) {
                    //if ($format == '%hh%im') $format = '%hh';
                    //else if ($format == '%hHR%iMIN') $format = '%hHR';
                    $format = strstr($format, '%i', true);
                }
                else if ($time_diff->format('%h') == 0) {
                    //if ($format == '%hh%im') $format = '%im';
                    //else if ($format == '%hHR%iMIN') $format = '%iMIN';
                    $format = strstr($format, '%i');
                }
                return $time_diff->format($format);
            }
            else {
                return '-';
            }
        }
        
        /**
        *    	Calculate time difference between start_time & end_time
        *
        *    	@param      boolean             $inminutes        convert in/to minutes or not
        *    	@return     string		time diff
        */
        function calcTimeDiff($inminutes=true)
        {
            if ($this->start_time && $this->end_time) {
                $start_time = new DateTime($this->start_time);
                $end_time = new DateTime($this->end_time);
                $time_diff = $start_time->diff($end_time);
                
                if ($inminutes)
                {
                    $minutes = 0;
                    //$minutes += $time_diff->days * 24 * 60;
                    $minutes += $time_diff->h * 60;
                    $minutes += $time_diff->i;
                    
                    return $minutes;
                }
                else
                {
                    return $time_diff;
                }
            }
            else {
                return 0;
            }
        }
        
        /**
        *  Returns the reference to the following non used Timesheet used depending on the active numbering module
        *  defined into TIMESHEET_ADDON
        *
        *  @param	Societe		$soc  	Object thirdparty
        *  @return string      		Reference libre pour la feuille de temps
        */
        function getNextNumRef($soc)
        {
            global $conf, $db, $langs;
            $langs->load("staff@staff");

            if (! empty($conf->global->TIMESHEET_ADDON))
            {
                    $mybool=false;

                $file = $conf->global->TIMESHEET_ADDON.".php";
                $classname = $conf->global->TIMESHEET_ADDON;

                // Include file with class
                $dirmodels = array_merge(array('/'), (array) $conf->modules_parts['models']);
                foreach ($dirmodels as $reldir) {

                    $dir = dol_buildpath($reldir."/staff/core/modules/");

                    // Load file with numbering class (if found)
                    $mybool|=@include_once $dir.$file;
                }

                if (! $mybool)
                {
                    dol_print_error('',"Failed to include file ".$file);
                    return '';
                }

                $obj = new $classname();
                $numref = "";
                $numref = $obj->getNextValue($soc,$this);

                if ($numref != "")
                {
                    return $numref;
                }
                else
                            {
                    $this->error=$obj->error;
                    //dol_print_error($db,"Propale::getNextNumRef ".$obj->error);
                    return "";
                }
            }
            else
                    {
                $langs->load("errors");
                print $langs->trans("Error")." ".$langs->trans("ErrorModuleSetupNotComplete");
                return "";
            }
        }
        
        /**
        *	Return clicable name (with picto eventually)
        *
        *	@param		int		$withpicto		0=No picto, 1=Include picto into link, 2=Only picto
        *	@param		string	$option			On what the link points
        *	@return		string					Chain with URL
        */
        function getNomUrl($path,$withpicto=0,$option='',$title='',$type='')
        {// TODO: remove $path var (not used anymore)
            global $langs, $conf, $user;

            $top_title = $type == 'planned_shift' ? $langs->trans("ShowPlannedShift") : $langs->trans("ShowTimesheet");
            $result='';
            $label = '<u>' . $top_title . '</u>';
            if (! empty($this->ref)) {
                $label .= '<br><b>' . $langs->trans('Ref') . ':</b> ' . $this->ref;
            }
            if (empty($type) && $this->origin == 'planned_shift') {
                $label .= '<br><b>' . $langs->trans('Origin') . ':</b> ' . $langs->trans('PlannedShift');
            }
            if (! empty($this->start_time)) {
                $label .= '<br><b>' . $langs->trans('StartTime') . ':</b> ' . $this->start_time;
            }
            if (! empty($this->end_time)) {
                $label .= '<br><b>' . $langs->trans('EndTime') . ':</b> ' . $this->end_time;
                $label .= '<br><b>' . $langs->trans('TotalHours') . ':</b> ' . $this->getTotalHours();
            }
            //require_once DOL_DOCUMENT_ROOT."/user/class/user.class.php";
            $userstatic = new User($this->db);
            if (! empty($this->fk_user)) {
                $userstatic->fetch($this->fk_user);
                $label .= '<br><b>' . $langs->trans('Staff') . ':</b> ' . $userstatic->getNomUrl(1, '', 0, 1);
            }
            if (empty($type) && ! empty($this->created_by)) {
                $userstatic->fetch($this->created_by);
                $label .= '<br><b>' . $langs->trans('SubmitedBy') . ':</b> ' . $userstatic->getNomUrl(1, '', 0, 1);
            }
            if (empty($type) && ! empty($this->note)) {
                $label .= '<br><b>' . $langs->trans('Note') . ':</b> ' . $this->note;
            }

            $link = '<a href="'.dol_buildpath('/staff/timesheet/card.php', 1).'?id='.$this->id.'&type='.$type.'" title="'.dol_escape_htmltag($label, 1).'" class="classfortooltip">';
            $linkend='</a>';

            $picto = empty($type) ? 'timesheet@staff' : 'plannedshift@staff';

            if ($withpicto) $result.=($link.img_object($label, $picto, 'class="classfortooltip"').$linkend);
            if ($withpicto && $withpicto != 2) $result.=' ';
            $result.=$link.(!empty($title) ? $title : $this->ref).$linkend;
            
            return $result;
        }
        
        /**
	 * Update object into database
	 *
	 * @param User $user User that modify
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, >0 if OK
	 */
	public function update($log_action='LogUpdateAction',$reset_status=0,$notrigger = 0,$type='')
	{
		global $conf, $langs;
		$error = 0;

		// Clean parameters
		if (isset($this->ref)) {
			$this->ref = trim($this->ref);
		}
                if (isset($this->note)) {
			$this->note = trim($this->note);
		}

		// Check parameters
		// Put here code to add control on parameters values
		// Update request
		$sql = "UPDATE " . MAIN_DB_PREFIX . "staff_timesheet SET";
		$sql.= " start_time = " . (isset($this->start_time) ? "'" . $this->start_time . "'" : "null") . ",";
                $sql.= " end_time = " . (isset($this->end_time) ? "'" . $this->end_time . "'" : "null") . ",";
                $sql.= " time_diff = '" . (isset($this->time_diff) ? $this->time_diff : "0") . "',";
                if ($reset_status) {
                    if ($type == 'planned_shift') {
                        $this->status = PlannedShift::STATUS_WAITING_TO_CONFIRM; // reset status to waiting to confirm
                    }
                    else {
                        $this->status = Timesheet::STATUS_PENDING; // reset status to pending
                    }
                    $sql.= " status = '" . $this->status . "',";
                }
                $sql.= " note = " . (isset($this->note) && ! empty($this->note) ? "'" . $this->db->escape($this->note) . "'" : "null") . "";

		$sql.= " WHERE rowid=" . $this->id;

		$this->db->begin();

		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if (! $resql) {
			$error ++;
			$this->errors[] = "Error " . $this->db->lasterror();
		}

		if (! $error) {
			if (! $notrigger) {
				// Uncomment this and change MYOBJECT to your own tag if you
				// want this action call a trigger.
				//// Call triggers
				//include_once DOL_DOCUMENT_ROOT . "/core/class/interfaces.class.php";
				//$interface=new Interfaces($this->db);
				//$result=$interface->run_triggers('MYOBJECT_MODIFY',$this,$user,$langs,$conf);
				//if ($result < 0) { $error++; $this->errors=$interface->errors; }
				//// End call triggers
			}
                        
                        if (! empty($log_action))
                        {
                            $log = new TimesheetLog($this->db);
                            $log->fk_timesheet = $this->id;
                            $log->action = $log_action;
                            $res = $log->create();

                            if (! $res) {
                                    $error ++;
                                    $this->errors = $log->errors;
                            }
                        }
		}

		// Commit or rollback
		if ($error) {
			foreach ($this->errors as $errmsg) {
				dol_syslog(__METHOD__ . " " . $errmsg, LOG_ERR);
				$this->error.=($this->error ? ', ' . $errmsg : $errmsg);
			}
			$this->db->rollback();

			return -1 * $error;
		} else {
			$this->db->commit();

			return 1;
		}
	}
        
        /**
	 * Update object into database
	 *
	 * @param User $user User that modify
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, >0 if OK
	 */
	public function set_status($id, $status, $log_action='LogChangeStatusAction', $check_status = true, $notrigger = 0)
	{
		global $conf, $langs;
		$error = 0;
                
                if (! $check_status || $this->status != $status)
                {
                    // Check parameters
                    // Put here code to add control on parameters values
                    // Update request
                    $sql = "UPDATE " . MAIN_DB_PREFIX . "staff_timesheet SET";
                    $sql.= " status = " . (isset($status) ? "'" . $status . "'" : "null") . "";
                    $sql.= " WHERE rowid=" . $id;

                    $this->db->begin();

                    dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
                    $resql = $this->db->query($sql);
                    if (! $resql) {
                            $error ++;
                            $this->errors[] = "Error " . $this->db->lasterror();
                    }

                    if (! $error) {
                            if (! $notrigger) {
                                    // Uncomment this and change MYOBJECT to your own tag if you
                                    // want this action call a trigger.
                                    //// Call triggers
                                    //include_once DOL_DOCUMENT_ROOT . "/core/class/interfaces.class.php";
                                    //$interface=new Interfaces($this->db);
                                    //$result=$interface->run_triggers('MYOBJECT_MODIFY',$this,$user,$langs,$conf);
                                    //if ($result < 0) { $error++; $this->errors=$interface->errors; }
                                    //// End call triggers
                            }
                            
                            $log = new TimesheetLog($this->db);
                            $log->fk_timesheet = $this->id;
                            $log->action = $log_action;
                            $res = $log->create();

                            if (! $res) {
                                    $error ++;
                                    $this->errors = $log->errors;
                            }
                    }

                    // Commit or rollback
                    if ($error) {
                            foreach ($this->errors as $errmsg) {
                                    dol_syslog(__METHOD__ . " " . $errmsg, LOG_ERR);
                                    $this->error.=($this->error ? ', ' . $errmsg : $errmsg);
                            }
                            $this->db->rollback();

                            return -1 * $error;
                    } else {
                            $this->db->commit();

                            return 1;
                    }
                }
                else
                {
                    return 1;
                }
	}
        
        /**
	 * Update object into database
	 *
	 * @param User $user User that modify
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, >0 if OK
	 */
	public function delete_payment($log_action='LogDeletePaymentAction', $notrigger = 0)
	{
		global $conf, $langs;
		$error = 0;
                
                // Check parameters
                
                
                // Put here code to add control on parameters values
                // Update request
                $sql = "UPDATE " . MAIN_DB_PREFIX . "staff_timesheet SET";
                $sql.= " status = " . Timesheet::STATUS_VALIDATED;
                $sql.= ", payment_id = null";
                $sql.= " WHERE rowid = " . $this->id;

                $this->db->begin();

                dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
                $resql = $this->db->query($sql);
                if (! $resql) {
                        $error ++;
                        $this->errors[] = "Error " . $this->db->lasterror();
                }

                if (! $error) {
                        if (! $notrigger) {
                                // Uncomment this and change MYOBJECT to your own tag if you
                                // want this action call a trigger.
                                //// Call triggers
                                //include_once DOL_DOCUMENT_ROOT . "/core/class/interfaces.class.php";
                                //$interface=new Interfaces($this->db);
                                //$result=$interface->run_triggers('MYOBJECT_MODIFY',$this,$user,$langs,$conf);
                                //if ($result < 0) { $error++; $this->errors=$interface->errors; }
                                //// End call triggers
                        }

                        $log = new TimesheetLog($this->db);
                        $log->fk_timesheet = $this->id;
                        $log->action = $log_action;
                        $res = $log->create();

                        if (! $res) {
                                $error ++;
                                $this->errors = $log->errors;
                        }
                }

                // Commit or rollback
                if ($error) {
                        foreach ($this->errors as $errmsg) {
                                dol_syslog(__METHOD__ . " " . $errmsg, LOG_ERR);
                                $this->error.=($this->error ? ', ' . $errmsg : $errmsg);
                        }
                        $this->db->rollback();

                        return -1 * $error;
                } else {
                        $this->db->commit();

                        return 1;
                }
	}
        
        /**
	 * Delete object in database
	 *
	 * @param User $user User that delete
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, >0 if OK
	 */
	public function delete($notrigger = 0)
	{
		global $conf, $langs;
		$error = 0;

		$this->db->begin();

		if (! $error) {
			if (! $notrigger) {
				// Uncomment this and change MYOBJECT to your own tag if you
				// want this action call a trigger.
				//// Call triggers
				//include_once DOL_DOCUMENT_ROOT . "/core/class/interfaces.class.php";
				//$interface=new Interfaces($this->db);
				//$result=$interface->run_triggers('MYOBJECT_DELETE',$this,$user,$langs,$conf);
				//if ($result < 0) { $error++; $this->errors=$interface->errors; }
				//// End call triggers
			}
		}
                
		if (! $error) {
			$sql = "DELETE FROM " . MAIN_DB_PREFIX . "staff_timesheet";
			$sql.= " WHERE rowid=" . $this->id;

			dol_syslog(__METHOD__ . " sql=" . $sql);
			$resql = $this->db->query($sql);
			if (! $resql) {
				$error ++;
				$this->errors[] = "Error " . $this->db->lasterror();
			}
		}

		// Commit or rollback
		if ($error) {
			foreach ($this->errors as $errmsg) {
				dol_syslog(__METHOD__ . " " . $errmsg, LOG_ERR);
				$this->error.=($this->error ? ', ' . $errmsg : $errmsg);
			}
			$this->db->rollback();

			return -1 * $error;
		} else {
			$this->db->commit();

			return 1;
		}
	}
        
        /**
	 * Return sql filter to filter timesheets & planned shifts
	 * 
	 *
	 * @return void
	 */
        static function getFilter($type)
        {
            $sql = '';
            //$now = dol_now();
            //$nowarray = dol_getdate($now);
            
            if ($type == 'planned_shift') {
                $sql.= ' AND status IN ('.PlannedShift::STATUS_WAITING_TO_CONFIRM.' ,'.PlannedShift::STATUS_WAITING_TO_SUBMIT.')';
                //$sql.= ' AND t.day <= '.$now;
                //$sql.= ' AND t.end_time < '.strtotime($nowarray['hour'].':'.$nowarray['min']);
            }
            else {
                $sql.= ' AND status NOT IN ('.PlannedShift::STATUS_WAITING_TO_CONFIRM.' ,'.PlannedShift::STATUS_WAITING_TO_SUBMIT.')';
            }
            
            return $sql;
        }
        
        /**
	 * Initialise object with example values
	 * Id must be 0 if object instance is a specimen
	 *
	 * @return void
	 */
	public function initAsSpecimen()
	{
		$this->id = 0;
		// ...
	}
}
