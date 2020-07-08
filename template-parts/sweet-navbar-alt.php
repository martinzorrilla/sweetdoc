<div class="row expanded app-dashboard-top-nav-bar">
    <div class="columns large-12">
      <button data-toggle="app-dashboard-sidebar" class="menu-icon hide-for-medium"></button>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="app-dashboard-logo">ZweetDoc!</a>
    </div>
    
    <div class="columns large-6 shrink app-dashboard-top-bar-actions align-right">
      <span style="padding: 0 15px; font-weight: bold;"><a href="#"> <?php $current_user = wp_get_current_user(); echo  $current_user->user_login; ?> </a> </span>
      <a class="app-dashboard-log-out" style="border: 1px solid white; padding: 5px 10px;" href="<?php echo wp_logout_url(); ?>">Salir</a>
      <!-- <button href="#" class="button hollow">Salir</button> -->
      <!-- <a href="#" height="30" width="30" alt=""><i class="fa fa-info-circle"></i></a> -->
    </div>
  </div>