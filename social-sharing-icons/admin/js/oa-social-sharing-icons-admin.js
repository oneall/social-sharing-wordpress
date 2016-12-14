/* Wizard */
var oneall_plugin_wizard = {};

jQuery(document).ready(function($) {
	
	/* Sharing Wizard */
	oneall_plugin_wizard = {
		application_domain : ''
	};
	
	/* Sort the available services */
	oneall_plugin_wizard.sort = function () {
		$('#oneall_sharing_methods_available .oneall_sharing_method').sort(function (a, b) {
			var o1, o2;			
			o1 = parseInt ($(a).data('order'));
			o2 = parseInt( $(b).data('order'));			
			return ((o1 < o2) ? -1 : (o1 > o2) ? 1 : 0);
		}).appendTo($("#oneall_sharing_methods_available"));
	};
	
	/* Sharing Wizard: Initialise */
	oneall_plugin_wizard.init = function(application_domain) {
		var old_list, new_list, item, thiz, val, elm;
		
		thiz = this;

		/* Setup application domain */
		this.application_domain = application_domain;

		/* Form Saving */
		 $('#oneall_settings_form').submit(function () {
			/* Loop through selection */	
			jQuery('#oneall_sharing_methods_selected').children('.oneall_sharing_method').each(function() {	
				$('<input>').attr('type','hidden').attr ('name', 'oa_social_sharing_icons_settings[enabled_methods_keys][' + jQuery(this).attr('data-key') + ']').appendTo('#oneall_settings_form');
			});
		 });
		 
		/* Sortable Elements */
		$('.oneall_sharing_methods_sortable').sortable({
			items : 'div.oneall_sharing_method',		  
			start : function(event, ui) {
				item = ui.item;
				new_list = old_list = ui.item.parent();
			},		  	  
			stop : function(event, ui) {	
				thiz.sort ();
				thiz.trigger_refresh_preview();
			},		  
			change : function(event, ui) {
				if (ui.sender) {
					new_list = ui.placeholder.parent();
				}
			},
			connectWith : ".oneall_sharing_methods_sortable"
		}).disableSelection();

		/* OnClick Element Moving */
		$('.oneall_sharing_method_mover').click(function() {
			var sharing_method = $(this).parent();
			if (sharing_method.parent().attr('id') == 'oneall_sharing_methods_selected') {
				$('#oneall_sharing_methods_available').append(sharing_method);				
			} else {
				$('#oneall_sharing_methods_selected').append(sharing_method);
			}		
			thiz.sort ();			
			thiz.trigger_refresh_preview();
		});
		
		/* Default Button Design */
		$("#oa_social_sharing_icons_settings_default_size").bind("change keydown", function() {
			thiz.trigger_refresh_preview();
		});
		
		/* Button Text */	
		$("#oa_social_sharing_icons_settings_button_text").keypress(function() {
			thiz.trigger_refresh_preview();
		});

		/* Refresh preview */
		this.trigger_refresh_preview();
	};

	/* Schedule a refresh of the preview */
	oneall_plugin_wizard.trigger_refresh_preview = function() {
		var that, wait;
		
		clearTimeout($.data(this, 'timer'));
		that = this;
		wait = setTimeout(function() {
			that.refresh_preview();
		}, 500);
		$(this).data('timer', wait);
	};

	/* Refresh the preview */
	oneall_plugin_wizard.refresh_preview = function() {
		
		var val, i, j, button_text, button_provider_text, button_provider_key, button_provider_name, button_class, html_code, valid_layouts;
		
		/* Button Text */
		val = jQuery("#oa_social_sharing_icons_settings_button_text").val();	
		if (typeof val === undefined || val.length === 0) {
			button_text = '%provider.name%';
		} else {	
			button_text = val.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
		}
		
		/* All Layouts */
		valid_layouts = ["btns_lfnm", "btns_lfnm_g", "btns_lfnm_b", "btns_s", "btns_m", "btns_l", "count_h", "count_v", "btns_hf", "btns_hf_b", "btns_hf_g", "btns_hf_count", "btns_hf_b_count", "btns_hf_g_count", "btns_hfrr", "btns_hfrr_b", "btns_hfrr_g", "btns_hfrr_count", "btns_hfrr_b_count", "btns_hfrr_g_count", "btns_lf", "btns_lf_b", "btns_lf_g", "btns_lf_count", "btns_lf_b_count", "btns_lf_g_count", "btns_lfr", "btns_lfr_b", "btns_lfr_g", "btns_lfrr", "btns_lfrr_b", "btns_lfrr_g", "btns_lfrr_count", "btns_lfrr_b_count", "btns_lfrr_g_count"];

		/* Default Button Design */
		button_class = valid_layouts[0];
		
		val = jQuery('#oa_social_sharing_icons_settings_default_size').val();				
		for (i = 0, j = valid_layouts.length; i < j; i = i + 1) {
			if (val === valid_layouts[i]) {
				button_class = val;
			}				
		}			
		
		/* Build code */	
		html_code = '<div class="oas_box oas_box_' + button_class + '" data-force-refresh="true">';	
		
		/* Selected Methods */	
		jQuery('#oneall_sharing_methods_selected').children('.oneall_sharing_method').each(function() {	
		
			/* Button Provider Key */
			button_provider_key = jQuery(this).attr('data-key');	
			
			/* Button Provider Name */
			button_provider_name = jQuery(this).attr('data-name');	
			
			/* Button Text */
			if (button_provider_key == 'email') {
				button_provider_text = button_provider_name;
			} else {
				if (button_provider_key == 'counter') {
					button_provider_text = '';
				} else {
					button_provider_text = button_text;
					button_provider_text = button_provider_text.replace ('%provider.name%', button_provider_name);
				}
			}

			/* Add Provider to HTML */
			html_code = html_code + ' <span class="oas_btn oas_btn_' + button_provider_key + '" title="' + button_provider_text + '"></span>';
		});
		
		html_code = html_code + "</div>";		
		
		/* Update preview */
		jQuery('#oneall_preview_content').html(html_code);
			
		/* Reset Preview Position */
		jQuery('#oneall_preview_outerbox').scrollTop(0).scrollLeft(0);
		
		/* Refresh Preview */
		var _oneall = window._oneall || [];
		window._oneall.push(['social_sharing', 'do_init']);		
	};
});