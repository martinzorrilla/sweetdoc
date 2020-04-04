<?php  

function create_post_type_patient() {

/*Patient Post_type*/
    register_post_type( 'sw_patient',
    array(
      'labels' => array(
        'name' => __( 'Pacientes' ),
        'singular_name' => __( 'Paciente' )
      ),
      'public' => true,
      'menu_icon' => 'dashicons-groups',
      'menu_position' => 80,
      'has_archive' => true,
    )
  );
    //echo "Patient post type registered.<br/>";
}
add_action( 'init', 'create_post_type_patient' );
?>