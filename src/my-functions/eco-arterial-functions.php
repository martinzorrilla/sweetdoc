<?php
/*
********************************************************************************
*
      Create New Appointment / Edit Appointment
*
********************************************************************************
*/
  function sw_create_eco_arterial_ajax(){

    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'', 'eco_arterial_id'=>'','msg'=>'');
  
    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    $eco_arterial_post_id = isset($_POST['eco_arterial_post_id']) && $_POST['eco_arterial_post_id'] != '' ? $_POST['eco_arterial_post_id'] : NULL;


    //eco_arterial data    IZQUIERDO --------------------------------------

    $arteria_femoral_comun = isset($_POST['arteria_femoral_comun']) && $_POST['arteria_femoral_comun'] != '' ? $_POST['arteria_femoral_comun'] : NULL;
    $afc_obs = isset($_POST['afc_obs']) && $_POST['afc_obs'] != '' ? $_POST['afc_obs'] : NULL;
    $afc_flujo = isset($_POST['afc_flujo']) && $_POST['afc_flujo'] != '' ? $_POST['afc_flujo'] : NULL;


    $arteria_femoral_profunda = isset($_POST['arteria_femoral_profunda']) && $_POST['arteria_femoral_profunda'] != '' ? $_POST['arteria_femoral_profunda'] : NULL;
    $afp_obs = isset($_POST['afp_obs']) && $_POST['afp_obs'] != '' ? $_POST['afp_obs'] : NULL;
    $afp_flujo = isset($_POST['afp_flujo']) && $_POST['afp_flujo'] != '' ? $_POST['afp_flujo'] : NULL;
    
    $arteria_femoral_superficial = isset($_POST['arteria_femoral_superficial']) && $_POST['arteria_femoral_superficial'] != '' ? $_POST['arteria_femoral_superficial'] : NULL;
    $afs_obs = isset($_POST['afs_obs']) && $_POST['afs_obs'] != '' ? $_POST['afs_obs'] : NULL;
    $afs_flujo = isset($_POST['afs_flujo']) && $_POST['afs_flujo'] != '' ? $_POST['afs_flujo'] : NULL;
    
    $arteria_poplitea = isset($_POST['arteria_poplitea']) && $_POST['arteria_poplitea'] != '' ? $_POST['arteria_poplitea'] : NULL;
    $ap_obs = isset($_POST['ap_obs']) && $_POST['ap_obs'] != '' ? $_POST['ap_obs'] : NULL;
    $ap_flujo = isset($_POST['ap_flujo']) && $_POST['ap_flujo'] != '' ? $_POST['ap_flujo'] : NULL;
    
    $arteria_tibial_anterior = isset($_POST['arteria_tibial_anterior']) && $_POST['arteria_tibial_anterior'] != '' ? $_POST['arteria_tibial_anterior'] : NULL;
    $ata_obs = isset($_POST['ata_obs']) && $_POST['ata_obs'] != '' ? $_POST['ata_obs'] : NULL;
    $ata_flujo = isset($_POST['ata_flujo']) && $_POST['ata_flujo'] != '' ? $_POST['ata_flujo'] : NULL;
    
    $arteria_tibial_posterior = isset($_POST['arteria_tibial_posterior']) && $_POST['arteria_tibial_posterior'] != '' ? $_POST['arteria_tibial_posterior'] : NULL;
    $atp_obs = isset($_POST['atp_obs']) && $_POST['atp_obs'] != '' ? $_POST['atp_obs'] : NULL;
    $atp_flujo = isset($_POST['atp_flujo']) && $_POST['atp_flujo'] != '' ? $_POST['atp_flujo'] : NULL;
    
   
    $arteria_fibular_peroneal = isset($_POST['arteria_fibular_peroneal']) && $_POST['arteria_fibular_peroneal'] != '' ? $_POST['arteria_fibular_peroneal'] : NULL;
    $arfipe_obs = isset($_POST['arfipe_obs']) && $_POST['arfipe_obs'] != '' ? $_POST['arfipe_obs'] : NULL;
    $arfipe_flujo = isset($_POST['arfipe_flujo']) && $_POST['arfipe_flujo'] != '' ? $_POST['arfipe_flujo'] : NULL;
   

    $arteria_pedia = isset($_POST['arteria_pedia']) && $_POST['arteria_pedia'] != '' ? $_POST['arteria_pedia'] : NULL;
    $arpe_obs = isset($_POST['arpe_obs']) && $_POST['arpe_obs'] != '' ? $_POST['arpe_obs'] : NULL;
    $arpe_flujo = isset($_POST['arpe_flujo']) && $_POST['arpe_flujo'] != '' ? $_POST['arpe_flujo'] : NULL;
   
    
    $conclusion = isset($_POST['conclusion'])? $_POST['conclusion'] : NULL;
    
    

    //eco_arterial derecho --------------------------------------------------

    $arteria_femoral_comun_der = isset($_POST['arteria_femoral_comun_der']) && $_POST['arteria_femoral_comun_der'] != '' ? $_POST['arteria_femoral_comun_der'] : NULL;
    $afc_obs_der = isset($_POST['afc_obs_der']) && $_POST['afc_obs_der'] != '' ? $_POST['afc_obs_der'] : NULL;
    $afc_flujo_der = isset($_POST['afc_flujo_der']) && $_POST['afc_flujo_der'] != '' ? $_POST['afc_flujo_der'] : NULL;


    $arteria_femoral_profunda_der = isset($_POST['arteria_femoral_profunda_der']) && $_POST['arteria_femoral_profunda_der'] != '' ? $_POST['arteria_femoral_profunda_der'] : NULL;
    $afp_obs_der = isset($_POST['afp_obs_der']) && $_POST['afp_obs_der'] != '' ? $_POST['afp_obs_der'] : NULL;
    $afp_flujo_der = isset($_POST['afp_flujo_der']) && $_POST['afp_flujo_der'] != '' ? $_POST['afp_flujo_der'] : NULL;

    $arteria_femoral_superficial_der = isset($_POST['arteria_femoral_superficial_der']) && $_POST['arteria_femoral_superficial_der'] != '' ? $_POST['arteria_femoral_superficial_der'] : NULL;
    $afs_obs_der = isset($_POST['afs_obs_der']) && $_POST['afs_obs_der'] != '' ? $_POST['afs_obs_der'] : NULL;
    $afs_flujo_der = isset($_POST['afs_flujo_der']) && $_POST['afs_flujo_der'] != '' ? $_POST['afs_flujo_der'] : NULL;

    $arteria_poplitea_der = isset($_POST['arteria_poplitea_der']) && $_POST['arteria_poplitea_der'] != '' ? $_POST['arteria_poplitea_der'] : NULL;
    $ap_obs_der = isset($_POST['ap_obs_der']) && $_POST['ap_obs_der'] != '' ? $_POST['ap_obs_der'] : NULL;
    $ap_flujo_der = isset($_POST['ap_flujo_der']) && $_POST['ap_flujo_der'] != '' ? $_POST['ap_flujo_der'] : NULL;

    $arteria_tibial_anterior_der = isset($_POST['arteria_tibial_anterior_der']) && $_POST['arteria_tibial_anterior_der'] != '' ? $_POST['arteria_tibial_anterior_der'] : NULL;
    $ata_obs_der = isset($_POST['ata_obs_der']) && $_POST['ata_obs_der'] != '' ? $_POST['ata_obs_der'] : NULL;
    $ata_flujo_der = isset($_POST['ata_flujo_der']) && $_POST['ata_flujo_der'] != '' ? $_POST['ata_flujo_der'] : NULL;

    $arteria_tibial_posterior_der = isset($_POST['arteria_tibial_posterior_der']) && $_POST['arteria_tibial_posterior_der'] != '' ? $_POST['arteria_tibial_posterior_der'] : NULL;
    $atp_obs_der = isset($_POST['atp_obs_der']) && $_POST['atp_obs_der'] != '' ? $_POST['atp_obs_der'] : NULL;
    $atp_flujo_der = isset($_POST['atp_flujo_der']) && $_POST['atp_flujo_der'] != '' ? $_POST['atp_flujo_der'] : NULL;


    $arteria_fibular_peroneal_der = isset($_POST['arteria_fibular_peroneal_der']) && $_POST['arteria_fibular_peroneal_der'] != '' ? $_POST['arteria_fibular_peroneal_der'] : NULL;
    $arfipe_obs_der = isset($_POST['arfipe_obs_der']) && $_POST['arfipe_obs_der'] != '' ? $_POST['arfipe_obs_der'] : NULL;
    $arfipe_flujo_der = isset($_POST['arfipe_flujo_der']) && $_POST['arfipe_flujo_der'] != '' ? $_POST['arfipe_flujo_der'] : NULL;


    $arteria_pedia_der = isset($_POST['arteria_pedia_der']) && $_POST['arteria_pedia_der'] != '' ? $_POST['arteria_pedia_der'] : NULL;
    $arpe_obs_der = isset($_POST['arpe_obs_der']) && $_POST['arpe_obs_der'] != '' ? $_POST['arpe_obs_der'] : NULL;
    $arpe_flujo_der = isset($_POST['arpe_flujo_der']) && $_POST['arpe_flujo_der'] != '' ? $_POST['arpe_flujo_der'] : NULL;


    $conclusion_der = isset($_POST['conclusion_der'])? $_POST['conclusion_der'] : NULL;

    
    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    // error_log(json_encode($_POST), 0);

    $params = array(
        "app_id" => $app_id,
        "patient_id" => $patient_id,
        "eco_arterial_post_id" => $eco_arterial_post_id,
        
        //arterial izq
        "arteria_femoral_comun" => $arteria_femoral_comun,
        "afc_obs" => $afc_obs,
        "afc_flujo" => $afc_flujo,

        "arteria_femoral_profunda" => $arteria_femoral_profunda,
        "afp_obs" => $afp_obs,
        "afp_flujo" => $afp_flujo,

        "arteria_femoral_superficial" => $arteria_femoral_superficial,
        "afs_obs" => $afs_obs,
        "afs_flujo" => $afs_flujo,

        "arteria_poplitea" => $arteria_poplitea,
        "ap_obs" => $ap_obs,
        "ap_flujo" => $ap_flujo,

        "arteria_tibial_anterior" => $arteria_tibial_anterior,
        "ata_obs" => $ata_obs,
        "ata_flujo" => $ata_flujo,

        "arteria_tibial_posterior" => $arteria_tibial_posterior,
        "atp_obs" => $atp_obs,
        "atp_flujo" => $atp_flujo,

        "arteria_fibular_peroneal" => $arteria_fibular_peroneal,
        "arfipe_obs" => $arfipe_obs,
        "arfipe_flujo" => $arfipe_flujo,

        "arteria_pedia" => $arteria_pedia,
        "arpe_obs" => $arpe_obs,
        "arpe_flujo" => $arpe_flujo,

        "conclusion" => $conclusion,


        //arterial der
        "arteria_femoral_comun_der" => $arteria_femoral_comun_der,
        "afc_obs_der" => $afc_obs_der,
        "afc_flujo_der" => $afc_flujo_der,

        "arteria_femoral_profunda_der" => $arteria_femoral_profunda_der,
        "afp_obs_der" => $afp_obs_der,
        "afp_flujo_der" => $afp_flujo_der,

        "arteria_femoral_superficial_der" => $arteria_femoral_superficial_der,
        "afs_obs_der" => $afs_obs_der,
        "afs_flujo_der" => $afs_flujo_der,

        "arteria_poplitea_der" => $arteria_poplitea_der,
        "ap_obs_der" => $ap_obs_der,
        "ap_flujo_der" => $ap_flujo_der,

        "arteria_tibial_anterior_der" => $arteria_tibial_anterior_der,
        "ata_obs_der" => $ata_obs_der,
        "ata_flujo_der" => $ata_flujo_der,

        "arteria_tibial_posterior_der" => $arteria_tibial_posterior_der,
        "atp_obs_der" => $atp_obs_der,
        "atp_flujo_der" => $atp_flujo_der,

        "arteria_fibular_peroneal_der" => $arteria_fibular_peroneal_der,
        "arfipe_obs_der" => $arfipe_obs_der,
        "arfipe_flujo_der" => $arfipe_flujo_der,

        "arteria_pedia_der" => $arteria_pedia_der,
        "arpe_obs_der" => $arpe_obs_der,
        "arpe_flujo_der" => $arpe_flujo_der,

        "conclusion_der" => $conclusion_der


    );

    //wp_die(var_dump($params));

    // NULL significa que es una nueva colpo, ya que no existe una asociada a esta consulta (app)
    if($eco_arterial_post_id === NULL){
      $result = sw_create_new_eco_arterial($params);
    }
    //elseif ($app_id != NULL && $app_id != '') {
    else{
      $result = sw_update_eco_arterial($params);
    }

    wp_die(json_encode($result));
  }

//wp_ajax_nopriv_ 
add_action( 'wp_ajax_sw_create_eco_arterial_ajax', 'sw_create_eco_arterial_ajax');

function sw_create_new_eco_arterial($params){

    //global $post;
    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'', 'eco_arterial_id'=>'','msg'=>'');

    $patient_id = $params['patient_id'];
    $app_id  = $params['app_id'];

 
    //miembro izquierdo
    $arteria_femoral_comun = $params['arteria_femoral_comun'];
    $afc_obs = $params['afc_obs'];
    $afc_flujo = $params['afc_flujo'];

    $arteria_femoral_profunda = $params['arteria_femoral_profunda'];
    $afp_obs = $params['afp_obs'];
    $afp_flujo = $params['afp_flujo'];
    
    $arteria_femoral_superficial = $params['arteria_femoral_superficial'];
    $afs_obs = $params['afs_obs'];
    $afs_flujo = $params['afs_flujo'];
    
    $arteria_poplitea = $params['arteria_poplitea'];
    $ap_obs = $params['ap_obs'];
    $ap_flujo = $params['ap_flujo'];
    
    $arteria_tibial_anterior = $params['arteria_tibial_anterior'];
    $ata_obs = $params['ata_obs'];
    $ata_flujo = $params['ata_flujo'];
    
    $arteria_tibial_posterior = $params['arteria_tibial_posterior'];
    $atp_obs = $params['atp_obs'];
    $atp_flujo = $params['atp_flujo'];
    
   
    $arteria_fibular_peroneal = $params['arteria_fibular_peroneal'];
    $arfipe_obs = $params['arfipe_obs'];
    $arfipe_flujo = $params['arfipe_flujo'];
   

    $arteria_pedia = $params['arteria_pedia'];
    $arpe_obs = $params['arpe_obs'];
    $arpe_flujo = $params['arpe_flujo'];

    
    $conclusion = $params['conclusion'];


    //miembro derecho
    $arteria_femoral_comun_der = $params['arteria_femoral_comun_der'];
    $afc_obs_der = $params['afc_obs_der'];
    $afc_flujo_der = $params['afc_flujo_der'];

    $arteria_femoral_profunda_der = $params['arteria_femoral_profunda_der'];
    $afp_obs_der = $params['afp_obs_der'];
    $afp_flujo_der = $params['afp_flujo_der'];
    
    $arteria_femoral_superficial_der = $params['arteria_femoral_superficial_der'];
    $afs_obs_der = $params['afs_obs_der'];
    $afs_flujo_der = $params['afs_flujo_der'];
    
    $arteria_poplitea_der = $params['arteria_poplitea_der'];
    $ap_obs_der = $params['ap_obs_der'];
    $ap_flujo_der = $params['ap_flujo_der'];
    
    $arteria_tibial_anterior_der = $params['arteria_tibial_anterior_der'];
    $ata_obs_der = $params['ata_obs_der'];
    $ata_flujo_der = $params['ata_flujo_der'];
    
    $arteria_tibial_posterior_der = $params['arteria_tibial_posterior_der'];
    $atp_obs_der = $params['atp_obs_der'];
    $atp_flujo_der = $params['atp_flujo_der'];
    

    $arteria_fibular_peroneal_der = $params['arteria_fibular_peroneal_der'];
    $arfipe_obs_der = $params['arfipe_obs_der'];
    $arfipe_flujo_der = $params['arfipe_flujo_der'];


    $arteria_pedia_der = $params['arteria_pedia_der'];
    $arpe_obs_der = $params['arpe_obs_der'];
    $arpe_flujo_der = $params['arpe_flujo_der'];

    $conclusion_der = $params['conclusion_der'];


    $patient_fields = get_post_custom($patient_id);
    $name = $patient_fields['nombre'][0];
    $lastname = $patient_fields['apellido'][0];
    // $cedula = $patient_fields['cedula'][0];
    $fullname = $name.'-'.$lastname;
    $timeStamp = date("Y-m-d H:i:s"); 


      //crear el post colposcopia y actualizar. vincular el post con patient_id y con app_id
      $eco_arterial_post_data = array(
        'post_title'    => wp_strip_all_tags( $fullname." Consulta_ID= ".$app_id),
        'post_status'   => 'publish',
        'post_author'   => get_current_user_id(),
        'post_type' => 'sw_eco_arterial',
        //'meta_input' => ["related_patient", $patient_post ]
        //'post_category' => array( 8,39 )
      );

      // Insert the post into the database // returns post id on succes. 0 on fail
      
      $eco_arterial_post = wp_insert_post( $eco_arterial_post_data );
      if ($eco_arterial_post == 0) {
        wp_die( "Error creating a new eco arterial" );
      }

      $acf_fields = array(

        "arteria_femoral_comun" => $arteria_femoral_comun,
        "afc_obs" => $afc_obs,
        "afc_flujo" => $afc_flujo,

        "arteria_femoral_profunda" => $arteria_femoral_profunda,
        "afp_obs" => $afp_obs,
        "afp_flujo" => $afp_flujo,

        "arteria_femoral_superficial" => $arteria_femoral_superficial,
        "afs_obs" => $afs_obs,
        "afs_flujo" => $afs_flujo,

        "arteria_poplitea" => $arteria_poplitea,
        "ap_obs" => $ap_obs,
        "ap_flujo" => $ap_flujo,

        "arteria_tibial_anterior" => $arteria_tibial_anterior,
        "ata_obs" => $ata_obs,
        "ata_flujo" => $ata_flujo,

        "arteria_tibial_posterior" => $arteria_tibial_posterior,
        "atp_obs" => $atp_obs,
        "atp_flujo" => $atp_flujo,

        "arteria_fibular_peroneal" => $arteria_fibular_peroneal,
        "arfipe_obs" => $arfipe_obs,
        "arfipe_flujo" => $arfipe_flujo,

        "arteria_pedia" => $arteria_pedia,
        "arpe_obs" => $arpe_obs,
        "arpe_flujo" => $arpe_flujo,


        "conclusion" => $conclusion,

        //arterial der
        "arteria_femoral_comun_der" => $arteria_femoral_comun_der,
        "afc_obs_der" => $afc_obs_der,
        "afc_flujo_der" => $afc_flujo_der,

        "arteria_femoral_profunda_der" => $arteria_femoral_profunda_der,
        "afp_obs_der" => $afp_obs_der,
        "afp_flujo_der" => $afp_flujo_der,

        "arteria_femoral_superficial_der" => $arteria_femoral_superficial_der,
        "afs_obs_der" => $afs_obs_der,
        "afs_flujo_der" => $afs_flujo_der,

        "arteria_poplitea_der" => $arteria_poplitea_der,
        "ap_obs_der" => $ap_obs_der,
        "ap_flujo_der" => $ap_flujo_der,

        "arteria_tibial_anterior_der" => $arteria_tibial_anterior_der,
        "ata_obs_der" => $ata_obs_der,
        "ata_flujo_der" => $ata_flujo_der,

        "arteria_tibial_posterior_der" => $arteria_tibial_posterior_der,
        "atp_obs_der" => $atp_obs_der,
        "atp_flujo_der" => $atp_flujo_der,

        "arteria_fibular_peroneal_der" => $arteria_fibular_peroneal_der,
        "arfipe_obs_der" => $arfipe_obs_der,
        "arfipe_flujo_der" => $arfipe_flujo_der,

        "arteria_pedia_der" => $arteria_pedia_der,
        "arpe_obs_der" => $arpe_obs_der,
        "arpe_flujo_der" => $arpe_flujo_der,

        "conclusion_der" => $conclusion_der


        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $eco_arterial_post );
            }
        }
      //agregar al post colpo el id de la app y del paciente que le corresponde.
      add_post_meta( $eco_arterial_post, 'eco_arterial_related_patient', $patient_id );
      add_post_meta( $eco_arterial_post, 'eco_arterial_related_app', $app_id );


      //file upload test
      $i = 1;  
      $j = 1;  
      foreach ($_FILES as $file ) {

          $uploadedfile = $file;
          $movefile = wp_handle_upload($uploadedfile, array('action' => 'sw_create_eco_arterial_ajax'));

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
              
              $file_name = $file["name"]; 
              // $file_name = ""; 
              // if ($file_name == "azul.PNG") {
              if (preg_match("/xderx/i", $file_name)) {
              //if (false) {
                update_field('eco_arterial_imagen_der_'.$i, $attach_id, $eco_arterial_post);
                $i++;
              }else {
                update_field('eco_arterial_imagen_'.$j, $attach_id, $eco_arterial_post);
                $j++;
              }
              
              // error_log(json_encode($file), 0);
              // update_field('eco_arterial_imagen_der_'.$i, $attach_id, $eco_arterial_post);
              //update_field('colpo_imagen', $attach_id, $colpo_post);

              // $i++;
          }
      }


      //---------------------------------------
      $result['success'] = TRUE;
      $result['patient_id'] = $patient_id;
      $result['app_id'] = $app_id;
      $result['eco_arterial_id'] = $eco_arterial_post;
      $result['msg'] = 'Nueva Ecografia arterial creada';
      return $result;
    

    //else{$result['error'] = ["key"=> "user_not_created", "msg" => "Error creating the Account"];}

}//end of sw_create_eco arterial


function sw_update_eco_arterial($params){

  $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'', 'colpo_id'=>'','msg'=>'');    

  $patient_id  = $params["patient_id"];
  $app_id  = $params["app_id"];
  $eco_arterial_post_id  = $params['eco_arterial_post_id'];
 

  $patient_fields = get_post_custom($patient_id);
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  //$cedula = $patient_fields['cedula'][0];
  $fullname = $name.'-'.$lastname;


    //   lado izq
    $arteria_femoral_comun = $params['arteria_femoral_comun'];
    $afc_obs = $params['afc_obs'];
    $afc_flujo = $params['afc_flujo'];

    $arteria_femoral_profunda = $params['arteria_femoral_profunda'];
    $afp_obs = $params['afp_obs'];
    $afp_flujo = $params['afp_flujo'];
    
    $arteria_femoral_superficial = $params['arteria_femoral_superficial'];
    $afs_obs = $params['afs_obs'];
    $afs_flujo = $params['afs_flujo'];
    
    $arteria_poplitea = $params['arteria_poplitea'];
    $ap_obs = $params['ap_obs'];
    $ap_flujo = $params['ap_flujo'];
    
    $arteria_tibial_anterior = $params['arteria_tibial_anterior'];
    $ata_obs = $params['ata_obs'];
    $ata_flujo = $params['ata_flujo'];
    
    $arteria_tibial_posterior = $params['arteria_tibial_posterior'];
    $atp_obs = $params['atp_obs'];
    $atp_flujo = $params['atp_flujo'];
    
    
    $arteria_fibular_peroneal = $params['arteria_fibular_peroneal'];
    $arfipe_obs = $params['arfipe_obs'];
    $arfipe_flujo = $params['arfipe_flujo'];
    

    $arteria_pedia = $params['arteria_pedia'];
    $arpe_obs = $params['arpe_obs'];
    $arpe_flujo = $params['arpe_flujo'];

    
    $conclusion = $params['conclusion'];
  
  
    //miembro derecho
    $arteria_femoral_comun_der = $params['arteria_femoral_comun_der'];
    $afc_obs_der = $params['afc_obs_der'];
    $afc_flujo_der = $params['afc_flujo_der'];

    $arteria_femoral_profunda_der = $params['arteria_femoral_profunda_der'];
    $afp_obs_der = $params['afp_obs_der'];
    $afp_flujo_der = $params['afp_flujo_der'];

    $arteria_femoral_superficial_der = $params['arteria_femoral_superficial_der'];
    $afs_obs_der = $params['afs_obs_der'];
    $afs_flujo_der = $params['afs_flujo_der'];

    $arteria_poplitea_der = $params['arteria_poplitea_der'];
    $ap_obs_der = $params['ap_obs_der'];
    $ap_flujo_der = $params['ap_flujo_der'];

    $arteria_tibial_anterior_der = $params['arteria_tibial_anterior_der'];
    $ata_obs_der = $params['ata_obs_der'];
    $ata_flujo_der = $params['ata_flujo_der'];

    $arteria_tibial_posterior_der = $params['arteria_tibial_posterior_der'];
    $atp_obs_der = $params['atp_obs_der'];
    $atp_flujo_der = $params['atp_flujo_der'];


    $arteria_fibular_peroneal_der = $params['arteria_fibular_peroneal_der'];
    $arfipe_obs_der = $params['arfipe_obs_der'];
    $arfipe_flujo_der = $params['arfipe_flujo_der'];


    $arteria_pedia_der = $params['arteria_pedia_der'];
    $arpe_obs_der = $params['arpe_obs_der'];
    $arpe_flujo_der = $params['arpe_flujo_der'];

    $conclusion_der = $params['conclusion_der'];

  
  
      //update the colposcopy fields

      $acf_fields = array(

        "arteria_femoral_comun" => $arteria_femoral_comun,
        "afc_obs" => $afc_obs,
        "afc_flujo" => $afc_flujo,

        "arteria_femoral_profunda" => $arteria_femoral_profunda,
        "afp_obs" => $afp_obs,
        "afp_flujo" => $afp_flujo,

        "arteria_femoral_superficial" => $arteria_femoral_superficial,
        "afs_obs" => $afs_obs,
        "afs_flujo" => $afs_flujo,

        "arteria_poplitea" => $arteria_poplitea,
        "ap_obs" => $ap_obs,
        "ap_flujo" => $ap_flujo,

        "arteria_tibial_anterior" => $arteria_tibial_anterior,
        "ata_obs" => $ata_obs,
        "ata_flujo" => $ata_flujo,

        "arteria_tibial_posterior" => $arteria_tibial_posterior,
        "atp_obs" => $atp_obs,
        "atp_flujo" => $atp_flujo,

        "arteria_fibular_peroneal" => $arteria_fibular_peroneal,
        "arfipe_obs" => $arfipe_obs,
        "arfipe_flujo" => $arfipe_flujo,

        "arteria_pedia" => $arteria_pedia,
        "arpe_obs" => $arpe_obs,
        "arpe_flujo" => $arpe_flujo,


        "conclusion" => $conclusion,

        //arterial der
        "arteria_femoral_comun_der" => $arteria_femoral_comun_der,
        "afc_obs_der" => $afc_obs_der,
        "afc_flujo_der" => $afc_flujo_der,

        "arteria_femoral_profunda_der" => $arteria_femoral_profunda_der,
        "afp_obs_der" => $afp_obs_der,
        "afp_flujo_der" => $afp_flujo_der,

        "arteria_femoral_superficial_der" => $arteria_femoral_superficial_der,
        "afs_obs_der" => $afs_obs_der,
        "afs_flujo_der" => $afs_flujo_der,

        "arteria_poplitea_der" => $arteria_poplitea_der,
        "ap_obs_der" => $ap_obs_der,
        "ap_flujo_der" => $ap_flujo_der,

        "arteria_tibial_anterior_der" => $arteria_tibial_anterior_der,
        "ata_obs_der" => $ata_obs_der,
        "ata_flujo_der" => $ata_flujo_der,

        "arteria_tibial_posterior_der" => $arteria_tibial_posterior_der,
        "atp_obs_der" => $atp_obs_der,
        "atp_flujo_der" => $atp_flujo_der,

        "arteria_fibular_peroneal_der" => $arteria_fibular_peroneal_der,
        "arfipe_obs_der" => $arfipe_obs_der,
        "arfipe_flujo_der" => $arfipe_flujo_der,

        "arteria_pedia_der" => $arteria_pedia_der,
        "arpe_obs_der" => $arpe_obs_der,
        "arpe_flujo_der" => $arpe_flujo_der,

        "conclusion_der" => $conclusion_der

        
      );
      foreach ($acf_fields as $field => $value) {
        // if($value != NULL){
              update_post_meta( $eco_arterial_post_id, $field, $value );
        // }
      }

      //test: empty all image fields before update. but only if image files has been selected to replace the old ones.
      $update_eco_arterial_images = false;
      foreach ($_FILES as $file ) {
        if($file['name'] != "") {
          $update_eco_arterial_images = true;
          }
      }

      if ($update_eco_arterial_images) {         
        $image_fields = array(
            "eco_arterial_imagen_1" => "",         
            "eco_arterial_imagen_2" => "",         
            "eco_arterial_imagen_3" => "",         
            "eco_arterial_imagen_4" => "",         
            "eco_arterial_imagen_5" => ""         
        );
        foreach ($image_fields as $field => $value) {
          update_post_meta( $eco_arterial_post_id, $field, $value );
        }
      }
      //file upload test
      $i = 1;   
      $j = 1;   
      foreach ($_FILES as $file ) {

        $uploadedfile = $file;
        $movefile = wp_handle_upload($uploadedfile, array('action' => 'sw_create_eco_arterial_ajax'));

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


          $file_name = $file["name"]; 
          // $file_name = ""; 
          // if ($file_name == "azul.PNG") {
          if (preg_match("/xderx/i", $file_name)) {
          //if (false) {
            // update_field('eco_arterial_imagen_der_'.$i, $attach_id, $eco_arterial_post);
            update_post_meta( $eco_arterial_post_id, 'eco_arterial_imagen_der_'.$i, $attach_id );  
            $i++;
          }else {
            // update_field('eco_arterial_imagen_'.$j, $attach_id, $eco_arterial_post);
            update_post_meta( $eco_arterial_post_id, 'eco_arterial_imagen_'.$j, $attach_id );  
            $j++;
          }

          
          // update_post_meta( $eco_arterial_post_id, 'eco_arterial_imagen_'.$i, $attach_id );  

          // $i++;
        }
      }
      //end update colposcopy

      $result['success'] = TRUE;
      $result['msg'] = 'Ecografía arterial actualizada';
      $result['patient_id'] = $patient_id;
      $result['app_id'] = $app_id;
      $result['eco_arterial_id'] = $eco_arterial_post_id;

      
  return $result;
}



?>