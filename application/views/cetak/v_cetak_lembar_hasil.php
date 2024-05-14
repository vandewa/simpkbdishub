<?php
class PDF extends FPDF
{
	function Pengujian($detail_uji){
		foreach($detail_uji as $row){
			$daftar_uji = date("Y-m-d",strtotime($row->tgl_daftar_uji));
			$tgl_daftar = $row->tgl_daftar_uji;
			$daftar = date("d M Y", strtotime($tgl_daftar));
			
			$this->SetLeftMargin(30);
			$this->setFont('Arial','B',16);
			$this->Ln(5);
			$this->Ln(5);
			$this->setFillColor(255,255,255);
			$this->setFont('Arial','B',12);
			$this->cell(40,0,'NO. PENGUJIAN',0,0,'L');
			$this->setFont('Arial','B',14);
			$this->cell(40,0,': '.$row->no_uji,0,0,'L');
			$this->Cell(10,0,"|",0,0,'C');
			$this->Cell(30,0,$row->jenis_uji,0,0,'L');
			$this->Ln(15);
			$this->setFont('Arial','B',12);
			$this->cell(40,0,'NO. KENDARAAN',0,0,'L');
			$this->setFont('Arial','B',14);			
			$this->cell(50,0,': '.$row->no_kendaraan,0,0,'L');
			$this->Cell(30,0,strftime("%d %B %Y", strtotime($row->tgl_uji)),0,0,'L');
			$this->setFont('Arial','',10);
			$this->Ln(12);
			$this->cell(40,0,'NAMA PEMILIK',0,0,'L');	
			$this->cell(90,0,': '.$row->nama,0,0,'L');
			$this->Ln(6);
			$this->cell(40,0,'ALAMAT',0,0,'L');	
			$this->cell(90,0,': '.$row->alamat,0,0,'L');
			$this->Ln(6);
			$this->cell(40,0,'JENIS KENDARAAN',0,0,'L');	
			$this->cell(90,0,': '.$row->jenis.' / '.$row->bentuk,0,0,'L');
			$this->Ln(6);
			$this->cell(40,0,'MERK DAN TIPE',0,0,'L');	
			$this->cell(95,0,': '.$row->merek.' / '.$row->tipe,0,0,'L');
			$this->Ln(6);
			$this->cell(40,0,'TAHUN',0,0,'L');	
			$this->cell(90,0,': '.$row->tahun,0,0,'L');
			$this->Ln(6);
			$this->cell(40,0,'NOMOR MESIN',0,0,'L');	
			$this->cell(90,0,': '.$row->no_mesin,0,0,'L');
			$this->Ln(6);
			$this->cell(40,0,'NOMOR RANGKA',0,0,'L');	
			$this->cell(90,0,': '.$row->no_rangka,0,0,'L');
			$this->Ln(218);
			$this->Cell(10,0);
			//$this->cell(40,0,$dari,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			//$this->cell(40,0,$no,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			//$this->cell(40,0,$tgl,0,0,'L');
			
			$this->Image(base_url().'files/pendaftaran/'.$daftar_uji.'/'.$row->qr_kodeuji.'.png',90,280,30,0,'PNG');

			$this->Ln();
			$this->Cell(30,0);
			$this->Cell(90,0);
			$this->cell(40,0,$row->penguji,0,0,'C');
			$this->Ln(4);
			$this->Cell(30,0);
			$this->Cell(90,0);
			$this->cell(40,0,$row->nrp,0,0,'C');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Pengujian($detail_pendaftaran);
$this->fpdf->Output("I",$title);
?>