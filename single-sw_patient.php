<?php get_header();?>

<?php  

 $appointment_url = home_url().'/consulta/?patient_id=';
// $indicacion_url = home_url().'/indicacion/?patient_id=';
// $estudios_url = home_url().'/estudios/?patient_id=';

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
?>


<p><a href="#consultas_paciente">Ir a consultas</a></p>
<div data-closable class="callout alert-callout-border secondary text-center">
  <h3 style="font-weight: bold;">Perfil de la Paciente</h3>
</div>
<!-- <h1 style="text-align: center; margin-left: 50px;">Perfil del Paciente</h1> -->
<?php 
//como prueba de concepto. si el usuario es doctor muestra estos campos si no, no
$result = "";
$result = sw_get_current_user_role();

  //check permissions for the user
  //this page should be visible only for a doctor role. else redirect to home page
  $the_role = sw_get_current_user_role(); // antes usaba esta funcion pero puedo hacer lo mismo con 'current_user_can()'
   if(!current_user_can('doctor') && !current_user_can('administrator')){
     echo "El usuario no es doctor o admin. no puede ver esta pagina";
      //wp_redirect( esc_url( wp_login_url() ), 307);
      //wp_redirect('http://example.com/'); exit;
   }
   
//en produccion: verificar que el usuario sea doctor
//if($result == "doctor"){
if(true){
  hm_get_template_part('template-parts/appointment/patient-data', ['patient_id' => $patient_id]);
  hm_get_template_part('template-parts/appointment/basic-data', ['patient_id' => $patient_id, 'is_editable' => "false" ]);
  hm_get_template_part('template-parts/appointment/static-data', ['static_data_post_id' => $static_data_post_id, 'patient_id' => $patient_id]); 
  ?>

  <!-- <h2 style="text-align: center; margin-left: 50px;">Consultas</h2> -->
  <!-- <a href="#"><strong>Nombre paciente</strong></a> -->
  <div data-closable class="callout alert-callout-border secondary text-center" style="margin: 2rem 0;">
    <h3 style="font-weight: bold;">
      <a href="<?php echo esc_url( $appointment_url ).$patient_id.'&app_id=new'; ?>" class="crete-app">  Crear nueva consulta</a>
    </h3>
  </div>

  <?php
  // seccion que trae las consultas del paciente
  //hm_get_template_part('template-parts/patients-all/lista-consultas', ['patient_id' => $patient_id]);
  hm_get_template_part('template-parts/patients-all/tabla-consultas', ['patient_id' => $patient_id]);
  // seccion que trae las colposcopias del paciente
  //hm_get_template_part('template-parts/patients-all/lista-colpos', ['patient_id' => $patient_id]);
  ?>

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

