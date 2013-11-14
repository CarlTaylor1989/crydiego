<?php

/*

Template Name:	Albums

@name			Albums Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Sidebar
if (gp_option('gp_album_sidebar') == 'left') {
	$sidebar		= 'left';	
} else {
	$sidebar		= 'right';
}

// Content Class
if (is_active_sidebar('widget_area_album')) {
	$content_class = 'content-sidebar content-sidebar-' . $sidebar;
} else {
	$content_class = 'one-entire';	
}

get_header();
?>

	<div class="canvas">
		
        <?php get_template_part('title'); ?>
        		
		<div class="grid">
        
        	<?php
			if ($sidebar == 'left') {
				if (is_active_sidebar('widget_area_album')) {
					get_sidebar('album');
				}
			}
			?>
            
            <div class="content grid-album <?php echo $content_class; ?>" role="main">
            	<div class="grid-merge grid-tiles">

					<?php
                    // Counter
					$post_count = 1;
					
					// Query
                    $gp_query_args = array(
						'post_type'			=> 'album',
						'meta_key'			=> 'gp_album_release_date',
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
							
							$block_class 				= array('tile', 'post', 'align-center');
							$album_artist				= __(gp_meta('gp_album_artist'));
                    ?>
                            
                            <article <?php post_class($block_class); ?>>
                                
								<?php if (has_post_thumbnail()) { ?>
                                
                                	<div class="post-image overlay">
                                    
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('medium-album'); ?>
                                            <span class="vinyl-small"></span>
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
                                    
                                    <div class="post-artist">
                                    	
                                        <?php echo $album_artist; ?>
                                        
                                    </div>
                                    
                                    <div class="post-meta">

										<?php get_template_part('date', 'album'); ?>
                                    
                                    </div><!-- END // post-meta -->
                                    
								</div><!-- END // tile-block -->

                            </article><!-- END // tile -->

                    <?php 
                        } //while
                    } else {
                    ?>

                        <p>
                            <?php _e('No albums were found.', 'gp'); ?>
                        </p>

                    <?php 
                    } //if
                    wp_reset_query();
                    ?>
                    
                </div><!-- END // grid classes -->
            </div><!-- END // content -->
            
            <?php
			if ($sidebar == 'right') {
				if (is_active_sidebar('widget_area_album')) {
					get_sidebar('album');
				}
			}
			?>

        </div><!-- END // grid -->
        
	</div><!-- END // canvas -->

<?php
get_footer();
?>
