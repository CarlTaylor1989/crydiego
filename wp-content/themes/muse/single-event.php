<?php

/*

@name			Single Event Template
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

// Content Class
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
            
            <div class="content single-event <?php echo $content_class; ?>" role="main">
                            
				<?php 
                if (have_posts()) { 
                    while (have_posts()) {
                        the_post();
						
						$event_time					= __(gp_meta('gp_event_time'));
						$event_venue				= __(gp_meta('gp_event_venue'));
						$event_venue_url			= __(gp_meta('gp_event_location_url'));
						$event_location				= __(gp_meta('gp_event_location'));
						$event_contact				= __(gp_meta('gp_event_contact'));
						$event_price				= __(gp_meta('gp_event_price'));
						$event_status				= __(gp_meta('gp_event_status'));
						$event_buy_text_1			= __(gp_meta('gp_event_buy_text_1'));
						$event_buy_url_1			= __(gp_meta('gp_event_buy_url_1'));
						$event_buy_text_2			= __(gp_meta('gp_event_buy_text_2'));
						$event_buy_url_2			= __(gp_meta('gp_event_buy_url_2'));
						$event_facebook_text		= __(gp_meta('gp_event_facebook_text'));
						$event_facebook_url			= __(gp_meta('gp_event_facebook_url'));
						$event_google_map_url		= __(gp_meta('gp_event_googlemap_url'));
						$event_youtube_code			= __(gp_meta('gp_event_youtube_code'));
						$event_vimeo_code			= __(gp_meta('gp_event_vimeo_code'));
						
						$original_image_url 		= wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
						
						$post_class = array('clearfix');
                ?>
                
                        <article <?php post_class($post_class); ?>>

							<?php if (has_post_thumbnail() || !empty($event_youtube_code) || !empty($event_vimeo_code)) { ?>
                            
                                <div class="col-1 one-half float-right-important">
                                
                            <?php } else { ?>
                            
                                <div class="col-1 one-entire">
                            
                            <?php } ?>
                                
                                <?php if (has_post_thumbnail()) { ?>
                                
                                    <div class="post-image lightbox overlay">
                                        <a href="<?php echo $original_image_url[0]; ?>">
                                            <?php the_post_thumbnail('large'); ?>
                                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                                        </a>
                                    </div><!-- END // post-image -->
                                    
                                <?php } ?>
                                
                                <?php if (!empty($event_youtube_code)) { ?>
                                
                                    <div class="post-video">
                                    
                                        <iframe src="http://www.youtube.com/embed/<?php echo $event_youtube_code; ?>?wmode=opaque&amp;autoplay=0&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                    
                                    </div><!-- END // post-video -->
                                    
                                <?php } else if (!empty($event_vimeo_code)) { ?>
                                
                                    <div class="post-video">
                                    
                                        <iframe src="http://player.vimeo.com/video/<?php echo $event_vimeo_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                    
                                    </div><!-- END // post-video -->
                                    
                                <?php } ?>
                                
                            </div><!-- END // one-half | one-entire -->
                            
                            <?php if (has_post_thumbnail() || !empty($event_youtube_code) || !empty($event_vimeo_code)) { ?>
    
                                <div class="col-2 one-half float-left-important margin-right">
                            
                            <?php } else { ?>
                            
                                <div class="col-2 one-entire">
                            
                            <?php } ?>
                            
                            	<?php if (!empty($event_google_map_url)) { ?>
                                
                                    <div class="post-map">
                                    
                                        <iframe height="400" src="<?php echo str_replace("&", "&amp;", $event_google_map_url); ?>&amp;output=embed" ></iframe>
                                    
                                    </div><!-- END // post-map -->
                                
                                <?php } ?>
                            
                            	<div class="post-meta-line one-entire inner-no-top-left clearfix">

                                    <ul>
                                        <li>
                                            <h2 class="post-date"><?php get_template_part('date', 'event'); ?></h2>
                                        </li>
                                        <?php if (comments_open()) { ?>
                                            <li class="post-comments underline">
                                                <a href="<?php comments_link(); ?>">
                                                    <?php comments_number(__('No comments', 'gp'), __('1 comment', 'gp'), __('% comments', 'gp')); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if (function_exists('zilla_likes')) { ?>
                                            <li class="post-likes">
                                                <?php zilla_likes(); ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                        
                                </div><!-- END // post-meta-line -->
                            
                                <div class="post-meta clearfix">
                                    
                                    <div class="post-meta-table underline">
                                        
                                        <?php if (!empty($event_time)) { ?>
                                            
                                            <div class="post-time row clearfix">
                                            
                                                <div class="cell head"><div class="inner"><?php _e('Time', 'gp'); ?></div></div>
                                                <div class="cell"><div class="inner"><?php echo $event_time; ?></div></div>
                                            
                                            </div><!-- END // post-time -->
                                            
                                        <?php } ?>
                                        
                                        <?php
                                        if (!empty($event_venue)) {
                                            if (!empty($event_venue_url)) {
                                        ?>
                                        
                                                <div class="post-venue row clearfix">
                                            
                                                    <div class="cell head"><div class="inner"><?php _e('Venue', 'gp'); ?></div></div>
                                                    <div class="cell">
                                                        <div class="inner">
                                                            <a class="underline" href="<?php echo $event_venue_url; ?>" title="<?php echo $event_venue; ?>" target="_blank">
                                                                <?php echo $event_venue; ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                
                                                </div><!-- END // post-venue -->
                                                
                                            <?php
                                            } else {
                                            ?>
                                                
                                                <div class="post-venue row clearfix">
                                            
                                                    <div class="cell head"><div class="inner"><?php _e('Venue', 'gp'); ?></div></div>
                                                    <div class="cell"><div class="inner"><?php echo $event_venue; ?></div></div>
                                                
                                                </div><!-- END // post-venue -->
                                                
                                        <?php
                                            }
                                        }
                                        ?>
                                        
                                        <?php if (!empty($event_location)) { ?>
                                            
                                            <div class="post-location row clearfix">
                                            
                                                <div class="cell head"><div class="inner"><?php _e('Location', 'gp'); ?></div></div>
                                                <div class="cell"><div class="inner"><?php echo $event_location; ?></div></div>
                                            
                                            </div><!-- END // post-location -->
                                            
                                        <?php } ?>
                                        
                                        <?php if (!empty($event_contact)) { ?>
                                            
                                            <div class="post-contact row clearfix">
                                            
                                                <div class="cell head"><div class="inner"><?php _e('Contact', 'gp'); ?></div></div>
                                                <div class="cell"><div class="inner"><?php echo $event_contact; ?></div></div>
                                            
                                            </div><!-- END // post-contact -->
                                            
                                        <?php } ?>
                                        
                                        <?php if (!empty($event_status)) { ?>
                                        
                                            <div class="post-status row clearfix">
                                            
                                                <div class="cell head"><div class="inner"><?php _e('Status', 'gp'); ?></div></div>
                                                <div class="cell"><div class="inner"><?php echo $event_status; ?></div></div>
                                            
                                            </div><!-- END // post-status -->
                                            
                                        <?php } ?>
                                        
                                        <?php if (!empty($event_price)) { ?>
                                        
                                            <div class="post-price row clearfix">
                                            
                                                <div class="cell head"><div class="inner"><?php _e('Price', 'gp'); ?></div></div>
                                                <div class="cell"><div class="inner"><?php echo $event_price; ?></div></div>
                                            
                                            </div><!-- END // post-price -->
                                            
                                        <?php } ?>
                                        
                                    </div><!-- END // post-meta-table -->
                                    
                                    <?php if (!empty($event_facebook_text) && !empty($event_facebook_url)) { ?>
                                        
                                        <div class="post-facebook button">
                                            <a href="<?php echo $event_facebook_url; ?>" title="<?php echo $event_facebook_text; ?>" target="_blank">
                                                <?php echo $event_facebook_text; ?>
                                            </a>
                                        </div>
                                    
                                    <?php } ?>
                                    
                                    <?php if (!empty($event_buy_text_1) && !empty($event_buy_url_1)) { ?>
                                        
                                        <div class="button float-left">
                                            <a href="<?php echo $event_buy_url_1; ?>" title="<?php echo $event_buy_text_1; ?>" target="_blank">
                                                <?php echo $event_buy_text_1; ?>
                                            </a>
                                        </div>
                                        
                                    <?php } ?>
                                    
                                    <?php if (!empty($event_buy_text_2) && !empty($event_buy_url_2)) { ?>
                                        
                                        <div class="button float-left">
                                            <a href="<?php echo $event_buy_url_2; ?>" title="<?php echo $event_buy_text_2; ?>" target="_blank">
                                                <?php echo $event_buy_text_2; ?>
                                            </a>
                                        </div>
                                        
                                    <?php } ?>
                                    
                                </div><!-- END // post-meta -->
                                
                                <div class="post-content clearfix">
                                
                                    <?php the_content(); ?>
                                    
                                </div><!-- END // post-content -->

								<?php if (function_exists('gp_share')) { gp_share(); } ?>

                            </div><!-- END // one-half | one-entire -->
                            
                        </article><!-- END // post -->
                
                <?php
                    } //while
                } //if
				wp_reset_query();
                ?>
                
                <?php
				if (comments_open()) {
					
					comments_template();
					
				} 
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