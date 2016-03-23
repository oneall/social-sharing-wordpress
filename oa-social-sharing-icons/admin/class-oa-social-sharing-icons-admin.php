<?php

/**
 * Social Sharing Icons \ Admin
 * @link		http://www.oneall.com
 * @package 	oa_social_sharing_icons
 */

/* Social Sharing Admin Menu */
class oa_social_sharing_icons_admin extends oa_social_sharing_icons
{	
	/**
	 * HTML rendering for methods passed as parameter.
	 */
	public static function render_methods_by_keys ($method_keys)
	{
		// Read Config
		$oa_social_sharing_icons_config = oa_social_sharing_icons_config::getInstance();
		
		// Read all methods
		$methods = $oa_social_sharing_icons_config->get_all_methods();
		
		// Build HTML Code
		$html_code = '';	
		
		foreach ($method_keys as $method_key)
		{
			if (isset ($methods[$method_key]))
			{			
				$html_code .= '<div data-order="'.$methods[$method_key] ['order'].'" data-key="' . $methods[$method_key] ['name_key'] . '" data-name="' . $methods[$method_key] ['name_button'] . '" class="oneall_sharing_method oneall_sharing_method_' . $methods[$method_key] ['type'] . '">' . $methods[$method_key] ['name'] . '<span class="oneall_sharing_method_mover"></span></div>';
			}
		}
	
		return $html_code;
	}
	
	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct ()
	{
		$oa_social_config = oa_social_sharing_icons_config::getInstance ();
		parent::__construct ($oa_social_config);
	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles ()
	{
		$style_key = $this->plugin_name.'_admin_css';
				
		if (!wp_style_is ($style_key, 'registered'))
		{
			wp_register_style ($style_key, plugin_dir_url (__FILE__) . 'css/oa-social-sharing-icons-admin.css');
		}
		
		if (did_action ('wp_print_styles'))
		{
			wp_print_styles ($style_key);
		}
		else
		{
			wp_enqueue_style ($style_key);
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts ()
	{
		$script_key = $this->plugin_name.'_admin_js';
				
		wp_enqueue_script ('jquery-ui-sortable');
		wp_enqueue_script ($script_key, plugin_dir_url (__FILE__) . 'js/oa-social-sharing-icons-admin.js');
	}

	/**
	 * Create the menu link in admin.
	 */
	public function add_admin_page ()
	{
		$page = add_menu_page ('OneAll Social Sharing ' . __ ('Setup', 'oa-social-sharing-icons'), 'Social Sharing', 'manage_options', $this->plugin_name . '_setup', array($this, 'load_admin_setup_content'), 'dashicons-share');
		add_action ('admin_print_styles-' . $page, array ($this, 'display_library_js'));		
		add_action ('admin_init', array ($this, 'register_settings'));
		add_action ('load-' . $page, array ($this, 'enqueue_styles'));
		add_action ('load-' . $page, array ($this, 'enqueue_scripts'));		
	}

	
	/**
	 * Add Setup Link to the plugin page.
	 */
	public function add_setup_link ($links, $file)
	{
		if ($file == 'oa-social-sharing-icons/oa-social-sharing-icons.php')
		{
			array_unshift ($links, '<a href="admin.php?page=oa-social-sharing-icons_setup">' . __ ('Setup', 'oa-social-sharing-icons') . '</a>');
		}
		
		return $links;
	}

	/**
	 * Load the plugin setup page template.
	 */
	public function load_admin_setup_content ()
	{
		// Read API Subdomain
		$api_subdomain = oa_social_sharing_icons_config::getInstance()->get_api_subdomain();
		
		// Initial Setup
		if (empty ($api_subdomain))
		{
			require_once plugin_dir_path (__FILE__) . 'templates/oa-social-sharing-icons-admin-setup.php';
		}
		// Wizard
		else
		{
			require_once plugin_dir_path (__FILE__) . 'templates/oa-social-sharing-icons-admin-wizard.php';
		}
	}

	/**
	 * Generate select options.
	 */
	public static function print_select_position_options ($disabled_allowed = true, $option = null, $options = array())
	{
	
		$positions = array(
			"Default" => array(
				"disabled" => __ ("Do not display", 'oa-social-sharing-icons'),
				"default" => __ ("Default Buttons", 'oa-social-sharing-icons') 
			),
			"Beveled Buttons" => array(
				"btns_s" => __ ("Small", 'oa-social-sharing-icons'),
				"btns_m" => __ ("Medium", 'oa-social-sharing-icons'),
				"btns_l" => __ ("Large", 'oa-social-sharing-icons') 
			),
			"Beveled Buttons +Counters" => array(
				"count_h" => __ ("Horizontal", 'oa-social-sharing-icons'),
				"count_v" => __ ("Vertical", 'oa-social-sharing-icons') 
			),
			"Flat Cornered Rectangles" => array(
				"btns_hf" => __ ("Colored", 'class-oa-social-sharing-icons'),
				"btns_hf_b" => __ ("Black", 'class-oa-social-sharing-icons'),
				"btns_hf_g" => __ ("Gray", 'class-oa-social-sharing-icons') 
			),
			"Flat Cornered Rectangles +Counters" => array(
				"btns_hf_count" => __ ("Colored", 'class-oa-social-sharing-icons'),
				"btns_hf_b_count" => __ ("Black", 'class-oa-social-sharing-icons'),
				"btns_hf_g_count" => __ ("Gray", 'class-oa-social-sharing-icons') 
			),
			"Flat Rounded Rectangles" => array(
				"btns_hfrr" => __ ("Colored", 'class-oa-social-sharing-icons'),
				"btns_hfrr_b" => __ ("Black", 'class-oa-social-sharing-icons'),
				"btns_hfrr_g" => __ ("Gray", 'class-oa-social-sharing-icons') 
			),
			"Flat Rounded Rectangles +Counters" => array(
				"btns_hfrr_count" => __ ("Colored", 'class-oa-social-sharing-icons'),
				"btns_hfrr_b_count" => __ ("Black", 'class-oa-social-sharing-icons'),
				"btns_hfrr_g_count" => __ ("Gray", 'class-oa-social-sharing-icons') 
			),
			"Flat Cornered Squares" => array(
				"btns_lf" => __ ("Colored", 'class-oa-social-sharing-icons'),
				"btns_lf_b" => __ ("Black", 'class-oa-social-sharing-icons'),
				"btns_lf_g" => __ ("Gray", 'class-oa-social-sharing-icons') 
			),
			"Flat Cornered Squares +Counters" => array(
				"btns_lf_count" => __ ("Colored", 'class-oa-social-sharing-icons'),
				"btns_lf_b_count" => __ ("Black", 'class-oa-social-sharing-icons'),
				"btns_lf_g_count" => __ ("Gray", 'class-oa-social-sharing-icons') 
			),
			"Flat Circles" => array(
				"btns_lfr" => __ ("Colored", 'class-oa-social-sharing-icons'),
				"btns_lfr_b" => __ ("Black", 'class-oa-social-sharing-icons'),
				"btns_lfr_g" => __ ("Gray", 'class-oa-social-sharing-icons') 
			),
			"Flat Rounded Squares" => array(
				"btns_lfrr" => __ ("Colored", 'class-oa-social-sharing-icons'),
				"btns_lfrr_b" => __ ("Black", 'class-oa-social-sharing-icons'),
				"btns_lfrr_g" => __ ("Gray", 'class-oa-social-sharing-icons') 
			),
			"Flat Rounded Squares +Counters" => array(
				"btns_lfrr_count" => __ ("Colored", 'class-oa-social-sharing-icons'),
				"btns_lfrr_b_count" => __ ("Black", 'class-oa-social-sharing-icons'),
				"btns_lfrr_g_count" => __ ("Gray", 'class-oa-social-sharing-icons') 
			) 
		);
		
		
		$html_options = '';
		foreach ($positions as $group_name => $group)
		{
			if (!($group_name == 'Default' && !$disabled_allowed))
			{
				if ($group_name <> 'Default')
				{
					$html_options .= '<optgroup label="' . $group_name . '">';
				}
				
				foreach ($group as $value => $wording)
				{
					// Should this option be selected?
					$selected = (((is_array ($options) && !empty ($option) && isset ($options [$option]) && $options [$option] == $value)) ? true : false);
					
					// Add Option
					$html_options .= '<option value="' . $value . '"' . ($selected ? ' selected="selected"' : '') . '>' . $wording . '</option>';
				}
				
				if ($group_name <> 'Default')
				{
					$html_options .= '</optgroup>';
				}
			}
		}
		
		return $html_options;
	}

	/**
	 * Register plugin settings and their sanitization callback.
	 */
	public function register_settings ()
	{
		register_setting ('oa_social_sharing_icons_settings_group', 'oa_social_sharing_icons_settings', array($this, 'validate_settings'));
	}

	/**
	 * Plugin settings sanitization callback.
	 */
	public function validate_settings ($settings)
	{
		// Read the current settings
		$sanitized_settings = get_option ('oa_social_sharing_icons_settings');
		
		// Check format
		if (!is_array ($sanitized_settings))
		{
			$sanitized_settings = array();
		}
		
		// OG Tags
		if (!empty ($settings ['disable_og_tags']))
		{
			$sanitized_settings ['disable_og_tags'] = 1;
		}
		else
		{
			$sanitized_settings ['disable_og_tags'] = 0;
		}
		
		// Button Test
		if (isset ($settings ['button_text']))
		{
			$sanitized_settings ['button_text'] = trim ($settings ['button_text']);
		}
		
		// Button Size
		if (isset ($settings ['default_size']))
		{
			$sanitized_settings ['default_size'] = trim ($settings ['default_size']);
		}
				
		// Subdomain
		if (isset ($settings ['api_subdomain']))
		{
			// Subdomain is always in lowercase
			$api_subdomain = strtolower (trim ($settings ['api_subdomain']));
			
			// Full domain entered
			if (preg_match ("/([a-z0-9\-]+)\.api\.oneall\.com/i", $api_subdomain, $matches))
			{
				$api_subdomain = $matches [1];
			}
			
			$sanitized_settings ['api_subdomain'] = $api_subdomain;
		}
		
		// Enabled Sharing Methods
		if (isset ($settings ['enabled_methods']) && is_array ($settings ['enabled_methods']))
		{
			$sanitized_settings ['enabled_methods'] = $settings ['enabled_methods'];
		}	
		
		// Enabled Sharing Methods - Form
		if (isset ($settings ['enabled_methods_keys']) && is_array ($settings ['enabled_methods_keys']))
		{
			$sanitized_settings ['enabled_methods'] = array_keys ($settings ['enabled_methods_keys']);
		}
		
		// Enabled Positions
		if (isset ($settings ['positions']) && is_array ($settings ['positions']))
		{
			$sanitized_settings ['positions'] = $settings ['positions'];
		}
			
		// Done
		return $sanitized_settings;
	}
	
	/**
	 * Adds the OneAll libray to the admin area
	 */
	public function display_library_js ()
	{
		// Load Config
		$oa_social_sharing_icons_config = oa_social_sharing_icons_config::getInstance();
		
		// API Subdomain
		$api_subdomain = $oa_social_sharing_icons_config->get_api_subdomain(false, true);
		
		// Initial Setup
		if ( ! empty ($api_subdomain))
		{
			// Plugin Version
			$plugin_version = $oa_social_sharing_icons_config->get_plugin_version();
			
			//JavaScript Method Reference: http://docs.oneall.com/api/javascript/library/methods/
			$output = array ();
			$output [] = '';
			$output [] = " <!-- OneAll.com / Social Sharing for WordPress / v" . $plugin_version . " -->";
			$output [] = '<script data-cfasync="false" type="text/javascript">';
			$output [] = " (function() {";
			$output [] = "  var oa = document.createElement('script'); oa.type = 'text/javascript';";
			$output [] = "  oa.async = true; oa.src = '//" . $api_subdomain . "/socialize/library.js';";
			$output [] = "  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(oa, s);";
			$output [] = " })();";
			$output [] = "</script>";
			$output [] = '';
			
			//Display
			echo implode ("\n", $output);
		}
		
	}
}