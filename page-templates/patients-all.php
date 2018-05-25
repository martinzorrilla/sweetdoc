<?php get_header();/* Template Name: Patients All */ ?>
<?php//$latest_patients = wp_list_pluck( $latest_patients, 'post_title'  );?>
<?php
//we use this to redirect to an appointment with te selected patient id
//$appointment_url = home_url().'/consulta/?patient_id=';
$create_patient_url = home_url().'/crear-paciente/';
//echo "crear paciente url: ".$create_patient_url;
?>

<div class="app-dashboard shrink-medium">

  <div class="row expanded app-dashboard-top-nav-bar">
    <div class="columns medium-2">
      <button data-toggle="app-dashboard-sidebar" class="menu-icon hide-for-medium"></button>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="app-dashboard-logo">Inicio</a>
    </div>
    <div class="columns show-for-medium">
      <div class="app-dashboard-search-bar-container">
        <input class="app-dashboard-search" type="search" placeholder="Search">
        <i class="app-dashboard-search-icon fa fa-search"></i>
      </div>
    </div>
    <div class="columns shrink app-dashboard-top-bar-actions">
      <button href="#" class="button hollow">Salir</button>
      <a href="#" height="30" width="30" alt=""><i class="fa fa-info-circle"></i></a>
    </div>
  </div>

  <div class="app-dashboard-body off-canvas-wrapper">

    <div id="app-dashboard-sidebar" class="app-dashboard-sidebar position-left off-canvas off-canvas-absolute reveal-for-medium" data-off-canvas>
      <div class="app-dashboard-sidebar-title-area">
        <div class="app-dashboard-close-sidebar">
          <h3 class="app-dashboard-sidebar-block-title">Menu</h3>
          <!-- Close button -->
          <button id="close-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-sidebar-close-button show-for-medium" aria-label="Close menu" type="button">
            <span aria-hidden="true"><a href="#"><i class="large fa fa-angle-double-left"></i></a></span>
          </button>
        </div>
        <div class="app-dashboard-open-sidebar">
          <button id="open-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-open-sidebar-button show-for-medium" aria-label="open menu" type="button">
            <span aria-hidden="true"><a href="#"><i class="large fa fa-angle-double-right"></i></a></span>
          </button>
        </div>
      </div>
      <div class="app-dashboard-sidebar-inner">
        <ul class="menu vertical">
          <li><a href="<?php echo $all_patient_url ?>" class="is-active">
            <i class="fas fa-address-book fa-2x"></i><span class="app-dashboard-sidebar-text"> Listar Pacientes</span>
          </a></li>
          <li><a href="<?php echo $create_patient_url ?>">
            <i class="fas fa-heartbeat fa-lg"></i><span class="app-dashboard-sidebar-text"> Crear Paciente Nuevo</span>
          </a></li>
          <li><a href="<?php echo $create_secretary_url ?>">
            <i class="fas fa-user-md fa-2x"></i><span class="app-dashboard-sidebar-text"> Crear Asistente</span>
          </a></li>
        </ul>
      </div>
    </div>

    <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>
  
    <!-- aca va el contenido de la pagina -->

<div class="card-profile-stats">
  <div class="card-profile-stats-intro">
    <img class="card-profile-stats-intro-pic" src="<?php bloginfo('template_url')?>/src/assets/images/andrea.jpg" alt="Andrea Zorrilla" />
    <div class="card-profile-stats-intro-content">
      <h3>Dra. Andrea Zorrilla</h3>
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


  <div class="profile-card-author">
    <h5 class="author-title">Todos los pacientes</h5>
    <p class="author-description">Alguna descripcion sobre alguna baticosa</p>
  </div>
    

  <!-- 
  Get the Part that renders the Patient List. 
  * search_param = ''; will get all the patients
   -->
  <?php hm_get_template_part('template-parts/patients-all/list-patients', ['search_param' => '']); ?>


    </div>
    
  </div>
</div>



<?php get_footer(); ?>


<script>
function searchBarFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>