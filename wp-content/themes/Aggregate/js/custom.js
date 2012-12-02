jQuery.noConflict();

jQuery(document).ready(function(){
	var et_disable_toptier = jQuery("meta[name=et_disable_toptier]").attr('content'),
		et_theme_folder = jQuery("meta[name=et_theme_folder]").attr('content'),
		$et_top_menu = jQuery('ul#top-menu > li > ul'),
		$et_secondary_menu = jQuery('ul#secondary-menu li ul');
		
	jQuery('ul.nav').superfish({ 
		delay:       300,                            // one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
		speed:       'fast',                          // faster animation speed 
		autoArrows:  true,                           // disable generation of arrow mark-up 
		dropShadows: false                            // disable drop shadows 
	});

	if ( $et_top_menu.length ){
		$et_top_menu.prepend('<li class="menu-gradient"></li>');
		jQuery('ul#top-menu li ul li').each(function(){
			if ( jQuery(this).prevAll().length == 0 && !jQuery(this).hasClass('menu-gradient') ) jQuery(this).addClass('first-item');
		});
	}

	if ( $et_secondary_menu.length ){
		$et_secondary_menu.find('>li:odd').addClass('even-item');
	}

	var $featured_content = jQuery('#featured #slides'),
		et_featured_slider_auto = jQuery("meta[name=et_featured_slider_auto]").attr('content'),
		et_featured_auto_speed = jQuery("meta[name=et_featured_auto_speed]").attr('content'),
		et_featured_slider_pause = jQuery("meta[name=et_featured_slider_pause]").attr('content');
	
	jQuery(window).load( function(){
		if ($featured_content.length){
			var $featured_controllers = jQuery('#controllers ul li'),
				$featured_controllers_links = $featured_controllers.find('a'),
				$et_active_arrow = jQuery('div#active_item'),
				et_featured_options = {
					timeout: 0,
					speed: 500,
					cleartypeNoBg: true,
					prev:   '#featured a#left-arrow', 
					next:   '#featured a#right-arrow',
					before: function (currSlideElement, nextSlideElement, options, forwardFlag) { 
						var $et_active_slide = jQuery(nextSlideElement),
							et_active_order = $et_active_slide.prevAll().length;
							
						$featured_controllers_links.removeClass('active').eq(et_active_order).addClass('active');
						
						$et_active_arrow.animate({"left": $featured_controllers.eq(et_active_order).find('div').position().left+37}, "slow");
					}
				}
				
			if ( et_featured_slider_auto == 1 ) et_featured_options.timeout = et_featured_auto_speed;
			if ( et_featured_slider_pause == 1 ) et_featured_options.pause = 1;
				
			$featured_content.cycle( et_featured_options );
			
			$featured_content.css('backgroundImage','none')
			if ( $featured_content.find('.slide').length == 1 ){
				$featured_content.find('.slide').css({'position':'absolute','top':'0','left':'0'}).show();
				jQuery('#featured a#left-arrow, #featured a#right-arrow').hide();
			}
				
			$featured_controllers_links.click(function(){
				et_ordernumber = jQuery(this).parent().parent('li').prevAll().length;
				$featured_content.cycle( et_ordernumber );
				return false;
			}).hover(function(){
				jQuery(this).fadeTo('fast',.7);
			}, function(){
				jQuery(this).fadeTo('fast',1);
			});
		}
	} );
		
	var $footer_widget = jQuery("#footer-widgets .footer-widget");
	if ( $footer_widget.length ) {
		$footer_widget.each(function (index, domEle) {
			if ((index+1)%4 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
		});
	}

	et_search_bar();

	function et_search_bar(){
		var $searchform = jQuery('#top-header div#search-form'),
			$searchinput = $searchform.find("input#searchinput"),
			searchvalue = $searchinput.val();
			
		$searchinput.focus(function(){
			if (jQuery(this).val() === searchvalue) jQuery(this).val("");
		}).blur(function(){
			if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
		});
	}

	if ( et_disable_toptier == 1 ) jQuery("ul.nav > li > ul").prev("a").attr("href","#");

	var $comment_form = jQuery('form#commentform');


	$comment_form.find('input:text, textarea').each(function(index,domEle){
		var $et_current_input = jQuery(domEle),
			$et_comment_label = $et_current_input.siblings('label'),
			et_comment_label_value = $et_current_input.siblings('label').text();
		if ( $et_comment_label.length ) {
			$et_comment_label.hide();
			if ( $et_current_input.siblings('span.required') ) { 
				et_comment_label_value += $et_current_input.siblings('span.required').text();
				$et_current_input.siblings('span.required').hide();
			}
			$et_current_input.val(et_comment_label_value);
		}
	}).live('focus',function(){
		var et_label_text = jQuery(this).siblings('label').text();
		if ( jQuery(this).siblings('span.required').length ) et_label_text += jQuery(this).siblings('span.required').text();
		if (jQuery(this).val() === et_label_text) jQuery(this).val("");
	}).live('blur',function(){
		var et_label_text = jQuery(this).siblings('label').text();
		if ( jQuery(this).siblings('span.required').length ) et_label_text += jQuery(this).siblings('span.required').text();
		if (jQuery(this).val() === "") jQuery(this).val( et_label_text );
	});

	$comment_form.find('input#submit').click(function(){
		if (jQuery("input#url").val() === jQuery("input#url").siblings('label').text()) jQuery("input#url").val("");
	});

	jQuery(function(){
		var $et_sidebar = jQuery('#sidebar'),
			$et_entries = jQuery('#entries');
		if ( $et_sidebar.length && ( $et_sidebar.height() > $et_entries.height() ) )
		$et_entries.css( 'height',$et_sidebar.height() - 58 );
	});
});