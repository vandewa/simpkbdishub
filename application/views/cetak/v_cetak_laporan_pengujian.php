<?php
class PDF extends FPDF
{
	function tgl($tanggal){
		$tgl_awal = $tanggal[0];
		$tgl1 = date("d-m-Y", strtotime($tgl_awal));
		$tgl_akhir = $tanggal[1];
		$tgl2 = date("d-m-Y", strtotime($tgl_akhir));
		
		$this->setFont('Times','B',14);
		$this->Cell(310,0,'REKAP PENGUJIAN KENDARAAN HARIAN',0,0,'C');
		$this->Ln(6);
		$this->setFont('Times','',12);
		$this->Cell(310,0,"Tanggal : ".$tgl1." - ".$tgl2,0,0,'C');
		$this->Ln(10);
	}
	
	function Content($laporan_pengujian){
		$w=19;
		$this->setFont('Times','B',9);
		$this->setFillColor(255,255,255);
		$this->Cell(16,5,'NO','LT',0,'C');
		$this->Cell($w,5,'M.BARU','LT',0,'C');
		$this->Cell($w,5,'M.NUM','LT',0,'C');
		$this->Cell($w,5,'M.NUK','LT',0,'C');
		$this->Cell($w,5,'M.MM','LT',0,'C');
		$this->Cell($w,5,'M.MK','LT',0,'C');
		$this->Cell($w,5,'M.PNM','LT',0,'C');
		$this->Cell($w*2,5,'JBB 0-4000KG','LTB',0,'C');
		$this->Cell($w*2,5,'JBB 4001-8000KG','LTB',0,'C');
		$this->Cell($w*2,5,'JBB 8001-14000KG','LTB',0,'C');
		$this->Cell($w*4,5,'JBB 14000KG KE ATAS','RLTB',0,'C');
		$this->Ln();
		$this->Cell(16,5,'','LB',0,'C');
		$this->Cell($w,5,'','LB',0,'C');
		$this->Cell($w,5,'','LB',0,'C');
		$this->Cell($w,5,'','LB',0,'C');
		$this->Cell($w,5,'','LB',0,'C');
		$this->Cell($w,5,'','LB',0,'C');
		$this->Cell($w,5,'','LB',0,'C');
		$this->Cell($w,5,'M.BUS','LB',0,'C');
		$this->Cell($w,5,'M.BARANG','LB',0,'C');
		$this->Cell($w,5,'M.BUS','LB',0,'C');
		$this->Cell($w,5,'M.BARANG','LB',0,'C');
		$this->Cell($w,5,'M.BUS','LB',0,'C');
		$this->Cell($w,5,'M.BARANG','LB',0,'C');
		$this->Cell($w,5,'M.BUS','LB',0,'C');
		$this->Cell($w,5,'M.BARANG','LB',0,'C');
		$this->Cell($w,5,'GANDENG','LB',0,'C');
		$this->Cell($w,5,'TEMPELAN','RLB',0,'C');
		$this->Ln();
		
		$this->setFont('Times','',9);
		$this->setFillColor(255,255,255);
		$no=1;
		foreach($laporan_pengujian as $row){
			$this->Cell(16,5,$no++,'LB',0,'C');
			$this->Cell($w,5,$row->mbaru,'LB',0,'C');
			$this->Cell($w,5,$row->mnum,'LB',0,'C');
			$this->Cell($w,5,$row->mnuk,'LB',0,'C');
			$this->Cell($w,5,$row->mmm,'LB',0,'C');
			$this->Cell($w,5,$row->mmk,'LB',0,'C');
			$this->Cell($w,5,$row->mpnm,'LB',0,'C');
			$this->Cell($w,5,$row->mbus1,'LB',0,'C');
			$this->Cell($w,5,$row->mtruck1,'LB',0,'C');
			$this->Cell($w,5,$row->mbus2,'LB',0,'C');
			$this->Cell($w,5,$row->mtruck2,'LB',0,'C');
			$this->Cell($w,5,$row->mbus3,'LB',0,'C');
			$this->Cell($w,5,$row->mtruck3,'LB',0,'C');
			$this->Cell($w,5,$row->mbus4,'LB',0,'C');
			$this->Cell($w,5,$row->mtruck4,'LB',0,'C');
			$this->Cell($w,5,$row->gandeng,'LB',0,'C');
			$this->Cell($w,5,$row->tempelan,'RLB',0,'C');
			$this->Ln();
		}
	}
	
	function Total($total_laporan_pengujian){
		$w=19;
		$this->setFont('Times','B',10);
		foreach($total_laporan_pengujian as $row){
			$this->Cell(16,5,'TOTAL','LB',0,'C');
			$this->Cell($w,5,$row->mbaru,'LB',0,'C');
			$this->Cell($w,5,$row->mnum,'LB',0,'C');
			$this->Cell($w,5,$row->mnuk,'LB',0,'C');
			$this->Cell($w,5,$row->mmm,'LB',0,'C');
			$this->Cell($w,5,$row->mmk,'LB',0,'C');
			$this->Cell($w,5,$row->mpnm,'LB',0,'C');
			$this->Cell($w,5,$row->mbus1,'LB',0,'C');
			$this->Cell($w,5,$row->mtruck1,'LB',0,'C');
			$this->Cell($w,5,$row->mbus2,'LB',0,'C');
			$this->Cell($w,5,$row->mtruck2,'LB',0,'C');
			$this->Cell($w,5,$row->mbus3,'LB',0,'C');
			$this->Cell($w,5,$row->mtruck3,'LB',0,'C');
			$this->Cell($w,5,$row->mbus4,'LB',0,'C');
			$this->Cell($w,5,$row->mtruck4,'LB',0,'C');
			$this->Cell($w,5,$row->gandeng,'LB',0,'C');
			$this->Cell($w,5,$row->tempelan,'RLB',0,'C');
			$this->Ln();
		}
	}
	
	function tanggal($now){
		$tanggal = unix_to_human($now);
		$sekarang = date("d-m-Y", strtotime($tanggal));
		$this->Ln(10);
		$this->Cell(240,0);
		$this->Cell(70,0,"SLAWI, ".$sekarang,0,0,'C');
	}
	
	function pengesahan($setting){
		$this->setFont('Times','B',10);
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
$this->fpdf->SetMargins(5,10,5); 
$this->fpdf->SetAutoPageBreak(true,10);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->tgl($tanggal);
$this->fpdf->Content($laporan_pengujian);
$this->fpdf->Total($total_laporan_pengujian);
$this->fpdf->tanggal($now);
$this->fpdf->pengesahan($setting);
$this->fpdf->Output("I",$title);
?>