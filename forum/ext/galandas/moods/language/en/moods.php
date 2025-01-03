<?php
/**
*
* Mood. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017 Galandas, http://phpbb3world.altervista.org
* @copyright Used Code Genders extension, 2016 Rich McGirr (RMcGirr83)
* @license GNU General Public License, version 2 (GPL-2.0)
*
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
	'MOOD'					=> 'Mood',
	'MOOD_NONE'				=> 'None Specified',
	'EM-BIGGRIN'			=> 'Happy',
	'EM-CONFUSED'			=> 'Confused',
	'EM-COOL'				=> 'Cool',
	'EM-CRY'				=> 'I crying',
	'EM-EEK'				=> 'Can not believe',
	'EM-EVIL'				=> 'Demoniac',
	'EM-LOL'				=> 'LOL',
	'EM-MAD'				=> 'Gone mad',
	'EM-MRGREEN'			=> 'Mr Green',
	'EM-NEUTRAL'			=> 'Neutral',
	'EM-RAZZ'				=> 'Smiling',
	'EM-REDFACE'			=> 'Blushed',
	'EM-ROLLEYES'			=> 'I do not understand',
	'EM-SAD'				=> 'Sad',
	'EM-SCREAM'				=> 'Screaming',
	'EM-SMILE'				=> 'Smiley face',
	'EM-SURPRISED'			=> 'Surprised',
	'EM-TWISTED'			=> 'Twisted',
	'EM-UGEEK'				=> 'Rocking',
	'EM-WINK'				=> 'Winked',
	'TOO_LARGE_USER_MOOD'	=> 'Mood value is too large.',
	'TOO_SMALL_USER_MOOD'	=> 'Mood value is too small.',
]);
