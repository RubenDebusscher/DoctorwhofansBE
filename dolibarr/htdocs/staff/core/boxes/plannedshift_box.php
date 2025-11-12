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
 * \file    core/boxes/mybox.php
 * \ingroup mymodule
 * \brief   Example box definition.
 *
 * Put detailed description here.
 */

/** Includes */
include_once DOL_DOCUMENT_ROOT . "/core/boxes/modules_boxes.php";

/**
 * Class to manage the box
 *
 * Warning: for the box to be detected correctly by dolibarr,
 * the filename should be the lowercase classname
 */
class plannedshift_box extends ModeleBoxes
{
	/**
	 * @var string Alphanumeric ID. Populated by the constructor.
	 */
	public $boxcode = "lastplannedshifts";

	/**
	 * @var string Box icon (in configuration page)
	 * Automatically calls the icon named with the corresponding "object_" prefix
	 */
	public $boximg = "plannedshift@staff";

	/**
	 * @var string Box label (in configuration page)
	 */
	public $boxlabel;

	/**
	 * @var string[] Module dependencies
	 */
	public $depends = array('staff'); // underscores in module name '_' not work 

	/**
	 * @var DoliDb Database handler
	 */
	public $db;

	/**
	 * @var mixed More parameters
	 */
	public $param;

	/**
	 * @var array Header informations. Usually created at runtime by loadBox().
	 */
	public $info_box_head = array();

	/**
	 * @var array Contents informations. Usually created at runtime by loadBox().
	 */
	public $info_box_contents = array();

	/**
	 * Constructor
	 *
	 * @param DoliDB $db Database handler
	 * @param string $param More parameters
	 */
	public function __construct(DoliDB $db, $param = '')
	{
		global $langs;
		$langs->load("boxes");
		$langs->load('staff@staff');

		parent::__construct($db, $param);

		$this->boxlabel = $langs->transnoentitiesnoconv("BoxLastPlannedShifts");

		$this->param = $param;
	}

	/**
	 * Load data into info_box_contents array to show array later. Called by Dolibarr before displaying the box.
	 *
	 * @param int $max Maximum number of records to load
	 * @return void
	 */
	public function loadBox($max = 5)
	{
		global $user, $langs, $db, $conf;

		// Use configuration value for max lines count
		$this->max = $max;

		//include_once DOL_DOCUMENT_ROOT . "/mymodule/class/mymodule.class.php";
        dol_include_once('/staff/class/plannedshift.class.php');
        require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';
        
        $plannedshiftstatic = new PlannedShift($db);
        $userstatic = new User($db);

		// Populate the head at runtime
		$text = $langs->trans("BoxTitleLastPlannedShifts", $max);
		$this->info_box_head = array(
			// Title text
			'text' => $text,
			// Add a link
			'sublink' => dol_buildpath('/staff/timesheet/index.php?mainmenu=hrm&leftmenu=plannedshift&type=planned_shift', 1),
			// Sublink icon placed after the text
			'subpicto' => 'list',
			// Sublink icon HTML alt text
			'subtext' => $langs->trans('AllPlannedShifts'),
			// Sublink HTML target - use '' for new window - use '_self' for same window
			'target' => '_self',
			// HTML class attached to the picto and link
			'subclass' => 'classfortooltip center'.'" style="vertical-align: middle;margin-right: 5px;', // @TODO: remove the style hack
			// Limit and truncate with "…" the displayed text lenght, 0 = disabled
			'limit' => 0,
			// Adds translated " (Graph)" to a hidden form value's input (?)
			'graph' => false
		);
                
                if ($user->rights->staff->plannedshift->read)
                {
                    $sql = "SELECT t.rowid, t.entity, t.ref, t.origin, t.day";
                    $sql.= ', time_format(t.start_time,"%H:%i") as start_time, time_format(t.end_time,"%H:%i") as end_time';
                    $sql.= ", t.time_diff, t.fk_user, t.created_by, t.note, t.status";
                    $sql.= " FROM ".MAIN_DB_PREFIX."staff_timesheet as t";
                    $sql.= " WHERE t.entity IN(".getEntity('user', 1).")"; // t.entity = $conf->entity;
                    $sql.= " AND status = ".PlannedShift::STATUS_WAITING_TO_CONFIRM;
                    if (! $user->admin) $sql.= " AND t.fk_user = ".$user->id;
                    $sql.= " ORDER BY t.day, t.start_time, t.end_time DESC";
                    $sql.= $db->plimit($max, 0);

                    $result = $db->query($sql);
                    if ($result) {
                        $num = $db->num_rows($result);

                        $line = 0;

                        while ($line < $num) {
                            $obj = $db->fetch_object($result);
                            
                            // Ref
                            $plannedshiftstatic->id = $obj->rowid;
                            $plannedshiftstatic->ref = $obj->ref;
                            $plannedshiftstatic->origin = $obj->origin;
                            $plannedshiftstatic->fk_user = $obj->fk_user;
                            $plannedshiftstatic->created_by = $obj->created_by;
                            $plannedshiftstatic->start_time = $obj->start_time;
                            $plannedshiftstatic->end_time = $obj->end_time;
                            $plannedshiftstatic->time_diff = $obj->time_diff;

                            $this->info_box_contents[$line][] = array(
                                'td' => 'align="left"',
                                'text' => $plannedshiftstatic->getNomUrl('',1),
                                'asis' => 1,
                            );

                            // Start time
                            $this->info_box_contents[$line][] = array(
                                'td' => 'align="left"',
                                'text' => $obj->start_time,
                            );

                            // End time
                            $this->info_box_contents[$line][] = array(
                                'td' => 'align="left"',
                                'text' => $obj->end_time,
                            );

                            // Day
                            $this->info_box_contents[$line][] = array(
                                'td' => 'align="center"',
                                'text' => dol_print_date($db->jdate($obj->day),'day'),
                            );

                            // User / Staff
                            $userstatic->fetch($obj->fk_user);
                            $this->info_box_contents[$line][] = array(
                                'td' => 'align="right"',
                                'text' => $userstatic->getNomUrl(1),
                                'asis' => 1,
                            );

                            $line++;
                        }

                        if ($num==0) $this->info_box_contents[$line][0] = array('td' => 'align="center"','text'=>$langs->trans("NoRecordedPlannedShifts"));

                        $db->free($result);
                    } else {
                        $this->info_box_contents[0][0] = array(
                            'td' => 'align="left"',
                            'maxlength'=>500,
                            'text' => ($db->error().' sql='.$sql),
                        );
                    }
                } else {
                    $this->info_box_contents[0][0] = array(
                        'align' => 'left',
                        'text' => $langs->trans("ReadPermissionNotAllowed"),
                    );
                }
	}

	/**
	 * Method to show box. Called by Dolibarr eatch time it wants to display the box.
	 *
	 * @param array $head Array with properties of box title
	 * @param array $contents Array with properties of box lines
	 * @return void
	 */
	public function showBox($head = null, $contents = null, $nooutput = 0)
	{
		// You may make your own code here…
		// … or use the parent's class function using the provided head and contents templates
		parent::showBox($this->info_box_head, $this->info_box_contents);
	}
}
