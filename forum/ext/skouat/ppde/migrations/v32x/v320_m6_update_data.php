<?php
/**
 *
 * PayPal Donation extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015-2020 Skouat
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace skouat\ppde\migrations\v32x;

class v320_m6_update_data extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\skouat\ppde\migrations\v32x\v320_m5_update_schema'];
	}

	public function update_data()
	{
		return [
			['config.add', ['ppde_default_remote', 0]],
			['config.add', ['ppde_sandbox_remote', 1]],
		];
	}
}
