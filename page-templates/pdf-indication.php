<?php /* Template Name: pdf-indication*/
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


    $this->SetFont('Arial','B',15);
    $this->Ln(30);
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    $this->SetDrawColor(157,165,170); 
    $this->SetFillColor(255, 255, 255);
    $this->SetTextColor(0,0,0);
    $this->SetLineWidth(1);
    //$this->Cell($w,9,$title,1,1,'C',true);
    $this->Ln(20);
    // Guardar ordenada
    $this->y0 = $this->GetY();
}

function Footer()
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

    $left_col_x = 0;
    $right_col_x = 120;
    $margin_bottom = -130;
    // $pageWidth = $this->GetPageWidth();
    // $halfWidth = $pageWidth/2; 

    // Pie de página
    $this->SetY($margin_bottom);
    //$this->SetFont('Arial','I',8);
    $this->SetFont('Times','',12);

    //$this->SetTextColor(128);
    $this->SetX(20);
    $this->Cell(0,12,'...............................................',0,2);
    $this->SetX(28);
    // $this->Cell(0,5,'Dra. Andrea Zorrilla',0,2);
    $this->Cell(0,5,$client_title." ".$client_name,0,2);
    $this->SetX(24);
    // $this->Cell(0,5,utf8_decode('Ginecología y Obstetricia'),0,2);
    $this->Cell(0,5,utf8_decode($client_especialidad),0,2);
    $this->SetX(16);
    // $this->Cell(0,5,utf8_decode('Especialista en TGI y colposcopia'),0,2);
    $this->Cell(0,5,utf8_decode($client_sub_especialidad),0,2);
    $this->SetX(35);
    $this->Cell(0,5,utf8_decode('RP: '.$client_registro),0,2);
    $this->SetX(0);


    $this->SetY($margin_bottom);
    //$this->SetTextColor(128);
    $this->SetX(130);
    $this->Cell(0,12,'...............................................',0,2);
    $this->SetX(138);
    // $this->Cell(0,5,'Dra. Andrea Zorrilla',0,2);
    $this->Cell(0,5,$client_title." ".$client_name,0,2);
    $this->SetX(134);
    // $this->Cell(0,5,utf8_decode('Ginecología y Obstetricia'),0,2);
    $this->Cell(0,5,utf8_decode($client_especialidad),0,2);
    $this->SetX(126);
    // $this->Cell(0,5,utf8_decode('Especialista en TGI y colposcopia'),0,2);
    $this->Cell(0,5,utf8_decode($client_sub_especialidad),0,2);
    $this->SetX(145);
    $this->Cell(0,5,utf8_decode('RP: '.$client_registro),0,2);
    $this->SetX(0);
}


function SetCol($col)
{
    // Establecer la posición de una columna dada
    $this->col = $col;
    $x = 55+$col*65;
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
    $this->MultiCell(80,5,$txt);
    $this->Ln();
    // Cita en itálica
    $this->SetFont('','I');
    $this->Cell(0,6,'(fin de la prescripcion)');
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

    $left_col_x = 0;
    $right_col_x = 120;
    // Título
    $this->SetFont('Arial','',12);
    $this->SetFillColor(255,128,128);
    //$this->Cell(0,6,"PARTE $num : $label",0,1,'L',true);
    $current_y = $this->GetY();
    
    // $this->Cell(0,$halfWidth,"$label",0,1,'C',true);
    $this->Cell(0 ,6,$title_array[0],0,1,'L',true);
    $this->SetY($current_y);
    $this->SetX($right_col_x);
    $this->Cell(0 ,6,$title_array[1],0,1,'L',true);
    
    $this->Ln(4);
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
    $left_col_x = 0;
    $right_col_x = 120;
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
            $this->Cell(0,6, $labels[$i].$data, 0, 1);
        $i++;
        }


        $this->SetY($current_y);
        $this->SetX($right_col_x);
        $i=0;
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        foreach($patient_data as $data){
            $this->Cell(0,6, $labels[$i].$data, 0, 1);
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
// $fecha_de_nacimiento = isset($patient_fields['fecha_de_nacimiento'][0]) ? $patient_fields['fecha_de_nacimiento'][0] : NULL;
// $fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0] !="" && $patient_fields['fecha_de_nacimiento'][0] !=NULL ? $patient_fields['fecha_de_nacimiento'][0] : "";
//$bday = new DateTime('23.8.1988'); // Your date of birth
$bday = new Datetime(date('d.m.y'));
if ($fecha_de_nacimiento != ""){ $bday = new Datetime(date('d.m.y', strtotime($fecha_de_nacimiento)));}
$today = new Datetime(date('d.m.y'));
$diff = $today->diff($bday);
$edad_paciente = $diff->y;
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

$rp = $indication_fields['rp'][0];
$indicaciones = $indication_fields['indicaciones'][0];

// fpdf --------------------------------------------
$pdf = new PDF();

//$pdf->SetAutoPageBreak(true, 100);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetAuthor('Dra. Andrea Zorrilla');
$title = 'Informe Colposcopico';
//$title = $fullname;
//$pdf->SetTitle($title);
$pdf->AddPage();
$page_height = $pdf->GetPageHeight();
$title_array=["Datos Personales", "Datos Personales"];
$pdf->TitleDatosPersonales($title_array);


// $pdf->PrintElement(2,utf8_decode('Nombre: '),$datos_personales);
$pdf->PrintHalfPersonData(1,$patient_data);
$pdf->Ln(4);
$title_array=["R.P.", "Indicaciones"];
$pdf->TitleDatosPersonales($title_array);
// $pdf->PrintSection(2,'INDICACIONES', "");
// $pdf->PrintChapter(1,' R.P.                                                                   -            INDICACIONES', $myfile);




// la pagina esta dividia en dos columnas, todo lo que vaya a chapter 1 se escribe en la parte izq. chapter 2 parte derecha
$pdf->Ln(4);
// guardamos la y donde empieza la RP para poder empezar en el mismo lugar las indicaciones
$current_y = $pdf->GetY();
$pdf->PrintPrescription(1,'R.P.', utf8_decode($rp));
// seteamos la y del capitulo 2 (la parte derecha) con el valor de la y de la parte izquierda
$pdf->SetY($current_y );
$pdf->PrintPrescription(2,'INDICACIONES', utf8_decode($indicaciones));
ob_start();
$pdf->Output();
ob_end_flush();
?>