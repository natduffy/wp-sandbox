<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php elegant_titles(); ?></title>
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/colorpicker.css" type="text/css" media="screen" />

<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Kreon:light,regular' rel='stylesheet' type='text/css'/>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie6style.css" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('img#logo, span.overlay, a.zoom-icon, a.more-icon, #menu, #menu-right, #menu-content, ul#top-menu ul, #menu-bar, .footer-widget ul li, span.post-overlay, #content-area, .avatar-overlay, .comment-arrow, .testimonials-item-bottom, #quote, #bottom-shadow, #quote .container');</script>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7style.css" />
<![endif]-->
<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8style.css" />
<![endif]-->

<script type="text/javascript">
	document.documentElement.className = 'js';
</script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<?php do_action('et_header_top'); ?>
	<div id="top-header">
		<div id="top-shadow"></div>
		<div id="bottom-shadow"></div>
		<div class="container clearfix">
			<?php do_action('et_header_menu'); ?>
			<?php $menuClass = 'nav';
			$menuID = 'top-menu';
			$primaryNav = '';
			if (function_exists('wp_nav_menu')) {
				$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
			};
			if ($primaryNav == '') { ?>
				<ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
					<?php if (get_option('aggregate_home_link') == 'on') { ?>
						<li <?php if (is_home()) echo('class="current_page_item"') ?>><a href="<?php echo home_url(); ?>"><?php esc_html_e('Home','Aggregate') ?></a></li>
					<?php }; ?>

					<?php show_page_menu($menuClass,false,false); ?>
					<?php show_categories_menu($menuClass,false); ?>
				</ul> <!-- end ul#nav -->
			<?php }
			else echo($primaryNav); ?>

			<div id="search-form">
				<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
					<input type="text" value="<?php esc_attr_e('search this site...', 'Aggregate'); ?>" name="s" id="searchinput" />
					<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/search_btn.png" id="searchsubmit" />
				</form>
			</div> <!-- end #search-form -->
		</div> <!-- end .container -->
	</div> <!-- end #top-header -->

	<div id="content-area">
		<div id="content-top-light">
			<div id="top-stitch"></div>
			<div class="container">
				<div id="logo-area">
					<a href="<?php echo home_url(); ?>">
						<?php $logo = (get_option('aggregate_logo') <> '') ? esc_attr(get_option('aggregate_logo')) : get_template_directory_uri().'/images/logo.png'; ?>
						<img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" id="logo"/>
					</a>
					<p id="slogan"><?php echo esc_html(get_bloginfo('description')); ?></p>
					<?php do_action('et_header'); ?>
				</div> <!-- end #logo-area -->
				<div id="content">
					<div id="inner-border">
						<div id="content-shadow">
							<div id="content-top-shadow">
								<div id="content-bottom-shadow">
									<div id="second-menu" class="clearfix">
										<?php do_action('et_secondary_menu'); ?>
										<?php $menuClass = 'nav';
										$menuID = 'secondary-menu';
										$secondaryNav = '';
										if (function_exists('wp_nav_menu')) {
											$secondaryNav = wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
										};
										if ($secondaryNav == '') { ?>
											<ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
												<?php if (get_option('aggregate_home_link') == 'on') { ?>
													<li <?php if (is_home()) echo('class="current_page_item"') ?>><a href="<?php echo home_url(); ?>"><?php esc_html_e('Home','Aggregate') ?></a></li>
												<?php }; ?>

												<?php show_page_menu($menuClass,false,false); ?>
												<?php show_categories_menu($menuClass,false); ?>
											</ul> <!-- end ul#nav -->
										<?php }
										else echo($secondaryNav); ?>
									</div> <!-- end #second-menu -->