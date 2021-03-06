<?php

  //get data from template if any
  //$patient_id = "new";
  $patient_id = $template_args["patient_id"];
  $app_id = $template_args["app_id"];
  $indication_id = $template_args["indication_id"];
  $is_editable = $template_args["is_editable"];
  //$is_editable = "true";
  $indication_fields = get_post_custom($indication_id);
  // $rp = $indication_fields['rp'][0];
  $rp = isset($indication_fields['rp'][0]) ? $indication_fields['rp'][0] : NULL;
  // $indicaciones = $indication_fields['indicaciones'][0];
  $indicaciones = isset($indication_fields['indicaciones'][0]) ? $indication_fields['indicaciones'][0] : NULL;
?> 

  <!-- agregar la clase white-tab a la clase tab y tabcontent para modificar el color del fichero -->
  <!-- <div class="tab white-tab"> -->
  <div class="tab">
    <button class="tablinks dabbed" >Indicación</button>
  </div>

  <!-- //patient cambiar por indication aca y en el js que le corresponde -->
  <!-- <div class="appform tabcontent white-tab"> -->
  <div class="appform tabcontent">
    <form id="create-indication-form" name="create-indication-form" method="post" >
          <input type="hidden" name="action" value="sw_create_indication_ajax">
          <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          <fieldset row>
            <div class="floated-label-wrapper large-6 columns">
              <label for="rp">R.P. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <!-- <input type="text" id="rp" name="rp" value="< ?php echo $rp ?>" placeholder="Escribir..." class="disableable-input" < ?php if($is_editable == "false")  echo "disabled"; ?> required> -->
              <textarea id="rp" name="rp" placeholder="Escribir..." style="height:15em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $rp ?></textarea>           
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="indicaciones">Indicaciónes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <!-- <input type="text" id="indicaciones" name="indicaciones" value="< ?php echo $indicaciones ?>" placeholder="Escribir..." class="disableable-input" < ?php if($is_editable == "false")  echo "disabled"; ?> required> -->
              <textarea id="indicaciones" name="indicaciones" placeholder="Escribir..." style="height:15em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $indicaciones ?></textarea>           
            </div>

          </fieldset>
        </form>
  </div>

