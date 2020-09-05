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

    $examen_fisico = isset($_POST['examen_fisico']) && $_POST['examen_fisico'] != '' ? $_POST['examen_fisico'] : NULL;
    $peso = isset($_POST['peso']) && $_POST['peso'] != '' ? $_POST['peso'] : NULL;
    $presion = isset($_POST['presion']) && $_POST['presion'] != '' ? $_POST['presion'] : NULL;
    $imc = isset($_POST['imc']) && $_POST['imc'] != '' ? $_POST['imc'] : NULL;


    $diagnostico_consulta = isset($_POST['diagnostico_consulta']) && $_POST['diagnostico_consulta'] != '' ? $_POST['diagnostico_consulta'] : NULL;
    $codigo_diagnostico = isset($_POST['codigo_diagnostico']) && $_POST['codigo_diagnostico'] != '' ? $_POST['codigo_diagnostico'] : NULL;
    $procedimiento = isset($_POST['procedimiento']) && $_POST['procedimiento'] != '' ? $_POST['procedimiento'] : NULL;
    $codigo_procedimiento = isset($_POST['codigo_procedimiento']) && $_POST['codigo_procedimiento'] != '' ? $_POST['codigo_procedimiento'] : NULL;
    $plan_tratamiento = isset($_POST['plan_tratamiento']) && $_POST['plan_tratamiento'] != '' ? $_POST['plan_tratamiento'] : NULL;
    
    //agregar aca el mismo codigo que arriba pero para los valores del checkbox el cual deberia ser un array
    //$checkbox_values = isset($_POST['checkbox_values']) && $_POST['checkbox_values'] != '' ? $_POST['checkbox_values'] : NULL;


    //private/static data
    $cesareas = isset($_POST['cesareas']) && $_POST['cesareas'] != '' ? $_POST['cesareas'] : NULL; 
    $menarca = isset($_POST['menarca']) && $_POST['menarca'] != '' ? $_POST['menarca'] : NULL;
    $irs = isset($_POST['irs']) && $_POST['irs'] != '' ? $_POST['irs'] : NULL; 
    $static_data_post_id = isset($_POST['static_data_post_id']) && $_POST['static_data_post_id'] != '' ? $_POST['static_data_post_id'] : NULL;
    $vacuna_vph = isset($_POST['vacuna_vph']) && $_POST['vacuna_vph'] != '' ? $_POST['vacuna_vph'] : NULL;    
    $edad_vph = isset($_POST['edad_vph']) && $_POST['edad_vph'] != '' ? $_POST['edad_vph'] : NULL;
    $ritmo_menstrual = isset($_POST['ritmo_menstrual']) && $_POST['ritmo_menstrual'] != '' ? $_POST['ritmo_menstrual'] : NULL;    
    $fum = isset($_POST['fum']) && $_POST['fum'] != '' ? $_POST['fum'] : NULL; 

    $menopausia = isset($_POST['menopausia']) && $_POST['menopausia'] != '' ? $_POST['menopausia'] : NULL;
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
    $alertas = isset($_POST['alertas']) && $_POST['alertas'] != '' ? $_POST['alertas'] : NULL;
    
    //colposcopia data
    $colpo_post_id = isset($_POST['colpo_post_id']) && $_POST['colpo_post_id'] != '' ? $_POST['colpo_post_id'] : NULL;
    
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


    // motivo_inadecuada
    // union_escamo_columnar
    // zona_de_transformacion
    // colposcopicos_normales
    // colposcopicos_anormales_grado_1
    // colposcopicos_anormales_grado_2
    // colposcopicos_anormales_no_especificos
    // colposcopicos_anormales_ubicacion
    // sospecha_de_invasion
    // hallazgos_varios
    // examen_de_vyv
    // examen_de_vyv_descripcion
    // colposcopicos_anormales_test_de_schiller
    // test_de_schiller_lugol
    // sugerencias


 








    //wp_die(var_dump($_FILES));
    
    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    // error_log(json_encode($_POST), 0);

    $params = array(
        "app_id" => $app_id,
        "patient_id" => $patient_id,
        "static_data_post_id" => $static_data_post_id,
        "colpo_post_id" => $colpo_post_id,

        //consulta
        "motivo_de_consulta" => $motivo_de_consulta,
        "antecedente_actual" => $antecedente_actual,
        
        "examen_fisico" => $examen_fisico,
        "peso" => $peso,
        "presion" => $presion,
        "imc" => $imc,
        
        "diagnostico_consulta" => $diagnostico_consulta,
        "codigo_diagnostico" => $codigo_diagnostico,
        "procedimiento" => $procedimiento,
        "codigo_procedimiento" => $codigo_procedimiento,
        "plan_tratamiento" => $plan_tratamiento,
        

        //ago
        "menarca" => $menarca,
        "irs" => $irs,
        "cesareas" => $cesareas,
        // "checkbox_values" => $checkbox_values,
        "vacuna_vph" => $vacuna_vph,
        "edad_vph" => $edad_vph,
        "ritmo_menstrual" => $ritmo_menstrual,
        "fum" => $fum,
        "menopausia" => $menopausia,
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
        "observaciones" => $observaciones,
        "alertas" => $alertas,
        
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

    //private/static data AGO
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

    $menopausia = $params['menopausia'];    
    $alertas = $params['alertas'];    



    //common fields CONSULTA
    $motivo_de_consulta = $params['motivo_de_consulta'];
    $antecedente_actual = $params['antecedente_actual'];
    
    $examen_fisico = $params['examen_fisico'];
    $peso = $params['peso'];
    $presion = $params['presion'];
    $imc = $params['imc'];
     
    $diagnostico_consulta = $params['diagnostico_consulta'];
    $codigo_diagnostico = $params['codigo_diagnostico'];
    $procedimiento = $params['procedimiento'];
    $codigo_procedimiento = $params['codigo_procedimiento'];
    $plan_tratamiento = $params['plan_tratamiento'];


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
            "antecedente_actual" => $antecedente_actual,

            "examen_fisico" => $examen_fisico,
            "peso" => $peso,
            "presion" => $presion,
            "imc" => $imc,

            "diagnostico_consulta" => $diagnostico_consulta,
            "codigo_diagnostico" => $codigo_diagnostico,
            "procedimiento" => $procedimiento,
            "codigo_procedimiento" => $codigo_procedimiento,
            "plan_tratamiento" => $plan_tratamiento
        );

        foreach ($acf_fields as $field => $value) {
            if($value != NULL){
                update_field( $field, $value, $app_post );
            }
        }
        // esta es la que originalmente ya estaba
      //esta realcion permite que: teniendo el id del paciente se pueda buscar sus apps
      add_post_meta( $app_post, 'related_patient', $patient_id );

      // esta agregue mucho despues cuando necesite en el momento de crear el pdf para la indicion, cosa que aun no funciona
      // esta relacion es para que funcione sw_get_patient_id_from_app_id y se pueda obtener el id del paciente a partir de la app_id. no se si funciona bien ya que solo guardaria en el la ultima app que se relaciono con el paciente.
      add_post_meta($patient_id, 'related_appointment', $app_post );
      
      //update the private/static data
      //WARNING: the post type static_data is created when the patient is created
        // $acf_fields = array(
        //     "cesareas" => $cesareas,
        //     "menarca" => $menarca,
        //     "irs" => $irs,
        //     "vacuna_vph" => $vacuna_vph,
        //     "edad_vph" => $edad_vph,
        //     "ritmo_menstrual" => $ritmo_menstrual,
        //     "fum" => $fum,

        //     "numero_embarazos" => $numero_embarazos,
        //     "parto_normal" => $parto_normal,
        //     "abortos" => $abortos,
        //     "metodo_anticonceptivo" => $metodo_anticonceptivo,
        //     "marca_anticonceptivo" => $marca_anticonceptivo,
        //     "terapia_hormonal" => $terapia_hormonal,
        //     "pap_anterior" => $pap_anterior,
        //     "fecha_pap" => $fecha_pap,
        //     "fumador" => $fumador,
        //     "cigarrillos_por_dia" => $cigarrillos_por_dia,
        //     "tratamientos_anteriores" => $tratamientos_anteriores,
        //     "fecha_de_tratamiento" => $fecha_de_tratamiento,
        //     "observaciones" => $observaciones,
        //     "menopausia" => $menopausia,
        //     "alertas" => $alertas

        // );
        // foreach ($acf_fields as $field => $value) {
        //     if($value != NULL)
        //         //var_dump("clave: ".$field." valor: ".$value)."<br>";
        //         //var_dump("app_id: ".$app_id)."<br>";
        //         //update_field( $field, $value, $app_id );
        //         update_post_meta( $static_data_post_id, $field, $value );
        // }



      //---------------------------------------
      $result['success'] = TRUE;
      $result['patient_id'] = $patient_id;
      $result['app_id'] = $app_post;
      // $result['msg'] = 'Nueva consulta creada';
      $result['msg'] = get_permalink( $patient_id );

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

    //common fields CONSULTA
    $motivo_de_consulta = $params['motivo_de_consulta'];
    $antecedente_actual = $params['antecedente_actual'];

    $examen_fisico = $params['examen_fisico'];
    $peso = $params['peso'];
    $presion = $params['presion'];
    $imc = $params['imc'];

    $diagnostico_consulta = $params['diagnostico_consulta'];
    $codigo_diagnostico = $params['codigo_diagnostico'];
    $procedimiento = $params['procedimiento'];
    $codigo_procedimiento = $params['codigo_procedimiento'];
    $plan_tratamiento = $params['plan_tratamiento'];
    
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

    $menopausia = $params['menopausia'];    
    $alertas = $params['alertas'];

    //colposcopia data
    $colpo_post_id = $params['colpo_post_id'];
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

    if ($app_id != NULL && $app_id != '') {

        //update the private/static data
        // $acf_fields = array(
        //     "cesareas" => $cesareas,
        //     "menarca" => $menarca,
        //     "irs" => $irs,
        //     "vacuna_vph" => $vacuna_vph,
        //     "edad_vph" => $edad_vph,
        //     "ritmo_menstrual" => $ritmo_menstrual,
        //     "fum" => $fum,
            
        //     "numero_embarazos" => $numero_embarazos,
        //     "parto_normal" => $parto_normal,
        //     "abortos" => $abortos,
        //     "metodo_anticonceptivo" => $metodo_anticonceptivo,
        //     "marca_anticonceptivo" => $marca_anticonceptivo,
        //     "terapia_hormonal" => $terapia_hormonal,
        //     "pap_anterior" => $pap_anterior,

        //     "fecha_pap" => $fecha_pap,
        //     "fumador" => $fumador,
        //     "cigarrillos_por_dia" => $cigarrillos_por_dia,
        //     "tratamientos_anteriores" => $tratamientos_anteriores,
        //     "fecha_de_tratamiento" => $fecha_de_tratamiento,
        //     "observaciones" => $observaciones,
        //     "menopausia" => $menopausia,
        //     "alertas" => $alertas

        // );
        // foreach ($acf_fields as $field => $value) {
        //     // if($value != NULL)
        //         //var_dump("clave: ".$field." valor: ".$value)."<br>";
        //         //var_dump("app_id: ".$app_id)."<br>";
        //         //update_field( $field, $value, $app_id );
        //         update_post_meta( $static_data_post_id, $field, $value );
        // }


        //update the common fields
        $acf_fields = array(
          "motivo_de_consulta" => $motivo_de_consulta,
          "antecedente_actual" => $antecedente_actual,

          "examen_fisico" => $examen_fisico,
          "peso" => $peso,
          "presion" => $presion,
          "imc" => $imc,

          "diagnostico_consulta" => $diagnostico_consulta,
          "codigo_diagnostico" => $codigo_diagnostico,
          "procedimiento" => $procedimiento,
          "codigo_procedimiento" => $codigo_procedimiento,
          "plan_tratamiento" => $plan_tratamiento
      );
      
        foreach ($acf_fields as $field => $value) {
            // if($value != NULL)
                //var_dump("clave: ".$field." valor: ".$value)."<br>";
                //var_dump("app_id: ".$app_id)."<br>";
                //update_field( $field, $value, $app_id );
                update_post_meta( $app_id, $field, $value );
        }


        $result['success'] = TRUE;
        // $result['msg'] = 'Consulta Actualizada';
        $result['msg'] = get_permalink( $patient_id );

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