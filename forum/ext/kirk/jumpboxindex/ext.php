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
		$php_min_ver		= '7.0.0';
		$php_below_ver		= '8.1.0@dev';
		$error_message		= [];

		if (!(phpbb_version_compare(PHPBB_VERSION, $phpbb_min_ver, '>=') && phpbb_version_compare(PHPBB_VERSION, $phpbb_below_ver, '<')))
		{
			if (phpbb_version_compare(PHPBB_VERSION, $phpbb_min_ver, '<'))
			{
				$user = $this->container->get('user');
				$user->add_lang_ext('kirk/jumpboxindex', 'ext_jumpboxindex_enable_error');
				$jumpboxindex = $user->lang('JUMPBOXINDEX');
				$error_message = ['error' => (sprintf($user->lang('ERROR_JUMPBOXINDEX_EXTENSION_NOT_ENABLEABLE') . '<br>' . $user->lang('ERROR_MSG_PHPBB_WRONG_VERSION'), $jumpboxindex, $phpbb_min_ver, $phpbb_below_ver)),];
			}
			else
			{
				$language  = $this->container->get('language');
				$language ->add_lang('ext_jumpboxindex_enable_error', 'kirk/jumpboxindex');
				$jumpboxindex = $language->lang('JUMPBOXINDEX');
				$error_message = ['error' => (sprintf($language->lang('ERROR_JUMPBOXINDEX_EXTENSION_NOT_ENABLEABLE') . '<br>' . $language->lang('ERROR_MSG_PHPBB_WRONG_VERSION'), $jumpboxindex, $phpbb_min_ver, $phpbb_below_ver)),];
			}
		}

		if (!(phpbb_version_compare(PHP_VERSION, $php_min_ver, '>=') && phpbb_version_compare(PHP_VERSION, $php_below_ver, '<')) && (phpbb_version_compare(PHPBB_VERSION, $phpbb_min_ver, '>=') && phpbb_version_compare(PHPBB_VERSION, $phpbb_below_ver, '<')))
		{
			$language  = $this->container->get('language');
			$language ->add_lang('ext_jumpboxindex_enable_error', 'kirk/jumpboxindex');
			$jumpboxindex = $language->lang('JUMPBOXINDEX');
			$error_message = ['error' => (sprintf($language->lang('ERROR_JUMPBOXINDEX_EXTENSION_NOT_ENABLEABLE') . '<br>' . $language->lang('ERROR_MSG_PHP_WRONG_VERSION'), $jumpboxindex, $php_min_ver, $php_below_ver)),];
		}

		if (phpbb_version_compare(PHPBB_VERSION, '3.3.0', '<') && !empty($error_message))
		{
			$error_message = implode('<br>', $error_message);
			trigger_error($error_message . $this->get_adm_back_link(), E_USER_WARNING);
		}

		return empty($error_message) ? true : $error_message;
	}

	private function get_adm_back_link()
	{
		return adm_back_link(append_sid('index.' . $this->container->getParameter('core.php_ext'), 'i=acp_extensions&amp;mode=main'));
	}
}
