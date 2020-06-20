<?php
function sw_add_doctor_role(){

//remove_role( 'doctor' );

	$result = add_role(
		'doctor',
		__( 'Doctor' ),
		array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => true, // Use false to explicitly deny
        // 'create_users' => true,
        'create_users' => false,
        'list_users' => true,
        'upload_files' => true,
        'edit_dashboard' => true,

    )
	);
	if ( null !== $result ) {
		echo 'Yay! Doctor role created!';
	}
	else {
		//echo 'Oh... the Doctor role already exists.<br/>';
		//wp_die( "the Doctor role already exists." );
	}
}
add_action( 'init', 'sw_add_doctor_role' );
?>