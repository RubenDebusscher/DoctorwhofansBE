<?php
/**
*
* @package phpBB Extension - Jumpbox on Index
* @copyright (c) 2020 - 2022 Kirk https://reyno41.bplaced.net/phpbb
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace kirk\jumpboxindex;

class ext extends \phpbb\extension\base
{
	/**
	* Check whether the extension can be enabled.
	* Provides meaningful(s) error message(s) and the back-link on failure.
	* CLI and 3.1/3.2 compatible (we do not use the $lang object here on purpose)
	*
	* @return bool
	*/
	public function is_enableable()
	{
		$phpbb_min_ver		= '3.2.6';
		$phpbb_below_ver	= '3.4.0@dev';

		if (!(phpbb_version_compare(PHPBB_VERSION, $phpbb_min_ver, '>=') && phpbb_version_compare(PHPBB_VERSION, $phpbb_below_ver, '<')))
		{
			if (phpbb_version_compare(PHPBB_VERSION, $phpbb_min_ver, '<'))
			{
				$user = $this->container->get('user');
				$user->add_lang_ext('ext_jumpboxindex_enable_error', 'kirk/jumpboxindex');
				$jumpboxindex = $user->lang('JUMPBOXINDEX');
				trigger_error(sprintf($user->lang('ERROR_JUMPBOXINDEX_EXTENSION_NOT_ENABLEABLE') . '<br>' . $user->lang('ERROR_MSG_PHPBB_WRONG_VERSION'), $jumpboxindex, $phpbb_min_ver, $phpbb_below_ver) . $this->get_adm_back_link(), E_USER_WARNING);
			}
			else
			{
				$language  = $this->container->get('language');
				$language ->add_lang('ext_jumpboxindex_enable_error', 'kirk/jumpboxindex');
				$jumpboxindex = $language->lang('JUMPBOXINDEX');
				trigger_error(sprintf($language->lang('ERROR_JUMPBOXINDEX_EXTENSION_NOT_ENABLEABLE') . '<br>' . $language->lang('ERROR_MSG_PHPBB_WRONG_VERSION'), $jumpboxindex, $phpbb_min_ver, $phpbb_below_ver) . $this->get_adm_back_link(), E_USER_WARNING);
			}
		}
		return true;
	}

	private function get_adm_back_link()
	{
		return adm_back_link(append_sid('index.' . $this->container->getParameter('core.php_ext'), 'i=acp_extensions&amp;mode=main'));
	}
}
