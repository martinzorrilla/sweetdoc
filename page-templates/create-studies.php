<?php get_header();/* Template Name: Create Studies*/?>
<?php 
  //retreive data from the url
  //$patient_id = "new";
  $patient_id = $_GET['patient_id'];
  $app_id =  $_GET['app_id'];
  //si el parametro patient_id == new, el formulario debe ser editable por defecto, si no debe no ser editable
  // $is_editable = $patient_id == "new" ? "true" : "false";
  $is_editable = "true"; 
  // $prescription_pdf_url = home_url().'/test';
  
  
  $studies_array = sw_get_studies_id($app_id);
  // $studies_id = $studies_array[0];
  $studies_id = isset($studies_array[0]) ? $studies_array[0] : NULL;


  // var_dump($studies_id);
  $title = $studies_id === NULL ? "Crear solicitud de estudios" : "Editar solicitud de estudios";
?>

<div data-closable class="callout alert-callout-border secondary text-center">
  <h3> <?= $title ?> </h3>
</div>

<?php hm_get_template_part('template-parts/studies/studies-data', ['patient_id' => $patient_id, 'app_id' => $app_id, 'studies_id' => $studies_id, 'is_editable' => $is_editable ]); ?>

<!-- if(role == doctor){ show AGO form} -->

<!-- we set the buttons outside the form so the form template remains independent to use in other places -->
<div class="row">  
  <div class="floated-label-wrapper large-12 columns text-center" style="padding-top: 1rem;">
    <button id="create-studies" class="submit_button save-button-expanded" type="submit" value="create-studies">
    <i class="fas fa-save 2x"></i>  <span class="app-dashboard-sidebar-text"> Guardar </span>
    </button>
    <p class="errorWrapper">
    </p>
  </div>

</div>


<?php get_footer(); ?>
