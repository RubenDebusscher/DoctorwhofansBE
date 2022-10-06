<?php
/**
*
* Opt-In Cookie Manager by klaro Script extension for the phpBB Forum Software package.
* @copyright (c) 2020 (Christian-Esch.de) and Kirk https://reyno41.bplaced.net/phpbb
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

/**
* DO NOT CHANGE
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'ACP_CM_GENERAL_PAGE_TITLE_EXPLAIN'				=>	'<br><br><b>Achtung</b> Wähle hier die Einstellungen mit Bedacht. ',
	'ACP_CM_GENERAL_SET_TITLE'						=>	'Basis-Einstellungen',
	'WINDOW_POSITION'								=>	'Fensterposition',
	'WINDOW_POSITION_EXPLAIN'						=>	'Hier können Sie auswählen ob Sie das Hinweisfensterr dezent am unteren rechten Bildschirmrand plazieren möchten oder direkt Mittig den Einwiligungsmanager öffnen lassen möchten. Wenn der Einwilligungsmanager sich direkt öffnet bekommt der Besucher des Forums direkt beim ersten Aufruf ein Auswahlfenster mit Schaltern angezeigt die er wählen kann und Bestätigen muss. Ansonsten kann er das Forum nicht nutzen.<br><br>Standard: <b>"Unten Rechts auf dem Bildschirm" </b>',
	'MIDDLE'										=>	'Mittig auf dem Bildschirm',
	'DOWNRIGHT'										=>	'Unten Rechts auf dem Bildschirm',
	'NAME_OF_COOKIE'								=>	'Name des Cookies',
	'NAME_OF_COOKIE_EXPLAIN'						=>	'Hier können Sie den Namen des Cookies angeben, unter dem Klaroscript die Einstellungen als Cookie abspeichert.<br><br>Standard: <b>Klaro</b>',
	'KLARO_DIV_CONTAINER'							=>	'Name des Klaro-Div Containers',
	'KLARO_DIV_CONTAINER_EXPLAIN'					=>	'Hier kann der Name des Div-Containers der beim Starten vom Cookie Manager beim Seitenaufruf erstellt wird angegeben werden. <br><br>Standard: <b>klaro</b>',
	'STORAGE_VERSION'								=>	'Speicher-Methode',
	'STORAGE_VERSION_EXPLAIN'						=>	'Hier kann ausgewählt werden ob man die Speicherung über Cookie (cookie) nutzen möchte oder ob die Daten Lokal gesspeichert (localStorage) werden sollen. Bei der Lokalen Speichermethode werden keine extra cookies ausser die phpbb eigenen Technische cookies genutzt. Die Daten werden direkt auf dem Rechner des Benutzes gespeichert. <br>Empfohlen wird der Standard.<br><br>Standard: <b>cookie</b>',
	'COOKIE'										=>	'cookie',
	'LOCALSTORAGE'									=>	'localStorage',
	'KLARO_STYLE'									=>	'Klaro Style',
	'KLARO_STYLE_EXPLAIN'							=>	'Hier könne Sie auswählen ob Sie den Klaro Manager in einer Dunkeler Optik haben möchten oder in einer Hellen Optik.',
	'DARK'											=>	'Dunkel',
	'LIGHT'											=>	'Hell',
	'KLARO_HIDDEN_WINDOWS'							=>	'Fenster Verstecken',
	'KLARO_HIDDEN_WINDOWS_EXPLAIN'					=>	'Mit dieser Option kann man das Fenster was sich öffnet so Einstellen, das wenn noch keine Cookies ausgewählt wurden sich das Fenster versteckt und es ganz unter dem Forum ist, also ganz zum Schluss. Dadurch mus man das Fenster je nach Grösse des Forums recht weit nach unten Scrollen um Eingabebox zu sehen und zu benutzen. Desweitren bleibt nach Abspeichern die Einstellungsbox für die Cookies dauerhaft unter dem Forum sichtbar.<br><br> Es Wird daher empfohlen diese Option <b>nicht</b> zu ändern und auf Standard zu lassen. Damit kann die Option vom Schalter "Fensterposition" die ausgabe Steuern.<br><br>Standard: <b> Auswahl vom Schalter "Fesnterpostion" </b>',
	'HIDDEN'										=>	'Fenster Versteckt',
	'ALTERNATE'										=>	'Auswahl durch Schalter "Fensterposition" beibehalten',
	'HTML_CODE_PROCESSING'							=>	'HTML-Code Verarbeitung',
	'HTML_CODE_PROCESSING_EXPLAIN'					=>	'Dieser Schalter sollte auf <b>phpbb-Kompatibel</b> stehen bleiben. Ansonsten werden die eingebauten Verlinkungen in dem ein oder anderen Text nicht als Link sondern als html-Code dargestellt.<br><br>Standard: <b>phpbb-Kompatibel</b>',
	'KLARO'											=>	'Klaro Standard',
	'PHPBBKOMP'										=>	'phpbb-Kompatibel',
	'GROUP_FORMATION'								=>	'Gruppenbildung',
	'GROUP_FORMATION_EXPLAIN'				 		=>	'Ermöglicht es Dienste der selben zugehörigkeit in Gruppen zusammen zu fassen. <br><br>Standard: <b>Zu Gruppen zusammenfügen</b>',
	'CM_GROUP'										=>	'Zu Gruppen zusammenfügen',
	'NO_CM_GROUP'									=>	'Dienste nicht in Gruppen sondern untereinander alle anzeigen',
	'COOKIE_ICON_SELECTION'							=>	'Symbol für das Fenster mit den Schaltern',
	'COOKIE_ICON_SELECTION_EXPLAIN'					=>	'Hier können Sie auswählen, ob Sie ein SVG-Icon im Fenster anzeigen lassen möchten oder ein Fontawesome-Icon. Es geht sich bei dem Icon was in dem Fenster wo dann nachher die Schalter aufgelistet sind zu sehen ist. Das Icon in der unteren Navigationsleiste bleibt davon unberührt.',
	'ACP_FONTAWESOME'								=>	'Fontawesome-Icon',
	'ACP_SVG'										=>	'SVG-Icon',
	'SAVE_ALL_BUTTON'								=>	'Button <b>"Alles Speichern"</b> anzeigen',
	'SAVE_ALL_BUTTON_EXPLAIN'						=>	'Mit diesem Schalter können Sie den Button <b>"Alles Speichern"</b> deaktivieren.<br><br>Standard: <b>Ja - Aktiviert</b>',
	'COOKIE_RUNTIME'								=>	'Cookie-Laufzeit',
	'COOKIE_RUNTIME_EXPLAIN'						=>	'Mit diesem Wert können Sie angeben wieviele Tage das Cookie welches der Klaromanager setzt Gülltigkeit behält.<br><br>Standard: <b>120</b>	',
	'SHOW_DECLINE_BUTTON'							=>	'Button <b>"Ablehnen"</b> anzeigen',
	'SHOW_DECLINE_BUTTON_EXPLAIN'					=>	'Mit diesem Schalter können Sie den Button <b>"Ablehnen"</b> deaktivieren.<br><br>Standard: <b>Ja - Aktiviert</b>',
	'TO_THE_COOKIE_SETTINGS'						=>	'Zu den Cookie-Einstellungen',
	'TO_THE_COOKIE_SETTINGS_EXPLAIN'				=>	'Den Schriftzug <b>" Zu den Cookie-Einstellungen"</b> auf dem ersten Eingabe Fenster der Cookiebestätigung anzeigen lasssen, welche sich immer lädt wenn noch keine Cookies bestätitgt worden sind oder es neue Cookies zu bestätigen gibt. <br><br>Standard: <b>Ja</b>',
	'WINDOW_FIX_IN_THE_MIDDLE'						=>	'Einwilligungsfenster mittig fixiert',
	'WINDOW_FIX_IN_THE_MIDDLE_EXPLAIN'				=>	'Mit dieser Option wird das Einwilligungsfenster mittig fixiert angezeigt, sofern man bei dem Schalter: "Fensterposition" die Option "Unten Rechts auf dem Bildschirm" ausgewählt hat.<br><br>Standard: <b>Nein</b>',
	'KLARO_NOTE'									=>	'Realized with Klaro!',
	'KLARO_NOTE_EXPLAIN'							=>	'Den Hinweis mit Verlinkung zur Klaro Homepage einbelden.<br><br><b>Anmerkung: </b>Da das Script kostenlos ist wird dies von Haus aus aktiviert. Der <a href="https://kiprotect.com/klaro" target="_blank"><b>Anbieter</b></a> des Scriptes stellt es dem Benutzer frei dieses zu deaktvieren. Um aber für sich Werbung zu machen, wird freundlichst darum gebeten dieses aktiv zu lassen.<br><br>Standard: <b>Ja</b>',
	'COOKIE_WARN_1'									=>	'Dies ist nur eine Information. Durch die  Aktivierung dieser Erweiterung wird der Standard <b>„Cookie-Hinweis“</b>, der im Administrationsbereich unter ',
	'COOKIE_WARN_2'									=>	' <b><i><u>Serverkonfiguration/Cookies</u></i></b>',
	'COOKIE_WARN_3'									=>	'gesetzt werden kann, unterdrückt, wenn dieser aktiviert ist. Dies führt zu keiner Funktionseinschränkung. Nur das normalerweise angezeigte Banner wird nicht angezeigt. Die Cookie-Funktion dieses Forums wird in keiner Weise beeinträchtigt.',
]);
