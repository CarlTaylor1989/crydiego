<?php

/*

@name 			Recent Tweet Widget
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Widget Recent Tweet
====================================================================================================
*/

class gp_Widget_Recent_Tweet extends WP_Widget {

	function gp_Widget_Recent_Tweet() {

		$widget_options = array(
			'classname'								=> 'widget_recent_tweet',
			'description'							=> __('Widget that displays recent tweet from the Twitter account.', 'gp')
		);
		
		$control_options = array(
			'id_base'								=> 'widget_recent_tweet'
		);

		$this->WP_Widget('widget_recent_tweet', __('Muse: Recent Tweet', 'gp'), $widget_options, $control_options);

	}

	function widget($args, $instance) {
		
		extract($args);
		
		$widget_title				= apply_filters('widget_title', $instance[__('widget_title')]);
		$twitter_username			= $instance['twitter_username'];
		$twitter_number				= '1';
		$twitter_duration			= $instance['twitter_duration'];
		$twitter_hide_replies		= $instance['twitter_hide_replies'];
		$follow_button_show			= $instance['follow_button_show'];
		$follow_button_text			= $instance[__('follow_button_text')];
		
		echo $before_widget;

		if (!empty($widget_title)) {
			
			echo $before_title . $widget_title . $after_title;
			
		}

		echo '<ul>' . "\n";

		$tweets = get_transient($twitter_username . '-' . $twitter_duration);

		if (!$tweets) {

			$counter = isset($twitter_hide_replies) ? (int)$twitter_number + 100 : (int)$twitter_number;
			$twitter = wp_remote_retrieve_body(wp_remote_request(sprintf('http://api.twitter.com/1/statuses/user_timeline.json?screen_name=%s&count=%s&trim_user=1', $twitter_username, $counter), array('timeout' => 100)));

			$json = json_decode($twitter);

			if (!$twitter) {
				$tweets[] = '<li>' . __('The Twitter API is taking too long to respond. Please try again later.', 'gp') . '</li>' . "\n";
			} else if (is_wp_error($twitter)) {
				$tweets[] = '<li>' . __('There was an error while attempting to contact the Twitter API. Please try again.', 'gp') . '</li>' . "\n";
			} else if (is_object($json) && $json->error) {
				$tweets[] = '<li>' . __('The Twitter API returned an error while processing your request. Please try again.', 'gp') . '</li>' . "\n";
			} else {

				foreach((array)$json as $tweet) {

					if ($twitter_hide_replies && $tweet->in_reply_to_user_id) {
						continue;
					}

					if (!empty($tweets[(int)$twitter_number - 1])) {
						break;
					}

					$timeago = sprintf(__('about %s ago', 'gp'), human_time_diff(strtotime($tweet->created_at)));
					$timeago_link = sprintf('<a href="%s" rel="nofollow" target="_blank">%s</a>', esc_url(sprintf('http://twitter.com/%s/status/%s', $twitter_username, $tweet->id_str)), esc_html($timeago));

					$tweets[] = '<li><span class="tweet_time">' . $timeago_link . '</span><span class="tweet_text">' . $this->tweet_linkify($tweet->text) . '</span></li>' . "\n";

				}

				$tweets = array_slice((array)$tweets, 0, (int)$twitter_number);

				$time = (absint($twitter_duration) * 60);

				set_transient($twitter_username . '-' . $twitter_duration, $tweets, $time);

			}

		}

		foreach( (array)$tweets as $tweet ) {
			echo $tweet;
		}

		echo '</ul>' . "\n";
		
		if ($follow_button_show && $follow_button_text) {
			echo '<div class="button"><a href="' . esc_url('http://twitter.com/' . $twitter_username) . '" target="_blank">' . esc_html($follow_button_text) . '</a></div>';
		}

		echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
		
		delete_transient($old_instance['twitter_username'] . '-' . $old_instance['twitter_duration']);
		
		$instance = $old_instance;

		$instance['widget_title']			= $new_instance['widget_title'];
		$instance['twitter_username']		= $new_instance['twitter_username'];
		$instance['twitter_duration']		= $new_instance['twitter_duration'];
		$instance['twitter_hide_replies']	= $new_instance['twitter_hide_replies'];
		$instance['follow_button_show']		= $new_instance['follow_button_show'];
		$instance['follow_button_text']		= $new_instance['follow_button_text'];

		return $instance;
		
	}

	function form($instance) {

		$defaults = array(
			'widget_title'					=> __('Recent Tweet', 'gp'),
			'twitter_username'				=> '',
			'twitter_duration'				=> '',
			'twitter_hide_replies'			=> false,
			'follow_button_show'			=> true,
			'follow_button_text'			=> __('Follow Us on Twitter', 'gp'),
		);
		
		$instance = wp_parse_args((array) $instance, $defaults);
		
		$widget_title						= isset($instance['widget_title']) ? esc_attr($instance['widget_title']) : '';
		$twitter_username					= isset($instance['twitter_username']) ? esc_attr($instance['twitter_username']) : '';
		$twitter_duration					= isset($instance['twitter_duration']) ? esc_attr($instance['twitter_duration']) : '';
		$twitter_hide_replies				= isset($instance['twitter_hide_replies']) ? esc_attr($instance['twitter_hide_replies']) : '';
		$follow_button_show					= isset($instance['follow_button_show']) ? esc_attr($instance['follow_button_show']) : '';
		$follow_button_text					= isset($instance['follow_button_text']) ? esc_attr($instance['follow_button_text']) : '';

	?>

		<p>
            
            <label for="<?php echo $this->get_field_id('widget_title'); ?>">
                <?php _e('Title', 'gp'); ?>
            </label>
            
            <input type="text" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" value="<?php echo $widget_title; ?>" />
            
        </p>

		<p>
            
            <label for="<?php echo $this->get_field_id('twitter_username'); ?>">
                <?php _e('Twitter Username', 'gp'); ?>
            </label>
            
            <input type="text" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo $twitter_username; ?>" />
            
        </p>
        
        <p>
			
            <label for="<?php echo $this->get_field_id('twitter_duration'); ?>">
				<?php _e('Load New Tweets Every', 'gp'); ?>
            </label>
            
			<select name="<?php echo $this->get_field_name('twitter_duration'); ?>" id="<?php echo $this->get_field_id('twitter_duration'); ?>">
				<option value="5" <?php selected(5, $twitter_duration); ?>><?php _e('5 Minutes', 'gp'); ?></option>
				<option value="15" <?php selected(15, $twitter_duration); ?>><?php _e('15 Minutes', 'gp'); ?></option>
				<option value="30" <?php selected(30, $twitter_duration); ?>><?php _e('30 Minutes', 'gp'); ?></option>
				<option value="60" <?php selected(60, $twitter_duration); ?>><?php _e('1 Hour', 'gp'); ?></option>
				<option value="120" <?php selected(120, $twitter_duration); ?>><?php _e('2 Hours', 'gp'); ?></option>
				<option value="240" <?php selected(240, $twitter_duration); ?>><?php _e('4 Hours', 'gp'); ?></option>
				<option value="720" <?php selected(720, $twitter_duration); ?>><?php _e('12 Hours', 'gp'); ?></option>
				<option value="1440" <?php selected(1440, $twitter_duration); ?>><?php _e('24 Hours', 'gp'); ?></option>
                <option value="2880" <?php selected(2880, $twitter_duration); ?>><?php _e('48 Hours', 'gp'); ?></option>
			</select>
            
		</p>
        
        <p>
        
        	<input class="checkbox" type="checkbox" <?php if ($follow_button_show) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('follow_button_show'); ?>" name="<?php echo $this->get_field_name('follow_button_show'); ?>">
            
			<label for="<?php echo $this->get_field_id('follow_button_show'); ?>">
            	<?php _e('Display Follow Button', 'gp'); ?>
            </label>
            
		</p>
        
        <p>
            
            <label for="<?php echo $this->get_field_id('follow_button_text'); ?>">
                <?php _e('Follow Button Text', 'gp'); ?>
            </label>
            
            <input type="text" id="<?php echo $this->get_field_id('follow_button_text'); ?>" name="<?php echo $this->get_field_name('follow_button_text'); ?>" type="text" value="<?php echo $follow_button_text; ?>" />
        
        </p>
        
        <p>
        
        	<input class="checkbox" type="checkbox" <?php if ($twitter_hide_replies) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('twitter_hide_replies'); ?>" name="<?php echo $this->get_field_name('twitter_hide_replies'); ?>">
            
			<label for="<?php echo $this->get_field_id('twitter_hide_replies'); ?>">
            	<?php _e('Hide Replies', 'gp'); ?>
            </label>
            
		</p>

	<?php
	}

	function tweet_linkify($tweet) {
	
		$tweet = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $tweet);
		$tweet = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $tweet);
		$tweet = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $tweet);
		$tweet = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $tweet);
	
		return $tweet;
	
	}

}