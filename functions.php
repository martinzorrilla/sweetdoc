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



//returns person post id on succes, false on failure.
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
***************************************************
*/


  function sw_create_appointment_ajax(){

  $result = [];
  //$result = array("error"=>[], "success"=>false);

    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;

    $menarca = isset($_POST['menarca']) && $_POST['menarca'] != '' ? $_POST['menarca'] : NULL;
    $irs = isset($_POST['irs']) && $_POST['irs'] != '' ? $_POST['irs'] : NULL; 
  

    //$person_post_id  = cca_get_current_user_person_post_id();

    $params = array(
        "app_id" => $app_id,
        "menarca" => $menarca,
        "irs" => $irs,
        "patient_id" => $patient_id
    );

    //wp_die(var_dump($params));

    $result = sw_create_appointment($params);


    wp_die(json_encode($result));
  }



//wp_ajax_nopriv_
add_action( 'wp_ajax_sw_create_appointment_ajax', 'sw_create_appointment_ajax');

function sw_create_appointment($params){

    $result = array('error'=>[], 'success'=>FALSE);

    //wp_die(var_dump($result));
    //wp_die( '<pre>' . var_dump($result) . '</pre>' );

    //$project_id     = $params["project_id"];
    $app_id  = $params["app_id"];
    $patient_id = $params['patient_id'];
    $menarca = $params['menarca'];
    $irs = $params['irs'];

    //$app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;
    //$patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    //$menarca = isset($_POST['menarca']) && $_POST['menarca'] != '' ? $_POST['menarca'] : NULL;
    //$irs = isset($_POST['irs']) && $_POST['irs'] != '' ? $_POST['irs'] : NULL;


    $name = get_field('nombre', $patient_id);
    $lastname = get_field('apellido', $patient_id);
    //$cedula = get_field('cedula', $patient_id);
    $fullname = $name.' '.$lastname;
    $local_timestamp = get_the_time('U');

    var_dump('$patient_id ' . $patient_id . ' --</br>');

    if ($app_id === 'new' && $patient_id != NULL) {
      //echo "  nueva consulta";
      $my_post = array(
        'post_title'    => wp_strip_all_tags( $fullname.'test' ),
        //'post_content'  => $_POST['post_content'],
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

      var_dump('$app_post' . $app_post . '</br>');

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                var_dump($value); echo '<br>';
                update_field( $field, $value, $app_post );
            }
        }

      echo '<br>'; echo '<br>';
      var_dump(get_fields($app_post));

      add_post_meta( $app_post, 'related_patient', $patient_id );
     // echo "## newly created app_id: ";
      //echo $appointment_id;
      $result['success'] = TRUE;
      //$result['error'] => 'no errors';
      //var_dump('<br> result = '. $result['succes'].'<br>'.$result['error']);
      var_dump('<br> result = '. $result['success']);
    }//if new patient = true



  /* ************************************** */


    //if ( true ) { //aca deberia controlar que la consulta es de es paciente o algo asi
    else{

        $acf_fields = array(
            "menarca" => $menarca,
            "irs" => $irs
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL)
                update_field( $field, $value, $app_id );
        }

        // save the data
        //do_action('acf/save_post' , $app_id);

        $result['success'] = false;
    }
    /*else{
        $result['error'] = ["key"=> "create_app_fail", "msg" => "Error creting app"];
    }*/

    //wp_die(json_encode($result));
}//end of sw_create_appointment


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