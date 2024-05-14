<?php
class PDF extends FPDF
{
	
	function Content($detail_buku){
		foreach($detail_buku as $row){
			
			//$this->SetLeftMargin(15);
			$this->setFont('Arial','',9);
			$this->Ln(19);
			$this->setFillColor(255,255,255);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->merek,0,0,'L');
			$this->Ln(4);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->tipe,0,0,'L');
			$this->Ln(4);
			$this->setFont('Arial','',12);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->no_uji,0,0,'L');
			$this->Ln(4);
			$this->setFont('Arial','',9);
			$this->Cell(95,0);
			$this->Cell(30,0,$row->jenis,0,0,'L');
			$this->Ln(3);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->isi_silinder,0,0,'L');
			$this->Ln(3);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->daya_motor,0,0,'L');
			$this->Ln(2);
			$this->setFont('Arial','',12);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->no_kendaraan,0,0,'L');
			$this->Ln(2);
			$this->setFont('Arial','',9);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->bahan_bakar,0,0,'L');
			$this->Ln(3);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->tahun,0,0,'L');
			$this->Ln(5);
			$this->setFont('Arial','',10);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->nama,0,0,'L');
			$this->Ln(10);
			$this->setFont('Arial','',10);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->alamat,0,0,'L');
			$this->Cell(68,0);
			$this->setFont('Arial','',9);
			$this->Cell(30,0,$row->no_rangka,0,0,'L');
			$this->Ln(6);
			$this->Cell(130,0);
			$this->Cell(30,0,$row->no_mesin,0,0,'L');
			$this->Ln(5);
			$this->setFont('Arial','',10);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->kecamatan,0,0,'L');
			$this->Ln(8);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->kota,0,0,'L');
			$this->Cell(60,0);
			//$this->Cell(15,0,$row->no_sertifikasi_uji,0,0,'L');
			//$this->Cell(15,0,$row->tgl_sertifikasi_uji,0,0,'L');
			$this->Ln(17);
			$this->Cell(32,0);
			$this->setFont('Arial','',10);
			$this->Cell(30,0,$row->no_ktp,0,0,'L');
			$this->Cell(68,0);
			$this->setFont('Arial','',9);
			//$this->Cell(15,0,$row->no_registrasi_uji,0,0,'L');
			//$this->Cell(15,0,$row->tgl_registrasi_uji,0,0,'L');
		}
	}
	
	function Detail($detail_buku){
		foreach($detail_buku as $row){
		}
	}
}
//$x = $this->fpdf->GetX();
//$y = $this->fpdf->GetY();
//$cell_width = 40;
//$cell_height = 5;

$this->fpdf = new PDF("L","mm",array(125,175));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,10,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_buku);
$this->fpdf->Detail($detail_buku);
$this->fpdf->Output("I",$title);
?>