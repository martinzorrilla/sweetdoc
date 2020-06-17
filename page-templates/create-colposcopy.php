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
  
  // var_dump($colpo_post_id);
  $title = $colpo_post_id === NULL ? "Crear informe colposcópico" : "Editar informe colposcópico";


  $patient_fields = get_post_custom($patient_id);
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  $cedula = $patient_fields['cedula'][0];
  $fullname = $name.' '.$lastname;

  //  obtener la edad de la paciente. la funcion esta en functions.php
  $fecha_de_nacimiento = isset($patient_fields['fecha_de_nacimiento'][0]) ? $patient_fields['fecha_de_nacimiento'][0] : NULL;
  $patient_age = calcular_edad($fecha_de_nacimiento);
?>

<div data-closable class="callout alert-callout-border secondary text-center">
  <h3> <?= $title ?> </h3>
</div>


<div class="callout secondary">
    <h3 style="text-align: center; "> <strong> <?php echo $fullname?> </strong>
    </h3>
    <h4 style="text-align: center; "> 
      <p><?php echo "Ci: ".$cedula; ?></p>
      <p>
        <?php 
        if ($fecha_de_nacimiento != NULL) {
          $patient_age = calcular_edad($fecha_de_nacimiento);
          $show_age = $patient_age->y;
          echo "Edad: ".$show_age;
          // $show_age = "tiene";
          // printf(' Edad : %d años', $patient_age->y); 
        }
        ?>
      </p>
    </h4>
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
