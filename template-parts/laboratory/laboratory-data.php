<?php

  //get data from template if any
  //$patient_id = "new"; 
  $patient_id = $template_args["patient_id"];
  $app_id = $template_args["app_id"];
  $laboratories_id = $template_args["laboratories_id"];
  $is_editable = $template_args["is_editable"];
  //$is_editable = "true";
  $laboratories_fields = get_post_custom($laboratories_id);
  
  $hemograma_completo = get_field('hemograma_completo', $laboratories_id);
  $tipificacion = get_field('tipificacion', $laboratories_id);
  $crasis_sanguinea = get_field('crasis_sanguinea', $laboratories_id);
  $test_de_coombs_indirecto = get_field('test_de_coombs_indirecto', $laboratories_id);
  $vdrl = get_field('vdrl', $laboratories_id);
  $if_p_toxoplasmosis = get_field('if_p_toxoplasmosis', $laboratories_id);
  $storch = get_field('storch', $laboratories_id);
  $hbs_ag = get_field('hbs_ag', $laboratories_id);
  $test_de_elisa_hiv = get_field('test_de_elisa_hiv', $laboratories_id);
  $chagas_igg_igm = get_field('chagas_igg_igm', $laboratories_id);
  $igmfta = get_field('igmfta', $laboratories_id);
  $abs = get_field('abs', $laboratories_id);
  $ft4_tsh = get_field('ft4_tsh', $laboratories_id);
  $progesterona = get_field('progesterona', $laboratories_id);
  $estradiol = get_field('estradiol', $laboratories_id);
  $fsh_lab = get_field('fsh_lab', $laboratories_id);
  $lh_lab = get_field('lh_lab', $laboratories_id);
  $bhch_cualitativo = get_field('bhch_cualitativo', $laboratories_id);
  $bhcg_cuantitativo = get_field('bhcg_cuantitativo', $laboratories_id);
  $prolactina = get_field('prolactina', $laboratories_id);
  $testosterona_libre = get_field('testosterona_libre', $laboratories_id);
  $androstenediona = get_field('androstenediona', $laboratories_id);
  $dhea_lab = get_field('dhea_lab', $laboratories_id);
  $amh_lab = get_field('amh_lab', $laboratories_id);
  $simple_lab = get_field('simple_lab', $laboratories_id);
  $cultivo_y_antibiograma = get_field('cultivo_y_antibiograma', $laboratories_id);
  $proteina_24hs = get_field('proteina_24hs', $laboratories_id);
  $vermes_y_protozoarios = get_field('vermes_y_protozoarios', $laboratories_id);
  $cya_heces = get_field('cya_heces', $laboratories_id);
  $sangre_oculta = get_field('sangre_oculta', $laboratories_id);
  $glicemia_en_ayunas = get_field('glicemia_en_ayunas', $laboratories_id);
  $ttgo = get_field('ttgo', $laboratories_id);
  $urea = get_field('urea', $laboratories_id);
  $creatinina = get_field('creatinina', $laboratories_id);
  $ac_urico = get_field('ac_urico', $laboratories_id);
  $colesterol_vhl = get_field('colesterol_vhl', $laboratories_id);
  $trigliceridos = get_field('trigliceridos', $laboratories_id);
  $lipidos_totales = get_field('lipidos_totales', $laboratories_id);
  $hepatograma = get_field('hepatograma', $laboratories_id);
  $proteinas_tyf = get_field('proteinas_tyf', $laboratories_id);
  
  $proteinas_tyfca_125 = get_field('proteinas_tyfca_125', $laboratories_id);
  $ca_125 = get_field('ca_125', $laboratories_id);
  $cea_lab = get_field('cea_lab', $laboratories_id);
  $ca_15_3 = get_field('ca_15_3', $laboratories_id);
  $pyrilinksd = get_field('pyrilinksd', $laboratories_id);
  $alfa_fetos_proteinas = get_field('alfa_fetos_proteinas', $laboratories_id);
  $fta_abs = get_field('fta_abs', $laboratories_id);
  $pcr_lab = get_field('pcr_lab', $laboratories_id);
  $factor_reumatoideo = get_field('factor_reumatoideo', $laboratories_id);
  $lupus_anticoagulante = get_field('lupus_anticoagulante', $laboratories_id);
  $ac_antinucleares = get_field('ac_antinucleares', $laboratories_id);
  $monotest = get_field('monotest', $laboratories_id);
  $ac_anti_dna = get_field('ac_anti_dna', $laboratories_id);
  $ac_antifosfolípidos = get_field('ac_antifosfolípidos', $laboratories_id);
  $vitamina_d25oh = get_field('vitamina_d25oh', $laboratories_id);
  $espermograma_biquimico = get_field('espermograma_biquimico', $laboratories_id);
  $simple_espermograma = get_field('simple_espermograma', $laboratories_id);
  $cya_espermograma = get_field('cya_espermograma', $laboratories_id);
  $vaginal_cultivo = get_field('vaginal_cultivo', $laboratories_id);
  $endocervical_cultivo = get_field('endocervical_cultivo', $laboratories_id);
  $cultivo_de_chla = get_field('cultivo_de_chla', $laboratories_id);

  // $otros_laboratorios = $laboratories_fields['otros_laboratorios'][0];
  $otros_laboratorios = isset($laboratories_fields['otros_laboratorios'][0]) ? $laboratories_fields['otros_laboratorios'][0] : NULL;
  // $diagnostico_laboratorios = $laboratories_fields['diagnostico_laboratorios'][0];
  $diagnostico_laboratorios = isset($laboratories_fields['diagnostico_laboratorios'][0]) ? $laboratories_fields['diagnostico_laboratorios'][0] : NULL;
  

 ?> 


  <!-- agregar la clase white-tab a la clase tab y tabcontent para modificar el color del fichero -->
  <!-- <div class="tab white-tab"> -->
  <div class="tab">
    <button class="tablinks active" >Laboratorios</button>
  </div>





  <!-- <div class="appform tabcontent white-tab"> -->
  <div class="appform tabcontent">
    <div class="card profile-card-action-icons">
      <div class="card-section">
        <div class="profile-card-about large-12 columns">
            <h5 class="about-title separator-left"> Marque los laboratorios a solicitar <?php //echo $name?></h5>
            <form id="create-laboratories-form" name="create-laboratories-form" method="post" >
                  <input type="hidden" name="action" value="sw_create_laboratories_ajax">
                  <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
                  <input type="hidden" name="app_id" value="<?= $app_id?>">

                  <!-- contenedor de columnas -->
                  <div class="row small-up-1 medium-up-1 large-up-2">

                    <!-- columna-A -->
                    <div class="column column-block  text-left">

                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" >HEMATOLOGÍA</h6>

                      <!-- hemograma_completo -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                  
                            <input type="checkbox" id="hemograma_completo" name="hemograma_completo[]" value="hemograma_completo" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $hemograma_completo != NULL || $hemograma_completo != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("hemograma_completo", $hemograma_completo)) echo "checked";
                            }
                            ?> >
                        <label for="hemograma_completo">Hemograma completo</label>
                      </div>

                      <!-- tipificacion -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="tipificacion" name="tipificacion[]" value="tipificacion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $tipificacion != NULL || $tipificacion != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("tipificacion", $tipificacion)) echo "checked";
                            }
                            ?> >
                        <label for="tipificacion">Tipificación</label>
                      </div>

                      <!-- crasis_sanguinea -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="crasis_sanguinea" name="crasis_sanguinea[]" value="crasis_sanguinea" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $crasis_sanguinea != NULL || $crasis_sanguinea != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("crasis_sanguinea", $crasis_sanguinea)) echo "checked";
                            }
                            ?> >
                        <label for="crasis_sanguinea">Crasis sanguinea</label>
                      </div>

                      <!-- test_de_coombs_indirecto -->
                      <div style="margin-bottom: 16px;" class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="test_de_coombs_indirecto" name="test_de_coombs_indirecto[]" value="test_de_coombs_indirecto" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $test_de_coombs_indirecto != NULL || $test_de_coombs_indirecto != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("test_de_coombs_indirecto", $test_de_coombs_indirecto)) echo "checked";
                            }
                            ?> >
                        <label for="test_de_coombs_indirecto">Test de coombs indirecto</label>
                      </div>

                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" > SEROLOGÍA </h6>

                      <!-- vdrl -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="vdrl" name="vdrl[]" value="vdrl" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $vdrl != NULL || $vdrl != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("vdrl", $vdrl)) echo "checked";
                            }
                            ?> >
                        <label for="vdrl">VDRL</label>
                      </div>

                      <!-- if_p_toxoplasmosis -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="if_p_toxoplasmosis" name="if_p_toxoplasmosis[]" value="if_p_toxoplasmosis" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $if_p_toxoplasmosis != NULL || $if_p_toxoplasmosis != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("if_p_toxoplasmosis", $if_p_toxoplasmosis)) echo "checked";
                            }
                            ?> >
                        <label for="if_p_toxoplasmosis">IF p Toxoplasmosis IGG/IGM</label>
                      </div>
                      <!-- storch -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="storch" name="storch[]" value="storch" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $storch != NULL || $storch != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("storch", $storch)) echo "checked";
                            }
                            ?> >
                        <label for="storch">STORCH</label>
                      </div>

                      <!-- hbs_ag -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="hbs_ag" name="hbs_ag[]" value="hbs_ag" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $hbs_ag != NULL || $hbs_ag != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("hbs_ag", $hbs_ag)) echo "checked";
                            }
                            ?> >
                        <label for="hbs_ag">HBS - Ag</label>
                      </div>
                      <!-- test_de_elisa_hiv -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="test_de_elisa_hiv" name="test_de_elisa_hiv[]" value="test_de_elisa_hiv" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $test_de_elisa_hiv != NULL || $test_de_elisa_hiv != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("test_de_elisa_hiv", $test_de_elisa_hiv)) echo "checked";
                            }
                            ?> >
                        <label for="test_de_elisa_hiv">Test de Elisa - HIV</label>
                      </div>
                      <!-- chagas_igg_igm -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="chagas_igg_igm" name="chagas_igg_igm[]" value="chagas_igg_igm" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $chagas_igg_igm != NULL || $chagas_igg_igm != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("chagas_igg_igm", $chagas_igg_igm)) echo "checked";
                            }
                            ?> >
                        <label for="chagas_igg_igm">Chagas IgG - IgM</label>
                      </div>
                      <!-- igmfta -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="igmfta" name="igmfta[]" value="igmfta" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $igmfta != NULL || $igmfta != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("igmfta", $igmfta)) echo "checked";
                            }
                            ?> >
                        <label for="igmfta">IgMFTA</label>
                      </div>
                      <!-- abs -->
                      <div style="margin-bottom: 16px;" class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="abs" name="abs[]" value="abs" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $abs != NULL || $abs != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("abs", $abs)) echo "checked";
                            }
                            ?> >
                        <label for="abs">ABS</label>
                      </div>

                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" > ENDOCRINOLOGÍA </h6>

                      <!-- ft4_tsh -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="ft4_tsh" name="ft4_tsh[]" value="ft4_tsh" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $ft4_tsh != NULL || $ft4_tsh != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("ft4_tsh", $ft4_tsh)) echo "checked";
                            }
                            ?> >
                        <label for="ft4_tsh">Ft4-TSH</label>
                      </div>

                      <!-- progesterona -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="progesterona" name="progesterona[]" value="progesterona" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $progesterona != NULL || $progesterona != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("progesterona", $progesterona)) echo "checked";
                            }
                            ?> >
                        <label for="progesterona">Progesterona</label>
                      </div>

                      <!-- estradiol -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="estradiol" name="estradiol[]" value="estradiol" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $estradiol != NULL || $estradiol != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("estradiol", $estradiol)) echo "checked";
                            }
                            ?> >
                        <label for="estradiol">Estradiol</label>
                      </div>

                      <!-- fsh_lab -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="fsh_lab" name="fsh_lab[]" value="fsh_lab" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $fsh_lab != NULL || $fsh_lab != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("fsh_lab", $fsh_lab)) echo "checked";
                            }
                            ?> >
                        <label for="fsh_lab">FSH</label>
                      </div>

                      <!-- lh_lab -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="lh_lab" name="lh_lab[]" value="lh_lab" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $lh_lab != NULL || $lh_lab != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("lh_lab", $lh_lab)) echo "checked";
                            }
                            ?> >
                        <label for="lh_lab">LH</label>
                      </div>

                      <!-- bhch_cualitativo -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="bhch_cualitativo" name="bhch_cualitativo[]" value="bhch_cualitativo" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $bhch_cualitativo != NULL || $bhch_cualitativo != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("bhch_cualitativo", $bhch_cualitativo)) echo "checked";
                            }
                            ?> >
                        <label for="bhch_cualitativo">BHCH Cualitativo</label>
                      </div>
          
                      <!-- bhcg_cuantitativo -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="bhcg_cuantitativo" name="bhcg_cuantitativo[]" value="bhcg_cuantitativo" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $bhcg_cuantitativo != NULL || $bhcg_cuantitativo != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("bhcg_cuantitativo", $bhcg_cuantitativo)) echo "checked";
                            }
                            ?> >
                        <label for="bhcg_cuantitativo">BHCG Cuantitativo</label>
                      </div>

                      <!-- prolactina -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="prolactina" name="prolactina[]" value="prolactina" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $prolactina != NULL || $prolactina != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("prolactina", $prolactina)) echo "checked";
                            }
                            ?> >
                        <label for="prolactina">Prolactina</label>
                      </div>

                      <!-- testosterona_libre -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="testosterona_libre" name="testosterona_libre[]" value="testosterona_libre" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $testosterona_libre != NULL || $testosterona_libre != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("testosterona_libre", $testosterona_libre)) echo "checked";
                            }
                            ?> >
                        <label for="testosterona_libre">Testosterona Libre</label>
                      </div>

                      <!-- androstenediona -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="androstenediona" name="androstenediona[]" value="androstenediona" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $androstenediona != NULL || $androstenediona != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("androstenediona", $androstenediona)) echo "checked";
                            }
                            ?> >
                        <label for="androstenediona">Androstenediona</label>
                      </div>

                      <!-- dhea_lab -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="dhea_lab" name="dhea_lab[]" value="dhea_lab" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $dhea_lab != NULL || $dhea_lab != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("dhea_lab", $dhea_lab)) echo "checked";
                            }
                            ?> >
                        <label for="dhea_lab">DHEA</label>
                      </div>

                      <!-- amh_lab -->
                      <div style="margin-bottom: 16px;" class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="amh_lab" name="amh_lab[]" value="amh_lab" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $amh_lab != NULL || $amh_lab != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("amh_lab", $amh_lab)) echo "checked";
                            }
                            ?> >
                        <label for="amh_lab">AMH</label>
                      </div>



                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" > ORINA </h6>

                      <!-- simple_lab -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="simple_lab" name="simple_lab[]" value="simple_lab" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $simple_lab != NULL || $simple_lab != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("simple_lab", $simple_lab)) echo "checked";
                            }
                            ?> >
                        <label for="simple_lab">Simple</label>
                      </div>

                      <!-- cultivo_y_antibiograma -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="cultivo_y_antibiograma" name="cultivo_y_antibiograma[]" value="cultivo_y_antibiograma" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $cultivo_y_antibiograma != NULL || $cultivo_y_antibiograma != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("cultivo_y_antibiograma", $cultivo_y_antibiograma)) echo "checked";
                            }
                            ?> >
                        <label for="cultivo_y_antibiograma">Cultivo y Antibiograma</label>
                      </div>

                      <!-- proteina_24hs -->
                      <div style="margin-bottom: 16px;" class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="proteina_24hs" name="proteina_24hs[]" value="proteina_24hs" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $proteina_24hs != NULL || $proteina_24hs != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("proteina_24hs", $proteina_24hs)) echo "checked";
                            }
                            ?> >
                        <label for="proteina_24hs">Proteina 24hs.</label>
                      </div>

                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" > HECES </h6>

                      <!-- vermes_y_protozoarios -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="vermes_y_protozoarios" name="vermes_y_protozoarios[]" value="vermes_y_protozoarios" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $vermes_y_protozoarios != NULL || $vermes_y_protozoarios != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("vermes_y_protozoarios", $vermes_y_protozoarios)) echo "checked";
                            }
                            ?> >
                        <label for="vermes_y_protozoarios">Vermes y Protozoarios</label>
                      </div>

                      <!-- cya_heces -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="cya_heces" name="cya_heces[]" value="cya_heces" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $cya_heces != NULL || $cya_heces != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("cya_heces", $cya_heces)) echo "checked";
                            }
                            ?> >
                        <label for="cya_heces">Cultivo y Antibiograma</label>
                      </div>

                      <!-- sangre_oculta -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="sangre_oculta" name="sangre_oculta[]" value="sangre_oculta" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $sangre_oculta != NULL || $sangre_oculta != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("sangre_oculta", $sangre_oculta)) echo "checked";
                            }
                            ?> >
                        <label for="sangre_oculta">Sangre Oculta</label>
                      </div>


                    </div><!-- FIN columna-A -->


                    <!-- columna-B -->
                    <div class="column column-block columna-B">

                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" > BIOQUÍMICA SANGUÍNEA </h6>
                      
                      <!-- glicemia_en_ayunas -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="glicemia_en_ayunas" name="glicemia_en_ayunas[]" value="glicemia_en_ayunas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $glicemia_en_ayunas != NULL || $glicemia_en_ayunas != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("glicemia_en_ayunas", $glicemia_en_ayunas)) echo "checked";
                            }
                            ?> >
                        <label for="glicemia_en_ayunas">Glicemia en ayunas</label>
                      </div>                      
                  
                      <!-- ttgo -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="ttgo" name="ttgo[]" value="ttgo" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $ttgo != NULL || $ttgo != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("ttgo", $ttgo)) echo "checked";
                            }
                            ?> >
                        <label for="ttgo">TTGO</label>
                      </div>

                      <!-- urea -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="urea" name="urea[]" value="urea" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $urea != NULL || $urea != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("urea", $urea)) echo "checked";
                            }
                            ?> >
                        <label for="urea">Urea</label>
                      </div>

                      <!-- creatinina -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="creatinina" name="creatinina[]" value="creatinina" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $creatinina != NULL || $creatinina != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("creatinina", $creatinina)) echo "checked";
                            }
                            ?> >
                        <label for="creatinina">Creatinina</label>
                      </div>

                      <!-- ac_urico -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="ac_urico" name="ac_urico[]" value="ac_urico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $ac_urico != NULL || $ac_urico != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("ac_urico", $ac_urico)) echo "checked";
                            }
                            ?> >
                        <label for="ac_urico">Ac. Urico</label>
                      </div>


                      <!-- colesterol_vhl -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="colesterol_vhl" name="colesterol_vhl[]" value="colesterol_vhl" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $colesterol_vhl != NULL || $colesterol_vhl != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("colesterol_vhl", $colesterol_vhl)) echo "checked";
                            }
                            ?> >
                        <label for="colesterol_vhl">Colesterol - (VLDL-HDL-LDL) </label>
                      </div>

                      <!-- trigliceridos -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="trigliceridos" name="trigliceridos[]" value="trigliceridos" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $trigliceridos != NULL || $trigliceridos != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("trigliceridos", $trigliceridos)) echo "checked";
                            }
                            ?> >
                        <label for="trigliceridos">Trigliceridos</label>
                      </div>

                      <!-- lipidos_totales -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="lipidos_totales" name="lipidos_totales[]" value="lipidos_totales" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $lipidos_totales != NULL || $lipidos_totales != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("lipidos_totales", $lipidos_totales)) echo "checked";
                            }
                            ?> >
                        <label for="lipidos_totales">Lípidos Totales</label>
                      </div>

                      <!-- hepatograma -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="hepatograma" name="hepatograma[]" value="hepatograma" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $hepatograma != NULL || $hepatograma != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("hepatograma", $hepatograma)) echo "checked";
                            }
                            ?> >
                        <label for="hepatograma">Hepatograma</label>
                      </div>

                      <!-- proteinas_tyf -->
                      <div style="margin-bottom: 16px;" class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="proteinas_tyf" name="proteinas_tyf[]" value="proteinas_tyf" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $proteinas_tyf != NULL || $proteinas_tyf != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("proteinas_tyf", $proteinas_tyf)) echo "checked";
                            }
                            ?> >
                        <label for="proteinas_tyf">Proteínas Totales y Fraccionadas</label>
                      </div>


                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" > MARCADORES </h6>
                      
                      <!-- ca_125 -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="ca_125" name="ca_125[]" value="ca_125" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $ca_125 != NULL || $ca_125 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("ca_125", $ca_125)) echo "checked";
                            }
                            ?> >
                        <label for="ca_125">CA 125</label>
                      </div>

                      <!-- cea_lab -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="cea_lab" name="cea_lab[]" value="cea_lab" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $cea_lab != NULL || $cea_lab != "" ){ //si esta vacio genera un error, por eso hay que cea_lab antes
                              if(in_array("cea_lab", $cea_lab)) echo "checked";
                            }
                            ?> >
                        <label for="cea_lab"> CEA </label>
                      </div>

                      <!-- ca_15_3 -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="ca_15_3" name="ca_15_3[]" value="ca_15_3" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $ca_15_3 != NULL || $ca_15_3 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("ca_15_3", $ca_15_3)) echo "checked";
                            }
                            ?> >
                        <label for="ca_15_3">CA 15-3</label>
                      </div>

                      <!-- pyrilinksd -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="pyrilinksd" name="pyrilinksd[]" value="pyrilinksd" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $pyrilinksd != NULL || $pyrilinksd != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("pyrilinksd", $pyrilinksd)) echo "checked";
                            }
                            ?> >
                        <label for="pyrilinksd">PyRilinks - D</label>
                      </div>

                      <!-- alfa_fetos_proteinas -->
                      <div style="margin-bottom: 16px;" class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="alfa_fetos_proteinas" name="alfa_fetos_proteinas[]" value="alfa_fetos_proteinas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $alfa_fetos_proteinas != NULL || $alfa_fetos_proteinas != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("alfa_fetos_proteinas", $alfa_fetos_proteinas)) echo "checked";
                            }
                            ?> >
                        <label for="alfa_fetos_proteinas">Alfa Feto Proteínas</label>
                      </div>

                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" > OTROS </h6>

                      <!-- fta_abs -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="fta_abs" name="fta_abs[]" value="fta_abs" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $fta_abs != NULL || $fta_abs != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("fta_abs", $fta_abs)) echo "checked";
                            }
                            ?> >
                        <label for="fta_abs"> FTA Abs</label>
                      </div>


                      <!-- pcr_lab -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="pcr_lab" name="pcr_lab[]" value="pcr_lab" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $pcr_lab != NULL || $pcr_lab != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("pcr_lab", $pcr_lab)) echo "checked";
                            }
                            ?> >
                        <label for="pcr_lab"> PCR </label>
                      </div>

                      <!-- factor_reumatoideo -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="factor_reumatoideo" name="factor_reumatoideo[]" value="factor_reumatoideo" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $factor_reumatoideo != NULL || $factor_reumatoideo != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("factor_reumatoideo", $factor_reumatoideo)) echo "checked";
                            }
                            ?> >
                        <label for="factor_reumatoideo">Factor Reumatoideo</label>
                      </div>

                      <!-- lupus_anticoagulante -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="lupus_anticoagulante" name="lupus_anticoagulante[]" value="lupus_anticoagulante" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $lupus_anticoagulante != NULL || $lupus_anticoagulante != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("lupus_anticoagulante", $lupus_anticoagulante)) echo "checked";
                            }
                            ?> >
                        <label for="lupus_anticoagulante">Lupus (Anticoagulante) </label>
                      </div>

                      <!-- ac_antinucleares -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="ac_antinucleares" name="ac_antinucleares[]" value="ac_antinucleares" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $ac_antinucleares != NULL || $ac_antinucleares != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("ac_antinucleares", $ac_antinucleares)) echo "checked";
                            }
                            ?> >
                        <label for="ac_antinucleares">Ac. Antinucleares (ANA) </label>
                      </div>

                      <!-- monotest -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="monotest" name="monotest[]" value="monotest" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $monotest != NULL || $monotest != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("monotest", $monotest)) echo "checked";
                            }
                            ?> >
                        <label for="monotest">Monotest</label>
                      </div>

                      <!-- ac_anti_dna -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="ac_anti_dna" name="ac_anti_dna[]" value="ac_anti_dna" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $ac_anti_dna != NULL || $ac_anti_dna != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("ac_anti_dna", $ac_anti_dna)) echo "checked";
                            }
                            ?> >
                        <label for="ac_anti_dna">Ac. Anti DNA (ds) </label>
                      </div>

                      <!-- ac_antifosfolípidos -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="ac_antifosfolípidos" name="ac_antifosfolípidos[]" value="ac_antifosfolípidos" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $ac_antifosfolípidos != NULL || $ac_antifosfolípidos != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("ac_antifosfolípidos", $ac_antifosfolípidos)) echo "checked";
                            }
                            ?> >
                        <label for="ac_antifosfolípidos">Ac. Antifosfolípidos</label>
                      </div>

                      <!-- vitamina_d25oh -->
                      <div style="margin-bottom: 16px;" class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="vitamina_d25oh" name="vitamina_d25oh[]" value="vitamina_d25oh" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $vitamina_d25oh != NULL || $vitamina_d25oh != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("vitamina_d25oh", $vitamina_d25oh)) echo "checked";
                            }
                            ?> >
                        <label for="vitamina_d25oh">25 - OH Vitamina D</label>
                      </div>


                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" > ESPERMOGRAMA </h6>

                      <!-- espermograma_biquimico -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="espermograma_biquimico" name="espermograma_biquimico[]" value="espermograma_biquimico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $espermograma_biquimico != NULL || $espermograma_biquimico != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("espermograma_biquimico", $espermograma_biquimico)) echo "checked";
                            }
                            ?> >
                        <label for="espermograma_biquimico">Espermograma + Biquímico</label>
                      </div>

                      <!-- simple_espermograma -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="simple_espermograma" name="simple_espermograma[]" value="simple_espermograma" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $simple_espermograma != NULL || $simple_espermograma != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("simple_espermograma", $simple_espermograma)) echo "checked";
                            }
                            ?> >
                        <label for="simple_espermograma">Simple</label>
                      </div>

                      <!-- cya_espermograma -->
                      <div style="margin-bottom: 16px;" class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="cya_espermograma" name="cya_espermograma[]" value="cya_espermograma" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $cya_espermograma != NULL || $cya_espermograma != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("cya_espermograma", $cya_espermograma)) echo "checked";
                            }
                            ?> >
                        <label for="cya_espermograma">Cultivo y Antibiograma</label>
                      </div>


                      <!-- SUBTITULO ------------------------------------------------------------------------- -->
                      <h6 class="separator-left" style="font-weight: bold;" > SECRECIONES </h6>


                      <!-- vaginal_cultivo -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="vaginal_cultivo" name="vaginal_cultivo[]" value="vaginal_cultivo" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $vaginal_cultivo != NULL || $vaginal_cultivo != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("vaginal_cultivo", $vaginal_cultivo)) echo "checked";
                            }
                            ?> >
                        <label for="vaginal_cultivo">Vaginal Cultivo</label>
                      </div>

                      <!-- endocervical_cultivo -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="endocervical_cultivo" name="endocervical_cultivo[]" value="endocervical_cultivo" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $endocervical_cultivo != NULL || $endocervical_cultivo != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("endocervical_cultivo", $endocervical_cultivo)) echo "checked";
                            }
                            ?> >
                        <label for="endocervical_cultivo"> Endocervical Cultivo </label>
                      </div>

                      <!-- cultivo_de_chla -->
                      <div class="floated-label-wrapper small-12 large-12 columns checkbox-radio text-left ">
                            <input type="checkbox" id="cultivo_de_chla" name="cultivo_de_chla[]" value="cultivo_de_chla" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                            <?php 
                            if( $cultivo_de_chla != NULL || $cultivo_de_chla != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                              if(in_array("cultivo_de_chla", $cultivo_de_chla)) echo "checked";
                            }
                            ?> >
                        <label for="cultivo_de_chla">Cultivo de Chlamydias</label> 
                      </div>

                    </div><!-- FIN columna-B -->
                  

                  </div> <!-- FIN contenedor de columnas -->


                  <div class="row">
                    <h6 class="separator-left" style="font-weight: bold;" > OTROS </h6>
                    
                    <div class="floated-label-wrapper small-12 large-12 columns">
                      
                      <input type="text" id="otros_laboratorios" name="otros_laboratorios" value="<?php echo $otros_laboratorios ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                    </div>

                    <h6 class="separator-left" style="font-weight: bold;" > DIAGNÓSTICO </h6>
                    
                    <div class="floated-label-wrapper small-12 large-12 columns end">
                      
                      <input type="text" id="diagnostico_laboratorios" name="diagnostico_laboratorios" value="<?php echo $diagnostico_laboratorios ?>" placeholder="Escribir..." class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> required>
                    </div>

                    
                  </div>


            </form>
            </div>
      </div>
    </div>
  </div> <!-- appform tabcontent -->


