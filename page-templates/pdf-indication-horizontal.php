<?php /* Template Name: pdf-indication-horizontal*/
// class PDF extends FPDF
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
    //global $page_height;
    // $image_path = home_url().'/pregnant.jpg';

    // $subtitulo = utf8_decode("Ginecología y Obstetricia");
    // $subtitulo_alterno = utf8_decode("T.G.I. y Colposcopía");
    // $info = utf8_decode("Cel.: (0981) 991 803");

    // datos---------------------------------------------------------------------------------------------
    
    $client_title = get_field('client_title', 'option');
    $client_title = isset($client_title) && $client_title !="" ? utf8_decode($client_title) : "Dr/Dra";
    $client_name = get_field('client_name', 'option');
    $client_name = isset($client_name) && $client_name !="" ? utf8_decode( $client_name ): "Nombre y Apellido";
    $client_especialidad = get_field('client_especialidad', 'option');
    $client_especialidad = isset($client_especialidad) && $client_especialidad !="" ? $client_especialidad : "Especialidad";
    $client_subtitle = get_field('client_subtitle', 'option');
    $client_phone = get_field('client_phone', 'option');
    // $subtitulo = utf8_decode($client_title.$client_name);
    $title = utf8_decode($client_title." ".$client_name);
    $subtitulo = utf8_decode($client_especialidad);
    $subtitulo_alterno = utf8_decode($client_subtitle);
    $info = utf8_decode("Cel.: ".$client_phone);
    $informe = utf8_decode("INDICACIÓN MÉDICA");

    $y_inicial = $this->GetY();
    $this->SetCol(0);//muy importante para cuando imprime la segunda hoja
    
    
    // set up for printing the header--------------------------
    $this->SetFont('Times','I',20);
    //color rosa
    $this->SetDrawColor(255,128,128);
    $this->SetFillColor(255, 255, 255);
    $this->SetTextColor(0,84,195);
    $this->SetLineWidth(1);

    $this->Cell(128,10,$title,0,1,'C',false);

    $this->SetFont('Arial','I',14);
    //color azul
    $this->SetTextColor(255,128,128);
    $this->Cell(128,6,$subtitulo,0,1,'C',false);
    $this->Cell(128,6,$subtitulo_alterno,0,1,'C',false);

    $this->SetFont('Arial','B',11);
    $this->SetTextColor(0,0,0);
    $this->Cell(128,6,$info,0,1,'C',false);


    //imprimir una lina a altura 40 
    // $this->Line(10, 42, 200, 42); // 20mm from each edge
    $this->Line(10, 42, 138, 42); // 20mm from each edge
    $this->Ln(7);

    $this->SetFont('Arial','B',13);
    $this->Cell(128,6,$informe,0,1,'C',false);
    $this->Ln(2);
    
    // lado derecho---------------------------------------------------------------------------------
     $this->SetCol(1);
     $this->SetY($y_inicial);


     $this->SetFont('Times','I',20);
     //color rosa
     $this->SetDrawColor(255,128,128);
     $this->SetFillColor(255, 255, 255);
     $this->SetTextColor(0,84,195);
     $this->SetLineWidth(1);

     $this->Cell(128,10,$title,0,1,'C',false);
     $this->SetFont('Arial','I',14);
     //color azul
     $this->SetTextColor(255,128,128);
     $this->Cell(128,6,$subtitulo,0,1,'C',false);
     $this->Cell(128,6,$subtitulo_alterno,0,1,'C',false);

     $this->SetFont('Arial','B',11);
     $this->SetTextColor(0,0,0);
     $this->Cell(128,6,$info,0,1,'C',false);


    // //imprimir una lina a altura 40 
    // // $this->Line(10, 42, 200, 42); // 20mm from each edge
     $this->Line(158, 42, 287, 42); // 20mm from each edge
     $this->Ln(7);

     $this->SetFont('Arial','B',13);
     $this->Cell(128,6,$informe,0,1,'C',false);
     $this->Ln(2);
    
    
    //-------------------------------------------------------------------------------------------------
    //salto despues de la linea separadora
    // $this->Ln(2);
    // Guardar ordenada
    $this->y0 = $this->GetY();
    $this->SetCol(0);

}

function Footer()
{

    $client_mail = get_field('client_mail', 'option');
    $client_city = get_field('client_city', 'option');

    // lado izquierdo
    $this->SetCol(0);
    $this->SetY(-30);
    $this->SetFont('Times','I',12);
    //color rosa
    $this->SetDrawColor(255,128,128);
    $this->SetFillColor(255, 255, 255);
    $this->SetTextColor(0,84,195);
    $this->SetLineWidth(1);
    $this->Line(10, 180, 138, 180); // 20mm from each edge
    $this->Ln(8);
    $this->SetTextColor(0,0,0);
    $this->Cell(128,6,$client_mail,0,1,'C',false);
    $this->Cell(128,6,$client_city,0,1,'C',false);

    // lado derecho
    $this->SetCol(1);
    $this->SetY(-30);
    $this->SetFont('Times','I',12);
    //color rosa
    $this->SetDrawColor(255,128,128);
    $this->SetFillColor(255, 255, 255);
    $this->SetTextColor(0,84,195);
    $this->SetLineWidth(1);
    $this->Line(158, 180, 287, 180); // 20mm from each edge
    $this->Ln(8);
    $this->SetTextColor(0,0,0);
    $this->Cell(128,6,$client_mail,0,1,'C',false);
    $this->Cell(128,6,$client_city,0,1,'C',false);

}


// function FirmaIndicacion($num)
function FirmaIndicacionOLDNOusoVerEnWriteHTML($num)
{
    // DATOS DEL CLIENTE DEL SISTEMA(DOCTOR) guardados en el theme options. en el backend wordpress creado con ACF custom fields
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
    
    $client_sign_offset = get_field('client_sign_offset', 'option');
    $client_sign_offset = isset($client_sign_offset) && $client_sign_offset !="" ? $client_sign_offset : 10;
    // si la columna es 1 la base_x tiene que estar a la derecha
    $sign_side = $this->col;
    $base_x  = $sign_side ? 225 : 75;

    // $this->SetY($altura_actual + $firma_altura);
    $this->Ln($num);
    //$this->SetFont('Arial','I',8);
    $this->SetFont('Times','',12);

    //$this->SetTextColor(128);
    $this->SetX($base_x-2);
    $this->Cell(0,8,'................................................',0,2);
    $this->SetX($base_x+$client_sign_offset);
    // $this->Cell(0,5,'Dra. Andrea Zorrilla',0,2);
    $this->Cell(0,5,$client_title." ".$client_name,0,2);
    $this->SetX($base_x+4);
    // $this->Cell(0,5,utf8_decode('Ginecología y Obstetricia'),0,2);
    $this->Cell(0,5,utf8_decode($client_especialidad),0,2);
    
    // $this->SetX($base_x-3);
    // $this->Cell(0,5,utf8_decode('Especialista en TGI y colposcopia'),0,2);
    // $this->Cell(0,5,utf8_decode($client_sub_especialidad),0,2);
    
    $this->SetX($base_x+15);
    $this->Cell(0,5,utf8_decode('RP: '.$client_registro),0,2);
    $this->SetX(0);
}

function CheckPageSpaceLeft($page_height, $current_y, $espacio_min_inferior)
{
    //$this->GetPageHeight();
    // $espacio_min_inferior = 115;
    //$espacio_min_inferior = 95;
    $space_left = $page_height - $current_y;
    if ($space_left < $espacio_min_inferior) {
        // $this->AddPage('L');
        return true;
    }
    return false;
}

function SetCol($col)
{
    // Establecer la posición de una columna dada
    $this->col = $col;
    // $x = 55+$col*65;
    $x = 10+ $col*148;
    $this->SetLeftMargin($x);
    $this->SetX($x);
    // $this->SetY(39);
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

// function ChapterTitle($num, $label)
// {
//     // Título
//     $this->SetFont('Arial','',12);
//     $this->SetFillColor(200,220,255);
//     //$this->Cell(0,6,"PARTE $num : $label",0,1,'L',true);
//     $this->Cell(0,6,"$label",0,1,'L',true);
//     $this->Ln(4);
//     // Guardar ordenada
//     $this->y0 = $this->GetY();
// }

function ChapterBody($file)
{
    // Abrir fichero de texto
    //$txt = file_get_contents($file);
    $txt = $file;
    
    // Fuente
    $this->SetFont('Times','',12);
    // Imprimir texto en una columna de 6 cm de ancho
    $this->MultiCell(128,5,$txt);
    $this->Ln();

    // Cita en itálica
    // $this->SetFont('','I');
    // $this->Cell(0,6,'(fin de la prescripcion)');
    
    // ir a la segunda columna
    $this->SetCol(1);
    $this->y0 = $this->GetY();

}

function PrintChapter($num, $title, $file)
{
    // Añadir capítulo
    $this->AddPage();
    $this->ChapterTitle($num,$title);
    //$this->ChapterBody($file);
}

function PrintPrescription($num, $title, $file)
{
    // Añadir capítulo
    //$this->AddPage();
    //$this->ChapterTitle($num,$title);
    $this->ChapterBody($file);
}

function ChapterTitle($num, $label)
{
     //$pageWidth = $this->GetPageWidth();
     //$halfWidth = $pageWidth/2;

     $left_col_x = 0;
     $right_col_x = 125;

    // Título
    $this->SetFont('Arial','',12);
    $this->SetFillColor(255,128,128);
    //$this->Cell(0,6,"PARTE $num : $label",0,1,'L',true);
    $current_y = $this->GetY();
    
    // $this->Cell(0,$halfWidth,"$label",0,1,'C',true);
    $this->Cell(0 ,6,$label,0,1,'L',true);
    $this->SetY($current_y);
    $this->SetX($right_col_x);
    $this->Cell(0 ,6,$label,0,1,'L',true);
    
    $this->Ln(4);
    // Guardar ordenada
    $this->y0 = $this->GetY();
}

function TitleDatosPersonales($title_array)
{

    $left_col_x = 10;
    $right_col_x = 158;
    // Título
    $this->SetFont('Arial','',12);
    $this->SetFillColor(255,128,128);
    //$this->Cell(0,6,"PARTE $num : $label",0,1,'L',true);
    $current_y = $this->GetY();
    
    // $this->Cell(0,$halfWidth,"$label",0,1,'C',true);
    $this->Cell(128,6,$title_array[0],0,1,'L',true);
    $this->SetY($current_y);
    $this->SetX($right_col_x);
    $this->Cell(128,6,$title_array[1],0,1,'L',true);
    
    $this->Ln(2);
    // Guardar ordenada
    $this->y0 = $this->GetY();
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
    // $base = $num == 1 ? 0 : 115;
    if (!empty($file)) {

        $txt = $title.": ".$file;
        // Fuente
        $this->SetFont('Times','',12);
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        $this->MultiCell(190,7,$txt);
        // $this->Cell(0,5,$txt);
        // $this->Ln();
        // Guardar ordenada
        $this->y0 = $this->GetY();
    }
}


function PrintHalfPersonData($num, $patient_data)
{
    // $base = $num == 1 ? 0 : 115;
    $left_col_x = 10;
    $right_col_x = 158;
    $i=0;
    $labels = ["Nombre: ", "Edad: ", "CI: ", "Fecha: "];
    
    $current_y = $this->GetY();
    
    //verificar si es array y no esta vacio
    if (is_array($patient_data)) {

        $txt = "";
        // Fuente
        $this->SetFont('Times','',12);
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        foreach($patient_data as $data){
            $this->Cell(128,6, $labels[$i].$data, 0, 1);
        $i++;
        }


        $this->SetY($current_y);
        $this->SetX($right_col_x);
        $i=0;
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        foreach($patient_data as $data){
            $this->Cell(128,6, $labels[$i].$data, 0, 1);
            $this->SetX($right_col_x);
        $i++;
        }

        // $this->MultiCell(190,7,$txt);
        // $this->Ln();
        // Guardar ordenada
        $this->y0 = $this->GetY();
    }
}

}//class

$indication_id = $_GET['indication_id'];
$indication_fields = get_post_custom($indication_id);

$patient_id = $indication_fields['indication_related_patient'][0];
$patient_fields = get_post_custom($patient_id);
$name = isset($patient_fields['nombre'][0]) ? $patient_fields['nombre'][0] : NULL;
// $name = $patient_fields['nombre'][0];  
$lastname = isset($patient_fields['apellido'][0]) ? $patient_fields['apellido'][0] : NULL;
$cedula = isset($patient_fields['cedula'][0]) ? $patient_fields['cedula'][0] : NULL;
$fecha_de_nacimiento = isset($patient_fields['fecha_de_nacimiento'][0]) ? $patient_fields['fecha_de_nacimiento'][0] : NULL;
$patient_age = calcular_edad($fecha_de_nacimiento);
// si la edad es cero es por que no se cargo ese dato, entonces imprimos en el informe que no hay datos
// $edad_paciente = $fecha_de_nacimiento == NULL?"Sin datos": $patient_age->y;

$edad_paciente = $fecha_de_nacimiento == NULL?"Sin datos": $patient_age->y.utf8_decode(" años");

// $fecha_de_nacimiento = isset($patient_fields['fecha_de_nacimiento'][0]) ? $patient_fields['fecha_de_nacimiento'][0] : NULL;
// $fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0] !="" && $patient_fields['fecha_de_nacimiento'][0] !=NULL ? $patient_fields['fecha_de_nacimiento'][0] : "";
//$bday = new DateTime('23.8.1988'); // Your date of birth
// $bday = new Datetime(date('d.m.y'));
// if ($fecha_de_nacimiento != ""){ $bday = new Datetime(date('d.m.y', strtotime($fecha_de_nacimiento)));}
// $today = new Datetime(date('d.m.y'));
// $diff = $today->diff($bday);
// $edad_paciente = $diff->y;


$creation_date = get_the_date( 'd-m-Y', $indication_id ); //fecha de creacion de colpo puede no ser == a fecha de la consulta debido a que se puede crear una consulta sin colpo y luego editar
$fullname = $name.' '.$lastname;
$datos_personales = $fullname."        Edad: ".$edad_paciente."        Ci: ".$cedula."        Fecha: ".$creation_date;

$datos_personales1 = $fullname."                     Edad: ".$edad_paciente;
$datos_personales2 = $cedula."                       Fecha: ".$creation_date;

$patient_data = array();
$patient_data[] = $fullname;
$patient_data[] = $edad_paciente;
$patient_data[] = $cedula;
$patient_data[] = $creation_date;

$rp = utf8_decode( $indication_fields['rp'][0]);

$indicaciones = utf8_decode( $indication_fields['indicaciones'][0]);

//cuando no se escribio nada que no agregue la firma al informe
$rp_is_empty  = empty($rp) ? true : false;
$indicaciones_is_empty  = empty($indicaciones) ? true : false;

// como FPDF no tiene manera de volver a la pagina anterior. tengo que bufferear si el contenido es muy largo
//separo todo el texto en elementos separados por nueve linea. de esa forma puedo ir agragando linea por linea al pdf y verificar si ya no entra en la pagina para crear una nueva. si no funciona probar con "EOL" o "\n\r"
$rp = explode("\n", $rp);
$indicaciones = explode("\n", $indicaciones);

// $rp = array_filter($result);

// fpdf --------------------------------------------
$pdf = new PDF( 'P', 'mm', 'A4' ); // A4, portrait, measurements in mm. A4 es 210 X 297mm
// $pdf = new PDF();

//$pdf->SetAutoPageBreak(true, 100);
// $pdf->SetAutoPageBreak(true, 10);
$pdf->SetAuthor('Sweetdoc');
$title = 'Indicacion';
$pdf->AddPage('L');
// $pdf->AddPage();
$page_height = $pdf->GetPageHeight();
$title_array=["Datos Personales", "Datos Personales"];
$pdf->TitleDatosPersonales($title_array);

// $pdf->PrintElement(2,utf8_decode('Nombre: '),$datos_personales);
$pdf->PrintHalfPersonData(1,$patient_data);
$pdf->Ln(4);
$title_array=["R.P.", "Indicaciones"];
$pdf->TitleDatosPersonales($title_array);
// $pdf->Ln(10);
$altura_firma = 10;
// la pagina esta dividia en dos columnas, todo lo que vaya a chapter 1 se escribe en la parte izq. chapter 2 parte derecha
// guardamos la y donde empieza la RP para poder empezar en el mismo lugar las indicaciones
$current_y = $pdf->GetY();
// $pdf->PrintPrescription(1,'R.P.', utf8_decode($rp));
$page_was_added = false;
$rp_continuation = array();
$pdf->SetFont('Times','',12);
// sizeof($rp);
$k=0;
foreach ($rp as $sentence) {    
    if ($page_was_added) {
        array_push($rp_continuation,$sentence);
    }
    if (!$page_was_added) {
        $sentence = preg_replace("/\r\n|\r|\n/", '', $sentence);
        if (!empty($sentence)) {
            $pdf->MultiCell(128,5,$sentence);
        }
        if ($k+1 == sizeof($rp)) {
            # code...
        }else{
            $page_was_added = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), 70);
        }
    }
    $k++;
}
if(!$rp_is_empty){
    $pdf->FirmaIndicacion($altura_firma);
}
// IMPRIMO LA PARTE DERECHA DE LA PAGINA 1. ES DECIR, INDICACION
$pdf->SetCol(1);
// seteamos la y del capitulo 2 (la parte derecha) con el valor de la y de la parte izquierda
$pdf->SetY($current_y );

// $pdf->PrintPrescription(2,'INDICACIONES', utf8_decode($indicaciones));
$page_was_added_ind = false;
$indicaciones_continuation = array();
$pdf->SetFont('Times','',12);
$k=0;
foreach ($indicaciones as $sentence) {    
    if ($page_was_added_ind) {
        array_push($indicaciones_continuation,$sentence);
    }
    if (!$page_was_added_ind) {
        $sentence = preg_replace("/\r\n|\r|\n/", '', $sentence);
        if (!empty($sentence)) {
            $pdf->MultiCell(128,5,$sentence);
        }
        if ($k+1 == sizeof($rp)) {
            # code...
        }else{
            $page_was_added_ind = $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY(), 70);
        }
    }
    $k++;
}
if(!$indicaciones_is_empty){
    $pdf->FirmaIndicacion($altura_firma);
}



// $pdf->SetCol(0);
// $pdf->AddPage('L');

/**
*           CONTINUACION DE INDICACION SI EL CONTENIDO ES LARGO 
*/
// una vez impreso el rp y la indicacion pasamos a imprimir la continuacion de cada uno si es que no entraba todo el contenido en una sola pagina
if ($page_was_added) {
    // $pdf->SetCol(0); //ya lo hace al final del header
    $pdf->AddPage('L');

    $title_array=["Datos Personales", "Datos Personales"];
    $pdf->TitleDatosPersonales($title_array);    
    $pdf->PrintHalfPersonData(1,$patient_data);

    $pdf->Ln(4);
    $title_array=["R.P.", "Indicaciones"];
    $pdf->TitleDatosPersonales($title_array);

    $pdf->SetFont('Times','',12);
    foreach ($rp_continuation as $sentence) {
        $sentence = preg_replace("/\r\n|\r|\n/", '', $sentence);
        if (!empty($sentence)) {
            $pdf->MultiCell(128,5,$sentence);
        }
        // $pdf->MultiCell(128,5,$sentence);
    }
    $pdf->FirmaIndicacion($altura_firma);
}

// para la continuacion de indicaciones
if ($page_was_added_ind) {
    $pdf->SetCol(1); //ya lo hace al final del header
    $pdf->SetY($current_y );

    if (!$page_was_added) {
        $pdf->AddPage('L');
        $pdf->SetCol(1); //ya lo hace al final del header
    }

    $pdf->SetFont('Times','',12);
    foreach ($indicaciones_continuation as $sentence) {
        $sentence = preg_replace("/\r\n|\r|\n/", '', $sentence);
        if (!empty($sentence)) {
            $pdf->MultiCell(128,5,$sentence);
        }
        // $pdf->MultiCell(128,5,$sentence);
    }
    $pdf->FirmaIndicacion($altura_firma);
}


ob_start();
$pdf->Output();
ob_end_flush();
?>