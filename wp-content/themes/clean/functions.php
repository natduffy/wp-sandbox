<?php
  
// Load main options panel file  
if ( !function_exists( 'optionsframework_init' ) ) {
	define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}

// Enable translation
// Translations can be put in the /languages/ directory
load_theme_textdomain( 'themetrust', TEMPLATEPATH . '/languages' );

// Widgets
require_once (TEMPLATEPATH . '/admin/widgets.php');

// Multiple Featured Images
require_once (TEMPLATEPATH . '/admin/multiple_featured_images.php');



//////////////////////////////////////////////////////////////
// Theme Header
/////////////////////////////////////////////////////////////
	
add_action('wp_enqueue_scripts', 'ttrust_scripts');

function ttrust_scripts() {

	wp_enqueue_script('jquery');
	
	wp_enqueue_script('superfish', get_bloginfo('template_url').'/js/superfish.js', array('jquery'), '1.4.8', true);	
	wp_enqueue_style('superfish', get_bloginfo('template_url').'/css/superfish.css', false, '1.4.8', 'all' );	
	
	if(is_active_widget(false,'','ttrust_flickr')) :	
    	wp_enqueue_script('flickrfeed', get_bloginfo('template_url').'/js/jflickrfeed.js', array('jquery'), '0.8', true);
	endif;
	
	if(is_active_widget(false,'','ttrust_twitter')) :	
    	wp_enqueue_script('jquery_twitter', get_bloginfo('template_url').'/js/jquery.twitter.js', array('jquery'), '1.5', true);
	endif;		

	wp_enqueue_script('pretty_photo', get_bloginfo('template_url').'/js/jquery.prettyPhoto.js', array('jquery'), '3.1.2', true);
	wp_enqueue_style('pretty_photo', get_bloginfo('template_url').'/css/prettyPhoto.css', false, '3.1.2', 'all' );	
	
	wp_enqueue_script('isotope', get_bloginfo('template_url').'/js/jquery.isotope.min.js', array('jquery'), '1.3.110525', true);	
	
	wp_enqueue_script('slideshow', get_bloginfo('template_url').'/js/jquery.flexslider-min.js', array('jquery'), '1.7', true);
	wp_enqueue_style('slideshow', get_bloginfo('template_url').'/css/flexslider.css', false, '1.7', 'all' );	
	
	wp_enqueue_script('theme_trust_js', get_bloginfo('template_url').'/js/theme_trust.js', array('jquery'), '1.0', true);	
	
	if(is_paginated() && of_get_option('ttrust_infinite_scrolling') != "disabled"){
		wp_enqueue_script('infinite_scroll', get_bloginfo('template_url').'/js/jquery.infinitescroll.min.js', array('jquery'), '2.0', true);	
	}
}

add_action('wp_head','ttrust_theme_head');

function ttrust_theme_head() { ?>
<meta name="generator" content="<?php global $ttrust_theme, $ttrust_version; echo $ttrust_theme.' '.$ttrust_version; ?>" />

<style type="text/css" media="screen">

<?php $heading_font = of_get_option('ttrust_heading_font'); ?>
<?php $body_font = of_get_option('ttrust_body_font'); ?>
<?php $home_message_font = of_get_option('ttrust_home_message_font'); ?>
<?php if ($heading_font) : ?>
	h1, h2, h3, h4, h5, h6 { font-family: '<?php echo $heading_font; ?>'; }
<?php endif; ?>

<?php if ($body_font) : ?>
	body { font-family: '<?php echo $body_font; ?>'; }
<?php endif; ?>

<?php if ($home_message_font) : ?>
	#homeMessage p { font-family: '<?php echo $home_message_font; ?>'; }
<?php endif; ?>

<?php if(of_get_option('ttrust_color_menu')) : ?>#mainNav ul a, #mainNav ul li.sfHover ul a { color: <?php echo(of_get_option('ttrust_color_menu')); ?> !important;	}<?php endif; ?>

<?php if(of_get_option('ttrust_color_menu_hover')) : ?>
	#mainNav ul li.current a,
	#mainNav ul li.current-cat a,
	#mainNav ul li.current_page_item a,
	#mainNav ul li.current-menu-item a,
	#mainNav ul li.current-post-ancestor a,
	#mainNav ul li.current_page_parent a,
	#mainNav ul li.current-category-parent a,
	#mainNav ul li.current-category-ancestor a,
	#mainNav ul li.current-portfolio-ancestor a,
	#mainNav ul li.current-projects-ancestor a {
		color: <?php echo(of_get_option('ttrust_color_menu_hover')); ?> !important;		
	}
	#mainNav ul li.sfHover a,
	#mainNav ul li a:hover,
	#mainNav ul li:hover {
		color: <?php echo(of_get_option('ttrust_color_menu_hover')); ?> !important;	
	}
	#mainNav ul li.sfHover ul a:hover { color: <?php echo(of_get_option('ttrust_color_menu_hover')); ?> !important;}	
<?php endif; ?>

<?php if(of_get_option('ttrust_color_link')) : ?>a { color: <?php echo(of_get_option('ttrust_color_link')); ?>;}<?php endif; ?>

<?php if(of_get_option('ttrust_color_link_hover')) : ?>a:hover {color: <?php echo(of_get_option('ttrust_color_link_hover')); ?>;}<?php endif; ?>

<?php if(of_get_option('ttrust_color_btn')) : ?>.button, #searchsubmit, input[type="submit"] {background-color: <?php echo(of_get_option('ttrust_color_btn')); ?> !important;}<?php endif; ?>

<?php if(of_get_option('ttrust_color_btn_hover')) : ?>.button:hover, #searchsubmit:hover, input[type="submit"]:hover {background-color: <?php echo(of_get_option('ttrust_color_btn_hover')); ?> !important;}<?php endif; ?>

<?php if ( is_archive() ): ?> html {height: 101%;} <?php endif; ?>
<?php echo(of_get_option('ttrust_custom_css')); ?>
</style>

<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie7.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie8.css" type="text/css" media="screen" />
<![endif]-->

<?php echo "\n".of_get_option('ttrust_analytics')."\n"; ?>

<?php }

add_action('init', 'remheadlink');
function remheadlink() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}


//////////////////////////////////////////////////////////////
// Custom Background Support
/////////////////////////////////////////////////////////////

if(function_exists('add_custom_background')) add_custom_background();


//////////////////////////////////////////////////////////////
// Body Class
/////////////////////////////////////////////////////////////

function ttrust_body_classes($classes) {	
	
	$classes[] = of_get_option('ttrust_background');	
	return $classes;
}
add_filter('body_class','ttrust_body_classes');


//////////////////////////////////////////////////////////////
// Check for pagination
/////////////////////////////////////////////////////////////

function is_paginated(){
	global $wp_query;
	$total = $wp_query->max_num_pages ; 
    if ($total > 1) : 
        return true;
    endif;
}

//////////////////////////////////////////////////////////////
// Theme Footer
/////////////////////////////////////////////////////////////

add_action('wp_footer','ttrust_footer');

function ttrust_footer() {
	
	global $wp_query;
	global $post;
	if($post) {
		if ( is_front_page() || false !== strpos($post->post_content, '[slideshow') ) {	
			include(TEMPLATEPATH . '/js/slideshow.php');			
		}
	}
	
	if(is_paginated() && of_get_option('ttrust_infinite_scrolling') != "disabled"){
		include(TEMPLATEPATH . '/js/infinite_scrolling.php');	
	}
}


//////////////////////////////////////////////////////////////
// Remove
/////////////////////////////////////////////////////////////

// #more from more-link
function ttrust_remove($content) {
	global $id;
	return str_replace('#more-'.$id.'"', '"', $content);
}
add_filter('the_content', 'ttrust_remove');


//////////////////////////////////////////////////////////////
// Custom Excerpt
/////////////////////////////////////////////////////////////

function excerpt_ellipsis($text) {
	return str_replace('[...]', '...', $text);
}
add_filter('the_excerpt', 'excerpt_ellipsis');



//////////////////////////////////////////////////////////////
// Pagination Styles
/////////////////////////////////////////////////////////////

add_action( 'wp_print_styles', 'ttrust_deregister_styles', 100 );
function ttrust_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}
remove_action('wp_head', 'pagenavi_css');
remove_action('wp_print_styles', 'pagenavi_stylesheets');


//////////////////////////////////////////////////////////////
// Navigation Menus
/////////////////////////////////////////////////////////////

add_theme_support('menus');
register_nav_menu('main', 'Main Navigation Menu');

function default_nav() {
	require_once (TEMPLATEPATH . '/includes/default_nav.php');
}


//////////////////////////////////////////////////////////////
// Custom Background
/////////////////////////////////////////////////////////////

add_custom_background();


//////////////////////////////////////////////////////////////
// Feature Images (Post Thumbnails)
/////////////////////////////////////////////////////////////

add_theme_support('post-thumbnails');

set_post_thumbnail_size(100, 100, true);
add_image_size('ttrust_post_thumb_big', 670, 220, true);
add_image_size('ttrust_post_thumb_small', 150, 150, true);
add_image_size('ttrust_post_thumb_tiny', 50, 50, true);
add_image_size('ttrust_one_fourth_cropped', 225, 170, true);
add_image_size('ttrust_three_fourth', 720, 290, true);
add_image_size('ttrust_one_fourth', 225, 9999);

new MultiPostThumbnails(array(
	'label' => 'Slideshow Image',
	'id' => 'slidewhow_image',
	'post_type' => 'page'
	)
);

new MultiPostThumbnails(array(
	'label' => 'Slideshow Image',
	'id' => 'slidewhow_image',
	'post_type' => 'post'
	)
);

add_image_size('ttrust_slideshow_image_full', 960, 350, true);


//////////////////////////////////////////////////////////////
// Enbale PrettyPhoto for Galleries
/////////////////////////////////////////////////////////////
 
function sant_prettyadd ($content) {
	$content = preg_replace("/<a/","<a rel=\"prettyPhoto[slides]\"",$content,1);
	return $content;
}

add_filter( 'wp_get_attachment_link', 'sant_prettyadd');


//////////////////////////////////////////////////////////////
// Button Shortcode
/////////////////////////////////////////////////////////////

function ttrust_button($a) {
	extract(shortcode_atts(array(
		'label' 	=> 'Button Text',
		'id' 	=> '1',
		'url'	=> '',
		'target' => '_parent',		
		'size'	=> '',
		'ptag'	=> false
	), $a));
	
	$link = $url ? $url : get_permalink($id);	
	
	if($ptag) :
		return  wpautop('<a href="'.$link.'" target="'.$target.'" class="button '.$size.'">'.$label.'</a>');
	else :
		return '<a href="'.$link.'" target="'.$target.'" class="button '.$size.'">'.$label.'</a>';
	endif;
	
}

add_shortcode('button', 'ttrust_button');

//////////////////////////////////////////////////////////////
// Slideshow Shortcode
/////////////////////////////////////////////////////////////

function ttrust_slideshow( $atts, $content = null ) {
    $content = str_replace('<br />', '', $content);
	$content = str_replace('<img', '<li><img', $content);
	$content = str_replace('/>', '/></li>', $content);
	return '<div class="slideshow"><div class="flexslider"><ul class="slides">' . $content . '</ul></div></div>';
}
add_shortcode('slideshow', 'ttrust_slideshow');


//////////////////////////////////////////////////////////////
// Elastic Video
/////////////////////////////////////////////////////////////

function ttrust_elasticVideo( $atts, $content = null ) {    
	return '<div class="videoContainer">' . $content . '</div>';
}
add_shortcode('elastic-video', 'ttrust_elasticVideo');

//////////////////////////////////////////////////////////////
// Add conainers to all videos
/////////////////////////////////////////////////////////////

function add_video_containers($content) { 
	$content = str_replace('<object', '<div class="videoContainer"><object', $content);
	$content = str_replace('</object>', '</object></div>', $content);
	
	$content = str_replace('<embed', '<div class="videoContainer"><embed', $content);
	$content = str_replace('</embed>', '</embed></div>', $content);
	
	$content = str_replace('<iframe', '<div class="videoContainer"><iframe', $content);
	$content = str_replace('</iframe>', '</iframe></div>', $content);
	
	return $content;
}

add_action('the_content', 'add_video_containers');
 





//////////////////////////////////////////////////////////////
// Custom More Link
/////////////////////////////////////////////////////////////

function more_link() {
	global $post;	
	$more_link = '<p class="moreLink"><a href="'.get_permalink().'" title="'.get_the_title().'">';
	$more_link .= '<span>Read More</span>';
	$more_link .= '</a></p>';
	echo $more_link;	
}

//////////////////////////////////////////////////////////////
// Custom Sanitize for Theme Options
/////////////////////////////////////////////////////////////

add_action('admin_init','optionscheck_change_santiziation', 100);
 

function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}
 
function custom_sanitize_textarea($input) {
    global $allowedposttags;
    
      $custom_allowedtags["script"] = array();
 
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}

//////////////////////////////////////////////////////////////
// Filter Categories in Home Page Main Loop
/////////////////////////////////////////////////////////////

function home_cats(&$query){
	$home_cats = of_get_option('ttrust_home_categories');		  
	global $wp_the_query;	
	if ($query->is_home && $home_cats && $wp_the_query === $query){        
	        $query->set('cat', $home_cats);
	 }
}
add_action('pre_get_posts', 'home_cats');



//////////////////////////////////////////////////////////////
// Meta Box
/////////////////////////////////////////////////////////////

$prefix = "_ttrust_";

$home_slideshow_options = array(
	
		"in_slideshow" => array(
    	"type" => "checkbox",
		"name" => $prefix."in_home_slideshow",
    	"std" => "",
    	"title" => __('Include in Home Page Slideshow','themetrust'),
    	"description" => __('Display this in the home page slideshow.','themetrust')),		

		"home_slideshow_text" => array(
    	"type" => "textarea",
		"name" => $prefix."home_slideshow_text",
    	"std" => "",
    	"title" => __('Home Slideshow Text','themetrust'),
    	"description" => __('Enter a short description to be included with the slideshow image.','themetrust'))		
);

$lightbox_options = array(		

		"lightbox_img" => array(
    	"type" => "textfield",
		"name" => $prefix."lightbox_img",
    	"std" => "",
    	"title" => __('Lightbox Image','themetrust'),
    	"description" => __('This image will be displayed when the thumbnail for this project is clicked. Enter the full image URL.','themetrust')),

		"lightbox_video" => array(
    	"type" => "textfield",
		"name" => $prefix."lightbox_video",
    	"std" => "",
    	"title" => __('Lightbox Video','themetrust'),
    	"description" => __('This video will be displayed when the thumbnail for this project is clicked. Enter the URL of a video from Vimeo or YouTube.','themetrust'))
);


$page_options = array(	
		"description" => array(
    	"type" => "textarea",
		"name" => $prefix."page_description",
    	"std" => "",
    	"title" => __('Description','themetrust'),
    	"description" => __('Enter a description about this page.','themetrust'))		
);



$meta_box_groups = array($home_slideshow_options, $page_options, $lightbox_options);

function new_meta_box($post, $metabox) {	
	
	$meta_boxes_inputs = $metabox['args']['inputs'];

	foreach($meta_boxes_inputs as $meta_box) {
	
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		if($meta_box_value == "") $meta_box_value = $meta_box['std'];
		
		echo'<div class="meta-field">';
		
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		
		echo'<p><strong>'.$meta_box['title'].'</strong></p>';
		
		if(isset($meta_box['type']) && $meta_box['type'] == 'checkbox') {
		
			if($meta_box_value == 'true') {
				$checked = "checked=\"checked\"";
			} elseif($meta_box['std'] == "true") {	
					$checked = "checked=\"checked\"";	
			} else {
					$checked = "";
			}
		
			echo'<p class="clearfix"><input type="checkbox" class="meta-radio" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="true" '.$checked.' /> ';		
			echo'<label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';		
		
		} elseif(isset($meta_box['type']) && $meta_box['type'] == 'textarea')  {			
			
			echo'<textarea rows="4" style="width:98%" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';			
			echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
		
		} else {
			
			echo'<input style="width:70%"type="text" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" /><br />';		
			echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
		
		}
		
		echo'</div>';
		
	} // end foreach
		
	echo'<br style="clear:both" />';
	
} // end meta boxes

function create_meta_box() {	
	global $home_slideshow_options, $page_options, $lightbox_options;	
	
	if ( function_exists('add_meta_box') ) {				
		add_meta_box( 'new-meta-boxes-home-slideshow', __('Home Slideshow Options','themetrust'), 'new_meta_box', 'post', 'normal', 'high', array('inputs'=>$home_slideshow_options) );
		add_meta_box( 'new-meta-boxes-home-slideshow', __('Home Slideshow Options','themetrust'), 'new_meta_box', 'page', 'normal', 'high', array('inputs'=>$home_slideshow_options) );		
		add_meta_box( 'new-meta-boxes-page-options', __('Page Options','themetrust'), 'new_meta_box', 'page', 'side', 'low', array('inputs'=>$page_options) );	
		add_meta_box( 'new-meta-boxes-lightbox-options', __('Lightbox Options','themetrust'), 'new_meta_box', 'post', 'normal', 'low', array('inputs'=>$lightbox_options) );		
	}
}



function save_postdata( $post_id ) {
global $post, $new_meta_boxes, $meta_box_groups;

if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
	return $post_id;
}

if( defined('DOING_AJAX') && DOING_AJAX ) { //Prevents the metaboxes from being overwritten while quick editing.
	return $post_id;
}

if( ereg('/\edit\.php', $_SERVER['REQUEST_URI']) ) { //Detects if the save action is coming from a quick edit/batch edit.
	return $post_id;
}

foreach($meta_box_groups as $group) {
	foreach($group as $meta_box) {

		// Verify
		if(isset($_POST[$meta_box['name'].'_noncename'])){
			if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
				return $post_id;
			}
		}

		if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
				return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ))
				return $post_id;
		}

		$data = "";
		if(isset($_POST[$meta_box['name'].'_value'])){
			$data = $_POST[$meta_box['name'].'_value'];
		}


		if(get_post_meta($post_id, $meta_box['name'].'_value') == "") 
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
		elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
		elseif($data == "" || $data == $meta_box['std'] )
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	
		} // end foreach
	} // end foreach
} // end save_postdata

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');



//////////////////////////////////////////////////////////////
// Comments
/////////////////////////////////////////////////////////////

function ttrust_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>		
	<li id="li-comment-<?php comment_ID() ?>">		
		
		<div class="comment <?php echo get_comment_type(); ?>" id="comment-<?php comment_ID() ?>">						
			
			<?php echo get_avatar($comment,'60',get_bloginfo('template_url').'/images/default_avatar.png'); ?>			
   	   			
   	   		<h5><?php comment_author_link(); ?></h5>
			<span class="date"><?php comment_date(); ?></span>
				
			<?php if ($comment->comment_approved == '0') : ?>
				<p><span class="message"><?php _e('Your comment is awaiting moderation.', 'themetrust'); ?></span></p>
			<?php endif; ?>
				
			<?php comment_text() ?>				
				
			<?php
			if(get_comment_type() != "trackback")
				comment_reply_link(array_merge( $args, array('add_below' => 'comment','reply_text' => '<span>'. __('Reply', 'themetrust') .'</span>', 'login_text' => '<span>'. __('Log in to reply', 'themetrust') .'</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'])))
			
			?>
				
		</div><!-- end comment -->
			
<?php
}

function ttrust_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
		<li class="comment" id="comment-<?php comment_ID() ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
<?php
}
?>