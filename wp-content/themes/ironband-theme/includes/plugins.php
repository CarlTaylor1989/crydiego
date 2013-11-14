<?php

/*
 * Register recommended plugins for this theme.
 */

function iron_register_required_plugins ()
{
	$plugins = array(
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => true
		),
		array(
			'name'     => 'Simple Page Ordering',
			'slug'     => 'simple-page-ordering',
			'required' => false
		),
		array(
			'name'     => 'Duplicate Post',
			'slug'     => 'duplicate-post',
			'required' => false
		),
		array(
			'name'		=>	'Google Analytics for WordPress',
			'slug'		=>	'google-analytics-for-wordpress',
			'required'	=>	false
		)
	);

	$config = array(
		'domain'       => IRON_TEXT_DOMAIN,
		'has_notices'  => true, // Show admin notices or not
		'is_automatic' => true // Automatically activate plugins after installation or not
	);

	tgmpa($plugins, $config);

}

add_action('tgmpa_register', 'iron_register_required_plugins');



/**
 *  iron_acf_helpers_get_dir
 *
 * If the theme is used as a symlinked folder, this should help.
 *
 *  @since: 1.6.0
 *  @see helpers_get_dir
 */

function iron_acf_helpers_get_dir ( $dir ) {

	if ( false === strpos($dir, WP_CONTENT_DIR) )
	{
		$output = get_stylesheet_directory_uri() . '/includes/advanced-custom-fields/';

		if ( false !== strpos($dir, 'addons/acf-repeater') )
			$output .= 'addons/acf-repeater/';

		if ( false !== strpos($dir, 'addons/acf-widget-area') )
			$output .= 'addons/acf-widget-area/';

		$dir = $output;
	}

	return $dir;
}

add_filter('acf/helpers/get_dir', 'iron_acf_helpers_get_dir', 2, 1);
