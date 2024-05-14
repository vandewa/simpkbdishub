<?php
class PDF extends FPDF
{	
	function header(){
		$this->setFont('Times','',12);
		$this->setFillColor(255,255,255);
		$this->cell(20,0);
		$this->cell(180,5,'PEMERINTAH KABUPATEN WONOSOBO',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(180,6,'DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERHUBUNGAN',0,0,'C');
		$this->ln();
		$this->setFont('Times','B',14);
		$this->cell(20,0);
		$this->cell(180,6,'UPTD PENGUJIAN KENDARAAN BERMOTOR',0,0,'C');
		$this->ln();
		$this->setFont('Times','',11);
		$this->cell(20,0);
		$this->cell(180,5,'Jl. Soepardjo Roestam No. 9A Andongsili Wonosobo Jawa Tengah 56351',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(180,5,'Telepon (0286)-321113 Faksimile (0286) 321113',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(180,5,'Laman: disperkimhub.wonosobokab.go.id Pos-el disperkimhub@wonosobokab.go.id',0,0,'C');
		$this->setFont('Times','',11);
		$this->ln();
		$this->SetLineWidth(0.7);
		$this->Line(225,39,5,39);
		$this->SetLineWidth(0.5);
		$this->Line(225,40,5,40);
		$this->Image(base_url().'assets/images/logo-kab-wonosobo.png',10,8,25,0,'PNG');
		$this->Image(base_url().'assets/images/logo-dishub-kab.png',200,5,25,0,'PNG');
		$this->ln(10);
	}
	
	function Surat($detail_surat){
		foreach($detail_surat as $row){
			$this->cell(20,6,'Nomor',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(105,6,'551.2/'.$row->no_surat,0,0,'L');
			//$this->cell(105,6,'551.2/',0,0,'L');
			$this->cell(90,6,'K e p a d a',0,0,'L');
			$this->ln();
			$this->cell(120,0);
			$this->cell(10,6,'Yth.',0,0,'L');
			$this->cell(90,6,'KEPALA DINAS PERHUBUNGAN',0,0,'L');
			$this->ln();
			$this->cell(130,0);
			$this->cell(90,6,strtoupper($row->kota_dinas),0,0,'L');
			$this->ln();
			$this->cell(130,0);
			$this->cell(90,6,'di -',0,0,'L');
			$this->ln();
			$this->cell(135,0);
			$this->cell(90,6,strtoupper($row->kota_tujuan),0,0,'L');
			$this->Image(base_url().'files/surat/'.date("Y",strtotime($row->tgl_surat)).'/'.date("F",strtotime($row->tgl_surat)).'/'.$row->qr_surat,10,70,30,0,'PNG');
		}
	}
}

$this->fpdf = new PDF("L","mm",array(230,110));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(5,5,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Surat($detail_surat);
$this->fpdf->Output("I",$title);
?>