<?php  

function create_post_type_study() {

/*Post_type para los estudios solicitados al paciente, seran asociadas a una consulta*/
    register_post_type( 'sw_study',
    array(
      'labels' => array(
        'name' => __( 'Estudios' ),
        'singular_name' => __( 'Study' )
      ),
      'public' => true,
      'menu_icon' => 'dashicons-clipboard',
      'menu_position' => 85,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type_study' );
?>