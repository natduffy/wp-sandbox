<?php get_header(); ?>

	<div id="pageHead">
		<h1><?php _e('Search Results', 'themetrust'); ?></h1>
	</div>
	
	<?php $page_layout = of_get_option('ttrust_posts_archive_layout'); ?>	
	<?php $content_width = ($page_layout=="masonry_no_sidebar") ? "full" : "threeFourths" ?>			
	<?php $posts_layout = ($page_layout!="normal") ? "masonry" : "" ?>
					 
	<div id="content" class="threeFourths clearfix">
		<?php if(have_posts()) : ?>
		<div class="posts <?php echo $posts_layout;?>">
		<?php $c=0; $post_count = $wp_query->post_count; ?>
						
		<?php while (have_posts()) : the_post(); ?>
			<?php $c++; ?>				
			<div <?php post_class('post'); ?> >																				
				<div class="inside">
					<h1><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h1>	
					<?php the_excerpt('',TRUE); ?>				
				</div>																									
			</div>					
		<?php endwhile; ?>
		</div>
		<?php else: ?>
			<div class="page" >																				
				<div class="inside">
					<h1><?php _e('No Results', 'themetrust'); ?></h1>	
					<p><?php _e('Nothing matched your search.', 'themetrust'); ?></p>			
				</div>																									
			</div>
		<?php endif; ?>	
		
		<?php include( TEMPLATEPATH . '/includes/pagination.php'); ?>	
	</div>	
	<?php get_sidebar(); ?>	
	
<?php get_footer(); ?>