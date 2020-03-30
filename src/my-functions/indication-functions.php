<?php  

/*
********************************************************************************
*
      CreatePatient
*
********************************************************************************
*/

function sw_create_indication_ajax(){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    //$result = [];
    //$patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;
    
    $rp = isset($_POST['rp']) && $_POST['rp'] != '' ? $_POST['rp'] : NULL;
    $indicaciones = isset($_POST['indicaciones']) && $_POST['indicaciones'] != '' ? $_POST['indicaciones'] : NULL;

    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
     //error_log(json_encode($_POST), 0);

    $params = array(
        //"patient_id" => $patient_id,
        "app_id" => $app_id,
        "rp" => $rp,
        "indicaciones" => $indicaciones
        
    );

    //if($patient_id === 'new'){
      $result = sw_create_indication($params);
    //}
    // else{
    //   $result = sw_update_patient($params);
    // }

    wp_die(json_encode($result));
}

add_action( 'wp_ajax_sw_create_indication_ajax', 'sw_create_indication_ajax');

//crea un paciente nuevo y tbm crea el post del tipo static-data-ago que le corresponde al paciente nuevo
function sw_create_indication($params){

      $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
      $static_values = [];

      $app_id = $params['app_id'];
      
      $rp = $params['rp'];
      $indicaciones = $params['indicaciones'];


      //$metodo_anticonceptivo = array("inyectable", "preservativos");
      //wp_die(var_dump($metodo_anticonceptivo));

      $post_author = $params['post_author'];
      //sw_get_patient_owner: devuelve el id del doctor directamente, o si el rol del usuario actual es secretaty 
      //devuelve el id del doctor que le corresponde 
      $patient_owner = sw_get_patient_owner();

      $my_post = array(
        'ID'   => 0,
        'post_title'    => wp_strip_all_tags( $rp.' '. $indicaciones." App ID: ".$app_id),
        'post_status'   => 'publish',
        //'post_author'   => get_current_user_id(),
        'post_author'   => $patient_owner,
        'post_type' => 'sw_indication',
        //'meta_input' => ["related_patient", $patient_post ]
        //'post_category' => array( 8,39 )
      );

      // Insert the post into the database // returns post id on succes. 0 on fail
      $post_id = wp_insert_post( $my_post );
      if ($post_id == 0) {
      //  wp_die( "Error creating a new Patient" );
      }

      $acf_fields = array(
            "rp" => $rp,
            "indicaciones" => $indicaciones
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $post_id );
            }
        }

        add_post_meta( $post_id, 'related_indication', $app_id );

      //create the patient static data post type
      //send param array with name , lastname and $post_id wich is the receently created patient
    //   $static_values = ['patient_name'=>$patient_name,
    //                     'static_data_id'=> 0,
    //                     'patient_last_name'=>$patient_last_name, 
    //                     'patient_id'=>$post_id
    //                    ];

    //   $static_data = sw_create_static_data($static_values);

      $result['success'] = TRUE;
      $result['msg'] = 'Nueva Indicacion creada';
      return $result;
}

//actualiza un paciente que ya existe y tbm actualiza el nombre del post del tipo static-data-ago que le corresponde
function sw_update_indication($params){

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
    $region_sanitaria = $params['region_sanitaria'];
    $epitelio_escamoso = $params['epitelio_escamoso'];

    $post_author = $params['post_author'];
    //sw_get_patient_owner: devuelve el id del doctor directamente, o si el rol del usuario actual es secretaty 
    //devuelve el id del doctor que le corresponde 
    $patient_owner = sw_get_patient_owner();

    $my_post = array(
      'ID'   => $patient_id,
      'post_title'    => wp_strip_all_tags( $patient_name.' '. $patient_last_name ),
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
    $result['msg'] = 'Datos del paciente actualizados';
    return $result;
}



// recibe el id del paciente y retorna el post tipo static_data-Ago asociado a el
//retorna una array  
function sw_get_patient_static_data_agoxxx($patient_id){
    
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
function sw_create_static_dataxxx($params){

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

function sw_delete_patient_ajaxxxx(){

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

function sw_delete_patientxxx($params){

  $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
  $patient_id = $params['patient_id'];
  
  
  //obtener la lista de consultas, por cada consulta obtener su colpo y borrarla. luego borrar la consulta
  $related = sw_get_related_appointments($patient_id);
  //r is the current app_id 
  foreach ($related as $r){
        //get the colposcopy id and href of this app
        $colpo_patient_array = sw_get_colpo_id($r);
        $colpo_post_id = $colpo_patient_array[0];

        wp_trash_post($colpo_post_id);
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