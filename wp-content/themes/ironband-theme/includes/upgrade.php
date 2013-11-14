<?php

/**
 * Upgrade
 *
 * All the functionality for upgrading IronBand
 *
 * @since 1.5.0
 */

function iron_upgrade () {
	global $wpdb; // $iron_updates

	# Don't run on theme activation
	if ( isset($_GET['activated']) && $_GET['activated'] == 'true' )
		return;
/*
	if ( ! current_user_can('update_themes') )
		wp_die( __('You do not have sufficient permissions to update this theme for this site.') );
*/
	$iron_theme  = wp_get_theme();
	$old_version = get_option( IRON_TEXT_DOMAIN . '_version', '1.0.0' ); // false
	$new_version = $iron_theme->get('Version'); // $iron_updates[0]['version'];

	if ( $new_version !== $old_version )
	{
		/*
		 * 1.4.0
		 *
		 * Migrate `gig_date` values from ACF
		 * to `post_date` from WordPress.
		 *
		 * @created 2013-09-13
		 * @updated 2013-10-03
		 */

		if ( $old_version < '1.4.1' )
		{
			$message = _x('Migrating Gig dates from Advanced Custom Fields to WordPress post date...', 'Upgrade', IRON_TEXT_DOMAIN);

			# Initial option introduced in 1.4.1 to track if migration was done.
			$migrated = get_option('iron_gig_dates_migrated', false);

			# Migration from initial release of 1.4.1 forgot to delete ACF field keys.
			if ( $migrated )
			{
				# Delete field value and field key
				$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key IN ('gig_date','_gig_date')");

				# Delete deprecated option in favor of version numbering.
				delete_option('iron_gig_dates_migrated');

			} else {

				$gigs = get_posts( array('post_type'=>'gig', 'posts_per_page' => -1, 'no_found_rows' => true) );

				foreach ( $gigs as $gig )
				{
					$gig_date = get_field('gig_date', $gig->ID);

					if ( $gig_date )
					{
						wp_update_post(array(
							'ID' => $gig->ID,
							'post_date' => date('Y-m-d H:i:s', strtotime( get_field('gig_date', $gig->ID) ))
						));

						delete_post_meta($gig->ID, 'gig_date');  # Field Value
						delete_post_meta($gig->ID, '_gig_date'); # Field Key
					}
				}

			}

			# Done
			update_option('ironband_version', '1.4.1');
		}



		/*
		 * 1.5.1
		 *
		 * Step 1 : Delete `vid_category` and `img_cat` fields
		 * from ACF in favor of native WordPress metabox.
		 *
		 * Step 2 : Migrate `vid_category` and `img_cat` taxonomies
		 * to hierarchical; from "tags" to "categories".
		 *
		 * @created 2013-10-03
		 */

		if ( $old_version < '1.5.1' )
		{
			$message = _x('Deprecating Video and Photo category dropdowns from Advanced Custom Fields in favor of WordPress native meta box...', 'Upgrade', IRON_TEXT_DOMAIN);

			# Step 1 : Delete `img_cat` and `vid_category` from ACF.
			# Values already saved in `wp_term_relationships` table.
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key IN ('vid_category', '_vid_category', 'img_cat','_img_cat')");

			# Step 2 : Make `img_cat` and `vid_category` taxonomies hierarchical, like categories.
			# Changes made in `/includes/taxonomies.php` and `/includes/custom-fields.php`.

			# Done
			update_option('ironband_version', '1.5.1');
		}



		/*
		 * 1.6.0
		 *
		 * Step 1 : - Delete `newsletter_enabled`
		 *          - Add `Iron_Widget_Newsletter` to
		 *            Default Footer (iron_sidebar_4)
		 *          - If `newsletter_enabled` true,
		 *            select Default Footer (iron_sidebar_4)
		 *            for `footer-area_id`
		 *
		 * Step 2 : - Delete `sidebar_for_posts`
		 *          - Add `Iron_Widget_Terms` to
		 *            Default News Sidebar (iron_sidebar_2)
		 *          - If `sidebar_for_posts` true,
		 *            select Default News Sidebar (iron_sidebar_2)
		 *            for `sidebar-area_id` for posts
		 *            using News page templates.
		 *
		 * Step 3 : - Delete `sidebar_for_videos`
		 *          - Add `Iron_Widget_Terms` to
		 *            Default News Sidebar (iron_sidebar_3)
		 *          - If `sidebar_for_videos` true,
		 *            select Default Videos Sidebar (iron_sidebar_3)
		 *            for `sidebar-area_id` for posts
		 *            using Video page templates.
		 *
		 * @created 2013-10-28
		 * @updated 2013-10-31
		 */

		if ( $old_version < '1.6' )
		{
			$message = _x('Deprecating a few Theme Options related to new WordPress Widgets implementation of IronBand’s modules...', 'Upgrade', IRON_TEXT_DOMAIN);

			$options = get_option(IRON_TEXT_DOMAIN);

			unregister_sidebar('sidebar-1');
			unregister_sidebar('sidebar-2');

			// Disable default WordPress sidebars from fresh install
			update_option( 'widget_search', array() );
			update_option( 'widget_recent-posts', array() );
			update_option( 'widget_recent-comments', array() );
			update_option( 'widget_archives', array() );
			update_option( 'widget_categories', array() );
			update_option( 'widget_meta', array() );
			update_option( 'sidebars_widgets', array( 'wp_inactive_widgets' => array() ) );

			# Setup Widget Instances
			$sidebar_widgets = wp_get_sidebars_widgets();
			$widget_areas = get_iron_option('widget_areas', null, array());

			if ( ! empty($widget_areas) && is_array($widget_areas) )
			{
				foreach ( $widget_areas as $w_id => $w_area )
				{
					if ( ! array_key_exists($w_id, $sidebar_widgets) )
						$sidebar_widgets[ $w_id ] = array();
				}

			}

			$old_home_blocks = $options['homepage_blocks'];

			$home_blocks = array(
				'enabled' => array(
					'placebo' => 'placebo' // REQUIRED
				),
				'disabled' => array(
					'placebo' => 'placebo' // REQUIRED
				)
			);

			# Sidebar "Home : Two Columns"
			if ( array_key_exists(IRON_SIDEBAR_PREFIX . '3', $sidebar_widgets) )
			{
				if ( ! empty($widget_areas) && isset($widget_areas[IRON_SIDEBAR_PREFIX . '3']) )
					$home_blocks['enabled'][IRON_SIDEBAR_PREFIX . '3'] = $widget_areas[IRON_SIDEBAR_PREFIX . '3']['sidebar_name'];

				$sidebar_widgets[IRON_SIDEBAR_PREFIX . '3'] = array(
					  'iron-radio-2'
					, 'iron-recent-tweets-2'
				);

				if ( ! $title = @$options['radio_playlist_label'] )
					$title = __('Popular Songs', IRON_TEXT_DOMAIN);

				update_option( 'widget_iron-radio', array(
					  2 => array(
						'title' => $title
					)
					, '_multiwidget' => 1
				) );

				if ( ! $title = @$options['twitter_widget_label'] )
					$title = __('Latest Tweet', IRON_TEXT_DOMAIN);

				update_option( 'widget_iron-recent-tweets', array(
					  2 => array(
						  'title'       => $title
						, 'screen_name' => ( empty($options['twitter_username']) ? '' : $options['twitter_username'] )
					)
					, '_multiwidget' => 1
				) );
			}

			# Sidebar "Home : One Column"
			if ( array_key_exists(IRON_SIDEBAR_PREFIX . '4', $sidebar_widgets) )
			{
				if ( ! empty($widget_areas) && isset($widget_areas[IRON_SIDEBAR_PREFIX . '4']) )
					$home_blocks['enabled'][IRON_SIDEBAR_PREFIX . '4'] = $widget_areas[IRON_SIDEBAR_PREFIX . '4']['sidebar_name'];

				$sidebar_widgets[IRON_SIDEBAR_PREFIX . '4'] = array(
					  'iron-recent-posts-2'
					, 'iron-recent-videos-2'
					, 'iron-recent-events-2'
				);

				if ( ! $title = iron_widget_title('post', get_option('page_for_posts')) )
					$title = __('Latest Posts', IRON_TEXT_DOMAIN);

				update_option( 'widget_iron-recent-posts', array(
					2 => array(
						  'title'       => $title
						, 'post_type'   => 'post'
						, 'number'      => get_option('posts_per_page')
						, 'show_date'   => true
					)
					, '_multiwidget' => 1
				) );

				if ( ! $title = iron_widget_title('video', @$options['page_for_videos']) )
					$title = __('Recent Videos', IRON_TEXT_DOMAIN);

				update_option( 'widget_iron-recent-videos', array(
					2 => array(
						  'title'       => $title
						, 'post_type'   => 'video'
						, 'number'      => ( empty($options['videos_per_page']) ? 10 : $options['videos_per_page'] )
					)
					, '_multiwidget' => 1
				) );

				if ( ! $title = iron_widget_title('gig', @$options['page_for_gigs']) )
					$title = __('Upcoming Events', IRON_TEXT_DOMAIN);

				update_option( 'widget_iron-recent-events', array(
					2 => array(
						  'title'       => $title
						, 'post_type'   => 'gig'
						, 'number'      => ( empty($options['gigs_per_page']) ? 10 : $options['gigs_per_page'] )
					)
					, '_multiwidget' => 1
				) );
			}

			if ( ! empty($widget_areas) )
			{
				foreach ( $widget_areas as $w_id => $w_area ) {
					if ( isset($home_blocks['enabled'][$w_id]) )
						continue;

					$home_blocks['disabled'][$w_id] = $w_area['sidebar_name'];
				}
			}

			set_iron_option( 'homepage_blocks', $home_blocks );



			# Step 1
			$enable_newsletter = $options['newsletter_enabled'];

			## Sidebar "Default Footer"
			if ( $enable_newsletter && array_key_exists(IRON_SIDEBAR_PREFIX . '2', $sidebar_widgets) )
			{
				$sidebar_widgets[IRON_SIDEBAR_PREFIX . '2'] = array(
					'iron-newsletter-2'
				);

				if ( ! $title = @$options['newsletter_label'] )
					$title = __('Subscribe to our newsletter', IRON_TEXT_DOMAIN);

				update_option( 'widget_iron-newsletter', array(
					2 => array(
						'title' => $title
					)
					, '_multiwidget' => 1
				) );

				set_iron_option('footer-area_id', IRON_SIDEBAR_PREFIX . '2');
			}


			# Step 2
			$enable_sidebar_for_posts = @$options['sidebar_for_posts'];

			## Sidebar "Default Blog Sidebar"
			if ( $enable_sidebar_for_posts && array_key_exists(IRON_SIDEBAR_PREFIX . '0', $sidebar_widgets) )
			{
				if ( ! in_array('iron-terms-2', $sidebar_widgets[IRON_SIDEBAR_PREFIX . '0']) )
					$sidebar_widgets[IRON_SIDEBAR_PREFIX . '0'][] = 'iron-terms-2';

				update_option( 'widget_iron-terms', array(
					2 => array(
						  'title'        => __('Categories')
						, 'taxonomy'     => 'category'
						, 'count'        => 1
						, 'hierarchical' => 0
						, 'dropdown'     => 0
					)
					, '_multiwidget' => 1
				) );

				$query = new WP_Query( array(
					  'post_type'      => 'page'
					, 'posts_per_page' => -1
					, 'no_found_rows'  => true
					, 'meta_query' => array(
						array(
							'key' => '_wp_page_template',
							'value' => 'index',
							'compare' => 'LIKE'
						)
					)
				) );

				if ( $query->have_posts() )
				{
					foreach ( $query->posts as $post )
					{
						update_post_meta( $post->ID, 'sidebar-position', 'right', 'disabled' );
						update_post_meta( $post->ID, 'sidebar-area_id', IRON_SIDEBAR_PREFIX . '0', '' );
					}
				}
			}


			# Step 3
			$enable_sidebar_for_videos = @$options['sidebar_for_videos'];

			## Sidebar "Default Video Sidebar"
			if ( $enable_sidebar_for_videos && array_key_exists(IRON_SIDEBAR_PREFIX . '1', $sidebar_widgets) )
			{
				if ( ! in_array('iron-terms-3', $sidebar_widgets[IRON_SIDEBAR_PREFIX . '1']) )
					$sidebar_widgets[IRON_SIDEBAR_PREFIX . '1'][] = 'iron-terms-3';

				$widget_instances = get_option( 'widget_iron-terms' );

				unset( $widget_instances['_multiwidget'] );

				$widget_instances[] = array(
					  'title'        => __('Categories')
					, 'taxonomy'     => 'video-category'
					, 'count'        => 1
					, 'hierarchical' => 0
					, 'dropdown'     => 0
				);

				$widget_instances['_multiwidget'] = 1;

				update_option( 'widget_iron-terms', $widget_instances );

				$query = new WP_Query( array(
					  'post_type'      => 'page'
					, 'posts_per_page' => -1
					, 'no_found_rows'  => true
					, 'meta_query' => array(
						array(
							'key' => '_wp_page_template',
							'value' => 'archive-video',
							'compare' => 'LIKE'
						)
					)
				) );

				if ( $query->have_posts() )
				{
					foreach ( $query->posts as $post )
					{
						update_post_meta( $post->ID, 'sidebar-position', 'right', 'disabled' );
						update_post_meta( $post->ID, 'sidebar-area_id', IRON_SIDEBAR_PREFIX . '1', '' );
					}
				}
			}

			# Done
			wp_set_sidebars_widgets( $sidebar_widgets );

			update_option('ironband_version', '1.6');
		}



		/*
		 * 1.6.1
		 *
		 * Step 1 : - Delete `newsletter_enabled`
		 * Step 2 : - Delete `sidebar_for_posts`
		 * Step 3 : - Delete `sidebar_for_videos`
		 *
		 * @created 2013-10-31
		 */

		/*if ( $old_version < '1.6.1' )
		{
			# Done
			update_option('ironband_version', '1.6.1');
		}*/
	}
}

add_action('init', 'iron_upgrade');
