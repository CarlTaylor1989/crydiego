<?php

/*

@name			404 Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/ 

get_header();
?>

	<div class="canvas">
		
        <header class="page-header">
    
            <h1>
                <?php _e('Page not Found', 'gp'); ?>
            </h1>
            
        </header><!-- END // page-header -->

		<div class="content" role="main">
                            
			<?php 
			$blog_title		= get_bloginfo('name'); 
			$blog_url		= home_url();
            ?>
            
            <h2><?php _e('Muse shared on W P L O C K E R . C O M - Sorry, this page was not found.', 'gp'); ?></h2>
            
            <p><?php printf(__('You can try to return to the <a title="%1$s homepage" href="%2$s">%1$s homepage</a> and start fresh.', 'gp'), $blog_title, $blog_url); ?></p>
                    
		</div><!-- END // content -->
        
	</div><!-- END // canvas -->

<?php
get_footer();
?>