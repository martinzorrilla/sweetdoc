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
    $region_sanitaria = isset($_POST['region_sanitaria']) && $_POST['region_sanitaria'] != '' ? $_POST['region_sanitaria'] : NULL;
    $epitelio_escamoso = isset($_POST['epitelio_escamoso']) && $_POST['epitelio_escamoso'] != '' ? $_POST['epitelio_escamoso'] : NULL;


    error_log(json_encode($_POST), 0);

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
        "region_sanitaria" => $region_sanitaria,
        "epitelio_escamoso" => $epitelio_escamoso
        
    );

    if($patient_id === 'new'){
      $result = sw_create_patient($params);
    }

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


      //$metodo_anticonceptivo = array("inyectable", "preservativos");
      //wp_die(var_dump($metodo_anticonceptivo));

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
*
*/
function print_hello_world(){
  echo "Hello World from function";
}
?>