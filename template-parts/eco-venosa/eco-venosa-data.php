<?php

    //get data from template if any
    //$patient_id = "new";
    $patient_id = $template_args["patient_id"];
    $app_id = $template_args["app_id"];
    $eco_venosa_post_id = $template_args["eco_venosa_post_id"]; 
    $eco_venosa_data_post = get_post_custom($eco_venosa_post_id);
    $is_editable = $template_args["is_editable"];



    //image files
    //store the ids of the images post
    $max_images = 5;
    $images_ids_array = array();
    // +1 bc 
    for ($i=0; $i < $max_images; $i++) {
      $k = $i+1;
      $text = 'eco_venosa_imagen_'.$k;
      //$the_image_id = $eco_venosa_data_post[$text][0]; // esta linea de codigo funciona pero da un warning the undefined  index cuando el elemento esta vacio
      // $the_image_id = $eco_venosa_data_post[$text][0];
      $the_image_id = isset($eco_venosa_data_post[$text][0]) ? $eco_venosa_data_post[$text][0] : NULL;

//       var_dump($the_image_id);
      if ($the_image_id != "" && $the_image_id != NULL) {
         $images_ids_array[$i] = $the_image_id;
       }   
    }
    //var_dump($images_ids_array);
    
    //$image_post_id = $eco_venosa_data_post['eco_venosa_imagen_1'][0];
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

    /*$image_post_id = $eco_venosa_data_post['colpo_imagen_1'][0];
    $image = wp_get_attachment_image_src( $image_post_id, $size );
    echo "image <br/>";
    var_dump($image);*/


    
    //field files
    $radiobox_vena_femoral_comun = get_field('vena_femoral_comun', $eco_venosa_post_id); 
    $radiobox_vena_femoral_superficial = get_field('vena_femoral_superficial', $eco_venosa_post_id); 
    $radiobox_vena_poplitea = get_field('vena_poplitea', $eco_venosa_post_id); 
    $radiobox_plexo_soleo_y_gemelar = get_field('plexo_soleo_y_gemelar', $eco_venosa_post_id); 
    
    
    $checkbox_union_safeno_femoral = get_field('union_safeno_femoral', $eco_venosa_post_id);
    $safeno_femoral_medida = isset($eco_venosa_data_post['safeno_femoral_medida'][0]) ? $eco_venosa_data_post['safeno_femoral_medida'][0] : NULL;
    
    $checkbox_tronco_suprapatelar = get_field('tronco_suprapatelar', $eco_venosa_post_id);
    $tronco_suprapatelar_medida = isset($eco_venosa_data_post['tronco_suprapatelar_medida'][0]) ? $eco_venosa_data_post['tronco_suprapatelar_medida'][0] : NULL;
    
    $checkbox_tronco_infrapatelar = get_field('tronco_infrapatelar', $eco_venosa_post_id);
    $tronco_infrapatelar_medida = isset($eco_venosa_data_post['tronco_infrapatelar_medida'][0]) ? $eco_venosa_data_post['tronco_infrapatelar_medida'][0] : NULL;
    
    $checkbox_union_safeno_poplitea = get_field('union_safeno_poplitea', $eco_venosa_post_id);
    $union_safeno_poplitea_medida = isset($eco_venosa_data_post['union_safeno_poplitea_medida'][0]) ? $eco_venosa_data_post['union_safeno_poplitea_medida'][0] : NULL;
    
    $checkbox_vena_safena_parva = get_field('vena_safena_parva', $eco_venosa_post_id);
    $vena_safena_parva_medida = isset($eco_venosa_data_post['vena_safena_parva_medida'][0]) ? $eco_venosa_data_post['vena_safena_parva_medida'][0] : NULL;
    
    $checkbox_venas_perforantes = get_field('venas_perforantes', $eco_venosa_post_id);
    $venas_perforantes_medida = isset($eco_venosa_data_post['venas_perforantes_medida'][0]) ? $eco_venosa_data_post['venas_perforantes_medida'][0] : NULL;
    
    $sugerobservacionesencias = isset($eco_venosa_data_post['observaciones'][0]) ? $eco_venosa_data_post['observaciones'][0] : NULL;
    $conclusion = isset($eco_venosa_data_post['conclusion'][0]) ? $eco_venosa_data_post['conclusion'][0] : NULL;
    
    
    
    
 ?>


  <div class="tab">
      <button class="tablinks dabbed" >Datos Básicos</button>
  </div>

  <div class="appform tabcontent">
    <div class="card profile-card-action-icons">
      <div class="card-section">
        <div class="profile-card-header">
          <div class="profile-card-author">
            <h5 class="author-title">Ecografía Venosa</h5>
          </div>
        </div>
        <div class="profile-card-about">
          <h5 class="about-title separator-left"> Ingresar datos de la Ecografía <?php //echo $name?></h5>

          <form id="create-colposcopy-form" name="create-colposcopy-form" method="post" >
          <input type="hidden" name="action" value="sw_create_colpo_ajax">
          <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          <input type="hidden" name="eco_venosa_post_id" value="<?= $eco_venosa_post_id?>">
          
            <!-- macroscopia -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="macroscopia">Macroscopía &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="macroscopia" name="macroscopia" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $macroscopia ?>" placeholder="Escribir..." required>
            </div>



            <!-- vena_femoral_comun -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Vena Femoral común</label>
                    
                      <input type="radio" id="adecuada" name="evaluacion_general" value="adecuada" <?php if ($radiobox_vena_femoral_comun == "adecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="adecuada">Adecuada</label>

                      <input type="radio" id="inadecuada" name="evaluacion_general" value="inadecuada" <?php if ($radiobox_vena_femoral_comun == "inadecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="inadecuada">Inadecuada</label>         
            </div>

            <!-- vena_femoral_superficial -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Vena Femoral superficial</label>
                    
                      <input type="radio" id="adecuada" name="evaluacion_general" value="adecuada" <?php if ($radiobox_vena_femoral_superficial == "adecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="adecuada">Adecuada</label>

                      <input type="radio" id="inadecuada" name="evaluacion_general" value="inadecuada" <?php if ($radiobox_vena_femoral_superficial == "inadecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="inadecuada">Inadecuada</label>         
            </div>

            <!-- vena_poplitea -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Vena poplítea</label>
                    
                      <input type="radio" id="adecuada" name="evaluacion_general" value="adecuada" <?php if ($radiobox_vena_poplitea == "adecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="adecuada">Adecuada</label>

                      <input type="radio" id="inadecuada" name="evaluacion_general" value="inadecuada" <?php if ($radiobox_vena_poplitea == "inadecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="inadecuada">Inadecuada</label>         
            </div>

            <!-- plexo_soleo_y_gemelar -->
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