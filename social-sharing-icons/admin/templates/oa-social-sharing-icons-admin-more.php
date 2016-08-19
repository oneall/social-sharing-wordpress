<?php

/**
 * Social Sharing Icons Admin More
 * @link       http://www.oneall.com
 * @package    oa_social_sharing_icons
 */

// Plugin URL
$social_login_url = admin_url('plugin-install.php?s=oa_social_login&tab=search&type=term');


?>
<div class="wrap">
	<div id="oneall">
		<h2>OneAll Social Sharing Icons <?php echo $this->version; ?></h2>
	
		<div class="oneall_box oneall_box_help">
			<div class="oneall_box_title">
				<?php _e ('Information', 'oa-social-sharing-icons'); ?>
			</div>
			<div class="oneall_box_contents">
				<ul>
					<li>
						<?php printf (__ ('<a target="_blank" href="%s">Follow us on Twitter</a> to stay informed about updates;', 'oa-social-sharing-icons'), 'http://www.twitter.com/oneall'); ?>
					</li>			
					<li>
						<?php printf (__ ('<a target="_blank" href="%s">Contact us</a> if you have feedback or need assistance.', 'oa-social-sharing-icons'), 'http://www.oneall.com/company/contact-us/'); ?>
					</li>
					<li>
						<?php printf (__ ('We also have <a target="_blank" href="%s">turnkey plugins</a> for Drupal, PrestaShop, Joomla, phpBB andy many others ...', 'oa-social-sharing-icons'), 'http://docs.oneall.com/plugins/'); ?>
					</li>					
				</ul>
			</div>			
		</div>		
		<div class="oneall_box oneall_box_teaser">
			<div class="oneall_box_title">
				<?php _e ('OneAll Social Login', 'oa-social-sharing-icons'); ?>
				<span class="oneall_pull_right">
					<a href="<?php echo $social_login_url; ?>"><?php _e ('View Plugin Details', 'oa-social-sharing-icons'); ?></a>
				</span>
			</div>
			<div class="oneall_box_contents">
				<div class="oneall_box_section oneall_box_description">							
					<?php _e ('Allow your visitors to comment, login and register with 30+ social networks like for example Twitter, Facebook, Pinterest, Instagram, Paypal, LinkedIn, OpenID, VKontakte or Google+. Easy to use and 100% FREE.', 'oa-social-sharing-icons'); ?>
				</div>
				<div class="oneall_box_section">
					<a href="<?php echo $social_login_url; ?>">
						<img class="theme_tease" src="<?php echo plugin_dir_url( __FILE__ ) . '../img/teaser/social-login.png' ?>" alt="<?php _e ('Social Login', 'oa-social-sharing-icons') ?>" />
					</a>		
				</div>
			</div>
		</div>	
	</div>
</div>	
