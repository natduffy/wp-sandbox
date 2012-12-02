<?php 

add_action( 'after_setup_theme', 'et_setup_theme' );
if ( ! function_exists( 'et_setup_theme' ) ){
	function et_setup_theme(){
		global $themename, $shortname;
		$themename = "Aggregate";
		$shortname = "aggregate";
		
		require_once(TEMPLATEPATH . '/epanel/custom_functions.php'); 

		require_once(TEMPLATEPATH . '/includes/functions/comments.php'); 

		require_once(TEMPLATEPATH . '/includes/functions/sidebars.php'); 

		load_theme_textdomain('Aggregate',get_template_directory().'/lang');

		require_once(TEMPLATEPATH . '/epanel/options_aggregate.php');

		require_once(TEMPLATEPATH . '/epanel/core_functions.php'); 

		require_once(TEMPLATEPATH . '/epanel/post_thumbnails_aggregate.php');
		
		include(TEMPLATEPATH . '/includes/widgets.php');
		
		add_action( 'wp_enqueue_scripts', 'et_add_responsive_shortcodes_css', 11 );
		
		add_action( 'pre_get_posts', 'et_home_posts_query' );
		
		add_action( 'et_epanel_changing_options', 'et_delete_featured_ids_cache' );
		add_action( 'delete_post', 'et_delete_featured_ids_cache' );	
		add_action( 'save_post', 'et_delete_featured_ids_cache' );
	}
}

add_action('wp_head','et_portfoliopt_additional_styles',100);
function et_portfoliopt_additional_styles(){ ?>
	<style type="text/css">
		#et_pt_portfolio_gallery { margin-left: -41px; margin-right: -51px; }
		.et_pt_portfolio_item { margin-left: 35px; }
		.et_portfolio_small { margin-left: -40px !important; }
		.et_portfolio_small .et_pt_portfolio_item { margin-left: 32px !important; }
		.et_portfolio_large { margin-left: -26px !important; }
		.et_portfolio_large .et_pt_portfolio_item { margin-left: 11px !important; }
	</style>
<?php }

function register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' ),
			'footer-menu' => __( 'Footer Menu' )
		)
	);
}
if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

// add Home link to the custom menu WP-Admin page
function et_add_home_link( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'et_add_home_link' );

add_action('wp_head','et_add_meta_javascript');
function et_add_meta_javascript(){
	global $shortname;
	echo '<!-- used in scripts -->';
	echo '<meta name="et_featured_auto_speed" content="'.get_option($shortname.'_slider_autospeed').'" />';
			
	$disable_toptier = get_option($shortname.'_disable_toptier') == 'on' ? 1 : 0;
	echo '<meta name="et_disable_toptier" content="'.$disable_toptier.'" />';
	
	$featured_slider_pause = get_option($shortname.'_slider_pause') == 'on' ? 1 : 0;
	echo '<meta name="et_featured_slider_pause" content="'.$featured_slider_pause.'" />';
	
	$featured_slider_auto = get_option($shortname.'_slider_auto') == 'on' ? 1 : 0;
	echo '<meta name="et_featured_slider_auto" content="'.$featured_slider_auto.'" />';
	
	echo '<meta name="et_theme_folder" content="'.get_template_directory_uri().'" />';
}

add_action( 'wp_enqueue_scripts', 'et_responsive_layout' );
function et_responsive_layout(){
	if ( 'on' != get_option('aggregate_responsive_layout') ) return;
	$template_dir = get_template_directory_uri();
	
	wp_enqueue_style('et_responsive', $template_dir . '/css/responsive.css');
	
	wp_enqueue_script('fitvids', $template_dir . '/js/jquery.fitvids.js', array('jquery'), '1.0', true);
	wp_enqueue_script('flexslider', $template_dir . '/js/jquery.flexslider-min.js', array('jquery'), '1.0', true);	
	wp_enqueue_script('et_flexslider_script', $template_dir . '/js/et_flexslider.js', array('jquery'), '1.0', true);
}

add_action( 'wp_head', 'et_add_viewport_meta' );
function et_add_viewport_meta(){
	if ( 'on' != get_option('aggregate_responsive_layout') ) return;
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />';
}


add_action( 'et_header_menu', 'et_add_mobile_navigation' );
function et_add_mobile_navigation(){
	if ( 'on' != get_option('aggregate_responsive_layout') ) return;
	echo '<a href="#" class="mobile_nav closed">' . esc_html__( 'Pages Navigation Menu', 'Aggregate' ) . '<span></span></a>';
}

add_action( 'et_secondary_menu', 'et_add_secondary_mobile_navigation' );
function et_add_secondary_mobile_navigation(){
	if ( 'on' != get_option('aggregate_responsive_layout') ) return;
	echo '<a href="#" class="mobile_nav closed">' . esc_html__( 'Categories Navigation Menu', 'Aggregate' ) . '<span></span></a>';
}

add_action('et_header_top','et_aggregate_control_panel');
function et_aggregate_control_panel(){
	$admin_access = apply_filters( 'et_showcontrol_panel', current_user_can('switch_themes') );
	if ( !$admin_access ) return;
	if ( get_option('aggregate_show_control_panel') <> 'on' ) return;
	global $et_bg_texture_urls, $et_google_fonts; ?>
	<div id="et-control-panel">
		<div id="control-panel-main">
			<a id="et-control-close" href="#"></a>
			<div id="et-control-inner">
				<h3 class="control_title">Example Colors</h3>
				<a href="#" class="et-control-colorpicker" id="et-control-background"></a>
				
				<div class="clear"></div>
				
				<?php 
					$sample_colors = array( '6a8e94', '8da49c', 'b0b083', '859a7c', 'c6bea6', 'b08383', 'a4869d', 'f5f5f5', '4e4e4e', '556f6a', '6f5555', '6f6755' );
					for ( $i=1; $i<=12; $i++ ) { ?>
						<a class="et-sample-setting" id="et-sample-color<?php echo $i; ?>" href="#" rel="<?php echo esc_attr($sample_colors[$i-1]); ?>" title="#<?php echo esc_attr($sample_colors[$i-1]); ?>"><span class="et-sample-overlay"></span></a>
				<?php } ?>
				<p>or define your own in ePanel</p>
				
				<h3 class="control_title">Texture Overlays</h3>
				<div class="clear"></div>
				
				<?php 
					$sample_textures = $et_bg_texture_urls;
					for ( $i=1; $i<=count($et_bg_texture_urls); $i++ ) { ?>
						<a title="<?php echo esc_attr($sample_textures[$i-1]); ?>" class="et-sample-setting et-texture" id="et-sample-texture<?php echo $i; ?>" href="#" rel="bg<?php echo $i+1; ?>"><span class="et-sample-overlay"></span></a>
				<?php } ?>
				
				<p>or define your own in ePanel</p>
				
				<?php 
					$google_fonts = $et_google_fonts;
					$font_setting = 'Kreon';
					$body_font_setting = 'Droid+Sans';
					if ( isset( $_COOKIE['et_aggregate_header_font'] ) ) $font_setting = $_COOKIE['et_aggregate_header_font'];
					if ( isset( $_COOKIE['et_aggregate_body_font'] ) ) $body_font_setting = $_COOKIE['et_aggregate_body_font'];
				?>
				
				<h3 class="control_title">Fonts</h3>
				<div class="clear"></div>
				
				<label for="et_control_header_font">Header
					<select name="et_control_header_font" id="et_control_header_font">
						<?php foreach( $google_fonts as $google_font ) { ?>
							<?php $encoded_value = urlencode($google_font); ?>
							<option value="<?php echo $encoded_value; ?>" <?php selected( $font_setting, $encoded_value ); ?>><?php echo esc_html($google_font); ?></option>
						<?php } ?>
					</select>
				</label>
				<a href="#" class="et-control-colorpicker et-font-control" id="et-control-headerfont_bg"></a>
				<div class="clear"></div>
				
				<label for="et_control_body_font">Body
					<select name="et_control_body_font" id="et_control_body_font">
						<?php foreach( $google_fonts as $google_font ) { ?>
							<?php $encoded_value = urlencode($google_font); ?>
							<option value="<?php echo $encoded_value; ?>" <?php selected( $body_font_setting, $encoded_value ); ?>><?php echo esc_html($google_font); ?></option>
						<?php } ?>
					</select>
				</label>
				<a href="#" class="et-control-colorpicker et-font-control" id="et-control-bodyfont_bg"></a>
				<div class="clear"></div>
				
			</div> <!-- end #et-control-inner -->
		</div> <!-- end #control-panel-main -->
	</div> <!-- end #et-control-panel -->
<?php
}

add_action( 'template_redirect', 'et_load_aggregate_scripts' );
function et_load_aggregate_scripts(){
	$template_dir = get_template_directory_uri();
	
	wp_enqueue_script('easing', $template_dir . '/js/jquery.easing.1.3.js', array('jquery'), '1.0');
	wp_enqueue_script('cycle', $template_dir . '/js/jquery.cycle.all.min.js', array('jquery'), '1.0');
	
	$admin_access = apply_filters( 'et_showcontrol_panel', current_user_can('switch_themes') );
	if ( $admin_access && get_option('aggregate_show_control_panel') == 'on' ) {
		wp_enqueue_script('et_colorpicker', $template_dir . '/epanel/js/colorpicker.js', array('jquery'), '1.0', true);
		wp_enqueue_script('et_eye', $template_dir . '/epanel/js/eye.js', array('jquery'), '1.0', true);
		wp_enqueue_script('et_cookie', $template_dir . '/js/jquery.cookie.js', array('jquery'), '1.0', true);
		wp_enqueue_script('et_control_panel', $template_dir . '/js/et_control_panel.js', array('jquery'), '1.0', true);
	}
}

add_action( 'wp_head', 'et_set_bg_properties' );
function et_set_bg_properties(){
	global $et_bg_texture_urls;
	
	$bgcolor = '';
	$bgcolor = ( isset( $_COOKIE['et_aggregate_bgcolor'] ) && get_option('aggregate_show_control_panel') == 'on' ) ? $_COOKIE['et_aggregate_bgcolor'] : get_option('aggregate_bgcolor');
	
	$bgtexture_url = '';
	$bgimage_url = '';
	if ( get_option('aggregate_bgimage') == '' ) {
		if ( isset( $_COOKIE['et_aggregate_texture_url'] ) && get_option('aggregate_show_control_panel') == 'on' ) $bgtexture_url =  $_COOKIE['et_aggregate_texture_url'];
		else {
			$bgtexture_url = get_option('aggregate_bgtexture_url');
			if ( $bgtexture_url == 'Default' ) $bgtexture_url = '';
			else $bgtexture_url = get_template_directory_uri() . '/images/body-bg' . ( array_search( $bgtexture_url, $et_bg_texture_urls )+2 ) . '.png';
		}
	} else {
		$bgimage_url = get_option('aggregate_bgimage');
	}
	
	$style = '';
	$style .= '<style type="text/css">';
	if ( $bgcolor <> '' ) { 
		$style .= '#content-area { background-color: #' . esc_attr($bgcolor) . '; }';
		$style .= '#top-header { border-color: #' . esc_attr($bgcolor) . '; }';
		$style .= '#content-area { border-color: #' . esc_attr($bgcolor) . '; }';
	}
	if ( $bgtexture_url <> '' ) $style .= '#content-area { background-image: url(' . esc_attr($bgtexture_url) . '); }';
	if ( $bgimage_url <> '' ) $style .= '#content-area { background-image: url(' . esc_attr($bgimage_url) . '); background-position: top center; background-repeat: no-repeat; }';
	$style .= '</style>';
	
	if ( $bgcolor <> '' || $bgtexture_url <> '' || $bgimage_url <> '' ) echo $style;
}

add_action( 'wp_head', 'et_set_font_properties' );
function et_set_font_properties(){
	$font_style = '';
	$font_color = '';
	$font_family = '';
	$font_color_string = '';
	
	if ( isset( $_COOKIE['et_aggregate_header_font'] ) && get_option('aggregate_show_control_panel') == 'on' ) $et_header_font =  $_COOKIE['et_aggregate_header_font'];
	else {
		$et_header_font = get_option('aggregate_header_font');
		if ( $et_header_font == 'Kreon' ) $et_header_font = '';
	}
	
	if ( isset( $_COOKIE['et_aggregate_header_font_color'] ) && get_option('aggregate_show_control_panel') == 'on' ) 	
		$et_header_font_color =  $_COOKIE['et_aggregate_header_font_color'];
	else 
		$et_header_font_color = get_option('aggregate_header_font_color');
	
	if ( $et_header_font <> '' || $et_header_font_color <> '' ) {
		$et_header_font_id = strtolower( str_replace( '+', '_', $et_header_font ) );
		$et_header_font_id = str_replace( ' ', '_', $et_header_font_id );
		
		if ( $et_header_font <> '' ) {
			$font_style .= "<link id='" . esc_attr($et_header_font_id) . "' href='" . esc_url( "http://fonts.googleapis.com/css?family=" . str_replace( ' ', '+', $et_header_font )  . ( 'Raleway' == $et_header_font ? ':100' : '' ) ) . "' rel='stylesheet' type='text/css' />";
			$font_family = "font-family: '" . str_replace( '+', ' ', $et_header_font ) . "', Arial, sans-serif !important; ";
		}
		
		if ( $et_header_font_color <> '' ) {
			$font_color_string = "color: #" . $et_header_font_color . "; ";
		}
		
		$font_style .= "<style type='text/css'>h1,h2,h3,h4,h5,h6 { ". $font_family .  " }</style>";
		$font_style .= "<style type='text/css'>h1,h2,h3,h4,h5,h6, h2 a, h3 a, h4 a, h5 a, h6 a { ". esc_attr($font_color_string) .  " }
		h2.featured-title a { color: #fff !important; }
		.main-title { color: #48423F !important; }
		</style>";
		
		echo $font_style;
	}
	
	$font_style = '';
	$font_color = '';
	$font_family = '';
	$font_color_string = '';
	
	if ( isset( $_COOKIE['et_aggregate_body_font'] ) && get_option('aggregate_show_control_panel') == 'on' ) $et_body_font =  $_COOKIE['et_aggregate_body_font'];
	else {
		$et_body_font = get_option('aggregate_body_font');
		if ( $et_body_font == 'Droid+Sans' ) $et_body_font = '';
	}
	
	if ( isset( $_COOKIE['et_aggregate_body_font_color'] ) && get_option('aggregate_show_control_panel') == 'on' ) 	
		$et_body_font_color =  $_COOKIE['et_aggregate_body_font_color'];
	else 
		$et_body_font_color = get_option('aggregate_body_font_color');
	
	if ( $et_body_font <> '' || $et_body_font_color <> '' ) {
		$et_body_font_id = strtolower( str_replace( '+', '_', $et_body_font ) );
		$et_body_font_id = str_replace( ' ', '_', $et_body_font_id );
		
		if ( $et_body_font <> '' ) { 
			$font_style .= "<link id='" . esc_attr($et_body_font_id) . "' href='" . esc_url( "http://fonts.googleapis.com/css?family=" . str_replace( ' ', '+', $et_body_font ) . ( 'Raleway' == $et_body_font ? ':100' : '' ) ) . "' rel='stylesheet' type='text/css' />";
			$font_family = "font-family: '" . str_replace( '+', ' ', $et_body_font) . "', Arial, sans-serif !important; ";
		}
		
		if ( $et_body_font_color <> '' ) {
			$font_color_string = "color: #" . esc_html($et_header_font_color) . "; ";
		}
		
		$font_style .= "<style type='text/css'>body { ". $font_family .  " }</style>";
		$font_style .= "<style type='text/css'>body { ". esc_attr($font_color_string) .  " }</style>";
		
		echo $font_style;
	}
} 

/**
 * Gets featured posts IDs from transient, if the transient doesn't exist - runs the query and stores IDs
 */
function et_get_featured_posts_ids(){
	if ( false === ( $et_featured_post_ids = get_transient( 'et_featured_post_ids' ) ) ) {
		$featured_query = new WP_Query( apply_filters( 'et_featured_post_args', array(
			'posts_per_page'	=> (int) et_get_option( 'aggregate_featured_num' ),
			'cat'				=> get_catId( et_get_option( 'aggregate_feat_cat' ) )
		) ) );

		if ( $featured_query->have_posts() ) {
			while ( $featured_query->have_posts() ) {
				$featured_query->the_post();
				
				$et_featured_post_ids[] = get_the_ID();
			}

			set_transient( 'et_featured_post_ids', $et_featured_post_ids );
		}
		
		wp_reset_postdata();
	}
	
	return $et_featured_post_ids;
}

/**
 * Filters the main query on homepage
 */
function et_home_posts_query( $query = false ) {
	/* Don't proceed if it's not homepage or the main query */
	if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() ) return;
		
	/* Set the amount of posts per page on homepage */
	$query->set( 'posts_per_page', et_get_option( 'aggregate_homepage_posts', '6' ) );
	
	/* Exclude categories set in ePanel */
	$exclude_categories = et_get_option( 'aggregate_exlcats_recent', false );
	if ( $exclude_categories ) $query->set( 'category__not_in', $exclude_categories );
	
	/* Exclude slider posts, if the slider is activated, pages are not featured and posts duplication is disabled in ePanel  */
	if ( 'on' == et_get_option( 'aggregate_featured', 'on' ) && 'false' == et_get_option( 'aggregate_use_pages', 'false' ) && 'false' == et_get_option( 'aggregate_duplicate', 'on' ) )
		$query->set( 'post__not_in', et_get_featured_posts_ids() );
}

/**
 * Deletes featured posts IDs transient, when the user saves, resets ePanel settings, creates or moves posts to trash in WP-Admin
 */
function et_delete_featured_ids_cache(){
	if ( false !== get_transient( 'et_featured_post_ids' ) ) delete_transient( 'et_featured_post_ids' );
}

if ( ! function_exists( 'et_list_pings' ) ){
	function et_list_pings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
	<?php }
}