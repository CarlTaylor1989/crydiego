<?php

/*

@name			Styles
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/ 

/*
====================================================================================================
Frontend Styles
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Frontend Output Styles from WordPress Customizer
----------------------------------------------------------------------------------------------------
*/

function gp_frontend_styles_generate() {
	
	// Google Font Face
	if (gp_option('gp_font_face') != '') {
		
		$font_face = gp_option('gp_font_face');

	}
	
	// Colors
	$color_background = '#' . get_background_color();
	if (get_theme_mod('gp_color_text')) { $color_text = get_theme_mod('gp_color_text'); } else { $color_text = '#ffffff'; }
	if (get_theme_mod('gp_color_primary')) { $color_primary = get_theme_mod('gp_color_primary'); } else { $color_primary = '#198caf'; }
	if (get_theme_mod('gp_color_secondary')) { $color_secondary = get_theme_mod('gp_color_secondary'); } else { $color_secondary = '#cd503c'; }
	if (get_theme_mod('gp_color_tertiary')) { $color_tertiary = get_theme_mod('gp_color_tertiary'); } else { $color_tertiary = '#282d32'; }
	if (get_theme_mod('gp_color_footer')) { $color_footer = get_theme_mod('gp_color_footer'); } else { $color_footer = '#ffffff'; }
	if (get_theme_mod('gp_color_footer_text')) { $color_footer_text = get_theme_mod('gp_color_footer_text'); } else { $color_footer_text = '#14191e'; }
	
	// Header Options
	if (get_theme_mod('gp_header_position')) { $header_position = get_theme_mod('gp_header_position'); } else { $header_position = 'fixed'; }
	
	?>

	<style type="text/css">
	
	<?php if (gp_option('gp_font_face') != '') { ?>
		
/* Font Face */
	
	/* Typography */
	h1, h2, h3, h4, h5, h6 { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
	blockquote { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
	/* Forms */
	label { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
	/* Navigation */
	nav.navigation,
	nav.navigation-mobile li { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
	/* Slideshow */
	.slide-caption,
	.slide-caption p { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
	/* Widgets */
	.widget_recent_tweet .tweet_text, .widget_pages li a, .widget_subpages li a, .widget_nav_menu li a, .widget_archive li, .widget_categories li, .widget_archive li li, .widget_categories li li { font-family: "<?php echo $font_face; ?>", Helvetica, Arial, sans-serif !important; }
	
	<?php } ?>
	
/* Colors & Positions */
	
	/* CSS Common > Selection */
	::selection { background: <?php echo $color_secondary; ?>; }
	::-moz-selection { background: <?php echo $color_secondary; ?>; }
	/* CSS Common > Links */
	a { color: <?php echo $color_text; ?>; }
	a:hover { color: <?php echo $color_text; ?>; border-color: <?php echo $color_text; ?>; background-color: <?php echo $color_primary; ?>; }
	a.underline, .underline a, a.underline-hover:hover, .underline-hover a:hover { color: <?php echo $color_text; ?>; border-color: <?php echo $color_text; ?>; }
	/* Body */
	body { color: <?php echo $color_text; ?>; background-color: <?php echo $color_background; ?>; }
	/* Body Background */
	.body-background { background-color: <?php echo $color_background; ?>; }
	/* Typography */
	blockquote { color: <?php echo $color_secondary; ?>; }
	blockquote cite { color: <?php echo $color_text; ?>; }
	/* Forms */
	button, .button a, #comment-submit { color: <?php echo $color_text; ?>; background-color: <?php echo $color_primary; ?>; border-color: <?php echo $color_text; ?>; }
	button:hover, .button a:hover, #comment-submit:hover { background-color: <?php echo $color_secondary; ?> !important; border-color: <?php echo $color_secondary; ?>; }
	/* Forms > Comments */
	.comments .comment-body { background-color: <?php echo $color_background; ?>; }
	.comments .comment-body:before { border-top-color: <?php echo $color_background; ?>; }
	.comments .bypostauthor .comment-body { background-color: <?php echo $color_primary; ?>; }
	.comments .bypostauthor .comment-body:before { border-top-color: <?php echo $color_primary; ?>; }
	.comments .bypostauthor .comment-reply-link:hover { color: <?php echo $color_tertiary; ?>; background-color: <?php echo $color_text; ?>; }
	.comments #cancel-comment-reply-link { color: <?php echo $color_secondary; ?>; }
	.comments #cancel-comment-reply-link:hover { color: <?php echo $color_text; ?>; }
	/* Grid > Common */
	.grid-tiles .tile-block,
	.grid-tiles-sidebar .tile-block { background-color: <?php echo $color_tertiary; ?>; }
	/* Header */
	header.header { position: <?php echo $header_position; ?>; }
	/* Header > Logo */
	.logo-default { background-color: <?php echo $color_primary; ?>; }
	/* Navigation */
	nav.navigation { position: <?php echo $header_position; ?>; }
	/* Navigation > Navigation - Primary > 1st Level */
	nav.navigation li,
	nav.navigation li a { color: <?php echo $color_text; ?> !important; background-color: <?php echo $color_primary; ?>; }
	nav.navigation li:hover a,
	nav.navigation li a:hover { color: <?php echo $color_tertiary; ?> !important; background-color: <?php echo $color_text; ?> !important; }
	/* Navigation > Navigation - Primary > 2nd+ Level */
	nav.navigation li li,
	nav.navigation li li a { background-color: <?php echo $color_text; ?>; }
	nav.navigation li li a:hover { color: <?php echo $color_primary; ?> !important; }
	/* Navigation > Navigation - Mobile */
	.navigation-mobile-button a { background-color: <?php echo $color_primary; ?>; }
	.navigation-mobile-button a:hover { background-color: <?php echo $color_secondary; ?>; }
	nav.navigation-mobile li a { color: <?php echo $color_tertiary; ?> !important; background-color: <?php echo $color_text; ?>; }
	nav.navigation-mobile li a:hover { color: <?php echo $color_text; ?> !important; background-color: <?php echo $color_primary; ?>; }
	/* Toolbar > qTranslate Language Switcher */
	.toolbar .qtrans_language_chooser li { border-color: <?php echo $color_text; ?>; }
	.toolbar .qtrans_language_chooser li:hover { background-color: <?php echo $color_primary; ?>; }
	/* Toolbar > Search - Modal */
	.modal-search-button { border-color: <?php echo $color_text; ?>; }
	.modal-search-button:hover { background-color: <?php echo $color_primary; ?>; }
	.modal-search-close { background-color: <?php echo $color_secondary; ?>; }
	.modal-search-close:hover { background-color: <?php echo $color_primary; ?>; }
	/* Slideshow */
	.slide-caption h2,
	.slide-caption h2.link a { background-color: <?php echo $color_secondary; ?>; }
	.slide-caption h2.link a:hover { background-color: <?php echo $color_primary; ?>; }
	.slide-caption p { background-color: <?php echo $color_primary; ?>; }
	/* Posts > Common */
	.post .post-body,
	.post .post-image-container { background-color: <?php echo $color_tertiary; ?>; }
	.post-share li a { background-color: <?php echo $color_primary; ?>; }
	.post-buy.button a { color: <?php echo $color_text; ?>; border-color: <?php echo $color_text; ?>; }
	.post-buy.button a:hover { background-color: <?php echo $color_secondary; ?>; border-color: <?php echo $color_text; ?>; }
	/* Posts > Blog & Event Grid Home */
	.grid-post-home { background-color: <?php echo $color_primary; ?>; }
	.grid-post-home a:hover { background-color: <?php echo $color_secondary; ?>; }
	.grid-event-home { background-color: <?php echo $color_tertiary; ?>; }
	.grid-post-home .post a:hover .post-title { border-color: <?php echo $color_text; ?>; }
	/* Posts > Blog Grid */
	.grid-blog .tile.format-audio .post-body.corner:before,
	.grid-blog .tile.format-gallery .post-body.corner:before,
	.grid-blog .tile.format-video .post-body.corner:before,
	.grid-blog .tile.format-quote .post-body.corner:before { border-right-color: <?php echo $color_background; ?>; }
	.grid-blog .tile.format-audio .post-corner:before,
	.grid-blog .tile.format-gallery .post-corner:before,
	.grid-blog .tile.format-video .post-corner:before,
	.grid-blog .tile.format-quote .post-corner:before { border-top-color: <?php echo $color_tertiary; ?>; }
	.grid-blog .tile.format-quote blockquote { color: <?php echo $color_text; ?>; }
	/* Posts > Event Grid */
	.grid-event-past .tile .tile-block { background-color: <?php echo $color_tertiary; ?>; }
	/* Posts > Event List */
	.list-event .inner { background-color: <?php echo $color_tertiary; ?>; }
	/* Posts > Archive Grid */
	.grid-archives a { color: <?php echo $color_primary; ?>; }
	.grid-archives a:hover { color: <?php echo $color_text; ?>; }
	/* Singles > Common */
	.post-meta .post-comments a,
	.post-meta .post-categories a { color: <?php echo $color_primary; ?>; }
	.post-meta .post-comments a:hover,
	.post-meta .post-categories a:hover { color: <?php echo $color_text; ?>; }
	.post-meta-line ul.post-categories a { background-color: <?php echo $color_secondary; ?>; }
	.post-meta-line ul.post-categories a:hover { background-color: <?php echo $color_primary; ?>; }
	.post-meta-table .inner { background-color: <?php echo $color_tertiary; ?>; }
	/* Singles > Single Blog */
	.single-blog .format-quote blockquote { color: <?php echo $color_text; ?>; }
	/* Singles > Single Event */
	.single-event .post-meta .button a { background-color: <?php echo $color_secondary; ?>; }
	.single-event .post-meta .button a:hover { background-color: <?php echo $color_primary; ?>; }
	.single-event .post-facebook a:hover { background-color: <?php echo $color_secondary; ?> !important; }
	/* Singles > Single Album */
	.single-album .post-meta .button a { background-color: <?php echo $color_secondary; ?>; }
	.single-album .post-meta .button a:hover { background-color: <?php echo $color_primary; ?>; }
	/* Pagination */
	.pagination a,
	.pagination-post a { background-color: <?php echo $color_primary; ?>; }
	.pagination a:hover,
	.pagination-post a:hover,
	.pagination span.current { background-color: <?php echo $color_secondary; ?>; }
	/* Widgets > Areas */
	.wa-footer-top { color: <?php echo $color_footer_text; ?>; background-color: <?php echo $color_footer; ?>; }
	.wa-footer-bottom { color: <?php echo $color_footer_text; ?>; background-color: <?php echo $color_footer; ?>; }
	.wa-footer-container { border-color: <?php echo $color_background; ?>; }
	/* Widget Tweets [Custom] */
	.widget_tweets li a,
	.widget_recent_tweet li a { color: <?php echo $color_primary; ?>; }
	.widget_tweets li a:hover,
	.widget_recent_tweet li a:hover { color: <?php echo $color_text; ?>; }
	/* Widget Recent [WordPress & Custom] */
	.widget_recent_posts a,
	.widget_recent_events a,
	.widget_recent_albums a,
	.widget_recent_videos a,
	.widget_recent_entries a,
	.widget_recent_comments a { color: <?php echo $color_primary; ?>; border-color: <?php echo $color_primary; ?>; }
	.widget_recent_posts a:hover,
	.widget_recent_events a:hover,
	.widget_recent_albums a:hover,
	.widget_recent_videos a:hover,
	.widget_recent_entries a:hover,
	.widget_recent_comments a:hover { color: <?php echo $color_text; ?>; }
	/* Widget Pages, Subpages, Navigation [WordPress] */
	.widget_pages li a,
	.widget_subpages li a,
	.widget_nav_menu li a { background-color: <?php echo $color_primary; ?>; }
	.widget_pages li a:hover,
	.widget_subpages li a:hover,
	.widget_nav_menu li a:hover { background-color: <?php echo $color_secondary; ?>; }
	/* Widget Archive, Categories [WordPress] */
	.widget_archive li,
	.widget_categories li { color: <?php echo $color_text; ?>; background-color: <?php echo $color_primary; ?>; }
	.widget_archive li a,
	.widget_categories li a { color: <?php echo $color_text; ?>; }
	/* Widget Tag Cloud & Tags [WordPress] */
	.post-tags a,
	.widget_tag_cloud a { background-color: <?php echo $color_primary; ?>; }
	.post-tags a:hover,
	.widget_tag_cloud a:hover { background-color: <?php echo $color_secondary; ?>; }
	/* Widget Links [WordPress] */
	.widget_links li a { color: <?php echo $color_primary; ?>; }
	.widget_links li a:hover { color: <?php echo $color_text; ?>; }
	/* Widget qTranslate [qTranslate] */
	.widget_qtranslate li a { background-color: <?php echo $color_primary; ?>; }
	.widget_qtranslate li a:hover { background-color: <?php echo $color_secondary; ?>; }
	
/* Components */
	
	/* Components > Slideshow */
	.gp-theme .rsArrowIcn { background-color: <?php echo $color_secondary; ?>; }
	.gp-theme .rsArrowIcn:hover { background-color: <?php echo $color_primary; ?>; }
	.gp-theme .rsPlayBtn .rsPlayBtnIcon { background-color: <?php echo $color_tertiary; ?>; }
	.gp-theme .rsPlayBtn:hover .rsPlayBtnIcon { background-color: <?php echo $color_secondary; ?>; }
	.gp-theme .rsCloseVideoIcn { background-color: <?php echo $color_secondary; ?>; }
	.gp-theme .rsCloseVideoIcn:hover { background-color: <?php echo $color_primary; ?>; }
	/* Components > Player */
	.player a:hover { background-color: <?php echo $color_primary; ?> !important; }
	.player-progress { background-color: <?php echo $color_tertiary; ?>; }
	.player-progress .player-seek-bar { background-color: <?php echo $color_tertiary; ?>; }
	.player-progress .player-play-bar { background-color: <?php echo $color_secondary; ?>; }
	.player-controls { background-color: <?php echo $color_tertiary; ?>; }
	.player-controls .player-volume-value { background-color: <?php echo $color_text; ?>; }
	.player-controls .player-volume-container { background-color: <?php echo $color_background; ?>; }
	.player-playlist ul li a { background-color: <?php echo $color_tertiary; ?>; }
	.player-playlist ul li a:hover { background-color: <?php echo $color_secondary; ?> !important; }
	.player-playlist ul li.jp-playlist-current a { background-color: <?php echo $color_primary; ?> !important; }
	.grid-blog .post-audio { background-color: <?php echo $color_background; ?>; }
	/* Components > Lightbox */
	.lightbox-arrow-left,
	.lightbox-arrow-right { background-color: <?php echo $color_secondary; ?>; }
	.lightbox-arrow-left:hover,
	.lightbox-arrow-right:hover { background-color: <?php echo $color_primary; ?>; }
	.lightbox-close { background-color: <?php echo $color_secondary; ?>; }
	.lightbox-close:hover { background-color: <?php echo $color_primary; ?>; }
	/* Components > Tabs */
	.ui-tabs .ui-tabs-nav li.ui-state-default a { color: <?php echo $color_text; ?>; background-color: <?php echo $color_primary; ?>; }
	.ui-tabs .ui-tabs-nav li.ui-state-default a:hover { color: <?php echo $color_text; ?>; background-color: <?php echo $color_secondary; ?>; }
	.ui-tabs .ui-tabs-nav li.ui-state-active a,
	.ui-tabs .ui-tabs-nav li.ui-state-active a:hover { color: <?php echo $color_primary; ?>; background-color: <?php echo $color_text; ?>; }
	.ui-tabs .ui-tabs-panel { background-color: <?php echo $color_text; ?>; color: <?php echo $color_tertiary; ?>; }
	/* Components > Back to Top Button */
	.back-to-top { background-color: <?php echo $color_secondary; ?>; }
	.back-to-top:hover { background-color: <?php echo $color_primary; ?>; }
	
	<?php if (gp_option('gp_custom_css')) {	?>
	
/* Custom CSS */
	<?php echo stripslashes(htmlspecialchars(gp_option('gp_custom_css'))); ?>
		
	<?php } ?>
	
	</style>
	
	<?php
	
}

add_action('wp_head', 'gp_frontend_styles_generate');

?>