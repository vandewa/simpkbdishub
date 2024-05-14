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
			
			if($row->tgl_ut==""){
				$tgl_ut = "";
			} else {
				$tgl_ut = date("d M Y", strtotime($row->tgl_ut));
			}
			
			if($row->tgl_rb==""){
				$tgl_rb = "";
			} else {
				$tgl_rb = date("d M Y", strtotime($row->tgl_rb));
			}
			
			if($row->tgl_sertifikasi_uji==""){
				$tgl_srut = "";
			} else {
				$tgl_srut = date("d M Y", strtotime($row->tgl_sertifikasi_uji));
			}
			
			if($row->tgl_pemakaian_pertama=="0000-00-00"){
				$tgl_pertama ="";
			} else {
				$tgl_pertama = date("d M Y", strtotime($row->tgl_pemakaian_pertama));
			}
			
			$this->setFont('Times','B',20);
			$this->setFillColor(255,255,255);
			$this->cell(20,0);
			$this->cell(225,8,'PEMERINTAH KABUPATEN MADIUN',0,0,'L');
			$this->cell(75,8,$row->no_uji,1,0,'C');
			$this->ln();
			$this->cell(20,0);
			$this->cell(225,8,'DINAS PERHUBUNGAN',0,0,'L');
			$this->cell(75,8,$row->no_kendaraan,1,0,'C');
			$this->ln(14);
			$this->Image(base_url().'assets/images/logo-kab-madiun.png',5,5,15,0,'PNG');
			
			$this->Image(base_url().'files/qrcode/'.$row->qrcode,220,0,25,0,'PNG');
			$this->setFillColor(255,255,255);
			$this->setFont('Arial','B',20);			
			$this->cell(320,8,'KARTU UJI BERKALA',0,0,'C');
			
			/*
			$this->setFont('Arial','B',20);
			$this->cell(80,8,$row->no_uji,1,0,'C');
			$this->Ln();
			$this->setFont('Arial','B',16);
			$this->cell(240,8,'',0,0,'C');
			$this->setFont('Arial','B',20);
			$this->cell(80,8,$row->no_kendaraan,1,0,'C');
			*/
			
			$this->Ln(11);
			$this->setFont('Arial','B',10);
			$this->cell(120,6,'IDENTITAS KENDARAAN',1,0,'C');
			$this->cell(110,6,'DIMENSI KENDARAAN',1,0,'C');
			$this->cell(50,6,'DAYA ANGKUT',1,0,'C');
			$this->cell(20,6,'1',1,0,'C');
			$this->cell(20,6,'2',1,0,'C');
			$this->Ln();
			$this->setFont('Arial','',10);
			$this->cell(50,5,'TEMPAT / TGL STNK','L',0,'L');
			$this->cell(70,5,': '.$row->tempat_pemakaian_pertama.' / '.$tgl_pertama,'R',0,'L');
			$this->cell(50,5,'RUMAH-RUMAH',0,0,'L');
			$this->cell(60,5,': '.$row->karoseri,'R',0,'L');
			$this->cell(50,5,'JBB','R',0,'L');
			$this->cell(20,5,$row->jbb,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(50,5,'NO UJI / NO KENDARAAN','L',0,'L');
			$this->cell(70,5,': '.$row->no_uji.' / '.$row->no_kendaraan,'R',0,'L');
			$this->cell(50,5,'BAHAN UTAMA',0,0,'L');
			$this->cell(60,5,': '.$row->dbm_bahan_bak,'R',0,'L');
			$this->cell(50,5,'JBKB','RB',0,'L');
			$this->cell(20,5,$row->jbb_kombinasi,'RB',0,'C');
			$this->cell(20,5,'','RB',0,'C');
			$this->Ln();
			$this->cell(50,5,'MERK / TYPE','L',0,'L');
			$this->cell(70,5,': '.$row->merek.' / '.$row->tipe,'R',0,'L');
			$this->cell(50,5,'BANYAK TEMPAT DUDUK',0,0,'L');
			$this->cell(60,5,': '.$row->tempat_duduk,'R',0,'L');
			$this->setFont('Arial','B',10);
			$this->cell(50,5,'BERAT KOSONG','R',0,'L');
			$this->setFont('Arial','',10);
			$this->cell(20,5,'','R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(50,5,'JENIS / NAMA KOMERSIIL','L',0,'L');
			$this->cell(70,5,': '.$row->jenis_kendaraan.' / '.$row->jenis,'R',0,'L');
			$this->cell(50,5,'BANYAK TEMPAT BERDIRI',0,0,'L');
			$this->cell(60,5,': '.$row->tempat_berdiri,'R',0,'L');
			$this->cell(50,5,'SUMBU I','R',0,'L');
			$this->cell(20,5,$row->bk_sumbu1,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(50,5,'TAHUN / WARNA','L',0,'L');
			$this->cell(70,5,': '.$row->tahun.' / '.$row->warna,'R',0,'L');
			$this->cell(50,5,'PANJANG KENDARAAN',0,0,'L');
			$this->cell(60,5,': '.$row->uk_panjang,'R',0,'L');
			$this->cell(50,5,'SUMBU II','R',0,'L');
			$this->cell(20,5,$row->bk_sumbu2,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(50,5,'NO RANGKA','L',0,'L');
			$this->cell(70,5,': '.$row->no_rangka,'R',0,'L');
			$this->cell(50,5,'LEBAR KENDARAAN',0,0,'L');
			$this->cell(60,5,': '.$row->uk_lebar,'R',0,'L');
			$this->cell(50,5,'SUMBU III','R',0,'L');
			$this->cell(20,5,$row->bk_sumbu3,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(50,5,'NO MESIN','L',0,'L');
			$this->cell(70,5,': '.$row->no_mesin,'R',0,'L');
			$this->cell(50,5,'TINGGI KENDARAAN',0,0,'L');
			$this->cell(60,5,': '.$row->uk_tinggi,'R',0,'L');
			$this->cell(50,5,'SUMBU IV','R',0,'L');
			$this->cell(20,5,$row->bk_sumbu4,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(50,5,'ISI SILINDER/DAYA MOTOR ','L',0,'L');
			$this->cell(70,5,': '.$row->isi_silinder.' CC / '.$row->daya_motor.' KW/PS','R',0,'L');
			$this->cell(50,5,'JULUR BELAKANG (ROH)',0,0,'L');
			$this->cell(60,5,': '.$row->uk_roh,'R',0,'L');
			$this->cell(50,5,'SUMBU V','R',0,'L');
			$this->cell(20,5,$row->bk_sumbu5,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(50,5,'BAHAN BAKAR','LB',0,'L');
			$this->cell(70,5,': '.$row->bahan_bakar.' CC','RB',0,'L');
			$this->cell(50,5,'JULUR DEPAN (FOH)','',0,'L');
			$this->cell(60,5,': '.$row->uk_foh,'R',0,'L');
			$this->cell(50,5,'TOTAL','RB',0,'L');
			$this->cell(20,5,$row->bk_total,'RB',0,'C');
			$this->cell(20,5,'','RB',0,'C');
			$this->Ln();
			$this->setFont('Arial','B',10);
			$this->cell(120,5,'SERTIFIKAT REGISTRASI / UJI TIPE','LBR',0,'C');
			$this->setFont('Arial','',10);
			$this->cell(50,5,'PANJANG '.strtoupper($row->dimensi_kendaraan),'',0,'L');
			$this->cell(60,5,': '.$row->dbm_panjang,'R',0,'L');
			$this->cell(50,5,'JUMLAH ANGKUT ORANG','R',0,'L');
			$this->cell(20,5,$row->da_orang .' Orang','R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->setFont('Arial','',10);
			$this->Ln();
			$this->setFont('Arial','B',10);
			$this->cell(120,5,'SERTIFIKAT REGISTRASI UJI TIPE','LR',0,'L');
			$this->setFont('Arial','',10);
			$this->cell(50,5,'LEBAR '.strtoupper($row->dimensi_kendaraan),'',0,'L');
			$this->cell(60,5,': '.$row->dbm_lebar,'R',0,'L');
			$this->cell(50,5,'DAYA ANGKUT ORANG','R',0,'L');
			$this->cell(20,5,$row->jml_da_orang,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(20,5,'NOMOR','L',0,'L');
			$this->cell(100,5,': '.$row->no_sertifikasi_uji,'R',0,'L');
			$this->cell(50,5,'TINGGI '.strtoupper($row->dimensi_kendaraan),'',0,'L');
			$this->cell(60,5,': '.$row->dbm_tinggi,'R',0,'L');
			$this->cell(50,5,'DAYA ANGKUT BARANG','R',0,'L');
			$this->cell(20,5,$row->da_barang,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(20,5,'PENERBIT','L',0,'L');
			$this->cell(100,5,': '.$row->penerbit_sertifikasi_uji,'R',0,'L');
			$this->cell(50,5,'VOLUME / BERAT JENIS','',0,'L');
			$this->cell(60,5,': '.$row->dt_volume,'R',0,'L');
			$this->cell(50,5,'JBI','R',0,'L');
			$this->cell(20,5,$row->jbi,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->cell(20,5,'TANGGAL','L',0,'L');
			$this->cell(100,5,': '.$tgl_srut,'R',0,'L');
			$this->cell(50,5,'JENIS MUATAN','',0,'L');
			$this->cell(60,5,': '.$row->dt_jenis_muatan,'R',0,'L');
			$this->cell(50,5,'MUATAN SUMBU TERBERAT','R',0,'L');
			$this->cell(20,5,$row->mst,'R',0,'C');
			$this->cell(20,5,'','R',0,'C');
			$this->Ln();
			$this->setFont('Arial','B',10);
			$this->cell(120,5,'SERTIFIKAT RANCANG BANGUN','LR',0,'L');
			$this->cell(110,5,'JARAK SUMBU','R',0,'L');
			$this->setFont('Arial','',10);
			$this->cell(50,5,'KELAS JALAN','RB',0,'L');
			$this->cell(20,5,$row->kelas_jalan,'RB',0,'C');
			$this->cell(20,5,'','RB',0,'C');
			$this->Ln();
			$this->cell(20,5,'NOMOR','L',0,'L');
			$this->cell(100,5,': '.$row->no_rb,'R',0,'L');
			$this->cell(30,5,'SUMBU I-II','',0,'L');
			$this->cell(25,5,': '.$row->js_sumbu1,0,0,'L');
			$this->cell(30,5,'SUMBU III-IV','',0,'L');
			$this->cell(25,5,': '.$row->js_sumbu3,'R',0,'L');
			$this->setFont('Arial','B',10);
			$this->cell(50,5,'PEMAKAIAN BAN','R',0,'L');
			$this->setFont('Arial','',10);
			$this->cell(40,5,'','R',0,'C');
			$this->Ln();
			$this->cell(20,5,'PENERBIT','L',0,'L');
			$this->cell(100,5,': '.$row->penerbit_rb,'R',0,'L');
			$this->cell(30,5,'SUMBU II-III','',0,'L');
			$this->cell(25,5,': '.$row->js_sumbu2,0,0,'L');
			$this->cell(30,5,'SUMBU IV-V','',0,'L');
			$this->cell(25,5,': '.$row->js_sumbu4,'R',0,'L');
			$this->cell(50,5,'SUMBU I','R',0,'L');
			$this->cell(40,5,$row->ban_sumbu1,'R',0,'L');
			$this->Ln();
			$this->cell(20,5,'TANGGAL','LB',0,'L');
			$this->cell(100,5,': '.$tgl_rb,'RB',0,'L');
			$this->cell(30,5,'SUMBU P','',0,'L');
			$this->cell(25,5,': '.$row->js_sumbup,0,0,'L');
			$this->cell(30,5,'SUMBU R','',0,'L');
			$this->cell(25,5,': '.$row->js_sumbur,'R',0,'L');
			$this->cell(50,5,'SUMBU II','R',0,'L');
			$this->cell(40,5,$row->ban_sumbu2,'R',0,'L');
			$this->Ln();
			$this->setFont('Arial','B',10);
			$this->cell(120,5,'PENGIRIMAN KARTU (MUTASI)',1,0,'C');
			$this->setFont('Arial','',10);
			$this->cell(30,5,'SUMBU Q','',0,'L');
			$this->cell(25,5,': '.$row->js_sumbuq,0,0,'L');
			$this->cell(30,5,'SUMBU B','',0,'L');
			$this->cell(25,5,': '.$row->js_sumbub,'R',0,'L');
			$this->cell(50,5,'SUMBU III','R',0,'L');
			$this->cell(40,5,$row->ban_sumbu3,'R',0,'L');
			$this->Ln();
			$this->cell(30,5,'','LR',0,'L');
			$this->cell(90,5,'','R',0,'L');
			$this->cell(50,5,'JARAK TERENDAH','',0,'L');
			$this->cell(60,5,': ','R',0,'L');
			$this->cell(50,5,'SUMBU IV','R',0,'L');
			$this->cell(40,5,$row->ban_sumbu4,'R',0,'L');
			$this->Ln();
			$this->cell(30,5,'','LRB',0,'L');
			$this->cell(90,5,'','RB',0,'L');
			$this->cell(50,5,'KONFIGURASI SUMBU','',0,'L');
			$this->cell(60,5,': '.$row->konf_sumbu,'R',0,'L');
			$this->cell(50,5,'SUMBU V','RB',0,'L');
			$this->cell(40,5,$row->ban_sumbu5,'RB',0,'L');
			$this->Ln();
			$this->cell(30,5,'','LR',0,'L');
			$this->cell(90,5,'','R',0,'L');
			$this->setFont('Arial','B',10);
			$this->cell(110,5,'KEMAMPUAN KENDARAAN MENURUT PABRIK','R',0,'L');
			$this->setFont('Arial','',10);
			$this->Ln();
			$this->cell(30,5,'','LRB',0,'L');
			$this->cell(90,5,'','RB',0,'L');
			$this->cell(30,5,'SUMBU I','',0,'L');
			$this->cell(25,5,': '.$row->kema_sumbu1,0,0,'L');
			$this->cell(30,5,'SUMBU IV','',0,'L');
			$this->cell(25,5,': '.$row->kema_sumbu4,'R',0,'L');
			$this->cell(90,5,'PENGESAHAN PENGUJI',0,0,'C');
			$this->Ln();
			$this->cell(30,5,'','LR',0,'L');
			$this->cell(90,5,'','R',0,'L');
			$this->cell(30,5,'SUMBU II','',0,'L');
			$this->cell(25,5,': '.$row->kema_sumbu2,0,0,'L');
			$this->cell(30,5,'SUMBU V','',0,'L');
			$this->cell(25,5,': ','R',0,'L');
			$this->Ln();
			$this->cell(30,5,'','LRB',0,'L');
			$this->cell(90,5,'','RB',0,'L');
			$this->cell(30,5,'SUMBU III','',0,'L');
			$this->cell(25,5,': '.$row->kema_sumbu3,0,0,'L');
			$this->cell(55,5,'','R',0,'L');
			$this->Ln();
			$this->cell(30,5,'','LR',0,'L');
			$this->cell(90,5,'','R',0,'L');
			$this->setFont('Arial','B',10);
			$this->cell(110,5,'PENGGUNAAN KENDARAAN YANG KHUSUS','R',0,'L');
			$this->setFont('Arial','',10);
			$this->Ln();
			$this->cell(30,5,'','LRB',0,'L');
			$this->cell(90,5,'','RB',0,'L');
			$this->cell(45,5,'BARANG KHUSUS','',0,'L');
			$this->cell(65,5,': ','R',0,'L');
			$this->Ln();
			$this->cell(30,5,'','LR',0,'L');
			$this->cell(90,5,'','R',0,'L');
			$this->cell(45,5,'PENGGUNAAN KHUSUS','',0,'L');
			$this->cell(65,5,': ','R',0,'L');
			$this->cell(90,5,'(.............................................)',0,0,'C');
			$this->Ln();
			$this->cell(30,5,'','LRB',0,'L');
			$this->cell(90,5,'','RB',0,'L');
			$this->cell(110,5,'','RB',0,'L');
			$this->setFont('Arial','B',10);
			$this->Ln(6);
			$this->cell(60,5,'NOMOR KARTU INDUK',0,0,'L');
			$this->cell(40,5,': ',0,0,'L');
			$this->Ln();
			$this->cell(60,5,'PERTAMA KALI DITERBITKAN DI',0,0,'L');
			$this->cell(40,5,': '.$row->tempat_pemakaian_pertama,0,0,'L');
			$this->Ln();
			$this->cell(60,5,'PADA TANGGAL',0,0,'L');
			$this->cell(40,5,': '.$tgl_pertama,0,0,'L');
			$this->Ln(5);
			
			$this->setFont('Arial','BI',10);
			$this->cell(20,5,'CATATAN',0,0,'L');
			$this->setFont('Arial','I',10);
			$this->cell(200,5,': Dokumen ini adalah Kartu Induk Dinas Perhubungan Kabupaten Madiun Sesuai DATA/SALINAN Aslinya.',0,0,'L');
		}
	}
	
	function Content2($detail_kendaraan){
		foreach($detail_kendaraan as $row){
			if(($row->tgl_stnk=="") || ($row->tgl_stnk=="0000-00-00")){
				$tgl_stnk = "";
			} else {
				$tgl_stnk = date("d M Y",strtotime($row->tgl_stnk));
			}
			$this->setFont('Times','B',18);
			$this->setFillColor(255,255,255);
			$this->cell(20,0);
			$this->cell(220,8,'',0,0,'L');
			//$this->cell(220,8,'PEMERINTAH KABUPATEN Madiun',0,0,'L');
			$this->cell(80,7,$row->no_uji,1,0,'C');
			$this->ln();
			$this->cell(20,0);
			$this->cell(220,8,'',0,0,'L');
			//$this->cell(220,8,'DINAS PERHUBUNGAN',0,0,'L');
			$this->cell(80,7,$row->no_kendaraan,1,0,'C');
			$this->ln();
			$this->cell(240,0);
			$this->cell(80,7,$row->jenis,1,0,'C');
			$this->ln();
			$this->setFont('Arial','B',20);	
			$this->cell(240,7,'KARTU UJI BERKALA',0,0,'C');
			$this->setFont('Times','B',18);
			$this->cell(80,7,strtoupper($row->sifat),1,0,'C');
		
			//$this->Image(base_url().'assets/images/logo-kab-Madiun.png',5,5,15,0,'PNG');
			$this->Image(base_url().'files/qrcode/'.$row->qrcode,215,5,25,0,'PNG');
			$this->setFillColor(255,255,255);

			//$this->Image(base_url().'files/foto/'.$row->kode_uji.'/'.$row->kode_uji.'_CAM2.jpg',263,48,55,0,'JPG');
			//$this->Image(base_url().'files/foto/'.$row->kode_uji.'/'.$row->kode_uji.'_CAM2.jpg',257,102,66,0,'JPG');
			//$this->Image(base_url().'files/kendaraan/'.$row->no_uji.'/CAM3.jpg',257,124,66,0,'JPG');
			//$this->Image(base_url().'files/kendaraan/'.$row->no_uji.'/CAM4.jpg',257,162,66,0,'JPG');
			
			$this->setFont('Arial','B',12);
			$this->Ln(12);
			$this->cell(250,9,'RIWAYAT KEPEMILIKAN KENDARAAN',1,0,'C');
			$this->cell(70,9,'FOTO KENDARAAN','TBR',0,'C');
			$this->Ln();
			$this->setFont('Arial','',10);
			$this->cell(10,7,'NO',1,0,'C');
			$this->cell(40,7,'TGL STNK',1,0,'C');
			$this->cell(80,7,'NAMA PEMILIK',1,0,'C');
			$this->cell(120,7,'ALAMAT',1,0,'C');
			$this->cell(70,7,'','R',0,'C');
			$this->Ln();
			$this->cell(10,10,'1','RL',0,'C');
			$this->cell(40,10,$tgl_stnk,'RL',0,'C');
			$this->cell(80,10,$row->nama,'RL',0,'L');
			$this->cell(120,10,$row->alamat.' '.$row->kecamatan,'RL',0,'L');
			$this->cell(70,10,'','RL',0,'C');
			$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(10,10,'',1,0,'C');
			$this->cell(40,10,'',1,0,'C');
			$this->cell(80,10,'',1,0,'C');
			$this->cell(120,10,'','BTL',0,'C');
			$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(10,10,'',1,0,'C');
			$this->cell(40,10,'',1,0,'C');
			$this->cell(80,10,'',1,0,'C');
			$this->cell(120,10,'','BTL',0,'C');
			$this->cell(70,10,'','RL',0,'C');
			
			$this->Ln();
			$this->setFont('Arial','B',12);
			$this->cell(250,9,'RIWAYAT PENGUJIAN KENDARAAN BERMOTOR',1,0,'C');
			$this->setFont('Arial','',10);
			$this->cell(70,9,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,7,'TANGGAL UJI',1,0,'C');
			$this->cell(30,7,'HABIS UJI',1,0,'C');
			$this->cell(190,7,'CATATAN / KETERANGAN',1,0,'C');
			$this->cell(70,7,'TTD dan NAMA PENGUJI',1,0,'C');
			//$this->cell(70,7,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln();
			$this->cell(30,10,'',1,0,'C');
			$this->cell(30,10,'',1,0,'C');
			$this->cell(190,10,'',1,0,'C');
			$this->cell(70,10,'',1,0,'C');
			//$this->cell(70,10,'','RL',0,'C');
			$this->Ln(12);
			$this->setFont('Arial','BI',10);
			$this->cell(20,5,'CATATAN',0,0,'L');
			$this->setFont('Arial','I',10);
			$this->cell(200,5,': Dokumen ini adalah Kartu Induk Dinas Perhubungan Kabupaten Madiun Sesuai DATA/SALINAN Aslinya.',0,0,'L');
		}
	}
}


$this->fpdf = new PDF("L","mm",array(210,330));
$this->fpdf->SetMargins(5,5,5); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',125,65,80,0,'PNG');
$this->fpdf->Content($detail_kendaraan);
$this->fpdf->AddPage();
//$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',125,65,80,0,'PNG');
$this->fpdf->Content2($detail_kendaraan);
$this->fpdf->Output("I",$title);
?>