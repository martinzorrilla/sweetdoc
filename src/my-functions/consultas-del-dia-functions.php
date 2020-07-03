<?php  

/*
********************************************************************************
*
      Consultas del Dia
*
********************************************************************************
*/

function sw_cargar_consultas_ajax(){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'accion_inicial'=>'');
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    // $patient_id = 1871; //clara franco
    $seleccion = isset($_POST['seleccion']) && $_POST['seleccion'] != '' ? $_POST['seleccion'] : NULL;
    $eliminar_paciente = isset($_POST['eliminar_paciente']) && $_POST['eliminar_paciente'] != '' ? $_POST['eliminar_paciente'] : NULL;

    // $seleccion = "cargar_consultas";

    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    error_log(json_encode($_POST), 0);

    $params = array(
        "patient_id" => $patient_id,
        "seleccion" => $seleccion
    );

    if ($patient_id != NULL) {
        if($eliminar_paciente != NULL){
            //$result = sw_agregar_paciente_a_consultas($params);
             $result = sw_eliminar_paciente_a_consultas($params);
        }
        else{
            $result = sw_agregar_paciente_a_consultas($params);
        }
    }
    else{
        if ($seleccion == "cargar_consultas") {
            $result = sw_cargar_consultas($params);
        }
    
        if ($seleccion == "vaciar_consultas") {
             $result = sw_vaciar_consultas($params);
        }
    }
    

    wp_die(json_encode($result));
}
add_action( 'wp_ajax_sw_cargar_consultas_ajax', 'sw_cargar_consultas_ajax');

function sw_agregar_paciente_a_consultas($params){

    // $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'accion_inicial'=>'');
    $patient_id = $params['patient_id'];

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

    $result['msg'] = "Paciente agregada a la lista";
    $result['success'] = TRUE;
    // $result['msg'] = $array_data_from_txt;
    return $result;
}

function sw_eliminar_paciente_a_consultas($params){

    // $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'accion_inicial'=>'');
    $patient_id = $params['patient_id'];

    $path = get_home_path();
    $path = $path."/array.txt";
    // $array_data_from_txt = [];

    // traer los datos del archivo txt
    $array_data_from_txt = json_decode(file_get_contents($path), true);
    // $array_data_from_txt = file_get_contents($path);
    // verificar que no sea null
    $array_data_from_txt = isset($array_data_from_txt) ? $array_data_from_txt  : array();

    //elimiar el id del array y cargar este nuevo array en el arxchivo txt
    $array_data_from_txt=array_diff($array_data_from_txt,[$patient_id]);
    file_put_contents($path, json_encode($array_data_from_txt));

    $result['msg'] = array("");
    // $result['msg'] = "Paciente Eliminada de la lista";
    $result['success'] = TRUE;
    // $result['msg'] = $array_data_from_txt;
    $result['accion_inicial'] = "eliminar_paciente";
    return $result;
}

function sw_cargar_consultas($params){

    // $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'accion_inicial'=>'');

    $path = get_home_path();
    $path = $path."/array.txt";
    // $array_data_from_txt = [];

    // traer los datos del archivo txt
    $array_data_from_txt = json_decode(file_get_contents($path), true);
    // $array_data_from_txt = file_get_contents($path);
    // verificar que no sea null
    $array_data_from_txt = isset($array_data_from_txt) ? $array_data_from_txt  : array();
    
    $full_html = array();

    foreach ($array_data_from_txt as $patient) {
        $aux_html = "";
        $post_object = get_post( $patient ); 
        $title = $post_object->post_title;
        $permalink = get_permalink( $patient );
        // $aux_html='<li><a href="'.$permalink.'" class="name">'.$title.'</a><p class="eliminarpacientxx">eliminar</p></li>';
        $aux_html='<li>
            <div data-closable class="callout alert-callout-border secondary list-patients blue-shadow">
                <div class="row">

                    <div class="large-6 medium-12 small-12 columns">
                        <a href="'.$permalink.'" class="black-font">'.$title.'</a>
                    </div>

                    <div class="large-6 medium-12 small-12 columns">
                        <div class="large-6 columns text-right" style="padding-bottom:1em;">
                            <a href="#" class="btn btn-blue button-medium btn-margin-rg llamar-paciente" data-id="'.$patient.'">Llamar a consultorio</a>
                        </div>

                        <div class="large-6 columns text-right">
                        <a href="#" class="btn btn-red button-medium btn-margin-rg eliminar-paciente-del-dia" data-id="'.$patient.'" data-close>Eliminar de la lista</a>
                        </div>
                    </div>

                </div>


            </div>
        </li>';
        

        array_push($full_html, $aux_html);
    }
    // $result['msg'] = $test_array;
    $result['msg'] = $full_html;
    // $result['msg'] = "hola martin";
    $result['success'] = TRUE;
    // $result['msg'] = $array_data_from_txt;
    return $result;
}


function sw_vaciar_consultas($params){

    // $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'accion_inicial'=>'');

    $path = get_home_path();
    $path = $path."/array.txt";

    // esto va sobreescribir lo que haya en el archivo y reemplazar con un string vacio
    file_put_contents($path, "");

    $result['success'] = TRUE;
    // $result['msg'] = array("Vaciado");
    // $result['msg'] = "";
    $result['msg'] = array("<p>Lista de pacientes vaciada</p>");
    $result['accion_inicial'] = "vaciar_consultas";

    return $result;
}


?>