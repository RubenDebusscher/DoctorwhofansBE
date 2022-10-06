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
	'NO_JAVA_SKRIPT_INFO'		=>	'Dieses Forum verwendet einen Cookie-Content Manager der auf JavaScript basiert. Bitte aktiviere dies in deinem Browser.',
	'TRUE'						=>	'true',
	'FALSE'						=>	'false',
	'ALL_ACCEPT'				=>	'Alle Akzeptieren',
	'ACCEPT'					=>	'Akzeptieren',
	'ACCEPT_SELECTED'			=>	'Ausgewählte akzeptieren',
	'DECLINE'					=>	'Ablehnen',
	'SAVE'						=>	'Speichern',
	'CLOSE'						=>	'Schließen',
	'POWERD_BY'					=>	'Realisiert mit Klaro!',
	'FIRST_INFOS'				=>	'Um bestimmte Funktionen nutzen zu können sind ein paar Einstellungen nötig. Damit wird gesteuert ob ein Dienst Cookies setzen darf oder nicht. <br><br>Es werden Cookies gesetzt für folgende Dienste:<br><br>{purposes}. <br><br>Die Einstellungen können später zu jedem Zeitpunkt geändert werden.<br><br>',
	'THE_COOKIE_SETTTINGS'		=>	'Zu den Cookie-Einstellungen',
	'ALL_SWITCH_EXPLAIN'		=>	'Mit diesem Schalter kannst Du alle Dienste aktivieren oder deaktivieren.',
	'ALL_SWITCH'				=>	'Alle Dienste aktivieren oder deaktivieren',
	'OPTOUT_INFO'				=>	'Diese Dienste werden standardmäßig geladen (Du kannst diese jedoch deaktivieren)',
	'KLARO_PURPOSE'				=>	'Zweck',
	'KLARO_PURPOSES'			=>	'Zwecke',
	'ALWAYS_REQUIRED_SERVICE'	=>	'Dieser Service ist immer erforderlich',
	'ALWAYS_REQUIRED'			=>	'(immer erforderlich)',
	'KLARO_SERVICE'				=>	'Dienst',
	'KLARO_SERVICES'			=>	'Dienste',
	'SETTINGS_FOR_COOKIE'		=>	'Einstellungen für unsere Cookie´s',
	'FONTAWESOME_FOR_COOKIE'	=>	'<i class="opt-in-cookie-icon cok_men"></i>',
	'SVG_FOR_COOKIE'			=>	'<span id="cookie_svg"></span>',
	'NEW_LINE'					=>	'<br>',
	'SECOND_INFOS'				=>	'Hier können die Einstellungen für Cookies vorgenommen werden die evtl. gesetzt werden.<br><br> Allgemeine Hinweise und Informationen entnehme bitte unserer <a href="%1$s"><strong>Datenschutzerklärung</strong></a> bzw. <a href="%2$s"><strong>Nutzungsbedingungen</strong></a>.',
	'COOKIES_MUST_HAVE'			=>	'Diese Cookies sind voreingestellte Werte und müssen akzeptiert werden, da diese für den Betrieb der Webseite erforderlich sind.',
	'TECHNICAL_COOKIES'			=>	'Technisch notwendige Cookies',
	'EXTERN_COOKIES_EXPLAIN'	=>	'Hier werden Optionen zur Auswahl gestellt die es ermöglichen Videos oder externe Medien direkt im Forum abspielbar zu machen.',
	'NEW_CHANGES'				=>	'Seit deinem letzten Besuch gab es Änderungen, bitte erneuere deine Zustimmung.',
	'EXTERN_COOKIES'			=>	'Externe Medien',
	'LOAD_EXTERNAL_CONTENT'		=>	'Möchtest Du externe Inhalte laden, die von {title} bereitgestellt werden?',
	'ALLOW_ONCE'				=>	'Einmalig erlauben',
	'PERMIT_PERMANENTLY'		=>	'Dauerhaft erlauben (Du kannst die Einstellungen jederzeit ändern!)',
	'TOOLS'						=>	'Besucher-Statistiken',
	'TOOLS_COOKIES'				=>	'Hier können dienste ausgewählt werden die für die Erfassung von Besucher-Statistiken genutzt werden.',
	'YTCOM_VIDEOLINK_HELP'		=>	'[youtube]Videolink[/youtube] - Für die Videos mit ganz normalen Youtube.com Links',
	'YTBE_VIDEOLINK_HELP'		=>	'[youtube_be]Videolink[/youtube_be] - Für die Youtbe Short Links via https://youtu.be',
	'VIMEO_VIDEOLINK_HELP'		=>	'[vimeo]Videolink[/vimeo] - Für die Videos von Vimeo.com',
	'SPOTIFY_VIDEOLINK_HELP'	=>	'[spotify]Videolink[/spotify] - Für die Videos oder Wiedergabelisten von spotify.com',
	'ANOTHER_EXT'				=>	'Kompatible Erweiterungen',
	'ANOTHER_EXT_EXPLAIN'		=>	'Hier finden Sie Auswahlmöglichkeiten für kompatible Extensions',
	'OPT_IN_COKKIE_INFO'		=>	'Cookie-Einstellungen',
	'CS_TECH_COOKIE'			=>	'Login, Session Cookies',
	'CS_YOUTUBE'				=>	'Youtube',
	'YOUTUBE_ADMIN'				=>	'Hier erscheint normalerweise ein Video von YouTube. Bitte wende dich an einen Administrator.',
	'VIMEO_ADMIN'				=>	'Hier erscheint normalerweise ein Video von Vimeo. Bitte wende dich an einen Administrator.',
	'SPOTIFY_ADMIN'				=>	'Hier erscheint normalerweise ein Video bzw. Wiedergabeliste von Spotify. Bitte wenden Sie sich an einen Administrator.',
	'CS_MATOMO'					=>	'Matomo',
	'CS_VIMEO'					=>	'Vimeo',
	'CS_SPOTIFY'				=>	'Spotify',
	'CS_GOOGLE_TRANSLATOR'		=>	'Google Translator',
	'CS_GOOGLE_ANALYTICS'		=>	'Google Analytics',
	'DS_YOUTUBE'				=>	'Wenn diese Cookies erlaubt werden können die Videos im Forum die über youtube.com eingebunden sind abgespielt werden. Es können dabei Daten an die Server von youtube.com gesendet werden.',
	'DS_VIMEO'					=>	'Wenn diese Cookies erlaubt werden können die Videos im Forum die über vimeo.com eingebunden sind abgespielt werden. Es werden dabei Daten an die Server von vimeo.com gesendet werden.',
	'DS_SPOTIFY'				=>	'Wenn diese Cookies erlaubt werden können damit Wiedergabelisten oder Videos von Spotify.com im Forum innerhalb von bbcodes eingebunden und genutzt werden. Dabei können Daten mit Servern von Spotify.com ausgetauscht werden.',
	'DS_GOOGLE_ANALYTICS_NO_TM'	=>	'Google Analytics ist ein Analytics-Service von Google. Dabei werden Cookies angelegt und Daten an die Server von Google weitergeleitet.',
	'DS_GOOGLE_TRANSLATOR'		=>	'Dies ist für die Funktion des Google-Translator´s Wichtig. Es werden dabei Cookies angelegt und Daten zwischen Diesem Server und Google gesendet.',
	'DS_MATOMO_INTERN'			=>	'Matomo Analytics ist ein einfacher Analytics-Service, welcher auf <b style="color: #00CC66">%1$s</b> betrieben wird. Dabei werden Cookies angelegt, aber es werden keine Daten an Dritte weitergegeben.',
	'DS_MATOMO_EXTERN'			=>	'Matomo Analytics ist ein einfacher Analytics-Service, welcher extern auf einem der Server von <a href="https://matomo.org/" target="_blank"><b>https://matomo.org/</b></a> läuft. Dabei werden Cookies angelegt und Daten an die Server von Matomo weitergeleitet.',
]);
