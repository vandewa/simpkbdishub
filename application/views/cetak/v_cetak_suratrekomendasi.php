<?php
class PDF extends FPDF
{	
	function header(){
		$this->setFont('Times','B',16);
		$this->setFillColor(255,255,255);
		$this->cell(20,0);
		$this->cell(160,6,'PEMERINTAH KABUPATEN MADIUN',0,0,'C');
		$this->ln();
		$this->setFont('Times','',18);
		$this->cell(20,0);
		$this->cell(160,7,'DINAS PERHUBUNGAN',0,0,'C');
		$this->ln();
		$this->setFont('Times','',12);
		$this->cell(20,0);
		$this->cell(160,5,'Jl. Panglima Sudirman No 50 Mejayan Telp. (0351) 383903',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(160,5,'Kode Pos : 63153, email : dishub.pkbmadiun@gmail.com',0,0,'C');
		$this->ln();
		$this->setFont('Times','B',14);
		$this->cell(20,0);
		$this->cell(160,5,'C A R U B A N',0,0,'C');
		$this->setFont('Times','',12);
		$this->ln();
		$this->SetLineWidth(0.7);
		$this->Line(200,40,10,40);
		$this->SetLineWidth(0.5);
		$this->Line(200,41,10,41);
		$this->Image(base_url().'assets/images/logo-kab-madiun.png',10,10,23,0,'PNG');
		$this->ln(8);
	}
	
	function Surat($dt_rekom){
		foreach($dt_rekom as $row){
			$this->setFont('Times','BU',12);
			$this->cell(190,5,'SURAT KETERANGAN REKOMENDASI TEKNIS KENDARAAN BERMOTOR',0,0,'C');
			$this->ln();
			$this->setFont('Times','',12);
			$this->cell(190,5,'Nomor : '.$row->no_rekom,0,0,'C');
			$this->ln(10);
			$this->setleftmargin(20);
			$this->cell(170,7,'Setelah diteliti dengan memperhatikan :',0,0,'L');
			$this->ln();
			$this->cell(5,6,'-',0,0,'L');
			$this->Multicell(165,5,'Permohonan Pendaftaran Kendaraan',0,'J');
			$this->cell(5,6,'-',0,0,'L');
			$this->Multicell(165,5,'Faktur Nomor : '.$row->no_faktur.', '.$row->penerbit_faktur.', Tanggal '.date("d F Y",strtotime($row->tgl_faktur)),0,'J');
			$this->cell(5,6,'-',0,0,'L');
			$this->Multicell(165,5,'Sertifikat Uji Tipe : '.$row->no_ut.', '.$row->penerbit_ut.', Tanggal '.date("d F Y",strtotime($row->tgl_ut)),0,'J');
			$this->cell(5,6,'-',0,0,'L');
			$this->Multicell(165,5,'Sertifikat Registrasi Uji Tipe : '.$row->no_srut.', '.$row->penerbit_srut.', Tanggal '.date("d F Y",strtotime($row->tgl_srut)),0,'J');
			if($row->no_fiskal!=""){
			$this->cell(5,6,'-',0,0,'L');
			$this->Multicell(165,5,'Fiskal Nomor : '.$row->no_fiskal.', '.$row->penerbit_fiskal.', Tanggal '.date("d F Y",strtotime($row->tgl_fiskal)),0,'J');
			}
			$this->ln(2);
			$this->cell(170,7,'Kendaraan dibawah ini memenuhi syarat untuk didaftarkan dengan spesifikasi teknis sebagai berikut :',0,0,'L');
			$this->ln();
			$this->cell(7,6,'1.',0,0,'L');
			$this->cell(50,6,'No Uji/ No Kend',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,'BARU',0,0,'L');
			$this->ln();
			$this->cell(7,6,'2.',0,0,'L');
			$this->cell(50,6,'Nama Pemilik',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->nama,0,0,'L');
			$this->ln();
			$this->cell(7,6,'3.',0,0,'L');
			$this->cell(50,6,'Alamat Pemilik',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->alamat.' KEC. '.$row->kecamatan.', MADIUN',0,0,'L');
			$this->ln();
			$this->cell(7,6,'4.',0,0,'L');
			$this->cell(50,6,'Jenis Kendaraan',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->setFont('Times','B',12);
			$this->cell(115,6,$row->jenis_kendaraan.' ('.$row->jenis.')',0,0,'L');
			$this->setFont('Times','',12);
			$this->ln();
			$this->cell(7,6,'5.',0,0,'L');
			$this->cell(50,6,'Nomor Rangka',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->no_rangka,0,0,'L');
			$this->ln();
			$this->cell(7,6,'6.',0,0,'L');
			$this->cell(50,6,'Nomor Mesin',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->no_mesin,0,0,'L');
			$this->ln();
			$this->cell(7,6,'7.',0,0,'L');
			$this->cell(50,6,'Bahan Bakar',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->bahan_bakar,0,0,'L');
			$this->ln();
			$this->cell(7,6,'8.',0,0,'L');
			$this->cell(50,6,'Merk / Tipe / Tahun',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->merek.' / '.$row->tipe.' / '.$row->tahun,0,0,'L');
			$this->ln();
			$this->cell(7,6,'9.',0,0,'L');
			$this->cell(50,6,'Dimensi Kendaraan',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(30,5,'a. Panjang',0,0,'L');
			$this->cell(30,5,': '.$row->uk_panjang.' mm',0,0,'L');
			$this->cell(30,5,'d. Julur Belakang',0,0,'L');
			$this->cell(30,5,': '.$row->uk_roh.' mm',0,0,'L');
			$this->ln();
			$this->cell(62,5);
			$this->cell(30,5,'b. Lebar',0,0,'L');
			$this->cell(30,5,': '.$row->uk_lebar.' mm',0,0,'L');
			$this->cell(30,5,'e. Julur Depan',0,0,'L');
			$this->cell(30,5,': '.$row->uk_foh.' mm',0,0,'L');
			$this->ln();
			$this->cell(62,5);
			$this->cell(30,5,'c. Tinggi',0,0,'L');
			$this->cell(30,5,': '.$row->uk_tinggi.' mm',0,0,'L');
			$this->ln();
			$this->cell(7,6,'10.',0,0,'L');
			$this->cell(50,6,'Jarak Sumbu',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(30,5,'a. S1-S2',0,0,'L');
			$this->cell(30,5,': '.$row->js_sumbu1.' mm',0,0,'L');
			$this->cell(30,5,'b. S3-S4',0,0,'L');
			$this->cell(30,5,': '.$row->js_sumbu3.' mm',0,0,'L');
			$this->ln();
			$this->cell(62,5);
			$this->cell(30,5,'c. S2-S3',0,0,'L');
			$this->cell(30,5,': '.$row->js_sumbu2.' mm',0,0,'L');
			$this->cell(30,5,'d. S4-S5',0,0,'L');
			$this->cell(30,5,': '.$row->js_sumbu4.' mm',0,0,'L');
			$this->ln();
			$this->cell(7,6,'11.',0,0,'L');
			$this->cell(50,6,'Isi Silinder / Daya Motor',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->isi_silinder.' CC / '.$row->daya_motor.' PS',0,0,'L');
			$this->ln();
			$this->cell(7,6,'12.',0,0,'L');
			$this->cell(50,6,'Konfigurasi Sumbu',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->konf_sumbu,0,0,'L');
			$this->ln();
			$this->cell(7,6,'13.',0,0,'L');
			$this->cell(50,5,'Kemampuan Sumbu Menurut Pabrik :',0,0,'L');
			$this->ln();
			$this->cell(62,5);
			$this->cell(30,5,'a. Sumbu 1',0,0,'L');
			$this->cell(30,5,': '.$row->kema_sumbu1.' mm',0,0,'L');
			$this->cell(30,5,'b. Sumbu 3',0,0,'L');
			$this->cell(30,5,': '.$row->kema_sumbu3.' mm',0,0,'L');
			$this->ln();
			$this->cell(62,5);
			$this->cell(30,5,'c. Sumbu 2',0,0,'L');
			$this->cell(30,5,': '.$row->kema_sumbu2.' mm',0,0,'L');
			$this->cell(30,5,'d. Sumbu 4',0,0,'L');
			$this->cell(30,5,': '.$row->kema_sumbu4.' mm',0,0,'L');
			$this->ln();
			$this->cell(7,6,'14.',0,0,'L');
			$this->cell(50,6,'JBB',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(30,6,$row->jbb.' kg',0,0,'L');
			$this->cell(30,6,'JBKB',0,0,'L');
			$this->cell(30,6,': '.$row->jbb_kombinasi.' kg',0,0,'L');
			$this->ln();
			$this->cell(7,6,'15.',0,0,'L');
			$this->cell(50,6,'Memenuhi Syarat Sebagai',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->setFont('Times','B',12);
			$this->cell(115,6,$row->jenis_kendaraan.' ('.$row->jenis.')',0,0,'L');
			$this->setFont('Times','',12);
			$this->ln();
			$this->cell(7,6,'16.',0,0,'L');
			$this->cell(50,6,'Status Penggunaan',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->setFont('Times','B',12);
			$this->cell(115,6,$row->sifat,0,0,'L');
			$this->setFont('Times','',12);
			$this->ln();
			$this->cell(7,6,'17.',0,0,'L');
			$this->cell(50,6,'Bahan Utama Rumah-rumah',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->bahan_rumah,0,0,'L');
			$this->ln();
			$this->cell(7,6,'18.',0,0,'L');
			$this->cell(50,6,'Jenis Rumah-rumah',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(115,6,$row->jenis_rumah,0,0,'L');
			$this->ln();
			$this->cell(90,7,'Demikian surat keterangan ini dibuat untuk digunakan sebagaimana mestinya.',0,0,'L');
			$this->Image(base_url().'files/surat/'.date("Y",strtotime($row->tgl_rekom)).'/'.date("F",strtotime($row->tgl_rekom)).'/'.$row->qrcode.'.png',20,260,30,0,'PNG');
		}
	}
	
	function Ttd($dt_setting){
		foreach($dt_setting as $row){
			$this->Ln(10);
			$this->cell(80,0);
			$this->Cell(30,5,'Dikeluarkan di',0,0,'L');
			$this->Cell(5,5,':',0,0,'L');
			$this->Cell(20,5,'Madiun',0,0,'L');
			$this->ln();
			$this->cell(80,0);
			$this->Cell(30,5,'Pada tanggal',0,0,'L');
			$this->Cell(5,5,':',0,0,'L');
			$this->Cell(20,5,date("d F Y"),0,0,'L');
			$this->ln(10);
			$this->setFont('Times','B',12);
			$this->cell(100,0);
			$this->Cell(50,5,'An. KEPALA DINAS PERHUBUNGAN',0,0,'C');
			$this->Ln();
			$this->cell(100,0);
			$this->Cell(50,5,'KABUPATEN MADIUN',0,0,'C');
			$this->Ln();
			$this->setFont('Times','',12);
			$this->cell(100,0);
			$this->Cell(50,5,'Kepala Bidang Angkutan',0,0,'C');
			$this->Ln(25);
			$this->setFont('Times','U',12);
			$this->cell(100,0);
			$this->Cell(50,5,'AGUNG PRIYO UTOMO, SH, MH.',0,0,'C');
			$this->Ln();
			$this->setFont('Times','',12);
			$this->cell(100,0);
			$this->Cell(50,5,'NIP. 19631024 198708 1 001',0,0,'C');
			//$this->Image(base_url().'files/ttd/ttd-kabid.png',120,285,60,0,'PNG');
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
$this->fpdf->Surat($dt_rekom);
$this->fpdf->Ttd($dt_setting);
$this->fpdf->Output("I",$title);
?>