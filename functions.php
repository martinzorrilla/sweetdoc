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

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );



//DEPRECATED: NO SE USA EN SWEETDOCTOR
// returns person post id on succes, false on failure.
  function cca_get_current_user_person_post_id(){
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    //If the meta value does not exist and $single is true the function will return an empty string.
    $user_person_id= get_user_meta( $current_user_id, 'person_post_id', true );
    return $user_person_id;
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

/*
********************************************************************************
*
      CreatePatient
*
********************************************************************************
*/

function sw_create_patient_ajax(){

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

    $result = sw_create_patient($params);

    //if(algun tipo de control)
      //$result['success'] = TRUE;
    wp_die(json_encode($result));
}

add_action( 'wp_ajax_sw_create_patient_ajax', 'sw_create_patient_ajax');

//deberia recibir el parametro ''post_author' asi si si la que creo el paciente
//fue la secretaria, solo le paso como parametro el meta de la secre "post_author"
//que va coincidir con el doctor que la creo, de esa forma al traer los pacientes
// puedo usar ese parametro para que traiga todos los pacientes de ese doctor.
function sw_create_patient($params){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $static_values = [];

      $patient_name = $params['patient_name'];
      $patient_last_name = $params['patient_last_name'];
      $patient_ci = $params['patient_ci'];
      $post_author = $params['post_author'];

      $patient_owner = sw_get_patient_owner();

      $my_post = array(
        'post_title'    => wp_strip_all_tags( $patient_name.' '. $patient_last_name ),
        'post_status'   => 'publish',
        //'post_author'   => get_current_user_id(),
        'post_author'   => $patient_owner,
        'post_type' => 'sw_patient',
        //'meta_input' => ["related_patient", $patient_post ]
        //'post_category' => array( 8,39 )
      );

      // Insert the post into the database // returns post id on succes. 0 on fail
      $post_id = wp_insert_post( $my_post );
      if ($post_id == 0) {
      //  wp_die( "Error creating a new Patient" );
      }

      $acf_fields = array(
            "nombre" => $patient_name,
            "apellido" => $patient_last_name,
            "cedula" => $patient_ci
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $post_id );
            }
        }


      //create the patient static data post type
      //send param array with name , lastname and $post_id wich is the receently created patient
      $static_values = ['patient_name'=>$patient_name,
                        'patient_last_name'=>$patient_last_name, 
                        'patient_id'=>$post_id
                       ];

      $static_data = sw_create_static_data($static_values);

      $result['success'] = TRUE;
      $result['msg'] = 'Nuevo Paciente creado';
      return $result;
}

//Create post type static data and relate it to the created patient
function sw_create_static_data($params){

    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'','msg'=>'');

    $patient_name = $params['patient_name'];
    $patient_last_name = $params['patient_last_name'];
    $patient_id = $params['patient_id'];

    $fullname = $patient_name.' '.$patient_last_name;

      $my_post = array(
        'post_title'    => wp_strip_all_tags( $fullname.' ID: '.$patient_id),
        'post_status'   => 'publish',
        'post_author'   => get_current_user_id(),
        'post_type'     => 'sw_static_data',
        //'meta_input' => ["related_patient", $patient_post ]
        //'post_category' => array( 8,39 )
      );

      // Insert the post into the database // returns post id on succes. 0 on fail
      $app_post = wp_insert_post( $my_post );
      if ($app_post == 0) {
        wp_die( "Error creating a new static data post for this patient" );
      }

/*      $acf_fields = array(
            "menarca" => $menarca,
            "irs" => $irs
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $app_post );
            }
        }*/

      add_post_meta( $app_post, 'patients_static_data', $patient_id );
      $result['success'] = TRUE;
      $result['patient_id'] = $patient_id;
      //$result['app_id'] = $app_post;
      $result['msg'] = 'Patient Static Data Created.';
      return $result;
}

/*
********************************************************************************
*
      Create New Appointment / Edit Appointment
*
********************************************************************************
*/
  function sw_create_appointment_ajax(){

    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'','msg'=>'');
  
    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    //common-variable data
    $menarca = isset($_POST['menarca']) && $_POST['menarca'] != '' ? $_POST['menarca'] : NULL;
    $irs = isset($_POST['irs']) && $_POST['irs'] != '' ? $_POST['irs'] : NULL; 
    
    //private/static data
    $cesareas = isset($_POST['cesareas']) && $_POST['cesareas'] != '' ? $_POST['cesareas'] : NULL; 
    $static_data_post_id = isset($_POST['static_data_post_id']) && $_POST['static_data_post_id'] != '' ? $_POST['static_data_post_id'] : NULL;

    $params = array(
        "app_id" => $app_id,
        "menarca" => $menarca,
        "irs" => $irs,
        "patient_id" => $patient_id,
        "cesareas" => $cesareas,
        "static_data_post_id" => $static_data_post_id
    );

    //wp_die(var_dump($params));

    if($app_id === 'new'){
      $result = sw_create_new_appointment($params);
      //sw_create_new_appointment($params);
      //$result = array('error'=>[], 'success'=>TRUE);
    }
    //elseif ($app_id != NULL && $app_id != '') {
    else{
      $result = sw_update_single_appointment($params);
    }

    wp_die(json_encode($result));
  }

//wp_ajax_nopriv_
add_action( 'wp_ajax_sw_create_appointment_ajax', 'sw_create_appointment_ajax');

function sw_create_new_appointment($params){

    //global $post;
    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'','msg'=>'');

    $app_id  = $params['app_id'];
    $patient_id = $params['patient_id'];
    $menarca = $params['menarca'];
    $irs = $params['irs'];

    //$app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;

    //$name = get_field('nombre', $patient_id);
    //$lastname = get_field('apellido', $patient_id);
    //$cedula = get_field('cedula', $patient_id);
    
    $patient_fields = get_post_custom($patient_id);
    $name = $patient_fields['nombre'][0];
    $lastname = $patient_fields['apellido'][0];
    $cedula = $patient_fields['cedula'][0];
    $fullname = $name.' '.$lastname;

    //$fullname = $name.' '.$lastname;
    //$local_timestamp = get_the_time('U');

    if ($app_id === 'new' && $patient_id != NULL) {
      $my_post = array(
        'post_title'    => wp_strip_all_tags( $fullname),
        'post_status'   => 'publish',
        'post_author'   => get_current_user_id(),
        'post_type' => 'sw_consulta',
        //'meta_input' => ["related_patient", $patient_post ]
        //'post_category' => array( 8,39 )
      );

      // Insert the post into the database // returns post id on succes. 0 on fail
      $app_post = wp_insert_post( $my_post );
      if ($app_post == 0) {
        wp_die( "Error creating a new appointment" );
      }

      $acf_fields = array(
            "menarca" => $menarca,
            "irs" => $irs
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $app_post );
            }
        }

      add_post_meta( $app_post, 'related_patient', $patient_id );
      $result['success'] = TRUE;
      $result['patient_id'] = $patient_id;
      $result['app_id'] = $app_post;
      $result['msg'] = 'Nueva consulta creada';
      return $result;
    }//if new patient = true

    //else{$result['error'] = ["key"=> "user_not_created", "msg" => "Error creating the Account"];}

}//end of sw_create_appointment


function sw_update_single_appointment($params){

    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'','msg'=>'');
    
    $app_id  = $params["app_id"];
    $static_data_post_id  = $params["static_data_post_id"];
    $menarca = $params['menarca'];
    $irs = $params['irs'];
    
    //private/static data
    $cesareas = $params['cesareas'];

    if ($app_id != NULL && $app_id != '') {
        //update the private/static data
        $acf_fields = array(
            "cesareas" => $cesareas,
        );
        foreach ($acf_fields as $field => $value) {
            if($value != NULL)
                //var_dump("clave: ".$field." valor: ".$value)."<br>";
                //var_dump("app_id: ".$app_id)."<br>";
                //update_field( $field, $value, $app_id );
                update_post_meta( $static_data_post_id, $field, $value );
        }


        //update the common fields
        $acf_fields = array(
            "menarca" => $menarca,
            "irs" => $irs
        );
        foreach ($acf_fields as $field => $value) {
            if($value != NULL)
                //var_dump("clave: ".$field." valor: ".$value)."<br>";
                //var_dump("app_id: ".$app_id)."<br>";
                //update_field( $field, $value, $app_id );
                update_post_meta( $app_id, $field, $value );
        }


        $result['success'] = TRUE;
        $result['msg'] = 'Consulta Actualizada';
    }
    /*else{
        $result['error'] = ["key"=> "create_app_fail", "msg" => "Error creting app"];
    }*/
    return $result;
}

//get all the related appointments of a given patient
function sw_get_related_appointments($patient_id){

  $args = array(
    'post_type'  => 'sw_consulta',
    'meta_key'   => 'related_patient',
    'posts_per_page' => -1,
  //'orderby'    => 'meta_value_num',
  //'order'      => 'ASC',
    'meta_query' => array(
      array(
        'key'     => 'related_patient',
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


//Cuando se crea un usuario del tipo secretaria es importante saber el id del doctor que 
//creo este usuario para poder despues filtrar los pacientes por doctor.
//(en caso que la secretraria cree pacientes).
function save_custom_user_profile_fields($user_id){


    $current_id = sw_get_current_id();
    # save my custom field
    update_user_meta($user_id, 'created_by', $current_id);
}
add_action('user_register', 'save_custom_user_profile_fields');