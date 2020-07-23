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

function Footer(){}

function PrintSignature($num)
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
    $right_col_x = 110;
    $base_x = $num*$right_col_x;
    $margin_bottom = -130;
    // $pageWidth = $this->GetPageWidth();
    // $halfWidth = $pageWidth/2; 

    // Pie de página
    $this->SetY($margin_bottom);
    //$this->SetFont('Arial','I',8);
    $this->SetFont('Times','',12);

    //$this->SetTextColor(128);
    $this->SetX($base_x+20);
    $this->Cell(0,12,'...............................................',0,2);
    $this->SetX($base_x+28);
    // $this->Cell(0,5,'Dra. Andrea Zorrilla',0,2);
    $this->Cell(0,5,$client_title." ".$client_name,0,2);
    $this->SetX($base_x+24);
    // $this->Cell(0,5,utf8_decode('Ginecología y Obstetricia'),0,2);
    $this->Cell(0,5,utf8_decode($client_especialidad),0,2);
    $this->SetX($base_x+16);
    // $this->Cell(0,5,utf8_decode('Especialista en TGI y colposcopia'),0,2);
    $this->Cell($base_x+0,5,utf8_decode($client_sub_especialidad),0,2);
    $this->SetX($base_x+35);
    $this->Cell(0,5,utf8_decode('RP: '.$client_registro),0,2);
    $this->SetX(0);
}

function SetCol($col)
{
    // Establecer la posición de una columna dada
    $this->col = $col;
    // $x = 55+$col*65;
    // $x = 10+$col*65;
    $x = 10+$col*110;
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


function ChapterBody($title, $file)
{
    // Abrir fichero de texto
    //$txt = file_get_contents($file);
    $txt = $title.$file;
    
    // Fuente
    $this->SetFont('Times','',12);
    // Imprimir texto en una columna de 6 cm de ancho
    $this->MultiCell(80,5,$txt);
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

function PrintDescription($num, $title, $file)
{
    // Añadir capítulo
    //$this->AddPage();
    //$this->ChapterTitle($num,$title);
    $this->ChapterBody($title, $file);
}

function ChapterTitle($num, $label)
{

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
    $right_col_x = 110;
    $base_x = $right_col_x;
    // Título
    $this->SetFont('Arial','',12);
    $this->SetFillColor(255,128,128);
    //$this->Cell(0,6,"PARTE $num : $label",0,1,'L',true);
    $current_y = $this->GetY();
    
    // $this->Cell(0,$halfWidth,"$label",0,1,'C',true);
    $this->Cell(80 ,6,$title_array[0],0,1,'L',true);
    // $this->SetY($current_y);
    // $this->SetX($right_col_x);
    // $this->Cell(0 ,6,$title_array[1],0,1,'L',true);
    
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

        // Guardar ordenada
        $this->y0 = $this->GetY();
    }
}

function PrintArray($num, $title, $array)
{

    // si es array y todos sus elementos no son vacios
    if (is_array($array) && array_filter($array)){
        // Fuente
        $this->SetFont('Times','',12);
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        $this->MultiCell(80,5,$title);
        //$this->Cell(0,5,$txt);
        //$this->Ln();
        // Guardar ordenada
        $this->y0 = $this->GetY();
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

$creation_date = get_the_date( 'd-m-Y', $studies_id ); //fecha de creacion de colpo puede no ser == a fecha de la consulta debido a que se puede crear una consulta sin colpo y luego editar
$fullname = $name.' '.$lastname;
$datos_personales = $fullname."        Edad: ".$edad_paciente."        Ci: ".$cedula."        Fecha: ".$creation_date;
//$datos_personales1 = $fullname."                        Edad: ".$edad_paciente;
//$datos_personales2 = $cedula."                        Fecha de consulta: ".$creation_date;

$patient_data = array();
$patient_data[] = $fullname;
$patient_data[] = $edad_paciente;
$patient_data[] = $cedula;
$patient_data[] = $creation_date;

$acf_checkbox_array = array();
$acf_description_name_array = array();

  // ACF FIELDS DATA --------------------------------------------
  $checkbox_egcv = get_field('egcv', $studies_id);
  // $egcv_dx = $studies_fields['egcv_dx'][0];
  $egcv_dx = isset($studies_fields['egcv_dx'][0]) ? $studies_fields['egcv_dx'][0] : NULL;
  if($checkbox_egcv!= NULL) {
    $acf_checkbox_array[] = "Ecografía ginecológica transvaginal";
    $acf_description_name_array[] = $egcv_dx;
  }
  
  $checkbox_egva = get_field('egva', $studies_id);
  // $egva_dx = $studies_fields['egva_dx'][0];
  $egva_dx = isset($studies_fields['egva_dx'][0]) ? $studies_fields['egva_dx'][0] : NULL;
  if($checkbox_egva!= NULL) {
    $acf_checkbox_array[] = "Ecografía ginecológica vía abdominal";
    $acf_description_name_array[] = $egva_dx;
  }

  
  $checkbox_ea_st = get_field('ea_st', $studies_id);
  // $ea_st_dx = $studies_fields['ea_st_dx'][0];
  $ea_st_dx = isset($studies_fields['ea_st_dx'][0]) ? $studies_fields['ea_st_dx'][0] : NULL;
  if($checkbox_ea_st!= NULL) {
    $acf_checkbox_array[] = "Ecografía abdominal";
    $acf_description_name_array[] = $ea_st_dx;
  }
  
  $checkbox_ecografia_renal = get_field('ecografia_renal', $studies_id);
  // // $er_dx = $studies_fields['er_dx'][0];
  $er_dx = isset($studies_fields['er_dx'][0]) ? $studies_fields['er_dx'][0] : NULL;
  if($checkbox_ecografia_renal!= NULL) {
    $acf_checkbox_array[] = "Ecografía renal";
    $acf_description_name_array[] = $er_dx;
  }
  

  $checkbox_mdb = get_field('mdb', $studies_id);
  // $mdb_dx = $studies_fields['mdb_dx'][0];
  $mdb_dx = isset($studies_fields['mdb_dx'][0]) ? $studies_fields['mdb_dx'][0] : NULL;
  if($checkbox_mdb!= NULL) {
    $acf_checkbox_array[] = "Mamografía digital bilateral";
    $acf_description_name_array[] = $mdb_dx ;
  }
  
  
  $checkbox_ecografia_mamaria = get_field('ecografia_mamaria', $studies_id);
  // $em_dx = $studies_fields['em_dx'][0];
  $em_dx = isset($studies_fields['em_dx'][0]) ? $studies_fields['em_dx'][0] : NULL;
  if($checkbox_ecografia_mamaria!= NULL) {
    $acf_checkbox_array[] = "Ecografía mamaria";
    $acf_description_name_array[] = $em_dx;
  }
  
  $checkbox_ecografia_obstetrica = get_field('ecografia_obstetrica', $studies_id);
  // $eo_dx = $studies_fields['eo_dx'][0];
  $eo_dx = isset($studies_fields['eo_dx'][0]) ? $studies_fields['eo_dx'][0] : NULL;
  if($checkbox_ecografia_obstetrica!= NULL) {
    $acf_checkbox_array[] = "Ecografía obstétrica";
    $acf_description_name_array[] = $eo_dx;
  }
  
  $checkbox_eodfp = get_field('eodfp', $studies_id);
  // $eodfp_dx = $studies_fields['eodfp_dx'][0];
  $eodfp_dx = isset($studies_fields['eodfp_dx'][0]) ? $studies_fields['eodfp_dx'][0] : NULL;
  if($checkbox_eodfp!= NULL) {
    $acf_checkbox_array[] = "Ecografía obstétrica + Doppler fetal y placentario";
    $acf_description_name_array[] = $eodfp_dx;
  }

  $checkbox_emdm = get_field('emdm', $studies_id);
  // $emdm_dx = $studies_fields['emdm_dx'][0];
  $emdm_dx = isset($studies_fields['emdm_dx'][0]) ? $studies_fields['emdm_dx'][0] : NULL;
  if($checkbox_emdm!= NULL) {
    $acf_checkbox_array[] = "Ecografía morfológica + Doppler materno";
    $acf_description_name_array[] = $emdm_dx;
  }
  
  $checkbox_eomcdm = get_field('eomcdm', $studies_id);
  // $eomcdm_dx = $studies_fields['eomcdm_dx'][0];
  $eomcdm_dx = isset($studies_fields['eomcdm_dx'][0]) ? $studies_fields['eomcdm_dx'][0] : NULL;
  if($checkbox_eomcdm!= NULL) {
    $acf_checkbox_array[] = "Marcadores cromosomicos + Doppler materno";
    $acf_description_name_array[] = $eomcdm_dx;
  }
  
  $checkbox_colposcopia_st = get_field('colposcopia_st', $studies_id);
  //$colposcopia_st_dx = $studies_fields['colposcopia_st_dx'][0];
  $colposcopia_st_dx = isset($studies_fields['colposcopia_st_dx'][0]) ? $studies_fields['colposcopia_st_dx'][0] : NULL;
  if($checkbox_colposcopia_st!= NULL) {
    $acf_checkbox_array[] = "Colposcopía";
    $acf_description_name_array[] = $colposcopia_st_dx;
  }
  
  $checkbox_lec_st = get_field('lec_st', $studies_id);
  //$lec_st_dx = $studies_fields['lec_st_dx'][0];
  $lec_st_dx = isset($studies_fields['lec_st_dx'][0]) ? $studies_fields['lec_st_dx'][0] : NULL;
  if($checkbox_lec_st!= NULL) {
    $acf_checkbox_array[] = "LEC";
    $acf_description_name_array[] = $lec_st_dx;
  }
  
  $checkbox_desintometria_osea = get_field('desintometria_osea', $studies_id);
  //$desintometria_osea_dx = $studies_fields['desintometria_osea_dx'][0];
  $desintometria_osea_dx = isset($studies_fields['desintometria_osea_dx'][0]) ? $studies_fields['desintometria_osea_dx'][0] : NULL;
  if($checkbox_desintometria_osea!= NULL) {
    $acf_checkbox_array[] = "Desintometría Ósea";
    $acf_description_name_array[] = $desintometria_osea_dx;
  }
  
  $checkbox_rtpa = get_field('rtpa', $studies_id);
  //$rtpa_dx = $studies_fields['rtpa_dx'][0];
  $rtpa_dx = isset($studies_fields['rtpa_dx'][0]) ? $studies_fields['rtpa_dx'][0] : NULL;
  if($checkbox_rtpa!= NULL) {
    $acf_checkbox_array[] = "Radiografía de tórax P.A.";
    $acf_description_name_array[] = $rtpa_dx;
  }
  
  $checkbox_electrocardiograma = get_field('electrocardiograma', $studies_id);
  //$electrocardiograma_dx = $studies_fields['electrocardiograma_dx'][0];
  $electrocardiograma_dx = isset($studies_fields['electrocardiograma_dx'][0]) ? $studies_fields['electrocardiograma_dx'][0] : NULL;
  if($checkbox_electrocardiograma!= NULL) {
    $acf_checkbox_array[] = "Electrocardiograma";
    $acf_description_name_array[] = $electrocardiograma_dx;
  }
  
  $checkbox_tapc = get_field('tapc', $studies_id);
  //$tapc_dx = $studies_fields['tapc_dx'][0];
  $tapc_dx = isset($studies_fields['tapc_dx'][0]) ? $studies_fields['tapc_dx'][0] : NULL;
  if($checkbox_tapc!= NULL) {
    $acf_checkbox_array[] = "Tomografía abdomen y pelvis con contraste";
    $acf_description_name_array[] = $tapc_dx;
  }
  
  $checkbox_tsts = get_field('tsts', $studies_id);
  //$tsts_dx = $studies_fields['tsts_dx'][0];
  $tsts_dx = isset($studies_fields['tsts_dx'][0]) ? $studies_fields['tsts_dx'][0] : NULL;
  if($checkbox_tsts!= NULL) {
    $acf_checkbox_array[] = "TAC de silla turca simple";
    $acf_description_name_array[] = $tsts_dx;
  }
  
  $checkbox_tstc = get_field('tstc', $studies_id);
  //$tstc_dx = $studies_fields['tstc_dx'][0];
  $tstc_dx = isset($studies_fields['tstc_dx'][0]) ? $studies_fields['tstc_dx'][0] : NULL;
  if($checkbox_tstc!= NULL) {
    $acf_checkbox_array[] = "TAC de silla turca con Contraste";
    $acf_description_name_array[] = $tstc_dx;
  }
  
  $checkbox_emba = get_field('emba', $studies_id);
  //$emba_dx = $studies_fields['emba_dx'][0];
  $emba_dx = isset($studies_fields['emba_dx'][0]) ? $studies_fields['emba_dx'][0] : NULL;
  if($checkbox_emba!= NULL) {
    $acf_checkbox_array[] = "Ecografía mamaria bilateral + axilar";
    $acf_description_name_array[] = $emba_dx;
  }
  
  $checkbox_pbf = get_field('pbf', $studies_id);
  //$pbf_dx = $studies_fields['pbf_dx'][0];
  $pbf_dx = isset($studies_fields['pbf_dx'][0]) ? $studies_fields['pbf_dx'][0] : NULL;
  if($checkbox_pbf!= NULL) {
    $acf_checkbox_array[] = "Perfil biofísico fetal";
    $acf_description_name_array[] = $pbf_dx;
  }
  
  $checkbox_pbfdfp = get_field('pbfdfp', $studies_id);
  //$pbfdfp_dx = $studies_fields['pbfdfp_dx'][0];
  $pbfdfp_dx = isset($studies_fields['pbfdfp_dx'][0]) ? $studies_fields['pbfdfp_dx'][0] : NULL;
  if($checkbox_pbfdfp!= NULL) {
    $acf_checkbox_array[] = "Perfil biofísico fetal + doppler fetal y placentario";
    $acf_description_name_array[] = $pbfdfp_dx;
  }
  
  $checkbox_mfne = get_field('mfne', $studies_id);
  //$mfne_dx = $studies_fields['mfne_dx'][0];
  $mfne_dx = isset($studies_fields['mfne_dx'][0]) ? $studies_fields['mfne_dx'][0] : NULL;
  if($checkbox_mfne!= NULL) {
    $acf_checkbox_array[] = "Monitoreo fetal no estresante";
    $acf_description_name_array[] = $mfne_dx;
  }
  
  $checkbox_pyc = get_field('pyc', $studies_id);
  //$pyc_dx = $studies_fields['pyc_dx'][0];
  $pyc_dx = isset($studies_fields['pyc_dx'][0]) ? $studies_fields['pyc_dx'][0] : NULL;
  if($checkbox_pyc!= NULL) {
    $acf_checkbox_array[] = "PAP + Colposcopía";
    $acf_description_name_array[] = $pyc_dx;
  }
  
  $checkbox_bcl = get_field('bcl', $studies_id);
  //$bcl_dx = $studies_fields['bcl_dx'][0];
  $bcl_dx = isset($studies_fields['bcl_dx'][0]) ? $studies_fields['bcl_dx'][0] : NULL;
  if($checkbox_bcl!= NULL) {
    $acf_checkbox_array[] = "Biopsia cervical + LEC";
    $acf_description_name_array[] = $bcl_dx;
  }

  //$otros_st = $studies_fields['otros_st'][0];
  $otros_st = isset($studies_fields['otros_st'][0]) ? $studies_fields['otros_st'][0] : NULL;
  if($otros_st!= NULL) {
    $acf_checkbox_array[] = "Otros estudios";
    $acf_description_name_array[] = $otros_st;
  }

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

// vamos a usar i para iterar sobre el $acf_description_name_array
$i=0;
// k es un contador para determianar si hay que agregar una nueva pagina
$k=1;
// side determina si se va a imprimir en la columna izq (0) o la columna der(1)
$side = 0;

$array_length = count($acf_checkbox_array);
// wp_die(var_dump($array_length));
foreach ($acf_checkbox_array as $study_name) {
    // if ($number % 3 == 0) $pdf->AddPage();
    
    $current_y = $pdf->GetY();
    $title_array=["Datos Personales", "Datos Personales"];
    $pdf->SetCol($side);
    $pdf->TitleDatosPersonales($title_array);
    $pdf->PrintHalfPersonData(1,$patient_data);
    $pdf->Ln(4);
    $title_array=["Estudios Solicitados", ""];
    $pdf->TitleDatosPersonales($title_array);
    $pdf->Ln(4);
    // el 3er parametro esta demas y podria eliminar. por pajero no hago
    $pdf->PrintArray(2,utf8_decode($study_name),$acf_checkbox_array);
    $pdf->Ln(2);
    // $pdf->PrintDescription(2,utf8_decode('- Descripción: '), utf8_decode($egcv_dx));
    $pdf->PrintDescription(2,utf8_decode('Descripción: '), utf8_decode($acf_description_name_array[$i]));
    $pdf->PrintSignature($side); 
    $pdf->SetY($current_y);
    
    if ($side == 0) {
        $side = 1;
    }else{
        $side = 0;
    }    
    
    $k++;
    $i++;

    if ( ($k == 3 || $k == 5 || $k == 7 || $k == 9 || $k == 11 || $k == 13 || $k == 15 || $k == 17 || $k == 19 || $k == 21 || $k == 23 || $k == 25 ) && $array_length> $k-1 ) {
        $pdf->AddPage();
    }
    


}




// $pdf->PrintArray(2,utf8_decode(' - Ecografía ginecológica vía abdominal '),$checkbox_egva);
// $pdf->PrintElement(2,utf8_decode(' - Descripción'),$egva_dx);


//El autoPagaBreak esta desactivado y lo hago manualmente para la seccion de imagenes. esi implica que si el texto de la seccion hallazgos es muy larga no hara el salto de pagian automaticamente
//$pdf->AddPage();
ob_start();
$pdf->Output();
ob_end_flush();
?>