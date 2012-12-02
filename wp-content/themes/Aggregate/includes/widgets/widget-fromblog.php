<?php class ETRecentFromWidget extends WP_Widget
{
    function ETRecentFromWidget(){
		$widget_ops = array('description' => 'Displays recent posts from any category');
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false,$name='ET Recent From Widget',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent From ' : $instance['title']);
		$posts_number = empty($instance['posts_number']) ? '' : (int) $instance['posts_number'];
		$blog_category = empty($instance['blog_category']) ? '' : (int) $instance['blog_category'];

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;
?>
		<?php query_posts("showposts=".$posts_number."&cat=".$blog_category);
		if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="block-post clearfix">
				<?php
					$thumb = '';
					$width = 40;
					$height = 40;
					$classtext = 'post-image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Recent');
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
				<p class="meta-info"><?php esc_html_e('Posted','Aggregate'); ?> <?php esc_html_e('by','Aggregate');?> <?php the_author_posts_link(); ?> <?php esc_html_e('on','Aggregate'); ?> <?php the_time('n-j-y'); ?></p>
			</div> <!-- end .block-post -->
		<?php endwhile; endif; wp_reset_query(); ?>
		
	<a href="<?php echo get_category_link($blog_category); ?>" class="more"><span><?php esc_html_e('More From ','Aggregate'); ?><?php echo get_categname($blog_category); ?></span></a>
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
		$instance = wp_parse_args( (array) $instance, array('title'=>'Recent From ', 'posts_number'=>'7', 'blog_category'=>'') );

		$title = esc_attr($instance['title']);
		$posts_number = (int) $instance['posts_number'];
		$blog_category = (int) $instance['blog_category'];

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# Number Of Posts
		echo '<p><label for="' . $this->get_field_id('posts_number') . '">' . 'Number of Posts:' . '</label><input class="widefat" id="' . $this->get_field_id('posts_number') . '" name="' . $this->get_field_name('posts_number') . '" type="text" value="' . $posts_number . '" /></p>';
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

}// end ETRecentFromWidget class

function ETRecentFromWidgetInit() {
  register_widget('ETRecentFromWidget');
}

add_action('widgets_init', 'ETRecentFromWidgetInit');

?>