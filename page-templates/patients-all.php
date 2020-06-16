<?php get_header();/* Template Name: Patients All */ ?>
<?php//$latest_patients = wp_list_pluck( $latest_patients, 'post_title'  );?>

  <?php //hm_get_template_part('template-parts/doctor/doctor-intro', ['data' => ""]); ?>
  
  <div data-closable class="callout alert-callout-border secondary text-center">
    <h3>Todas las pacientes</h3>
  </div>

  <!-- Get the Part that renders the Patient List. 
  * search_param = ''; will get all the patients-->
  <?php //hm_get_template_part('template-parts/patients-all/list-patients', ['search_param' => '']); ?>
  <?php hm_get_template_part('template-parts/patients-all/table-patients', ['search_param' => '']); ?>

<?php get_footer(); ?>
