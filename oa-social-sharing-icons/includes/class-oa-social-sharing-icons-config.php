<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    oa_social_sharing_icons
 * @subpackage oa_social_sharing_icons/includes
 * @author     Your Name <email@example.com>
 */
class oa_social_sharing_icons_config {

	
	// Holds the instance
	private static $instance = null;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	public $plugin_name = 'oa-social-sharing-icons';

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	public $version = '1.0.0';

	
	private function __construct() {  
	
		// Add hook for admin <head></head>
		add_action('wp_head', array( $this, 'get_oa_library_js'));
		add_action('admin_head', array( $this, 'get_oa_library_js_admin'));
	}


	// Returns the instance
	public static function getInstance ()
	{
		 if(is_null(self::$instance)) {
	       self::$instance = new oa_social_sharing_icons_config();  
	     }
	 
	     return self::$instance;
	}


	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}


	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Show library in admin 
	 * @return string library
	 */
	public function get_oa_library_js_admin(){
		$this->get_oa_library_js(false);
	}

	/**
	 * Add oneall libray to website
	 * @param  boolean $check_duplicate if true we don't add library twice
	 * @return string library
	 */
	public function get_oa_library_js($check_duplicate=true) {
		
		//get subdomain
		$api_subdomain = $this->get_user_subdomain().".api.oneall.com";

		if (!empty($api_subdomain)) {

			if (!$check_duplicate || !$this->is_same_subdomain_social_login()) {

				echo "<script type='text/javascript'>
						var oa = document.createElement('script');
						oa.type = 'text/javascript'; oa.async = true;
						oa.src = '//".$api_subdomain."/socialize/library.js'
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(oa, s)
					</script>
				";
			}
		}
	}


	/**
	 * does the user saved a subdomain
	 * @return string user subdomain
	 */
	public function get_user_subdomain(){
		$settings_sharing = get_option ('oa_social_sharing_icons_settings');
		return empty($settings_sharing['api_subdomain']) ? null :  $settings_sharing['api_subdomain'];
	}


	/**
	 * if social login plugin installed, we check if the apisubdomain is identical
	 * @return boolean true if social login and social sharing have the same subdomain
	 */
	public function is_same_subdomain_social_login(){
		$settings_login           = get_option ('oa_social_login_settings');
		$social_login_subdomain   = !empty($settings_login ['api_subdomain']) ? $settings_login ['api_subdomain'] : '';
		$social_sharing_subdomain = $this->get_user_subdomain();

		return ( $social_login_subdomain == $social_sharing_subdomain );
	}


	/**
	 * if social login plugin installed, we check if the apisubdomain is identical
	 * @return boolean true if social login and social sharing have the same subdomain
	 */
	public function existing_social_login_config(){
		return !empty(get_option ('oa_social_login_settings'));
	}


}