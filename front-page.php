<?php get_header();/* Template Name: Front Page */ ?>
<?php  
  $all_patient_url = home_url().'/pacientes/';
  $create_patient_url = home_url().'/crear-paciente/';
  $create_secretary_url = home_url().'/crear-asistente/';
  $current_user = wp_get_current_user();
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
      <div class="callout primary">
        <h1 class="text-center">Buenos dias <?php echo $current_user->user_firstname; ?></h1>
      </div>

      <div class="callout secondary">
      <?php 
        echo "<h2 class='text-center'> Hoy es el " . date("d/m/Y") . "</h2>";
      ?>
      </div>

      <div class="callout secondary">
      <?php
       
        echo "<h5 class='text-center'> Hora " . date("h:i:a") . "</h5>";
      ?>
      </div>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus blandit ligula eget est feugiat viverra. Duis a arcu laoreet, rhoncus libero imperdiet, placerat velit. Vestibulum euismod mi et ornare sodales. Donec efficitur mattis blandit. Proin in massa elit. Praesent malesuada iaculis nisl, a venenatis dui. Nullam venenatis tincidunt placerat. Suspendisse egestas urna a aliquet pretium.</p>

    </div>
  </div>
</div>

<?php get_footer(); ?>