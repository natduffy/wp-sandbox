(function($){
	var $featured = $('#featured'),
		$controllers = $('#controllers'),
		$et_mobile_nav_button = $('#top-header .mobile_nav'),
		$et_nav = $('#top-header ul.nav'),
		et_container_width = $('.container').width(),
		et_featured_slider_auto, et_featured_auto_speed,
		et_slider;
	
	$(document).ready(function(){
		var et_slider_settings;
		
		$("#entries, .fslider_widget").fitVids();
	
		if ( $featured.length ){
			var $featured_controllers = jQuery('#controllers ul li'),
				$featured_controllers_links = $featured_controllers.find('a'),
				$et_active_arrow = jQuery('div#active_item');
			
			et_slider_settings = {
				slideshow: false,
				before: function(slider){		
					$featured_controllers_links.removeClass('active').eq( slider.animatingTo ).addClass('active');
					
					$et_active_arrow.animate({"left": $featured_controllers.eq( slider.animatingTo ).find('div').position().left+37}, "slow");
				},
				start: function(slider) {
					et_slider = slider;
				}
			}

			if ( $featured.hasClass('et_slider_auto') ) {
				var et_slider_autospeed_class_value = /et_slider_speed_(\d+)/g;
				
				et_slider_settings.slideshow = true;
				
				et_slider_autospeed = et_slider_autospeed_class_value.exec( $featured.attr('class') );
				
				et_slider_settings.slideshowSpeed = et_slider_autospeed[1];
			}
			
			et_slider_settings.pauseOnHover = true;
			
			$featured.flexslider( et_slider_settings );
		}
		
		$('.fslider_widget').flexslider( { slideshow: false } );
		
		jQuery('.fslider_widget iframe').each( function(){
			var src_attr = jQuery(this).attr('src'),
				wmode_character = src_attr.indexOf( '?' ) == -1 ? '?' : '&amp;',
				this_src = src_attr + wmode_character + 'wmode=opaque';
			jQuery(this).attr('src',this_src);
		} );
		
		et_duplicate_menu( $et_nav, $et_mobile_nav_button, 'mobile_menu', 'et_mobile_menu' );
		et_duplicate_menu( $('#second-menu ul.nav'), $('#second-menu .mobile_nav'), 'category_mobile_menu', 'et_mobile_menu' );
		
		function et_duplicate_menu( menu, append_to, menu_id, menu_class ){
			var $cloned_nav;
			
			menu.clone().attr('id',menu_id).removeClass().attr('class',menu_class).appendTo( append_to );
			$cloned_nav = append_to.find('> ul');
			$cloned_nav.find('li:first').addClass('et_first_mobile_item');
			
			append_to.click( function(){
				if ( $(this).hasClass('closed') ){
					$(this).removeClass( 'closed' ).addClass( 'opened' );
					$cloned_nav.slideDown( 500 );
				} else {
					$(this).removeClass( 'opened' ).addClass( 'closed' );
					$cloned_nav.slideUp( 500 );
				}
				return false;
			} );
			
			append_to.find('a').click( function(event){
				event.stopPropagation();
			} );
		}
		
		$(window).resize( function(){
			if ( et_container_width != $('.container').width() ) { 
				et_container_width = $('.container').width();
				
				if ( ! $featured.is(':visible') ) et_slider.pause();
			}
		});
	});
	
	$(window).load(function(){
		var $flexcontrol = $('#featured .flex-control-nav'),
			$flexnav = $('#featured .flex-direction-nav');
		
		$controllers.find('a').click( function(){
			var $this_control = $(this),
				order = $this_control.closest('li').prevAll('li').length;
			
			if ( $this_control.hasClass('active-slide') ) return;
			
			et_slider.flexAnimate( order, et_slider.vars.pauseOnAction );

			return false;
		} );
	});
})(jQuery)