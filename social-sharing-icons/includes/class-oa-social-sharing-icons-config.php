<?php

/**
 * Social Sharing Icons \ Configuration
 * @link		http://www.oneall.com
 * @package 	oa_social_sharing_icons
 */

/* Social Sharing Configuration */
class oa_social_sharing_icons_config
{
	/**
	 * Sharing methods that can be used with the plugin.
	 */
	private static $methods = array(		
		'counter' => array(
			'name' => 'Total Shares Counter',
			'name_button' => 'Shares',
			'name_key' => 'counter',
			'type' => 'counter',
			'is_default' => '1',
			'order' => 1
		),
		'amazon' => array(
			'name' => 'Amazon',
			'name_button' => 'Amazon',
			'name_key' => 'amazon',
			'type' => 'service',
			'is_default' => '0',
			'order' => 10
		),
		'aol' => array(
			'name' => 'AOL',
			'name_button' => 'AOL',
			'name_key' => 'aol',
			'type' => 'service',
			'is_default' => '0',
			'order' => 20
		),
		'baidu' => array(
			'name' => 'Baidu',
			'name_button' => 'Baidu',
			'name_key' => 'baidu',
			'type' => 'service',
			'is_default' => '0', 
			'order' => 30
		),
		'blogger' => array(
			'name' => 'Blogger',
			'name_button' => 'Blogger',
			'name_key' => 'blogger',
			'type' => 'service',
			'is_default' => '0',
			'order' => 40
		),
		'buffer' => array(
			'name' => 'Buffer',
			'name_button' => 'Buffer',
			'name_key' => 'buffer',
			'type' => 'service',
			'is_default' => '0',
			'order' => 50
		),
		'delicious' => array(
			'name' => 'Delicious',
			'name_button' => 'Delicious',
			'name_key' => 'delicious',
			'type' => 'service',
			'is_default' => '0',
			'order' => 60
		),
		'digg' => array(
			'name' => 'Digg',
			'name_button' => 'Digg',
			'name_key' => 'digg',
			'type' => 'service',
			'is_default' => '0',
			'order' => 70
		),
		'draugiem' => array(
			'name' => 'Draugiem',
			'name_button' => 'Draugiem',
			'name_key' => 'draugiem',
			'type' => 'service',
			'is_default' => '0',
			'order' => 80
		),
		'email' => array(
			'name' => 'Email',
			'name_button' => 'Email',
			'name_key' => 'email',
			'type' => 'service',
			'is_default' => '1',
			'order' => 90
		),
		'evernote' => array(
			'name' => 'Evernote',
			'name_button' => 'Evernote',
			'name_key' => 'evernote',
			'type' => 'service',
			'is_default' => '0',
			'order' => 100
		),
		'facebook' => array(
			'name' => 'Facebook',
			'name_button' => 'Facebook',
			'name_key' => 'facebook',
			'type' => 'service',
			'is_default' => '1' ,
			'order' => 110
		),
		'google_bookmarks' => array(
			'name' => 'Google Bookmarks',
			'name_button' => 'Google',
			'name_key' => 'google_bookmarks',
			'type' => 'service',
			'is_default' => '0',
			'order' => 120
		),
		'google_plus' => array(
			'name' => 'Google Plus',
			'name_button' => 'Google',
			'name_key' => 'google_plus',
			'type' => 'service',
			'is_default' => '0',
			'order' => 130
		),
		'hackernews' => array(
			'name' => 'Hackernews',
			'name_button' => 'Hackernews',
			'name_key' => 'hackernews',
			'type' => 'service',
			'is_default' => '0',
			'order' => 140
		),
		'linkedin' => array(
			'name' => 'LinkedIn',
			'name_button' => 'LinkedIn',
			'name_key' => 'linkedin',
			'type' => 'service',
			'is_default' => '1',
			'order' => 150
		),
		'livejournal' => array(
			'name' => 'Livejournal',
			'name_button' => 'Livejournal',
			'name_key' => 'livejournal',
			'type' => 'service',
			'is_default' => '0',
			'order' => 160
		),
		'odnoklassniki' => array(
			'name' => 'Odnoklassniki',
			'name_button' => 'Odnoklassniki',
			'name_key' => 'odnoklassniki',
			'type' => 'service',
			'is_default' => '0' ,
			'order' => 170
		),
		'pinterest' => array(
			'name' => 'Pinterest',
			'name_button' => 'Pinterest',
			'name_key' => 'pinterest',
			'type' => 'service',
			'is_default' => '0',
			'order' => 180
		),
		'pocket' => array(
			'name' => 'Pocket',
			'name_button' => 'Pocket',
			'name_key' => 'pocket',
			'type' => 'service',
			'is_default' => '0',
			'order' => 190
		),
		'reddit' => array(
			'name' => 'Reddit',
			'name_button' => 'Reddit',
			'name_key' => 'reddit',
			'type' => 'service',
			'is_default' => '0',
			'order' => 200
		),
		'renren' => array(
			'name' => 'Renren',
			'name_button' => 'Renren',
			'name_key' => 'renren',
			'type' => 'service',
			'is_default' => '0',
			'order' => 210
		),
		'stumbleupon' => array(
			'name' => 'StumbleUpon',
			'name_button' => 'StumbleUpon',
			'name_key' => 'stumbleupon',
			'type' => 'service',
			'is_default' => '0',
			'order' => 220
		),
		'tumblr' => array(
			'name' => 'Tumblr',
			'name_button' => 'Tumblr',
			'name_key' => 'tumblr',
			'type' => 'service',
			'is_default' => '0',
			'order' => 230
		),
		'twitter' => array(
			'name' => 'Twitter',
			'name_button' => 'Twitter',
			'name_key' => 'twitter',
			'type' => 'service',
			'is_default' => '1',
			'order' => 240
		),
		'vkontakte' => array(
			'name' => 'VKontakte',
			'name_button' => 'В Контакте',
			'name_key' => 'vkontakte',
			'type' => 'service',
			'is_default' => '0',
			'order' => 250
		),
		'weibo' => array(
			'name' => 'Sina Weibo',
			'name_button' => 'Weibo',
			'name_key' => 'weibo',
			'type' => 'service',
			'is_default' => '0',
			'order' => 260
		),
		'yahoomail' => array(
			'name' => 'Yahoo Mail',
			'name_button' => 'Yahoo Mail',
			'name_key' => 'yahoomail',
			'type' => 'service',
			'is_default' => '0',
			'order' => 270
		),
		'facebook_like_but' => array(
			'name' => 'Facebook Like Button',
			'name_button' => 'Facebook',
			'name_key' => 'facebook_like_but',
			'type' => 'addon',
			'is_default' => '0',
			'order' => 1010
		),
		'google_plus_one_but' => array(
			'name' => 'Google +1 Button',
			'name_button' => 'Google',
			'name_key' => 'google_plus_one_but',
			'type' => 'addon',
			'is_default' => '0',
			'order' => 1020
		),
		'linkedin_share_but' => array(
			'name' => 'LinkedIn Share Button',
			'name_button' => 'LinkedIn',
			'name_key' => 'linkedin_share_but',
			'type' => 'addon',
			'is_default' => '0',
			'order' => 1030
		),
		'twitter_tweet_but' => array(
			'name' => 'Twitter Tweet Button',
			'name_button' => 'Twitter',
			'name_key' => 'twitter_tweet_but',
			'type' => 'addon',
			'is_default' => '0',
			'order' => 1040
		),
		'vkontakte_share_but' => array(
			'name' => 'VKontakte Share Button',
			'name_button' => 'В Контакте',
			'name_key' => 'vkontakte_share_but',
			'type' => 'addon',
			'is_default' => '0',
			'order' => 1050
		) 
	);
	
	/**
	 * Holds the instance of this class.
	 */
	private static $instance = null;
	
	/**
	 * Holds the plugin settings.
	 */
	private $settings = null;
	
	/**
	 * The unique identifier of this plugin.
	 */
	public $plugin_name = 'oa-social-sharing-icons';
	
	/**
	 * The current version of the plugin.
	 */
	public $plugin_version = '2.4';

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
	 * The plugin version.
	 */
	public function get_plugin_version ()
	{
		return $this->plugin_version;
	}
	
	// /////////////////////////////////////////////////////////////////////////////////////////////
	// SETTINGS
	// /////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * Return the settings
	 */
	public function get_settings ($reload = false)
	{
		if (!is_array ($this->settings) || $reload === true)
		{
			// Read Settings
			$this->settings = get_option ('oa_social_sharing_icons_settings');
			
			// We have no settings yet
			if ( ! is_array ($this->settings))
			{
				$this->settings = array();
			}
	
			// Wrapper for old properties
			if (isset ($this->settings['wizard_final_choice']))
			{		
				// Decode
				$settings = @json_decode ($this->settings ['wizard_final_choice']);	

				// Make sure we have the correct format
				if (is_object ($settings))
				{							
					// Default Size
					if ( ! empty ($settings->default_size))
					{
						// Convert to new format
						$this->settings['default_size'] = $settings->default_size;
					}
					
					// Selected Methods
					if (isset ($settings->methods) && is_array ($settings->methods))
					{
						$enabled_methods = array();
						
						foreach ($settings->methods AS $method)
						{						
							if (is_object ($method) && ! empty ($method->key))
							{
								$enabled_methods[] = $method->key;
							}
						}		

						// Convert to new format
						$this->settings['enabled_methods'] = $enabled_methods;
					}
					
					// Positions
					$properties = get_object_vars ($settings);
					
					// Make sure we have the correct format
					if (is_array ($properties))
					{
						$positions = array();
						
						foreach ($properties AS $property => $value)
						{
							if (preg_match ('#^position_([a-z_]+)$#', $property, $matches))
							{
								$positions[$matches[1]] = $value;
							}	
						}
						
						// Convert to new format
						$this->settings['positions'] = $positions;
					}			
				}	


				// Remove from Settings
				unset ($this->settings['wizard_final_choice']);	
				
				// Update Options	
				wp_cache_delete ('alloptions', 'options');
				delete_option ('oa_social_sharing_icons_settings');
				update_option ('oa_social_sharing_icons_settings', $this->settings, true);
				wp_cache_delete ('alloptions', 'options');
			}
		}

		return $this->settings;
	}

	/**
	 * Return the subdomain setting
	 */
	public function get_api_subdomain ($reload = false, $full_domain = false)
	{
		$settings = $this->get_settings ($reload);
		
		$api_subdomain = '';
		
		if ( ! empty ($settings ['api_subdomain']))
		{
			if ($full_domain)
			{
				$api_subdomain = $settings ['api_subdomain'].'.api.oneall.com';
			}
			else
			{
				$api_subdomain = $settings ['api_subdomain'];
			}
		}
		
		return $api_subdomain;
	}
	
	/**
	 * Return the default size
	 */
	public function get_default_size ($reload = false)
	{
		$settings = $this->get_settings ($reload);
		return (isset ($settings ['default_size']) ? $settings ['default_size'] : 'btns_lfnm');
	}

	/**
	 * Return the disable_og_tags setting
	 */
	public function get_disable_og_tags ($reload = false)
	{
		$settings = $this->get_settings ($reload);
		return (!empty ($settings ['disable_og_tags']) ? 1 : 0);
	}

	/**
	 * Return the positions setting
	 */
	public function get_positions ($reload = false, $enabled_only = false)
	{
		$settings = $this->get_settings ($reload);
		
		// Default
		$positions = array();
		
		// Setup Positions		
		if (isset ($settings ['positions']) && is_array ($settings ['positions']))
		{
			// Only enabled positions
			if ($enabled_only === true)
			{
				foreach ($settings ['positions'] AS $position => $flag)
				{
					if ($flag <> 'disabled')
					{
						$positions[$position] = $flag;
					}
				}
			}
			// All positions
			else
			{			
				$positions = $settings ['positions'];
			}	
		}
			
		return $positions;
	}

	/**
	 * Return the button_text setting
	 */
	public function get_button_text ($reload = false)
	{
		$settings = $this->get_settings ($reload);
		
		// Default Text
		if ( ! isset ($settings ['button_text']))
		{
			$button_text = 'Share On %provider.name%';
		}
		// Custom Text
		else
		{
			// No Text Specified
			if (empty ($settings ['button_text']))
			{
				$button_text = '%provider.name%';
			}
			// Custom Text Specified
			else
			{
				$button_text = $settings ['button_text'];
			}
		}
		
		return $button_text;
	}

	/**
	 * Return the list of methods
	 */
	public function get_all_methods ()
	{
		return self::$methods;
	}
	
	/**
	 * Return the list of enabled methods
	 */
	public function get_enabled_methods ($reload = false, $all_properties = false)
	{
		$settings = $this->get_settings ($reload);
		
		// Setup enabled methods		
		if (isset ($settings ['enabled_methods']) && is_array ($settings ['enabled_methods']))
		{		
				$enabled_methods = $settings ['enabled_methods'];			
		}
		else
		{	
			$enabled_methods = array();
		}
		
		// Full list with all properties
		if (count ($enabled_methods) > 0)
		{
			if ($all_properties === true)
			{
				$full_methods = array();
				
				foreach ($enabled_methods AS $method_key)
				{
					if (isset (self::$methods[$method_key]))
					{
						$full_methods [$method_key] = self::$methods[$method_key];
					}
				}
								
				$enabled_methods = $full_methods;
			}
		}
	
		return $enabled_methods;
	}

	/**
	 * Return the list of disabled methods
	 */
	public function get_disabled_methods ($reload = false)
	{
		$settings = $this->get_settings ($reload);
		
		$enabled_methods = $this->get_enabled_methods ();
		$disabled_methods = array();
		
		if (count ($enabled_methods) == 0)
		{
			$disabled_methods = array_keys (self::$methods);
		}
		else
		{
			foreach (self::$methods AS $method_key => $method_data)
			{
				if (!in_array ($method_key, $enabled_methods))
				{
					$disabled_methods [] = $method_key;
				}
			}
		}
		
		return $disabled_methods;
	}
}
