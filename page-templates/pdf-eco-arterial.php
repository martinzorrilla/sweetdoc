<?php /* Template Name: pdf-eco-arterial*/
class PDF extends FPDF
{
protected $col = 0; // Columna actual
protected $y0;      // Ordenada de comienzo de la columna




function Header()
{
    // Cabacera
    global $title;
    global $y_actual;
    global $y_new;
    //global $page_height;
    // $image_path = home_url().'/pregnant.jpg';

    // $subtitulo = utf8_decode("Ginecología y Obstetricia");
    // $subtitulo_alterno = utf8_decode("T.G.I. y Colposcopía");
    // $info = utf8_decode("Cel.: (0981) 991 803");


    $client_title = get_field('client_title', 'option');
    $client_title = isset($client_title) && $client_title !="" ? $client_title : "Dr/Dra";
    $client_name = get_field('client_name', 'option');
    $client_name = isset($client_name) && $client_name !="" ? $client_name : "Nombre y Apellido";
    $client_especialidad = get_field('client_especialidad', 'option');
    $client_especialidad = isset($client_especialidad) && $client_especialidad !="" ? $client_especialidad : "Especialidad";
    $client_subtitle = get_field('client_subtitle', 'option');
    $client_phone = get_field('client_phone', 'option');


    // $subtitulo = utf8_decode($client_title.$client_name);
    $title = utf8_decode($client_title." ".$client_name);
    $subtitulo = utf8_decode($client_especialidad);
    $subtitulo_alterno = utf8_decode($client_subtitle);
    $info = utf8_decode("Cel.: ".$client_phone);
    $informe = utf8_decode("ECOGRAFÍA DOPPLER VENOSA");

    $this->SetFont('Times','I',20);
    //color rosa
    $this->SetDrawColor(255,128,128);
    $this->SetFillColor(255, 255, 255);
    $this->SetTextColor(0,84,195);
    $this->SetLineWidth(1);



    $this->Cell(0,10,$title,0,1,'C',false);
    $this->SetFont('Arial','I',14);
    //color azul
    $this->SetTextColor(255,128,128);
    $this->Cell(0,6,$subtitulo,0,1,'C',false);
    $this->Cell(0,6,$subtitulo_alterno,0,1,'C',false);

    $this->SetFont('Arial','B',11);
    $this->SetTextColor(0,0,0);
    $this->Cell(0,6,$info,0,1,'C',false);


    //imprimir una lina a altura 40 de ancho 190
    $this->Line(10, 42, 200, 42); // 20mm from each edge
    $this->Ln(7);

    $this->SetFont('Arial','B',13);
    $this->Cell(0,6,$informe,0,1,'C',false);
    $this->Ln(5);

    // Guardar ordenada
    $this->y0 = $this->GetY();
}

function Footer()
{

    $client_mail = get_field('client_mail', 'option');
    $client_city = get_field('client_city', 'option');


    $this->SetY(-30);
    $this->SetFont('Times','I',12);
    //color rosa
    $this->SetDrawColor(255,128,128);
    $this->SetFillColor(255, 255, 255);
    $this->SetTextColor(0,84,195);
    $this->SetLineWidth(1);
    $this->Line(10, 267, 200, 267); // 20mm from each edge
    $this->Ln(8);
    $this->SetTextColor(0,0,0);
    $this->Cell(0,6,$client_mail,0,1,'C',false);
    $this->Cell(0,6,$client_city,0,1,'C',false);


}

function Firma($num)
{

// DATOS DEL CLIENTE DEL SISTEMA(DOCTOR) guardados en el theme options. en el backend wordpress creado con ACF custom fields
// .
// .
// .
$client_title = get_field('client_title', 'option');
$client_title = isset($client_title) && $client_title !="" ? $client_title : "Dr/Dra";
$client_name = get_field('client_name', 'option');
$client_name = isset($client_name) && $client_name !="" ? $client_name : "Nombre y Apellido";
$client_especialidad = get_field('client_especialidad', 'option');
$client_especialidad = isset($client_especialidad) && $client_especialidad !="" ? $client_especialidad : "Especialidad";
$client_sub_especialidad = get_field('client_sub_especialidad', 'option');
$client_sub_especialidad = isset($client_sub_especialidad) && $client_sub_especialidad !="" ? $client_sub_especialidad : "Sub Especialidad";
$client_registro = get_field('client_registro', 'option');
$client_registro = isset($client_registro) && $client_registro !="" ? $client_registro : "XXXX";
$client_otros = get_field('client_otros', 'option');
$client_otros = isset($client_otros) && $client_otros !="" ? $client_otros : "Otros datos";



    // $this->SetY($altura_actual + $firma_altura);
    $this->Ln($num);
    //$this->SetFont('Arial','I',8);
    $this->SetFont('Times','',12);

    //$this->SetTextColor(128);
    $this->SetX(110);
    $this->Cell(0,12,'...............................................',0,2);
    $this->SetX(113);
    // $this->Cell(0,5,'Dra. Andrea Zorrilla',0,2);
    $this->Cell(0,5,$client_title." ".$client_name,0,2);
    $this->SetX(114); //gineco obstetra (andrea, alba etc)
    // $this->SetX(120); // felbologia yu cirugia
    // $this->Cell(0,5,utf8_decode('Ginecología y Obstetricia'),0,2);
    $this->Cell(0,5,utf8_decode($client_especialidad),0,2);
    $this->SetX(106);
    // $this->Cell(0,5,utf8_decode('Especialista en TGI y colposcopia'),0,2);
    $this->Cell(0,5,utf8_decode($client_sub_especialidad),0,2);
    $this->SetX(125);
    $this->Cell(0,5,utf8_decode('RP: '.$client_registro),0,2);
    $this->SetX(0);
}


function SetCol($col)
{
    // Establecer la posición de una columna dada
    $this->col = $col;
    $x = 50+$col*65;
    $this->SetLeftMargin($x);
    $this->SetX($x);
    $this->SetY(39);
}

function AcceptPageBreak()
{
    // Método que acepta o no el salto automático de página
    if($this->col<2)
    {
        // Ir a la siguiente columna
        $this->SetCol($this->col+1);
        // Establecer la ordenada al principio
        $this->SetY($this->y0);
        // Seguir en esta página
        return false;
    }
    else
    {
        // Volver a la primera columna
        $this->SetCol(0);
        // Salto de página
        return true;
    }
}

function ChapterTitle($num, $label)
{
    // Título
    $this->SetFont('Arial','',12);
    $this->SetFillColor(200,220,255);
    //$this->Cell(0,6,"PARTE $num : $label",0,1,'L',true);
    $this->Cell(0,6,"$label",0,1,'C',true);
    $this->Ln(2);
    // Guardar ordenada
    $this->y0 = $this->GetY();
}

function ChapterBody($file)
{
    // Abrir fichero de texto
    //$txt = file_get_contents($file);
    $txt = $file;

    // Fuente
    $this->SetFont('Times','',12);
    // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
    $this->MultiCell(190,7,$txt);
    //$this->Cell(0,5,$txt);

    $this->Ln();
    // Cita en itálica
    $this->SetFont('','I');
    $this->Cell(0,5,'(fin de la seccion)');
    // ir a la segunda columna
    //$this->SetCol(1);

    $this->Ln(14);
    // Guardar ordenada
    $this->y0 = $this->GetY();
}

function ImageBody($num, $eje_y, $file)
{

    //$this->SetX(20);
    $abscissa = 50; // eje X
    $ordenada = $eje_y; // eje Y
    $image_height = 30;

    $abscissa_inicial = $abscissa; // eje X
    $ordenada_inicial = $ordenada; // eje Y

    switch ($num) {
        case 1:
            $abscissa = $abscissa_inicial + 60;
            $ordenada = $ordenada_inicial;
            break;
        case 2:
            $abscissa = $abscissa_inicial;
            $ordenada = $ordenada_inicial + $image_height;
            break;
        case 3:
            $abscissa = $abscissa_inicial + 60;
            $ordenada = $ordenada_inicial + $image_height;
            break;
        case 4:
            $abscissa = $abscissa_inicial;
            $ordenada = $ordenada_inicial + 2*$image_height + 10;
            break;
    }

    // $this->Image($file,$abscissa,$ordenada,50,30,'JPG');
    $this->Image($file,$abscissa,$ordenada,50,30);
    //$this->Cell(50,10,'texto de prueba'.$num.' -> Y='.$this->GetY(), 1);
    $this->Ln();
}

function PrintChapter($num, $title, $file)
{
    // Añadir capítulo
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    //$this->ChapterBody($file);
}

function PrintSection($num, $title, $file)
{
    // Añadir capítulo
    //$this->AddPage();
    $this->ChapterTitle($num,$title);
    //$this->ChapterBody($file);
}

function PrintElement($num, $title, $file)
{
    if (!empty($file)) {

        $txt = $title.$file;
        // Fuente
        $this->SetFont('Times','',12);
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        $this->MultiCell(190,7,$txt);
        //$this->Cell(0,5,$txt);
        //$this->Ln();
        // Guardar ordenada
        $this->y0 = $this->GetY();
    }
}

function PrintSecondaryTitle($num, $title, $file)
{

        // Fuente
        $this->SetFont('Times','B',12);
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        $this->MultiCell(190,7,$title);
        //$this->Cell(0,5,$txt);
        //$this->Ln();
        // Guardar ordenada
        $this->y0 = $this->GetY();
}

function PrintArray($num, $title, $array, $optional = "")
{
    //primero eliminar los elementos vacios
    $emptyRemoved = array_filter($array);
    // var_dump(empty($emptyRemoved));
    if( !empty($emptyRemoved) ):    
        $this->SetFont('Times','',12);
        
        $aux = array();
        foreach( $emptyRemoved as $element ):
            array_push($aux, utf8_decode($element['label']));
         endforeach;
        
         if (!empty($optional)){
            array_push($aux, utf8_decode("Mide: ".$optional." cm."));   
        }
        
        $emptyRemoved = array_filter($aux);
        // //unir todos los elementos del array en un string
        $arrayToString = implode( ". ", $emptyRemoved );
        
        // antes de imprimir verificamos que alguna opcion haya sido marcada en el checkbox, de lo contrario
        // imprime solo el titulo y ningun campo.
        if ($arrayToString!="") {
            $this->MultiCell(0,7,$title.": ".$arrayToString);
        }
        // $this->MultiCell(0,7,$title.": ".$arrayToString);
        // $this->MultiCell(190,7,$color['label']);

    endif;
}

function PrintEvaluacionGeneral($num, $radiobox_evaluacion_general, $checkbox_motivo_inadecuada)
{

    $arrayToString = "";
    // si es array y todos sus elementos no son vacios
    if (is_array($checkbox_motivo_inadecuada) && array_filter($checkbox_motivo_inadecuada)){
        //primero eliminar los elementos vacios
        $emptyRemoved = array_filter($checkbox_motivo_inadecuada);
        //unir todos los elementos del array en un string
        $arrayToString = implode( ", ", $emptyRemoved );
        //como lo que devuelve son los propios valores de la BD y no los labels, remover los "_"
        $arrayToString = str_replace("_", " ", $arrayToString);
        $arrayToString = ". ".$arrayToString;

        //$pdf->PrintElement(2,$title,$arrayToString);
    }

    if (!empty($radiobox_evaluacion_general)) {
        $txt = " - Evaluacion general: ".$radiobox_evaluacion_general.$arrayToString;;
        $this->SetFont('Times','',12);
        $this->MultiCell(190,7,$txt);
        $this->y0 = $this->GetY();
    }
}


function PrintImage($num, $eje_y, $file)
{
    $this->ImageBody($num, $eje_y, $file);
}

function CheckPageSpaceLeft($page_height, $current_y, $espacio_min_inferior)
{
    //$this->GetPageHeight();
    // $espacio_min_inferior = 115;
    //$espacio_min_inferior = 95;
    $space_left = $page_height - $current_y;
    if ($space_left < $espacio_min_inferior) {
        $this->AddPage();
        return true;
    }
    return false;
}

// recibe array con nomres de los fields a verificar
// retorna true o false
function check_if_radio_values_are_empty($data){
    $has_value = false;
    foreach ($data as $item) 
    {
        $emptyRemoved = array_filter($item);
    
        if(!empty($emptyRemoved) ){
            $has_value = true;
        }
    }
    return $has_value;
}


}//class


// DATOS VATIOS DEL PACIENTE ------------------------------------------------------------------------------------------
// .
// .
// .

$eco_venosa_post_id = $_GET['eco_venosa_id'];
$eco_venosa_data_post = get_post_custom($eco_venosa_post_id);
$patient_id = $eco_venosa_data_post['eco_venosa_related_patient'][0];


$patient_fields = get_post_custom($patient_id);
$name = isset($patient_fields['nombre'][0]) ? $patient_fields['nombre'][0] : NULL;
// $name = $patient_fields['nombre'][0];
$lastname = isset($patient_fields['apellido'][0]) ? $patient_fields['apellido'][0] : NULL;
$cedula = isset($patient_fields['cedula'][0]) ? $patient_fields['cedula'][0] : NULL;
$fecha_de_nacimiento = isset($patient_fields['fecha_de_nacimiento'][0]) ? $patient_fields['fecha_de_nacimiento'][0] : NULL;
$patient_age = calcular_edad($fecha_de_nacimiento);
// si la edad es cero es por que no se cargo ese dato, entonces imprimos en el informe que no hay datos
// $edad_paciente = $fecha_de_nacimiento == NULL?"Sin datos": $patient_age->y;
$e_unidad = "años";
$edad_paciente = $fecha_de_nacimiento == NULL?"Sin datos": $patient_age->y." años";
$creation_date = get_the_date( 'd-m-Y', $eco_venosa_post_id ); //fecha de creacion de eco_venosa puede no ser == a fecha de la consulta debido a que se puede crear una consulta sin eco_venosa y luego editar
$fullname = $name.' '.$lastname;
$datos_personales = $fullname."        Edad: ".$edad_paciente."        Ci: ".$cedula."        Fecha: ".$creation_date;



// DATOS DE LA ECO - LADO IZQUIERDO --------------------------------------------------------------------
// .
// .
// .
$radiobox_vena_femoral_comun = get_field('field_5f4847af9b85f', $eco_venosa_post_id); 
$radiobox_vena_femoral_superficial = get_field('field_5f4847af9c51c', $eco_venosa_post_id);
$radiobox_vena_poplitea = get_field('field_5f4847af9ec07', $eco_venosa_post_id); 
$radiobox_plexo_soleo_y_gemelar = get_field('field_5f48546d30af2', $eco_venosa_post_id); 
$checkbox_union_safeno_femoral = get_field('field_5f4847af9bbd9', $eco_venosa_post_id);
$safeno_femoral_medida = isset($eco_venosa_data_post['safeno_femoral_medida'][0]) ? $eco_venosa_data_post['safeno_femoral_medida'][0] : NULL;

$checkbox_tronco_suprapatelar = get_field('field_5f485918b9757', $eco_venosa_post_id);
$tronco_suprapatelar_medida = isset($eco_venosa_data_post['tronco_suprapatelar_medida'][0]) ? $eco_venosa_data_post['tronco_suprapatelar_medida'][0] : NULL;

$checkbox_tronco_infrapatelar = get_field('field_5f485917b9756', $eco_venosa_post_id);
$tronco_infrapatelar_medida = isset($eco_venosa_data_post['tronco_infrapatelar_medida'][0]) ? $eco_venosa_data_post['tronco_infrapatelar_medida'][0] : NULL;

$checkbox_union_safeno_poplitea = get_field('field_5f485916b9755', $eco_venosa_post_id);
$union_safeno_poplitea_medida = isset($eco_venosa_data_post['union_safeno_poplitea_medida'][0]) ? $eco_venosa_data_post['union_safeno_poplitea_medida'][0] : NULL;

$checkbox_vena_safena_parva = get_field('field_5f485916b9754', $eco_venosa_post_id);
$vena_safena_parva_medida = isset($eco_venosa_data_post['vena_safena_parva_medida'][0]) ? $eco_venosa_data_post['vena_safena_parva_medida'][0] : NULL;

$checkbox_venas_perforantes = get_field('field_5f485915b9753', $eco_venosa_post_id);
$venas_perforantes_medida = isset($eco_venosa_data_post['venas_perforantes_medida'][0]) ? $eco_venosa_data_post['venas_perforantes_medida'][0] : NULL;

$observaciones = isset($eco_venosa_data_post['observaciones'][0]) ? $eco_venosa_data_post['observaciones'][0] : NULL;
$conclusion = isset($eco_venosa_data_post['conclusion'][0]) ? $eco_venosa_data_post['conclusion'][0] : NULL;

//Get images lado izq ----------------------------------------------------------------
//image files
//store the ids of the images post
$max_images = 5;
$images_ids_array = array();
// +1 bc
for ($i=0; $i < $max_images; $i++) {
    $k = $i+1;
    $text = 'eco_venosa_imagen_'.$k;
    // $the_image_id = $eco_venosa_data_post[$text][0];
    $the_image_id = isset($eco_venosa_data_post[$text][0]) ? $eco_venosa_data_post[$text][0] : NULL;

//var_dump($text);
    if ($the_image_id != "" && $the_image_id != NULL) {
        $images_ids_array[$i] = $the_image_id;
    }
}
//var_dump($images_ids_array);

//$image_post_id = $eco_venosa_data_post['eco_venosa_imagen_1'][0];
// Segun mis pruebas medium proporciona una calidad suficiente para el informe con la ventaja de pesar una fraccion de lo que pesaria con la imagen en tamaño "full"
$size = "medium"; // (thumbnail, medium, large, full or custom size)
//$size = "full"; // (thumbnail, medium, large, full or custom size)

$images_array = array();
$images_names = array();
for ($i=0; $i < sizeof($images_ids_array); $i++) {
    //store the names
    $image_post = get_post_custom( $images_ids_array[$i] );
    $images_names[$i] = $image_post["_wp_attached_file"][0];
    //store the actual image
    $images_array[$i] = wp_get_attachment_image_src( $images_ids_array[$i], $size );
}//get images ----------------------------------------------------------------



// DATOS DE LA ECO - LADO DERECHO --------------------------------------------------------------------
// .
// .
// .
$radiobox_vena_femoral_comun_der = get_field('field_5f4dc19d11f62', $eco_venosa_post_id); 
$radiobox_vena_femoral_superficial_der = get_field('field_5f4dc1bd11f63', $eco_venosa_post_id); 
$radiobox_vena_poplitea_der = get_field('field_5f4dc1d311f64', $eco_venosa_post_id); 
$radiobox_plexo_soleo_y_gemelar_der = get_field('field_5f4dc1df11f65', $eco_venosa_post_id); 

$checkbox_union_safeno_femoral_der = get_field('union_safeno_femoral_der', $eco_venosa_post_id);
$safeno_femoral_medida_der = isset($eco_venosa_data_post['safeno_femoral_medida_der'][0]) ? $eco_venosa_data_post['safeno_femoral_medida_der'][0] : NULL;

$checkbox_tronco_suprapatelar_der = get_field('tronco_suprapatelar_der', $eco_venosa_post_id);
$tronco_suprapatelar_medida_der = isset($eco_venosa_data_post['tronco_suprapatelar_medida_der'][0]) ? $eco_venosa_data_post['tronco_suprapatelar_medida_der'][0] : NULL;

$checkbox_tronco_infrapatelar_der = get_field('tronco_infrapatelar_der', $eco_venosa_post_id);
$tronco_infrapatelar_medida_der = isset($eco_venosa_data_post['tronco_infrapatelar_medida_der'][0]) ? $eco_venosa_data_post['tronco_infrapatelar_medida_der'][0] : NULL;

$checkbox_union_safeno_poplitea_der = get_field('union_safeno_poplitea_der', $eco_venosa_post_id);
$union_safeno_poplitea_medida_der = isset($eco_venosa_data_post['union_safeno_poplitea_medida_der'][0]) ? $eco_venosa_data_post['union_safeno_poplitea_medida_der'][0] : NULL;

$checkbox_vena_safena_parva_der = get_field('vena_safena_parva_der', $eco_venosa_post_id);
$vena_safena_parva_medida_der = isset($eco_venosa_data_post['vena_safena_parva_medida_der'][0]) ? $eco_venosa_data_post['vena_safena_parva_medida_der'][0] : NULL;

$checkbox_venas_perforantes_der = get_field('venas_perforantes_der', $eco_venosa_post_id);
$venas_perforantes_medida_der = isset($eco_venosa_data_post['venas_perforantes_medida_der'][0]) ? $eco_venosa_data_post['venas_perforantes_medida_der'][0] : NULL;

$observaciones_der = isset($eco_venosa_data_post['observaciones_der'][0]) ? $eco_venosa_data_post['observaciones_der'][0] : NULL;
$conclusion_der = isset($eco_venosa_data_post['conclusion_der'][0]) ? $eco_venosa_data_post['conclusion_der'][0] : NULL;


//Get images lado izq ----------------------------------------------------------------
    //image files
    //store the ids of the images post
    $max_images_der = 5;
    $images_ids_array_der = array();
    // +1 bc 
    $k = 0;
    for ($i=0; $i < $max_images_der; $i++) {
      $k = $i+1;
      $text = 'eco_venosa_imagen_der_'.$k;
      //$the_image_id = $eco_venosa_data_post[$text][0]; // esta linea de codigo funciona pero da un warning the undefined  index cuando el elemento esta vacio
      // $the_image_id = $eco_venosa_data_post[$text][0];
      $the_image_id = isset($eco_venosa_data_post[$text][0]) ? $eco_venosa_data_post[$text][0] : NULL;

      if ($the_image_id != "" && $the_image_id != NULL) {
         $images_ids_array_der[$i] = $the_image_id;
       }   
    }

    //$image_post_id = $eco_venosa_data_post['eco_venosa_imagen_1'][0];
    $size = "medium"; // (thumbnail, medium, large, full or custom size)
    $images_array_der = array();
    $images_names_der = array();
    for ($i=0; $i < sizeof($images_ids_array_der); $i++) {
      //store the names 
      $image_post = get_post_custom( $images_ids_array_der[$i] );
      $images_names_der[$i] = $image_post["_wp_attached_file"][0];
      //store the actual image
      $images_array_der[$i] = wp_get_attachment_image_src( $images_ids_array_der[$i], $size );
    }






// ------------------------------------------GENERAR EL PDF CON LOS DATOS OBTENIDOS MAS ARRIBA --------------------------------------------
//*
//*
//*
//*
//*
//*
$pdf = new PDF( 'P', 'mm', 'A4' ); // A4, portrait, measurements in mm. A4 es 210 X 297mm
//$pdf->SetAutoPageBreak(true, 100);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetAuthor('Sweetdoc');
$title = 'Eco doppler venoso';
//$title = $fullname;
$pdf->SetTitle($title);

// VERIFICAMOS EL LADO IZQ PRIMERAMENTE PARA VER SI EXISTE ALMENOS ALGUN CAMPO CON DATOS
// antes de imprimir tbm verificar si hay valor en elguno de los fields por cada seccion
// check_if_radio_values_are_empty devuelve true or false. false si todos los campos son vacios
$radio_field_names = array($radiobox_vena_femoral_comun, $radiobox_vena_femoral_superficial, $radiobox_vena_poplitea, $radiobox_plexo_soleo_y_gemelar);
$sistema_venoso_profundo = $pdf->check_if_radio_values_are_empty($radio_field_names);

$radio_field_names = array($checkbox_union_safeno_femoral);
$sistema_venoso_superficial = $pdf->check_if_radio_values_are_empty($radio_field_names);

$radio_field_names = array($checkbox_tronco_suprapatelar, $checkbox_tronco_infrapatelar);
$vena_safena_magna = $pdf->check_if_radio_values_are_empty($radio_field_names);

$radio_field_names = array($checkbox_union_safeno_poplitea, $checkbox_vena_safena_parva);
$vena_safena_menor = $pdf->check_if_radio_values_are_empty($radio_field_names);

$radio_field_names = array($checkbox_venas_perforantes);
$sistemas_perforantes = $pdf->check_if_radio_values_are_empty($radio_field_names);


$imprimir_informe = true;
// si todos son falsos no hay informe que imprimir.
if ($sistema_venoso_profundo == false && $sistema_venoso_superficial == false && $vena_safena_magna == false && $vena_safena_menor == false && $sistemas_perforantes == false && sizeof($images_ids_array)<=0) {
        $imprimir_informe = false;
}
// ATENCION: si da un error el pdf probar verificando que no sea empty el array de los fields "radio" antes de imprimir el "label"

if ($imprimir_informe) {

    $pdf->AddPage();
    $page_height = $pdf->GetPageHeight();
    $pdf->PrintSection(1,'DATOS PERSONALES', $fullname);
    $pdf->PrintElement(2,utf8_decode(' - Nombre: '),utf8_decode($datos_personales));
    $pdf->Ln(4);
    $pdf->PrintSection(2,'MIEMBRO INFERIOR IZQUIERDO', $fullname);

    if ($sistema_venoso_profundo) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Sistema Venoso Profundo'), "");
        $pdf->PrintElement(2,utf8_decode(' - Vena femoral comun: '), utf8_decode( $radiobox_vena_femoral_comun["label"]));
        $pdf->PrintElement(2,utf8_decode(' - Vena femoral superficial: '), utf8_decode( $radiobox_vena_femoral_superficial["label"]));
        $pdf->PrintElement(2,utf8_decode(' - Vena poplítea: '), utf8_decode($radiobox_vena_poplitea["label"]));
        $pdf->PrintElement(2,utf8_decode(' - Plexo soleo y gemelar: '), utf8_decode($radiobox_plexo_soleo_y_gemelar["label"]));
    }

    if ($sistema_venoso_superficial) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Sistema Venoso Superficial'), "");
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Vena Safena mayor'), "");
        // ------------------------------------------------------------------------
        $pdf->PrintArray(2,utf8_decode(' - Unión Safeno-Femoral '),$checkbox_union_safeno_femoral, $safeno_femoral_medida);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$safeno_femoral_medida);
    }


    if ($vena_safena_magna) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Vena Safena Magna (Interna)'), "");
        // ------------------------------------------------------------------------
        $pdf->PrintArray(2,utf8_decode(' - Tronco Suprapatelar '),$checkbox_tronco_suprapatelar, $tronco_suprapatelar_medida);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$tronco_suprapatelar_medida);
        $pdf->PrintArray(2,utf8_decode(' - Tronco Infrapatelar '),$checkbox_tronco_infrapatelar, $tronco_infrapatelar_medida);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$tronco_infrapatelar_medida);
    }


    if ($vena_safena_menor) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Vena Safena Menor'), "");
        // ------------------------------------------------------------------------
        $pdf->PrintArray(2,utf8_decode(' - Unión Safeno-Poplitea '),$checkbox_union_safeno_poplitea, $union_safeno_poplitea_medida);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$union_safeno_poplitea_medida);
        $pdf->PrintArray(2,utf8_decode(' - Vena Safena Parva (Externa) '),$checkbox_vena_safena_parva, $vena_safena_parva_medida);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$vena_safena_parva_medida);
    }


    if ($sistemas_perforantes) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Sistemas Perforantes'), "");
        // ------------------------------------------------------------------------ 
        $pdf->PrintArray(2,utf8_decode(' - Venas Perforantes '),$checkbox_venas_perforantes, $venas_perforantes_medida);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(cm): '),$venas_perforantes_medida);
    }

    $pdf->PrintElement(2,utf8_decode(' - Observaciones: '),$observaciones);
    $pdf->PrintElement(2,utf8_decode(' - Conclusion: '),$conclusion);
    // Fin de impresion de datos --------------------------------------------------------




    // Imprimir las imagenes --------------------------------------------------------
    $custom_y = $pdf->GetY();
    // $custom_y = intval($custom_y);
    //altura firma es la distancia entre la posicion y actual y el margen para imprimir la firma, si no hay imagen
    $altura_firma = 15;
    $k = 0;
    if (sizeof($images_ids_array)>0) {
        //si hay imagen (1 o 2) la distancia con la firma debe ser un poco mayor
        $altura_firma = 40;
        foreach ($images_array as $image) {
            //$pdf->PrintImage(2,'Imagen:',$images_names[$k]);
            //verificamos cuando hay una fila o 2 filas
            if ($k == 0 || $k == 2) {
                // si no hay espacio agrega otra pagina
                $custom_y = $pdf->GetY();
                if ($k == 0) {
                    $new_page = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), 125);
                    $pdf->Ln(3);
                    $pdf->PrintSection(3,utf8_decode('IMÁGENES'), $fullname);
                    $custom_y = $pdf->GetY();
                }
                if ($k == 2) {
                    $new_page = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), 135);
                    $custom_y =  $new_page == true ? 25 :  $pdf->GetY();
                    $altura_firma =  $new_page == true ? 40 :  65;
                }
            }

            $pdf->PrintImage($k,$custom_y + 5,$image[0]);
        $k++;
        }
    }

    $pdf->Firma($altura_firma);


}

// impresion del lado derecho si es que no esta vacio ---------------------------------------------------------------------


// antes de imprimir tbm verificar si hay valor en elguno de los fields por cada seccion
// check_if_radio_values_are_empty devuelve true or false. false si todos los campos son vacios
$radio_field_names = array($radiobox_vena_femoral_comun_der, $radiobox_vena_femoral_superficial_der, $radiobox_vena_poplitea_der, $radiobox_plexo_soleo_y_gemelar_der);
$sistema_venoso_profundo_der = $pdf->check_if_radio_values_are_empty($radio_field_names);

$radio_field_names = array($checkbox_union_safeno_femoral_der);
$sistema_venoso_superficial_der = $pdf->check_if_radio_values_are_empty($radio_field_names);

$radio_field_names = array($checkbox_tronco_suprapatelar_der, $checkbox_tronco_infrapatelar_der);
$vena_safena_magna_der = $pdf->check_if_radio_values_are_empty($radio_field_names);

$radio_field_names = array($checkbox_union_safeno_poplitea_der, $checkbox_vena_safena_parva_der);
$vena_safena_menor_der = $pdf->check_if_radio_values_are_empty($radio_field_names);

$radio_field_names = array($checkbox_venas_perforantes_der);
$sistemas_perforantes_der = $pdf->check_if_radio_values_are_empty($radio_field_names);


$imprimir_informe_der = true;
// si todos son falsos no hay informe que imprimir.
if ($sistema_venoso_profundo_der == false && $sistema_venoso_superficial_der == false && $vena_safena_magna_der == false && $vena_safena_menor_der == false && $sistemas_perforantes_der == false ) {
        $imprimir_informe_der = false;
}
// ATENCION: si da un error el pdf probar verificando que no sea empty el array de los fields "radio" antes de imprimir el "label"

if ($imprimir_informe_der) {

    $pdf->AddPage();
    $page_height = $pdf->GetPageHeight();
    $pdf->PrintSection(1,'DATOS PERSONALES', $fullname);
    $pdf->PrintElement(2,utf8_decode(' - Nombre: '),utf8_decode($datos_personales));
    $pdf->Ln(4);
    $pdf->PrintSection(2,'MIEMBRO INFERIOR DERECHO', $fullname);

    if ($sistema_venoso_profundo_der) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Sistema Venoso Profundo'), "");
        $pdf->PrintElement(2,utf8_decode(' - Vena femoral comun: '), utf8_decode( $radiobox_vena_femoral_comun_der["label"]));
        $pdf->PrintElement(2,utf8_decode(' - Vena femoral superficial: '), utf8_decode( $radiobox_vena_femoral_superficial_der["label"]));
        $pdf->PrintElement(2,utf8_decode(' - Vena poplítea: '), utf8_decode($radiobox_vena_poplitea_der["label"]));
        $pdf->PrintElement(2,utf8_decode(' - Plexo soleo y gemelar: '), utf8_decode($radiobox_plexo_soleo_y_gemelar_der["label"]));
    }

    if ($sistema_venoso_superficial_der) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Sistema Venoso Superficial'), "");
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Vena Safena mayor'), "");
        // ------------------------------------------------------------------------
        $pdf->PrintArray(2,utf8_decode(' - Unión Safeno-Femoral '),$checkbox_union_safeno_femoral_der, $safeno_femoral_medida_der);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$safeno_femoral_medida);
    }


    if ($vena_safena_magna_der) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Vena Safena Magna (Interna)'), "");
        // ------------------------------------------------------------------------
        $pdf->PrintArray(2,utf8_decode(' - Tronco Suprapatelar '),$checkbox_tronco_suprapatelar_der, $tronco_suprapatelar_medida_der);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$tronco_suprapatelar_medida);
        $pdf->PrintArray(2,utf8_decode(' - Tronco Infrapatelar '),$checkbox_tronco_infrapatelar_der, $tronco_infrapatelar_medida_der);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$tronco_infrapatelar_medida);
    }


    if ($vena_safena_menor_der) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Vena Safena Menor'), "");
        // ------------------------------------------------------------------------
        $pdf->PrintArray(2,utf8_decode(' - Unión Safeno-Poplitea '),$checkbox_union_safeno_poplitea_der, $union_safeno_poplitea_medida_der);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$union_safeno_poplitea_medida);
        $pdf->PrintArray(2,utf8_decode(' - Vena Safena Parva (Externa) '),$checkbox_vena_safena_parva_der, $vena_safena_parva_medida_der);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(mm): '),$vena_safena_parva_medida);
    }


    if ($sistemas_perforantes_der) {
        $pdf->PrintSecondaryTitle(2,utf8_decode(' Sistemas Perforantes'), "");
        // ------------------------------------------------------------------------ 
        $pdf->PrintArray(2,utf8_decode(' - Venas Perforantes '),$checkbox_venas_perforantes_der, $venas_perforantes_medida_der);
        // $pdf->PrintElement(2,utf8_decode(' - Medida(cm): '),$venas_perforantes_medida);
    }

    $pdf->PrintElement(2,utf8_decode(' - Observaciones: '),$observaciones_der);
    $pdf->PrintElement(2,utf8_decode(' - Conclusion: '),$conclusion_der);
    // Fin de impresion de datos --------------------------------------------------------

    // Imprimir las imagenes --------------------------------------------------------
    $custom_y = $pdf->GetY();
    // $custom_y = intval($custom_y);
    //altura firma es la distancia entre la posicion y actual y el margen para imprimir la firma, si no hay imagen
    $altura_firma = 15;
    $k = 0;
    if (sizeof($images_ids_array_der)>0) {
        //si hay imagen (1 o 2) la distancia con la firma debe ser un poco mayor
        $altura_firma = 40;
        foreach ($images_array_der as $image) {
            //$pdf->PrintImage(2,'Imagen:',$images_names[$k]);
            //verificamos cuando hay una fila o 2 filas
            if ($k == 0 || $k == 2) {
                // si no hay espacio agrega otra pagina
                $custom_y = $pdf->GetY();
                if ($k == 0) {
                    $new_page = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), 125);
                    $pdf->Ln(3);
                    $pdf->PrintSection(3,utf8_decode('IMÁGENES'), $fullname);
                    $custom_y = $pdf->GetY();
                }
                if ($k == 2) {
                    $new_page = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), 135);
                    $custom_y =  $new_page == true ? 25 :  $pdf->GetY();
                    $altura_firma =  $new_page == true ? 40 :  65;
                }
            }

            $pdf->PrintImage($k,$custom_y + 5,$image[0]);
        $k++;
        }
    }

    $pdf->Firma($altura_firma);


} //if imprimir informe derecho == true





// fin del documento, no importa el lado------------------------------------------------------------------------------------
ob_start();
$pdf->Output();
ob_end_flush();
?>