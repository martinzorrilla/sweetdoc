<?php get_header();/* Template Name: Crear Reserva*/?>
<?php 
	// $crear_reservas_url = home_url().'/crear-reserva/';
	// $administrar_reservas_url = home_url().'/reservas/';
?>

    <div class="wrap" style="margin-bottom:2em;"> 
        <h1 class="under font-bold">Reservar turno</h1>
    </div>

    <div class="em-crear-reserva-containter">
        <?php 
        if (class_exists('EM_Events')) {
            echo do_shortcode('[event_form]');
        }else {
            echo "Revisar el estado del plugin gestor de eventos o contacte con el desarrollador del sistema.";
        }
        ?>
    </div>

<?php get_footer(); ?>
