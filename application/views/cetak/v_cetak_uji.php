<?php
class PDF extends FPDF
{
	
	function Content($detail_uji){
		foreach($detail_uji as $row){
			$tgl_daftar = $row->tgl_daftar_uji;
			$daftar = date("d-m-Y", strtotime($tgl_daftar));
			
			$this->SetLeftMargin(60);
			$this->setFont('Arial','',12);
			$this->Ln(20);
			$this->setFillColor(255,255,255);	
			$this->cell(90,0,$row->no_uji,0,0,'L');
			$this->Ln(12);
			$this->cell(95,0,$row->no_kendaraan,0,0,'L');
			$this->Cell(60,0,$daftar,0,0,'L');
			$this->setFont('Arial','',10);
			$this->Ln(12);
			$this->Cell(10,0);
			$this->cell(90,0,$row->nama,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			$this->cell(90,0,$row->alamat,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			$this->cell(90,0,$row->jenis,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			$this->cell(20,0,$row->merek,0,0,'L');
			$this->cell(5,0,'/',0,0,'L');
			$this->cell(70,0,$row->tipe,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			$this->cell(90,0,$row->tahun,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			$this->cell(90,0,$row->no_mesin,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			$this->cell(90,0,$row->no_rangka,0,0,'L');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_uji);
$this->fpdf->Output("I",$title);
?>