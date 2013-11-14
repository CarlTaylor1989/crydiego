<?php

/*

@name			GPanel Options Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Theme Options Sections
====================================================================================================
*/

function gp_theme_options_sections() {

	$sections = array();

	$sections['general'] 				= __('General Settings', 'gp');
	$sections['styling'] 				= __('Styling', 'gp');
	$sections['reading'] 				= __('Reading', 'gp');
	$sections['socials'] 				= __('Socials', 'gp');
	$sections['forms'] 					= __('Forms', 'gp');
	$sections['tracking'] 				= __('Tracking', 'gp');

	return $sections;

}

/*
====================================================================================================
Theme Options
====================================================================================================
*/

function gp_theme_options_fields() {
	global $wp_version;
	
/*
----------------------------------------------------------------------------------------------------
General Tab
----------------------------------------------------------------------------------------------------
*/
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_responsivity',
		'title'		=> __('Responsivity of the Theme', 'gp'),
		'desc'		=> __('Enable or disable responsivity of the theme (Enabled = media queries in "styles/style-responsivity.css" will be loaded).', 'gp'),
		'type'		=> 'select-text',
		'std'		=> '',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_heading_images',
		'title'		=> __('Images', 'gp'),
		'type'		=> 'heading',
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_image_logo',
		'title'		=> __('Logo Image', 'gp'),
		'desc'		=> __('Upload a logo image. Upload an image and then click "Select" or "Insert into Post".<br /> <strong>Best size: Anything x 80 px.</strong>', 'gp'),
		'type'		=> 'input-upload',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_image_favicon',
		'title'		=> __('Favicon', 'gp'),
		'desc'		=> __('Upload a favicon in *.ico, *.png or *.gif format. Upload an image and then click "Select" or "Insert into Post".<br /> <strong>Required size: 16 x 16 px.</strong>', 'gp'),
		'type'		=> 'input-upload',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_image_login_logo',
		'title'		=> __('WordPress Login Logo Image', 'gp'),
		'desc'		=> __('Upload a WordPress login logo image. Upload an image and then click "Select" or "Insert into Post".<br /> <strong>Required size: 274 x 100 px.</strong>', 'gp'),
		'type'		=> 'input-upload',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_image_background',
		'title'		=> __('Full Screen Background Image with Backstretch', 'gp'),
		'desc'		=> __('Upload a full screen background image. Upload an image and then click "Select" or "Insert into Post".<br /> Background image of Theme Customizer will be disabled.<br /> <strong>Recommended minimum size: 1600 x 1200 px.</strong>', 'gp'),
		'type'		=> 'input-upload',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_image_background_opacity',
		'title'		=> __('Background Image Opacity', 'gp'),
		'desc'		=> __('Select opacity of background image.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('100%', 'gp') . '|1',
			__('75%', 'gp') . '|.75',
			__('50%', 'gp') . '|.5',
			__('25%', 'gp') . '|.25',
			__('10%', 'gp') . '|.1'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_heading_search',
		'title'		=> __('Search', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_search',
		'title'		=> __('Search Button', 'gp'),
		'desc'		=> __('Enable / disable displaying of the search button.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_heading_slideshow',
		'title'		=> __('Slideshow', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_autoplay',
		'title'		=> __('Autoplay', 'gp'),
		'desc'		=> __('Enable / disable autoplay of the slideshow.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_nav',
		'title'		=> __('Arrow Navigation', 'gp'),
		'desc'		=> __('Enable / disable arrow navigation.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_nav_autohide',
		'title'		=> __('Arrow Navigation Auto Hide', 'gp'),
		'desc'		=> __('Enable / disable auto hide of the arrow navigation.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'false',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_nav_touch',
		'title'		=> __('Arrow Navigation on Touch Devices', 'gp'),
		'desc'		=> __('Show / hide arrow navigation completely on touch devices.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'false',
		'choices'	=> array(
			__('Show', 'gp') . '|false',
			__('Hide', 'gp') . '|true'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_nav_by_click',
		'title'		=> __('Navigate by Click', 'gp'),
		'desc'		=> __('Enable / disable navigation by click.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_drag',
		'title'		=> __('Drag', 'gp'),
		'desc'		=> __('Enable / disable mouse drag navigation over the slideshow.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_touch',
		'title'		=> __('Touch', 'gp'),
		'desc'		=> __('Enable / disable touch navigation of the slideshow.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_transition_type',
		'title'		=> __('Transition Type.', 'gp'),
		'desc'		=> __('Select slideshow transition type.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'move',
		'choices'	=> array(
			__('Move', 'gp') . '|move',
			__('Fade', 'gp') . '|fade'
		)
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_transition_speed',
		'title'		=> __('Transition Speed', 'gp'),
		'desc'		=> __('Fill the transition speed in miliseconds. Default: 1000', 'gp'),
		'type'		=> 'input',
		'std'		=> '1000'
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_slideshow_delay',
		'title'		=> __('Delay', 'gp'),
		'desc'		=> __('Fill the delay between slides in miliseconds. Default: 5000', 'gp'),
		'type'		=> 'input',
		'std'		=> '5000'
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_heading_rss',
		'title'		=> __('RSS', 'gp'),
		'desc'		=> __('For this setting you will need to create an account on <a href="http://www.feedburner.com/" target="_blank">Feedburner</a>.', 'gp'),
		'type'		=> 'heading',
	);

	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_feedburner',
		'title'		=> __('FeedBurner URL', 'gp'),
		'desc'		=> __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress feed. <a href="http://www.wpbeginner.com/beginners-guide/step-by-step-guide-to-setup-feedburner-for-wordpress/" target="_blank">Step by Step Guide to Setup FeedBurner for WordPress</a>', 'gp'),
		'type'		=> 'input',
		'class'		=> 'url',
		'std'		=> ''
	);

if (!gp_seo_third_party()) {
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_heading_meta',
		'title'		=> __('Meta', 'gp'),
		'type'		=> 'heading',
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_meta_keywords_default',
		'title'		=> __('Default Meta Keywords', 'gp'),
		'desc'		=> __('Add default meta keywords. Separate keywords with commas.', 'gp'),
		'type'		=> 'textarea',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'general',
		'id'		=> GP_SHORTNAME . '_meta_description_default',
		'title'		=> __('Default Meta Description', 'gp'),
		'desc'		=> __('Add default meta description.', 'gp'),
		'type'		=> 'textarea',
		'std'		=> ''
	);
	
}
	
/*
----------------------------------------------------------------------------------------------------
Styling Tab
----------------------------------------------------------------------------------------------------
*/

	$options[] = array(
		'section'	=> 'styling',
		'id'		=> GP_SHORTNAME . '_font_face',
		'title'		=> __('Custom Google Font', 'gp'),
		'desc'		=> __('Fill the full name of the font that you\'d like using from Google Font API: <a href="http://www.google.com/webfonts" target="_blank">
http://www.google.com/webfonts</a>.<br /> For example: Racing Sans One<br /> Empty field = Default font', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'styling',
		'id'		=> GP_SHORTNAME . '_custom_css',
		'title'		=> __('Custom CSS', 'gp'),
		'desc'		=> __('Here you can specify a custom CSS section of code. This code will be given priority over other CSS styles.', 'gp'),
		'type'		=> 'textarea',
		'std'		=> ''
	);
	
/*
----------------------------------------------------------------------------------------------------
Reading Tab
----------------------------------------------------------------------------------------------------
*/
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_date_format',
		'title'		=> __('Date', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_date_format',
		'title'		=> __('Select Date Format', 'gp'),
		'desc'		=> __('Please select a date format for the events and albums.<br /> d m Y = 01 02 2000<br /> m d Y = 02 01 2000<br /> Y m d = 2000 02 01<br /> Y d m = 2000 01 02<br /> F j, Y = January 1, 2000<br /> j M, Y = 1 Jan, 2000', 'gp'),
		'type'		=> 'select-text',
		'std'		=> '',
		'choices'	=> array(
			__('d m Y', 'gp') . '|d m Y',
			__('m d Y', 'gp') . '|m d Y',
			__('Y m d', 'gp') . '|Y m d',
			__('Y d m', 'gp') . '|Y d m',
			__('F j, Y (Delimiter ignored)', 'gp') . '|F j, Y',
			__('j M, Y (Delimiter ignored)', 'gp') . '|j M, Y'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_date_delimiter',
		'title'		=> __('Select Date Delimiter', 'gp'),
		'desc'		=> __('Please elect delimiter what want to use between the characters of date.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> '/',
		'choices'	=> array(
			__('Space [ ]', 'gp') . '| ',
			__('Slash [/]', 'gp') . '|/',
			__('Dash [-]', 'gp') . '|-',
			__('Dot [.]', 'gp') . '|.'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_callout_homepage',
		'title'		=> __('Callouts on Homepage', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_callout_homepage',
		'title'		=> __('Callouts on Homepage', 'gp'),
		'desc'		=> __('Enable / disable callout blocks on homepage.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_event_homepage',
		'title'		=> __('Events on Homepage', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_event_homepage',
		'title'		=> __('Events', 'gp'),
		'desc'		=> __('Enable / Disable latest posts on homepage.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_event_homepage_date',
		'title'		=> __('Event Date', 'gp'),
		'desc'		=> __('Enable / disable post date on homepage.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_post_homepage',
		'title'		=> __('Posts on Homepage', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_post_homepage',
		'title'		=> __('Posts', 'gp'),
		'desc'		=> __('Enable / Disable latest posts on homepage.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_post_homepage_date',
		'title'		=> __('Post Date', 'gp'),
		'desc'		=> __('Enable / disable post date on homepage.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_post',
		'title'		=> __('Posts', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_post_corner',
		'title'		=> __('Post Format Corner', 'gp'),
		'desc'		=> __('Enable / disable blog post format corner with icon.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_blog_sidebar',
		'title'		=> __('Blog Sidebar', 'gp'),
		'desc'		=> __('Select the sidebar location of the blog templates.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Right', 'gp') . '|right',
			__('Left', 'gp') . '|left'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_event',
		'title'		=> __('Events', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_event_thumbnail',
		'title'		=> __('Thumbnails on Events Page', 'gp'),
		'desc'		=> __('Enable / disable thumbnails on the <strong>Events</strong> page template.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_event_past_events',
		'title'		=> __('Past Events on Events Page', 'gp'),
		'desc'		=> __('Enable / disable past events on the <strong>Events</strong> page template.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_event_single',
		'title'		=> __('Event Single Page', 'gp'),
		'desc'		=> __('Enable / disable event single page.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_event_sidebar',
		'title'		=> __('Events Sidebar', 'gp'),
		'desc'		=> __('Select the sidebar location of the events templates.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Right', 'gp') . '|right',
			__('Left', 'gp') . '|left'
		)
	);

	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_page',
		'title'		=> __('Pages', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_page_sidebar',
		'title'		=> __('Pages Sidebar', 'gp'),
		'desc'		=> __('Select the sidebar location of the page templates.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Right', 'gp') . '|right',
			__('Left', 'gp') . '|left'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_album',
		'title'		=> __('Albums', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_album_sidebar',
		'title'		=> __('Albums Sidebar', 'gp'),
		'desc'		=> __('Select the sidebar location of the album templates.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Right', 'gp') . '|right',
			__('Left', 'gp') . '|left'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_video',
		'title'		=> __('Videos', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_video_sidebar',
		'title'		=> __('Videos Sidebar', 'gp'),
		'desc'		=> __('Select the sidebar location of the video templates.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Right', 'gp') . '|right',
			__('Left', 'gp') . '|left'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_gallery',
		'title'		=> __('Galleries', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		"section"	=> 'reading',
		'id'		=> GP_SHORTNAME . '_gallery_sidebar',
		'title'		=> __('Galleries Sidebar', 'gp'),
		'desc'		=> __('Select the sidebar location of the gallery templates.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Right', 'gp') . '|right',
			__('Left', 'gp') . '|left'
		)
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_heading_footer',
		'title'		=> __('Footer', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		'section'	=> 'reading',
		'id'		=> GP_SHORTNAME . '_footer_copyright',
		'title'		=> __('Footer Copyright', 'gp'),
		'desc'		=> __('Fill the text appeared instead copyright in footer.', 'gp'),
		'type'		=> 'textarea',
		'std'		=> ''
	);
	
/*
----------------------------------------------------------------------------------------------------
Socials Tab
----------------------------------------------------------------------------------------------------
*/

	$options[] = array(
		"section"	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_header',
		'title'		=> __('Header Social Icons', 'gp'),
		'desc'		=> __('Enable / disable displaying of the social icons in the header.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_footer',
		'title'		=> __('Footer Social Icons', 'gp'),
		'desc'		=> __('Enable / disable displaying of the social icons in the footer.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_target',
		'title'		=> __('Open Links in New Window', 'gp'),
		'desc'		=> __('Enable / disable opening of the link in new window. Enabled = Open in new window/tab, Disabled = Open in actual window/tab', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_heading_social_profiles',
		'title'		=> __('Social Profiles', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_twitter',
		'title'		=> __('Twitter', 'gp'),
		'desc'		=> __('Fill the absolute path to your Twitter account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_facebook',
		'title'		=> __('Facebook', 'gp'),
		'desc'		=> __('Fill the absolute path to your Facebook account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_googleplus',
		'title'		=> __('Google+', 'gp'),
		'desc'		=> __('Fill the absolute path to your Google+ account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_amazon',
		'title'		=> __('Amazon', 'gp'),
		'desc'		=> __('Fill the absolute path to your Amazon account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_youtube',
		'title'		=> __('YouTube', 'gp'),
		'desc'		=> __('Fill the absolute path to your YouTube account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_vimeo',
		'title'		=> __('Vimeo', 'gp'),
		'desc'		=> __('Fill the absolute path to your Vimeo account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_itunes',
		'title'		=> __('iTunes', 'gp'),
		'desc'		=> __('Fill the absolute path to your iTunes account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_soundcloud',
		'title'		=> __('SoundCloud', 'gp'),
		'desc'		=> __('Fill the absolute path to your SoundCloud account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_beatport',
		'title'		=> __('Beatport', 'gp'),
		'desc'		=> __('Fill the absolute path to your Beatport account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_mixcloud',
		'title'		=> __('Mixcloud', 'gp'),
		'desc'		=> __('Fill the absolute path to your Mixcloud account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_purevolume',
		'title'		=> __('PureVolume', 'gp'),
		'desc'		=> __('Fill the absolute path to your PureVolume account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_spotify',
		'title'		=> __('Spotify', 'gp'),
		'desc'		=> __('Fill the absolute path to your Spotify account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_lastfm',
		'title'		=> __('Last.fm', 'gp'),
		'desc'		=> __('Fill the absolute path to your Last.fm account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_myspace',
		'title'		=> __('Myspace', 'gp'),
		'desc'		=> __('Fill the absolute path to your Myspace account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_grooveshark',
		'title'		=> __('Grooveshark', 'gp'),
		'desc'		=> __('Fill the absolute path to your Grooveshark account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_flickr',
		'title'		=> __('Flickr', 'gp'),
		'desc'		=> __('Fill the absolute path to your Flickr account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_socials_pinterest',
		'title'		=> __('Pinterest', 'gp'),
		'desc'		=> __('Fill the absolute path to your Pinterest account.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'socials',
		'id'		=> GP_SHORTNAME . '_heading_sharing_box',
		'title'		=> __('Sharing Box', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		"section"	=> 'socials',
		'id'		=> GP_SHORTNAME . '_share_twitter',
		'title'		=> __('Twitter Button', 'gp'),
		'desc'		=> __('Enable / disable Twitter button for post sharing.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'socials',
		'id'		=> GP_SHORTNAME . '_share_facebook',
		'title'		=> __('Facebook Button', 'gp'),
		'desc'		=> __('Enable / disable Facebook button for post sharing.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'socials',
		'id'		=> GP_SHORTNAME . '_share_googleplus',
		'title'		=> __('Google+ Button', 'gp'),
		'desc'		=> __('Enable / disable Google+ button for post sharing.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'socials',
		'id'		=> GP_SHORTNAME . '_share_pinterest',
		'title'		=> __('Pinterest Button', 'gp'),
		'desc'		=> __('Enable / disable Pinterest button for post sharing.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'true',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);

/*
----------------------------------------------------------------------------------------------------
Forms Tab
----------------------------------------------------------------------------------------------------
*/
	
	$options[] = array(
		'section'	=> 'forms',
		'id'		=> GP_SHORTNAME . '_heading_contact_form',
		'title'		=> __('Contact Form', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		'section'	=> 'forms',
		'id'		=> GP_SHORTNAME . '_form_contact_email',
		'title'		=> __('Email Address for Receiving Emails', 'gp'),
		'desc'		=> __('Fill your email address in this format: john@doe.com', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'forms',
		'id'		=> GP_SHORTNAME . '_form_contact_subject',
		'title'		=> __('Subject of Received Emails', 'gp'),
		'desc'		=> __('Fill the subject of the email. Something as: Name of the site - Contact form.', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'forms',
		'id'		=> GP_SHORTNAME . '_heading_recaptcha',
		'title'		=> __('reCaptcha', 'gp'),
		'type'		=> 'heading'
	);
	
	$options[] = array(
		"section"	=> 'forms',
		'id'		=> GP_SHORTNAME . '_form_recaptcha',
		'title'		=> __('reCaptcha', 'gp'),
		'desc'		=> __('Enable / disable reCaptcha for contact form.', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'false',
		'choices'	=> array(
			__('Enabled', 'gp') . '|true',
			__('Disabled', 'gp') . '|false'
		)
	);
	
	$options[] = array(
		"section"	=> 'forms',
		'id'		=> GP_SHORTNAME . '_form_recaptcha_theme',
		'title'		=> __('reCaptcha Theme', 'gp'),
		'desc'		=> __('Select reCaptcha theme. Available themes you can see on: <a href="https://developers.google.com/recaptcha/docs/customization">https://developers.google.com/recaptcha/docs/customization</a>', 'gp'),
		'type'		=> 'select-text',
		'std'		=> 'clean',
		'choices'	=> array(
			__('Clean', 'gp') . '|clean',
			__('Red', 'gp') . '|red',
			__('White', 'gp') . '|white',
			__('Blackglass', 'gp') . '|blackglass'
		)
	);
	
	$options[] = array(
		'section'	=> 'forms',
		'id'		=> GP_SHORTNAME . '_form_recaptcha_public_key',
		'title'		=> __('Public Key [REQUIRED]', 'gp'),
		'desc'		=> __('Fill the public key. Keys you can get on: <a href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
	$options[] = array(
		'section'	=> 'forms',
		'id'		=> GP_SHORTNAME . '_form_recaptcha_private_key',
		'title'		=> __('Private Key [REQUIRED]', 'gp'),
		'desc'		=> __('Fill the private key. Keys you can get on: <a href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>', 'gp'),
		'type'		=> 'input',
		'std'		=> ''
	);
	
/*
----------------------------------------------------------------------------------------------------
Tracking Tab
----------------------------------------------------------------------------------------------------
*/

	$options[] = array(
		'section'	=> 'tracking',
		'id'		=> GP_SHORTNAME . '_tracking_code',
		'title'		=> __('Tracking Code', 'gp'),
		'desc'		=> __('Paste your Google Analytics (or other) tracking code. It will be inserted before the closing body tag of your theme.', 'gp'),
		'type'		=> 'textarea',
		'std'		=> ''
	);
	
	return $options;
		
}

?>