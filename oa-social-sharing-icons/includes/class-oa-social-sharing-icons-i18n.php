<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.oneall.com
 * @since      1.0.0
 *
 * @package    oa_social_sharing_icons
 * @subpackage oa_social_sharing_icons/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    oa_social_sharing_icons
 * @subpackage oa_social_sharing_icons/includes
 * @author     Your Name <email@example.com>
 */
class oa_social_sharing_icons_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		
		load_plugin_textdomain(
			'oa-social-sharing-icons',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
