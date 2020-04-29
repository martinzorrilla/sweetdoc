<?php /* Template Name: pdf-studies*/
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

// function Footer()
// {
//     // Pie de página
//     $this->SetY(-15);
//     $this->SetFont('Arial','I',8);
//     $this->SetTextColor(128);
//     $this->Cell(0,10,'Dra. Andrea Zorrilla - Pagina '.$this->PageNo(),0,0,'C');
// }

function Footer()
{
    // Pie de página
    $this->SetY(-45);
//    $this->SetFont('Arial','I',8);
    $this->SetFont('Times','',12);

    //$this->SetTextColor(128);
    $this->SetX(110);
    $this->Cell(0,12,'...............................................',0,2);
    $this->SetX(118);
    $this->Cell(0,5,'Dra. Andrea Zorrilla',0,2);
    $this->SetX(114);
    $this->Cell(0,5,utf8_decode('Ginecología y Obstetricia'),0,2);
    $this->SetX(106);
    $this->Cell(0,5,utf8_decode('Especialista en TGI y colposcopia'),0,2);
    $this->SetX(125);
    $this->Cell(0,5,utf8_decode('RP: 11.220'),0,2);
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
    $this->Ln(4);
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

    $this->Image($file,$abscissa,$ordenada,50,30,'JPG');
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

        $txt = $title.": ".$file;
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

function PrintArray($num, $title, $array)
{

    // si es array y todos sus elementos no son vacios
    if (is_array($array) && array_filter($array)){
        //primero eliminar los elementos vacios
        $emptyRemoved = array_filter($array);
        //unir todos los elementos del array en un string
        $arrayToString = implode( ", ", $emptyRemoved );
        //como lo que devuelve son los propios valores de la BD y no los labels, remover los "_"
        $arrayToString = str_replace("_", " ", $arrayToString);
        //$pdf->PrintElement(2,$title,$arrayToString);
        
        $txt = $title.": ".$arrayToString;
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
        $arrayToString = " por ".$arrayToString;
        
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

function CheckPageSpaceLeft($page_height, $current_y)
{
    //$this->GetPageHeight();
    $espacio_min_inferior = 115;
    //$espacio_min_inferior = 95;
    $space_left = $page_height - $current_y;
    if ($space_left < $espacio_min_inferior) {
        $this->AddPage();
    }
}

}//class


// pure php data ----------------------------------------------
$studies_id = $_GET['studies_id'];
$studies_fields = get_post_custom($studies_id);

//$colpo_data_post = get_post_custom($colpo_post_id);
$app_id = $studies_fields['related_study'][0];
$patient_id = $studies_fields['study_related_patient'][0];

// $patient_id = sw_get_patient_id_from_app_id($app_id);
// wp_die(var_dump($patient_id));

// $patient_id = $studies_fields['related_study'][0];

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
$creation_date = get_the_date( 'd-m-Y', $colpo_post_id ); //fecha de creacion de colpo puede no ser == a fecha de la consulta debido a que se puede crear una consulta sin colpo y luego editar
$fullname = $name.' '.$lastname;
$datos_personales = $fullname."        Edad: ".$edad_paciente."        Ci: ".$cedula."        Fecha: ".$creation_date;
//$datos_personales1 = $fullname."                        Edad: ".$edad_paciente;
//$datos_personales2 = $cedula."                        Fecha de consulta: ".$creation_date;



  // ACF FIELDS DATA --------------------------------------------
  $checkbox_egcv = get_field('egcv', $studies_id);
  // $egcv_dx = $studies_fields['egcv_dx'][0];
  $egcv_dx = isset($studies_fields['egcv_dx'][0]) ? $studies_fields['egcv_dx'][0] : NULL;

  
  $checkbox_egva = get_field('egva', $studies_id);
  // $egva_dx = $studies_fields['egva_dx'][0];
  $egva_dx = isset($studies_fields['egva_dx'][0]) ? $studies_fields['egva_dx'][0] : NULL;

  
  $checkbox_ea_st = get_field('ea_st', $studies_id);
  // $ea_st_dx = $studies_fields['ea_st_dx'][0];
  $ea_st_dx = isset($studies_fields['ea_st_dx'][0]) ? $studies_fields['ea_st_dx'][0] : NULL;

  
  $checkbox_ecografia_renal = get_field('ecografia_renal', $studies_id);
  // // $er_dx = $studies_fields['er_dx'][0];
  $er_dx = isset($studies_fields['er_dx'][0]) ? $studies_fields['er_dx'][0] : NULL;
  

  $checkbox_mdb = get_field('mdb', $studies_id);
  // $mdb_dx = $studies_fields['mdb_dx'][0];
  $mdb_dx = isset($studies_fields['mdb_dx'][0]) ? $studies_fields['mdb_dx'][0] : NULL;

  
  $checkbox_ecografia_mamaria = get_field('ecografia_mamaria', $studies_id);
  // $em_dx = $studies_fields['em_dx'][0];
  $em_dx = isset($studies_fields['em_dx'][0]) ? $studies_fields['em_dx'][0] : NULL;

  
  $checkbox_ecografia_obstetrica = get_field('ecografia_obstetrica', $studies_id);
  // $eo_dx = $studies_fields['eo_dx'][0];
  $eo_dx = isset($studies_fields['eo_dx'][0]) ? $studies_fields['eo_dx'][0] : NULL;

  
  $checkbox_eodfp = get_field('eodfp', $studies_id);
  // $eodfp_dx = $studies_fields['eodfp_dx'][0];
  $eodfp_dx = isset($studies_fields['eodfp_dx'][0]) ? $studies_fields['eodfp_dx'][0] : NULL;


  $checkbox_emdm = get_field('emdm', $studies_id);
  // $emdm_dx = $studies_fields['emdm_dx'][0];
  $emdm_dx = isset($studies_fields['emdm_dx'][0]) ? $studies_fields['emdm_dx'][0] : NULL;

  
  $checkbox_eomcdm = get_field('eomcdm', $studies_id);
  // $eomcdm_dx = $studies_fields['eomcdm_dx'][0];
  $eomcdm_dx = isset($studies_fields['eomcdm_dx'][0]) ? $studies_fields['eomcdm_dx'][0] : NULL;

  
  $checkbox_colposcopia_st = get_field('colposcopia_st', $studies_id);
  //$colposcopia_st_dx = $studies_fields['colposcopia_st_dx'][0];
  $colposcopia_st_dx = isset($studies_fields['colposcopia_st_dx'][0]) ? $studies_fields['colposcopia_st_dx'][0] : NULL;

  
  $checkbox_lec_st = get_field('lec_st', $studies_id);
  //$lec_st_dx = $studies_fields['lec_st_dx'][0];
  $lec_st_dx = isset($studies_fields['lec_st_dx'][0]) ? $studies_fields['lec_st_dx'][0] : NULL;

  
  $checkbox_desintometria_osea = get_field('desintometria_osea', $studies_id);
  //$desintometria_osea_dx = $studies_fields['desintometria_osea_dx'][0];
  $desintometria_osea_dx = isset($studies_fields['desintometria_osea_dx'][0]) ? $studies_fields['desintometria_osea_dx'][0] : NULL;

  
  $checkbox_rtpa = get_field('rtpa', $studies_id);
  //$rtpa_dx = $studies_fields['rtpa_dx'][0];
  $rtpa_dx = isset($studies_fields['rtpa_dx'][0]) ? $studies_fields['rtpa_dx'][0] : NULL;

  
  $checkbox_electrocardiograma = get_field('electrocardiograma', $studies_id);
  //$electrocardiograma_dx = $studies_fields['electrocardiograma_dx'][0];
  $electrocardiograma_dx = isset($studies_fields['electrocardiograma_dx'][0]) ? $studies_fields['electrocardiograma_dx'][0] : NULL;

  
  $checkbox_tapc = get_field('tapc', $studies_id);
  //$tapc_dx = $studies_fields['tapc_dx'][0];
  $tapc_dx = isset($studies_fields['tapc_dx'][0]) ? $studies_fields['tapc_dx'][0] : NULL;

  
  $checkbox_tsts = get_field('tsts', $studies_id);
  //$tsts_dx = $studies_fields['tsts_dx'][0];
  $tsts_dx = isset($studies_fields['tsts_dx'][0]) ? $studies_fields['tsts_dx'][0] : NULL;

  
  $checkbox_tstc = get_field('tstc', $studies_id);
  //$tstc_dx = $studies_fields['tstc_dx'][0];
  $tstc_dx = isset($studies_fields['tstc_dx'][0]) ? $studies_fields['tstc_dx'][0] : NULL;

  
  $checkbox_emba = get_field('emba', $studies_id);
  //$emba_dx = $studies_fields['emba_dx'][0];
  $emba_dx = isset($studies_fields['emba_dx'][0]) ? $studies_fields['emba_dx'][0] : NULL;

  
  $checkbox_pbf = get_field('pbf', $studies_id);
  //$pbf_dx = $studies_fields['pbf_dx'][0];
  $pbf_dx = isset($studies_fields['pbf_dx'][0]) ? $studies_fields['pbf_dx'][0] : NULL;

  
  $checkbox_pbfdfp = get_field('pbfdfp', $studies_id);
  //$pbfdfp_dx = $studies_fields['pbfdfp_dx'][0];
  $pbfdfp_dx = isset($studies_fields['pbfdfp_dx'][0]) ? $studies_fields['pbfdfp_dx'][0] : NULL;

  
  $checkbox_mfne = get_field('mfne', $studies_id);
  //$mfne_dx = $studies_fields['mfne_dx'][0];
  $mfne_dx = isset($studies_fields['mfne_dx'][0]) ? $studies_fields['mfne_dx'][0] : NULL;

  
  $checkbox_pyc = get_field('pyc', $studies_id);
  //$pyc_dx = $studies_fields['pyc_dx'][0];
  $pyc_dx = isset($studies_fields['pyc_dx'][0]) ? $studies_fields['pyc_dx'][0] : NULL;

  
  $checkbox_bcl = get_field('bcl', $studies_id);
  //$bcl_dx = $studies_fields['bcl_dx'][0];
  $bcl_dx = isset($studies_fields['bcl_dx'][0]) ? $studies_fields['bcl_dx'][0] : NULL;


  //$otros_st = $studies_fields['otros_st'][0];
  $otros_st = isset($studies_fields['otros_st'][0]) ? $studies_fields['otros_st'][0] : NULL;


// fpdf --------------------------------------------
$pdf = new PDF();
//$pdf->SetAutoPageBreak(true, 100);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetAuthor('Dra. Andrea Zorrilla');
$title = 'Solicitud de estudios';
//$title = $fullname;
//$pdf->SetTitle($title);

$pdf->AddPage();
$page_height = $pdf->GetPageHeight();
$pdf->PrintSection(1,'DATOS PERSONALES', $fullname);
$pdf->PrintElement(2,utf8_decode(' - Nombre'),$datos_personales);

$pdf->Ln(4);
$pdf->PrintSection(2,utf8_decode('ESTUDIOS SOLICITADOS'), $fullname);
$pdf->PrintArray(2,utf8_decode(' - Ecografía ginecológica transvaginal'),$checkbox_egcv);
$pdf->PrintElement(2,' - DESCRIPCION',$egcv_dx);

$pdf->AddPage();
$page_height = $pdf->GetPageHeight();
$pdf->PrintSection(1,'DATOS PERSONALES', $fullname);
$pdf->PrintElement(2,utf8_decode(' - Nombre'),$datos_personales);

$pdf->Ln(4);
$pdf->PrintSection(2,utf8_decode('ESTUDIOS SOLICITADOS'), $fullname);
$pdf->PrintArray(2,utf8_decode(' - Ecografía ginecológica vía abdominal '),$checkbox_egva);
$pdf->PrintElement(2,' - DESCRIPCION',$egva_dx);
// $pdf->PrintSecondaryTitle(2,utf8_decode(' - Hallazgos colposcopicos anormales'), "");

//El autoPagaBreak esta desactivado y lo hago manualmente para la seccion de imagenes. esi implica que si el texto de la seccion hallazgos es muy larga no hara el salto de pagian automaticamente
//$pdf->AddPage();

ob_start();
$pdf->Output();
ob_end_flush();
?>