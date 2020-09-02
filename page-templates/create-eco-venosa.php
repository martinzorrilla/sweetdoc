<?php get_header();/* Template Name: Create Eco Venosa*/?>
<?php 

//  colposcopy = eco_venosa
//  colpo = eco_venosa

  //retreive data from the url
  //$patient_id = "new";
  $patient_id = $_GET['patient_id'];
  $app_id =  $_GET['app_id'];


  $eco_venosa_patient_array = sw_get_eco_venosa_id($app_id);
  $eco_venosa_post_id = isset($eco_venosa_patient_array[0]) ? $eco_venosa_patient_array[0] : NULL;

  //si el parametro patient_id == new, el formulario debe ser editable por defecto, si no debe no ser editable
  // $is_editable = $patient_id == "new" ? "true" : "false";
  $is_editable = "true";  
  
  // var_dump($colpo_post_id);
  $title = $eco_venosa_post_id === NULL ? "Crear informe de ecografía" : "Editar informe de ecografía";


  $patient_fields = get_post_custom($patient_id);
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  $cedula = $patient_fields['cedula'][0];
  $seguro_medico = get_field("seguro_medico", $patient_id);

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

        }
        ?>
      </p>
      <p><?php 
      if ($seguro_medico != NULL) {
        echo "Seguro Médico: ".$seguro_medico; }?>
      </p>

    </h4>
  </div>


  <!-- <div class="tab">
      <button class="tablinks dabbed" >Izquierdo</button>
      <button class="tablinks dabbed" >Derecho</button>
  </div> -->


  <div class="tab">
    <button class="tablinks dabbed tab-eco-venosa" data-id="izquierdo"  id="defaultOpen">Izquierdo</button>
    <button class="tablinks dabbed tab-eco-venosa" data-id="derecho">Derecho</button>
  </div>

  <form id="create-eco-venosa-form" name="create-eco-venosa-form" method="post">
    <?php 
    hm_get_template_part('template-parts/eco-venosa/eco-venosa-data', ['patient_id' => $patient_id, 'app_id' => $app_id, 'eco_venosa_post_id' => $eco_venosa_post_id, 'is_editable' => $is_editable ]); 

    hm_get_template_part('template-parts/eco-venosa/eco-venosa-data-derecho', ['patient_id' => $patient_id, 'app_id' => $app_id, 'eco_venosa_post_id' => $eco_venosa_post_id, 'is_editable' => $is_editable ]); 
    ?>
  </form>

<!-- nuevo -->
<div class="row" style="padding-top: 2rem;">  
    <div class="small-12 columns text-center" style="padding-bottom:1em;">
      <a id="create-eco-venosa" href="#" class="crete-app btn btn-green botones-estandard">Guardar</a>
    </div>
</div>

<?php get_footer(); ?>
