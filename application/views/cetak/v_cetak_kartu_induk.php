<?php
class PDF extends FPDF
{
	
	function Content($detail_kendaraan){
		foreach($detail_kendaraan as $row){
			$dimensi = $row->dimensi_kendaraan;
			if($dimensi=='Bak muatan'){
				$d = "Dimensi ".$dimensi;
				$p = "P = ".$row->dbm_panjang." mm";
				$l = "L = ".$row->dbm_lebar." mm";
				$t = "T = ".$row->dbm_tinggi." mm";
				$v = "";
				$j = "";
				$bj = "";
				$bh = $row->dbm_bahan_bak;
			} else if($dimensi=='Tangki'){
				$d = "Dimensi ".$dimensi;
				$p = "P = ".$row->dt_panjang." mm";
				$l = "L = ".$row->dt_lebar." mm";
				$t = "T = ".$row->dt_tinggi." mm";
				$v = "V = ".$row->dt_volume;
				$j = "Jenis muatan = ".$row->dt_jenis_muatan;
				$bj = "Berat jenis = ".$row->dt_berat_jenis_muatan;
				$bh = $row->dt_bahan_tangki;
			} else {
				$d = "";
				$p = "";
				$l = "";
				$t = "";
				$v = "";
				$j = "";
				$bj = "";
				$bh = "";
			}
			
			if($row->tgl_pemakaian_pertama=="0000-00-00"){
				$tgl_pertama ="";
			} else {
				$tgl_pertama = date("d M Y", strtotime($row->tgl_pemakaian_pertama));
			}
			
			if($row->tgl_sertifikasi_uji==""){
				$tgl_srut = "";
			} else {
				$tgl_srut = date("d M Y", strtotime($row->tgl_sertifikasi_uji));
			}
			
			$this->Image(base_url().'files/qrcode/'.$row->qrcode,200,0,25,0,'PNG');
			$this->setFont('Arial','B',24);
			$this->setFillColor(255,255,255);	
			$this->cell(230,0);
			$this->cell(80,0,$row->no_uji,0,0,'C');
			$this->Ln(30);
			$this->setFont('Arial','',10);
			$this->cell(65,0);
			$this->Cell(60,0,$row->merek,0,0,'L');
			$this->cell(65,0);
			$this->Cell(45,0,$row->uk_tinggi,0,0,'L');
			$this->cell(50,0);
			$this->cell(40,0,$row->nama_komersiil,0,0,'L');
			$this->Ln(5);
			$this->cell(65,0);
			$this->Cell(60,0,$row->tipe,0,0,'L');
			$this->cell(65,0);
			$this->Cell(45,0,$row->karoseri,0,0,'L');
			$this->cell(50,0);
			$this->cell(40,0,$row->warna,0,0,'L');
			$this->Ln(5);
			$this->cell(75,0);
			$this->Cell(50,0,$row->tahun,0,0,'L');
			$this->cell(65,0);
			$this->Cell(45,0,$row->jenis,0,0,'L');
			$this->Ln(5);
			$this->cell(190,0);
			$this->Cell(45,0,$row->dbm_bahan_bak,0,0,'L');
			$this->cell(50,0);
			$this->cell(40,0,$row->uk_julur_belakang,0,0,'L');
			$this->Ln(5);
			$this->cell(65,0);
			$this->Cell(60,0,$tgl_pertama,0,0,'L');
			$this->cell(65,0);
			$this->Cell(45,0,$row->tempat_duduk,0,0,'L');
			$this->cell(50,0);
			$this->cell(40,0,$row->uk_julur_depan,0,0,'L');
			$this->Ln(4);
			$this->cell(65,0);
			$this->Cell(60,0,$row->no_rangka,0,0,'L');
			$this->cell(65,0);
			$this->Cell(45,0,$row->tempat_berdiri,0,0,'L');
			$this->cell(50,0);
			$this->cell(40,0,'',0,0,'L');
			$this->Ln(5);
			$this->cell(65,0);
			$this->Cell(60,0,$row->no_mesin,0,0,'L');
			$this->cell(60,0);
			$this->Cell(50,0,'',0,0,'L');
			$this->Ln(5);
			$this->cell(70,0);
			$this->Cell(15,0,$row->js_sumbu1,0,0,'L');
			$this->cell(20,0);
			$this->Cell(15,0,$row->js_sumbu3,0,0,'L');
			$this->cell(70,0);
			$this->Cell(40,0,'',0,0,'L');
			$this->cell(55,0);
			$this->Cell(40,0,$row->isi_silinder." cc",0,0,'L');
			$this->Ln(5);
			$this->cell(70,0);
			$this->Cell(15,0,$row->js_sumbu2,0,0,'L');
			$this->cell(20,0);
			$this->Cell(15,0,'',0,0,'L');
			$this->cell(165,0);
			$this->Cell(40,0,$row->daya_motor,0,0,'L');
			$this->Ln(5);
			$this->cell(65,0);
			$this->Cell(60,0,$row->uk_panjang,0,0,'L');
			$this->cell(60,0);
			$this->Cell(50,0,'',0,0,'L');
			$this->cell(50,0);
			$this->cell(40,0,$row->konf_sumbu,0,0,'L');
			$this->Ln(4);
			$this->cell(65,0);
			$this->Cell(60,0,$row->uk_lebar,0,0,'L');
			$this->cell(20,0);
			$this->Cell(50,0,$row->js_sumbuq,0,0,'L');
			$this->Ln(23);
			$this->cell(75,0);
			$this->Cell(20,0,$row->jbb,0,0,'L');
			$this->Ln(4);
			$this->cell(75,0);
			$this->Cell(20,0,$row->jbb_kombinasi,0,0,'L');
			$this->Ln(5);
			$this->cell(75,0);
			$this->Cell(20,0,$row->bk_sumbu1,0,0,'L');
			$this->cell(160,0);
			$this->Cell(20,0,$d,0,0,'L');
			$this->Ln(4);
			$this->cell(75,0);
			$this->Cell(20,0,$row->bk_sumbu2,0,0,'L');
			$this->cell(160,0);
			$this->Cell(20,0,$p,0,0,'L');
			$this->Ln(5);
			$this->cell(75,0);
			$this->Cell(20,0,$row->bk_sumbu3,0,0,'L');
			$this->cell(160,0);
			$this->Cell(20,0,$l,0,0,'L');
			$this->Ln(4);
			$this->cell(75,0);
			$this->Cell(20,0,$row->bk_sumbu4,0,0,'L');
			$this->cell(160,0);
			$this->Cell(20,0,$t,0,0,'L');
			$this->Ln(5);
			$this->cell(75,0);
			$this->Cell(20,0,'',0,0,'L');
			$this->cell(160,0);
			$this->Cell(20,0,$v,0,0,'L');
			$this->Ln(5);
			$this->cell(75,0);
			$this->Cell(20,0,$row->bk_total,0,0,'L');
			$this->cell(160,0);
			$this->Cell(20,0,$j,0,0,'L');
			$this->Ln(5);
			$this->cell(45,0);
			$this->Cell(10,0,$row->da_orang,0,0,'L');
			$this->cell(20,0);
			$this->Cell(20,0,$row->jml_da_orang,0,0,'L');
			$this->cell(160,0);
			$this->Cell(20,0,$bj,0,0,'L');
			$this->Ln(4);
			$this->cell(75,0);
			$this->Cell(20,0,$row->da_barang,0,0,'L');
			$this->Ln(5);
			$this->cell(75,0);
			$this->Cell(20,0,$row->jbi,0,0,'L');
			$this->Ln(5);
			$this->cell(75,0);
			$this->Cell(20,0,$row->muatan_sum_berat,0,0,'L');
			$this->Ln(5);
			$this->cell(75,0);
			$this->Cell(20,0,$row->kelas_jl_min,0,0,'L');
			$this->Ln(6);
			$this->cell(75,0);
			$this->Cell(20,0,$row->ban_sumbu1,0,0,'L');
			$this->cell(67,0);
			$this->cell(80,0,$row->no_sertifikasi_uji,0,0,'L');
			$this->Ln(4);
			$this->cell(75,0);
			$this->Cell(20,0,$row->ban_sumbu2,0,0,'L');
			$this->cell(67,0);
			$this->cell(80,0,$tgl_srut,0,0,'L');
			$this->Ln(5);
			$this->cell(75,0);
			$this->Cell(20,0,$row->ban_sumbu3,0,0,'L');
			$this->cell(67,0);
			$this->cell(80,0,$row->penerbit_sertifikasi_uji,0,0,'L');
			$this->Ln(4);
			$this->cell(75,0);
			$this->Cell(20,0,$row->ban_sumbu4,0,0,'L');
			$this->Ln(9);
			$this->cell(55,0);
			$this->Cell(40,0,$row->tempat_pemakaian_pertama,0,0,'L');
			$this->Ln(4);
			$this->cell(55,0);
			$this->Cell(40,0,$tgl_pertama,0,0,'L');
			$this->setFont('Arial','',11);
			$this->Ln(10);
			$this->Cell(40,0,"Di cetak oleh : ".$row->keterangan,0,0,'L');
		}
	}
	
	function Content2($detail_kendaraan){
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
			$this->setFont('Arial','',11);
			$this->Ln(22);
			$this->Cell(40,0,"Di cetak oleh : ".$row->keterangan,0,0,'L');
		}
	}

}

$this->fpdf = new PDF("L","mm",array(210,330));
$this->fpdf->SetMargins(10,7,10); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_kendaraan);
$this->fpdf->AddPage();
$this->fpdf->Content2($detail_kendaraan);
$this->fpdf->Output("I",$title);
?>