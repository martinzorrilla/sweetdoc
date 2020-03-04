<?php
    $colpo_post_id = $template_args["colpo_post_id"]; 
    $colpo_data_post = get_post_custom($colpo_post_id);
    //var_dump($colpo_data_post);
    //load all the data we need from the colpscopy post-------
  
    //image files
    //store the ids of the images post
    $max_images = 5;
    $images_ids_array = array();
    // +1 bc 
    for ($i=0; $i < $max_images; $i++) {
      $k = $i+1;
      $text = 'colpo_imagen_'.$k;
      $the_image_id = $colpo_data_post[$text][0];
    //var_dump($text);
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
    $macroscopia = $colpo_data_post['macroscopia'][0];
    $colposcopia = $colpo_data_post['colposcopia'][0];
    $radiobox_evaluacion_general = get_field('evaluacion_general', $colpo_post_id); 
    // $motivo_inadecuada = $colpo_data_post['motivo_inadecuada'][0];
    $checkbox_motivo_inadecuada = get_field('motivo_inadecuada', $colpo_post_id);
    $union_escamo_columnar = $colpo_data_post['union_escamo_columnar'][0];
    $zona_de_transformacion = $colpo_data_post['zona_de_transformacion'][0];
    $colposcopicos_normales = $colpo_data_post['colposcopicos_normales'][0];

    $colposcopicos_anormales_grado_1 = $colpo_data_post['colposcopicos_anormales_grado_1'][0];
    $colposcopicos_anormales_grado_2 = $colpo_data_post['colposcopicos_anormales_grado_2'][0];
    $colposcopicos_anormales_no_especificos = $colpo_data_post['colposcopicos_anormales_no_especificos'][0];
    $colposcopicos_anormales_test_de_schiller = $colpo_data_post['colposcopicos_anormales_test_de_schiller'][0];
    $colposcopicos_anormales_ubicacion = $colpo_data_post['colposcopicos_anormales_ubicacion'][0]; 
    $sospecha_de_invasion = $colpo_data_post['sospecha_de_invasion'][0];
    $hallazgos_varios = $colpo_data_post['hallazgos_varios'][0];
    $examen_de_vyv = $colpo_data_post['examen_de_vyv'][0];
    $examen_de_vyv_descripcion = $colpo_data_post['examen_de_vyv_descripcion'][0];
    
    
            // motivo_inadecuada
        // union_escamo_columnar
        // zona_de_transformacion
        // colposcopicos_normales
        // colposcopicos_anormales_grado_1
        // colposcopicos_anormales_grado_2
        // colposcopicos_anormales_no_especificos
        // colposcopicos_anormales_test_de_schiller
        // colposcopicos_anormales_ubicacion
        // sospecha_de_invasion
        // hallazgos_varios
        // examen_de_vyv
        // examen_de_vyv_descripcion
    
 ?>

<div class="card profile-card-action-icons">
  <div class="card-section">
    <div class="profile-card-header">
      <div class="profile-card-author">
        <h5 class="author-title">Informe Colposcopico</h5>
      </div>
    </div>
    <div class="profile-card-about row">
      <h5 class="about-title separator-left"> Ingresar datos de la Colposcopia <?php //echo $name?></h5>

      <!-- macroscopia -->
      <div class="floated-label-wrapper large-6 columns ">
        <label class="separator-left" for="macroscopia">Macroscopia &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="macroscopia" name="macroscopia" value="<?php echo $macroscopia ?>" placeholder="Escribir..." required>
      </div>

      <!-- colposcopia -->
      <div class="floated-label-wrapper large-6 columns">
        <label class="separator-left" for="colposcopia">Colposcopia &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopia" name="colposcopia" value="<?php echo $colposcopia ?>" placeholder="Escribir..." required>
      </div>

      <!-- evaluacion_general -->
      <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left grid-content">
              <label class="separator-left">Evaluación general</label>
              
                <input type="radio" id="adecuada" name="evaluacion_general" value="adecuada" <?php if ($radiobox_evaluacion_general == "adecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="adecuada">Adecuada</label>

                <input type="radio" id="inadecuada" name="evaluacion_general" value="inadecuada" <?php if ($radiobox_evaluacion_general == "inadecuada") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="inadecuada">Inadecuada</label>         
      </div>


      <!-- checkbox_motivo_inadecuadas - checkbox -->
      <div class="floated-label-wrapper small-12 columns checkbox-radio text-left grid-content">
          <label class="separator-left">checkbox_motivo_inadecuada</label>
        

              <input type="checkbox" id="inflamacion" name="motivo_inadecuada[]" value="inflamacion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
              <?php 
              if( $checkbox_motivo_inadecuada != NULL || $checkbox_motivo_inadecuada != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                if(in_array("inflamacion", $checkbox_motivo_inadecuada)) echo "checked";
              }
              ?> >
              <label for="inflamacion">inflamacion</label>

              <input type="checkbox" id="atrofia_severa" name="motivo_inadecuada[]" value="atrofia_severa" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
              <?php 
              if( $checkbox_motivo_inadecuada != NULL || $checkbox_motivo_inadecuada != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                if(in_array("atrofia_severa", $checkbox_motivo_inadecuada)) echo "checked";
              }
              ?> >
              <label for="atrofia_severa">atrofia_severa</label>

              <input type="checkbox" id="cicatriz" name="motivo_inadecuada[]" value="cicatriz" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
              <?php 
              if( $checkbox_motivo_inadecuada != NULL || $checkbox_motivo_inadecuada != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                if(in_array("cicatriz", $checkbox_motivo_inadecuada)) echo "checked";
              }
              ?> >
              <label for="cicatriz">cicatriz</label>


              <input type="checkbox" id="no_visualizacion" name="motivo_inadecuada[]" value="no_visualizacion" class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> 
              <?php 
              if( $checkbox_motivo_inadecuada != NULL || $checkbox_motivo_inadecuada != "" ){ //si esta vacio genera un error, por eso hay que verificar antes
                if(in_array("no_visualizacion", $checkbox_motivo_inadecuada)) echo "checked";
              }
              ?> >
              <label for="no_visualizacion">no_visualizacion</label>

      </div>  

      <!-- union_escamo_columnar -->
        <div class="floated-label-wrapper large-6 columns ">
        <label for="union_escamo_columnar">union_escamo_columnar</label>
        <input type="text" id="union_escamo_columnar" name="union_escamo_columnar" value="<?php echo $union_escamo_columnar ?>" placeholder="Escribir..." required>
      </div>

      <!-- zona_de_transformacion -->
        <div class="floated-label-wrapper large-6 columns ">
        <label for="zona_de_transformacion">motivo_inadecuada</label>
        <input type="text" id="zona_de_transformacion" name="zona_de_transformacion" value="<?php echo $zona_de_transformacion ?>" placeholder="Escribir..." required>
      </div>

      <!-- Colposcopicos normales -->
      <div class="floated-label-wrapper large-6 columns ">
        <label for="colposcopicos_normales">Colposcopicos normales &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopicos_normales" name="colposcopicos_normales" value="<?php echo $colposcopicos_normales ?>" placeholder="Escribir..." required>
      </div>

      <!-- colposcopicos_anormales_grado_1 -->
      <div class="floated-label-wrapper large-6 columns ">
        <label for="colposcopicos_anormales_grado_1">colposcopicos_anormales_grado_1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopicos_anormales_grado_1" name="colposcopicos_anormales_grado_1" value="<?php echo $colposcopicos_anormales_grado_1 ?>" placeholder="Escribir..." required>
      </div>


      <!-- colposcopicos_anormales_grado_2 -->
      <div class="floated-label-wrapper large-6 columns ">
        <label for="colposcopicos_anormales_grado_2">colposcopicos_anormales_grado_2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopicos_anormales_grado_2" name="colposcopicos_anormales_grado_2" value="<?php echo $colposcopicos_anormales_grado_2 ?>" placeholder="Escribir..." required>
      </div>

      <!-- colposcopicos_anormales_no_especificoss -->
        <div class="floated-label-wrapper large-6 columns ">
        <label for="colposcopicos_anormales_no_especificos">colposcopicos_anormales_no_especificos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopicos_anormales_no_especificos" name="colposcopicos_anormales_no_especificos" value="<?php echo $colposcopicos_anormales_no_especificos ?>" placeholder="Escribir..." required>
      </div>

      <!-- colposcopicos_anormales_test_de_schiller -->
        <div class="floated-label-wrapper large-6 columns ">
        <label for="colposcopicos_anormales_test_de_schiller">colposcopicos_anormales_test_de_schiller &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopicos_anormales_test_de_schiller" name="colposcopicos_anormales_test_de_schiller" value="<?php echo $colposcopicos_anormales_test_de_schiller ?>" placeholder="Escribir..." required>
      </div>


      <!-- colposcopicos_anormales_ubicacion -->
        <div class="floated-label-wrapper large-6 columns ">
        <label for="colposcopicos_anormales_ubicacion">colposcopicos_anormales_ubicacion &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopicos_anormales_ubicacion" name="colposcopicos_anormales_ubicacion" value="<?php echo $colposcopicos_anormales_ubicacion ?>" placeholder="Escribir..." required>
      </div>

      <!-- Sospecha de invasion -->
      <div class="floated-label-wrapper large-6 columns ">
        <label for="sospecha_de_invasion">Sospecha de invasion &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="sospecha_de_invasion" name="sospecha_de_invasion" value="<?php echo $sospecha_de_invasion ?>" placeholder="Escribir..." required>
      </div>

      <!-- hallazgos_varios -->
      <div class="floated-label-wrapper large-6 columns ">
        <label for="hallazgos_varios">Hallazgos varios &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="hallazgos_varios" name="hallazgos_varios" value="<?php echo $hallazgos_varios ?>" placeholder="Escribir..." required>
      </div>

      <!-- Examen de vagina y vulva -->
      <div class="floated-label-wrapper large-6 columns ">
        <label for="examen_de_vyv">Examen de vagina y vulva &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="examen_de_vyv" name="examen_de_vyv" value="<?php echo $examen_de_vyv ?>" placeholder="Escribir..." required>
      </div>

      <!-- Descripcio Examen de vagina y vulva -->
      <div class="floated-label-wrapper large-12 columns end">
        <label for="examen_de_vyv_descripcion">Descripción &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="examen_de_vyv_descripcion" name="examen_de_vyv_descripcion" value="<?php echo $examen_de_vyv_descripcion ?>" placeholder="Escribir..." required>
      </div>

      <!-- Testing the image uploader -->
      <!-- 
      <div class="floated-label-wrapper">

      <input type="file" accepts="jpg,jpeg,png" name="profile_photo" id="profile_photo" class="inputfile" multiple style="opacity: 0;" />
    
      <label class="filelabel" for="file" style="border: 2px solid black;">
      Choose file</label>
      </div> 
      -->
      <!-- Testing the image uploader -->

      <div class="archivos large-12 columns">
      <h5 class="about-title separator-left"> Imagenes <?php //echo $name?></h5>

        <div class="subir-colpo test">
          <label for="image_uploads">Seleccionar imagenes (png, jpg )</label>
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
    
    </div>
  </div>
</div>