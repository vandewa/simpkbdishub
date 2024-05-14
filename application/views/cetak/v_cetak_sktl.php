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
	
	function Surat($dt_sktl){
		foreach($dt_sktl as $row){
			$this->ln(5);
			$this->setFont('TIMES','BU',12);
			$this->cell(20,5);
			$this->cell(160,5,'SURAT KETERANGAN TIDAK LULUS UJI',0,0,'C');
			$this->Ln();
			$this->setFont('TIMES','',12);
			$this->cell(20,5);
			$this->cell(160,5,'Nomor : 511.2/'.$row->no_surat,0,0,'C');
			$this->Ln(10);
			$this->Multicell(190,6,'          Mendasari Undang-Undang nomor 22 Tahun 2009 tentang Lalu Lintas dan Angkutan Jalan, Peraturan Pemerintah Republik Indonesia Nomor 55 Tahun 2012 tentang Kendaraan, Peraturan Menteri Perhubungan Nomor PM 133 Tahun 2015 Tentang Pengujian Berkala Kendaraan Bermotor. Setelah dilakukan pemeriksaan pengujian kendaraan bermotor secara administrasi dan teknis pada tanggal '.strftime("%d %B %Y",strtotime($row->tgl_uji)).' di UPUBKB Kabupaten Wonosobo dengan data kendaraan sebagai berikut :',0,'J');
			$this->cell(52,6,'1. Nomor Uji/ Kendaraan',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->setFont('TIMES','B',12);
			$this->cell(70,6,$row->no_uji.' / '.$row->no_kendaraan,0,0,'L');
			$this->Ln();
			$this->setFont('TIMES','',12);
			$this->cell(52,6,'2. Nama Pemilik',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->setFont('TIMES','B',12);
			$this->cell(70,6,$row->nama,0,0,'L');
			$this->Ln();
			$this->setFont('TIMES','',12);
			$this->cell(52,6,'3. Alamat Pemilik',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->setFont('TIMES','B',12);
			$this->cell(70,6,$row->alamat.' '.$row->kecamatan,0,0,'L');
			$this->Ln();
			$this->setFont('TIMES','',12);
			$this->cell(52,6,'4. Jenis Kendaraan ',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->setFont('TIMES','B',12);
			$this->cell(70,6,$row->jenis.' ('.$row->jenis_kendaraan.')',0,0,'L');
			$this->Ln();
			$this->setFont('TIMES','',12);
			$this->cell(52,6,'5. Nomor Rangka',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->setFont('TIMES','B',12);
			$this->cell(70,6,$row->no_rangka,0,0,'L');
			$this->Ln();
			$this->setFont('TIMES','',12);
			$this->cell(52,6,'6. Nomor Mesin',0,0,'L');
			$this->cell(3,6,':',0,0,'L');
			$this->setFont('TIMES','B',12);
			$this->cell(70,6,$row->no_mesin,0,0,'L');
			$this->Ln();
			$this->setFont('TIMES','',12);
			$this->cell(10,6);
			$this->cell(70,6,'Didapatkan kekurangan/kerusakan yang harus diperbaiki antara lain : ',0,0,'L');
		}
	}
	
	function Kerusakan($dt_kerusakan){
		$no = 1;
		foreach($dt_kerusakan as $row){
			if($row->aktif=='0'){
				$status = '(DIPERBAIKI)';
			} else {
				$status = '';
			}
			$this->Ln();
			$this->cell(150,5,$no++.'. '.$row->catatan.' '.$status,0,0,'L');
		}
	}
	
	function Surat2($dt_sktl,$jml_kerusakan){
		foreach($dt_sktl as $row){
			$this->Ln(8);
			$this->Multicell(190,6,'Sehingga, diperintahkan kepada pemilik kendaraan untuk melakukan perbaikan kekurangan teknis tersebut. Selanjutnya kendaraan tersebut diharuskan melakukan pengujian kendaraan ulang selambat-lambatnya pada tanggal '.strftime("%d %B %Y",strtotime($row->tgl_batas_perbaikan)).' di UPUBKB Kabupaten Wonosobo',0,'J');
			$this->cell(52,10,'Demikian untuk diketahui dan dilaksanakan sebagaimana mestinya.',0,0,'L');
			$this->Ln(10);
			$this->cell(115,5);
			$this->cell(50,5,'Wonosobo, '.strftime("%d %B %Y",strtotime($row->tgl_uji)),0,0,'C');
			$this->Ln();
			$this->cell(115,5);
			$this->setFont('TIMES','B',12);
			$this->cell(50,5,'PENGUJI KENDARAAN BERMOTOR',0,0,'C');
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
			
			$ln = ($jml_kerusakan*5)+165;
			//$this->Image(base_url().'files/ttd/'.$row->ttd.'.png',120,$ln,0,35,'PNG');
			$this->Image(base_url().'files/pendaftaran/'.date("Y-m-d",strtotime($row->tgl_daftar_uji)).'/'.$row->qr_kodeuji.'.png',10,290,0,30,'PNG');
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
$this->fpdf->Surat($dt_sktl);
$this->fpdf->Kerusakan($dt_kerusakan);
$this->fpdf->Surat2($dt_sktl,$jml_kerusakan);
$this->fpdf->Output("I",$title);
?>