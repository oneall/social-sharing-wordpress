<?php

/**
 * Social Sharing Icons \ Admin
 * @link		http://www.oneall.com
 * @package 	oa_social_sharing_icons
 */
class oa_social_sharing_icons_admin extends oa_social_sharing_icons
{

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct ()
	{
		$oa_social_config = oa_social_sharing_icons_config::getInstance ();
		parent::__construct ($oa_social_config);
		
		// Form action
		add_action ('admin_init', array(
			$this,
			'register_settings' 
		));
		
		// Add hook for admin <head></head>
		add_action ('admin_head', array(
			$oa_social_config,
			'get_oa_library_js' 
		));
	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles ()
	{
		wp_enqueue_style ('admin_print_styles-' . $this->plugin_name, plugin_dir_url (__FILE__) . 'css/oa-social-sharing-icons-admin-setup.css');
		wp_enqueue_style ('admin_print_styles-wizard-' . $this->plugin_name, plugin_dir_url (__FILE__) . 'css/oa-social-sharing-icons-admin-wizard.css');
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts ()
	{
		wp_enqueue_script ('jquery-ui-sortable');
		wp_enqueue_script ('admin_script-wizard-' . $this->plugin_name, plugin_dir_url (__FILE__) . 'js/oa-social-sharing-icons-admin-wizard.js');
	}

	/**
	 * Create the menu link in admin.
	 */
	public function add_admin_page ()
	{
		add_menu_page ('OneAll Social Sharing ' . __ ('Setup', 'oa-social-sharing-icons'), 'Social Sharing', 'manage_options', $this->plugin_name . '_setup', array(
			$this,
			'load_admin_setup_content' 
		), 'dashicons-share');
	}

	/**
	 * Add Setup Link to the plugin page.
	 */
	public function add_setup_link ($links, $file)
	{
		if ($file == 'oa-social-sharing-icons/oa-social-sharing-icons.php')
		{
			$settings_link = '<a href="admin.php?page=oa-social-sharing-icons_setup">' . __ ('Setup', 'oa-social-sharing-icons') . '</a>';
			array_unshift ($links, $settings_link);
		}
		return $links;
	}

	/**
	 * Load the plugin setup page template.
	 */
	public function load_admin_setup_content ()
	{
		require_once plugin_dir_path (__FILE__) . 'templates/oa-social-sharing-icons-admin-setup.php';
		
		// If we have no subdomain then do not show the wizard
		if ($this->config->get_user_subdomain ())
		{
			require_once plugin_dir_path (__FILE__) . 'templates/oa-social-sharing-icons-admin-wizard.php';
		}
		
		require_once plugin_dir_path (__FILE__) . 'templates/oa-social-sharing-icons-admin-setup-endform.php';
	}

	/**
	 * Generate select options.
	 */
	public static function print_select_position_options ($selected_option = null)
	{
		$positions = array(
			"disabled" => __ ("Disabled", 'oa-social-sharing-icons'),
			"default" => __ ("Default Buttons", 'oa-social-sharing-icons'),
			"btns_s" => __ ("Small Buttons", 'oa-social-sharing-icons'),
			"btns_m" => __ ("Medium Buttons", 'oa-social-sharing-icons'),
			"btns_l" => __ ("Large Buttons", 'oa-social-sharing-icons'),
			"count_h" => __ ("Horizontal Counters", 'oa-social-sharing-icons'),
			"count_v" => __ ("Vertical Counters", 'oa-social-sharing-icons') 
		);
		$html_options = '';
		foreach ($positions as $value => $wording)
		{
			$selected = ($value == $selected_option) ? 'selected' : '';
			$html_options .= "<option value='" . $value . "' $selected>" . $wording . "</option>";
		}
		
		return $html_options;
	}

	/**
	 * Register plugin settings and their sanitization callback.
	 */
	public function register_settings ()
	{
		register_setting ('oa_social_sharing_icons_settings_group', 'oa_social_sharing_icons_settings', array(
			$this,
			'validate_settings' 
		));
	}

	/**
	 * Plugin settings sanitization callback.
	 */
	public function validate_settings ($settings)
	{
		// Import providers
		GLOBAL $oa_social_sharing_icons_providers;
		
		// Store the sanitzed settings
		$sanitized_settings = get_option ('oa_social_sharing_icons_settings');
		
		// //////////////////////////////////////////////////////////////////////////////////////////////////////////
		// Setup
		// //////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		// Check format
		if (!is_array ($sanitized_settings))
		{
			$sanitized_settings = array();
		}
		
		// Extract fields
		foreach (array(
			'api_subdomain',
			'wizard_final_choice' 
		) as $key)
		{
			if (isset ($settings [$key]))
			{
				$sanitized_settings [$key] = trim ($settings [$key]);
			}
		}
		
		// Sanitize API Subdomain
		if (isset ($sanitized_settings ['api_subdomain']))
		{
			// Subdomain is always in lowercase
			$api_subdomain = strtolower ($sanitized_settings ['api_subdomain']);
			
			// Full domain entered
			if (preg_match ("/([a-z0-9\-]+)\.api\.oneall\.com/i", $api_subdomain, $matches))
			{
				$api_subdomain = $matches [1];
			}
			
			$sanitized_settings ['api_subdomain'] = $api_subdomain;
		}
		
		// If no user choice, left floating and end post by default
		if (!empty ($sanitized_settings ['wizard_final_choice']))
		{
			$user_choice = json_decode ($sanitized_settings ['wizard_final_choice']);
			
			// first setup => add value by default
			if (empty ($user_choice->methods))
			{
				$user_choice->methods = array(
					array(
						'key' => 'facebook',
						'title' => 'Facebook' 
					),
					array(
						'key' => 'twitter',
						'title' => 'Twitter' 
					),
					array(
						'key' => 'linkedin',
						'title' => 'LinkedIn' 
					) 
				);
				$user_choice->position_left_floating = 'default';
				$user_choice->position_end_post = 'default';
				
				$sanitized_settings ['wizard_final_choice'] = json_encode ($user_choice);
			}
		}
		
		// Done
		return $sanitized_settings;
	}
}
