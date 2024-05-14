<?php
class PDF extends FPDF
{	
	function header(){
		$this->setFont('Times','B',12);
		$this->setFillColor(255,255,255);
		$this->cell(20,0);
		$this->cell(160,5,'PEMERINTAH KABUPATEN TEGAL',0,0,'C');
		$this->ln();
		$this->setFont('Times','B',15);
		$this->cell(20,0);
		$this->cell(160,6,'DINAS PERHUBUNGAN',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(160,6,'BIDANG LALU LINTAS DAN KESELAMATAN JALAN',0,0,'C');
		$this->ln();
		$this->setFont('Times','',12);
		$this->cell(20,0);
		$this->cell(160,5,'Jl. Gatot Subroto, Komplek Sarana Perhubungan Terpadu Dukuhsalam Slawi',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(160,5,'Kode Pos : 52417, email : dishubkominfo@tegalkab.go.id',0,0,'C');
		$this->ln();
		$this->SetLineWidth(0.7);
		$this->Line(200,38,10,38);
		$this->SetLineWidth(0.5);
		$this->Line(200,39,10,39);
		$this->Image(base_url().'assets/images/logo-kab-tegal.png',10,10,20,0,'PNG');
		$this->ln(5);
	}
	
	function Surat($detail_bap){
		foreach($detail_bap as $row){
			$ax_s1 = $row->ax_total_s1;
			$ax_s2 = $row->ax_total_s2;
			$ax_s3 = $row->ax_total_s3;
			$br_kiri_s1 = $row->br_kiri_s1;
			$br_kanan_s1 = $row->br_kanan_s1;
			$br_kiri_s2 = $row->br_kiri_s2;
			$br_kanan_s2 = $row->br_kanan_s2;
			$br_kiri_s3 = $row->br_kiri_s3;
			$br_kanan_s3 = $row->br_kanan_s3;
			$br_total_s1 = $br_kiri_s1 + $br_kanan_s1;
			$br_total_s2 = $br_kiri_s2 + $br_kanan_s2;
			$br_total_s3 = $br_kiri_s3 + $br_kanan_s3;
			$br_kiri_parkir = $row->br_kiri_parkir;
			$br_kanan_parkir = $row->br_kanan_parkir;
			$br_total_parkir = $br_kiri_parkir + $br_kanan_parkir;
			
			$rem_utama = ($br_total_s1 + $br_total_s2 + $br_total_s3)/$row->bk_total*100;
			$bef = ($rem_utama * $row->bk_total)/100;
			$rem_parkir = ($br_total_parkir / $row->bk_total)*100;
			
			if($rem_utama != "0"){
				$rem = round($rem_utama,2);
			} else {
				$rem = "";
			}
			
			if($rem_parkir != "0"){
				$parkir = round($rem_parkir,2);
			} else {
				$parkir = "";
			}
			
			if($br_kanan_s1 > "0") {
				$ps1 = round((((abs($br_kiri_s1-$br_kanan_s1))/$ax_s1)*100),2);
			} else {
				$ps1 = "";
			}
			if($br_kanan_s2 > "0") {
				$ps2 = round((((abs($br_kiri_s2-$br_kanan_s2))/$ax_s2)*100),2);
			} else {
				$ps2 = "";
			}
			if($br_kanan_s3 > "0") {
				$ps3 = round((((abs($br_kiri_s3-$br_kanan_s3))/$ax_s3)*100),2);
			} else {
				$ps3 = "";
			}
			
			$asap = $row->asap;
			$asap_co = $row->asap_co;
			$asap_hc = $row->asap_hc;
			
			if($row->tahun >="2007"){
				$batas_asap = "40";
			} else {
				$batas_asap = "70";
			}
			if($asap<=$batas_asap){
				$hasil_asap = "LULUS";
			} else {
				$hasil_asap = "GAGAL";
			}
			
			if($rem_utama>="50"){
				$hasil_bef = "LULUS";
			} else {
				$hasil_bef = "GAGAL";
			}
			
			if($rem_parkir>="10"){
				$hasil_pef = "LULUS";
			} else {
				$hasil_pef = "GAGAL";
			}
			
			if($ps1<="8"){
				$hasil_ps1 = "LULUS";
			} else {
				$hasil_ps1 = "GAGAL";
			}
			
			if($ps2<="8"){
				$hasil_ps2 = "LULUS";
			} else {
				$hasil_ps2 = "GAGAL";
			}
			
			$this->setFont('Times','BU',14);
			$this->cell(205,6,'BERITA ACARA PEMERIKSAAN',0,0,'C');
			$this->setFont('Times','',12);		
			$this->ln(10);
			$this->setleftmargin(20);
			$this->Multicell(170,7,'Berdasarkan hasil pemeriksaan nomor '.$row->kode_uji.' pada tanggal '.date("d M Y",strtotime($row->tgl_uji)).', dengan ini disampaikan hasil pengujian kendaraan sebagai berikut :',0,'J');
			$this->ln();
			$this->cell(35,7,'Nomor Uji',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->cell(90,7,$row->no_uji,0,0,'L');
			$this->ln();
			$this->cell(35,7,'Nomor Kendaraan',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->cell(90,7,$row->no_kendaraan,0,0,'L');
			$this->ln();
			$this->cell(35,7,'Nama Pemilik',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->cell(90,7,$row->pemilik,0,0,'L');
			$this->ln();
			$this->cell(35,7,'Alamat',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->Multicell(130,7,$row->alamat.' '.$row->kecamatan.' '.$row->kota,0,'J');
			$this->cell(35,7,'Jenis Kendaraan',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->cell(90,7,$row->jenis,0,0,'L');
			$this->ln();
			$this->cell(35,7,'Merk dan Tipe',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->cell(90,7,$row->merek.' / '.$row->tipe,0,0,'L');
			$this->ln();
			$this->cell(35,7,'Tahun Pembuatan',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->cell(90,7,$row->tahun,0,0,'L');
			$this->ln();
			$this->cell(35,7,'Nomor Rangka',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->cell(90,7,$row->no_rangka,0,0,'L');
			$this->ln();
			$this->cell(35,7,'Nomor Mesin',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->cell(90,7,$row->no_mesin,0,0,'L');
			$this->ln(10);
			$this->cell(10,7,'NO',1,0,'C');
			$this->cell(110,7,'PENGUJIAN',1,0,'C');
			$this->cell(20,7,'HASIL',1,0,'C');
			$this->cell(30,7,'KETERANGAN',1,0,'C');
			$this->ln();
			$this->cell(10,7,'1','LR',0,'C');
			$this->cell(40,7,'ASAP','LR',0,'L');
			$this->cell(70,7,'SMOKE',1,0,'L');
			$this->cell(20,7,$asap,1,0,'L');
			$this->cell(30,7,$hasil_asap,1,0,'L');
			$this->ln();
			$this->cell(10,7,'','LR',0,'C');
			$this->cell(40,7,'','LR',0,'L');
			$this->cell(70,7,'CO',1,0,'L');
			$this->cell(20,7,$asap_co,1,0,'L');
			$this->cell(30,7,'',1,0,'L');
			$this->ln();
			$this->cell(10,7,'','LR',0,'C');
			$this->cell(40,7,'','LR',0,'L');
			$this->cell(70,7,'HC',1,0,'L');
			$this->cell(20,7,$asap_hc,1,0,'L');
			$this->cell(30,7,'',1,0,'L');
			$this->ln();
			$this->cell(10,7,'2','LTR',0,'C');
			$this->cell(40,7,'LAMPU','LTR',0,'L');
			$this->cell(70,7,'KANAN',1,0,'L');
			$this->cell(20,7,$row->lampu_kanan,1,0,'L');
			$this->cell(30,7,'',1,0,'L');
			$this->ln();
			$this->cell(10,7,'','LR',0,'C');
			$this->cell(40,7,'','LR',0,'L');
			$this->cell(70,7,'KIRI',1,0,'L');
			$this->cell(20,7,$row->lampu_kiri,1,0,'L');
			$this->cell(30,7,'',1,0,'L');
			$this->ln();
			$this->cell(10,7,'3','LTR',0,'C');
			$this->cell(40,7,'SIDE SLIP','LTR',0,'L');
			$this->cell(70,7,'IN',1,0,'L');
			$this->cell(20,7,$row->side_slip_in,1,0,'L');
			$this->cell(30,7,'',1,0,'L');
			$this->ln();
			$this->cell(10,7,'','LR',0,'C');
			$this->cell(40,7,'','LR',0,'L');
			$this->cell(70,7,'OUT',1,0,'L');
			$this->cell(20,7,$row->side_slip_out,1,0,'L');
			$this->cell(30,7,'',1,0,'L');
			$this->ln();
			$this->cell(10,7,'4','LTR',0,'C');
			$this->cell(40,7,'REM','LTR',0,'L');
			$this->cell(70,7,'EFISIENSI REM UTAMA',1,0,'L');
			$this->cell(20,7,$rem,1,0,'L');
			$this->cell(30,7,$hasil_bef,1,0,'L');
			$this->ln();
			$this->cell(10,7,'','LR',0,'C');
			$this->cell(40,7,'','LR',0,'L');
			$this->cell(70,7,'EFISIENSI REM PARKIR',1,0,'L');
			$this->cell(20,7,$parkir,1,0,'L');
			$this->cell(30,7,$hasil_pef,1,0,'L');
			$this->ln();
			$this->cell(10,7,'','LR',0,'C');
			$this->cell(40,7,'','LR',0,'L');
			$this->cell(70,7,'PENYIMPANGAN SUMBU 1',1,0,'L');
			$this->cell(20,7,$ps1,1,0,'L');
			$this->cell(30,7,$hasil_ps1,1,0,'L');
			$this->ln();
			$this->cell(10,7,'','LR',0,'C');
			$this->cell(40,7,'','LR',0,'L');
			$this->cell(70,7,'PENYIMPANGAN SUMBU 2',1,0,'L');
			$this->cell(20,7,$ps2,1,0,'L');
			$this->cell(30,7,$hasil_ps2,1,0,'L');
			$this->ln();
			$this->cell(10,7,'','LRB',0,'C');
			$this->cell(40,7,'','LRB',0,'L');
			$this->cell(70,7,'PENYIMPANGAN SUMBU 3',1,0,'L');
			$this->cell(20,7,'',1,0,'L');
			$this->cell(30,7,'',1,0,'L');
			
			$this->Ln(20);
			$this->cell(100,0);
			$this->Cell(50,5,'TANDA TANGAN PENGUJI',0,0,'C');
			$this->Ln(28);
			$this->cell(100,0);
			$this->Cell(50,5,$row->nama,0,0,'C');
			$this->Ln();
			$this->cell(100,0);
			$this->Cell(50,5,'NIP. '.$row->no_reg,0,0,'C');
			$this->Image(base_url().'files/pendaftaran/'.$row->tgl_daftar_uji.'/'.$row->qr_kodeuji,160,75,30,0,'PNG');
		}
	}
	
	function Kode($detail_bap){
		foreach($detail_bap as $row){
			$this->Image(base_url().'files/barcode/'.$row->barcode,70,295,70,0,'PNG');
			$this->SetLineWidth(0.5);
			$this->Line(50,316,160,316);
			$this->Ln(40);
			$this->setFont('Times','',9);
			$this->Cell(170,5,'http://dishub.tegalkab.go.id , email : dishubslawi@gmail.com',0,0,'C');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',65,100,80,0,'PNG');
$this->fpdf->Surat($detail_bap);
$this->fpdf->Kode($detail_bap);
$this->fpdf->Output("I",$title);
?>