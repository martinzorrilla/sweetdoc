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
 ?>
<!-- <h3>Datos Estaticos del Paciente</h3> -->

  <style>

    .archivos {
      font-family: sans-serif;
      /* width: 600px; */
      width: 100%;
      /* background: #ccc; */
      margin: 0 auto;
      padding: 20px;
      border: 1px solid black;
    }

    .archivos ol {
      padding-left: 0;
    }

    .archivos li, .archivos div > p {
      background: #eee;
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      list-style-type: none;
      border: 1px solid black;
    }

    .archivos img {
      height: 64px;
      order: 1;
    }

    .archivos p {
      line-height: 32px;
      padding-left: 10px;
    }

    .archivos label, .archivos button {
      background-color: #7F9CCB;
      padding: 5px 10px;
      border-radius: 5px;
      border: 1px ridge black;
      font-size: 0.8rem;
      height: auto;
    }

    .archivos label:hover, .archivos button:hover {
      background-color: #2D5BA3;
      color: white;
    }

    .archivos label:active, .archivos button:active {
      background-color: #0D3F8F;
      color: white;
    }
  </style>


<div class="card profile-card-action-icons">
  <div class="card-section">
    <div class="profile-card-header">
      <div class="profile-card-avatar">
        <img class="avatar-image" src="<?php bloginfo('template_url')?>/src/assets/images/pepaicon.jpg" alt="Peppa Pig">
      </div>
      <div class="profile-card-author">
        <h5 class="author-title">Colposcopia</h5>
        <p class="author-description">Paciente</p>
      </div>
    </div>
    <div class="profile-card-about">
      <h5 class="about-title separator-left">Aca van los campos de la Colposcopia <?php //echo $name?></h5>
      <p class="about-content">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem eveniet nulla quae ullam sit iure voluptatum, nesciunt voluptas perferendis, minus natus in quaerat?
      </p>

      <div class="floated-label-wrapper">
        <label for="macroscopia">Macroscopia &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="macroscopia" name="macroscopia" value="<?php echo $macroscopia ?>" placeholder="Type..." required>
      </div>

      <br>
      <!-- Testing the image uploader -->
      <!-- 
      <div class="floated-label-wrapper">

      <input type="file" accepts="jpg,jpeg,png" name="profile_photo" id="profile_photo" class="inputfile" multiple style="opacity: 0;" />
    
      <label class="filelabel" for="file" style="border: 2px solid black;">
      Choose file</label>
      </div> 
      -->
      <!-- Testing the image uploader -->

      <div class="archivos">

        <div>
          <label for="image_uploads">Seleccione las imagenes (PNG, JPG)</label>
          <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" multiple>
        </div>

        <?php 
        //if ($image) { cerrar el php
        if (sizeof($images_ids_array)>0) { ?>
          <div class="preview">
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
          <div class="preview">
            <p>No hay archivos seleccionados</p>
          </div> <?php  
        } 
        ?>
      </div> <!-- div.archivos -->
    
    </div>
  </div>
</div>