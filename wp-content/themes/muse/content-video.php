<?php

/*

@name			Video Post Format Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Video Codes
$youtube_code	= gp_meta('gp_post_youtube_code');
$vimeo_code		= gp_meta('gp_post_vimeo_code');

// !Single
if (!is_single()) {
?>
    
    <div class="post-body clearfix<?php if (gp_option('gp_post_corner') != 'false') { ?> corner<?php } ?>">
    	
        <?php if (gp_option('gp_post_corner') != 'false') { ?>
            
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-corner">
            </a><!-- END // post-corner -->
        
        <?php } ?>

        <h2 class="post-header">
            <a class="underline-hover" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
            </a>
        </h2><!-- END // post-header -->
                                        
        <div class="post-meta">
            <?php the_time(); ?>
        </div><!-- END // post-meta -->
        
        <?php if (!empty($post->post_content)) { ?>
        
            <div class="post-excerpt">
                <?php the_excerpt(); ?>
            </div><!-- END // post-excerpt -->
        
        <?php } ?>

        <div class="post-more">
            <a class="underline-hover" href="<?php the_permalink(); ?>" title="<?php _e('Read more ...', 'gp'); ?> <?php the_title(); ?>">
                <?php _e('Read more ...', 'gp'); ?>
            </a>
        </div><!-- END // post-more -->

        <?php if (function_exists('zilla_likes')) { ?>
            
            <div class="post-likes">
                <?php zilla_likes(); ?>
            </div><!-- END // post-likes -->
            
        <?php } ?>
    
    </div><!-- END // post-body -->
    
<?php
// Single
} else if (is_single()) {
?>

	<?php if (!empty($youtube_code) || !empty($vimeo_code)) { ?>
    
        <div class="one-half float-right-important">
        
    <?php } else { ?>
    
        <div class="one-entire">
    
    <?php } ?>
    
			<?php if (!empty($youtube_code)) { ?>
                                    
                <div class="post-video">
                
                    <iframe src="http://www.youtube.com/embed/<?php echo $youtube_code; ?>?wmode=opaque&amp;autoplay=0&amp;enablejsapi=1&modestbranding=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;theme=dark" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                
                </div><!-- END // post-video -->
                
            <?php } else if (!empty($vimeo_code)) { ?>
            
                <div class="post-video">
                
                    <iframe src="http://player.vimeo.com/video/<?php echo $vimeo_code; ?>?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                
                </div><!-- END // post-video -->
                
            <?php } ?>
        
        </div><!-- END // one-half | one-entire -->

    <?php if (!empty($youtube_code) || !empty($vimeo_code)) { ?>
    
        <div class="one-half float-left-important margin-right">
        
    <?php } else { ?>
    
        <div class="one-entire">
    
    <?php } ?>
    
            <div class="post-meta-line inner-no-top-left clearfix">
            
                <?php the_category(); ?>
                
                <ul>
                    <li class="post-author underline">
                        <?php _e('by ', 'gp'); ?><?php the_author_posts_link(); ?>
                    </li>
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

			<?php if (!empty($post->post_content)) { ?>
                
                <div class="post-content inner-top clearfix">
                
                    <?php the_content(); ?>
                    
                </div><!-- END // post-content -->
            
            <?php } ?>
        
        	<div class="post-meta">
            
                <?php if (has_tag()) { ?>
                        
                    <div class="post-tags">
                        <h3><?php _e('Tags', 'gp'); ?></h3>
                        <?php the_tags('', '', ''); ?>
                    </div>
                    
                <?php } ?>
    
                <?php if (function_exists('gp_share')) { gp_share(); } ?>
    
            </div><!-- END // post-meta -->
    
        </div><!-- END // one-half | one-entire -->

<?php
}
?>