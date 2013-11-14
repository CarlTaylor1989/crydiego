<?php
/**
 * Template Name: Home
 */

$widget_areas = get_iron_option('widget_areas');
$featured_zones = get_iron_option('homepage_blocks');
$active_zones = $featured_zones['enabled'];

get_header();

echo iron_get_home_slider();

?>

<!-- container -->
<div class="container">

<?php

if ( $active_zones ) :

	foreach ( $active_zones as $zone => $title ) :
		if ( 'placebo' === $zone ) continue;

		if ( is_active_sidebar( $zone ) )
		{
			global $iron_sidebar_grid;

			$iron_sidebar_grid = $widget_areas[$zone]['sidebar_grid'];

?>
	<div id="home-widget-area-<?php echo esc_attr($zone); ?>" class="widget-area widget-area--<?php echo esc_attr($zone); if ( $widget_areas[$zone]['sidebar_grid'] > 1 ) echo ' grid-cols grid-cols--' . $widget_areas[$zone]['sidebar_grid']; ?>">
<?php
do_action('before_ironband_home_dynamic_sidebar', $widget_areas[$zone]['sidebar_grid']);

dynamic_sidebar( $zone );

do_action('after_ironband_home_dynamic_sidebar', $widget_areas[$zone]['sidebar_grid']);
?>
	</div>
<?php
			$iron_sidebar_grid = false;
		}

	endforeach;
endif;

?>

</div>

<?php get_footer(); ?>