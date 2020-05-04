<?php
/*
********************************************************************************
*
      Create New Appointment / Edit Appointment
*
********************************************************************************
*/
  function sw_create_colpo_ajax(){

    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'','msg'=>'');
  
    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    $colpo_post_id = isset($_POST['colpo_post_id']) && $_POST['colpo_post_id'] != '' ? $_POST['colpo_post_id'] : NULL;

    //colposcopia data    
    $macroscopia = isset($_POST['macroscopia']) && $_POST['macroscopia'] != '' ? $_POST['macroscopia'] : NULL;
    $colposcopia = isset($_POST['colposcopia']) && $_POST['colposcopia'] != '' ? $_POST['colposcopia'] : NULL;
    $evaluacion_general = isset($_POST['evaluacion_general']) && $_POST['evaluacion_general'] != '' ? $_POST['evaluacion_general'] : NULL;
   
    $motivo_inadecuada = isset($_POST['motivo_inadecuada']) && $_POST['motivo_inadecuada'] != '' ? $_POST['motivo_inadecuada'] : NULL;
    $union_escamo_columnar = isset($_POST['union_escamo_columnar']) && $_POST['union_escamo_columnar'] != '' ? $_POST['union_escamo_columnar'] : NULL;
    $zona_de_transformacion = isset($_POST['zona_de_transformacion']) && $_POST['zona_de_transformacion'] != '' ? $_POST['zona_de_transformacion'] : NULL;
    $colposcopicos_normales = isset($_POST['colposcopicos_normales']) && $_POST['colposcopicos_normales'] != '' ? $_POST['colposcopicos_normales'] : NULL;
    $colposcopicos_anormales_grado_1 = isset($_POST['colposcopicos_anormales_grado_1']) && $_POST['colposcopicos_anormales_grado_1'] != '' ? $_POST['colposcopicos_anormales_grado_1'] : NULL;
    $colposcopicos_anormales_grado_2 = isset($_POST['colposcopicos_anormales_grado_2']) && $_POST['colposcopicos_anormales_grado_2'] != '' ? $_POST['colposcopicos_anormales_grado_2'] : NULL;
    

    $colposcopicos_anormales_no_especificos = isset($_POST['colposcopicos_anormales_no_especificos']) && $_POST['colposcopicos_anormales_no_especificos'] != '' ? $_POST['colposcopicos_anormales_no_especificos'] : NULL;
    $colposcopicos_anormales_ubicacion = isset($_POST['colposcopicos_anormales_ubicacion']) && $_POST['colposcopicos_anormales_ubicacion'] != '' ? $_POST['colposcopicos_anormales_ubicacion'] : NULL;
    $sospecha_de_invasion = isset($_POST['sospecha_de_invasion']) && $_POST['sospecha_de_invasion'] != '' ? $_POST['sospecha_de_invasion'] : NULL;
    $hallazgos_varios = isset($_POST['hallazgos_varios']) && $_POST['hallazgos_varios'] != '' ? $_POST['hallazgos_varios'] : NULL;
    $examen_de_vyv = isset($_POST['examen_de_vyv']) && $_POST['examen_de_vyv'] != '' ? $_POST['examen_de_vyv'] : NULL;
    $examen_de_vyv_descripcion = isset($_POST['examen_de_vyv_descripcion']) && $_POST['examen_de_vyv_descripcion'] != '' ? $_POST['examen_de_vyv_descripcion'] : NULL;
    $colposcopicos_anormales_test_de_schiller = isset($_POST['colposcopicos_anormales_test_de_schiller']) && $_POST['colposcopicos_anormales_test_de_schiller'] != '' ? $_POST['colposcopicos_anormales_test_de_schiller'] : NULL;
    $test_de_schiller_lugol = isset($_POST['test_de_schiller_lugol']) && $_POST['test_de_schiller_lugol'] != '' ? $_POST['test_de_schiller_lugol'] : NULL;
    $sugerencias = isset($_POST['sugerencias']) && $_POST['sugerencias'] != '' ? $_POST['sugerencias'] : NULL;
    //wp_die(var_dump($_FILES));

    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    // error_log(json_encode($_POST), 0);

    $params = array(
        "app_id" => $app_id,
        "patient_id" => $patient_id,
        "colpo_post_id" => $colpo_post_id,
        
        //colposcopia
        "macroscopia" => $macroscopia,
        "colposcopia" => $colposcopia,
        "evaluacion_general" => $evaluacion_general,
        "motivo_inadecuada" => $motivo_inadecuada,
        "union_escamo_columnar" => $union_escamo_columnar,
        "zona_de_transformacion" => $zona_de_transformacion,
        "colposcopicos_normales" => $colposcopicos_normales,
        "colposcopicos_anormales_grado_1" => $colposcopicos_anormales_grado_1,
        "colposcopicos_anormales_grado_2" => $colposcopicos_anormales_grado_2,
        "colposcopicos_anormales_no_especificos" => $colposcopicos_anormales_no_especificos,
        "colposcopicos_anormales_ubicacion" => $colposcopicos_anormales_ubicacion,
        "sospecha_de_invasion" => $sospecha_de_invasion,
        "hallazgos_varios" => $hallazgos_varios,
        "examen_de_vyv" => $examen_de_vyv,
        "examen_de_vyv_descripcion" => $examen_de_vyv_descripcion,
        "colposcopicos_anormales_test_de_schiller" => $colposcopicos_anormales_test_de_schiller,
        "test_de_schiller_lugol" => $test_de_schiller_lugol,
        "sugerencias" => $sugerencias

    );

    //wp_die(var_dump($params));

    // NULL significa que es una nueva colpo, ya que no existe una asociada a esta consulta (app)
    if($colpo_post_id === NULL){
      $result = sw_create_new_colpo($params);
    }
    //elseif ($app_id != NULL && $app_id != '') {
    else{
      $result = sw_update_single_colpo($params);
    }

    wp_die(json_encode($result));
  }

//wp_ajax_nopriv_
add_action( 'wp_ajax_sw_create_colpo_ajax', 'sw_create_colpo_ajax');

function sw_create_new_colpo($params){

    //global $post;
    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'', 'colpo_id'=>'','msg'=>'');

    $patient_id = $params['patient_id'];
    $app_id  = $params['app_id'];

 
    //colposcopia data
    $macroscopia = $params['macroscopia'];
    $colposcopia = $params['colposcopia'];
    $evaluacion_general = $params['evaluacion_general'];
    $motivo_inadecuada = $params['motivo_inadecuada'];
    $union_escamo_columnar = $params['union_escamo_columnar'];
    $zona_de_transformacion = $params['zona_de_transformacion'];
    $colposcopicos_normales = $params['colposcopicos_normales'];
    $colposcopicos_anormales_grado_1 = $params['colposcopicos_anormales_grado_1'];
    $colposcopicos_anormales_grado_2 = $params['colposcopicos_anormales_grado_2'];
    $colposcopicos_anormales_no_especificos = $params['colposcopicos_anormales_no_especificos'];
    $colposcopicos_anormales_ubicacion = $params['colposcopicos_anormales_ubicacion'];
    $examen_de_vyv_descripcion = $params['examen_de_vyv_descripcion'];
    $sospecha_de_invasion = $params['sospecha_de_invasion'];
    $hallazgos_varios = $params['hallazgos_varios'];
    $examen_de_vyv = $params['examen_de_vyv'];    
    $colposcopicos_anormales_test_de_schiller = $params['colposcopicos_anormales_test_de_schiller'];
    $test_de_schiller_lugol = $params['test_de_schiller_lugol'];
    $sugerencias = $params['sugerencias'];

    
    $patient_fields = get_post_custom($patient_id);
    $name = $patient_fields['nombre'][0];
    $lastname = $patient_fields['apellido'][0];
    // $cedula = $patient_fields['cedula'][0];
    $fullname = $name.'-'.$lastname;
    $timeStamp = date("Y-m-d H:i:s"); 


      //crear el post colposcopia y actualizar. vincular el post con patient_id y con app_id
      $colpo_post_data = array(
        'post_title'    => wp_strip_all_tags( $fullname." Consulta_ID= ".$app_id),
        'post_status'   => 'publish',
        'post_author'   => get_current_user_id(),
        'post_type' => 'sw_colposcopia',
        //'meta_input' => ["related_patient", $patient_post ]
        //'post_category' => array( 8,39 )
      );

      // Insert the post into the database // returns post id on succes. 0 on fail
      
      $colpo_post = wp_insert_post( $colpo_post_data );
      if ($colpo_post == 0) {
        wp_die( "Error creating a new Colposcopia" );
      }

      $acf_fields = array(
            "macroscopia" => $macroscopia,
            "colposcopia" => $colposcopia,
            "evaluacion_general" => $evaluacion_general,
            "motivo_inadecuada" => $motivo_inadecuada,
            "union_escamo_columnar" => $union_escamo_columnar,
            "zona_de_transformacion" => $zona_de_transformacion,
            "colposcopicos_normales" => $colposcopicos_normales,
            "colposcopicos_anormales_grado_1" => $colposcopicos_anormales_grado_1,
            "colposcopicos_anormales_grado_2" => $colposcopicos_anormales_grado_2,
            "colposcopicos_anormales_no_especificos" => $colposcopicos_anormales_no_especificos,
            "colposcopicos_anormales_test_de_schiller" => $colposcopicos_anormales_test_de_schiller,
            "colposcopicos_anormales_ubicacion" => $colposcopicos_anormales_ubicacion,
            "sospecha_de_invasion" => $sospecha_de_invasion,
            "hallazgos_varios" => $hallazgos_varios,
            "examen_de_vyv" => $examen_de_vyv,
            "examen_de_vyv_descripcion" => $examen_de_vyv_descripcion,
            "test_de_schiller_lugol" => $test_de_schiller_lugol,
            "sugerencias" => $sugerencias

        // test_de_schiller_lugol
        // sugerencias
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $colpo_post );
            }
        }
      //agregar al post colpo el id de la app y del paciente que le corresponde.
      add_post_meta( $colpo_post, 'colpo_related_patient', $patient_id );
      add_post_meta( $colpo_post, 'colpo_related_app', $app_id );


      //file upload test
      $i = 1;  
      foreach ($_FILES as $file ) {

          $uploadedfile = $file;
          $movefile = wp_handle_upload($uploadedfile, array('action' => 'sw_create_colpo_ajax'));

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

              update_field('colpo_imagen_'.$i, $attach_id, $colpo_post);
              //update_field('colpo_imagen', $attach_id, $colpo_post);
              $i++;
          }
      }


      //---------------------------------------
      $result['success'] = TRUE;
      $result['patient_id'] = $patient_id;
      $result['app_id'] = $app_id;
      $result['colpo_id'] = $colpo_post;
      $result['msg'] = 'Nueva colposcopía creada';
      return $result;
    

    //else{$result['error'] = ["key"=> "user_not_created", "msg" => "Error creating the Account"];}

}//end of sw_create_appointment


function sw_update_single_colpo($params){

    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'', 'colpo_id'=>'','msg'=>'');    

    $patient_id  = $params["patient_id"];
    $app_id  = $params["app_id"];
    $colpo_post_id  = $params['colpo_post_id'];
   

    $patient_fields = get_post_custom($patient_id);
    $name = $patient_fields['nombre'][0];
    $lastname = $patient_fields['apellido'][0];
    //$cedula = $patient_fields['cedula'][0];
    $fullname = $name.'-'.$lastname;

    //colposcopia data
    // $colpo_post_id = $params['colpo_post_id'];
    $macroscopia = $params['macroscopia'];
    $colposcopia = $params['colposcopia'];
    $evaluacion_general = $params['evaluacion_general'];
    $motivo_inadecuada = $params['motivo_inadecuada'];
    $union_escamo_columnar = $params['union_escamo_columnar'];
    $zona_de_transformacion = $params['zona_de_transformacion'];
    $colposcopicos_normales = $params['colposcopicos_normales'];
    $colposcopicos_anormales_grado_1 = $params['colposcopicos_anormales_grado_1'];
    $colposcopicos_anormales_grado_2 = $params['colposcopicos_anormales_grado_2'];
    $colposcopicos_anormales_no_especificos = $params['colposcopicos_anormales_no_especificos'];
    $colposcopicos_anormales_test_de_schiller = $params['colposcopicos_anormales_test_de_schiller'];
    $colposcopicos_anormales_ubicacion = $params['colposcopicos_anormales_ubicacion'];
    $examen_de_vyv_descripcion = $params['examen_de_vyv_descripcion'];
    $sospecha_de_invasion = $params['sospecha_de_invasion'];
    $hallazgos_varios = $params['hallazgos_varios'];
    $examen_de_vyv = $params['examen_de_vyv'];
    $test_de_schiller_lugol = $params['test_de_schiller_lugol'];
    $sugerencias = $params['sugerencias'];

    
        //update the colposcopy fields

        $acf_fields = array(
          "macroscopia" => $macroscopia,
          "colposcopia" => $colposcopia,
          "evaluacion_general" => $evaluacion_general,
          "motivo_inadecuada" => $motivo_inadecuada,
          "union_escamo_columnar" => $union_escamo_columnar,
          "zona_de_transformacion" => $zona_de_transformacion,
          "colposcopicos_normales" => $colposcopicos_normales,
          "colposcopicos_anormales_grado_1" => $colposcopicos_anormales_grado_1,
          "colposcopicos_anormales_grado_2" => $colposcopicos_anormales_grado_2,
          "colposcopicos_anormales_no_especificos" => $colposcopicos_anormales_no_especificos,
          "colposcopicos_anormales_test_de_schiller" => $colposcopicos_anormales_test_de_schiller,
          "colposcopicos_anormales_ubicacion" => $colposcopicos_anormales_ubicacion,
          "sospecha_de_invasion" => $sospecha_de_invasion,
          "hallazgos_varios" => $hallazgos_varios,
          "examen_de_vyv" => $examen_de_vyv,
          "examen_de_vyv_descripcion" => $examen_de_vyv_descripcion,
          "test_de_schiller_lugol" => $test_de_schiller_lugol,
          "sugerencias" => $sugerencias      
        );
        foreach ($acf_fields as $field => $value) {
            if($value != NULL)

                update_post_meta( $colpo_post_id, $field, $value );
        }

        //test: empty all image fields before update. but only if image files has been selected to replace the old ones.
        $update_colpo_images = false;
        foreach ($_FILES as $file ) {
          if($file['name'] != "") {
            $update_colpo_images = true;
            }
        }

        if ($update_colpo_images) {         
          $image_fields = array(
              "colpo_imagen_1" => "",         
              "colpo_imagen_2" => "",         
              "colpo_imagen_3" => "",         
              "colpo_imagen_4" => "",         
              "colpo_imagen_5" => ""         
          );
          foreach ($image_fields as $field => $value) {
            update_post_meta( $colpo_post_id, $field, $value );
          }
        }
        //file upload test
        $i = 1;   
        foreach ($_FILES as $file ) {

          $uploadedfile = $file;
          $movefile = wp_handle_upload($uploadedfile, array('action' => 'sw_create_colpo_ajax'));

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
            
            //update_post_meta( $colpo_post_id, 'colpo_imagen', $attach_id );  
            update_post_meta( $colpo_post_id, 'colpo_imagen_'.$i, $attach_id );  
            //update_field('colpo_imagen', $attach_id, $colpo_post_id);
            $i++;
          }
        }
        //end update colposcopy

        $result['success'] = TRUE;
        $result['msg'] = 'Colposcopía actualizada';
        $result['patient_id'] = $patient_id;
        $result['app_id'] = $app_id;
        $result['colpo_id'] = $colpo_post_id;

        
    return $result;
}

//get all the related appointments of a given patient
function sw_get_related_appointmentsXXX($patient_id){

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
?>