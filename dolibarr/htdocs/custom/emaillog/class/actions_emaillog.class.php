<?php
/* Copyright (C) 2020 SuperAdmin
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
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * \file    emaillog/class/actions_emaillog.class.php
 * \ingroup emaillog
 * \brief   Example hook overload.
 *
 * Put detailed description here.
 */

require 'emaillog.class.php';

/**
 * Class ActionsEmailLog
 */
class ActionsEmailLog
{
    /**
     * @var DoliDB Database handler.
     */
    public $db;

    /**
     * @var string Error code (or message)
     */
    public $error = '';

    /**
     * @var array Errors
     */
    public $errors = array();


    /**
     * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
     */
    public $results = array();

    /**
     * @var string String displayed by executeHook() immediately after return
     */
    public $resprints;


    /**
     * Constructor
     *
     *  @param		DoliDB		$db      Database handler
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Execute action
     *
     * @param	array			$parameters		Array of parameters
     * @param	CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
     * @param	string			$action      	'add', 'update', 'view'
     * @return	int         					<0 if KO,
     *                           				=0 if OK but we want to process standard actions too,
     *                            				>0 if OK and we want to replace standard actions.
     */
    public function getNomUrl($parameters, &$object, &$action)
    {
        global $db,$langs,$conf,$user;
        $this->resprints = '';
        return 0;
    }

    /* Add here any other hooked methods... */

    public function sendMailAfter($parameters, &$object, &$action, $hookmanager)
    {
        global $conf, $user, $langs;

        $error = 0; // Error counter
            
        if (in_array($parameters['currentcontext'], array('mail')))
        {
            $emailLog = new EmailLog($this->db);
            $emailLog->ref = $object->msgid;
            $emailLog->msg_id = $object->msgid;
            $emailLog->send_context = $object->sendcontext;
            $emailLog->send_mode = $object->sendmode;
            $emailLog->subject = htmlspecialchars($object->subject);
            $emailLog->addr_from = htmlspecialchars($object->addr_from);
            $emailLog->addr_reply_to = htmlspecialchars($object->reply_to);
            $emailLog->addr_errors_to = htmlspecialchars($object->errors_to);
            $emailLog->addr_to = htmlspecialchars($object->addr_to);
            $emailLog->addr_cc = htmlspecialchars($object->addr_cc);
            $emailLog->addr_bcc = htmlspecialchars($object->addr_bcc);
            $emailLog->msg = htmlspecialchars($object->msg);
            $emailLog->is_html = $object->msgishtml;
            $emailLog->delivery_receipt = $object->deliveryreceipt;
            $emailLog->error = $object->error;
            $emailLog->send_log = $object->smtps->log;

            $result = $emailLog->create($user);
        }

        return 0;
    }
}
