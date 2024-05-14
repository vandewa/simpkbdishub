<?php
class PDF extends FPDF
{
	function tgl($tanggal){
		$tgl_awal = $tanggal[0];
		$tgl1 = date("d M Y", strtotime($tgl_awal));
		$tgl_akhir = $tanggal[1];
		$tgl2 = date("d M Y", strtotime($tgl_akhir));
		
		$this->setFont('Times','B',14);
		$this->Cell(310,0,'REKAP RETRIBUSI HARIAN',0,0,'C');
		$this->Ln(6);
		$this->setFont('Times','',12);
		$this->Cell(310,0,"Tanggal : ".$tgl1." - ".$tgl2,0,0,'C');
		$this->Ln(10);
	}
	
	function Content($laporan_retribusi){
		
		
		$this->setFont('Times','B',10);
		$this->setFillColor(255,255,255);
		$this->Cell(10,6,'NO',1,0,'C');
		$this->Cell(20,6,'TANGGAL',1,0,'C');
		$this->Cell(70,6,'NAMA',1,0,'C');
		$this->Cell(25,6,'NO UJI',1,0,'C');
		$this->Cell(25,6,'NO KEND',1,0,'C');
		$this->Cell(35,6,'JENIS',1,0,'C');
		$this->Cell(25,6,'RETRIBUSI',1,0,'C');
		$this->Cell(25,6,'STIKER',1,0,'C');
		$this->Cell(25,6,'PLAT',1,0,'C');
		$this->Cell(25,6,'BUKU',1,0,'C');
		$this->Cell(25,6,'TOTAL',1,0,'C');
		$this->Ln();
		
		$this->setFont('Times','',10);
		$this->setFillColor(255,255,255);
		$no=1;
		foreach($laporan_retribusi as $row){
			$tanggal = $row->tgl_pembayaran;
			$tgl = date("d M Y", strtotime($tanggal));
			
			$retribusi = number_format($row->retribusi, 0, ".", ",");
			$stiker = number_format($row->stiker, 0, ".", ",");
			$plat = number_format($row->plat, 0, ".", ",");
			$buku = number_format($row->buku, 0, ".", ",");
			$total_retribusi = number_format($row->total_retribusi, 0, ".", ",");
			
			$this->Cell(10,6,$no++,1,0,'C');
			$this->Cell(20,6,$tgl,1,0,'C');
			$this->Cell(70,6,$row->nama,1);
			$this->Cell(25,6,$row->no_uji,1);
			$this->Cell(25,6,$row->no_kendaraan,1);
			$this->Cell(35,6,$row->jenis,1);
			$this->Cell(25,6,"Rp ".$retribusi,1);
			$this->Cell(25,6,"Rp ".$stiker,1);
			$this->Cell(25,6,"Rp ".$plat,1);
			$this->Cell(25,6,"Rp ".$buku,1);
			$this->Cell(25,6,"Rp ".$total_retribusi,1);
			$this->Ln();
		}
	}
	
	function Total($total_retribusi){
		foreach($total_retribusi as $row){
			$jml_retribusi = number_format($row->jml_retribusi, 0, ".", ",");
			$jml_stiker = number_format($row->jml_stiker, 0, ".", ",");
			$jml_plat = number_format($row->jml_plat, 0, ".", ",");
			$jml_buku = number_format($row->jml_buku, 0, ".", ",");
			$jml_total_retribusi = number_format($row->jml_total_retribusi, 0, ".", ",");
			
			$this->Cell(150,6,'','LRB');
			$this->Cell(35,6,'TOTAL','LRB',0,'C');
			$this->Cell(25,6,"Rp ".$jml_retribusi,'LRB');
			$this->Cell(25,6,"Rp ".$jml_stiker,'LRB');
			$this->Cell(25,6,"Rp ".$jml_plat,'LRB');
			$this->Cell(25,6,"Rp ".$jml_buku,'LRB');
			$this->Cell(25,6,"Rp ".$jml_total_retribusi,'LRB');
			$this->Ln();
		}
	}
	
	function tanggal($now){
		$this->setFont('Times','B',10);
		$tanggal = unix_to_human($now);
		$sekarang = date("d M Y", strtotime($tanggal));
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
$this->fpdf->Content($laporan_retribusi);
$this->fpdf->Total($total_retribusi);
$this->fpdf->tanggal($now);
$this->fpdf->pengesahan($setting);
$this->fpdf->Output("I",$title);
?>