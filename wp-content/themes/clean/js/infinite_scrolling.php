<?php $infinite_scrolling = of_get_option('ttrust_infinite_scrolling'); ?>

<?php if($infinite_scrolling != "disabled") : ?>

<script type="text/javascript">
//<![CDATA[

jQuery(window).load(function(){	
	
	jQuery('#content .posts').infinitescroll({
		debug: false,
		navSelector  : "div.pagination",	                   
		nextSelector : "div.pagination a:first",	                  
		itemSelector : "#content div.post",		
		behavior : "twitter",		
		loading: {
			finishedMsg: "<?php _e('Nothing to load.','themetrust'); ?>",
			img: "",
			msgText: "<?php _e('Loading...','themetrust'); ?>"
		},
		errorCallback: function() {		
			jQuery('.infscrBtn').animate({opacity: 0.8},2000).fadeOut('normal');
		}},
			// call Isotope as a callback
		function( newElements ) {
			var newElems = jQuery(newElements).css({ opacity: 0 });
			
			newElems.imagesLoaded(function(){
				jQuery('.posts').isotope( 'appended', newElems );
				lightboxInit();
				projectThumbInit();
			});
			jQuery('.infscrBtn span').text("Load More"); 	
		}
	);
	
<?php if($infinite_scrolling == "enabled_with_button") : ?>
	jQuery(window).unbind('.infscr');
	
	jQuery('.post').css("display: none;");
	
	// hook up the manual click.
	jQuery('.infscrBtn').click(function(){
		jQuery('#content .posts').infinitescroll('retrieve');
		jQuery('.infscrBtn span').text("<?php _e('Loading...','themetrust'); ?>"); 		   
	});	
	
<?php endif; ?>
	
});

//]]>
</script>

<?php endif; ?>