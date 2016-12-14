<?php

/**
 * Social Sharing Icons Admin Wizard
 * @link       http://www.oneall.com
 * @package    oa_social_sharing_icons
 */

/* Load Configuration */
$oa_social_sharing_icons_config = oa_social_sharing_icons_config::getInstance();

?>
<div class="wrap">
	<div id="oneall">
		<h2>OneAll Social Sharing Icons <?php echo $this->version; ?></h2>		
		<div class="oneall_box oneall_box_account">
			<div class="oneall_box_contents">
				<p class="oneall_buttons">
					<a class="button-secondary" href="https://app.oneall.com/signin/" target="_blank"><?php _e ('Access my OneAll Account', 'oa-social-sharing-icons'); ?></a>
					<a class="button-secondary" href="https://app.oneall.com/insights/sharing/" target="_blank"><?php _e ('View my Sharing Insights', 'oa-social-sharing-icons'); ?></a>
				</p>
			</div>
		</div>
			
		<?php 
			// Settings Updated
			if (!empty ($_REQUEST ['settings-updated']) AND strtolower ($_REQUEST ['settings-updated']) == 'true')
			{
				?>
					<div class="oneall_box oneall_box_updated">
						<div class="oneall_box_title">
							<?php _e ('Your modifications have successfully been saved', 'oa-social-sharing-icons'); ?>
						</div>
					</div>
				<?php
			}
		?>
			
		<form method="post" action="options.php" id="oneall_settings_form">
			<?php
				settings_fields ('oa_social_sharing_icons_settings_group');
			?>
			<div class="oneall_box oneall_box_config">
				<div class="oneall_box_title">
					<?php _e ('OneAll Config', 'oa-social-sharing-icons'); ?>
					<span class="oneall_pull_right">
						<a href="https://app.oneall.com/applications/" target="_blank"><?php _e ('View My API Credentials', 'oa_social_login'); ?></a>
					</span>
				</div>
				<div class="oneall_box_contents">
					<div class="oneall_form">
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">								
								<label for="oa_social_sharing_icons_settings_api_subdomain">
									<?php 
										_e ('OneAll Site Subdomain', 'oa-social-sharing-icons');
										$oneall_api_subdomain = $oa_social_sharing_icons_config->get_api_subdomain();
									?>
								</label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<input type="text" class="oneall_form_field" id="oa_social_sharing_icons_settings_api_subdomain" name="oa_social_sharing_icons_settings[api_subdomain]" size="65" value="<?php echo htmlspecialchars ($oneall_api_subdomain); ?>" />
								<p class="description"><?php _e ('You can find the subdomain in the API Settings of your site in your OneAll account.', 'oa-social-sharing-icons') ?></p>
							</div>								
						</div>
					</div>		
				</div>
			</div>				
			<div class="oneall_box oneall_box_config">
				<div class="oneall_box_title">
					<?php _e ('Sharing Icons Config', 'oa-social-sharing-icons'); ?>
				</div>
				<div class="oneall_box_contents">
					<div class="oneall_form">
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="oa_social_sharing_icons_settings_disable_og_tags">
									<?php 
										_e ('Open Graph OG Tags', 'oa-social-sharing-icons');
										$oneall_disable_og_tags = $oa_social_sharing_icons_config->get_disable_og_tags();
									?>
								</label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" id="oa_social_sharing_icons_settings_disable_og_tags" name="oa_social_sharing_icons_settings[disable_og_tags]">
									<option value="0"<?php echo (empty ($oneall_disable_og_tags) ? ' selected="selected"' :'');?>><?php _e ('Use Open Graph tags when sharing content'); ?></option>
									<option value="1"<?php echo ( ! empty ($oneall_disable_og_tags) ? ' selected="selected"' :'');?>><?php _e ('Do not use Open Graph tags when sharing content'); ?></option>																			
								</select>
								<p class="description"><?php _e ('If enabled, the <a href="https://developers.facebook.com/docs/sharing/webmasters" target="_blank">Open Graph</a> tags of your blog will be used when sharing content.', 'oa-social-sharing-icons');?></p>
							</div>
						</div>						
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="oa_social_sharing_icons_settings_button_text">
									<?php 
										_e ('Button Text', 'oa-social-sharing-icons');
										$oneall_button_text = $oa_social_sharing_icons_config->get_button_text ();
									?>
								</label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<input type="text" class="oneall_form_field" id="oa_social_sharing_icons_settings_button_text" name="oa_social_sharing_icons_settings[button_text]" size="65" value="<?php echo htmlspecialchars ($oneall_button_text); ?>" />								
								<p class="description"><?php _e ('<strong>%provider.name%</strong> is automatically replaced by the name of the social network.', 'oa-social-sharing-icons');?></p>
							</div>
						</div>	
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="oa_social_sharing_icons_settings_default_size">
									<?php 
										_e ('Default Button Design', 'oa-social-sharing-icons');
										$oneall_default_size = $oa_social_sharing_icons_config->get_default_size();									
									?>
								</label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" id="oa_social_sharing_icons_settings_default_size" name="oa_social_sharing_icons_settings[default_size]">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(false, 'default_size', array ('default_size' => $oneall_default_size)); ?>											
								</select>
								<p class="description"><?php _e ('This is the default design used to display the icons. The selected design is visible in the preview below.', 'oa-social-sharing-icons');?></p>
							</div>
						</div>		
						<div class="oneall_form_row">
							<label>Button Preview</label>
						</div>
						<div class="oneall_form_row">
							<div id="oneall_preview_outerbox">	
								<div id="oneall_preview_innerbox">
									<div id="oneall_preview_content">												
									</div> 
								</div>
							</div>
						</div>
						<div class="oneall_form_row">
							<p>
								<?php _e ('To enable a service drag&amp;drop it from <strong>Available Services</strong> to <strong>Enabled Services</strong>. You can also drag&amp;drop the elements to re-order the buttons.', 'oa-social-sharing-icons');?>
							</p>
						</div>
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_50">
								<div id="oneall_sharing_methods_left" class="oneall_sharing_methods">									
									<div class="oneall_sharing_methods_title">
										<?php										 
											_e ('Enabled Services', 'oa-social-sharing-icons');
											$oneall_enabled_methods = $oa_social_sharing_icons_config->get_enabled_methods();								
										?>
									</div>
									<div class="oneall_sharing_methods_contents oneall_sharing_methods_sortable" id="oneall_sharing_methods_selected">									
										<?php echo oa_social_sharing_icons_admin::render_methods_by_keys($oneall_enabled_methods); ?>											
									</div>							
								</div>	
							</div>
							<div class="oneall_form_col oneall_form_col_50">
								<div id="oneall_sharing_methods_right" class="oneall_sharing_methods">									
									<div class="oneall_sharing_methods_title">
										<?php 
											_e ('Available Services', 'oa-social-sharing-icons');
											$oneall_disabled_methods = $oa_social_sharing_icons_config->get_disabled_methods();
										?>
									</div>
									<div class="oneall_sharing_methods_contents oneall_sharing_methods_sortable" id="oneall_sharing_methods_available">									
										<?php 
											echo oa_social_sharing_icons_admin::render_methods_by_keys($oneall_disabled_methods);											 
										?>										
									</div>							
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="oneall_box oneall_box_config">
				<div class="oneall_box_title">
					<?php 
						_e ('Sharing Icons Locations', 'oa-social-sharing-icons'); 
						$oneall_positions = $oa_social_sharing_icons_config->get_positions();
					?>
				</div>
				<div class="oneall_box_contents">
					<div class="oneall_form oneall_form_desc">
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<?php _e ('Location', 'oa-social-sharing-icons'); ?>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<?php _e ('Select a button style or leave the corresponding field empty to disable the buttons.', 'oa-social-sharing-icons'); ?>
							</div>
						</div>
					</div>				
					<div class="oneall_form">						
						<div class="oneall_form_row">				
							
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_left_floating"><?php _e ('All Pages \ Floating Left', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								 <select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][left_floating]" id="position_left_floating">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'left_floating', $oneall_positions); ?>
								 </select>
							</div>
						</div>
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_right_floating"><?php _e ('All Pages \ Floating Right', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								 <select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][right_floating]" id="position_right_floating">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'right_floating', $oneall_positions); ?>
								 </select>
							</div>
						</div>					
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_dynamic_sidebar_before"><?php _e ('All Pages \ Sidebar Top', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][dynamic_sidebar_before]" id="position_dynamic_sidebar_before">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'dynamic_sidebar_before', $oneall_positions); ?>
								</select>
							</div>
						</div>
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_dynamic_sidebar_after"><?php _e ('All Pages \ Sidebar Bottom', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][dynamic_sidebar_after]" id="position_dynamic_sidebar_after">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'dynamic_sidebar_after', $oneall_positions); ?>
				 				</select>
							</div>
						</div>
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_header"><?php _e ('All Pages \ Blog Header', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][header]" id="position_header">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'header', $oneall_positions); ?>
								 </select>
							</div>
						</div>
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_footer"><?php _e ('All Pages \ Blog Footer', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][footer]" id="position_footer">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'footer', $oneall_positions); ?>
								 </select>
							</div>
						</div>	
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_credits"><?php _e ('All Pages \ Blog Credits', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][credits]" id="position_credits">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'credits', $oneall_positions); ?>
				 				</select>
							</div>
						</div>		
					</div>
					<div class="oneall_form">				
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_before_post_title"><?php _e ('Single Post \ Above Title', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][before_post_title]" id="position_before_post_title">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'before_post_title', $oneall_positions); ?>
								</select>
							</div>
						</div>
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_after_post_title"><?php _e ('Single Post \ Between Title And Text', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][after_post_title]" id="position_after_post_title">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'after_post_title', $oneall_positions); ?>
								</select>
							</div>
						</div>		
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_end_post"><?php _e ('Single Post \ Below Text', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][end_post]" id="position_end_post">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'end_post', $oneall_positions); ?>
								</select>
							</div>
						</div>							
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_comment_form_before"><?php _e ('Single Post \ Above Comments Form', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][comment_form_before]" id="position_comment_form_before">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'comment_form_before', $oneall_positions); ?>
								</select>
							</div>
						</div>
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_comment_form_after"><?php _e ('Single Post \ Below Comments Form', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								<select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][comment_form_after]" id="position_comment_form_after">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(true, 'comment_form_after', $oneall_positions); ?>
								</select>
							</div>
						</div>				
												
					</div>
				</div>
			</div>
			
			<div class="oneall_box oneall_box_config">
				<div class="oneall_box_title">
					<?php 
						_e ('Embed the icons using a shortcode', 'oa-social-sharing-icons'); 
						$oneall_positions = $oa_social_sharing_icons_config->get_positions();
					?>
				</div>
				<div class="oneall_box_contents">
					<div class="oneall_form">
						<div class="oneall_form_row">
						<?php 
							_e('You can embed the sharing icons by adding the code <code>[oa_social_sharing_icons]</code> to a post or page. Below you can select the design that should be used for icons embedded using the shortcode.');
						?>
						</div>
						<div class="oneall_form_row">
							<div class="oneall_form_col oneall_form_col_30">
								<label for="position_left_floating"><?php _e ('Shortcode Icons Design', 'oa-social-sharing-icons'); ?></label>
							</div>
							<div class="oneall_form_col oneall_form_col_70">
								 <select class="oneall_form_field" name="oa_social_sharing_icons_settings[positions][shortcode]" id="position_shortcode">
									<?php echo oa_social_sharing_icons_admin::print_select_position_options(false, 'shortcode', $oneall_positions); ?>
								 </select>
							</div>
						</div>				
					</div>
				</div>
			</div>
			
			<div class="oneall_form">
				<div class="oneall_form_row oneall_form_row_buttons">
					<input type="hidden" id="oneall_enabled_methods" name="oa_social_sharing_icons_settings[enabled_methods]">
					<input type="hidden" name="page" value="setup" />
					<input id="save_user_choice" type="submit" class="button-primary" value="<?php _e ('Save Settings', 'oa-social-sharing-icons') ?>" />						
				</div>
			</div>
		</form>
	</div>
</div>	
<script type="text/javascript">										
	function oneall_load_plugin_wizard () {
    	if (typeof window.oneall_plugin_wizard.init !== 'undefined') {
    		oneall_plugin_wizard.init ("<?php echo htmlspecialchars ($oneall_api_subdomain); ?>.api.oneall.com");
    	} else {
        	setTimeout(function() {oneall_load_plugin_wizard()}, 50);
		}
	}
	oneall_load_plugin_wizard();						
</script>