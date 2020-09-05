<?php  

/*
********************************************************************************
*
      Consultas del Dia
*
********************************************************************************
*/

function sw_cargar_consultas_paciente_ajax(){

    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'data'=>[]);
    $patient_id = isset($_POST['patient_id']) && $_POST['patient_id'] != '' ? $_POST['patient_id'] : NULL;
    // $patient_id = 1871; //clara franco
    
    // $seleccion = isset($_POST['seleccion']) && $_POST['seleccion'] != '' ? $_POST['seleccion'] : NULL;
    // $eliminar_paciente = isset($_POST['eliminar_paciente']) && $_POST['eliminar_paciente'] != '' ? $_POST['eliminar_paciente'] : NULL;

    // $seleccion = "cargar_consultas";

    //esto es para debugear el json que recibe desde el frontend. se guarda en el phpError.log de apache
    error_log(json_encode($_POST), 0);

    $params = array(
        "patient_id" => $patient_id,
        "seleccion" => $seleccion
    );
    
    //$result['msg'] = "hola martin ".$patient_id;
    //$result['success'] = TRUE;
    $result = sw_cargar_consultas_paciente($params);

    wp_die(json_encode($result));
}
add_action( 'wp_ajax_sw_cargar_consultas_paciente_ajax', 'sw_cargar_consultas_paciente_ajax');


function sw_cargar_consultas_paciente($params){

    // $result = array('error'=>[], 'success'=>FALSE,'msg'=>'');
    $result = array('error'=>[], 'success'=>FALSE,'msg'=>'', 'data'=>[]);
    $patient_id = $params['patient_id'];





    $appointment_url = home_url().'/consulta/?patient_id=';

    // $colpo_url = home_url().'/colposcopia/?patient_id=';
    $colpo_url = home_url().'/imagenes/?patient_id=';
    $colpo_pdf_url = home_url().'/pdf-colpo/?colpo_id=';
  
    $indicacion_url = home_url().'/indicacion/?patient_id=';
    // $prescription_pdf_url = home_url().'/indicacion-pdf/?indication_id='.$post_id;
    $prescription_pdf_url = home_url().'/indicacion-pdf/?indication_id=';
  
  
    $estudios_url = home_url().'/estudios/?patient_id=';
    // $studies_pdf_url = home_url().'/estudios-pdf/?studies_id='.$post_id;
    $studies_pdf_url = home_url().'/estudios-pdf/?studies_id=';
    
    $laboratorios_url = home_url().'/laboratorios/?patient_id=';
    // $laboratories_pdf_url = home_url().'/laboratorios-pdf/?laboratories_id='.$post_id;
    $laboratories_pdf_url = home_url().'/laboratorios-pdf/?laboratories_id=';


    $eco_venosa_url = home_url().'/eco-venosa/?patient_id=';
    $eco_venosa_pdf_url = home_url().'/eco-venosa-pdf/?eco_venosa_id=';

    $eco_arterial_url = home_url().'/eco-arterial/?patient_id=';
    $eco_arterial_pdf_url = home_url().'/eco-arterial-pdf/?eco_arterial_id=';


    $related = sw_get_related_appointments($patient_id);

/** */

    $table_body = array();
    foreach ($related as $r){
    $filas = "";





        //get the appointment creation date
        $creation_date = get_the_date( 'd-M-Y', $r );    
        //get the colposcopy id and href of this app
        $colpo_patient_array = sw_get_colpo_id($r);
        $colpo_post_id = isset($colpo_patient_array[0]) ? $colpo_patient_array[0] : NULL;
        // $colpo_post_id = $colpo_patient_array[0];
        $colpo_title = $colpo_post_id === NULL ? "Crear" : "Editar";
        $colpo_post_url = $colpo_post_id === NULL ? "&#35" : get_permalink( $colpo_post_id );

        $indication_array = sw_get_indication_id($r);
        $indication_id = isset($indication_array[0]) ? $indication_array[0] : NULL;
        // $indication_id = $indication_array[0];
        $indication_title = $indication_id === NULL ? "Crear" : "Editar";

        $studies_array = sw_get_studies_id($r);
        $studies_id = isset($studies_array[0]) ? $studies_array[0] : NULL;
        // $studies_id = $studies_array[0];
        $studies_title = $studies_id === NULL ? "Crear" : "Editar";
        
        $laboratories_array = sw_get_laboratories_id($r);
        $laboratories_id = isset($laboratories_array[0]) ? $laboratories_array[0] : NULL;
        // $laboratories_id = $laboratories_array[0];
        $laboratories_title = $laboratories_id === NULL ? "Crear" : "Editar";


        $eco_venosa_array = sw_get_eco_venosa_id($r);
        $eco_venosa_id = isset($eco_venosa_array[0]) ? $eco_venosa_array[0] : NULL;
        // $laboratories_id = $laboratories_array[0];
        $eco_venosa_title = $eco_venosa_id === NULL ? "Crear" : "Editar";


        $eco_arterial_array = sw_get_eco_arterial_id($r);
        $eco_arterial_id = isset($eco_arterial_array[0]) ? $eco_arterial_array[0] : NULL;
        // $laboratories_id = $laboratories_array[0];
        $eco_arterial_title = $eco_arterial_id === NULL ? "Crear" : "Editar";

        $filas =
         '<tr> 
         <td scope="row" data-label="ID">
               <a href="#">'.$r.'</a>      
         </td>

            <td scope="row" data-label="Fecha">
                <a href="#">'.$creation_date.'</a>      
            </td>

            <td scope="row" data-label="Consulta">
                <a class="btn btn-green botones-estandard btn-table-consultas" href="'.esc_url( $appointment_url ).$patient_id.'&app_id='.$r.'">Ver</a>      
            </td>
    
            <td scope="row" data-label="Imágenes">
            <a class="btn btn-blue botones-estandard btn-table-consultas" href="'.esc_url( $colpo_url ).$patient_id.'&app_id='.$r.'">'.$colpo_title.'</a>';
            
            if ($colpo_post_id) {
                $filas = $filas.'<br>
                <a class="btn btn-green botones-estandard btn-table-consultas marg-top" href="'.esc_url( $colpo_post_url ).$colpo_post_id.'">Ver Imágenes</a>';
            }
        
            $filas = $filas.'
            </td>
            
            <td scope="row" data-label="Indicación">
            <a class="btn btn-blue botones-estandard btn-table-consultas" href="'.esc_url( $indicacion_url ).$patient_id.'&app_id='.$r.'">'.$indication_title.'</a>';
            
            if ($indication_id) {
                $filas = $filas.'<br>
                <a class="btn btn-green botones-estandard btn-table-consultas marg-top" href="'.esc_url( $prescription_pdf_url ).$indication_id.'">Imprimir PDF</a>';    
            }
            
            $filas = $filas.'
            </td>

            <td scope="row" data-label="Estudios">
            <a class="btn btn-blue botones-estandard btn-table-consultas" href="'.esc_url( $estudios_url ).$patient_id.'&app_id='.$r.'">'.$studies_title.'</a>';

            if ($studies_id) {
                $filas = $filas.'<br>

                <a class="btn btn-green botones-estandard btn-table-consultas marg-top" href="'.esc_url( $studies_pdf_url ).$studies_id.'">Imprimir PDF</a>';                
            }
            $filas = $filas.'
            </td>


            <td scope="row" data-label="Laboratorio">                  
            <a class="btn btn-blue botones-estandard btn-table-consultas" href="'.esc_url( $laboratorios_url ).$patient_id.'&app_id='.$r.'">'.$laboratories_title.'</a>';
        
            if ($laboratories_id) {
                $filas = $filas.'<br>

                <a class="btn btn-green botones-estandard btn-table-consultas marg-top" href="'.esc_url( $laboratories_pdf_url ).$laboratories_id.'">Imprimir PDF</a>';
            }
            $filas = $filas.'
            </td>


            <td scope="row" data-label="Ecografía Venosa">                  
            <a class="btn btn-blue botones-estandard btn-table-consultas" href="'.esc_url( $eco_venosa_url ).$patient_id.'&app_id='.$r.'">'.$eco_venosa_title.'</a>';
        
            if ($eco_venosa_id) {
                $filas = $filas.'<br>

                <a class="btn btn-green botones-estandard btn-table-consultas marg-top" href="'.esc_url( $eco_venosa_pdf_url ).$eco_venosa_id.'">Imprimir PDF</a>';
            }
            $filas = $filas.'
            </td>

            <td scope="row" data-label="Ecografía Arterial">                  
            <a class="btn btn-blue botones-estandard btn-table-consultas" href="'.esc_url( $eco_arterial_url ).$patient_id.'&app_id='.$r.'">'.$eco_arterial_title.'</a>';
        
            if ($eco_arterial_id) {
                $filas = $filas.'<br>

                <a class="btn btn-green botones-estandard btn-table-consultas marg-top" href="'.esc_url( $eco_arterial_pdf_url ).$eco_arterial_id.'">Imprimir PDF</a>';
            }
            $filas = $filas.'
            </td>


        </tr>';

        // $table_body = $table_body.$filas;
        // $filas = "";
        array_push($table_body,$filas);

    } //foreach





/** */

    // $result['msg'] = "  -Patient ID: ".$patient_id;
    $result['data'] = $table_body;
    $result['success'] = TRUE;
    // $result['msg'] = $array_data_from_txt;
    return $result;
}


?>