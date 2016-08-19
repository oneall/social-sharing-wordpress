<?php

/**
 * Social Sharing Icons \ Internationalization
 * @link		http://www.oneall.com
 * @package 	oa_social_sharing_icons
 */

/* Social Sharing Translations */
class oa_social_sharing_icons_i18n
{
	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain ()
	{
		load_plugin_textdomain ('oa-social-sharing-icons', false, dirname (dirname (plugin_basename (__FILE__))) . '/languages/');
	}
}
