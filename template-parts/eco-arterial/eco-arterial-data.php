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
                <label class="separator-left"> Artéria Femoral Común </label>
              

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

 <!-- -------------------- ************* ------------------- **************** -------------------------- -->

            <!-- checkbox_arteria_femoral_profunda- checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Femoral Profunda </label>
              

                    <input type="checkbox" id="arfepro1" name="arteria_femoral_profunda[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfepro1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="arfepro2" name="arteria_femoral_profunda[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfepro2">Calibre conservado</label>


                    <input type="checkbox" id="arfepro3" name="arteria_femoral_profunda[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfepro3">Calibre disminuido</label>



                    <input type="checkbox" id="arfepro4" name="arteria_femoral_profunda[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arfepro4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="arfepro5" name="arteria_femoral_profunda[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arfepro5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="arfepro6" name="arteria_femoral_profunda[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arfepro6">Con placas ateromatosas</label>


                    <input type="checkbox" id="arfepro7" name="arteria_femoral_profunda[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arfepro7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="arfepro8" name="arteria_femoral_profunda[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfepro8">Ocluido</label>

            </div>  

            <!-- afp_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="afp_obs">Observaciones</label>
              <textarea id="afp_obs" name="afp_obs" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $afp_obs ?></textarea>
            </div>

            <!-- checkbox_afp_flujo - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="afpflujo1" name="afp_flujo[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afp_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afp_flujo as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afpflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="afpflujo2" name="afp_flujo[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afp_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afp_flujo as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afpflujo2">Bifásico</label>


                    <input type="checkbox" id="afpflujo3" name="afp_flujo[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afp_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afp_flujo as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afpflujo3">Trifásico</label>



                    <input type="checkbox" id="afpflujo4" name="afp_flujo[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afp_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afp_flujo as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afpflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_femoral_superficial - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Femoral Superficial </label>
              

                    <input type="checkbox" id="afs1" name="arteria_femoral_superficial[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afs1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="afs2" name="arteria_femoral_superficial[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afs2">Calibre conservado</label>


                    <input type="checkbox" id="afs3" name="arteria_femoral_superficial[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afs3">Calibre disminuido</label>



                    <input type="checkbox" id="afs4" name="arteria_femoral_superficial[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afs4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="afs5" name="arteria_femoral_superficial[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afs5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="afs6" name="arteria_femoral_superficial[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afs6">Con placas ateromatosas</label>


                    <input type="checkbox" id="afs7" name="arteria_femoral_superficial[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afs7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="afs8" name="arteria_femoral_superficial[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afs8">Ocluido</label>

            </div>  

            <!-- afs_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="afs_obs">Observaciones</label>
              <textarea id="afs_obs" name="afs_obs" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $afs_obs ?></textarea>
            </div>

            <!-- checkbox_afs_flujo - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="afsflujo1" name="afs_flujo[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afs_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afs_flujo as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afsflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="afsflujo2" name="afs_flujo[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afs_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afs_flujo as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afsflujo2">Bifásico</label>


                    <input type="checkbox" id="afsflujo3" name="afs_flujo[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afs_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afs_flujo as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="afsflujo3">Trifásico</label>



                    <input type="checkbox" id="afsflujo4" name="afs_flujo[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afs_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afs_flujo as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="afsflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_poplitea - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Arteria poplítea </label>
              

                    <input type="checkbox" id="ap1" name="arteria_poplitea[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ap1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="ap2" name="arteria_poplitea[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ap2">Calibre conservado</label>


                    <input type="checkbox" id="ap3" name="arteria_poplitea[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ap3">Calibre disminuido</label>



                    <input type="checkbox" id="ap4" name="arteria_poplitea[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="ap4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="ap5" name="arteria_poplitea[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="ap5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="ap6" name="arteria_poplitea[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="ap6">Con placas ateromatosas</label>


                    <input type="checkbox" id="ap7" name="arteria_poplitea[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="ap7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="ap8" name="arteria_poplitea[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ap8">Ocluido</label>

            </div>  

            <!-- ap_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="ap_obs">Observaciones</label>
              <textarea id="ap_obs" name="ap_obs" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $ap_obs ?></textarea>
            </div>

            <!-- checkbox_ap_flujo - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="apflujo1" name="ap_flujo[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ap_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ap_flujo as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="apflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="apflujo2" name="ap_flujo[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ap_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ap_flujo as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="apflujo2">Bifásico</label>


                    <input type="checkbox" id="apflujo3" name="ap_flujo[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ap_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ap_flujo as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="apflujo3">Trifásico</label>



                    <input type="checkbox" id="apflujo4" name="ap_flujo[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ap_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ap_flujo as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="apflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_tibial_anterior - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Tíbial Anterior </label>
              

                    <input type="checkbox" id="ata1" name="arteria_tibial_anterior[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ata1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="ata2" name="arteria_tibial_anterior[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ata2">Calibre conservado</label>


                    <input type="checkbox" id="ata3" name="arteria_tibial_anterior[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ata3">Calibre disminuido</label>



                    <input type="checkbox" id="ata4" name="arteria_tibial_anterior[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="ata4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="ata5" name="arteria_tibial_anterior[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="ata5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="ata6" name="arteria_tibial_anterior[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="ata6">Con placas ateromatosas</label>


                    <input type="checkbox" id="ata7" name="arteria_tibial_anterior[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="ata7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="ata8" name="arteria_tibial_anterior[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ata8">Ocluido</label>

            </div>  

            <!-- ata_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="ata_obs">Observaciones</label>
              <textarea id="ata_obs" name="ata_obs" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $ata_obs ?></textarea>
            </div>

            <!-- checkbox_ata_flujo - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="ataflujo1" name="ata_flujo[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ata_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ata_flujo as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ataflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="ataflujo2" name="ata_flujo[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ata_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ata_flujo as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ataflujo2">Bifásico</label>


                    <input type="checkbox" id="ataflujo3" name="ata_flujo[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ata_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ata_flujo as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="ataflujo3">Trifásico</label>



                    <input type="checkbox" id="ataflujo4" name="ata_flujo[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ata_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ata_flujo as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="ataflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->

            <!-- checkbox_arteria_tibial_posterior - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Tibial Posterior </label>
              

                    <input type="checkbox" id="atp1" name="arteria_tibial_posterior[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="atp1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="atp2" name="arteria_tibial_posterior[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="atp2">Calibre conservado</label>


                    <input type="checkbox" id="atp3" name="arteria_tibial_posterior[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="atp3">Calibre disminuido</label>



                    <input type="checkbox" id="atp4" name="arteria_tibial_posterior[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="atp4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="atp5" name="arteria_tibial_posterior[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="atp5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="atp6" name="arteria_tibial_posterior[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="atp6">Con placas ateromatosas</label>


                    <input type="checkbox" id="atp7" name="arteria_tibial_posterior[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="atp7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="atp8" name="arteria_tibial_posterior[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="atp8">Ocluido</label>

            </div>  

            <!-- atp_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="atp_obs">Observaciones</label>
              <textarea id="atp_obs" name="atp_obs" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $atp_obs ?></textarea>
            </div>

            <!-- checkbox_atp_flujo - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="atpflujo1" name="atp_flujo[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_atp_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_atp_flujo as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="atpflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="atpflujo2" name="atp_flujo[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_atp_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_atp_flujo as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="atpflujo2">Bifásico</label>


                    <input type="checkbox" id="atpflujo3" name="atp_flujo[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_atp_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_atp_flujo as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="atpflujo3">Trifásico</label>



                    <input type="checkbox" id="atpflujo4" name="atp_flujo[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_atp_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_atp_flujo as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="atpflujo4">Sin flujo</label>
            </div>

 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_fibular_peroneal - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria fibular (Peroneal):  </label>
              

                    <input type="checkbox" id="arfipe1" name="arteria_fibular_peroneal[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfipe1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="arfipe2" name="arteria_fibular_peroneal[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfipe2">Calibre conservado</label>


                    <input type="checkbox" id="arfipe3" name="arteria_fibular_peroneal[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfipe3">Calibre disminuido</label>



                    <input type="checkbox" id="arfipe4" name="arteria_fibular_peroneal[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arfipe4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="arfipe5" name="arteria_fibular_peroneal[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arfipe5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="arfipe6" name="arteria_fibular_peroneal[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arfipe6">Con placas ateromatosas</label>


                    <input type="checkbox" id="arfipe7" name="arteria_fibular_peroneal[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arfipe7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="arfipe8" name="arteria_fibular_peroneal[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfipe8">Ocluido</label>

            </div>  

            <!-- arfipe_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="arfipe_obs">Observaciones</label>
              <textarea id="arfipe_obs" name="arfipe_obs" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $arfipe_obs ?></textarea>
            </div>

            <!-- checkbox_arfipe_flujo - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="arfipeflujo1" name="arfipe_flujo[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arfipe_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arfipe_flujo as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfipeflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="arfipeflujo2" name="arfipe_flujo[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arfipe_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arfipe_flujo as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfipeflujo2">Bifásico</label>


                    <input type="checkbox" id="arfipeflujo3" name="arfipe_flujo[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arfipe_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arfipe_flujo as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arfipeflujo3">Trifásico</label>



                    <input type="checkbox" id="arfipeflujo4" name="arfipe_flujo[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arfipe_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arfipe_flujo as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arfipeflujo4">Sin flujo</label>
            </div>

 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_pedia - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Pedia </label>
              

                    <input type="checkbox" id="arpe1" name="arteria_pedia[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arpe1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="arpe2" name="arteria_pedia[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arpe2">Calibre conservado</label>


                    <input type="checkbox" id="arpe3" name="arteria_pedia[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arpe3">Calibre disminuido</label>



                    <input type="checkbox" id="arpe4" name="arteria_pedia[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arpe4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="arpe5" name="arteria_pedia[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arpe5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="arpe6" name="arteria_pedia[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arpe6">Con placas ateromatosas</label>


                    <input type="checkbox" id="arpe7" name="arteria_pedia[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arpe7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="arpe8" name="arteria_pedia[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arpe8">Ocluido</label>

            </div>  

            <!-- arpe_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="arpe_obs">Observaciones</label>
              <textarea id="arpe_obs" name="arpe_obs" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $arpe_obs ?></textarea>
            </div>

            <!-- checkbox_arpe_flujo - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="arpeflujo1" name="arpe_flujo[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arpe_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arpe_flujo as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arpeflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="arpeflujo2" name="arpe_flujo[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arpe_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arpe_flujo as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arpeflujo2">Bifásico</label>


                    <input type="checkbox" id="arpeflujo3" name="arpe_flujo[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arpe_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arpe_flujo as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="arpeflujo3">Trifásico</label>



                    <input type="checkbox" id="arpeflujo4" name="arpe_flujo[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arpe_flujo ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arpe_flujo as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="arpeflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


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