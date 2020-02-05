<?php
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
    $motivo_de_consulta = isset($_POST['motivo_de_consulta']) && $_POST['motivo_de_consulta'] != '' ? $_POST['motivo_de_consulta'] : NULL;
    $antecedente_actual = isset($_POST['antecedente_actual']) && $_POST['antecedente_actual'] != '' ? $_POST['antecedente_actual'] : NULL;
    //agregar aca el mismo codigo que arriba pero para los valores del checkbox el cual deberia ser un array
    $checkbox_values = isset($_POST['checkbox_values']) && $_POST['checkbox_values'] != '' ? $_POST['checkbox_values'] : NULL;

    //private/static data
    $cesareas = isset($_POST['cesareas']) && $_POST['cesareas'] != '' ? $_POST['cesareas'] : NULL; 
    $menarca = isset($_POST['menarca']) && $_POST['menarca'] != '' ? $_POST['menarca'] : NULL;
    $irs = isset($_POST['irs']) && $_POST['irs'] != '' ? $_POST['irs'] : NULL; 
    $static_data_post_id = isset($_POST['static_data_post_id']) && $_POST['static_data_post_id'] != '' ? $_POST['static_data_post_id'] : NULL;
    $vacuna_vph = isset($_POST['vacuna_vph']) && $_POST['vacuna_vph'] != '' ? $_POST['vacuna_vph'] : NULL;    
    $edad_vph = isset($_POST['edad_vph']) && $_POST['edad_vph'] != '' ? $_POST['edad_vph'] : NULL;
    $ritmo_menstrual = isset($_POST['ritmo_menstrual']) && $_POST['ritmo_menstrual'] != '' ? $_POST['ritmo_menstrual'] : NULL;    
    $fum = isset($_POST['fum']) && $_POST['fum'] != '' ? $_POST['fum'] : NULL; 

    
    $numero_embarazos = isset($_POST['numero_embarazos']) && $_POST['numero_embarazos'] != '' ? $_POST['numero_embarazos'] : NULL; 
    $parto_normal = isset($_POST['parto_normal']) && $_POST['parto_normal'] != '' ? $_POST['parto_normal'] : NULL; 
    $abortos = isset($_POST['abortos']) && $_POST['abortos'] != '' ? $_POST['abortos'] : NULL; 
    $metodo_anticonceptivo = isset($_POST['metodo_anticonceptivo']) && $_POST['metodo_anticonceptivo'] != '' ? $_POST['metodo_anticonceptivo'] : NULL; 
    $marca_anticonceptivo = isset($_POST['marca_anticonceptivo']) && $_POST['marca_anticonceptivo'] != '' ? $_POST['marca_anticonceptivo'] : NULL; 
    $terapia_hormonal = isset($_POST['terapia_hormonal']) && $_POST['terapia_hormonal'] != '' ? $_POST['terapia_hormonal'] : NULL; 
    $pap_anterior = isset($_POST['pap_anterior']) && $_POST['pap_anterior'] != '' ? $_POST['pap_anterior'] : NULL; 

    $fecha_pap = isset($_POST['fecha_pap']) && $_POST['fecha_pap'] != '' ? $_POST['fecha_pap'] : NULL; 
    $fumador = isset($_POST['fumador']) && $_POST['fumador'] != '' ? $_POST['fumador'] : NULL; 
    $cigarrillos_por_dia = isset($_POST['cigarrillos_por_dia']) && $_POST['cigarrillos_por_dia'] != '' ? $_POST['cigarrillos_por_dia'] : NULL;
    
    $tratamientos_anteriores = isset($_POST['tratamientos_anteriores']) && $_POST['tratamientos_anteriores'] != '' ? $_POST['tratamientos_anteriores'] : NULL; 
    $fecha_de_tratamiento = isset($_POST['fecha_de_tratamiento']) && $_POST['fecha_de_tratamiento'] != '' ? $_POST['fecha_de_tratamiento'] : NULL; 
    $observaciones = isset($_POST['observaciones']) && $_POST['observaciones'] != '' ? $_POST['observaciones'] : NULL;
    
    //colposcopia data
    $colpo_post_id = isset($_POST['colpo_post_id']) && $_POST['colpo_post_id'] != '' ? $_POST['colpo_post_id'] : NULL;
    $macroscopia = isset($_POST['macroscopia']) && $_POST['macroscopia'] != '' ? $_POST['macroscopia'] : NULL;
    
    //wp_die(var_dump($_FILES));
    
    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    error_log(json_encode($_POST), 0);

    $params = array(
        "app_id" => $app_id,
        "patient_id" => $patient_id,
        "static_data_post_id" => $static_data_post_id,
        "colpo_post_id" => $colpo_post_id,
        "motivo_de_consulta" => $motivo_de_consulta,
        "antecedente_actual" => $antecedente_actual,
        "menarca" => $menarca,
        "irs" => $irs,
        "cesareas" => $cesareas,
        "macroscopia" => $macroscopia,
        "checkbox_values" => $checkbox_values,
        "vacuna_vph" => $vacuna_vph,
        "edad_vph" => $edad_vph,
        "ritmo_menstrual" => $ritmo_menstrual,
        "fum" => $fum,
        
        "numero_embarazos" => $numero_embarazos,
        "parto_normal" => $parto_normal,
        "abortos" => $abortos,
        "metodo_anticonceptivo" => $metodo_anticonceptivo,
        "marca_anticonceptivo" => $marca_anticonceptivo,
        "terapia_hormonal" => $terapia_hormonal,
        "pap_anterior" => $pap_anterior,

        "fecha_pap" => $fecha_pap,
        "fumador" => $fumador,
        "cigarrillos_por_dia" => $cigarrillos_por_dia,
        "tratamientos_anteriores" => $tratamientos_anteriores,
        "fecha_de_tratamiento" => $fecha_de_tratamiento,
        "observaciones" => $observaciones

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

    //private/static data
    $static_data_post_id  = $params["static_data_post_id"];
    $cesareas = $params['cesareas'];
    $menarca = $params['menarca'];
    $irs = $params['irs'];
    $vacuna_vph = $params['vacuna_vph'];
    $edad_vph = $params['edad_vph'];
    $ritmo_menstrual = $params['ritmo_menstrual'];
    $fum = $params['fum'];

    $numero_embarazos = $params['numero_embarazos'];
    $parto_normal = $params['parto_normal'];
    $abortos = $params['abortos'];
    $metodo_anticonceptivo = $params['metodo_anticonceptivo'];
    $marca_anticonceptivo = $params['marca_anticonceptivo'];
    $terapia_hormonal = $params['terapia_hormonal'];
    $pap_anterior = $params['pap_anterior'];    

    $fecha_pap = $params['fecha_pap'];    
    $fumador = $params['fumador'];    
    $cigarrillos_por_dia = $params['cigarrillos_por_dia'];    
    $tratamientos_anteriores = $params['tratamientos_anteriores'];    
    $fecha_de_tratamiento = $params['fecha_de_tratamiento'];    
    $observaciones = $params['observaciones'];    



    //common fields
    $motivo_de_consulta = $params['motivo_de_consulta'];
    $antecedente_actual = $params['antecedente_actual'];
    
    //colposcopia data
    $macroscopia = $params['macroscopia'];

    //$app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;

    //$name = get_field('nombre', $patient_id);
    //$lastname = get_field('apellido', $patient_id);
    //$cedula = get_field('cedula', $patient_id);
    
    $patient_fields = get_post_custom($patient_id);
    $name = $patient_fields['nombre'][0];
    $lastname = $patient_fields['apellido'][0];
    $cedula = $patient_fields['cedula'][0];
    $fullname = $name.'-'.$lastname;

    $timeStamp = date("Y-m-d H:i:s"); 

    //creamos el post type consulta, el que tiene motivo de consulta y antecedente actual.
    //static_data/AGO ya se crea al momento de crear el paciente
    if ($app_id === 'new' && $patient_id != NULL) {
      $my_post = array(
        'post_title'    => wp_strip_all_tags( $fullname."-".$timeStamp),
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
            "motivo_de_consulta" => $motivo_de_consulta,
            "antecedente_actual" => $antecedente_actual
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $app_post );
            }
        }
      add_post_meta( $app_post, 'related_patient', $patient_id );
      
      //update the private/static data
      //WARNING: the post type static_data is created when the patient is created
        $acf_fields = array(
            "cesareas" => $cesareas,
            "menarca" => $menarca,
            "irs" => $irs,
            "vacuna_vph" => $vacuna_vph,
            "edad_vph" => $edad_vph,
            "ritmo_menstrual" => $ritmo_menstrual,
            "fum" => $fum,

            "numero_embarazos" => $numero_embarazos,
            "parto_normal" => $parto_normal,
            "abortos" => $abortos,
            "metodo_anticonceptivo" => $metodo_anticonceptivo,
            "marca_anticonceptivo" => $marca_anticonceptivo,
            "terapia_hormonal" => $terapia_hormonal,
            "pap_anterior" => $pap_anterior,
 
            "fecha_pap" => $fecha_pap,
            "fumador" => $fumador,
            "cigarrillos_por_dia" => $cigarrillos_por_dia,
            "tratamientos_anteriores" => $tratamientos_anteriores,
            "fecha_de_tratamiento" => $fecha_de_tratamiento,
            "observaciones" => $observaciones

        );
        foreach ($acf_fields as $field => $value) {
            if($value != NULL)
                //var_dump("clave: ".$field." valor: ".$value)."<br>";
                //var_dump("app_id: ".$app_id)."<br>";
                //update_field( $field, $value, $app_id );
                update_post_meta( $static_data_post_id, $field, $value );
        }

      //create colpo only if all the fields are not empty
      if ($macroscopia != NULL /* && other_fields != NULL */) {
      //crear el post colposcopia y actualizar. vincular el post con patient_id y con app_id
      $colpo_post_data = array(
        'post_title'    => wp_strip_all_tags( $fullname." App ID: ".$app_post),
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
            "macroscopia" => $macroscopia
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $colpo_post );
            }
        }
      //agregar al post colpo el id de la app y del paciente que le corresponde.
      add_post_meta( $colpo_post, 'colpo_related_patient', $patient_id );
      add_post_meta( $colpo_post, 'colpo_related_app', $app_post );
      }//if colpo fields are not empty


      //file upload test
      $i = 1;  
      foreach ($_FILES as $file ) {

          $uploadedfile = $file;
          $movefile = wp_handle_upload($uploadedfile, array('action' => 'sw_create_appointment_ajax'));

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
      $result['app_id'] = $app_post;
      $result['msg'] = 'Nueva consulta creada';
      return $result;
    }//if new patient = true

    //else{$result['error'] = ["key"=> "user_not_created", "msg" => "Error creating the Account"];}

}//end of sw_create_appointment


function sw_update_single_appointment($params){

    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'', 'app_id'=>'','msg'=>'');
    
    $app_id  = $params["app_id"];
    $patient_id  = $params["patient_id"];
   
    $patient_fields = get_post_custom($patient_id);
    $name = $patient_fields['nombre'][0];
    $lastname = $patient_fields['apellido'][0];
    //$cedula = $patient_fields['cedula'][0];
    $fullname = $name.'-'.$lastname;

    //common fields 
    $motivo_de_consulta = $params['motivo_de_consulta'];
    $antecedente_actual = $params['antecedente_actual'];
    $checkbox_values = $params['checkbox_values'];
    
    //private/static data
    $static_data_post_id  = $params["static_data_post_id"];
    $cesareas = $params['cesareas'];
    $menarca = $params['menarca'];
    $irs = $params['irs'];
    $vacuna_vph = $params['vacuna_vph'];
    $edad_vph = $params['edad_vph'];
    $ritmo_menstrual = $params['ritmo_menstrual'];
    $fum = $params['fum'];
    
    $numero_embarazos = $params['numero_embarazos'];
    $parto_normal = $params['parto_normal'];
    $abortos = $params['abortos'];
    $metodo_anticonceptivo = $params['metodo_anticonceptivo'];
    $marca_anticonceptivo = $params['marca_anticonceptivo'];
    $terapia_hormonal = $params['terapia_hormonal'];
    $pap_anterior = $params['pap_anterior'];  
    
    $fecha_pap = $params['fecha_pap'];    
    $fumador = $params['fumador'];    
    $cigarrillos_por_dia = $params['cigarrillos_por_dia'];   
    $tratamientos_anteriores = $params['tratamientos_anteriores'];    
    $fecha_de_tratamiento = $params['fecha_de_tratamiento'];   
    $observaciones = $params['observaciones'];  

    //colposcopia data
    $colpo_post_id  = $params["colpo_post_id"];
    $macroscopia = $params['macroscopia'];

    if ($app_id != NULL && $app_id != '') {

        //update the private/static data
        $acf_fields = array(
            "cesareas" => $cesareas,
            "menarca" => $menarca,
            "irs" => $irs,
            "vacuna_vph" => $vacuna_vph,
            "edad_vph" => $edad_vph,
            "ritmo_menstrual" => $ritmo_menstrual,
            "fum" => $fum,
            
            "numero_embarazos" => $numero_embarazos,
            "parto_normal" => $parto_normal,
            "abortos" => $abortos,
            "metodo_anticonceptivo" => $metodo_anticonceptivo,
            "marca_anticonceptivo" => $marca_anticonceptivo,
            "terapia_hormonal" => $terapia_hormonal,
            "pap_anterior" => $pap_anterior,

            "fecha_pap" => $fecha_pap,
            "fumador" => $fumador,
            "cigarrillos_por_dia" => $cigarrillos_por_dia,
            "tratamientos_anteriores" => $tratamientos_anteriores,
            "fecha_de_tratamiento" => $fecha_de_tratamiento,
            "observaciones" => $observaciones

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
            "motivo_de_consulta" => $motivo_de_consulta,           
            "antecedente_actual" => $antecedente_actual           
        );
        foreach ($acf_fields as $field => $value) {
            if($value != NULL)
                //var_dump("clave: ".$field." valor: ".$value)."<br>";
                //var_dump("app_id: ".$app_id)."<br>";
                //update_field( $field, $value, $app_id );
                update_post_meta( $app_id, $field, $value );
        }
        //update_field('checkbox', array("blue"), $appointment_post_id);
        update_field('checkbox', $checkbox_values, $app_id);
        
        //update the colposcopy fields
        
        //but if the id is null we have to create a new colpo bc
        //there was no previous colpo for this app_id
        if ($colpo_post_id === NULL) {
              $colpo_post_data = array(
              'post_title'    => wp_strip_all_tags( $fullname." App ID: ".$app_id),
              'post_status'   => 'publish',
              'post_author'   => get_current_user_id(),
              'post_type' => 'sw_colposcopia'
            );

          // Insert the post into the database // returns post id on succes. 0 on fail
          $colpo_post_id = wp_insert_post( $colpo_post_data );
          if ($colpo_post_id == 0) {
            wp_die( "Error creating a new Colposcopia" );
          }
          //agregar al post colpo el id de la app y del paciente que le corresponde.
          add_post_meta( $colpo_post_id, 'colpo_related_patient', $patient_id );
          add_post_meta( $colpo_post_id, 'colpo_related_app', $app_id );
        }//if colpo_post_id === NULL
        
        $acf_fields = array(
            "macroscopia" => $macroscopia         
        );
        foreach ($acf_fields as $field => $value) {
            if($value != NULL)
                //var_dump("clave: ".$field." valor: ".$value)."<br>";
                //var_dump("app_id: ".$app_id)."<br>";
                //update_field( $field, $value, $app_id );
                update_post_meta( $colpo_post_id, $field, $value );
        }

        //test: empty all image fields before update
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

        //file upload test
        $i = 1;   
        foreach ($_FILES as $file ) {

          $uploadedfile = $file;
          $movefile = wp_handle_upload($uploadedfile, array('action' => 'sw_create_appointment_ajax'));

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
?>