<?php

/**
 * @package Verified Profiles
 * @copyright (c) 2021 Daniel James
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

if ( ! defined( 'IN_PHPBB' ) ) {

	exit;

}

if ( empty( $lang ) || ! is_array( $lang ) ) {

	$lang = [];

}

$lang = array_merge( $lang, [
	'VERIFIED' => 'Verified',
	'VERIFIED_TIP' => 'User is verified',
	'VERIFIED_LABEL' => 'Verify',
	'VERIFIED_EXPLAIN' => 'Set as yes to verify this user\'s profile.',
] );
