<?php
/**
 *
 * @package phpBB Extension - Smartfeed
 * @copyright (c) 2018 Mark D. Hamill (mark@phpbbservices.com)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace phpbbservices\smartfeed;

/**
 * @ignore
 */

class ext extends \phpbb\extension\base
{

	public function is_enableable()
	{

		$config = $this->container->get('config');

		if (
			phpbb_version_compare($config['version'], '3.2.0', '>=') &&
			phpbb_version_compare($config['version'], '4.0', '<') &&
			extension_loaded('xml') &&
			extension_loaded('pcre') &&
			extension_loaded('openssl')
		)
		{
			// Conditions met to install extension
			return true;
		}
		else
		{
			$language = $this->container->get('language');
			$language->add_lang(array('common'), 'phpbbservices/smartfeed');
			$message_type = E_USER_WARNING;
			$message = $language->lang('SMARTFEED_INSTALL_REQUIREMENTS');
			trigger_error($message, $message_type);
			return false;
		};

	}

}
