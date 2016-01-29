<?php
/**
 * All sharing methods.
 *
 * Defines all sharing methods.
 *
 * @package    oa_social_sharing_icons
 * @subpackage oa_social_sharing_icons/admin
 * @author     Your Name <email@example.com>
 */
class oa_social_sharing_icons_admin_methods {

	/**
	 * Methods that can be used with this plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $methods    all methods.
	 */
	private $methods = array(
		'facebook_like_but'   => array('name' => 'Facebook Like Button','name_button' => 'Facebook','name_key' => 'facebook_like_but','type' => 'addon','is_default' => '0'),
		'facebook'            => array('name' => 'Facebook','name_button' => 'Facebook','name_key' => 'facebook','type' => 'service','is_default' => '1'),
		'twitter'             => array('name' => 'Twitter','name_button' => 'Twitter','name_key' => 'twitter','type' => 'service','is_default' => '1'),
		'linkedin'            => array('name' => 'LinkedIn','name_button' => 'LinkedIn','name_key' => 'linkedin','type' => 'service','is_default' => '1'),
		'google_bookmarks'    => array('name' => 'Google Bookmarks','name_button' => 'Google','name_key' => 'google_bookmarks','type' => 'service','is_default' => '0'),
		'twitter_tweet_but'   => array('name' => 'Twitter Tweet Button','name_button' => 'Twitter','name_key' => 'twitter_tweet_but','type' => 'addon','is_default' => '0'),
		'google_plus_one_but' => array('name' => 'Google +1 Button','name_button' => 'Google','name_key' => 'google_plus_one_but','type' => 'addon','is_default' => '0'),
		'linkedin_share_but'  => array('name' => 'LinkedIn Share Button','name_button' => 'LinkedIn','name_key' => 'linkedin_share_but','type' => 'addon','is_default' => '0'),
		'delicious'           => array('name' => 'Delicious','name_button' => 'Delicious','name_key' => 'delicious','type' => 'service','is_default' => '0'),
		'digg'                => array('name' => 'Digg','name_button' => 'Digg','name_key' => 'digg','type' => 'service','is_default' => '0'),
		'stumbleupon'         => array('name' => 'StumbleUpon','name_button' => 'StumbleUpon','name_key' => 'stumbleupon','type' => 'service','is_default' => '0'),
		'reddit'              => array('name' => 'Reddit','name_button' => 'Reddit','name_key' => 'reddit','type' => 'service','is_default' => '0'),
		'tumblr'              => array('name' => 'Tumblr','name_button' => 'Tumblr','name_key' => 'tumblr','type' => 'service','is_default' => '0'),
		'vkontakte'           => array('name' => 'VKontakte','name_button' => 'В Контакте','name_key' => 'vkontakte','type' => 'service','is_default' => '0'),
		'vkontakte_share_but' => array('name' => 'VKontakte Share Button','name_button' => 'В Контакте','name_key' => 'vkontakte_share_but','type' => 'addon','is_default' => '0'),
		'pinterest'           => array('name' => 'Pinterest','name_button' => 'Pinterest','name_key' => 'pinterest','type' => 'service','is_default' => '0'),
		'google_plus'         => array('name' => 'Google Plus','name_button' => 'Google','name_key' => 'google_plus','type' => 'service','is_default' => '0'),
		'email'               => array('name' => 'Email','name_button' => 'Email','name_key' => 'email','type' => 'service','is_default' => '0')
	);
	

	/**
	 * Name key methods already used to prevent wizard doubloon 
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $methods    all name_key methods selected .
	 */
	private $used_methods = array();


	/**
	 * Name key methods already used to prevent wizard doubloon 
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $methods    all name_key methods selected .
	 */
	private $use_default = true;



	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
	}


	/**
	 * Get all methods by type
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param      string    $type    methods or addon.
	 * @return array methods with sepecific type
	 */
	public function get_methods_by_type($type){
		return $this->get_methods_by_param('type', $type);
	}


	/**
	 * Get all methods by name
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param      string    $name    methods or addon.
	 * @return array methods with sepecific name
	 */
	public function get_methods_by_name($name){
		return $this->get_methods_by_param('name', $name);
	}

	/**
	 * Get all methods by name_key
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param      string    $name_key    methods or addon.
	 * @return array methods with sepecific name_key
	 */
	public function get_methods_by_name_key($name_key){
		return $this->get_methods_by_param('name_key', $name_key);
	}


	/**
	 * Get all methods by name_button
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param      string    $name_button    methods or addon.
	 * @return array methods with sepecific name_button
	 */
	public function get_methods_by_name_button($name_button){
		return $this->get_methods_by_param('name_button', $name_button);
	}



	/**
	 * Get all methods by name_button
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param      string    $name_button    methods or addon.
	 * @return array methods with sepecific name_button
	 */
	public function get_selected_methods (){

		$settings = get_option ('oa_social_sharing_icons_settings');

		//user saved data
		if (isset($settings['wizard_final_choice'])) {

			$selected_methods = array();
			$user_choice = json_decode($settings['wizard_final_choice']);

			//user saved methods
			if (!empty($user_choice->methods)){
				foreach ($user_choice->methods as $method) {
					$selected_methods[]   = $this->methods[$method->key];
					$this->used_methods[] = $method->key; //save selected method to prevent doubloon
				}

				$this->use_default = false;
				return $selected_methods;
			}

			return $this->get_methods_default();

		} 
		
		//no methods selected -> default methods
		return $this->get_methods_default();		
	}



	/**
	 * Get all methods by param 
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param      string    $name    methods or addon.
	 * @return array methods with sepecific name
	 */
	public function get_methods_by_param($param_name, $param_value){

		$methods_by_param = array();
		
		//foreach methods
		foreach ($this->methods as $key => $method) {

			//does the method havec the specific param ? && not already used in another listing ?
			if ($method[$param_name] == $param_value && !in_array($key, $this->used_methods)){

				//all specific methods (default & non default)
				if ( !$this->use_default){
					$methods_by_param[] = $method;

				//only non default method
				} else {

					if ($method['is_default']==0){
						$methods_by_param[] = $method;
					}
				}
			}
		}

		return $methods_by_param;
	}


	/**
	 * Get all default methods
	 *
	 * @since    1.0.0
	 * @access   private
	 * @return array default methods
	 */
	public function get_methods_default(){

		$default_methods = array();
		
		foreach ($this->methods as $key => $method) {
			if ($method['is_default'] == 1 ){
				$default_methods[]    = $method;
				$this->used_methods[] = $key;
			}
		}

		return $default_methods;
	}

	/**
	 * Html rendering for methods passed as param
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param      array    $methods    methods.
	 * @return string html content
	 */
	static public function render_methods($methods){

		$html_methods = '';
		
		foreach ($methods as $method) {
			$html_methods .= self::render_method_row($method['name'], $method['name_key'], $method['name_button'], $method['type']);
		}

		return $html_methods;
	}



	/**
	 * Html rendering for a single method
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param      string    $name    methods name.
	 * @param      string    $name_key    methods key name.
	 * @param      string    $name_button    methods button_name.
	 * @param      string    $type    methods or addon.
	 * @return string html content
	 */
	static public function render_method_row($name, $name_key, $name_button, $type){

		return '<div data-key="'.$name_key.'" data-name="'.$name.'" data-name-button="'.$name_button.'" class="sharing_method sharing_method_'.$type.'">
					<span class="name ui-sortable-handle">'.$name.'</span>
					<span class="mover"></span>
				</div>';
	}


}