/* Wizard */
var plugin_wizard = {};

/* Sharing Wizard */
plugin_wizard.social_sharing = {
	application_domain : ''
};
	
jQuery(document).ready(function($) {

	/* Sharing Wizard: Initialise */
	plugin_wizard.social_sharing.init = function(application_domain) {

		var library_code, oldList, newList, item, thiz, val, elm;
		thiz = this;

		/* Setup application domain */
		this.application_domain = application_domain;

		/* Setup sortable lists */
		$('.sortable').sortable({
		  items : 'div',
		  handle : '.name',
		  
		  start : function(event, ui) {
			  item = ui.item;
			  newList = oldList = ui.item.parent();
		  },
		  	  
		  stop : function(event, ui) {
		  	
			  if (newList.attr('id') == 'sharing_methods_addons' && !item.hasClass('sharing_method_addon')) {
				  $('#sharing_methods_services').append(item);
			  }

			  generate_preview();
			  thiz.trigger_refresh_preview();
		  },
		  
		  change : function(event, ui) {
			  if (ui.sender) {
				  newList = ui.placeholder.parent();
			  }
		  },
		  connectWith : ".sortable"
		}).disableSelection();

		/* OnClick Element Moving */
		$('.mover').click(function() {
			var sharing_method = $(this).parent();
			if (sharing_method.parent().attr('id') == 'sharing_methods_addons_services') {
				$('#sharing_methods_services').append(sharing_method);
			} else {
				$('#sharing_methods_addons_services').append(sharing_method);
			}

			generate_preview();
			thiz.trigger_refresh_preview();
		});
		
		/* Layout Changes */
		$('.layout_button').click(function()  {
			generate_preview();
			thiz.trigger_refresh_preview();
		});	

		/* Refresh preview */
		this.trigger_refresh_preview();
	};

	/* Setup a default value for an input field */
	plugin_wizard.social_sharing.set_input_default = function (elm, val){
		var that = this;
		
		elm.val(val);
		elm.addClass('default');	
		elm.keypress(function() {
			that.trigger_refresh_preview ();
		});	
		elm.click(function() {
			if ($(this).val() == val) {
				$(this).val('');
				elm.removeClass('default');
			}
		});	  	
	};

	/* Schedule a refresh the preview */
	plugin_wizard.social_sharing.trigger_refresh_preview = function() {
		clearTimeout($.data(this, 'timer'));
		var that = this;
		var wait = setTimeout(function() {
			that.refresh_preview();
		}, 500);
		$(this).data('timer', wait);
	};

	/* Do refresh the preview */
	plugin_wizard.social_sharing.refresh_preview = function() {

		/* Reset scroll position */
		$('.preview_outerbox').scrollTop(0);
		$('.preview_outerbox').scrollLeft(0);

		/* Refresh preview iFrame */
		$('#preview_container > iframe').attr('src', function(i, val) {
			return val;
		});

		window._oneall.push(['social_sharing', 'do_init']);
	};


});


//generate wizard preview
function generate_preview(){
	var val, elm, opt_button_title, html_button_title, html_button_key, html_layout, html_sharing_code, html_sharing_sharing_code_attributes, i, valid_layouts;
	
	/* Valid layouts */
	valid_layouts = ['btns_s', 'btns_m', 'btns_l','count_v', 'count_h'];
	
	/* Default layout */
	html_layout = 'btns_m';
					
	/* Check selected layout */
	elm = jQuery('input[name=layout_type]:checked', window.parent.document);
	val = elm.val();				
	for (i = 0; i < valid_layouts.length; i = i + 1) {
		if (val === valid_layouts[i]){
			html_layout = val;
		}				
	}			
	
	/* Build code */	
	html_sharing_code = "<div class=\"oas_box oas_box_"+html_layout+"\">\n";	
	
	jQuery('#sharing_methods_addons_services', window.parent.document).children('.sharing_method').each(function() {				
		
		html_button_key = jQuery(this).attr('data-key');				

		html_button_title = ' title="Send to '+jQuery(this).attr('data-name-button')+'"';
		
		html_sharing_code = html_sharing_code + ' <span class="oas_btn oas_btn_' + html_button_key + '"'+html_button_title+"></span>\n";
	});
	html_sharing_code = html_sharing_code + "</div>";		
	
	/* Update preview */
	jQuery('#preview').html(html_sharing_code);
	
	/* Add result to parent code boxes */			
	jQuery('#plugin_code', window.parent.document).val(html_sharing_code);
}




//save user final choice
function save_final_choice(){

	var val, elm, html_button_title, html_button_key, html_layout, i, valid_layouts;

	var final_data = {};
	
	/* Valid layouts */
	valid_layouts = ['btns_s', 'btns_m', 'btns_l','count_v', 'count_h'];
	
	/* Default layout */
	default_size = 'btns_m';
					
	/* Get default size*/
	elm = jQuery('input[name=layout_type]:checked', window.parent.document);
	val = elm.val();				
	for (i = 0; i < valid_layouts.length; i = i + 1) {
		if (val === valid_layouts[i]){
			default_size = val;
		}				
	}			
	final_data.default_size = default_size;


	//save methods chose by the user
	final_data.methods = [];
	jQuery('#sharing_methods_addons_services', window.parent.document).children('.sharing_method').each(function() {				
		html_button_key   = jQuery(this).attr('data-key');				
		html_button_title = jQuery(this).attr('data-name-button');

		var button = {'key':html_button_key, 'title':html_button_title};
		final_data.methods.push(button);
	});

	//save buttons position & size
	jQuery('select.hook_position').each(function(){
		var position_id = jQuery(this).prop('id');
		// var position_size = (jQuery(this).val() == 'default') ? default_size : jQuery(this).val();
		var position_size = jQuery(this).val();
		final_data[position_id] = position_size;
	});

	return final_data;
}