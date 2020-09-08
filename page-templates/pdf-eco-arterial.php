<?php /* Template Name: pdf-eco-arterial*/
// class PDF extends FPDF
// class PDF extends PDF_WriteTag
//agregue un script llamado writeTag en la carpeta fpdf e hice include del archivo en functions.php.
class PDF extends PDF_HTML

{
protected $col = 0; // Columna actual
protected $y0;      // Ordenada de comienzo de la columna




function Header()
{
    // Cabacera
    global $title;
    global $y_actual;
    global $y_new;
    global $page_height;
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
    $informe = utf8_decode("DOPPLER DE SISTEMA ARTERIAL");

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

$client_offset = get_field('client_sign_offset', 'option');
$client_offset = isset($client_offset) && $client_offset !="" ? intval($client_offset) : 113;

    // $this->SetY($altura_actual + $firma_altura);
    $this->Ln($num);
    //$this->SetFont('Arial','I',8);
    $this->SetFont('Times','',12);

    //$this->SetTextColor(128);
    $this->SetX(110);
    $this->Cell(0,12,'...............................................',0,2);
    $this->SetX($client_offset);
    // $this->Cell(0,5,'Dra. Andrea Zorrilla',0,2);
    $this->Cell(0,5,$client_title." ".$client_name,0,2);
    $this->SetX(114); //gineco obstetra (andrea, alba etc)
    // $this->SetX(120); // felbologia yu cirugia
    // $this->Cell(0,5,utf8_decode('Ginecología y Obstetricia'),0,2);
    $this->Cell(0,5,utf8_decode($client_especialidad),0,2);
    // $this->SetX(106);
    // $this->Cell(0,5,utf8_decode('Especialista en TGI y colposcopia'),0,2);
    // $this->Cell(0,5,utf8_decode($client_sub_especialidad),0,2);
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

function PrintElementWr($num, $title, $file)
{
    if (!empty($file)) {

        $txt = $title.utf8_decode($file);
        // Fuente
        $this->SetFont('Times','',12);   
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        $this->MultiCell(190,7,$txt);
        // $pdf->WriteTag(0,7,$txt,0,"L",0,0);

        //$this->Cell(0,5,$txt);
        //$this->Ln();
        // Guardar ordenada
        $this->y0 = $this->GetY();
    }
}

function PrintElement($num, $title, $file)
{
    if (!empty($file)) {

        // $txt = $title.utf8_decode($file);
        $txt = $title.utf8_decode($file);
        
        // Fuente
        $this->SetFont('Times','',12);   
        $this->WriteHTML($txt);
        $this->Ln();
        // Guardar ordenada
        $this->y0 = $this->GetY();
    }
}

function PrintElementWithSpaceChecker($num, $title, $file)
{
    if (!empty($file)) {

        // $this->SetFont('Times','',12);
        $txt = $title.utf8_decode($file);
        // $this->MultiCell(190,7,$txt);

        // $page_height = $this->$page_height;
        $page_height = $this->GetPageHeight();

        $page_was_added = false;
        $rp = array();
        $rp_continuation = array();
        $page_was_added = $this->CheckPageSpaceLeft($page_height, $this->GetY(), 70);
        $rp = explode("\n", $txt);

        $k=0;
        foreach ($rp as $sentence) {    
            if ($page_was_added) {
                array_push($rp_continuation,$sentence);
            }
            if (!$page_was_added) {
                $sentence = preg_replace("/\r\n|\r|\n/", '', $sentence);
                if (!empty($sentence)) {
                    // $pdf->MultiCell(128,5,$sentence);
                    $this->MultiCell(190,7,$sentence);
                }
                if ($k+1 == sizeof($rp)) {
                    # code...
                }else{
                    $page_was_added = $this->CheckPageSpaceLeft($page_height, $this->GetY(), 70);
                }
            }
            $k++;
        }



        // $this->y0 = $this->GetY();
    }


}//function




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
    $title_lenght = $this->GetStringWidth($title) + 3;
    $page_margin = 10;
    if( !empty($emptyRemoved) ):    
        $this->SetFont('Times','',12);
        
        // $this->SetFont('Times','B',12);
        // $this->Cell($title_lenght,7,$title.": ", 0 ,0);
        // $this->SetX(0);

        $aux = array();
        foreach( $emptyRemoved as $element ):
            array_push($aux, utf8_decode($element['label']));
         endforeach;
        
        //  if (!empty($optional)){
        //     array_push($aux, utf8_decode("Mide: ".$optional." cm."));   
        // }
        
        $emptyRemoved = array_filter($aux);
        // //unir todos los elementos del array en un string
        $arrayToString = implode( ". ", $emptyRemoved );
        
        // antes de imprimir verificamos que alguna opcion haya sido marcada en el checkbox, de lo contrario
        // imprime solo el titulo y ningun campo.
        if ($arrayToString!="") {

            // $this->MultiCell(0,7,$title.": ".$arrayToString);
            $this->SetFont('Times','',12);   
            $this->WriteHTML($title.": ".$arrayToString);
            $this->Ln();
            // Guardar ordenada
            $this->y0 = $this->GetY();   
        }


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

$eco_arterial_post_id = $_GET['eco_arterial_id'];
$eco_arterial_data_post = get_post_custom($eco_arterial_post_id);
$patient_id = $eco_arterial_data_post['eco_arterial_related_patient'][0];


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
$creation_date = get_the_date( 'd-m-Y', $eco_arterial_post_id ); //fecha de creacion de eco_arterial puede no ser == a fecha de la consulta debido a que se puede crear una consulta sin eco_arterial y luego editar
$fullname = $name.' '.$lastname;
$datos_personales = $fullname."        Edad: ".$edad_paciente."        Ci: ".$cedula."        Fecha: ".$creation_date;



// DATOS DE LA ECO - LADO IZQUIERDO --------------------------------------------------------------------
// .
// .
// .
$checkbox_arteria_femoral_comun = get_field('arteria_femoral_comun', $eco_arterial_post_id);
$afc_obs = isset($eco_arterial_data_post['afc_obs'][0]) ? $eco_arterial_data_post['afc_obs'][0] : NULL;
$checkbox_afc_flujo = get_field('afc_flujo', $eco_arterial_post_id);

$checkbox_arteria_femoral_profunda = get_field('arteria_femoral_profunda', $eco_arterial_post_id);
$afp_obs = isset($eco_arterial_data_post['afp_obs'][0]) ? $eco_arterial_data_post['afp_obs'][0] : NULL;
$checkbox_afp_flujo = get_field('afp_flujo', $eco_arterial_post_id);


$checkbox_arteria_femoral_superficial = get_field('arteria_femoral_superficial', $eco_arterial_post_id);
$afs_obs = isset($eco_arterial_data_post['afs_obs'][0]) ? $eco_arterial_data_post['afs_obs'][0] : NULL;
$checkbox_afs_flujo = get_field('afs_flujo', $eco_arterial_post_id);


$checkbox_arteria_poplitea = get_field('arteria_poplitea', $eco_arterial_post_id);
$ap_obs = isset($eco_arterial_data_post['ap_obs'][0]) ? $eco_arterial_data_post['ap_obs'][0] : NULL;
$checkbox_ap_flujo = get_field('ap_flujo', $eco_arterial_post_id);


$checkbox_arteria_tibial_anterior = get_field('arteria_tibial_anterior', $eco_arterial_post_id);
$ata_obs = isset($eco_arterial_data_post['ata_obs'][0]) ? $eco_arterial_data_post['ata_obs'][0] : NULL;
$checkbox_ata_flujo = get_field('ata_flujo', $eco_arterial_post_id);

$checkbox_arteria_tibial_posterior = get_field('arteria_tibial_posterior', $eco_arterial_post_id);
$atp_obs = isset($eco_arterial_data_post['atp_obs'][0]) ? $eco_arterial_data_post['atp_obs'][0] : NULL;
$checkbox_atp_flujo = get_field('atp_flujo', $eco_arterial_post_id);

$checkbox_arteria_fibular_peroneal = get_field('arteria_fibular_peroneal', $eco_arterial_post_id);
$arfipe_obs = isset($eco_arterial_data_post['arfipe_obs'][0]) ? $eco_arterial_data_post['arfipe_obs'][0] : NULL;
$checkbox_arfipe_flujo = get_field('arfipe_flujo', $eco_arterial_post_id);

$checkbox_arteria_pedia = get_field('arteria_pedia', $eco_arterial_post_id);
$arpe_obs = isset($eco_arterial_data_post['arpe_obs'][0]) ? $eco_arterial_data_post['arpe_obs'][0] : NULL;
$checkbox_arpe_flujo = get_field('arpe_flujo', $eco_arterial_post_id);

$conclusion = isset($eco_arterial_data_post['conclusion'][0]) ? $eco_arterial_data_post['conclusion'][0] : NULL;

//Get images lado izq ----------------------------------------------------------------
//image files
//store the ids of the images post
$max_images = 5;
$images_ids_array = array();
// +1 bc
for ($i=0; $i < $max_images; $i++) {
    $k = $i+1;
    $text = 'eco_arterial_imagen_'.$k;
    // $the_image_id = $eco_arterial_data_post[$text][0];
    $the_image_id = isset($eco_arterial_data_post[$text][0]) ? $eco_arterial_data_post[$text][0] : NULL;

//var_dump($text);
    if ($the_image_id != "" && $the_image_id != NULL) {
        $images_ids_array[$i] = $the_image_id;
    }
}
//var_dump($images_ids_array);

//$image_post_id = $eco_arterial_data_post['eco_arterial_imagen_1'][0];
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
$checkbox_arteria_femoral_comun_der =  get_field('arteria_femoral_comun_der', $eco_arterial_post_id);
$afc_obs_der =  isset($eco_arterial_data_post['afc_obs_der'][0]) ? $eco_arterial_data_post['afc_obs_der'][0] : NULL;
$checkbox_afc_flujo_der =  get_field('afc_flujo_der', $eco_arterial_post_id);

$checkbox_arteria_femoral_profunda_der =  get_field('arteria_femoral_profunda_der', $eco_arterial_post_id);
// fsdfsdf
$afp_obs_der =  isset($eco_arterial_data_post['afp_obs_der'][0]) ? $eco_arterial_data_post['afp_obs_der'][0] : NULL;
$checkbox_afp_flujo_der =  get_field('afp_flujo_der', $eco_arterial_post_id);


$checkbox_arteria_femoral_superficial_der =  get_field('arteria_femoral_superficial_der', $eco_arterial_post_id);
$afs_obs_der =  isset($eco_arterial_data_post['afs_obs_der'][0]) ? $eco_arterial_data_post['afs_obs_der'][0] : NULL;
$checkbox_afs_flujo_der =  get_field('afs_flujo_der', $eco_arterial_post_id);


$checkbox_arteria_poplitea_der =  get_field('arteria_poplitea_der', $eco_arterial_post_id);
$ap_obs_der =  isset($eco_arterial_data_post['ap_obs_der'][0]) ? $eco_arterial_data_post['ap_obs_der'][0] : NULL;
$checkbox_ap_flujo_der =  get_field('ap_flujo_der', $eco_arterial_post_id);


$checkbox_arteria_tibial_anterior_der =  get_field('arteria_tibial_anterior_der', $eco_arterial_post_id);
$ata_obs_der =  isset($eco_arterial_data_post['ata_obs_der'][0]) ? $eco_arterial_data_post['ata_obs_der'][0] : NULL;
$checkbox_ata_flujo_der =  get_field('ata_flujo_der', $eco_arterial_post_id);

$checkbox_arteria_tibial_posterior_der =  get_field('arteria_tibial_posterior_der', $eco_arterial_post_id);
$atp_obs_der =  isset($eco_arterial_data_post['atp_obs_der'][0]) ? $eco_arterial_data_post['atp_obs_der'][0] : NULL;
$checkbox_atp_flujo_der =  get_field('atp_flujo_der', $eco_arterial_post_id);

$checkbox_arteria_fibular_peroneal_der =  get_field('arteria_fibular_peroneal_der', $eco_arterial_post_id);
$arfipe_obs_der =  isset($eco_arterial_data_post['arfipe_obs_der'][0]) ? $eco_arterial_data_post['arfipe_obs_der'][0] : NULL;
$checkbox_arfipe_flujo_der =  get_field('arfipe_flujo_der', $eco_arterial_post_id);

$checkbox_arteria_pedia_der =  get_field('arteria_pedia_der', $eco_arterial_post_id);
$arpe_obs_der =  isset($eco_arterial_data_post['arpe_obs_der'][0]) ? $eco_arterial_data_post['arpe_obs_der'][0] : NULL;
$checkbox_arpe_flujo_der =  get_field('arpe_flujo_der', $eco_arterial_post_id);

$conclusion_der =  isset($eco_arterial_data_post['conclusion_der'][0]) ? $eco_arterial_data_post['conclusion_der'][0] : NULL;


//Get images lado izq ----------------------------------------------------------------
    //image files
    //store the ids of the images post
    $max_images_der = 5;
    $images_ids_array_der = array();
    // +1 bc 
    $k = 0;
    for ($i=0; $i < $max_images_der; $i++) {
      $k = $i+1;
      $text = 'eco_arterial_imagen_der_'.$k;
      //$the_image_id = $eco_arterial_data_post[$text][0]; // esta linea de codigo funciona pero da un warning the undefined  index cuando el elemento esta vacio
      // $the_image_id = $eco_arterial_data_post[$text][0];
      $the_image_id = isset($eco_arterial_data_post[$text][0]) ? $eco_arterial_data_post[$text][0] : NULL;

      if ($the_image_id != "" && $the_image_id != NULL) {
         $images_ids_array_der[$i] = $the_image_id;
       }   
    }

    //$image_post_id = $eco_arterial_data_post['eco_arterial_imagen_1'][0];
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
// $pdf= new PDF_WriteTag();
// $pdf= new PDF();
$pdf= new PDF('P', 'mm', 'A4');
// $pdf = new PDF( 'P', 'mm', 'A4' ); // A4, portrait, measurements in mm. A4 es 210 X 297mm
//$pdf->SetAutoPageBreak(true, 100);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetAuthor('Sweetdoc');
$title = 'Eco doppler arterial';
//$title = $fullname;
$pdf->SetTitle($title);
$page_height = $pdf->GetPageHeight();


// VERIFICAMOS EL LADO IZQ PRIMERAMENTE PARA VER SI EXISTE ALMENOS ALGUN CAMPO CON DATOS
// antes de imprimir tbm verificar si hay valor en elguno de los fields por cada seccion
// check_if_radio_values_are_empty devuelve true or false. false si todos los campos son vacios

$radio_field_names = array(
   $checkbox_arteria_femoral_comun,
   $checkbox_arteria_femoral_profunda,
   $checkbox_arteria_femoral_superficial,
   $checkbox_arteria_poplitea,
   $checkbox_arteria_tibial_anterior,
   $checkbox_arteria_tibial_posterior,
   $checkbox_arteria_fibular_peroneal,
   $checkbox_arteria_pedia
);

$sistema_arterial = $pdf->check_if_radio_values_are_empty($radio_field_names);

$imprimir_informe = true;
// si todos son falsos no hay informe que imprimir.
if ($sistema_arterial == false  && sizeof($images_ids_array)<=0) {
        $imprimir_informe = false;
}
// ATENCION: si da un error el pdf probar verificando que no sea empty el array de los fields "radio" antes de imprimir el "label"

if ($imprimir_informe) {

    $pdf->AddPage();
    // $page_height = $pdf->GetPageHeight();
    
    $need_to_add_page = false;
    //cuando hay campo decripcion o "otros" podemos escribir hasta mas abajo y no preocpuarnos tanto por el espacio de la firma
    $min_height = 85;
    if(empty($conclusion) ){
      $min_height = 75;
    }

    $pdf->PrintSection(1,'DATOS PERSONALES', $fullname);
    $pdf->PrintElement(2,utf8_decode('Nombre: '),$datos_personales);
    // $pdf->PrintElement(2,utf8_decode(' - Nombre: '),utf8_decode($datos_personales));
    $pdf->Ln(4);
    $pdf->PrintSection(2,'MIEMBRO INFERIOR IZQUIERDO', $fullname);

    if ($sistema_arterial) {
        // $pdf->PrintSecondaryTitle(2,utf8_decode(' titulo izq'), "");
        // ------------------------------------------------------------------------

        $pdf->PrintArray(2,utf8_decode('<b>Artéria Femoral Común</b>'),$checkbox_arteria_femoral_comun);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_afc_flujo);
        $pdf->PrintElement(2,"<b>Observaciones:</b> ",$afc_obs); 

        $pdf->PrintArray(2,utf8_decode('<b>Artéria Femoral Profunda</b>'),$checkbox_arteria_femoral_profunda);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_afp_flujo);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$afp_obs);

        // $need_to_add_page = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), $min_height);
        // $need_to_add_page = false;


        $pdf->PrintArray(2,utf8_decode('<b>Artéria Femoral Superficial</b>'),$checkbox_arteria_femoral_superficial);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_afs_flujo);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$afs_obs);
        // $pdf->PrintElementWithSpaceChecker(2,utf8_decode("<b>Observaciones:</b> "),$afs_obs);

        // $need_to_add_page = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), $min_height);

        $pdf->PrintArray(2,utf8_decode('<b>Arteria poplítea</b>'),$checkbox_arteria_poplitea);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_ap_flujo);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$ap_obs);

        // $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), $min_height);

        $pdf->PrintArray(2,utf8_decode('<b>Artéria Tíbial Anterior</b>'),$checkbox_arteria_tibial_anterior);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_ata_flujo);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$ata_obs);

        // $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), $min_height);

        $pdf->PrintArray(2,utf8_decode('<b>Artéria Tibial Posterior</b>'),$checkbox_arteria_tibial_posterior);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_atp_flujo);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$atp_obs);

        // $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), $min_height);


        $pdf->PrintArray(2,utf8_decode('<b>Artéria fibular (Peroneal)</b>'),$checkbox_arteria_fibular_peroneal);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_arfipe_flujo);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$arfipe_obs);

        $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), $min_height);

        $pdf->PrintArray(2,utf8_decode('<b>Artéria Pedia</b>'),$checkbox_arteria_pedia);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_arpe_flujo);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$arpe_obs);


    }

    $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), $min_height);
    
    if (!empty($conclusion)) {
        $pdf->PrintSecondaryTitle(2,utf8_decode('Conclusión: '), "");
        $pdf->PrintElement(2,'',$conclusion);
    }
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
                    $new_page = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), 120);
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


$radio_field_names = array(
    $checkbox_arteria_femoral_comun_der,
    $checkbox_arteria_femoral_profunda_der,
    $checkbox_arteria_femoral_superficial_der,
    $checkbox_arteria_poplitea_der,
    $checkbox_arteria_tibial_anterior_der,
    $checkbox_arteria_tibial_posterior_der,
    $checkbox_arteria_fibular_peroneal_der,
    $checkbox_arteria_pedia_der
 );
 
 $sistema_arterial_der = $pdf->check_if_radio_values_are_empty($radio_field_names);
 
 $imprimir_informe_der = true;
 // si todos son falsos no hay informe que imprimir.
 if ($sistema_arterial_der == false  && sizeof($images_ids_array_der)<=0) {
         $imprimir_informe_der = false;
 }

if ($imprimir_informe_der) {

    $pdf->AddPage();
    $page_height = $pdf->GetPageHeight();
    $need_to_add_page = false;
    //cuando hay campo decripcion o "otros" podemos escribir hasta mas abajo y no preocpuarnos tanto por el espacio de la firma
    $min_height = 85;
    if(empty($conclusion) ){
      $min_height = 75;
    }

    $pdf->PrintSection(1,'DATOS PERSONALES', $fullname);
    $pdf->PrintElement(2,utf8_decode('Nombre: '),$datos_personales);
    // $pdf->PrintElement(2,utf8_decode(' - Nombre: '),utf8_decode($datos_personales));
    $pdf->Ln(4);
    $pdf->PrintSection(2,'MIEMBRO INFERIOR DERECHO', $fullname);

    if ($sistema_arterial_der) {
        // $pdf->PrintSecondaryTitle(2,utf8_decode(' titulo der'), "");
        // ------------------------------------------------------------------------
        $pdf->PrintArray(2,utf8_decode('<b>Artéria Femoral Común</b>'),$checkbox_arteria_femoral_comun_der);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_afc_flujo_der);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$afc_obs_der);

        $pdf->PrintArray(2,utf8_decode('<b>Artéria Femoral Profunda</b>'),$checkbox_arteria_femoral_profunda_der);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_afp_flujo_der);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$afp_obs_der);


        $pdf->PrintArray(2,utf8_decode('<b>Artéria Femoral Superficial</b>'),$checkbox_arteria_femoral_superficial_der);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_afs_flujo_der);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$afs_obs_der);


        $pdf->PrintArray(2,utf8_decode('<b>Arteria poplítea</b>'),$checkbox_arteria_poplitea_der);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_ap_flujo_der);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$ap_obs_der);

        $pdf->PrintArray(2,utf8_decode('<b>Artéria Tíbial Anterior</b>'),$checkbox_arteria_tibial_anterior_der);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_ata_flujo_der);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$ata_obs_der);

        $pdf->PrintArray(2,utf8_decode('<b>Artéria Tibial Posterior</b>'),$checkbox_arteria_tibial_posterior_der);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_atp_flujo_der);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$atp_obs_der);

        $pdf->PrintArray(2,utf8_decode('<b>Artéria fibular (Peroneal)</b>'),$checkbox_arteria_fibular_peroneal_der);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_arfipe_flujo_der);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$arfipe_obs_der);

        $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), $min_height);

        $pdf->PrintArray(2,utf8_decode('<b>Artéria Pedia</b>'),$checkbox_arteria_pedia_der);
        $pdf->PrintArray(2,utf8_decode('<b>Flujo</b>'),$checkbox_arpe_flujo_der);
        $pdf->PrintElement(2,utf8_decode("<b>Observaciones:</b> "),$arpe_obs_der);


    }

    $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), $min_height);

    if (!empty($conclusion_der)) {
        $pdf->PrintSecondaryTitle(2,utf8_decode('Conclusión: '), "");
        $pdf->PrintElement(2,'',$conclusion_der);
    }
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
                    $new_page = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), 120);
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