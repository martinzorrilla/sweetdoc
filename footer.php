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
		<!-- esto usamos antes de iniciar el contenido (en el header) y al final para estandarizar 
		un padding arriba y abajo de todo el sitio -->
		<div class="top-bottom-spacer"></div>
     <!-- the content ends here! -->
	 </div>
  </div>
</div>
</div><!-- patient-div -->

<div class="footer-container">

	<!-- por default, esto estaba descomentado y no estaba lo que agregue mas arriba --> 	
	<footer class="footer">
		<h3>Footer</h3>
		<?php dynamic_sidebar( 'footer-widgets' ); ?>
	</footer> 
	
</div>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
</div><!-- Close off-canvas content -->
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
