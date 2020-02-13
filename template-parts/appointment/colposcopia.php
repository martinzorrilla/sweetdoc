<?php
    $colpo_post_id = $template_args["colpo_post_id"]; 
    $colpo_data_post = get_post_custom($colpo_post_id);
    //var_dump($colpo_data_post);
    $radiobox_epitelio = get_field('epitelio_escamoso', $colpo_post_id); 
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

    $evaluacion_general = $colpo_data_post['evaluacion_general'][0];
    $colposcopicos_normales = $colpo_data_post['colposcopicos_normales'][0];
    $colposcopicos_anormales = $colpo_data_post['colposcopicos_anormales'][0];
    $sospecha_de_invasion = $colpo_data_post['sospecha_de_invasion'][0];
    $hallazgos_varios = $colpo_data_post['hallazgos_varios'][0];
    $examen_de_vyv = $colpo_data_post['examen_de_vyv'][0];
    
    
    
    
 ?>

<div class="card profile-card-action-icons">
  <div class="card-section">
    <div class="profile-card-header">
      <div class="profile-card-author">
        <h5 class="author-title">Colposcopia</h5>
      </div>
    </div>
    <div class="profile-card-about row">
      <h5 class="about-title separator-left"> Ingresar datos de la Colposcopia <?php //echo $name?></h5>

      <div class="floated-label-wrapper large-6 columns ">
        <label for="macroscopia">Macroscopia &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="macroscopia" name="macroscopia" value="<?php echo $macroscopia ?>" placeholder="Escribir..." required>
      </div>

      <div class="floated-label-wrapper large-6 columns">
        <label for="colposcopia">Colposcopia &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopia" name="colposcopia" value="<?php echo $colposcopia ?>" placeholder="Escribir..." required>
      </div>

      <div class="floated-label-wrapper small-12 medium-12 columns checkbox-radio text-left grid-content">
              <label class="separator-left">Epitelio escamoso original</label>
              
                <input type="radio" id="maduro" name="epitelio_escamoso" value="maduro" <?php if ($radiobox_epitelio == "maduro") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="maduro">Maduro</label>

                <input type="radio" id="atrofico" name="epitelio_escamoso" value="atrofico" <?php if ($radiobox_epitelio == "atrofico") echo "checked"; ?> class="disableable-input" <?php if($is_editable == "false")  echo "disabled"; ?> >
                <label for="atrofico">Atrófico</label>         
      </div>

      <!-- evaluacion general -->
      <div class="floated-label-wrapper large-6 columns ">
        <label for="evaluacion_general">Evaluacion general</label>
        <input type="text" id="evaluacion_general" name="evaluacion_general" value="<?php echo $evaluacion_general ?>" placeholder="Escribir..." required>
      </div>

      <!-- Colposcopicos normales -->
      <div class="floated-label-wrapper large-6 columns ">
        <label for="colposcopicos_normales">Colposcopicos normales &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopicos_normales" name="colposcopicos_normales" value="<?php echo $colposcopicos_normales ?>" placeholder="Escribir..." required>
      </div>

      <!-- Hallazgos colposcopicos anormales -->
      <div class="floated-label-wrapper large-6 columns ">
        <label for="colposcopicos_anormales">Hallazgos colposcopicos anormales &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="colposcopicos_anormales" name="colposcopicos_anormales" value="<?php echo $colposcopicos_anormales ?>" placeholder="Escribir..." required>
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