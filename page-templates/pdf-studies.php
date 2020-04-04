<?php /* Template Name: pdf-studies*/
class PDF extends FPDF
{
protected $col = 0; // Columna actual
protected $y0;      // Ordenada de comienzo de la columna

function Header()
{
    // Cabacera
    global $title;
    //$header_title = 'Dra. Diana Andrea Zorrilla';

    $this->SetFont('Arial','B',15);
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    $this->SetDrawColor(157,165,170); 
    $this->SetFillColor(255, 255, 255);
    $this->SetTextColor(0,0,0);
    $this->SetLineWidth(1);
    $this->Cell($w,9,$title,1,1,'C',true);
    $this->Ln(10);
    // Guardar ordenada
    $this->y0 = $this->GetY();
}

function Footer()
{
    // Pie de página
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->SetTextColor(128);
    $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
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
    $this->Cell(0,6,"$label",0,1,'L',true);
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
    // Imprimir texto en una columna de 6 cm de ancho
    $this->MultiCell(80,5,$txt);
    $this->Ln();
    // Cita en itálica
    $this->SetFont('','I');
    $this->Cell(0,5,'(fin de la prescripcion)');
    // ir a la segunda columna
    $this->SetCol(1);
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
}//class

$studies_id = $_GET['studies_id'];
$studies_fields = get_post_custom($studies_id);
  
$egcv = $studies_fields['egcv'][0];
$egcv_dx = $studies_fields['egcv_dx'][0];

$pdf = new PDF();
$title = 'Dra. Diana Andrea Zorrilla';
$pdf->SetTitle($title);
$pdf->SetAuthor('Andrea Zorrilla');
$pdf->PrintChapter(1,' EGCV.                                                                   -            egcv_dx', $myfile);
$pdf->PrintPrescription(1,'egcv', $egcv);
$pdf->PrintPrescription(2,'egcv_dx',$egcv_dx);
$pdf->Output();
?>