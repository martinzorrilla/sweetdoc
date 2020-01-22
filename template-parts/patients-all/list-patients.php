  <?php

  
  $appointment_url = home_url().'/consulta/?patient_id=';

  $search_param = $template_args["search_param"];

  //search_param DEPRECTATED. I don't use search param anymore but it can be used
  $latest_patients = sw_get_patients($search_param);
  ?>

  <input type="text" id="myInput" onkeyup="searchBarFunction()" placeholder="Buscar por Nombre de Pacientes..">

  <ul id="myUL">
    <?php foreach ($latest_patients as $patient): ?>
      <li>
        <div data-closable class="callout alert-callout-border secondary list-patients">
          
          <a href="<?php echo get_permalink( $patient->ID ); ?> " class="name">
            <strong><?php echo $patient->post_title;?></strong>           
            <span><strong> - Cedula: <?php echo (get_field( "cedula", $patient->ID ));?></strong></p>
          </a>
          
          <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id=new'; ?>" class="crete-app"> - Crear Nueva consulta</a>

          <?php 
          $related = sw_get_related_appointments($patient->ID); 
          foreach ($related as $r){?>
             <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id='.$r; ?>"> - Consulta Anterior id: <?php echo $r ?> </a>
          <?php }?>
          <!-- <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
          </button> -->

        </div>
      </li>
    <?php endforeach;?>
  </ul>