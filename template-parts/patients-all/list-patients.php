  <?php

  
  $appointment_url = home_url().'/consulta/?patient_id=';

  $search_param = $template_args["search_param"];

  //echo "search_param = ".$search_param;

  $latest_patients = sw_get_patients($search_param);
  ?>

  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por Nombre de Pacientes..">

  <ul id="myUL">
    <?php foreach ($latest_patients as $patient): ?>
      <li>
        <div data-closable class="callout alert-callout-border primary">
          <a href="<?php echo get_permalink( $patient->ID ); ?> "><strong><?php echo $patient->post_title;?></strong></a>
          <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id=new'; ?>"> - Nueva consulta</a>

          <?php 
          $related = sw_get_related_appointments($patient->ID); 
          foreach ($related as $r){?>
            <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id='.$r; ?>"> - Consulta Anterior id: <?php echo $r ?> </a>
            <?php
          }
          ?>
          <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </li>
    <?php endforeach;?>
  </ul>