<?php
class PDF extends FPDF
{
	function tanggal(){
		$this->setFont('Arial','',12);
		$this->setFillColor(255,255,255);
		$this->cell(130,0);
		$this->cell(40,0,'SLAWI',0,0,'L');
		$this->Ln(11);
		$this->cell(130,0);
		$this->Ln(21);
		$this->cell(125,0);
		$this->cell(40,0,'PERHUBUNGAN',0,0,'C');
		$this->Ln(4);
		$this->cell(125,0);
		$this->cell(40,0,'KAB. TEGAL',0,0,'C');
	}
	
	function Dinas($detail_dinas){
		foreach($detail_dinas as $row){
			$this->setFont('Arial','',9);
			$this->Ln(5);
			$this->cell(105,0);
			$this->cell(40,0,'AN. KEPALA DINAS PERHUBUNGAN',0,0,'C');
			$this->Ln(3);
			$this->cell(105,0);
			$this->cell(40,0,'SEKRETARIS',0,0,'C');
			$this->setFont('Arial','',11);
			$this->Ln(18);
			$this->cell(105,0);
			$this->cell(40,0,$row->ka_dinas,0,0,'C');
			$this->setFont('Arial','',9);
			$this->Ln(4);
			$this->cell(105,0);
			$this->cell(40,0,$row->status_kadinas,0,0,'C');
			$this->setFont('Arial','',10);
			$this->Ln(4);
			$this->cell(105,0);
			$this->cell(40,0,$row->nip_kadinas,0,0,'C');
		}
	}
	
	function Content($detail_dinas){
		foreach($detail_dinas as $row){
			$this->setFont('Arial','',12);
			$this->Ln(24);
			$this->setFillColor(255,255,255);
			$this->Cell(115,0);
			//$this->Cell(30,0,$row->no_uji,0,0,'L');
			//$this->Image(base_url().'files/ttd/ttd-kasi.png',120,45,30,0,'PNG');
			$this->setFont('Arial','',7);
			$this->Ln(2);
			$this->cell(104,0);
			$this->cell(15,3,'PARAF','LTR',0,'C');
			$this->cell(15,3,'KASIE','TRB',0,'C');
			$this->Ln();
			$this->cell(104,0);
			$this->cell(15,9,'HIRARKI','LRB',0,'C');
			$this->cell(15,9,'','RB',0,'C');
		}
	}
}

$this->fpdf = new PDF("L","mm",array(125,180));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,10,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->tanggal();
$this->fpdf->Dinas($detail_dinas);
$this->fpdf->Content($detail_dinas);
$this->fpdf->Output("I",$title);
?>