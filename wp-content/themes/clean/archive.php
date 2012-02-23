<?php get_header(); ?>

		<div id="pageHead">
			<?php global $post; if(is_archive() && have_posts()) :

				if (is_category()) : ?>
					<h1><?php single_cat_title(); ?></h1>				
					<?php if(strlen(category_description()) > 0) echo category_description(); ?>
				<?php elseif( is_tag() ) : ?>
					<h1><?php single_tag_title(); ?></h1>
				<?php elseif (is_day()) : ?>
					<h1>Archive <?php the_time('M j, Y'); ?></h1>
				<?php elseif (is_month()) : ?>
					<h1>Archive <?php the_time('F Y'); ?></h1>
				<?php elseif (is_year()) : ?>
					<h1>Archive <?php the_time('Y'); ?></h1>
				<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
					<h1>Archive</h1>
				<?php endif; ?>

			<?php endif; ?>
		</div>	
		
		<?php $page_layout = of_get_option('ttrust_posts_archive_layout'); ?>	
		<?php $content_width = ($page_layout=="masonry_no_sidebar") ? "full" : "threeFourths" ?>			
		<?php $posts_layout = ($page_layout!="normal") ? "masonry" : "" ?>
						 
		<div id="content" class="threeFourths clearfix">
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
		<?php get_sidebar(); ?>				
	
		
<?php get_footer(); ?>