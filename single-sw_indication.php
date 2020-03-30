<?php get_header();/* Template Name: Create Indication*/?>
<?php 
    $post_id = get_the_ID();
    $indication_data_post = get_post_custom($post_id);
   
    //get the app id that is related to this indiaction
    $app_id = $indication_data_post['related_indication'][0]; 
    //wp_die(var_dump($app_id));
  //retreive data from the url
  $patient_id = "edit";
  //$patient_id = $_GET['patient_id'];
  //$app_id =  $_GET['app_id'];
  //si el parametro patient_id == new, el formulario debe ser editable por defecto, si no debe no ser editable
  $is_editable = $patient_id == "new" ? "true" : "false";
  $title = $patient_id == "new" ? "Crear indicación médica" : "Editar indicación médica";
  $prescription_pdf_url = home_url().'/indicacion-pdf/?indication_id='.$post_id;


?>

<div data-closable class="callout alert-callout-border secondary text-center">
  <h3> <?= $title ?> </h3>
</div>

<?php hm_get_template_part('template-parts/indication/indication-data', ['app_id' => $app_id, 'is_editable' => $is_editable ]); ?>

<!-- if(role == doctor){ show AGO form} -->

<div class="button-div">
    <a href="<?php echo esc_url( $prescription_pdf_url ).$r; ?>" target="_blank" 
      <button id="create-indication-pdf" class="save-button-expanded" type="submit" value="Next">Generar indicación en PDF</button>
    </a>  
    <p class="errorWrapper"></p>
  </div>


<?php get_footer(); ?>
