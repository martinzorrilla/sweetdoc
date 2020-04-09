<?php  

function create_post_type_static_data() {

/*Patient Post_type*/
    register_post_type( 'sw_static_data',
    array(
      'labels' => array(
        'name' => __( 'A.G.O.' ),
        'singular_name' => __( 'static_data_ago' )
      ),
      'public' => true,
      'menu_icon' => 'dashicons-id',
      'menu_position' => 81,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type_static_data' );
?>