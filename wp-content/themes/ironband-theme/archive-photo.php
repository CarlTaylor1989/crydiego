<?php
/**
 * Template Name: Photo Posts
 */

global $post;

get_header();

$page_for_archive = ( isset($post->ID) ? $post->ID : get_iron_option('page_for_videos') );
$tax = 'photo-category';
$terms = get_terms($tax);
$query = iron_get_posts('photo', 1, -1);

/**
 * Setup Dynamic Sidebar
 */

list( $has_sidebar, $sidebar_position, $sidebar_area ) = setup_dynamic_sidebar( $page_for_archive );

?>

		<!-- container -->
		<div class="container">
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<h1><?php the_title(); ?></h1>

<?php
if ( $has_sidebar ) :
?>
			<div id="twocolumns" class="content__wrapper<?php if ( 'left' === $sidebar_position ) echo ' content--rev'; ?>">
				<div id="content" class="content__main">
<?php
endif;
?>

<?php	if ( count($terms) > 0 ) : ?>
			<!-- filters-block -->
			<div class="filters-block">
				<span class="filter-heading"><?php _e('Filter by', IRON_TEXT_DOMAIN); ?></span>
				<ul id="filter-type" class="filter">
					<li><a class="active" href="#" data-target="all"><?php _e('All', IRON_TEXT_DOMAIN); ?></a></li>
<?php		foreach ( $terms as $term ) :
				$target = sanitize_html_class($tax, 'tax') . '-' . sanitize_html_class($term->slug, $term->term_id); ?>
					<li><a href="#" data-target="<?php echo $target; ?>"><?php echo $term->name; ?></a></li>
<?php		endforeach; ?>
				</ul>
			</div>
<?php	endif; ?>

<?php	if ( $query->have_posts() ): ?>
			<!-- photos -->
			<ul id="filter-collection" class="filter-data photos-list one-<?php echo ( $has_sidebar ? 'half' : 'third' ); ?>">
<?php
			while ( $query->have_posts() ) :
				$query->the_post();

				get_template_part('items/photo');

			endwhile;
?>
			</ul>
<?php
endif;

if ( $has_sidebar ) :
?>
				</div>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
	do_action('before_ironband_sidebar_dynamic_sidebar', 'archive-photo.php');

	dynamic_sidebar( $sidebar_area );

	do_action('after_ironband_sidebar_dynamic_sidebar', 'archive-photo.php');
?>
				</aside>
			</div>
<?php
endif;
?>
		</div>

<?php get_footer(); ?>