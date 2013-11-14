<?php

/*

Template Name:	Events List

@name			Events List Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Sidebar
if (gp_option('gp_event_sidebar') == 'left') {
	$sidebar		= 'left';	
} else {
	$sidebar		= 'right';
}

// Content & Grid Classes
if (is_active_sidebar('widget_area_event')) {
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
} else {
	$content_class	= 'one-entire';
}

get_header();
?>

	<div class="canvas">
		
        <?php get_template_part('title'); ?>
        
        <div class="grid">

			<?php
            if ($sidebar == 'left') {
                if (is_active_sidebar('widget_area_event')) {
                    get_sidebar('event');
                }
            }
            ?>
            
            <div class="content <?php echo $content_class; ?>" role="main">
                <div class="list-event list-event-upcoming clearfix">
    
                    <?php
                    $post_count = 1;
                    
                    // Query
                    $gp_query_args = array(
                        'post_type'			=> 'event',
                        'meta_key'			=> 'gp_event_date',
                        'meta_value'		=> date('Y/m/d'),
                        'meta_compare'		=> '>=',
                        'orderby'			=> 'meta_value',
                        'order'				=> 'ASC',
                        'posts_per_page'	=> -1
                    );
                    $gp_query = NULL;
                    $gp_query = new WP_Query($gp_query_args);
    
                    // Loop
                    if ($gp_query->have_posts()) {
                        while ($gp_query->have_posts()) {
                            $gp_query->the_post();
    
                            $event_time					= __(gp_meta('gp_event_time'));
                            $event_venue				= __(gp_meta('gp_event_venue'));
                            $event_venue_url			= __(gp_meta('gp_event_location_url'));
                            $event_location				= __(gp_meta('gp_event_location'));
                            $event_status				= __(gp_meta('gp_event_status'));
                            $event_buy_text_1			= __(gp_meta('gp_event_buy_text_1'));
                            $event_buy_url_1			= __(gp_meta('gp_event_buy_url_1'));
                            $event_buy_text_2			= __(gp_meta('gp_event_buy_text_2'));
                            $event_buy_url_2			= __(gp_meta('gp_event_buy_url_2'));
							
							$original_image_url 		= wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                            
                            // Has Info
                            if (!empty($event_venue) || !empty($event_location)) {
                                $event_info_class = 'has-info';
                            } else {
                                $event_info_class = 'no-info';
                            }
							
							// Has Status
                            if (!empty($event_status)) {
                                $event_status_class = 'has-status';
                            } else {
                                $event_status_class = 'no-status';
                            }
                            
                            // Has Action
                            if (!empty($event_buy_text_1) && !empty($event_buy_url_1) || !empty($event_buy_text_2) && !empty($event_buy_url_2)) {
                                $event_action_class = 'has-action';
                            } else {
                                $event_action_class = 'no-action';
                            }
                            
							// Block Class
                            if (has_post_thumbnail()) {
                                $block_class = array('event-upcoming', 'has-post-thumbnail', 'post', 'one-entire', $event_info_class, $event_status_class, $event_action_class, 'clearfix');
                            } else {
                                $block_class = array('event-upcoming', 'post', 'one-entire', $event_info_class, $event_status_class, $event_action_class, 'clearfix');
                            }
                            
                    ?>
                            
                            <article id="post-<?php the_ID(); ?>" <?php post_class($block_class); ?>>
                            
                                <div class="post-header">
                                    
                                    <?php
                                    if (gp_option('gp_event_thumbnail') != 'false') {
                                        if (has_post_thumbnail()) { 
                                        ?>
                                
                                            <div class="post-image overlay">
                                            
                                            	<?php if (gp_option('gp_event_single') != 'false') { ?>
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                        <?php the_post_thumbnail('small-event'); ?>
                                                    	<span class="overlay-block"><span class="overlay-icon"></span></span>
                                                    </a>
                                                <?php } else if (gp_option('gp_event_single') == 'false' || gp_option('gp_event_single') == '' && has_post_thumbnail()) { ?>
                                                    <span class="lightbox">
                                                        <a href="<?php echo $original_image_url[0]; ?>" title="<?php the_title_attribute(); ?>">
                                                            <?php the_post_thumbnail('small-event'); ?>
                                                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                        </a>
                                                    </span>
                                                <?php } else { ?>
                                                    <?php the_post_thumbnail('small-event'); ?>
                                                    <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                <?php } ?>

                                            </div><!-- END // tile-block post-image -->
                                    
                                    <?php
                                        }
                                    } 
                                    ?>
                                        
                                    <div class="inner">
    
                                        <h5 class="post-date">
                                            <?php get_template_part('date', 'event'); ?>
                                            <?php if (!empty($event_time)) { ?>
                                                <small class="post-time">
                                                    <?php echo $event_time; ?>                             
                                                </small><!-- END // post-time -->
                                            <?php } ?>
                                        </h5><!-- END // post-date -->
                                        
                                        <h2 class="post-title">
											<?php if (gp_option('gp_event_single') != 'false') { ?>
                                                <a class="underline-hover" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            <?php } else if (gp_option('gp_event_single') == 'false' || gp_option('gp_event_single') == '' && has_post_thumbnail()) { ?>
                                                <span class="lightbox">
                                                    <a class="underline-hover" href="<?php echo $original_image_url[0]; ?>" title="<?php the_title_attribute(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </span>
                                            <?php } else { ?>
                                                <?php the_title(); ?>
                                            <?php } ?>
                                        </h2><!-- END // post-title -->
                                    
                                    </div><!-- END // inner -->
                                
                                </div><!-- END // post-header -->
                                
                                <?php if (!empty($event_venue) || !empty($event_location)) { ?>
                                
                                    <div class="post-info align-center">
                                    
                                        <div class="inner">
                                        
                                            <?php
                                            if (!empty($event_venue)) {
                                                if (!empty($event_venue_url)) {
                                            ?>
                                            
                                                <div class="post-venue">
                                                    <a class="underline" href="<?php echo $event_venue_url; ?>" title="<?php echo $event_venue; ?>" target="_blank">
                                                        <?php echo $event_venue; ?>
                                                    </a>
                                                </div><!-- END // post-venue -->
                                                
                                                <?php
                                                } else {
                                                ?>
                                                
                                                <div class="post-venue">
                                                    <?php echo $event_venue; ?>
                                                </div><!-- END // post-venue -->
                                                
                                            <?php
                                                }
                                            }
                                            ?>
                                            
                                            <?php if (!empty($event_location)) { ?>
            
                                                <div class="post-location">
                                                    <?php echo $event_location; ?>
                                                </div><!-- END // post-location -->
            
                                            <?php } ?>
                                        
                                        </div><!-- END // inner -->
                                        
                                    </div><!-- END // post-info -->
                                
                                <?php } ?>
                                
                                <?php if (!empty($event_status)) { ?>
                                
                                    <div class="post-status align-center">
                                    
                                        <div class="inner">
                                        
                                            <p class="no-bottom"><?php echo $event_status; ?></p>
                                        
                                        </div><!-- END // inner -->
                                        
                                    </div><!-- END // post-status -->
                                    
                                <?php } ?>
                                
                                <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1) || !empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>
                                
                                    <div class="post-action align-center">
                                    
                                        <div class="inner">
                                    
                                            <?php
                                            if (!empty($event_buy_text_1) && !empty($event_buy_url_1)) { 
                                            ?>
                                                
                                                <div class="post-buy button float-left">
                                                    <a href="<?php echo $event_buy_url_1; ?>" title="<?php echo $event_buy_text_1; ?>" target="_blank">
                                                        <?php echo $event_buy_text_1; ?>
                                                    </a>
                                                </div><!-- END // post-buy -->
                                                
                                            <?php
                                            }
                                            ?>
                                            
                                            <?php
                                            if (!empty($event_buy_text_2) && !empty($event_buy_url_2)) { 
                                            ?>
                                                
                                                <div class="post-buy button float-left">
                                                    <a href="<?php echo $event_buy_url_2; ?>" title="<?php echo $event_buy_text_2; ?>" target="_blank">
                                                        <?php echo $event_buy_text_2; ?>
                                                    </a>
                                                </div><!-- END // post-buy -->
                                                
                                            <?php
                                            }
                                            ?>
    
                                        </div><!-- END // inner -->
                                            
                                    </div><!-- END // post-action -->
                                
                                <?php } ?>
                                    
                            </article><!-- END // post -->
    
                    <?php
                        $post_count++;
                        } //while
                    } else {
                    ?>
    
                        <p>
                            <?php _e('No upcoming events were found.', 'gp'); ?>
                        </p>
    
                    <?php 
                    } //if
                    wp_reset_query();
                    ?>
                    
                </div><!-- END // list-event-upcoming -->
                
                <?php if (gp_option('gp_event_past_events') != 'false') { ?>
                
                    <h2><?php _e('Past Events', 'gp'); ?></h2>
                
                    <div class="list-event list-event-past clearfix">
                    
                        <?php
                        // Query						
                        $gp_query_args = array(
                            'post_type'			=> 'event',
                            'meta_key'			=> 'gp_event_date',
                            'meta_value'		=> date('Y/m/d'),
                            'meta_compare'		=> '<',
                            'orderby'			=> 'meta_value',
                            'order'				=> 'DESC',
                            'posts_per_page'	=> -1
                        );
                        $gp_query = NULL;
                        $gp_query = new WP_Query($gp_query_args);
                        
                        // Loop
                        if ($gp_query->have_posts()) {
                            while ($gp_query->have_posts()) {
                                $gp_query->the_post();
                                
                                $event_time					= __(gp_meta('gp_event_time'));
                                $event_venue				= __(gp_meta('gp_event_venue'));
                                $event_venue_url			= __(gp_meta('gp_event_location_url'));
                                $event_location				= __(gp_meta('gp_event_location'));
                                $event_status				= __(gp_meta('gp_event_status'));
								
								// Has Info
								if (!empty($event_venue) || !empty($event_location)) {
									$event_info_class = 'has-info';
								} else {
									$event_info_class = 'no-info';
								}
								
								// Block Class
								if (has_post_thumbnail()) {
									$block_class = array('event-upcoming', 'has-post-thumbnail', 'post', 'one-entire', $event_info_class, 'clearfix');
								} else {
									$block_class = array('event-upcoming', 'post', 'one-entire', $event_info_class, 'clearfix');
								}
                            
                    ?>
                            
                                <article id="post-<?php the_ID(); ?>" <?php post_class($block_class); ?>>
                            
                                <div class="post-header">
                                        
                                    <div class="inner">
    
                                        <h5 class="post-date">
                                            <?php get_template_part('date', 'event'); ?>
                                        </h5><!-- END // post-date -->
                                        
                                        <h2 class="post-title">
                                            <?php if (gp_option('gp_event_single') != 'false') { ?>
                                                <a class="underline-hover" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            <?php } else { ?>
                                                <?php the_title(); ?>
                                            <?php } ?>
                                        </h2><!-- END // post-title -->
                                    
                                    </div><!-- END // inner -->
                                
                                </div><!-- END // post-header -->
                                
                                <?php if (!empty($event_venue) || !empty($event_location)) { ?>
                                
                                    <div class="post-info align-center">
                                    
                                        <div class="inner">
                                        
                                            <?php
                                            if (!empty($event_venue)) {
                                                if (!empty($event_venue_url)) {
                                            ?>
                                            
                                                <div class="post-venue">
                                                    <a class="underline" href="<?php echo $event_venue_url; ?>" title="<?php echo $event_venue; ?>" target="_blank">
                                                        <?php echo $event_venue; ?>
                                                    </a>
                                                </div><!-- END // post-venue -->
                                                
                                                <?php
                                                } else {
                                                ?>
                                                
                                                <div class="post-venue">
                                                    <?php echo $event_venue; ?>
                                                </div><!-- END // post-venue -->
                                                
                                            <?php
                                                }
                                            }
                                            ?>
                                            
                                            <?php if (!empty($event_location)) { ?>
            
                                                <div class="post-location">
                                                    <?php echo $event_location; ?>
                                                </div><!-- END // post-location -->
            
                                            <?php } ?>
                                        
                                        </div><!-- END // inner -->
                                        
                                    </div><!-- END // post-info -->
                                
                                <?php } ?>
                                    
                            </article><!-- END // post -->
    
                        <?php
                            } //while
                        } else {
                        ?>
    
                            <p>
                                <?php _e('No past events were found.', 'gp'); ?>
                            </p>
    
                        <?php
                        } //if
                        wp_reset_query();
                        ?>
                    
                    </div><!-- END // list-event-past -->
                    
                <?php
                } //if
                ?>
                    
            </div><!-- END // content -->
        
			<?php
            if ($sidebar == 'right') {
                if (is_active_sidebar('widget_area_event')) {
                    get_sidebar('event');
                }
            }
            ?>
        
        </div><!-- END // grid -->
            
	</div><!-- END // canvas -->

<?php
get_footer();
?>