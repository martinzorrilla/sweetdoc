<?php  

/*
********************************************************************************
*
      CreateIndication
*
********************************************************************************
*/

function sw_create_indication_ajax(){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;    
    $rp = isset($_POST['rp']) && $_POST['rp'] != '' ? $_POST['rp'] : NULL;
    $indicaciones = isset($_POST['indicaciones']) && $_POST['indicaciones'] != '' ? $_POST['indicaciones'] : NULL;

    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    //  error_log(json_encode($_POST), 0);

    $params = array(
        "patient_id" => $patient_id,
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
      $app_id = $params['app_id'];
      $patient_id = $params['patient_id'];

      //datos del formulario en si
      $rp = $params['rp'];
      $indicaciones = $params['indicaciones'];

      // $patient_id =  sw_get_patient_id_by_app($app_id);
      $patient_fields = get_post_custom($patient_id);
      $name = $patient_fields['nombre'][0];
      $lastname = $patient_fields['apellido'][0];
      //$cedula = $patient_fields['cedula'][0];
      $fullname = $name.'-'.$lastname;
      //$fullname = "no anda";

      // $post_author = $params['post_author'];
      //sw_get_patient_owner: devuelve el id del doctor directamente, o si el rol del usuario actual es secretaty 
      //devuelve el id del doctor que le corresponde 
      $patient_owner = sw_get_patient_owner();

      $my_post = array(
        'ID'   => 0,
        'post_title'    => wp_strip_all_tags( $fullname."- app_id: ".$app_id),
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
        add_post_meta( $post_id, 'indication_related_patient', $patient_id );


      $result['success'] = TRUE;
      $result['msg'] = 'Nueva Indicacion creada';
      return $result;
}

//POR EL MOMENTO NO USO YA QUE ESTOY CREANDO UN NUEVO POST POR CADA UPDATE DE INDICACION, DE MANERA A TENER UN HISTORIAL DE CAMBIOS. ESTA FUNCION ES UNA COPIA SIN MODIFICAR DE UPDATE_PATIENT
//SI QUIERO USAR TENGO QUE MODIFICAR LA FUNCION
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

?>