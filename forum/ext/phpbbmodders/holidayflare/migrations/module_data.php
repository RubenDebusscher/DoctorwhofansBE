<?php
/**
 *
 * @package Holiday Flare extension
 * @author bonelifer (William Jacoby) bonelifer@phpbbmodders.net
 * @author VSE (Matt Friedman)
 * @copyright (c) 2014 phpbbmodders.net
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbmodders\holidayflare\migrations;

class module_data extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_HOLIDAYFLARE'
			)),
			array('module.add', array(
				'acp',
				'ACP_HOLIDAYFLARE',
				array(
					'module_basename'	=> '\phpbbmodders\holidayflare\acp\holidayflare_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
