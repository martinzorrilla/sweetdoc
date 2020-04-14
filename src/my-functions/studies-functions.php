<?php  

/*
********************************************************************************
*
      CreateStudies
*
********************************************************************************
*/

function sw_create_studies_ajax(){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    $app_id = isset($_POST['app_id']) && $_POST['app_id'] != '' ? $_POST['app_id'] : NULL;    
    
    $egcv = isset($_POST['egcv']) && $_POST['egcv'] != '' ? $_POST['egcv'] : NULL;
    $egcv_dx = isset($_POST['egcv_dx']) && $_POST['egcv_dx'] != '' ? $_POST['egcv_dx'] : NULL;
    $egva = isset($_POST['egva']) && $_POST['egva'] != '' ? $_POST['egva'] : NULL;
    $egva_dx = isset($_POST['egva_dx']) && $_POST['egva_dx'] != '' ? $_POST['egva_dx'] : NULL;
    $ea_st = isset($_POST['ea_st']) && $_POST['ea_st'] != '' ? $_POST['ea_st'] : NULL;
    $ea_st_dx = isset($_POST['ea_st_dx']) && $_POST['ea_st_dx'] != '' ? $_POST['ea_st_dx'] : NULL;
    $ecografia_renal = isset($_POST['ecografia_renal']) && $_POST['ecografia_renal'] != '' ? $_POST['ecografia_renal'] : NULL;
    $er_dx = isset($_POST['er_dx']) && $_POST['er_dx'] != '' ? $_POST['er_dx'] : NULL;


    $mdb = isset($_POST['mdb']) && $_POST['mdb'] != '' ? $_POST['mdb'] : NULL;
    $mdb_dx = isset($_POST['mdb_dx']) && $_POST['mdb_dx'] != '' ? $_POST['mdb_dx'] : NULL;
    $ecografia_mamaria = isset($_POST['ecografia_mamaria']) && $_POST['ecografia_mamaria'] != '' ? $_POST['ecografia_mamaria'] : NULL;
    $em_dx = isset($_POST['em_dx']) && $_POST['em_dx'] != '' ? $_POST['em_dx'] : NULL;
    $ecografia_obstetrica = isset($_POST['ecografia_obstetrica']) && $_POST['ecografia_obstetrica'] != '' ? $_POST['ecografia_obstetrica'] : NULL;
    $eo_dx = isset($_POST['eo_dx']) && $_POST['eo_dx'] != '' ? $_POST['eo_dx'] : NULL;
    $eodfp = isset($_POST['eodfp']) && $_POST['eodfp'] != '' ? $_POST['eodfp'] : NULL;
    $eodfp_dx = isset($_POST['eodfp_dx']) && $_POST['eodfp_dx'] != '' ? $_POST['eodfp_dx'] : NULL;
    $emdm = isset($_POST['emdm']) && $_POST['emdm'] != '' ? $_POST['emdm'] : NULL;
    $emdm_dx = isset($_POST['emdm_dx']) && $_POST['emdm_dx'] != '' ? $_POST['emdm_dx'] : NULL;
    $eomcdm = isset($_POST['eomcdm']) && $_POST['eomcdm'] != '' ? $_POST['eomcdm'] : NULL;
    $eomcdm_dx = isset($_POST['eomcdm_dx']) && $_POST['eomcdm_dx'] != '' ? $_POST['eomcdm_dx'] : NULL;
    $colposcopia_st = isset($_POST['colposcopia_st']) && $_POST['colposcopia_st'] != '' ? $_POST['colposcopia_st'] : NULL;
    $colposcopia_st_dx = isset($_POST['colposcopia_st_dx']) && $_POST['colposcopia_st_dx'] != '' ? $_POST['colposcopia_st_dx'] : NULL;
    $lec_st = isset($_POST['lec_st']) && $_POST['lec_st'] != '' ? $_POST['lec_st'] : NULL;
    $lec_st_dx = isset($_POST['lec_st_dx']) && $_POST['lec_st_dx'] != '' ? $_POST['lec_st_dx'] : NULL;
    $desintometria_osea = isset($_POST['desintometria_osea']) && $_POST['desintometria_osea'] != '' ? $_POST['desintometria_osea'] : NULL;
    $desintometria_osea_dx = isset($_POST['desintometria_osea_dx']) && $_POST['desintometria_osea_dx'] != '' ? $_POST['desintometria_osea_dx'] : NULL;
    $rtpa = isset($_POST['rtpa']) && $_POST['rtpa'] != '' ? $_POST['rtpa'] : NULL;
    $rtpa_dx = isset($_POST['rtpa_dx']) && $_POST['rtpa_dx'] != '' ? $_POST['rtpa_dx'] : NULL;
    $electrocardiograma = isset($_POST['electrocardiograma']) && $_POST['electrocardiograma'] != '' ? $_POST['electrocardiograma'] : NULL;
    $electrocardiograma_dx = isset($_POST['electrocardiograma_dx']) && $_POST['electrocardiograma_dx'] != '' ? $_POST['electrocardiograma_dx'] : NULL;
    $tapc = isset($_POST['tapc']) && $_POST['tapc'] != '' ? $_POST['tapc'] : NULL;
    $tapc_dx = isset($_POST['tapc_dx']) && $_POST['tapc_dx'] != '' ? $_POST['tapc_dx'] : NULL;
    $tsts = isset($_POST['tsts']) && $_POST['tsts'] != '' ? $_POST['tsts'] : NULL;
    $tsts_dx = isset($_POST['tsts_dx']) && $_POST['tsts_dx'] != '' ? $_POST['tsts_dx'] : NULL;
    $tstc = isset($_POST['tstc']) && $_POST['tstc'] != '' ? $_POST['tstc'] : NULL;
    $tstc_dx = isset($_POST['tstc_dx']) && $_POST['tstc_dx'] != '' ? $_POST['tstc_dx'] : NULL;
    $emba = isset($_POST['emba']) && $_POST['emba'] != '' ? $_POST['emba'] : NULL;
    $emba_dx = isset($_POST['emba_dx']) && $_POST['emba_dx'] != '' ? $_POST['emba_dx'] : NULL;
    $pbf = isset($_POST['pbf']) && $_POST['pbf'] != '' ? $_POST['pbf'] : NULL;
    $pbf_dx = isset($_POST['pbf_dx']) && $_POST['pbf_dx'] != '' ? $_POST['pbf_dx'] : NULL;
    $pbfdfp = isset($_POST['pbfdfp']) && $_POST['pbfdfp'] != '' ? $_POST['pbfdfp'] : NULL;
    $pbfdfp_dx = isset($_POST['pbfdfp_dx']) && $_POST['pbfdfp_dx'] != '' ? $_POST['pbfdfp_dx'] : NULL;
    $mfne = isset($_POST['mfne']) && $_POST['mfne'] != '' ? $_POST['mfne'] : NULL;
    $mfne_dx = isset($_POST['mfne_dx']) && $_POST['mfne_dx'] != '' ? $_POST['mfne_dx'] : NULL;
    $pyc = isset($_POST['pyc']) && $_POST['pyc'] != '' ? $_POST['pyc'] : NULL;
    $pyc_dx = isset($_POST['pyc_dx']) && $_POST['pyc_dx'] != '' ? $_POST['pyc_dx'] : NULL;
    $bcl = isset($_POST['bcl']) && $_POST['bcl'] != '' ? $_POST['bcl'] : NULL;
    $bcl_dx = isset($_POST['bcl_dx']) && $_POST['bcl_dx'] != '' ? $_POST['bcl_dx'] : NULL;
    $otros_st = isset($_POST['otros_st']) && $_POST['otros_st'] != '' ? $_POST['otros_st'] : NULL;


    
    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    // error_log(json_encode($_POST), 0);

    $params = array(
        "patient_id" => $patient_id,
        "app_id" => $app_id,


        "egcv" => $egcv,
        "egcv_dx" => $egcv_dx,
        "egva" => $egva,
        "egva_dx" => $egva_dx,
        "ea_st" => $ea_st,
        "ea_st_dx" => $ea_st_dx,
        "ecografia_renal" => $ecografia_renal,
        "er_dx" => $er_dx,
        "mdb" => $mdb,
        "mdb_dx" => $mdb_dx,
        "ecografia_mamaria" => $ecografia_mamaria,
        "em_dx" => $em_dx,
        "ecografia_obstetrica" => $ecografia_obstetrica,
        "eo_dx" => $eo_dx,
        "eodfp" => $eodfp,
        "eodfp_dx" => $eodfp_dx,
        "emdm" => $emdm,
        "emdm_dx" => $emdm_dx,
        "eomcdm" => $eomcdm,
        "eomcdm_dx" => $eomcdm_dx,
        "colposcopia_st" => $colposcopia_st,
        "colposcopia_st_dx" => $colposcopia_st_dx,
        "lec_st" => $lec_st,
        "lec_st_dx" => $lec_st_dx,
        "desintometria_osea" => $desintometria_osea,
        "desintometria_osea_dx" => $desintometria_osea_dx,
        "rtpa" => $rtpa,
        "rtpa_dx" => $rtpa_dx,
        "electrocardiograma" => $electrocardiograma,
        "electrocardiograma_dx" => $electrocardiograma_dx,
        "tapc" => $tapc,
        "tapc_dx" => $tapc_dx,
        "tsts" => $tsts,
        "tsts_dx" => $tsts_dx,
        "tstc" => $tstc,
        "tstc_dx" => $tstc_dx,
        "emba" => $emba,
        "emba_dx" => $emba_dx,
        "pbf" => $pbf,
        "pbf_dx" => $pbf_dx,
        "pbfdfp" => $pbfdfp,
        "pbfdfp_dx" => $pbfdfp_dx,
        "mfne" => $mfne,
        "mfne_dx" => $mfne_dx,
        "pyc" => $pyc,
        "pyc_dx" => $pyc_dx,
        "bcl" => $bcl,
        "bcl_dx" => $bcl_dx,
        "otros_st" => $otros_st

        
    );

    //if($patient_id === 'new'){
      $result = sw_create_studies($params);
    //}
    // else{
    //   $result = sw_update_patient($params);
    // }

    wp_die(json_encode($result));
}

add_action( 'wp_ajax_sw_create_studies_ajax', 'sw_create_studies_ajax');

//crea un paciente nuevo y tbm crea el post del tipo static-data-ago que le corresponde al paciente nuevo
function sw_create_studies($params){

      $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
      $patient_id = $params['patient_id'];
      $app_id = $params['app_id'];

      $egcv = $params['egcv'];
      $egcv_dx = $params['egcv_dx'];
      $egva = $params['egva'];
      $egva_dx = $params['egva_dx'];
      $ea_st = $params['ea_st'];
      $ea_st_dx = $params['ea_st_dx'];

      $ecografia_renal = $params['ecografia_renal'];
      $er_dx = $params['er_dx'];
      $mdb = $params['mdb'];
      $mdb_dx = $params['mdb_dx'];
      $ecografia_mamaria = $params['ecografia_mamaria'];
      $em_dx = $params['em_dx'];
      $ecografia_obstetrica = $params['ecografia_obstetrica'];
      $eo_dx = $params['eo_dx'];
      $eodfp = $params['eodfp'];
      $eodfp_dx = $params['eodfp_dx'];
      $emdm = $params['emdm'];
      $emdm_dx = $params['emdm_dx'];
      $eomcdm = $params['eomcdm'];
      $eomcdm_dx = $params['eomcdm_dx'];
      $colposcopia_st = $params['colposcopia_st'];
      $colposcopia_st_dx = $params['colposcopia_st_dx'];
      $lec_st = $params['lec_st'];
      $lec_st_dx = $params['lec_st_dx'];
      $desintometria_osea = $params['desintometria_osea'];
      $desintometria_osea_dx = $params['desintometria_osea_dx'];
      $rtpa = $params['rtpa'];
      $rtpa_dx = $params['rtpa_dx'];
      $electrocardiograma = $params['electrocardiograma'];
      $electrocardiograma_dx = $params['electrocardiograma_dx'];
      $tapc = $params['tapc'];
      $tapc_dx = $params['tapc_dx'];
      $tsts = $params['tsts'];
      $tsts_dx = $params['tsts_dx'];
      $tstc = $params['tstc'];
      $tstc_dx = $params['tstc_dx'];
      $emba = $params['emba'];
      $emba_dx = $params['emba_dx'];
      $pbf = $params['pbf'];
      $pbf_dx = $params['pbf_dx'];
      $pbfdfp = $params['pbfdfp'];
      $pbfdfp_dx = $params['pbfdfp_dx'];
      $mfne = $params['mfne'];
      $mfne_dx = $params['mfne_dx'];
      $pyc = $params['pyc'];
      $pyc_dx = $params['pyc_dx'];
      $bcl = $params['bcl'];
      $bcl_dx = $params['bcl_dx']; 
      
      $otros_st = $params['otros_st']; 


      $patient_fields = get_post_custom($patient_id);
      $name = $patient_fields['nombre'][0];
      $lastname = $patient_fields['apellido'][0];
      //$cedula = $patient_fields['cedula'][0];
      $fullname = $name.'-'.$lastname;
      $post_author = $params['post_author'];
      //sw_get_patient_owner: devuelve el id del doctor directamente, o si el rol del usuario actual es secretaty 
      //devuelve el id del doctor que le corresponde 
      $patient_owner = sw_get_patient_owner();

      $my_post = array(
        'ID'   => 0,
        'post_title'    => wp_strip_all_tags( $fullname."- app_id: ".$app_id),
        'post_status'   => 'publish',
        //'post_author'   => get_current_user_id(),
        'post_author'   => $patient_owner,
        'post_type' => 'sw_study',
        //'meta_input' => ["related_patient", $patient_post ]
        //'post_category' => array( 8,39 )
      );

      // Insert the post into the database // returns post id on succes. 0 on fail
      $post_id = wp_insert_post( $my_post );
      if ($post_id == 0) {
      //  wp_die( "Error creating a new Patient" );
      }

      $acf_fields = array(
            "egcv" => $egcv,
            "egcv_dx" => $egcv_dx,
            "egva" => $egva,
            "egva_dx" => $egva_dx,
            "ea_st" => $ea_st,
            "ea_st_dx" => $ea_st_dx,
            "ecografia_renal" => $ecografia_renal,
            "er_dx" => $er_dx,
            "mdb" => $mdb,
            "mdb_dx" => $mdb_dx,
            "ecografia_mamaria" => $ecografia_mamaria,
            "em_dx" => $em_dx,
            "ecografia_obstetrica" => $ecografia_obstetrica,
            "eo_dx" => $eo_dx,
            "eodfp" => $eodfp,
            "eodfp_dx" => $eodfp_dx,
            "emdm" => $emdm,
            "emdm_dx" => $emdm_dx,
            "eomcdm" => $eomcdm,
            "eomcdm_dx" => $eomcdm_dx,
            "colposcopia_st" => $colposcopia_st,
            "colposcopia_st_dx" => $colposcopia_st_dx,
            "lec_st" => $lec_st,
            "lec_st_dx" => $lec_st_dx,
            "desintometria_osea" => $desintometria_osea,
            "desintometria_osea_dx" => $desintometria_osea_dx,
            "rtpa" => $rtpa,
            "rtpa_dx" => $rtpa_dx,
            "electrocardiograma" => $electrocardiograma,
            "electrocardiograma_dx" => $electrocardiograma_dx,
            "tapc" => $tapc,
            "tapc_dx" => $tapc_dx,
            "tsts" => $tsts,
            "tsts_dx" => $tsts_dx,
            "tstc" => $tstc,
            "tstc_dx" => $tstc_dx,
            "emba" => $emba,
            "emba_dx" => $emba_dx,
            "pbf" => $pbf,
            "pbf_dx" => $pbf_dx,
            "pbfdfp" => $pbfdfp,
            "pbfdfp_dx" => $pbfdfp_dx,
            "mfne" => $mfne,
            "mfne_dx" => $mfne_dx,
            "pyc" => $pyc,
            "pyc_dx" => $pyc_dx,
            "bcl" => $bcl,
            "bcl_dx" => $bcl_dx,
            "otros_st" => $otros_st

        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $post_id );
            }
        }

        add_post_meta( $post_id, 'related_study', $app_id );

      $result['success'] = TRUE;
      $result['msg'] = 'Nuevo estudio creado';
      return $result;
}

//POR EL MOMENTO NO USO YA QUE ESTOY CREANDO UN NUEVO POST POR CADA UPDATE DE INDICACION, DE MANERA A TENER UN HISTORIAL DE CAMBIOS. ESTA FUNCION ES UNA COPIA SIN MODIFICAR DE UPDATE_PATIENT
function sw_update_studies($params){

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