<?php
    $colpo_post_id = $template_args["colpo_post_id"];
    //$static_data_array = sw_get_static_data_id($patient_id); 
    $colpo_data_post = get_post_custom($colpo_post_id);
    //var_dump($static_data_post);
    
    //load all the data we need from the static_data
    $macroscopia = $colpo_data_post['macroscopia'][0];
 ?>
<!-- <h3>Datos Estaticos del Paciente</h3> -->

<div class="card profile-card-action-icons">
  <div class="card-section">
    <div class="profile-card-header">
      <div class="profile-card-avatar">
        <img class="avatar-image" src="https://i.imgur.com/3AeQRbR.jpg" alt="Harry Manchanda">
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

      
    </div>
  </div>
</div>