<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar( array(
		'name' => 'Homepage Recent From Area #1',
		'id' => 'homepage-recentfrom-area-1',
		'before_widget' => '<div class="recent-from et-recent-top">',
		'after_widget' => '</div> <!-- end .recent-content --> </div> <!-- end .recent-from -->',
		'before_title' => '<h4 class="main-title">',
		'after_title' => '</h4><div class="recent-content">',
	) );
	
	register_sidebar( array(
		'name' => 'Homepage Recent From Area #2',
		'id' => 'homepage-recentfrom-area-2',
		'before_widget' => '<div class="recent-from recent-middle et-recent-top">',
		'after_widget' => '</div> <!-- end .recent-content --> </div> <!-- end .recent-from -->',
		'before_title' => '<h4 class="main-title">',
		'after_title' => '</h4><div class="recent-content">',
	) );
	
	register_sidebar( array(
		'name' => 'Homepage Recent From Area #3',
		'id' => 'homepage-recentfrom-area-3',
		'before_widget' => '<div class="recent-from recent-last et-recent-top">',
		'after_widget' => '</div> <!-- end .recent-content --> </div> <!-- end .recent-from -->',
		'before_title' => '<h4 class="main-title">',
		'after_title' => '</h4><div class="recent-content">',
	) );

    register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '',
		'after_widget' => '</div> <!-- end .widget -->',
		'before_title' => '<h4 class="main-title widget-title">',
		'after_title' => '</h4><div class="widget">',
    ));
	
	register_sidebar(array(
		'name' => 'Homepage Sidebar',
		'id' => 'homepage-sidebar',
		'before_widget' => '',
		'after_widget' => '</div> <!-- end .widget -->',
		'before_title' => '<h4 class="main-title widget-title">',
		'after_title' => '</h4><div class="widget">',
    ));
	
	register_sidebar( array(
		'name' => 'Homepage Bottom Area #1',
		'id' => 'bottom-area-1',
		'before_widget' => '<div class="recent-from">',
		'after_widget' => '</div> <!-- end .recent-content --> </div> <!-- end .recent-from -->',
		'before_title' => '<h4 class="main-title">',
		'after_title' => '</h4><div class="recent-content">',
	) );
	
	register_sidebar( array(
		'name' => 'Homepage Bottom Area #2',
		'id' => 'bottom-area-2',
		'before_widget' => '<div class="recent-from recent-middle">',
		'after_widget' => '</div> <!-- end .recent-content --> </div> <!-- end .recent-from -->',
		'before_title' => '<h4 class="main-title">',
		'after_title' => '</h4><div class="recent-content">',
	) );
	
	register_sidebar( array(
		'name' => 'Homepage Bottom Area #3',
		'id' => 'bottom-area-3',
		'before_widget' => '<div class="recent-from recent-last">',
		'after_widget' => '</div> <!-- end .recent-content --> </div> <!-- end .recent-from -->',
		'before_title' => '<h4 class="main-title">',
		'after_title' => '</h4><div class="recent-content">',
	) );
	
	register_sidebar( array(
		'name' => '728x90 Leaderboard Unit',
		'id' => '728area',
		'before_widget' => '<div id="ad-720">',
		'after_widget' => '</div> <!-- end #ad-720 -->',
		'before_title' => '',
		'after_title' => '',
	) );
	
	register_sidebar( array(
		'name' => '468x60 Top Ad Unit',
		'id' => '468_top_area',
		'before_widget' => '<div class="ad-468">',
		'after_widget' => '</div> <!-- end #ad-468 -->',
		'before_title' => '',
		'after_title' => '',
	) );
	
	register_sidebar( array(
		'name' => '468x60 Bottom Ad Unit',
		'id' => '468_bottom_area',
		'before_widget' => '<div class="ad-468 ad-bottom">',
		'after_widget' => '</div> <!-- end #ad-468 -->',
		'before_title' => '',
		'after_title' => '',
	) );
	
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div> <!-- end .footer-widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
    ));
} 
?>