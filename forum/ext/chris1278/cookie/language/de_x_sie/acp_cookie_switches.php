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
	'ACP_CM_SETTINGS_SETTINGS'						=>	'Einstellungen',
	'ACP_CM_SETTINGS_PAGE_TITLE'					=>	'Cookie Manager',
	'ACP_CM_SETTINGS_PAGE_TITLE_EXPLAIN'			=>	'Hier können Sie die Einstellungen vornehmen um Ihr Script anzupassen.<br><br> Wählen Sie hier deine Optionen/Schalter aus welche Ihren Besuchern beim Besuch deines Forums angezeigt werden sollen.',
	'ACP_CM_SWITCH_SET_TITLE'						=>	'Anzuzeigende Schalter',
	'CM_COOKIE_UPDATE'								=>	'Die Opt-In Cookie Manager by klaro Script-Einstellungen wurden erfolgreich übernommen!',
	'ACP_MEDIA_SWITCHES'							=>	'Media-BBcodes',
	'YOUTUBE_BBCODE_SWITCH'							=>	'YouTube',
	'YOUTUBE_BBCODE_SWITCH_EXPLAIN'					=>	'Dieser Schalter ist für das erlauben/verbieten von YouTube Videos',
	'VIMEO_BBCODE_SWITCH'							=>	'Vimeo',
	'VIMEO_BBCODE_SWITCH_EXPLAIN'					=>	'Dieser Schalter ist für das erlauben/verbieten von Vimeo Videos',
	'SPOTIFY_BBCODE_SWITCH'							=>	'Spotify',
	'SPOTIFY_BBCODE_SWITCH_EXPLAIN'					=>	'Dieser Schalter ist für das erlauben/verbieten von Spotify Videos/Wiedergabelisten',
	'ACP_OTHER_EXTENSIONS_SWITCHES'					=>	'Kompatible Erweiterungen',
	'GOOGLE_TRANSLATOR_SWITCH'						=>	'Google Translator',
	'GOOGLE_TRANSLATOR_SWITCH_EXPLAIN'				=>	'Mit diesem Schalter aktivieren Sie den Schalter für die Extension <a href="https://www.phpbb.com/customise/db/extension/google_translator/"><b>Google Translator</b></a>.<br><br> Diese Extension sollten Sie natürlich vorher Installieren.',
	'ACP_VISITOR STATISTICS_SWITCHES'				=>	'Dienste für Besucher-Statistiken',
	'GOOGLE_ANALYTICS_NO_TAGMANAGER'				=>	'Google Analitycs ohne Tag Manger',
	'GOOGLE_ANALYTICS_NO_TAGMANAGER_EXPLAIN'		=>	'Mit diesem Schalter können Sie die Option Google Analytics ohne Tag Manger aktivieren. Dazu können Sie im nächsten Feld dann noch Ihre Google-ID eintragen und dann können Sie diese Funktion nutzen.',
	'GOOGLE_ANALYTICS_ID'							=>	'Google ID',
	'GOOGLE_ANALYTICS_ID_EXPLAIN'					=>	'Hier tragen Sie bitte Ihre Google-ID ein.',
	'ACP_GOOGLE_ANALYTICS_ID'						=>	'Beispiel für eine Google ID - G-8FK05BPM2N',
	'MATOMO_SWITCH'									=>	'Matomo-Analytics',
	'MATOMO_SWITCH_EXPLAIN'							=>	'Hier kann <b><a href="https://matomo.org" target="_blank">Matomo-Analytics</a></b> aktiviert werden.',
	'MATOMO_URL'									=>	'Matomo URL/ID',
	'MATOMO_URL_EXPLAIN'							=>	'Hier bitte die Matomo Url eingeben.<br><br> Die Url bitte ohne führendes <b>https://</b> und ohne abschliessendes <b>/</b> eingeben. <br><br>Um den richtigen Eintrag zu finden suchen Sie bitte im Trackingcode folgende <br>Zeile:<b> var u="https://namevonmatomo.matomo.cloud/";</b> und daraus tragen Sie dann bitte <b>namevonmatomo.matomo.cloud</b> als Url hier ein.',
	'MATOMO_SIDE_ID'								=>	'Side id',
	'MATOMO_SIDE_ID_EXPLAIN'						=>	'Hier bitte die <b>setSiteId</b> eintragen.<br><br>Diese ist im Trackingcode zu finden. Finden Sie die Zeile: <b>_paq.push([\'setSiteId\', \'1\']);</b> Die Zahl die zwischen den Hochkommas steht ist die einzutragende Ziffer. Wenn Sie nur eine Seite haben die Sie nutzen, können Sie das Feld leer lassen (dann wird automatisch eine 1 als id eingesetzt) oder einfach die 1 als Wert eintragen.',
	'MATOMO_IN_OUT'									=>	'Matomo Skript Anwendung',
	'MATOMO_IN_OUT_EXPLAIN'							=>	'Hier können Sie die Art auswählen wie das Skript verarbeitet wird.<br><br>Bei der Option <b>Matomo Externe Anwendung</b> wird davon ausgegangen das Sie lediglich das Skript von Matomo nutzen aber die Auswertung der Statistik direkt von Matomo.org übernommen wird.<br><br>Bei der Option <b>Matomo Interne Anwendung</b> wird davon ausgegangen das die komplette Skript-Anwendung auf Ihrem Server/Webspace liegt.',
	'ACP_MATOMO_EXTERN'								=>	'Matomo Externe Anwendung',
	'ACP_MATOMO_INTERN'								=>	'Matomo Interne Anwendung',
]);
