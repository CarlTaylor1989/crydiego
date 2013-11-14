<?php

/*

@name			Single Video Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Sidebar
if (gp_option('gp_video_sidebar') == 'left') {
	$sidebar = 'left';	
} else {
	$sidebar = 'right';
}

// Content & Grid Classes
if (is_active_sidebar('widget_area_video')) {
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
				if (is_active_sidebar('widget_area_video')) {
					get_sidebar('video');
				}
			}
			?>
            
            <div class="content <?php echo $content_class; ?>" role="main">
            
            	<div class="single-video">
            
                    <div class="post-meta-line inner-no-top-left clearfix">
    
                        <ul>
                            <li class="post-date">
                                <?php the_time(); ?>
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
                    
                    <div class="grid clearfix">
                    
						<?php 
                        if (have_posts()) { 
                            while (have_posts()) {
                                the_post();
                                
                                $block_class				= 'post post-video';
                                
                                $video_youtube_code			= __(gp_meta('gp_video_youtube_code'));
                                $video_vimeo_code			= __(gp_meta('gp_video_vimeo_code'));
                                ?>
                                
                                <div class="col-1 one-half">
                                
                                    <div class="<?php echo $block_class; ?>">
        
                                        <?php if (!empty($video_youtube_code)) { ?>
                                    
                                            <div class="post-video">
                                            
                                                <iframe src="http://www.youtube.com/embed/<?php echo $video_youtube_code; ?>?wmode=opaque&amp;autoplay=0&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                            
                                            </div><!-- END // post-video -->
                                            
                                        <?php } else if (!empty($video_vimeo_code)) { ?>
                                        
                                            <div class="post-video">
                                            
                                                <iframe src="http://player.vimeo.com/video/<?php echo $video_vimeo_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                            
                                            </div><!-- END // post-video -->
                                            
                                        <?php } ?>
        
                                    </div><!-- END // tile -->
                                
                                </div><!-- END // one-half -->
                                
                                <div class="col-2 one-half">
                                
                                	<div class="post-content clearfix">
                                    
                                    	<?php the_content(); ?>
                                    
                                    </div><!-- END // post-content -->
                                    
                                    <?php if (function_exists('gp_share')) { gp_share(); } ?>
                                    
                                </div><!-- END // one-half -->
                                
                                <?php
                            } //while
                        } //if
                        wp_reset_query();
                        ?>
                        
					</div><!-- END // grid -->
                
                </div><!-- END // single-gallery -->
                
                <?php
				if (comments_open()) {
					
					comments_template();
					
				} 
				?>
                
			</div><!-- END // content -->
            
            <?php
			if ($sidebar == 'right') {
				if (is_active_sidebar('widget_area_video')) {
					get_sidebar('video');
				}
			}
			?>

        </div><!-- END // grid -->
        
	</div><!-- END // canvas -->

<?php
get_footer();
?>