<?php get_header();?>

<?php  

 $appointment_url = home_url().'/consulta/?patient_id=';
// $indicacion_url = home_url().'/indicacion/?patient_id=';
// $estudios_url = home_url().'/estudios/?patient_id=';
//$is_editable = FALSE;

// $edit_patient_url = home_url().'/crear-paciente/?patient_id=new';
//the id of the post in the current loop. witch is the patient
$post_id = get_the_ID(); 
//echo $post_id;

$post7 =get_post($post_id);
$post_author = $post7->post_author; 
  //echo "post author = ".$post_author."<br/>";

$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
  //echo "logged user id = ".$current_user_id."<br/>";

$usersrole = sw_get_current_user_role();
//echo "the users role : ". $usersrole;

$patient_id = $post_id; 

  //this is to get the id of the static_data post for this patient
  //returns an array 
  $static_data_array = sw_get_static_data_id($patient_id);
  $static_data_post_id = $static_data_array[0];
  // nuevo
  $static_data_post = get_post_custom($static_data_post_id);
  $alertas = isset($static_data_post['alertas'][0]) ? $static_data_post['alertas'][0] : NULL;

?>


  <p><a href="#consultas_paciente">Ir a consultas</a></p>

  <!-- <div class="large-spacer"></div> -->

  <div class="wrap"> 
      <h1 class="under font-bold">Perfil de la Paciente</h1>
  </div>

  <!-- <div data-closable class="callout alert-callout-border secondary text-center">
    <h3 style="font-weight: bold;">Perfil de la Paciente</h3>
  </div> -->


  <?php 
  if($alertas != "" &&  (current_user_can( 'doctor' ) || current_user_can( 'administrator') )){?>
  <div class="callout alert-callout-border alert text-center alert-field-active">
    <h3 style="font-weight: bold;">Alerta</h3>
  </div>
  <?php 
  }
  ?>

<?php 
//como prueba de concepto. si el usuario es doctor muestra estos campos si no, no
$result = "";
$result = sw_get_current_user_role();

   
//en produccion: verificar que el usuario sea doctor
//if($result == "doctor"){
if(true){
  hm_get_template_part('template-parts/appointment/patient-data', ['patient_id' => $patient_id, 'is_editable' => "false"]);
  hm_get_template_part('template-parts/appointment/basic-data', ['patient_id' => $patient_id, 'is_editable' => "false"]);

  //check permissions for the user
  //this section should only  be visible by a doctor role or admin.
  if(current_user_can('doctor') || current_user_can('administrator')){
    hm_get_template_part('template-parts/appointment/static-data', ['static_data_post_id' => $static_data_post_id, 'patient_id' => $patient_id, 'is_editable' => "false"]); 
  }

  // seccion que trae las consultas del paciente
  //hm_get_template_part('template-parts/patients-all/lista-consultas', ['patient_id' => $patient_id]);
  hm_get_template_part('template-parts/patients-all/tabla-consultas', ['patient_id' => $patient_id]);
  // seccion que trae las colposcopias del paciente
  //hm_get_template_part('template-parts/patients-all/lista-colpos', ['patient_id' => $patient_id]);
  ?>

  <!-- <h2 style="text-align: center; margin-left: 50px;">Consultas</h2> -->
  <!-- <a href="#"><strong>Nombre paciente</strong></a> -->



<!-- nuevo -->
  <div class="row" style="padding-top: 2rem;">  
    <div class="small-12 columns text-center" style="padding-bottom:1em;">
      <a href="<?php echo esc_url( $appointment_url ).$patient_id.'&app_id=new'; ?>" class="crete-app btn btn-green botones-estandard">Crear nueva consulta</a>
    </div>
  </div>

<!-- viejo -->
  <!-- <div data-closable class="callout alert-callout-border secondary text-center" style="margin: 2rem 0;">
    <h3 style="font-weight: bold;">
      <a href="< ?php echo esc_url( $appointment_url ).$patient_id.'&app_id=new'; ?>" class="crete-app">  Crear nueva consulta</a>
    </h3>
  </div> -->




<?php
}//if is a doctor
?>

<?php get_footer();?>

<script>
// EL PROBLEMA: AL CREAR un nuevo post_type UN (ESTUDIO, INDICACION, LABORATORIO ETC) Y VOLVER ATRAS A LA PAGINA single-sw_patient, esta se debe recargar manualmente, de lo contrario no se ve que se creo un nuevo post type o si se edito tovia esta linkeado al post anterior.

// LA SOLUCION: este codigo detecta que se presiono el boton atras del navegador y fuerza el reload de la pagina de manera a solucionar el problema mencionado
// source: https://stackoverflow.com/questions/43043113/how-to-force-reloading-a-page-when-using-browser-back-button

window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore. 
    //alert("Everything is ready now!");
    window.location.reload();
  }
});
</script>

