<?php get_header();/* Template Name: Create Colposcopy*/?>
<?php 


  //retreive data from the url
  //$patient_id = "new";
  $patient_id = $_GET['patient_id'];
  $app_id =  $_GET['app_id'];


  $colpo_patient_array = sw_get_colpo_id($app_id);
  $colpo_post_id = isset($colpo_patient_array[0]) ? $colpo_patient_array[0] : NULL;

  //si el parametro patient_id == new, el formulario debe ser editable por defecto, si no debe no ser editable
  // $is_editable = $patient_id == "new" ? "true" : "false";
  $is_editable = "true";  
  
  //var_dump($indication_id);
  $title = $colpo_post_id === NULL ? "Crear informe colposcópico" : "Editar informe colposcópico";
?>

<div data-closable class="callout alert-callout-border secondary text-center">
  <h3> <?= $title ?> </h3>
</div>

<?php hm_get_template_part('template-parts/colposcopy/colposcopy-data', ['patient_id' => $patient_id, 'app_id' => $app_id, 'colpo_post_id' => $colpo_post_id, 'is_editable' => $is_editable ]); ?>

<!-- if(role == doctor){ show AGO form} -->

<!-- we set the buttons outside the form so the form template remains independent to use in other places -->
<div class="row">  
  <div class="floated-label-wrapper large-12 columns text-center" style="padding-top: 1rem;">
    <button id="create-colposcopy" class="submit_button save-button-expanded" type="submit" value="create-colposcopy">
    <i class="fas fa-save 2x"></i>  <span class="app-dashboard-sidebar-text"> Guardar </span>
    </button>
    <p class="errorWrapper">
    </p>
  </div>

</div>


<?php get_footer(); ?>
