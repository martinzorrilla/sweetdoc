<?php

  // si el argumento es valido, aceptarlo, sino forzarlo a que sea string vacio
  //$patient_id = $template_args["patient_id"] !="" && $template_args["patient_id"] !=NULL ? $template_args["patient_id"] : "";

  //get data from template if any
  $patient_id = $template_args["patient_id"];
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

  <!-- <div class="appform tabcontent white-tab"> -->
  <div class="appform tabcontent">
    <form id="create-patient-form" name="create-patient-form" method="post" >
          <input type="hidden" name="action" value="sw_create_patient_ajax">
          <input type="hidden" name="patient_id" value="<?= $patient_id?>">
          <fieldset row>
            <div class="floated-label-wrapper large-6 columns">
              <label for="patient_name">Nombre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_name" name="patient_name" value="<?php echo $name ?>" placeholder="Ingrese el nombre del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="patient_last_name">Apellido &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_last_name" name="patient_last_name" value="<?php echo $lastname ?>" placeholder="Ingrese el apellido del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="patient_ci">Cedula &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_ci" name="patient_ci" value="<?php echo $cedula ?>" placeholder="Ingrese el documento del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <!-- email del paciente -->
            <div class="floated-label-wrapper large-6 columns">
              <label for="email_paciente">email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="email" id="email_paciente" name="email_paciente" value="<?php echo $email_paciente ?>" placeholder="Ingrese el email del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <!-- Fecha de nacimiento del paciente -->
            <div class="floated-label-wrapper large-6 columns">
              <label for="fecha_de_nacimiento">Fecha de nacimiento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="date" id="fecha_de_nacimiento" name="fecha_de_nacimiento" value="<?php echo $newDate ?>" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
            </div>

            <!-- Departamento del paciente -->
            <div class="floated-label-wrapper large-6 columns">
              <label for="departamento">Departamento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <select name="departamento" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>>
                    <option value="guaira" <?php if($departamento == "guaira") echo "selected"?>>Guaira</option>
                    <option value="concepcion" <?php if($departamento == "concepcion") echo "selected"?>>Concepción</option>
                    <option value="san_pedro" <?php if($departamento == "san_pedro") echo "selected"?>>San Pedro</option>
                    <option value="cordillera" <?php if($departamento == "cordillera") echo "selected"?>>Cordillera</option>
                    <option value="caaguazu" <?php if($departamento == "caaguazu") echo "selected"?>>Caaguazú</option>
                    <option value="caazapa" <?php if($departamento == "caazapa") echo "selected"?>>Caazapá</option>
                    <option value="itapua" <?php if($departamento == "itapua") echo "selected"?>>Itapúa</option>
                    <option value="misiones" <?php if($departamento == "misiones") echo "selected"?>>Misiones</option>
                    <option value="paraguari" <?php if($departamento == "paraguari") echo "selected"?>>Paraguarí</option>
                    <option value="alto_parana" <?php if($departamento == "alto_parana") echo "selected"?>>Alto Paraná</option>
                    <option value="central" <?php if($departamento == "central") echo "selected"?>>Central</option>
                    <option value="neembucu" <?php if($departamento == "neembucu") echo "selected"?>>Ñeembucú</option>
                    <option value="amambay" <?php if($departamento == "amambay") echo "selected"?>>Amambay</option>
                    <option value="canindeyu" <?php if($departamento == "canindeyu") echo "selected"?>>Canindeyú</option>
                    <option value="presidente_hayes" <?php if($departamento == "presidente_hayes") echo "selected"?>>Presidente Hayes</option>
                    <option value="boqueron" <?php if($departamento == "boqueron") echo "selected"?>>Boquerón</option>
                    <option value="alto_paraguay"<?php if($departamento == "alto_paraguay") echo "selected"?>>Alto Paraguay</option>
                </select>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="ciudad">Ciudad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="ciudad" name="ciudad" value="<?php echo $ciudad ?>" placeholder="Ingrese la ciudad del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="direccion">Dirección &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="direccion" name="direccion" value="<?php echo $direccion ?>" placeholder="Ingrese al dirección del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="telefono">Telefono &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono ?>" placeholder="Ingrese el numero de telefono del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="celular">Celular &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="tel" id="celular" name="celular" value="<?php echo $celular ?>" placeholder="Ingrese el numero de celular del paciente..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns end">
              <label for="establecimiento">Establecimiento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="establecimiento" name="establecimiento" value="<?php echo $establecimiento ?>" placeholder="Ingrese el establecimiento..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>


          </fieldset>
        </form>
  </div>
</div>
<!-- fin de crear-editar paciente -->

