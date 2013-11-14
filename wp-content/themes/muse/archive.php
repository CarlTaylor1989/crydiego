<?php

/*

@name			Archive Template
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
        
        	<?php
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			?>
            <?php
				// Category Archive
				if (is_category()) {
				?>
                
            		<h1><?php printf(__('All posts in %s', 'gp'), single_cat_title('', false)); ?></h1>
                
				<?php
                // Tag Archive
                } else if (is_tag()) {
				?>
            
            		<h1><?php printf(__('All posts tagged %s', 'gp'), single_tag_title('', false)); ?></h1>
                
                <?php
                // Author Archive
                } else if (is_author()) {
				?>
            
            		<h1><?php printf(__('All posts by %s', 'gp'), $curauth->nickname); ?></h1>
                
				<?php
                // Day Archive
                } else if (is_day()) {
                ?>
            
            		<h1><?php _e('Archive for', 'gp'); ?> <?php the_time(__('F jS, Y', 'gp')); ?></h1>
            
				<?php
                // Month Archive
                } else if (is_month()) {
                ?>
            	
                	<h1><?php _e('Archive for', 'gp'); ?> <?php the_time(__('F, Y', 'gp')); ?></h1>
            
				<?php
                // Year Archive
                } else if (is_year()) {
                ?>
            
            		<h1><?php _e('Archive for', 'gp'); ?> <?php the_time(__('Y', 'gp')); ?></h1>
            
				<?php
                // Post Format Archive
                } else if (get_post_format()) {
                ?>
            
            		<h1><?php printf(__('Archive for %s', 'gp'), get_post_format()); ?></h1>
            
				<?php
                // Paged Archive
                } else if (isset($_GET['paged']) && !empty($_GET['paged'])) {
                ?>
            	
                	<h1><?php _e('Blog archives', 'gp'); ?></h1>
            
				<?php
                }
			?>
            
        </header><!-- page-header -->
        
        <?php
        	if (category_description()) {
			?>
        
            <div class="content">
            
				<?php echo category_description(); ?>
                
            </div><!-- content-page -->
            
        	<?php
        	}
		?>

        
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
							if (has_post_thumbnail()) {
								$post_class = array('tile', 'has-post-thumbnail', 'post', $post_format);
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
                                
                                </div>
                            
                            </article>
                            
                    <?php
                        } //while
					} //if
					wp_reset_query();
                    ?>

				</div><!-- END // grid classes -->
            </div><!-- END // content -->
            
            <?php
			if ($sidebar == 'right') {
				if (is_active_sidebar('widget_area_blog')) {
					get_sidebar('blog');
				}
			}
			?>
            
            <?php gp_pagination(); ?>
            
        </div><!-- END // grid -->
        
	</div><!-- END // canvas -->

<?php get_footer(); ?>
