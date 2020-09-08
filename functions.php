<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

require_once( 'library/oikos-post-type-lib.php' );

require_once 'library/fpdf/fpdf.php';
require_once 'library/fpdf/WriteTag.php';
require_once 'library/fpdf/WriteHTML.php';


/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}


/**
 * Post Types Definitions - autoloader
 */
foreach (glob(get_template_directory()."/config/post-types/*.php") as $filename) {
    require_once($filename);
}

/**
 * Taxonomies Definitions - autoloader
 */
foreach (glob(get_template_directory()."/config/taxonomies/*.php") as $filename) {
    require_once($filename);
}

/**
 * Custom Roles - autoloader
 */
foreach (glob(get_template_directory()."/config/custom-roles/*.php") as $filename) {
    require_once($filename);
}


/**
 * My-Custom Functions - autoloader
 */
foreach (glob(get_template_directory()."/src/my-functions/*.php") as $filename) {
    require_once($filename);
}

/*********************************************************************************
*
*
      Codigo para la funcion hm_get_template_part()
*
**********************************************************************************
*/
/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the template as $template_args array
 * @param string filepart
 * @param mixed wp_args style argument list
 */
function hm_get_template_part( $file, $template_args = array(), $cache_args = array() ) {
  $template_args = wp_parse_args( $template_args );
  $cache_args = wp_parse_args( $cache_args );
  if ( $cache_args ) {
    foreach ( $template_args as $key => $value ) {
      if ( is_scalar( $value ) || is_array( $value ) ) {
        $cache_args[$key] = $value;
      } else if ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
        $cache_args[$key] = call_user_method( 'get_id', $value );
      }
    }
    if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {
      if ( ! empty( $template_args['return'] ) )
        return $cache;
      echo $cache;
      return;
    }
  }
  $file_handle = $file;
  do_action( 'start_operation', 'hm_template_part::' . $file_handle );
  if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
    $file = get_stylesheet_directory() . '/' . $file . '.php';
  elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
    $file = get_template_directory() . '/' . $file . '.php';
  ob_start();
  $return = require( $file );
  $data = ob_get_clean();
  do_action( 'end_operation', 'hm_template_part::' . $file_handle );
  if ( $cache_args ) {
    wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
  }
  if ( ! empty( $template_args['return'] ) )
    if ( $return === false )
      return false;
    else
      return $data;
  echo $data;
}

/*
********************************************************************************
*
      CreateSecretary
*
********************************************************************************
*/

function sw_create_secretary_ajax(){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    //$result = [];
    $patient_name = isset($_POST['patient_name']) && $_POST['patient_name'] != '' ? $_POST['patient_name'] : NULL;
    $patient_last_name = isset($_POST['patient_last_name']) && $_POST['patient_last_name'] != '' ? $_POST['patient_last_name'] : NULL;
    $patient_ci = isset($_POST['patient_ci']) && $_POST['patient_ci'] != '' ? $_POST['patient_ci'] : NULL;

    $params = array(
        "patient_name" => $patient_name,
        "patient_last_name" => $patient_last_name,
        "patient_ci" => $patient_ci
    );

    
    // DESCOMENTAR ESTA LINEA PARA QUE FUNCIONE LA CREACION DEL USUARIO CON ROL SECRETARY
     $result = sw_create_secretary($params);

    //if(algun tipo de control)
      //$result['success'] = TRUE;
    wp_die(json_encode($result));
}

add_action( 'wp_ajax_sw_create_secretary_ajax', 'sw_create_secretary_ajax');


function sw_create_secretary($params){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');

      $secretary_name = $params['patient_name'];
      $secretary_last_name = $params['patient_last_name'];
      $secretary_email = $params['patient_ci'];
      //$post_author = $params['post_author'];



      //create a new wp user-----------
      $user_id = username_exists( $secretary_name );
      //if ( !$user_id and email_exists($patient_email) == false ) {
      if ( true ) {
        $password = "admin";
        $user_id = wp_create_user( $secretary_name, $password, $secretary_email );

         $user = new WP_User( $user_id );
         $user->set_role( 'secretary' );


        $result['success'] = TRUE;
        $result['msg'] = 'Nuevo Asistente creado';
      } else {
        $result['success'] = 'FALLO';
        //$result['error'][0] = TRUE;
        //$random_password = __('User already exists.  Password inherited.');
      }
      //------------------------------

      return $result;
}


//get static_data post of a given patient
function sw_get_static_data_id($patient_id){

  $args = array(
    'post_type'  => 'sw_static_data',
    'meta_key'   => 'patients_static_data',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'patients_static_data',
        'value'   => array($patient_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}

//get static_data post of a given app_id of a patient
//returns NULL if the app_id does not have a colposcopy
function sw_get_colpo_id($app_id){

  $args = array(
    'post_type'  => 'sw_colposcopia',
    'meta_key'   => 'colpo_related_app',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'colpo_related_app',
        'value'   => array($app_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}


function sw_get_eco_venosa_id($app_id){

  $args = array(
    'post_type'  => 'sw_eco_venosa',
    'meta_key'   => 'eco_venosa_related_app',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'eco_venosa_related_app',
        'value'   => array($app_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}

function sw_get_eco_arterial_id($app_id){

  $args = array(
    'post_type'  => 'sw_eco_arterial',
    'meta_key'   => 'eco_arterial_related_app',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'eco_arterial_related_app',
        'value'   => array($app_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}


// como deberia funcionar
// recibe la app_id y devuelve el patient_id
function sw_get_patient_id_from_app_id($app_id){

  $args = array(
    'post_type'  => 'sw_consulta',
    'meta_key'   => 'related_appointment',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'related_appointment',
        'value'   => array($app_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}


//get static_data post of a given app_id of a patient
//returns NULL if the app_id does not have a colposcopy
function sw_patiente_colpos($patient_id){

  $args = array(
    'post_type'  => 'sw_colposcopia',
    'meta_key'   => 'colpo_related_patient',
    'posts_per_page' => -1,
    'meta_query' => array(
      array(
        'key'     => 'colpo_related_patient',
        'value'   => array($patient_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}

//  Get all the patients of a given doctor
//  * search_param = ''; will get all the patients
function sw_get_patients($param){

//'author__in' needs an array to work properly
$patient_owner = [];
$patient_owner[0] = sw_get_patient_owner();

  $args = array(
    'post_type'   => 'sw_patient',
    'numberposts' => -1,
    'author__in'   => $patient_owner,
    //'meta_key'   => 'nombre',
    /*'meta_query' => array(
      'relation' => 'OR',
        array(
          'key'     => 'post_author',
          'value'   => 2,
          'compare' => 'LIKE',
        ),
        array(
          'key'     => 'apellido',
          'value'   => $param,
          'compare' => 'LIKE',
        ),
    ),*/
  );
  $latest_patients = get_posts( $args );
  wp_reset_postdata();
  return $latest_patients;
}


//  Get all the posts of a given doctor. post type is a parameter
function sw_get_post_types_of_current_doctor($post_type){

  //'author__in' needs an array to work properly
  $patient_owner = [];
  // gets the doctor id, even id the current user role is secretary
  $patient_owner[0] = sw_get_patient_owner();
  
    $args = array(
      'post_type'   => $post_type,
      'numberposts' => -1,
      'author__in'   => $patient_owner,
      //'meta_key'   => 'nombre',
      /*'meta_query' => array(
        'relation' => 'OR',
          array(
            'key'     => 'post_author',
            'value'   => 2,
            'compare' => 'LIKE',
          ),
          array(
            'key'     => 'apellido',
            'value'   => $param,
            'compare' => 'LIKE',
          ),
      ),*/
    );
    $latest_patients = get_posts( $args );
    wp_reset_postdata();
    return $latest_patients;
  }


//returns the id of the doctor thaat created this sw_get_secretarys_doctor_id
  function sw_get_secretarys_doctor_id(){
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    //If the meta value does not exist and $single is true the function will return an empty string.
    $doctor_id= get_user_meta( $current_user_id, 'created_by', true );
    return $doctor_id;
  }

// returns id of the current user
  function sw_get_current_id(){
    $current_user = wp_get_current_user();
    $current_id = $current_user->ID;
    return $current_id;
  }


//crear funcion que determina si el usuario tiene el rol secretaria o doctor
function sw_get_current_user_role(){
  $current_user_id = sw_get_current_id();
  $user_info = get_userdata($current_user_id);
  $user_roles = $user_info->roles;

  $result = "";

  if (in_array("doctor", $user_roles))
  {
    //echo "Match found";
    $result = "doctor";
    return $result;
  }

  if (in_array("secretary", $user_roles))
  {
    //echo "Match found";
    $result = "secretary";
    return $result;
  }

  return $result;
}

//funcion que devuelve el author por el cual buscar o crear el paciente
function sw_get_patient_owner(){

  $result = sw_get_current_user_role();

  if($result == "doctor" or $result == ""){
    $patient_owner = sw_get_current_id();
    return $patient_owner;
  }

  if($result == "secretary"){
    $patient_owner = sw_get_secretarys_doctor_id();
    return $patient_owner;
  }
}

//Cuando se crea un usuario del tipo secretary es importante saber el id del doctor que 
//creo este usuario para poder despues filtrar los pacientes por doctor.
//(en caso que la secretraria cree pacientes).
function save_custom_user_profile_fields($user_id){
    $current_id = sw_get_current_id();
    # save my custom field
    update_user_meta($user_id, 'created_by', $current_id);
}
add_action('user_register', 'save_custom_user_profile_fields');



/*
*
*
Function To upload images from to the front end to acf image fields
*
*/

// Deal with images uploaded from the front-end while allowing ACF to do it's thing
function my_acf_pre_save_post($post_id) {

if ( !function_exists('wp_handle_upload') ) {
require_once(ABSPATH . 'wp-admin/includes/file.php');
}

// Move file to media library
$movefile = wp_handle_upload( $_FILES['my_image_upload'], array('test_form' => false) );

// If move was successful, insert WordPress attachment
if ( $movefile && !isset($movefile['error']) ) {
$wp_upload_dir = wp_upload_dir();
$attachment = array(
'guid' => $wp_upload_dir['url'] . '/' . basename($movefile['file']),
'post_mime_type' => $movefile['type'],
'post_title' => preg_replace( '/\.[^.]+$/', ”, basename($movefile['file']) ),
'post_content' => ”,
'post_status' => 'inherit'
);
$attach_id = wp_insert_attachment($attachment, $movefile['file']);

// Assign the file as the featured image
set_post_thumbnail($post_id, $attach_id);
update_field('my_image_upload', $attach_id, $post_id);

}

return $post_id;

}

add_filter('acf/pre_save_post' , 'my_acf_pre_save_post');


/*
*
*
*
* AGREGAR TAXONOMIA A LAS PAGINAS Y POSTS. DE ESTA MANERA PUEDO ASIGNAR PAGINAS Y POSTS CON EL ATRIBUTO "DOCTOR LEVEL" ASI
* ESTAS PAGINAS Y POSTS NO PUEDEN SER VISTOS POR EL ROLE SECRETARY. ESO LO HAGO CON OTRA FUNCION QUE REDIRECCIONA A ESTOS ROLES
* A LA PAGINA PRINCIPAL SI ES QUE LAS PAGINAS O POSTS TIENEN EL ATRIBUTO DOCTOR LEVEL *
*
* @return void
*/
function category_with_pages() {
  register_taxonomy_for_object_type( 'category', 'page' );
  // agregar a los otros custom post types tambien
  // register_taxonomy_for_object_type( 'category', 'sw_colposcopia' );
  // register_taxonomy_for_object_type( 'category', 'sw paciente' );
  // register_taxonomy_for_object_type( 'category', 'sw incicaciones' );
  // . 
  // . 
}
add_action( 'init', 'category_with_pages' );





/**
 * WordPress function for redirecting users on login based on user role
 */

 // redirect del login de wordpress. wordpress login redirect 
// solo si es admin envia al wp-admin luego del logueo. en otros casos envia a la home del sitio

 function my_login_redirect( $url, $request, $user ){
  if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
      if( $user->has_cap( 'administrator' ) ) {
          $url = admin_url();
      } else {
        $url = home_url('');
        // $url = home_url('/members-only/');
      }
  }
  return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );

//Disable admin bar for specific user roles
add_action('after_setup_theme', 'remove_admin_bar_for_roles');
function remove_admin_bar_for_roles() {
    // if (current_user_can('doctor') && !is_admin()) {
    if (!is_admin()) {
        show_admin_bar(false);
    }
}

/**
 * Block wp-admin access for secretaries
 */
function ace_block_wp_admin() {
	if ( is_admin() &&  current_user_can( 'secretary' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_safe_redirect( home_url() );
		exit;
	}
}
add_action( 'admin_init', 'ace_block_wp_admin' );


/***********************************************************
**
*
*
*/
// redirect users that are not doctor or admin to home page when trying to acces special pages like appointment and others
// Example to restrict entire pages for logged in users only
function wpex_restrict_page_to_doctors_and_admin() {

	// Get global post
	global $post;
  $private_page = false;
      
  // Buscamos si la pagina tiene la categoria doctor-level, lo cual indica que solo se debe acceder si el rol es doctor o admin
  $postcat = get_the_category( $post->ID );
  $cat_names = wp_list_pluck( $postcat, 'name' );
  if (in_array("doctor-level", $cat_names)) {
    $private_page = true;
  }
  
  // Prevent access to page with ID of 2 and all children of this page
	// $page_id = 397;
	// if ( is_page() && ( $post->post_parent == $page_id || is_page( $page_id ) ) ) {

    // al usar esta condicion multiple, NO aplica para los single-posts, solo para las paginas y que ademas tienene la categoria doctor-level  
    if ( is_page()  && $private_page ) {
    // esta incluye a los single-posts, explicitamente
    // if ( (is_page() || is_single() ) && $private_page ) {
        
    // al usar solo esta condicion, tambien aplica para los single-posts.  
    // if ($private_page ) {
      
		// Set redirect to true by default
		$redirect = true;

    // $the_role = sw_get_current_user_role(); // antes usaba esta funcion pero puedo hacer lo mismo con 'current_user_can()'
    if(current_user_can('doctor') || current_user_can('administrator')){
		 	$redirect = false;
    }
		
		// Redirect people witout access to homepage
		if ( $redirect ) {
       wp_redirect( esc_url( home_url( '/' ) ), 307 );
		}

	}

}
add_action( 'template_redirect', 'wpex_restrict_page_to_doctors_and_admin' );




//get indication_id post of a given app_id of a patient
//returns NULL if the app_id does not have a indication
function sw_get_indication_id($app_id){

  $args = array(
    'post_type'  => 'sw_indication',
    'meta_key'   => 'related_indication',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'related_indication',
        'value'   => array($app_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}

//get indication_id post of a given app_id of a patient
//returns NULL if the app_id does not have a indication
function sw_get_studies_id($app_id){

  $args = array(
    'post_type'  => 'sw_study',
    'meta_key'   => 'related_study',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'related_study',
        'value'   => array($app_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}

//get indication_id post of a given app_id of a patient
//returns NULL if the app_id does not have a indication
function sw_get_laboratories_id($app_id){

  $args = array(
    'post_type'  => 'sw_laboratory',
    'meta_key'   => 'related_laboratory',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'related_laboratory',
        'value'   => array($app_id),
        'compare' => 'IN',
      ),
    ),
  );
  $myquery = new WP_Query( $args );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );

  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}

/*
********************************************************************************
*
      validate_patient()
*
********************************************************************************
*/
//validar los valores antes de crear el paciente. ie. que no exista la cedula en la base de datos
function validate_patient($params){

  $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
  
  $patient_id = $params['patient_id'];
  $patient_name = $params['patient_name'];
  $patient_last_name = $params['patient_last_name'];
  $patient_ci = $params['patient_ci'];
  
  
  $myquery = new WP_Query(  
    array( 
      //'id' => $patient_id,
      'post_type'  => 'sw_patient',
      'meta_query' => array(
        array(
          'key'     => 'cedula',
          'value'   => array($patient_ci),
          'compare' => 'IN',
        ),
      ),
    )
  );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );
  wp_reset_postdata(); //always reset the post data!
  //return $related;

  $error_msg_1 = "";
  $error_msg_2 = "";
  $empty_fields = false;
  $ci_exists =false;

  if( $patient_name =="" || $patient_last_name =="" || $patient_ci ==""){
    $empty_fields = true;
    $error_msg_1 = "Completar los campos obligatorios. ";
  }

  // it sizeof($related)>0 true it means that Cedula already exists
  // if(sizeof($related)>0){
  if(sizeof($related)>0 && $patient_id=="new"){
    $ci_exists = true;
    $error_msg_2 = "El numero de cédula ya existe";
  }
  if($ci_exists == true || $empty_fields){
    $result['error'][0] = TRUE;
    $result['msg'] = $error_msg_1.$error_msg_2;
    return $result;
  }
    
    
  $result['success'] = TRUE;
  $result['error'][0] = FALSE;

  //$result['patient_id'] = $patient_id;
  //$result['app_id'] = $app_post;
  $result['msg'] = 'No existe el nro de cedula en la base de datos.';
  return $result;
}

 
// ATENCION: para que funciones es SUPER IMPORTANTE configurar en el acf que devuelva la fecha
//  en el formato "20200612 Ymd"
function calcular_edad($fecha_de_nacimiento){
  //$bday = new DateTime('23.8.1988'); // Your date of birth
  $bday = new Datetime(date('d.m.y'));
  //  if ($fecha_de_nacimiento != ""){ $bday = new Datetime(date('d.m.y', strtotime($fecha_de_nacimiento)));}
   if ($fecha_de_nacimiento != ""){ 
     $bday = new Datetime($fecha_de_nacimiento);
      // $bday = new Datetime(intval($fecha_de_nacimiento));
    //  $bday->setTimestamp(intval($fecha_de_nacimiento));
    }
  // if ($fecha_de_nacimiento != ""){ $bday = new Datetime(date($fecha_de_nacimiento));}
  $today = new Datetime(date('d.m.y'));
  $diff = $today->diff($bday);
  return  $diff;
}


// *
// *calcular la cantidad de post publicados por post type.  recibe como parametro el post type que se desea calcular. por ejemplo patients
// parametros: $post_type = 'page' 
// return: numero de posts
// *  contador_de_posts($post_type = 'sw_patient')
// *
// *EL PROBLEMA DE ESTA DUNCION  es que no puede filtrar por autor por lo cual me trae todos los posts y no solo lo que son de este doctor

function contador_de_posts($post_type){
  $published_posts = 0;
  $count_posts = wp_count_posts($post_type);
  if ( $count_posts ) {
    $published_posts = $count_posts->publish;
  }
  return $published_posts;
}