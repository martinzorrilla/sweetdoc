<?php  

/*
********************************************************************************
*
      CreateStudies
*
********************************************************************************
*/

function sw_cargar_consultas_ajax(){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    // $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    $patient_id = 1871; //clara franco
    $seleccion = isset($_POST['seleccion']) && $_POST['seleccion'] != '' ? $_POST['seleccion'] : NULL;

    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    // error_log(json_encode($_POST), 0);

    $params = array(
        "patient_id" => $patient_id,
        "seleccion" => $seleccion
    );

    if ($seleccion == "cargar_consultas") {
        $result = sw_cargar_consultas($params);
    }

    if ($seleccion == "vaciar_consultas") {
        $result = sw_vaciar_consultas($params);
    }

    wp_die(json_encode($result));
}

add_action( 'wp_ajax_sw_cargar_consultas_ajax', 'sw_cargar_consultas_ajax');

function sw_cargar_consultas($params){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $patient_id = $params['patient_id'];
    $seleccion = $params['seleccion'];
    // $patient_id = 'facu';
    // $patient_id = $seleccion;

    $path = get_home_path();
    $path = $path."/array.txt";
    // $array_data_from_txt = [];

    // traer los datos del archivo txt
    $array_data_from_txt = json_decode(file_get_contents($path), true);
    // $array_data_from_txt = file_get_contents($path);
    // verificar que no sea null
    $array_data_from_txt = isset($array_data_from_txt) ? $array_data_from_txt  : array();
    // si el paciente ya existe en la lista, no agregar
    if (!in_array($patient_id, $array_data_from_txt, true)) {    
        // si no existe, agregar al array y guardar el array en el archivo txt, eliminando lo anterior
        array_push($array_data_from_txt, $patient_id);
        file_put_contents($path, json_encode($array_data_from_txt));
    }
    
    $test_array = $array_data_from_txt[2];
    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    // error_log(json_encode($array_data_from_txt), 0);
    
    $full_html = array();
    
    foreach ($array_data_from_txt as $patient) {
        $aux_html = "";
        $post_object = get_post( $patient ); 
        $title = $post_object->post_title;
        $aux_html='<li>
            <div data-closable class="callout alert-callout-border secondary list-patients">
                <div class="row">
                    <div class="large-6 columns">
                        <a href="#" class="name">'.$title.'</a>
                    </div>
                </div>
            </div>
        </li>';
    
        array_push($full_html, $aux_html);
    }
    // $result['msg'] = $test_array;
    $result['msg'] = $full_html;
    $result['success'] = TRUE;
    // $result['msg'] = $array_data_from_txt;
    return $result;
}


function sw_vaciar_consultas($params){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $path = get_home_path();
    $path = $path."/array.txt";

    // esto va sobreescribir lo que haya en el archivo y reemplazar con un string vacio
    file_put_contents($path, "");

    $result['success'] = TRUE;
    $result['msg'] = array("Vaciado");
    return $result;
}


?>