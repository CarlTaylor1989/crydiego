<?php

/*

@name			Single Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/ 

// Sidebar
if (gp_option('gp_blog_sidebar') == 'left') {
	$sidebar = 'left';	
} else {
	$sidebar = 'right';
}

// Content & Grid Classes
if (is_active_sidebar('widget_area_blog')) {
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
				if (is_active_sidebar('widget_area_blog')) {
					get_sidebar('blog');
				}
			}
			?>
            
            <div class="content single-blog <?php echo $content_class; ?>" role="main">
    
                    <?php 
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
							if (has_post_thumbnail()) {
								$post_class = array('has-post-thumbnail', 'post', $post_format);
							} else {
								$post_class = array('post', $post_format);
							}
							?>
							
                            <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                            
                            	<?php
                                if (!get_post_format()) {
                                    get_template_part('content', 'standard');
                                } else {
                                    get_template_part('content', get_post_format());
                                }
								?>
								
							</article>
                            
							<?php wp_link_pages(); ?>
                            
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