<?php

/*

@name			Theme Functions
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/ 

/*
====================================================================================================
Frontend Setup
====================================================================================================
*/

function gp_frontend_setup() {

	// Add Custom Background Support
	add_theme_support(
		'custom-background',
		array(
			'default-color' 		=> '00050a'
		)
	);
	
	// Add Post Thumbnails Support
	add_theme_support('post-thumbnails');
	
	// Add Automatic Feed Links Support
	add_theme_support('automatic-feed-links');
	
	// Editor Stylesheet
	add_editor_style('styles/style-editor.css');
	
}

add_action('after_setup_theme', 'gp_frontend_setup');

/*
====================================================================================================
Frontend Scripts
====================================================================================================
*/

function gp_frontend_scripts() {
	
	if (!is_admin()) {
	
		// jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', false, '1.8.3', true);
		wp_enqueue_script('jquery');
		
		// jQuery UI
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		
		if (is_page_template('template-home.php')) {
			
			// jQuery Easing
			wp_register_script('gp-easing', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.easing.js', array('jquery'), '1.3', true);
			wp_enqueue_script('gp-easing');
			
			// jQuery RoyalSlider
			wp_register_script('gp-slider', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.slider.min.js', array('jquery', 'gp-easing'), '9.4.5', true);
			wp_enqueue_script('gp-slider');
		
			// jQuery Center
			wp_register_script('gp-center', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.center.js', array('jquery'), '1.0.0', true);
			wp_enqueue_script('gp-center');
		
		}

		// jQuery jPlayer
		wp_register_script('gp-jplayer', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.jplayer.min.js', array('jquery'), '2.2.0', true);
		wp_enqueue_script('gp-jplayer');
		
		if (get_post_type() == 'album' && is_single()) {
			
			// jQuery jPlayer Playlist
			wp_register_script('gp-jplayer-playlist', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.jplayer.playlist.min.js', array('jquery', 'gp-jplayer'), '2.1.0', true);
			wp_enqueue_script('gp-jplayer-playlist');
			
		}
		
		// jQuery Isotope
		wp_register_script('gp-isotope', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.isotope.min.js', array('jquery'), '1.5.21', true);
		wp_enqueue_script('gp-isotope');
		
		// jQuery Image Loader
		wp_register_script('gp-loadimages', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.loadimages.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('gp-loadimages');
		
		// jQuery FitVids
		wp_register_script('gp-fitvids', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.fitvids.js', array('jquery'), '1.0', true);
		wp_enqueue_script('gp-fitvids');
		
		// jQuery Backstretch
		wp_register_script('gp-backstretch', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.backstretch.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('gp-backstretch');
		
		// jQuery Respond
		wp_register_script('gp-respond', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.respond.min.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('gp-respond');
		
		// jQuery Lightbox
		wp_register_script('gp-lightbox', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.touchtouch.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('gp-lightbox');

		if (is_page_template('template-contact.php')) {
		
			// jQuery Form
			wp_register_script('gp-form', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.form.js', array('jquery'), '2.63', true);
			wp_enqueue_script('gp-form');
		
			// jQuery Validate
			wp_register_script('gp-validate', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.validate.min.js', array('jquery'), '1.8.1', true);
			wp_enqueue_script('gp-validate');
		
		}
		
		// jQuery Muse
		wp_register_script('muse', trailingslashit(get_template_directory_uri()) . 'javascripts/jquery.muse.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('muse');
		
	}
	
	if (is_singular() && get_option('thread_comments') && comments_open()) { 
		// Comment Reply JavaScript
		wp_enqueue_script('comment-reply'); 
		
	}
	
}

add_action('wp_enqueue_scripts', 'gp_frontend_scripts');

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Homepage
----------------------------------------------------------------------------------------------------
*/

function gp_homepage_scripts() {

	if (is_page_template('template-home.php')) {
	
		// Variables
		if (gp_option('gp_slideshow_nav') == 'false') {
			$arrowsnav = 'false';
		} else {
			$arrowsnav = 'true';
		}
		if (gp_option('gp_slideshow_nav_autohide') == 'true') {
			$arrowsnavautohide = 'true';
		} else {
			$arrowsnavautohide = 'false';
		}
		if (gp_option('gp_slideshow_nav_touch') == 'true') {
			$arrowsnavhideontouch = 'true';
		} else {
			$arrowsnavhideontouch = 'false';
		}
		if (gp_option('gp_slideshow_drag') == 'false' || wp_count_posts('slide')->publish == 1) {
			$sliderdrag = 'false';
		} else {
			$sliderdrag = 'true';
		}
		if (gp_option('gp_slideshow_touch') == 'false' || wp_count_posts('slide')->publish == 1) {
			$slidertouch = 'false';
		} else {
			$slidertouch = 'true';
		}
		if (gp_option('gp_slideshow_nav_by_click') == 'false' || wp_count_posts('slide')->publish == 1) {
			$navigatebyclick = 'false';
		} else {
			$navigatebyclick = 'true';
		}
		if (gp_option('gp_slideshow_transition_type')) {
			$transitiontype = gp_option('gp_slideshow_transition_type');
		} else {
			$transitiontype = 'move';
		}
		if (is_numeric(gp_option('gp_slideshow_transition_speed'))) {
			$transitionspeed = gp_option('gp_slideshow_transition_speed');
		} else {
			$transitionspeed = '1000';
		}
		if (gp_option('gp_slideshow_autoplay') == 'true') {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}
		if (is_numeric(gp_option('gp_slideshow_delay'))) {
			$delay = gp_option('gp_slideshow_delay');
		} else {
			$delay = '5000';
		}
		
		?>
	
		<script type="text/javascript">
		
			//<![CDATA[
			
				jQuery(document).ready(function() {
					"use strict";
					
					// Slideshow
					jQuery('.slideshow').royalSlider({
						loop: false,
						keyboardNavEnabled: true,
						controlsInside: false,
						imageScaleMode: 'fill',
						arrowsNav: <?php echo $arrowsnav; ?>,
						arrowsNavAutoHide: <?php echo $arrowsnavautohide; ?>,
						arrowsNavHideOnTouch: <?php echo $arrowsnavhideontouch ?>,
						sliderDrag: <?php echo $sliderdrag; ?>,
						sliderTouch: <?php echo $slidertouch; ?>,
						autoScaleSlider: true,
						controlNavigation: 'none',
						navigateByClick: <?php echo $navigatebyclick; ?>,
						transitionType: '<?php echo $transitiontype; ?>',
						transitionSpeed: <?php echo $transitionspeed; ?>,
						slidesSpacing: 0,
						globalCaption: false,
						block: {
							fadeEffect: false,
							moveEffect: 'left'
						},
						autoPlay: {
							enabled: <?php echo $autoplay; ?>,
							pauseOnHover: false,
							delay: <?php echo $delay; ?>
						},
						video: {
							autoHideArrows: true,
							autoHideControlNav: true,
							autoHideBlocks: true,
							youTubeCode:'<iframe type="text/html" width="100%" height="100%" src="http://www.youtube.com/embed/%id%?wmode=opaque&amp;autoplay=1&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" frameborder="0" allowfullscreen></iframe>'	
						}
					});
					
					var slider = jQuery('.slideshow').data('royalSlider');
					
					slider.ev.on('rsVideoPlay', function() {  
						jQuery('.header').hide();
						jQuery('.navigation').hide();
						jQuery('.navigation-mobile').hide();
						jQuery('.navigation-mobile-button').hide();
						jQuery('.toolbar').hide();
						jQuery('.content-home').hide();
					});
					
					slider.ev.on('rsVideoStop', function() {
						jQuery('.header').show();
						jQuery('.navigation').show();
						jQuery('.navigation-mobile-button').show();
						jQuery('.toolbar').show();
						jQuery('.content-home').show();	
					});
					
				});
				
				// Center
				jQuery(document).ready(function() {
					"use strict";
					
					// Center Images
					jQuery(".grid-callout-home .post-image img").imgCenter();
				 
				});

			//]]>
		
		</script>
		
		<?php
	}
}

add_action('wp_print_footer_scripts', 'gp_homepage_scripts');

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Global
----------------------------------------------------------------------------------------------------
*/

function gp_global_scripts() {
?>
        
	<script type="text/javascript">
    
        //<![CDATA[
            
            // Load Images
            jQuery(document).ready(function() {
                "use strict";
                
                // Load Images
                jQuery(".canvas").loadImages();

                // Fit Videos
                jQuery(".canvas").fitVids();
             
            });
            
            <?php
            if (gp_option('gp_image_background')) {
                
                $background_image			= gp_option('gp_image_background');
                
                if (gp_option('gp_image_background_opacity') == '' || gp_option('gp_image_background_opacity') == '1') {
                    $background_opacity		 = '1';
                } else {
                    $background_opacity		 = gp_option('gp_image_background_opacity');
                }
            ?>
            
                    // Backstretch Background
                    jQuery(document).ready(function() {
                        "use strict";
                        
                        jQuery(".body-background").backstretch("<?php echo $background_image; ?>").css('opacity', '<?php echo $background_opacity; ?>');
                     
                    });

            
            <?php
            }
            ?>
            
        //]]>
        
    </script>
		
<?php
}

add_action('wp_print_footer_scripts', 'gp_global_scripts');

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Contact
----------------------------------------------------------------------------------------------------
*/

function gp_contact_scripts() {
		
	if (is_page_template('template-contact.php')) { 
		
		$gp_recaptcha					= gp_option('gp_form_recaptcha');
		$gp_recaptcha_theme 			= gp_option('gp_form_recaptcha_theme');
		
		if (empty($gp_recaptcha_theme)) {
			$gp_recaptcha_theme 		= 'clean';
		}
	?>

		<script type="text/javascript">
			
			//<![CDATA[
			
				jQuery(document).ready(function() {
					"use strict";
					
					jQuery("#form-contact").validate({
						messages: {
							contact_name: '<?php _e('Please fill your name.', 'gp'); ?>',
							contact_email: {
								required: '<?php _e('Please fill your email address.', 'gp'); ?>',
								email: '<?php _e('Please fill the valid email address.', 'gp'); ?>'
							},
							contact_message: '<?php _e('Please fill your message.', 'gp'); ?>',
							captcha_message: '<?php _e('Please fill valid captcha.', 'gp'); ?>'
						}
					});
					
				});
				
				<?php if ($gp_recaptcha == 'true') { ?>
				
				var RecaptchaOptions = {
					theme: '<?php echo $gp_recaptcha_theme; ?>'
				};
				
				<?php } ?>
			
			//]]>
			
		</script>
		
	<?php
	}
}

add_action('wp_print_footer_scripts', 'gp_contact_scripts');

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Audio Post Format
----------------------------------------------------------------------------------------------------
*/

function gp_audio_scripts() {
	global $post_id;

	if (have_posts()) { 
		while (have_posts()) { 
			the_post();
			
			// Get Files
			$files = gp_meta('gp_post_mp3', 'type=upload_plupload');
			
			foreach ($files as $file) {
				$audio_url = $file['url'];
			}
			
			if (get_post_format() == 'audio' && $files != NULL) {
	?>

				<script type="text/javascript">
                    
                    //<![CDATA[
                    
                        jQuery(document).ready(function() {
							"use strict";
                                
                            jQuery('.player-<?php the_ID(); ?>').jPlayer({
                                ready: function () {
                                    jQuery(this).jPlayer('setMedia', {
                                        mp3: '<?php echo $audio_url; ?>'
                                    });
                                },
                                play: function() {
                                    jQuery(this).jPlayer('pauseOthers');
                                },
                                swfPath: '<?php echo get_template_directory_uri(); ?>/javascripts',
                                supplied: 'mp3',
                                solution: 'html, flash',
                                volume: 0.8,
                                cssSelectorAncestor: '.player-container-<?php the_ID(); ?>',
                                cssSelector: {
                                    play: '.player-play',
                                    pause: '.player-pause',
                                    stop: '.player-stop',
                                    mute: '.player-mute',
                                    unmute: '.player-unmute',
                                    seekBar: '.player-seek-bar',
                                    playBar: '.player-play-bar',
                                    volumeBar: '.player-volume',
                                    volumeBarValue: '.player-volume-value'
                                }
                            });
                            
                        });
                    
                    //]]>
                    
                </script>
		
	<?php
			}
		}
	}
}

add_action('wp_print_footer_scripts', 'gp_audio_scripts');

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Album
----------------------------------------------------------------------------------------------------
*/

function gp_album_scripts() {
	global $post_id;

	if (have_posts()) { 
		while (have_posts()) { 
			the_post();
			
			// Get Files
			$files = gp_meta('gp_album_songs', 'type=upload_plupload');
			
			foreach ($files as $file) {
				$audio_url = $file['url'];
			}
			
			if ($files != NULL && get_post_type() == 'album' && is_single()) {
	?>

				<script type="text/javascript">
                    
                    //<![CDATA[
                    
                        jQuery(document).ready(function() {
							"use strict";
                                                    
							var playList =  new jPlayerPlaylist({
								jPlayer: '.player-<?php the_ID(); ?>',
								cssSelectorAncestor: '.player-container-<?php the_ID(); ?>'
							}, [
								<?php
								$file_count = 1;
								foreach ($files as $file) {
									
									?>
									{
										title: '<?php echo $file['title']; ?>',
										mp3: '<?php echo $file['url']; ?>'
									}<?php if ($file_count != sizeof($files)) { ?>,<?php } ?>
									<?php
									$file_count++;
								}
								?>
							], {
								swfPath: '<?php echo get_template_directory_uri(); ?>/javascripts',
								supplied: 'mp3',
								solution: 'html, flash',
								volume: 0.8,
								cssSelector: {
									play: '.player-play',
									pause: '.player-pause',
									stop: '.player-stop',
									mute: '.player-mute',
									unmute: '.player-unmute',
									seekBar: '.player-seek-bar',
									playBar: '.player-play-bar',
									volumeBar: '.player-volume',
									volumeBarValue: '.player-volume-value',
									currentTime: ".player-current-time",
									duration: ".player-duration"
								}
							});
							
						});
                    
                    //]]>
                    
                </script>
		
	<?php
			}
		}
	}
}

add_action('wp_print_footer_scripts', 'gp_album_scripts');

/*
----------------------------------------------------------------------------------------------------
Frontend Scripts > Search
----------------------------------------------------------------------------------------------------
*/

function gp_search_scripts() {
?>

	<script type="text/javascript">
        
        //<![CDATA[
		
			jQuery(document).ready(function() {
	
				jQuery('input[name=s]').focus(function() {
					"use strict";
					
					if (jQuery(this).val() === '<?php _e('Search ...', 'gp'); ?>') {
						jQuery(this).val('');
					}
					
				});
				
				jQuery('input[name=s]').blur(function() {
					"use strict";
					
					if (jQuery(this).val() === '') {
						jQuery(this).val('<?php _e('Search ...', 'gp'); ?>'); 
					}
					
				});
			
			});

        //]]>
        
    </script>
		
<?php
}

add_action('wp_print_footer_scripts', 'gp_search_scripts');

/*
====================================================================================================
Frontend Styles
====================================================================================================
*/

function gp_frontend_styles() {
		
	if (!is_admin()) {
		
		// Core Stylesheet
		wp_enqueue_style('gp-style', trailingslashit(get_template_directory_uri()) . 'style.css', array(), '', 'all');
		
		// Font Face Stylesheet [Google Font API]
		if (gp_option('gp_font_face') != '') {
			
			$font_face = gp_option('gp_font_face');
			$font_face = str_replace(' ', '+', $font_face);
			
			// Google Font Face Stylesheet
			wp_enqueue_style('gp-style-font-' . strtolower($font_face), 'http://fonts.googleapis.com/css?family=' . $font_face);
			
		} else {
			
			// Default Font Face Stylesheet
			wp_enqueue_style('gp-style-font', trailingslashit(get_template_directory_uri()) . 'styles/style-font.css');
			
		}
		
		// Open Sans Stylesheet [Google Font API]
		wp_enqueue_style('gp-style-font-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans');
		
		// Theme Stylesheet
		wp_enqueue_style('gp-style-theme', trailingslashit(get_template_directory_uri()) . 'styles/style-muse.css');
		
		// Components Stylesheet
		wp_enqueue_style('gp-style-components', trailingslashit(get_template_directory_uri()) . 'styles/style-components.css');
		
		
		// Skin Stylesheet
		/*
		----------------------------------------------------------------------------------------------------
		Uncomment following line if you want use the default colors or make your own color skin by
		editing 'styles/style-skin.css' file. Then follow line 377 in 'functions.php' file.
		----------------------------------------------------------------------------------------------------
		*/
		// wp_enqueue_style('gp-style-skin', trailingslashit(get_template_directory_uri()) . 'styles/style-skin.css');
		
		// Responsivity Stylesheet
		if (gp_option('gp_responsivity') != 'false') {
			
			wp_enqueue_style('gp-style-responsivity', trailingslashit(get_template_directory_uri()) . 'styles/style-responsivity.css');
			
		}
		
	}
	
}

add_action('wp_enqueue_scripts', 'gp_frontend_styles');

/*
----------------------------------------------------------------------------------------------------
Init Dynamic Frontend Style
----------------------------------------------------------------------------------------------------
*/

/*
----------------------------------------------------------------------------------------------------
Comment following line if you don't want use the colors chosen in the WordPress Theme Customizer and if
you did uncomment the line 350 in 'functions.php' file.
----------------------------------------------------------------------------------------------------
*/
require_once(trailingslashit(get_template_directory()) . 'style.php');

/*
----------------------------------------------------------------------------------------------------
Global Styles
----------------------------------------------------------------------------------------------------
*/

function gp_frontend_styles_global() {
	
	if (gp_option('gp_image_background')) {
	?>
    
	<style type="text/css">
		body.custom-background { background-image: none !important; }
	</style>
	
	<?php
	}
		
}

add_action('wp_head', 'gp_frontend_styles_global');

/*
----------------------------------------------------------------------------------------------------
Post Styles
----------------------------------------------------------------------------------------------------
*/

function gp_frontend_styles_post() {
	
	if (is_home() || is_archive()) {
	?>
    
	<style type="text/css">
	<?php
	// Query
	$gp_query_args = array(
		'posts_per_page'	=> -1
	);
	$gp_query = NULL;
	$gp_query = new WP_Query($gp_query_args);

	// Loop
	if ($gp_query->have_posts()) {
		while ($gp_query->have_posts()) {
			$gp_query->the_post();
			
			$post_background	= gp_meta('gp_post_block_background');
			$color_tertiary		= get_theme_mod('gp_color_tertiary');
			
			if (!empty($post_background)) {
			?>
        	.grid-blog #post-<?php the_ID(); ?> .post-body,
			.grid-blog #post-<?php the_ID(); ?> .post-image-container { background-color: <?php echo $post_background; ?>; }
			
			.grid-blog #post-<?php the_ID(); ?> .post-audio .player-progress { background-color: <?php echo $post_background; ?>; }
			.grid-blog #post-<?php the_ID(); ?> .player-progress .player-seek-bar { background-color: <?php echo $post_background; ?>; }
			.grid-blog #post-<?php the_ID(); ?> .player-controls { background-color: <?php echo $post_background; ?>; }

			#post-<?php the_ID(); ?> .post-corner:before { border-top-color: <?php echo $post_background; ?>; }
			<?php
			}
		}
	}
	?>
	</style>
	
	<?php
	}
		
}

add_action('wp_head', 'gp_frontend_styles_post');

/*
----------------------------------------------------------------------------------------------------
Event Styles
----------------------------------------------------------------------------------------------------
*/

function gp_frontend_styles_event() {
	
	if (is_page_template('template-event.php') || is_page_template('template-event-list.php')) {
	?>
    
	<style type="text/css">
	<?php
	
	// Event Loop
	$gp_query_args = array(
		'post_type'			=> 'event',
		'posts_per_page'	=> -1
	);
	$gp_query = NULL;
	$gp_query = new WP_Query($gp_query_args);
	
	if ($gp_query->have_posts()) {
		while ($gp_query->have_posts()) {
			$gp_query->the_post();
			
			$event_background	= gp_meta('gp_event_block_background');
			
			if (!empty($event_background)) {
			?>
			.grid-event-upcoming #post-<?php the_ID(); ?> .post-body,
			.list-event-upcoming #post-<?php the_ID(); ?> .inner { background-color: <?php echo $event_background; ?>; }
			<?php
			}
		}
	}
		
	?>
	</style>
	
	<?php
	}
		
}

add_action('wp_head', 'gp_frontend_styles_event');

/*
====================================================================================================
Display Navigation
====================================================================================================
*/

function gp_navigation() {

	wp_nav_menu(
		array(
			'theme_location'	=> 'primary_navigation',
			'depth'				=> 3
		)
	);
	
}

/*
----------------------------------------------------------------------------------------------------
Remove current_page_item Class of Blog Page
----------------------------------------------------------------------------------------------------
*/

function gp_current_page_item_remove($classes, $item) {

    $post_type = get_query_var('post_type');

    if (get_post_type() == $post_type) {
        $classes = array_filter($classes, "get_current_value");
	}
	
	if (is_search()) {
        $classes = array_filter($classes, "get_current_value");
	}

    return $classes;
	
}

function get_current_value($element) {
    return ($element != "current_page_parent");
}

add_filter('nav_menu_css_class', 'gp_current_page_item_remove', 10, 2);

/*
----------------------------------------------------------------------------------------------------
Add current_page_item Class for CPT Menu Item
----------------------------------------------------------------------------------------------------
*/

function gp_current_page_item_add($classes = array(), $menu_item = false){

    $post_type = get_post_type();
    $page_template = get_post_meta($menu_item->object_id, '_wp_page_template', true);

    if (is_single() && $post_type == 'album' && $page_template == 'template-album.php') {
        $classes[] = 'current_page_item';
    }
	
	if (is_single() && $post_type == 'event' && $page_template == 'template-event.php') {
        $classes[] = 'current_page_item';
    }
	if (is_single() && $post_type == 'event' && $page_template == 'template-event-list.php') {
        $classes[] = 'current_page_item';
    }
	
	if (is_single() && $post_type == 'gallery' && $page_template == 'template-gallery.php') {
        $classes[] = 'current_page_item';
    }
	
	if (is_single() && $post_type == 'video' && $page_template == 'template-video.php') {
        $classes[] = 'current_page_item';
    }

    return $classes;
	
}

add_filter('nav_menu_css_class', 'gp_current_page_item_add', 10, 2);

/*
====================================================================================================
Pagination
====================================================================================================
*/

function gp_pagination() {
	global $wp_query;

	$big = 999999999;
	
	echo '<div class="pagination one-entire clearfix">';
	echo paginate_links(
		array(
			'base'		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format'	=> '?paged=%#%',
			'current'	=> max(1, get_query_var('paged')),
			'total'		=> $wp_query->max_num_pages
		)
	);
	echo '</div><!-- END // pagination -->';
	
}

/*
====================================================================================================
Pagination for Posts
====================================================================================================
*/

function gp_pagination_post($defaults) {
	
	$args = array(
		'before'		=> '<div class="pagination-post">',
		'after'			=> '</div><!-- END // pagination-post -->',
	);
	
	$r = wp_parse_args($args, $defaults);
	
	return $r;
	
}

add_filter('wp_link_pages_args', 'gp_pagination_post');

/*
====================================================================================================
Time
====================================================================================================
*/

function gp_time_ago() {
	global $post;

	$date = get_post_time('G', true, $post);
	$chunks = array(
		array(60 * 60 * 24 * 365, __('year', 'gp'), __('years', 'gp')),
		array(60 * 60 * 24 * 30, __('month', 'gp'), __('months', 'gp')),
		array(60 * 60 * 24 * 7, __('week', 'gp'), __('weeks', 'gp')),
		array(60 * 60 * 24, __('day', 'gp'), __('days', 'gp')),
		array(60 * 60, __('hour', 'gp'), __('hours', 'gp')),
		array(60, __('minute', 'gp'), __('minutes', 'gp')),
		array(1, __('second', 'gp'), __('seconds', 'gp'))
	);
 
	if (!is_numeric($date)) {
		$time_chunks		= explode(':', str_replace(' ', ':', $date));
		$date_chunks		= explode('-', str_replace(' ', '-', $date));
		$date				= gmmktime((int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0]);
	}
 
	$current_time		= current_time('mysql', $gmt = 0);
	$newer_date			= strtotime( $current_time );
	$since				= $newer_date - $date;
 
	if ($since < 0) {
		return __('sometime', 'gp');
	}

	for ($i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
 
		if (($count = floor($since / $seconds)) != 0) {
			break;
		}
	}

	$output = ($count == 1) ? '1 ' . $chunks[$i][1] : $count . ' ' . $chunks[$i][2];

	if (!(int)trim($output)) {
		$output = '0 ' . __('seconds', 'gp');
	}
	
	$output .= __(' ago', 'gp');
 
	return $output;
	
}

add_filter('the_time', 'gp_time_ago');

/*
====================================================================================================
Social Sharing
====================================================================================================
*/

function gp_share() {
	global $post_id;
	
	$title = get_the_title();
	$original_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
	
	if (gp_option('gp_share_twitter') != 'false' || gp_option('gp_share_facebook') || 'false' && gp_option('gp_share_googleplus') != 'false' || gp_option('gp_share_pinterest') != 'false') {
	?>
    
    <div class="post-share">

        <h3><?php _e('Share', 'gp'); ?></h3>

        <ul>
        
        	<?php if (gp_option('gp_share_twitter') != 'false') { ?>
        
                <li class="share-twitter social-twitter">
                    <a href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo str_replace(" ", "%20", $title); ?>" title="<?php _e('Tweet This', 'gp'); ?>" target="_blank"></a>
                </li>
            
            <?php } ?>
            
            <?php if (gp_option('gp_share_facebook') != 'false') { ?>
        
                <li class="share-facebook social-facebook">
                    <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;title=<?php echo str_replace(" ", "%20", $title); ?>" title="<?php _e('Share on Facebook', 'gp'); ?>" target="_blank"></a>
                </li>
            
            <?php } ?>
            
            <?php if (gp_option('gp_share_googleplus') != 'false') { ?>
        
                <li class="share-googleplus social-googleplus">
                    <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title="<?php _e('Share on Google+', 'gp'); ?>" target="_blank"></a>
                </li>
            
            <?php } ?>
            
            <?php if (gp_option('gp_share_pinterest') != 'false') { ?>
        
                <li class="share-pinterest social-pinterest">
                    <a href="javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());" title="<?php _e('Pin it', 'gp'); ?>" target="_blank"></a>
                </li>
            
            <?php } ?>

        </ul>
        
    </div>
    
    <?php
	}
	
}

/*
====================================================================================================
Add Custom Hooks
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Add Custom Hooks > Meta Head
----------------------------------------------------------------------------------------------------
*/

function gp_meta_head() { 

	do_action('gp_meta_head');

}

/*
----------------------------------------------------------------------------------------------------
Add Custom Hooks > Footer
----------------------------------------------------------------------------------------------------
*/

function gp_footer() { 

	do_action('gp_footer');

}

/*
====================================================================================================
Third Party SEO Plugins
====================================================================================================
*/

function gp_seo_third_party() {
	
	include_once(ABSPATH . 'wp-admin/includes/plugin.php');
	
	if (is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')) {
		return true;
	}
	
	if (is_plugin_active('wordpress-seo/wp-seo.php')) {
		return true;
	}
	
	return false;
	
}

/*
====================================================================================================
Title
====================================================================================================
*/

function gp_title($title) {
	global $post_id;
	
	if (!gp_seo_third_party()){	
		if (is_front_page()) {
			return get_bloginfo('name') . ' &rsaquo; ' . get_bloginfo('description'); 
		} else if (is_feed()) {
			return trim($title); 
		} else {
			return trim($title) . ' &lsaquo; ' . get_bloginfo('name'); 
		}
	}

	return $title;

}

add_filter('wp_title', 'gp_title');

/*
====================================================================================================
Add Meta
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Add Keywords
----------------------------------------------------------------------------------------------------
*/

if (!gp_seo_third_party()) {

	function gp_meta_keywords() {
		global $post_id;
	
		if (gp_meta('gp_page_keywords') != '') {
		?>
		<meta name="keywords" content="<?php echo gp_meta('gp_page_keywords'); ?>" />
		<?php
		} else {
		?>
		<meta name="keywords" content="<?php echo gp_option('gp_meta_keywords_default'); ?>" />
		<?php 
		}
		
	}
	
	add_action('gp_meta_head', 'gp_meta_keywords');

}

/*
----------------------------------------------------------------------------------------------------
Add Description
----------------------------------------------------------------------------------------------------
*/

if (!gp_seo_third_party()) {

	function gp_meta_description() {
		global $post_id;
	
		if (gp_meta('gp_page_description') != '') {
		?>
		<meta name="description" content="<?php echo gp_meta('gp_page_description'); ?>" />
		<?php
		} else {
		?>
		<meta name="description" content="<?php echo gp_option('gp_meta_description_default'); ?>" />
		<?php 
		}
		
	}
	
	add_action('gp_meta_head', 'gp_meta_description');

}

/*
====================================================================================================
Footer Tracking
====================================================================================================
*/

function gp_footer_tracking() {

	if (gp_option('gp_tracking_code')) { 
		echo stripslashes(gp_option('gp_tracking_code'));
	}
	
}

add_action('gp_footer', 'gp_footer_tracking');

/*
====================================================================================================
Remove WordPress Version to Increase Security
====================================================================================================
*/

function gp_kill_wp_version() {
	
	return '';
	
}

add_filter('the_generator', 'gp_kill_wp_version');

/*
====================================================================================================
Browser Body Class
====================================================================================================
*/

function gp_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if ($is_lynx) { 
		$classes[] = 'lynx';
	} else if ($is_gecko) {
		$classes[] = 'gecko';
	} else if ($is_opera) {
		$classes[] = 'opera';
	} else if ($is_NS4) {
		$classes[] = 'ns4';
	} else if ($is_safari) {
		$classes[] = 'safari';
	} else if ($is_chrome) {
		$classes[] = 'chrome';
	} else if ($is_IE) {
		$classes[] = 'ie';
	} else {
		$classes[] = 'unknown';
	}
	
	if ($is_iphone) {
		$classes[] = 'iphone';
	}
	
	return $classes;
	
}

add_filter('body_class', 'gp_body_class');

/*
====================================================================================================
Browser Body Class
====================================================================================================
*/

function gp_body_class_toolbar($classes) {
	
	if (gp_option('gp_socials_header') != 'false' || function_exists('qtrans_generateLanguageSelectCode') || gp_option('gp_search') != 'false') {
		$classes[] = 'toolbar-active';
	}
	
	return $classes;
	
}

add_filter('body_class', 'gp_body_class_toolbar');

/*
====================================================================================================
Add Custom Favicon
====================================================================================================
*/

function gp_favicon() {
		
	if (gp_option('gp_image_favicon')) { 
	?>
	<link rel="shortcut icon" href="<?php echo gp_option('gp_image_favicon'); ?>"/>
	<?php } else { ?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
	<?php 
	}
	
}

add_action('wp_head', 'gp_favicon');

/*
====================================================================================================
Custom Excerpt
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Remove Excerpt Metabox from WordPress
----------------------------------------------------------------------------------------------------
*/

function gp_remove_excerpt_metabox() {

	remove_meta_box('postexcerpt', 'post', 'normal');

}

add_action('admin_menu', 'gp_remove_excerpt_metabox');

/*
----------------------------------------------------------------------------------------------------
Custom Excerpt
----------------------------------------------------------------------------------------------------
*/

function gp_excerpt($text) {
        global $post;
		
        if ($text == '') {
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace('\]\]\>', ']]&gt;', $text);
			$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
			$text = strip_tags($text, '<p>');
			$excerpt_length = 30;
			$words = explode(' ', $text, $excerpt_length + 1);
			if (count($words)> $excerpt_length) {
				array_pop($words);
				array_push($words, '...');
				$text = implode(' ', $words);
			}
        }
		
        return $text;
		
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'gp_excerpt');

/*
====================================================================================================
Set Max Content Width
====================================================================================================
*/

if (!isset($content_width)) {

	$content_width = 1200;

}

/*
====================================================================================================
Add Thumbnail Sizes
====================================================================================================
*/

// Thumbnails > Post Thumbnail Size
set_post_thumbnail_size(1000, '');

// Thumbnails > Default
add_image_size('small', 300, '', true);
add_image_size('medium', 600, '', true);
add_image_size('large', 1200, '', true);

// Thumbnails > Event
add_image_size('small-event', 300, 300, true);
add_image_size('medium-event', 600, '', true);
add_image_size('large-event', 1200, '', true);

// Thumbnails > Album
add_image_size('medium-album', 600, 600, true);
add_image_size('large-album', 1200, 1200, true);

/*
====================================================================================================
Add WP Login Logo
====================================================================================================
*/
	
function gp_custom_login_logo() {

	if (gp_option('gp_image_login_logo')) {
	?>

	<style type="text/css">
		#login h1 a {
			background-image: url("<?php echo gp_option('gp_image_login_logo'); ?>") !important;
			background-size: 274px 100px;
			height: 100px;
		}
	</style>
    
	<?php
	}
}

add_action('login_head', 'gp_custom_login_logo');

/*
====================================================================================================
Add to RSS
====================================================================================================
*/

/*
----------------------------------------------------------------------------------------------------
Add to RSS > Custom Post Types
----------------------------------------------------------------------------------------------------
*/

function gp_add_posttypes_to_rss($qv) {
		
	if (isset($qv['feed']) && !isset($qv['post_type']) ) {
		$qv['post_type'] = array('post', 'event');
	}
	return $qv;
	
}

add_filter('request', 'gp_add_posttypes_to_rss');

/*
----------------------------------------------------------------------------------------------------
Add to RSS > Thumbnails
----------------------------------------------------------------------------------------------------
*/

function gp_add_thumbnails_to_rss($content) {
	
	global $post;
	
	if (has_post_thumbnail($post->ID)) {
		$content = '' . $content;
	}
	
	return $content;
	
}

add_filter('the_excerpt_rss', 'gp_add_thumbnails_to_rss');
add_filter('the_content_feed', 'gp_add_thumbnails_to_rss');

/*
====================================================================================================
Comments List
====================================================================================================
*/

function gp_comments_list($comment, $args, $depth) {
   $globals['comment'] = $comment;
?>

	<div <?php comment_class(); ?>>
   
		<div id="comment-<?php comment_ID(); ?>">
     
     		<div class="comment-avatar float-left">
            	
                <?php echo get_avatar($comment, $size='40', $default='<path_to_url>'); ?>
                
            </div><!-- END // comment-avatar -->
            
            <div class="comment-body">
            
            	<div class="comment-meta clearfix">

                    <h5 class="float-left">
                        <?php echo get_comment_author_link(); ?>
                    </h5>
					
                    <div class="comment-date float-right">
                        <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s at %2$s', 'gp'), get_comment_date(), get_comment_time()); ?></a>
                        <?php edit_comment_link(__('[edit]', 'gp'),'',''); ?>
                    </div>

                </div><!-- END // comment-meta -->
                
				<?php if ($comment->comment_approved == '0') { ?>
                
                    <div class="alert notice"><?php _e('Your comment is awaiting moderation.', 'gp'); ?></div>
                
				<?php } ?>
                
                <div class="comment-content">
                	
					<div class="comment-text">
						<?php comment_text() ?>
                    </div><!-- END // comment-text -->
                    
                    <div class="comment-reply button">
						<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div><!-- END // comment-reply -->
                    
                </div><!-- END // comment-content -->
                
            </div><!-- END // comment-body -->
            
		</div><!-- END // comment -->

<?php
}

/*
====================================================================================================
Contact Form reCaptcha
====================================================================================================
*/

if (!class_exists('reCAPTCHA')) { // If is activated reCaptcha plugin // http://wordpress.org/extend/plugins/wp-recaptcha/

	require_once(TEMPLATEPATH . '/forms/lib_recaptcha.php');
	
}

/*
====================================================================================================
Init Backend (GPanel)
====================================================================================================
*/

require_once(trailingslashit(get_template_directory()) . 'backend/gpanel.php');

?>