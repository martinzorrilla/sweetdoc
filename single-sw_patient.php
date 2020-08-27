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


  <!-- <p><a href="#consultas_paciente">Ir a consultas</a></p> -->

  <!-- <div class="large-spacer"></div> -->

  <div class="wrap">
      <h1 class="under font-bold">Ficha de la Paciente</h1>
  </div>

  <!-- <div data-closable class="callout alert-callout-border secondary text-center">
    <h3 style="font-weight: bold;">Perfil de la Paciente</h3>
  </div> -->


  <?php
  if($alertas != "" &&  (current_user_can( 'doctor' ) || current_user_can( 'administrator') )){?>
  <!-- <div class="callout alert-callout-border alert text-center alert-field-active">
    <h3 style="font-weight: bold;">Alerta</h3>
  </div> -->

  <div class="row" style="padding-top: 2rem;">
    <div class="small-12 columns text-center" style="padding-bottom:1em;">
      <a href="#alertas" class="crete-app btn btn-yellow botones-estandard">Alerta</a>
    </div>
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

    ?>

  <div class="tab">
    <button class="tablinks dabbed tab-single-patient" data-id="Resumen"  id="defaultOpen">Resumen</button>
    <button class="tablinks dabbed tab-single-patient" data-id="Datos-Basicos" >Datos</button>
    <button class="tablinks dabbed tab-single-patient" data-id="AGO" >AGO</button>
    <button class="tablinks dabbed tab-single-patient" data-id="Consultas" id="consultasAsync" >Consultas</button>
  </div>

    <?php


  hm_get_template_part('template-parts/appointment/patient-data', ['patient_id' => $patient_id, 'is_editable' => "false"]);
  hm_get_template_part('template-parts/appointment/basic-data', ['patient_id' => $patient_id, 'is_editable' => "false"]);

  //check permissions for the user
  //this section should only  be visible by a doctor role or admin.
  if(current_user_can('doctor') || current_user_can('administrator')){
    hm_get_template_part('template-parts/appointment/static-data', ['static_data_post_id' => $static_data_post_id, 'patient_id' => $patient_id, 'is_editable' => "false"]);
    hm_get_template_part('template-parts/patients-all/tabla-consultas-responsive', ['patient_id' => $patient_id]);

  }

  // seccion que trae las consultas del paciente
  //hm_get_template_part('template-parts/patients-all/lista-consultas', ['patient_id' => $patient_id]);

  // hm_get_template_part('template-parts/patients-all/tabla-consultas', ['patient_id' => $patient_id]);

  // hm_get_template_part('template-parts/patients-all/tabla-consultas-responsive', ['patient_id' => $patient_id]);

  // seccion que trae las colposcopias del paciente
  //hm_get_template_part('template-parts/patients-all/lista-colpos', ['patient_id' => $patient_id]);
  ?>

  <!-- <h2 style="text-align: center; margin-left: 50px;">Consultas</h2> -->
  <!-- <a href="#"><strong>Nombre paciente</strong></a> -->



<!-- nuevo -->
  <!-- <div id="consultas_paciente" class="row" style="padding-top: 2rem;">   -->

  <!-- <div class="row" style="padding-top: 2rem;">
    <div class="small-12 columns text-center" style="padding-bottom:1em;">
      <a href="< ?php echo esc_url( $appointment_url ).$patient_id.'&app_id=new'; ?>" class="crete-app btn btn-green botones-estandard">Crear nueva consulta</a>
    </div>
  </div> -->

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



// UPDATE 26-08-2020: ESTO servia antes que cargue las consultas por ajax. ahora ya no es necesario
// window.addEventListener( "pageshow", function ( event ) {
//   var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
//   if ( historyTraversal ) {
//     // Handle page restore.
//     alert("Everything is ready now!");
//     window.location.reload();
//   }
// });

</script>

<script>
$(document).ready(function(){

  // tablaConsultasModule.cargarConsultasPaciente();

  var tablaConsultasModule = function(){
    //global vars
    var $ = jQuery;
    var cargarConsultas;
    //here we will load the response from the backend. i.e all the appointments from a patient
    var consultasTargetDiv;

    // cargarConsultas = $("#consultasAsync");
    cargarConsultas = $("#fakeid");
    consultasTargetDiv = $("#tbody-consultas");

    $("#overlay").fadeIn(300);
    // cargarConsultasPaciente();

    // var cargarConsultasPaciente = function () {
    function cargarConsultasPaciente() {

        var $ = jQuery;
        var patient_id = $("#consultas-target-div").data('id');

        // var myData = 'foo=bar'+ '&action=' + 'sw_llamar_pacientes_ajax' + '&patient_id=' + patient_id;
        var myData = 'foo=bar'+ '&action=' + 'sw_cargar_consultas_paciente_ajax' + '&patient_id=' + patient_id;

        // alert(myData);
        // alert("normal");

        $.ajax({
           type: "POST",
           url:window.homeUrl + "/wp-admin/admin-ajax.php",
           data: myData,
           dataType: "json",
           success: function(data) {
              if(data.error.length >0){
                 if(data.error){
                  alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> cargarConsultasPaciente ');
                }
              }
              if(data.success){

                consultasTargetDiv.empty();
                setTimeout(function(){
                  $("#overlay").fadeOut(300);
                },500);

                data["data"].forEach(function(entry) {
                    // console.log(entry);
                    consultasTargetDiv.append(entry);

                });

              }
           },
           error: function() {
              // alert('No se pudo cargar las llamdas de paciente. JX');
              console.log('No se pudo cargar las consultas del paciente');
           }
        });// $.ajax
        }




    return{
      // init:init,
      cargarConsultasPaciente : cargarConsultasPaciente
    }


  }();
  // tablaConsultasModule.init();
  tablaConsultasModule.cargarConsultasPaciente();


// EL PROBLEMA: AL CREAR un nuevo post_type UN (ESTUDIO, INDICACION, LABORATORIO ETC) en vez de hacer un page reload actua como un "VOLVER ATRAS A LA PAGINA single-sw_patient", y no hace el ajax request para actualizar la tabla de consultas

// LA SOLUCION: este codigo detecta que se presiono el boton atras del navegador y fuerza el reload de la pagina de manera a solucionar el problema mencionado
// source: https://stackoverflow.com/questions/43043113/how-to-force-reloading-a-page-when-using-browser-back-button
   window.addEventListener( "pageshow", function ( event ) {
   var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
   if ( historyTraversal ) {
     // Handle page restore.
    //  alert("history back");
    $("#overlay").fadeIn(300);
    tablaConsultasModule.cargarConsultasPaciente();
   }
 });

});

</script>