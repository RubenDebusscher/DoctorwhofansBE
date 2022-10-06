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
	'NO_JAVA_SKRIPT_INFO'		=>	'This forum uses a cookie content manager based on JavaScript. Please enable this in your browser.',
	'TRUE'						=>	'true',
	'FALSE'						=>	'false',
	'ALL_ACCEPT'				=>	'Accept All',
	'ACCEPT'					=>	'Accept',
	'ACCEPT_SELECTED'			=>	'Accept selected',
	'DECLINE'					=>	'Decline',
	'SAVE'						=>	'Save',
	'CLOSE'						=>	'Close',
	'POWERD_BY'					=>	'Realized with Klaro!',
	'FIRST_INFOS'				=>	'A few settings are required to be able to use certain functions. This controls whether a service is allowed to set cookies or not.<br><br>Cookies are set for the following services:<br><br>{purposes}. <br><br>The settings can be changed later at any time.<br><br>',
	'THE_COOKIE_SETTTINGS'		=>	'To the Cookie-Settings',
	'ALL_SWITCH_EXPLAIN'		=>	'With this switch you can activate or deactivate all services.',
	'ALL_SWITCH'				=>	'Activate or deactivate all services',
	'OPTOUT_INFO'				=>	'These services are loaded by default (but you can disable them)',
	'KLARO_PURPOSE'				=>	'Purpose',
	'KLARO_PURPOSES'			=>	'Purposes',
	'ALWAYS_REQUIRED_SERVICE'	=>	'This service is always required!',
	'ALWAYS_REQUIRED'			=>	'(always required)',
	'KLARO_SERVICE'				=>	'Service',
	'KLARO_SERVICES'			=>	'Services',
	'SETTINGS_FOR_COOKIE'		=>	'Settings for the Cookie´s',
	'FONTAWESOME_FOR_COOKIE'	=>	'<i class="opt-in-cookie-icon cok_men"></i>',
	'SVG_FOR_COOKIE'			=>	'<span id="cookie_svg"></span>',
	'NEW_LINE'					=>	'<br>',
	'SECOND_INFOS'				=>	'The settings for cookies can be made here, which may be set.<br><br> For general notes and information, please refer to our <a href="%1$s"><strong>Data protection</strong></a> respectively <a href="%2$s"><strong> Terms of Use</strong></a>.',
	'COOKIES_MUST_HAVE'			=>	'These cookies are preset values and must be accepted as they are necessary for the website to operate.',
	'TECHNICAL_COOKIES'			=>	'Technically necessary cookies',
	'EXTERN_COOKIES_EXPLAIN'	=>	'Options are provided here that make it possible to play videos or external media directly in the forum.',
	'NEW_CHANGES'				=>	'There have been changes since your last visit, please renew your consent.',
	'EXTERN_COOKIES'			=>	'External Media',
	'LOAD_EXTERNAL_CONTENT'		=>	'Would you like to load external content provided by {title}?',
	'ALLOW_ONCE'				=>	'Allow once',
	'PERMIT_PERMANENTLY'		=>	'Permit permanently (you can change the settings at any time!)',
	'TOOLS'						=>	'Visitor Statistics',
	'TOOLS_COOKIES'				=>	'Services can be selected here that are used to collect visitor statistics.',
	'ANOTHER_EXT'				=>	'Compatible extensions',
	'ANOTHER_EXT_EXPLAIN'		=>	'Here you will find selection options for compatible extensions',
	'YTCOM_VIDEOLINK_HELP'		=>	'[youtube]Videolink[/youtube] - For the videos with normal Youtube.com links',
	'YTBE_VIDEOLINK_HELP'		=>	'[youtube_be]Videolink[/youtube_be] - For the Youtbe Short Links via https://youtu.be',
	'VIMEO_VIDEOLINK_HELP'		=>	'[vimeo]Videolink[/vimeo] - For the videos from Vimeo.com',
	'SPOTIFY_VIDEOLINK_HELP'	=>	'[spotify]Videolink[/spotify] - For the videos or Playlist from spotify.com',
	'OPT_IN_COKKIE_INFO'		=>	'Cookie-Settings',
	'YOUTUBE_ADMIN'				=>	'Here is usually a video from YouTube. If you are reading this please contact an administrator.',
	'CS_TECH_COOKIE'			=>	'Login, Session Cookies',
	'CS_YOUTUBE'				=>	'Youtube',
	'YOUTUBE_ADMIN'				=>	'A video from YouTube usually appears here. Please contact an administrator.',
	'VIMEO_ADMIN'				=>	'A video from Vimeo usually appears here. Please contact an administrator.',
	'SPOTIFY_ADMIN'				=>	'A video or playlist from Spotify usually appears here. Please contact an administrator.',
	'CS_MATOMO'					=>	'Matomo',
	'CS_VIMEO'					=>	'Vimeo',
	'CS_SPOTIFY'				=>	'Spotify',
	'CS_GOOGLE_TRANSLATOR'		=>	'Google Translator',
	'CS_GOOGLE_ANALYTICS'		=>	'Google Analytics',
	'DS_YOUTUBE'				=>	'If these cookies are allowed, the videos in the forum that are integrated via youtube.com can be played. Data can be sent to the servers of youtube.com.',
	'DS_VIMEO'					=>	'If these cookies are allowed, the videos in the forum that are integrated via vimeo.com can be played. Data will be sent to the vimeo.com servers.',
	'DS_SPOTIFY'				=>	'If these cookies are allowed, playlists or videos from Spotify.com can be included and used in the forum within bbcodes. Data can be exchanged with Spotify.com servers.',
	'DS_GOOGLE_ANALYTICS_NO_TM'	=>	'Google Analytics is an analytics service provided by Google. Cookies are created and data is forwarded to the Google servers.',
	'DS_GOOGLE_TRANSLATOR'		=>	'This is important for the function of the Google translator. Cookies are created and data is sent between this server and Google.',
	'DS_MATOMO_INTERN'			=>	'Matomo Analytics is a simple analytics service operated at <b style="color: #00CC66">%1$s</b>. Cookies are created, but no data is passed on to third parties.',
	'DS_MATOMO_EXTERN'			=>	'Matomo Analytics is a simple analytics service that runs externally on one of the <a href="https://matomo.org/" target="_blank"><b>https://matomo.org/</b></a> servers. Cookies are created and data is forwarded to the Matomo servers.',
]);
