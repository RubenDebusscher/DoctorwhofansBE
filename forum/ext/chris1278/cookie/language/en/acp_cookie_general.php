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
	'ACP_CM_GENERAL_PAGE_TITLE_EXPLAIN'				=>	'<br><br><b>Attention</b> Choose the settings here carefully. ',
	'ACP_CM_GENERAL_SET_TITLE'						=>	'General Settings',
	'WINDOW_POSITION'								=>	'Window Position',
	'WINDOW_POSITION_EXPLAIN'						=>	'Select to place the cookie notice at the bottom right edge of the screen or in the middle of the screen. If middle of the screen is selected, the visitor will need to confirm his choices in order to access the forum Otherwise he cannot use the forum.<br><br>Default: <b>"Bottom right of the screen" </b>',
	'MIDDLE'										=>	'In the middle of the screen',
	'DOWNRIGHT'										=>	'Bottom right of the screen',
	'NAME_OF_COOKIE'								=>	'Name from the Cookies',
	'NAME_OF_COOKIE_EXPLAIN'						=>	'Here you can enter the name of the cookie in which Klaroscript will save the cookie settings.<br><br>Default: <b>Klaro</b>',
	'KLARO_DIV_CONTAINER'							=>	'Name of the Klaro-Div Container',
	'KLARO_DIV_CONTAINER_EXPLAIN'					=>	'Enter a name for the Div container that is created when the Cookie Manager is started when the page is accessed. <br><br>Default: <b>klaro</b>',
	'COOKIE'										=>	'cookie',
	'LOCALSTORAGE'									=>	'localStorage',
	'STORAGE_VERSION'								=>	'Memory method',
	'STORAGE_VERSION_EXPLAIN'						=>	'Here you can choose whether you want to use cookie storage or whether the data should be saved locally (local storage). With the local storage method, no extra cookies are used except for phpbb´s own technical cookies. The data is saved directly on the user´s computer. The default is recommended. <br><br>Default: <b>cookie</b>',
	'KLARO_STYLE'									=>	'Klaro Style',
	'KLARO_STYLE_EXPLAIN'							=>	'Here you can choose whether you want the Klaro Manager in a dark look or in a light look.',
	'DARK'											=>	'Dark',
	'LIGHT'											=>	'Light',
	'KLARO_HIDDEN_WINDOWS'							=>	'Hidden cookie selection window',
	'KLARO_HIDDEN_WINDOWS_EXPLAIN'					=>	'With this option you can set the window that opens so that if no cookies have been selected, the window is hidden and it is completely under the forum, i.e. at the very end. This means that, depending on the size of the forum, you have to scroll the window quite far down to see and use the input box. Furthermore, the setting box for the cookies remains permanently visible under the forum after saving. It is therefore recommended not to change this option and to keep the default value. This allows the option of the "Window position" switch to control the output. <br><br>Default: <b> Selecting the "Window position" switch </b>',
	'HIDDEN'										=>	'Hidden Windows',
	'ALTERNATE'										=>	'Maintain selection with "Window position" button',
	'HTML_CODE_PROCESSING'							=>	'HTML code processing',
	'HTML_CODE_PROCESSING_EXPLAIN'					=>	'This switch should preferably remain on <b>phpbb compatible</b>. If not, the built-in urls in the text will be shown as html code instead of as links.<br><br>Default: <b>phpbb compatible</b>',
	'KLARO'											=>	'Klaro Default',
	'PHPBBKOMP'										=>	'phpbb compatible',
	'GROUP_FORMATION'								=>	'Group Formation',
	'GROUP_FORMATION_EXPLAIN'				 		=>	'Allows services of the same affiliation to be grouped together.<br><br>Default: <b>Merge groups</b>',
	'CM_GROUP'										=>	'Merge groups',
	'NO_CM_GROUP'									=>	'Merge groups Do not merge services in groups but display all of them one below the other',
	'COOKIE_ICON_SELECTION'							=>	'Switch window icon',
	'COOKIE_ICON_SELECTION_EXPLAIN'					=>	'Here you can choose whether you want to display an SVG icon in the window or a Fontawesome icon. It´s about the icon that can be seen in the window where the switches are then listed. The icon in the lower navigation bar remains unaffected.',
	'ACP_FONTAWESOME'								=>	'Fontawesome-Icon',
	'ACP_SVG'										=>	'SVG-Icon',
	'SAVE_ALL_BUTTON'								=>	'Show Button <b>"Accept All"</b>',
	'SAVE_ALL_BUTTON_EXPLAIN'						=>	'Activate or deactivate the button "Accept All".<br><br>Default: <b>Yes - Activated</b>',
	'COOKIE_RUNTIME'								=>	'Cookie-Runtime',
	'COOKIE_RUNTIME_EXPLAIN'						=>	'Specify how many days the cookie set by the Klaromanager will remain valid.<br><br>Default: <b>120</b>	',
	'SHOW_DECLINE_BUTTON'							=>	'Show Button <b>"Decline"</b>',
	'SHOW_DECLINE_BUTTON_EXPLAIN'					=>	'Activate or Deactivate the button <b>"Decline"</b> .<br><br>Default: <b>Yes - Activated</b>',
	'TO_THE_COOKIE_SETTINGS'						=>	'To the Cookie-Settings',
	'TO_THE_COOKIE_SETTINGS_EXPLAIN'				=>	'Display the text "To the cookie settings" in the first input window of the cookie confirmation, which always loads if no cookies have been confirmed yet or if there are new cookies to be confirmed. <br><br>Default: <b>YES</b>',
	'WINDOW_FIX_IN_THE_MIDDLE'						=>	'Consent window fixed in the middle',
	'WINDOW_FIX_IN_THE_MIDDLE_EXPLAIN'				=>	'With this option, the consent window is displayed fixed in the middle, provided that the option "Bottom right on the screen" has been selected for the switch: "Window position". <br><br>Default: <b>No</b>',
	'KLARO_NOTE'									=>	'Realized with Klaro!',
	'KLARO_NOTE_EXPLAIN'							=>	'Note: Since the script is free, this is activated by default. <a href="https://kiprotect.com/klaro" target="_blank"><b>The provider</b></a> of the script allows the user to deactivate it. But in order to advertise yourself, you are kindly asked to keep it active. <br><br>Default: <b>YES</b>',
	'COOKIE_WARN_1'									=>	'This is just information. By activating this extension, the Default <b> "Cookie Notice" </b>, which can be found in the administration area under ',
	'COOKIE_WARN_2'									=>	' <b><i><u>Server Configuration/Cookies Settings</u></i></b>',
	'COOKIE_WARN_3'									=>	'can be set, suppressed if this is activated. This does not lead to any functional restriction. Only the banner normally displayed is not displayed. The cookie function of this forum is not impaired in any way.',
]);
