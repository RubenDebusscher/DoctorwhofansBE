<?php

/* Copyright (C) 2004-2010 Laurent Destailleur    <eldy@users.sourceforge.net>
 * Copyright (C) 2005-2010 Regis Houssin          <regis@dolibarr.fr>
 * Copyright (C) 2008      Raphael Bertrand       <raphael.bertrand@resultic.fr>
 * Copyright (C) 2010      Juanjo Menent		  <jmenent@2byte.es>
 * Copyright (C) 2016      Bahfir Abbes           <dolipar@dolipar.org>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 * or see http://www.gnu.org/
 */

/**
 * 	\file       htdocs/includes/modules/paiement/pdf_cesame.modules.php
 * 	\ingroup    facture
 * 	\brief      File of class to generate invoices from crab model
 * 	\author	    Laurent Destailleur
 * 	\version    $Id: pdf_cesame.modules.php,v 1.298 2011/01/03 09:50:08 eldy Exp $
 */
require_once DOL_DOCUMENT_ROOT . "/core/class/commondocgenerator.class.php";
require_once(DOL_DOCUMENT_ROOT . "/product/class/product.class.php");
require_once(DOL_DOCUMENT_ROOT . "/core/lib/company.lib.php");
require_once(DOL_DOCUMENT_ROOT . "/core/lib/functions2.lib.php");
require_once(DOL_DOCUMENT_ROOT . '/core/lib/pdf.lib.php');

/**
 * 	\class      pdf_cesame
 * 	\brief      Classe permettant de generer les paiements au modele cesame
 */
class pdf_cesame extends CommonDocGenerator {

    var $emetteur; // Objet societe qui emet

    /**
     * 		Constructor
     * 		@param		db		Database access handler
     */

    function __construct($db) {
        global $conf, $langs, $mysoc;

        $this->db = $db;
        $this->name = "cesame";
        $this->description = $langs->trans('PDFcesameDescription');

        // Dimension page pour format A4
        $this->type = 'pdf';
        $this->page_largeur = 210;
        $this->page_hauteur = 148.5;
        $this->format = array($this->page_largeur, $this->page_hauteur);
        $this->marge_gauche = 10;
        $this->marge_droite = 10;
        $this->marge_haute = 10;
        $this->marge_basse = 10;

        $this->option_logo = 1;                    // Affiche logo
        $this->option_tva = 1;                     // Gere option tva FACTURE_TVAOPTION
        $this->option_modereg = 1;                 // Affiche mode reglement
        $this->option_condreg = 1;                 // Affiche conditions reglement
        $this->option_codeproduitservice = 1;      // Affiche code produit-service
        $this->option_multilang = 1;               // Dispo en plusieurs langues
        $this->option_escompte = 1;                // Affiche si il y a eu escompte
        $this->option_credit_note = 1;             // Support credit notes
        $this->option_freetext = 1;       // Support add of a personalised text

        $this->franchise = !$mysoc->tva_assuj;

        // Get source company
        $this->emetteur = $mysoc;
        if (!$this->emetteur->pays_code)
            $this->emetteur->pays_code = substr($langs->defaultlang, -2);    // By default, if was not defined
    }

    /**
     * 		Write the object to document file to disk
     * 		@param	    object			Object invoice to build (or id if old method)
     * 		@param		outputlangs		Lang object for output language
     * 		@return	    int     		1=OK, 0=KO
     */
    function write_file($object, $outputlangs, $srctemplatepath = '', $hidedetails = 0, $hidedesc = 0, $hideref = 0) {
        global $user, $langs, $conf;

        if (!is_object($outputlangs))
            $outputlangs = $langs;
        // For backward compatibility with FPDF, force output charset to ISO, because FPDF expect text to be encoded in ISO

        $default_font_size = pdf_getPDFFontSize($outputlangs);

        $objectref = dol_sanitizeFileName($object->ref);
        $dir = DOL_DATA_ROOT . '/subscriptionreceipt/' . $objectref;
        $file = $dir . "/" . $objectref . ".pdf";
        if (!file_exists($dir)) {
            if (dol_mkdir($dir) < 0) {
                $this->error = $langs->trans("ErrorCanNotCreateDir", $dir);
                return 0;
            }
        }

        if (file_exists($dir)) {

            $pdf = pdf_getInstance($this->format, 'mm', 'l');

            if (class_exists('TCPDF')) {
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);
            }
            $pdf->SetFont(pdf_getPDFFont($outputlangs));

            $pdf->Open();
            $pagenb = 0;
            $pdf->SetDrawColor(128, 128, 128);

            $pdf->SetTitle($outputlangs->convToOutputCharset($object->ref));
            $pdf->SetSubject($outputlangs->transnoentities("Invoice"));
            $pdf->SetCreator("Dolibarr " . DOL_VERSION);
            $pdf->SetAuthor($outputlangs->convToOutputCharset($user->getFullName($outputlangs)));
            $pdf->SetKeyWords($outputlangs->convToOutputCharset($object->ref) . " " . $outputlangs->transnoentities("Invoice"));
            if ($conf->global->MAIN_DISABLE_PDF_COMPRESSION)
                $pdf->SetCompression(false);

            $pdf->SetMargins($this->marge_gauche, $this->marge_haute, $this->marge_droite);   // Left, Top, Right
            $pdf->SetAutoPageBreak(1, 0);

            // New page
            $pdf->AddPage();
            $pagenb++;
            $pdf->SetFont('', '', $default_font_size - 3);
            $pdf->MultiCell(0, 3, '');  // Set interline to 3
//Debut document
            $this->_pagehead($pdf, $object, 1, $outputlangs);
//Fin document

            $pdf->Close();

            $pdf->Output($file, 'F');
            if (!empty($conf->global->MAIN_UMASK))
                @chmod($file, octdec($conf->global->MAIN_UMASK));

            return 1;   // Pas d'erreur
        }
        else {
            $this->error = $langs->trans("ErrorCanNotCreateDir", $dir);
            return 0;
        }

        $this->error = $langs->trans("ErrorUnknown");
        return 0;   // Erreur par defaut
    }

    /**
     *   	\brief      Show header of page
     *      \param      pdf             Object PDF
     *      \param      object          Object invoice
     *      \param      showaddress     0=no, 1=yes
     *      \param      outputlangs		Object lang for output
     */
    function _pagehead(&$pdf, $object, $showaddress = 1, $outputlangs) {
        global $conf, $langs;
// Recipient name

        $adh=new Adherent($this->db);
        $adh->fetch($object->fk_adherent);
        $carac_emetteur = pdf_build_address($outputlangs, $this->emetteur);
        $carac_client_name = $outputlangs->convToOutputCharset("$adh->firstname $adh->lastname");
        $carac_client = pdf_build_address_adherent($outputlangs, $this->emetteur, $adh,null,false,'target');

        //get values

        $default_font_size = pdf_getPDFFontSize($outputlangs);

        pdf_pagehead($pdf, $outputlangs, $this->page_hauteur);

        $Xoff = 90;
        $Yoff = 0;

        $tab4_top = 60;
        $tab4_hl = 6;
        $tab4_sl = 4;
        $line = 2;

        $posy = $this->marge_haute;
        $pdf->SetXY(11, 7);

        // Logo
        $logo = $conf->mycompany->dir_output . '/logos/' . $this->emetteur->logo;
        if ($this->emetteur->logo && is_readable($logo)) {
            if (is_readable($logo)) {
                $pdf->Image($logo, 10, 5, 0, 22);
            }
            else {
                $pdf->SetTextColor(200, 0, 0);
                $pdf->SetFont('', 'B', $default_font_size - 2);
                $pdf->MultiCell(100, 3, $outputlangs->transnoentities("ErrorLogoFileNotFound", $logo), 0, 'L');
                $pdf->MultiCell(100, 3, $outputlangs->transnoentities("ErrorGoToGlobalSetup"), 0, 'L');
            }
        }
        else {
            $text = $this->emetteur->nom;
            $pdf->MultiCell(100, 3, $outputlangs->convToOutputCharset($text), 0, 'L');
        }

        $pdf->SetXY($Xoff + 10, 7);
        $pdf->SetFont('', 'B', $default_font_size + 2);
        $pdf->SetTextColor(0, 0, 0);
        $titrebon = $outputlangs->transnoentities("Reçudeversement");
        $pdf->MultiCell(0, 3, $titrebon, '', 'L'); // Bordereau expedition

        $pdf->SetFont('', '', $default_font_size - 2);
        $pdf->SetTextColor(0, 0, 0);

        $Xoff = 142;

        $Yoff = $Yoff + 7;
        $pdf->SetXY($Xoff, $Yoff);
        $pdf->MultiCell(0, 3, $outputlangs->transnoentities("Ref") . " : " . $object->ref, '', 'R');

        //Date Versement
        $Yoff = $Yoff + 4;
        $pdf->SetXY($Xoff, $Yoff);
        $pdf->MultiCell(0, 3, $outputlangs->transnoentities("Date") . " : " . dol_print_date($object->datec, "day", false, $outputlangs), '', 'R');

        $Yoff = $Yoff + 10;
        if ($showaddress) {
			// Sender properties
			//Definition Emplacement du bloc Societe
			$Xoff = 30;
			$blSocX = 10;
			$blSocY = 28;
			$Yoff +=6;
			$blH = dol_nboflines($carac_client)*5+2;
			$blSocDX = $blSocX + 30;
			$blSocDY = $blSocY + 20;
			$blSocW = 50;
			$blSocX2 = $blSocW + $blSocXs;

			// Sender name
			$pdf->SetTextColor(0, 0, 60);
			$pdf->SetFont('', 'B', $default_font_size);
			$pdf->SetXY($blSocX, $blSocY);
			$pdf->MultiCell(0, 3, $outputlangs->convToOutputCharset($this->emetteur->nom), 0, 'L');
			$pdf->SetTextColor(0, 0, 0);

			// Infos expediteur
			// Sender properties
			$Ydef = $Yoff;
			$blExpX = $Xoff - 20;
			$blW = 52;
			$Yoff = $Yoff + 5;
			$Ydef = $Yoff;
			$blSocY = 1;
			$pdf->Rect($blExpX, $Yoff, $blW, $blH);
			$pdf->SetXY($blExpX, $Yoff + 1);
			$pdf->SetFont('', '', $default_font_size - 3);
			$pdf->MultiCell($blW - 2, 4, $carac_emetteur, 0, 'L');

			$blDestX = $blExpX + 55;
			$blW = 50;
			$Yoff = $Ydef + 1;
			$pdf->Rect($blDestX, $Yoff - 1, $blW, $blH);

			//Titre
			$pdf->SetFont('', 'B', $default_font_size - 2);
			$pdf->SetXY($blDestX, $Yoff - 4);
			$pdf->MultiCell($blW, 3, $outputlangs->transnoentities('Client'), 0, 'L');

			// Show customer/recipient
			$pdf->SetFont('', 'B', $default_font_size - 3);
			$pdf->SetXY($blDestX, $Yoff);
			$pdf->MultiCell($blW, 3, $carac_client_name, 0, 'L');

			$pdf->SetFont('', '', $default_font_size - 2);
			$pdf->SetXY($blDestX, $Yoff + 4);
			$pdf->MultiCell($blW, 2, $carac_client, 0, 'L');
		}
		$y = $pdf->getY() + 10;
		$int = 7; //interligne
		$pdf->SetXY(10, $y);
		$pdf->SetFont('', 'B', $default_font_size - 2);
		$pdf->MultiCell(50, 0, $outputlangs->transnoentities('Montantverse').' : ', '', 'L');

        $pdf->SetXY(50, $y);
        $pdf->SetFont('', '', $default_font_size - 2);
        $pdf->MultiCell(0, 0, price($object->amount)." ".$outputlangs->trans($conf->currency), '', 'L');

        $y+=$int;
        $pdf->SetXY(10, $y);
        $pdf->SetFont('', 'B', $default_font_size - 2);
        $pdf->MultiCell(0, 0, $outputlangs->transnoentities('Montantverseenlettres').' : ', '', 'L');

        $pdf->SetXY(50, $y);
        $pdf->SetFont('', '', $default_font_size - 2);
        $string = ucfirst($langs->getLabelFromNumber(($object->amount), 1));
        if ($_SERVER['WINDIR'])
            $string = utf8_decode($string);
        $pdf->writeHTMLCell(0, 0, 50, $y, $string);

        $y+=$int;
        $pdf->SetXY(10, $y);
        $pdf->SetFont('', 'B', $default_font_size - 2);
        $pdf->MultiCell(0, 0, $outputlangs->trans('Note').' : ', '', 'L');
        $pdf->SetXY(50, $y);
        $pdf->SetFont('', '', $default_font_size - 2);
        $string = $object->note;
        if ($_SERVER['WINDIR'])
            $string = utf8_decode($string);
        $pdf->writeHTMLCell(0, 0, 50, $y, $string);


        $y+=$int;
        $pdf->SetFont('', 'B', $default_font_size - 2);
        $pdf->SetXY(140, $y);
        $pdf->MultiCell(0, 0, $outputlangs->trans('Cachetetsignature'), '', 'L');
    }

}
/**
 *   	Return a string with full address formated for output on documents
 *
 * 		@param	Translate	          $outputlangs		    Output langs object
 *   	@param  Societe		          $sourcecompany		Source company object
 *   	@param  Societe|string|null   $targetcompany		Target company object
 *      @param  Contact|string|null	  $targetcontact	    Target contact object
 * 		@param	int			          $usecontact		    Use contact instead of company
 * 		@param	string  	          $mode				    Address type ('source', 'target', 'targetwithdetails', 'targetwithdetails_xxx': target but include also phone/fax/email/url)
 *      @param  Object                $object               Object we want to build document for
 * 		@return	string					    		        String with full address
 */
function pdf_build_address_adherent($outputlangs, $sourcecompany, $targetcompany = '', $targetcontact = '', $usecontact = 0, $mode = 'source', $object = null)
{
	global $conf, $hookmanager;

	if ($mode == 'source' && !is_object($sourcecompany)) {
		return -1;
	}
	if ($mode == 'target' && !is_object($targetcompany)) {
		return -1;
	}

	if (!empty($sourcecompany->state_id) && empty($sourcecompany->state)) {
		$sourcecompany->state = getState($sourcecompany->state_id);
	}
	if (!empty($targetcompany->state_id) && empty($targetcompany->state)) {
		$targetcompany->state = getState($targetcompany->state_id);
	}

	$reshook = 0;
	$stringaddress = '';
	if (is_object($hookmanager)) {
		$parameters = array('sourcecompany' => &$sourcecompany, 'targetcompany' => &$targetcompany, 'targetcontact' => &$targetcontact, 'outputlangs' => $outputlangs, 'mode' => $mode, 'usecontact' => $usecontact);
		$action = '';
		$reshook = $hookmanager->executeHooks('pdf_build_address', $parameters, $object, $action); // Note that $action and $object may have been modified by some hooks
		$stringaddress .= $hookmanager->resPrint;
	}
	if (empty($reshook)) {
		if ($mode == 'source') {
			$withCountry = 0;
			if (isset($targetcompany->country_code) && !empty($sourcecompany->country_code) && ($targetcompany->country_code != $sourcecompany->country_code)) {
				$withCountry = 1;
			}

			$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->convToOutputCharset(dol_format_address($sourcecompany, $withCountry, "\n", $outputlangs))."\n";

			if (empty($conf->global->MAIN_PDF_DISABLESOURCEDETAILS)) {
				// Phone
				if ($sourcecompany->phone) {
					$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("PhoneShort").": ".$outputlangs->convToOutputCharset($sourcecompany->phone);
				}
				// Fax
				if ($sourcecompany->fax) {
					$stringaddress .= ($stringaddress ? ($sourcecompany->phone ? " - " : "\n") : '').$outputlangs->transnoentities("Fax").": ".$outputlangs->convToOutputCharset($sourcecompany->fax);
				}
				// EMail
				if ($sourcecompany->email) {
					$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Email").": ".$outputlangs->convToOutputCharset($sourcecompany->email);
				}
				// Web
				if ($sourcecompany->url) {
					$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Web").": ".$outputlangs->convToOutputCharset($sourcecompany->url);
				}
			}
			// Intra VAT
			if (!empty($conf->global->MAIN_TVAINTRA_IN_SOURCE_ADDRESS)) {
				if ($sourcecompany->tva_intra) {
					$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("VATIntraShort").': '.$outputlangs->convToOutputCharset($sourcecompany->tva_intra);
				}
			}
			// Professionnal Ids
			$reg = array();
			if (!empty($conf->global->MAIN_PROFID1_IN_SOURCE_ADDRESS) && !empty($sourcecompany->idprof1)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId1", $sourcecompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($sourcecompany->idprof1);
			}
			if (!empty($conf->global->MAIN_PROFID2_IN_SOURCE_ADDRESS) && !empty($sourcecompany->idprof2)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId2", $sourcecompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($sourcecompany->idprof2);
			}
			if (!empty($conf->global->MAIN_PROFID3_IN_SOURCE_ADDRESS) && !empty($sourcecompany->idprof3)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId3", $sourcecompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($sourcecompany->idprof3);
			}
			if (!empty($conf->global->MAIN_PROFID4_IN_SOURCE_ADDRESS) && !empty($sourcecompany->idprof4)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId4", $sourcecompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($sourcecompany->idprof4);
			}
			if (!empty($conf->global->MAIN_PROFID5_IN_SOURCE_ADDRESS) && !empty($sourcecompany->idprof5)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId5", $sourcecompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($sourcecompany->idprof5);
			}
			if (!empty($conf->global->MAIN_PROFID6_IN_SOURCE_ADDRESS) && !empty($sourcecompany->idprof6)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId6", $sourcecompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($sourcecompany->idprof6);
			}
			if (!empty($conf->global->PDF_ADD_MORE_AFTER_SOURCE_ADDRESS)) {
				$stringaddress .= ($stringaddress ? "\n" : '').$conf->global->PDF_ADD_MORE_AFTER_SOURCE_ADDRESS;
			}
		}

		if ($mode == 'target' || preg_match('/targetwithdetails/', $mode)) {
			if ($usecontact) {
				if (is_object($targetcontact)) {
					$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->convToOutputCharset($targetcontact->getFullName($outputlangs, 1));

					if (!empty($targetcontact->address)) {
						$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->convToOutputCharset(dol_format_address($targetcontact))."\n";
					} else {
						$companytouseforaddress = $targetcompany;

						// Contact on a thirdparty that is a different thirdparty than the thirdparty of object
						if ($targetcontact->socid > 0 && $targetcontact->socid != $targetcompany->id) {
							$targetcontact->fetch_thirdparty();
							$companytouseforaddress = $targetcontact->thirdparty;
						}

						$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->convToOutputCharset(dol_format_address($companytouseforaddress))."\n";
					}
					// Country
					if (!empty($targetcontact->country_code) && $targetcontact->country_code != $sourcecompany->country_code) {
						$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->convToOutputCharset($outputlangs->transnoentitiesnoconv("Country".$targetcontact->country_code));
					} elseif (empty($targetcontact->country_code) && !empty($targetcompany->country_code) && ($targetcompany->country_code != $sourcecompany->country_code)) {
						$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->convToOutputCharset($outputlangs->transnoentitiesnoconv("Country".$targetcompany->country_code));
					}

					if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || preg_match('/targetwithdetails/', $mode)) {
						// Phone
						if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || $mode == 'targetwithdetails' || preg_match('/targetwithdetails_phone/', $mode)) {
							if (!empty($targetcontact->phone_pro) || !empty($targetcontact->phone_mobile)) {
								$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Phone").": ";
							}
							if (!empty($targetcontact->phone_pro)) {
								$stringaddress .= $outputlangs->convToOutputCharset($targetcontact->phone_pro);
							}
							if (!empty($targetcontact->phone_pro) && !empty($targetcontact->phone_mobile)) {
								$stringaddress .= " / ";
							}
							if (!empty($targetcontact->phone_mobile)) {
								$stringaddress .= $outputlangs->convToOutputCharset($targetcontact->phone_mobile);
							}
						}
						// Fax
						if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || $mode == 'targetwithdetails' || preg_match('/targetwithdetails_fax/', $mode)) {
							if ($targetcontact->fax) {
								$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Fax").": ".$outputlangs->convToOutputCharset($targetcontact->fax);
							}
						}
						// EMail
						if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || $mode == 'targetwithdetails' || preg_match('/targetwithdetails_email/', $mode)) {
							if ($targetcontact->email) {
								$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Email").": ".$outputlangs->convToOutputCharset($targetcontact->email);
							}
						}
						// Web
						if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || $mode == 'targetwithdetails' || preg_match('/targetwithdetails_url/', $mode)) {
							if ($targetcontact->url) {
								$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Web").": ".$outputlangs->convToOutputCharset($targetcontact->url);
							}
						}
					}
				}
			} else {
				if (is_object($targetcompany)) {
					$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->convToOutputCharset(dol_format_address_adherent($targetcompany,1))."\n";
					// Country
					if (!empty($targetcompany->country_code) && $targetcompany->country_code != $sourcecompany->country_code) {
						$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->convToOutputCharset($outputlangs->transnoentitiesnoconv("Country".$targetcompany->country_code));
					}

					if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || preg_match('/targetwithdetails/', $mode)) {
						// Phone
						if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || $mode == 'targetwithdetails' || preg_match('/targetwithdetails_phone/', $mode)) {
							if (!empty($targetcompany->phone)) {
								$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Phone").": ";
							}
							if (!empty($targetcompany->phone)) {
								$stringaddress .= $outputlangs->convToOutputCharset($targetcompany->phone);
							}
						}
						// Fax
						if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || $mode == 'targetwithdetails' || preg_match('/targetwithdetails_fax/', $mode)) {
							if ($targetcompany->fax) {
								$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Fax").": ".$outputlangs->convToOutputCharset($targetcompany->fax);
							}
						}
						// EMail
						if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || $mode == 'targetwithdetails' || preg_match('/targetwithdetails_email/', $mode)) {
							if ($targetcompany->email) {
								$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Email").": ".$outputlangs->convToOutputCharset($targetcompany->email);
							}
						}
						// Web
						if (!empty($conf->global->MAIN_PDF_ADDALSOTARGETDETAILS) || $mode == 'targetwithdetails' || preg_match('/targetwithdetails_url/', $mode)) {
							if ($targetcompany->url) {
								$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("Web").": ".$outputlangs->convToOutputCharset($targetcompany->url);
							}
						}
					}
				}
			}

			// Intra VAT
			if (empty($conf->global->MAIN_TVAINTRA_NOT_IN_ADDRESS)) {
				if ($targetcompany->tva_intra) {
					$stringaddress .= ($stringaddress ? "\n" : '').$outputlangs->transnoentities("VATIntraShort").': '.$outputlangs->convToOutputCharset($targetcompany->tva_intra);
				}
			}

			// Professionnal Ids
			if (!empty($conf->global->MAIN_PROFID1_IN_ADDRESS) && !empty($targetcompany->idprof1)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId1", $targetcompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($targetcompany->idprof1);
			}
			if (!empty($conf->global->MAIN_PROFID2_IN_ADDRESS) && !empty($targetcompany->idprof2)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId2", $targetcompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($targetcompany->idprof2);
			}
			if (!empty($conf->global->MAIN_PROFID3_IN_ADDRESS) && !empty($targetcompany->idprof3)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId3", $targetcompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($targetcompany->idprof3);
			}
			if (!empty($conf->global->MAIN_PROFID4_IN_ADDRESS) && !empty($targetcompany->idprof4)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId4", $targetcompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($targetcompany->idprof4);
			}
			if (!empty($conf->global->MAIN_PROFID5_IN_ADDRESS) && !empty($targetcompany->idprof5)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId5", $targetcompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($targetcompany->idprof5);
			}
			if (!empty($conf->global->MAIN_PROFID6_IN_ADDRESS) && !empty($targetcompany->idprof6)) {
				$tmp = $outputlangs->transcountrynoentities("ProfId6", $targetcompany->country_code);
				if (preg_match('/\((.+)\)/', $tmp, $reg)) {
					$tmp = $reg[1];
				}
				$stringaddress .= ($stringaddress ? "\n" : '').$tmp.': '.$outputlangs->convToOutputCharset($targetcompany->idprof6);
			}

			// Public note
			if (!empty($conf->global->MAIN_PUBLIC_NOTE_IN_ADDRESS)) {
				if ($mode == 'source' && !empty($sourcecompany->note_public)) {
					$stringaddress .= ($stringaddress ? "\n" : '').dol_string_nohtmltag($sourcecompany->note_public);
				}
				if (($mode == 'target' || preg_match('/targetwithdetails/', $mode)) && !empty($targetcompany->note_public)) {
					$stringaddress .= ($stringaddress ? "\n" : '').dol_string_nohtmltag($targetcompany->note_public);
				}
			}
		}
	}

	return $stringaddress;
}
/**
 *      Return a formated address (part address/zip/town/state) according to country rules.
 *      See https://en.wikipedia.org/wiki/Address
 *
 *      @param  Object		$object			A company or contact object
 * 	    @param	int			$withcountry	1=Add country into address string
 *      @param	string		$sep			Separator to use to build string
 *      @param	Translate	$outputlangs	Object lang that contains language for text translation.
 *      @param	int			$mode			0=Standard output, 1=Remove address
 *  	@param	string		$extralangcode	User extralanguage $langcode as values for address, town
 *      @return string						Formated string
 *      @see dol_print_address()
 */
function dol_format_address_adherent($object, $withcountry = 0, $sep = "\n", $outputlangs = '', $mode = 0, $extralangcode = '')
{
	global $conf, $langs, $hookmanager;

	$ret = '';
	$countriesusingstate = array('AU', 'CA', 'US', 'IN', 'GB', 'ES', 'UK', 'TR', 'CN'); // See also MAIN_FORCE_STATE_INTO_ADDRESS

	// See format of addresses on https://en.wikipedia.org/wiki/Address
	// Address
	if (empty($mode)) {
		$ret .= ($extralangcode ? $object->array_languages['address'][$extralangcode] : (empty($object->address) ? '' : $object->address));
	}
	// Zip/Town/State
	if (isset($object->country_code) && in_array($object->country_code, array('AU', 'CA', 'US', 'CN')) || !empty($conf->global->MAIN_FORCE_STATE_INTO_ADDRESS)) {
		// US: title firstname name \n address lines \n town, state, zip \n country
		$town = ($extralangcode ? $object->array_languages['town'][$extralangcode] : (empty($object->town) ? '' : $object->town));
		$ret .= (($ret && $town) ? $sep : '').$town;

		if (!empty($object->state))	{
			$ret .= ($ret ? ($town ? ", " : $sep) : '').$object->state;
		}
		if (!empty($object->zip)) {
			$ret .= ($ret ? (($town || $object->state) ? ", " : $sep) : '').$object->zip;
		}
	} elseif (isset($object->country_code) && in_array($object->country_code, array('GB', 'UK'))) {
		// UK: title firstname name \n address lines \n town state \n zip \n country
		$town = ($extralangcode ? $object->array_languages['town'][$extralangcode] : (empty($object->town) ? '' : $object->town));
		$ret .= ($ret ? $sep : '').$town;
		if (!empty($object->state)) {
			$ret .= ($ret ? ", " : '').$object->state;
		}
		if (!empty($object->zip)) {
			$ret .= ($ret ? $sep : '').$object->zip;
		}
	} elseif (isset($object->country_code) && in_array($object->country_code, array('ES', 'TR'))) {
		// ES: title firstname name \n address lines \n zip town \n state \n country
		$ret .= ($ret ? $sep : '').$object->zip;
		$town = ($extralangcode ? $object->array_languages['town'][$extralangcode] : (empty($object->town) ? '' : $object->town));
		$ret .= ($town ? (($object->zip ? ' ' : '').$town) : '');
		if (!empty($object->state)) {
			$ret .= "\n".$object->state;
		}
	} elseif (isset($object->country_code) && in_array($object->country_code, array('JP'))) {
		// JP: In romaji, title firstname name\n address lines \n [state,] town zip \n country
		// See https://www.sljfaq.org/afaq/addresses.html
		$town = ($extralangcode ? $object->array_languages['town'][$extralangcode] : (empty($object->town) ? '' : $object->town));
		$ret .= ($ret ? $sep : '').($object->state ? $object->state.', ' : '').$town.($object->zip ? ' ' : '').$object->zip;
	} elseif (isset($object->country_code) && in_array($object->country_code, array('IT'))) {
		// IT: title firstname name\n address lines \n zip town state_code \n country
		$ret .= ($ret ? $sep : '').$object->zip;
		$town = ($extralangcode ? $object->array_languages['town'][$extralangcode] : (empty($object->town) ? '' : $object->town));
		$ret .= ($town ? (($object->zip ? ' ' : '').$town) : '');
		$ret .= (empty($object->state_code) ? '' : (' '.$object->state_code));
	} else {
		// Other: title firstname name \n address lines \n zip town[, state] \n country
		$town = ($extralangcode ? $object->array_languages['town'][$extralangcode] : (empty($object->town) ? '' : $object->town));
		$ret .= !empty($object->zip) ? (($ret ? $sep : '').$object->zip) : '';
		$ret .= ($town ? (($object->zip ? ' ' : ($ret ? $sep : '')).$town) : '');
		if (!empty($object->country) && in_array($object->country_code, $countriesusingstate)) {
			$ret .= ($ret ? ", " : '').$object->country;
		}
	}
	if (!is_object($outputlangs)) {
		$outputlangs = $langs;
	}
	if ($withcountry) {
		$langs->load("dict");
		$ret .= (empty($object->country_code) ? '' : ($ret ? $sep : '').$object->country);
	}
	if ($hookmanager) {
		$parameters = array('withcountry' => $withcountry, 'sep' => $sep, 'outputlangs' => $outputlangs,'mode' => $mode, 'extralangcode' => $extralangcode);
		$reshook = $hookmanager->executeHooks('formatAddress', $parameters, $object);
		if ($reshook > 0) {
			$ret = '';
		}
		$ret .= $hookmanager->resPrint;
	}

	return $ret;
}

?>
