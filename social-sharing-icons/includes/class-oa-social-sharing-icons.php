<?php

/**
 * Social Sharing Icons \ Core
 * @link		http://www.oneall.com
 * @package 	oa_social_sharing_icons
 */

/* Social Sharing Core */
class oa_social_sharing_icons
{	
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power the plugin.
	 */
	protected $loader;
	
	/**
	 * The unique identifier of the plugin.
	 */
	protected $plugin_name;
	
	/**
	 * The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 */
	public function __construct ($oa_social_config)
	{
		// Read Configuration
		$oa_social_sharing_icons_config = oa_social_sharing_icons_config::getInstance ();
		
		// Plugin Details
		$this->plugin_name = $oa_social_sharing_icons_config->get_plugin_name ();
		$this->version = $oa_social_sharing_icons_config->get_plugin_version ();
	}

	/**
	 * Initialize.
	 */
	public function init ()
	{
		$this->load_dependencies ();
		$this->load_loader();
		
		$this->set_locale ();
		$this->define_hooks ();
	}
	
	/**
	 * Load the required dependencies for this plugin.
	 */
	private function load_dependencies ()
	{
		$plugin_path = plugin_dir_path (dirname (__FILE__));
		
		// The class responsible for orchestrating the actions and filters of the core plugin.
		require_once $plugin_path . 'includes/class-oa-social-sharing-icons-loader.php';
		
		// The class responsible for defining internationalization functionality
		require_once $plugin_path . 'includes/class-oa-social-sharing-icons-i18n.php';
		
		// Administration Area	
		if (is_admin())
		{
			require_once $plugin_path . 'admin/class-oa-social-sharing-icons-admin.php';
			require_once $plugin_path . 'admin/class-oa-social-sharing-icons-admin-widget.php';
		}
		// Public Area
		else
		{		
			require_once $plugin_path . 'public/class-oa-social-sharing-icons-public.php';
		}
	}
	
	/**
	 * Define the locale for this plugin for internationalization.
	 */
	private function set_locale ()
	{
		$plugin_i18n = new oa_social_sharing_icons_i18n ();
		$this->loader->add_action ('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the functionality of the plugin.
	 */
	private function define_hooks ()
	{
		// Administration Area	
		if (is_admin())
		{
			$plugin_admin = new oa_social_sharing_icons_admin ();
			$this->loader->add_action ('admin_menu', $plugin_admin, 'add_admin_page');	
			$this->loader->add_filter ('plugin_action_links', $plugin_admin, 'add_setup_link', 10, 2);
		}
		// Public Area
		else
		{
			$plugin_public = new oa_social_sharing_icons_public ();
			$this->loader->add_action ('wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 10, 0);
			$this->loader->add_action ('wp_head', $plugin_public, 'display_library_js', 10, 0);
		}
	}

	/**
	 * Load the loader for this plugin.
	 */
	private function load_loader ()
	{
		$this->loader = new oa_social_sharing_icons_loader ();
	}
	
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 */
	public function run ()
	{
		$this->loader->run ();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 */
	public function get_loader ()
	{
		return $this->loader;
	}
}
