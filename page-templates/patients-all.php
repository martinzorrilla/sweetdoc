<?php get_header();/* Template Name: Patients All */ ?>
<?php//$latest_patients = wp_list_pluck( $latest_patients, 'post_title'  );?>

  <?php //hm_get_template_part('template-parts/doctor/doctor-intro', ['data' => ""]); ?>

  <div class="profile-card-author">
    <h5 class="author-title">Listado de pacientes</h5>
    <p class="author-description">Alguna descripcion sobre los pacientes, eliminar la seccion</p>
  </div>
    

  <!-- Get the Part that renders the Patient List. 
  * search_param = ''; will get all the patients-->
  <?php hm_get_template_part('template-parts/patients-all/list-patients', ['search_param' => '']); ?>

<?php get_footer(); ?>
