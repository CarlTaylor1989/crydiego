<?php

/*

@name			Blog Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Sidebar
if (gp_option('gp_blog_sidebar') == 'left') {
	$sidebar		= 'left';	
} else {
	$sidebar		= 'right';
}

// Content & Grid Classes
if (is_active_sidebar('widget_area_blog')) {
	$content_class	= 'content-sidebar content-sidebar-' . $sidebar;
	$grid_class		= 'grid-tiles-sidebar';
} else {
	$content_class	= 'one-entire';
	$grid_class		= 'grid-tiles';
}

get_header();
?>

	<div class="canvas">
		
        <header class="page-header">
        
            <?php $page = get_post(get_option('page_for_posts')); ?>
			<h1>
				<?php echo $page->post_title; ?>
            </h1>
            
        </header><!-- page-header -->
        
        <div class="grid">
        
        	<?php
			if ($sidebar == 'left') {
				if (is_active_sidebar('widget_area_blog')) {
					get_sidebar('blog');
				}
			}
			?>
        
			<div class="content <?php echo $content_class; ?>" role="main">
            	<div class="grid-blog grid-merge <?php echo $grid_class; ?>">

					<?php
					// Counter
					$post_count = 1;
					
					// Loop
                    if (have_posts()) { 
                        while (have_posts()) { 
                            the_post();
							
							// Post Format Class
							if (!get_post_format()) {
								$post_format = 'format-standard';
							} else {
								$post_format = 'format-' . get_post_format();
							}
							
							// Post Class
							if (has_post_thumbnail() && $post_count == 1 && ($paged == '' || $paged < 2)) {
								$post_class = array('tile', 'has-post-thumbnail', 'post-featured', 'width-double', $post_format);
							} else if (has_post_thumbnail()) {
								$post_class = array('tile', 'has-post-thumbnail', 'post', $post_format);
							} else if ($post_count == 1 && ($paged == '' || $paged < 2)) {
								$post_class = array('tile', 'post-featured', 'width-double', $post_format);
							} else {
								$post_class = array('tile', 'post', $post_format);
							}
                    ?>
                    	
                            <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                            
                            	<div class="tile-block">
                                
                                	<?php
                                    if (has_post_thumbnail() && $post_format != 'format-audio') {
									?>
                                    
                                    	<div class="post-image-container">
    
                                            <div class="post-image overlay">
                                                
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                                    <?php the_post_thumbnail('medium'); ?>
                                                    <span class="overlay-block"><span class="overlay-icon"></span></span>
                                                </a>
                                                
                                            </div><!-- END // post-image -->
                                        
                                        </div>
                                    
                                    <?php
                                    }
									
                                    if (!get_post_format()) {
                                        get_template_part('content', 'standard');
                                    } else {
                                        get_template_part('content', get_post_format());
                                    }
                                    ?>

                                </div><!-- END // tile-block -->
                            
                            </article><!-- END // tile -->
                            
                    <?php
						$post_count++;
                        } //while
					} //if
					wp_reset_query();
                    ?>

				</div><!-- END // grid classes -->
            	
                <?php if (function_exists('gp_pagination')) { gp_pagination(); } ?>
            
            </div><!-- END // content -->
            
            <?php
			if ($sidebar == 'right') {
				if (is_active_sidebar('widget_area_blog')) {
					get_sidebar('blog');
				}
			}
			?>
            
        </div><!-- END // grid -->
        
	</div><!-- END // canvas -->

<?php
get_footer();
?>
