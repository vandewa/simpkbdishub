<?php
class PDF extends FPDF
{	
	function header(){
		$this->setFont('Times','',12);
		$this->setFillColor(255,255,255);
		$this->cell(20,0);
		$this->cell(160,5,'PEMERINTAH KABUPATEN WONOSOBO',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(160,6,'DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERHUBUNGAN',0,0,'C');
		$this->ln();
		$this->setFont('Times','B',14);
		$this->cell(20,0);
		$this->cell(160,6,'UPTD PENGUJIAN KENDARAAN BERMOTOR',0,0,'C');
		$this->ln();
		$this->setFont('Times','',11);
		$this->cell(20,0);
		$this->cell(160,5,'Jl. Soepardjo Roestam No. 9A Andongsili Wonosobo Jawa Tengah 56351',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(160,5,'Telepon (0286)-321113 Faksimile (0286) 321113',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(160,5,'Laman: disperkimhub.wonosobokab.go.id Pos-el disperkimhub@wonosobokab.go.id',0,0,'C');
		$this->setFont('Times','',11);
		$this->ln();
		$this->SetLineWidth(0.7);
		$this->Line(200,39,10,39);
		$this->SetLineWidth(0.5);
		$this->Line(200,40,10,40);
		$this->Image(base_url().'assets/images/logo-kab-wonosobo.png',10,8,25,0,'PNG');
		$this->ln(5);
	}
	
	function Surat($detail_surat){		
		foreach($detail_surat as $row){
			if($row->dasar=='STNK'){
				$dasar = $row->dasar;
			} else {
				$dasar = "Surat Keterangan Fiskal Antar Daerah";
			}
			$this->cell(115,0);
			$this->cell(90,6,'Wonosobo, '.strftime("%d %B %Y",strtotime($row->tgl_surat)),0,0,'L');
			$this->ln(8);
			$this->cell(20,6,'Nomor',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			//$this->cell(90,6,'551.2/',0,0,'L');
			$this->cell(90,6,'551.2/'.$row->no_surat,0,0,'L');
			$this->cell(90,6,'K e p a d a',0,0,'L');
			$this->ln();
			$this->cell(20,6,'Sifat',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(80,6,'Biasa',0,0,'L');
			$this->cell(10,6,'Yth.',0,0,'L');
			$this->cell(90,6,'KEPALA DINAS PERHUBUNGAN',0,0,'L');
			$this->ln();
			$this->cell(20,6,'Lampiran',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,'1 (Satu) Berkas',0,0,'L');
			$this->cell(90,6,$row->kota_dinas,0,0,'L');
			$this->ln();
			$this->cell(20,6,'Perihal',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->setFont('Times','B',12);
			$this->cell(90,6,'Mutasi Uji Kendaraan',0,0,'L');
			$this->setFont('Times','',12);
			$this->cell(90,6,'di -',0,0,'L');
			$this->ln();
			$this->cell(120,0);
			$this->cell(90,6,$row->kota_tujuan,0,0,'L');
			
			$this->ln(10);
			$this->setleftmargin(20);
			$this->cell(15,0);
			$this->cell(90,10,'Dengan ini diberitahukan dengan hormat bahwa kendaraan di bawah ini :',0,0,'L');
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
			$this->cell(90,7,$row->nama,0,0,'L');
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
			$this->cell(35,7,'Tahun',0,0,'L');
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
			$this->Image(base_url().'files/surat/'.date("Y",strtotime($row->tgl_surat)).'/'.date("F",strtotime($row->tgl_surat)).'/'.$row->qr_surat,20,240,30,0,'PNG');
		}
	}
	
	function Surat1($detail_surat){		
		foreach($detail_surat as $row){
			if($row->dasar=='STNK'){
				$dasar = "Surat Tanda Nomor Kendaraan";
			} else {
				$dasar = "Surat Keterangan Fiskal Antar Daerah";
			}		
			$this->ln();
			$this->Multicell(170,7,'           Bahwa berdasarkan '.$dasar.' yang dikeluarkan oleh Kepala UPPD '.$row->kota_dasar.' BAPENDA Provinsi Jawa Tengah Tanggal '.strftime("%d %B %Y",strtotime($row->tgl_dasar)).' Nomor '.$row->no_dasar.' dan sesuai dengan permohonan pemilik kendaraan, kendaraan tersebut memenuhi syarat untuk dimutasikan / dipindahkan ke '.$row->kota_dinas.'. Dengan pemilik baru :',0,'J');
			//$this->Multicell(170,7,'            Sesuai dengan permohonan pemilik, kendaraan tersebut memenuhi syarat untuk di mutasi ke '.$row->kota_dinas.'. Dengan pemilik baru :',0,'J');
			$this->cell(35,7,'Nama',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->cell(90,7,$row->nama_baru,0,0,'L');
			$this->ln();
			$this->cell(35,7,'Alamat',0,0,'L');
			$this->cell(5,7,':',0,0,'L');
			$this->Multicell(125,7,$row->alamat_baru,0,'J');
			$this->cell(15,0);
			$this->cell(90,7,'Demikian disampaikan kepada saudara, untuk mendapatkan penyelesaian lebih lanjut.',0,0,'L');
		}
	}
	
	function Ttd($dt_ttd){
		foreach($dt_ttd as $row){
			if($row->jabatan=="kadis"){
				$an = "KEPALA DINAS PERUMAHAN";
				$ab = "KAWASAN PERMUKIMAN DAN PERHUBUNGAN";
				$kb = "";
				$ub = "";
			} else if($row->jabatan=="kabid"){
				$an = "An. KEPALA DINAS PERUMAHAN";
				$ab = "KAWASAN PERMUKIMAN DAN PERHUBUNGAN";
				$kb = $row->nama_jabatan;
				$ub = "";
			} else {
				$an = "An. KEPALA DINAS PERUMAHAN";
				$ab = "KAWASAN PERMUKIMAN DAN PERHUBUNGAN";
				$kb = $row->nama_jabatan;
				$ub = "";
			}
			$this->Ln(10);
			$this->setFont('Times','B',12);
			$this->cell(100,0);
			$this->Cell(50,5,$an,0,0,'C');
			$this->Ln();
			$this->cell(100,0);
			$this->Cell(50,5,$ab,0,0,'C');
			$this->Ln();
			$this->cell(100,0);
			$this->Cell(50,5,'KABUPATEN WONOSOBO',0,0,'C');
			$this->Ln();
			$this->setFont('Times','',12);
			$this->cell(100,0);
			$this->Cell(50,5,$kb,0,0,'C');
			$this->Ln();
			$this->setFont('Times','',12);
			$this->cell(100,0);
			$this->Cell(50,5,$ub,0,0,'C');
			$this->Ln(25);
			$this->setFont('Times','BU',12);
			$this->cell(100,0);
			$this->Cell(50,5,$row->nama,0,0,'C');
			$this->Ln();
			$this->setFont('Times','',12);
			$this->cell(100,0);
			$this->Cell(50,5,$row->pangkat,0,0,'C');
			$this->Ln();
			$this->setFont('Times','',12);
			$this->cell(100,0);
			$this->Cell(50,5,'NIP. '.$row->nip,0,0,'C');
			//$this->Image(base_url().'files/ttd/ttd-kabid.png',120,233,60,0,'PNG');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,5,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
//$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',65,100,80,0,'PNG');
//$this->fpdf->Berkala($berkala);
$this->fpdf->Surat($detail_surat);
$this->fpdf->Surat1($detail_surat);
$this->fpdf->Ttd($dt_ttd);
$this->fpdf->Output("I",$title);
?>