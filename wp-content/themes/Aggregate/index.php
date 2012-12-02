<?php get_header(); ?>

<div id="main-content" class="clearfix">
	<div id="left-area">
		<?php get_template_part('includes/breadcrumbs'); ?>
		<div id="entries">
			<?php if ( is_active_sidebar( '468_top_area' ) ) { ?>
				<?php if ( !dynamic_sidebar('468_top_area') ) : ?> 
				<?php endif; ?>
			<?php } ?>	
			
			<?php get_template_part('includes/entry','index'); ?>
			
			<?php if ( is_active_sidebar( '468_bottom_area' ) ) { ?>
				<?php if ( !dynamic_sidebar('468_bottom_area') ) : ?> 
				<?php endif; ?>
			<?php } ?>
		</div> <!-- end #entries -->
	</div> <!-- end #left-area -->
	<?php get_sidebar(); ?>	
		
<?php get_footer(); ?>