<?php get_header(); ?>			
			<?php $page_layout = of_get_option('ttrust_posts_home_layout'); ?>					
			<?php $content_width = ($page_layout=="masonry_no_sidebar") ? "full" : "threeFourths" ?>			
			<?php $posts_layout = ($page_layout!="normal") ? "masonry" : "" ?>		
						
			<div id="content" class="<?php echo $content_width;?>">				
				<div class="posts <?php echo $posts_layout;?>">
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
				
			<?php if($page_layout!="masonry_no_sidebar") get_sidebar(); ?>				
	
<?php get_footer(); ?>
