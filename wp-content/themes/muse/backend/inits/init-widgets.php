<?php

/*

@name			GPanel Widgets Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Register Widgets
====================================================================================================
*/

function register_widgets() {
	
	register_widget('gp_Widget_About');
	register_widget('gp_Widget_Recent_Albums');
	register_widget('gp_Widget_Recent_Events');
	register_widget('gp_Widget_Recent_Posts');
	register_widget('gp_Widget_Recent_Tweet');
	register_widget('gp_Widget_Recent_Videos');
	register_widget('gp_Widget_Subpages');
	register_widget('gp_Widget_Tweets');
	
}

add_action('widgets_init', 'register_widgets');

/*
====================================================================================================
Unregister Default WP Widgets
====================================================================================================
*/

function unregister_wp_widgets(){
	
	unregister_widget('WP_Widget_Calendar');
  
}

add_action('widgets_init', 'unregister_wp_widgets', 1);

/*
====================================================================================================
Register Widget Areas
====================================================================================================
*/

if (function_exists('register_sidebar')) {
	
	// Sidebar > Page
	register_sidebar(
		array(
			'name' 				=> __('Page Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget_area_page',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Blog
	register_sidebar(
		array(
			'name' 				=> __('Blog Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on blog pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget_area_blog',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Event
	register_sidebar(
		array(
			'name' 				=> __('Events Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on event pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget_area_event',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Album
	register_sidebar(
		array(
			'name' 				=> __('Albums Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on album pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget_area_album',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Video
	register_sidebar(
		array(
			'name' 				=> __('Videos Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on video pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget_area_video',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Sidebar > Gallery
	register_sidebar(
		array(
			'name' 				=> __('Galleries Sidebar', 'gp'),
			'description' 		=> __('Sidebar that appears on gallery pages. Sidebar won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget_area_gallery',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);

	// Footer Sidebar > Full
	register_sidebar(
		array(
			'name' 				=> __('Footer [Full]', 'gp'),
			'description' 		=> __('Full width footer widget area appears on all pages. Area won\'t be displayed when won\'t be placed a widget.', 'gp'),
			'id' 				=> 'widget_area_footer_full',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > First
	register_sidebar(
		array(
			'name' 				=> __('Footer [1st]', 'gp'),
			'description' 		=> __('1st footer widget area.', 'gp'),
			'id' 				=> 'widget_area_footer_first',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > Second
	register_sidebar(
		array(
			'name' 				=> __('Footer [2nd]', 'gp'),
			'description' 		=> __('2nd footer widget area.', 'gp'),
			'id' 				=> 'widget_area_footer_second',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > Third
	register_sidebar(
		array(
			'name' 				=> __('Footer [3rd]', 'gp'),
			'description' 		=> __('3rd footer widget area.', 'gp'),
			'id' 				=> 'widget_area_footer_third',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > Fourth
	register_sidebar(
		array(
			'name' 				=> __('Footer [4th]', 'gp'),
			'description' 		=> __('4th footer widget area.', 'gp'),
			'id' 				=> 'widget_area_footer_fourth',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title'  	=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	
	// Footer Sidebar > Fifth
	register_sidebar(
		array(
			'name' 				=> __('Footer [5th]', 'gp'),
			'description' 		=> __('5th footer widget area.', 'gp'),
			'id' 				=> 'widget_area_footer_fifth',
			'before_widget' 	=> '<div id="%1$s" class="widget-block %2$s clearfix">',
			'after_widget'  	=> '</div>',
			'before_title' 		=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);

}

?>