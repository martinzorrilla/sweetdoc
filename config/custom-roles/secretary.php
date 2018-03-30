<?php
function sw_add_secretary_role(){

//remove_role( 'secretary' );
	
	$result = add_role(
		'secretary',
		__( 'Secretary' ),
		array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
        'upload_files' => true,
    )
	);
	if ( null !== $result ) {
		echo 'Yay! Secretary role created!';
	}
	else {
		//echo 'Oh... the secretary role already exists.<br/>';
		//wp_die( "the secretary role already exists." );
	}
}
add_action( 'init', 'sw_add_secretary_role' );
?>