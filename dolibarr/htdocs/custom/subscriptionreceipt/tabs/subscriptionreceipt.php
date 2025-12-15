<?php

//
/* Copyright (C) 2004      Rodolphe Quiedeville  <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2011 Laurent Destailleur   <eldy@users.sourceforge.net>
 * Copyright (C) 2005      Marc Barilley / Ocebo <marc@ocebo.com>
 * Copyright (C) 2005-2012 Regis Houssin         <regis.houssin@capnetworks.com>
 * Copyright (C) 2013	   Marcos García		 <marcosgdf@gmail.com>
 * Copyright (C) 2015	   Juanjo Menent		 <jmenent@2byte.es>
 * Copyright (C) 2016 	   Abbes Bahfir 		<bafbes@gmail.com>
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
 *        \file       htdocs/compta/Subscription/card.php
 *        \ingroup    facture
 *        \brief      Page of a customer payment
 *        \remarks    Nearly same file than fournisseur/Subscription/card.php
 */
$res = 0;
if (!$res && file_exists("../../main.inc.php")) $res = @include("../../main.inc.php");        // For root directory
if (!$res && file_exists("../../../main.inc.php")) $res = @include("../../../main.inc.php");    // For "custom" directory

require_once DOL_DOCUMENT_ROOT . '/adherents/class/adherent.class.php';
require_once DOL_DOCUMENT_ROOT . '/adherents/class/adherent_type.class.php';
require_once DOL_DOCUMENT_ROOT . '/adherents/class/subscription.class.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/member.lib.php';
require_once DOL_DOCUMENT_ROOT . "/core/class/html.formfile.class.php";
dol_include_once("subscriptionreceipt/subscriptionreceipt_consts.php");
dol_include_once("subscriptionreceipt/core/modules/subscriptionreceipt/modules_subscriptionreceipt.php");
dol_include_once("subscriptionreceipt/functions.inc.php");

$langs->load('bills');
$langs->load('banks');
$langs->load('companies');

// Security check
$id = GETPOST('id', 'int');
$action = GETPOST('action', 'alpha');
$confirm = GETPOST('confirm', 'alpha');
if ($user->societe_id)
    $socid = $user->societe_id;
// TODO ajouter regle pour restreindre acces Subscription
//$result = restrictedArea($user, 'facture', $id,'');

$adh = new Adherent($db);
$adht = new AdherentType($db);
$object = new Subscription($db);


/*
 * Actions
 */

if ($action == 'setnote' && $user->rights->adherent->cotisation->lire) {
    $db->begin();

    $object->fetch($id);
    $result = $object->update_note(GETPOST('note'));
    if ($result > 0) {
        $db->commit();
        $action = '';
    }
    else {
        setEventMessages($object->error, $object->errors, 'errors');
        $db->rollback();
    }
}

if ($action == 'confirm_delete' && $confirm == 'yes' && $user->rights->adherent->cotisation->creer) {
    $db->begin();

    $object->fetch($id);
    $result = $object->delete();
    if ($result > 0) {
        $db->commit();
        header("Location: list.php");
        exit;
    }
    else {
        $langs->load("errors");
        setEventMessages($object->error, $object->errors, 'errors');
        $db->rollback();
    }
}

if ($action == 'setdatep' && !empty($_POST['datepday'])) {
    $object->fetch($id);
    $datepaye = dol_mktime(12, 0, 0, $_POST['datepmonth'], $_POST['datepday'], $_POST['datepyear']);
    $res = $object->update_date($datepaye);
    if ($res === 0) {
        setEventMessages($langs->trans('SubscriptionDateUpdateSucceeded'), null, 'mesgs');
    }
    else {
        setEventMessages($langs->trans('SubscriptionDateUpdateFailed'), null, 'errors');
    }
}

if ($action == 'builddoc') { // En get ou en post
    $object->fetch($id);

    $result = subscription_pdf_create($db, $object, '', $object->modelpdf ? $object->modelpdf : 'cesame', $langs, GETPOST('hidedetails'), GETPOST('hidedesc'), GETPOST('hideref'));
    if ($result <= 0) {
        dol_print_error($db, $result);
        exit;
    }
    else {
        Header('Location: ' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . (empty($conf->global->MAIN_JUMP_TAG) ? '' : '#builddoc'));
        exit;
    }
}
// Remove file in doc form
else if ($action == 'remove_file') {
    if ($object->fetch($id)) {
        require_once DOL_DOCUMENT_ROOT . '/core/lib/files.lib.php';

        $object->fetch_thirdparty();

        $langs->load("other");
        $upload_dir = $conf->subscriptionreceipt->dir_output;
        $file = $upload_dir . '/' . GETPOST('file');
        $ret = dol_delete_file($file, 0, 0, 0, $object);
        if ($ret)
            setEventMessage($langs->trans("FileWasRemoved", GETPOST('urlfile')));
        else
            setEventMessage($langs->trans("ErrorFailToDeleteFile", GETPOST('urlfile')), 'errors');
        $action = '';
    }
}


/*
 * View
 */

llxHeader();

$thirdpartystatic = new Societe($db);

$result = $object->fetch($id);
if ($result <= 0) {
    dol_print_error($db, 'Subscription ' . $id . ' not found in database');
    exit;
}

$form = new Form($db);

$head = subscription_prepare_head($object);

dol_fiche_head($head, 'subscriptionreceipt', $langs->trans("SubscriptionCustomerInvoice"), 0, 'payment');

print '<form action="'.$_SERVER["PHP_SELF"].'" method="post">';
print '<input type="hidden" name="token" value="'.newToken().'">';

$linkback = '<a href="'.DOL_URL_ROOT.'/adherents/subscription/list.php?restore_lastsearch_values=1">'.$langs->trans("BackToList").'</a>';

dol_banner_tab($object, 'rowid', $linkback, 1);

print '<div class="fichecenter">';

print '<div class="underbanner clearboth"></div>';

print '<table class="border centpercent">';

// Member
$adh->ref = $adh->getFullName($langs);
print '<tr>';
print '<td class="titlefield">'.$langs->trans("Member").'</td><td class="valeur">'.$adh->getNomUrl(1, 0, 'subscription').'</td>';
print '</tr>';

// Type
print '<tr>';
print '<td class="titlefield">'.$langs->trans("Type").'</td>';
print '<td class="valeur">';
if ($object->fk_type > 0 || $adh->typeid > 0) {
    $typeid = ($object->fk_type > 0 ? $object->fk_type : $adh->typeid);
    $adht->fetch($typeid);
    print $adht->getNomUrl(1);
} else {
    print $langs->trans("NoType");
}
print '</td></tr>';

// Date subscription
print '<tr>';
print '<td>'.$langs->trans("DateSubscription").'</td><td class="valeur">'.dol_print_date($object->dateh, 'day').'</td>';
print '</tr>';

// Date end subscription
print '<tr>';
print '<td>'.$langs->trans("DateEndSubscription").'</td><td class="valeur">'.dol_print_date($object->datef, 'day').'</td>';
print '</tr>';

// Amount
print '<tr><td>'.$langs->trans("Amount").'</td><td class="valeur">'.price($object->amount).'</td></tr>';

// Label
//print '<tr><td>'.$langs->trans("Label").'</td><td class="valeur">'.$object->note.'</td></tr>';
print '<tr><td class="tdtop">'.$form->editfieldkey("Comments", 'note', $object->note, $object, $user->rights->adherent->cotisation->creer).'</td><td>';
print $form->editfieldval("Note", 'note', $object->note, $object, $user->rights->adherent->cotisation->creer, 'textarea:'.ROWS_3.':90%');
print '</td></tr>';

// Bank line
if (!empty($conf->banque->enabled))
{
    if ($conf->global->ADHERENT_BANK_USE || $object->fk_bank)
    {
        print '<tr><td>'.$langs->trans("BankTransactionLine").'</td><td class="valeur">';
        if ($object->fk_bank)
        {
            $bankline = new AccountLine($db);
            $result = $bankline->fetch($object->fk_bank);
            print $bankline->getNomUrl(1, 0, 'showall');
        }
        else
        {
            print $langs->trans("NoneF");
        }
        print '</td></tr>';
    }
}

print "</table>\n";
print '</div>';

print '</form>';

dol_fiche_end();


/*
 * List of invoices
 */

/*$disable_delete = 0;
$sql = "SELECT s.rowid, f.$facnumber, f.type, f.total_ttc, f.paye, f.fk_statut, pf.amount, s.nom as name, s.rowid as socid";
$sql.= ' FROM ' . MAIN_DB_PREFIX . 'subscription as s,' . MAIN_DB_PREFIX . ',' . MAIN_DB_PREFIX . 'adherent as a';
$sql.= ' WHERE s.fk_adherent = a.rowid';
$sql.= ' AND f.fk_soc = s.rowid';
$sql.= ' AND f.entity = ' . $conf->entity;
$sql.= ' AND pf.fk_subscription = ' . $object->id;
$resql = $db->query($sql);
if ($resql) {
    $num = $db->num_rows($resql);

    $i = 0;
    $total = 0;
    print '<br><table class="noborder" width="100%">';
    print '<tr class="liste_titre">';
    print '<td>' . $langs->trans('Bill') . '</td>';
    print '<td>' . $langs->trans('Company') . '</td>';
    print '<td align="right">' . $langs->trans('ExpectedToPay') . '</td>';
    print '<td align="right">' . $langs->trans('PayedByThisSubscription') . '</td>';
    print '<td align="right">' . $langs->trans('RemainderToPay') . '</td>';
    print '<td align="right">' . $langs->trans('Status') . '</td>';
    print "</tr>\n";

    if ($num > 0) {
        $var = True;

        while ($i < $num) {
            $objp = $db->fetch_object($resql);
            $var = !$var;
            print '<tr ' . $bc[$var] . '>';

            $invoice = new Facture($db);
            $invoice->fetch($objp->facid);
            $subscription = $invoice->getSommeSubscription();
            $creditnotes = $invoice->getSumCreditNotesUsed();
            $deposits = $invoice->getSumDepositsUsed();
            $alreadypayed = price2num($subscription + $creditnotes + $deposits, 'MT');
            $remaintopay = price2num($invoice->total_ttc - $subscription - $creditnotes - $deposits, 'MT');

            // Invoice
            print '<td>';
            print $invoice->getNomUrl(1);
            print "</td>\n";

            // Third party
            print '<td>';
            $thirdpartystatic->id = $objp->socid;
            $thirdpartystatic->name = $objp->name;
            print $thirdpartystatic->getNomUrl(1);
            print '</td>';

            // Expected to pay
            print '<td align="right">' . price($objp->total_ttc) . '</td>';

            // Amount payed
            print '<td align="right">' . price($objp->amount) . '</td>';

            // Remain to pay
            print '<td align="right">' . price($remaintopay) . '</td>';

            // Status
            print '<td align="right">' . $invoice->getLibStatut(5, $alreadypayed) . '</td>';

            print "</tr>\n";
            if ($objp->paye == 1) { // If at least one invoice is paid, disable delete
                $disable_delete = 1;
            }
            $total = $total + $objp->amount;
            $i++;
        }
    }
    $var = !$var;

    print "</table>\n";
    $db->free($resql);
}
else {
    dol_print_error($db);
}

print '</div>';


/*
 * Boutons Actions
 */

print '<table width="100%"><tr><td width="50%" valign="top">';
print '<a name="builddoc"></a>'; // ancre

/*
 * Documents generes
 */

$subscription = new Subscription($db);
$subscription->fetch($id);
$filename = dol_sanitizeFileName($subscription->ref);

// Definition of $dir and $file
$filedir = DOL_DATA_ROOT . '/subscriptionreceipt/' . dol_sanitizeFileName($subscription->ref);
$urlsource = $_SERVER['PHP_SELF'] . '?id=' . $id;
$genallowed = $user->rights->adherent->cotisation->creer;
$delallowed = $user->rights->adherent->cotisation->creer;

print '<br>';
print showdocuments($db, 'subscriptionreceipt', $filename, $filedir, $urlsource, $genallowed, $delallowed, 'cesame');

print '</td><td valign="top" width="50%">';
print '</td></tr></table>';

print '</div>';

llxFooter();

$db->close();
