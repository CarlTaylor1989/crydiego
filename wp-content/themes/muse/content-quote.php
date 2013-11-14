<?php

/*

@name			Quote Post Format Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// !Single
if (!is_single()) {
?>
    
    <div class="post-body clearfix<?php if (gp_option('gp_post_corner') != 'false') { ?> corner<?php } ?>">
    	
        <?php if (gp_option('gp_post_corner') != 'false') { ?>
            
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-corner">
            </a><!-- END // post-corner -->
        
        <?php } ?>
        
        <div class="inner">

            <div class="post-header clearfix">
                <blockquote>
                    <?php
                    if (gp_meta('gp_post_quote')) {
                        echo gp_meta('gp_post_quote');
                    } else {
                        the_content();
                    }
                    ?>
                </blockquote>
            </div><!-- END // post-header -->
                                            
            <div class="post-meta">
                <a class="underline-hover" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
            </div><!-- END // post-meta -->
            
            <?php if (function_exists('zilla_likes')) { ?>
                
                <div class="post-likes">
                    <?php zilla_likes(); ?>
                </div><!-- END // post-likes -->
                
            <?php } ?>
        
        </div>
    
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

        <?php if (gp_meta('gp_post_quote')) { ?>
        
            <div class="post-content inner-double-top inner-double-bottom">
                <blockquote>
					<?php
                    if (gp_meta('gp_post_quote')) {
                        echo gp_meta('gp_post_quote');
                    } else {
                        the_content();
                    }
                    ?>
                </blockquote>
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