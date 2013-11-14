<?php

/*

@name			Title Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/ 

?>

<header class="page-header">
    
    <h1>
		<?php
        if (is_home()) { 
            bloginfo('name');
        } else if (is_category()) {
            single_cat_title();
        } else if (is_single()) {
            single_post_title();
        } else if (is_page()) {
            single_post_title();
        } else {
            wp_title('', true);
        }
        ?>
    	
        <?php
		if (current_user_can('edit_post', $post->ID)) {
			edit_post_link(__('[edit]', 'gp'), '<span class="edit-post-link">', '</span>'); 
		}
		?>    
    </h1>
    
</header><!-- END // page-header -->