<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		

		<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
		<script src="../wp-content/themes/FoundationPress/src/assets/js/bar.js"></script>

		<?php wp_head(); ?>

		<!-- home url -->
		<script>window.homeUrl = "<?php echo get_home_url(); ?>";</script>
	</head>
	<body <?php body_class(); ?>>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>


	<!-- original header section -->
	<header class="site-header" role="banner" style="display:none">
		<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
			<div class="title-bar-left">
				<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
				<span class="site-mobile-title title-bar-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</span>
			</div>
		</div>

		<nav class="site-navigation top-bar" role="navigation">
			<div class="top-bar-left">
				<div class="site-desktop-title top-bar-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</div>
			</div>
			<div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>

				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
			</div>
		</nav>

	</header>

	<div class="patient-div">

	<!-- we need this so the side bar will know how to redirect to the correspondings urls -->
	<?php  
		$all_patient_url = home_url().'/pacientes/';
		$create_patient_url = home_url().'/crear-paciente/';
		$create_secretary_url = home_url().'/crear-asistente/';
		$current_user = wp_get_current_user();
	?>
	<div class="app-dashboard shrink-medium">
  		<?php hm_get_template_part('template-parts/sweet-navbar-alt'); ?>
			<div class="app-dashboard-body off-canvas-wrapper">
				<div id="app-dashboard-sidebar" class="app-dashboard-sidebar position-left off-canvas off-canvas-absolute reveal-for-medium" data-off-canvas>
				<div class="app-dashboard-sidebar-title-area">
					<div class="app-dashboard-close-sidebar">
					<h3 class="app-dashboard-sidebar-block-title">Menu</h3>
					<!-- Close button -->
					<button id="close-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-sidebar-close-button show-for-medium" aria-label="Close menu" type="button">
						<span aria-hidden="true"><a href="#"><i class="large fa fa-angle-double-left"></i></a></span>
					</button>
					</div>
					<div class="app-dashboard-open-sidebar">
					<button id="open-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-open-sidebar-button show-for-medium" aria-label="open menu" type="button">
						<span aria-hidden="true"><a href="#"><i class="large fa fa-angle-double-right"></i></a></span>
					</button>
					</div>
				</div>
				<div class="app-dashboard-sidebar-inner">
					<ul class="menu vertical">
					<li><a href="<?php echo $all_patient_url ?>" class="is-active">
						<i class="fas fa-address-book fa-2x"></i><span class="app-dashboard-sidebar-text"> Listar Pacientes</span>
					</a></li>
					<li><a href="<?php echo $create_patient_url ?>">
						<i class="fas fa-heartbeat fa-lg"></i><span class="app-dashboard-sidebar-text"> Crear Paciente Nuevo</span>
					</a></li>
					<li><a href="<?php echo $create_secretary_url ?>">
						<i class="fas fa-user-md fa-2x"></i><span class="app-dashboard-sidebar-text"> Crear Asistente</span>
					</a></li>
					</ul>
				</div>
				</div>

				<div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>
				<!-- the content starts here! -->

				<!-- <ul class="menu align-center">
					<li><a href="#">One</a></li>
					<li><a href="#">Two</a></li>
					<li><a href="#">Three</a></li>
				</ul> -->

				<?php //hm_get_template_part('template-parts/sweet-navbar'); ?>

				<?php
				date_default_timezone_set("America/Asuncion");
				//echo date_default_timezone_get();
				?>