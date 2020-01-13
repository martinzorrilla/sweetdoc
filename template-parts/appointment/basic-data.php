<?php

// si el argumento es valido, aceptarlo, sino forzarlo a que sea string vacio
//$patient_id = $template_args["patient_id"] !="" && $template_args["patient_id"] !=NULL ? $template_args["patient_id"] : "";

  //get data from template if any
  $patient_id = $template_args["patient_id"];
  
  //load all the data we need from the Patient Post
  $patient_fields = get_post_custom($patient_id);
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  $cedula = $patient_fields['cedula'][0];
  $email_paciente = $patient_fields['email_paciente'][0];

  //$fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0];
  $fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0] !="" && $patient_fields['fecha_de_nacimiento'][0] !=NULL ? $patient_fields['fecha_de_nacimiento'][0] : "";
  $newDate = "";
  //acf retoran la fecha asi:20191128 en vez de 2019-11-28 que es como el input[date] requiere
  if ($fecha_de_nacimiento != ""){ $newDate = date("Y-m-d", strtotime($fecha_de_nacimiento));}

  $departamento = $patient_fields['departamento'][0];
  $ciudad = $patient_fields['ciudad'][0];
  $direccion = $patient_fields['direccion'][0];

  var_dump($departamento);
  



  $fullname = $name.' '.$lastname;
 ?> 

<!-- crear-editar paciente -->
<div class="form-tab-style">

  <!-- agregar la clase white-tab a la clase tab y tabcontent para modificar el color del fichero -->
  <!-- <div class="tab white-tab"> -->
  <div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'London')">Datos Básicos</button>
  </div>

  <!-- <div class="appform tabcontent white-tab"> -->
  <div class="appform tabcontent">
    <form id="create-patient-form" name="create-patient-form" method="post" >
          <fieldset row>
            <div class="floated-label-wrapper large-6 columns">
              <label for="nombre">Nombre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_name" name="patient_name" value="<?php echo $name ?>" placeholder="Ingrese el nombre del paciente..." required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="apellido">Apellido &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_last_name" name="patient_last_name" value="<?php echo $lastname ?>" placeholder="Ingrese el apellido del paciente..." required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="cedula">Cedula &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_ci" name="patient_ci" value="<?php echo $cedula ?>" placeholder="Ingrese el documento del paciente..." required>
            </div>

            <!-- email del paciente -->
            <div class="floated-label-wrapper large-6 columns">
              <label for="email">email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="email" id="email_paciente" name="email_paciente" value="<?php echo $email_paciente ?>" placeholder="Ingrese el email del paciente..." required>
            </div>

            <!-- Fecha de nacimiento del paciente -->
            <div class="floated-label-wrapper large-6 columns">
              <label for="fecha_de_nacimiento">Fecha de nacimiento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="date" id="fecha_de_nacimiento" name="fecha_de_nacimiento" value="<?php echo $newDate ?>" >
            </div>

            <!-- Departamento del paciente -->
            <div class="floated-label-wrapper large-6 columns">
              <label for="departamento">Departamento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <select name="departamento">
                    <option value="guaira">Guaira</option>
                    <option value="concepcion">Concepción</option>
                    <option value="san_pedro">San Pedro</option>
                    <option value="cordillera">Cordillera</option>
                    <option value="caaguazu">Caaguazú</option>
                    <option value="caazapa">Caazapá</option>
                    <option value="itapua ">Itapúa</option>
                    <option value="misiones">Misiones</option>
                    <option value="paraguari">Paraguarí</option>
                    <option value="alto_parana">Alto Paraná</option>
                    <option value="central">Central</option>
                    <option value="neembucu">Ñeembucú</option>
                    <option value="amambay">Amambay</option>
                    <option value="canindeyu">Canindeyú</option>
                    <option value="presidente_hayes ">Presidente Hayes</option>
                    <option value="boqueron">Boquerón</option>
                    <option value="alto_paraguay">Alto Paraguay</option>
                </select>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="ciudad">Ciudad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="ciudad" name="ciudad" value="<?php echo $ciudad ?>" placeholder="Ingrese la ciudad del paciente..." required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="direccion">Dirección &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="direccion" name="direccion" value="<?php echo $direccion ?>" placeholder="Ingrese al dirección del paciente..." required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <legend>Metodo anticonceptivo actual</legend>
                <div>
                  <input type="checkbox" id="inyectable" name="metodo_anticonceptivo" value="inyectable">
                  <label for="inyectable">Inyectable</label>
                </div>
                <div>
                  <input type="checkbox" id="preservativos" name="metodo_anticonceptivo" value="preservativos">
                  <label for="preservativos">Preservativos</label>
                </div>
            </div>
            <!-- <div class="floated-label-wrapper large-12 columns text-center">
              <button id="create-patient" class="submit_button save-button-expanded" type="submit" value="create-patient">Crear</button>
              <p class="errorWrapper">
              </p>
            </div> -->

            <div class="floated-label-wrapper large-12 columns text-center" style="padding-top: 1rem;">
              <button id="create-patient" class="submit_button save-button-expanded" type="submit" value="create-patient">
              <i class="fas fa-save fa-lg"></i><span class="app-dashboard-sidebar-text"></span>
              </button>
              <p class="errorWrapper">
              </p>
            </div>

          </fieldset>
        </form>
  </div>
</div>
<!-- fin de crear-editar paciente -->

