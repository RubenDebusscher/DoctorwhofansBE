<?php

/**
 * SEO Metadata extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2018 Alfredo Ramos
 * @license GNU GPL-2.0-only
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * @ignore
 */
if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'ACP_SEO_METADATA' => 'SEO Metadata',
	'LOG_SEO_METADATA_DATA' => '<strong>Změna nastavení SEO Metadata</strong><br>» %s'
]);
