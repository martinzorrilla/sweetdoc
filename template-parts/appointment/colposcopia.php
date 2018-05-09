<?php
    $colpo_post_id = $template_args["colpo_post_id"]; 
    $colpo_data_post = get_post_custom($colpo_post_id);
    
    //load all the data we need from the static_data
    $macroscopia = $colpo_data_post['macroscopia'][0];
    
    //$image =  get_post_custom(460);
    //$colpo_imagen = $image['_wp_attached_file'][0];
     //var_dump($colpo_imagen); 
      
    //$image = $colpo_imagen['url'];
    //echo "image url: ".$image;
    //var_dump($image);
 ?>
<!-- <h3>Datos Estaticos del Paciente</h3> -->

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
      
        <div class="floated-label-wrapper">
          <!-- <input type="file" accepts="jpg,jpeg,png" id="profile_photo" name="profile_photo" placeholder="Type..." required>&nbsp; -->

          <input type="file" accepts="jpg,jpeg,png" name="profile_photo" id="profile_photo" class="inputfile"/>
          <label class="filelabel" for="file">Choose file</label>

          <p class="filetext">(No file chosen)<br/>.jpg, .gif and .png Max file size 700K<br/>For best quality use a 330x330 pixel image.<span class="user-email"></span></p> 
          
        </div>
      <!-- Testing the image uploader -->
      
    </div>
  </div>
</div>