<?php get_header();/* Template Name: Reservar Turnos*/?>
<?php 
	$crear_reservas_url = home_url().'/crear-reserva/';
	$administrar_reservas_url = home_url().'/administrar-reservas/';

?>

  <div class="wrap" style="margin-bottom:2em;"> 
      <h1 class="under font-bold">Reserva de Turnos</h1>
  </div>

  <div class="row" style="padding-top: 1rem; padding-bottom: 2rem;">  
    <div class="small-12 medium-12 large-6 columns text-center" style="padding-bottom:1em;">
          <a id="reservar-turno-url" href="<?= $crear_reservas_url ?>" class="btn btn-green botones-estandard">Crear nueva reserva</a>
    </div>
  

    <div class="small-12 medium-12 large-6 columns text-center" style="padding-bottom:1em;">
          <a id="administrar-reservas-url" href="<?= $administrar_reservas_url ?>" class="btn btn-green botones-estandard">Administrar Reservas</a>
    </div>

  </div>

  <!-- <h2 style="text-align:center">Agendamientos</h2> -->

  <div class="em-full-calendar" style="padding:0 1em;">
    <?php
    if(class_exists('WP_FullCalendar')){
      echo WP_FullCalendar::calendar();
      // echo EM_Calendar::output(array('full'=>0, 'long_events'=>1))
    }else {
      echo "Revisar el estado del plugin gestor de eventos/Full Calendar o contacte con el desarrollador del sistema.";
    }	
    ?>
  </div>

<?php get_footer(); ?>
