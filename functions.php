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
add_action( 'wp_ajax_sw_create_appointment', 'sw_create_appointment');
//borrar el nopriv para produccion
//add_action( 'wp_ajax_nopriv_cca_create_profile', 'cca_create_profile');

function sw_create_appointment(){

    $result = array('error'=>[], 'success'=>FALSE);

    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;

    $menarca = isset($_POST['menarca']) && $_POST['menarca'] != '' ? $_POST['menarca'] : NULL;
    $irs = isset($_POST['irs']) && $_POST['irs'] != '' ? $_POST['irs'] : NULL;

    //if ( true ) { //aca deberia controlar que la consulta es de es paciente o algo asi
    if ( $app_id ) {

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

        $result['success'] = true;
    }
    else{
        $result['error'] = ["key"=> "create_app_fail", "msg" => "Error creting app"];
    }

    wp_die(json_encode($result));
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