<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.oneall.com
 * @since      1.0.0
 *
 * @package    oa_social_sharing_icons
 * @subpackage oa_social_sharing_icons/admin/templates
 */

$settings_login = get_option ('oa_social_login_settings');

//get subdomain
$api_subdomain = '';
if (!$this->config->get_user_subdomain()){
	if (!empty($settings_login['api_subdomain'])) {
		$api_subdomain = $settings_login['api_subdomain'];
	}
} else {
	$api_subdomain = $this->config->get_user_subdomain();
}

?>

<form method="post" action="options.php">
	<?php
		settings_fields ('oa_social_sharing_icons_settings_group');
		$settings = get_option ('oa_social_sharing_icons_settings');
	?>

	<div class="wrap">
		<div class="oa_social_sharing_icons_page oa_social_sharing_icons_setup">
			<h2>OneAll Social Sharing Icons <?php echo $this->version; ?></h2>

			<div class="oa_social_sharing_icons_box" id="oa_social_sharing_icons_box_help">
				<div class="oa_social_sharing_icons_box_title">
					<span class="dashicons dashicons-plus-alt"></span> <span class="dashicons dashicons-dismiss" style="display: none;"></span> <?php _e ('Help, Updates &amp; Documentation', 'oa-social-sharing-icons'); ?>
				</div>
				<ul id="oa_social_sharing_icons_box_help_detail">
					<li><?php printf (__ ('<a target="_blank" href="%s">Follow us on Twitter</a> to stay informed about updates', 'oa-social-sharing-icons'), 'http://www.twitter.com/oneall'); ?>;</li>
					<li><?php printf (__ ('Feel free to <a target="_blank" href="%s">get in touch</a> if you have any questions', 'oa-social-sharing-icons'), 'http://support.oneall.com/forums/'); ?>;</li>
					<li><?php printf (__ ('<a target="_blank" href="%s">Contact us</a> if you have feedback or need assistance', 'oa-social-sharing-icons'), 'http://www.oneall.com/company/contact-us/'); ?>.
					<li><?php printf (__ ('Let your visitors comment, login and register with 30+ Social Networks with our <a target="_blank" href="%s">Social Login plugin</a>!', 'oa-social-sharing-icons'), 'https://wordpress.org/plugins/oa-social-login/'); ?>.
					</li>
				</ul>
			</div>

			<?php
				//settings updated
				if (empty ($settings) )
				{
					?>
					<div class="oa_social_sharing_icons_box" id="oa_social_sharing_icons_box_status">
						<div class="oa_social_sharing_icons_box_title">
							<?php _e ('Get Started!', 'oa-social-sharing-icons'); ?>
						</div>
						<p>
							<?php printf (__ ('To be able to use this plugin you first of all need to create a free account at %s and setup a Site.', 'oa-social-sharing-icons'), '<a href="https://app.oneall.com/signup/wp" target="_blank">http://www.oneall.com</a>'); ?>
							<?php _e ('After having created your account and setup your Site, please enter the Site settings in the form below.', 'oa-social-sharing-icons'); ?>
							<?php _e ("Don't worry the setup takes only a couple of minutes!", 'oa-social-sharing-icons'); ?>
						</p>
						<p>
							<a class="button-secondary" href="https://app.oneall.com/signup/wp" target="_blank"><strong><?php _e ('Click here to setup your free account', 'oa-social-sharing-icons'); ?></strong></a>
						</p>
						<h3>
							<?php printf (__ ('You are in good company! This plugin is used on more than %s websites!', 'oa-social-sharing-icons'), '250,000'); ?>
						</h3>
					</div>
					<?php
				}


				//settings updated
				if (!empty ($_REQUEST ['settings-updated']) AND strtolower ($_REQUEST ['settings-updated']) == 'true')
				{
					?>
						<div class="oa_social_sharing_icons_box" id="oa_social_sharing_icons_box_updated">
							<?php _e ('Your modifications have been saved successfully!', 'oa-social-sharing-icons'); ?>
						</div>
					<?php
				}

				//user uses social login plugin but didn't specified a subdomain for sharing plugin
				if (!$this->config->get_user_subdomain()){	
					if (!empty($settings_login['api_subdomain'])) {
					?>
						<div class="oa_social_sharing_icons_box" id="oa_social_sharing_icons_box_status">
							<?php _e ('The subdomain showed is the one you used in the Social Login wordpress plugin. Please save this subdomain or enter a valid new one.', 'oa-social-sharing-icons'); ?>
						</div>
					<?php
					}
				}

				// User don't use the same subdomain used in social login plugin 
				if ($this->config->existing_social_login_config() && !$this->config->is_same_subdomain_social_login() && !empty($settings) && is_plugin_active( 'oa-social-login/oa-social-login.php' )){	
					?>
						<div class="oa_social_sharing_icons_box" id="oa_social_sharing_icons_box_status">
							<?php _e ('You specified a different subdomain in social login plugin. Is it correct ?', 'oa-social-sharing-icons'); ?>
						</div>
					<?php
				}
			?>
			<table class="form-table oa_social_sharing_icons_table">
				<tr class="row_head">
					<th>
						<?php _e ('Enter your API Settings', 'oa-social-sharing-icons'); ?>
					</th>
					<th><a href="https://app.oneall.com/applications/" target="_blank"><?php _e ('Click here to create and view your API Credentials', 'oa-social-sharing-icons'); ?></a>
					</th>
				</tr>
				<tr class="row_even">
					<td class="title">
						<label for="oa_social_sharing_icons_settings_api_subdomain"><?php _e ('API Subdomain', 'oa-social-sharing-icons'); ?>:</label>
					</td>
					<td>
						<input type="text" id="oa_social_sharing_icons_settings_api_subdomain" name="oa_social_sharing_icons_settings[api_subdomain]" size="65" value="<?php echo htmlspecialchars ($api_subdomain); ?>" />
					</td>
				</tr>
			</table>			
		</div>