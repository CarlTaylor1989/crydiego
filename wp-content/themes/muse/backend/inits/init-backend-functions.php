<?php

/*

@name			GPanel Functions Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/

/*
====================================================================================================
Backend Scripts
====================================================================================================
*/

if (!function_exists('gp_backend_scripts')) {

	function gp_backend_scripts() {
		global $wp_version;

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		
		if ($wp_version < 3.5) {
			
			// Enqueue Upload for WordPress 3.4 and lower
			wp_register_script('gp-upload', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.upload.js', array('jquery', 'media-upload', 'thickbox'), GP_VERSION, true);
			wp_enqueue_script('gp-upload');
			
		} else {
			
			// Enqueue Media
			if (!did_action('wp_enqueue_media')) {
   				wp_enqueue_media();	
			}
			// Enqueue Upload for WordPress 3.5 and higher
			wp_register_script('gp-upload-3.5', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.upload.3.5.js', array('jquery', 'media-upload', 'thickbox'), GP_VERSION, true);
			wp_enqueue_script('gp-upload-3.5');
		
		}
		
		// Plupload
		wp_enqueue_script('plupload-all');

		// Color Picker
		wp_register_script('gp-colorpicker', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.colorpicker.js', 'jquery', GP_VERSION, true);
		wp_enqueue_script('gp-colorpicker');
		
		// Cookie
		wp_register_script('gp-cookie', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.cookie.js', 'jquery', GP_VERSION, true);
		wp_enqueue_script('gp-cookie');

		// Custom
		wp_register_script('gp-backend', trailingslashit(get_template_directory_uri()) . 'backend/javascripts/jquery.backend.js', 'jquery', GP_VERSION, true);
		wp_enqueue_script('gp-backend');
		
	}
	
	add_action('admin_enqueue_scripts', 'gp_backend_scripts');

}

// Datepicker Scripts for Event
function gp_backend_datepicker_scripts() {
	global $post_type;
	
	if (empty($post_type) && !empty($_GET['post'])) {
		$post = get_post($_GET['post']);
		$post_type = $post->post_type;
	}

	if ($post_type == 'event' || $post_type == 'album') {
	?>
	
		<script type="text/javascript">
        //<![CDATA[
            jQuery(document).ready(function() {

                jQuery(".gp-datepicker").datepicker({ 
                    firstDay: 1,
                    dateFormat: "yy/mm/dd",
                    dayNames: [
						'<?php _e('Sunday', 'gp'); ?>',
						'<?php _e('Monday', 'gp'); ?>',
						'<?php _e('Tuesday', 'gp'); ?>',
						'<?php _e('Wednesday', 'gp'); ?>',
						'<?php _e('Thursday', 'gp'); ?>',
						'<?php _e('Friday', 'gp'); ?>',
						'<?php _e('Saturday', 'gp'); ?>'
					],
                    dayNamesMin: [
						'<?php _e('Su', 'gp'); ?>',
						'<?php _e('Mo', 'gp'); ?>',
						'<?php _e('Tu', 'gp'); ?>',
						'<?php _e('We', 'gp'); ?>',
						'<?php _e('Th', 'gp'); ?>',
						'<?php _e('Fr', 'gp'); ?>',
						'<?php _e('Sa', 'gp'); ?>'
					],
                    monthNames: [
						'<?php _e('January', 'gp'); ?>',
						'<?php _e('February', 'gp'); ?>',
						'<?php _e('March', 'gp'); ?>',
						'<?php _e('April', 'gp'); ?>',
						'<?php _e('May', 'gp'); ?>',
						'<?php _e('June', 'gp'); ?>',
						'<?php _e('July', 'gp'); ?>',
						'<?php _e('August', 'gp'); ?>',
						'<?php _e('September', 'gp'); ?>',
						'<?php _e('October', 'gp'); ?>',
						'<?php _e('November', 'gp'); ?>',
						'<?php _e('December', 'gp'); ?>'
					],
                    nextText: '<?php _e('Next', 'gp'); ?>',
                    prevText: '<?php _e('Prev', 'gp'); ?>'
                });
            });
        //]]>
        </script>

	<?php
	}
	
}

add_action('admin_print_footer_scripts', 'gp_backend_datepicker_scripts');

/*
====================================================================================================
Backend Styles
====================================================================================================
*/

function gp_backend_styles() {
	
	// Thickbox Stylesheet
	wp_enqueue_style('thickbox');
	
	// Core Backend Stylesheet
	wp_enqueue_style('gp-style', trailingslashit(get_template_directory_uri()) . 'backend/styles/style.css');
	
	// Widget Stylesheet
    wp_enqueue_style('gp-style-widget', trailingslashit(get_template_directory_uri()) . 'backend/styles/style-widget.css');
	
	// Metabox Stylesheet
	wp_enqueue_style('gp-style-metabox', trailingslashit(get_template_directory_uri()) . 'backend/styles/style-metabox.css');
	
	// Components Stylesheet
    wp_enqueue_style('gp-style-components', trailingslashit(get_template_directory_uri()) . 'backend/styles/style-components.css');
	
}

add_action('admin_print_styles', 'gp_backend_styles');

/*
====================================================================================================
Theme Customizer
====================================================================================================
*/

function gp_theme_customize_register($wp_customize) {

	/*
	--------------------------------------------------
	Add Sections
	--------------------------------------------------
	*/
	
	// Colors
	$wp_customize->add_section('colors', array(
		'title'			=> __('Colors', 'gp'),
		'priority'		=> 30
	));
	
	// Header
	$wp_customize->add_section('header', array(
		'title'			=> __('Header', 'gp'),
		'priority'		=> 100
	));
	
	/*
	--------------------------------------------------
	Add Settings
	--------------------------------------------------
	*/

	// Text Color
	$wp_customize->add_setting('gp_color_text', array(
		'default'		=> '#ffffff',
		'transport'		=> 'refresh'
	));
	
	// Primary Color
	$wp_customize->add_setting('gp_color_primary', array(
		'default'		=> '#198caf',
		'transport'		=> 'refresh'
	));
	
	// Secondary Color
	$wp_customize->add_setting('gp_color_secondary', array(
		'default'		=> '#cd503c',
		'transport'		=> 'refresh'
	));
	
	// Tertiary Color
	$wp_customize->add_setting('gp_color_tertiary', array(
		'default'		=> '#282d32',
		'transport'		=> 'refresh'
	));
	
	// Footer Background Color
	$wp_customize->add_setting('gp_color_footer', array(
		'default'		=> '#ffffff',
		'transport'		=> 'refresh'
	));
	
	// Footer Text Color
	$wp_customize->add_setting('gp_color_footer_text', array(
		'default'		=> '#14191e',
		'transport'		=> 'refresh'
	));
	
	// Background Opacity
	$wp_customize->add_setting('background_opacity', array(
			'default' => '50',
	));
	
	// Header Position
	$wp_customize->add_setting('gp_header_position', array(
			'default' => 'fixed',
	));
	
	/*
	--------------------------------------------------
	Add Controls
	--------------------------------------------------
	*/

	// Text Color
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gp_color_text', array(
		'label'			=> __('Text Color', 'gp'),
		'section'		=> 'colors',
		'settings'		=> 'gp_color_text',
		'priority'		=> 1
	)));
	
	// Primary Color
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gp_color_primary', array(
		'label'			=> __('Primary Color', 'gp'),
		'section'		=> 'colors',
		'settings'		=> 'gp_color_primary',
		'priority'		=> 11
	)));
	
	// Secondary Color
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gp_color_secondary', array(
		'label'			=> __('Secondary Color', 'gp'),
		'section'		=> 'colors',
		'settings'		=> 'gp_color_secondary',
		'priority'		=> 12
	)));
	
	// Tertiary Color
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gp_color_tertiary', array(
		'label'			=> __('Tertiary Color', 'gp'),
		'section'		=> 'colors',
		'settings'		=> 'gp_color_tertiary',
		'priority'		=> 13
	)));
	
	// Footer Background Color
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gp_color_footer', array(
		'label'			=> __('Footer Background Color', 'gp'),
		'section'		=> 'colors',
		'settings'		=> 'gp_color_footer',
		'priority'		=> 15
	)));
	
	// Footer Text Color
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gp_color_footer_text', array(
		'label'			=> __('Footer Text Color', 'gp'),
		'section'		=> 'colors',
		'settings'		=> 'gp_color_footer_text',
		'priority'		=> 16
	)));
	
	// Header Position
	$wp_customize->add_control('gp_header_position', array(
		'type'			=> 'radio',
		'label'			=> __('Header Position', 'gp'),
		'section'		=> 'header',
		'choices'		=> array(
			'fixed'			=> __('Fixed', 'gp'),
			'absolute'		=> __('Scroll', 'gp')
		)
	));

}

add_action('customize_register', 'gp_theme_customize_register');

/*
====================================================================================================
Add Appearance Links
====================================================================================================
*/

// Add Support Link
function gp_appearance_support_link() {

	add_theme_page( 
		esc_html__('Theme Support', 'gp'),
		esc_html__('Theme Support', 'gp'),
		'edit_theme_options',
		'gp-support',
		'gp_init_support'
	);
	
}

add_action('admin_menu', 'gp_appearance_support_link', 10);

// Add Documentation Link
function gp_appearance_documentation_link() {

	add_theme_page( 
		esc_html__('Theme Docs', 'gp'),
		esc_html__('Theme Docs', 'gp'),
		'edit_theme_options',
		'gp-documentation',
		'gp_init_documentation'
	);
	
}

add_action('admin_menu', 'gp_appearance_documentation_link', 10);

// Add Customize Link
function gp_appearance_customize_link() {

	add_theme_page( 
		esc_html__('Customize', 'gp'),
		esc_html__('Customize', 'gp'),
		'edit_theme_options',
		'customize.php'
	);
	
}

add_action('admin_menu', 'gp_appearance_customize_link', 11);

/*
====================================================================================================
Add Featured Image Description
====================================================================================================
*/

function gp_featured_image_description($content) {
    
	$content .= '<p>';
	$content .= __('The Featured Image is an image that is chosen as the representative image for the post. Click the link above to upload the image for this post.', 'gp');
	$content .= '</p>';
	
	return $content;
	
}

add_filter('admin_post_thumbnail_html', 'gp_featured_image_description');

/*
====================================================================================================
Add Translation Text Domain
====================================================================================================
*/

function gp_textdomain() {
		
	load_theme_textdomain('gp', trailingslashit(get_template_directory()) . 'languages');
	
}

add_action('after_setup_theme', 'gp_textdomain');

?>