<?php
class PDF extends FPDF
{
	
	function Content($detail_pendaftaran){
		foreach($detail_pendaftaran as $row){
			$tgl_akhir = $row->max_tgl_habis_uji;
			$habis = date("d-m-Y", strtotime($tgl_akhir));
			
			$this->SetLeftMargin(60);
			$this->setFont('Arial','',10);
			$this->Ln(45);
			$this->setFillColor(255,255,255);	
			$this->cell(100,0,$row->no_uji,0,0,'L');
			$this->Cell(60,0,$row->no_kendaraan,0,0,'L');
			$this->Ln(8);
			$this->cell(100,0,$row->nama,0,0,'L');
			$this->Cell(60,0,$row->no_mesin,0,0,'L');
			$this->Ln(6);
			$this->cell(100,0,$row->alamat,0,0,'L');
			$this->Cell(60,0,$row->no_rangka,0,0,'L');
			$this->Ln(6);
			$this->cell(20,0,$row->merek,0,0,'L');
			$this->cell(5,0,'/',0,0,'L');
			$this->cell(75,0,$row->tipe,0,0,'L');
			$this->Cell(60,0,$row->sifat_uji,0,0,'L');
			$this->Ln(6);
			$this->cell(100,0,$row->tahun,0,0,'L');
			$this->Cell(60,0,$habis,0,0,'L');
			$this->Ln(6);
			$this->cell(60,0,$row->jenis,0,0,'L');
			
		}
	}
	
	function tanggal($now){
		$tanggal = unix_to_human($now);
		$sekarang = date("d-m-Y", strtotime($tanggal));
		$this->Ln(31);
		$this->cell(75,0);
		$this->cell(40,0,$sekarang,0,0,'C');
	}
	
	function pemohon($detail_pendaftaran){
		foreach($detail_pendaftaran as $row){
			$this->Ln(24);
			$this->cell(80,0);
			$this->cell(40,0,$row->nama,0,0,'C');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_pendaftaran);
$this->fpdf->tanggal($now);
$this->fpdf->pemohon($detail_pendaftaran);
$this->fpdf->Output("I",$title);
?>