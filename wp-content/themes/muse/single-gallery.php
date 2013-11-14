<?php

/*

@name			Single Gallery Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Sidebar
if (gp_option('gp_gallery_sidebar') == 'left') {
	$sidebar = 'left';	
} else {
	$sidebar = 'right';
}

// Content & Grid Classes
if (is_active_sidebar('widget_area_gallery')) {
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
} else {
	$content_class	= 'one-entire';
	$grid_class		= 'grid-tiles';
}

// Get Images
$images = gp_meta('gp_gallery_images', 'type=upload_plupload');

get_header();
?>

	<div class="canvas">
		
        <?php get_template_part('title'); ?>
        		
		<div class="grid">
        
        	<?php
			if ($sidebar == 'left') {
				if (is_active_sidebar('widget_area_gallery')) {
					get_sidebar('gallery');
				}
			}
			?>
            
            <div class="content <?php echo $content_class; ?>" role="main">
            
            	<div class="single-gallery">
            
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
                
                    <div class="grid-single-gallery grid grid-merge lightbox clearfix <?php echo $grid_class; ?>">
                                
                        <?php 
                        if (have_posts()) { 
                            while (have_posts()) {
                                the_post();
                                
                                $block_class = 'tile post-image overlay';
                        		?>
                                
                                <?php
                                foreach ($images as $image) {
                                ?>
                                
                                    <div class="<?php echo $block_class; ?>">
    
                                        <a data-gallery="gallery" href="<?php echo $image['image_full_url']; ?>" title="<?php echo $image['image_title']; ?>">
                                            <img src="<?php echo $image['image_url']; ?>" alt="<?php echo $image['image_alt']; ?>" />
                                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                                        </a>
    
                                    </div><!-- END // tile -->
                                        
                                <?php
                                } //foreach
                                ?>
                                
                        		<?php
                            } //while
                        } //if
                        wp_reset_query();
                        ?>
                        
                    </div><!-- END // grid classes -->
                
					<?php 
                    if (have_posts()) { 
                        while (have_posts()) {
                            the_post();
                    		?>
    
                            <div class="post-content clearfix">
                                
                                <?php the_content(); ?>
                                
                            </div><!-- END // post-content -->
                            
                            <?php if (function_exists('gp_share')) { gp_share(); } ?>
                            
                    		<?php
                        } //while
                    } //if
                    wp_reset_query();
                    ?>
                
                </div><!-- END // single-gallery -->
                
                <?php
				if (comments_open()) {
					
					comments_template();
					
				} 
				?>
                
			</div><!-- END // content -->
            
            <?php
			if ($sidebar == 'right') {
				if (is_active_sidebar('widget_area_gallery')) {
					get_sidebar('gallery');
				}
			}
			?>

        </div><!-- END // grid -->
        
	</div><!-- END // canvas -->

<?php
get_footer();
?>