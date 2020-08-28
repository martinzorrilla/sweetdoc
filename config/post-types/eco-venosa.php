<?php  

function create_post_type_eco_venosa() {

/*Patient Post_type*/
    register_post_type( 'sw_eco_venosa',
    array(
      'labels' => array(
        'name' => __( 'Ecografias Venosas' ),
        'singular_name' => __( 'Ecografia Venosa' )
      ),
      'public' => true,
      'menu_icon' => 'dashicons-video-alt',
      'menu_position' => 84,
      'has_archive' => true,
      'taxonomies' => array( 'category' ),

    )
  );
}
add_action( 'init', 'create_post_type_eco_venosa' );
?>