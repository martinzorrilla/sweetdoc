<?php
    $static_data_post_id = $template_args["static_data_post_id"];
    //$static_data_array = sw_get_static_data_id($patient_id); 
    $static_data_post = get_post_custom($static_data_post_id);
    //var_dump($static_data_post);
    
    //load all the data we need from the static_data
    $cesareas = $static_data_post['cesareas'][0];
    $menarca = $static_data_post['menarca'][0];
    $irs = $static_data_post['irs'][0];
 ?>
<!-- <h3>Datos Estaticos del Paciente</h3> -->

<div class="card profile-card-action-icons">
  <div class="card-section">
    <div class="profile-card-header">
      <div class="profile-card-avatar">
        <img class="avatar-image" src="https://i.imgur.com/3AeQRbR.jpg" alt="Harry Manchanda">
      </div>
      <div class="profile-card-author">
        <h5 class="author-title">Datos Privados</h5>
        <p class="author-description">Paciente</p>
      </div>
    </div>
    <div class="profile-card-about">
      <h5 class="about-title separator-left">Aca van los campos <?php //echo $name?></h5>
      <p class="about-content">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem eveniet nulla quae ullam sit iure voluptatum, nesciunt voluptas perferendis, minus natus in quaerat?
      </p>

      <div class="floated-label-wrapper">
        <label for="cesareas">Cesareas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="cesareas" name="cesareas" value="<?php echo $cesareas ?>" placeholder="Type..." required>
      </div>

      <div class="floated-label-wrapper">
        <label for="menarca">Menarca &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="menarca" name="menarca" value="<?php echo $menarca ?>" placeholder="Type..." required>
      </div>

      <div class="floated-label-wrapper">
        <label for="irs">IRS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        <input type="text" id="irs" name="irs" value="<?php echo $irs ?>" placeholder="Type..." required>
      </div>
      
    </div>
  </div>
</div>