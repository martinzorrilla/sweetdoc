<?php get_header();/* Template Name: Patients All */ ?>
<?php//$latest_patients = wp_list_pluck( $latest_patients, 'post_title'  );?>
<?php
//we use this to redirect to an appointment with te selected patient id
$appointment_url = home_url().'/consulta/?patient_id=';?>
<div class="patient-div">

  <ul class="menu align-center">
    <li><a href="#">One</a></li>
    <li><a href="#">Two</a></li>
    <li><a href="#">Three</a></li>
  </ul>


<div class="card-profile-stats">
  <div class="card-profile-stats-intro">
    <img class="card-profile-stats-intro-pic" src="https://pbs.twimg.com/profile_images/732634911761260544/OxHbNdTF.jpg" alt="profile-image" />
    <div class="card-profile-stats-intro-content">
      <h3>Dr. Diego Garcia</h3>
      <p>Gineco obstetra</small></p>
    </div> <!-- /.card-profile-stats-intro-content -->
  </div> <!-- /.card-profile-stats-intro -->

  <hr />

  <div class="card-profile-stats-container">
    <div class="card-profile-stats-statistic">
      <span class="stat">25</span>
      <p>Pacientes</p>
    </div> <!-- /.card-profile-stats-statistic -->
    <div class="card-profile-stats-statistic">
      <span class="stat">12</span>
      <p>Consultas de hoy</p>
    </div> <!-- /.card-profile-stats-statistic -->
    <div class="card-profile-stats-statistic">
      <span class="stat">6</span>
      <p>En espera</p>
    </div> <!-- /.card-profile-stats-statistic -->
  </div> <!-- /.card-profile-stats-container -->

  <div class="card-profile-stats-more">
    <p class="card-profile-stats-more-link"><a href="#"><i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
    <div class="card-profile-stats-more-content">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem libero fugit, pariatur maxime! Optio enim, deserunt quia molestiae fugiat delectus, dolore et esse nostrum, quod autem necessitatibus fugit soluta repellendus.
      </p>
    </div> <!-- /.card-profile-stats-more-content -->
  </div> <!-- /.card-profile-stats-more -->
</div> <!-- /.card-profile-stats -->


  <div class="profile-card-author">
    <h5 class="author-title">Todos los pacientes</h5>
    <p class="author-description">Alguna descripcion sobre alguna baticosa</p>
    <a href="">
    <button id="create-patient" class="submit_button create-patient" type="submit" value="Crear">Crear Nuevo Paciente</button></a>
  </div>
    
  <?php
  $args = array(
    'numberposts' => -1,
    'post_type'   => 'sw_patient'
  );
  $latest_patients = get_posts( $args );?>
    
  <?php foreach ($latest_patients as $patient): ?>
      <div data-closable class="callout alert-callout-border primary">
        <a href="<?php echo get_permalink( $patient->ID ); ?> "><strong><?php echo $patient->post_title;?></strong></a>
        <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id=new'; ?>"> - Nueva consulta</a>

  <?php 
    $related = sw_get_related_appointments($patient->ID); 
      foreach ($related as $r){?>
        <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id='.$r; ?>"> - Consulta Anterior id: <?php echo $r ?> </a>
        <?php
      }
    ?>

        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endforeach; ?>
</div>
<?php get_footer(); ?>