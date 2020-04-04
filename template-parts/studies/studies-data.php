<?php

  //get data from template if any
  //$patient_id = "new";
  //$patient_id = $template_args["patient_id"];
  $app_id = $template_args["app_id"];
  $studies_id = $template_args["studies_id"];
  $is_editable = $template_args["is_editable"];
  //$is_editable = "true";
  $studies_fields = get_post_custom($studies_id);
  $egcv = $studies_fields['egcv'][0];
  $egcv_dx = $studies_fields['egcv_dx'][0];
 ?> 

<!-- creo que este div no es necesario para que funcione correctamente el form del paciente -->
<div class="form-tab-style">

  <!-- agregar la clase white-tab a la clase tab y tabcontent para modificar el color del fichero -->
  <!-- <div class="tab white-tab"> -->
  <div class="tab">
    <button class="tablinks active" >Estudios</button>
  </div>


  <!-- <div class="appform tabcontent white-tab"> -->
  <div class="appform tabcontent">
    <form id="create-studies-form" name="create-studies-form" method="post" >
          <input type="hidden" name="action" value="sw_create_studies_ajax">
          <!-- <input type="hidden" name="patient_id" value="<?php //echo $patient_id;?>"> -->
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          <fieldset row>
            <div class="floated-label-wrapper large-6 columns">
              <label for="egcv">egcv &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="egcv" name="egcv" value="<?php echo $egcv ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="egcv_dx">egcv_dx &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="egcv_dx" name="egcv_dx" value="<?php echo $egcv_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>

          </fieldset>
        </form>
  </div>
</div>
<!-- fin de crear-editar paciente -->

