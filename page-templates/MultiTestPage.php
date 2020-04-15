<?php get_header();/* Template Name: MultiTestPage*/?>
<?php

$params = array(
    "patient_id" => $patient_id,
    "patient_name" => $patient_name,
    "patient_last_name" => $patient_last_name,
    "patient_ci" => "4214578"
);

$app_id = "1276";
$patient_id =  sw_get_patient_id_by_app($app_id);

var_dump($patient_id);



/*
********************************************************************************
*
      no funciona todavia, yo lo que necesito es que dado una app_id(consulta), traiga su patient_id, pero esto lo que hace
      es buscar todas las patient_id que tienen esa app_id guardada en ella con la relacion related_patient, pero eso no existe
*
********************************************************************************
*/
 function sw_get_patient_id_by_app($app_id){

  $args = array(
    'post_type'  => 'sw_patient',
    'meta_key'   => 'related_patient',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'related_patient',
        'value'   => array($app_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}



?>

<div>
  <h2>Multi teste page</h2>
</div>

<?php get_footer(); ?>

