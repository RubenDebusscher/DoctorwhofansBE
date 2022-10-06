<?php
/**
*
* @package phpBB Extension - Jumpbox on Index
* @copyright (c) 2020 - 2022 Kirk https://reyno41.bplaced.net/phpbb
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, [
	// page titel
	'JUMPBOXINDEX'						=> 'Jumpbox on Index',
	'JUMPBOXINDEX_EXPLAIN'				=> 'Hier können diverse Einstellungen (z. b. die Position der Jumpbox) vorgenommen werden.',
	'JUMPBOXINDEX_DEFAULT'				=> 'Anzeige der Jumpbox in der Foren-Übersicht',

	// jumpbox design
	'JUMPBOX_DEFAULT'					=> 'Anzeige der Jumpbox',
	'JUMPBOX_DEFAULT_EXPLAIN'			=> 'Hier kann eingestellt werden, ob die Jumpbox im Standard-Design oder in Form eines Font Awesome Symbols angezeigt werden soll.',
	'FONT_AWESOME_SYMBOL'				=> 'Font Awesome-Symbol',
	'DEFAULTDESIGN'						=> 'Standard-Design',

	// jumpbox ucp
	'JUMPBOX_UCP'						=> 'Anzeige der Jumpbox im Persönlichen Bereich',
	'JUMPBOX_UCP_EXPLAIN'				=> 'Wenn aktiviert, wird die Jumpbox zusätzlich im Persönlichen Bereich angezeigt.',

	// jumpbox left right
	'JUMPBOX_LEFT_RIGHT'				=> 'Anzeige der Jumpbox',
	'JUMPBOX_LEFT_RIGHT_EXPLAIN'		=> 'Hier können Sie einstellen auf welcher Seite die Jumpbox angezeigt werden soll.',
	'JUMPBOX_LEFT'						=> 'Links',
	'JUMPBOX_RIGHT'						=> 'Rechts',

	// jumpbox position
	'JUMPBOXINDEX_POSITION'				=> 'Position der Jumpbox in der Foren-Übersicht',
	'JUMPBOXINDEX_POSITION_EXPLAIN'		=> 'Hier kann eingestellt werden an welcher Position die Jumpbox in der Foren-Übersicht angezeigt werden soll.<br />Die Auswahl der Positionen <strong>"In der oberen Navbar"</strong> oder <strong>"In der unteren Navbar"</strong> verwendet <strong>ausschließlich</strong> das Font Awesome-Symbol.',
	'JUMPBOX_POSITION'					=> 'Position der Jumpbox',
	'JUMPBOX_POSITION_EXPLAIN'			=> 'Hier kann eingestellt werden an welcher Position die Jumpbox angezeigt werden soll.<br />Die Auswahl der Positionen <strong>"In der oberen Navbar"</strong> oder <strong>"In der unteren Navbar"</strong> verwendet <strong>ausschließlich</strong> das Font Awesome-Symbol.',
	'JUMPBOX_NAVBAR_TOP'				=> 'In der oberen Navbar',
	'JUMPBOX_FORUMLIST_BEFORE'			=> 'Oberhalb der Forumlist',
	'JUMPBOX_STATISTICS_AFTER'			=> 'Unterhalb der Statistik',
	'JUMPBOX_NAVBAR_BOTTOM'				=> 'In der unteren Navbar',
	'JUMPBOX_FONT_ICON'					=> 'Jumpbox Icon',
	'JUMPBOX_FONT_ICON_EXPLAIN'			=> 'Geben Sie den Namen eines <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank" rel="noopener noreferrer">Font Awesome</a> Symbols (z. B. <strong>fa-map-o</strong>) ein.<br />Lassen Sie dieses Feld leer, um das Standard Font Awesome-Symbol zu verwenden.',

	// messages
	'JUMPBOX_DISABLED'					=> 'Die Einstellung <strong>"Anzeige der Jumpbox"</strong> ist unter <a href="%1$s">Serverlast</a> deaktiviert!',
	'JUMPBOX_SETTINGS_UPDATED'			=> '%1$s%2$s %3$s',
	'JUMPBOXINDEX_VERSION_COPY'			=> 'phpBB Extension - %1$s- Version %2$s - Powered by <a href="https://reyno41.bplaced.net/phpbb">Kirk</a>',
]);
