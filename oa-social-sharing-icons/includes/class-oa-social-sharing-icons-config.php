<?php

/**
 * Social Sharing Icons \ Configuration
 * @link		http://www.oneall.com
 * @package 	oa_social_sharing_icons
 */
class oa_social_sharing_icons_config
{
	/**
	 * Holds the instance of the configuration settings.
	 */
	private static $instance = null;
	
	/**
	 * The unique identifier of this plugin.
	 */
	public $plugin_name = 'oa-social-sharing-icons';
	
	/**
	 * The current version of the plugin.
	 */
	public $version = '1.0.0';

	/**
	 * Add Hooks
	 */
	private function __construct ()
	{
		add_action ('wp_head', array(
			$this,
			'get_oa_library_js' 
		));
		add_action ('admin_head', array(
			$this,
			'get_oa_library_js_admin' 
		));
	}

	/**
	 * Returns the instance
	 */
	public static function getInstance ()
	{
		if (is_null (self::$instance))
		{
			self::$instance = new oa_social_sharing_icons_config ();
		}
		return self::$instance;
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 */
	public function get_plugin_name ()
	{
		return $this->plugin_name;
	}

	/**
	 * The plugin versopn.
	 */
	public function get_version ()
	{
		return $this->version;
	}

	/**
	 * Displays the OneAll library in the admin setup area.
	 */
	public function get_oa_library_js_admin ()
	{
		$this->get_oa_library_js (false);
	}

	/**
	 * Adds the OneAll libray to the public website
	 */
	public function get_oa_library_js ($check_duplicate = true)
	{
		// Get Subdomain
		$api_subdomain = $this->get_user_subdomain () . ".api.oneall.com";
		
		if (!empty ($api_subdomain))
		{
			if (!$check_duplicate || !$this->is_same_subdomain_social_login ())
			{
				echo "<script type='text/javascript'>
						var oa = document.createElement('script');
						oa.type = 'text/javascript'; oa.async = true;
						oa.src = '//" . $api_subdomain . "/socialize/library.js'
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(oa, s)
					</script>
				";
			}
		}
	}

	/**
	 * Returns the subdomain stored in the config.
	 */
	public function get_user_subdomain ()
	{
		$settings_sharing = get_option ('oa_social_sharing_icons_settings');
		return empty ($settings_sharing ['api_subdomain']) ? null : $settings_sharing ['api_subdomain'];
	}

	/**
	 * Checks if Social Login is installed and it it's OneAll subdomain is indentical to the Sharing Icons subdomain.
	 */
	public function is_same_subdomain_social_login ()
	{
		$settings_login = get_option ('oa_social_login_settings');
		$social_login_subdomain = (!empty ($settings_login ['api_subdomain']) ? $settings_login ['api_subdomain'] : '');
		$social_sharing_subdomain = $this->get_user_subdomain ();
		return ($social_login_subdomain == $social_sharing_subdomain);
	}

	/**
	 * Checks if Social Login is installed and configurated.
	 */
	public function existing_social_login_config ()
	{
		return (!empty (get_option ('oa_social_login_settings')));
	}
}