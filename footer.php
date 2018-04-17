<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

</div><!-- patient-div -->

<div class="footer-container">
	<!-- Added by MZ -->
<!-- 	<nav class="site-navigation top-bar" role="navigation">
	<div class="top-bar-left">
		<div class="site-desktop-title top-bar-title">
			<a href="#">Footer</a>
		</div>
	</div>
	<div class="top-bar-right">
		<?php// foundationpress_top_bar_r(); ?>

		<?php// if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
			<?php// get_template_part( 'template-parts/mobile-top-bar' ); ?>
		<?php// endif; ?>
	</div>
</nav> -->
	<!-- Added by MZ -->

	<!-- por default, esto estaba descomentado y no estaba lo que agregue mas arriba --> 	
	<footer class="footer">
		<?php dynamic_sidebar( 'footer-widgets' ); ?>
	</footer> 
	

</div>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
</div><!-- Close off-canvas content -->
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
