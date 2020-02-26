<?php get_header();?>

<?php  
// $all_patient_url = home_url().'/pacientes/';
// $create_patient_url = home_url().'/crear-paciente/';
// $create_secretary_url = home_url().'/crear-asistente/';

// ************************************ separador *******************************************

$appointment_url = home_url().'/consulta/?patient_id=';
$prescription_url = home_url().'/prescripcion/?patient_id=';
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
  //$patient_id = ""; 
  hm_get_template_part('template-parts/appointment/basic-data', ['patient_id' => $patient_id, 'is_editable' => "false" ]);
  hm_get_template_part('template-parts/appointment/static-data', ['static_data_post_id' => $static_data_post_id, 'patient_id' => $patient_id]); 
  ?>
  

  <!-- <h2 style="text-align: center; margin-left: 50px;">Consultas</h2> -->
  <!-- <a href="#"><strong>Nombre paciente</strong></a> -->
  <div data-closable class="callout alert-callout-border primary text-center" style="margin-top: 2rem;">
    <h3 style="font-weight: bold;">Consultas Previas</h3>
  </div>

  <?php 
  $related = sw_get_related_appointments($patient_id);
  //r is the current app_id 
  foreach ($related as $r){
        //get the appointment creation date
        $creation_date = get_the_date( 'd-M-Y', $r );
    
        //get the colposcopy id and href of this app
        $colpo_patient_array = sw_get_colpo_id($r);
        $colpo_post_id = $colpo_patient_array[0];
        //$the_app = get_post($r); 
        //  var_dump($the_app);
        //echo $creation_date;
        //echo the_date('Y-m-d', '<h2>', '</h2>');
        //var_dump($the_app->post_date);
    ?>
    <div data-closable class="callout alert-callout-border secondary">
      <a href="<?php echo esc_url( $appointment_url ).$patient_id.'&app_id='.$r; ?>"> - Consulta en fecha <strong> <?php echo $creation_date ?> </strong> - Codigo: <?php echo $r ?>
      </a>
      
      <br/>
      <a href="<?php echo get_permalink( $colpo_post_id ); ?> ">- Colposcopia: <?php echo $colpo_post_id; ?></a>

      <br/>
      <a href="<?php echo esc_url( $prescription_url ).$patient_id.'&app_id='.$r; ?>"> - Solicitar Nueva Prescripción </a>
      <br/>
      
      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
  } //foreach 
  ?>
  
  <!-- esta seccion trae todas las COLPOSCOPIAS DE UN PACIENTE -->

  <!-- <h2 style="text-align: center; margin-left: 50px;">Colposcopias de la paciente</h2> -->
  <?php 
    // $patients_colpos = sw_patiente_colpos($patient_id);
    // //  var_dump($patients_colpos);
    // foreach ($patients_colpos as $p){
    //   //$colpo_post =get_post($p);
    //   $creation_date = get_the_date( 'd-M-Y', $p );?>
        <!-- <div data-closable class="callout alert-callout-border success"> -->
          <!-- <a href="<?php //echo get_permalink( $p ); ?> "> - Colposcopia en fecha <strong> <?php //echo $creation_date ?> </strong> - iD: <?php //echo $p ?></a> -->
        <!-- </div> -->
    <?php 
    // } //foreach patient_colpos ?>

<?php
}//if is a doctor
?>




<?php get_footer();?>