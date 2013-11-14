<?php

/*

@name			Audio Post Format Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Get Files
$files = gp_meta('gp_post_mp3', 'type=upload_plupload');

foreach ($files as $file) {
    $audio_url = $file['url'];
}

// Original Image
$original_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

// !Single
if (!is_single()) {
?>
	
	<?php if ($files != NULL) { ?>
    
        <div class="post-audio clearfix">
        	
            <div class="player-<?php the_ID(); ?>"></div>
                                        
            <div class="player">
    
                <div class="player-container-<?php the_ID(); ?> player-container">
    
                    <div class="player-progress">
                        <div class="player-seek-bar">
                            <div class="player-play-bar"></div>
                        </div>
                    </div><!-- END // player-progress -->
                    
                    <div class="player-controls">
    
                        <ul>
                            <li><a href="javascript:;" class="player-play" tabindex="1">Play</a></li>
                            <li><a href="javascript:;" class="player-pause" tabindex="1">Pause</a></li>
                            <li><a href="javascript:;" class="player-stop" tabindex="1">Stop</a></li>
                            <li><a href="javascript:;" class="player-mute" tabindex="1">Mute</a></li>
                            <li><a href="javascript:;" class="player-unmute" tabindex="1">Unmute</a></li>
                        </ul><!-- END // player-controls -->
                        
                        <div class="player-volume">
                            <div class="player-volume-container">
                                <div class="player-volume-value"></div>
                            </div>
                        </div><!-- END // player-colume -->
                        
                    </div><!-- END // player-bar -->
                    
                </div><!-- END // player-container -->
                    
            </div><!-- END // player -->
            
        </div><!-- END // post-audio -->
    
    <?php } ?>
    
    <?php if (has_post_thumbnail()) { ?>
                                    
        <div class="post-image-container">

            <div class="post-image overlay">
                
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                    <?php the_post_thumbnail('medium'); ?>
                    <span class="overlay-block"><span class="overlay-icon"></span></span>
                </a>
                
            </div><!-- END // post-image -->
        
        </div>
    
    <?php } ?>
    
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

	<?php if (has_post_thumbnail() || $files != NULL) { ?>
    
        <div class="one-half float-right-important">
        
    <?php } else { ?>
    
        <div class="one-entire">
    
    <?php } ?>
    
        <?php if ($files != NULL) { ?>
        
            <div class="post-audio clearfix">

                <div class="player-<?php the_ID(); ?>"></div>
                                            
                <div class="player">
        
                    <div class="player-container-<?php the_ID(); ?> player-container">
        
                        <div class="player-progress">
                            <div class="player-seek-bar">
                                <div class="player-play-bar"></div>
                            </div>
                        </div><!-- END // player-progress -->
                        
                        <div class="player-controls">
        
                            <ul>
                                <li><a href="javascript:;" class="player-play" tabindex="1">Play</a></li>
                                <li><a href="javascript:;" class="player-pause" tabindex="1">Pause</a></li>
                                <li><a href="javascript:;" class="player-stop" tabindex="1">Stop</a></li>
                                <li><a href="javascript:;" class="player-mute" tabindex="1">Mute</a></li>
                                <li><a href="javascript:;" class="player-unmute" tabindex="1">Unmute</a></li>
                            </ul><!-- END // player-controls -->
                            
                            <div class="player-volume">
                                <div class="player-volume-container">
                                    <div class="player-volume-value"></div>
                                </div>
                            </div><!-- END // player-colume -->
                            
                        </div><!-- END // player-bar -->
                        
                    </div><!-- END // player-container -->
                        
                </div><!-- END // player -->
                
            </div><!-- END // post-audio -->
        
        <?php } ?>
        
        <?php if (has_post_thumbnail()) { ?>
        
            <div class="post-image">
                
                <div class="post-image lightbox overlay">
                    <a href="<?php echo $original_image_url[0]; ?>">
                        <?php the_post_thumbnail('large'); ?>
                        <span class="overlay-block"><span class="overlay-icon"></span></span>
                    </a>
                </div><!-- END // post-image -->
                
            </div><!-- END // post-image -->
        
        <?php } ?>
        
            <div class="post-meta inner-double-no-right-left">
            
                <?php if (has_tag()) { ?>
                        
                    <div class="post-tags">
                        <h3><?php _e('Tags', 'gp'); ?></h3>
                        <?php the_tags('', '', ''); ?>
                    </div>
                    
                <?php } ?>
    
                <?php if (function_exists('gp_share')) { gp_share(); } ?>
    
            </div><!-- END // post-meta -->
        
        </div><!-- END // one-half | one-entire -->

    <?php if (has_post_thumbnail() || $files != NULL) { ?>
    
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
    
        </div><!-- END // one-half | one-entire -->

<?php
}
?>