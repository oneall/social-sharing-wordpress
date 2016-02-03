<?php

/**
 * Social Sharing Icons \ Widgets
 * @link		http://www.oneall.com
 * @package 	oa_social_sharing_icons
 */
class oa_social_sharing_icons_admin_widget extends WP_Widget
{
	public $oa_social_config;

	/**
	 * Constructor.
	 */
	public function __construct ()
	{
		$this->oa_social_config = $oa_social_config = oa_social_sharing_icons_config::getInstance ();
		
		parent::__construct ('oa_social_sharing_icons', 'Social Sharing Icons', array(
			'description' => __ ('Allow your visitors to share your website pages on their social networks like Twitter, Facebook, LinkedIn, Google and Yahoo.', 'oa-social-sharing-icons') 
		));
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
	 * Display Widget Settings.
	 */
	public function form ($instance)
	{
		// Default settings
		$default_settings = array(
			'widget_size_value' => 'default',
			'widget_title' => __ ('Share', 'oa-social-sharing-icons') 
		);
		
		$instance = wp_parse_args ((array) $instance, $default_settings);
		
		?>
<p>
	<label for="<?php echo $this->get_field_id ('widget_title'); ?>"><?php _e ('Title', 'oa-social-sharing-icons'); ?>:</label> <input
		class="widefat" id="<?php echo $this->get_field_id ('widget_title'); ?>" name="<?php echo $this->get_field_name ('widget_title'); ?>"
		type="text" value="<?php echo $instance ['widget_title']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id ('widget_size_value'); ?>"><?php _e ('Size', 'oa-social-sharing-icons'); ?>:</label> <select
		class="widefat" id="<?php echo $this->get_field_id ('widget_size_value'); ?>" name="<?php echo $this->get_field_name ('widget_size_value'); ?>">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options( $instance ['widget_size_value'] ); ?>
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
		$instance ['widget_size_value'] = trim ($new_instance ['widget_size_value']);
		return $instance;
	}

	/**
	 * Display Providers.
	 */
	public function render_sharing_form ($instance = array ())
	{
		// Container for returned value
		$output = '';
		
		// Read settings
		$settings = get_option ('oa_social_wizard_settings');
		
		// API Subdomain
		$api_subdomain = $this->oa_social_config->get_user_subdomain ();
		
		// API Subdomain Required
		if (!empty ($api_subdomain))
		{
			// get button size
			$button_size = !empty ($instance ['widget_size_value']) ? $instance ['widget_size_value'] : 'btms_m';
			
			// Generate buttons (according to plugin user choice)
			$oa_social_sharing_icons_public = new oa_social_sharing_icons_public ('widget');
			$output = $oa_social_sharing_icons_public->print_sharing_block ('widget', $button_size);
			
			// Return a string and let the calling function do the actual outputting
			return $output;
		}
	}
}

add_action ('widgets_init', create_function ('', 'return register_widget( "oa_social_sharing_icons_admin_widget" );'));