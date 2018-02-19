<?php
    $appointment_post_id = $template_args["appointment_id"];
    //var_dump($appointment_post_id);
    $appointment_id = get_post($appointment_post_id);
    $menarca = get_field('menarca', $appointment_id);
    $irs = get_field('irs', $appointment_id);
    //var_dump($menarca);
 ?>
<h3>Antecedentes GO</h3>

<div class="card profile-card-action-icons">
  <div class="card-section">
    <div class="profile-card-header">
      <div class="profile-card-avatar">
        <img class="avatar-image" src="https://i.imgur.com/3AeQRbR.jpg" alt="Harry Manchanda">
      </div>
      <div class="profile-card-author">
        <h5 class="author-title"><?php echo $fullname?></h5>
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
            <li>Menarca: <?php echo $menarca ?></li>
            <li>IRS: <?php echo $irs ?></li>
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