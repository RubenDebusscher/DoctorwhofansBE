<?php
/* Copyright (C) 2003-2005 Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2010 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2005-2011 Regis Houssin        <regis.houssin@capnetworks.com>
 * Copyright (C) 2011      Juanjo Menent	    <jmenent@2byte.es>
 * Copyright (C) 2013	   Philippe Grand	    <philippe.grand@atoo-net.com>
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
 *	\defgroup   mymodule     Module de test
 *	\brief      Module pour gerer ...
 *	\file       htdocs/core/modules/modMyModule.class.php
 *	\ingroup    mymodule
 *	\brief      Fichier de description et activation du module mymodule
 */

include_once DOL_DOCUMENT_ROOT .'/core/modules/DolibarrModules.class.php';


/**
 *	Class to describe and enable module
 */
class modStaff extends DolibarrModules
{

	/**
	 *   Constructor. Define names, constants, directories, boxes, permissions
	 *
	 *   @param      DoliDB		$db      Database handler
	 */
	function __construct($db)
	{
		global $conf;

		$this->db = $db;
		$this->editor_name = '<b>AXeL</b>';
		$this->editor_web = 'http://github.com/AXeL-dev';
		$this->editor_url = 'http://github.com/AXeL-dev';
		$this->numero = 512000;
                // key to reference module (for permissions, menus, etc.)
		$this->rights_class = 'staff';

		// Can be one of 'crm', 'financial', 'hr', 'projects', 'products', 'ecm', 'technic', 'other'
		$this->family = "hr";
		$this->module_position = 500;
		// Module label (no space allowed), used if translation string 'ModuleXXXName' not found (where XXX is value of numeric property 'numero' of module)
		$this->name = preg_replace('/^mod/i','',get_class($this));
		$this->description = "Staff management";

		// Possible values for version are: 'development', 'experimental', 'dolibarr' or version
		$this->version = '3.4.1';

		$this->const_name = 'MAIN_MODULE_'.strtoupper($this->name);
		$this->special = 0;
        $picto = function_exists('version_compare') && version_compare(DOL_VERSION, '12.0.0') >= 0 ? "staff_128" : "staff";
		$this->picto = $picto."@staff";

		// Module parts (css, js, ...)
		$this->module_parts = array(
            'css' => array('staff/css/staff.css.php'),
            'hooks' => array('toprightmenu','usercard','userlist','salarycard'),
            'triggers' => 1
        );

		// Data directories to create when module is enabled
		$this->dirs = array("/staff/temp");

		// Config pages
		$this->config_page_url = array("setup.php@staff");

		// Dependencies
		$this->depends = array("modUser", "modSalaries");
		$this->requiredby = array();
		$this->conflictwith = array();
		$this->langfiles = array('staff@staff');
		$this->phpmin = array(5,0);															// Minimum version of PHP required by module
		$this->need_dolibarr_version = array(3,9);															// Minimum version of Dolibarr required by module

		// Constants
		$this->const = array();
        $r=0;
                
        $this->const[$r][0] = "TIMESHEET_ADDON";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "mod_staff_timesheet_marbre";
		$this->const[$r][3] = 'Name of numbering numerotation rules of timesheets';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "TIMESHEET_DEFAULT_VIEW";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "show_week";
		$this->const[$r][3] = 'Timesheet default view';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "ENABLE_TIMESHEET_QUICK_SHORTCUT";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "0";
		$this->const[$r][3] = 'Enable timesheet quick shortcut';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "HIDE_SUBMENU_BY_DEFAULT";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "0";
		$this->const[$r][3] = 'Hide submenu by default';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "PLANNED_SHIFT_REF_PREFIX";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "PS";
		$this->const[$r][3] = 'Planned shift reference prefix';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "TIMESHEET_BACK_COLOR";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "f8f8f8";
		$this->const[$r][3] = 'Timesheet box background color';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "PLANNED_SHIFT_BACK_COLOR";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "aaff56";
		$this->const[$r][3] = 'Planned shift box background color';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "TIMESHEET_USE_MULTI_COLORS";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "0";
		$this->const[$r][3] = 'Use multi colors for timesheets';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "TOTAL_HOURS_HOUR_SUFFIX";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "h";
		$this->const[$r][3] = 'Total hours Hour suffix';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "TOTAL_HOURS_MIN_SUFFIX";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "min";
		$this->const[$r][3] = 'Total hours Minute suffix';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "STAFF_SHOW_DAY_OFF";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "1";
		$this->const[$r][3] = 'Show DAY OFF label on free days';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "PS_FORM_SHIFTS_NUMBER";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "2";
		$this->const[$r][3] = 'Number of shifts on planned shift submit form';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "SHOW_PLANNED_SHIFT_INSTRUCTIONS";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "1";
		$this->const[$r][3] = 'Show planned shift instructions';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "TIMESHEET_SHOW_MORE_DETAILS";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "1";
		$this->const[$r][3] = 'Show more details on timesheets';
		$this->const[$r][4] = 0;
        $r++;
                
        $this->const[$r][0] = "STAFF_RESET_TIMESHEETS_ON_PAYMENT_DELETE";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "0";
		$this->const[$r][3] = 'Reset timesheets status on payment delete';
		$this->const[$r][4] = 0;
        $r++;

        $this->const[$r][0] = "TIMESHEET_ADD_AFTERNOON_TIME_ON_CREATION";
		$this->const[$r][1] = "chaine";
		$this->const[$r][2] = "0";
		$this->const[$r][3] = 'Add afternoon time on timesheet creation form';
		$this->const[$r][4] = 0;
        $r++;

        // Boxes
		$this->boxes = array(
                0 => array(
                        'file' => 'timesheet_box@staff',
                        'note' => '',
                        'enabledbydefaulton' => 'Home'
                ),
                1 => array(
                        'file' => 'plannedshift_box@staff',
                        'note' => '',
                        'enabledbydefaulton' => 'Home'
                ),
                2 => array(
                        'file' => 'today_plannedshift_box@staff',
                        'note' => '',
                        'enabledbydefaulton' => 'Home'
                ),
                3 => array(
                        'file' => 'today_timesheet_box@staff',
                        'note' => '',
                        'enabledbydefaulton' => 'Home'
                )
        );

		// Permissions
		$this->rights = array();

		$r=0;

		$this->rights[$r][0] = 512001;
		$this->rights[$r][1] = 'Read his timesheets';
		$this->rights[$r][2] = 'r';
		$this->rights[$r][3] = 1;
		$this->rights[$r][4] = 'timesheet';
		$this->rights[$r][5] = 'read';
		$r++;

		$this->rights[$r][0] = 512002;
		$this->rights[$r][1] = 'Submit his timesheets';
		$this->rights[$r][2] = 'w';
		$this->rights[$r][3] = 1;
		$this->rights[$r][4] = 'timesheet';
		$this->rights[$r][5] = 'submit';
		$r++;

		$this->rights[$r][0] = 512003;
		$this->rights[$r][1] = 'Modify his timesheets';
		$this->rights[$r][2] = 'm';
		$this->rights[$r][3] = 1;
		$this->rights[$r][4] = 'timesheet';
		$this->rights[$r][5] = 'modify';
		$r++;

		$this->rights[$r][0] = 512004;
		$this->rights[$r][1] = 'Delete his timesheets';
		$this->rights[$r][2] = 'd';
		$this->rights[$r][3] = 0;
		$this->rights[$r][4] = 'timesheet';
		$this->rights[$r][5] = 'delete';
		$r++;

		$this->rights[$r][0] = 512005;
		$this->rights[$r][1] = 'Clone his timesheets';
		$this->rights[$r][2] = 'w';
		$this->rights[$r][3] = 1;
		$this->rights[$r][4] = 'timesheet';
		$this->rights[$r][5] = 'clone';
		$r++;

		$this->rights[$r][0] = 512006;
		$this->rights[$r][1] = 'Validate his timesheets';
		$this->rights[$r][2] = 'w';
		$this->rights[$r][3] = 0;
		$this->rights[$r][4] = 'timesheet';
		$this->rights[$r][5] = 'validate';
		$r++;

		$this->rights[$r][0] = 512007;
		$this->rights[$r][1] = 'Get full permissions';
		$this->rights[$r][2] = 'w';
		$this->rights[$r][3] = 0;
		$this->rights[$r][4] = 'perms';
		$this->rights[$r][5] = 'full';
		$r++;

		$this->rights[$r][0] = 512008;
		$this->rights[$r][1] = 'Read his plannedshifts';
		$this->rights[$r][2] = 'r';
		$this->rights[$r][3] = 1;
		$this->rights[$r][4] = 'plannedshift';
		$this->rights[$r][5] = 'read';
		$r++;

		// Main menu entries
		$this->menu = array();	
		$r=0;
		 
		// Add here entries to declare new menus
                
        // Top Menu entry:
        $this->menu[$r]=array(
        	'fk_menu'=>0,
            'type'=>'top',
            'titre'=>'HRM',
            'mainmenu'=>'hrm',
            'leftmenu'=>'',//'hrm',
            'url'=>'/staff/index.php',//'/hrm/index.php?mainmenu=hrm&leftmenu=',
            'langs'=>'holiday',
            'position'=>90,
            'enabled'=>'(!$conf->hrm->enabled && !$conf->holiday->enabled && !$conf->deplacement->enabled && !$conf->expensereport->enabled) || (!$user->rights->hrm->employee->read && !$user->rights->holiday->write && !$user->rights->expensereport->lire)',
            'perms'=>'$user->rights->staff->timesheet->read',
            'target'=>'',
            'user'=>2
        );
        $r++;

        /*
         * Staff
         */

        // Left Menu entry: (r=0)
		$dol_version = explode('.', DOL_VERSION);
		$user_page = (int)$dol_version[0] >= 8 ? 'list' : 'index';
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm',	// Use 'fk_mainmenu=xxx' or 'fk_mainmenu=xxx,fk_leftmenu=yyy' where xxx is mainmenucode and yyy is a leftmenucode of parent menu
					'type'=>'left',			// This is a Left menu entry
					'titre'=>'StaffMenu',
					'mainmenu'=>'hrm',
					'leftmenu'=>'staff',
					'url'=>'/user/'.$user_page.'.php?mainmenu=hrm&leftmenu=staff&mode=employee',
					'langs'=>'staff@staff',	// Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
					'position'=>91,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',			// Define condition to show or hide menu entry. Use '$conf->monmodule->enabled' if entry must be visible if module is enabled.
					'perms'=>'$user->admin || ($user->rights->staff->perms->full && $user->rights->user->user->lire)',			// Use 'perms'=>'$user->rights->monmodule->level1->level2' if you want your menu with a permission rules
					'target'=>'',
					'user'=>2);				// 0=Menu for internal users,1=external users, 2=both
		$r++;

		// Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=staff',
					'type'=>'left',
					'titre'=>'NewStaff',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/user/card.php?mainmenu=hrm&leftmenu=staff&action=create&employee=1',
					'langs'=>'staff@staff',
					'position'=>92,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',
					'perms'=>'$user->admin || ($user->rights->staff->perms->full && $user->rights->user->user->creer)',
					'target'=>'',
					'user'=>2);
		$r++;

		// Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=staff',
					'type'=>'left',
					'titre'=>'StaffList',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/user/'.$user_page.'.php?mainmenu=hrm&leftmenu=staff&mode=employee',
					'langs'=>'staff@staff',
					'position'=>93,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',
					'perms'=>'$user->admin || ($user->rights->staff->perms->full && $user->rights->user->user->lire)',
					'target'=>'',
					'user'=>2);
		$r++;

		// Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=staff',
					'type'=>'left',
					'titre'=>'PaySalary',
					'mainmenu'=>'hrm',
					'leftmenu'=>'salarypayments',
					'url'=>'/staff/paysalary.php?mainmenu=hrm&leftmenu=staff&action=create',
					'langs'=>'staff@staff',
					'position'=>94,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',
					'perms'=>'$user->admin || ($user->rights->staff->perms->full && $user->rights->salaries->write)',
					'target'=>'',
					'user'=>2);
		$r++;

		// Left Menu sub menu entry: (r=1)
		$salary_page = (int)$dol_version[0] >= 9 ? 'list' : 'index';
        $salary_path = (int)$dol_version[0] >= 11 ? '/salaries' : '/compta/salaries';
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=salarypayments',
					'type'=>'left',
					'titre'=>'Payments',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>$salary_path.'/'.$salary_page.'.php?mainmenu=hrm&leftmenu=salarypayments',
					'langs'=>'staff@staff',
					'position'=>95,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',
					'perms'=>'$user->admin || ($user->rights->staff->perms->full && $user->rights->salaries->read)',
					'target'=>'',
					'user'=>2);
		$r++;

		// Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=salarypayments',
					'type'=>'left',
					'titre'=>'SalaryStatistics',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>$salary_path.'/stats/index.php?leftmenu=salarypayments',
					'langs'=>'staff@staff',
					'position'=>96,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',
					'perms'=>'$user->admin || ($user->rights->staff->perms->full && $user->rights->salaries->read)',
					'target'=>'',
					'user'=>2);
		$r++;

		// Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=staff',
					'type'=>'left',
					'titre'=>'SendEmail',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/sendmail.php?mainmenu=hrm&leftmenu=staff&mode=init',
					'langs'=>'staff@staff',
					'position'=>97,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',
					'perms'=>'$user->admin || $user->rights->staff->perms->full',
					'target'=>'',
					'user'=>2);
		$r++;

		/*
		 * Timesheets
		 */

		// Left Menu entry: (r=0)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm',	// Use 'fk_mainmenu=xxx' or 'fk_mainmenu=xxx,fk_leftmenu=yyy' where xxx is mainmenucode and yyy is a leftmenucode of parent menu
					'type'=>'left',			// This is a Left menu entry
					'titre'=>'Timesheets',
					'mainmenu'=>'hrm',
					'leftmenu'=>'timesheet',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=timesheet',
					'langs'=>'staff@staff',	// Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
					'position'=>200,
					'enabled'=>'1',			// Define condition to show or hide menu entry. Use '$conf->monmodule->enabled' if entry must be visible if module is enabled.
					'perms'=>'$user->rights->staff->timesheet->read',			// Use 'perms'=>'$user->rights->monmodule->level1->level2' if you want your menu with a permission rules
					'target'=>'',
					'user'=>2);				// 0=Menu for internal users,1=external users, 2=both
		$r++;
                
        // Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheet',
					'type'=>'left',
					'titre'=>'SubmitTimesheet',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/card.php?mainmenu=hrm&leftmenu=timesheet&action=create',
					'langs'=>'staff@staff',
					'position'=>201,
					'enabled'=>'1',
					'perms'=>'$user->rights->staff->timesheet->submit',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheet',
					'type'=>'left',
					'titre'=>'AllTimesheets',
					'mainmenu'=>'hrm',
					'leftmenu'=>'timesheetlist',
					'url'=>'/staff/timesheet/list.php?mainmenu=hrm&leftmenu=timesheetlist',
					'langs'=>'staff@staff',
					'position'=>202,
					'enabled'=>'1',
					'perms'=>'$user->rights->staff->timesheet->read',
					'target'=>'',
					'user'=>2);
		$r++;

        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheetlist',
					'type'=>'left',
					'titre'=>'Today',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=timesheetlist&action=show_day',
					'langs'=>'staff@staff',
					'position'=>203,
					'enabled'=>'($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'timesheetlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT)',
					'perms'=>'$user->rights->staff->timesheet->read',
					'target'=>'',
					'user'=>2);
		$r++;

        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheetlist',
					'type'=>'left',
					'titre'=>'ThisWeek',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=timesheetlist&action=show_week',
					'langs'=>'staff@staff',
					'position'=>204,
					'enabled'=>'($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'timesheetlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT)',
					'perms'=>'$user->rights->staff->timesheet->read',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheetlist',
					'type'=>'left',
					'titre'=>'PreviousWeek',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=timesheetlist&action=show_week&wich_week=previous',
					'langs'=>'staff@staff',
					'position'=>205,
					'enabled'=>'($user->admin || $user->rights->staff->perms->full) && (($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'timesheetlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT))',
					'perms'=>'$user->rights->staff->timesheet->read',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheetlist',
					'type'=>'left',
					'titre'=>'FollowingWeek',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=timesheetlist&action=show_week&wich_week=next',
					'langs'=>'staff@staff',
					'position'=>206,
					'enabled'=>'($user->admin || $user->rights->staff->perms->full) && (($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'timesheetlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT))',
					'perms'=>'$user->rights->staff->timesheet->read',
					'target'=>'',
					'user'=>2);
		$r++;

        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheetlist',
					'type'=>'left',
					'titre'=>'ThisMonth',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=timesheetlist&action=show_month',
					'langs'=>'staff@staff',
					'position'=>207,
					'enabled'=>'($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'timesheetlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT)',
					'perms'=>'$user->rights->staff->timesheet->read',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheetlist',
					'type'=>'left',
					'titre'=>'PerUser',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/peruser.php?mainmenu=hrm&leftmenu=timesheetlist',
					'langs'=>'staff@staff',
					'position'=>208,
					'enabled'=>'($user->admin || $user->rights->staff->perms->full) && (($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'timesheetlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT))',
					'perms'=>'$user->rights->staff->timesheet->read',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheet',
					'type'=>'left',
					'titre'=>'PendingList',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/list.php?mainmenu=hrm&leftmenu=timesheet&status=0',
					'langs'=>'staff@staff',
					'position'=>209,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full || $user->rights->staff->timesheet->validate',
					'perms'=>'$user->rights->staff->timesheet->read',
					'target'=>'',
					'user'=>2);
		$r++;

		/*
        // Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=timesheet',
					'type'=>'left',
					'titre'=>'Statistics',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/stats/index.php?mainmenu=hrm&leftmenu=timesheet',
					'langs'=>'staff@staff',
					'position'=>110,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',
					'perms'=>'$user->rights->staff->timesheet->read',
					'target'=>'',
					'user'=>2);
		$r++;
		*/

		/*
		 * Planned shifts
		 */

		// Left Menu entry: (r=0)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm',	// Use 'fk_mainmenu=xxx' or 'fk_mainmenu=xxx,fk_leftmenu=yyy' where xxx is mainmenucode and yyy is a leftmenucode of parent menu
					'type'=>'left',			// This is a Left menu entry
					'titre'=>'PlannedShifts',
					'mainmenu'=>'hrm',
					'leftmenu'=>'plannedshift',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=plannedshift&type=planned_shift',
					'langs'=>'staff@staff',	// Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
					'position'=>100,
					'enabled'=>'1',			// Define condition to show or hide menu entry. Use '$conf->monmodule->enabled' if entry must be visible if module is enabled.
					'perms'=>'$user->rights->staff->plannedshift->read',			// Use 'perms'=>'$user->rights->monmodule->level1->level2' if you want your menu with a permission rules
					'target'=>'',
					'user'=>2);				// 0=Menu for internal users,1=external users, 2=both
		$r++;
                
        // Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshift',
					'type'=>'left',
					'titre'=>'NewPlannedShift',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/plannedshift.php?mainmenu=hrm&leftmenu=plannedshift&action=create',
					'langs'=>'staff@staff',
					'position'=>101,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',
					'perms'=>'$user->rights->staff->plannedshift->read && $user->rights->staff->timesheet->submit',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshift',
					'type'=>'left',
					'titre'=>'ClonePlannedShifts',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/plannedshift.php?mainmenu=hrm&leftmenu=plannedshift&action=clone',
					'langs'=>'staff@staff',
					'position'=>102,
					'enabled'=>'$user->admin || $user->rights->staff->perms->full',
					'perms'=>'$user->rights->staff->plannedshift->read && $user->rights->staff->timesheet->clone',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshift',
					'type'=>'left',
					'titre'=>'AllPlannedShifts',
					'mainmenu'=>'hrm',
					'leftmenu'=>'plannedshiftlist',
					'url'=>'/staff/timesheet/list.php?mainmenu=hrm&leftmenu=plannedshiftlist&type=planned_shift',
					'langs'=>'staff@staff',
					'position'=>103,
					'enabled'=>'1',
					'perms'=>'$user->rights->staff->plannedshift->read',
					'target'=>'',
					'user'=>2);
		$r++;

        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshiftlist',
					'type'=>'left',
					'titre'=>'Today',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=plannedshiftlist&action=show_day&type=planned_shift',
					'langs'=>'staff@staff',
					'position'=>104,
					'enabled'=>'($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'plannedshiftlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT)',
					'perms'=>'$user->rights->staff->plannedshift->read',
					'target'=>'',
					'user'=>2);
		$r++;

        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshiftlist',
					'type'=>'left',
					'titre'=>'ThisWeek',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=plannedshiftlist&action=show_week&type=planned_shift',
					'langs'=>'staff@staff',
					'position'=>105,
					'enabled'=>'($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'plannedshiftlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT)',
					'perms'=>'$user->rights->staff->plannedshift->read',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshiftlist',
					'type'=>'left',
					'titre'=>'PreviousWeek',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=plannedshiftlist&action=show_week&type=planned_shift&wich_week=previous',
					'langs'=>'staff@staff',
					'position'=>106,
					'enabled'=>'($user->admin || $user->rights->staff->perms->full) && (($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'plannedshiftlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT))',
					'perms'=>'$user->rights->staff->plannedshift->read',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshiftlist',
					'type'=>'left',
					'titre'=>'FollowingWeek',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=plannedshiftlist&action=show_week&type=planned_shift&wich_week=next',
					'langs'=>'staff@staff',
					'position'=>107,
					'enabled'=>'($user->admin || $user->rights->staff->perms->full) && (($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'plannedshiftlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT))',
					'perms'=>'$user->rights->staff->plannedshift->read',
					'target'=>'',
					'user'=>2);
		$r++;

        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshiftlist',
					'type'=>'left',
					'titre'=>'ThisMonth',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/index.php?mainmenu=hrm&leftmenu=plannedshiftlist&action=show_month&type=planned_shift',
					'langs'=>'staff@staff',
					'position'=>108,
					'enabled'=>'($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'plannedshiftlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT)',
					'perms'=>'$user->rights->staff->plannedshift->read',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=2)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshiftlist',
					'type'=>'left',
					'titre'=>'PerUser',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/peruser.php?mainmenu=hrm&leftmenu=plannedshiftlist&type=planned_shift',
					'langs'=>'staff@staff',
					'position'=>109,
					'enabled'=>'($user->admin || $user->rights->staff->perms->full) && (($conf->global->HIDE_SUBMENU_BY_DEFAULT && $leftmenu==\'plannedshiftlist\') || (! $conf->global->HIDE_SUBMENU_BY_DEFAULT))',
					'perms'=>'$user->rights->staff->plannedshift->read',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshift',
					'type'=>'left',
					'titre'=>'WaitingToConfirmList',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/list.php?mainmenu=hrm&leftmenu=plannedshift&type=planned_shift&status=5',
					'langs'=>'staff@staff',
					'position'=>110,
					'enabled'=>'1',
					'perms'=>'$user->rights->staff->plannedshift->read',
					'target'=>'',
					'user'=>2);
		$r++;
                
        // Left Menu sub menu entry: (r=1)
		$this->menu[$r]=array(	'fk_menu'=>'fk_mainmenu=hrm,fk_leftmenu=plannedshift',
					'type'=>'left',
					'titre'=>'WaitingToSubmitList',
					'mainmenu'=>'hrm',
					'leftmenu'=>'',
					'url'=>'/staff/timesheet/list.php?mainmenu=hrm&leftmenu=plannedshift&type=planned_shift&status=6',
					'langs'=>'staff@staff',
					'position'=>111,
					'enabled'=>'1',
					'perms'=>'$user->rights->staff->plannedshift->read',
					'target'=>'',
					'user'=>2);
		$r++;

		// Exports
		//--------
		
	}


	/**
	 * Function called when module is enabled.
	 * The init function add constants, boxes, permissions and menus
	 * (defined in constructor) into Dolibarr database.
	 * It also creates data directories
	 *
	 * @param string $options Options when enabling module ('', 'noboxes')
	 * @return int 1 if OK, 0 if KO
	 */
	public function init($options = '')
	{
		//$this->remove($options);

		$sql = array();

		$result = $this->loadTables();

		return $this->_init($sql, $options);
	}

	/**
	 * Create tables, keys and data required by module
	 * Files llx_table1.sql, llx_table1.key.sql llx_data.sql with create table, create keys
	 * and create data commands must be stored in directory /mymodule/sql/
	 * This function is called by this->init
	 *
	 * @return int <=0 if KO, >0 if OK
	 */
	private function loadTables()
	{
		return $this->_load_tables('/staff/sql/');
	}

	/**
	 * Function called when module is disabled.
	 * Remove from database constants, boxes and permissions from Dolibarr database.
	 * Data directories are not deleted
	 *
	 * @param string $options Options when enabling module ('', 'noboxes')
	 * @return int 1 if OK, 0 if KO
	 */
	public function remove($options = '')
	{
		$sql = array();

		return $this->_remove($sql, $options);
	}
}
