<?php

/**
 * Social Sharing Icons Admin Setup
 * @link       http://www.oneall.com
 * @package    oa_social_sharing_icons
 */

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
						Do not take the risk of loosing any users due to outdated social network integrations. Unlike other providers we monitor the APIs and technologies of the social networks and 
						we update our service as soon as changes arise. By using OneAll you can be sure that your social media integration will always run smoothly and with the most up-to-date calls. 
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
								<input type="text" class="oneall_form_field" id="oa_social_sharing_icons_settings_api_subdomain" name="oa_social_sharing_icons_settings[api_subdomain]" placeholder="my-subdomain" size="65" value="" />
							</div>
						</div>	
						<div class="oneall_form_row oneall_form_row_buttons">	
							<input type="hidden" name="page" value="setup" />
							<input id="save_user_choice" type="submit" class="oneall_btn oneall_btn_success" value="<?php _e ('Get Started', 'oa-social-sharing-icons') ?>" />
						</div>				
					</div>		
				</div>
			</div>						
			<div class="oneall_box oneall_box_teaser">
				<div class="oneall_box_title">
					30+ Social Networks - 30+ Themes - 100% FREE !
				</div>
				<div class="oneall_box_contents">		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Beveled Buttons</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/beveled-buttons.png' ?>" alt="Beveled Buttons" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Beveled Buttons With Counters</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/beveled-buttons-counters.png' ?>" alt="Beveled Buttons With Counters" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Flat Cornered Squares</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-cornered-squares.png' ?>" alt="Flat Cornered Squares" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Flat Cornered Squares With Counters</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-cornered-squares-counters.png' ?>" alt="Flat Cornered Squares With Counters" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Flat Cornered Rectangles</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-cornered-rectangles.png' ?>" alt="Flat Cornered Rectangles" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Flat Cornered Rectangles With Counters</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-cornered-rectangles-counters.png' ?>" alt="Flat Cornered Rectangles With Counters" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Flat Rounded Rectangles</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-rounded-rectangles.png' ?>" alt="Flat Rounded Rectangles" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Flat Rounded Rectangles With Counters</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-rounded-rectangles-counters.png' ?>" alt="Flat Rounded Rectangles With Counters" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Flat Circles</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-circles.png' ?>" alt="Flat Circles" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Flat Rounded Squares</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-rounded-squares.png' ?>" alt="Flat Rounded Squares" />
					</div>		
					<div class="oneall_box_section">
						<div class="oneall_box_section_title">Flat Rounded Squares With Counters</div>		
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/flat-rounded-squares-counters.png' ?>" alt="Flat Rounded Squares With Counters" />
					</div>
				</div>
			</div>	
		</form>
	</div>	
</div>