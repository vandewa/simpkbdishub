<?php
class PDF extends FPDF
{
	
	function header(){
		$this->setFont('ARIAL','B',10);
		$this->cell(190,5,'PEMERINTAH KABUPATEN SEMARANG',0,0,'C');
		$this->ln();
		$this->cell(190,5,'DINAS PERHUBUNGAN',0,0,'C');
		$this->ln();
		$this->cell(190,5,'TANDA BUKTI PEMBAYARAN',0,0,'C');
		$this->setFont('ARIAL','',10);
		$this->ln();
		$this->cell(190,5,'Nomor :             /TBP/Penerimaan Tunai/1.07.01/A01/Bendahara Penerimaan',0,0,'C');

	}
	
	function total($total_retribusi){
		$this->ln(10);
		$this->cell(60,5,'telah membayar uang sebesar',0,0,'L');
		$this->setFont('ARIAL','B',10);
		$this->cell(100,5,'Rp. '.number_format($total_retribusi, 2, ".", ","),0,0,'L');
	}
	
	function terbilang($terbilang){
		$this->ln();
		$this->cell(60,5,'',0,0,'L');
		$this->cell(100,5,'('.$terbilang.' Rupiah)',0,0,'L');
		
		$this->setFont('ARIAL','',10);
		$this->ln(10);
		$this->cell(60,5,'Dari',0,0,'L');
		$this->cell(100,5,': FAJAR MEI RAHMANA',0,0,'L');
		$this->ln();
		$this->cell(60,5,'Jabatan',0,0,'L');
		$this->cell(100,5,': Bendahara Pembantu Seksi Pengujian Kendaraan Bermotor',0,0,'L');
		$this->ln();
		$this->cell(60,5,'Sebagai Pembayaran',0,0,'L');
		$this->cell(100,5,': Diterima Retribusi Pengujian Kendaraan Bemotor',0,0,'L');
		$this->ln(7);
		$this->cell(70,5,'Dengan rincian sebagai berikut : ',0,0,'L');
		$this->setFont('ARIAL','B',10);
		
		$this->ln(10);
		$this->cell(10,6,'No',1,0,'C');
		$this->cell(50,6,'Kode Rekening',1,0,'C');
		$this->cell(90,6,'Uraian Rincian Obyek',1,0,'C');
		$this->cell(40,6,'Jumlah (Rp.)',1,0,'C');
		$this->setFont('ARIAL','',10);
		$this->ln();
		$this->cell(10,6,'1.',1,0,'C');
		$this->cell(50,6,'4. 1. 2. 01. 07.',1,0,'C');
		$this->cell(90,6,'Retribusi Pengujian Kendaraan Bermotor',1,0,'C');
		$this->cell(40,6,'',1,0,'R');
	}
	
	function sts($dt_sts){
		foreach($dt_sts as $row){
			$jml_total = number_format($row->total_retribusi+$row->total_retribusi_terhutang+$row->total_tanda, 2, ".", ",");
			$jml_denda = number_format($row->total_denda, 2, ".", ",");

			$this->ln();
			$this->cell(10,6,'',1,0,'C');
			$this->cell(50,6,'',1,0,'C');
			$this->cell(90,6,'Bulan '.date("F Y",strtotime($row->tgl_pembayaran)),1,0,'C');
			$this->cell(40,6,$jml_total,1,0,'R');
		}
	}
	
	function jumlah($total_retribusi){
		$jml_denda = number_format($total_retribusi, 2, ".", ",");
		$this->ln();
		$this->cell(10,8,'',1,0,'C');
		$this->cell(50,8,'',1,0,'C');
		$this->setFont('ARIAL','B',10);
		$this->cell(90,8,'JUMLAH',1,0,'R');
		$this->cell(40,8,$jml_denda,1,0,'R');
	}
	
	function pejabat($tgl_akhir){
		$this->setFont('ARIAL','',10);
		$this->ln(10);
		$this->cell(190,5,'Tanggal diterima uang : '.date("d F Y",strtotime($tgl_akhir)),0,0,'L');
		$this->ln(10);
		$this->cell(60,5,'Mengetahui,',0,0,'C');
		$this->ln();
		$this->cell(60,5,'Bendahara Penerimaan',0,0,'C');
		$this->cell(60,5);
		$this->cell(60,5,'Pembayar / Penyetor',0,0,'C');
		$this->ln(20);
		$this->setFont('ARIAL','UB',10);
		$this->cell(60,5,'JUMINI',0,0,'C');
		$this->cell(60,5);
		$this->cell(60,5,'FAJAR MEI RAHMANA',0,0,'C');
		$this->ln();
		$this->setFont('ARIAL','',10);
		$this->cell(60,5,'NIP. 19641217 198801 2 001',0,0,'C');
		$this->cell(60,5);
		$this->cell(60,5,'NIP. 19740505 200901 1 005',0,0,'C');
		$this->ln(15);
		$this->setFont('ARIAL','',8);
		$this->cell(40,4,'Lembar Asli',0,0,'L');
		$this->cell(60,4,': untuk pembayaran / penyetor / pihak ketiga',0,0,'L');
		$this->ln();
		$this->cell(40,4,'Salinan pertama',0,0,'L');
		$this->cell(60,4,': untuk bendahara',0,0,'L');
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->total($total_retribusi);
$this->fpdf->terbilang($terbilang);
$this->fpdf->sts($dt_sts);
$this->fpdf->jumlah($total_retribusi);
$this->fpdf->pejabat($tgl_akhir);
$this->fpdf->Output("I",$title);
?>