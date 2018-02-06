<?php  

function create_post_type_ficha() {

/*Patient Post_type*/
    register_post_type( 'sw_ficha',
    array(
      'labels' => array(
        'name' => __( 'Fichas' ),
        'singular_name' => __( 'ficha' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type_ficha' );

?>