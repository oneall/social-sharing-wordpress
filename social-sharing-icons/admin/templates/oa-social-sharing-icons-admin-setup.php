<?php

/**
 * Social Sharing Icons Admin Setup
 * @link       http://www.oneall.com
 * @package    oa_social_sharing_icons
 */

// Try to read Social Login settings
$settings = get_option ('oa_social_login_settings');

// Restore Subdomain
$api_subdomain = ((is_array ($settings) && isset ($settings['api_subdomain'])) ? trim ($settings['api_subdomain']) : '');

?>
<div class="wrap">
	<div id="oneall">
		<form method="post" action="options.php">
			<?php
				settings_fields ('oa_social_sharing_icons_settings_group');
			?>				
			<h2>OneAll Social Sharing Icons <?php echo $this->version; ?></h2>
			<div class="oneall_box oneall_box_setup">
				<div class="oneall_box_title">
					<?php printf (__ ('OneAll is used on more than %s websites worldwide!', 'oa-social-sharing-icons'), '250,000'); ?>
				</div>
				<div class="oneall_box_contents">
					<p>
						<?php _e ('Unlike other providers we monitor the social networks and update our services as soon as changes arise.', 'oa-social-sharing-icons'); ?>
						<?php _e ('By using OneAll you can be sure that your social media integration will always run smoothly and with the most up-to-date technology.', 'oa-social-sharing-icons'); ?>
					</p>
					<p>
						<?php printf (__ ('To be able to use this plugin you first need to create a free account at %s and setup a Site.', 'oa-social-sharing-icons'), '<a href="https://app.oneall.com/signup/wp" target="_blank">http://www.oneall.com</a>'); ?>
						<?php _e ('Then please enter your Site settings in the form below. Don\'t worry the setup is free and takes only a couple of minutes!', 'oa-social-sharing-icons'); ?>
					</p>
					<p class="oneall_buttons">
						<a class="button-secondary" href="https://app.oneall.com/signup/wp" target="_blank"><strong><?php _e ('Click here to setup your free account', 'oa-social-sharing-icons'); ?></strong></a>
					</p>
				</div>
			</div>					
			<div class="oneall_box oneall_box_config">
				<div class="oneall_box_title">
					<?php _e ('Enter your OneAll Subdomain to get started!', 'oa-social-sharing-icons'); ?>
				</div>
				<div class="oneall_box_contents">
					<div class="oneall_form">
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="oa_social_sharing_icons_settings_api_subdomain"><?php _e ('OneAll Site Subdomain', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<input type="text" class="oneall_form_field" id="oa_social_sharing_icons_settings_api_subdomain" name="oa_social_sharing_icons_settings[api_subdomain]" size="65" value="<?php echo $api_subdomain; ?>" />
								<p class="description"><?php _e ('You can find the subdomain in the API Settings of your site in your OneAll account.', 'oa-social-sharing-icons') ?></p>
							</div>
						</div>	
						<div class="oneall_form_row oneall_form_row_buttons">	
							<input type="hidden" name="page" value="setup" />									
							<input id="save_user_choice" type="submit" class="oneall_btn oneall_btn_success" value="<?php _e ('Confirm Subdomain', 'oa-social-sharing-icons') ?>" />
						</div>				
					</div>		
				</div>
			</div>					
			<h1 class="oneall_teaser_title"><?php _e ('Discover some of the plugin features below'); ?></h1>
			<div class="oneall_box oneall_box_teaser">
				<div class="oneall_box_title">
					<?php _e ('Statistics &amp; User Geolocation Info', 'oa-social-sharing-icons') ?>
				</div>
				<div class="oneall_box_contents">
					<div class="oneall_box_section">
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/shared-pages.png' ?>" alt="<?php _e ('Shared Pages', 'oa-social-sharing-icons') ?>" />
					</div>
					<div class="oneall_box_section">
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/geolocation.png' ?>" alt="<?php _e ('User Geolocation', 'oa-social-sharing-icons') ?>" />
					</div>
				</div>
			</div>				
						
			<div class="oneall_box oneall_box_teaser">
				<div class="oneall_box_title">
						<?php _e ('30+ Social Networks &amp; 30+ Themes') ?>
				</div>
				<div class="oneall_box_contents">		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Beveled Buttons') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/beveled-buttons.png' ?>" alt="Beveled Buttons" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Beveled Buttons With Counters') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/beveled-buttons-counters.png' ?>" alt="Beveled Buttons With Counters" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Flat Cornered Squares') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-cornered-squares.png' ?>" alt="Flat Cornered Squares" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Flat Cornered Squares With Counters') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-cornered-squares-counters.png' ?>" alt="Flat Cornered Squares With Counters" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Flat Cornered Rectangles') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-cornered-rectangles.png' ?>" alt="Flat Cornered Rectangles" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Flat Cornered Rectangles With Counters') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-cornered-rectangles-counters.png' ?>" alt="Flat Cornered Rectangles With Counters" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Flat Rounded Rectangles') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-rounded-rectangles.png' ?>" alt="Flat Rounded Rectangles" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Flat Rounded Rectangles With Counters') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-rounded-rectangles-counters.png' ?>" alt="Flat Rounded Rectangles With Counters" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Flat Circles') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-circles.png' ?>" alt="Flat Circles" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Flat Rounded Squares') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-rounded-squares.png' ?>" alt="Flat Rounded Squares" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title"><?php _e ('Flat Rounded Squares With Counters') ?></div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-rounded-squares-counters.png' ?>" alt="Flat Rounded Squares With Counters" />
					</div>
				</div>
			</div>	
			
			<div class="oneall_box oneall_box_teaser">
				<div class="oneall_box_title">
						<?php _e ('Setup in minutes and 100% free !') ?>
				</div>
			</div>
		</form>
	</div>	
</div>