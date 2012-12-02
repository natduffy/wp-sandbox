<?php get_template_part('includes/breadcrumbs','single'); ?>
		
<div id="entries">
	<?php if ( is_active_sidebar( '468_top_area' ) ) { ?>
		<?php if ( !dynamic_sidebar('468_top_area') ) : ?> 
		<?php endif; ?>
	<?php } ?>
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="entry post clearfix">
			<?php if (get_option('aggregate_integration_single_top') <> '' && get_option('aggregate_integrate_singletop_enable') == 'on') echo(get_option('aggregate_integration_single_top')); ?>
							
			<h1 class="title"><?php the_title(); ?></h1>
			<?php get_template_part('includes/postinfo','single'); ?>
			
			<?php if (get_option('aggregate_thumbnails') == 'on') { ?>
				<?php 
					$thumb = '';
					$width = 200;
					$height = 200;
					$classtext = 'single-thumb';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Entry');
					$thumb = $thumbnail["thumb"];
				?>
				
				<?php if($thumb <> '') { ?>
					<div class="thumb">
						<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
						<span class="overlay"></span>
					</div> 	<!-- end .thumb -->
				<?php } ?>
			<?php } ?>

			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','Aggregate').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<?php edit_post_link(esc_html__('Edit this page','Aggregate')); ?>
		</div> <!-- end .entry -->

		<?php if (get_option('aggregate_integration_single_bottom') <> '' && get_option('aggregate_integrate_singlebottom_enable') == 'on') echo(get_option('aggregate_integration_single_bottom')); ?>		
						
		<?php if (get_option('aggregate_468_enable') == 'on') { ?>
				  <?php if(get_option('aggregate_468_adsense') <> '') echo(get_option('aggregate_468_adsense'));
				else { ?>
				   <a href="<?php echo esc_url(get_option('aggregate_468_url')); ?>"><img src="<?php echo esc_url(get_option('aggregate_468_image')); ?>" alt="468 ad" class="foursixeight" /></a>
		   <?php } ?>   
		<?php } ?>

		<?php if (get_option('aggregate_show_postcomments') == 'on') comments_template('', true); ?>
	<?php endwhile; // end of the loop. ?>

	<?php if ( is_active_sidebar( '468_bottom_area' ) ) { ?>
		<?php if ( !dynamic_sidebar('468_bottom_area') ) : ?> 
		<?php endif; ?>
	<?php } ?>
</div> <!-- end #entries -->