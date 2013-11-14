<?php

/*

@name 			Post Metabox [SEO]
@package		GPanel WordPress Framework
@since			3.0.0
@author 		Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

*/
/*
====================================================================================================
Post Type Metabox Register
====================================================================================================
*/

function gp_register_metabox_post() {
	
	if (!class_exists('gp_Metabox')) {
		return;
	}

	$meta_boxes = array();
	
	/*
	--------------------------------------------------
	Post Block Options
	--------------------------------------------------
	*/
	
	if (get_theme_mod('gp_color_tertiary')) {
		$color_tertiary = get_theme_mod('gp_color_tertiary');
	} else {
		$color_tertiary = '#14191e';
	}

	$meta_boxes[] = array(
		'id'				=> 'gp-metabox-post',
		'title'				=> __('Post Block Options', 'gp'),
		'pages'				=> array('post'),
		'fields'			=> array(
			array(
				'name'				=> __('Background Color', 'gp'),
				'desc'				=> __('Add or select the background color of the post block. Default: #14191e.', 'gp'),
				'id'				=> GP_SHORTNAME . '_post_block_background',
				'std'				=> $color_tertiary,
				'type'				=> 'picker_color'
			)
		)
	);
	
	foreach ($meta_boxes as $meta_box) {
		new gp_Metabox($meta_box);
	}

}

add_action('admin_init', 'gp_register_metabox_post');

?>