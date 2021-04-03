<?php get_header();/* Template Name: Front Page */ ?>
<?php  
  $all_patient_url = home_url().'/pacientes/';
  $create_patient_url = home_url().'/crear-paciente/';
  $create_secretary_url = home_url().'/crear-asistente/';
  $current_user = wp_get_current_user();
  $client_gender = get_field('client_gender', 'option');
  $client_gender = isset($client_gender) && $client_gender !="" ? $client_gender : "Valor no ingresado";
  $welcome_msg =  $client_gender =="female" ? "Bienvenida" : "Bienvenido";
?>
 
<div class="the-content">

  <?php hm_get_template_part('template-parts/doctor/doctor-intro', ['data' => ""]); ?>

  <!-- <div class="callout primary">
    <h1 class="text-center"> < ?= $welcome_msg ?> </h1>
  </div> -->

  <!-- <div class="row" style="margin:2em 0;">

    <div class="callout secondary small-12 medium-12 large-6 columns">
    < ?php 
      echo "<h2 class='text-center'> Hoy es el " . date("d/m/Y") . "</h2>";
    ?>
    </div>

    <div class="callout secondary small-12 medium-12 large-6 columns">
    < ?php

      echo "<h2 class='text-center'> Hora " . date("h:i:a") . "</h2>";
    ?>
    </div>

  </div> -->

  <div class="em-full-calendar" style="padding:0 1em;">
  <?php
    if(class_exists('WP_FullCalendar')){
      echo WP_FullCalendar::calendar();
      // echo EM_Calendar::output(array('full'=>0, 'long_events'=>1))
    }	
    ?>
  </div>

</div>

<?php get_footer(); ?>