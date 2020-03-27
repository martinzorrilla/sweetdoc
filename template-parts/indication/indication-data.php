<?php

  //get data from template if any
  $patient_id = $template_args["patient_id"];
  $app_id = $template_args["app_id"];
  $is_editable = $template_args["is_editable"];

  


  //load all the data we need from the Patient Post
  $patient_fields = get_post_custom($patient_id);
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  $cedula = $patient_fields['cedula'][0];
  $email_paciente = $patient_fields['email_paciente'][0];

  //$fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0];
  $fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0] !="" && $patient_fields['fecha_de_nacimiento'][0] !=NULL ? $patient_fields['fecha_de_nacimiento'][0] : "";
  $newDate = "";
  //acf retoran la fecha asi:20191128 en vez de 2019-11-28 que es como el input[date] requiere, x eso tranformo el valor
  if ($fecha_de_nacimiento != ""){ $newDate = date("Y-m-d", strtotime($fecha_de_nacimiento));}
  $departamento = $patient_fields['departamento'][0];
  $ciudad = $patient_fields['ciudad'][0];
  $direccion = $patient_fields['direccion'][0];
  
  //$radiobox_metodo_anti = get_field('epitelio_escamoso', $patient_id); 
  $telefono = $patient_fields['telefono'][0];
  $celular = $patient_fields['celular'][0];
  $establecimiento = $patient_fields['establecimiento'][0];
  $region_sanitaria = $patient_fields['region_sanitaria'][0];
  
  $fullname = $name.' '.$lastname;
  //if ($radiobox_metodo_anti) { var_dump($radiobox_metodo_anti); } else { echo "checkbox anti esta vacio"; }

 ?> 

<!-- creo que este div no es necesario para que funcione correctamente el form del paciente -->
<div class="form-tab-style">

  <!-- agregar la clase white-tab a la clase tab y tabcontent para modificar el color del fichero -->
  <!-- <div class="tab white-tab"> -->
  <div class="tab">
    <button class="tablinks active" >Datos Básicos</button>
  </div>

<!-- //patient cambiar por indication aca y en el js que le corresponde -->
  <!-- <div class="appform tabcontent white-tab"> -->
  <div class="appform tabcontent">
    <form id="create-indication-form" name="create-indication-form" method="post" >
          <input type="hidden" name="action" value="sw_create_indication_ajax">
          <input type="hidden" name="patient_id" value="<?= $patient_id?>">
          <fieldset row>
            <div class="floated-label-wrapper large-6 columns">
              <label for="indication_name">Nombre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="indication_name" name="indication_name" value="<?php echo $name ?>" placeholder="Ingrese el nombre del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="indication_last_name">Apellido &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="indication_last_name" name="indication_last_name" value="<?php echo $lastname ?>" placeholder="Ingrese el apellido del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

          </fieldset>
        </form>
  </div>
</div>
<!-- fin de crear-editar paciente -->

