<?php  

function create_post_type_colposcopia() {

/*Patient Post_type*/
    register_post_type( 'sw_colposcopia',
    array(
      'labels' => array(
        'name' => __( 'Colposcopias' ),
        'singular_name' => __( 'Colposcopia' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type_colposcopia' );
?>