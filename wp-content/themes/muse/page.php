<?php

/*

@name			Page Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

// Sidebar
if (gp_option('gp_page_sidebar') == 'left') {
	$sidebar		= 'left';	
} else {
	$sidebar		= 'right';
}

// Content Class
if (is_active_sidebar('widget_area_page')) {
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
				if (is_active_sidebar('widget_area_page')) {
					get_sidebar();
				}
			}
			?>
        
			<div class="content <?php echo $content_class; ?>" role="main">

				<?php
                // Loop
                if (have_posts()) { 
                    while (have_posts()) { 
                        the_post();
                ?>
                    
                        <div class="content-page one-entire">
                        
                            <?php the_content(); ?>
                        
                        </div><!-- END // content-page -->
                        
                <?php
                    } //while
                } //if
                wp_reset_query();
                ?>

            </div><!-- END // content -->
            
            <?php
			if ($sidebar == 'right') {
				if (is_active_sidebar('widget_area_page')) {
					get_sidebar();
				}
			}
			?>
            
        </div><!-- END // grid -->
        
	</div><!-- END // canvas -->

<?php
get_footer();
?>