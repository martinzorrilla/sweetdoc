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
      'menu_icon' => 'dashicons-video-alt',
      'menu_position' => 83,
      'has_archive' => true,
      'taxonomies' => array( 'category' ),

    )
  );
}
add_action( 'init', 'create_post_type_colposcopia' );
?>