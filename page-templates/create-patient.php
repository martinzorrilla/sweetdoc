<?php get_header();/* Template Name: Create Patient*/?>
<?php 
  //retreive data from the url
  $patient_id = $_GET['patient_id'];
  //si el parametro patient_id == new, el formulario debe ser editable por defecto, si no debe no ser editable
  $is_editable = $patient_id == "new" ? "true" : "false";
  $title = $patient_id == "new" ? "Agregar Paciente" : "Editar Paciente";
  $column_size = $patient_id == "new" ? "large-12" : "large-6";
  //var_dump($patient_id);
  
?>

<!-- <div data-closable class="callout alert-callout-border secondary text-center">
  <h3> < ?= $title ?> </h3>
</div> -->

<div class="callout secondary wrap" style="margin-top: 3em; margin-bottom: 3em;">
  <h2 class="font-bold"><?= $title ?></h2>
</div>

<?php hm_get_template_part('template-parts/appointment/basic-data', ['patient_id' => $patient_id, 'is_editable' => $is_editable ]); ?>

<!-- if(role == doctor){ show AGO form} -->

<!-- we set the buttons outside the form so the form template remains independent to use in other places -->
<!-- <div class="row">  
  <div class="floated-label-wrapper large-6 columns text-center" style="padding-top: 1rem;">
    <button id="create-patient" class="submit_button save-button-expanded" type="submit" value="create-patient">
    <i class="fas fa-save 2x"></i>  <span class="app-dashboard-sidebar-text"> Guardar </span>
    </button>
    <p class="errorWrapper">
    </p>
  </div>
  <div class="floated-label-wrapper large-6 columns text-center" style="padding-top: 1rem;">
    <button id="toggle-input" class="toggle-input submit_button save-button-expanded" type="submit" value="toggle-input">
    <i class="fas fa-edit 2x"></i>  <span class="app-dashboard-sidebar-text"> Editar </span>
    </button>
    <p class="errorWrapper">
    </p>
  </div>
</div> -->

  <div class="row" style="padding-top: 2rem;">  
    <div class="small-12 medium-12 <?= $column_size ?> columns text-center" style="padding-bottom:1em;">
          <a id="create-patient" href="#" class="btn btn-green botones-estandard">Guardar</a>
    </div>

    <?php 
      if($patient_id != "new"){?>
      <div class="small-12 medium-12 large-6 columns text-center">
        <a id="toggle-input" href="#" class="toggle-input btn btn-blue botones-estandard">Editar</a>
      </div>
      <?php 
      }
    ?>

    <!-- <div class="small-12 medium-12 large-6 columns text-center">
      <a id="toggle-input" href="#" class="toggle-input btn btn-blue botones-estandard">Editar</a>
    </div> -->

  </div>

<?php get_footer(); ?>

<!-- <script > aca iba el JS que ahora esta en src/assets/js/my-custom-js  </script> -->