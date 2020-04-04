<div id="consultas_paciente" data-closable class="callout alert-callout-border primary text-center" style="margin-top: 2rem;">
    <h3 style="font-weight: bold;">Consultas Previas</h3>
</div>

<?php
  $appointment_url = home_url().'/consulta/?patient_id=';
  $indicacion_url = home_url().'/indicacion/?patient_id=';
  $estudios_url = home_url().'/estudios/?patient_id=';
  $patient_id = $template_args["patient_id"];
  $related = sw_get_related_appointments($patient_id);
  
?>

<table class="hover stack my-table-data">
  <thead style="background-color: #2c3840; color: #eee;">
    <tr>
      <th>Código</th>
      <th>Fecha</th>
      <th>Colposcopía</th>
      <th>Indicación</th>
      <th>Estudios</th>
    </tr>
  </thead>
  <tbody>

    <!-- <tr> 1ra fila -->
      <!-- <td> 1124 </td> codigo -->
      <!-- <td>23-04-2019</td> Fecha -->
      <!-- <td>908</td>Colpo -->
      <!-- <td>Crear</td>Indiacion -->
      <!-- <td>Ver</td>Estudio -->
    <!-- </tr>Fin de 1ra fila -->

    <?php
    //r is the current app_id 
    foreach ($related as $r){
        //get the appointment creation date
        $creation_date = get_the_date( 'd-M-Y', $r );    
        //get the colposcopy id and href of this app
        $colpo_patient_array = sw_get_colpo_id($r);
        $colpo_post_id = $colpo_patient_array[0];

        $indication_array = sw_get_indication_id($r);
        $indication_id = $indication_array[0];
        $indication_title = $indication_id === NULL ? "Crear" : "Editar";

        $studies_array = sw_get_studies_id($r);
        $studies_id = $studies_array[0];
        $studies_title = $studies_id === NULL ? "Crear" : "Editar";?>
        
        <tr> <!--cada tr es una fila en la tabla -->
            <!-- codigo -->
            <td>
                <a href="<?php echo esc_url( $appointment_url ).$patient_id.'&app_id='.$r; ?>"><?php echo $r ?></a>      
            </td>

            <!-- Fecha -->
            <td>
                <a href="<?php echo esc_url( $appointment_url ).$patient_id.'&app_id='.$r; ?>"><?php echo $creation_date ?></a>      
            </td>

            <!-- COLPOSCOPIAS -->
            <td>
                <a href="<?php echo get_permalink( $colpo_post_id ); ?> "> Ver<?php //echo $colpo_post_id; ?></a>
            </td>

            <!-- INDICACION -->
            <td>
            <a href="<?php echo esc_url( $indicacion_url ).$patient_id.'&app_id='.$r; ?>"><?= $indication_title?></a>
            <!-- solo si existe una indicacion para esta app (consulta) debemos mostrar las opcion ver indicacion ya que si el valor es null aun no se creo una indicacion. -->
            <?php 
            if ($indication_id) {
                ?>
                <br>
                <a href="<?php echo get_permalink( $indication_id ); ?> "> Imprimir <?php //echo $indication_id; ?></a>
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
                <a href="<?php echo get_permalink( $studies_id ); ?> "> Imprimir <?php //echo $studies_id; ?></a>
                <?php 
            }
            ?>
            </td>
        </tr>
    <?php
    } //foreach 
    ?>
    </tbody>
</table>