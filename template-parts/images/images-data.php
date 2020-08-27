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
    // $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
    $size = "large"; // (thumbnail, medium, large, full or custom size)
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
      <button class="tablinks dabbed" >Imágenes</button>
  </div>

  <div class="appform tabcontent">
    <div class="card profile-card-action-icons">
      <div class="card-section">
        <div class="profile-card-header">
          <div class="profile-card-author">
            <!-- <h5 class="author-title">Imágenes</h5> -->
          </div>
        </div>
        <div class="profile-card-about">
          <h5 class="about-title separator-left"> Adjuntar imágenes </h5>

          <form id="create-colposcopy-form" name="create-colposcopy-form" method="post" >
          <input type="hidden" name="action" value="sw_create_colpo_ajax">
          <input type="hidden" name="patient_id" value="<?php echo $patient_id;?>">
          <input type="hidden" name="app_id" value="<?= $app_id?>">
          <input type="hidden" name="colpo_post_id" value="<?= $colpo_post_id?>">
          




          
            <!-- IMAGENES -->
            <div class="archivos large-12 columns" style="margin-top: 1.5rem;">
            
              <div class="profile-card-about">
                <!-- <h5 class="about-title separator-left"> Adjuntar imágenes </h5> -->
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