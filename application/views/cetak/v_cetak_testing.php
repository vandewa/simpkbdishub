<?php
class PDF extends FPDF
{
	
	function tanggal($now){
		$tanggal = unix_to_human($now);
		$sekarang = date("d-m-Y", strtotime($tanggal));
		$this->setFont('Times','BU',14);
		$this->setFillColor(255,255,255);
		$this->cell(190,0,'HASIL PENGUJIAN KENDARAAN',0,0,'C');
		$this->Ln(10);
		$this->setFont('Times','',12);
		$this->cell(20,0,'Tanggal');
		$this->cell(2,0,':');
		$this->cell(40,0,$sekarang,0,0,'L');
	}
	
	function content($detail_testing){
		foreach($detail_testing as $row){
			$this->Ln(6);
			$this->cell(20,0,'No Uji');
			$this->cell(2,0,':');
			$this->cell(40,0,$row->no_uji,0,0,'L');
			$this->Ln(6);
			$this->cell(10,8,'NO',1,0,'C');
			$this->cell(80,8,'TESTING',1,0,'C');
			$this->cell(50,8,'HASIL',1,0,'C');
			$this->cell(50,8,'KETERANGAN',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'1',1,0,'C');
			$this->cell(40,8,'ASAP SOLAR',1,0,'L');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(50,8,$row->asap.'%',1,0,'C');
			$this->cell(50,8,'-',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'ASAP BENSIN',1,0,'L');
			$this->cell(40,8,'CO',1,0,'L');
			$this->cell(50,8,$row->asap_co.'%',1,0,'C');
			$this->cell(50,8,'LULUS',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'HC',1,0,'L');
			$this->cell(50,8,$row->asap_hc.' ppm',1,0,'C');
			$this->cell(50,8,'LULUS',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'2',1,0,'C');
			$this->cell(40,8,'LAMPU',1,0,'L');
			$this->cell(40,8,'KIRI',1,0,'L');
			$this->cell(50,8,$row->lampu_kiri.' cd / '. $row->derajat_lampu_kiri.' '.$row->menit_lampu_kiri,1,0,'C');
			$this->cell(50,8,$row->hasil_lampu_kiri,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'KANAN',1,0,'L');
			$this->cell(50,8,$row->lampu_kanan.' cd / '. $row->derajat_lampu_kanan.' '.$row->menit_lampu_kanan,1,0,'C');
			$this->cell(50,8,$row->hasil_lampu_kanan,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'3',1,0,'C');
			$this->cell(40,8,'SIDE SLIP',1,0,'L');
			$this->cell(40,8,'IN',1,0,'L');
			$this->cell(50,8,$row->side_slip_in.' mm',1,0,'C');
			$this->cell(50,8,$row->hasil_side_slip,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'OUT',1,0,'L');
			$this->cell(50,8,$row->side_slip_out.' mm',1,0,'C');
			$this->cell(50,8,'-',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'4',1,0,'C');
			$this->cell(40,8,'REM',1,0,'L');
			$this->cell(40,8,'UTAMA',1,0,'L');
			$this->cell(50,8,$row->rem_utama."%",1,0,'C');
			$this->cell(50,8,$row->hasil_utama,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'PS1',1,0,'L');
			$this->cell(50,8,$row->ps1."%",1,0,'C');
			$this->cell(50,8,$row->hasil_ps1,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'PS2',1,0,'L');
			$this->cell(50,8,$row->ps2."%",1,0,'C');
			$this->cell(50,8,$row->hasil_ps2,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'PARKIR',1,0,'L');
			$this->cell(50,8,$row->rem_parkir."%",1,0,'C');
			$this->cell(50,8,$row->hasil_parkir,1,0,'C');
			$this->Line(210,140,0,140);
		}
	}
	
	function tanggal2($now){
		$this->Ln(30);
		$tanggal = unix_to_human($now);
		$sekarang = date("d-m-Y", strtotime($tanggal));
		$this->setFont('Times','BU',14);
		$this->setFillColor(255,255,255);
		$this->cell(190,0,'HASIL PENGUJIAN KENDARAAN',0,0,'C');
		$this->Ln(10);
		$this->setFont('Times','',12);
		$this->cell(20,0,'Tanggal');
		$this->cell(2,0,':');
		$this->cell(40,0,$sekarang,0,0,'L');
	}
	
	function content2($detail_testing){
		foreach($detail_testing as $row){
			$this->Ln(6);
			$this->cell(20,0,'No Uji');
			$this->cell(2,0,':');
			$this->cell(40,0,$row->no_uji,0,0,'L');
			$this->Ln(6);
			$this->cell(10,8,'NO',1,0,'C');
			$this->cell(80,8,'TESTING',1,0,'C');
			$this->cell(50,8,'HASIL',1,0,'C');
			$this->cell(50,8,'KETERANGAN',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'1',1,0,'C');
			$this->cell(40,8,'ASAP SOLAR',1,0,'L');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(50,8,$row->asap.'%',1,0,'C');
			$this->cell(50,8,'-',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'ASAP BENSIN',1,0,'L');
			$this->cell(40,8,'CO',1,0,'L');
			$this->cell(50,8,$row->asap_co.'%',1,0,'C');
			$this->cell(50,8,'LULUS',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'HC',1,0,'L');
			$this->cell(50,8,$row->asap_hc.' ppm',1,0,'C');
			$this->cell(50,8,'LULUS',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'2',1,0,'C');
			$this->cell(40,8,'LAMPU',1,0,'L');
			$this->cell(40,8,'KIRI',1,0,'L');
			$this->cell(50,8,$row->lampu_kiri.' cd / '. $row->derajat_lampu_kiri.' '.$row->menit_lampu_kiri,1,0,'C');
			$this->cell(50,8,$row->hasil_lampu_kiri,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'KANAN',1,0,'L');
			$this->cell(50,8,$row->lampu_kanan.' cd / '. $row->derajat_lampu_kanan.' '.$row->menit_lampu_kanan,1,0,'C');
			$this->cell(50,8,$row->hasil_lampu_kanan,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'3',1,0,'C');
			$this->cell(40,8,'SIDE SLIP',1,0,'L');
			$this->cell(40,8,'IN',1,0,'L');
			$this->cell(50,8,$row->side_slip_in.' mm',1,0,'C');
			$this->cell(50,8,$row->hasil_side_slip,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'OUT',1,0,'L');
			$this->cell(50,8,$row->side_slip_out.' mm',1,0,'C');
			$this->cell(50,8,'-',1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'4',1,0,'C');
			$this->cell(40,8,'REM',1,0,'L');
			$this->cell(40,8,'UTAMA',1,0,'L');
			$this->cell(50,8,$row->rem_utama."%",1,0,'C');
			$this->cell(50,8,$row->hasil_utama,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'PS1',1,0,'L');
			$this->cell(50,8,$row->ps1."%",1,0,'C');
			$this->cell(50,8,$row->hasil_ps1,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'PS2',1,0,'L');
			$this->cell(50,8,$row->ps2."%",1,0,'C');
			$this->cell(50,8,$row->hasil_ps2,1,0,'C');
			$this->Ln(8);
			$this->cell(10,8,'',1,0,'C');
			$this->cell(40,8,'',1,0,'L');
			$this->cell(40,8,'PARKIR',1,0,'L');
			$this->cell(50,8,$row->rem_parkir."%",1,0,'C');
			$this->cell(50,8,$row->hasil_parkir,1,0,'C');
		}
	}
}

$this->fpdf = new PDF("P","mm","A4");
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->tanggal($now);
$this->fpdf->content($detail_testing);
$this->fpdf->tanggal2($now);
$this->fpdf->content2($detail_testing);
$this->fpdf->Output("I",$title);
?>