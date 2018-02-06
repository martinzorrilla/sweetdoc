<?php
/*
Template Name: Home Page
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container">
	<div class="main-grid">
		<main class="main-content-full-width">
			<?php while ( have_posts() ) : the_post(); 
			the_title();
			the_content();
			?>

			

			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php get_footer();
