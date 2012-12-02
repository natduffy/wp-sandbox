<?php class ETRecentVideosWidget extends WP_Widget
{
    function ETRecentVideosWidget(){
		$widget_ops = array('description' => 'Displays recent videos from any category');
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false,$name='ET Recent Videos Widget',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Videos' : $instance['title']);
		$posts_number = empty($instance['posts_number']) ? 2 : (int) $instance['posts_number'];
		$blog_category = empty($instance['blog_category']) ? '' : (int) $instance['blog_category'];
		$responsive = 'on' != get_option('aggregate_responsive_layout') ? false : true;

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;
?>
	<?php if ( $responsive ) { ?>
		<div class="flexslider fslider_widget">
			<ul id="<?php echo $args['widget_id']; ?>" class="slides">
	<?php } else { ?>
		<div id="<?php echo $args['widget_id']; ?>" class="video-slider">
	<?php } ?>
		<?php if ( ! $responsive ) { ?>
			<div class="video-slides">
		<?php } ?>
				<?php 
					global $wp_embed, $post;
					$width = 248;
					$height = 162;
					$custom_query = new WP_Query("showposts=".$posts_number."&cat=".$blog_category);
					if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
					<?php if ( $responsive ) { ?>
						<li class="slide recent-video">
					<?php } else { ?>
						<div class="recent-video">
					<?php } ?>
							<?php
								$video = esc_url(get_post_meta( $post->ID,'et_videolink',true ));
								$video_manual_embed = get_post_meta( $post->ID,'et_videoembed',true );
								
								if ( $video <> '' ) { 
									$video_embed = apply_filters( 'the_content', $wp_embed->shortcode( '', $video ) );
									if ( $video_embed == '<a href="'.$video.'">'.$video.'</a>' ) $video_embed = $video_manual_embed;
								} else {
									$video_embed = $video_manual_embed;
								}
																	
								$video_embed = preg_replace('/<embed /','<embed wmode="transparent" ',$video_embed);
								$video_embed = preg_replace('/<\/object>/','<param name="wmode" value="transparent" /></object>',$video_embed); 
								$video_embed = preg_replace("/height=\"[0-9]*\"/", "height={$height}", $video_embed);
								$video_embed = preg_replace("/width=\"[0-9]*\"/", "width={$width}", $video_embed);
								
								echo $video_embed;
							?>
					<?php if ( $responsive ) { ?>
						</li>
					<?php } else { ?>
						</div> <!-- end .recent-video -->
					<?php } ?>
					<?php endwhile; endif; wp_reset_postdata(); ?>
		<?php if ( $responsive ) { ?>
				</ul> <!-- end .slides -->
			</div> <!-- end .fslider_widget -->
		<?php } else { ?>
			</div> <!-- end .video-slides -->
		<?php } ?>
		<?php if ( ! $responsive ) { ?>
			<a href="#" class="prev-video">Previous</a>
			<a href="#" class="next-video">Next</a>
		</div> <!-- end .video-slider -->
		<?php } ?>
		
		<script type="text/javascript">
		//<![CDATA[
			jQuery(function() {
				<?php if ( ! $responsive ) { ?>
					jQuery('#<?php echo esc_js($args['widget_id']); ?> .video-slides').cycle({
						timeout: 0,
						speed: 500,
						cleartypeNoBg: true,
						prev:   '#<?php echo esc_js($args['widget_id']); ?> a.prev-video', 
						next:   '#<?php echo esc_js($args['widget_id']); ?> a.next-video'
					});
				<?php } ?>
			});
		//]]>
		</script>
<?php
		echo $after_widget;
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['posts_number'] = (int) $new_instance['posts_number'];
		$instance['blog_category'] = (int) $new_instance['blog_category'];

		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'Recent Videos', 'posts_number'=>'7', 'blog_category'=>'') );

		$title = htmlspecialchars($instance['title']);
		$posts_number = (int) $instance['posts_number'];
		$blog_category = (int) $instance['blog_category'];

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# Number Of Posts
		echo '<p><label for="' . $this->get_field_id('posts_number') . '">' . 'Number of Videos:' . '</label><input class="widefat" id="' . $this->get_field_id('posts_number') . '" name="' . $this->get_field_name('posts_number') . '" type="text" value="' . $posts_number . '" /></p>';
		# Category ?>
		<?php 
			$cats_array = get_categories('hide_empty=0');
		?>
		<p>
			<label for="<?php echo $this->get_field_id('blog_category'); ?>">Category</label>
			<select name="<?php echo $this->get_field_name('blog_category'); ?>" id="<?php echo $this->get_field_id('blog_category'); ?>" class="widefat">
				<?php foreach( $cats_array as $category ) { ?>
					<option value="<?php echo $category->cat_ID; ?>"<?php selected( $instance['blog_category'], $category->cat_ID ); ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p> 
		<?php
	}

}// end ETRecentVideosWidget class

function ETRecentVideosWidgetInit() {
  register_widget('ETRecentVideosWidget');
}

add_action('widgets_init', 'ETRecentVideosWidgetInit');

?>