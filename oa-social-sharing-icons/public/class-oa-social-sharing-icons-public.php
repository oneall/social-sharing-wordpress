<?php

/**
 * Social Sharing Icons \ Public Features
 * @link		http://www.oneall.com
 * @package 	oa_social_sharing_icons
 */
class oa_social_sharing_icons_public extends oa_social_sharing_icons
{		
	/**
	 * Enabled Positions
	 */
	public $positions = array();
	
	/**
	 * Define which hooks to use for which position
	 */
	public $positions_hooks = array(
		'dynamic_sidebar_before' => array(
			'hook' => 'dynamic_sidebar_before',
			'function' => 'add_content_dynamic_sidebar_before' 
		),
		'dynamic_sidebar_after' => array(
			'hook' => 'dynamic_sidebar_after',
			'function' => 'add_content_dynamic_sidebar_after' 
		),
		'header' => array(
			'hook' => 'get_header',
			'function' => 'add_content_get_header' 
		),
		'footer' => array(
			'hook' => 'get_footer',
			'function' => 'add_content_get_footer' 
		),
		'end_post' => array(
			'hook' => 'the_content',
			'function' => 'add_content_end_post' 
		),
		'credits' => array(
			'hook' => '_credits',
			'function' => 'add_content_credits' 
		),
		'left_floating' => array(
			'hook' => 'get_header',
			'function' => 'add_content_floating_left' 
		),
		'right_floating' => array(
			'hook' => 'get_header',
			'function' => 'add_content_floating_right' 
		), 
		'comment_form_before' => array(
			'hook' => 'comment_form_before',
			'function' => 'add_content_comment_form_before'
		),
		'comment_form_after' => array(
			'hook' => 'comment_form_after',
			'function' => 'add_content_comment_form_after'
		)		
	);

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct ($source = null)
	{		
		// Add theme name to credits hook
		$this->positions_hooks ['credits'] ['hook'] = get_template () . '_credits';
		
		// Get all data
		$this->init_data ();
		
		// Widget doesn't need hooks
		if (empty ($source))
		{
			$this->add_hooks_all_positions ();
		}
		
		// Shortcode: [oa_social_sharing_icons]
		add_shortcode ('oa_social_sharing_icons', array($this, 'shortcode_handler'));
		
		// Action: do_action ('oa_social_sharing_icons');
		add_action ('oa_social_sharing_icons', array($this, 'shortcode_handler'), 10, 2);
	}

	/**
	 * Init data saved in the database.
	 */
	public function init_data ()
	{		
		// Load Configuration 
		$oa_social_sharing_icons_config = oa_social_sharing_icons_config::getInstance();

		// Enabled Positions
		$enabled_positions = $oa_social_sharing_icons_config->get_positions();
		
		// For all positions
		if (is_array ($enabled_positions) && count ($enabled_positions) > 0)
		{
			foreach ($this->positions_hooks AS $position_key => $position_data)
			{
				$this->positions [$position_key] = (!empty ($enabled_positions[$position_key]) ? $enabled_positions[$position_key] : 'disabled');
			}
		}
	}

	/**
	 * Add hook for each specified position
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
		
		$button_size = !empty ($size) ? $size : (!empty ($atts ['size']) ? $atts ['size'] : oa_social_sharing_icons_config::getInstance()->get_default_size());
		
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
		echo '<div class="oneall_sharing_icons oneall_sharing_icons_custom">'.$this->print_sharing_block ($position, $size) .'</div>';
	}

	/**
	 * Position: Floating Left
	 */
	public function add_content_floating_left ($content)
	{
		$size = $this->positions ['left_floating'];
		echo '<div class="oneall_sharing_icons oneall_sharing_icons_floating oneall_sharing_icons_floating_left">'. $this->print_sharing_block ('left_floating', $size) . '</div>';
	}

	/**
	 * Position: Floating Right
	 */
	public function add_content_floating_right ($content)
	{
		$size = $this->positions ['right_floating'];
		echo '<div class="oneall_sharing_icons oneall_sharing_icons_floating oneall_sharing_icons_floating_right">'. $this->print_sharing_block ('right_floating', $size) . '</div>';
	}
	
	/**
	 * Position: At the end of a single post
	 */
	public function add_content_end_post ($content)
	{		
		if (is_single ())
		{
			$size = $this->positions ['end_post'];
			return $content . '<div class="oneall_sharing_icons oneall_sharing_icons_post oneall_sharing_icons_post_end">' . $this->print_sharing_block ('end_post', $size) . '</div>';
		}
		
		return $content;
	}

	/**
	 * Position: Header
	 */
	public function add_content_get_header ()
	{
		$size = $this->positions ['header'];
		echo '<span class="oneall_sharing_icons oneall_sharing_icons_header">' . $this->print_sharing_block ('header', $size).'</span>';
	}
	
	/**
	 * Position: Footer
	 */
	public function add_content_get_footer ()
	{
		$size = $this->positions ['footer'];
		echo '<span class="oneall_sharing_icons oneall_sharing_icons_footer">'. $this->print_sharing_block ('footer', $size). '</span>';
	}

	/**
	 * Position: Credits
	 */
	public function add_content_credits ()
	{
		$size = $this->positions ['credits'];
		echo '<span class="oneall_sharing_icons oneall_sharing_icons_credits">'. $this->print_sharing_block ('credits', $size) .'</span>';
	}

	/**
	 * Position: Before Sidebar
	 */
	public function add_content_dynamic_sidebar_before ()
	{
		$size = $this->positions ['dynamic_sidebar_before'];
		echo '<aside class="widget oneall_sharing_icons oneall_sharing_icons_sidebar oneall_sharing_icons_sidebar_before">' . $this->print_sharing_block ('dynamic_sidebar_before', $size) . '</aside>';
	}

	/**
	 * Position: After Sidebar
	 */
	public function add_content_dynamic_sidebar_after ()
	{
		$size = $this->positions ['dynamic_sidebar_after'];
		echo '<aside class="widget oneall_sharing_icons oneall_sharing_icons_sidebar oneall_sharing_icons_sidebar_after">' . $this->print_sharing_block ('dynamic_sidebar_after', $size) . '</aside>';
	}
	
	/**
	 * Position: Before Comment Form
	 */
	public function add_content_comment_form_before ()
	{
		$size = $this->positions ['comment_form_before'];
		echo '<div class="oneall_sharing_icons oneall_sharing_icons_comment_form oneall_sharing_icons_comment_form_before">' . $this->print_sharing_block ('comment_form_before', $size) . '</div>';
	}
	
	/**
	 * Position: After Comment Form
	 */
	public function add_content_comment_form_after ()
	{
		$size = $this->positions ['comment_form_after'];
		echo '<div class="oneall_sharing_icons oneall_sharing_icons_comment_form oneall_sharing_icons_comment_form_after">' . $this->print_sharing_block ('comment_form_after', $size) . '</div>';
	}

	
	
	/**
	 * Generate HTML sharing block
	 */
	public function print_sharing_block ($sharing_block_class, $display_size)
	{
		// Sharing Block
		$social_sharing_block = '';
		
		// Read Configuration
		$oa_social_sharing_icons_config = oa_social_sharing_icons_config::getInstance();
		
		// Enabled Methods
		$enabled_methods = $oa_social_sharing_icons_config->get_enabled_methods(false, true);
		
		// Any Methods enabled?
		if (is_array ($enabled_methods) && count ($enabled_methods) > 0)
		{
			// Default Size
			$default_size = $oa_social_sharing_icons_config->get_default_size();
			
			// Button Text
			$button_text = $oa_social_sharing_icons_config->get_button_text ();
			
			// Open Graph Tags
			$disable_og_tags = $oa_social_sharing_icons_config->get_disable_og_tags();
					
			// Size for the buttons
			$display_size = (($display_size == 'default') ? $default_size : $display_size);
			
			// Not disabled
			if ($display_size <> 'disabled')
			{
				$social_sharing_block .= '<span class="oas_box oas_box_' . $display_size . ' oas_box_' . $sharing_block_class . '"'.( ! empty ($disable_og_tags) ? ' data-read-og-tags="false"' : '').'>';
				
				foreach ($enabled_methods as $method_data)
				{
					$social_sharing_block .= '<span class="oas_btn oas_btn_' . $method_data['name_key'] . '" title="' . str_replace ('%provider.name%', $method_data['name'], $button_text) . '"></span>';
				}
				
				$social_sharing_block .= '</span>';
			}
		}
		
		return $social_sharing_block;
	}

	/**
	 * Register the stylesheets for the public-facing side of the plugin.
	 */
	public function enqueue_styles ()
	{
		wp_enqueue_style ('public_print_styles-' . $this->plugin_name, plugin_dir_url (__FILE__) . 'css/oa-social-sharing-icons-public.css');
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
