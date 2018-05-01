<?php get_header();?>
<?php

$appointment_url = home_url().'/consulta/?patient_id=';
$prescription_url = home_url().'/prescripcion/?patient_id=';
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
?>

<h1 style="text-align: center; margin-left: 50px;">Perfil del Paciente</h1>

<?php 
  //como prueba de concepto. si el usuario es doctor muestra estos campos si no, no
$result = "";
$result = sw_get_current_user_role();

if($result == "doctor"){

  hm_get_template_part('template-parts/appointment/patient-data', ['patient_id' => $patient_id]);
  ?> 

  <h1 style="text-align: center; margin-left: 50px;">Consultas</h1>
  <!-- <a href="#"><strong>Nombre paciente</strong></a> -->
  <br/>

  <?php 
  $related = sw_get_related_appointments($patient_id); 
  foreach ($related as $r){
        $creation_date = get_the_date( 'd-M-Y', $r );
        //$the_app = get_post($r); 
        //  var_dump($the_app);
        //echo $creation_date;
        //echo the_date('Y-m-d', '<h2>', '</h2>');
        //var_dump($the_app->post_date);
    ?>
    <div data-closable class="callout alert-callout-border primary">
      <a href="<?php echo esc_url( $appointment_url ).$patient_id.'&app_id='.$r; ?>"> - Consulta en fecha <strong> <?php echo $creation_date ?> </strong> - Codigo: <?php echo $r ?></a>
      
      <br/><br/>
      <a href="<?php echo esc_url( $prescription_url ).$patient_id.'&app_id='.$r; ?>"> - Solicitar Nueva Prescripción </a>
      <br/>
      
      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
  } //foreach 
}//if
?>

<?php get_footer();?>