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

  
  $egva = $studies_fields['egva'][0];
  
  $egva_dx = $studies_fields['egva_dx'][0];
  
  $ea = $studies_fields['ea'][0];
  
  $ea_dx = $studies_fields['ea_dx'][0];
  
  $ecografia_renal = $studies_fields['ecografia_renal'][0];
  
  $er_dx = $studies_fields['er_dx'][0];
  
  $mdb = $studies_fields['mdb'][0];
  
  $mdb_dx = $studies_fields['mdb_dx'][0];
  
  $ecografia_mamaria = $studies_fields['ecografia_mamaria'][0];
  
  $em_dx = $studies_fields['em_dx'][0];
  
  $ecografia_obstetrica = $studies_fields['ecografia_obstetrica'][0];
  
  $eo_dx = $studies_fields['eo_dx'][0];
  
  $eodfp = $studies_fields['eodfp'][0];
  
  $eodfp_dx = $studies_fields['eodfp_dx'][0];
  
  $emdm = $studies_fields['emdm'][0];
  
  $emdm_dx = $studies_fields['emdm_dx'][0];
  
  $eomcdm = $studies_fields['eomcdm'][0];
  
  $eomcdm_dx = $studies_fields['eomcdm_dx'][0];
  
  $colposcopia = $studies_fields['colposcopia'][0];
  
  $colposcopia_dx = $studies_fields['colposcopia_dx'][0];
  
  $lec = $studies_fields['lec'][0];
  
  $lec_dx = $studies_fields['lec_dx'][0];
  
  $desintometria_osea = $studies_fields['desintometria_osea'][0];
  
  $do_dx = $studies_fields['do_dx'][0];
  
  $rtpa = $studies_fields['rtpa'][0];
  
  $rtpa_dx = $studies_fields['egcv_dx'][0];
  
  $electrocardiograma = $studies_fields['electrocardiograma'][0];
  
  $electrocardiograma_dx = $studies_fields['electrocardiograma_dx'][0];
  
  $tapc = $studies_fields['tapc'][0];
  
  $tapc_dx = $studies_fields['tapc_dx'][0];
  
  $tsts = $studies_fields['tsts'][0];
  
  $tsts_dx = $studies_fields['tsts_dx'][0];
  
  $tstc = $studies_fields['tstc'][0];
  
  $tstc_dx = $studies_fields['tstc_dx'][0];
  
  $emba = $studies_fields['emba'][0];
  
  $emba_dx = $studies_fields['emba_dx'][0];
  
  $pbf = $studies_fields['pbf'][0];
  
  $pbf_dx = $studies_fields['pbf_dx'][0];
  
  $pbfdfp = $studies_fields['pbfdfp'][0];
  
  $pbfdfp_dx = $studies_fields['pbfdfp_dx'][0];
  
  $mfne = $studies_fields['mfne'][0];
  
  $mfne_dx = $studies_fields['mfne_dx'][0];
  
  $pyc = $studies_fields['pyc'][0];
  
  $pyc_dx = $studies_fields['pyc_dx'][0];
  
  $bcl = $studies_fields['bcl'][0];
  
  $bcl_dx = $studies_fields['bcl_dx'][0];



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

