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
		$this->cell(160,6,'BIDANG ANGKUTAN',0,0,'C');
		$this->ln();
		$this->setFont('Times','',12);
		$this->cell(20,0);
		$this->cell(160,5,'Jl. Gatot Subroto, Komplek Sarana Perhubungan Terpadu Dukuhsalam Slawi',0,0,'C');
		$this->ln();
		$this->cell(20,0);
		$this->cell(160,5,'Kode Pos : 52417, email : dishub@tegalkab.go.id',0,0,'C');
		$this->ln();
		$this->SetLineWidth(0.7);
		$this->Line(200,35,10,35);
		$this->SetLineWidth(0.5);
		$this->Line(200,36,10,36);
		$this->Image(base_url().'assets/images/logo-kab-tegal.png',10,5,20,0,'PNG');
		$this->ln(5);
	}
	
	function Surat($detail_surat){
		foreach($detail_surat as $row){
			$this->setFont('Times','BU',14);
			$this->cell(190,6,'SURAT PERSETUJUAN NUMPANG UJI KENDARAAN BERMOTOR',0,0,'C');
			$this->ln();
			$this->setFont('Times','',12);
			$this->cell(190,6,'NOMOR : 551.2/'.$row->no_surat,0,0,'C');
			$this->ln(10);
			
			$this->cell(15,0);
			$this->cell(90,10,'Berdasarkan Permohonan Pemilik Kendaraan Bermotor di bawah ini :',0,0,'L');
			$this->ln();
			$this->cell(35,6,'Nama Pemilik',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,$row->nama,0,0,'L');
			$this->ln();
			$this->cell(35,6,'Alamat',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->Multicell(130,6,$row->alamat.' '.$row->kecamatan.' '.$row->kota,0,'J');
			$this->cell(35,6,'Nomor Uji',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,$row->no_uji,0,0,'L');
			$this->ln();
			$this->cell(35,6,'Nomor Kendaraan',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,$row->no_kendaraan,0,0,'L');
			$this->ln();
			
			$this->cell(35,6,'Jenis Kendaraan',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,$row->jenis.' ('.$row->bentuk.')',0,0,'L');
			$this->ln();
			$this->cell(35,6,'Merk dan Tipe',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,$row->merek.' / '.$row->tipe,0,0,'L');
			$this->ln();
			$this->cell(35,6,'Tahun Pembuatan',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,$row->tahun,0,0,'L');
			$this->ln();
			$this->cell(35,6,'Nomor Rangka',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,$row->no_rangka,0,0,'L');
			$this->ln();
			$this->cell(35,6,'Nomor Mesin',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,$row->no_mesin,0,0,'L');
			$this->ln();
			$this->cell(35,6,'Habis Uji',0,0,'L');
			$this->cell(5,6,':',0,0,'L');
			$this->cell(90,6,strftime("%d %B %Y",strtotime($row->tgl_habis_uji)),0,0,'L');
			$this->ln(8);
			$this->cell(15,0);
			$this->cell(90,10,'Pada prinsipnya kami tidak keberatan kendaraan tersebut dimaksud untuk diuji di :',0,0,'L');
			$this->ln();
			$this->setFont('Times','B',13);
			$this->cell(190,10,'DINAS PERHUBUNGAN '.strtoupper($row->kota_dinas),0,0,'C');
			$this->ln();
			$this->setFont('Times','',12);
			$this->cell(15,0);
			$this->cell(90,10,'Dengan ketentuan :',0,0,'L');
			$this->ln();
			$this->cell(5,6,'1.',0,0,'L');
			$this->Multicell(185,6,'Identifikasi kendaraan dan data pemilik, serta data dan dimensi kendaraan sesuai yang tercantum pada Kartu Uji dan Sertifikat Uji.',0,'J');
			$this->cell(5,6,'2.',0,0,'L');
			$this->Multicell(185,6,'Rekomendasi Numpang Uji berlaku untuk satu kali pengujian dan hasil ujinya agar dikirim kepada kami.',0,'J');
			$this->cell(5,6,'3.',0,0,'L');
			$this->Multicell(185,6,'Masa berlaku Surat Rekomendasi Numpang Uji Keluar sampai dengan tanggal '.strftime("%d %B %Y",strtotime($row->tgl_surat."+14 day")).'.',0,'J');
			$this->cell(15,0);
			$this->cell(90,10,'Demikian surat Rekomendasi ini dibuat agar dapat dipergunakan sebagaimana mestinya.',0,0,'L');
			$this->Image(base_url().'files/surat/'.date("Y",strtotime($row->tgl_surat)).'/'.date("F",strtotime($row->tgl_surat)).'/'.$row->qr_surat,10,290,30,0,'PNG');
			$this->Ln(15);
			$this->cell(110,8);
			$this->cell(50,8,'Jepara, '.strftime("%d %B %Y",strtotime($row->tgl_surat)),0,0,'C');
		}
	}
	
	function Ttd($dt_ttd){
		foreach($dt_ttd as $row){
			if($row->jabatan=="kadis"){
				$an = "KEPALA DINAS PERHUBUNGAN";
				$kb = "";
				$ub = "";
			} else if($row->jabatan=="kabid"){
				$an = "An. KEPALA DINAS PERHUBUNGAN";
				$kb = "Kepala Bidang Angkutan Jalan";
				$ub = "";
			} else if($row->jabatan=="kasie"){
				$an = "An. KEPALA DINAS PERHUBUNGAN";
				$kb = "Kepala Bidang Angkutan Jalan";
				$ub = "Ub. Kepala Seksi Pengujian Kendaraan Bermotor";
			}
			
			$this->Ln();
			$this->setFont('Times','B',12);
			$this->cell(110,0);
			$this->Cell(50,5,$an,0,0,'C');
			$this->Ln();
			$this->cell(110,0);
			$this->Cell(50,5,'KABUPATEN JEPARA',0,0,'C');
			$this->Ln();
			$this->setFont('Times','',12);
			$this->cell(110,0);
			$this->Cell(50,5,$kb,0,0,'C');
			$this->Ln();
			$this->setFont('Times','',12);
			$this->cell(110,0);
			$this->Cell(50,5,$ub,0,0,'C');
			$this->Ln();
			
			$this->setFont('Times','',10.5);
			$this->Multicell(80,5,'SURAT EDARAN DIRJEN PERHUBUNGAN DARAT NO AJ.402/9/10/DRJD/2003 NUMPANG UJI HANYA DIBERIKAN SATU KALI, UNTUK PENGUJIAN BERIKUTNYA DI DINAS PERHUBUNGAN KABUPATEN JEPARA',1,'C');
			
			$this->setFont('Times','BU',12);
			$this->cell(110,0);
			$this->Cell(50,5,$row->nama,0,0,'C');
			$this->Ln();
			$this->setFont('Times','',12);
			$this->cell(110,0);
			$this->Cell(50,5,'NIP. '.$row->nip,0,0,'C');
			$this->Ln(15);
			
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
$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',65,100,80,0,'PNG');
//$this->fpdf->Image(base_url().'files/ttd/stempel.png',105,215,45,0,'PNG');
$this->fpdf->Surat($detail_surat);
$this->fpdf->Ttd($dt_ttd);
$this->fpdf->Output("I",$title);
?>