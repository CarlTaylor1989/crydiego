<?php

/*

Template Name:	Galleries

@name			Gallery Template
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
            	<div class="grid-gallery grid-merge <?php echo $grid_class; ?>">

					<?php
					// Query
                    $gp_query_args = array(
						'post_type'			=> 'gallery',
						'posts_per_page'	=> -1
					);
					$gp_query = NULL;
                    $gp_query = new WP_Query($gp_query_args);
					
					// Loop
                    if ($gp_query->have_posts()) {
                        while ($gp_query->have_posts()) {
                            $gp_query->the_post();

							$block_class = array('tile', 'post', 'align-center');
                    ?>
                            
                            <article <?php post_class($block_class); ?>>
                                
								<?php if (has_post_thumbnail()) { ?>
    
                                    <div class="post-image overlay">
                                        
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                            <?php the_post_thumbnail('medium'); ?>
                                            <span class="overlay-block"><span class="overlay-icon"></span></span>
                                        </a>
                                        
                                    </div><!-- END // post-image -->
                                
                                <?php } ?>

                                <div class="tile-block inner">

                                    <h2 class="post-header">
                                        <a class="underline-hover" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2><!-- END // post-header -->
                                    
                                    <div class="post-meta">

										<?php the_time(); ?>
                                    
                                    </div><!-- END // post-meta -->
                                    
                                    <?php if (function_exists('zilla_likes')) { ?>
                                        <div class="post-likes">
                                            <?php zilla_likes(); ?>
                                        </div>
                                    <?php } ?>
                                    
								</div><!-- END // tile-block -->

                            </article><!-- END // tile -->

                    <?php 
                        } //while
                    } else {
                    ?>

                        <p>
                            <?php _e('No galleries were found.', 'gp'); ?>
                        </p>

                    <?php 
                    } //if
                    wp_reset_query();
                    ?>

                </div><!-- END // grid classes -->
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
