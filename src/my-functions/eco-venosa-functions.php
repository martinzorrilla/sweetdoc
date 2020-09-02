<?php
/*
********************************************************************************
*
      Create New Appointment / Edit Appointment
*
********************************************************************************
*/
  function sw_create_eco_venosa_ajax(){

    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'', 'eco_venosa_id'=>'','msg'=>'');
  
    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    $eco_venosa_post_id = isset($_POST['eco_venosa_post_id']) && $_POST['eco_venosa_post_id'] != '' ? $_POST['eco_venosa_post_id'] : NULL;

    //eco_venosa data    IZQUIERDO
    $vena_femoral_comun = isset($_POST['vena_femoral_comun']) && $_POST['vena_femoral_comun'] != '' ? $_POST['vena_femoral_comun'] : NULL;
    $vena_femoral_superficial = isset($_POST['vena_femoral_superficial']) && $_POST['vena_femoral_superficial'] != '' ? $_POST['vena_femoral_superficial'] : NULL;
    $vena_poplitea = isset($_POST['vena_poplitea']) && $_POST['vena_poplitea'] != '' ? $_POST['vena_poplitea'] : NULL;
   
    $plexo_soleo_y_gemelar = isset($_POST['plexo_soleo_y_gemelar']) && $_POST['plexo_soleo_y_gemelar'] != '' ? $_POST['plexo_soleo_y_gemelar'] : NULL;
    $union_safeno_femoral = isset($_POST['union_safeno_femoral']) && $_POST['union_safeno_femoral'] != '' ? $_POST['union_safeno_femoral'] : NULL;
    $safeno_femoral_medida = isset($_POST['safeno_femoral_medida']) && $_POST['safeno_femoral_medida'] != '' ? $_POST['safeno_femoral_medida'] : NULL;
    $tronco_suprapatelar = isset($_POST['tronco_suprapatelar']) && $_POST['tronco_suprapatelar'] != '' ? $_POST['tronco_suprapatelar'] : NULL;
    $tronco_suprapatelar_medida = isset($_POST['tronco_suprapatelar_medida']) && $_POST['tronco_suprapatelar_medida'] != '' ? $_POST['tronco_suprapatelar_medida'] : NULL;
    $tronco_infrapatelar = isset($_POST['tronco_infrapatelar']) && $_POST['tronco_infrapatelar'] != '' ? $_POST['tronco_infrapatelar'] : NULL;
    
    $tronco_infrapatelar_medida = isset($_POST['tronco_infrapatelar_medida']) && $_POST['tronco_infrapatelar_medida'] != '' ? $_POST['tronco_infrapatelar_medida'] : NULL;
    $union_safeno_poplitea = isset($_POST['union_safeno_poplitea']) && $_POST['union_safeno_poplitea'] != '' ? $_POST['union_safeno_poplitea'] : NULL;
    $union_safeno_poplitea_medida = isset($_POST['union_safeno_poplitea_medida']) && $_POST['union_safeno_poplitea_medida'] != '' ? $_POST['union_safeno_poplitea_medida'] : NULL;
    $vena_safena_parva = isset($_POST['vena_safena_parva']) && $_POST['vena_safena_parva'] != '' ? $_POST['vena_safena_parva'] : NULL;
    $vena_safena_parva_medida = isset($_POST['vena_safena_parva_medida']) && $_POST['vena_safena_parva_medida'] != '' ? $_POST['vena_safena_parva_medida'] : NULL;
    $venas_perforantes = isset($_POST['venas_perforantes']) && $_POST['venas_perforantes'] != '' ? $_POST['venas_perforantes'] : NULL;
    $venas_perforantes_medida = isset($_POST['venas_perforantes_medida']) && $_POST['venas_perforantes_medida'] != '' ? $_POST['venas_perforantes_medida'] : NULL;
    $observaciones = isset($_POST['observaciones']) && $_POST['observaciones'] != '' ? $_POST['observaciones'] : NULL;
    $conclusion = isset($_POST['conclusion'])? $_POST['conclusion'] : NULL;
    
    //eco_venosa data    DERECHO
    $vena_femoral_comun_der = isset($_POST['vena_femoral_comun_der']) && $_POST['vena_femoral_comun_der'] != '' ? $_POST['vena_femoral_comun_der'] : NULL;
    
    $vena_femoral_superficial_der = isset($_POST['vena_femoral_superficial_der']) && $_POST['vena_femoral_superficial_der'] != '' ? $_POST['vena_femoral_superficial_der'] : NULL;
    $vena_poplitea_der = isset($_POST['vena_poplitea_der']) && $_POST['vena_poplitea_der'] != '' ? $_POST['vena_poplitea_der'] : NULL;
    $plexo_soleo_y_gemelar_der = isset($_POST['plexo_soleo_y_gemelar_der']) && $_POST['plexo_soleo_y_gemelar_der'] != '' ? $_POST['plexo_soleo_y_gemelar_der'] : NULL;
    $union_safeno_femoral_der = isset($_POST['union_safeno_femoral_der']) && $_POST['union_safeno_femoral_der'] != '' ? $_POST['union_safeno_femoral_der'] : NULL;
    $safeno_femoral_medida_der = isset($_POST['safeno_femoral_medida_der']) && $_POST['safeno_femoral_medida_der'] != '' ? $_POST['safeno_femoral_medida_der'] : NULL;
    $tronco_suprapatelar_der = isset($_POST['tronco_suprapatelar_der']) && $_POST['tronco_suprapatelar_der'] != '' ? $_POST['tronco_suprapatelar_der'] : NULL;
    $tronco_suprapatelar_medida_der = isset($_POST['tronco_suprapatelar_medida_der']) && $_POST['tronco_suprapatelar_medida_der'] != '' ? $_POST['tronco_suprapatelar_medida_der'] : NULL;
    $tronco_infrapatelar_der = isset($_POST['tronco_infrapatelar_der']) && $_POST['tronco_infrapatelar_der'] != '' ? $_POST['tronco_infrapatelar_der'] : NULL;
    $tronco_infrapatelar_medida_der = isset($_POST['tronco_infrapatelar_medida_der']) && $_POST['tronco_infrapatelar_medida_der'] != '' ? $_POST['tronco_infrapatelar_medida_der'] : NULL;
    $union_safeno_poplitea_der = isset($_POST['union_safeno_poplitea_der']) && $_POST['union_safeno_poplitea_der'] != '' ? $_POST['union_safeno_poplitea_der'] : NULL;
    $union_safeno_poplitea_medida_der = isset($_POST['union_safeno_poplitea_medida_der']) && $_POST['union_safeno_poplitea_medida_der'] != '' ? $_POST['union_safeno_poplitea_medida_der'] : NULL;
    $vena_safena_parva_der = isset($_POST['vena_safena_parva_der']) && $_POST['vena_safena_parva_der'] != '' ? $_POST['vena_safena_parva_der'] : NULL;
    $vena_safena_parva_medida_der = isset($_POST['vena_safena_parva_medida_der']) && $_POST['vena_safena_parva_medida_der'] != '' ? $_POST['vena_safena_parva_medida_der'] : NULL;
    $venas_perforantes_der = isset($_POST['venas_perforantes_der']) && $_POST['venas_perforantes_der'] != '' ? $_POST['venas_perforantes_der'] : NULL;
    $venas_perforantes_medida_der = isset($_POST['venas_perforantes_medida_der']) && $_POST['venas_perforantes_medida_der'] != '' ? $_POST['venas_perforantes_medida_der'] : NULL;
    $observaciones_der = isset($_POST['observaciones_der']) && $_POST['observaciones_der'] != '' ? $_POST['observaciones_der'] : NULL;
    
    $conclusion_der = isset($_POST['conclusion_der'])? $_POST['conclusion_der'] : NULL;
    

    
    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    // error_log(json_encode($_POST), 0);

    $params = array(
        "app_id" => $app_id,
        "patient_id" => $patient_id,
        "eco_venosa_post_id" => $eco_venosa_post_id,
        
        //colposcopia
        "vena_femoral_comun" => $vena_femoral_comun,
        "vena_femoral_superficial" => $vena_femoral_superficial,
        "vena_poplitea" => $vena_poplitea,
        "plexo_soleo_y_gemelar" => $plexo_soleo_y_gemelar,
        "union_safeno_femoral" => $union_safeno_femoral,
        "safeno_femoral_medida" => $safeno_femoral_medida,
        "tronco_suprapatelar" => $tronco_suprapatelar,
        "tronco_suprapatelar_medida" => $tronco_suprapatelar_medida,
        "tronco_infrapatelar" => $tronco_infrapatelar,
        "tronco_infrapatelar_medida" => $tronco_infrapatelar_medida,
        "union_safeno_poplitea" => $union_safeno_poplitea,
        "union_safeno_poplitea_medida" => $union_safeno_poplitea_medida,
        "vena_safena_parva" => $vena_safena_parva,
        "vena_safena_parva_medida" => $vena_safena_parva_medida,
        "venas_perforantes" => $venas_perforantes,
        "venas_perforantes_medida" => $venas_perforantes_medida,
        "observaciones" => $observaciones,
        "conclusion" => $conclusion,


        //miembro derecho
        "vena_femoral_comun_der" => $vena_femoral_comun_der,
        "vena_femoral_superficial_der" => $vena_femoral_superficial_der,
        "vena_poplitea_der" => $vena_poplitea_der,
        "plexo_soleo_y_gemelar_der" => $plexo_soleo_y_gemelar_der,
        "union_safeno_femoral_der" => $union_safeno_femoral_der,
        "safeno_femoral_medida_der" => $safeno_femoral_medida_der,
        "tronco_suprapatelar_der" => $tronco_suprapatelar_der,
        "tronco_suprapatelar_medida_der" => $tronco_suprapatelar_medida_der,
        "tronco_infrapatelar_der" => $tronco_infrapatelar_der,
        "tronco_infrapatelar_medida_der" => $tronco_infrapatelar_medida_der,
        "union_safeno_poplitea_der" => $union_safeno_poplitea_der,
        "union_safeno_poplitea_medida_der" => $union_safeno_poplitea_medida_der,
        "vena_safena_parva_der" => $vena_safena_parva_der,
        "vena_safena_parva_medida_der" => $vena_safena_parva_medida_der,
        "venas_perforantes_der" => $venas_perforantes_der,
        "venas_perforantes_medida_der" => $venas_perforantes_medida_der,
        "observaciones_der" => $observaciones_der,
        "conclusion_der" => $conclusion_der

    );

    //wp_die(var_dump($params));

    // NULL significa que es una nueva colpo, ya que no existe una asociada a esta consulta (app)
    if($eco_venosa_post_id === NULL){
      $result = sw_create_new_eco_venosa($params);
    }
    //elseif ($app_id != NULL && $app_id != '') {
    else{
      $result = sw_update_eco_venosa($params);
    }

    wp_die(json_encode($result));
  }

//wp_ajax_nopriv_ 
add_action( 'wp_ajax_sw_create_eco_venosa_ajax', 'sw_create_eco_venosa_ajax');

function sw_create_new_eco_venosa($params){

    //global $post;
    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'', 'eco_venosa_id'=>'','msg'=>'');

    $patient_id = $params['patient_id'];
    $app_id  = $params['app_id'];

 
    //miembro izquierdo
    $vena_femoral_comun = $params['vena_femoral_comun'];
    $vena_femoral_superficial = $params['vena_femoral_superficial'];
    $vena_poplitea = $params['vena_poplitea'];
    $plexo_soleo_y_gemelar = $params['plexo_soleo_y_gemelar'];
    $union_safeno_femoral = $params['union_safeno_femoral'];
    $safeno_femoral_medida = $params['safeno_femoral_medida'];

    $tronco_suprapatelar = $params['tronco_suprapatelar'];
    $tronco_suprapatelar_medida = $params['tronco_suprapatelar_medida'];
    $tronco_infrapatelar = $params['tronco_infrapatelar'];
    $tronco_infrapatelar_medida = $params['tronco_infrapatelar_medida'];
    $union_safeno_poplitea = $params['union_safeno_poplitea'];
    $union_safeno_poplitea_medida = $params['union_safeno_poplitea_medida'];
    $vena_safena_parva = $params['vena_safena_parva'];
    $vena_safena_parva_medida = $params['vena_safena_parva_medida'];
    $venas_perforantes = $params['venas_perforantes'];    
    $venas_perforantes_medida = $params['venas_perforantes_medida'];
    $observaciones = $params['observaciones'];
    $conclusion = $params['conclusion'];


    //meiembro derecho
    $vena_femoral_comun_der = $params['vena_femoral_comun_der'];
    $vena_femoral_superficial_der = $params['vena_femoral_superficial_der'];
    $vena_poplitea_der = $params['vena_poplitea_der'];
    $plexo_soleo_y_gemelar_der = $params['plexo_soleo_y_gemelar_der'];
    $union_safeno_femoral_der = $params['union_safeno_femoral_der'];
    $safeno_femoral_medida_der = $params['safeno_femoral_medida_der'];

    $tronco_suprapatelar_der = $params['tronco_suprapatelar_der'];
    $tronco_suprapatelar_medida_der = $params['tronco_suprapatelar_medida_der'];
    $tronco_infrapatelar_der = $params['tronco_infrapatelar_der'];
    $tronco_infrapatelar_medida_der = $params['tronco_infrapatelar_medida_der'];
    $union_safeno_poplitea_der = $params['union_safeno_poplitea_der'];
    $union_safeno_poplitea_medida_der = $params['union_safeno_poplitea_medida_der'];
    $vena_safena_parva_der = $params['vena_safena_parva_der'];
    $vena_safena_parva_medida_der = $params['vena_safena_parva_medida_der'];
    $venas_perforantes_der = $params['venas_perforantes_der'];    
    $venas_perforantes_medida_der = $params['venas_perforantes_medida_der'];
    $observaciones_der = $params['observaciones_der'];
    $conclusion_der = $params['conclusion_der'];


    $patient_fields = get_post_custom($patient_id);
    $name = $patient_fields['nombre'][0];
    $lastname = $patient_fields['apellido'][0];
    // $cedula = $patient_fields['cedula'][0];
    $fullname = $name.'-'.$lastname;
    $timeStamp = date("Y-m-d H:i:s"); 


      //crear el post colposcopia y actualizar. vincular el post con patient_id y con app_id
      $eco_venosa_post_data = array(
        'post_title'    => wp_strip_all_tags( $fullname." Consulta_ID= ".$app_id),
        'post_status'   => 'publish',
        'post_author'   => get_current_user_id(),
        'post_type' => 'sw_eco_venosa',
        //'meta_input' => ["related_patient", $patient_post ]
        //'post_category' => array( 8,39 )
      );

      // Insert the post into the database // returns post id on succes. 0 on fail
      
      $eco_venosa_post = wp_insert_post( $eco_venosa_post_data );
      if ($eco_venosa_post == 0) {
        wp_die( "Error creating a new Colposcopia" );
      }

      $acf_fields = array(

            "vena_femoral_comun" => $vena_femoral_comun,
            "vena_femoral_superficial" => $vena_femoral_superficial,
            "vena_poplitea" => $vena_poplitea,
            "plexo_soleo_y_gemelar" => $plexo_soleo_y_gemelar,
            "union_safeno_femoral" => $union_safeno_femoral,
            "safeno_femoral_medida" => $safeno_femoral_medida,
            "tronco_suprapatelar" => $tronco_suprapatelar,
            "tronco_suprapatelar_medida" => $tronco_suprapatelar_medida,
            "tronco_infrapatelar" => $tronco_infrapatelar,
            "tronco_infrapatelar_medida" => $tronco_infrapatelar_medida,
            "union_safeno_poplitea" => $union_safeno_poplitea,
            "union_safeno_poplitea_medida" => $union_safeno_poplitea_medida,
            "vena_safena_parva" => $vena_safena_parva,
            "vena_safena_parva_medida" => $vena_safena_parva_medida,
            "venas_perforantes" => $venas_perforantes,
            "venas_perforantes_medida" => $venas_perforantes_medida,
            "observaciones" => $observaciones,
            "conclusion" => $conclusion,



            //miembro derecho
            "vena_femoral_comun_der" => $vena_femoral_comun_der,
            "vena_femoral_superficial_der" => $vena_femoral_superficial_der,
            "vena_poplitea_der" => $vena_poplitea_der,
            "plexo_soleo_y_gemelar_der" => $plexo_soleo_y_gemelar_der,
            "union_safeno_femoral_der" => $union_safeno_femoral_der,
            "safeno_femoral_medida_der" => $safeno_femoral_medida_der,
            "tronco_suprapatelar_der" => $tronco_suprapatelar_der,
            "tronco_suprapatelar_medida_der" => $tronco_suprapatelar_medida_der,
            "tronco_infrapatelar_der" => $tronco_infrapatelar_der,
            "tronco_infrapatelar_medida_der" => $tronco_infrapatelar_medida_der,
            "union_safeno_poplitea_der" => $union_safeno_poplitea_der,
            "union_safeno_poplitea_medida_der" => $union_safeno_poplitea_medida_der,
            "vena_safena_parva_der" => $vena_safena_parva_der,
            "vena_safena_parva_medida_der" => $vena_safena_parva_medida_der,
            "venas_perforantes_der" => $venas_perforantes_der,
            "venas_perforantes_medida_der" => $venas_perforantes_medida_der,
            "observaciones_der" => $observaciones_der,
            "conclusion_der" => $conclusion_der


        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $eco_venosa_post );
            }
        }
      //agregar al post colpo el id de la app y del paciente que le corresponde.
      add_post_meta( $eco_venosa_post, 'eco_venosa_related_patient', $patient_id );
      add_post_meta( $eco_venosa_post, 'eco_venosa_related_app', $app_id );


      //file upload test
      $i = 1;  
      foreach ($_FILES as $file ) {

          $uploadedfile = $file;
          $movefile = wp_handle_upload($uploadedfile, array('action' => 'sw_create_eco_venosa_ajax'));

          //Guardamos la foto en la biblioteca multimedia
          if ($movefile) {
              $wp_upload_dir = wp_upload_dir();
              $attachment = array(
                  'guid' => $wp_upload_dir['url'].'/'.basename($movefile['file']),
                  'post_mime_type' => $movefile['type'],
                  'post_title' => preg_replace('/\.[^.]+$/', '', basename($movefile['file'])),
                  'post_content' => '',
                  'post_status' => 'inherit'
              );
              $attach_id = wp_insert_attachment($attachment, $movefile['file']);

              // nuevo. estas 3 lineas permiten que al alzar una imagen WP cree versiones de diferentes tamaños
              // con lo cual, luego podemos usar imagenes mas pequeñas para hacer los informes colposcopicos casi en un 1000%
              
              // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
              require_once( ABSPATH . 'wp-admin/includes/image.php' ); // me anda igual sin esta linea pero lei que hay que agregar si o si 
              $attach_data = wp_generate_attachment_metadata($attach_id, $movefile['file']);
              wp_update_attachment_metadata($attach_id, $attach_data);
              
              update_field('eco_venosa_imagen_'.$i, $attach_id, $eco_venosa_post);
              //update_field('colpo_imagen', $attach_id, $colpo_post);

              $i++;
          }
      }


      //---------------------------------------
      $result['success'] = TRUE;
      $result['patient_id'] = $patient_id;
      $result['app_id'] = $app_id;
      $result['eco_venosa_id'] = $eco_venosa_post;
      $result['msg'] = 'Nueva Ecografia venosa creada';
      return $result;
    

    //else{$result['error'] = ["key"=> "user_not_created", "msg" => "Error creating the Account"];}

}//end of sw_create_eco venosa


function sw_update_eco_venosa($params){

  $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'', 'colpo_id'=>'','msg'=>'');    

  $patient_id  = $params["patient_id"];
  $app_id  = $params["app_id"];
  $eco_venosa_post_id  = $params['eco_venosa_post_id'];
 

  $patient_fields = get_post_custom($patient_id);
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  //$cedula = $patient_fields['cedula'][0];
  $fullname = $name.'-'.$lastname;

  $vena_femoral_comun = $params['vena_femoral_comun'];
  $vena_femoral_superficial = $params['vena_femoral_superficial'];
  $vena_poplitea = $params['vena_poplitea'];
  $plexo_soleo_y_gemelar = $params['plexo_soleo_y_gemelar'];
  $union_safeno_femoral = $params['union_safeno_femoral'];
  $safeno_femoral_medida = $params['safeno_femoral_medida'];

  $tronco_suprapatelar = $params['tronco_suprapatelar'];
  $tronco_suprapatelar_medida = $params['tronco_suprapatelar_medida'];
  $tronco_infrapatelar = $params['tronco_infrapatelar'];
  $tronco_infrapatelar_medida = $params['tronco_infrapatelar_medida'];
  $union_safeno_poplitea = $params['union_safeno_poplitea'];
  $union_safeno_poplitea_medida = $params['union_safeno_poplitea_medida'];
  $vena_safena_parva = $params['vena_safena_parva'];
  $vena_safena_parva_medida = $params['vena_safena_parva_medida'];
  $venas_perforantes = $params['venas_perforantes'];    
  $venas_perforantes_medida = $params['venas_perforantes_medida'];
  $observaciones = $params['observaciones'];
  $conclusion = $params['conclusion'];
  
  
  //meiembro derecho
  $vena_femoral_comun_der = $params['vena_femoral_comun_der'];
  $vena_femoral_superficial_der = $params['vena_femoral_superficial_der'];
  $vena_poplitea_der = $params['vena_poplitea_der'];
  $plexo_soleo_y_gemelar_der = $params['plexo_soleo_y_gemelar_der'];
  $union_safeno_femoral_der = $params['union_safeno_femoral_der'];
  $safeno_femoral_medida_der = $params['safeno_femoral_medida_der'];

  $tronco_suprapatelar_der = $params['tronco_suprapatelar_der'];
  $tronco_suprapatelar_medida_der = $params['tronco_suprapatelar_medida_der'];
  $tronco_infrapatelar_der = $params['tronco_infrapatelar_der'];
  $tronco_infrapatelar_medida_der = $params['tronco_infrapatelar_medida_der'];
  $union_safeno_poplitea_der = $params['union_safeno_poplitea_der'];
  $union_safeno_poplitea_medida_der = $params['union_safeno_poplitea_medida_der'];
  $vena_safena_parva_der = $params['vena_safena_parva_der'];
  $vena_safena_parva_medida_der = $params['vena_safena_parva_medida_der'];
  $venas_perforantes_der = $params['venas_perforantes_der'];    
  $venas_perforantes_medida_der = $params['venas_perforantes_medida_der'];
  $observaciones_der = $params['observaciones_der'];
  $conclusion_der = $params['conclusion_der'];

  
  
      //update the colposcopy fields

      $acf_fields = array(

        "vena_femoral_comun" => $vena_femoral_comun,
        "vena_femoral_superficial" => $vena_femoral_superficial,
        "vena_poplitea" => $vena_poplitea,
        "plexo_soleo_y_gemelar" => $plexo_soleo_y_gemelar,
        "union_safeno_femoral" => $union_safeno_femoral,
        "safeno_femoral_medida" => $safeno_femoral_medida,
        "tronco_suprapatelar" => $tronco_suprapatelar,
        "tronco_suprapatelar_medida" => $tronco_suprapatelar_medida,
        "tronco_infrapatelar" => $tronco_infrapatelar,
        "tronco_infrapatelar_medida" => $tronco_infrapatelar_medida,
        "union_safeno_poplitea" => $union_safeno_poplitea,
        "union_safeno_poplitea_medida" => $union_safeno_poplitea_medida,
        "vena_safena_parva" => $vena_safena_parva,
        "vena_safena_parva_medida" => $vena_safena_parva_medida,
        "venas_perforantes" => $venas_perforantes,
        "venas_perforantes_medida" => $venas_perforantes_medida,
        "observaciones" => $observaciones,
        "conclusion" => $conclusion,


        //miembro derecho
        "vena_femoral_comun_der" => $vena_femoral_comun_der,
        "vena_femoral_superficial_der" => $vena_femoral_superficial_der,
        "vena_poplitea_der" => $vena_poplitea_der,
        "plexo_soleo_y_gemelar_der" => $plexo_soleo_y_gemelar_der,
        "union_safeno_femoral_der" => $union_safeno_femoral_der,
        "safeno_femoral_medida_der" => $safeno_femoral_medida_der,
        "tronco_suprapatelar_der" => $tronco_suprapatelar_der,
        "tronco_suprapatelar_medida_der" => $tronco_suprapatelar_medida_der,
        "tronco_infrapatelar_der" => $tronco_infrapatelar_der,
        "tronco_infrapatelar_medida_der" => $tronco_infrapatelar_medida_der,
        "union_safeno_poplitea_der" => $union_safeno_poplitea_der,
        "union_safeno_poplitea_medida_der" => $union_safeno_poplitea_medida_der,
        "vena_safena_parva_der" => $vena_safena_parva_der,
        "vena_safena_parva_medida_der" => $vena_safena_parva_medida_der,
        "venas_perforantes_der" => $venas_perforantes_der,
        "venas_perforantes_medida_der" => $venas_perforantes_medida_der,
        "observaciones_der" => $observaciones_der,
        "conclusion_der" => $conclusion_der 

        
      );
      foreach ($acf_fields as $field => $value) {
        // if($value != NULL){
              update_post_meta( $eco_venosa_post_id, $field, $value );
        // }
      }

      //test: empty all image fields before update. but only if image files has been selected to replace the old ones.
      $update_eco_venosa_images = false;
      foreach ($_FILES as $file ) {
        if($file['name'] != "") {
          $update_eco_venosa_images = true;
          }
      }

      if ($update_eco_venosa_images) {         
        $image_fields = array(
            "eco_venosa_imagen_1" => "",         
            "eco_venosa_imagen_2" => "",         
            "eco_venosa_imagen_3" => "",         
            "eco_venosa_imagen_4" => "",         
            "eco_venosa_imagen_5" => ""         
        );
        foreach ($image_fields as $field => $value) {
          update_post_meta( $eco_venosa_post_id, $field, $value );
        }
      }
      //file upload test
      $i = 1;   
      foreach ($_FILES as $file ) {

        $uploadedfile = $file;
        $movefile = wp_handle_upload($uploadedfile, array('action' => 'sw_create_eco_venosa_ajax'));

        //Guardamos la foto en la biblioteca multimedia
        if ($movefile) {
          $wp_upload_dir = wp_upload_dir();
          $attachment = array(
            'guid' => $wp_upload_dir['url'].'/'.basename($movefile['file']),
            'post_mime_type' => $movefile['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($movefile['file'])),
            'post_content' => '',
            'post_status' => 'inherit'
          );
          $attach_id = wp_insert_attachment($attachment, $movefile['file']);
          

          // nuevo. estas 3 lineas permiten que al alzar una imagen WP cree versiones de diferentes tamaños
          // con lo cual, luego podemos usar imagenes mas pequeñas para hacer los informes colposcopicos casi en un 1000%
          
          // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
          require_once( ABSPATH . 'wp-admin/includes/image.php' ); // me anda igual sin esta linea pero lei que hay que agregar si o si 
          $attach_data = wp_generate_attachment_metadata($attach_id, $movefile['file']);
          wp_update_attachment_metadata($attach_id, $attach_data);


          //update_post_meta( $colpo_post_id, 'colpo_imagen', $attach_id );  
          update_post_meta( $eco_venosa_post_id, 'eco_venosa_imagen_'.$i, $attach_id );  
          //update_field('colpo_imagen', $attach_id, $colpo_post_id);
          $i++;
        }
      }
      //end update colposcopy

      $result['success'] = TRUE;
      $result['msg'] = 'Ecografía venosa actualizada';
      $result['patient_id'] = $patient_id;
      $result['app_id'] = $app_id;
      $result['colpo_id'] = $eco_venosa_post_id;

      
  return $result;
}



?>