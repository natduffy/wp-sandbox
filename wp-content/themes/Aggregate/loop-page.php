<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<h1 class="title"><?php the_title(); ?></h1>
				
	<?php if (get_option('aggregate_page_thumbnails') == 'on') { ?>
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
<?php endwhile; // end of the loop. ?>