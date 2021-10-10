<?php

/**
 * @package Verified Profiles
 * @copyright (c) 2021 Daniel James
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace danieltj\verifiedprofiles;

class ext extends \phpbb\extension\base {

	/**
	 * Check to see if at least phpBB 3.2 is used.
	 *
	 * @return boolean
	 */
	public function is_enableable() {

		$config = $this->container->get( 'config' );

		return phpbb_version_compare( $config[ 'version' ], '3.2', '>=' );

	}

}
