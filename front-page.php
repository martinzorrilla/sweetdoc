<?php get_header();/* Template Name: Front Page */ ?>
<?php  
  $all_patient_url = home_url().'/pacientes/';
  $create_patient_url = home_url().'/crear-paciente/';
  $create_secretary_url = home_url().'/crear-asistente/';
  $current_user = wp_get_current_user();
?>
  
<div class="the-content">

  <?php hm_get_template_part('template-parts/doctor/doctor-intro', ['data' => ""]); ?>

  <div class="callout primary">
    <h1 class="text-center">Bienvenido!</h1>
  </div>

  <div class="callout secondary">
  <?php 
    echo "<h2 class='text-center'> Hoy es el " . date("d/m/Y") . "</h2>";
  ?>
  </div>

  <div class="callout secondary">
  <?php

    echo "<h5 class='text-center'> Hora " . date("h:i:a") . "</h5>";
  ?>
  </div>

  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus blandit ligula eget est feugiat viverra. Duis a arcu laoreet, rhoncus libero imperdiet, placerat velit. Vestibulum euismod mi et ornare sodales. Donec efficitur mattis blandit. Proin in massa elit. Praesent malesuada iaculis nisl, a venenatis dui. Nullam venenatis tincidunt placerat. Suspendisse egestas urna a aliquet pretium.</p>
  </div>

<?php get_footer(); ?>