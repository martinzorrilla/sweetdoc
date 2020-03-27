<?php  

function create_post_type_indication() {

/*Post_type para las indicaciones solicitadas al paciente, seran asociadas a una consulta*/
    register_post_type( 'sw_indication',
    array(
      'labels' => array(
        'name' => __( 'Indicaciones' ),
        'singular_name' => __( 'Indication' )
      ),
      'public' => true,
      'menu_icon' => 'dashicons-welcome-write-blog',
      'menu_position' => 84,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type_indication' );
?>