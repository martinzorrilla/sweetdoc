<?php  

function create_post_type_prescription() {

/*Patient Post_type*/
    register_post_type( 'sw_prescription',
    array(
      'labels' => array(
        'name' => __( 'Prescriptions' ),
        'singular_name' => __( 'Prescription' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_post_type_prescription' );
?>