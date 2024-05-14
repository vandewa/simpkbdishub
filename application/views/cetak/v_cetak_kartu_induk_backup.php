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
			$this->cell(225,8,'PEMERINTAH KABUPATEN TEGAL',0,0,'L');
			$this->cell(75,8,$row->no_uji,1,0,'C');
			$this->ln();
			$this->cell(20,0);
			$this->cell(225,8,'DINAS PERHUBUNGAN',0,0,'L');
			$this->cell(75,8,$row->no_kendaraan,1,0,'C');
			$this->ln(15);
			$this->Image(base_url().'assets/images/logo-kab-tegal.png',5,5,15,0,'PNG');
			
			$this->Image(base_url().'files/qrcode/'.$row->qrcode,220,0,25,0,'PNG');
			$this->setFillColor(255,255,255);
			$this->setFont('Arial','B',16);			
			$this->cell(320,8,'KARTU REGISTER INDENTITAS KENDARAAN DAN SPESIFIKASI KENDARAAN WAJIB UJI',0,0,'C');
			
			/*
			$this->setFont('Arial','B',20);
			$this->cell(80,8,$row->no_uji,1,0,'C');
			$this->Ln();
			$this->setFont('Arial','B',16);
			$this->cell(240,8,'',0,0,'C');
			$this->setFont('Arial','B',20);
			$this->cell(80,8,$row->no_kendaraan,1,0,'C');
			*/
			
			$this->Ln(12);
			$this->setFont('Arial','B',12);
			$this->cell(320,7,'INDENTITAS KENDARAAN',1,0,'C');
			//$this->cell(100,8,'KEISTIMEWAAN','TB',0,'C');
			$this->setFont('Arial','B',10);
			$this->Ln(9);
			$this->cell(130,6,'KENDARAAN',1,0,'C');
			$this->cell(190,6,'PEMILIK','TBR',0,'C');
			$this->Ln();
			$this->setFont('Arial','',10);
			$this->cell(50,6,'NO UJI / NO KENDARAAN','L',0,'L');
			$this->cell(80,6,': '.$row->no_uji.' / '.$row->no_kendaraan,'R',0,'L');
			$this->cell(40,6,'NO KTP / NAMA',0,0,'L');
			$this->cell(150,6,': '.$row->no_ktp.' / '.$row->nama,'R',0,'L');
			$this->Ln();
			$this->cell(50,5,'MERK / TYPE / TAHUN','L',0,'L');
			$this->cell(80,5,': '.$row->merek.' / '.$row->tipe.' / '.$row->tahun,'R',0,'L');
			$this->cell(40,5,'ALAMAT',0,0,'L');
			$this->cell(150,5,': '.$row->alamat,'R',0,'L');
			$this->Ln();
			$this->cell(50,5,'NO RANGKA / NO MESIN','L',0,'L');
			$this->cell(80,5,': '.$row->no_rangka.' / '.$row->no_mesin,'R',0,'L');
			$this->cell(40,5,'KEC / KOTA / TELP',0,0,'L');
			$this->cell(150,5,': '.$row->kecamatan.' / '.$row->kota.' / '.$row->telp,'R',0,'L');
			$this->Ln();
			$this->cell(50,5,'JENIS / NAMA KOMERSIIL','L',0,'L');
			$this->cell(80,5,': '.$row->jenis_kendaraan.' / '.$row->jenis,'R',0,'L');
			$this->cell(190,5,'','R',0,'L');
			$this->Ln();
			$this->cell(50,5,'STATUS PENGGUNAAN','L',0,'L');
			$this->cell(80,5,': '.$row->status,'R',0,'L');
			$this->cell(40,5,'SERTIFIKASI','TBR',0,'C');
			$this->cell(70,5,'NOMOR','TBR',0,'C');
			$this->cell(25,5,'TANGGAL','TBR',0,'C');
			$this->cell(55,5,'PENERBIT','TBR',0,'C');
			$this->Ln();
			$this->cell(50,5,'WARNA KABIN / BAK','L',0,'L');
			$this->cell(80,5,': '.$row->warna,'R',0,'L');
			$this->cell(40,5,'UJI TIPE','R',0,'L');
			$this->cell(70,5,$row->no_ut,'R',0,'L');
			$this->cell(25,5,$tgl_ut,'R',0,'C');
			$this->cell(55,5,$row->penerbit_ut,'R',0,'L');
			$this->Ln();
			$this->cell(50,5,'PENGIMPORT / PABRIK','L',0,'L');
			$this->cell(80,5,': ','R',0,'L');
			$this->cell(40,5,'RANCANG BANGUN','R',0,'L');
			$this->cell(70,5,$row->no_rb,'R',0,'L');
			$this->cell(25,5,$tgl_rb,'R',0,'C');
			$this->cell(55,5,$row->penerbit_rb,'R',0,'L');
			$this->Ln();
			$this->cell(50,5,'PENGGUNAAN KHUSUS','LB',0,'L');
			$this->cell(80,5,': ','BR',0,'L');
			$this->cell(40,5,'REGISTRASI UJI TIPE','RB',0,'L');
			$this->cell(70,5,$row->no_sertifikasi_uji,'RB',0,'L');
			$this->cell(25,5,$tgl_srut,'RB',0,'C');
			$this->cell(55,5,$row->penerbit_sertifikasi_uji,'RB',0,'L');
			$this->Ln(12);
			
			$this->setFont('Arial','B',12);
			$this->cell(320,7,'SPESIFIKASI KENDARAAN',1,0,'C');
			$this->setFont('Arial','',10);
			$this->Ln(9);
			$this->cell(50,5,'SUMBU',1,0,'C');
			$this->cell(30,5,'KE-1','RBT',0,'C');
			$this->cell(30,5,'KE-2','RBT',0,'C');
			$this->cell(30,5,'KE-3','RBT',0,'C');
			$this->cell(30,5,'KE-4','RBT',0,'C');
			$this->cell(30,5,'KE-5','RBT',0,'C');
			$this->cell(60,5,' JBB / JBKB','T',0,'L');
			$this->cell(60,5,' : '.$row->jbb .' / '.$row->jbb_kombinasi.' Kg','RT',0,'L');
			$this->Ln();
			$this->cell(50,5,'BERAT (Kg)','LR',0,'L');
			$this->cell(30,5,$row->bk_sumbu1,'R',0,'C');
			$this->cell(30,5,$row->bk_sumbu2,'R',0,'C');
			$this->cell(30,5,$row->bk_sumbu3,'R',0,'C');
			$this->cell(30,5,$row->bk_sumbu4,'R',0,'C');
			$this->cell(30,5,'','R',0,'C');
			$this->cell(60,5,' BERAT KENDARAAN',0,0,'L');
			$this->cell(60,5,' : '.$row->bk_total.' Kg','R',0,'L');
			$this->Ln();
			$this->cell(50,5,'DAYA DUKUNG PABRIK (Kg)','LR',0,'L');
			$this->cell(30,5,$row->kema_sumbu1,'R',0,'C');
			$this->cell(30,5,$row->kema_sumbu2,'R',0,'C');
			$this->cell(30,5,$row->kema_sumbu3,'R',0,'C');
			$this->cell(30,5,$row->kema_sumbu4,'R',0,'C');
			$this->cell(30,5,'','R',0,'C');
			$this->cell(60,5,' DAYA ANGKUT',0,0,'L');
			$this->cell(60,5,' : '.$row->da_orang.' Orang / '.$row->jml_da_orang.' Kg','R',0,'L');
			$this->Ln();
			$this->cell(50,5,'UKURAN BAN','LR',0,'L');
			$this->cell(30,5,$row->ban_sumbu1,'R',0,'C');
			$this->cell(30,5,$row->ban_sumbu2,'R',0,'C');
			$this->cell(30,5,$row->ban_sumbu3,'R',0,'C');
			$this->cell(30,5,$row->ban_sumbu4,'R',0,'C');
			$this->cell(30,5,'','R',0,'C');
			$this->cell(60,5,' JBI / MST / KELAS JALAN',0,0,'L');
			$this->cell(60,5,' : '.$row->jbi.' Kg / '.$row->muatan_sum_berat.' Kg / '.$row->kelas_jl_min,'R',0,'L');
			$this->Ln();
			$this->cell(50,5,'','LRB',0,'L');
			$this->cell(30,5,'','RB',0,'C');
			$this->cell(30,5,'','RB',0,'C');
			$this->cell(30,5,'','RB',0,'C');
			$this->cell(30,5,'','RB',0,'C');
			$this->cell(30,5,'','RB',0,'C');
			$this->cell(60,5,' ISI SILINDER/BAHAN BAKAR/DAYA','B',0,'L');
			$this->cell(60,5,' : '.$row->isi_silinder.' CC / '.$row->bahan_bakar.' / '.$row->daya_motor.' KW/PS','RB',0,'L');
			
			$this->Ln(8);
			$this->cell(50,5,'DIMENSI',1,0,'C');
			$this->cell(30,5,'PANJANG (mm)','RBT',0,'C');
			$this->cell(30,5,'LEBAR (mm)','RBT',0,'C');
			$this->cell(30,5,'TINGGI (mm)','RBT',0,'C');
			$this->cell(60,5,' BAGIAN YANG MENJOROK','T',0,'L');
			$this->cell(60,5,' : KEBELAKANG (ROH) = '.$row->uk_julur_belakang.' mm','T',0,'L');
			$this->cell(60,5,'KEDEPAN (FOH) = '.$row->uk_julur_depan.' mm','RT',0,'L');
			$this->Ln();
			$this->cell(50,5,'KENDARAAN','RL',0,'L');
			$this->cell(30,5,$row->uk_panjang,'R',0,'C');
			$this->cell(30,5,$row->uk_lebar,'R',0,'C');
			$this->cell(30,5,$row->uk_tinggi,'R',0,'C');
			$this->cell(60,5,' KONFIGURASI SUMBU ',0,0,'L');
			$this->cell(120,5,' : '.$row->konf_sumbu,'R',0,'L');
			$this->Ln();
			$this->cell(50,5,'BAK MUATAN','RLB',0,'L');
			$this->cell(30,5,$row->dt_panjang,'RB',0,'C');
			$this->cell(30,5,$row->dt_lebar,'RB',0,'C');
			$this->cell(30,5,$row->dt_tinggi,'RB',0,'C');
			$this->cell(60,5,' JARAK TITIK BERAT ','B',0,'L');
			$this->cell(30,5,' : P1 = '.$row->js_sumbup.' mm','B',0,'L');
			$this->cell(30,5,'Q = '.$row->js_sumbuq.' mm','B',0,'L');
			$this->cell(30,5,'P2 = '.$row->js_sumbur.' mm','B',0,'L');
			$this->cell(30,5,'R = '.$row->js_sumbub.' mm','RB',0,'L');
			
			$this->Ln(8);
			$this->cell(60,5,'SUMBU',1,0,'C');
			$this->cell(40,5,'I-II','RBT',0,'C');
			$this->cell(40,5,'II-III','RBT',0,'C');
			$this->cell(40,5,'III - IV','RBT',0,'C');
			$this->cell(40,5,'IV - V',1,0,'C');
			$this->Ln(5);
			$this->cell(60,5,'JARAK (mm)','RLB',0,'C');
			$this->cell(40,5,$row->js_sumbu1,'RB',0,'C');
			$this->cell(40,5,$row->js_sumbu2,'RB',0,'C');
			$this->cell(40,5,$row->js_sumbu3,'RB','C');
			$this->cell(40,5,$row->js_sumbu4,1,0,'C');
			
			$this->Ln(8);
			$this->cell(60,5,'RUMAH RUMAH / KAROSERI',1,0,'C');
			$this->cell(40,5,'JENIS',1,0,'C');
			$this->cell(40,5,'BAHAN',1,0,'C');
			$this->cell(40,5,'TEMPAT DUDUK',1,0,'C');
			$this->cell(40,5,'TEMPAT BERDIRI',1,0,'C');
			$this->Ln();
			$this->cell(60,5,'',1,0,'C');
			$this->cell(40,5,$row->karoseri,1,0,'C');
			$this->cell(40,5,$row->dbm_bahan_bak,1,0,'C');
			$this->cell(40,5,$row->tempat_duduk,1,0,'C');
			$this->cell(40,5,$row->tempat_berdiri,1,0,'C');
			
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
			$this->Ln(8);
			
			$this->setFont('Arial','BI',10);
			$this->cell(20,5,'CATATAN',0,0,'L');
			$this->setFont('Arial','I',10);
			$this->cell(200,5,': Dokumen ini adalah Kartu Induk Dinas Perhubungan Kabupaten Tegal Sesuai DATA/SALINAN Aslinya.',0,0,'L');
		}
	}
	
	function Content2($detail_kendaraan){
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
			
			$this->setFont('Times','B',18);
			$this->setFillColor(255,255,255);
			$this->cell(20,0);
			$this->cell(220,8,'PEMERINTAH KABUPATEN TEGAL',0,0,'L');
			$this->cell(80,8,$row->no_uji,1,0,'C');
			$this->ln();
			$this->cell(20,0);
			$this->cell(220,8,'DINAS PERHUBUNGAN',0,0,'L');
			$this->cell(80,8,$row->jenis,1,0,'C');
			$this->ln(15);
			$this->Image(base_url().'assets/images/logo-kab-tegal.png',5,5,15,0,'PNG');
			
			$this->Image(base_url().'files/qrcode/'.$row->qrcode,220,0,25,0,'PNG');
			$this->setFillColor(255,255,255);
			$this->setFont('Arial','B',16);			
			$this->cell(320,8,'KARTU RIWAYAT KEPEMILIKAN DAN PENGUJIAN KENDARAAN WAJIB UJI',0,0,'C');
			
			/*
			$this->setFont('Arial','B',20);
			$this->cell(80,8,$row->no_uji,1,0,'C');
			$this->Ln();
			$this->setFont('Arial','B',16);
			$this->cell(240,8,'',0,0,'C');
			$this->setFont('Arial','B',20);
			$this->cell(80,8,$row->no_kendaraan,1,0,'C');
			*/
			$this->Image(base_url().'files/kendaraan/'.$row->no_uji.'/CAM2.jpg',185,50,70,0,'JPG');
			$this->Image(base_url().'files/kendaraan/'.$row->no_uji.'/CAM3.jpg',255,50,70,0,'JPG');
			
			$this->setFont('Arial','B',10);
			$this->Ln(9);
			$this->cell(180,6,'DATA KEPEMILIKAN',1,0,'C');
			$this->cell(140,6,'FOTO KENDARAAN','TBR',0,'C');
			$this->Ln();
			$this->setFont('Arial','',10);
			$this->cell(10,6,'NO',1,0,'C');
			$this->cell(70,6,'NAMA / PERUSAHAAN',1,0,'C');
			$this->cell(100,6,'ALAMAT',1,0,'C');
			$this->cell(70,6,'DEPAN',1,0,'C');
			$this->cell(70,6,'BELAKANG',1,0,'C');
			$this->Ln();
			$this->cell(10,6,'','RL',0,'C');
			$this->cell(70,6,$row->nama,'RL',0,'L');
			$this->cell(100,6,$row->alamat.' '.$row->kecamatan,'RL',0,'L');
			$this->cell(70,6,'','RL',0,'C');
			$this->cell(70,6,'','RL',0,'C');
			$this->Ln();
			$this->cell(10,34,'','BRL',0,'C');
			$this->cell(70,34,'','BRL',0,'C');
			$this->cell(100,34,'','BRL',0,'C');
			$this->cell(70,34,'','BRL',0,'C');
			$this->cell(70,34,'','BRL',0,'C');
			$this->Ln(40);
			$this->setFont('Arial','B',10);
			$this->cell(320,7,'RIWAYAT PENGUJIAN KENDARAAN BERMOTOR',1,0,'C');
			$this->setFont('Arial','',10);
			$this->Ln();
			$this->cell(40,5,'TANGGAL',1,0,'C');
			$this->cell(40,5,'MASA UJI BERKALA',1,0,'C');
			$this->cell(70,5,'CATATAN',1,0,'C');
			$this->cell(170,5,'KETERANGAN',1,0,'C');
			$this->Ln();
			$this->cell(40,90,'',1,0,'C');
			$this->cell(40,90,'',1,0,'C');
			$this->cell(70,90,'',1,0,'C');
			$this->cell(170,90,'',1,0,'C');
			$this->Ln(95);
			$this->setFont('Arial','BI',10);
			$this->cell(20,5,'CATATAN',0,0,'L');
			$this->setFont('Arial','I',10);
			$this->cell(200,5,': Dokumen ini adalah Kartu Induk Dinas Perhubungan Kabupaten Tegal Sesuai DATA/SALINAN Aslinya.',0,0,'L');
		}
	}
	
	function Content3($detail_kendaraan){
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
		}
	}

}

$this->fpdf = new PDF("L","mm",array(210,330));
$this->fpdf->SetMargins(5,5,5); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_kendaraan);
$this->fpdf->AddPage();
$this->fpdf->Content2($detail_kendaraan);
//$this->fpdf->AddPage();
//$this->fpdf->Content2($detail_kendaraan);
$this->fpdf->Output("I",$title);
?>