<?php

/**
 * Social Sharing Icons \ Core
 * @link		http://www.oneall.com
 * @package 	oa_social_sharing_icons
 */
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
	 * The current configuration of the plugin.
	 */
	protected $config;

	/**
	 * Define the core functionality of the plugin.
	 */
	public function __construct ($oa_social_config)
	{
		$this->config = $oa_social_config;
		$this->plugin_name = $this->config->get_plugin_name ();
		$this->version = $this->config->get_version ();
	}

	/**
	 * Initialize.
	 */
	public function init ()
	{
		$this->load_dependencies ();
		$this->set_locale ();
		$this->define_admin_hooks ();
		$this->define_public_hooks ();
	}

	/**
	 * Load the required dependencies for this plugin.
	 */
	private function load_dependencies ()
	{
		// The class responsible for orchestrating the actions and filters of the core plugin.
		require_once plugin_dir_path (dirname (__FILE__)) . 'includes/class-oa-social-sharing-icons-loader.php';
		
		// The class responsible for defining internationalization functionality
		require_once plugin_dir_path (dirname (__FILE__)) . 'includes/class-oa-social-sharing-icons-i18n.php';
		
		// The classes responsible for defining all actions that occur in the admin area.
		require_once plugin_dir_path (dirname (__FILE__)) . 'admin/class-oa-social-sharing-icons-admin.php';
		require_once plugin_dir_path (dirname (__FILE__)) . 'admin/class-oa-social-sharing-icons-admin-methods.php';
		require_once plugin_dir_path (dirname (__FILE__)) . 'admin/class-oa-social-sharing-icons-admin-widget.php';
		
		// The class responsible for defining all actions that occur in the public-facing side of the site.
		require_once plugin_dir_path (dirname (__FILE__)) . 'public/class-oa-social-sharing-icons-public.php';
		
		// Add Loader
		$this->loader = new oa_social_sharing_icons_Loader ();
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
	 * Register all of the hooks related to the admin area functionality of the plugin.
	 */
	private function define_admin_hooks ()
	{
		$plugin_admin = new oa_social_sharing_icons_Admin ();
		$this->loader->add_action ('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action ('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		$this->loader->add_action ('admin_menu', $plugin_admin, 'add_admin_page');
		$this->loader->add_filter ('plugin_action_links', $plugin_admin, 'add_setup_link', 10, 2);
	}

	/**
	 * Register all of the hooks related to the public-facing functionality of the plugin.
	 */
	private function define_public_hooks ()
	{
		$plugin_public = new oa_social_sharing_icons_public ();
		$this->loader->add_action ('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action ('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
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