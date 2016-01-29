
		<p class="submit">
			<input type="hidden" id="wizard_final_choice" name="oa_social_sharing_icons_settings[wizard_final_choice]">
			<input type="hidden" name="page" value="setup" />
			<input id="save_user_choice" type="submit" class="button-primary" value="<?php _e ('Save Changes', 'oa-social-sharing-icons') ?>" />
		</p>


		<script type="text/javascript">
			jQuery(document).ready(function() {
				plugin_wizard.social_sharing.init ("<?php echo $api_subdomain.'.api.oneall.io';?>");
				generate_preview();
			 });

			jQuery('#save_user_choice').on('click', function(){
				var wizard_final_choice = save_final_choice();
				jQuery('#wizard_final_choice').val(JSON.stringify( wizard_final_choice ));
			});

			jQuery('#oa_social_sharing_icons_box_help').on('click', function(){
				jQuery('#oa_social_sharing_icons_box_help').toggleClass('active');
				jQuery('.dashicons-plus-alt').toggle();
				jQuery('.dashicons-dismiss').toggle();
			});

		</script>

	</div>
</form>