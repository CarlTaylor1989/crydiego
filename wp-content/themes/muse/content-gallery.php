<?php

/*

@name			Gallery Post Format Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Get Images
$images = gp_meta('gp_post_gallery', 'type=upload_plupload');

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

	<div class="post-meta-line one-entire inner-no-top-left">
    
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

    <div class="one-entire">
        
        <?php if ($images != NULL) { ?>

            <div class="grid-single-gallery grid-gallery grid-merge grid-tiles lightbox">
            
                <?php foreach ($images as $image) { ?>
                
                    <div class="tile">
        
                        <a data-gallery="gallery" class="post-image overlay" href="<?php echo $image['image_full_url']; ?>" title="<?php echo $image['image_title']; ?>">
                            <img src="<?php echo $image['image_url']; ?>" alt="<?php echo $image['image_alt']; ?>" />
                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                        </a>
                        
                    </div><!-- END // tile -->
        
                <?php } ?>
                
            </div><!-- END // grid-single-gallery -->
            
        <?php } ?>
        
		<?php if (!empty($post->post_content)) { ?>
            
            <div class="post-content inner-top">
                <?php the_content(); ?>
            </div><!-- END // post-content -->
        
        <?php } ?>
        
    </div><!-- END // one-entire -->
    
    <div class="post-meta">
        
		<?php if (has_tag()) { ?>
                
            <div class="post-tags">
                <h3><?php _e('Tags', 'gp'); ?></h3>
                <?php the_tags('', '', ''); ?>
            </div>
            
        <?php } ?>

        <?php if (function_exists('gp_share')) { gp_share(); } ?>

    </div><!-- END // post-meta -->

<?php
}
?>