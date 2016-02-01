<?php

/**
 * Social Sharing Icons admin wizard
 *
 * @link       http://www.oneall.com
 * @package    oa_social_sharing_icons
 * @subpackage oa_social_sharing_icons/admin
 */

//get all services and addons
$oa_social_sharing_icons_admin_methods = new oa_social_sharing_icons_admin_methods();
$oa_social_sharing_icons_selected = $oa_social_sharing_icons_admin_methods->get_selected_methods();
$oa_social_sharing_icons_services = $oa_social_sharing_icons_admin_methods->get_methods_by_type('service');
$oa_social_sharing_icons_addons = $oa_social_sharing_icons_admin_methods->get_methods_by_type('addon');

//check if there is a choice in database
$settings = get_option ('oa_social_sharing_icons_settings');
$form_value = json_decode($settings['wizard_final_choice']);
?>

<div class="oa_social_sharing_icons_page">
	<div class="block">
		<div class="inner_border">	
			<div class="contents">	
				<div class="wizard">
					<div class="group">
						<div class="header">
							<?php _e ('Build your Social Sharing Icons', 'oa-social-sharing-icons');?> 				
						</div>
						<div class="body">					
							<div class="row">						
								<div class="section">
									<div class="description">
										<p>
											<?php _e ('Add this plugin to your website to allow your users to share comments, purchases and other activities	directly from your website to their friends 
											on multiple social networks.', 'oa-social-sharing-icons');?> 
										</p>

										<p >
											<?php _e ('You can simply drag&amp;drop from <strong>Available Services/Add-ons</strong> 
											to <strong>Selected Services &amp; Add-ons</strong> and vice versa. 
											You can also drag&amp;drop the elements to change the order of the buttons.', 'oa-social-sharing-icons');?>
										</p>
									</div>	
									<div class="caption">
										<?php _e ('Preview', 'oa-social-sharing-icons');?>
									</div>						
									<div class="preview_outerbox">	
										<div class="preview_innerbox">
											<div id="preview">												
											</div> 
										</div>
									</div>
								</div>
							</div>						
							
							<div class="row">	
								<div class="section">
									<div class="caption">
										<?php _e ('Choose the default button type to use:', 'oa-social-sharing-icons');?>
									</div>								
									<div class="input square">
										<div class="border layout_button">
											<div class="option">
												<input type="radio" name="layout_type" value="btns_s" id="layout_type_small_buttons" 
												<?php echo ($form_value->default_size=='btns_s') ? 'checked="checked"' : ''; ?> /> 
											</div>
											<label for="layout_type_small_buttons"><?php _e ('Small', 'oa-social-sharing-icons');?></label>
										</div>
									</div>								
									
									<div class="input square">
										<div class="border layout_button">
											<div class="option">
												<input type="radio" name="layout_type" value="btns_m" id="layout_type_medium_buttons" 
												<?php echo ($form_value->default_size=='btns_m') ? 'checked="checked"' : ''; ?> /> 
											</div>
											<label for="layout_type_medium_buttons"><?php _e ('Medium', 'oa-social-sharing-icons');?></label>
										</div>
									</div>	
									
									<div class="input square">
										<div class="border layout_button">
											<div class="option">
												<input type="radio" name="layout_type" value="btns_l" id="layout_type_large_buttons" 
												<?php echo ($form_value->default_size=='btns_l') ? 'checked="checked"' : ''; ?> /> 
											</div>
											<label for="layout_type_large_buttons"><?php _e ('Large', 'oa-social-sharing-icons');?></label>
										</div>
									</div>					
																	
									<div class="input square">
										<div class="border layout_button">
											<div class="option">
												<input type="radio" name="layout_type" value="count_h" id="layout_type_horizontal_counters" 
												<?php echo ($form_value->default_size=='count_h') ? 'checked="checked"' : ''; ?> /> 
											</div>
											<label for="layout_type_horizontal_counters"><?php _e ('Horizontal', 'oa-social-sharing-icons');?></label>
										</div>
									</div>											
													
									<div class="input square">
										<div class="border layout_button">
											<div class="option">
												<input type="radio" name="layout_type" value="count_v" id="layout_type_vertical_counters" 
												<?php echo ($form_value->default_size=='count_v') ? 'checked="checked"' : ''; ?> /> 
											</div>
											<label for="layout_type_vertical_counters"><?php _e ('Vertical', 'oa-social-sharing-icons');?></label>
										</div>
									</div>	
								</div>							
							</div>
						
							<div class="row">							
								<div class="section">
									<div class="caption">
										<?php _e ('Choose the sharing Add-ons and Services to use:', 'oa-social-sharing-icons');?>
									</div>
									<div id="sharing_methods_selector">
									
										<div id="sharing_methods_selected" class="sharing_methods">	
											<div class="container_oa">
												<div class="container_title">
													<?php _e ('Selected Services &amp; Add-ons', 'oa-social-sharing-icons');?>
												</div>
												<div id="sharing_methods_addons_services" class="container_body sortable">
													<?php echo oa_social_sharing_icons_admin_methods::render_methods($oa_social_sharing_icons_selected); ?>											
												</div>																				
											</div>										
										</div>	
										<div id="sharing_methods_available" class="sharing_methods">
											<div class="container_oa" >
												<div class="container_title">
													<?php _e ('Available Services', 'oa-social-sharing-icons');?>
												</div>
												<div id="sharing_methods_services" class="container_body sortable">
													<?php echo oa_social_sharing_icons_admin_methods::render_methods($oa_social_sharing_icons_services); ?>
													<?php echo oa_social_sharing_icons_admin_methods::render_methods($oa_social_sharing_icons_addons); ?>										
												</div>																		
											</div>					
										</div>
									</div>
								</div>	
							</div>					
								
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		

	<table class="form-table oa_social_sharing_icons_table">
		<tr class="row_head">
			<th colspan="2">
				<?php _e ('Plugin Position', 'oa-social-sharing-icons'); ?>
			</th>
		</tr>
		<tr class="row_even">
			<td class="title">
				<label for="position_left_floating"><?php _e ('Left floating (all pages)', 'oa-social-sharing-icons'); ?></label>
			</td>
			<td>
				 <select class="hook_position" name="oa_social_sharing_icons_settings[position_left_floating]" id="position_left_floating">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options( $form_value->position_left_floating ); ?>
				 </select>
			</td>
		</tr>
		<tr class="row_odd">
			<td class="title">
				<label for="position_right_floating"><?php _e ('Right floating (all pages)', 'oa-social-sharing-icons'); ?></label>
			</td>
			<td>
				 <select class="hook_position" name="oa_social_sharing_icons_settings[position_right_floating]" id="position_right_floating">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options( $form_value->position_right_floating ); ?>
				 </select>
			</td>
		</tr>
		<tr class="row_even">
			<td class="title">
				<label for="position_header"><?php _e ('Blog header', 'oa-social-sharing-icons'); ?></label>
			</td>
			<td>
				 <select class="hook_position" name="oa_social_sharing_icons_settings[position_header]" id="position_header">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options( $form_value->position_header ); ?>
				 </select>
			</td>
		</tr>
		<tr class="row_odd">
			<td class="title">
				<label for="position_footer"><?php _e ('Blog footer', 'oa-social-sharing-icons'); ?></label>
			</td>
			<td>
				 <select class="hook_position" name="oa_social_sharing_icons_settings[position_footer]" id="position_footer">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options( $form_value->position_footer ); ?>
				 </select>
			</td>
		</tr>
		<tr class="row_even">
			<td class="title">
				<label for="position_end_post"><?php _e ('After each post', 'oa-social-sharing-icons'); ?></label>
			</td>
			<td>
				 <select class="hook_position" name="oa_social_sharing_icons_settings[position_end_post]" id="position_end_post">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options( $form_value->position_end_post ); ?>
				 </select>
			</td>
		</tr>
		<tr class="row_odd">
			<td class="title">
				<label for="position_dynamic_sidebar_before"><?php _e ('Before sidebar', 'oa-social-sharing-icons'); ?></label>
			</td>
			<td>
				 <select class="hook_position" name="oa_social_sharing_icons_settings[position_dynamic_sidebar_before]" id="position_dynamic_sidebar_before">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options( $form_value->position_dynamic_sidebar_before ); ?>
				 </select>
			</td>
		</tr>
		<tr class="row_even">
			<td class="title">
				<label for="position_dynamic_sidebar_after"><?php _e ('After sidebar', 'oa-social-sharing-icons'); ?></label>
			</td>
			<td>
				 <select class="hook_position" name="oa_social_sharing_icons_settings[position_dynamic_sidebar_after]" id="position_dynamic_sidebar_after">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options( $form_value->position_dynamic_sidebar_after ); ?>
				 </select>
			</td>
		</tr>
		<tr class="row_odd">
			<td class="title">
				<label for="position_credits"><?php _e ('WordPress credits', 'oa-social-sharing-icons'); ?></label>
			</td>
			<td>
				 <select class="hook_position" name="oa_social_sharing_icons_settings[position_credits]" id="position_credits">
					<?php echo oa_social_sharing_icons_admin::print_select_position_options( $form_value->position_credits ); ?>
				 </select>
			</td>
		</tr>
	</table>
</div>