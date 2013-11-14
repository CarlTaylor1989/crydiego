<?php

get_header();

global $post;

$archive_page = get_option('page_for_posts');
$archive_page = ( empty($archive_page) ? false : post_permalink($archive_page) );

/**
 * Setup Dynamic Sidebar
 */

list( $has_sidebar, $sidebar_position, $sidebar_area ) = setup_dynamic_sidebar( $post->ID );

?>

		<!-- container -->
		<div class="container">
<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
?>
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
?>
					<!-- single-post -->
					<div id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
						<?php the_post_thumbnail( array(696, 353), array( 'class' => 'wp-featured-image' ) ); ?>

						<!-- meta -->
						<div class="meta">
							<time class="datetime" datetime="<?php the_time('c'); ?>"><?php the_date(); ?></time>
<?php

		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __(', ', IRON_TEXT_DOMAIN) );
		if ( $categories_list ) {
			echo '<span class="links categories-links">' . sprintf(_x('%s: ', 'A term followed by a punctuation mark used to explain or start an enumeration.', IRON_TEXT_DOMAIN), __('Category', IRON_TEXT_DOMAIN)) . $categories_list . '</span>';
		}

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __(', ', IRON_TEXT_DOMAIN) );
		if ( $tag_list ) {
			echo '<span class="links tags-links">' . sprintf(_x('%s: ', 'A term followed by a punctuation mark used to explain or start an enumeration.', IRON_TEXT_DOMAIN), __('Tag', IRON_TEXT_DOMAIN)) . $tag_list . '</span>';
		}

?>
						</div>

						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div>

<?php	get_template_part('parts/share'); ?>

<?php	comments_template(); ?>
					</div>
<?php
		if ( $has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'single-post.php');

	dynamic_sidebar( $sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'single-post.php');
?>
				</aside>
			</div>
<?php
		endif;

	endwhile;
endif;
?>
		</div>


<?php

get_footer();