<?php
class PDF extends FPDF
{
	protected $javascript;
	protected $n_js;

	function IncludeJS($script, $isUTF8=false) {
		if(!$isUTF8)
			$script=utf8_encode($script);
		$this->javascript=$script;
	}

	function _putjavascript() {
		$this->_newobj();
		$this->n_js=$this->n;
		$this->_put('<<');
		$this->_put('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');
		$this->_put('>>');
		$this->_put('endobj');
		$this->_newobj();
		$this->_put('<<');
		$this->_put('/S /JavaScript');
		$this->_put('/JS '.$this->_textstring($this->javascript));
		$this->_put('>>');
		$this->_put('endobj');
	}

	function _putresources() {
		parent::_putresources();
		if (!empty($this->javascript)) {
			$this->_putjavascript();
		}
	}

	function _putcatalog() {
		parent::_putcatalog();
		if (!empty($this->javascript)) {
			$this->_put('/Names <</JavaScript '.($this->n_js).' 0 R>>');
		}
	}
	
	function AutoPrint($printer=''){
        // Open the print dialog
        if($printer)
        {
            $printer = str_replace('\\', '\\\\', $printer);
            $script = "var pp = getPrintParams();";
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
            $script .= "pp.printerName = '$printer'";
            $script .= "print(pp);";
        }
        else
            $script = 'print(true);';
        $this->IncludeJS($script);
    }
	
	function header(){
		$this->setFont('Times','',12);
		$this->setFillColor(255,255,255);
		$this->multicell(190,6,'Gunakan Bukti Booking Antrian Berikut Untuk Melakukan Verifikasi dan Pendaftaran Pengujian Kendaraan Bermotor Dinas Perhubungan Kabupaten Jepara',1,'C');
	}
	
	function Content($dt_booking){
		foreach($dt_booking as $row){
			$this->Image(base_url().'files/booking/'.$row->kode_booking.'.png',90,23,0,30,'PNG');
			$this->ln(35);
			$this->setFont('Times','B',12);
			$this->cell(190,6,$row->kode_booking,0,0,'C');
			$this->ln(10);
			$this->setFont('Times','',10);
			$this->cell(190,5,'Anda telah melakukan pendaftaran dengan Jenis Pelayanan : Uji '.$row->jenis_pendaftaran,0,0,'C');
			$this->ln();
			$this->cell(190,5,'Tanggal Rencana Uji : '.strftime("%d %B %Y", strtotime($row->tgl_booking)),0,0,'C');
			$this->ln();
			$this->cell(190,5,'Tanggal Pendaftaran : '.strftime("%d %B %Y %H:%M:%S", strtotime($row->tgl_pra_daftar)),0,0,'C');
			$this->ln(7);
			$this->setFont('Times','B',10);
			$this->multicell(190,6,'*Dimohon Untuk Membawa Bukti Pendaftaran Ini / Whatsapp Bukti Pendaftaran Saat Melakukan Verifikasi Pendaftaran.',0,'C');
			$this->multicell(190,6,'*Kendaraan WAJIB HADIR sesuai dengan tanggal pendaftaran diatas, Jika melebihi batas waktu tersebut akan dikenakan sanksi yang berlaku.',0,'C');
			$this->setFont('Times','',10);
			$this->ln();
			$this->cell(190,5,'BERIKUT LANGKAH-LANGKAH MELAKUKAN VERIFIKASI :','TRL',0,'L');
			$this->ln();
			$this->multicell(190,5,'1. Menunjukkan bukti booking kepada petugas untuk dilakukan scan barcode atau verifikasi pemesanan di loket pelayanan.','RL','J');
			$this->multicell(190,5,'2. Melakukan verifikasi pendaftaran di loket pelayanan/loket 1.','RL','J');
			$this->multicell(190,5,'3. Melakukan pembayaran di loket pelayanan/loket 2.','RL','J');
			$this->multicell(190,5,'4. Jika verifikasi pendaftaran melewati batas waktu habis uji kendaraan, maka kendaraan akan dikenakan sanksi administrasi sesuai dengan waktu keterlambatan uji.','RLB','J');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,210));
$this->fpdf->SetMargins(10,5,10); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
//$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',90,40,30,0,'PNG');
$this->fpdf->Content($dt_booking);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>