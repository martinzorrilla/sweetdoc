<?php  

function create_post_type_laboratory() {

/*Post_type para los estudios solicitados al paciente, seran asociadas a una consulta*/
    register_post_type( 'sw_laboratory',
    array(
      'labels' => array(
        'name' => __( 'Laboratorios' ),
        'singular_name' => __( 'Laboratory' )
      ),
      'public' => true,
      'menu_icon' => 'dashicons-shield',
      'menu_position' => 86,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type_laboratory' );
?>