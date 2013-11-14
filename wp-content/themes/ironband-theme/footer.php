		<!-- footer -->
		<footer id="footer">

			<!-- footer-block -->
			<div class="footer-block">
				<a class="footer-logo" href="<?php echo home_url('/'); ?>">
					<img class="logo-desktop" src="<?php echo esc_url( get_iron_option('footer_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
					<img class="logo-mobile" src="<?php echo esc_url( get_iron_option('footer_logo_mobile') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
				</a>

				<!-- links-box -->
				<div class="links-box">
<?php if ( get_iron_option('facebook_page') ) : ?>
					<!-- facebook-box -->
					<div class="facebook-box">
						<div class="fb-like-box" data-href="<?php echo esc_url( get_iron_option('facebook_page') ); ?>"<?php if ( get_iron_option('facebook_appid') ) echo ' data-appid="' . esc_attr( get_iron_option('facebook_appid') ) . '"'; ?> data-width="200" data-colorscheme="dark" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
<?php endif; ?>

<?php get_template_part('parts/networks'); ?>
				</div>
			</div>

<?php
$footer_area = get_iron_option('footer-area_id');
if ( is_active_sidebar( $footer_area ) ) :
	$widget_area = get_iron_option('widget_areas', $footer_area);
?>
			<div class="footer__widgets widget-area widget-area--<?php echo esc_attr( $footer_area ); if ( $widget_area['sidebar_grid'] > 1 ) echo ' grid-cols grid-cols--' . $widget_area['sidebar_grid']; ?>">
<?php
	do_action('before_ironband_footer_dynamic_sidebar');

	dynamic_sidebar( $footer_area );

	do_action('after_ironband_footer_dynamic_sidebar');
?>
			</div>
<?php
endif;
?>

			<!-- footer-row -->
			<div class="footer-row">
				<?php
	if ( get_iron_option('footer_bottom_logo') ) :
		$output = '<img src="' . esc_url( get_iron_option('footer_bottom_logo') ) . '" alt="">';

		if ( get_iron_option('footer_bottom_link') )
			$output = sprintf('<a target="_blank" href="%s">%s</a>', esc_url( get_iron_option('footer_bottom_link') ), $output);

		echo $output . "\n";
	endif;
				?>
				<div class="text"><?php echo apply_filters('the_content', get_iron_option('footer_copyright') ); ?></div>
			</div>
		</footer>

	</div>

<?php wp_footer(); ?>

</body>
</html>