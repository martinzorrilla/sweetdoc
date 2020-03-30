<?php

  //get data from template if any
  //$patient_id = "new";
  $patient_id = $template_args["patient_id"];
  $app_id = $template_args["app_id"];
  //$is_editable = $template_args["is_editable"];
  $is_editable = "true";
  
  $indication_id = $template_args["indication_id"]; // uso??
  $rp = "ovulos";
  $indicaciones = "cada 8hs";


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
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          <fieldset row>
            <div class="floated-label-wrapper large-6 columns">
              <label for="rp">R.P. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="rp" name="rp" value="<?php echo $rp ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="indicaciones">Indicaciónes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="indicaciones" name="indicaciones" value="<?php echo $indicaciones ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

          </fieldset>
        </form>
  </div>
</div>
<!-- fin de crear-editar paciente -->

