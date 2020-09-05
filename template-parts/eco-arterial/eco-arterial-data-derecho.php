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
    $max_images_der = 5;
    $images_ids_array_der = array();
    // +1 bc 
    $k = 0;
    for ($i=0; $i < $max_images_der; $i++) {
      $k = $i+1;
      $text = 'eco_arterial_imagen_der_'.$k;
      //$the_image_id = $eco_arterial_data_post[$text][0]; // esta linea de codigo funciona pero da un warning the undefined  index cuando el elemento esta vacio
      // $the_image_id = $eco_arterial_data_post[$text][0];
      $the_image_id = isset($eco_arterial_data_post[$text][0]) ? $eco_arterial_data_post[$text][0] : NULL;

//       var_dump($the_image_id);
      if ($the_image_id != "" && $the_image_id != NULL) {
         $images_ids_array_der[$i] = $the_image_id;
       }   
    }
    // echo("<br>" );
    // echo("der:" );
    // var_dump($images_ids_array_der);
    // $images_ids_array;

    //$image_post_id = $eco_arterial_data_post['eco_arterial_imagen_1'][0];
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
$checkbox_arteria_femoral_comun_der =  get_field('arteria_femoral_comun_der', $eco_arterial_post_id);
$afc_obs_der =  isset($eco_arterial_data_post['afc_obs_der'][0]) ? $eco_arterial_data_post['afc_obs_der'][0] : NULL;
$checkbox_afc_flujo_der =  get_field('afc_flujo_der', $eco_arterial_post_id);

$checkbox_arteria_femoral_profunda_der =  get_field('arteria_femoral_profunda_der', $eco_arterial_post_id);
// fsdfsdf
$afp_obs_der =  isset($eco_arterial_data_post['afp_obs_der'][0]) ? $eco_arterial_data_post['afp_obs_der'][0] : NULL;
$checkbox_afp_flujo_der =  get_field('afp_flujo_der', $eco_arterial_post_id);


$checkbox_arteria_femoral_superficial_der =  get_field('arteria_femoral_superficial_der', $eco_arterial_post_id);
$afs_obs_der =  isset($eco_arterial_data_post['afs_obs_der'][0]) ? $eco_arterial_data_post['afs_obs_der'][0] : NULL;
$checkbox_afs_flujo_der =  get_field('afs_flujo_der', $eco_arterial_post_id);


$checkbox_arteria_poplitea_der =  get_field('arteria_poplitea_der', $eco_arterial_post_id);
$ap_obs_der =  isset($eco_arterial_data_post['ap_obs_der'][0]) ? $eco_arterial_data_post['ap_obs_der'][0] : NULL;
$checkbox_ap_flujo_der =  get_field('ap_flujo_der', $eco_arterial_post_id);


$checkbox_arteria_tibial_anterior_der =  get_field('arteria_tibial_anterior_der', $eco_arterial_post_id);
$ata_obs_der =  isset($eco_arterial_data_post['ata_obs_der'][0]) ? $eco_arterial_data_post['ata_obs_der'][0] : NULL;
$checkbox_ata_flujo_der =  get_field('ata_flujo_der', $eco_arterial_post_id);

$checkbox_arteria_tibial_posterior_der =  get_field('arteria_tibial_posterior_der', $eco_arterial_post_id);
$atp_obs_der =  isset($eco_arterial_data_post['atp_obs_der'][0]) ? $eco_arterial_data_post['atp_obs_der'][0] : NULL;
$checkbox_atp_flujo_der =  get_field('atp_flujo_der', $eco_arterial_post_id);

$checkbox_arteria_fibular_peroneal_der =  get_field('arteria_fibular_peroneal_der', $eco_arterial_post_id);
$arfipe_obs_der =  isset($eco_arterial_data_post['arfipe_obs_der'][0]) ? $eco_arterial_data_post['arfipe_obs_der'][0] : NULL;
$checkbox_arfipe_flujo_der =  get_field('arfipe_flujo_der', $eco_arterial_post_id);

$checkbox_arteria_pedia_der =  get_field('arteria_pedia_der', $eco_arterial_post_id);
$arpe_obs_der =  isset($eco_arterial_data_post['arpe_obs_der'][0]) ? $eco_arterial_data_post['arpe_obs_der'][0] : NULL;
$checkbox_arpe_flujo_der =  get_field('arpe_flujo_der', $eco_arterial_post_id);

$conclusion_der =  isset($eco_arterial_data_post['conclusion_der'][0]) ? $eco_arterial_data_post['conclusion_der'][0] : NULL;

    
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


          <!-- <form id="der_create-eco-arterial-form" name="create-eco-arterial-form" method="post"> -->
          <div>

            <!-- checkbox_arteria_femoral_comun_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Femoral Común </label>
              

                    <input type="checkbox" id="der_afc1" name="arteria_femoral_comun_der[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun_der as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afc1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="der_afc2" name="arteria_femoral_comun_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afc2">Calibre conservado</label>


                    <input type="checkbox" id="der_afc3" name="arteria_femoral_comun_der[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun_der as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afc3">Calibre disminuido</label>



                    <input type="checkbox" id="der_afc4" name="arteria_femoral_comun_der[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun_der as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afc4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="der_afc5" name="arteria_femoral_comun_der[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun_der as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afc5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="der_afc6" name="arteria_femoral_comun_der[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun_der as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afc6">Con placas ateromatosas</label>


                    <input type="checkbox" id="der_afc7" name="arteria_femoral_comun_der[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun_der as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afc7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="der_afc8" name="arteria_femoral_comun_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_comun_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_comun_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afc8">Ocluido</label>

            </div>  

            <!-- afc_obs_der -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="der_afc_obs">Observaciones</label>
              <textarea id="der_afc_obs" name="afc_obs_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $afc_obs_der ?></textarea>
            </div>

            <!-- checkbox_afc_flujo_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="der_afcflujo1" name="afc_flujo_der[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afc_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afc_flujo_der as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afcflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="der_afcflujo2" name="afc_flujo_der[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afc_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afc_flujo_der as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afcflujo2">Bifásico</label>


                    <input type="checkbox" id="der_afcflujo3" name="afc_flujo_der[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afc_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afc_flujo_der as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afcflujo3">Trifásico</label>



                    <input type="checkbox" id="der_afcflujo4" name="afc_flujo_der[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afc_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afc_flujo_der as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afcflujo4">Sin flujo</label>
            </div>  

 <!-- -------------------- ************* ------------------- **************** -------------------------- -->

            <!-- checkbox_arteria_femoral_profunda_der- checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Femoral Profunda </label>
              

                    <input type="checkbox" id="der_arfepro1" name="arteria_femoral_profunda_der[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda_der as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfepro1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="der_arfepro2" name="arteria_femoral_profunda_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfepro2">Calibre conservado</label>


                    <input type="checkbox" id="der_arfepro3" name="arteria_femoral_profunda_der[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda_der as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfepro3">Calibre disminuido</label>



                    <input type="checkbox" id="der_arfepro4" name="arteria_femoral_profunda_der[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda_der as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arfepro4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="der_arfepro5" name="arteria_femoral_profunda_der[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda_der as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arfepro5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="der_arfepro6" name="arteria_femoral_profunda_der[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda_der as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arfepro6">Con placas ateromatosas</label>


                    <input type="checkbox" id="der_arfepro7" name="arteria_femoral_profunda_der[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda_der as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arfepro7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="der_arfepro8" name="arteria_femoral_profunda_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_profunda_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_profunda_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfepro8">Ocluido</label>

            </div>  

            <!-- afp_obs --> 
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="der_afp_obs">Observaciones</label>
              <textarea id="der_afp_obs" name="afp_obs_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $afp_obs_der ?></textarea>
            </div>

            <!-- checkbox_afp_flujo_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="der_afpflujo1" name="afp_flujo_der[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afp_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afp_flujo_der as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afpflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="der_afpflujo2" name="afp_flujo_der[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afp_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afp_flujo_der as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afpflujo2">Bifásico</label>


                    <input type="checkbox" id="der_afpflujo3" name="afp_flujo_der[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afp_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afp_flujo_der as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afpflujo3">Trifásico</label>



                    <input type="checkbox" id="der_afpflujo4" name="afp_flujo_der[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afp_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afp_flujo_der as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afpflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_femoral_superficial_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Femoral Superficial </label>
              

                    <input type="checkbox" id="der_afs1" name="arteria_femoral_superficial_der[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial_der as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afs1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="der_afs2" name="arteria_femoral_superficial_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afs2">Calibre conservado</label>


                    <input type="checkbox" id="der_afs3" name="arteria_femoral_superficial_der[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial_der as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afs3">Calibre disminuido</label>



                    <input type="checkbox" id="der_afs4" name="arteria_femoral_superficial_der[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial_der as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afs4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="der_afs5" name="arteria_femoral_superficial_der[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial_der as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afs5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="der_afs6" name="arteria_femoral_superficial_der[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial_der as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afs6">Con placas ateromatosas</label>


                    <input type="checkbox" id="der_afs7" name="arteria_femoral_superficial_der[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial_der as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afs7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="der_afs8" name="arteria_femoral_superficial_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_femoral_superficial_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_femoral_superficial_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afs8">Ocluido</label>

            </div>  

            <!-- afs_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="der_afs_obs">Observaciones</label>
              <textarea id="der_afs_obs" name="afs_obs_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $afs_obs_der ?></textarea>
            </div>

            <!-- checkbox_afs_flujo_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="der_afsflujo1" name="afs_flujo_der[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afs_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afs_flujo_der as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afsflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="der_afsflujo2" name="afs_flujo_der[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afs_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afs_flujo_der as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afsflujo2">Bifásico</label>


                    <input type="checkbox" id="der_afsflujo3" name="afs_flujo_der[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afs_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afs_flujo_der as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_afsflujo3">Trifásico</label>



                    <input type="checkbox" id="der_afsflujo4" name="afs_flujo_der[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_afs_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_afs_flujo_der as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_afsflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_poplitea_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Arteria poplítea </label>
              

                    <input type="checkbox" id="der_ap1" name="arteria_poplitea_der[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea_der as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ap1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="der_ap2" name="arteria_poplitea_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ap2">Calibre conservado</label>


                    <input type="checkbox" id="der_ap3" name="arteria_poplitea_der[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea_der as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ap3">Calibre disminuido</label>



                    <input type="checkbox" id="der_ap4" name="arteria_poplitea_der[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea_der as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_ap4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="der_ap5" name="arteria_poplitea_der[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea_der as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_ap5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="der_ap6" name="arteria_poplitea_der[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea_der as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_ap6">Con placas ateromatosas</label>


                    <input type="checkbox" id="der_ap7" name="arteria_poplitea_der[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea_der as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_ap7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="der_ap8" name="arteria_poplitea_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_poplitea_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_poplitea_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ap8">Ocluido</label>

            </div>  

            <!-- ap_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="der_ap_obs">Observaciones</label>
              <textarea id="der_ap_obs" name="ap_obs_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $ap_obs_der ?></textarea>
            </div>

            <!-- checkbox_ap_flujo_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="der_apflujo1" name="ap_flujo_der[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ap_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ap_flujo_der as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_apflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="der_apflujo2" name="ap_flujo_der[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ap_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ap_flujo_der as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_apflujo2">Bifásico</label>


                    <input type="checkbox" id="der_apflujo3" name="ap_flujo_der[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ap_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ap_flujo_der as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_apflujo3">Trifásico</label>



                    <input type="checkbox" id="der_apflujo4" name="ap_flujo_der[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ap_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ap_flujo_der as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_apflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_tibial_anterior_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Tíbial Anterior </label>
              

                    <input type="checkbox" id="der_ata1" name="arteria_tibial_anterior_der[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior_der as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ata1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="der_ata2" name="arteria_tibial_anterior_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ata2">Calibre conservado</label>


                    <input type="checkbox" id="der_ata3" name="arteria_tibial_anterior_der[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior_der as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ata3">Calibre disminuido</label>



                    <input type="checkbox" id="der_ata4" name="arteria_tibial_anterior_der[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior_der as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_ata4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="der_ata5" name="arteria_tibial_anterior_der[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior_der as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_ata5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="der_ata6" name="arteria_tibial_anterior_der[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior_der as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_ata6">Con placas ateromatosas</label>


                    <input type="checkbox" id="der_ata7" name="arteria_tibial_anterior_der[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior_der as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_ata7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="der_ata8" name="arteria_tibial_anterior_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_anterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_anterior_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ata8">Ocluido</label>

            </div>  

            <!-- ata_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="der_ata_obs">Observaciones</label>
              <textarea id="der_ata_obs" name="ata_obs_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $ata_obs_der ?></textarea>
            </div>

            <!-- checkbox_ata_flujo_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="der_ataflujo1" name="ata_flujo_der[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ata_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ata_flujo_der as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ataflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="der_ataflujo2" name="ata_flujo_der[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ata_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ata_flujo_der as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ataflujo2">Bifásico</label>


                    <input type="checkbox" id="der_ataflujo3" name="ata_flujo_der[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ata_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ata_flujo_der as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_ataflujo3">Trifásico</label>



                    <input type="checkbox" id="der_ataflujo4" name="ata_flujo_der[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_ata_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_ata_flujo_der as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_ataflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->

            <!-- checkbox_arteria_tibial_posterior_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Tibial Posterior </label>
              

                    <input type="checkbox" id="der_atp1" name="arteria_tibial_posterior_der[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior_der as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_atp1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="der_atp2" name="arteria_tibial_posterior_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_atp2">Calibre conservado</label>


                    <input type="checkbox" id="der_atp3" name="arteria_tibial_posterior_der[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior_der as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_atp3">Calibre disminuido</label>



                    <input type="checkbox" id="der_atp4" name="arteria_tibial_posterior_der[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior_der as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_atp4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="der_atp5" name="arteria_tibial_posterior_der[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior_der as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_atp5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="der_atp6" name="arteria_tibial_posterior_der[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior_der as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_atp6">Con placas ateromatosas</label>


                    <input type="checkbox" id="der_atp7" name="arteria_tibial_posterior_der[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior_der as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_atp7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="der_atp8" name="arteria_tibial_posterior_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_tibial_posterior_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_tibial_posterior_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_atp8">Ocluido</label>

            </div>  

            <!-- atp_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="der_atp_obs">Observaciones</label>
              <textarea id="der_atp_obs" name="atp_obs_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $atp_obs_der ?></textarea>
            </div>

            <!-- checkbox_atp_flujo_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="der_atpflujo1" name="atp_flujo_der[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_atp_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_atp_flujo_der as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_atpflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="der_atpflujo2" name="atp_flujo_der[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_atp_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_atp_flujo_der as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_atpflujo2">Bifásico</label>


                    <input type="checkbox" id="der_atpflujo3" name="atp_flujo_der[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_atp_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_atp_flujo_der as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_atpflujo3">Trifásico</label>



                    <input type="checkbox" id="der_atpflujo4" name="atp_flujo_der[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_atp_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_atp_flujo_der as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_atpflujo4">Sin flujo</label>
            </div>

 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_fibular_peroneal_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria fibular (Peroneal):  </label>
              

                    <input type="checkbox" id="der_arfipe1" name="arteria_fibular_peroneal_der[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal_der as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfipe1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="der_arfipe2" name="arteria_fibular_peroneal_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfipe2">Calibre conservado</label>


                    <input type="checkbox" id="der_arfipe3" name="arteria_fibular_peroneal_der[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal_der as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfipe3">Calibre disminuido</label>



                    <input type="checkbox" id="der_arfipe4" name="arteria_fibular_peroneal_der[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal_der as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arfipe4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="der_arfipe5" name="arteria_fibular_peroneal_der[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal_der as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arfipe5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="der_arfipe6" name="arteria_fibular_peroneal_der[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal_der as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arfipe6">Con placas ateromatosas</label>


                    <input type="checkbox" id="der_arfipe7" name="arteria_fibular_peroneal_der[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal_der as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arfipe7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="der_arfipe8" name="arteria_fibular_peroneal_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_fibular_peroneal_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_fibular_peroneal_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfipe8">Ocluido</label>

            </div>  

            <!-- arfipe_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="der_arfipe_obs">Observaciones</label>
              <textarea id="der_arfipe_obs" name="arfipe_obs_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $arfipe_obs_der ?></textarea>
            </div>

            <!-- checkbox_arfipe_flujo_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="der_arfipeflujo1" name="arfipe_flujo_der[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arfipe_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arfipe_flujo_der as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfipeflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="der_arfipeflujo2" name="arfipe_flujo_der[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arfipe_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arfipe_flujo_der as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfipeflujo2">Bifásico</label>


                    <input type="checkbox" id="der_arfipeflujo3" name="arfipe_flujo_der[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arfipe_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arfipe_flujo_der as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arfipeflujo3">Trifásico</label>



                    <input type="checkbox" id="der_arfipeflujo4" name="arfipe_flujo_der[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arfipe_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arfipe_flujo_der as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arfipeflujo4">Sin flujo</label>
            </div>

 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- checkbox_arteria_pedia_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Artéria Pedia </label>
              

                    <input type="checkbox" id="der_arpe1" name="arteria_pedia_der[]" value="pared_regular" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia_der as $field){
                        if( $field && in_array('pared_regular', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arpe1">Presenta pared regular</label>

                  
                    <input type="checkbox" id="der_arpe2" name="arteria_pedia_der[]" value="calibre_conservado" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia_der as $field){
                        if( $field && in_array('calibre_conservado', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arpe2">Calibre conservado</label>


                    <input type="checkbox" id="der_arpe3" name="arteria_pedia_der[]" value="calibre_disminuido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia_der as $field){
                        if( $field && in_array('calibre_disminuido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arpe3">Calibre disminuido</label>



                    <input type="checkbox" id="der_arpe4" name="arteria_pedia_der[]" value="dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia_der as $field){
                        if( $field && in_array('dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arpe4">Se evidencia dilatacíones</label>


                    <input type="checkbox" id="der_arpe5" name="arteria_pedia_der[]" value="no_dilataciones" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia_der as $field){
                        if( $field && in_array('no_dilataciones', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arpe5">No se evidencia dilatacíones</label>



                    <input type="checkbox" id="der_arpe6" name="arteria_pedia_der[]" value="placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia_der as $field){
                        if( $field && in_array('placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arpe6">Con placas ateromatosas</label>


                    <input type="checkbox" id="der_arpe7" name="arteria_pedia_der[]" value="sin_placas_ateromatosas" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia_der as $field){
                        if( $field && in_array('sin_placas_ateromatosas', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arpe7">Sin placas ateromatosas</label>

                    <input type="checkbox" id="der_arpe8" name="arteria_pedia_der[]" value="ocluido" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arteria_pedia_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arteria_pedia_der as $field){
                        if( $field && in_array('ocluido', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arpe8">Ocluido</label>

            </div>  

            <!-- arpe_obs -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="der_arpe_obs">Observaciones</label>
              <textarea id="der_arpe_obs" name="arpe_obs_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $arpe_obs_der ?></textarea>
            </div>

            <!-- checkbox_arpe_flujo_der - checkbox -->
            <!-- <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content"> -->
            <div class="floated-label-wrapper small-12 columns checkbox-radio text-left ">
                <label class="separator-left"> Flujo </label>
              

                    <input type="checkbox" id="der_arpeflujo1" name="arpe_flujo_der[]" value="monofasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arpe_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arpe_flujo_der as $field){
                        if( $field && in_array('monofasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arpeflujo1">Monofásico</label>

                  
                    <input type="checkbox" id="der_arpeflujo2" name="arpe_flujo_der[]" value="bifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arpe_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arpe_flujo_der as $field){
                        if( $field && in_array('bifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arpeflujo2">Bifásico</label>


                    <input type="checkbox" id="der_arpeflujo3" name="arpe_flujo_der[]" value="trifasico" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arpe_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arpe_flujo_der as $field){
                        if( $field && in_array('trifasico', $field) )  echo "checked";
                      }                    
                    }
                    ?> >
                    <label for="der_arpeflujo3">Trifásico</label>



                    <input type="checkbox" id="der_arpeflujo4" name="arpe_flujo_der[]" value="sin_flujo " class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
                    <?php 
                    if( $checkbox_arpe_flujo_der ){ //si esta vacio genera un error, por eso hay que verificar antes
                      foreach ($checkbox_arpe_flujo_der as $field){
                        if( $field && in_array('sin_flujo ', $field) )  echo "checked";

                      }                    
                    }
                    ?> >
                    <label for="der_arpeflujo4">Sin flujo</label>
            </div>


 <!-- -------------------- ************* ------------------- **************** -------------------------- -->


            <!-- conclusion_der -->
            <div class="floated-label-wrapper large-12 columns end">
              <label class="separator-left" for="der_conclusion">Conclusion</label>
              <textarea id="der_conclusion" name="conclusion_der" placeholder="Escribir..." style="height:7em" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?>  required><?php echo $conclusion_der ?></textarea>
            </div>

            <!-- pegar aca la seccion: IMAGENES -->

            <!-- IMAGENES -->
            <div id="imagenes-eco-art-der" class="archivos large-12 columns" style="margin-top: 1.5rem;">
            
              <div class="profile-card-about">
                <h5 class="about-title separator-left"> Ingresar imágenes de la ecografía </h5>
              </div>
              <div class="subir-colpo test">
                <label for="imagen_eco_arterial_der">Seleccionar imágenes (png, jpg )</label>
                <input type="file" id="imagen_eco_arterial_der" name="imagen_eco_arterial_der" accept=".jpg, .jpeg, .png" multiple>
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