<?php /* Template Name: pdf-colposcopy-daisy-circulo*/
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
    // $image_path = home_url().'/wp-content/themes/sweetdoc/src/assets/images/circulo-tranparente.png';
    // $this->Image('logo.png',10,6,30);
    // wp-content\themes\sweetdoc\src\assets\images
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
    $informe = utf8_decode("INFORME COLPOSCÓPICO");

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
    $this->Ln(6);
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
    $this->SetX(120);
    // $this->Cell(0,5,'Dra. Andrea Zorrilla',0,2);
    $this->Cell(0,5,$client_title." ".$client_name,0,2);
    $this->SetX(114);
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

function CheckPageSpaceLeft($page_height, $current_y)
{
    //$this->GetPageHeight();
    // $espacio_min_inferior = 115;
    $espacio_min_inferior = 95;
    $space_left = $page_height - $current_y;
    if ($space_left < $espacio_min_inferior) {
        $this->AddPage();
    }
}

}//class


// DATOS VATIOS DEL PACIENTE ------------------------------------------------------------------------------------------
// .
// .
// .
$colpo_post_id = $_GET['colpo_id'];
$colpo_data_post = get_post_custom($colpo_post_id);
$patient_id = $colpo_data_post['colpo_related_patient'][0];

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



// $fecha_de_nacimiento = isset($patient_fields['fecha_de_nacimiento'][0]) ? $patient_fields['fecha_de_nacimiento'][0] : NULL;
// $fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0] !="" && $patient_fields['fecha_de_nacimiento'][0] !=NULL ? $patient_fields['fecha_de_nacimiento'][0] : "";
//$bday = new DateTime('23.8.1988'); // Your date of birth
// $bday = new Datetime(date('d.m.y'));
// if ($fecha_de_nacimiento != ""){ $bday = new Datetime(date('d.m.y', strtotime($fecha_de_nacimiento)));}
// $today = new Datetime(date('d.m.y'));
// $diff = $today->diff($bday);
// $edad_paciente = $diff->y;


$creation_date = get_the_date( 'd-m-Y', $colpo_post_id ); //fecha de creacion de colpo puede no ser == a fecha de la consulta debido a que se puede crear una consulta sin colpo y luego editar
$fullname = $name.' '.$lastname;
$datos_personales = $fullname."        Edad: ".$edad_paciente."        Ci: ".$cedula."        Fecha: ".$creation_date;
//$datos_personales1 = $fullname."                        Edad: ".$edad_paciente;
//$datos_personales2 = $cedula."                        Fecha de consulta: ".$creation_date;







// DATOS DE LA COSLPOSCOPIA ------------------------------------------------------------------------------------------
// .
// .
// .
// $macroscopia = $colpo_data_post['macroscopia'][0];
$macroscopia = isset($colpo_data_post['macroscopia'][0]) ? $colpo_data_post['macroscopia'][0] : NULL;
// $colposcopia = $colpo_data_post['colposcopia'][0];
$colposcopia = isset($colpo_data_post['colposcopia'][0]) ? $colpo_data_post['colposcopia'][0] : NULL;
$radiobox_evaluacion_general = get_field('evaluacion_general', $colpo_post_id); 
$checkbox_motivo_inadecuada = get_field('motivo_inadecuada', $colpo_post_id);
$radiobox_union_escamo_columnar = get_field('union_escamo_columnar', $colpo_post_id);
$radiobox_zona_de_transformacion = get_field('zona_de_transformacion', $colpo_post_id);
// $colposcopicos_normales = $colpo_data_post['colposcopicos_normales'][0];
$checkbox_colposcopicos_normales = get_field('colposcopicos_normales', $colpo_post_id);
$checkbox_colposcopicos_anormales_grado_1 = get_field('colposcopicos_anormales_grado_1', $colpo_post_id);
$checkbox_colposcopicos_anormales_grado_2 = get_field('colposcopicos_anormales_grado_2', $colpo_post_id);
$checkbox_colposcopicos_anormales_no_especificos = get_field('colposcopicos_anormales_no_especificos', $colpo_post_id);
// $colposcopicos_anormales_ubicacion = $colpo_data_post['colposcopicos_anormales_ubicacion'][0];
$colposcopicos_anormales_ubicacion = isset($colpo_data_post['colposcopicos_anormales_ubicacion'][0]) ? $colpo_data_post['colposcopicos_anormales_ubicacion'][0] : NULL;
$checkbox_sospecha_de_invasion = get_field('sospecha_de_invasion', $colpo_post_id);
$checkbox_hallazgos_varios = get_field('hallazgos_varios', $colpo_post_id);
$checkbox_examen_de_vyv = get_field('examen_de_vyv', $colpo_post_id);
// $examen_de_vyv_descripcion = $colpo_data_post['examen_de_vyv_descripcion'][0];
$examen_de_vyv_descripcion = isset($colpo_data_post['examen_de_vyv_descripcion'][0]) ? $colpo_data_post['examen_de_vyv_descripcion'][0] : NULL;
$radiobox_colposcopicos_anormales_test_de_schiller = get_field('colposcopicos_anormales_test_de_schiller', $colpo_post_id);
$checkbox_test_de_schiller_lugol = get_field('test_de_schiller_lugol', $colpo_post_id);
// $sugerencias = $colpo_data_post['sugerencias'][0];
$sugerencias = isset($colpo_data_post['sugerencias'][0]) ? $colpo_data_post['sugerencias'][0] : NULL;
// wp_die(var_dump(array_filter($checkbox_colposcopicos_anormales_grado_2)));
//  wp_die(var_dump($edad_paciente));


//Get images ----------------------------------------------------------------
//image files
//store the ids of the images post
$max_images = 5;
$images_ids_array = array();
// +1 bc 
for ($i=0; $i < $max_images; $i++) {
    $k = $i+1;
    $text = 'colpo_imagen_'.$k;
    // $the_image_id = $colpo_data_post[$text][0];
    $the_image_id = isset($colpo_data_post[$text][0]) ? $colpo_data_post[$text][0] : NULL;

//var_dump($text);
    if ($the_image_id != "" && $the_image_id != NULL) {
        $images_ids_array[$i] = $the_image_id;
    }   
}
//var_dump($images_ids_array);

//$image_post_id = $colpo_data_post['colpo_imagen_1'][0];
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



// fpdf --------------------------------------------
// $pdf = new PDF();
$pdf = new PDF( 'P', 'mm', 'A4' ); // A4, portrait, measurements in mm. A4 es 210 X 297mm
//$pdf->SetAutoPageBreak(true, 100);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetAuthor('Sweetdoc');
$title = 'Informe Colposcopico';
//$title = $fullname;
$pdf->SetTitle($title);
$pdf->AddPage();
$page_height = $pdf->GetPageHeight();
$pdf->PrintSection(1,'DATOS PERSONALES', $fullname);
$pdf->PrintElement(2,utf8_decode(' - Nombre'),utf8_decode($datos_personales));
$pdf->Ln(4);
$pdf->PrintSection(2,'HALLAZGOS', $fullname);


$pdf->PrintElement(2,utf8_decode(' - Macroscopía'),$macroscopia);
$pdf->PrintElement(2,utf8_decode(' - Colposcopía'),$colposcopia);
$pdf->PrintEvaluacionGeneral(2,$radiobox_evaluacion_general,$checkbox_motivo_inadecuada);
// $pdf->PrintElement(2,utf8_decode(' - Visibilidad de la unión escamo columnar'),$radiobox_union_escamo_columnar);
$pdf->PrintElement(2,utf8_decode(' - Visibilidad de la unión escamo columnar'),str_replace("_", " ", $radiobox_union_escamo_columnar));
$pdf->PrintElement(2,utf8_decode(' - Zona de transformación'), str_replace("_", " ", $radiobox_zona_de_transformacion));
$pdf->PrintArray(2,utf8_decode(' - Hallazgos colposcopicos normales'),$checkbox_colposcopicos_normales);

// imprimir el titulo de hllazgos anormales solo si alguno de ellos tiene datos
if ( (is_array($checkbox_colposcopicos_anormales_grado_1) && array_filter($checkbox_colposcopicos_anormales_grado_1))  ||  (is_array($checkbox_colposcopicos_anormales_grado_2) && array_filter($checkbox_colposcopicos_anormales_grado_2))  || 
(is_array($checkbox_colposcopicos_anormales_no_especificos) && array_filter($checkbox_colposcopicos_anormales_no_especificos))
){
    $pdf->PrintSecondaryTitle(2,utf8_decode(' - Hallazgos colposcopicos anormales'), "");
}
$pdf->PrintArray(2,utf8_decode(' - Grado 1'),$checkbox_colposcopicos_anormales_grado_1);
$pdf->PrintArray(2,utf8_decode(' - Grado 2'),$checkbox_colposcopicos_anormales_grado_2);
$pdf->PrintArray(2,utf8_decode(' - No especificos'),$checkbox_colposcopicos_anormales_no_especificos);
$pdf->PrintElement(2,utf8_decode(' - Ubicación'), str_replace("_", " ", $colposcopicos_anormales_ubicacion));
$pdf->PrintArray(2,utf8_decode(' - Sospecha de invasión'),$checkbox_sospecha_de_invasion);
$pdf->PrintArray(2,utf8_decode(' - Hallazgos varios'),$checkbox_hallazgos_varios);
$pdf->PrintArray(2,utf8_decode(' - Exámen de vulva y vagina'),$checkbox_examen_de_vyv);
$pdf->PrintElement(2,utf8_decode(' - Descripción del exámen'),$examen_de_vyv_descripcion);
$pdf->PrintElement(2,utf8_decode(' - Test de Schiller '),$radiobox_colposcopicos_anormales_test_de_schiller);
$pdf->PrintArray(2,utf8_decode(' - Lugol'),$checkbox_test_de_schiller_lugol);
$pdf->PrintElement(2,utf8_decode(' - Sugerencias'),$sugerencias);

//El autoPagaBreak esta desactivado y lo hago manualmente para la seccion de imagenes. esi implica que si el texto de la seccion hallazgos es muy larga no hara el salto de pagian automaticamente
//$pdf->AddPage();

// Output the images ---------------
$custom_y = $pdf->GetY();
$altura_firma = 45; 
$k == 0;
$print_circle = true;
if (sizeof($images_ids_array)>0) {  
    $k = 0; 
    $altura_firma = 55;
    $print_circle = false; 
    foreach ($images_array as $image) { 
        //$pdf->PrintImage(2,'Imagen:',$images_names[$k]);
        if ($k == 0 || $k == 2) {
            $pdf->CheckPageSpaceLeft($page_height, $pdf->GetY());
            if ($k == 0) {
                $pdf->Ln(3);
                $pdf->PrintSection(3,utf8_decode(' IMÁGENES'), $fullname);
            }   
            $custom_y = $pdf->GetY(); 
        }
        
        $pdf->PrintImage($k,$custom_y + 5,$image[0]);
    $k++;
    } 
}

// luego de insertar los campos, verificar si hay espacio para las imagenes y la firma
$pdf->CheckPageSpaceLeft($page_height, $pdf->GetY());

// print the circle only if there is no images
if ($print_circle) {
    $image_path = home_url().'/wp-content/themes/sweetdoc/src/assets/images/circulo-tranparente.png';
    $pdf->Image($image_path,90,$pdf->GetY()+5,30);
}
// $pdf->Ln(14);

// recibe k xq la altura de la firma depende de la cantidad de imagenes
// $pdf->Firma(sizeof($images_ids_array));
if ($k == 3 || $k == 4) {
    $altura_firma = 65; 
}
$pdf->Firma($altura_firma);

ob_start();
$pdf->Output();
ob_end_flush();
?>