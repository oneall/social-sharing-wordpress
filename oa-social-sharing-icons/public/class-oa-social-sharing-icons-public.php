<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.oneall.com
 * @package    oa_social_sharing_icons
 * @subpackage oa_social_sharing_icons/public
 */
class oa_social_sharing_icons_public extends oa_social_sharing_icons
{	
	/**
	 * Selected methods : Twitter, Facebook...	
	 * @var array
	 */
	public $selected_methods;
	
	/**
	 * Selected default size
	 * @var string
	 */
	public $default_size;
	
	/**
	 * Selected positions
	 * @var array
	 */
	public $positions = array();
	
	/**
	 * Define which hooks to use for which position
	 * @var array
	 */
	public $positions_hooks = array(
		'position_dynamic_sidebar_before' => array(
			'hook' => 'dynamic_sidebar_before',
			'function' => 'add_content_dynamic_sidebar_before' 
		),
		'position_dynamic_sidebar_after' => array(
			'hook' => 'dynamic_sidebar_after',
			'function' => 'add_content_dynamic_sidebar_after' 
		),
		'position_header' => array(
			'hook' => 'get_header',
			'function' => 'add_content_get_header' 
		),
		'position_footer' => array(
			'hook' => 'get_footer',
			'function' => 'add_content_get_footer' 
		),
		'position_end_post' => array(
			'hook' => 'the_content',
			'function' => 'add_content_end_post' 
		),
		'position_credits' => array(
			'hook' => '_credits',
			'function' => 'add_content_credits' 
		),
		'position_left_floating' => array(
			'hook' => 'get_header',
			'function' => 'add_content_floating_left' 
		),
		'position_right_floating' => array(
			'hook' => 'get_header',
			'function' => 'add_content_floating_right' 
		) 
	);

	/**
	 * Initialize the class and set its properties.
	 * @return void
	 */
	public function __construct ($source = null)
	{
		$oa_social_config = oa_social_sharing_icons_config::getInstance ();
		parent::__construct ($oa_social_config);
		
		// Add theme name to credits hook
		$this->positions_hooks ['position_credits'] ['hook'] = get_template () . '_credits';
		
		// Get all data
		$this->init_data ();
		
		// Widget doesn't need hooks
		if (empty ($source))
		{
			$this->add_hooks_all_positions ();
		}
		
		// Shortcode [oa_social_sharing_icons]
		add_shortcode ('oa_social_sharing_icons', array($this, 'shortcode_handler'));
		
		// Actioon do_action ('oa_social_sharing_icons');
		add_action ('oa_social_sharing_icons', array($this, 'shortcode_handler'), 10, 2);
	}

	/**
	 * Init data saved in database
	 * @return void
	 */
	public function init_data ()
	{		
		// Check if we have settings in the database
		$settings = get_option ('oa_social_sharing_icons_settings');
		$values = json_decode ($settings ['wizard_final_choice']);
		
		$this->default_size = (!empty ($values->default_size)) ? $values->default_size : 'btns_m';
		$this->selected_methods = (!empty ($values->methods)) ? $values->methods : null;
		$this->positions = array();
		
		// For all positions
		foreach ($this->positions_hooks as $position => $unused_additionnal_info)
		{
			$this->positions [$position] = (!empty ($values->{$position})) ? $values->{$position} : 'disabled';
		}
	}

	/**
	 * Add hook for each position specified
	 * @return void
	 */
	public function add_hooks_all_positions ()
	{
		if (!is_admin ())
		{
			foreach ($this->positions as $position => $value)
			{				
				$hook = $this->positions_hooks [$position] ['hook'];
				$function = $this->positions_hooks [$position] ['function'];				
				add_action ($hook, array($this, $function));
			}
		}
	}

	/**
	 * Setup Shortcode handler
	 * @return string html plugin
	 */
	public function shortcode_handler ($atts, $size = null)
	{
		// Custom html id
		if (!empty ($atts ['id']))
		{
			$shortcode_html_id = 'custom_' . $atts ['id'];
		}
		else if (!empty ($atts))
		{
			$shortcode_html_id = 'custom_' . $atts;
		}
		else
		{
			$shortcode_html_id = 'custom';
		}
		
		$button_size = !empty ($size) ? $size : (!empty ($atts ['size']) ? $atts ['size'] : $this->default_size);
		
		// In posts, needed for the shortcode to be placed at the good place
		if (is_single ())
		{
			ob_start ();
			$this->add_content_custom ($shortcode_html_id, $button_size);
			$output_string = ob_get_contents ();
			ob_end_clean ();
			return $output_string;
		}
		
		return $this->add_content_custom ($shortcode_html_id, $button_size);
	}
	
	/**
	 * Position: Custom
	 */ 
	public function add_content_custom ($position, $size)
	{
		echo $this->print_sharing_block ($position, $size);
	}

	/**
	 * Position: Floating Left
	 */
	public function add_content_floating_left ($content)
	{
		$size = $this->positions ['position_left_floating'];
		echo '<div id="oass_floating_left_sharing" class="oass_floating_sharing">' . $this->print_sharing_block ('position_left_floating', $size) . '</div>';
	}

	/**
	 * Position: Floating Right
	 */
	public function add_content_floating_right ($content)
	{
		$size = $this->positions ['position_right_floating'];
		echo '<div id="oass_floating_right_sharing" class="oass_floating_sharing">' . $this->print_sharing_block ('position_right_floating', $size) . '</div>';
	}
	
	/**
	 * Position: At the end of a single post
	 */
	public function add_content_end_post ($content)
	{		
		if (is_single ())
		{
			$size = $this->positions ['position_end_post'];
			return $content . $this->print_sharing_block ('position_end_post', $size);
		}
		
		return $content;
	}

	/**
	 * Position: Header
	 */
	public function add_content_get_header ()
	{
		$size = $this->positions ['position_header'];
		echo $this->print_sharing_block ('position_header', $size);
	}
	
	/**
	 * Position: Footer
	 */
	public function add_content_get_footer ()
	{
		$size = $this->positions ['position_footer'];
		echo $this->print_sharing_block ('position_footer', $size);
	}

	/**
	 * Position: Credits
	 */
	public function add_content_credits ()
	{
		$size = $this->positions ['position_credits'];
		echo $this->print_sharing_block ('position_credits', $size);
	}

	/**
	 * Position: Before Sidebar
	 */
	public function add_content_dynamic_sidebar_before ()
	{
		$size = $this->positions ['position_dynamic_sidebar_before'];
		echo $this->print_sharing_block ('position_dynamic_sidebar_before', $size);
	}

	/**
	 * Position: After Sidebar
	 */
	public function add_content_dynamic_sidebar_after ()
	{
		$size = $this->positions ['position_dynamic_sidebar_after'];
		echo $this->print_sharing_block ('position_dynamic_sidebar_after', $size);
	}

	/**
	 * Generate html sharing block
	 * @return string html
	 */
	public function print_sharing_block ($position_id, $size)
	{
		if (isset ($this->selected_methods) && is_array ($this->selected_methods))
		{
			$size = (($size == 'default') ? $this->default_size : $size);
			
			if ($size != 'disabled')
			{
				$social_sharing_block = '<div class="oas_box oas_box_' . $size . ' oas_box_' . $position_id . '">';
				foreach ($this->selected_methods as $method)
				{
					$social_sharing_block .= '<span class="oas_btn oas_btn_' . $method->key . '" title="Send to ' . $method->title . '"></span>';
				}
				$social_sharing_block .= '</div>';
				
				// Done
				return $social_sharing_block;
			}
		}
		return null;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles ()
	{
		wp_enqueue_style ('public_print_styles-' . $this->plugin_name, plugin_dir_url (__FILE__) . 'css/oa-social-sharing-icons-public.css');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts ()
	{
		wp_enqueue_script ($this->plugin_name, plugin_dir_url (__FILE__) . 'js/oa-social-sharing-icons-public.js', array('jquery'), $this->version, false);
	}
}
