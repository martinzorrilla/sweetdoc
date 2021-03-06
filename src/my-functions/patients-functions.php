<?php  

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
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    
    $patient_name = isset($_POST['patient_name']) && $_POST['patient_name'] != '' ? $_POST['patient_name'] : NULL;
    $patient_last_name = isset($_POST['patient_last_name']) && $_POST['patient_last_name'] != '' ? $_POST['patient_last_name'] : NULL;
    $patient_ci = isset($_POST['patient_ci']) && $_POST['patient_ci'] != '' ? $_POST['patient_ci'] : NULL;
    $email = isset($_POST['email_paciente']) && $_POST['email_paciente'] != '' ? $_POST['email_paciente'] : NULL;
    $fecha_de_nacimiento = isset($_POST['fecha_de_nacimiento']) && $_POST['fecha_de_nacimiento'] != '' ? $_POST['fecha_de_nacimiento'] : NULL;
    $departamento = isset($_POST['departamento']) && $_POST['departamento'] != '' ? $_POST['departamento'] : NULL;
    $ciudad = isset($_POST['ciudad']) && $_POST['ciudad'] != '' ? $_POST['ciudad'] : NULL;
    $direccion = isset($_POST['direccion']) && $_POST['direccion'] != '' ? $_POST['direccion'] : NULL;
    $metodo_anticonceptivo = isset($_POST['metodo_anticonceptivo']) && $_POST['metodo_anticonceptivo'] != '' ? $_POST['metodo_anticonceptivo'] : NULL;
    $telefono = isset($_POST['telefono']) && $_POST['telefono'] != '' ? $_POST['telefono'] : NULL;
    $celular = isset($_POST['celular']) && $_POST['celular'] != '' ? $_POST['celular'] : NULL;
    $establecimiento = isset($_POST['establecimiento']) && $_POST['establecimiento'] != '' ? $_POST['establecimiento'] : NULL;
    $seguro_medico = isset($_POST['seguro_medico']) && $_POST['seguro_medico'] != '' ? $_POST['seguro_medico'] : NULL;
    $region_sanitaria = isset($_POST['region_sanitaria']) && $_POST['region_sanitaria'] != '' ? $_POST['region_sanitaria'] : NULL;
    $epitelio_escamoso = isset($_POST['epitelio_escamoso']) && $_POST['epitelio_escamoso'] != '' ? $_POST['epitelio_escamoso'] : NULL;


    
    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
     //error_log(json_encode($_POST), 0);


    // Sanitizes a username, stripping out unsafe characters.
    $patient_name= sanitize_user($patient_name);
    // Convert all characters to lowercase
    $patient_name= strtolower($patient_name);
    // Capitalize every word in the sring
    $patient_name= ucwords($patient_name);
    // Sanitizes a username, stripping out unsafe characters.
    $patient_last_name= sanitize_user($patient_last_name);
    // Capitalize every word in the sring
    $patient_last_name= strtolower($patient_last_name);
    // Capitalize every word in the sring
    $patient_last_name= ucwords($patient_last_name);


    $seguro_medico= sanitize_user($seguro_medico);
    // Convert all characters to lowercase
    $seguro_medico= strtolower($seguro_medico);
    // Capitalize every word in the sring
    $seguro_medico= ucwords($seguro_medico);

    $params = array(
        "patient_id" => $patient_id,
        "patient_name" => $patient_name,
        "patient_last_name" => $patient_last_name,
        "patient_ci" => $patient_ci,
        "email" => $email,
        "fecha_de_nacimiento" => $fecha_de_nacimiento,
        "departamento" => $departamento,
        "ciudad" => $ciudad,
        "direccion" => $direccion,
        "metodo_anticonceptivo" => $metodo_anticonceptivo,
        "telefono" => $telefono,
        "celular" => $celular,
        "establecimiento" => $establecimiento,
        "seguro_medico" => $seguro_medico,
        "region_sanitaria" => $region_sanitaria,
        "epitelio_escamoso" => $epitelio_escamoso
        
    );

    //call validate_patient()
    //before creating or updating a patient we should validate the data (ie Cedula doesnt exist)
    $validate_result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    // $validate_result['error'][0] == false;

    $validate_result = validate_patient($params);
    if ( $validate_result['error'][0] == true ){
      $result = $validate_result; 
      //wp_die(json_encode($result));
      //echo "error al crear el paciente. ya existe el numero de cedula"
    }
    else{
      if($patient_id === 'new'){
        $result = sw_create_patient($params);
      }else{
        $result = sw_update_patient($params);
      }
    }

    wp_die(json_encode($result));
}

add_action( 'wp_ajax_sw_create_patient_ajax', 'sw_create_patient_ajax');

//crea un paciente nuevo y tbm crea el post del tipo static-data-ago que le corresponde al paciente nuevo
function sw_create_patient($params){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $static_values = [];

      $patient_name = $params['patient_name'];
      $patient_last_name = $params['patient_last_name'];
      $patient_ci = $params['patient_ci'];
      $email = $params['email'];
      $fecha_de_nacimiento = $params['fecha_de_nacimiento'];
      $departamento = $params['departamento'];
      $ciudad = $params['ciudad'];
      $direccion = $params['direccion'];
      $metodo_anticonceptivo = $params['metodo_anticonceptivo'];
      $telefono = $params['telefono'];
      $celular = $params['celular'];
      $establecimiento = $params['establecimiento'];
      $seguro_medico = $params['seguro_medico'];
      $region_sanitaria = $params['region_sanitaria'];
      $epitelio_escamoso = $params['epitelio_escamoso'];

      
      //$metodo_anticonceptivo = array("inyectable", "preservativos");
      //wp_die(var_dump($metodo_anticonceptivo));

      // $post_author = $params['post_author'];
      //sw_get_patient_owner: devuelve el id del doctor directamente, o si el rol del usuario actual es secretaty 
      //devuelve el id del doctor que le corresponde 
      $patient_owner = sw_get_patient_owner();

      $username= $patient_name.' '.$patient_last_name;
      // capitalizar cada palabra del string antes de guardar en la BD
      $username= ucwords($username);

      $my_post = array(
        'ID'   => 0,
        // 'post_title'    => wp_strip_all_tags( $patient_name.' '. $patient_last_name ),
        'post_title'    => $username,
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
        wp_die( "Error creating a new Patient. Patients-functions" );
      }

      $acf_fields = array(
            "nombre" => $patient_name,
            "apellido" => $patient_last_name,
            "cedula" => $patient_ci,
            "email_paciente" => $email,
            "fecha_de_nacimiento" => $fecha_de_nacimiento,
            "departamento" => $departamento,
            "ciudad" => $ciudad,
            "direccion" => $direccion,
            "metodo_anticonceptivo" => $metodo_anticonceptivo,
            "telefono" => $telefono,
            "celular" => $celular,
            "establecimiento" => $establecimiento,
            "seguro_medico" => $seguro_medico,
            "region_sanitaria" => $region_sanitaria,
            "epitelio_escamoso" => $epitelio_escamoso
            
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $post_id );
            }
        }


      //create the patient static data post type
      //send param array with name , lastname and $post_id wich is the receently created patient
      $static_values = ['patient_name'=>$patient_name,
                        'static_data_id'=> 0,
                        'patient_last_name'=>$patient_last_name, 
                        'patient_id'=>$post_id
                       ];

      $static_data = sw_create_static_data($static_values);

      $result['success'] = TRUE;
      // $result['msg'] = 'Nuevo Paciente creado';
      // $result['msg'] = $patient_name.'-'. $patient_last_name;
      $result['msg'] = get_permalink( $post_id );
      return $result;
}

//actualiza un paciente que ya existe y tbm actualiza el nombre del post del tipo static-data-ago que le corresponde
function sw_update_patient($params){

  $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
  $static_values = [];

    $patient_id = $params['patient_id'];
    $patient_name = $params['patient_name'];
    $patient_last_name = $params['patient_last_name'];
    $patient_ci = $params['patient_ci'];
    $email = $params['email'];
    $fecha_de_nacimiento = $params['fecha_de_nacimiento'];
    $departamento = $params['departamento'];
    $ciudad = $params['ciudad'];
    $direccion = $params['direccion'];
    $metodo_anticonceptivo = $params['metodo_anticonceptivo'];
    $telefono = $params['telefono'];
    $celular = $params['celular'];
    $establecimiento = $params['establecimiento'];
    $seguro_medico = $params['seguro_medico'];
    $region_sanitaria = $params['region_sanitaria'];
    $epitelio_escamoso = $params['epitelio_escamoso'];
    
    // $post_author = $params['post_author'];
    //sw_get_patient_owner: devuelve el id del doctor directamente, o si el rol del usuario actual es secretaty 
    //devuelve el id del doctor que le corresponde 
    $patient_owner = sw_get_patient_owner();

    $username= $patient_name.' '.$patient_last_name;
    // capitalizar cada palabra del string antes de guardar en la BD
    $username= ucwords($username);

    $my_post = array(
      'ID'   => $patient_id,
      'post_title'    => $username,
      'post_status'   => 'publish',
      //'post_author'   => get_current_user_id(),
      'post_author'   => $patient_owner,
      'post_type' => 'sw_patient'
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
          "cedula" => $patient_ci,
          "email_paciente" => $email,
          "fecha_de_nacimiento" => $fecha_de_nacimiento,
          "departamento" => $departamento,
          "ciudad" => $ciudad,
          "direccion" => $direccion,
          "metodo_anticonceptivo" => $metodo_anticonceptivo,
          "telefono" => $telefono,
          "celular" => $celular,
          "establecimiento" => $establecimiento,
          "seguro_medico" => $seguro_medico,
          "region_sanitaria" => $region_sanitaria,
          "epitelio_escamoso" => $epitelio_escamoso
      );
      
      foreach ($acf_fields as $field => $value) {
          if($value != NULL){
              update_field( $field, $value, $patient_id );
          }
      }


    // returns an array containing the ID of the static data post related to this patient id.
    $the_query = sw_get_patient_static_data_ago($patient_id);
    $patient_ago_id =  $the_query[0];      

    //create the patient static data post type
    //send param array with name , lastname and $post_id wich is the receently created patient
     $static_values = ['patient_name'=>$patient_name,
                       'static_data_id'=>$patient_ago_id, 
                       'patient_last_name'=>$patient_last_name, 
                       'patient_id'=>$patient_id
                      ];

     $static_data = sw_create_static_data($static_values);

    $result['success'] = TRUE;
    // $result['msg'] = 'Datos del paciente actualizados';
    // $result['msg'] = $patient_name.'-'. $patient_last_name;
    $result['msg'] = get_permalink( $post_id );

    return $result;
}



// recibe el id del paciente y retorna el post tipo static_data-Ago asociado a el
//retorna una array  
function sw_get_patient_static_data_ago($patient_id){
    
  $myquery = new WP_Query(  
    array( 
      'id' => $patient_id,
      'post_type'  => 'sw_static_data',
      'meta_query' => array(
        array(
          'key'     => 'patients_static_data',
          'value'   => array($patient_id),
          'compare' => 'IN',
        ),
      ),
    )
  );

  //returns a fucking array
  $related =  wp_list_pluck( $myquery->posts, 'ID' );
  wp_reset_postdata(); //always reset the post data!
  
  //if want to return an array of id's
  return $related;
  //if want to return the query object
  //return $myquery;
}


//Create post type static data and relate it to the created patient
function sw_create_static_data($params){

    $result = array('error'=>[], 'success'=>FALSE, 'patient_id'=>'','msg'=>'');

    $patient_name = $params['patient_name'];
    $patient_last_name = $params['patient_last_name'];
    $patient_id = $params['patient_id'];
    //if static_data_id == 0, it will create a new post, else it will update the post with the id passed to it
    $static_data_id = $params['static_data_id'];

    $fullname = $patient_name.' '.$patient_last_name;

      $my_post = array(
        'ID'   => $static_data_id,
        'post_title'    => wp_strip_all_tags( $fullname.' - Owner ID: '.$patient_id),
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

      /*$acf_fields = array(
            "menarca" => $menarca,
            "irs" => $irs
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $app_post );
            }
        }*/

        //if $static_data_id == 0 means is a new patient and needs to link the  newly created static ago post
        // to the patient id. else means its a patient thats being updated
        if($static_data_id == 0){
          add_post_meta( $app_post, 'patients_static_data', $patient_id );
          //add_post_meta( $patient_id, 'patients_static_data', $app_post );
        }
      
      
      $result['success'] = TRUE;
      $result['patient_id'] = $patient_id;
      //$result['app_id'] = $app_post;
      $result['msg'] = 'Patient Static Data Created.';
      return $result;
}


/*
********************************************************************************
*
      deletePatient
*
********************************************************************************
*/

function sw_delete_patient_ajax(){

  $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
  //$result = [];
  $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
  
  //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
  //error_log(json_encode($_POST), 0);

  $params = array(
      "patient_id" => $patient_id
  );

  $result = sw_delete_patient($params);

  wp_die(json_encode($result));
}
add_action( 'wp_ajax_sw_delete_patient_ajax', 'sw_delete_patient_ajax');

function sw_delete_patient($params){

  $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
  $patient_id = $params['patient_id'];
  
  
  //obtener la lista de consultas, por cada consulta obtener su colpo y borrarla. luego borrar la consulta
  $related = sw_get_related_appointments($patient_id);
  //r is the current app_id 
  foreach ($related as $r){
        //get the colposcopy id and href of this app
        $colpo_patient_array = sw_get_colpo_id($r);
        $colpo_post_id = $colpo_patient_array[0];

        $indication_array = sw_get_indication_id($r);
        $indication_id = isset($indication_array[0]) ? $indication_array[0] : NULL;

        $studies_array = sw_get_studies_id($r);
        $studies_id = isset($studies_array[0]) ? $studies_array[0] : NULL;
        
        $laboratories_array = sw_get_laboratories_id($r);
        $laboratories_id = isset($laboratories_array[0]) ? $laboratories_array[0] : NULL;
        
        wp_trash_post($colpo_post_id);
        wp_trash_post($indication_id);
        wp_trash_post($studies_id);
        wp_trash_post($laboratories_id);
        wp_trash_post($r);
  }

  // FALTA AGREGAR LO QUE SEA QUE RE RELACIONE CON EL PACIENTE Y NO ESTE AGREGADO ACA COMO PRESCRIPCIONES ETC

  // returns an array containing the ID of the static data post related to this patient id.
  $the_query = sw_get_patient_static_data_ago($patient_id);
  $patient_ago_id =  $the_query[0];
  // borrar el post del tipo static-data/AGO
  wp_trash_post($patient_ago_id);
  //borrar el post del tipo paciente
  wp_trash_post($patient_id);

  $result['success'] = TRUE;
  $result['msg'] = 'Paciente eliminado en el backend - ID eliminado:  '.$patient_id ;
  return $result;
}

?>