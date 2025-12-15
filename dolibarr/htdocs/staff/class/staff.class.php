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
if (false === (@include_once DOL_DOCUMENT_ROOT.'/compta/salaries/class/paymentsalary.class.php')) {
    require_once DOL_DOCUMENT_ROOT.'/salaries/class/paymentsalary.class.php';
}

/**
 * Put your class' description here
 */
class Staff// extends CommonObject
{

    /** @var DoliDb Database handler */
	public $db;
    /** @var string Error code or message */
	public $error;
    /** @var array Several error codes or messages */
	public $errors = array();
    /** @var int An example ID */
	public $id;
    /** @var mixed An example property */
	public $hourly_rate;
        

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

                
		return 1;
	}
        
        
        /**
	 * Return Staff hourly rate
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function getHourlyRate($userid)
	{
		$sql = "SELECT u.rowid, u.staff_hourly_rate";
		$sql.= " FROM " . MAIN_DB_PREFIX . "user as u";
                $sql.= " WHERE u.entity IN (".getEntity('user', 1).")";
		$sql.= " AND u.rowid = " . $userid;

		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			if ($this->db->num_rows($resql)) {
				$obj = $this->db->fetch_object($resql);

                                $this->id = $obj->rowid;
				$this->hourly_rate = $obj->staff_hourly_rate;
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
	 * Return Admin(s) id(s)
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function getAdminID()
	{// TODO: check if there is more then 1 admin
                $adminid = 0;
                
		$sql = "SELECT u.rowid";
		$sql.= " FROM " . MAIN_DB_PREFIX . "user as u";
                $sql.= " WHERE u.entity IN (".getEntity('user', 1).")";
		$sql.= " AND u.admin = 1";

		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			if ($this->db->num_rows($resql)) {
				$obj = $this->db->fetch_object($resql);

                                $adminid = $obj->rowid;
			}
			$this->db->free($resql);

			return $adminid;
		} else {
			$this->error = "Error " . $this->db->lasterror();
			dol_syslog(__METHOD__ . " " . $this->error, LOG_ERR);

			return -1;
		}
	}
        
        
        /**
	 * Return Staff payment amount
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function getPaymentAmount($userid, $hourly_rate, $start_period, $end_period)
	{
                global $db, $langs;
                
                if (! empty($hourly_rate) && is_numeric($hourly_rate))
                {
                    $payment_amount = 0;
                    
                    $sql = "SELECT SUM(t.time_diff) as total_rate";
                    $sql.= " FROM " . MAIN_DB_PREFIX . "staff_timesheet as t";
                    $sql.= " WHERE t.entity IN (".getEntity('user', 1).")";
                    $sql.= " AND t.fk_user = " . $userid;
                    $sql.= " AND t.status = " . Timesheet::STATUS_VALIDATED;
                    $sql.= " AND t.day BETWEEN '" . $db->idate($start_period) . "' AND '" . $db->idate($end_period) . "'";

                    dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
                    $resql = $this->db->query($sql);
                    if ($resql) {
                            if ($this->db->num_rows($resql)) {
                                    $obj = $this->db->fetch_object($resql);

                                    $payment_amount = $hourly_rate * ($obj->total_rate / 60); // convert total_rate from minutes to hours
                            }
                            $this->db->free($resql);
                            
                            $payment_amount = price($payment_amount,'',$langs,1,2,-1); // round to 2 decimals

                            return $payment_amount;
                    } else {
                            $this->error = "Error " . $this->db->lasterror();
                            dol_syslog(__METHOD__ . " " . $this->error, LOG_ERR);

                            return -1;
                    }
                }
                else
                {
                    return 0;
                }
	}
        
        
        /**
	 * Set Staff hourly rate
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function setHourlyRate($userid, $hourly_rate='null', $act='set')
	{
                $sql = "UPDATE ".MAIN_DB_PREFIX."user";
                $sql.= " SET staff_hourly_rate = ".$hourly_rate;
                $sql.= " WHERE rowid = ".$userid;
                $result=$this->db->query($sql);

                dol_syslog("User::".$act." staff hourly rate", LOG_DEBUG);
                if ($result)
                {
                    return 1;
                }
                else
                {
                    return -1;
                }
        }
        
        
        /**
	 * Set Staff timesheets to payed status
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function setTimesheetsToPayed($datesp, $dateep, $paymentid, $userid)
	{
                $sql = "UPDATE ".MAIN_DB_PREFIX."staff_timesheet";
                $sql.= " SET status = ".Timesheet::STATUS_PAID;
                if ($paymentid > 0) $sql.= ", payment_id = ".$paymentid;
                $sql.= " WHERE status = ".Timesheet::STATUS_VALIDATED;
                $sql.= " AND day BETWEEN '".$this->db->idate($datesp)."' AND '".$this->db->idate($dateep)."'";
                if ($userid > 0) $sql.= " AND fk_user = ".$userid;
                $result=$this->db->query($sql);

                dol_syslog("Timesheet::set to payed", LOG_DEBUG);
                if ($result)
                {
                    $sql = "SELECT rowid FROM ".MAIN_DB_PREFIX."staff_timesheet";
                    $sql.= " WHERE status = ".Timesheet::STATUS_PAID;
                    $sql.= " AND day BETWEEN '".$this->db->idate($datesp)."' AND '".$this->db->idate($dateep)."'";
                    $resql=$this->db->query($sql);
                    
                    dol_syslog("Timesheet::create payed timesheets log", LOG_DEBUG);
                    if ($resql)
                    {
                        $i = 0;
                        $log = new TimesheetLog($this->db);
                        
                        $num = $this->db->num_rows($resql);
			while ($i < $num) {
				$obj = $this->db->fetch_object($resql);

				$log->fk_timesheet = $obj->rowid;
                                $log->action = 'LogPayedAction';
                                $log->create();
                                
                                $i++;
			}
			$this->db->free($resql);
                    }
                    
                    return 1;
                }
                else
                {
                    return -1;
                }
        }
        
        
        /**
	 * Reset Staff timesheets to pending status
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function resetTimesheets($paymentid, $userid)
	{
                $payment = new PaymentSalary($this->db);
                $payment->fetch($paymentid);

                $sql = "UPDATE ".MAIN_DB_PREFIX."staff_timesheet";
                $sql.= " SET status = ".Timesheet::STATUS_PENDING;
                $sql.= ", payment_id = null";
                $sql.= " WHERE status = ".Timesheet::STATUS_PAID;
                $sql.= " AND day BETWEEN ".$this->db->idate($payment->datesp)." AND ".$this->db->idate($payment->dateep);
                if ($userid > 0) $sql.= " AND fk_user = ".$userid;
                $result=$this->db->query($sql);

                dol_syslog("Timesheet::reset to pending", LOG_DEBUG);
                if ($result)
                {
                    return 1;
                }
                else
                {
                    return -1;
                }
        }
}
