<?php /* Template Name: pdf-laboratories*/

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
    // $this->SetY($margin_bottom);
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
        // $this->MultiCell(190,7,$txt);
        $this->MultiCell(80,5,$txt);
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



function PrintLabName($title)
{
        $this->SetFont('Times','',12);
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        $this->MultiCell(80,5,$title);
        //$this->Cell(0,5,$txt);
        //$this->Ln();
        // Guardar ordenada
        $this->y0 = $this->GetY();
}

function PrintArray($num, $title, $array)
{

    // si es array y todos sus elementos no son vacios
    if (is_array($array) && array_filter($array)){
        // Fuente
        $this->SetFont('Times','',12);
        // Imprimir texto en una columna de 6 cm de ancho (si el valor es 60)
        $this->MultiCell(80,5,$title);
        $this->MultiCell(80,5,$array);
        //$this->Cell(0,5,$txt);
        //$this->Ln();
        // Guardar ordenada
        $this->y0 = $this->GetY();
    }
}

}//class


// pure php data ----------------------------------------------
$laboratories_id = $_GET['laboratories_id'];

$laboratories_fields = get_post_custom($laboratories_id);

//$colpo_data_post = get_post_custom($colpo_post_id);
$app_id = $laboratories_fields['related_laboratory'][0];
$patient_id = $laboratories_fields['laboratory_related_patient'][0];

// $patient_id = sw_get_patient_id_from_app_id($app_id);
// wp_die(var_dump($patient_id));

// $patient_id = $laboratories_fields['related_study'][0];

$patient_fields = get_post_custom($patient_id);

$name = isset($patient_fields['nombre'][0]) ? $patient_fields['nombre'][0] : NULL;
// $name = $patient_fields['nombre'][0];
$lastname = isset($patient_fields['apellido'][0]) ? $patient_fields['apellido'][0] : NULL;
$cedula = isset($patient_fields['cedula'][0]) ? $patient_fields['cedula'][0] : NULL;
$fecha_de_nacimiento = isset($patient_fields['fecha_de_nacimiento'][0]) ? $patient_fields['fecha_de_nacimiento'][0] : NULL;
$patient_age = calcular_edad($fecha_de_nacimiento);
// si la edad es cero es por que no se cargo ese dato, entonces imprimos en el informe que no hay datos
$edad_paciente = $fecha_de_nacimiento == NULL?"Sin datos": $patient_age->y;

// $fecha_de_nacimiento = isset($patient_fields['fecha_de_nacimiento'][0]) ? $patient_fields['fecha_de_nacimiento'][0] : NULL;
// $fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0] !="" && $patient_fields['fecha_de_nacimiento'][0] !=NULL ? $patient_fields['fecha_de_nacimiento'][0] : "";
//$bday = new DateTime('23.8.1988'); // Your date of birth
// $bday = new Datetime(date('d.m.y'));
// if ($fecha_de_nacimiento != ""){ $bday = new Datetime(date('d.m.y', strtotime($fecha_de_nacimiento)));}
// $today = new Datetime(date('d.m.y'));
// $diff = $today->diff($bday);
// $edad_paciente = $diff->y;


$creation_date = get_the_date( 'd-m-Y', $laboratories_id ); //fecha de creacion de colpo puede no ser == a fecha de la consulta debido a que se puede crear una consulta sin colpo y luego editar
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
  $hemograma_completo = get_field('hemograma_completo', $laboratories_id);
  if($hemograma_completo!= NULL) {
    $acf_checkbox_array[] = "Hemograma completo";
  }

  $tipificacion = get_field('tipificacion', $laboratories_id);
  if($tipificacion!= NULL) {
    $acf_checkbox_array[] = "Tipificación";
  }
  $crasis_sanguinea = get_field('crasis_sanguinea', $laboratories_id);
  if($crasis_sanguinea!= NULL) {
    $acf_checkbox_array[] = "Crasis sanguinea";
  }
  $test_de_coombs_indirecto = get_field('test_de_coombs_indirecto', $laboratories_id);
  if($test_de_coombs_indirecto!= NULL) {
    $acf_checkbox_array[] = "Test de coombs indirecto";
  }
  $vdrl = get_field('vdrl', $laboratories_id);
  if($vdrl!= NULL) {
    $acf_checkbox_array[] = "VDRL";
  }
  $if_p_toxoplasmosis = get_field('if_p_toxoplasmosis', $laboratories_id);
  if($if_p_toxoplasmosis!= NULL) {
    $acf_checkbox_array[] = "IF p Toxoplasmosis IGG/IGM";
  }
  $storch = get_field('storch', $laboratories_id);
  if($storch!= NULL) {
    $acf_checkbox_array[] = "STORCH";
  }
  $hbs_ag = get_field('hbs_ag', $laboratories_id);
  if($hbs_ag!= NULL) {
    $acf_checkbox_array[] = "HBS - Ag";
  }
  $test_de_elisa_hiv = get_field('test_de_elisa_hiv', $laboratories_id);
  if($test_de_elisa_hiv!= NULL) {
    $acf_checkbox_array[] = "Test de Elisa - HIV";
  }
  $chagas_igg_igm = get_field('chagas_igg_igm', $laboratories_id);
  if($chagas_igg_igm!= NULL) {
    $acf_checkbox_array[] = "Chagas IgG - IgM";
  }
  $igmfta = get_field('igmfta', $laboratories_id);
  if($igmfta!= NULL) {
    $acf_checkbox_array[] = "IgMFTA";
  }
  $abs = get_field('abs', $laboratories_id);
  if($abs!= NULL) {
    $acf_checkbox_array[] = "ABS";
  }
  $ft4_tsh = get_field('ft4_tsh', $laboratories_id);
  if($ft4_tsh!= NULL) {
    $acf_checkbox_array[] = "Ft4-TSH";
  }
  $progesterona = get_field('progesterona', $laboratories_id);
  if($progesterona!= NULL) {
    $acf_checkbox_array[] = "Progesterona";
  }
  $estradiol = get_field('estradiol', $laboratories_id);
  if($estradiol!= NULL) {
    $acf_checkbox_array[] = "Estradiol";
  }
  $fsh_lab = get_field('fsh_lab', $laboratories_id);
  if($fsh_lab!= NULL) {
    $acf_checkbox_array[] = "FSH";
  }
  $lh_lab = get_field('lh_lab', $laboratories_id);
  if($lh_lab!= NULL) {
    $acf_checkbox_array[] = "LH";
  }
  $bhch_cualitativo = get_field('bhch_cualitativo', $laboratories_id);
  if($bhch_cualitativo!= NULL) {
    $acf_checkbox_array[] = "BHCH Cualitativo";
  }
  $bhcg_cuantitativo = get_field('bhcg_cuantitativo', $laboratories_id);
  if($bhcg_cuantitativo!= NULL) {
    $acf_checkbox_array[] = "BHCG Cuantitativo";
  }
  $prolactina = get_field('prolactina', $laboratories_id);
  if($prolactina!= NULL) {
    $acf_checkbox_array[] = "Prolactina";
  }
  $testosterona_libre = get_field('testosterona_libre', $laboratories_id);
  if($testosterona_libre!= NULL) {
    $acf_checkbox_array[] = "Testosterona Libre";
  }
  $androstenediona = get_field('androstenediona', $laboratories_id);
  if($androstenediona!= NULL) {
    $acf_checkbox_array[] = "Androstenediona";
  }
  $dhea_lab = get_field('dhea_lab', $laboratories_id);
  if($dhea_lab!= NULL) {
    $acf_checkbox_array[] = "DHEA";
  }
  $amh_lab = get_field('amh_lab', $laboratories_id);
  if($amh_lab!= NULL) {
    $acf_checkbox_array[] = "AMH";
  }
  $simple_lab = get_field('simple_lab', $laboratories_id);
  if($simple_lab!= NULL) {
    $acf_checkbox_array[] = "Orina - Simple";
  }
  $cultivo_y_antibiograma = get_field('cultivo_y_antibiograma', $laboratories_id);
  if($cultivo_y_antibiograma!= NULL) {
    $acf_checkbox_array[] = "Orina - Cultivo y Antibiograma";
  }
  $proteina_24hs = get_field('proteina_24hs', $laboratories_id);
  if($proteina_24hs!= NULL) {
    $acf_checkbox_array[] = "Orina - Proteina 24hs.";
  }
  $vermes_y_protozoarios = get_field('vermes_y_protozoarios', $laboratories_id);
  if($vermes_y_protozoarios!= NULL) {
    $acf_checkbox_array[] = "Heces - Vermes y Protozoarios";
  }
  $cya_heces = get_field('cya_heces', $laboratories_id);
  if($cya_heces!= NULL) {
    $acf_checkbox_array[] = "Heces - Cultivo y Antibiograma";
  }
  $sangre_oculta = get_field('sangre_oculta', $laboratories_id);
  if($sangre_oculta!= NULL) {
    $acf_checkbox_array[] = "Heces - Sangre Oculta";
  }
  $glicemia_en_ayunas = get_field('glicemia_en_ayunas', $laboratories_id);
  if($glicemia_en_ayunas!= NULL) {
    $acf_checkbox_array[] = "Glicemia en ayunas";
  }
  $ttgo = get_field('ttgo', $laboratories_id);
  if($ttgo!= NULL) {
    $acf_checkbox_array[] = "TTGO";
  }
  $urea = get_field('urea', $laboratories_id);
  if($urea!= NULL) {
    $acf_checkbox_array[] = "Urea";
  }
  $creatinina = get_field('creatinina', $laboratories_id);
  if($creatinina!= NULL) {
    $acf_checkbox_array[] = "Creatinina ";
  }
  $ac_urico = get_field('ac_urico', $laboratories_id);
  if($ac_urico!= NULL) {
    $acf_checkbox_array[] = "Ac. Urico";
  }
  $colesterol_vhl = get_field('colesterol_vhl', $laboratories_id);
  if($colesterol_vhl!= NULL) {
    $acf_checkbox_array[] = "Colesterol - (VLDL-HDL-LDL) ";
  }
  $trigliceridos = get_field('trigliceridos', $laboratories_id);
  if($trigliceridos!= NULL) {
    $acf_checkbox_array[] = "Trigliceridos";
  }
  $lipidos_totales = get_field('lipidos_totales', $laboratories_id);
  if($lipidos_totales!= NULL) {
    $acf_checkbox_array[] = "Lípidos Totales";
  }
  $hepatograma = get_field('hepatograma', $laboratories_id);
  if($hepatograma!= NULL) {
    $acf_checkbox_array[] = "Hepatograma";
  }
  $proteinas_tyf = get_field('proteinas_tyf', $laboratories_id);
  if($proteinas_tyf!= NULL) {
    $acf_checkbox_array[] = "Proteínas Totales y Fraccionadas";
  }

  $proteinas_tyfca_125 = get_field('proteinas_tyfca_125', $laboratories_id);
  if($proteinas_tyfca_125!= NULL) {
    $acf_checkbox_array[] = "xxx";
  }

  $ca_125 = get_field('ca_125', $laboratories_id);
  if($ca_125!= NULL) {
    $acf_checkbox_array[] = "CA 125";
  }
  $cea_lab = get_field('cea_lab', $laboratories_id);
  if($cea_lab!= NULL) {
    $acf_checkbox_array[] = "CEA";
  }
  $ca_15_3 = get_field('ca_15_3', $laboratories_id);
  if($ca_15_3!= NULL) {
    $acf_checkbox_array[] = "CA 15-3";
  }
  $pyrilinksd = get_field('pyrilinksd', $laboratories_id);
  if($pyrilinksd!= NULL) {
    $acf_checkbox_array[] = "PyRilinks - D";
  }
  $alfa_fetos_proteinas = get_field('alfa_fetos_proteinas', $laboratories_id);
  if($alfa_fetos_proteinas!= NULL) {
    $acf_checkbox_array[] = "Alfa Feto Proteínas";
  }
  $fta_abs = get_field('fta_abs', $laboratories_id);
  if($fta_abs!= NULL) {
    $acf_checkbox_array[] = "FTA Abs";
  }
  $pcr_lab = get_field('pcr_lab', $laboratories_id);
  if($pcr_lab!= NULL) {
    $acf_checkbox_array[] = "PCR";
  }
  $factor_reumatoideo = get_field('factor_reumatoideo', $laboratories_id);
  if($factor_reumatoideo!= NULL) {
    $acf_checkbox_array[] = "Factor Reumatoideo";
  }
  $lupus_anticoagulante = get_field('lupus_anticoagulante', $laboratories_id);
  if($lupus_anticoagulante!= NULL) {
    $acf_checkbox_array[] = "Lupus (Anticoagulante)";
  }
  $ac_antinucleares = get_field('ac_antinucleares', $laboratories_id);
  if($ac_antinucleares!= NULL) {
    $acf_checkbox_array[] = "Ac. Antinucleares (ANA)";
  }
  $monotest = get_field('monotest', $laboratories_id);
  if($monotest!= NULL) {
    $acf_checkbox_array[] = "Monotest";
  }
  $ac_anti_dna = get_field('ac_anti_dna', $laboratories_id);
  if($ac_anti_dna!= NULL) {
    $acf_checkbox_array[] = "Ac. Anti DNA (ds) ";
  }
  $ac_antifosfolípidos = get_field('ac_antifosfolípidos', $laboratories_id);
  if($ac_antifosfolípidos!= NULL) {
    $acf_checkbox_array[] = "Ac. Antifosfolípidos";
  }
  $vitamina_d25oh = get_field('vitamina_d25oh', $laboratories_id);
  if($vitamina_d25oh!= NULL) {
    $acf_checkbox_array[] = "25 - OH Vitamina D";
  }
  $espermograma_biquimico = get_field('espermograma_biquimico', $laboratories_id);
  if($espermograma_biquimico!= NULL) {
    $acf_checkbox_array[] = "Espermograma + Biquímico";
  }
  $simple_espermograma = get_field('simple_espermograma', $laboratories_id);
  if($simple_espermograma!= NULL) {
    $acf_checkbox_array[] = "Espermograma Simple";
  }
  $cya_espermograma = get_field('cya_espermograma', $laboratories_id);
  if($cya_espermograma!= NULL) {
    $acf_checkbox_array[] = "Cultivo y Antibiograma";
  }
  $vaginal_cultivo = get_field('vaginal_cultivo', $laboratories_id);
  if($vaginal_cultivo!= NULL) {
    $acf_checkbox_array[] = "Vaginal Cultivo";
  }
  $endocervical_cultivo = get_field('endocervical_cultivo', $laboratories_id);
  if($endocervical_cultivo!= NULL) {
    $acf_checkbox_array[] = "Endocervical Cultivo";
  }
  $cultivo_de_chla = get_field('cultivo_de_chla', $laboratories_id);
  if($cultivo_de_chla!= NULL) {
    $acf_checkbox_array[] = "Cultivo de Chlamydias";
  }

  $otros_laboratorios = isset($laboratories_fields['otros_laboratorios'][0]) ? $laboratories_fields['otros_laboratorios'][0] : NULL;
  $diagnostico_laboratorios = isset($laboratories_fields['diagnostico_laboratorios'][0]) ? $laboratories_fields['diagnostico_laboratorios'][0] : NULL;


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



$title_array=["Datos Personales", ""];
$pdf->SetCol($side);
$pdf->TitleDatosPersonales($title_array);
$pdf->PrintHalfPersonData(1,$patient_data);
$pdf->Ln(4);
$title_array=["Laboratorios Solicitados", ""];
$pdf->TitleDatosPersonales($title_array);
$pdf->Ln(4);
$initial_y = $pdf->GetY();
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();


// imprimir todos los checkboex que estan marcados
foreach ($acf_checkbox_array as $study_name) {
    // si todavia hay espacio en esta columna, impprimir, sino saltar a la columna derecha
    if (($page_height - $pdf->GetY()) > 100) {
        $pdf->PrintLabName(utf8_decode($study_name));
        $pdf->Ln(2);
    }else{
        $pdf->SetCol(1);
        $pdf->SetY($current_y);
        $pdf->PrintLabName(utf8_decode($study_name));
        $pdf->Ln(2);
    }
}

// $pdf->SetY($current_y);
$pdf->Ln(6);

if (($page_height - $pdf->GetY()) > 100) {
    if($otros_laboratorios!= NULL && $otros_laboratorios!= "") {
        $pdf->PrintElement(2,utf8_decode("Otros estudios"),$otros_laboratorios);
        $pdf->Ln(4);
      }
    // $pdf->Ln(2);
}else{
    $pdf->SetCol(1);
    $pdf->SetY($current_y);
    $pdf->PrintElement(2,utf8_decode("Otros estudios"),$otros_laboratorios);
    $pdf->Ln(4);
}

if (($page_height - $pdf->GetY()) > 120) {
    if($diagnostico_laboratorios!= NULL && $diagnostico_laboratorios!= "") {
        $pdf->PrintElement(2,utf8_decode("Diagnostico"),$diagnostico_laboratorios);
        $pdf->Ln(2);
      }
}else{
    $pdf->SetCol(1);
    $pdf->SetY($current_y);
    $pdf->PrintElement(2,utf8_decode("Diagnostico"),$diagnostico_laboratorios);
    $pdf->Ln(2);
}



$current_x = $pdf->GetX();
if ($current_x < 80) {
    $side = 0;
}else{
    $side = 1;
}
// wp_die(var_dump($current_x));
// verificamos que exista el espacio de 130 desde abajo de la pagina para imprimir la firma
if (($page_height - $pdf->GetY()) > 130) {
    # code...
    // $pdf->SetY($current_y);
    $pdf->Ln(10);
    $pdf->PrintSignature($side);
}else{
    // ya estamos en la columna derecha, ir a otra pagina
    if ($side == 1) {
        $pdf->AddPage();
        $side = 0;
        $pdf->SetY($initial_y);
        $pdf->Ln(10);
        $pdf->PrintSignature($side);    
    }else{

        $side = 1;
        $pdf->SetY($initial_y);
        $pdf->Ln(10);
        $pdf->PrintSignature($side);
    }


}
// $pdf->SetY($current_y);


// $pdf->PrintArray(2,utf8_decode(' - Ecografía ginecológica vía abdominal '),$checkbox_egva);
// $pdf->PrintElement(2,utf8_decode(' - Descripción'),$egva_dx);


//El autoPagaBreak esta desactivado y lo hago manualmente para la seccion de imagenes. esi implica que si el texto de la seccion hallazgos es muy larga no hara el salto de pagian automaticamente
//$pdf->AddPage();
ob_start();
$pdf->Output();
ob_end_flush();
?>