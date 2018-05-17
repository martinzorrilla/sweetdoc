<?php
    $colpo_post_id = $template_args["colpo_post_id"]; 
    $colpo_data_post = get_post_custom($colpo_post_id);
    //load all the data we need from the colpscopy post
      
    //image files 
    $image_post_id = $colpo_data_post['colpo_imagen'][0];
    
    //to get the image name if it has
    $image_post = get_post_custom( $image_post_id ); 
    $image_name = $image_post["_wp_attached_file"][0];
    //var_dump($image_name);

    //to get the image
    $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
    //$attachment_id = get_field('colpo_imagen', $colpo_post_id );
    //$image = wp_get_attachment_image_src( $attachment_id, $size );
    $image = wp_get_attachment_image_src( $image_post_id, $size );
    // url = $image[0];
    // width = $image[1];
    // height = $image[2]; 
    //var_dump($attachment_id);

    //$image = $colpo_imagen['url'];
    //echo "image url: ".$image;
    //var_dump($image);
    
    //field files
    $macroscopia = $colpo_data_post['macroscopia'][0];
 ?>
<!-- <h3>Datos Estaticos del Paciente</h3> -->

 <style>

.archivos {
  font-family: sans-serif;
  width: 600px;
  background: #ccc;
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
        if ($image) { ?>
          <div class="preview">
          <ol>
            <li>
              <img class="image-class" alt="" src="<?php echo $image[0]; ?>" />
              <p>Nombre del archivo <?php echo $image_name; ?> </p>
            </li>
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