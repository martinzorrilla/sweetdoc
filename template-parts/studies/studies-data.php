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
  
  $checkbox_ea_st = get_field('ea_st', $studies_id);
  $ea_st_dx = $studies_fields['ea_st_dx'][0];
  
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
  $colposcopia_st_dx = $studies_fields['colposcopia_st_dx'][0];
  
  $checkbox_lec_st = get_field('lec_st', $studies_id);
  $lec_st_dx = $studies_fields['lec_st_dx'][0];
  
  $checkbox_desintometria_osea = get_field('desintometria_osea', $studies_id);
  $desintometria_osea_dx = $studies_fields['desintometria_osea_dx'][0];
  
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
  $pbfdfp_dx = $studies_fields['pbfdfp_dx'][0];
  
  $checkbox_mfne = get_field('mfne', $studies_id);
  $mfne_dx = $studies_fields['mfne_dx'][0];
  
  $checkbox_pyc = get_field('pyc', $studies_id);
  $pyc_dx = $studies_fields['pyc_dx'][0];
  
  $checkbox_bcl = get_field('bcl', $studies_id);
  $bcl_dx = $studies_fields['bcl_dx'][0];

  $otros_st = $studies_fields['otros_st'][0];

  

 ?> 



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
                    <div class="floated-label-wrapper small-12 large-6 columns">
                      <label class="separator-left" for="egcv_dx">Descripción</label>
                      <input type="text" id="egcv_dx" name="egcv_dx" value="<?php echo $egcv_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                    </div>


                  <!-- checkbox_egva-->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Ecografía ginecológica vía abdominal </label>
                          <input type="checkbox" id="egva_si" name="egva[]" value="egva_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_egva != NULL || $checkbox_egva != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("egva_si", $checkbox_egva)) echo "checked";
                          }
                          ?> >
                          <label for="egva_si">Si</label>
                  </div>  
                    <div class="floated-label-wrapper small-12 large-6 columns">
                      <label class="separator-left" for="egva_dx">Descripción</label>
                      <input type="text" id="egva_dx" name="egva_dx" value="<?php echo $egva_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                    </div>

                  <!-- checkbox_Ecografía abdominal-->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Ecografía abdominal </label>
                          <input type="checkbox" id="ea_st" name="ea_st[]" value="ea_st_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_ea_st != NULL || $checkbox_ea_st != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("ea_st_si", $checkbox_ea_st)) echo "checked";
                          }
                          ?> >
                          <label for="ea_st">Si</label>
                  </div>  
                    <div class="floated-label-wrapper small-12 large-6 columns">
                      <label class="separator-left" for="ea_st_dx">Descripción</label>
                      <input type="text" id="ea_st_dx" name="ea_st_dx" value="<?php echo $ea_st_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                    </div>


                  <!-- checkbox_Ecografía renal-->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Ecografía renal </label>
                          <input type="checkbox" id="ecografia_renal" name="ecografia_renal[]" value="ecografia_renal_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_ecografia_renal != NULL || $checkbox_ecografia_renal != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("ecografia_renal_si", $checkbox_ecografia_renal)) echo "checked";
                          }
                          ?> >
                          <label for="ecografia_renal">Si</label>
                  </div>  
                    <div class="floated-label-wrapper small-12 large-6 columns">
                      <label class="separator-left" for="er_dx">Descripción</label>
                      <input type="text" id="er_dx" name="er_dx" value="<?php echo $er_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                    </div>


                  <!-- checkbox_Mamografía digital bilateral-->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Mamografía digital bilateral </label>
                          <input type="checkbox" id="mdb" name="mdb[]" value="mdb_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_mdb != NULL || $checkbox_mdb != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("mdb_si", $checkbox_mdb)) echo "checked";
                          }
                          ?> >
                          <label for="mdb">Si</label>
                  </div>  
                    <div class="floated-label-wrapper small-12 large-6 columns">
                      <label class="separator-left" for="mdb_dx">Descripción</label>
                      <input type="text" id="mdb_dx" name="mdb_dx" value="<?php echo $mdb_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                    </div>

                  <!-- checkbox_Ecografía mamaria-->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Ecografía mamaria </label>
                          <input type="checkbox" id="ecografia_mamaria" name="ecografia_mamaria[]" value="ecografia_mamaria_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_ecografia_mamaria != NULL || $checkbox_ecografia_mamaria != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("ecografia_mamaria_si", $checkbox_ecografia_mamaria)) echo "checked";
                          }
                          ?> >
                          <label for="ecografia_mamaria">Si</label>
                  </div>  
                    <div class="floated-label-wrapper small-12 large-6 columns">
                      <label class="separator-left" for="em_dx">Descripción</label>
                      <input type="text" id="em_dx" name="em_dx" value="<?php echo $em_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                    </div>

                  <!-- checkbox_Ecografía obstétricaa-->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Ecografía obstétrica </label>
                          <input type="checkbox" id="ecografia_obstetrica" name="ecografia_obstetrica[]" value="ecografia_obstetrica_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_ecografia_obstetrica != NULL || $checkbox_ecografia_obstetrica != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("ecografia_obstetrica_si", $checkbox_ecografia_obstetrica)) echo "checked";
                          }
                          ?> >
                          <label for="ecografia_obstetrica">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="eo_dx">Descripción</label>
                    <input type="text" id="eo_dx" name="eo_dx" value="<?php echo $eo_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_Ecografía obstétrica + Doppler fetal y placentario-->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Ecografía obstétrica + Doppler fetal y placentario </label>
                          <input type="checkbox" id="eodfp" name="eodfp[]" value="eodfp_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_eodfp != NULL || $checkbox_eodfp != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("eodfp_si", $checkbox_eodfp)) echo "checked";
                          }
                          ?> >
                          <label for="eodfp">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="eodfp_dx">Descripción</label>
                    <input type="text" id="eodfp_dx" name="eodfp_dx" value="<?php echo $eodfp_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_Ecografía morfológica + Doppler materno-->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Ecografía morfológica + Doppler materno </label>
                          <input type="checkbox" id="emdm" name="emdm[]" value="emdm_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_emdm != NULL || $checkbox_emdm != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("emdm_si", $checkbox_emdm)) echo "checked";
                          }
                          ?> >
                          <label for="emdm">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="emdm_dx">Descripción</label>
                    <input type="text" id="emdm_dx" name="emdm_dx" value="<?php echo $emdm_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Ecografía obstétrica para marcadores cromosomicos + Doppler materno -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Marcadores cromosomicos + Doppler materno </label>
                          <input type="checkbox" id="eomcdm" name="eomcdm[]" value="eomcdm_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_eomcdm != NULL || $checkbox_eomcdm != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("eomcdm_si", $checkbox_eomcdm)) echo "checked";
                          }
                          ?> >
                          <label for="eomcdm">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="eomcdm_dx">Descripción</label>
                    <input type="text" id="eomcdm_dx" name="eomcdm_dx" value="<?php echo $eomcdm_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Colposcopía -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Colposcopía </label>
                          <input type="checkbox" id="colposcopia_st" name="colposcopia_st[]" value="colposcopia_st_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_colposcopia_st != NULL || $checkbox_colposcopia_st != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("colposcopia_st_si", $checkbox_colposcopia_st)) echo "checked";
                          }
                          ?> >
                          <label for="colposcopia_st">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="colposcopia_st_dx">Descripción</label>
                    <input type="text" id="colposcopia_st_dx" name="colposcopia_st_dx" value="<?php echo $colposcopia_st_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ LEC -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> LEC </label>
                          <input type="checkbox" id="lec_st" name="lec_st[]" value="lec_st_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_lec_st != NULL || $checkbox_lec_st != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("lec_st_si", $checkbox_lec_st)) echo "checked";
                          }
                          ?> >
                          <label for="lec_st">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="lec_st_dx">Descripción</label>
                    <input type="text" id="lec_st_dx" name="lec_st_dx" value="<?php echo $lec_st_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Desintometría Ósea -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Desintometría Ósea </label>
                          <input type="checkbox" id="desintometria_osea" name="desintometria_osea[]" value="desintometria_osea_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_desintometria_osea != NULL || $checkbox_desintometria_osea != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("desintometria_osea_si", $checkbox_desintometria_osea)) echo "checked";
                          }
                          ?> >
                          <label for="desintometria_osea">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="desintometria_osea_dx">Descripción</label>
                    <input type="text" id="desintometria_osea_dx" name="desintometria_osea_dx" value="<?php echo $desintometria_osea_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Radiografía de tórax P.A. -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Radiografía de tórax P.A. </label>
                          <input type="checkbox" id="rtpa" name="rtpa[]" value="rtpa_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_rtpa != NULL || $checkbox_rtpa != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("rtpa_si", $checkbox_rtpa)) echo "checked";
                          }
                          ?> >
                          <label for="rtpa">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="rtpa_dx">Descripción</label>
                    <input type="text" id="rtpa_dx" name="rtpa_dx" value="<?php echo $rtpa_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Electrocardiograma -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Electrocardiograma </label>
                          <input type="checkbox" id="electrocardiograma" name="electrocardiograma[]" value="electrocardiograma_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_electrocardiograma != NULL || $checkbox_electrocardiograma != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("electrocardiograma_si", $checkbox_electrocardiograma)) echo "checked";
                          }
                          ?> >
                          <label for="electrocardiograma">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="electrocardiograma_dx">Descripción</label>
                    <input type="text" id="electrocardiograma_dx" name="electrocardiograma_dx" value="<?php echo $electrocardiograma_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Tomografía abdomen y pelvis con contraste -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Tomografía abdomen y pelvis con contraste </label>
                          <input type="checkbox" id="tapc" name="tapc[]" value="tapc_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_tapc != NULL || $checkbox_tapc != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("tapc_si", $checkbox_tapc)) echo "checked";
                          }
                          ?> >
                          <label for="tapc">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="tapc_dx">Descripción</label>
                    <input type="text" id="tapc_dx" name="tapc_dx" value="<?php echo $tapc_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ TAC de silla turca simple -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> TAC de silla turca simple </label>
                          <input type="checkbox" id="tsts" name="tsts[]" value="tsts_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_tsts != NULL || $checkbox_tsts != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("tsts_si", $checkbox_tsts)) echo "checked";
                          }
                          ?> >
                          <label for="tsts">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="tsts_dx">Descripción</label>
                    <input type="text" id="tsts_dx" name="tsts_dx" value="<?php echo $tsts_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Ecografía mamaria bilateral + axilar -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Ecografía mamaria bilateral + axilar </label>
                          <input type="checkbox" id="emba" name="emba[]" value="emba_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_emba != NULL || $checkbox_emba != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("emba_si", $checkbox_emba)) echo "checked";
                          }
                          ?> >
                          <label for="emba">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="emba_dx">Descripción</label>
                    <input type="text" id="emba_dx" name="emba_dx" value="<?php echo $emba_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Perfil biofísico fetal -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Perfil biofísico fetal </label>
                          <input type="checkbox" id="pbf" name="pbf[]" value="pbf_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_pbf != NULL || $checkbox_pbf != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("pbf_si", $checkbox_pbf)) echo "checked";
                          }
                          ?> >
                          <label for="pbf">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="pbf_dx">Descripción</label>
                    <input type="text" id="pbf_dx" name="pbf_dx" value="<?php echo $pbf_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Perfil biofísico fetal + doppler fetal y placentario -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Perfil biofísico fetal + doppler fetal y placentario </label>
                          <input type="checkbox" id="pbfdfp" name="pbfdfp[]" value="pbfdfp_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_pbfdfp != NULL || $checkbox_pbfdfp != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("pbfdfp_si", $checkbox_pbfdfp)) echo "checked";
                          }
                          ?> >
                          <label for="pbfdfp">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="pbfdfp_dx">Descripción</label>
                    <input type="text" id="pbfdfp_dx" name="pbfdfp_dx" value="<?php echo $pbfdfp_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Monitoreo fetal no estresante -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Monitoreo fetal no estresante </label>
                          <input type="checkbox" id="mfne" name="mfne[]" value="mfne_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_mfne != NULL || $checkbox_mfne != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("mfne_si", $checkbox_mfne)) echo "checked";
                          }
                          ?> >
                          <label for="mfne">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="mfne_dx">Descripción</label>
                    <input type="text" id="mfne_dx" name="mfne_dx" value="<?php echo $mfne_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ PAP + Colposcopía -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> PAP + Colposcopía </label>
                          <input type="checkbox" id="pyc" name="pyc[]" value="pyc_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_pyc != NULL || $checkbox_pyc != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("pyc_si", $checkbox_pyc)) echo "checked";
                          }
                          ?> >
                          <label for="pyc">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="pyc_dx">Descripción</label>
                    <input type="text" id="pyc_dx" name="pyc_dx" value="<?php echo $pyc_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- checkbox_ Biopsia cervical + LEC -->
                  <div class="floated-label-wrapper small-12 large-6 columns checkbox-radio text-left ">
                      <label class="separator-left"> Biopsia cervical + LEC </label>
                          <input type="checkbox" id="bcl" name="bcl[]" value="bcl_si" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                          <?php 
                          if( $checkbox_bcl != NULL || $checkbox_bcl != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                            if(in_array("bcl_si", $checkbox_bcl)) echo "checked";
                          }
                          ?> >
                          <label for="bcl">Si</label>
                  </div>  
                  <div class="floated-label-wrapper small-12 large-6 columns">
                    <label class="separator-left" for="bcl_dx">Descripción</label>
                    <input type="text" id="bcl_dx" name="bcl_dx" value="<?php echo $bcl_dx ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  <!-- otros estudios -->
                  <div class="floated-label-wrapper small-12 large-12 columns">
                    <label class="separator-left" for="otros_st">Otros estudios</label>
                    <input type="text" id="otros_st" name="otros_st" value="<?php echo $otros_st ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                  </div>

                  </fieldset>
            </form>
        </div>
      </div>
    </div>
  </div>



