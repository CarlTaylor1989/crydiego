<?php

/*

Template Name:	Archives

@name			Archives Template
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

// Content & Grid Classes
if (is_active_sidebar('widget_area_page')) {
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
				if (is_active_sidebar('widget_area_page')) {
					get_sidebar();
				}
			}
			?>

            <div class="content <?php echo $content_class; ?>" role="main">
            
            	<?php
				if (have_posts()) {
					while (have_posts()) {
						the_post();
						
						if (!empty($post->post_content)) {
						?>

							<div class="content-page one-entire">
								<div class="inner-no-left-right">

									<?php the_content(); ?>
								
								</div>
							</div>

						<?php 
						}
					} //while
				} //if
				wp_reset_query();
				?>
				
            	<div class="grid-archives grid-merge <?php echo $grid_class; ?>">
                
                    <div class="tile">
                    
                    	<div class="tile-block inner">
                        
                            <h3><?php _e('Pages', 'gp'); ?></h3>
                            
                            <?php gp_navigation(); ?>
                            
                        </div><!-- END // tile-block -->
                        
                    </div><!-- END // tile -->
                    
                    <div class="tile">
                    
                    	<div class="tile-block inner">
                        
                            <h3><?php _e('Posts', 'gp'); ?></h3>
                            
                            <ul>
								<?php
                                	wp_get_archives(
										array(
											'type' => 'postbypost',
											'limit' => 20
										)
									);
								?>
                            </ul>
                            
                        </div><!-- END // tile-block -->
                        
                    </div><!-- END // tile -->
                    
                    <div class="tile">
                    
                    	<div class="tile-block inner">
                        
                            <h3><?php _e('Upcoming Events', 'gp'); ?></h3>
                            
                            <ul>
								<?php
								$gp_query_args = array(
									'post_type'			=> 'event',
									'meta_key'			=> 'gp_event_date',
									'meta_value'		=> date('Y/m/d'),
									'meta_compare'		=> '>=',
									'orderby'			=> 'meta_value',
									'order'				=> 'ASC',
									'posts_per_page'	=> 20
								);
								$gp_query = NULL;
								$gp_query = new WP_Query($gp_query_args);
								
								if ($gp_query->have_posts()) {
									while ($gp_query->have_posts()) {
										$gp_query->the_post();
								?>
                                
									<li>
                                    	<?php get_template_part('date', 'event'); ?>
                                    	<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
                                        </a>
									</li>
								
                                <?php
									} //while
								} else {
								?>
                                
                                    <p>
                                        <?php _e('No upcoming events were found.', 'gp'); ?>
                                    </p>
                                
                                <?php
								} //if
								wp_reset_query();
								?>
                            </ul>
                            
                        </div><!-- END // tile-block -->
                        
                    </div><!-- END // tile -->
                    
                    <div class="tile">
                    
                    	<div class="tile-block inner">
                        
                            <h3><?php _e('Past Events', 'gp'); ?></h3>
                            
                            <ul>
								<?php
								$gp_query_args = array(
									'post_type'			=> 'event',
									'meta_key'			=> 'gp_event_date',
									'meta_value'		=> date('Y/m/d'),
									'meta_compare'		=> '<',
									'orderby'			=> 'meta_value',
									'order'				=> 'ASC',
									'posts_per_page'	=> 20
								);
								$gp_query = NULL;
								$gp_query = new WP_Query($gp_query_args);
								
								if ($gp_query->have_posts()) {
									while ($gp_query->have_posts()) {
										$gp_query->the_post();
								?>
                                
									<li>
                                    	<?php get_template_part('date', 'event'); ?>
                                    	<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
                                        </a>
									</li>
								
                                <?php
									} //while
								} else {
								?>
                                
                                    <p>
                                        <?php _e('No past events were found.', 'gp'); ?>
                                    </p>
                                
                                <?php
								} //if
								wp_reset_query();
								?>	
                            </ul>
                            
                        </div><!-- END // tile-block -->
                        
                    </div><!-- END // tile -->
                    
                    <div class="tile">
                    
                    	<div class="tile-block inner">
                        
                            <h3><?php _e('Albums', 'gp'); ?></h3>
                            
                            <ul>
								<?php
								$gp_query_args = array(
									'post_type'			=> 'album',
									'posts_per_page'	=> 20
								);
								$gp_query = NULL;
								$gp_query = new WP_Query($gp_query_args);
								
								if ($gp_query->have_posts()) {
									while ($gp_query->have_posts()) {
										$gp_query->the_post();
								?>
                                
									<li>
                                    	<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
                                        </a>
									</li>
								
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
                            </ul>
                            
                        </div><!-- END // tile-block -->
                        
                    </div><!-- END // tile -->
                    
                    <div class="tile">
                    
                    	<div class="tile-block inner">
                        
                            <h3><?php _e('Videos', 'gp'); ?></h3>
                            
                            <ul>
								<?php
								$gp_query_args = array(
									'post_type'			=> 'video',
									'posts_per_page'	=> 20
								);
								$gp_query = NULL;
								$gp_query = new WP_Query($gp_query_args);
								
								if ($gp_query->have_posts()) {
									while ($gp_query->have_posts()) {
										$gp_query->the_post();
								?>
                                
									<li>
                                    	<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
                                        </a>
									</li>
								
                                <?php
									} //while
								} else {
								?>
                                
                                    <p>
                                        <?php _e('No videos were found.', 'gp'); ?>
                                    </p>
                                
                                <?php
								} //if
								wp_reset_query();
								?>
                            </ul>
                            
                        </div><!-- END // tile-block -->
                        
                    </div><!-- END // tile -->
                    
                    <div class="tile">
                    
                    	<div class="tile-block inner">
                        
                            <h3><?php _e('Galleries', 'gp'); ?></h3>
                            
                            <ul>
								<?php
								$gp_query_args = array(
									'post_type'			=> 'gallery',
									'posts_per_page'	=> 20
								);
								$gp_query = NULL;
								$gp_query = new WP_Query($gp_query_args);
								
								if ($gp_query->have_posts()) {
									while ($gp_query->have_posts()) {
										$gp_query->the_post();
								?>
                                
									<li>
                                    	<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
                                        </a>
									</li>
								
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
                            </ul>
                            
                        </div><!-- END // tile-block -->
                        
                    </div><!-- END // tile -->
                    
                    <div class="tile">
                    
                    	<div class="tile-block inner">
                        
                            <h3><?php _e('Archives by Categories', 'gp'); ?></h3>
                            
                            <ul>
								<?php
									wp_list_categories(
										array(
											'depth' => 1,
											'title_li' => ''
										)
									);
								?>
                            </ul>
                            
                        </div><!-- END // tile-block -->
                        
                    </div><!-- END // tile -->
                    
                    <div class="tile">
                    
                    	<div class="tile-block inner">
                        
                            <h3><?php _e('Archives by Month', 'gp'); ?></h3>
                            
                            <ul>
								<?php
                                	wp_get_archives(
										array(
											'show_post_count' => '1'
										)
									);
								?>
                            </ul>
                            
                        </div><!-- END // tile-block -->
                        
                    </div><!-- END // tile -->
                    
                    <?php if (get_the_tags()) { ?>
                    
                        <div class="tile">
                        
                            <div class="tags tile-block inner">
                            
                                <h3><?php _e('Tags', 'gp'); ?></h3>
                                
                                <?php
                                    wp_tag_cloud(
                                        array(
                                            'orderby' => 'count'
                                        )
                                    );
                                ?>
                                
                            </div><!-- END // tile-block -->
                            
                        </div><!-- END // tile -->
                    
                    <?php } ?>
                            
				</div><!-- END // grid classes -->
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