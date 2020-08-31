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
    // var_dump($checkbox_union_safeno_femoral[1]["value"]);
    // checkbox_union_safeno_femoral
    // var_dump($radiobox_plexo_soleo_y_gemelar["value"]);


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
    
    $observaciones = isset($eco_venosa_data_post['observaciones'][0]) ? $eco_venosa_data_post['observaciones'][0] : NULL;
    $conclusion = isset($eco_venosa_data_post['conclusion'][0]) ? $eco_venosa_data_post['conclusion'][0] : NULL;
    
    
    
    
 ?>


  <div class="tab">
      <button class="tablinks dabbed" >Izquierdo</button>
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

          <form id="create-eco-venosa-form" name="create-eco-venosa-form" method="post" >
          <input type="hidden" name="action" value="sw_create_eco_venosa_ajax">
          <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          <input type="hidden" name="eco_venosa_post_id" value="<?= $eco_venosa_post_id?>">
        
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Sistema Venoso Profundo</h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->


            <!-- vena_femoral_comun -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Vena Femoral común</label>
                    
                      <input type="radio" id="vfc_1" name="vena_femoral_comun" value="permeable_suficiente" <?php 
                      if( $radiobox_vena_femoral_comun && in_array('permeable_suficiente', $radiobox_vena_femoral_comun) )  echo "checked";?> 
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfc_1">Permeable y suficiente</label>

                      <input type="radio" id="vfc_2" name="vena_femoral_comun" value="permeable_insuficiente" <?php 
                      if( $radiobox_vena_femoral_comun && in_array('permeable_insuficiente', $radiobox_vena_femoral_comun) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfc_2">Permeable insuficiente</label>         

                      <input type="radio" id="vfc_3" name="vena_femoral_comun" value="ocluido" <?php 
                      if( $radiobox_vena_femoral_comun && in_array('ocluido', $radiobox_vena_femoral_comun) )  echo "checked";?>  
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfc_3">Ocluido</label>

                      <input type="radio" id="vfc_4" name="vena_femoral_comun" value="recanalizado" <?php 
                      if( $radiobox_vena_femoral_comun && in_array('recanalizado', $radiobox_vena_femoral_comun) )  echo "checked";?>  
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfc_4">Recanalizado</label>

            </div>

            <!-- vena_femoral_superficial -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Vena Femoral superficial</label>
                    
                    <input type="radio" id="vfs_1" name="vena_femoral_superficial" value="permeable_suficiente" <?php 
                      if( $radiobox_vena_femoral_superficial && in_array('permeable_suficiente', $radiobox_vena_femoral_superficial) )  echo "checked";?> 
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfs_1">Permeable y suficiente</label>

                      <input type="radio" id="vfs_2" name="vena_femoral_superficial" value="permeable_insuficiente" <?php 
                      if( $radiobox_vena_femoral_superficial && in_array('permeable_insuficiente', $radiobox_vena_femoral_superficial) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfs_2">Permeable insuficiente</label>         

                      <input type="radio" id="vfs_3" name="vena_femoral_superficial" value="ocluido" <?php 
                      if( $radiobox_vena_femoral_superficial && in_array('ocluido', $radiobox_vena_femoral_superficial) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfs_3">Ocluido</label>

                      <input type="radio" id="vfs_4" name="vena_femoral_superficial" value="recanalizado" <?php 
                      if( $radiobox_vena_femoral_superficial && in_array('recanalizado', $radiobox_vena_femoral_superficial) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfs_4">Recanalizado</label>
        
            </div>

            <!-- vena_poplitea -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Vena poplítea</label>
                    
                    <input type="radio" id="vfp_1" name="vena_poplitea[]" value="permeable_suficiente" <?php 
                      if( $radiobox_vena_poplitea && in_array('permeable_suficiente', $radiobox_vena_poplitea) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfp_1">Permeable y suficiente</label>

                      <input type="radio" id="vfp_2" name="vena_poplitea[]" value="permeable_insuficiente" <?php 
                      if( $radiobox_vena_poplitea && in_array('permeable_insuficiente', $radiobox_vena_poplitea) )  echo "checked";?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfp_2">Permeable y suficiente</label>       

                      <input type="radio" id="vfp_3" name="vena_poplitea[]" value="ocluido" <?php 
                      if( $radiobox_vena_poplitea && in_array('ocluido', $radiobox_vena_poplitea) )  echo "checked";?> 
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfp_3">Ocluido</label>

                      <input type="radio" id="vfp_4" name="vena_poplitea[]" value="recanalizado" <?php 
                      if( $radiobox_vena_poplitea && in_array('recanalizado', $radiobox_vena_poplitea) )  echo "checked";?> 
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="vfp_4">Recanalizado</label>

            </div>

            <!-- plexo_soleo_y_gemelar -->
            <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left ">
                    <label class="separator-left">Plexo soleo y gemelar</label>
                    
                    <input type="radio" id="psg_1" name="plexo_soleo_y_gemelar" value="permeable_suficiente" <?php 
                      if( $radiobox_plexo_soleo_y_gemelar && $radiobox_plexo_soleo_y_gemelar["value"] == "permeable_suficiente" ){

                        // var_dump($radiobox_plexo_soleo_y_gemelar["value"]);
                        echo "checked"; } ?>

                        
                      
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="psg_1">Permeable y suficiente</label>

                      <input type="radio" id="psg_2" name="plexo_soleo_y_gemelar" value="permeable_insuficiente" <?php 
                      if( $radiobox_plexo_soleo_y_gemelar && $radiobox_plexo_soleo_y_gemelar["value"] == "permeable_insuficiente" )  
                      
                      {

                        echo "checked"; }

                      ?>
                      
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="psg_2">Permeable insuficiente</label>         

                      <input type="radio" id="psg_3" name="plexo_soleo_y_gemelar" value="ocluido" <?php 
                      if( $radiobox_plexo_soleo_y_gemelar && $radiobox_plexo_soleo_y_gemelar["value"] == "ocluido" )  echo "checked";?>
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="psg_3">Ocluido</label>

                      <input type="radio" id="psg_4" name="plexo_soleo_y_gemelar" value="recanalizado" <?php 
                      if( $radiobox_plexo_soleo_y_gemelar && $radiobox_plexo_soleo_y_gemelar["value"] == "recanalizado" )  echo "checked";?>
                      class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                      <label for="psg_4">Recanalizado</label>
            
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


            <!-- checkbox_union_safeno_femoral - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Unión Safeno-Femoral </label>
              

                    <input type="checkbox" id="usf1" name="union_safeno_femoral[]" value="permeable_calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral as $field){
                        // if($field['value']=="permeable_calibre_conservado") echo "checked";
                        if( $field && in_array('permeable_calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usf1">Permeable de calibre conservado</label>

                  
                    <input type="checkbox" id="usf2" name="union_safeno_femoral[]" value="permeable_calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral as $field){
                        // if($field['value']=="permeable_calibre_aumentado") echo "checked";
                        if( $field && in_array('permeable_calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usf2">Permeable de calibre aumentado</label>


                    <input type="checkbox" id="usf3" name="union_safeno_femoral[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral as $field){
                        // if($field['value']=="suficiente") echo "checked";
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usf3">Suficiente</label>



                    <input type="checkbox" id="usf4" name="union_safeno_femoral[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral as $field){
                        // if($field['value']=="insuficiente") echo "checked";
                        if( $field && in_array('insuficiente', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="usf4">Insuficiente</label>



                    <input type="checkbox" id="usf5" name="union_safeno_femoral[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_femoral ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_femoral as $field){
                        // if($field['value']=="ocluido") echo "checked";
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usf5">Ocluido</label>

            </div>  

            <!-- safeno_femoral_medida -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="safeno_femoral_medida">Medida (mm)</label>
              <input type="text" id="safeno_femoral_medida" name="safeno_femoral_medida" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $safeno_femoral_medida ?>" placeholder="Escribir..." required>
            </div>


            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="" style="font-weight: bold; padding-top: 20px;" >Vena Safena Magna (Interna)</h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->


            <!-- checkbox_tronco_suprapatelar - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Tronco suprapatelar  </label>
              

                    <input type="checkbox" id="ts1" name="tronco_suprapatelar[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar as $field){
                        // if($field['value']=="calibre_conservado") echo "checked";
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts1">Calibre conservado</label>

                  
                    <input type="checkbox" id="ts2" name="tronco_suprapatelar[]" value="calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar as $field){
                        // if($field['value']=="calibre_aumentado") echo "checked";
                        if( $field && in_array('calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts2">Calibre aumentado</label>



                    <input type="checkbox" id="ts3" name="tronco_suprapatelar[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar as $field){
                        // if($field['value']=="suficiente") echo "checked";
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts3">Suficiente</label>



                    <input type="checkbox" id="ts4" name="tronco_suprapatelar[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar as $field){
                        // if($field['value']=="insuficiente") echo "checked";
                        if( $field && in_array('insuficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts4">Insuficiente</label>



                    <input type="checkbox" id="ts5" name="tronco_suprapatelar[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_suprapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_suprapatelar as $field){
                        // if($field['value']=="ocluido") echo "checked";
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ts5">Ocluido</label>

            </div>  

            <!-- tronco_suprapatelar_medida -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="tronco_suprapatelar_medida">Medida (mm)</label>
              <input type="text" id="tronco_suprapatelar_medida" name="tronco_suprapatelar_medida" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $tronco_suprapatelar_medida ?>" placeholder="Escribir..." required>
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->


            <!-- checkbox_tronco_infrapatelar - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Tronco infrapatelar </label>
              

                    <input type="checkbox" id="ti1" name="tronco_infrapatelar[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti1">Calibre conservado</label>

                  
                    <input type="checkbox" id="ti2" name="tronco_infrapatelar[]" value="calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar as $field){
                        if( $field && in_array('calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti2">Calibre aumentado</label>



                    <input type="checkbox" id="ti3" name="tronco_infrapatelar[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar as $field){
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti3">Suficiente</label>



                    <input type="checkbox" id="ti4" name="tronco_infrapatelar[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar as $field){
                        if( $field && in_array('insuficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti4">Insuficiente</label>



                    <input type="checkbox" id="ti5" name="tronco_infrapatelar[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_tronco_infrapatelar ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_tronco_infrapatelar as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ti5">Ocluido</label>

            </div>  

            <!-- tronco_infrapatelar_medida -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="tronco_infrapatelar_medida">Medida (mm)</label>
              <input type="text" id="tronco_infrapatelar_medida" name="tronco_infrapatelar_medida" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $tronco_infrapatelar_medida ?>" placeholder="Escribir..." required>
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Vena Safena Menor</h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->


            <!-- checkbox_union_safeno_poplitea - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Unión Safeno-Poplitea </label>
              

                    <input type="checkbox" id="usp1" name="union_safeno_poplitea[]" value="permeable_calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea as $field){
                        if( $field && in_array('permeable_calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp1">Permeable de calibre conservado</label>

                  
                    <input type="checkbox" id="usp2" name="union_safeno_poplitea[]" value="permeable_calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea as $field){
                        if( $field && in_array('permeable_calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp2">Permeable de calibre aumentado</label>



                    <input type="checkbox" id="usp3" name="union_safeno_poplitea[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea as $field){
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp3">Suficiente</label>



                    <input type="checkbox" id="usp4" name="union_safeno_poplitea[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea as $field){
                        if( $field && in_array('insuficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp4">Insuficiente</label>



                    <input type="checkbox" id="usp5" name="union_safeno_poplitea[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_union_safeno_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_union_safeno_poplitea as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="usp5">Ocluido</label>

            </div>  

            <!-- union_safeno_poplitea_medida -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="union_safeno_poplitea_medida">Medida (mm)</label>
              <input type="text" id="union_safeno_poplitea_medida" name="union_safeno_poplitea_medida" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $union_safeno_poplitea_medida ?>" placeholder="Escribir..." required>
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->

            <!-- checkbox_vena_safena_parva - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Vena Safena Parva (Externa) </label>
              

                    <input type="checkbox" id="vsp1" name="vena_safena_parva[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp1">Calibre conservado</label>

                  
                    <input type="checkbox" id="vsp2" name="vena_safena_parva[]" value="calibre_aumentado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva as $field){
                        if( $field && in_array('calibre_aumentado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp2">Calibre aumentado</label>



                    <input type="checkbox" id="vsp3" name="vena_safena_parva[]" value="suficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva as $field){
                        if( $field && in_array('suficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp3">Suficiente</label>



                    <input type="checkbox" id="vsp4" name="vena_safena_parva[]" value="insuficiente" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva as $field){
                        if( $field && in_array('insuficiente', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp4">Insuficiente</label>



                    <input type="checkbox" id="vsp5" name="vena_safena_parva[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_vena_safena_parva ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_vena_safena_parva as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vsp5">Ocluido</label>

            </div>  

            <!-- vena_safena_parva_medida -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="vena_safena_parva_medida">Medida (mm)</label>
              <input type="text" id="vena_safena_parva_medida" name="vena_safena_parva_medida" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $vena_safena_parva_medida ?>" placeholder="Escribir..." required>
            </div>

            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="small-12 columns">
              <h6 class="separator-left" style="font-weight: bold; padding-top: 20px;" >Sistemas Perforantes  </h6>
            </div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------------- -->

            <!-- checkbox_venas_perforantes - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Venas Perforantes </label>
              

                    <input type="checkbox" id="vp1" name="venas_perforantes[]" value="se_visualizan" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_venas_perforantes ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_venas_perforantes as $field){
                        if( $field && in_array('se_visualizan', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vp1">Se visualizan</label>

                  
                    <input type="checkbox" id="vp2" name="venas_perforantes[]" value="no_se_visualizan" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_venas_perforantes ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_venas_perforantes as $field){
                        if( $field && in_array('no_se_visualizan', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vp2">No se visualizan</label>



                    <input type="checkbox" id="vp3" name="venas_perforantes[]" value="planta_pie" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_venas_perforantes ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_venas_perforantes as $field){
                        if( $field && in_array('planta_pie', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vp3">De la planta del pie</label>



                    <input type="checkbox" id="vp4" name="venas_perforantes[]" value="rodilla" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_venas_perforantes ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_venas_perforantes as $field){
                        if( $field && in_array('rodilla', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="vp4">De la rodilla</label>

            </div>  

            <!-- venas_perforantes_medida -->
            <div class="floated-label-wrapper large-6 columns ">
              <label class="separator-left" for="venas_perforantes_medida">Medida (cm)</label>
              <input type="text" id="venas_perforantes_medida" name="venas_perforantes_medida" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  value="<?php echo $venas_perforantes_medida ?>" placeholder="Escribir..." required>
            </div>



            <!-- observaciones -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="observaciones">Observaciones</label>
              <textarea id="observaciones" name="observaciones" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $observaciones ?></textarea>
            </div>

            <!-- conclusion -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="conclusion">Conclusion</label>
              <textarea id="conclusion" name="conclusion" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $conclusion ?></textarea>
            </div>

            <!-- IMAGENES -->
            <div class="archivos large-12 columns" style="margin-top: 1.5rem;">
            
              <div class="profile-card-about">
                <h5 class="about-title separator-left"> Ingresar imágenes de la ecografía </h5>
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