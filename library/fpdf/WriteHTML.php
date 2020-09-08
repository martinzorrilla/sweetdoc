<?php
// require('fpdf.php');

class PDF_HTML extends FPDF
{
	var $B=0;
	var $I=0;
	var $U=0;
	var $HREF='';
	var $ALIGN='';

	function WriteHTML($html)
	{
		//HTML parser
		$html=str_replace("\n",' ',$html);
		$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
		foreach($a as $i=>$e)
		{
			if($i%2==0)
			{
				//Text
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				elseif($this->ALIGN=='center')
					$this->Cell(0,7,$e,0,1,'C');
				else
					$this->Write(7,$e);
			}
			else
			{
				//Tag
				if($e[0]=='/')
					$this->CloseTag(strtoupper(substr($e,1)));
				else
				{
					//Extract properties
					$a2=explode(' ',$e);
					$tag=strtoupper(array_shift($a2));
					$prop=array();
					foreach($a2 as $v)
					{
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$prop[strtoupper($a3[1])]=$a3[2];
					}
					$this->OpenTag($tag,$prop);
				}
			}
		}
	}

	function OpenTag($tag,$prop)
	{
		//Opening tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,true);
		if($tag=='A')
			$this->HREF=$prop['HREF'];
		if($tag=='BR')
			$this->Ln(5);
		if($tag=='P')
			$this->ALIGN=$prop['ALIGN'];
		if($tag=='HR')
		{
			if( !empty($prop['WIDTH']) )
				$Width = $prop['WIDTH'];
			else
				$Width = $this->w - $this->lMargin-$this->rMargin;
			$this->Ln(2);
			$x = $this->GetX();
			$y = $this->GetY();
			$this->SetLineWidth(0.4);
			$this->Line($x,$y,$x+$Width,$y);
			$this->SetLineWidth(0.2);
			$this->Ln(2);
		}
	}

	function CloseTag($tag)
	{
		//Closing tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,false);
		if($tag=='A')
			$this->HREF='';
		if($tag=='P')
			$this->ALIGN='';
	}

	function SetStyle($tag,$enable)
	{
		//Modify style and select corresponding font
		$this->$tag+=($enable ? 1 : -1);
		$style='';
		foreach(array('B','I','U') as $s)
			if($this->$s>0)
				$style.=$s;
		$this->SetFont('',$style);
	}

	function PutLink($URL,$txt)
	{
		//Put a hyperlink
		$this->SetTextColor(0,0,255);
		$this->SetStyle('U',true);
		$this->Write(5,$txt,$URL);
		$this->SetStyle('U',false);
		$this->SetTextColor(0);
	}



	// agregada por Mz
	/**
	 * 
	 * 
	 * 
	 * 
	 */
	function Firma($num)
	{

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
    // $base_x  = $sign_side ? 225 : 75;
    $base_x  = 110;


		// $this->SetY($altura_actual + $firma_altura);
		$this->Ln($num);
		//$this->SetFont('Arial','I',8);
		$this->SetFont('Times','',12);

		//$this->SetTextColor(128);

		// $this->SetX(110);
		$this->SetX($base_x);

		$this->Cell(0,12,'...............................................',0,2);

		// $this->SetX($client_offset);
		$this->SetX($base_x+$client_offset);

		// $this->Cell(0,5,'Dra. Andrea Zorrilla',0,2);
		$this->Cell(0,5,$client_title." ".$client_name,0,2);

		// $this->SetX(114); //gineco obstetra (andrea, alba etc)
		$this->SetX($base_x+4);


		// $this->SetX(120); // felbologia yu cirugia
		// $this->Cell(0,5,utf8_decode('Ginecología y Obstetricia'),0,2);
		$this->Cell(0,5,utf8_decode($client_especialidad),0,2);
		// $this->SetX(106);
		// $this->Cell(0,5,utf8_decode('Especialista en TGI y colposcopia'),0,2);
		// $this->Cell(0,5,utf8_decode($client_sub_especialidad),0,2);

		// $this->SetX(125);
		$this->SetX($base_x+15);

		$this->Cell(0,5,utf8_decode('RP: '.$client_registro),0,2);
		$this->SetX(0);
	}


	function FirmaIndicacion($num)
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
	
	function FirmaStudies($num, $side)
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
    // $sign_side = $this->col;
    $sign_side = $side;
    $base_x  = $sign_side ? 225 : 75;

    // $this->SetY($altura_actual + $firma_altura);
    $this->Ln($num);
    //$this->SetFont('Arial','I',8);
    $this->SetFont('Times','',12);
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



}
?>
