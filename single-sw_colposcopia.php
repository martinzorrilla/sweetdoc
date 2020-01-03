<?php get_header();?>

<?php
  $colposcopy_pdf_url = home_url().'/pdf-colpo/?colpo_id='; 
  //the id of the post in the current loop. witch is the patient
  $post_id = get_the_ID(); 
  //echo $post_id;
  $colpo_data_post = get_post_custom($post_id);
  //var_dump($colpo_data_post);

  $patient_id = $colpo_data_post['colpo_related_patient'][0]; 
  //var_dump($patient_id);

  //get images
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


  //actual data of the colposcopy
  $macroscopia = $colpo_data_post['macroscopia'][0];
?>

  <style>

    .colpo-imagenes ol {
      padding-left: 0;
      margin-left: 0px;
    }

    .colpo-imagenes li {
      /* background: #eee; */
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      list-style-type: none;
    }

  </style>


<h1 style="text-align: center; margin-left: 50px;">Colposcopia del PacienteX</h1>

<?php 
  //como prueba de concepto. si el usuario es doctor muestra estos campos si no, no
$result = "";
$result = sw_get_current_user_role();

//en produccion: verificar que el usuario sea doctor
//if($result == "doctor"){
if(true){
  hm_get_template_part('template-parts/appointment/patient-data', ['patient_id' => $patient_id]);
?>


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
        <input type="text" id="macroscopia" name="macroscopia" value="<?php echo $macroscopia ?>" placeholder="Type..." readonly="readonly">
      </div>
    
    </div>
  </div>
</div>


<!-- imagenes -->

<div class="colpo-imagenes">
      
          <h4>Imagenes</h4>

        <?php 
        //if ($image) { cerrar el php
        if (sizeof($images_ids_array)>0) { ?>
          <div class="preview">
          <ol>
            
            <?php  
            $k = 0; 
            foreach ($images_array as $image) { ?>
            <li>


              <div class="card profile-card-action-icons">
                <div class="card-section">
                  <div class="profile-card-header">
                    <div class="profile-card-avatar">
                      <img class="avatar-image" src="<?php bloginfo('template_url')?>/src/assets/images/pepaicon.jpg" alt="Peppa Pig">
                    </div>
                    <div class="profile-card-author">
                      <h5 class="author-title">Imagen</h5>
                      <!-- <p class="author-description">Paciente</p> -->
                    </div>
                  </div>
                  <div class="profile-card-about">
                    <h5 class="about-title separator-left">Nombre del archivo: <?php echo $images_names[$k]; ?>
                    </h5>

                    <img class="image-class" alt="" src="<?php echo $image[0]; ?>" />

                  </div>
                </div>
              </div>
              
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

  <div class="button-div">

    <a href="<?php echo esc_url( $colposcopy_pdf_url ).$r; ?>" target="_blank" 
      <button id="create-colposcopy-pdf" class="save-button-expanded" type="submit" value="Next">Generar Colposcopia PDF</button>
    </a>
    
    <p class="errorWrapper"></p>
  </div>

<?php
 } //if result == doctor
?> 


<?php get_footer();?>