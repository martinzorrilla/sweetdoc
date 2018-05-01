<?php
  $patient_id = $template_args["patient_id"];
  //load all the data we need from the Patient Post
  $patient_fields = get_post_custom($patient_id);
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  $cedula = $patient_fields['cedula'][0];
  $fullname = $name.' '.$lastname;
 ?>

  <div class="card profile-card-action-icons">
    <div class="card-section">
      <div class="profile-card-header">
        <div class="profile-card-avatar">
          <img class="avatar-image" src="<?php bloginfo('template_url')?>/src/assets/images/pepaicon.jpg" alt="Peppa Pig">
        </div>
        <div class="profile-card-author">
          <h5 class="author-title"><?php echo $fullname." ci:".$cedula ?></h5>
          <p class="author-description">Paciente</p>
        </div>
      </div>
      <div class="profile-card-about">
        <h5 class="about-title separator-left">Acerca de <?php echo $name?></h5>
        <p class="about-content">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem eveniet nulla quae ullam sit iure voluptatum, nesciunt voluptas perferendis, minus natus in quaerat?
        </p>

        <br>
        <h5 class="about-title separator-left">Ultimo estudios</h5>
        
        <div class="row about-skills">
          <div class="small-6 columns">
            <ul class="arrow">
              <li>Ecografia</li>
              <li>Colposcopia</li>
              <li>Analisis de Sangre</li>
            </ul>
          </div>
          <div class="small-6 columns">
            <ul class="arrow">
              <li>Maths</li>
              <li>Dancing</li>
              <li>Smiling</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>