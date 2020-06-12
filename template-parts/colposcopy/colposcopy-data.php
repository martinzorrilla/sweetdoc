<?php

    //get data from template if any
    //$patient_id = "new";
    $patient_id = $template_args["patient_id"];
    $app_id = $template_args["app_id"];
    $colpo_post_id = $template_args["colpo_post_id"]; 
    $colpo_data_post = get_post_custom($colpo_post_id);
    $is_editable = $template_args["is_editable"];



    //image files
    //store the ids of the images post
    $max_images = 5;
    $images_ids_array = array();
    // +1 bc 
    for ($i=0; $i < $max_images; $i++) {
      $k = $i+1;
      $text = 'colpo_imagen_'.$k;
      //$the_image_id = $colpo_data_post[$text][0]; // esta linea de codigo funciona pero da un warning the undefined  index cuando el elemento esta vacio
      // $the_image_id = $colpo_data_post[$text][0];
      $the_image_id = isset($colpo_data_post[$text][0]) ? $colpo_data_post[$text][0] : NULL;

//       var_dump($the_image_id);
      if ($the_image_id != "" && $the_image_id != NULL) {
         $images_ids_array[$i] = $the_image_id;
       }   
    }
    //var_dump($images_ids_array);
    
    //$image_post_id = $colpo_data_post['colpo_imagen_1'][0];
    $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
    $images_array = array();
    $images_names = array();
    for ($i=0; $i < sizeof($images_ids_array); $i++) {
      //store the names 
      $image_post = get_post_custom( $images_ids_array[$i] );
      $images_names[$i] = $image_post["_wp_attached_file"][0];
      //store the actual image
      $images_array[$i] = wp_get_attachment_image_src( $images_ids_array[$i], $size );
    }

    /*$image_post_id = $colpo_data_post['colpo_imagen_1'][0];
    $image = wp_get_attachment_image_src( $image_post_id, $size );
    echo "image <br/>";
    var_dump($image);*/


    
    //field files
    // $macroscopia = $colpo_data_post['macroscopia'][0];
    $macroscopia = isset($colpo_data_post['macroscopia'][0]) ? $colpo_data_post['macroscopia'][0] : NULL;
    // $colposcopia = $colpo_data_post['colposcopia'][0];
    $colposcopia = isset($colpo_data_post['colposcopia'][0]) ? $colpo_data_post['colposcopia'][0] : NULL;
    $radiobox_evaluacion_general = get_field('evaluacion_general', $colpo_post_id); 
    $checkbox_motivo_inadecuada = get_field('motivo_inadecuada', $colpo_post_id);
    $radiobox_union_escamo_columnar = get_field('union_escamo_columnar', $colpo_post_id);
    $radiobox_zona_de_transformacion = get_field('zona_de_transformacion', $colpo_post_id);
    // $colposcopicos_normales = $colpo_data_post['colposcopicos_normales'][0];
    $checkbox_colposcopicos_normales = get_field('colposcopicos_normales', $colpo_post_id);
    $checkbox_colposcopicos_anormales_grado_1 = get_field('colposcopicos_anormales_grado_1', $colpo_post_id);
    $checkbox_colposcopicos_anormales_grado_2 = get_field('colposcopicos_anormales_grado_2', $colpo_post_id);
    $checkbox_colposcopicos_anormales_no_especificos = get_field('colposcopicos_anormales_no_especificos', $colpo_post_id);
    // $colposcopicos_anormales_ubicacion = $colpo_data_post['colposcopicos_anormales_ubicacion'][0];
    $colposcopicos_anormales_ubicacion = isset($colpo_data_post['colposcopicos_anormales_ubicacion'][0]) ? $colpo_data_post['colposcopicos_anormales_ubicacion'][0] : NULL;
    $checkbox_sospecha_de_invasion = get_field('sospecha_de_invasion', $colpo_post_id);
    $checkbox_hallazgos_varios = get_field('hallazgos_varios', $colpo_post_id);
    $checkbox_examen_de_vyv = get_field('examen_de_vyv', $colpo_post_id);
    // $examen_de_vyv_descripcion = $colpo_data_post['examen_de_vyv_descripcion'][0];
    $examen_de_vyv_descripcion = isset($colpo_data_post['examen_de_vyv_descripcion'][0]) ? $colpo_data_post['examen_de_vyv_descripcion'][0] : NULL;
    $radiobox_colposcopicos_anormales_test_de_schiller = get_field('colposcopicos_anormales_test_de_schiller', $colpo_post_id);
    $checkbox_test_de_schiller_lugol = get_field('test_de_schiller_lugol', $colpo_post_id);
    // $sugerencias = $colpo_data_post['sugerencias'][0];
    $sugerencias = isset($colpo_data_post['sugerencias'][0]) ? $colpo_data_post['sugerencias'][0] : NULL;
    
 ?>


  <div class="tab">
      <button class="tablinks active" >Datos Básicos</button>
  </div>

  <div class="appform tabcontent">
    <div class="card profile-card-action-icons">
      <div class="card-section">
        <div class="profile-card-header">
          <div class="profile-card-author">
            <h5 class="author-title">Colposcopía</h5>
          </div>
        </div>
        <div class="profile-card-about">
          <h5 class="about-title separator-left"> Ingresar datos de la Colposcopía <?php //echo $name?></h5>

          <form id="create-colposcopy-form" name="create-colposcopy-form" method="post" >
          <input type="hidden" name="action" value="sw_create_colpo_ajax">
          <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          <input type="hidden" name="colpo_post_id" value="<?= $colpo_post_id?>">
          
            <!-- macroscopia -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="macroscopia">Macroscopía &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="macroscopia" name="macroscopia" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $macroscopia ?>" placeholder="Escribir..." required>
            </div>

            <!-- colposcopia -->
            <div class="floated-label-wrapper large-6 columns">
              <label class="separator-left" for="colposcopia">Colposcopía &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="colposcopia" name="colposcopia" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> value="<?php echo $colposcopia ?>" placeholder="Escribir..." required>
            </div>

            <!-- evaluacion_general -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Evaluación general</label>
                    
                      <input type="radio" id="adecuada" name="evaluacion_general" value="adecuada" <?php if ($radiobox_evaluacion_general == "adecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="adecuada">Adecuada</label>

                      <input type="radio" id="inadecuada" name="evaluacion_general" value="inadecuada" <?php if ($radiobox_evaluacion_general == "inadecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="inadecuada">Inadecuada</label>         
            </div>


            <!-- checkbox_motivo_inadecuadas - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Evaluación inadecuada por</label>
              

                    <input type="checkbox" id="inflamacion" name="motivo_inadecuada[]" value="inflamacion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_motivo_inadecuada != NULL || $checkbox_motivo_inadecuada != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("inflamacion", $checkbox_motivo_inadecuada)) echo "checked";
                    }
                    ?> >
                    <label for="inflamacion">Inflamación</label>

                    <input type="checkbox" id="atrofia_severa" name="motivo_inadecuada[]" value="atrofia_severa" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_motivo_inadecuada != NULL || $checkbox_motivo_inadecuada != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("atrofia_severa", $checkbox_motivo_inadecuada)) echo "checked";
                    }
                    ?> >
                    <label for="atrofia_severa">Atrofia severa</label>

                    <input type="checkbox" id="cicatriz" name="motivo_inadecuada[]" value="cicatriz" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_motivo_inadecuada != NULL || $checkbox_motivo_inadecuada != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("cicatriz", $checkbox_motivo_inadecuada)) echo "checked";
                    }
                    ?> >
                    <label for="cicatriz">Cicatriz</label>


                    <input type="checkbox" id="no_visualizacion" name="motivo_inadecuada[]" value="no_visualizacion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_motivo_inadecuada != NULL || $checkbox_motivo_inadecuada != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("no_visualizacion", $checkbox_motivo_inadecuada)) echo "checked";
                    }
                    ?> >
                    <label for="no_visualizacion">No visualización</label>

            </div>  

            <!-- union_escamo_columnar -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Visibilidad de la unión escamo columnar</label>
                    
                      <input type="radio" id="visible_uec" name="union_escamo_columnar" value="visible" <?php if ($radiobox_union_escamo_columnar == "visible") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="visible_uec">Visible</label>

                      <input type="radio" id="parcialmente_visible_uec" name="union_escamo_columnar" value="parcialmente_visible" <?php if ($radiobox_union_escamo_columnar == "parcialmente_visible") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="parcialmente_visible_uec">Parcialmente visible</label>         

                      <input type="radio" id="no_visible_uec" name="union_escamo_columnar" value="no_visible" <?php if ($radiobox_union_escamo_columnar == "no_visible") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="no_visible_uec">No visible</label>
            </div>

            <!-- zona_de_transformacion -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Tipo de zona de transformación</label>
                    
                      <input type="radio" id="tipo_1_zt" name="zona_de_transformacion" value="tipo_1" <?php if ($radiobox_zona_de_transformacion == "tipo_1") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="tipo_1_zt">Tipo 1</label>

                      <input type="radio" id="tipo_2_zt" name="zona_de_transformacion" value="tipo_2" <?php if ($radiobox_zona_de_transformacion == "tipo_2") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="tipo_2_zt">Tipo 2</label>         

                      <input type="radio" id="tipo_3_zt" name="zona_de_transformacion" value="tipo_3" <?php if ($radiobox_zona_de_transformacion == "tipo_3") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="tipo_3_zt">tipo 3</label>
            </div>

            <!-- Colposcopicos normales - checkbox -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left">Hallazgos colposcopicos normales</label>
              

                    <input type="checkbox" id="epitelio_escamoso_original_maduro" name="colposcopicos_normales[]" value="epitelio_escamoso_original_maduro" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_normales != NULL || $checkbox_colposcopicos_normales != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("epitelio_escamoso_original_maduro", $checkbox_colposcopicos_normales)) echo "checked";
                    }
                    ?> >
                    <label for="epitelio_escamoso_original_maduro">Epitelio escamoso original maduro</label>

                    <input type="checkbox" id="epitelio_escamoso_original_atrofico" name="colposcopicos_normales[]" value="epitelio_escamoso_original_atrofico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_normales != NULL || $checkbox_colposcopicos_normales != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("epitelio_escamoso_original_atrofico", $checkbox_colposcopicos_normales)) echo "checked";
                    }
                    ?> >
                    <label for="epitelio_escamoso_original_atrofico">Epitelio escamoso original atrofico</label>

                    <input type="checkbox" id="epitelio_columnar_ectopia" name="colposcopicos_normales[]" value="epitelio_columnar_ectopia" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_normales != NULL || $checkbox_colposcopicos_normales != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("epitelio_columnar_ectopia", $checkbox_colposcopicos_normales)) echo "checked";
                    }
                    ?> >
                    <label for="epitelio_columnar_ectopia">Epitelio columnar: Ectopia</label>


                    <input type="checkbox" id="epitelio_escamoso_metaplasico" name="colposcopicos_normales[]" value="epitelio_escamoso_metaplasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_normales != NULL || $checkbox_colposcopicos_normales != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("epitelio_escamoso_metaplasico", $checkbox_colposcopicos_normales)) echo "checked";
                    }
                    ?> >
                    <label for="epitelio_escamoso_metaplasico">Epitelio escamoso metaplasico</label>

                    <input type="checkbox" id="quiste_naboth" name="colposcopicos_normales[]" value="quiste_naboth" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_normales != NULL || $checkbox_colposcopicos_normales != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("quiste_naboth", $checkbox_colposcopicos_normales)) echo "checked";
                    }
                    ?> >
                    <label for="quiste_naboth">Quiste naboth</label>

                    <input type="checkbox" id="orificios_glandulares" name="colposcopicos_normales[]" value="orificios_glandulares" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_normales != NULL || $checkbox_colposcopicos_normales != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("orificios_glandulares", $checkbox_colposcopicos_normales)) echo "checked";
                    }
                    ?> >
                    <label for="orificios_glandulares">Orificios glandulares</label>

                    <input type="checkbox" id="deciduosis_en_embarazo" name="colposcopicos_normales[]" value="deciduosis_en_embarazo" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_normales != NULL || $checkbox_colposcopicos_normales != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("deciduosis_en_embarazo", $checkbox_colposcopicos_normales)) echo "checked";
                    }
                    ?> >
                    <label for="deciduosis_en_embarazo">Deciduosis en el embarazo</label>

            </div>  

            <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Hallazgos Colposcópicos Anormales </h6>
            </div>

            <!-- colposcopicos_anormales_grado_1 - checkbox -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left">Grado 1 (Menor)</label>
              

                    <input type="checkbox" id="mosaico_regular_ca1" name="colposcopicos_anormales_grado_1[]" value="mosaico_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_grado_1 != NULL || $checkbox_colposcopicos_anormales_grado_1 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("mosaico_regular", $checkbox_colposcopicos_anormales_grado_1)) echo "checked";
                    }
                    ?> >
                    <label for="mosaico_regular_ca1">Mosaico regular</label>

                    <input type="checkbox" id="epitelio_acetoblanco_ca1" name="colposcopicos_anormales_grado_1[]" value="epitelio_acetoblanco" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_grado_1 != NULL || $checkbox_colposcopicos_anormales_grado_1 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("epitelio_acetoblanco", $checkbox_colposcopicos_anormales_grado_1)) echo "checked";
                    }
                    ?> >
                    <label for="epitelio_acetoblanco_ca1">Epitelio acetoblanco</label>


                    <input type="checkbox" id="puntillado_fino_ca1" name="colposcopicos_anormales_grado_1[]" value="puntillado_fino" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_grado_1 != NULL || $checkbox_colposcopicos_anormales_grado_1 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("puntillado_fino", $checkbox_colposcopicos_anormales_grado_1)) echo "checked";
                    }
                    ?> >
                    <label for="puntillado_fino_ca1">Puntillado fino</label>

            </div>  

            <!-- colposcopicos_anormales_grado_2 - checkbox -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left">Grado 2 (Mayor)</label>
              

                    <input type="checkbox" id="mosaico_irregular_ca2" name="colposcopicos_anormales_grado_2[]" value="mosaico_irregular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_grado_2 != NULL || $checkbox_colposcopicos_anormales_grado_2 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("mosaico_irregular", $checkbox_colposcopicos_anormales_grado_2)) echo "checked";
                    }
                    ?> >
                    <label for="mosaico_irregular_ca2">Mosaico irregular</label>

                    <input type="checkbox" id="puntillado_grueso_ca2" name="colposcopicos_anormales_grado_2[]" value="puntillado_grueso" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_grado_2 != NULL || $checkbox_colposcopicos_anormales_grado_2 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("puntillado_grueso", $checkbox_colposcopicos_anormales_grado_2)) echo "checked";
                    }
                    ?> >
                    <label for="puntillado_grueso_ca2">Puntillado grueso</label>

                    <input type="checkbox" id="signo_de_limite_borde_interno_ca2" name="colposcopicos_anormales_grado_2[]" value="signo_de_limite_borde_interno" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_grado_2 != NULL || $checkbox_colposcopicos_anormales_grado_2 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("signo_de_limite_borde_interno", $checkbox_colposcopicos_anormales_grado_2)) echo "checked";
                    }
                    ?> >
                    <label for="signo_de_limite_borde_interno_ca2">Signo del limite del borde interno</label>


                    <input type="checkbox" id="signo_cresta_ca2" name="colposcopicos_anormales_grado_2[]" value="signo_cresta" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_grado_2 != NULL || $checkbox_colposcopicos_anormales_grado_2 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("signo_cresta", $checkbox_colposcopicos_anormales_grado_2)) echo "checked";
                    }
                    ?> >
                    <label for="signo_cresta_ca2">Signo de cresta</label>

                    <input type="checkbox" id="sobre_elevado_ca2" name="colposcopicos_anormales_grado_2[]" value="sobre_elevado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_grado_2 != NULL || $checkbox_colposcopicos_anormales_grado_2 != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("sobre_elevado", $checkbox_colposcopicos_anormales_grado_2)) echo "checked";
                    }
                    ?> >
                    <label for="sobre_elevado_ca2">Sobre elevado</label>

            </div>  

            <!-- colposcopicos_anormales_no_especificos - checkbox -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left">No especificos</label>

                    <input type="checkbox" id="leucoplasia_queratosis" name="colposcopicos_anormales_no_especificos[]" value="leucoplasia_queratosis" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_no_especificos != NULL || $checkbox_colposcopicos_anormales_no_especificos != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("leucoplasia_queratosis", $checkbox_colposcopicos_anormales_no_especificos)) echo "checked";
                    }
                    ?> >
                    <label for="leucoplasia_queratosis">Leucoplasia queratosis</label>

                    <input type="checkbox" id="erosion_can" name="colposcopicos_anormales_no_especificos[]" value="erosion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_colposcopicos_anormales_no_especificos != NULL || $checkbox_colposcopicos_anormales_no_especificos != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("erosion", $checkbox_colposcopicos_anormales_no_especificos)) echo "checked";
                    }
                    ?> >
                    <label for="erosion_can">Erosión</label>
            </div>  

            <!-- colposcopicos_anormales_ubicacion -->
              <div class="floated-label-wrapper large-6 columns ">
              <label for="colposcopicos_anormales_ubicacion"> Ubicación y tamaño de la lesión</label>
              <input type="text" id="colposcopicos_anormales_ubicacion" name="colposcopicos_anormales_ubicacion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $colposcopicos_anormales_ubicacion ?>" placeholder="Escribir..." required>
            </div>

            <!-- sospecha_de_invasion - checkbox -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left">Sospecha de invasión</label>
              
                    <input type="checkbox" id="vasos_atipicos_sdi" name="sospecha_de_invasion[]" value="vasos_atipicos" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_sospecha_de_invasion != NULL || $checkbox_sospecha_de_invasion != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("vasos_atipicos", $checkbox_sospecha_de_invasion)) echo "checked";
                    }
                    ?> >
                    <label for="vasos_atipicos_sdi">Vasos atipicos</label>

                    <input type="checkbox" id="lesion_exofitica_sdi" name="sospecha_de_invasion[]" value="lesion_exofitica" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_sospecha_de_invasion != NULL || $checkbox_sospecha_de_invasion != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("lesion_exofitica", $checkbox_sospecha_de_invasion)) echo "checked";
                    }
                    ?> >
                    <label for="lesion_exofitica_sdi">Lesion exofitica</label>

                    <input type="checkbox" id="necrosis_sdi" name="colposcopicos_anormales_grado_2[]" value="necrosis" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_sospecha_de_invasion != NULL || $checkbox_sospecha_de_invasion != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("necrosis", $checkbox_sospecha_de_invasion)) echo "checked";
                    }
                    ?> >
                    <label for="necrosis_sdi">Necrosis</label>


                    <input type="checkbox" id="ulceracion_sdi" name="sospecha_de_invasion[]" value="ulceracion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_sospecha_de_invasion != NULL || $checkbox_sospecha_de_invasion != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("ulceracion", $checkbox_sospecha_de_invasion)) echo "checked";
                    }
                    ?> >
                    <label for="ulceracion_sdi">Ulceración</label>

                    <input type="checkbox" id="tumoracion_sdi" name="sospecha_de_invasion[]" value="tumoracion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_sospecha_de_invasion != NULL || $checkbox_sospecha_de_invasion != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("tumoracion", $checkbox_sospecha_de_invasion)) echo "checked";
                    }
                    ?> >
                    <label for="tumoracion_sdi">Tumoración</label>

            </div> 

            <!-- hallazgos_varios - checkbox -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left">Hallazgos Varios</label>
        

                    <input type="checkbox" id="zt_congenita_hv" name="hallazgos_varios[]" value="zt_congenita" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_hallazgos_varios != NULL || $checkbox_hallazgos_varios != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("zt_congenita", $checkbox_hallazgos_varios)) echo "checked";
                    }
                    ?> >
                    <label for="zt_congenita_hv">Z.T. congenita</label>

                    <input type="checkbox" id="inflamacion_hv" name="hallazgos_varios[]" value="inflamacion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_hallazgos_varios != NULL || $checkbox_hallazgos_varios != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("inflamacion", $checkbox_hallazgos_varios)) echo "checked";
                    }
                    ?> >
                    <label for="inflamacion_hv">Inflamación</label>

                    <input type="checkbox" id="prolapso_hv" name="hallazgos_varios[]" value="prolapso" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_hallazgos_varios != NULL || $checkbox_hallazgos_varios != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("prolapso", $checkbox_hallazgos_varios)) echo "checked";
                    }
                    ?> >
                    <label for="prolapso_hv">Prolapso</label>


                    <input type="checkbox" id="condiloma_hv" name="hallazgos_varios[]" value="condiloma" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_hallazgos_varios != NULL || $checkbox_hallazgos_varios != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("condiloma", $checkbox_hallazgos_varios)) echo "checked";
                    }
                    ?> >
                    <label for="condiloma_hv">Condiloma</label>

                    <input type="checkbox" id="estenosis_hv" name="hallazgos_varios[]" value="estenosis" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_hallazgos_varios != NULL || $checkbox_hallazgos_varios != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("estenosis", $checkbox_hallazgos_varios)) echo "checked";
                    }
                    ?> >
                    <label for="estenosis_hv">Estenosis</label>

                    <input type="checkbox" id="polipo_hv" name="hallazgos_varios[]" value="polipo" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_hallazgos_varios != NULL || $checkbox_hallazgos_varios != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("polipo", $checkbox_hallazgos_varios)) echo "checked";
                    }
                    ?> >
                    <label for="polipo_hv">Polipo</label>

                    <input type="checkbox" id="endometriosis_hv" name="hallazgos_varios[]" value="endometriosis" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_hallazgos_varios != NULL || $checkbox_hallazgos_varios != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("endometriosis", $checkbox_hallazgos_varios)) echo "checked";
                    }
                    ?> >
                    <label for="endometriosis_hv">Endometriosis</label>

            </div>  

            <!-- examen_de_vyv - checkbox -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left">Exámen de vulva y vagina</label>

                    <input type="checkbox" id="sin_particularidades_evyv" name="examen_de_vyv[]" value="sin_particularidades" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_examen_de_vyv != NULL || $checkbox_examen_de_vyv != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("sin_particularidades", $checkbox_examen_de_vyv)) echo "checked";
                    }
                    ?> >
                    <label for="sin_particularidades_evyv">Sin particularidades</label>
            </div>  

            <!-- Descripcio Examen de vagina y vulva -->
            <div class="floated-label-wrapper large-12 columns end">
              <label for="examen_de_vyv_descripcion">Descripción del examen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="examen_de_vyv_descripcion" name="examen_de_vyv_descripcion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $examen_de_vyv_descripcion ?>" placeholder="Escribir..." required>
            </div>

            <!-- colposcopicos_anormales_test_de_schiller -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Test de Schiller</label>
                    
                      <input type="radio" id="positivo_cats" name="colposcopicos_anormales_test_de_schiller" value="positivo" <?php if ($radiobox_colposcopicos_anormales_test_de_schiller == "positivo") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="positivo_cats">Positivo</label>

                      <input type="radio" id="_cats" name="colposcopicos_anormales_test_de_schiller" value="negativo" <?php if ($radiobox_colposcopicos_anormales_test_de_schiller == "negativo") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="_cats">Negativo</label>         
            </div>

            <!-- test de schiller lugol - checkbox -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left">Lugol</label>
              
                    <input type="checkbox" id="caoba_oscuro_uniforme_ts" name="test_de_schiller_lugol[]" value="caoba_oscuro_uniforme" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_test_de_schiller_lugol != NULL || $checkbox_test_de_schiller_lugol != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("caoba_oscuro_uniforme", $checkbox_test_de_schiller_lugol)) echo "checked";
                    }
                    ?> >
                    <label for="caoba_oscuro_uniforme_ts">Caoba oscuro uniforme</label>

                    <input type="checkbox" id="caoba_oscuro_irregular_ts" name="test_de_schiller_lugol[]" value="caoba_oscuro_irregular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_test_de_schiller_lugol != NULL || $checkbox_test_de_schiller_lugol != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("caoba_oscuro_irregular", $checkbox_test_de_schiller_lugol)) echo "checked";
                    }
                    ?> >
                    <label for="caoba_oscuro_irregular_ts">Caoba oscuro irregular</label>

                    <input type="checkbox" id="caoba_claro_regular_ts" name="test_de_schiller_lugol[]" value="caoba_claro_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_test_de_schiller_lugol != NULL || $checkbox_test_de_schiller_lugol != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("caoba_claro_regular", $checkbox_test_de_schiller_lugol)) echo "checked";
                    }
                    ?> >
                    <label for="caoba_claro_regular_ts">Caoba claro regular</label>


                    <input type="checkbox" id="caoba_claro_irregular_ts" name="test_de_schiller_lugol[]" value="caoba_claro_irregular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_test_de_schiller_lugol != NULL || $checkbox_test_de_schiller_lugol != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("caoba_claro_irregular", $checkbox_test_de_schiller_lugol)) echo "checked";
                    }
                    ?> >
                    <label for="caoba_claro_irregular_ts">Caoba claro irregular</label>

                    <input type="checkbox" id="claro_periorificial_ts" name="test_de_schiller_lugol[]" value="claro_periorificial" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_test_de_schiller_lugol != NULL || $checkbox_test_de_schiller_lugol != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                      if(in_array("claro_periorificial", $checkbox_test_de_schiller_lugol)) echo "checked";
                    }
                    ?> >
                    <label for="claro_periorificial_ts">Claro periorificial</label>
            </div>

            <!-- sugerencias -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="sugerencias_col">Sugerencias</label>
              <!-- <input type="text" id="sugerencias_col" name="sugerencias" value="< ?php echo $sugerencias ?>" placeholder="Escribir..." required> -->
              <textarea id="sugerencias_col" name="sugerencias" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $sugerencias ?></textarea>
            </div>

            <!-- IMAGENES -->
            <div class="archivos large-12 columns" style="margin-top: 1.5rem;">
            
              <div class="profile-card-about">
                <h5 class="about-title separator-left"> Ingresar imágenes de la colposcopía </h5>
              </div>
              <div class="subir-colpo test">
                <label for="image_uploads">Seleccionar imágenes (png, jpg )</label>
                <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" multiple>
              </div>

              <?php 
              //if ($image) { cerrar el php
              if (sizeof($images_ids_array)>0) { ?>
                <div class="preview test">
                <ol>
                  <?php  
                  $k = 0; 
                  foreach ($images_array as $image) { ?>        
                    <li>  
                        <img class="image-class" alt="" src="<?php echo $image[0]; ?>" />
                        <p>Nombre del archivo <?php echo $images_names[$k]; ?> </p>
                    </li>
                  
                  <?php
                  $k++;
                  } ?>

                </ol>
                </div> <?php
              }else{ ?>
                <div class="preview no-files">
                  <p>No hay archivos seleccionados</p>
                </div> <?php  
              } 
              ?>
            </div> <!-- div.archivos -->
          
          </form>
        </div>
      </div>
    </div>
  </div>