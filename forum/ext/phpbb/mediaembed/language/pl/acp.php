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
	// Settings
	'ACP_MEDIA_SETTINGS'				=> 'Ustawienia osadzania multimediów',
	'ACP_MEDIA_SETTINGS_EXPLAIN'		=> 'Tutaj można dokonać konfiguracji rozszerzenia Media Embed.',
	'ACP_MEDIA_DISPLAY_BBCODE'			=> 'Wyświetl znacznik BBcode <samp>[MEDIA]</samp> na forum',
	'ACP_MEDIA_DISPLAY_BBCODE_EXPLAIN'	=> 'Jeśli wybrano Nie, to znacznik <samp>[MEDIA]</samp> nie będzie wyświetlony, jednakże nadal można go używać na forum.',
	'ACP_MEDIA_ALLOW_SIG'				=> 'Znacznik <samp>[MEDIA]</samp> w podpisach',
	'ACP_MEDIA_ALLOW_SIG_EXPLAIN'		=> 'Zezwól na używanie multimediów w sygnaturze.',
	'ACP_MEDIA_PARSE_URLS'				=> 'Konwersja adresów URL',
	'ACP_MEDIA_PARSE_URLS_EXPLAIN'		=> 'Jeśli wybrano Tak, to adresy URL zostaną przekonwertowane bez użycia znacznika BBCode <samp>[media]</samp> lub <samp>[url]</samp>. Ta opcja wpłynie tylko na nowo osadzone multimedia. Dotychczasowe adresy URL nie zostaną przetworzone.',
	'ACP_MEDIA_SITE_TITLE'				=> 'ID strony: %s',
	'ACP_MEDIA_SITE_DISABLED'			=> 'Ta strona ma konflikt z istniejącym znacznikiem BBCode: [%s]',

	// Manage sites
	'ACP_MEDIA_MANAGE'					=> 'Zarządzaj stronami osadzania multimediów',
	'ACP_MEDIA_MANAGE_EXPLAIN'			=> 'Tutaj można dokonać konfiguracji wyświetlania elementów stron przez rozszerzenie Media Embed.',
	'ACP_MEDIA_SITES_ERROR'				=> 'Nie ma żadnych stron do wyświetlenia.',
	'ACP_MEDIA_SITES_MISSING'			=> 'The following sites are no longer supported or working. Please re-submit this page to remove them.',
));
