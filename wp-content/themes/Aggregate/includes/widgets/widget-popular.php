<?php class PopularWidget extends WP_Widget
{
    function PopularWidget(){
		$widget_ops = array('description' => 'Displays Popular Posts');
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false,$name='ET Popular Widget',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Popular This Week' : $instance['title']);
		$postsNum = empty($instance['postsNum']) ? '' : $instance['postsNum'];
		$show_thisweek = isset($instance['thisweek']) ? (bool) $instance['thisweek'] : false;
		
		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;

?>
<?php
	$additional_query = $show_thisweek ? '&year=' . date('Y') . '&w=' . date('W') : '';

	query_posts( 'post_type=post&posts_per_page='.$postsNum.'&orderby=comment_count&order=DESC' . $additional_query ); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="blog-entry">
			<a href="<?php the_permalink(); ?>" class="comments"><?php comments_number('0','1','%'); ?></a>
			<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<p class="meta-info"><?php esc_html_e('Posted','Aggregate'); ?> <?php esc_html_e('by','Aggregate');?> <?php the_author_posts_link(); ?> <?php esc_html_e('on','Aggregate'); ?> <?php the_time('n-j-y'); ?></p>
		</div>
	<?php endwhile; endif; wp_reset_query(); ?>

<?php
		echo $after_widget;
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['postsNum'] = stripslashes($new_instance['postsNum']);
		$instance['thisweek'] = 0;
		if ( isset($new_instance['thisweek']) ) $instance['thisweek'] = 1;
		
		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'Popular Posts', 'postsNum'=>'','thisweek'=>false) );

		$title = htmlspecialchars($instance['title']);
		$postsNum = htmlspecialchars($instance['postsNum']);
		
		
		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# Number of posts
		echo '<p><label for="' . $this->get_field_id('postsNum') . '">' . 'Number of posts:' . '</label><input class="widefat" id="' . $this->get_field_id('postsNum') . '" name="' . $this->get_field_name('postsNum') . '" type="text" value="' . $postsNum . '" /></p>';	 ?>
		<input class="checkbox" type="checkbox" <?php checked($instance['thisweek'], 1) ?> id="<?php echo $this->get_field_id('thisweek'); ?>" name="<?php echo $this->get_field_name('thisweek'); ?>" />
		<label for="<?php echo $this->get_field_id('thisweek'); ?>"><?php esc_html_e('Popular this week','Aggregate'); ?></label>
		<?php
	}

}// end AboutMeWidget class

function PopularWidgetInit() {
  register_widget('PopularWidget');
}

add_action('widgets_init', 'PopularWidgetInit');

?>