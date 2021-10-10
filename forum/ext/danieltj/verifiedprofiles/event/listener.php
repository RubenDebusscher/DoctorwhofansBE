<?php

/**
 * @package Verified Profiles
 * @copyright (c) 2021 Daniel James
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace danieltj\verifiedprofiles\event;

use phpbb\controller\helper;
use phpbb\language\language;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface {

	/**
	 * @var helper
	 */
	protected $helper;

	/**
	 * @var language
	 */
	protected $language;

	/**
	 * @var request
	 */
	protected $request;

	/**
	 * @var template
	 */
	protected $template;

	/**
	 * @var user
	 */
	protected $user;

	/**
	 * Setup the class to include core phpBB bits.
	 */
	public function __construct( helper $helper, language $language, request $request, template $template, user $user ) {

		$this->helper = $helper;
		$this->language = $language;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;

	}

	/**
	 * Hook into core events.
	 */
	static public function getSubscribedEvents() {

		return [
			'core.user_setup'						=> 'verifiedprofiles_language_init',
			'core.acp_users_modify_profile'			=> 'verifiedprofiles_modify',
			'core.acp_users_profile_modify_sql_ary'	=> 'verifiedprofiles_sql_ary',
			'core.viewtopic_cache_user_data'		=> 'verifiedprofiles_viewtopic_cache_user_data',
			'core.viewtopic_cache_guest_data'		=> 'verifiedprofiles_viewtopic_cache_guest_data',
			'core.viewtopic_modify_post_row'		=> 'verifiedprofiles_viewtopic_modify_post_row'
		];

	}

	/**
	 * Add the language pack.
	*/
	public function verifiedprofiles_language_init( $event ) {

		$lang_set_ext = $event[ 'lang_set_ext' ];

		$lang_set_ext[] = [
			'ext_name' => 'danieltj/verifiedprofiles',
			'lang_set' => 'verifiedprofiles',
		];

		$event[ 'lang_set_ext' ] = $lang_set_ext;

	}

	/**
	 * Update event data to include verified setting.
	 */
	public function verifiedprofiles_modify( $event ) {

		if ( defined( 'IN_ADMIN' ) ) {

			$verified = $this->request->variable( 'user_verified', (int) $event[ 'user_row' ][ 'user_verified' ] );

		} else {

			$verified = $this->request->variable( 'user_verified', (int) $this->user->data[ 'user_verified' ] );

		}

		$event[ 'data' ] = array_merge( $event[ 'data' ], [
			'user_verified' => $verified
		] );

		$this->template->assign_vars( [
			'USER_VERIFIED' => $verified
		] );

	}

	/**
	 * SQL stuff, apparently.
	 */
	public function verifiedprofiles_sql_ary( $event ) {

		$event[ 'sql_ary' ] = array_merge( $event[ 'sql_ary' ], [
				'user_verified' => $event[ 'data' ][ 'user_verified' ],
		] );

	}

	/**
	 * Include the verified setting in the cache.
	 */
	public function verifiedprofiles_viewtopic_cache_user_data( $event ) {

		$array = $event[ 'user_cache_data' ];
		$array[ 'user_verified' ] = $event[ 'row' ][ 'user_verified' ];
		$event[ 'user_cache_data' ] = $array;

	}

	/**
	 * Include the verified setting in the cache.
	 */
	public function verifiedprofiles_viewtopic_cache_guest_data( $event ) {

		$array = $event[ 'user_cache_data' ];
		$array[ 'user_verified' ] = '';
		$event[ 'user_cache_data' ] = $array;

	}

	/**
	 * Add the verified setting into the postrow data for display.
	 */
	public function verifiedprofiles_viewtopic_modify_post_row( $event ) {

		$event[ 'post_row' ] = array_merge( $event[ 'post_row' ], [
			'USER_VERIFIED' => $event[ 'user_poster_data' ][ 'user_verified' ]
		] );

	}

}
