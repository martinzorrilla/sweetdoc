<?php
    $colpo_post_id = $template_args["colpo_post_id"]; 
    $colpo_data_post = get_post_custom($colpo_post_id);
    
    //load all the data we need from the static_data
    $macroscopia = $colpo_data_post['macroscopia'][0];
    
    $image_post_id = $colpo_data_post['colpo_imagen'][0];
    //$image =  get_post_custom(460);
    //$colpo_imagen = $image['_wp_attached_file'][0];
     //var_dump($colpo_data_post); 
     $image_post = get_post_custom( $image_post_id );
     var_dump($image_post); 
     //$image_name = $image_post["_wp_attached_file"][0];
     //var_dump($image_name); 

    //$image = $colpo_imagen['url'];
    //echo "image url: ".$image;
    //var_dump($image);
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

      <!-- Testing the image uploader -->
      <br>
<!--         <div class="floated-label-wrapper">

  <input type="file" accepts="jpg,jpeg,png" name="profile_photo" id="profile_photo" class="inputfile" multiple style="opacity: 0;" />
  
  <label class="filelabel" for="file" style="border: 2px solid black;">
  Choose file</label>
</div> -->



  <div class="archivos">
    <div>
      <label for="image_uploads">Choose images to upload (PNG, JPG)</label>
      <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" multiple>
    </div>
    <div class="preview">
      <p>No files currently selected for upload</p>
    </div>
</div>







      <!-- Testing the image uploader -->
      
    </div>
  </div>
</div>