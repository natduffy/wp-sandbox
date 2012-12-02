<?php
	global $paged;
	$i = 0;
?>
<?php 
	if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php
		$i++;
		$et_is_latest_post = ( $paged == 0 && ( is_home() && $i <= 2 ) ) || !is_home();
	?>
		<div class="post entry clearfix<?php if ( $et_is_latest_post ) echo ' latest'; ?>">
			<?php
				$thumb = '';
				$width = $et_is_latest_post ? 130 : 67;
				$height = $et_is_latest_post ? 130 : 67;
				$classtext = 'post-thumb';
				$titletext = get_the_title();
				$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Entry');
				$thumb = $thumbnail["thumb"];
			?>
			
			<?php if($thumb <> '' && get_option('aggregate_thumbnails_index') == 'on') { ?>
				<div class="thumb">
					<a href="<?php the_permalink(); ?>">
						<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
						<span class="overlay"></span>
					</a>
				</div> 	<!-- end .post-thumbnail -->
			<?php } ?>
			
			<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php get_template_part('includes/postinfo'); ?>

			<?php if (get_option('aggregate_blog_style') == 'on') the_content(''); else { ?>
				<?php 
					$et_excerpt_length = $et_is_latest_post && is_home() ? 215 : 80;
					if ( !is_home() ) $et_excerpt_length = 140;
				?>
				<p><?php truncate_post($et_excerpt_length); ?></p>
			<?php }; ?>
			<a href="<?php the_permalink(); ?>" class="more"><span><?php esc_html_e('Read More','Aggregate'); ?></span></a>
		</div> 	<!-- end .post-->
<?php endwhile; ?>
	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
	else { ?>
		 <?php get_template_part('includes/navigation','entry'); ?>
	<?php } ?>
<?php else : ?>
	<?php get_template_part('includes/no-results','entry'); ?>
<?php endif; ?>