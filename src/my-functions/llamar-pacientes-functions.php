<?php  

/*
********************************************************************************
*
      Llamar pacientes: se cargara un unico paciente que es el siguiente en ingresar 
      al consultorio del medico
*
********************************************************************************
*/

function sw_llamar_pacientes_ajax(){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'accion_inicial'=>'');
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    $seleccion = isset($_POST['seleccion']) && $_POST['seleccion'] != '' ? $_POST['seleccion'] : NULL;
    $eliminar_paciente = isset($_POST['eliminar_paciente']) && $_POST['eliminar_paciente'] != '' ? $_POST['eliminar_paciente'] : NULL;
    
    // $patient_id = 1873; //clara franco
    // $patient_id = NULL; //clara franco
    // $seleccion = "get_patient";

    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    // error_log(json_encode($_POST), 0);

    $params = array(
        "patient_id" => $patient_id,
        "seleccion" => $seleccion
    );

    if ($patient_id != NULL) {
        $result = sw_add_next_patient($params);
    }
    else{
        if ($seleccion == "get_patient") {
            $result = sw_get_next_patient($params);
        }
    }
    

    wp_die(json_encode($result));
}
add_action( 'wp_ajax_sw_llamar_pacientes_ajax', 'sw_llamar_pacientes_ajax');

function sw_add_next_patient($params){

    // $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'accion_inicial'=>'');
    $patient_id = $params['patient_id'];

    $path = get_home_path();
    $path = $path."/next-patient.txt";

    $empty_array = [];

    // traer los datos del archivo txt
    $array_data_from_txt = json_decode(file_get_contents($path), true);
    // $array_data_from_txt = file_get_contents($path);
    // verificar que no sea null
    $array_data_from_txt = isset($array_data_from_txt) ? $array_data_from_txt  : array();
    // si el paciente ya existe en la lista, no ecribir 
    if (!in_array($patient_id, $array_data_from_txt, true)) {    
        // si no existe, agregar al array y guardar el array en el archivo txt, eliminando lo anterior
        $timestamp = strtotime(date('Y-m-d H:i:s'));
        $arr = ['id' => $patient_id, 'timestamp' => $timestamp];
        file_put_contents($path, json_encode($arr));
        // array_push($empty_array, $patient_id);
        // file_put_contents($path, json_encode($empty_array));
        $result['msg'] = array("<p>Paciente sera llamado a consultorio</p>");
    }else{
        $result['msg'] = array("<p>Paciente ya se encuentra en la lista</p>");
    } 

    $result['success'] = TRUE;
    // $result['msg'] = $array_data_from_txt;
    return $result;
}

function sw_get_next_patient($params){

    // $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'accion_inicial'=>'');

    $path = get_home_path();
    $path = $path."/next-patient.txt";
    // $array_data_from_txt = [];

    // traer los datos del archivo txt
    $array_data_from_txt = json_decode(file_get_contents($path), true);
    // $array_data_from_txt = file_get_contents($path);
    // verificar que no sea null
    $array_data_from_txt = isset($array_data_from_txt) ? $array_data_from_txt  : array();
    error_log(json_encode($array_data_from_txt), 0);
    
    $full_html = array();

    // foreach ($array_data_from_txt as $patient) {
        $aux_html = "";
        $post_object = get_post( $array_data_from_txt['id'] ); 
        $title = $post_object->post_title;
        $permalink = get_permalink( $array_data_from_txt['id'] );
        $timestamp = $array_data_from_txt['timestamp'];
        // $aux_html='<li><a href="'.$permalink.'" class="name">'.$title.'</a><p class="eliminarpacientxx">eliminar</p></li>';
        $aux_html='<li>
            <div data-closable class="callout alert-callout-border secondary paciente-llamado blink-bg">
                <div class="row">
                    <div class="large-12 columns">
                        <p class="nombre-paciente">'.$title.'</p>
                    </div>
                </div>

                <button id="eliminar-paciente-llamado" class="close-button eliminar-paciente-llamado" data-id="'.$patient.'" data-timestamp="'.$timestamp.'" aria-label="Dismiss alert" type="button" data-close>
                <span aria-hidden="true">&times;</span>
                </button>

            </div>
        </li>';
        

        array_push($full_html, $aux_html);
    // }
    // $result['msg'] = $test_array;
    $result['msg'] = $full_html;
    // $result['msg'] = "hola martin";
    $result['success'] = TRUE;
    // $result['msg'] = $array_data_from_txt;
    $result['accion_inicial'] = $timestamp;

    return $result;
}


?>