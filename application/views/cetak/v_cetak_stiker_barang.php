<?php
class PDF extends FPDF
{
	
	function Content($detail_stiker){
		foreach($detail_stiker as $row){
			$tgl_habis = $row->tgl_habis_uji;
			$habis = date("d-m-Y", strtotime($tgl_habis));
			
			$d = date("d", strtotime($tgl_habis));
			$m = date("m", strtotime($tgl_habis));
			$y = date("Y", strtotime($tgl_habis));
			
			$jd = gregoriantojd($m,$d,$y);
			$mn = jdmonthname($jd,0);
			
			$orang = $row->da_orang;
			
			$this->SetLeftMargin(15);
			$this->setFont('Arial','B',24);
			$this->Cell(110,0);
			$this->cell(50,0,'',1,1,'C');
			$this->Ln(5);
			$this->setFillColor(255,255,255);
			$this->Cell(110,0);
			$this->cell(50,0,$d." ".$mn." ".$y,0,0,'C');
			$this->setFont('Arial','B',16);
			$this->Ln(11);
			$this->Cell(120,0);
			$this->cell(30,0,$row->bk_total,0,0,'L');
			$this->Ln(9);
			$this->Cell(120,0);
			$this->cell(30,0,$row->uk_panjang,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->uk_lebar,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->uk_tinggi,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->jbb,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->jbi,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->muatan_sum_berat,0,0,'L');
			$this->Ln(15);
			$this->Cell(100,0);
			$this->cell(50,0,$orang,0,0,'L');
			$this->cell(30,0,$row->jml_da_orang,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->da_barang,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->kelas_jl_min,0,0,'L');
			
		}
	}
	
	function Dinas($detail_dinas){
		foreach($detail_dinas as $row){
			$this->setFont('Arial','B',12);
			$this->Ln(10);
			$this->Cell(100,0);
			$this->cell(50,0,$row->dinas,0,0,'L');
		}
	}
	
	function Uji($detail_stiker){
		foreach($detail_stiker as $row){
			$this->setFont('Arial','B',24);
			$this->Ln(14);
			//$this->Cell(20,0);
			$this->cell(90,0,$row->no_uji,0,0,'L');
			$this->Ln(9);
			//$this->Cell(20,0);
			$this->cell(90,0,$row->no_kendaraan,0,0,'L');
			$this->setFont('Arial','B',12);
			$this->Ln(3);
			$this->Cell(126,0);
			$this->Cell(70,0,$row->nama,0,0,'C');
			$this->Ln(5);
			$this->Cell(145,0);
			$this->Cell(70,0,$row->no_reg,0,0,'L');
			$this->Image(base_url().'files/pendaftaran/'.$daftar_uji.'/'.$row->qr_kodeuji,95,115,35,0,'PNG');
		}
	}
}

$this->fpdf = new PDF("L","mm",array(150,200));
$this->fpdf->SetMargins(10,10,10);
$this->fpdf->SetAutoPageBreak(true,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_stiker);
$this->fpdf->Dinas($detail_dinas);
$this->fpdf->Uji($detail_stiker);
$this->fpdf->Output("I",$title);
?>