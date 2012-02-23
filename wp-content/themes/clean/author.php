<?php get_header(); ?>
		
		<div id="pageHead">
			<?php global $wp_query; $current_author = $wp_query->get_queried_object(); ?>
			<h1><?php _e('Author:', 'themetrust'); ?> <?php echo $current_author->display_name; ?></h1>
		</div>
		
		<?php $page_layout = of_get_option('ttrust_posts_archive_layout'); ?>	
		<?php $content_width = ($page_layout=="masonry_no_sidebar") ? "full" : "threeFourths" ?>			
		<?php $posts_layout = ($page_layout!="normal") ? "masonry" : "" ?>			
							 
		<div id="content" class="threeFourths clearfix">
			<div class="posts <?php echo $posts_layout;?>">
			<?php $c=0; $post_count = $wp_query->post_count; ?>	
			<?php while (have_posts()) : the_post(); ?>
				
				<?php if($page_layout == "normal") : ?>											
		    		<?php include( TEMPLATEPATH . '/includes/post_normal.php'); ?>		    	
				<?php else: ?>
					<?php include( TEMPLATEPATH . '/includes/post_small.php'); ?>	
				<?php endif; ?>
				
			<?php endwhile; ?>
			</div>
			<?php include( TEMPLATEPATH . '/includes/pagination.php'); ?>
					    	
		</div>		
		<?php get_sidebar(); ?>		
		
<?php get_footer(); ?>