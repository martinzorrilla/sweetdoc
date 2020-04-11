<?php

  //get data from template if any
  //$patient_id = "new";
  $patient_id = $template_args["patient_id"];
  $app_id = $template_args["app_id"];
  $studies_id = $template_args["studies_id"];
  $is_editable = $template_args["is_editable"];
  //$is_editable = "true";
  $studies_fields = get_post_custom($studies_id);
  //$egcv = $studies_fields['egcv'][0];

  // ACF FIELDS DATA --------------------------------------------
  $checkbox_egcv = get_field('egcv', $studies_id);
  $egcv_dx = $studies_fields['egcv_dx'][0];

  $checkbox_egva = get_field('egva', $studies_id);
  $egva_dx = $studies_fields['egva_dx'][0];
  
  $checkbox_ea = get_field('ea', $studies_id);
  $ea_dx = $studies_fields['ea_dx'][0];
  
  $checkbox_ecografia_renal = get_field('ecografia_renal', $studies_id);
  $er_dx = $studies_fields['er_dx'][0];
  
  $checkbox_mdb = get_field('mdb', $studies_id);
  $mdb_dx = $studies_fields['mdb_dx'][0];
  
  $checkbox_ecografia_mamaria = get_field('ecografia_mamaria', $studies_id);
  $em_dx = $studies_fields['em_dx'][0];
  
  $checkbox_ecografia_obstetrica = get_field('ecografia_obstetrica', $studies_id);
  $eo_dx = $studies_fields['eo_dx'][0];
  
  $checkbox_eodfp = get_field('eodfp', $studies_id);
  $eodfp_dx = $studies_fields['eodfp_dx'][0];

  $checkbox_emdm = get_field('emdm', $studies_id);
  $emdm_dx = $studies_fields['emdm_dx'][0];
  
  $checkbox_eomcdm = get_field('eomcdm', $studies_id);
  $eomcdm_dx = $studies_fields['eomcdm_dx'][0];
  
  $checkbox_colposcopia_st = get_field('colposcopia_st', $studies_id);
  $colposcopia_dx = $studies_fields['colposcopia_st_dx'][0];
  
  $checkbox_lec_st = get_field('lec_st', $studies_id);
  $lec_dx = $studies_fields['lec_st_dx'][0];
  
  $checkbox_desintometria_osea = get_field('desintometria_osea', $studies_id);
  $do_dx = $studies_fields['desintometria_osea_dx'][0];
  
  $checkbox_rtpa = get_field('rtpa', $studies_id);
  $rtpa_dx = $studies_fields['rtpa_dx'][0];
  
  $checkbox_electrocardiograma = get_field('electrocardiograma', $studies_id);
  $electrocardiograma_dx = $studies_fields['electrocardiograma_dx'][0];
  
  $checkbox_tapc = get_field('tapc', $studies_id);
  $tapc_dx = $studies_fields['tapc_dx'][0];
  
  $checkbox_tsts = get_field('tsts', $studies_id);
  $tsts_dx = $studies_fields['tsts_dx'][0];
  
  $checkbox_tstc = get_field('tstc', $studies_id);
  $tstc_dx = $studies_fields['tstc_dx'][0];
  
  $checkbox_emba = get_field('emba', $studies_id);
  $emba_dx = $studies_fields['emba_dx'][0];
  
  $checkbox_pbf = get_field('pbf', $studies_id);
  $pbf_dx = $studies_fields['pbf_dx'][0];
  
  $checkbox_pbfdfp = get_field('pbfdfp', $studies_id);
  $pbfdfp = $studies_fields['pbfdfp'][0];
  
  $checkbox_mfne = get_field('mfne', $studies_id);
  $mfne_dx = $studies_fields['mfne_dx'][0];
  
  $checkbox_pyc = get_field('pyc', $studies_id);
  $pyc_dx = $studies_fields['pyc_dx'][0];
  
  $checkbox_bcl = get_field('bcl', $studies_id);
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
  <div class="card profile-card-action-icons">
      <div class="card-section">
          
          <div class="profile-card-about large-12 columns">
            <h5 class="about-title separator-left"> Ingresar los estudios a solicitar <?php //echo $name?></h5>


    <form id="create-studies-form" name="create-studies-form" method="post" >
          <input type="hidden" name="action" value="sw_create_studies_ajax">
          <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          
          <fieldset row>





          <!-- checkbox_egcv-->
          <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
              <label class="separator-left"> Ecografía ginecológica transvaginal</label>
                  <input type="checkbox" id="egcv_si" name="egcv[]" value="egcv_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                  <?php 
                  if( $checkbox_egcv != NULL || $checkbox_egcv != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                    if(in_array("egcv_si", $checkbox_egcv)) echo "checked";
                  }
                  ?> >
                  <label for="egcv_si">Si</label>
          </div>  
            <div class="floated-label-wrapper large-6 columns">
              <label class="separator-left" for="egcv_dx">Descripción</label>
              <input type="text" id="egcv_dx" name="egcv_dx" value="<?php echo $egcv_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
            </div>









          </fieldset>
        </form>
  </div>

  </div>
  </div>
  </div>


</div>
<!-- fin de crear-editar paciente -->

