<?php
/*

Template Name:	Full Width	

@name			Full Width Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/

get_header();
?>

	<div class="canvas">
		
        <?php get_template_part('title'); ?>
        
        <div class="grid">
        
			<div class="content" role="main">

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
            
        </div><!-- END // grid -->
        
	</div><!-- END // canvas -->

<?php
get_footer();
?>