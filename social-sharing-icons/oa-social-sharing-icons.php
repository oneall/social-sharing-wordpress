<?php
/**
 * Plugin Name: Sharing Icons &amp; Share Buttons 
 * Plugin URI: http://www.oneall.com/ 
 * Description: Easy to use and 100% FREE Social Sharing Icons &amp; Share buttons for WordPress to allow people to share your posts and pages to 30+ social networks.
 * Version: 2.2 
 * Author: Damien Zara, OneAll.com
 * Author URI: http://www.oneall.com/ 
 * License: GPL-2.0+ 
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt 
 * Text Domain: oa-social-sharing-icons Domain 
 * Path: /languages
 */

// If this file is called directly, abort.
if (!defined ('WPINC'))
{
	die ();
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-oa-social-sharing-icons-activator.php
 */
function activate_plugin_name ()
{
	require_once plugin_dir_path (__FILE__) . 'includes/class-oa-social-sharing-icons-activator.php';
	oa_social_sharing_icons_Activator::activate ();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-oa-social-sharing-icons-deactivator.php
 */
function deactivate_plugin_name ()
{
	require_once plugin_dir_path (__FILE__) . 'includes/class-oa-social-sharing-icons-deactivator.php';
	oa_social_sharing_icons_Deactivator::deactivate ();
}
register_activation_hook (__FILE__, 'activate_plugin_name');
register_deactivation_hook (__FILE__, 'deactivate_plugin_name');

/**
 * The core plugin class that is used to define internationalization, admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path (__FILE__) . 'includes/class-oa-social-sharing-icons-config.php';
require plugin_dir_path (__FILE__) . 'includes/class-oa-social-sharing-icons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks, then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 */
function run_plugin_name ()
{
	$oa_social_config = oa_social_sharing_icons_config::getInstance ();
	
	$plugin = new oa_social_sharing_icons ($oa_social_config);
	$plugin->init ();
	$plugin->run ();
}
run_plugin_name ();
