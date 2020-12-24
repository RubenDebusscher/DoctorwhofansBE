<?php
/**
*
* @package National Flags
* @copyright (c) 2015 Rich McGirr(RMcGirr83)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace rmcgirr83\nationalflags\core;

use phpbb\config\config;
use phpbb\controller\helper;
use phpbb\cache\service as cache_service;
use phpbb\db\driver\driver_interface;
use phpbb\language\language;
use phpbb\template\template;
use phpbb\user;
use phpbb\extension\manager;
use phpbb\path_helper;
use Symfony\Component\HttpFoundation\JsonResponse;
use rmcgirr83\nationalflags\core\flag_position_constants;

class nationalflags
{

	/**
	 * Target flag_is_set
	 */
	protected $flag_is_set = false;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\db\driver\driver_interface; */
	protected $db;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	 * The database table the flags are stored in
	 *
	 * @var string
	 */
	protected $flags_table;

	/** @var \phpbb\extension\manager "Extension Manager" */
	protected $ext_manager;

	/** @var \phpbb\path_helper */
	protected $path_helper;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config					$config				Config object
	 * @param \phpbb\controller\helper				$helper				Controller helper object
	 * @param \phpbb\cache\service					$cache				Cache object
	 * @param \phpbb\db\driver\driver_interface		$db					Database object
	 * @param \phpbb\language\language				$language			Language object
	 * @param \phpbb\template\template				$template			Template object
	 * @param \phpbb\user							$user				User object
	 * @param string								$flags_table		Name of the table used to store flag data
	 * @param \phpbb\extension\manager				$ext_manager		Extension manager object
	 * @param \phpbb\path_helper					$path_helper		Path helper object
	 */
	public function __construct(
			config $config,
			helper $helper,
			cache_service $cache,
			driver_interface $db,
			language $language,
			template $template,
			user $user,
			$flags_table,
			manager $ext_manager,
			path_helper $path_helper,
			\phpbb\collapsiblecategories\operator\operator $operator = null)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->cache = $cache;
		$this->db = $db;
		$this->language = $language;
		$this->template = $template;
		$this->user = $user;
		$this->flags_table = $flags_table;
		$this->ext_manager	 = $ext_manager;
		$this->path_helper	 = $path_helper;
		$this->operator = $operator;

		$this->ext_path = $this->ext_manager->get_extension_path('rmcgirr83/nationalflags', true);
		$this->ext_path_web = $this->path_helper->update_web_root_path($this->ext_path);
	}

	/**
	 * Get user flag
	 *
	 * @return string flag
	 */

	public function get_user_flag($flag_id = false, $size = 0)
	{
		$flags = $this->get_flag_cache();

		if ($flag_id)
		{
			$flag_name = $this->flag_name_lang_var($flags[$flag_id]['flag_name']);
			$size = (!empty($size)) ? 'style="height:' . $size . 'px; width:auto;"' : '';
			$flag = '<img class="flag_image" src="' . $this->ext_path_web . 'flags/' . $flags[$flag_id]['flag_image'] . '" ' . $size . ' alt="' . $flag_name . '" title="' . $flag_name . '" />';

			return $flag;
		}
		return false;
	}
	/**
	 * cache_flags
	 *
	 * Build the cache of the flags
	 *
	 * @return null
	 */

	public function cache_flags()
	{
		if (($this->cache->get('_user_flags')) === false)
		{
			$sql = 'SELECT *
				FROM ' . $this->flags_table . '
			ORDER BY flag_id';
			$result = $this->db->sql_query($sql);

			$user_flags = [];
			while ($row = $this->db->sql_fetchrow($result))
			{
				$user_flags[$row['flag_id']] = [
					'flag_id'		=> $row['flag_id'],
					'flag_name'		=> $row['flag_name'],
					'flag_image'	=> $row['flag_image'],
					'flag_default'	=> $row['flag_default'],
				];
			}
			$this->db->sql_freeresult($result);

			// cache this data for ever, can only change in ACP
			$this->cache->put('_user_flags', $user_flags);
		}
	}

	/**
	 * Get list_flags
	 *
	 * @param int $flag_id
	 * @return string flag_options
	 */

	public function list_flags($flag_id = false)
	{
		$sql = 'SELECT *
			FROM ' . $this->flags_table . '
		ORDER BY flag_name';
		$result = $this->db->sql_query($sql);

		$flag_options = '<option value="0">' . $this->language->lang('FLAG_EXPLAIN') . '</option>';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$selected = ($row['flag_id'] == $flag_id && !$this->flag_is_set) ? ' selected="selected"' : '';
			if (!empty($selected))
			{
				$this->flag_is_set = true;
			}
			else if ($row['flag_default'] && !$this->flag_is_set)
			{
				$selected = ' selected="selected"';
			}

			$flag_name = $this->flag_name_lang_var($row['flag_name']);

			$flag_options .= '<option value="' . $row['flag_id'] . '" ' . $selected . '>' . $flag_name . '</option>';
		}
		$this->db->sql_freeresult($result);

		return $flag_options;
	}

	/**
	 * Get top_flags
	 * displayed on the index page
	 */
	public function top_flags()
	{
		// If setting in ACP is set to not allow guests and bots to view the flags
		if (!$this->display_flags_on_forum())
		{
			return false;
		}

		$cached_flags = $this->get_flag_cache();
		$cached_user_flags = $this->get_users_and_flags_cache();

		$cached_user_flags = array_count_values($cached_user_flags);

		if (sizeof($cached_user_flags))
		{
			$cached_flags_keys = array_keys($cached_flags);

			foreach ($cached_user_flags as $key => $value)
			{
				if (in_array($key, $cached_flags_keys))
				{
					$cached_flags[$key]['user_count'] = (int) $value;
				}
			}

			//need to add bogus user_count to cached_flags for the sort
			foreach ($cached_flags as $key => $value)
			{
				if (!isset($value['user_count']))
				{
					$cached_flags[$key]['user_count'] = 0;
				}
			}

			$user_count = array_column($cached_flags, 'user_count');
			$flag_name = array_column($cached_flags, 'flag_name');

			// Sort the data with user count descending, flag name ascending
			array_multisort($user_count, SORT_DESC, $flag_name, SORT_ASC, $cached_flags);

			//build the display of flags with user count
			$max_display = (int) $this->config['flags_num_display'];

			$count = 0;
			for ($i = 0; $i < $max_display; ++$i)
			{
				++$count;
				if (!empty($cached_flags[$i]['user_count']))
				{
					$this->template->assign_block_vars('flag', array(
						'FLAG' 			=> $this->get_user_flag($cached_flags[$i]['flag_id']),
						'FLAG_USERS'	=> $this->user->lang('FLAG_USERS', (int) $cached_flags[$i]['user_count']),
						'U_FLAG'		=> $this->helper->route('rmcgirr83_nationalflags_getflags', array('flag_id' => $cached_flags[$i]['flag_id'])),
					));
				}
			}

			if ($count)
			{
				if ($this->operator !== null)
				{
					$fid = 'nationalflags'; // can be any unique string to identify your extension's collapsible element, must have version 2.0.0 of collapsible categories for this to work
					$this->template->assign_vars(array(
						'S_NATIONALFLAGS_HIDDEN' => $this->operator->is_collapsed($fid),
						'U_NATIONALFLAGS_COLLAPSE_URL' => $this->operator->get_collapsible_link($fid),
					));
				}
				$this->template->assign_vars(array(
					'U_FLAGS'		=> $this->helper->route('rmcgirr83_nationalflags_display'),
					'S_FLAGS'		=> true
				));
			}
		}
	}

	/**
	 * Display flag on change in ucp
	 * Ajax function
	 * @param $flag_id
	 *
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 */
	public function get_flag($flag_id)
	{
		$flags = $this->get_flag_cache();

		foreach ($flags as $id => $data)
		{
			$flags_id[] = $id;
		}
		if (!in_array($flag_id, $flags_id))
		{
			if ($this->config['flags_required'])
			{
				return new JsonResponse([
					'error' => $this->language->lang('MUST_CHOOSE_FLAG'),
				]);
			}
			else
			{
				return new JsonResponse([
					'error' => $this->language->lang('NO_SUCH_FLAG'),
				]);
			}
		}

		$flag_img = $this->ext_path . 'flags/' . $flags[$flag_id]['flag_image'];
		$flag_img = str_replace('./', generate_board_url() . '/', $flag_img); //fix paths

		$flag_name = $this->flag_name_lang_var($flags[$flag_id]['flag_name']);

		$json = new JsonResponse([
				'flag_image'     => $flag_img,
				'flag_name'     => $flag_name,
		]);
		return $json;
	}

	/**
	 * Get the cache of the flags
	 *
	 * @return string flag_cache
	 * @access public
	 */
	public function get_flag_cache()
	{
		return $this->cache->get('_user_flags');
	}

	/**
	 * Get the cache of the users and their flags
	 *
	 * @return string users and flags
	 * @access public
	 */
	public function get_users_and_flags_cache()
	{
		return $this->cache->get('_users_and_flags');
	}

	/**
	* Display Flag to guests
	*/
	public function display_flags_on_forum($setting = true)
	{
		if (!$setting)
		{
			return false;
		}
		if (!$this->config['flags_display_to_guests'])
		{
			$check_display = ($this->user->data['user_id'] == ANONYMOUS || $this->user->data['is_bot']) ? false : true;
			return $check_display;
		}

		return true;
	}

	/**
	* Flag position
	*/
	public function flag_display_position()
	{
		$flag_position_constants = flag_position_constants::get_flag_position();

		$flag_display_position = '';
		foreach ($flag_position_constants as $name => $value)
		{
			if ($value == $this->config['flag_position'])
			{
				$flag_display_position = 'FLAG_POSITION_' . $name;
			}
		}
		return $flag_display_position;
	}

	/**
	* Build users and flags		A cache of user ids and the applicable flag id
	*
	* @return null
	* @access public
	*/
	public function build_users_and_flags()
	{
		if (($this->cache->get('_users_and_flags')) === false)
		{
			$sql = 'SELECT user_id, user_flag
				FROM ' . USERS_TABLE . '
			WHERE user_flag > 0';
			$result = $this->db->sql_query($sql);

			$users_and_flags = [];
			while ($row = $this->db->sql_fetchrow($result))
			{
				$users_and_flags[$row['user_id']] = $row['user_flag'];
			}
			$this->db->sql_freeresult($result);

			// cache this data forever, cache is only destroyed when a user registers or updates their profile
			$this->cache->put('_users_and_flags', $users_and_flags);
		}
	}

	/**
	* User flag id		The flag id a user has chosen
	*
	* @param int user_id	$user_id	the user id
	* @param return			int 		the users flag id or false
	*/
	public function user_flag_id($user_id = 0)
	{
		$users_flag_array = $this->get_users_and_flags_cache();

		$users = [];
		$flag_id = 0;
		if (!empty($users_flag_array))
		{
			$users = array_keys($users_flag_array);
			$flag_id = isset($users_flag_array[$user_id]) ? intval($users_flag_array[$user_id]) : 0;
		}

		if (in_array($user_id, $users) && !empty($flag_id))
		{
			return $flag_id;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Display flag for user selection
	 *
	 * @param object $user_flag The users flag number
	 * @return null
	 * @access public
	 */
	public function display_flag_options($user_flag)
	{
		$flags = $this->get_flag_cache();

		$flag_name = $flag_image = '';

		foreach ($flags as $key => $value)
		{
			if ($value['flag_default'])
			{
				$flag_name = $value['flag_name'];
				$flag_image = $value['flag_image'];
			}
		}

		if ($user_flag)
		{
			$flag_name = $this->flag_name_lang_var($flags[$user_flag]['flag_name']);

			$flag_image = $flags[$user_flag]['flag_image'];
		}

		$s_flag_options = $this->list_flags($user_flag);

		$this->template->assign_vars([
			'USER_FLAG'			=> $user_flag,
			'FLAG_IMAGE'		=> ($flag_image) ? $this->ext_path . 'flags/' . $flag_image : '',
			'FLAG_NAME'			=> $flag_name,
			'S_FLAG_OPTIONS'	=> $s_flag_options,
			'S_FLAGS'			=> true,
			'S_FLAG_REQUIRED'	=> ($this->config['flags_required']) ? true : false,
			'AJAX_FLAG_INFO' 	=> $this->helper->route('rmcgirr83_nationalflags_getflag', ['flag_id' => $user_flag]),
		]);
	}

	/**
	* Trash the cache		destroys the users and flags cache
	*						called on registration and if a user changes their flag choice in profile
	*
	* @return null
	* @access public
	*/
	public function trash_the_cache()
	{
		$this->cache->destroy('_users_and_flags');
	}

	/**
	 * Check for translated flag name for the user
	 *
	 * @return string	translated flag name
	 * @access public
	 */
	public function flag_name_lang_var($flag_name = '')
	{
		if (array_key_exists((strtoupper(str_replace(" ", "_", $flag_name))), $this->language->get_lang_array()))
		{
			$flag_name = html_entity_decode($this->language->lang(strtoupper(str_replace(" ", "_", $flag_name))));
		}

		return $flag_name;
	}
}
