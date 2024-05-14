<?php
class PDF extends FPDF
{	
	function Content($detail_kendaraan){
		foreach($detail_kendaraan as $row){
			$this->setFont('Times','B',20);
			$this->setFillColor(255,255,255);
			$this->cell(20,0);
			$this->cell(225,8,'PEMERINTAH KABUPATEN TEGAL',0,0,'L');
			$this->ln();
			$this->cell(20,0);
			$this->cell(225,8,'DINAS PERHUBUNGAN',0,0,'L');
			$this->ln(14);
			$this->Image(base_url().'assets/images/logo-kab-tegal.png',5,5,15,0,'PNG');
		}
	}
	
	function Content2($detail_kendaraan){
		foreach($detail_kendaraan as $row){
			$this->setFont('Times','B',18);
			$this->setFillColor(255,255,255);
			$this->cell(20,0);
			$this->cell(220,8,'PEMERINTAH KABUPATEN TEGAL',0,0,'L');
			$this->ln();
			$this->cell(20,0);
			$this->cell(220,8,'DINAS PERHUBUNGAN',0,0,'L');
			$this->ln();
			$this->Image(base_url().'assets/images/logo-kab-tegal.png',5,5,15,0,'PNG');
		}
	}
	
	function Content3($detail_kendaraan){
		foreach($detail_kendaraan as $row){
			$kendaraan = $row->no_kendaraan;
			if($kendaraan==""){
				$noken[0] = "";
				$noken[1] = "";
				$noken[2] = "";
			} else {
				$noken = explode("-",$kendaraan);
			}
			
			if($row->tgl_pemakaian_pertama=="0000-00-00"){
				$tgl_pertama ="";
			} else {
				$tgl_pertama = date("d M Y", strtotime($row->tgl_pemakaian_pertama));
			}
			
			if(($row->tgl_stnk=="") || ($row->tgl_stnk=="0000-00-00")){
				$t = "";
				$d = "";
				$m = "";
				$y = "";
			} else {
				$t = "SMG";
				$d = date("d", strtotime($row->tgl_stnk));
				$m = date("M", strtotime($row->tgl_stnk));
				$y = date("Y", strtotime($row->tgl_stnk));
			}
			
			$this->Image(base_url().'files/barcode/'.$row->barcode,20,5,0,15,'PNG');
			$this->setFont('Arial','B',24);
			$this->setFillColor(255,255,255);	
			$this->cell(230,0);
			$this->cell(80,0,$row->no_uji,0,0,'C');
			$this->setFont('Arial','B',14);
			$this->Ln(5);
			$this->cell(230,0);
			$this->cell(80,0,$row->status,0,0,'C');
			$this->Ln(55);
			$this->cell(40,0);
			$this->Cell(60,0,$row->jenis,0,0,'L');
			$this->cell(90,0);
			$this->Cell(30,0,$row->tempat_pemakaian_pertama,0,0,'L');
			$this->cell(40,0);
			$this->cell(40,0,$tgl_pertama,0,0,'L');
			$this->Ln(37);
			$this->setFont('Arial','',9);
			$this->cell(235,0);
			$this->Cell(10,0,$t,0,0,'C');
			$this->setFont('Arial','B',11);
			$this->Cell(20,0,$noken[0],0,0,'C');
			$this->setFont('Arial','',9);
			$this->Cell(30,0,$row->nama,0,0,'L');
			$this->Ln(3);
			$this->cell(235,0);
			$this->Cell(10,0,$d,0,0,'C');
			$this->setFont('Arial','B',11);
			$this->Cell(20,0,$noken[1],0,0,'C');
			$this->setFont('Arial','',9);
			$this->Cell(70,0,$row->alamat,0,0,'L');
			$this->Ln(3);
			$this->cell(235,0);
			$this->Cell(10,0,$m,0,0,'C');
			$this->setFont('Arial','B',11);
			$this->Cell(20,0,$noken[2],0,0,'C');
			$this->setFont('Arial','',9);
			$this->Cell(70,0,$row->kecamatan,0,0,'L');
			$this->Ln(3);
			$this->cell(235,0);
			$this->Cell(10,0,$y,0,0,'C');
			$this->Cell(20,0);
			$this->Cell(70,0,$row->kota,0,0,'L');
			$this->Ln(63);
			$this->cell(237,0);
			$this->Cell(20,0,$tgl_pertama,0,0,'L');
			$this->cell(10,0);
			$this->Cell(30,0,$row->bahan_bakar,0,0,'L');
		}
	}

}


$this->fpdf = new PDF("L","mm",array(210,330));
$this->fpdf->SetMargins(5,5,5); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',125,65,80,0,'PNG');
$this->fpdf->Content($detail_kendaraan);
$this->fpdf->AddPage();
$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',125,65,80,0,'PNG');
$this->fpdf->Content2($detail_kendaraan);
$this->fpdf->Output("I",$title);
?>