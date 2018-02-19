<?php  

function create_post_type_consulta() {

/*Patient Post_type*/
    register_post_type( 'sw_consulta',
    array(
      'labels' => array(
        'name' => __( 'Consultas' ),
        'singular_name' => __( 'Consulta' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type_consulta' );
?>