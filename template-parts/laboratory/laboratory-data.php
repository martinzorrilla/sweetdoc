<?php

  //get data from template if any
  //$patient_id = "new";
  $patient_id = $template_args["patient_id"];
  $app_id = $template_args["app_id"];
  $laboratories_id = $template_args["laboratories_id"];
  $is_editable = $template_args["is_editable"];
  //$is_editable = "true";
  $laboratories_fields = get_post_custom($laboratories_id);
  $lab1 = $laboratories_fields['lab1'][0];
  $lab2 = $laboratories_fields['lab2'][0];


 ?> 

<!-- creo que este div no es necesario para que funcione correctamente el form del paciente -->
<div class="form-tab-style">

  <!-- agregar la clase white-tab a la clase tab y tabcontent para modificar el color del fichero -->
  <!-- <div class="tab white-tab"> -->
  <div class="tab">
    <button class="tablinks active" >Laboratorios</button>
  </div>


  <!-- <div class="appform tabcontent white-tab"> -->
  <div class="appform tabcontent">
    <form id="create-laboratories-form" name="create-laboratories-form" method="post" >
          <input type="hidden" name="action" value="sw_create_laboratories_ajax">
          <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          <fieldset row>
            <div class="floated-label-wrapper large-6 columns">
              <label for="lab1">lab1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="lab1" name="lab1" value="<?php echo $lab1 ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="lab2">lab2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="lab2" name="lab2" value="<?php echo $lab2 ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

          </fieldset>
        </form>
  </div>
</div>
<!-- fin de crear-editar paciente -->

