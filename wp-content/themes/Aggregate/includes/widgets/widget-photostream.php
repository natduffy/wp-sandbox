<?php class ETPhotostream extends WP_Widget
{
    function ETPhotostream(){
		$widget_ops = array('description' => 'Displays photos from any category');
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false,$name='ET Photostream Widget',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Photostream' : $instance['title']);
		$posts_number = empty($instance['posts_number']) ? '' : $instance['posts_number'];
		$blog_category = empty($instance['blog_category']) ? '' : $instance['blog_category'];

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;
?>
	<div class="photostream clearfix">
		<?php query_posts("showposts=".$posts_number."&cat=".$blog_category);
		if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<?php
					$thumb = '';
					$width = 67;
					$height = 67;
					$classtext = 'post-thumb';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Entry');
					$thumb = $thumbnail["thumb"];
				?>			
				<div class="thumb">
					<a href="<?php the_permalink(); ?>">
						<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
						<span class="overlay"></span>
					</a>
				</div> 	<!-- end .post-thumbnail -->
		<?php endwhile; endif; wp_reset_query(); ?>
	</div> <!-- end .photostream -->
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
		$instance = wp_parse_args( (array) $instance, array('title'=>'Photostream', 'posts_number'=>'7', 'blog_category'=>'') );

		$title = htmlspecialchars($instance['title']);
		$posts_number = (int) $instance['posts_number'];
		$blog_category = $instance['blog_category'];

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# Number Of Posts
		echo '<p><label for="' . $this->get_field_id('posts_number') . '">' . 'Number of Photos:' . '</label><input class="widefat" id="' . $this->get_field_id('posts_number') . '" name="' . $this->get_field_name('posts_number') . '" type="text" value="' . $posts_number . '" /></p>';
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

}// end ETPhotostream class

function ETPhotostreamInit() {
  register_widget('ETPhotostream');
}

add_action('widgets_init', 'ETPhotostreamInit');

?>