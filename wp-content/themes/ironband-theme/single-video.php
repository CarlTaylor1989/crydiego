<?php

get_header();

$archive_page = get_iron_option('page_for_videos');
$archive_page = ( empty($archive_page) ? false : post_permalink($archive_page) );

/**
 * Setup Dynamic Sidebar
 */

list( $has_sidebar, $sidebar_position, $sidebar_area ) = setup_dynamic_sidebar( $post->ID );

?>

		<!-- container -->
		<div class="container">
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<?php the_title('<h1>','</h1>'); ?>

<?php
		if ( $has_sidebar ) :
?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
<?php
		endif;

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
?>
					<!-- single-post video-post -->
					<div id="post-<?php the_ID(); ?>" <?php post_class('single-post video-post'); ?>>
						<!-- video-block -->
						<div class="video-block">
							<?php the_field('vid_video',$post->ID); ?>
						</div>

						<!-- meta -->
						<div class="meta">
							<time class="datetime" datetime="<?php the_time('c'); ?>"><?php the_date(); ?></time>
							<?php the_terms( $post->ID, 'video-category', '<span class="links">' . __('Category', IRON_TEXT_DOMAIN) . ': ', ', ', '</span>' ); ?>
						</div>

						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div>

<?php	get_template_part('parts/share'); ?>

<?php	comments_template(); ?>
					</div>
<?php
	endwhile;
endif;

if ( $has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'single-video.php');

	dynamic_sidebar( $sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'single-video.php');
?>
				</aside>
			</div>
<?php
endif;
?>
			</div>
		</div>

<?php get_footer(); ?>