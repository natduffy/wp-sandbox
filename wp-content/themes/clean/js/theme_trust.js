//////////////////////////////////////////////////////////////
// Set Variables
/////////////////////////////////////////////////////////////

var transitionSpeed = 500;
var hasSlideshow = false;


///////////////////////////////		
// IE7 Superfish Fix
///////////////////////////////
function fixIE7Supperfish(){
	if (jQuery.browser.msie  && parseInt(jQuery.browser.version) == 7) {
		jQuery(function() {
	    	var zIndexNumber = 1000;
	    	jQuery('div').each(function() {
	        	jQuery(this).css('zIndex', zIndexNumber);
	        	zIndexNumber -= 10;
	    	});
		});
	}
}
	
///////////////////////////////		
// iPad and iPod Detection
///////////////////////////////
	
function isiPad(){
    return (navigator.platform.indexOf("iPad") != -1);
}

function isiPhone(){
    return (
        //Detect iPhone
        (navigator.platform.indexOf("iPhone") != -1) || 
        //Detect iPod
        (navigator.platform.indexOf("iPod") != -1)
    );
}


///////////////////////////////		
// Isotope Browser Check
///////////////////////////////

function isotopeAnimationEngine(){
	if(jQuery.browser.mozilla){
		return "jquery";
	}else{
		return "css";
	}
}

function projectThumbInit() {
	
	if(!isiPad() && !isiPhone()) {
		jQuery(".post.small a.thumb").hover(
			function() {				
				jQuery(this).find('.lbIndicator').stop().fadeTo("fast", 1);					
			},
			function() {				
				jQuery(this).find('.lbIndicator').stop().fadeTo("fast", 0);					
		});	
	}	
}

///////////////////////////////		
// Lightbox
///////////////////////////////	

function lightboxInit() {
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false,
		deeplinking: false
	});
}

	
jQuery.noConflict();
jQuery(window).load(function(){
	
	lightboxInit();
	projectThumbInit()	
	
	jQuery('#content .posts').isotope({
		// options
		itemSelector : '#content .post',			
		hiddenStyle : {
		    opacity: 0,
		    scale : 1
		}
		
	});
	fixIE7Supperfish();	
});


