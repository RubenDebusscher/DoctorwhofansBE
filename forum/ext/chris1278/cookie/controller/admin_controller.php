<?php
/**
 *
 * Opt-In Cookie Manager. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace chris1278\cookie\controller;

class admin_controller
{
	protected $extension_manager;
	protected $path_helper;
	protected $config;
	protected $language;
	protected $log;
	protected $request;
	protected $template;
	protected $user;
	protected $root_path;
	protected $php_ext;
	protected $u_action;

	public function __construct(
		\phpbb\extension\manager $ext_manager,
		\phpbb\path_helper $path_helper,
		\phpbb\config\config $config,
		\phpbb\language\language $language,
		\phpbb\log\log $log,
		\phpbb\request\request $request,
		\phpbb\template\template $template,
		\phpbb\user $user,
		$root_path,
		$php_ext
	)
	{
		$this->md_manager 			= $ext_manager->create_extension_metadata_manager('chris1278/cookie');
		$this->admin_path 			= $path_helper->get_phpbb_root_path() . $path_helper->get_adm_relative_path();
		$this->config				= $config;
		$this->language				= $language;
		$this->log					= $log;
		$this->request				= $request;
		$this->template				= $template;
		$this->user					= $user;
		$this->php_ext				= $php_ext;
		$this->root_path			= $root_path;
	}

	public function display_general()
	{
		$ext_display_ver 			= $this->md_manager->get_metadata('version');
		$ext_lang_min_ver 			= $this->md_manager->get_metadata()['extra']['lang-min-ver'];
		$ext_display_name 			= $this->md_manager->get_metadata('display-name');
		$ext_display_ver 			= $this->md_manager->get_metadata('version');
		$lang_ver 					= ($this->language->lang('CM_LANG_EXT_VER') !== 'CM_LANG_EXT_VER') ? $this->language->lang('CM_LANG_EXT_VER') : '0.0.0';
		$notes 						= '';
		$this->language->add_lang('acp_cookie_general', 'chris1278/cookie');
		add_form_key('cookie_general');
		$errors = [];

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('cookie_general'))
			{
				$errors[] = $this->language->lang('FORM_INVALID');
			}

			if (empty($errors))
			{
				$this->config->set('window_position', $this->request->variable('window_position', 0));
				$this->config->set('name_of_cookie', $this->request->variable('name_of_cookie', ''));
				$this->config->set('klaro_div_container', $this->request->variable('klaro_div_container', ''));
				$this->config->set('klaro_hidden_windows', $this->request->variable('klaro_hidden_windows', 0));
				$this->config->set('html_code_processing', $this->request->variable('html_code_processing', 0));
				$this->config->set('group_formation', $this->request->variable('group_formation', 0));
				$this->config->set('cookie_icon_selection', $this->request->variable('cookie_icon_selection', 0));
				$this->config->set('save_all_button', $this->request->variable('save_all_button', 0));
				$this->config->set('cookie_runtime', $this->request->variable('cookie_runtime', ''));
				$this->config->set('show_decline_button', $this->request->variable('show_decline_button', 0));
				$this->config->set('to_the_cookie_settings', $this->request->variable('to_the_cookie_settings', 0));
				$this->config->set('window_fix_in_the_middle', $this->request->variable('window_fix_in_the_middle', 0));
				$this->config->set('klaro_note', $this->request->variable('klaro_note', 0));
				$this->config->set('storage_version', $this->request->variable('storage_version', '', true));
				$this->config->set('klarostyle', $this->request->variable('klarostyle', '', true));
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ACP_COOKIE_GENERAL');
				trigger_error($this->language->lang('ACP_COOKIE_SETTING_SAVED') . adm_back_link($this->u_action));
			}
		}

		$s_errors = !empty($errors);

		if (!phpbb_version_compare($lang_ver, $ext_lang_min_ver, '>='))
		{
			$this->add_note($notes, $this->language->lang('CM_MSG_LANGUAGEPACK_OUTDATED'));
		}

		$this->template->assign_vars([
			'S_ERROR'					=>	$s_errors,
			'ERROR_MSG'					=>	$s_errors ? implode('<br />', $errors) : '',
			'CM_NOTES'					=>	$notes,
			'CM_EXT_NAME'				=>	$ext_display_name,
			'CM_EXT_VER'				=>	$ext_display_ver,
			'WINDOW_POSITION'			=>	$this->config['window_position'],
			'NAME_OF_COOKIE'			=>	$this->config['name_of_cookie'],
			'KLARO_DIV_CONTAINER'		=>	$this->config['klaro_div_container'],
			'KLARO_HIDDEN_WINDOWS'		=>	$this->config['klaro_hidden_windows'],
			'HTML_CODE_PROCESSING'		=>	$this->config['html_code_processing'],
			'GROUP_FORMATION'			=>	$this->config['group_formation'],
			'COOKIE_ICON_SELECTION'		=>	$this->config['cookie_icon_selection'],
			'SAVE_ALL_BUTTON'			=>	$this->config['save_all_button'],
			'COOKIE_RUNTIME'			=>	$this->config['cookie_runtime'],
			'SHOW_DECLINE_BUTTON'		=>	$this->config['show_decline_button'],
			'TO_THE_COOKIE_SETTINGS'	=>	$this->config['to_the_cookie_settings'],
			'WINDOW_FIX_IN_THE_MIDDLE'	=>	$this->config['window_fix_in_the_middle'],
			'KLARO_NOTE'				=> 	$this->config['klaro_note'],
			'STORAGE_VERSION'			=> 	$this->config['storage_version'],
			'KLAROSTYLE'				=> 	$this->config['klarostyle'],
			'U_COOKIE_BANNER'			=>	append_sid("{$this->admin_path}index.$this->php_ext", '&i=acp_board&mode=cookie'),
			'U_ACTION'					=>	$this->u_action,

		]);
	}

	private function add_note(string &$notes, $msg)
	{
		$notes .= (($notes != '') ? "\n" : "") . sprintf('<p>%s</p>', $msg);

	}

	public function display_switches()
	{
		$ext_display_name 			= $this->md_manager->get_metadata('display-name');
		$this->language->add_lang('acp_cookie_switches', 'chris1278/cookie');
		add_form_key('cookie_switches');
		$errors = [];

		if ($this->request->is_set_post('submit'))
		{

			if (!check_form_key('cookie_switches'))
			{
				$errors[] = $this->language->lang('FORM_INVALID');
			}

			if (empty($errors))
			{
				$this->config->set('youtube_bbcode_switch', $this->request->variable('youtube_bbcode_switch', 0));
				$this->config->set('google_translator_switch', $this->request->variable('google_translator_switch', 0));
				$this->config->set('google_analytics_no_tm_switch', $this->request->variable('google_analytics_no_tm_switch', 0));
				$this->config->set('google_analytics_id', $this->request->variable('google_analytics_id', ''));
				$this->config->set('vimeo_bbcode_switch', $this->request->variable('vimeo_bbcode_switch', 0));
				$this->config->set('spotify_bbcode_switch', $this->request->variable('spotify_bbcode_switch', 0));
				$this->config->set('matomo_switch', $this->request->variable('matomo_switch', 0));
				$this->config->set('matomo_url', $this->request->variable('matomo_url', ''));
				$this->config->set('matomo_side_id', $this->request->variable('matomo_side_id', '1'));
				$this->config->set('matomo_in_out', $this->request->variable('matomo_in_out', 0));
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ACP_COOKIE_SWITCHES');
				trigger_error($this->language->lang('ACP_COOKIE_SETTING_SAVED') . adm_back_link($this->u_action));
			}
		}

		$s_errors = !empty($errors);

		if (empty($this->config['matomo_side_id']))
		{
			$matomoacpsideid					=	'1';
		}
		else
		{
			$matomoacpsideid					=	$this->config['matomo_side_id'];
		}

		$this->template->assign_vars([
			'S_ERROR'									=>	$s_errors,
			'ERROR_MSG'									=>	$s_errors ? implode('<br />', $errors) : '',
			'CM_EXT_NAME'								=>	$ext_display_name,
			'MATOMO_SWITCH'								=>	$this->config['matomo_switch'],
			'MATOMO_URL'								=>	$this->config['matomo_url'],
			'MATOMO_SIDE_ID'							=>	$matomoacpsideid,
			'MATOMO_IN_OUT'								=>	$this->config['matomo_in_out'],
			'YOUTUBE_BBCODE_SWITCH'						=>	$this->config['youtube_bbcode_switch'],
			'GOOGLE_TRANSLATOR_SWITCH'					=>	$this->config['google_translator_switch'],
			'GOOGLE_ANALYTICS_NO_TM_SWITCH'				=>	$this->config['google_analytics_no_tm_switch'],
			'GOOGLE_ANALYTICS_ID'						=>	$this->config['google_analytics_id'],
			'VIMEO_BBCODE_SWITCH'						=>	$this->config['vimeo_bbcode_switch'],
			'SPOTIFY_BBCODE_SWITCH'						=>	$this->config['spotify_bbcode_switch'],
			'U_ACTION'									=>	$this->u_action,

		]);
	}

	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
