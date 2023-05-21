<?php

/**
*
* @package phpBB Extension - Show Transferred Permissions
* @copyright (c) 2020 - HiFiKabin
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace hifikabin\showtransferedpermissions\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{

	protected $language;

	public function __construct(\phpbb\language\language $language)
	{
		$this->language				= $language;
	}

	public static function getSubscribedEvents()
	{
		return array(
			'core.user_setup'		=> 'load_lang',
		);
	}

	public function load_lang()
	{
		$this->language->add_lang('showtransferedpermissions', 'hifikabin/showtransferedpermissions');
	}
}
