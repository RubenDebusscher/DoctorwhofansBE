<?php
/**
*
* @package phpBB Extension - Smartfeed
* @copyright (c) 2020 Mark D. Hamill (mark@phpbbservices.com)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace phpbbservices\smartfeed\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	protected $config;
	protected $helper;
	protected $language;
	protected $request;
	protected $template;

	/**
	* Constructor
	*
	* @param \phpbb\config\config		$config		Config object
	* @param \phpbb\controller\helper	$helper		Controller helper object
	* @param \phpbb\language\language   $language   Language object
	* @param \phpbb\request\request     $request    Request object
	* @param \phpbb\template\template	$template	Template object
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\request\request $request, \phpbb\language\language $language)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->language = $language;
		$this->request = $request;
		$this->template = $template;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'						=> 'load_language_on_setup',
			'core.page_header'						=> 'add_page_header_link',
			'core.page_header_after'  				=> 'overall_header_head_append',
		);
	}

	public function load_language_on_setup($event)
	{
		// This language file is needed pretty much everywhere, since among other things it places
		// content in the <head> section for most pages.
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'phpbbservices/smartfeed',
			'lang_set' => array('common','ui'),
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function add_page_header_link()
	{
		$this->template->assign_vars(array(
			'U_SMARTFEED_PAGE'	=> $this->helper->route('phpbbservices_smartfeed_ui_controller'),
		));
	}
	
	public function overall_header_head_append()
	{
		$script_name = $this->request->server('script_name', 'NONE');

		$this->template->assign_vars(array(
			'L_SMARTFEED_PUBLIC_ATOM_TITLE'			=> $this->config['sitename'] . ' - ' . $this->language->lang('SMARTFEED_ATOM_FEED'),
			'L_SMARTFEED_PUBLIC_RSS_TITLE'			=> $this->config['sitename'] . ' - ' .  $this->language->lang('SMARTFEED_RSS_FEED'),
			'S_AUTO_ADVERTISE_PUBLIC_FEED'			=> $this->config['phpbbservices_smartfeed_auto_advertise_public_feed'],
			'S_SMARTFEED_UI_LOCATION'				=> $this->config['phpbbservices_smartfeed_ui_location'],
			'U_SMARTFEED_URL_ATOM'					=> $this->helper->route('phpbbservices_smartfeed_feed_controller'),
			'U_SMARTFEED_URL_RSS'					=> $this->helper->route('phpbbservices_smartfeed_feed_controller', array('y'=>2)),
		));

		if (stristr($script_name, 'viewtopic'))
		{
			$topic_id = $this->request->variable('t', 0);
			// If on the view topic page, show the generated feed links
			$this->template->assign_vars(array(
				'S_SHOW_TOPIC_FEED'				=> true,
				'U_SMARTFEED_TOPIC_URL_ATOM'	=> $this->helper->route('phpbbservices_smartfeed_feed_controller', array('tf'=>$topic_id)),
				'U_SMARTFEED_TOPIC_URL_RSS' 	=> $this->helper->route('phpbbservices_smartfeed_feed_controller', array('y'=>2,'tf'=>$topic_id)),
			));
		}
	}
   	
}
