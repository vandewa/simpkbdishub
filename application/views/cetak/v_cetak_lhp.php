<?php
class PDF extends FPDF
{	
	function header(){
		$this->setFont('Times','',14);
		$this->setFillColor(255,255,255);
		$this->cell(20,0);
		$this->cell(160,7,'PEMERINTAH KABUPATEN JEPARA',0,0,'C');
		$this->ln();
		$this->setFont('Times','B',16);
		$this->cell(20,0);
		$this->cell(160,7,'DINAS PERHUBUNGAN',0,0,'C');
		$this->ln();
		$this->setFont('Times','',12);
		$this->cell(20,0);
		$this->cell(160,5,'Jl. Jendral Hugeng Imam Santoso No. 1 Telp (0291) 591237 Ngabul',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(160,5,'JEPARA',0,0,'C');
		$this->ln(10);
		$this->SetLineWidth(0.5);
		$this->Line(200,30,10,30);
		$this->SetLineWidth(0.3);
		$this->Line(200,31,10,31);
		$this->Image(base_url().'assets/images/logo_kab_jepara.png',10,5,16,0,'PNG');
	}
	
	function Surat($dt_sktl){
		foreach($dt_sktl as $row){
			$this->setFont('TIMES','BU',12);
			$this->cell(20,5);
			$this->cell(160,5,'LEMBAR HASIL PEMERIKSAAN KENDARAAN BERMOTOR',0,0,'C');
			$this->Ln(10);
			$this->setFont('TIMES','B',12);
			$this->cell(30,6,'DATA KENDARAAN',0,0,'L');
			$this->setFont('TIMES','',10);
			$this->Ln();
			$this->cell(42,6,'1. Nomor Uji / Kendaraan',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,$row->no_uji.' / '.$row->no_kendaraan,0,0,'L');
			$this->Ln();
			$this->cell(42,6,'2. Nama Pemilik',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,$row->nama,0,0,'L');
			$this->Ln();
			$this->cell(42,6,'3. Alamat Pemilik',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,$row->alamat.' '.$row->kecamatan,0,0,'L');
			$this->Ln();
			$this->cell(42,6,'4. Jenis Kendaraan ',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,$row->jenis.' ('.$row->jenis_kendaraan.' / '.$row->bentuk.')',0,0,'L');
			$this->Ln();
			$this->cell(42,6,'5. Merk / Tipe / Tahun ',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,$row->merek .' / '.$row->tipe.' / '.$row->tahun,0,0,'L');
			$this->Ln();
			$this->cell(42,6,'5. Nomor Rangka',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,$row->no_rangka,0,0,'L');
			$this->Ln();
			$this->cell(42,6,'6. Nomor Mesin',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,$row->no_mesin,0,0,'L');
			$this->Ln();
			$this->setFont('TIMES','B',12);
			$this->cell(30,6,'FOTO KENDARAAN',0,0,'L');
			$this->setFont('TIMES','',10);
			$this->Ln();
			$this->setFont('TIMES','B',12);
			$this->cell(30,6,'HASIL PEMERIKSAAN',0,0,'L');
			$this->setFont('TIMES','',10);
			$this->Ln();
			$this->cell(42,6,'1. Hasil Pengujian',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,$row->hasil,0,0,'L');
			$this->Ln();
			$this->cell(42,6,'2. Tanggal Uji / Habis Uji',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,strftime("%d %B %Y",strtotime($row->tgl_uji)).' / '.strftime("%d %B %Y",strtotime($row->tgl_habis_uji)),0,0,'L');
			$this->Ln();
			$this->cell(42,6,'3. Penguji Kendaraan ',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,$row->penguji.' (NRP. '.$row->nrp.' / '.$row->pangkat.') ',0,0,'L');
			$this->Ln();
			$this->cell(42,6,'4. Hasil Pemeriksaan ',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->cell(70,6,'',0,0,'L');
			$this->Ln();
		}
	}
	
	function Hasil($dt_hasil){
		foreach($dt_hasil as $row){
			if($row->ax_total_s1=="0"){
				$ax_s1 = $row->bk_sumbu1;
			} else {
				$ax_s1 = $row->ax_total_s1;
			}
			if($row->ax_total_s2=="0"){
				$ax_s2 = $row->bk_sumbu2;
			} else {
				$ax_s2 = $row->ax_total_s2;
			}
			if($row->ax_total_s3=="0"){
				$ax_s3 = $row->bk_sumbu3;
			} else {
				$ax_s3 = $row->ax_total_s3;
			}
			if($row->ax_total_s4=="0"){
				$ax_s4 = $row->bk_sumbu4;
			} else {
				$ax_s4 = $row->ax_total_s4;
			}
			$br_kiri_s1 = $row->br_kiri_s1;
			$br_kanan_s1 = $row->br_kanan_s1;
			$br_kiri_s2 = $row->br_kiri_s2;
			$br_kanan_s2 = $row->br_kanan_s2;
			$br_kiri_s3 = $row->br_kiri_s3;
			$br_kanan_s3 = $row->br_kanan_s3;
			$br_kiri_s4 = $row->br_kiri_s4;
			$br_kanan_s4 = $row->br_kanan_s4;
			$br_tangan_kiri = $row->br_tangan_kiri;
			$br_tangan_kanan = $row->br_tangan_kanan;
			$br_kaki_kiri = $row->br_kaki_kiri;
			$br_kaki_kanan = $row->br_kaki_kanan;
			
			$br_total_s1 = $br_kiri_s1 + $br_kanan_s1;
			$br_total_s2 = $br_kiri_s2 + $br_kanan_s2;
			$br_total_s3 = $br_kiri_s3 + $br_kanan_s3;
			$br_total_s4 = $br_kiri_s3 + $br_kanan_s4;
			
			$br_parkir_tangan = $br_tangan_kiri + $br_tangan_kanan;
			$br_parkir_kaki = $br_kaki_kiri + $br_kaki_kanan;
			
			$rem_utama = ($br_total_s1 + $br_total_s2 + $br_total_s3 + $br_total_s4)/($ax_s1 + $ax_s2 + $ax_s3 + $ax_s4) * 100;
			$ps1 = ((abs($br_kiri_s1-$br_kanan_s1))/$ax_s1)*100;
			$ps2 = ((abs($br_kiri_s2-$br_kanan_s2))/$ax_s2)*100;
			if($ax_s3>0){
				$ps3 = ((abs($br_kiri_s3-$br_kanan_s3))/$ax_s3)*100;
			}
			if($ax_s4>0){
				$ps4 = ((abs($br_kiri_s4-$br_kanan_s4))/$ax_s4)*100;
			}
			
			if($br_tangan_kanan>0){
				$rem_parkir = $br_parkir_tangan/($ax_s1 + $ax_s2 + $ax_s3 + $ax_s4)*100;
			} else {
				$rem_parkir = $br_parkir_kaki/($ax_s1 + $ax_s2 + $ax_s3 + $ax_s4)*100;
			}
					
			$this->cell(10,6,'No',1,0,'C');
			$this->cell(90,6,'Pengujian',1,0,'C');
			$this->cell(65,6,'Hasil Uji',1,0,'C');
			$this->cell(25,6,'Keterangan',1,0,'C');
			$this->Ln();
			$this->cell(10,6,'1.',1,0,'C');
			$this->cell(90,6,'Pemeriksaan visual dan manual kendaraan',1,0,'L');
			$this->cell(65,6,'Baik',1,0,'C');
			$this->cell(25,6,'Lulus',1,0,'C');
			$this->Ln();
			$this->cell(10,6,'2.',1,0,'C');
			$this->cell(90,6,'Pengujian tingkat kebisingan klakson',1,0,'L');
			$this->cell(65,6,$row->sound_level.' dB',1,0,'C');
			$this->cell(25,6,'Lulus',1,0,'C');
			$this->Ln();
			$this->cell(10,6,'3.',1,0,'C');
			$this->cell(90,6,'Pengujian daya tembus kaca',1,0,'L');
			$this->cell(65,6,$row->tint_meter.' %',1,0,'C');
			$this->cell(25,6,'Lulus',1,0,'C');
			$this->Ln();
			$this->cell(10,6,'4.',1,0,'C');
			$this->cell(90,6,'Pengujian kedalaman alur ban',1,0,'L');
			$this->cell(65,6,$row->alur_ban.' mm',1,0,'C');
			$this->cell(25,6,'Lulus',1,0,'C');
			$this->Ln();
			$this->cell(10,6,'5.',1,0,'C');
			$this->cell(90,6,'Pengujian emisi gas buang',1,0,'L');
			if($row->bahan_bakar=="SOLAR"){ 
			$this->cell(65,6,$row->asap.' %',1,0,'C');
			} else {
			$this->cell(65,6,'CO: '.$row->asap_co. '%, HC: '.$row->asap_hc. '%',1,0,'C');
			}
			$this->cell(25,6,'Lulus',1,0,'C');
			$this->Ln();
			$this->cell(10,6,'6.','TLR',0,'C');
			$this->cell(90,6,'Pengujian daya pancar lampu','TLR',0,'L');
			$this->cell(15,6,'Kiri','T',0,'L');
			$this->cell(50,6,': '.$row->lampu_kiri.' cd '.$row->derajat_lampu_kiri,'TR',0,'L');
			$this->cell(25,6,'Lulus','TLR',0,'C');
			$this->Ln();
			$this->cell(10,5,'','BLR',0,'C');
			$this->cell(90,5,'','BLR',0,'L');
			$this->cell(15,5,'Kanan',0,0,'L');
			$this->cell(50,5,': '.$row->lampu_kanan.' cd '.$row->derajat_lampu_kanan,'BR',0,'L');
			$this->cell(25,5,'','BLR',0,'C');
			$this->Ln();
			$this->cell(10,6,'7.','TLR',0,'C');
			$this->cell(90,6,'Pengujian pengereman','TLR',0,'L');
			$this->cell(65,6,'Utama : '.round($rem_utama,2).' %','TLR',0,'L');
			$this->cell(25,6,'Lulus','TLR',0,'C');
			$this->Ln();
			$this->cell(10,5,'','LR',0,'C');
			$this->cell(90,5,'','LR',0,'L');
			$this->cell(65,5,'Parkir : '.round($rem_parkir,2).' %','LR',0,'L');
			$this->cell(25,5,'','LR',0,'C');
			if(($ax_s1>0) || ($ax_s2>0)){
			$this->Ln();
			$this->cell(10,5,'','BLR',0,'C');
			$this->cell(90,5,'','BLR',0,'L');
			$this->cell(65,5,'PS1 : '.round($ps1,2).' %, PS2 : '.round($ps2,2).' %','BLR',0,'L');
			$this->cell(25,5,'','BLR',0,'C');
			} else if($ax_s3>0){
			$this->Ln();
			$this->cell(10,5,'','BLR',0,'C');
			$this->cell(90,5,'','BLR',0,'L');
			$this->cell(65,5,'PS1 : '.round($ps1,2).' %, PS2 : '.round($ps2,2).' %, PS3 : '.round($ps3,2).' %','BLR',0,'L');
			$this->cell(25,5,'','BLR',0,'C');
			} else if($ax_s4>0){
			$this->Ln();
			$this->cell(10,5,'','BLR',0,'C');
			$this->cell(90,5,'','BLR',0,'L');
			$this->cell(65,5,'PS1 : '.round($ps1,2).' %, PS2 : '.round($ps2,2).' %, PS3 : '.round($ps3,2).' %, PS4 : '.round($ps4,2).' %','BLR',0,'L');
			$this->cell(25,5,'','BLR',0,'C');
			}
			$this->Ln();
			$this->cell(10,6,'8.',1,0,'C');
			$this->cell(90,6,'Pengujian kincup roda depan',1,0,'L');
			$this->cell(65,6,$row->side_slip_in.' mm',1,0,'C');
			$this->cell(25,6,'Lulus',1,0,'C');
			$this->Ln();
			$this->cell(10,6,'9.',1,0,'C');
			$this->cell(90,6,'Pengujian akurasi alat penunjuk kecepatan',1,0,'L');
			$this->cell(65,6,$row->speedometer.' kpj',1,0,'C');
			$this->cell(25,6,'Lulus',1,0,'C');
		}
	}
	
	function Kerusakan($dt_kerusakan){
		$no = 1;
		foreach($dt_kerusakan as $row){
			$this->Ln();
			$this->cell(10,5);
			$this->cell(150,5,$no++.'. '.$row->catatan,0,0,'L');
		}
	}
	
	function Surat1($dt_sktl){
		foreach($dt_sktl as $row){
			$this->Ln();
			$this->cell(10,10);
			$this->cell(52,10,'Sehingga, diperintahkan kepada pemilik kendaraan untuk :',0,0,'L');
		}
	}
	
	function Perbaikan($dt_perbaikan){
		$no = 1;
		foreach($dt_perbaikan as $row){
			$this->Ln();
			$this->cell(10,5);
			$this->cell(150,5,$no++.'. '.$row->catatan,0,0,'L');
		}
	}
	
	function Surat2($dt_sktl){
		foreach($dt_sktl as $row){
			$this->Ln(8);
			$this->Multicell(190,6,'Selanjutnya kendaraan tersebut diharuskan melakukan pengujian kendaraan ulang selambat-lambatnya pada tanggal '.strftime("%d %B %Y",strtotime($row->tgl_batas_perbaikan)).' di UPUBKB Kabupaten Jepara',0,'J');
			$this->cell(52,10,'Demikian untuk diketahui dan dilaksanakan sebagaimana mestinya.',0,0,'L');
			$this->Ln(10);
			$this->cell(115,10);
			$this->cell(50,10,'Jepara, '.strftime("%d %B %Y",strtotime($row->tgl_uji)),0,0,'C');
			$this->Ln();
			$this->cell(115,5);
			$this->setFont('TIMES','B',12);
			$this->cell(50,5,'PEMERIKSA TEKNIS KELAYAKAN',0,0,'C');
			$this->setFont('TIMES','',12);
			$this->Ln();
			$this->cell(115,5);
			$this->setFont('TIMES','',12);
			$this->cell(50,5,$row->pangkat,0,0,'C');
			$this->Ln(20);
			$this->setFont('TIMES','BU',12);
			$this->cell(115,5);
			$this->cell(50,5,$row->penguji,0,0,'C');
			$this->Ln();
			$this->setFont('TIMES','',12);
			$this->cell(115,5);
			$this->cell(50,5,'NRP. '.$row->nrp,0,0,'C');
			$this->Ln();
			$this->Image(base_url().'files/pendaftaran/'.date("Y-m-d",strtotime($row->tgl_daftar_uji)).'/'.$row->qr_kodeuji.'.png',10,290,0,30,'PNG');
			//$this->Image(base_url().'files/ttd/taryono.png',130,180,35,0,'PNG');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,5,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',65,100,80,0,'PNG');
//$this->fpdf->Image(base_url().'files/ttd/stempel.png',105,215,45,0,'PNG');
$this->fpdf->Surat($dt_sktl);
$this->fpdf->Hasil($dt_hasil);
$this->fpdf->Kerusakan($dt_kerusakan);
$this->fpdf->Surat1($dt_sktl);
$this->fpdf->Perbaikan($dt_perbaikan);
$this->fpdf->Surat2($dt_sktl);
$this->fpdf->Output("I",$title);
?>