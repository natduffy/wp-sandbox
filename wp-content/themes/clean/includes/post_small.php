<?php
$lightbox_media = ""; 
$lightbox_img = get_post_meta($post->ID, "_ttrust_lightbox_img_value", true); 
$lightbox_video = get_post_meta($post->ID, "_ttrust_lightbox_video_value", true); 			
if ($lightbox_img || $lightbox_video) : 
	$lightbox_media = ($lightbox_video != "") ? $lightbox_video : $lightbox_img; 
endif; 			
?>

<div <?php post_class('small'); ?>>
	<?php if(has_post_thumbnail()) : ?>		
		<?php if($lightbox_media) : ?>						
			<a class="thumb" href="<?php echo $lightbox_media; ?>" rel="prettyPhoto" title="">
				<span class="lbIndicator"><span></span></span>	
		<?php else : ?>
			<a class="thumb" href="<?php the_permalink(); ?>" rel="bookmark" >
		<?php endif; ?>													
			<?php the_post_thumbnail('ttrust_one_fourth_cropped', array('class' => 'postThumb', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?>
			</a>		
	<?php endif; ?>					
	<div class="inside">
		<div class="meta clearfix">															
			<?php $post_show_category = of_get_option('ttrust_post_show_category'); ?>
			<?php if($post_show_category) { _e('In', 'themetrust'); ?> <?php the_category(', '); echo "<br/>";} ?>
		</div>
		<h1><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h1>
		<div class="meta clearfix">
			<?php $post_show_author = of_get_option('ttrust_post_show_author'); ?>
			<?php $post_show_date = of_get_option('ttrust_post_show_date'); ?>			
			<?php $post_show_comments = of_get_option('ttrust_post_show_comments'); ?>
			
			<?php if($post_show_author) { _e('By ', 'themetrust'); the_author_posts_link(); echo "<br/>"; } ?>
			<?php if($post_show_date) { the_time( 'M j, Y' ); echo "<br/>";} ?>			
			<?php if($post_show_comments) : ?>
				<a href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'themetrust'), __('One Comment', 'themetrust'), __('% Comments', 'themetrust')); ?></a>
			<?php endif; ?>
		</div>																				

		<?php the_excerpt(); ?>
		<?php more_link(); ?>		
	</div>																				
</div>