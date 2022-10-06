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
	'ACP_CM_SETTINGS_SETTINGS'						=>	'Settings',
	'ACP_CM_SETTINGS_PAGE_TITLE'					=>	'Cookie Manager',
	'ACP_CM_SETTINGS_PAGE_TITLE_EXPLAIN'			=>	'Here you can make the settings to customize your script.<br><br> Select your options/switches here which should be displayed to your visitors when they visit your forum.',
	'ACP_CM_SWITCH_SET_TITLE'						=>	'Switches to display',
	'CM_COOKIE_UPDATE'								=>	'The Opt-In Cookie Manager by klaro Script settings have been successfully applied!',
	'ACP_MEDIA_SWITCHES'							=>	'Media-BBcodes',
	'YOUTUBE_BBCODE_SWITCH'							=>	'YouTube',
	'YOUTUBE_BBCODE_SWITCH_EXPLAIN'					=>	'This switch is for allowing/disallowing YouTube videos',
	'VIMEO_BBCODE_SWITCH'							=>	'Vimeo',
	'VIMEO_BBCODE_SWITCH_EXPLAIN'					=>	'This toggle is for allowing/disallowing Vimeo videos',
	'SPOTIFY_BBCODE_SWITCH'							=>	'Spotify',
	'SPOTIFY_BBCODE_SWITCH_EXPLAIN'					=>	'This toggle is for allowing/disallowing Spotify videos/playlists',
	'ACP_OTHER_EXTENSIONS_SWITCHES'					=>	'Compatible extensions',
	'GOOGLE_TRANSLATOR_SWITCH'						=>	'Google Translator',
	'GOOGLE_TRANSLATOR_SWITCH_EXPLAIN'				=>	'With this switch you activate the switch for the <a href="https://www.phpbb.com/customise/db/extension/google_translator/"><b>Google Translator</b></a> extension.<br><br>You should of course install this extension beforehand.',
	'ACP_VISITOR STATISTICS_SWITCHES'				=>	'Visitor Statistics Services',
	'GOOGLE_ANALYTICS_NO_TAGMANAGER'				=>	'Google Analytics without Tag Manager',
	'GOOGLE_ANALYTICS_NO_TAGMANAGER_EXPLAIN'		=>	'With this switch you can activate the option Google Analytics without Tag Manager. You can then enter your Google ID in the next field and then you can use this function.',
	'GOOGLE_ANALYTICS_ID'							=>	'Google ID',
	'GOOGLE_ANALYTICS_ID_EXPLAIN'					=>	'Please enter your Google ID here.',
	'ACP_GOOGLE_ANALYTICS_ID'						=>	'Example of a Google ID - G-8FK05BPM2N',
	'MATOMO_SWITCH'									=>	'Matomo-Analytics',
	'MATOMO_SWITCH_EXPLAIN'							=>	'<b><a href="https://matomo.org" target="_blank">Matomo-Analytics</a></b> can be activated here.',
	'MATOMO_URL'									=>	'Matomo URL/ID',
	'MATOMO_URL_EXPLAIN'							=>	'Please enter the Matomo URL here.<br><br>Please enter the URL without a leading <b>https://</b> and without a trailing <b>/</b>.<br><br>To find the right entry, please look for the following line in the tracking code:<b> var u="https://namevonmatomo.matomo.cloud/";</b> and then please enter <b>namevonmatomo.matomo.cloud</b> as Url here.',
	'MATOMO_SIDE_ID'								=>	'Side id',
	'MATOMO_SIDE_ID_EXPLAIN'						=>	'Please enter the <b>setSiteId</b> here.<br><br>This can be found in the tracking code. Find the line:  <b>_paq.push([\'setSiteId\', \'1\']);</b> The number between the inverted commas is the digit to be entered. If you only have one page that you use, you can leave the field empty (a 1 will then be automatically used as the id) or simply enter the 1 as the value.',
	'MATOMO_IN_OUT'									=>	'Matomo Skript application',
	'MATOMO_IN_OUT_EXPLAIN'							=>	'Here you can select the way the script is processed.<br><br>With the <b>Matomo External Application</b> option, it is assumed that you are only using the Matomo script, but that the statistics are evaluated directly by Matomo.org.<br><br>With the option <b>Matomo internal application</b> it is assumed that the complete script application is on your server/web space.',
	'ACP_MATOMO_EXTERN'								=>	'Matomo External application',
	'ACP_MATOMO_INTERN'								=>	'Matomo internal application',



]);
