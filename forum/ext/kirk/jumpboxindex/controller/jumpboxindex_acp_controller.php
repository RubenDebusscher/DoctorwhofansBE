<?php
/**
*
* @package phpBB Extension - Jumpbox on Index
* @copyright (c) 2020 - 2022 Kirk https://reyno41.bplaced.net/phpbb
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace kirk\jumpboxindex\controller;

class jumpboxindex_acp_controller
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;

	/** @var string */
	protected $phpbb_admin_path;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string PHP extension */
	protected $php_ext;

	/** @var string Custom form action */
	protected $u_action;

	/**
	* Constructor for acp controller
	*
	* @param \phpbb\config\config			$config					Config object
	* @param \phpbb\request\request			$request				Request object
	* @param \phpbb\template\template		$template				Template object
	* @param \phpbb\extension\manager		$phpbb_ext_manager		Extension manager Object
	* @param \phpbb\user					$user					User object
	* @param \phpbb\language\language		$language				Language object
	* @param string							$phpbb_root_path		phpbb_root_path
	*
	*/
	public function __construct(
		\phpbb\config\config $config,
		\phpbb\language\language $language,
		\phpbb\request\request $request,
		\phpbb\template\template $template,
		$ext_manager,
		$path_helper,
		$php_ext
	)
	{
		$this->config			= $config;
		$this->language			= $language;
		$this->request			= $request;
		$this->template			= $template;
		$this->php_ext			= $php_ext;
		$this->admin_path		= $path_helper->get_phpbb_root_path() . $path_helper->get_adm_relative_path();
		$this->md_manager		= $ext_manager->create_extension_metadata_manager('kirk/jumpboxindex');
	}

	public function jumpbox_settings($u_action)
	{
		// Jumpboxindex Settings
		$form_key					= 'acp_jumpboxindex';
		$this->u_action				= $u_action;
		$u_serverlast				= append_sid("{$this->phpbb_admin_path}index.$this->php_ext" ,'i=acp_board&amp;mode=load');
		$redirect_url				= append_sid("{$this->phpbb_admin_path}index.$this->php_ext" ,'i=-kirk-jumpboxindex-acp-jumpboxindex_module&mode=settings');
		$disp_ext_name				= $this->md_manager->get_metadata('display-name');
		$jumpboxindex_version		= $this->md_manager->get_metadata('version');
		$jumpbox_colon				= $this->language->lang('COLON');
		$jumpbox_config_updated		= $this->language->lang('CONFIG_UPDATED');
		$jumpbox_disabled			= $this->config['load_jumpbox'] == 0;
		$submit						= $this->request->is_set_post('submit');
		$jumpbox_notes				= '';
		$this->language->add_lang('jumpboxindex_acp', 'kirk/jumpboxindex');
		add_form_key($form_key);

		if ($submit)
		{
			if (!check_form_key($form_key))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$this->config->set('jumpbox_default', $this->request->variable('jumpbox_default', ''));
			$this->config->set('jumpbox_ucp', $this->request->variable('jumpbox_ucp', ''));
			$this->config->set('jumpbox_left', $this->request->variable('jumpbox_left', ''));
			$this->config->set('jumpbox_position', $this->request->variable('jumpbox_position', ''));
			$this->config->set('jumpbox_font_icon', $this->request->variable('jumpbox_font_icon', ''));
			meta_refresh(2, $redirect_url);
			trigger_error(sprintf($this->language->lang('JUMPBOX_SETTINGS_UPDATED'), $disp_ext_name, $jumpbox_colon, $jumpbox_config_updated) . adm_back_link($this->u_action));
		}

		if ($jumpbox_disabled)
		{
			$this->add_jumpbox_note($jumpbox_notes, sprintf($this->language->lang('JUMPBOX_DISABLED'), $u_serverlast));
		}

		$this->template->assign_vars([
			'JUMPBOX_NOTES'				=> $jumpbox_notes,
			'JUMPBOX_DISABLED'			=> $jumpbox_disabled,
			'JUMPBOX_DEFAULT'			=> $this->config['jumpbox_default'],
			'JUMPBOX_UCP'				=> $this->config['jumpbox_ucp'],
			'JUMPBOX_LEFT'				=> $this->config['jumpbox_left'],
			'JUMPBOX_POSITION'			=> $this->config['jumpbox_position'],
			'JUMPBOX_FONT_ICON'			=> $this->config['jumpbox_font_icon'],
			'JUMPBOXINDEX_VERSION'		=> sprintf($this->language->lang('JUMPBOXINDEX_VERSION_COPY'), $disp_ext_name, $jumpboxindex_version),
			'U_ACTION'					=> $this->u_action
		]);
	}

	private function add_jumpbox_note(string &$jumpbox_notes, string $msg)
	{
		$jumpbox_notes .= (($jumpbox_notes != '') ? "\n" : "") . sprintf('<p>%s</p>', $msg);
	}
}
