<?php

/*

Template Name:	Homepage

@name			Homepage Template
@package		Muse
@since			1.0.0
@author			Pavel Richter <pavel@grandpixels.com>
@copyright		Copyright (c) 2013, Grand Pixels
@link			http://themes.grandpixels.com/muse

*/ 

get_header(); 
?>

	<div class="slideshow royalSlider gp-theme">
        
        <?php
		// Counter
		$slide_count = 1;

		// Query
		$gp_query_args = array(
			'post_type' => 'slide',
			'posts_per_page' => -1
		);
		$gp_query = NULL;
		$gp_query = new WP_Query($gp_query_args);

		// Loop
        if ($gp_query->have_posts()) { 
            while ($gp_query->have_posts()) {
                $gp_query->the_post();

				$slide_image_helper			= get_template_directory_uri() . '/images/bg-helper-00050a.png';
				$slide_title				= __(gp_meta('gp_slide_title'));
				$slide_caption				= __(gp_meta('gp_slide_caption'));
				$slide_url					= __(gp_meta('gp_slide_url'));
				$slide_youtube_code			= __(gp_meta('gp_slide_youtube_code'));
				$slide_vimeo_code			= __(gp_meta('gp_slide_vimeo_code'));
				
				$original_image_url 		= wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				
				?>
				
				<?php
				if (!empty($slide_youtube_code)) {
				?>
				
					<div class="slide-<?php echo $slide_count; ?> rsContent">
					
						<a class="rsImg" data-rsVideo="http://www.youtube.com/watch?v=<?php echo $slide_youtube_code; ?>" href="<?php if (has_post_thumbnail()) { echo $original_image_url[0]; } else { echo $slide_image_helper; } ?>"></a>
						
							
						<div class="slide-caption rsABlock rsNoDrag" data-fade-effect="false" data-move-effect="left" data-move-offset="300" data-speed="500" data-delay="0" data-easing="easeOutSine">
							<?php 
							if ($slide_title != '0') {
								if (!empty($slide_url)) {
								?>
								
                                    <h2 class="link">
                                        <a href="<?php echo $slide_url; ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    
								<?php
								} else {
								?>
								
                                    <h2>
                                        <?php the_title(); ?>
                                    </h2>
							
								<?php
								}
							}
							?>
							
							<?php if (!empty($slide_caption)) { ?> 
							
								<p><?php echo $slide_caption; ?></p>
								
							<?php } ?>
							
						</div><!-- END // slide-caption -->

					</div><!-- END // slide -->
			
				<?php
				} else if (!empty($slide_vimeo_code)) {
				?>
			
					<div class="slide-<?php echo $slide_count; ?> rsContent">
					
						<a class="rsImg" data-rsVideo="https://vimeo.com/<?php echo $slide_vimeo_code; ?>" href="<?php if (has_post_thumbnail()) { echo $original_image_url[0]; } else { echo $slide_image_helper; } ?>"></a>
						
						<div class="slide-caption rsABlock rsNoDrag" data-fade-effect="false" data-move-effect="left" data-move-offset="300" data-speed="500" data-delay="0" data-easing="easeOutSine">
							<?php 
							if ($slide_title != '0') {
								if (!empty($slide_url)) {
								?>
								
                                    <h2 class="link">
                                        <a href="<?php echo $slide_url; ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
								
								<?php
								} else {
								?>
								
                                    <h2>
                                        <?php the_title(); ?>
                                    </h2>
							
								<?php
								}
							}
							?>
							
							<?php if (!empty($slide_caption)) { ?> 
							
								<p><?php echo $slide_caption; ?></p>
								
							<?php } ?>
							
						</div><!-- END // slide-caption -->

					</div><!-- END // slide -->
				
				<?php
				} else if (has_post_thumbnail()) {
				?>
			
					<div class="slide-<?php echo $slide_count; ?> rsContent">
					
						<img class="rsImg" src="<?php echo $original_image_url[0]; ?>" alt="<?php echo $slide_title; ?>" />

						<div class="slide-caption rsABlock rsNoDrag" data-fade-effect="false" data-move-effect="left" data-move-offset="300" data-speed="500" data-delay="0" data-easing="easeOutSine">
							<?php 
							if ($slide_title != '0') {
								if (!empty($slide_url)) {
								?>
								
                                    <h2 class="link">
                                        <a href="<?php echo $slide_url; ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
								
								<?php
								} else {
								?>
								
                                    <h2>
                                        <?php the_title(); ?>
                                    </h2>
							
								<?php
								}
							}
							?>
							
							<?php if (!empty($slide_caption)) { ?> 

								<p><?php echo $slide_caption; ?></p>
								
							<?php } ?>
							
						</div><!-- END // slide-caption -->

					</div><!-- END // slide -->
			
				<?php
				} //if
				?>

       		<?php
            $slide_count++;
            } //while
        } //if
        wp_reset_query();
        ?>
    
	</div><!-- END // slideshow -->
    
    <div class="content-home position-fixed transition">
        
        <?php
        if (get_posts('post_type=callout') && gp_option('gp_callout_homepage') != 'false') {

			if (wp_count_posts('callout')->publish == 1) {
				$callout_number = 1;
			} else if (wp_count_posts('callout')->publish == 2) {
				$callout_number = 2;
			} else if (wp_count_posts('callout')->publish == 3) {
				$callout_number = 3;
			} else if (wp_count_posts('callout')->publish == 4) {
				$callout_number = 4;
			} else if (wp_count_posts('callout')->publish == 5) {
				$callout_number = 5;
			} else if (wp_count_posts('callout')->publish > 5) {
				$callout_number = 5;
			} else {
				$callout_number = 5;
			}
		?>
			
            <div class="grid-callout-home grid-merge float-left posts-no-<?php echo $callout_number; ?>">
            
                <?php
                // Counter
                $callout_count = 1;
                
                // Query
                $gp_query_args = array(
                    'post_type' => 'callout',
                    'posts_per_page' => $callout_number
                );
                $gp_query = NULL;
                $gp_query = new WP_Query($gp_query_args);
                
                // Loop
                if ($gp_query->have_posts()) {
                    while ($gp_query->have_posts()) { 
                        $gp_query->the_post();
                        
                        if (gp_meta('gp_callout_block_background')) {
                            $callout_background 	= ' style="background-color:' . gp_meta('gp_callout_block_background') . ';"';
                        } else {
                            $callout_background		= '';
                        }
                        
                        if (has_post_thumbnail()) {
                            $class_thumbnail 		= 'has-post-thumbnail';
                        } else {
                            $class_thumbnail 		= 'no-post-thumbnail';
                        }
                        
                        if (gp_meta('gp_callout_url')) {
                            $class_url 		= 'has-url';
                        } else {
                            $class_url 		= 'no-url';
                        }
                        
                        $callout_title				= __(gp_meta('gp_callout_title'));
                        $callout_url				= __(gp_meta('gp_callout_url'));
                        
                        $callout_class 				= array('post', 'post-no-' . $callout_count, $class_thumbnail, $class_url);
				?>
                    
                        <article <?php post_class($callout_class); ?><?php echo $callout_background; ?>>
                            
                            <?php if ($callout_title != '0') { ?>
                            
                            <div class="post-header transition float-left">
                                
                                <h3 class="post-title">
                                    <?php
                                    if (!empty($callout_url)) {
                                    ?>
                                        
                                        <a class="underline-hover" href="<?php echo $callout_url; ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                        
                                    <?php
                                    } else {
                                        
                                        the_title();
                                        
                                    } 
                                    ?>
                                </h3>
                                
                            </div><!-- END // post-header -->
                            
                            <?php } ?>

                            <?php if (has_post_thumbnail()) { ?>
                            
                                <div class="post-image transition">
                                    <a href="<?php echo $callout_url; ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('large'); ?>
                                    </a>
                                </div>
                                
                            <?php } ?>
    
                        </article><!-- END // post -->
                
                <?php
                    $callout_count++;
                    } // while
                } // if
                wp_reset_query();
                ?>
    
            </div><!-- END // list-callout-home -->
        
        <?php 
		} // if
		?>
        
        <?php
        if (get_posts('post_type=event') && gp_option('gp_event_homepage') != 'false') {

			if (wp_count_posts('event')->publish == 1) {
				$event_number = 1;
			} else if (wp_count_posts('event')->publish == 2) {
				$event_number = 2;
			} else if (wp_count_posts('event')->publish == 3) {
				$event_number = 3;
			} else if (wp_count_posts('event')->publish == 4) {
				$event_number = 4;
			} else if (wp_count_posts('event')->publish > 4) {
				$event_number = 4;
			} else {
				$event_number = 4;
			}
		?>
			
				<div class="grid-event-home grid-post-home grid-merge float-left posts-no-<?php echo $event_number; ?>">
				
					<?php
					// Counter
					$event_count = 1;
					
					//Query
					$gp_query_args = array(
						'post_type'			=> 'event',
						'meta_key'			=> 'gp_event_date',
						'meta_value'		=> date('Y/m/d'),
						'meta_compare'		=> '>=',
						'orderby'			=> 'meta_value',
						'order'				=> 'ASC',
						'posts_per_page'	=> $event_number
					);
					$gp_query = NULL;
                    $gp_query = new WP_Query($gp_query_args);
					
					// Loop
					if ($gp_query->have_posts()) {
						while ($gp_query->have_posts()) { 
							$gp_query->the_post();
							
							if (gp_meta('gp_event_location')) {
								$event_location			= ' [' . __(gp_meta('gp_event_location')) . ']';
								$event_title			= the_title('', '', false);
								$event_title			.= $event_location;	
							} else {
								$event_title			= the_title('', '', false);
							}
							
							$event_class 				= array('one-fourth', 'post', 'post-no-' . $event_count);
					?>
						
							<article id="post-<?php the_ID(); ?>" <?php post_class($event_class); ?>>
                        	
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                
                                    <div class="post-header">
                                    
                                    	<?php if (gp_option('gp_event_homepage_date') != 'false') { ?>
                                            <div class="post-date">
                                                <?php get_template_part('date', 'event'); ?>
                                            </div>
                                        <?php } ?>
                                        
                                        <h3 class="post-title transition">
                                        	<?php echo $event_title; ?>
                                        </h3>
                                        
                                    </div>
                                
                                </a>
                            
                            </article><!-- END // post -->
                            
					<?php
						$event_count++;
						} // while
					} // if
					wp_reset_query();
					?>
		
				</div><!-- END // list-event-home -->
        
        <?php 
		} // if
		?>
        
        <?php 
		if (gp_option('gp_post_homepage') != 'false') {
		
			if (wp_count_posts()->publish == 1) {
				$post_number = 1;
			} else if (wp_count_posts()->publish == 2) {
				$post_number = 2;
			} else if (wp_count_posts()->publish == 3) {
				$post_number = 3;
			} else if (wp_count_posts()->publish == 4) {
				$post_number = 4;
			} else if (wp_count_posts()->publish == 5) {
				$post_number = 5;
			} else if (wp_count_posts()->publish > 5) {
				$post_number = 5;
			} else {
				$post_number = 5;
			}
		?>
        
            <div class="grid-blog-home grid-post-home grid-merge float-left posts-no-<?php echo $post_number; ?>">
            
                <?php
				// Counter
				$post_count = 1;
				
				// Query
                $gp_query_args = array(
					'ignore_sticky_posts'	=> 1,
					'posts_per_page'		=> $post_number
				);
				$gp_query = NULL;
				$gp_query = new WP_Query($gp_query_args);
                
				// Loop
                if ($gp_query->have_posts()) {
                    while ($gp_query->have_posts()) { 
                        $gp_query->the_post();
						
						// Post Format Class
						if (!get_post_format()) {
							$post_format = 'format-standard';
						} else {
							$post_format = 'format-' . get_post_format();
						}
						
						$post_class 				= array('post-no-' . $post_count, $post_format);
                ?>
                    
                        <article <?php post_class($post_class); ?>>
                        
                        	<?php if (gp_option('gp_post_icon') != 'false') { ?>
            
                                <span class="post-icon"></span><!-- END // post-icon -->
                            
                            <?php } ?>
                            
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                
                                <div class="post-header">
                                
                                    <?php if (gp_option('gp_post_homepage_date') != 'false') { ?>
                                        <div class="post-date">
                                            <?php the_time(); ?>
                                        </div>
                                    <?php } ?>
                                    
                                    <h3 class="post-title transition">
                                        <?php the_title(); ?>
                                    </h3>
                                    
                                </div>
                            
                            </a>
                        
                        </article><!-- END // post -->
                        
                <?php
					$post_count++;
                    } // while
                } // if
                wp_reset_query();
                ?>
    
            </div><!-- END // list-post-home -->
            
		<?php
		} // if
        ?>

    </div><!-- END // content -->
    
    <?php gp_footer(); ?>
    <?php wp_footer(); ?>

</body>
</html>