<?php
/*
Plugin Name: Simple Connect Widget
Version: 0.2.1
Plugin URI: http://wordpress.org/extend/plugins/simple-social-widget/
Description: Displays simple social media icons in the sidebar
Author: Andrew Epperson
Author URI: http://eppand.com
License: GPL2

Copyright 2012  Andrew Epperson  (email : eppand@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Begin Widget Code

class AE_Simple_Social_Widget extends WP_Widget
{
  function AE_Simple_Social_Widget()
  {
    $widget_ops = array('classname' => 'simpleSocialWidget', 'description' => 'Displays icons that link to your social media websites' );
    $this->WP_Widget('AE_Simple_Social_Widget', 'Custom - Simple Social Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'twitter_url' => '', 'facebook_url' => '', 'google_url' => '', 'linkedin_url' => '', 'feed_url' => '', 'youtube_url' => '', 'pinterest_url' => '' ) );
    $title = $instance['title'];
	$twitter_url = $instance['twitter_url'];
	$facebook_url = $instance['facebook_url'];
	$google_url = $instance['google_url'];
	$linkedin_url = $instance['linkedin_url'];
	$feed_url = $instance['feed_url'];
	$youtube_url = $instance['youtube_url'];
	$pinterest_url = $instance['pinterest_url'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></p>
  <p><label for="<?php echo $this->get_field_id('twitter_url'); ?>">Twitter URL:</label><input class="widefat" id="<?php echo $this->get_field_id('twitter_url'); ?>" name="<?php echo $this->get_field_name('twitter_url'); ?>" type="text" value="<?php echo attribute_escape($twitter_url); ?>" /></p>
  <p><label for="<?php echo $this->get_field_id('facebook_url'); ?>">Facebook URL:</label><input class="widefat" id="<?php echo $this->get_field_id('facebook_url'); ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" type="text" value="<?php echo attribute_escape($facebook_url); ?>" /></p>
   <p><label for="<?php echo $this->get_field_id('google_url'); ?>">Google+ URL:</label><input class="widefat" id="<?php echo $this->get_field_id('google_url'); ?>" name="<?php echo $this->get_field_name('google_url'); ?>" type="text" value="<?php echo attribute_escape($google_url); ?>" /></p>
    <p><label for="<?php echo $this->get_field_id('linkedin_url'); ?>">LinkedIn URL:</label><input class="widefat" id="<?php echo $this->get_field_id('linkedin_url'); ?>" name="<?php echo $this->get_field_name('linkedin_url'); ?>" type="text" value="<?php echo attribute_escape($linkedin_url); ?>" /></p>
    <p><label for="<?php echo $this->get_field_id('youtube_url'); ?>">YouTube URL:</label><input class="widefat" id="<?php echo $this->get_field_id('youtube_url'); ?>" name="<?php echo $this->get_field_name('youtube_url'); ?>" type="text" value="<?php echo attribute_escape($youtube_url); ?>" /></p>
    <p><label for="<?php echo $this->get_field_id('pinterest_url'); ?>">Pinterest URL:</label><input class="widefat" id="<?php echo $this->get_field_id('pinterest_url'); ?>" name="<?php echo $this->get_field_name('pinterest_url'); ?>" type="text" value="<?php echo attribute_escape($pinterest_url); ?>" /></p>
    <p><label for="<?php echo $this->get_field_id('feed_url'); ?>">Feed URL:</label><input class="widefat" id="<?php echo $this->get_field_id('feed_url'); ?>" name="<?php echo $this->get_field_name('feed_url'); ?>" type="text" value="<?php echo attribute_escape($feed_url); ?>" /></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['twitter_url'] = $new_instance['twitter_url'];
	$instance['facebook_url'] = $new_instance['facebook_url'];
	$instance['google_url'] = $new_instance['google_url'];
	$instance['linkedin_url'] = $new_instance['linkedin_url'];
	$instance['youtube_url'] = $new_instance['youtube_url'];
	$instance['pinterest_url'] = $new_instance['pinterest_url'];
	$instance['feed_url'] = $new_instance['feed_url'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	$twitter_url = empty($instance['twitter_url']) ? ' ' : apply_filters('widget_title', $instance['twitter_url']);
	$facebook_url = empty($instance['facebook_url']) ? ' ' : apply_filters('widget_title', $instance['facebook_url']);
	$google_url = empty($instance['google_url']) ? ' ' : apply_filters('widget_title', $instance['google_url']);
	$linkedin_url = empty($instance['linkedin_url']) ? ' ' : apply_filters('widget_title', $instance['linkedin_url']);
	$youtube_url = empty($instance['youtube_url']) ? ' ' : apply_filters('widget_title', $instance['youtube_url']);
	$pinterest_url = empty($instance['pinterest_url']) ? ' ' : apply_filters('widget_title', $instance['pinterest_url']);
	$feed_url = empty($instance['feed_url']) ? ' ' : apply_filters('widget_title', $instance['feed_url']);

    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
	$html = '';
	if ( ' ' !== $twitter_url)
		$html .= '<a href="'.$twitter_url.'" class="ssw-square ssw-twitter" title="Twitter" target="_blank"><span>Twitter</span></a>';
	if ( ' ' !== $facebook_url)
		$html .= '<a href="'.$facebook_url.'" class="ssw-square ssw-facebook" title="Facebook" target="_blank"><span>Facebook</span></a>';
	if ( ' ' !== $google_url)
		$html .= '<a href="'.$google_url.'" class="ssw-square ssw-google" title="Google+" target="_blank"><span>Google+</span></a>';
	if ( ' ' !== $linkedin_url)
		$html .= '<a href="'.$linkedin_url.'" class="ssw-square ssw-linkedin" title="LinkedIn" target="_blank"><span>LinkedIn</span></a>';
	if ( ' ' !== $youtube_url)
		$html .= '<a href="'.$youtube_url.'" class="ssw-square ssw-youtube" title="YouTube" target="_blank"><span>YouTube</span></a>';
	if ( ' ' !== $pinterest_url)
		$html .= '<a href="'.$pinterest_url.'" class="ssw-square ssw-pinterest" title="Pinterest" target="_blank"><span>Pinterest</span></a>';
	if ( ' ' !== $feed_url)
		$html .= '<a href="'.$feed_url.'" class="ssw-square ssw-rss" title="RSS" target="_blank"><span>RSS</span></a>';
	$html .= '<div class="clear">&nbsp;</div>';
    echo $html;
	
	echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("AE_Simple_Social_Widget");') );


add_action('wp_enqueue_scripts', 'add_ssw_stylesheet');
function add_ssw_stylesheet() {
        wp_register_style( 'sswStyleSheets', plugins_url('ssw-styles.css', __FILE__) );
        wp_enqueue_style( 'sswStyleSheets' );
    }

?>