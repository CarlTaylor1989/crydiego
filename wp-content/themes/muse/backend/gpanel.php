<?php

/*

@name			GPanel Init
@package		GPanel WordPress Framework
@since			3.0.0
@author			Pavel RICHTER <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels

====================================================================================================
Define Constants
====================================================================================================
*/

define('GP_VERSION', '3.0.0');
define('GP_SHORTNAME', 'gp');
define('GP_BASENAME', 'gp-theme-options');
define('GP_DIR', trailingslashit(get_template_directory()) . 'backend');
define('GP_URL', trailingslashit(get_template_directory_uri()) . 'backend');

/*
====================================================================================================
Load GPanel Components
====================================================================================================
*/

// Load Inits
require_once(trailingslashit(GP_DIR) . 'inits/init-backend.php');
require_once(trailingslashit(GP_DIR) . 'inits/init-backend-options.php');
require_once(trailingslashit(GP_DIR) . 'inits/init-backend-functions.php');
require_once(trailingslashit(GP_DIR) . 'inits/init-navigation.php');
require_once(trailingslashit(GP_DIR) . 'inits/init-postformats.php');
require_once(trailingslashit(GP_DIR) . 'inits/init-shortcodes.php');
require_once(trailingslashit(GP_DIR) . 'inits/init-support.php');
require_once(trailingslashit(GP_DIR) . 'inits/init-documentation.php');
require_once(trailingslashit(GP_DIR) . 'inits/init-widgets.php');

// Load Classes
require_once(trailingslashit(GP_DIR) . 'classes/class-metabox.php');
require_once(trailingslashit(GP_DIR) . 'classes/class-fields.php');

// Load Custom Post Types
require_once(trailingslashit(GP_DIR) . 'posttypes/posttype-album.php');
require_once(trailingslashit(GP_DIR) . 'posttypes/posttype-callout.php');
require_once(trailingslashit(GP_DIR) . 'posttypes/posttype-event.php');
require_once(trailingslashit(GP_DIR) . 'posttypes/posttype-gallery.php');
require_once(trailingslashit(GP_DIR) . 'posttypes/posttype-slide.php');
require_once(trailingslashit(GP_DIR) . 'posttypes/posttype-video.php');

// Load Widgets
require_once(trailingslashit(GP_DIR) . 'widgets/widget-about.php');
require_once(trailingslashit(GP_DIR) . 'widgets/widget-recent-albums.php');
require_once(trailingslashit(GP_DIR) . 'widgets/widget-recent-events.php');
require_once(trailingslashit(GP_DIR) . 'widgets/widget-recent-posts.php');
require_once(trailingslashit(GP_DIR) . 'widgets/widget-recent-tweet.php');
require_once(trailingslashit(GP_DIR) . 'widgets/widget-recent-videos.php');
require_once(trailingslashit(GP_DIR) . 'widgets/widget-subpages.php');
require_once(trailingslashit(GP_DIR) . 'widgets/widget-tweets.php');

// Load Shortcodes
require_once(trailingslashit(GP_DIR) . 'shortcodes/shortcodes.php');

// Load Metaboxes
require_once(trailingslashit(GP_DIR) . 'metaboxes/metabox-post.php');

if (!gp_seo_third_party()) {
	require_once(trailingslashit(GP_DIR) . 'metaboxes/metabox-global.php');
}

// Load Helpers
require_once(trailingslashit(GP_DIR) . 'helpers/gp-option.php');
require_once(trailingslashit(GP_DIR) . 'helpers/gp-meta.php');

?>