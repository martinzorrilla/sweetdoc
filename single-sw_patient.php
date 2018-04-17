<?php get_header();?>
<?php

  //the id of the post in the current loop. wich is the patient
  $post_id = get_the_ID(); 
  //echo $post_id;

  $post7 =get_post($post_id);
  $post_author = $post7->post_author; 
  echo "post author = ".$post_author."<br/>";

  $current_user = wp_get_current_user();
  $current_user_id = $current_user->ID;
  echo "logged user id = ".$current_user_id."<br/>";
  
  $usersrole = sw_get_current_user_role();
  echo "the users role : ". $usersrole;

  //$name = get_field('nombre');
  //$lastname = get_field('apellido');
  //$fullname = $name.' '.$lastname;

  $patient_fields = get_post_custom($patient_id);
  //load all the data we need from the Person Post
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  $cedula = $patient_fields['cedula'][0];
  $fullname = $name.' '.$lastname;
  ?>


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
    <div class="profile-card-action">
      <div class="action-area">
        <a href="#" class="action-anchor has-tip bottom" data-tooltip aria-haspopup="true" data-disable-hover="false" tabindex="2" title="Like Harry Profile">
          <i class="fa fb" aria-hidden="true"></i>
          <span class="show-for-sr">Like Harry Profile</span>
        </a>
      </div>
      <div class="action-area">
        <a href="#" class="action-anchor has-tip bottom" data-tooltip aria-haspopup="true" data-disable-hover="false" tabindex="2" title="Comment on Harry Profile">
          <i class="fa fa-comments-o" aria-hidden="true"></i>
          <span class="show-for-sr">Comment on Harry Profile</span>
        </a>
      </div>
      <div class="action-area">
        <a href="#" class="action-anchor has-tip bottom" data-tooltip aria-haspopup="true" data-disable-hover="false" tabindex="2" title="Add Harry as a Friend">
          <i class="fa fa-user-plus" aria-hidden="true"></i>
          <span class="show-for-sr">Add Harry as a Friend</span>
        </a>
      </div>
      <div class="action-area">
        <a href="#" class="action-anchor has-tip bottom" data-tooltip aria-haspopup="true" data-disable-hover="false" tabindex="2" title="Send Harry a Gift">
          <i class="fa fa-gift" aria-hidden="true"></i>
          <span class="show-for-sr">Send Harry a Gift</span>
        </a>
      </div>
      <div class="action-area">
        <a href="#" class="action-anchor has-tip bottom" data-tooltip aria-haspopup="true" data-disable-hover="false" tabindex="2" title="Block Harry!">
          <i class="fa fa-ban" aria-hidden="true"></i>
          <span class="show-for-sr">Block Harry!</span>
        </a>
      </div>
    </div>
  </div>
</div>

<?php 
  //como prueba de concepto. si el usuario es doctor muestra estos campos si no, no
  $result = "";
  $result = sw_get_current_user_role();
  if($result == "doctor"){
    hm_get_template_part('template-parts/appointment/ago', ['appointment_post_id' => $appointment_id]); 
  }
?>

<?php get_footer();?>