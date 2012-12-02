<?php class AdBlockWidget extends WP_Widget
{
    function AdBlockWidget(){
		$widget_ops = array('description' => 'Displays Advertisement');
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false,$name='ET Ad Block',$widget_ops,$control_ops);
    }

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$imagePath = empty($instance['imagePath']) ? '' : esc_url($instance['imagePath']);
		$imageUrl = empty($instance['imageUrl']) ? '' : esc_url($instance['imageUrl']);

		echo $before_widget;
?>
	<a href="<?php echo $imageUrl; ?>"><img src="<?php echo $imagePath; ?>" class="728_image" alt="" /></a>
<?php
		echo $after_widget;
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['imagePath'] = esc_url($new_instance['imagePath']);
		$instance['imageUrl'] = esc_url($new_instance['imageUrl']);

		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('imagePath'=>'', 'imageUrl'=>'') );

		$imagePath = esc_url($instance['imagePath']);
		$imageUrl = esc_url($instance['imageUrl']);
		
		# Image
		echo '<p><label for="' . $this->get_field_id('imagePath') . '">' . 'Image Path:' . '</label><textarea cols="20" rows="2" class="widefat" id="' . $this->get_field_id('imagePath') . '" name="' . $this->get_field_name('imagePath') . '" >'. $imagePath .'</textarea></p>';
		# Image
		echo '<p><label for="' . $this->get_field_id('imageUrl') . '">' . 'Image Url:' . '</label><textarea cols="20" rows="2" class="widefat" id="' . $this->get_field_id('imageUrl') . '" name="' . $this->get_field_name('imageUrl') . '" >'. $imageUrl .'</textarea></p>';
	}

}// end AdBlockWidget class

function AdBlockWidgetInit() {
  register_widget('AdBlockWidget');
}

add_action('widgets_init', 'AdBlockWidgetInit');

?>