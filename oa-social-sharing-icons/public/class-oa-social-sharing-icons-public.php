<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.oneall.com
 * @since      1.0.0
 *
 * @package    oa_social_sharing_icons
 * @subpackage oa_social_sharing_icons/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    oa_social_sharing_icons
 * @subpackage oa_social_sharing_icons/public
 * @author     Your Name <email@example.com>
 */
class oa_social_sharing_icons_public extends oa_social_sharing_icons {

	/**
	 * Selected methods : Twitter, Facebook...
	 * @var array
	 */
	public $selected_methods;

	/**
	 * selected default size
	 * @var string
	 */
	public $default_size;	

	/**
	 * selected positions info
	 * @var array
	 */
	public $positions = array();

	/**
	 * define which hooks to use with position
	 * @var array
	 */
	public $positions_hooks = array (

		'position_dynamic_sidebar_before' => array('hook' => 'dynamic_sidebar_before' , 'function' => 'add_content_dynamic_sidebar_before'),
		'position_dynamic_sidebar_after'  => array('hook' => 'dynamic_sidebar_after' , 'function' => 'add_content_dynamic_sidebar_after'),
		'position_header'                 => array('hook' => 'get_header' , 'function' => 'add_content_get_header'),
		'position_footer'                 => array('hook' => 'get_footer' , 'function' => 'add_content_get_footer'),
		'position_end_post'               => array('hook' => 'the_content' , 'function' => 'add_content_end_post'),
		'position_credits'                => array('hook' =>  '_credits' , 'function' => 'add_content_credits'),
		'position_left_floating'          => array('hook' => 'get_header' , 'function' => 'add_content_floating_left'),
		'position_right_floating'         => array('hook' => 'get_header' , 'function' => 'add_content_floating_right'),
	);



	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $source=null ) {

		$oa_social_config = oa_social_sharing_icons_config::getInstance();
		parent::__construct($oa_social_config);

		//add theme name to credits hook
		$this->positions_hooks['position_credits']['hook'] = get_template().'_credits';

		//get all data
		$this->init_data();

		//widget doesn't need hooks	
		if ( empty($source) ){
			$this->add_hooks_all_positions();
		}

		//shortcode [oa_social_sharing_icons]
		add_shortcode ('oa_social_sharing_icons', array($this,'oa_social_login_shortcode_handler'));
		add_action ('oa_social_sharing_icons',  array($this,'oa_social_login_shortcode_handler'), 10, 2);	
	}



	/**
	 * Init data saved in database
	 * @return void
	 */
	public function init_data() {

		//check if there is a choice in database
		$settings = get_option ('oa_social_sharing_icons_settings');
		$values   = json_decode($settings['wizard_final_choice']);

		$this->default_size     = (!empty($values->default_size)) ? $values->default_size : 'btns_m';
		$this->selected_methods = (!empty($values->methods)) ? $values->methods : null;

		//for all positions
		foreach ($this->positions_hooks as $position => $unused_additionnal_info) {
			$this->positions [$position] = (!empty($values->{$position})) ? $values->{$position} : 'disabled';
		}
	}


	/**
	 * Add hook for each position specified 
	 * @return void
	 */
	public function add_hooks_all_positions() {

		if ( ! is_admin() ) {
			foreach ($this->positions as $position => $value) {

				$hook     = $this->positions_hooks[$position]['hook'];
				$function = $this->positions_hooks[$position]['function'];
				 
				add_action ($hook, array($this, $function));
			}
		}
	}


	/**
	 * Setup Social Login Shortcode handler
	 * @param  array  $atts shortcode paramaters values
	 * @param  string $size buttons size asked
	 * @return string html plugin
	 */
	public function oa_social_login_shortcode_handler ($atts, $size=null)
	{
		//custom html id
		if (!empty($atts['id'])) {
			$shortcode_html_id = 'custom_'.$atts['id'];
		} else if (!empty($atts)) {
			$shortcode_html_id = 'custom_'.$atts;
		} else {
			$shortcode_html_id = 'custom';
		}

		$button_size = !empty($size) ? $size : (!empty($atts['size']) ? $atts['size'] : $this->default_size );


		//in post, needed for the shortcode to be placed at the good place
		if (is_single()){
			ob_start();
			$this->add_content_custom ($shortcode_html_id, $button_size);
			$output_string = ob_get_contents();
			ob_end_clean();
			return $output_string;
		} 

		return $this->add_content_custom ($shortcode_html_id, $button_size);		
	}




	// Hook Callback
	public function add_content_custom($position, $size) {
		echo $this->print_sharing_bloc($position, $size);
	}

	public function add_content_floating_left($content) {
		$size = $this->positions['position_left_floating'];	
		echo '<div id="floating_left_sharing" class="floating_sharing">'.
				$this->print_sharing_bloc('position_left_floating',$size)
			.'</div>';
	}
	public function add_content_floating_right($content) {
		$size = $this->positions['position_right_floating'];
		echo '<div id="floating_right_sharing" class="floating_sharing">'.
				$this->print_sharing_bloc('position_right_floating',$size)
			.'</div>';
	}
	//show button at the end of single post page
	public function add_content_end_post($content) {
		$size = $this->positions['position_end_post'];
		if ( is_single() ){
			return $content . $this->print_sharing_bloc('position_end_post',$size); 
	    }

	    return $content;
	}
	public function add_content_get_header() {
		$size = $this->positions['position_header'];
		echo $this->print_sharing_bloc('position_header',$size);
	}
	public function add_content_get_footer() {
		$size = $this->positions['position_footer'];
		echo $this->print_sharing_bloc('position_footer',$size);
	}
	public function add_content_credits() {
		$size = $this->positions['position_credits'];
		echo $this->print_sharing_bloc('position_credits',$size);
	}
	public function add_content_dynamic_sidebar_before() {
		$size = $this->positions['position_dynamic_sidebar_before'];
		echo $this->print_sharing_bloc('position_dynamic_sidebar_before',$size);
	}
	public function add_content_dynamic_sidebar_after() {
		$size = $this->positions['position_dynamic_sidebar_after'];
		echo $this->print_sharing_bloc('position_dynamic_sidebar_after',$size);
	}


	/**
	 * Generate html sharing bloc
	 * @param  string $position_id id
	 * @param  string $size buttons size class
	 * @return string html
	 */
	public function print_sharing_bloc($position_id, $size) {

		$size = ($size=='default') ? $this->default_size : $size;
		if (!empty($this->selected_methods)){
			if ($size != 'disabled') {
				$social_sharing_bloc = '<div class="oas_box oas_box_'.$size.' oas_box_'.$position_id.'">';	
				foreach ($this->selected_methods as $method) {
					$social_sharing_bloc .= '<span class="oas_btn oas_btn_'.$method->key.'" title="Send to '.$method->title.'"></span>';
				}
				$social_sharing_bloc .= '</div>';
				return $social_sharing_bloc;
			}
		}
		return null;
	}



	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'public_print_styles-' .$this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/oa-social-sharing-icons-public.css' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/oa-social-sharing-icons-public.js', array( 'jquery' ), $this->version, false );
	}

}
