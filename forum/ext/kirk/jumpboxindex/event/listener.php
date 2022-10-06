<?php
/**
*
* @package phpBB Extension - Jumpbox on Index
* @copyright (c) 2020 - 2022 Kirk https://reyno41.bplaced.net/phpbb
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace kirk\jumpboxindex\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $phpbb_root_path;

	/** @var string PHP extension */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\config\config		$config				Config object
	* @param \phpbb\template\template	$template			Template object
	* @param \phpbb\user				$user				User object
	* @param \phpbb\phpbb_root_path		$phpbb_root_path	phpbb_root_path
	* @param \phpbb\php_ext				$php_ext			php_ext
	*
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->config		= $config;
		$this->template		= $template;
		$this->user			= $user;
		$this->root_path	= $phpbb_root_path;
		$this->php_ext		= $php_ext;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	*/
	public static function getSubscribedEvents()
	{
		return [
			'core.page_header'					=> 'jumpbox_settings',
			'core.index_modify_page_title'		=> 'make_jumpbox_index',
			'core.ucp_display_module_before'	=> 'make_jumpbox_ucp'
		];
	}

	public function jumpbox_settings()
	{
		$jumpbox_default = $this->config['jumpbox_default'];
		$jumpbox_left = $this->config['jumpbox_left'] == 1;
		$jumpbox_right = $this->config['jumpbox_left'] == 0;
		$jumpbox_position = $this->config['jumpbox_position'];
		$jumpbox_position_navbar = $this->config['jumpbox_position'] == 1 || $this->config['jumpbox_position'] == 4;
		$jumpbox_position_top = $this->config['jumpbox_position'] == 2;
		$jumpbox_position_down = $this->config['jumpbox_position'] == 3 || $this->config['jumpbox_position'] == 4;
		$jumpbox_font_icon = $this->config['jumpbox_font_icon'];
		$show_jumpbox_index = ($this->user->page['page_name'] == 'index.' .$this->php_ext);
		$show_jumpbox_ucp = ($this->user->page['page_name'] == 'ucp.' .$this->php_ext);

		$this->template->assign_vars([
			'JUMPBOX_DEFAULT'				=> $jumpbox_default,
			'JUMPBOX_RIGHT'					=> $jumpbox_right,
			'JUMPBOX_POSITION'				=> $jumpbox_position,
			'JUMPBOX_POSITION_DOWN'			=> $jumpbox_position_down,
			'JUMPBOX_POSITION_DOWN_LEFT'	=> $jumpbox_position_down && $jumpbox_left,
			'JUMPBOX_POSITION_DOWN_RIGHT'	=> $jumpbox_position_down && $jumpbox_right,
			'JUMPBOX_TOP_LEFT'				=> $jumpbox_position_top && $jumpbox_left,
			'JUMPBOX_TOP_RIGHT'				=> $jumpbox_right && $jumpbox_position_top,
			'JUMPBOX_DOWN_LEFT'				=> $jumpbox_position_down && $jumpbox_left,
			'JUMPBOX_DOWN_RIGHT'			=> $jumpbox_position_down && $jumpbox_right,
			'JUMPBOX_NAVBAR'				=> $jumpbox_position_navbar,
			'JUMPBOX_FONT_ICON'				=> $jumpbox_font_icon,
			'JUMPBOX_INDEX_UCP'				=> $show_jumpbox_index || $show_jumpbox_ucp,
			'JUMPBOX_UCP'					=> $show_jumpbox_ucp
		]);
	}

	// Display whether jumpbox on index should be displayed
	public function make_jumpbox_index()
	{
		make_jumpbox(append_sid("{$this->phpbb_root_path}viewforum.$this->php_ext"));
	}

	// Display of whether the jumpbox should be displayed in the user control panel
	public function make_jumpbox_ucp()
	{
		if ($this->config['jumpbox_ucp'] == 1)
		{
			make_jumpbox(append_sid("{$this->phpbb_root_path}viewforum.$this->php_ext"));
		}
	}
}
