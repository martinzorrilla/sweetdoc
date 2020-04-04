<div id="consultas_paciente" data-closable class="callout alert-callout-border primary text-center" style="margin-top: 2rem;">
    <h3 style="font-weight: bold;">Consultas Previas</h3>
</div>

<?php
  $appointment_url = home_url().'/consulta/?patient_id=';
  $indicacion_url = home_url().'/indicacion/?patient_id=';
  $estudios_url = home_url().'/estudios/?patient_id=';
  $patient_id = $template_args["patient_id"];
  $related = sw_get_related_appointments($patient_id);
  //r is the current app_id 
  foreach ($related as $r){
        //get the appointment creation date
        $creation_date = get_the_date( 'd-M-Y', $r );
    
        //get the colposcopy id and href of this app
        $colpo_patient_array = sw_get_colpo_id($r);
        $colpo_post_id = $colpo_patient_array[0];
        //$the_app = get_post($r); 
        //  var_dump($the_app);
        //echo $creation_date;
        //echo the_date('Y-m-d', '<h2>', '</h2>');
        //var_dump($the_app->post_date);
        $indication_array = sw_get_indication_id($r);
        $indication_id = $indication_array[0];
        $indication_title = $indication_id === NULL ? "- Crear indicación" : " - Editar indicación";

        $studies_array = sw_get_studies_id($r);
        $studies_id = $studies_array[0];
        $studies_title = $studies_id === NULL ? "- Crear solicitud de estudios" : " - Editar solicitud de estudios";

    ?>
    <div data-closable class="callout alert-callout-border secondary">
      <!-- CONSULTAS -->
      <a href="<?php echo esc_url( $appointment_url ).$patient_id.'&app_id='.$r; ?>"> - Consulta en fecha <strong> <?php echo $creation_date ?> </strong> - Codigo: <?php echo $r ?>
      </a>
      <br/>
      
      <!-- COLPOSCOPIAS -->
      <a href="<?php echo get_permalink( $colpo_post_id ); ?> ">- Colposcopía: <?php echo $colpo_post_id; ?></a>
      <br/>

      <!-- INDICACION -->
      <a href="<?php echo esc_url( $indicacion_url ).$patient_id.'&app_id='.$r; ?>"> <?= $indication_title ?></a>
      <!-- solo si existe una indicacion para esta app (consulta) debemos mostrar las opcion ver indicacion ya que si el valor es null aun no se creo una indicacion. -->
      <?php 
      if ($indication_id) {
        ?>  
        <a href="<?php echo get_permalink( $indication_id ); ?> ">- Ver indicación: <?php echo $indication_id; ?></a>
        <?php 
      }
      ?>
      <br/>
      
      <!-- ESTUDIOS -->
      <a href="<?php echo esc_url( $estudios_url ).$patient_id.'&app_id='.$r; ?>"> <?= $studies_title ?> </a>
      <!-- solo si existe una solicitud de estudios para esta app (consulta) debemos mostrar las opcion ver indicacion ya que si el valor es null aun no se creo una indicacion. -->
      <?php 
      if ($studies_id) {
        ?>  
        <a href="<?php echo get_permalink( $studies_id ); ?> ">- Ver solicitud: <?php echo $studies_id; ?></a>
        <?php 
      }
      ?>
      <br/>

      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
  } //foreach 
  ?>