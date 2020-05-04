<div id="consultas_paciente" data-closable class="callout alert-callout-border secondary text-center" style="margin-top: 2rem;">
    <h3 style="font-weight: bold;">Consultas Previas</h3>
</div>

<?php
  $appointment_url = home_url().'/consulta/?patient_id=';
  $colpo_url = home_url().'/colposcopia/?patient_id=';

  $indicacion_url = home_url().'/indicacion/?patient_id=';
  // $prescription_pdf_url = home_url().'/indicacion-pdf/?indication_id='.$post_id;
  $prescription_pdf_url = home_url().'/indicacion-pdf/?indication_id=';


  $estudios_url = home_url().'/estudios/?patient_id=';
  // $studies_pdf_url = home_url().'/estudios-pdf/?studies_id='.$post_id;
  $studies_pdf_url = home_url().'/estudios-pdf/?studies_id=';
  
  $laboratorios_url = home_url().'/laboratorios/?patient_id=';
  // $laboratories_pdf_url = home_url().'/laboratorios-pdf/?laboratories_id='.$post_id;
  $laboratories_pdf_url = home_url().'/laboratorios-pdf/?laboratories_id=';

  $patient_id = $template_args["patient_id"];
  $related = sw_get_related_appointments($patient_id);
  
?>
      <table class="sw-tabla-consultas">
        <thead>
          <tr>
            <th>Consulta</th>
            <th>Fecha</th>
            <th>Colposcopía</th>
            <th>Indicación</th>
            <th>Estudios</th>
            <th>Laboratorio</th>
            <th>Ecografía</th>
          </tr>
        </thead>

        <tbody>
          <?php
          //r is the current app_id 
          foreach ($related as $r){
              //get the appointment creation date
              $creation_date = get_the_date( 'd-M-Y', $r );    
              //get the colposcopy id and href of this app
              $colpo_patient_array = sw_get_colpo_id($r);
              $colpo_post_id = isset($colpo_patient_array[0]) ? $colpo_patient_array[0] : NULL;
              // $colpo_post_id = $colpo_patient_array[0];
              $colpo_title = $colpo_post_id === NULL ? "Crear" : "Editar";
              $colpo_post_url = $colpo_post_id === NULL ? "&#35" : get_permalink( $colpo_post_id );

              $indication_array = sw_get_indication_id($r);
              $indication_id = isset($indication_array[0]) ? $indication_array[0] : NULL;
              // $indication_id = $indication_array[0];
              $indication_title = $indication_id === NULL ? "Crear" : "Editar";

              $studies_array = sw_get_studies_id($r);
              $studies_id = isset($studies_array[0]) ? $studies_array[0] : NULL;
              // $studies_id = $studies_array[0];
              $studies_title = $studies_id === NULL ? "Crear" : "Editar";
              
              $laboratories_array = sw_get_laboratories_id($r);
              $laboratories_id = isset($laboratories_array[0]) ? $laboratories_array[0] : NULL;
              // $laboratories_id = $laboratories_array[0];
              $laboratories_title = $laboratories_id === NULL ? "Crear" : "Editar";

              ?>
              
              <tr> <!--cada tr es una fila en la tabla -->
                  <!-- consulta -->
                  <td>
                      <a href="<?php echo esc_url( $appointment_url ).$patient_id.'&app_id='.$r; ?>">Ver<?php //echo $r ?></a>      
                  </td>

                  <!-- Fecha -->
                  <td>
                      <a href="#"><?php echo $creation_date ?></a>      
                  </td>

                  <!-- COLPOSCOPIAS -->
                  <td>
                      <!-- <a href="< ?php //echo $colpo_post_url;?>"> < ?php //echo $colpo_title; ?></a> -->
                  <a href="<?php echo esc_url( $colpo_url ).$patient_id.'&app_id='.$r; ?>"><?= $colpo_title?></a>
                  <!-- solo si existe una indicacion para esta app (consulta) debemos mostrar las opcion ver indicacion ya que si el valor es null aun no se creo una indicacion. -->
                  <?php 
                  if ($colpo_post_id) {
                      ?>
                      <br>
                      <a href="<?php echo get_permalink( $colpo_post_id ); ?> "> Imprimir <?php //echo $indication_id; ?></a>
                      <?php 
                  }
                  ?>
                  </td>

                  <!-- INDICACION -->
                  <td>
                  <a href="<?php echo esc_url( $indicacion_url ).$patient_id.'&app_id='.$r; ?>"><?= $indication_title?></a>
                  <!-- solo si existe una indicacion para esta app (consulta) debemos mostrar las opcion ver indicacion ya que si el valor es null aun no se creo una indicacion. -->
                  <?php 
                  if ($indication_id) {
                      ?>
                      <br>
                      <!--  -->
                      <!-- <a href="< ?php echo get_permalink( $indication_id ) ?> "> Imprimir < ?php //echo $indication_id; ?></a> -->
                      <a href="<?php echo esc_url( $prescription_pdf_url ).$indication_id; ?>">Imprimir PDF</a>
                      <?php 
                  }
                  ?>
                  </td>

                  <!-- ESTUDIOS -->
                  <td>
                  <a href="<?php echo esc_url( $estudios_url ).$patient_id.'&app_id='.$r; ?>"><?= $studies_title?></a>
                  <!-- solo si existe una solicitud de estudios para esta app (consulta) debemos mostrar las opcion ver indicacion ya que si el valor es null aun no se creo una indicacion. -->
                  <?php 
                  if ($studies_id) {
                      ?>
                      <br>  
                      <!-- <a href="< ?php echo get_permalink( $studies_id ); ?> "> Imprimir < ?php //echo $studies_id; ?></a> -->
                      <a href="<?php echo esc_url( $studies_pdf_url ).$studies_id; ?>">Imprimir PDF</a>
                      
                      <?php 
                  }
                  ?>
                  </td>

                  <!-- Laboratorio -->
                  <td>
                  <a href="<?php echo esc_url( $laboratorios_url ).$patient_id.'&app_id='.$r; ?>"><?= $laboratories_title?></a>
                  <!-- solo si existe una solicitud de estudios para esta app (consulta) debemos mostrar las opcion ver indicacion ya que si el valor es null aun no se creo una indicacion. -->
                  <?php 
                  if ($laboratories_id) {
                      ?>
                      <br>
                      <!-- <a href="< ?php echo get_permalink( $laboratories_id ); ?> "> Imprimir < ?php //echo $studies_id; ?></a> -->
                      <a href="<?php echo esc_url( $laboratories_pdf_url ).$laboratories_id; ?>">Imprimir PDF</a>
                      <?php 
                  }
                  ?>
                  </td>
                  <!-- Ecografia -->
                  <td>
                    <a href="#">No disponible</a>      
                  </td>
              </tr>
          <?php
          } //foreach 
          ?>
          </tbody>
          
          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
          </tfoot>
      </table>
