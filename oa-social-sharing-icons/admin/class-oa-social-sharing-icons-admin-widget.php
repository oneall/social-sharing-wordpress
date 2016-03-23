<?php

/**
 * Social Sharing Icons Widget
 * @link       http://www.oneall.com
 * @package    oa_social_sharing_icons
 */

/* Social Sharing Wizard */
class oa_social_sharing_icons_admin_widget extends WP_Widget
{
	/**
	 * Constructor.
	 */
	public function __construct ()
	{		
		parent::__construct ('oa_social_sharing_icons', 'Social Sharing Icons', array(
			'description' => __ ('Allow your visitors to share your website pages on their social networks like Twitter, Facebook, LinkedIn, Google and Yahoo.', 'oa-social-sharing-icons') 
		));
	}

	/**
	 * Display Widget Settings.
	 */
	public function form ($settings)
	{
		// Default settings
		$default_settings = array(
			'widget_size' => 'default',
			'widget_title' => __ ('Share', 'oa-social-sharing-icons') 
		);
		
		// Read Settings
		$settings = wp_parse_args ((array) $settings, $default_settings);
		
		?>
			<p>
				<label for="<?php echo $this->get_field_id ('widget_title'); ?>"><?php _e ('Title', 'oa-social-sharing-icons'); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id ('widget_title'); ?>" name="<?php echo $this->get_field_name ('widget_title'); ?>" type="text" value="<?php echo $settings ['widget_title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id ('widget_size'); ?>"><?php _e ('Size', 'oa-social-sharing-icons'); ?>:</label> 
				<select class="widefat" id="<?php echo $this->get_field_id ('widget_size'); ?>" name="<?php echo $this->get_field_name ('widget_size'); ?>">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options(false, 'widget_size', array ('widget_size' => $settings ['widget_size'])); ?>
				</select>
			</p>
		<?php
	}

	/**
	 * Update Widget Settings.
	 */
	public function update ($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance ['widget_title'] = trim ($new_instance ['widget_title']);
		$instance ['widget_size'] = trim ($new_instance ['widget_size']);
		return $instance;
	}

	/**
	 * Display Widget.
	 */
	public function widget ($args, $instance)
	{
		if (!empty ($instance ['widget_title']))
		{
			echo '<h3>' . $instance ['widget_title'] . '</h3>';
		}
		echo $this->render_sharing_form ($instance);
	}
	
	/**
	 * Display Sharing Providers.
	 */
	public function render_sharing_form ($instance = array ())
	{
		// Load Configuration 
		$oa_social_sharing_icons_config = oa_social_sharing_icons_config::getInstance();
		
		// Read Subdomain
		$api_subdomain = $oa_social_sharing_icons_config->get_api_subdomain();
						
		// API Subdomain Required
		if (!empty ($api_subdomain))
		{
			// get button size
			$button_size = (!empty ($instance ['widget_size']) ? $instance ['widget_size'] : 'btms_m');
			
			// Generate buttons (according to plugin user choice)
			$oa_social_sharing_icons_public = new oa_social_sharing_icons_public ('widget');
			
			// Return a string and let the calling function do the actual outputting
			return  $oa_social_sharing_icons_public->print_sharing_block ('widget', $button_size);
		}
	}
}

add_action ('widgets_init', create_function ('', 'return register_widget( "oa_social_sharing_icons_admin_widget" );'));