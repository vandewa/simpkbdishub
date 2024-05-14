<?php
class PDF extends FPDF
{
	function nosurat($detail_surat){
		foreach($detail_surat as $row){
			$tanggal = date("d M Y", strtotime($row->tgl_surat));
			$this->setFont('Arial','',10);
			$this->setFillColor(255,255,255);
			$this->Ln(41);
			$this->cell(45,0);
			$this->cell(45,0,$row->no_surat,0,0,'L');
			$this->cell(40,0);
			$this->cell(40,0,$tanggal,0,0,'L');
		}
	}
	
	function Content($detail_surat){
		foreach($detail_surat as $row){
			$tgl = $row->tgl_surat;
			$y = date("Y",strtotime($tgl));
			$m = date("F",strtotime($tgl));
			
			$this->Ln(22);
			$this->cell(128,0);
			$this->Cell(40,0,"KEPALA DINAS PERHUBUNGAN",0,0,'L');
			$this->Ln(7);
			$this->cell(128,0);
			$this->Cell(40,0,$row->kota_dinas,0,0,'L');
			$this->Ln(7);
			$this->cell(128,0);
			$this->Cell(40,0,$row->kota_tujuan,0,0,'L');
			$this->Ln(49);
			$this->cell(90,0);
			$this->Cell(90,0,$row->nama,0,0,'L');
			$this->Ln(7);
			$this->cell(90,0);
			$this->MultiCell(110,0,$row->alamat." ".$row->kecamatan." ".$row->kota,0,'L');
			$this->Ln(7);
			$this->cell(90,0);
			$this->Cell(90,0,$row->jenis,0,0,'L');
			$this->Ln(7);
			$this->cell(90,0);
			$this->MultiCell(90,0,$row->merek."/".$row->tipe,0,'L');
			$this->Ln(7);
			$this->cell(90,0);
			$this->Cell(90,0,$row->tahun,0,0,'L');
			$this->Ln(8);
			$this->cell(90,0);
			$this->Cell(90,0,$row->no_uji,0,0,'L');
			$this->Ln(7);
			$this->cell(90,0);
			$this->Cell(90,0,$row->no_kendaraan,0,0,'L');
			$this->Ln(7);
			$this->cell(90,0);
			$this->Cell(90,0,$row->no_rangka,0,0,'L');
			$this->Ln(7);
			$this->cell(90,0);
			$this->Cell(90,0,$row->no_mesin,0,0,'L');
			$this->Ln(7);
			$this->cell(90,0);
			$this->Cell(90,0,$row->no_seri_buku,0,0,'L');
			$this->Ln(24);
			$this->cell(45,0);
			$this->Cell(90,0,"DINAS PERHUBUNGAN ".$row->kota_dinas,0,0,'L');
			$this->Image(base_url().'files/surat/'.$y.'/'.$m.'/'.$row->qr_surat,40,270,30,0,'PNG');
			$this->Ln(45);
			$this->cell(33,0);
			//$this->Cell(90,0,"SCAN SURAT",0,0,'L');
		}
	}
	
	function setting($detail_uptd){
		foreach($detail_uptd as $row){
			$this->Ln(33);
			$this->cell(100,0);
			$this->Cell(50,0,$row->kepala_uptd,0,0,'C');
			$this->Ln(5);
			$this->cell(112,0);
			$this->Cell(50,0,$row->nip,0,0,'L');
			//$this->Image(base_url().'files/ttd/ttd-kabid.png',115,275,40,0,'PNG');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,10,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->nosurat($detail_surat);
//$this->fpdf->tanggal($now);
$this->fpdf->Content($detail_surat);
$this->fpdf->setting($detail_uptd);
$this->fpdf->Output("I",$title);
?>