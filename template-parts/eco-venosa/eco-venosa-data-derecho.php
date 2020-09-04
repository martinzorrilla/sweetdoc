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
    $max_images_der = 5;
    $images_ids_array_der = array();
    // +1 bc 
    $k = 0;
    for ($i=0; $i < $max_images_der; $i++) {
      $k = $i+1;
      $text = 'eco_venosa_imagen_der_'.$k;
      //$the_image_id = $eco_venosa_data_post[$text][0]; // esta linea de codigo funciona pero da un warning the undefined  index cuando el elemento esta vacio
      // $the_image_id = $eco_venosa_data_post[$text][0];
      $the_image_id = isset($eco_venosa_data_post[$text][0]) ? $eco_venosa_data_post[$text][0] : NULL;

//       var_dump($the_image_id);
      if ($the_image_id != "" && $the_image_id != NULL) {
         $images_ids_array_der[$i] = $the_image_id;
       }   
    }
    // echo("<br>" );
    // echo("der:" );
    // var_dump($images_ids_array_der);
    // $images_ids_array;

    //$image_post_id = $eco_venosa_data_post['eco_venosa_imagen_1'][0];
    $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
    $images_array_der = array();
    $images_names_der = array();
    for ($i=0; $i < sizeof($images_ids_array_der); $i++) {
      //store the names 
      $image_post = get_post_custom( $images_ids_array_der[$i] );
      $images_names_der[$i] = $image_post["_wp_attached_file"][0];
      //store the actual image
      $images_array_der[$i] = wp_get_attachment_image_src( $images_ids_array_der[$i], $size );
    }


 //field files
 $radiobox_vena_femoral_comun_der = get_field('field_5f4dc19d11f62', $eco_venosa_post_id); 
 $radiobox_vena_femoral_superficial_der = get_field('field_5f4dc1bd11f63', $eco_venosa_post_id); 
 $radiobox_vena_poplitea_der = get_field('field_5f4dc1d311f64', $eco_venosa_post_id); 
 $radiobox_plexo_soleo_y_gemelar_der = get_field('field_5f4dc1df11f65', $eco_venosa_post_id); 

 $checkbox_union_safeno_femoral_der = get_field('union_safeno_femoral_der', $eco_venosa_post_id);
 $safeno_femoral_medida_der = isset($eco_venosa_data_post['safeno_femoral_medida_der'][0]) ? $eco_venosa_data_post['safeno_femoral_medida_der'][0] : NULL;
 
 $checkbox_tronco_suprapatelar_der = get_field('tronco_suprapatelar_der', $eco_venosa_post_id);
 $tronco_suprapatelar_medida_der = isset($eco_venosa_data_post['tronco_suprapatelar_medida_der'][0]) ? $eco_venosa_data_post['tronco_suprapatelar_medida_der'][0] : NULL;
 
 $checkbox_tronco_infrapatelar_der = get_field('tronco_infrapatelar_der', $eco_venosa_post_id);
 $tronco_infrapatelar_medida_der = isset($eco_venosa_data_post['tronco_infrapatelar_medida_der'][0]) ? $eco_venosa_data_post['tronco_infrapatelar_medida_der'][0] : NULL;
 
 $checkbox_union_safeno_poplitea_der = get_field('union_safeno_poplitea_der', $eco_venosa_post_id);
 $union_safeno_poplitea_medida_der = isset($eco_venosa_data_post['union_safeno_poplitea_medida_der'][0]) ? $eco_venosa_data_post['union_safeno_poplitea_medida_der'][0] : NULL;
 
 $checkbox_vena_safena_parva_der = get_field('vena_safena_parva_der', $eco_venosa_post_id);
 $vena_safena_parva_medida_der = isset($eco_venosa_data_post['vena_safena_parva_medida_der'][0]) ? $eco_venosa_data_post['vena_safena_parva_medida_der'][0] : NULL;
 
 $checkbox_venas_perforantes_der = get_field('venas_perforantes_der', $eco_venosa_post_id);
 $venas_perforantes_medida_der = isset($eco_venosa_data_post['venas_perforantes_medida_der'][0]) ? $eco_venosa_data_post['venas_perforantes_medida_der'][0] : NULL;
 
 $observaciones_der = isset($eco_venosa_data_post['observaciones_der'][0]) ? $eco_venosa_data_post['observaciones_der'][0] : NULL;
 $conclusion_der = isset($eco_venosa_data_post['conclusion_der'][0]) ? $eco_venosa_data_post['conclusion_der'][0] : NULL;
 
 

    
    
 ?>

  <div id="derecho" class="appform tabcontent">
    <div class="card profile-card-action-icons">
      <div class="card-section">
        <div class="profile-card-header">
          <div class="profile-card-author">
            <h5 class="author-title">Derecho</h5>
          </div>
        </div>
        <div class="profile-card-about">
          <h5 class="about-title separator-left"> Derecho <?php //echo $name?></h5>


          <!-- <form id="create-eco-venosa-form" name="create-eco-venosa-form" method="post"> -->
          <div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Sistema Venoso Profundo</h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->


            <!-- vena_femoral_comun_der -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Vena Femoral común</label>
                    
                      <input type="radio" id="vfc_1_der" name="vena_femoral_comun_der" value="permeable_suficiente" <?php 
                      if( $radiobox_vena_femoral_comun_der && in_array('permeable_suficiente', $radiobox_vena_femoral_comun_der) )  echo "checked";?> 
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfc_1_der">Permeable y suficiente</label>

                      <input type="radio" id="vfc_2_der" name="vena_femoral_comun_der" value="permeable_insuficiente" <?php 
                      if( $radiobox_vena_femoral_comun_der && in_array('permeable_insuficiente', $radiobox_vena_femoral_comun_der) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfc_2_der">Permeable insuficiente</label>         

                      <input type="radio" id="vfc_3_der" name="vena_femoral_comun_der" value="ocluido" <?php 
                      if( $radiobox_vena_femoral_comun_der && in_array('ocluido', $radiobox_vena_femoral_comun_der) )  echo "checked";?>  
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfc_3_der">Ocluido</label>

                      <input type="radio" id="vfc_4_der" name="vena_femoral_comun_der" value="recanalizado" <?php 
                      if( $radiobox_vena_femoral_comun_der && in_array('recanalizado', $radiobox_vena_femoral_comun_der) )  echo "checked";?>  
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfc_4_der">Recanalizado</label>

            </div>

            <!-- vena_femoral_superficial_der -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Vena Femoral superficial</label>
                    
                    <input type="radio" id="vfs_1_der" name="vena_femoral_superficial_der" value="permeable_suficiente" <?php 
                      if( $radiobox_vena_femoral_superficial_der && in_array('permeable_suficiente', $radiobox_vena_femoral_superficial_der) )  echo "checked";?> 
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfs_1_der">Permeable y suficiente</label>

                      <input type="radio" id="vfs_2_der" name="vena_femoral_superficial_der" value="permeable_insuficiente" <?php 
                      if( $radiobox_vena_femoral_superficial_der && in_array('permeable_insuficiente', $radiobox_vena_femoral_superficial_der) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfs_2_der">Permeable insuficiente</label>         

                      <input type="radio" id="vfs_3_der" name="vena_femoral_superficial_der" value="ocluido" <?php 
                      if( $radiobox_vena_femoral_superficial_der && in_array('ocluido', $radiobox_vena_femoral_superficial_der) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfs_3_der">Ocluido</label>

                      <input type="radio" id="vfs_4_der" name="vena_femoral_superficial_der" value="recanalizado" <?php 
                      if( $radiobox_vena_femoral_superficial_der && in_array('recanalizado', $radiobox_vena_femoral_superficial_der) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfs_4_der">Recanalizado</label>
        
            </div>

            <!-- vena_poplitea_der -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Vena poplítea</label>
                    
                    <input type="radio" id="vfp_1_der" name="vena_poplitea_der[]" value="permeable_suficiente" <?php 
                      if( $radiobox_vena_poplitea_der && in_array('permeable_suficiente', $radiobox_vena_poplitea_der) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfp_1_der">Permeable y suficiente</label>

                      <input type="radio" id="vfp_2_der" name="vena_poplitea_der[]" value="permeable_insuficiente" <?php 
                      if( $radiobox_vena_poplitea_der && in_array('permeable_insuficiente', $radiobox_vena_poplitea_der) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfp_2_der">Permeable insuficiente</label>       

                      <input type="radio" id="vfp_3_der" name="vena_poplitea_der[]" value="ocluido" <?php 
                      if( $radiobox_vena_poplitea_der && in_array('ocluido', $radiobox_vena_poplitea_der) )  echo "checked";?> 
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfp_3_der">Ocluido</label>

                      <input type="radio" id="vfp_4_der" name="vena_poplitea_der[]" value="recanalizado" <?php 
                      if( $radiobox_vena_poplitea_der && in_array('recanalizado', $radiobox_vena_poplitea_der) )  echo "checked";?> 
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfp_4_der">Recanalizado</label>

            </div>

            <!-- plexo_soleo_y_gemelar_der -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Plexo soleo y gemelar</label>
                    
                    <input type="radio" id="psg_1_der" name="plexo_soleo_y_gemelar_der" value="permeable_suficiente" <?php 
                      if( $radiobox_plexo_soleo_y_gemelar_der && $radiobox_plexo_soleo_y_gemelar_der["value"] == "permeable_suficiente" ){

                        // var_dump($radiobox_plexo_soleo_y_gemelar_der["value"]);
                        echo "checked"; } ?>

                        
                      
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="psg_1_der">Permeable y suficiente</label>

                      <input type="radio" id="psg_2_der" name="plexo_soleo_y_gemelar_der" value="permeable_insuficiente" <?php 
                      if( $radiobox_plexo_soleo_y_gemelar_der && $radiobox_plexo_soleo_y_gemelar_der["value"] == "permeable_insuficiente" )  
                      
                      {

                        echo "checked"; }

                      ?>
                      
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="psg_2_der">Permeable insuficiente</label>         

                      <input type="radio" id="psg_3_der" name="plexo_soleo_y_gemelar_der" value="ocluido" <?php 
                      if( $radiobox_plexo_soleo_y_gemelar_der && $radiobox_plexo_soleo_y_gemelar_der["value"] == "ocluido" )  echo "checked";?>
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="psg_3_der">Ocluido</label>

                      <input type="radio" id="psg_4_der" name="plexo_soleo_y_gemelar_der" value="recanalizado" <?php 
                      if( $radiobox_plexo_soleo_y_gemelar_der && $radiobox_plexo_soleo_y_gemelar_der["value"] == "recanalizado" )  echo "checked";?>
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="psg_4_der">Recanalizado</label>
            
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Sistema Venoso Superficial</h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Vena Safena Mayor</h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->


            <!-- checkbox_union_safeno_femoral_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Unión Safeno-Femoral </label>
              

                    <input type="checkbox" id="usf1_der" name="union_safeno_femoral_der[]" value="permeable_calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral_der as $field){
                        // if($field['value']=="permeable_calibre_conservado") echo "checked";
                        if( $field && in_array('permeable_calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usf1_der">Permeable de calibre conservado</label>

                  
                    <input type="checkbox" id="usf2_der" name="union_safeno_femoral_der[]" value="permeable_calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral_der as $field){
                        // if($field['value']=="permeable_calibre_aumentado") echo "checked";
                        if( $field && in_array('permeable_calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usf2_der">Permeable de calibre aumentado</label>


                    <input type="checkbox" id="usf3_der" name="union_safeno_femoral_der[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral_der as $field){
                        // if($field['value']=="suficiente") echo "checked";
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usf3_der">Suficiente</label>



                    <input type="checkbox" id="usf4_der" name="union_safeno_femoral_der[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral_der as $field){
                        // if($field['value']=="insuficiente") echo "checked";
                        if( $field && in_array('insuficiente', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="usf4_der">Insuficiente</label>



                    <input type="checkbox" id="usf5_der" name="union_safeno_femoral_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral_der as $field){
                        // if($field['value']=="ocluido") echo "checked";
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usf5_der">Ocluido</label>

            </div>  

            <!-- safeno_femoral_medida_der -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="safeno_femoral_medida_der">Medida (mm)</label>
              <input type="text" id="safeno_femoral_medida_der" name="safeno_femoral_medida_der" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $safeno_femoral_medida_der ?>" placeholder="Escribir..." required>
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="" style="font-weight: bold; padding-top: 20px;" >Vena Safena Magna (Interna)</h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->


            <!-- checkbox_tronco_suprapatelar_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Tronco suprapatelar  </label>
              

                    <input type="checkbox" id="ts1_der" name="tronco_suprapatelar_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar_der as $field){
                        // if($field['value']=="calibre_conservado") echo "checked";
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts1_der">Calibre conservado</label>

                  
                    <input type="checkbox" id="ts2_der" name="tronco_suprapatelar_der[]" value="calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar_der as $field){
                        // if($field['value']=="calibre_aumentado") echo "checked";
                        if( $field && in_array('calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts2_der">Calibre aumentado</label>



                    <input type="checkbox" id="ts3_der" name="tronco_suprapatelar_der[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar_der as $field){
                        // if($field['value']=="suficiente") echo "checked";
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts3_der">Suficiente</label>



                    <input type="checkbox" id="ts4_der" name="tronco_suprapatelar_der[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar_der as $field){
                        // if($field['value']=="insuficiente") echo "checked";
                        if( $field && in_array('insuficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts4_der">Insuficiente</label>



                    <input type="checkbox" id="ts5_der" name="tronco_suprapatelar_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar_der as $field){
                        // if($field['value']=="ocluido") echo "checked";
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts5_der">Ocluido</label>

            </div>  

            <!-- tronco_suprapatelar_medida_der -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="tronco_suprapatelar_medida_der">Medida (mm)</label>
              <input type="text" id="tronco_suprapatelar_medida_der" name="tronco_suprapatelar_medida_der" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $tronco_suprapatelar_medida_der ?>" placeholder="Escribir..." required>
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->



            <!-- checkbox_tronco_infrapatelar - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Tronco infrapatelar </label>
              

                    <input type="checkbox" id="ti1_der" name="tronco_infrapatelar_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti1_der">Calibre conservado</label>

                  
                    <input type="checkbox" id="ti2_der" name="tronco_infrapatelar_der[]" value="calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar_der as $field){
                        if( $field && in_array('calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti2_der">Calibre aumentado</label>



                    <input type="checkbox" id="ti3_der" name="tronco_infrapatelar_der[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar_der as $field){
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti3_der">Suficiente</label>



                    <input type="checkbox" id="ti4_der" name="tronco_infrapatelar_der[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar_der as $field){
                        if( $field && in_array('insuficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti4_der">Insuficiente</label>



                    <input type="checkbox" id="ti5_der" name="tronco_infrapatelar_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti5_der">Ocluido</label>

            </div>  

            <!-- tronco_infrapatelar_medida_der -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="tronco_infrapatelar_medida_der">Medida (mm)</label>
              <input type="text" id="tronco_infrapatelar_medida_der" name="tronco_infrapatelar_medida_der" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $tronco_infrapatelar_medida_der ?>" placeholder="Escribir..." required>
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Vena Safena Menor</h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->


            <!-- checkbox_union_safeno_poplitea_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Unión Safeno-Poplitea </label>
              

                    <input type="checkbox" id="usp1_der" name="union_safeno_poplitea_der[]" value="permeable_calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea_der as $field){
                        if( $field && in_array('permeable_calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp1_der">Permeable de calibre conservado</label>

                  
                    <input type="checkbox" id="usp2_der" name="union_safeno_poplitea_der[]" value="permeable_calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea_der as $field){
                        if( $field && in_array('permeable_calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp2_der">Permeable de calibre aumentado</label>



                    <input type="checkbox" id="usp3_der" name="union_safeno_poplitea_der[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea_der as $field){
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp3_der">Suficiente</label>



                    <input type="checkbox" id="usp4_der" name="union_safeno_poplitea_der[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea_der as $field){
                        if( $field && in_array('insuficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp4_der">Insuficiente</label>



                    <input type="checkbox" id="usp5_der" name="union_safeno_poplitea_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp5_der">Ocluido</label>

            </div>  

            <!-- union_safeno_poplitea_medida_der -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="union_safeno_poplitea_medida_der">Medida (mm)</label>
              <input type="text" id="union_safeno_poplitea_medida_der" name="union_safeno_poplitea_medida_der" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $union_safeno_poplitea_medida_der ?>" placeholder="Escribir..." required>
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->

            <!-- checkbox_vena_safena_parva_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Vena Safena Parva (Externa) </label>
              

                    <input type="checkbox" id="vsp1_der" name="vena_safena_parva_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp1_der">Calibre conservado</label>

                  
                    <input type="checkbox" id="vsp2_der" name="vena_safena_parva_der[]" value="calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva_der as $field){
                        if( $field && in_array('calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp2_der">Calibre aumentado</label>



                    <input type="checkbox" id="vsp3_der" name="vena_safena_parva_der[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva_der as $field){
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp3_der">Suficiente</label>



                    <input type="checkbox" id="vsp4_der" name="vena_safena_parva_der[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva_der as $field){
                        if( $field && in_array('insuficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp4_der">Insuficiente</label>



                    <input type="checkbox" id="vsp5_der" name="vena_safena_parva_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp5_der">Ocluido</label>

            </div>  

            <!-- vena_safena_parva_medida_der -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="vena_safena_parva_medida_der">Medida (mm)</label>
              <input type="text" id="vena_safena_parva_medida_der" name="vena_safena_parva_medida_der" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $vena_safena_parva_medida_der ?>" placeholder="Escribir..." required>
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Sistemas Perforantes  </h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->

            <!-- checkbox_venas_perforantes_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Venas Perforantes </label>
              

                    <input type="checkbox" id="vp1_der" name="venas_perforantes_der[]" value="se_visualizan" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_venas_perforantes_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_venas_perforantes_der as $field){
                        if( $field && in_array('se_visualizan', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vp1_der">Se visualizan</label>

                  
                    <input type="checkbox" id="vp2_der" name="venas_perforantes_der[]" value="no_se_visualizan" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_venas_perforantes_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_venas_perforantes_der as $field){
                        if( $field && in_array('no_se_visualizan', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vp_der">No se visualizan</label>



                    <input type="checkbox" id="vp3_der" name="venas_perforantes_der[]" value="planta_pie" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_venas_perforantes_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_venas_perforantes_der as $field){
                        if( $field && in_array('planta_pie', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vp3_der">De la planta del pie</label>



                    <input type="checkbox" id="vp4_der" name="venas_perforantes_der[]" value="rodilla" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_venas_perforantes_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_venas_perforantes_der as $field){
                        if( $field && in_array('rodilla', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vp4_der">De la rodilla</label>

            </div>  

            <!-- venas_perforantes_medida_der -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="venas_perforantes_medida_der">Medida (cm)</label>
              <input type="text" id="venas_perforantes_medida_der" name="venas_perforantes_medida_der" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $venas_perforantes_medida_der ?>" placeholder="Escribir..." required>
            </div>



            <!-- observaciones_der -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="observaciones_der">Observaciones</label>
              <textarea id="observaciones_der" name="observaciones_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $observaciones_der ?></textarea>
            </div>

            <!-- conclusion_der -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="conclusion_der">Conclusion</label>
              <textarea id="conclusion_der" name="conclusion_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $conclusion_der ?></textarea>
            </div>

            <!-- pegar aca la seccion: IMAGENES -->

            <!-- IMAGENES -->
            <div id="imagenes-eco-ven-der" class="archivos large-12 columns" style="margin-top: 1.5rem;">
            
              <div class="profile-card-about">
                <h5 class="about-title separator-left"> Ingresar imágenes de la ecografía </h5>
              </div>
              <div class="subir-colpo test">
                <label for="imagen_eco_venosa_der">Seleccionar imágenes (png, jpg )</label>
                <input type="file" id="imagen_eco_venosa_der" name="imagen_eco_venosa_der" accept=".jpg, .jpeg, .png" multiple>
              </div>

              <?php 
              //if ($image) { cerrar el php
              if (sizeof($images_ids_array_der)>0) { ?>
                <div class="preview-der test">
                <ol>
                  <?php  
                  $k = 0; 
                  foreach ($images_array_der as $image) { ?>        
                    <li>  
                        <img class="image-class" alt="" src="<?php echo $image[0]; ?>" />
                        <p>Nombre del archivo <?php echo $images_names_der[$k]; ?> </p>
                    </li>
                  
                  <?php
                  $k++;
                  } ?>

                </ol>
                </div> <?php
              }else{ ?>
                <div class="preview-der no-files">
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