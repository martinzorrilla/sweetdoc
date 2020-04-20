<?php 
      $client_title = get_field('client_title', 'option');
      $client_title = isset($client_title) && $client_title !="" ? $client_title : "Dr/Dra";
      $client_name = get_field('client_name', 'option');
      $client_name = isset($client_name) && $client_name !="" ? $client_name : "Nombre y Apellido";
      $client_especialidad = get_field('client_especialidad', 'option');
      $client_especialidad = isset($client_especialidad) && $client_especialidad !="" ? $client_especialidad : "Especialidad";
      $client_sub_especialidad = get_field('client_sub_especialidad', 'option');
      $client_sub_especialidad = isset($client_sub_especialidad) && $client_sub_especialidad !="" ? $client_sub_especialidad : "Sub Especialidad";
      $client_registro = get_field('client_registro', 'option');
      $client_registro = isset($client_registro) && $client_registro !="" ? $client_registro : "XXXXXXX";
      $client_otros = get_field('client_otros', 'option');
      $client_otros = isset($client_otros) && $client_otros !="" ? $client_otros : "Otros datos";
      

      //traer la imagen del backend wp en theme options
      $client_image = get_field('client_image', 'option');
      $client_image = isset($client_image) ? $client_image : "";

      // si el campo acf esta vacio usaremos un avatar generico que ya se encuentra en la carpeta images del tema
      $template_url = get_bloginfo('template_url');
      $default_avatar = $template_url."/src/assets/images/avatar.png";
      $profile_image = isset($client_image) && $client_image !=""  ? $client_image['url'] : $default_avatar ;

?>

<div class="card-profile-stats">
  <div class="card-profile-stats-intro">
    <!-- <img class="card-profile-stats-intro-pic" src="< ?php bloginfo('template_url')?>/src/assets/images/andrea.jpg" alt="Andrea Zorrilla" /> -->
    <!-- <img class="card-profile-stats-intro-pic" src="< ?php bloginfo('template_url')?>/src/assets/images/avatar.png" alt="default avatar" /> -->
    <img class="card-profile-stats-intro-pic" src="<?php echo $profile_image; ?>" alt="profile image" />
    
    
    <div class="card-profile-stats-intro-content">
      <!-- <h3>Dra. Andrea Zorrilla</h3> -->
      <h3><?php echo($client_title." ".$client_name); ?></h3>
      <p><?php echo($client_especialidad); ?></small></p>
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
      <br>
      <div>
        <a href="<?php echo $create_patient_url ?>" rel="nofollow" target="_blank">
            <button id="create-patient" class="submit_button create-button" type="submit" value="Crear">Crear Nuevo Paciente
            </button>
        </a>
      </div>
    </div> <!-- /.card-profile-stats-more-content -->
  </div> <!-- /.card-profile-stats-more -->
</div> <!-- /.card-profile-stats -->
