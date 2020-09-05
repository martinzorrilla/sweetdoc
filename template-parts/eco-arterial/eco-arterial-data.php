<?php

    //get data from template if any
    //$patient_id = "new";
    $patient_id = $template_args["patient_id"];
    $app_id = $template_args["app_id"];
    $eco_arterial_post_id = $template_args["eco_arterial_post_id"]; 
    $eco_arterial_data_post = get_post_custom($eco_arterial_post_id);
    $is_editable = $template_args["is_editable"];



    //image files
    //store the ids of the images post
    $max_images = 5;
    $images_ids_array = array();
    // +1 bc 
    for ($i=0; $i < $max_images; $i++) {
      $k = $i+1;
      $text = 'eco_arterial_imagen_'.$k;
      //$the_image_id = $eco_arterial_data_post[$text][0]; // esta linea de codigo funciona pero da un warning the undefined  index cuando el elemento esta vacio
      // $the_image_id = $eco_arterial_data_post[$text][0];
      $the_image_id = isset($eco_arterial_data_post[$text][0]) ? $eco_arterial_data_post[$text][0] : NULL;

//       var_dump($the_image_id);
      if ($the_image_id != "" && $the_image_id != NULL) {
         $images_ids_array[$i] = $the_image_id;
       }   
    }
    // echo("izq:" );
    // var_dump($images_ids_array);
    
    //$image_post_id = $eco_arterial_data_post['eco_arterial_imagen_1'][0];
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

    /*$image_post_id = $eco_arterial_data_post['colpo_imagen_1'][0];
    $image = wp_get_attachment_image_src( $image_post_id, $size );
    echo "image <br/>";
    var_dump($image);*/

    
    
    //field files
    $checkbox_arteria_femoral_comun = get_field('arteria_femoral_comun', $eco_arterial_post_id);
    $afc_obs = isset($eco_arterial_data_post['afc_obs'][0]) ? $eco_arterial_data_post['afc_obs'][0] : NULL;
    $checkbox_afc_flujo = get_field('afc_flujo', $eco_arterial_post_id);

    $checkbox_arteria_femoral_profunda = get_field('arteria_femoral_profunda', $eco_arterial_post_id);
    $afp_obs = isset($eco_arterial_data_post['afp_obs'][0]) ? $eco_arterial_data_post['afp_obs'][0] : NULL;
    $checkbox_afp_flujo = get_field('afp_flujo', $eco_arterial_post_id);


    $checkbox_arteria_femoral_superficial = get_field('arteria_femoral_superficial', $eco_arterial_post_id);
    $afs_obs = isset($eco_arterial_data_post['afs_obs'][0]) ? $eco_arterial_data_post['afs_obs'][0] : NULL;
    $checkbox_afs_flujo = get_field('afs_flujo', $eco_arterial_post_id);


    $checkbox_arteria_poplitea = get_field('arteria_poplitea', $eco_arterial_post_id);
    $ap_obs = isset($eco_arterial_data_post['ap_obs'][0]) ? $eco_arterial_data_post['ap_obs'][0] : NULL;
    $checkbox_ap_flujo = get_field('ap_flujo', $eco_arterial_post_id);


    $checkbox_arteria_tibial_anterior = get_field('arteria_tibial_anterior', $eco_arterial_post_id);
    $ata_obs = isset($eco_arterial_data_post['ata_obs'][0]) ? $eco_arterial_data_post['ata_obs'][0] : NULL;
    $checkbox_ata_flujo = get_field('ata_flujo', $eco_arterial_post_id);

    $checkbox_arteria_tibial_posterior = get_field('arteria_tibial_posterior', $eco_arterial_post_id);
    $atp_obs = isset($eco_arterial_data_post['atp_obs'][0]) ? $eco_arterial_data_post['atp_obs'][0] : NULL;
    $checkbox_atp_flujo = get_field('atp_flujo', $eco_arterial_post_id);

    $checkbox_arteria_fibular_peroneal = get_field('arteria_fibular_peroneal', $eco_arterial_post_id);
    $arfipe_obs = isset($eco_arterial_data_post['arfipe_obs'][0]) ? $eco_arterial_data_post['arfipe_obs'][0] : NULL;
    $checkbox_arfipe_flujo = get_field('arfipe_flujo', $eco_arterial_post_id);

    $checkbox_arteria_pedia = get_field('arteria_pedia', $eco_arterial_post_id);
    $arpe_obs = isset($eco_arterial_data_post['arpe_obs'][0]) ? $eco_arterial_data_post['arpe_obs'][0] : NULL;
    $checkbox_arpe_flujo = get_field('arpe_flujo', $eco_arterial_post_id);
    
    $conclusion = isset($eco_arterial_data_post['conclusion'][0]) ? $eco_arterial_data_post['conclusion'][0] : NULL;
    

    
 ?>

  <div id="izquierdo" class="appform tabcontent">
    <div class="card profile-card-action-icons">
      <div class="card-section">
        <div class="profile-card-header">
          <div class="profile-card-author">
            <h5 class="author-title">Ecografía arterial</h5>
          </div>
        </div>
        <div class="profile-card-about">
          <h5 class="about-title separator-left"> Ingresar datos de la Ecografía - Miembro Izquierdo <?php //echo $name?></h5>

          <!-- <form id="create-eco-arterial-form" name="create-eco-arterial-form" method="post"> -->
          <div>
          <input type="hidden" name="action" value="sw_create_eco_arterial_ajax">
          <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          <input type="hidden" name="eco_arterial_post_id" value="<?= $eco_arterial_post_id?>">
        

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Sistema Venoso Superficial</h6>
            </div> -->
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Vena Safena Mayor</h6>
            </div> -->
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->


            <!-- checkbox_arteria_femoral_comun - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria femoral común </label>
              

                    <input type="checkbox" id="afc1" name="arteria_femoral_comun[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afc1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="afc2" name="arteria_femoral_comun[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afc2">Calibre conservado</label>


                    <input type="checkbox" id="afc3" name="arteria_femoral_comun[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afc3">Calibre disminuido</label>



                    <input type="checkbox" id="afc4" name="arteria_femoral_comun[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afc4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="afc5" name="arteria_femoral_comun[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afc5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="afc6" name="arteria_femoral_comun[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afc6">Con placas ateromatosas</label>


                    <input type="checkbox" id="afc7" name="arteria_femoral_comun[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afc7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="afc8" name="arteria_femoral_comun[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afc8">Ocluido</label>

            </div>  
            
            <!-- afc_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="afc_obs">Observaciones</label>
              <textarea id="afc_obs" name="afc_obs" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $afc_obs ?></textarea>
            </div>

            <!-- checkbox_afc_flujo - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="afcflujo1" name="afc_flujo[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afc_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afc_flujo as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afcflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="afcflujo2" name="afc_flujo[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afc_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afc_flujo as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afcflujo2">Bifásico</label>


                    <input type="checkbox" id="afcflujo3" name="afc_flujo[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afc_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afc_flujo as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afcflujo3">Trifásico</label>



                    <input type="checkbox" id="afcflujo4" name="afc_flujo[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afc_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afc_flujo as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afcflujo4">Sin flujo</label>
            </div>  






















            <!-- conclusion -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="conclusion">Conclusion</label>
              <textarea id="conclusion" name="conclusion" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $conclusion ?></textarea>
            </div>

            <!-- IMAGENES -->
            <div id="imagenes-eco-art-izq" class="archivos large-12 columns" style="margin-top: 1.5rem;">
            
              <div class="profile-card-about">
                <h5 class="about-title separator-left"> Ingresar imágenes de la ecografía </h5>
              </div>
              <div class="subir-colpo test">
                <label for="imagen_eco_arterial">Seleccionar imágenes (png, jpg )</label>
                <input type="file" id="imagen_eco_arterial" name="imagen_eco_arterial" accept=".jpg, .jpeg, .png" multiple>
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
          
          
            </div> <!-- form -->
        </div>
      </div>
    </div>
  </div>