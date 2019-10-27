<?php
/**
 *
 * phpBB Media Embed PlugIn extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 * @Polska wersja językowa 30.07.2018, Mateusz Dutko (vader) www.rnavspotters.pl
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_PHPBB_MEDIA_EMBED'				=> 'Osadzanie multimediów',
	'ACP_PHPBB_MEDIA_EMBED_MANAGE'		=> 'Zarządzaj stronami',
	'ACP_PHPBB_MEDIA_EMBED_SETTINGS'	=> 'Ustawienia',

	// Log keys
	'LOG_PHPBB_MEDIA_EMBED_MANAGE'		=> '<strong>Zaktualizowano strony Media Embed</strong>',
	'LOG_PHPBB_MEDIA_EMBED_SETTINGS'	=> '<strong>Zmieniono ustawienia Media Embed</strong>',
));
