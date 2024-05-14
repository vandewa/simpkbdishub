<?php
class PDF extends FPDF
{
	function tgl($tanggal){
		$tgl_awal = $tanggal[0];
		$tgl1 = date("d-m-Y", strtotime($tgl_awal));
		$tgl_akhir = $tanggal[1];
		$tgl2 = date("d-m-Y", strtotime($tgl_akhir));
		
		$this->setFont('Times','B',14);
		$this->Cell(310,0,'REKAP PENDAFTARAN PENGUJIAN HARIAN',0,0,'C');
		$this->Ln(6);
		$this->setFont('Times','',12);
		$this->Cell(310,0,"Tanggal : ".$tgl1." - ".$tgl2,0,0,'C');
		$this->Ln(10);
	}
	
	function Content($laporan_pendaftaran){
		$this->setFont('Times','B',10);
		$this->setFillColor(255,255,255);
		$this->Cell(10,6,'NO',1,0,'C');
		$this->Cell(30,6,'TANGGAL',1,0,'C');
		$this->Cell(80,6,'NAMA',1,0,'C');
		$this->Cell(30,6,'NO KENDARAAN',1,0,'C');
		$this->Cell(90,6,'ALAMAT',1,0,'C');
		$this->Cell(30,6,'TELEPON',1,0,'C');
		$this->Cell(40,6,'KECAMATAN',1,0,'C');
		$this->Ln();
		
		$this->setFont('Times','',10);
		$this->setFillColor(255,255,255);
		$no=1;
		foreach($laporan_pendaftaran as $row){
			$tanggal = $row->tgl_daftar_uji;
			$tgl = date("d-m-Y", strtotime($tanggal));
			
			$this->Cell(10,6,$no++,1,0,'C');
			$this->Cell(30,6,$tgl,1,0,'C');
			$this->Cell(80,6,$row->nama,1);
			$this->Cell(30,6,$row->no_kendaraan,1);
			$this->Cell(90,6,$row->alamat,1);
			$this->Cell(30,6,$row->telp,1);
			$this->Cell(40,6,$row->kecamatan,1);
			$this->Ln();
		}
	}
	
	function tanggal($now){
		$this->setFont('Times','B',10);
		$tanggal = unix_to_human($now);
		$sekarang = date("d-m-Y", strtotime($tanggal));
		$this->Ln(10);
		$this->Cell(240,0);
		$this->Cell(70,0,"SLAWI, ".$sekarang,0,0,'C');
	}
	
	function pengesahan($setting){
		foreach($setting as $row){
			$this->Ln(7);
			$this->Cell(240,0);
			$this->Cell(70,0,'KEPALA UPTD',0,0,'C');
			$this->Ln(5);
			$this->Cell(240,0);
			$this->Cell(70,0,'PENGUJIAN KENDARAAN BERMOTOR',0,0,'C');
			$this->Ln(20);
			$this->Cell(240,0);
			$this->setFont('Times','BU',10);
			$this->Cell(70,0,$row->kepala_uptd,0,0,'C');
			$this->Ln(5);
			$this->Cell(240,0);
			$this->setFont('Times','B',10);
			$this->Cell(70,0,"NIP. ".$row->nip,0,0,'C');
		}
	}
}

$this->fpdf = new PDF("L","mm",array(210,330));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetAutoPageBreak(true,10);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->tgl($tanggal);
$this->fpdf->Content($laporan_pendaftaran);
$this->fpdf->tanggal($now);
$this->fpdf->pengesahan($setting);
$this->fpdf->Output("I",$title);
?>