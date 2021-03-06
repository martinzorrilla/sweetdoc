<?php
  $patient_id = $template_args["patient_id"];
  $is_editable = $template_args["is_editable"];

  $edit_patient_url = home_url().'/crear-paciente/?patient_id='.$patient_id;
  //load all the data we need from the Patient Post
  $patient_fields = get_post_custom($patient_id);
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  $cedula = $patient_fields['cedula'][0];
  $seguro_medico = get_field("seguro_medico", $patient_id);

  $fullname = $name.' '.$lastname;
  // $fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0] !="" && $patient_fields['fecha_de_nacimiento'][0] !=NULL ? $patient_fields['fecha_de_nacimiento'][0] : "";
  $fecha_de_nacimiento = isset($patient_fields['fecha_de_nacimiento'][0]) ? $patient_fields['fecha_de_nacimiento'][0] : NULL;
  $patient_age = calcular_edad($fecha_de_nacimiento);
  // var_dump($patient_fields['fecha_de_nacimiento'][0]);
  // var_dump(get_field( "fecha_de_nacimiento", $patient_id ));
  

  //printf(' Edad : %d años, %d meses, %d dias', $diff->y, $diff->m, $diff->d);
  $static_data_array = sw_get_static_data_id($patient_id); 
  $static_data_post = get_post_custom($static_data_array[0]);
  $numero_embarazos = isset($static_data_post['numero_embarazos'][0]) ? $static_data_post['numero_embarazos'][0] : NULL;
  $parto_normal = isset($static_data_post['parto_normal'][0]) ? $static_data_post['parto_normal'][0] : NULL;
  $cesareas = isset($static_data_post['cesareas'][0]) ? $static_data_post['cesareas'][0] : NULL;

  // $numero_embarazos = $static_data_post['numero_embarazos'][0];
  // $parto_normal = $static_data_post['parto_normal'][0];
  // $cesareas = $static_data_post['cesareas'][0];
  //var_dump($patient_id);

 ?> 
  <!-- agregar la clase white-tab a la clase tab y tabcontent para modificar el color del fichero -->
  <!-- <div class="tab white-tab"> -->
  <!-- <div class="tab"> -->
    <!-- <button class="tablinks active">Resumen</button> -->
    <!-- <button class="tablinks dabbed" onclick="openCity(event, 'London')" id="defaultOpen">London</button> -->
  <!-- </div> -->

    <!-- <div class="appform tabcontent white-tab"> -->
  <div id="Resumen" class="appform tabcontent">
    <div class="card profile-card-action-icons">
      <div class="card-section">
        <div class="profile-card-header">
          <div class="profile-card-author">
            <h5 class="author-title"><?php echo $fullname ?></h5>
          </div>
        </div>
        <div class="profile-card-about">
          
          
          <form id="delete-patient-form" name="delete-patient-form" method="post" >
          <input type="hidden" name="action" value="sw_delete_patient_ajax">
          <input type="hidden" name="patient_id" value="<?= $patient_id?>">
          </form>

          <h5 class="about-title separator-left">Acerca de <?php echo $name?></h5>

          <p class="about-content">
          <div class="row">          
            <div class="large-4 medium-12 columns ">
              <p><?php echo("Cedula : ".$cedula);?></p>
            </div>

            <div class="large-4 medium-12 columns ">
            <p>
                <?php
                if ($fecha_de_nacimiento == NULL) {
                  echo("Edad : ");
                }else{
                  printf(' Edad : %d años, %d meses, %d dias', $patient_age->y, $patient_age->m, $patient_age->d); 
                }?>
              </p>
            </div>

            <div class="large-4 medium-12 columns ">
              <p><?php 
                  if ($seguro_medico != NULL) {
                    echo "Seguro Médico: ".$seguro_medico; }?>
                </p>
            </div>

          </div> <!-- row -->

          <div class="row">          

            <div class="large-4 medium-12 columns ">
              <p><?php 
                if ($numero_embarazos != NULL) {
                echo("Embarazos : ".$numero_embarazos);}?>
                </p>
            </div>

            <div class="large-4 medium-12 columns ">
              <p>
                <?php
                  if ($parto_normal != NULL) {
                  echo("Parto normal : ".$parto_normal);}?>
              </p>
            </div>

            <div class="large-4 medium-12 columns ">
              <p><?php
                  if ($cesareas != NULL) {
                  echo("Cesareas : ".$cesareas);}?>
              </p>
            </div>
          </div> <!-- row -->

          </p>

          <!-- <br>
          <h5 class="about-title separator-left">Ultimo estudios</h5>
          
          <div class="row about-skills">
            <div class="small-6 columns">
              <ul class="arrow">
                <li>Ecografia</li>
                <li>Colposcopia</li>
                <li>Analisis de Sangre</li>
              </ul>
            </div>
            <div class="small-6 columns">
              <ul class="arrow">
                <li>Ecografia</li>
                <li>Leep</li>
                <li>Colposcopia</li>
              </ul>
            </div>
          </div> -->

          <br>
          <h5 class="about-title separator-left">Administrar paciente</h5>

              <!-- viejo -->
            <!-- <div class="row">  
              <div class="floated-label-wrapper large-6 medium-6 columns text-center" style="padding-top: 1rem;">
              <a href="< ?php echo $edit_patient_url ?>">
                <button id="edit-patient" class="submit_button save-button-expanded" type="submit" value="">
                  <i class="fas fa-edit 2x"></i>  <span class="app-dashboard-sidebar-text"> Editar </span>
                </button>
              </a>
  
              </div>
                <div class="floated-label-wrapper large-6 medium-6 columns text-center" style="padding-top: 1rem;">
                  <button id="delete-patient" class="toggle-input submit_button save-button-expanded" type="submit" value="delete-patient">
                    <i class="fas fa-trash-alt 2x"></i>  <span class="app-dashboard-sidebar-text"> Borrar </span>
                  </button>
                <p class="errorWrapper"></p>
              </div>
            </div> -->

            <!-- nuevo -->
          <div class="row" style="padding-top: 2rem;">  
            <div class="small-12 medium-12 large-6 columns text-center" style="padding-bottom:1em;">
                <a id="edit-patient" href="<?php echo $edit_patient_url ?>" class="btn btn-blue botones-estandard">Editar</a>
            </div>
            <div class="small-12 medium-12 large-6 columns text-center">
            <a id="delete-patient" href="#" class="btn btn-red botones-estandard">Borrar</a>
            </div>
          </div>



        </div>
      </div>
    </div>
  </div>