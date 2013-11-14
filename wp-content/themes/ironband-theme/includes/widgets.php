<?php

/**
 * Custom Widgets
 *
 * Widgets :
 * - Iron_Widget_Radio
 * - Iron_Widget_Twitter
 * - Iron_Widget_Terms
 * - Iron_Widget_Recent_Posts
 * - Iron_Widget_Recent_Videos
 * - Iron_Widget_Upcoming_Events
 *
 * @link http://codex.wordpress.org/Function_Reference/register_widget
 */

$iron_widgets = array(
	  'Iron_Widget_Radio'           => IRON_WIDGET_PREFIX . _x('Radio Player', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Twitter'         => IRON_WIDGET_PREFIX . _x('Recent Tweets', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Terms'           => IRON_WIDGET_PREFIX . _x('Terms', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Recent_Posts'    => IRON_WIDGET_PREFIX . __('Recent Posts', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Recent_Videos'   => IRON_WIDGET_PREFIX . __('Recent Videos', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Upcoming_Events' => IRON_WIDGET_PREFIX . __('Upcoming Events', 'Widget', IRON_TEXT_DOMAIN)
	, 'Iron_Widget_Newsletter'      => IRON_WIDGET_PREFIX . __('Newsletter', 'Widget', IRON_TEXT_DOMAIN)
);



/**
 * Radio Widget Class
 *
 * @since 1.6.0
 * @todo  - Add options
 */

class Iron_Widget_Radio extends WP_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;

	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_radio'
			, 'description' => _x('A simple radio that plays a list of songs from the Home page template.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			//'playlist'     => ''
			//'show_art'     => true
			//'action_label' => get_iron_option('albums_widget_action_label')
			//'action_link'  => get_iron_option('page_for_albums')
			//'action_icon'  => get_iron_option('albums_widget_action_icon')
		);

		parent::__construct('iron-radio', IRON_WIDGET_PREFIX . _x('Radio Player', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);
	}

	/**
	 * Front-end display of widget.
	 */

	public function widget ( $args, $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		// $playlist = apply_filters( 'iron_widget_playlist', $instance['playlist'], $instance, $this->id_base );

		/***/

		$action = iron_widget_action_link( 'album', get_iron_option('page_for_albums') );

		$playlist = iron_get_playlist();
		if ( isset($playlist['tracks']) && ! empty($playlist['tracks']) )
			$player_message = _x('Loading tracks...', 'Widget', IRON_TEXT_DOMAIN);
		else
			$player_message = _x('No tracks founds...', 'Widget', IRON_TEXT_DOMAIN);

		/***/

		if ( ! $playlist )
			return;

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo sprintf( $args['before_title'], $action ) . $title . $args['after_title'];

		echo '
			<div class="panel__body player-holder" data-url-playlist="' . home_url('?load=playlist.json') . '">
				<div class="info-box">
					<img class="poster-image" src="'.IRON_PARENT_URL.'/images/player-thumb.jpg" width="107" height="107" alt="">
					<div class="text player-title-box">'.$player_message.'</div>
				</div>
				<!-- jplayer markup start -->
				<div id="audio-holder">
					<div class="jp-jplayer"></div>
					<!-- jp-audio player-box -->
					<div class="jp-audio player-box">
						<div class="jp-type-playlist">
							<div class="jp-gui jp-interface">
								<!-- time-box -->
								<div class="time-box">
									<div class="jp-current-time"></div>
									<div class="jp-duration"></div>
								</div>
								<!-- jp-controls -->
								<ul class="jp-controls">
									<li><a href="javascript:;" class="jp-previous" tabindex="1"><i class="icon-backward" title="'.__("previous", IRON_TEXT_DOMAIN).'"></i></a></li>
									<li><a href="javascript:;" class="jp-play" tabindex="1"><i class="icon-play" title="'.__("play", IRON_TEXT_DOMAIN).'"></i></a></li>
									<li><a href="javascript:;" class="jp-pause" tabindex="1"><i class="icon-pause" title="'.__("pause", IRON_TEXT_DOMAIN).'"></i></a></li>
									<li><a href="javascript:;" class="jp-next" tabindex="1"><i class="icon-forward" title="'.__("next", IRON_TEXT_DOMAIN).'"></i></a></li>
								</ul>
								<!-- jp-progress -->
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
							</div>
							<!-- jp-playlist hidden -->
							<div class="jp-playlist hidden">
								<ul>
									<li></li>
								</ul>
							</div>
							<!-- jp-no-solution -->
							<div class="jp-no-solution '.(empty($playlist['tracks']) ? 'hidden' : '').'">
								<span>'.__("Update Required", IRON_TEXT_DOMAIN).'</span>
								'.__("To play the media you will need to either update your browser to a recent version or update your", IRON_TEXT_DOMAIN).' <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
							</div>
						</div>
					</div>
				</div>
			</div>';

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 */

	public function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = esc_attr( $instance['title'] );

?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _ex('Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" placeholder="<?php _e('Popular Songs', IRON_TEXT_DOMAIN); ?>" />
		</p>
<?php
		$page_on_front = get_option('page_on_front');

		if ( $page_on_front ) :
?>
		<p><?php printf( __('The playlist is editable from the page with the <a target="_blank" href="%1$s">Home</a> template.', IRON_TEXT_DOMAIN), get_edit_post_link( $page_on_front ) ); ?></p>
<?php
		endif;

/*
		// Get playlists
		$playlists = new WP_Query( array(
			  'post_type'      => 'playlist'
			, 'posts_per_page' => -1
			, 'no_found_rows'  => true
		) );

		if ( $playlists->have_posts() ) :

?>
		<p>
			<label for="<?php echo $this->get_field_id('playlist'); ?>"><?php _ex('Select Playlist:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<select id="<?php echo $this->get_field_id('playlist'); ?>" name="<?php echo $this->get_field_name('playlist'); ?>">
<?php
			foreach ( $playlists->posts as $list ) {
				echo "\t\t\t" . '<option value="' . $list->ID . '"' . selected( $instance['playlist'], $list->ID, false ) . '>'. esc_attr($list->post_title) . '</option>';
			}
?>
			</select>
		</p>
<?php

		else :
			// If no playlists exists, direct the user to go and create some.
			if ( ! $playlists ) {
				echo '<p>'. sprintf( _x('No playlists have been created yet. <a href="%s">Create some</a>.', 'Widget', IRON_TEXT_DOMAIN), admin_url('edit.php?post_type=playlist') ) .'</p>';
				return;
			}
		endif;
*/
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */

	public function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		// $instance['playlist'] = (int) $new_instance['playlist'];

		return $instance;
	}

} // class Iron_Widget_Radio



/**
 * Twitter Widget Class
 *
 * @since 1.6.0
 * @todo  - Add options
 */

class Iron_Widget_Twitter extends WP_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;

	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_recent_tweets'
			, 'description' => _x('The most recent tweet.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'           => ''
			, 'screen_name'     => ''
			//'count'           => 1
			//'exclude_replies' => true
			//'expand_media'    => true
			//'action_label'    => get_iron_option('twitter_widget_action_label')
			//'action_link'     => get_iron_option('twitter_page')
			//'action_icon'     => get_iron_option('twitter_widget_action_icon')
		);

		parent::__construct('iron-recent-tweets', IRON_WIDGET_PREFIX . _x('Recent Tweets', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);
	}

	/**
	 * Front-end display of widget.
	 */

	public function widget ( $args, $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$username = apply_filters( 'iron_widget_screen_name', $instance['screen_name'], $instance, $this->id_base );

		if ( ! $username )
			return;

		$action = iron_widget_action_link( 'twitter', 0, 'https://twitter.com/' . $username );

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo sprintf( $args['before_title'], $action ) . $title . $args['after_title'];

		echo '
			<div class="panel__body">
				<div id="twitter" class="query" data-username="'.$username.'"></div>
			</div>';

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 */

	public function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = esc_attr( $instance['title'] );
		$username = esc_attr( $instance['screen_name'] );

?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _ex('Title:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" placeholder="<?php _e('Live from Twitter', IRON_TEXT_DOMAIN); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('screen_name'); ?>"><?php _ex('Screen Name:', 'Widget', IRON_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('screen_name'); ?>" name="<?php echo $this->get_field_name('screen_name'); ?>" value="<?php echo $username; ?>" placeholder="@IronTemplates" />
		</p>
<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 */

	public function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['screen_name'] = str_replace('@', '', strip_tags( stripslashes($new_instance['screen_name']) ));

		return $instance;
	}

} // class Iron_Widget_Twitter


/**
 * Terms Widget Class
 *
 * @since 1.6.0
 */
class Iron_Widget_Terms extends WP_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;

	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_terms'
			, 'description' => _x('A list or dropdown of terms', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			, 'taxonomy'     => 'category'
			, 'count'        => 0
			, 'hierarchical' => 0
			, 'dropdown'     => 0
		);

		parent::__construct('iron-terms', IRON_WIDGET_PREFIX . __('Terms'), $widget_ops);
	}

	function widget ( $args, $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$taxonomy = $instance['taxonomy'];
		$c = $instance['count'];
		$h = $instance['hierarchical'];
		$d = $instance['dropdown'];

		echo $before_widget;
		if ( $title )
			echo sprintf( $before_title, '' ) . $title . $after_title;

		$term_args = array(
			  'taxonomy'           => $taxonomy
			, 'orderby'            => 'name'
			, 'order'              => 'ASC'
			, 'hide_empty'         => 1
			, 'show_count'         => $c
			, 'hierarchical'       => $h
			, 'title_li'           => false
			, 'depth'              => 0
			, 'style'              => 'list'
			, 'orderby'            => 'name'
			, 'use_desc_for_title' => 1
			, 'child_of'           => 0
			, 'exclude'            => ''
			, 'exclude_tree'       => ''
			, 'current_category'   => 0
		);

		$terms = get_terms( $taxonomy, array( 'orderby' => 'name', 'hierarchical' => $h ) );

		if ( $d ) :
			$term_args['show_option_none'] = __('Select Term');

?>
<select id="tax-<?php echo $taxonomy; ?>" class="terms-dropdown" name="<?php echo $this->get_field_name('taxonomy'); ?>">
	<option><?php echo $term_args['show_option_none']; ?></option>
<?php
			foreach ( $terms as $term ) {
				echo '<option value="' . $term->term_id . '">'. $term->name . ( $c ? ' (' . $term->count . ')' : '' ) . '</option>';
			}
?>
</select>

<script>
/* <![CDATA[ */
	var dropdown = document.getElementById('tax-<?php echo esc_attr($taxonomy); ?>');
	function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo home_url(); ?>/?taxonomy=<?php echo esc_url($taxonomy); ?>&term="+dropdown.options[dropdown.selectedIndex].value;
		}
	}
	dropdown.onchange = onCatChange;
/* ]]> */
</script>

<?php
		else :
			$taxonomy_object = get_taxonomy( $taxonomy );

			$term_args['show_option_all'] = $taxonomy_object->labels->all_items;

			$posts_page = ( 'page' == get_option('show_on_front') && get_option('page_for_posts') ) ? get_permalink( get_option('page_for_posts') ) : get_iron_option('page_for_' . $taxonomy_object->object_type[0] . 's');
			$posts_page = esc_url( $posts_page );
?>
		<ul class="terms-list">
			<li><a href="<?php echo $posts_page; ?>"><i class="icon-plus"></i> <?php echo $term_args['show_option_all']; ?></a></li>
<?php
			// wp_list_categories( apply_filters('widget_categories_args', $term_args) );
/*
			if ( $h )
				$depth = 0;
			else
				$depth = -1; // Flat.

			walk_category_tree( $categories, $depth, $r );
*/
			foreach ( $terms as $term ) {
				echo '<li><a href="' . get_term_link( $term, $taxonomy ) . '"><i class="icon-plus"></i> ' . $term->name . ( $c ? ' <small>(' . $term->count . ')</small>' : '' ) . '</a></li>';
			}
?>
		</ul>
<?php
		endif;

		echo $after_widget;
	}

	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		// $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

		return $instance;
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = esc_attr( $instance['title'] );
		$count = (bool) $instance['count'];
		// $hierarchical = (bool) $instance['hierarchical'];
		$dropdown = (bool) $instance['dropdown'];
		$taxonomy = esc_attr( $instance['taxonomy'] );

		# Get taxonomiues
		$taxonomies = get_taxonomies( array( 'public' => true ) );

		# If no taxonomies exists
		if ( ! $taxonomies ) {
			echo '<p>'. __('No taxonomies have been created yet.', IRON_TEXT_DOMAIN) .'</p>';
			return;
		}

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" placeholder="<?php _e('Categories', IRON_TEXT_DOMAIN); ?>" /></p>

		<p>
			<label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e( 'Select Taxonomy:' ); ?></label>
			<select id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
		<?php
			foreach ( $taxonomies as $tax ) {
				$tax = get_taxonomy($tax);
				echo '<option value="' . $tax->name . '"' . selected( $taxonomy, $tax->name, false ) . '>'. $tax->label . '</option>';
			}
		?>
			</select>
		</p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />
<?php /*
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
<?php
*/
	}

} // class Iron_Widget_Terms



/**
 * Recent_Posts Widget Class
 *
 * @since 1.6.0
 * @see   WP_Widget_Recent_Posts
 * @todo  - Add advanced options
 *        - Merge Events, and Videos
 */

class Iron_Widget_Recent_Posts extends WP_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;

	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_recent_posts'
			, 'description' => _x('The most recent posts on your site.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			//'action_label' => get_iron_option('posts_widget_action_label')
			//'action_link'  => get_option('page_for_posts')
			//'action_icon'  => get_iron_option('posts_widget_action_icon')
			, 'post_type'    => 'post'
			//'order'        => 'DESC'
			//'orderby'      => 'date'
			, 'number'       => get_option('posts_per_page')
			//'taxonomy'     => array()
			, 'show_date'    => true
			//'thumbnails'   => true
		);

		parent::__construct('iron-recent-posts', IRON_WIDGET_PREFIX . __('Recent Posts', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget ( $args, $instance )
	{
		$cache = wp_cache_get('iron_widget_recent_posts', 'widget');

		if ( ! is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$post_type  = apply_filters( 'widget_post_type', $instance['post_type'], $instance, $this->id_base );
		$number     = $instance['number'];
		$show_date  = $instance['show_date'];
		// $thumbnails = $instance['thumbnails'];

		$r = new WP_Query( apply_filters( 'iron_widget_posts_args', array(
			  'post_type'           => $post_type
			, 'posts_per_page'      => $number
			, 'no_found_rows'       => true
			, 'post_status'         => 'publish'
			, 'ignore_sticky_posts' => true
		) ) );

		if ( $r->have_posts() ) :

			$action = iron_widget_action_link( $post_type, get_option('page_for_posts') );
/*
			switch ( $post_type ) {
				case 'post'  : $classname = ' responsive1'; break;
				case 'gig'   : $classname = ' responsive2'; break;
				case 'video' : $classname = ' responsive3'; break;
				default      : $classname = ''; break;
			}
*/
			global $iron_sidebar_grid;

			$is_front = ( is_front_page() || is_page_template('page-home.php') ) && ( 1 == $iron_sidebar_grid );
			if ( $is_front ) {
				$tag = 'section';

				echo '<' . $tag . ' class="section">' . "\n";

				if ( ! empty( $title ) ) :
?>
				<header class="heading">
					<?php echo $action . "\n"; ?>
					<h1><?php echo $title; ?></h1>
				</header>
<?php
				endif;

			} else {

				echo $before_widget;

				if ( ! empty( $title ) )
					echo sprintf( $before_title, $action ) . $title . $after_title;

			}
?>
				<div class="carousel responsive1">
					<div class="carousel__wrapper">
						<div class="slideset">

<?php
				while ( $r->have_posts() ) : $r->the_post();
?>
					<div class="slide">
						<a href="<?php the_permalink(); ?>">
<?php
					if ( has_post_thumbnail() ) :
?>
 							<div class="image"><?php the_post_thumbnail( 'image-thumb', array( 'alt' => get_the_title() ) ); ?></div>
<?php
					endif;
?>
							<div class="text">
								<h2><?php the_title(); ?></h2>
<?php
					if ( $show_date ) :
?>
								<time class="datetime" datetime="<?php the_time('c'); ?>"><?php echo get_the_date(); ?></time>
<?php
					endif;
?>
								<i class="more icon-plus" title="<?php _e('More', IRON_TEXT_DOMAIN); ?>"></i>
							</div>
						</a>
					</div>
<?php
				endwhile;
?>

						</div>
					</div>
					<a class="btn-prev" href="#"><i class="icon-left-open-big" title="<?php _e('Previous', IRON_TEXT_DOMAIN); ?>"></i></a>
					<a class="btn-next" href="#"><i class="icon-right-open-big" title="<?php _e('Next', IRON_TEXT_DOMAIN); ?>"></i></a>
				</div>

<?php
			if ( $is_front )
				echo '</' . $tag . '>' . "\n";
			else {
				echo $after_widget;
			}

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('iron_widget_recent_posts', $cache, 'widget');
	}

	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : true;
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache ()
	{
		wp_cache_delete('iron_widget_recent_posts', 'widget');
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : true;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" placeholder="<?php _e('Latest News', IRON_TEXT_DOMAIN); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
	}
} // class Iron_Widget_Recent_Posts



/**
 * Recent_Videos Widget Class
 *
 * @since 1.6.0
 * @see   WP_Widget_Recent_Posts
 * @todo  - Add advanced options
 *        - Merge Events, and Posts
 */

class Iron_Widget_Recent_Videos extends WP_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;

	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_recent_videos'
			, 'description' => _x('The most recent videos on your site.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			//'action_label' => get_iron_option('videos_widget_action_label')
			//'action_link'  => get_iron_option('page_for_videos')
			//'action_icon'  => get_iron_option('videos_widget_action_icon')
			, 'post_type'    => 'video'
			//'order'        => 'DESC'
			//'orderby'      => 'date'
			, 'number'       => get_iron_option('videos_per_page')
			//'taxonomy'     => array()
			//'show_date'    => true
			//'thumbnails'   => true
		);

		parent::__construct('iron-recent-videos', IRON_WIDGET_PREFIX . __('Recent Videos', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget ( $args, $instance )
	{
		$cache = wp_cache_get('iron_widget_recent_videos', 'widget');

		if ( ! is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$post_type  = apply_filters( 'widget_post_type', $instance['post_type'], $instance, $this->id_base );
		$number     = $instance['number'];
		// $show_date  = $instance['show_date'];
		// $thumbnails = $instance['thumbnails'];

		$r = new WP_Query( apply_filters( 'iron_widget_posts_args', array(
			  'post_type'           => $post_type
			, 'posts_per_page'      => $number
			, 'no_found_rows'       => true
			, 'post_status'         => 'publish'
			, 'ignore_sticky_posts' => true
		) ) );

		if ( $r->have_posts() ) :

			$action = iron_widget_action_link( $post_type, get_iron_option('page_for_videos') );

			global $iron_sidebar_grid;

			$is_front = ( is_front_page() || is_page_template('page-home.php') ) && ( 1 == $iron_sidebar_grid );
			if ( $is_front ) {
				$tag = 'section';

				echo '<' . $tag . ' class="section">' . "\n";

				if ( ! empty( $title ) ) :
?>
				<header class="heading">
					<?php echo $action . "\n"; ?>
					<h1><?php echo $title; ?></h1>
				</header>
<?php
				endif;

			} else {

				echo $before_widget;

				if ( ! empty( $title ) )
					echo sprintf( $before_title, $action ) . $title . $after_title;

			}
?>
				<div class="carousel responsive3">
					<div class="carousel__wrapper">
						<div class="slideset">

<?php
				while ( $r->have_posts() ) : $r->the_post();
?>
					<div class="slide">
						<a class="video-box" href="<?php the_permalink(); ?>">
<?php
					if ( has_post_thumbnail() ) :
?>
							<div class="image"><?php the_post_thumbnail( 'image-thumb', array( 'alt' => get_the_title() ) ); ?></div>

							<div class="hover-box hover-box__centered">
								<div class="hover-box__inner">
									<h2><?php the_title(); ?></h2>
									<i class="icon-play"></i>
									<span class="btn-play"><?php _e('Play Video', IRON_TEXT_DOMAIN); ?></span>
								</div>
							</div>

<?php
					else :
?>
							<div class="text">
								<h2><?php the_title(); ?></h2>
								<i class="more icon-plus" title="<?php _e('More', IRON_TEXT_DOMAIN); ?>"></i>
							</div>
<?php
					endif;
?>
						</a>
					</div>
<?php
				endwhile;
?>

						</div>
					</div>
					<a class="btn-prev" href="#"><i class="icon-left-open-big" title="<?php _e('Previous', IRON_TEXT_DOMAIN); ?>"></i></a>
					<a class="btn-next" href="#"><i class="icon-right-open-big" title="<?php _e('Next', IRON_TEXT_DOMAIN); ?>"></i></a>
				</div>

<?php
			if ( $is_front )
				echo '</' . $tag . '>' . "\n";
			else {
				echo $after_widget;
			}

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('iron_widget_recent_videos', $cache, 'widget');
	}

	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache ()
	{
		wp_cache_delete('iron_widget_recent_videos', 'widget');
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" placeholder="<?php _e('Recent Videos', IRON_TEXT_DOMAIN); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of videos to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
} // class Iron_Widget_Recent_Videos



/**
 * Upcoming_Events Widget Class
 *
 * @since 1.6.0
 * @see   WP_Widget_Recent_Posts
 * @todo  - Add advanced options
 *        - Merge Videos, and Posts
 */

class Iron_Widget_Upcoming_Events extends WP_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;

	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_upcoming_events'
			, 'description' => _x('The most upcoming events on your site.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'        => ''
			//'action_label' => get_iron_option('gigs_widget_action_label')
			//'action_link'  => iron_get_page_for_post_type('gig', 'archive-gig.php')
			//'action_icon'  => get_iron_option('gigs_widget_action_icon')
			, 'post_type'    => 'gig'
			//'order'        => 'DESC'
			//'orderby'      => 'date'
			, 'number'       => get_iron_option('gigs_per_page')
			//'taxonomy'     => array()
			//'show_date'    => true
			//'thumbnails'   => true
		);

		parent::__construct('iron-recent-events', IRON_WIDGET_PREFIX . __('Upcoming Events', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget ( $args, $instance )
	{
		$cache = wp_cache_get('iron_widget_upcoming_events', 'widget');

		if ( ! is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$post_type  = apply_filters( 'widget_post_type', $instance['post_type'], $instance, $this->id_base );
		$number     = $instance['number'];
		// $show_date  = $instance['show_date'];
		// $thumbnails = $instance['thumbnails'];

		$r = new WP_Query( apply_filters( 'iron_widget_posts_args', array(
			  'post_type'           => $post_type
			, 'posts_per_page'      => $number
			, 'no_found_rows'       => true
			, 'post_status'         => 'publish'
			, 'ignore_sticky_posts' => true
		) ) );

		if ( $r->have_posts() ) :

			global $iron_sidebar_grid, $post;

			$action = iron_widget_action_link( $post_type, iron_get_page_for_post_type('gig', 'archive-gig.php') );

			$is_front = ( is_front_page() || is_page_template('page-home.php') ) && ( 1 == $iron_sidebar_grid );
			if ( $is_front ) {
				$tag = 'section';

				echo '<' . $tag . ' class="section">' . "\n";

				if ( ! empty( $title ) ) :
?>
				<header class="heading">
					<?php echo $action . "\n"; ?>
					<h1><?php echo $title; ?></h1>
				</header>
<?php
				endif;

			} else {

				echo $before_widget;

				if ( ! empty( $title ) )
					echo sprintf( $before_title, $action ) . $title . $after_title;

			}
?>
				<div class="carousel responsive2">
					<div class="carousel__wrapper">
						<div class="slideset">

<?php
				$permalink_enabled = (bool) get_option('permalink_structure');
				while ( $r->have_posts() ) : $r->the_post();
					$permalink = get_permalink( iron_get_page_for_post_type('gig', 'archive-gig.php') ) . ( $permalink_enabled ? '?' : '&' ) . 'id=' . $post->ID;
?>
					<div class="slide">
						<a class="concert-box" href="<?php echo $permalink; ?>">
							<div class="info">
								<?php iron_the_gig_date(); ?>

								<span class="event-title"><?php the_title(); ?></span>

<?php
			if ( get_field('gig_city') ) {
?>
								<span class="event-location">@<?php the_field('gig_city'); ?></span>
<?php
			}
?>
							</div>
							<div class="hover-box"><?php _e(get_iron_option('gig_more_label'), IRON_TEXT_DOMAIN); ?></div>
							<i class="more icon-plus" title="<?php _e('More', IRON_TEXT_DOMAIN); ?>"></i>
						</a>
					</div>
<?php
				endwhile;
?>

						</div>
					</div>
					<a class="btn-prev" href="#"><i class="icon-left-open-big" title="<?php _e('Previous', IRON_TEXT_DOMAIN); ?>"></i></a>
					<a class="btn-next" href="#"><i class="icon-right-open-big" title="<?php _e('Next', IRON_TEXT_DOMAIN); ?>"></i></a>
				</div>

<?php
			if ( $is_front )
				echo '</' . $tag . '>' . "\n";
			else {
				echo $after_widget;
			}

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('iron_widget_recent_videos', $cache, 'widget');
	}

	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();

		return $instance;
	}

	function flush_widget_cache ()
	{
		wp_cache_delete('iron_widget_recent_videos', 'widget');
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" placeholder="<?php _e('Upcoming Events', IRON_TEXT_DOMAIN); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of events to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
} // class Iron_Widget_Upcoming_Events



/**
 * Newsletter Widget Class
 *
 * @since 1.6.0
 * @todo  - Add options
 */

class Iron_Widget_Newsletter extends WP_Widget
{
	/**
	 * Widget Defaults
	 */

	public static $widget_defaults;

	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'iron_widget_newsletter'
			, 'description' => _x('The IronBand newsletter or Mailchimp add-on.', 'Widget', IRON_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title'           => ''
			//'type'            => get_iron_option('newsletter_type')
			//'submit_label'    => get_iron_option('newsletter_submit_button_label')
			//'success_message' => get_iron_option('newsletter_success')
			//'exists_message'  => get_iron_option('newsletter_exists')
			//'invalid_message' => get_iron_option('newsletter_invalid')
			//'error_message'   => get_iron_option('newsletter_error')
		);

		parent::__construct('iron-newsletter', IRON_WIDGET_PREFIX . _x('Newsletter', 'Widget', IRON_TEXT_DOMAIN), $widget_ops);
	}

	/**
	 * Front-end display of widget.
	 */

	public function widget ( $args, $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		$is_footer = ( did_action('before_ironband_footer_dynamic_sidebar') && ! did_action('after_ironband_footer_dynamic_sidebar') );

		if ( ! $is_footer )
		{
			if ( ! empty( $title ) )
				echo sprintf( $args['before_title'], '' ) . $title . $args['after_title'];
		}
?>

			<form class="form-inline">
				<input type="hidden" id="<?php echo $args['widget_id']; ?>-action" name="action" value="<?php echo get_iron_option('newsletter_type'); ?>">
				<fieldset class="form-group">
<?php
		if ( $is_footer ) :
?>
					<label class="control-label" for="<?php echo $args['widget_id']; ?>-email"><?php echo $title; ?></label>
<?php
		endif;
?>
					<div class="control-append">
						<input type="email" class="form-control input-text input-email" id="<?php echo $args['widget_id']; ?>-email" name="email">
						<input type="submit" value="<?php _e(get_iron_option('newsletter_submit_button_label'), IRON_TEXT_DOMAIN); ?>">
					</div>
					<p class="form-status"></p>
				</fieldset>
			</form>

<?php

		echo $args['after_widget'];
	}

	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
<?php
	}
} // class Iron_Widget_Newsletter



/**
 * jQuery Slider Revolution "Widget"
 *
 * @since 1.0.0
 * @todo  - Replace with Slider Revolution for WordPress
 */

function iron_get_home_slider ()
{
	$query = new WP_Query( array(
		  'post_type' => 'slide'
		, 'no_found_rows' => true
	) );

	$output = '';

	if ( $query->have_posts() ) :

		$output = array();

		while ( $query->have_posts() ) : $query->the_post();
			if ( ! has_post_thumbnail() ) continue;

			if ( get_field('slide_link_type') == 'internal' ) {
				$link = get_field('slide_link');
				$target = '';
			} else {
				$link = get_field('slide_link_external');
				$target = ' target="blank" ';
			}

			if ( ! $action = get_field('slide_more_text') ) {
				if ( ! $action = get_iron_option('slide_more_label') ) {
					$action = __('Read More', IRON_TEXT_DOMAIN);
				}
			}

			$title = get_the_title();

			if ( ! $icon = get_iron_option('slides_widget_action_icon') )
				$icon = 'plus';

			$output[] = '
				<li class="slide" data-transition="slidedown" data-slotamount="10" data-masterspeed="300">
					' . get_the_post_thumbnail( get_the_ID(), 'full' ) . '
					<div class="caption text-box lfl lfl" data-x="0" data-y="140" data-speed="300" data-start="800" data-easing="easeOutExpo">'
						. ( empty($title) ? '<div class="placeholder"></div>' : '<h1><span>' . get_the_title() . '</span></h1>' . ( empty($link)  ? '' : '<a class="more" href="' . $link . '"' . $target . '><i class="icon-' . $icon .'"></i> ' . $action . '</a>' ) )
						. '<div class="tp-leftarrow tparrows"><i class="icon-caret-left"></i></div>
						<div class="tp-rightarrow tparrows"><i class="icon-caret-right"></i></div>
					</div>
				</li>';

		endwhile;

		if ( empty($output) ) :
			$output = '';
		else :
			$output = '
	<!-- marquee -->
	<div class="marquee__container">
		<div id="home-marquee" class="marquee">
			<ul class="slideset">'
			. implode("\n", $output).
			'</ul>
		</div>
	</div>';
		endif;

		wp_reset_postdata();

	endif;

	return $output;
} // function iron_get_home_slider
