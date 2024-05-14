<?php
class PDF extends FPDF
{
	function tanggal($now){
		$tanggal = unix_to_human($now);
		$sekarang = date("d-m-Y", strtotime($tanggal));
		$d = date("d", strtotime($tanggal));
		$m = date("m", strtotime($tanggal));
		$y = date("Y", strtotime($tanggal));
		$jd = gregoriantojd($m,$d,$y);
		$mn = jdmonthname($jd,0);
		
		$this->setFont('Arial','',12);
		$this->setFillColor(255,255,255);
		$this->cell(130,0);
		//$this->cell(40,0,'SLAWI',0,0,'L');
		$this->Ln(11);
		$this->cell(130,0);
		$this->cell(40,0,$d." ".$mn." ".$y,0,0,'L');
		$this->Ln(21);
		$this->cell(125,0);
		//$this->cell(40,0,'HUBKOMINFO',0,0,'C');
		$this->Ln(4);
		$this->cell(125,0);
		//$this->cell(40,0,'KAB. TEGAL',0,0,'C');
	}
	
	function Dinas($detail_dinas){
		foreach($detail_dinas as $row){
			$this->setFont('Arial','',11);
			$this->Ln(17);
			$this->cell(105,0);
			//$this->cell(40,0,$row->ka_dinas,0,0,'C');
			$this->setFont('Arial','',9);
			$this->Ln(4);
			$this->cell(105,0);
			//$this->cell(40,0,$row->status_kadinas,0,0,'C');
			$this->setFont('Arial','',10);
			$this->Ln(4);
			$this->cell(105,0);
			//$this->cell(40,0,$row->nip_kadinas,0,0,'C');
		}
	}
	
	function Depan($detail_buku){
		foreach($detail_buku as $row){
			$this->setFont('Arial','',12);
			$this->Ln(24);
			$this->setFillColor(255,255,255);
			$this->Cell(100,0);
			$this->Cell(40,0,$row->no_uji,0,0,'C');
			$this->Image(base_url().'files/barcode/'.$row->barcode,116,80,40,0,'PNG');
			$this->setFont('Arial','',7);
			/*
			$this->Ln(4);
			$this->cell(102,0);
			$this->cell(15,3,'PARAF','LTR',0,'C');
			$this->cell(15,3,'UPTD PKB','TRB',0,'C');
			$this->cell(15,3,'SEKDIN','TRB',0,'C');
			$this->Ln();
			$this->cell(102,0);
			$this->cell(15,7,'HIRARKI','LRB',0,'C');
			$this->cell(15,7,'','RB',0,'C');
			$this->cell(15,7,'','RB',0,'C');
			*/
		}
	}
	
	function Buku($detail_buku){
		foreach($detail_buku as $row){
			$sertifikasi = $row->tgl_sertifikasi_uji;
			$tgl_sertifikasi = date("d M Y", strtotime($sertifikasi));
			if($tgl_sertifikasi=='01 Jan 1970'){
				$ser = "";
			}
			else {
				$ser = $tgl_sertifikasi;
			}
			//$this->SetLeftMargin(15);
			$this->setFont('Arial','',9);
			$this->Ln(19);
			$this->setFillColor(255,255,255);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->merek,0,0,'L');
			$this->Ln(4);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->tipe,0,0,'L');
			$this->Ln(4);
			$this->setFont('Arial','',12);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->no_uji,0,0,'L');
			$this->Ln(4);
			$this->setFont('Arial','',9);
			$this->Cell(95,0);
			$this->Cell(30,0,$row->jenis,0,0,'L');
			$this->Ln(3);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->isi_silinder,0,0,'L');
			$this->Ln(3);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->daya_motor,0,0,'L');
			$this->Ln(2);
			$this->setFont('Arial','',12);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->no_kendaraan,0,0,'L');
			$this->Ln(2);
			$this->setFont('Arial','',9);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->bahan_bakar,0,0,'L');
			$this->Ln(3);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->tahun,0,0,'L');
			$this->Ln(5);
			$this->setFont('Arial','',10);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->pemilik,0,0,'L');
			$this->setFont('Arial','',9);
			$this->Cell(70,0);
			$this->Cell(30,0,$row->status,0,0,'L');
			$this->Ln(10);
			$this->setFont('Arial','',10);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->alamat_pemilik,0,0,'L');
			$this->Cell(68,0);
			$this->setFont('Arial','',9);
			$this->Cell(30,0,$row->no_rangka,0,0,'L');
			$this->Ln(6);
			$this->Cell(130,0);
			$this->Cell(30,0,$row->no_mesin,0,0,'L');
			$this->Ln(5);
			$this->setFont('Arial','',10);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->kecamatan,0,0,'L');
			$this->Cell(68,0);
			$this->setFont('Arial','',9);
			$this->Multicell(34,3,$row->no_sertifikasi_uji,0,'L');
			$this->Ln(5);
			$this->setFont('Arial','',10);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->kota,0,0,'L');
			$this->setFont('Arial','',9);
			$this->Cell(68,0);
			$this->Cell(15,0,$ser,0,0,'L');
			$this->Ln(10);
			$this->Cell(32,0);
			$this->setFont('Arial','',10);
			//$this->Cell(30,0,$row->no_ktp,0,0,'L');
			$this->Cell(68,0);
			$this->setFont('Arial','',9);
			//$this->Cell(15,0,$row->no_registrasi_uji,0,0,'L');
			//$this->Cell(15,0,$row->tgl_registrasi_uji,0,0,'L');
		}
	}
	
	function Detail($detail_buku){
		foreach($detail_buku as $row){
			
			$this->SetLeftMargin(40);
			$this->setFont('','',9);
			$this->Ln(6);
			$this->setFillColor(255,255,255);
			$this->Cell(20,0);
			$this->Cell(20,0,$row->uk_panjang,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(20,0,$row->bk_sumbu1,0,0,'L');
			$this->Ln(2);
			$this->Cell(30,0);
			$this->Cell(20,0,$row->uk_lebar,0,0,'L');
			$this->Ln(2);
			$this->Cell(40,0);
			$this->Cell(75,0);
			$this->Cell(20,0,$row->bk_sumbu2,0,0,'L');
			$this->Ln(1);
			$this->Cell(20,0);
			$this->Cell(20,0,$row->uk_tinggi,0,0,'L');
			$this->Ln(1);
			$this->Cell(40,0);
			$this->Cell(65,0);
			$this->Cell(20,0,$row->bk_sumbu3,0,0,'L');
			$this->Ln(2);
			$this->Cell(30,0);
			$this->Cell(20,0,$row->uk_julur_belakang,0,0,'L');
			$this->Ln(2);
			$this->Cell(20,0);
			$this->Cell(20,0,$row->uk_julur_depan,0,0,'L');
			$this->Cell(75,0);
			$this->Cell(20,0,$row->bk_sumbu4,0,0,'L');
			
			$this->Ln(6);
			$this->Cell(20,0);
			$this->Cell(20,0,$row->js_sumbu1,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(20,0,$row->bk_total,0,0,'L');
			$this->Ln(2);
			$this->Cell(30,0);
			$this->Cell(20,0,$row->js_sumbu2,0,0,'L');
			$this->Ln(2);
			$this->Cell(20,0);
			$this->Cell(20,0,$row->js_sumbu3,0,0,'L');
			$this->Ln(2);
			$this->Cell(30,0);
			$this->Cell(20,0,$row->js_sumbuq,0,0,'L');
			
			$this->Ln(6);
			$this->Cell(10,0);
			$this->Cell(25,0,$row->dbm_panjang,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(25,0,$row->da_orang,0,0,'L');
			$this->Ln(2);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->dbm_lebar,0,0,'L');
			$this->Ln(2);
			$this->Cell(10,0);
			$this->Cell(25,0,$row->dbm_tinggi,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(25,0,$row->da_barang,0,0,'L');
			$this->Ln(3);
			$this->Cell(10,0);
			$this->Cell(25,0,$row->dbm_bahan_bak,0,0,'L');
			$this->Ln(4);
			$this->Cell(100,0);
			$this->Cell(25,0,$row->jbi,0,0,'L');
			
			$this->Ln(3);
			$this->Cell(10,0);
			$this->Cell(25,0,$row->dt_panjang,0,0,'L');
			$this->Ln(2);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->dt_lebar,0,0,'L');
			$this->Ln(2);
			$this->Cell(10,0);
			$this->Cell(25,0,$row->dt_tinggi,0,0,'L');
			$this->Ln(2);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->dt_volume,0,0,'L');
			
			$this->Ln(6);
			$this->Cell(10,0);
			$this->Cell(25,0,$row->dt_jenis_muatan,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(25,0,$row->jbi_kombinasi,0,0,'L');
			$this->Ln(2);
			$this->Cell(10,0);
			$this->Cell(25,0,$row->dt_berat_jenis_muatan,0,0,'L');
			$this->Ln(2);
			$this->Cell(10,0);
			$this->Cell(25,0,$row->dt_bahan_tangki,0,0,'L');
			$this->Ln(10);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->ban_sumbu1,0,0,'L');
			$this->Ln(3);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->ban_sumbu2,0,0,'L');
			$this->Ln(1);
			$this->Cell(100,0);
			$this->Cell(25,0,$row->muatan_sum_berat,0,0,'L');
			$this->Ln(2);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->ban_sumbu3,0,0,'L');
			$this->Ln(3);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->ban_sumbu4,0,0,'L');
			$this->Ln(2);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->konf_sumbu,0,0,'L');
			$this->Ln(2);
			$this->Cell(100,0);
			$this->Cell(25,0,$row->kelas_jl_min,0,0,'L');
			$this->Ln(3);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->jbb,0,0,'L');
			$this->Ln(6);
			$this->Cell(20,0);
			$this->Cell(25,0,$row->jbb_kombinasi,0,0,'L');
		}
	}
	
	function hasil_uji($detail_buku){
		foreach($detail_buku as $row){
			$this->setFont('Times','B',12);
			$this->SetLeftMargin(0);
			$this->Ln(17);
			$this->Cell(63,0);
			$this->Cell(23,0,'LULUS',0,0,'C');
			$this->Ln(10);
			$this->Cell(63,0);
			$this->Cell(23,0,'SLAWI',0,0,'C');
		}
	}
	
	function waktu($detail_buku){
		foreach($detail_buku as $row){
			$tanggal = $row->tgl_uji;
			$sekarang = date("d-m-Y", strtotime($tanggal));
			$d = date("d", strtotime($tanggal));
			$m = date("m", strtotime($tanggal));
			$y = date("Y", strtotime($tanggal));
			$jd = gregoriantojd($m,$d,$y);
			$mn = jdmonthname($jd,0);
			
			$this->Ln(5);
			$this->Cell(63,0);
			$this->Cell(23,0,$d." ".$mn." ".$y,0,0,'C');
		}
	}
	
	function hasil_uji_berlaku($detail_buku){
		foreach($detail_buku as $row){
			$tgl_habis = $row->tgl_habis_uji;
			$habis = date("d-m-Y", strtotime($tgl_habis));
			$d = date("d", strtotime($tgl_habis));
			$m = date("m", strtotime($tgl_habis));
			$y = date("Y", strtotime($tgl_habis));
			$jd = gregoriantojd($m,$d,$y);
			$mn = jdmonthname($jd,0);
			
			$this->Ln(25);
			$this->Cell(63,0);
			$this->Cell(23,0,$d." ".$mn." ".$y,0,0,'C');
			/*$this->setFont('Times','BU',10);
			$this->Ln(27);
			$this->Cell(58,0);
			$this->Cell(23,0,$row->nama,0,0,'C');
			$this->setFont('Times','',8);
			$this->Ln(3);
			$this->Cell(58,0);
			$this->Cell(23,0,"NO. REG:".$row->no_reg,0,0,'C');
			*/
		}
	}
	
	function keterangan($detail_buku){
		foreach($detail_buku as $row){
			$this->setFont('ARIAL','',9);
			$this->Cell(90,4,'APABILA MASA BERLAKU UJI ANDA HABIS',0,0,'C');
			$this->Ln();
			$this->setFont('','B',9);
			$this->Cell(90,4,'SEGERA DATANG',0,0,'C');
			$this->Ln();
			$this->setFont('','',9);
			$this->Cell(90,4,'KE UPT PENGUJIAN KENDARAAN BERMOTOR',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'KABUPATEN TEGAL',0,0,'C');
			$this->Ln();
			$this->setFont('','',8);
			$this->Cell(90,4,'Jl. Gatot Subroto, Komplek Sarana Perhubungan Terpadu',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'Dukuhsalam, Slawi',0,0,'C');
			$this->Ln();
			$this->setFont('','',9);
			$this->Cell(90,4,'UNTUK INFORMASI BIAYA UJI, KELUHAN, ',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'KRITIK, DAN SARAN SMS KE NOMOR : ',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'0 8 1 5 7 5 7 1 7 3 6 0',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'DENGAN FORMAT SMS :',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'INFO BIAYA UJI : KIR(SPASI)NOMOR UJI KENDARAAN',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'CONTOH : KIR(SPASI)'.$row->no_uji,0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'KELUHAN : LAPOR(SPASI)ISI KELUHAN,KRITIK,SARAN',0,0,'C');
			$this->Ln(5);
			$this->setFont('','',8);
			$this->Cell(90,4,'Email : uptdpkb.slawi@gmail.com',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'Web : epkb.tegalkab.go.id',0,0,'C');
			$this->Ln(2);
			$this->setFont('','B',9);
			$this->Ln();
			$this->Cell(90,4,'MOHON APABILA KENDARAAN DENGAN BUKU UJI INI',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'DITILANG, MOHON SMS KE NOMOR ',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'0 8 1 5 7 5 7 1 7 3 6 0',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'DENGAN FORMAT : TILANG(SPASI)NOMOR UJI',0,0,'C');
			$this->Ln();
			$this->Cell(90,4,'',0,0,'C');
		}
	}
}

$this->fpdf = new PDF("L","mm",array(125,175));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,10,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->tanggal($now);
$this->fpdf->Dinas($detail_dinas);
$this->fpdf->Depan($detail_buku);
$this->fpdf->AddPage();
$this->fpdf->Buku($detail_buku);
$this->fpdf->AddPage();
$this->fpdf->Detail($detail_buku);
$this->fpdf->AddPage();
$this->fpdf->hasil_uji($detail_buku);
$this->fpdf->waktu($detail_buku);
$this->fpdf->hasil_uji_berlaku($detail_buku);
//$this->fpdf->AddPage();
//$this->fpdf->keterangan($detail_buku);
$this->fpdf->Output("I",$title);
?>