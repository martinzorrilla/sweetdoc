<?php  

function create_post_type_eco_arterial() {

/*Patient Post_type*/
    register_post_type( 'sw_eco_arterial',
    array(
      'labels' => array(
        'name' => __( 'Ecografias Arteriales' ),
        'singular_name' => __( 'Ecografia Arterial' )
      ),
      'public' => true,
      'menu_icon' => 'dashicons-video-alt',
      'menu_position' => 85,
      'has_archive' => true,
      'taxonomies' => array( 'category' ),

    )
  );
}
add_action( 'init', 'create_post_type_eco_arterial' );
?>