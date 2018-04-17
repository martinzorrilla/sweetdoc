<?php  

function create_post_type_static_data() {

/*Patient Post_type*/
    register_post_type( 'sw_static_data',
    array(
      'labels' => array(
        'name' => __( 'Private Data' ),
        'singular_name' => __( 'private_data_s' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type_static_data' );
?>