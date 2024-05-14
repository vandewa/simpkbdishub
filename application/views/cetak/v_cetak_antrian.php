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
	
	/*
	function AutoPrint($dt_printer,$printer=''){
		foreach($dt_printer as $row){
			$print = explode('-', $row->stiker);
			$server = $print[0];
			$printer = $print[1];
		}
        // Open the print dialog
		//$server = "192.168.1.12";
		//$printer = "Canon iP2700 series";
        if($printer)
        {
           // $printer = str_replace('\\', '\\\\', $printer);
            $script = "var pp = getPrintParams();";
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
			//$script .= "pp.printerName = '$printer'";
			if($server==""){
				$script .= "pp.printerName = '".$printer."';";
			} else {
				$script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
			}
            $script .= "print(pp);";
        }
        else
            $script = 'print(true);';
        $this->IncludeJS($script);
    }
	*/
	
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
		$this->setFont('Arial','B',9);
		$this->setFillColor(255,255,255);
		$this->cell(70,4,'SELAMAT DATANG DI UPUBKB',0,0,'C');
		$this->ln();
		$this->cell(70,4,'DINAS PERHUBUNGAN KABUPATEN WONOSOBO',0,0,'C');
		$this->ln();
	}
	
	function Content($dt_antrian){
		foreach($dt_antrian as $row){
			$this->ln(3);
			$this->setFont('Arial','',8);
			$this->cell(70,4,'Nomor Antrian Anda',0,0,'C');
			$this->Ln(6);
			$this->setFont('Arial','B',36);
			$this->cell(70,14,$row->no_antrian,0,0,'C');
			$this->Ln();
			$this->setFont('Arial','',8);
			$this->cell(25,4,'Tanggal daftar',0,0,'L');
			$this->cell(45,4,': '.strftime("%d %B %Y",strtotime($row->tgl_daftar_uji)),0,0,'L');
			$this->Ln();
			$this->cell(25,4,'Permohonan Uji',0,0,'L');
			$this->cell(45,4,': '.$row->jenis_uji,0,0,'L');
			$this->Ln();
			$this->cell(25,4,'No Uji',0,0,'L');
			$this->cell(45,4,': '.$row->no_uji,0,0,'L');
			$this->Ln();
			$this->cell(25,4,'No Kendaraan',0,0,'L');
			$this->cell(45,4,': '.$row->no_kendaraan,0,0,'L');
			$this->Ln();
			$this->cell(25,4,'Pemohon',0,0,'L');
			$this->cell(45,4,': '.$row->nama_pemohon,0,0,'L');
			$this->Image(base_url().'files/pembayaran/'.$row->tgl_daftar_uji.'/'.$row->id_billing.'.png',27.5,58,0,25,'PNG');
			$this->Ln(30);
			$this->setFont('Arial','B',10);
			$this->cell(70,5,$row->id_billing,0,0,'C');
			$this->Ln(7);
			$this->setFont('Arial','I',8);
			$this->multicell(70,4,'Struk ini digunakan untuk proses selanjutnya, simpanlah baik-baik',0,'C');
			$this->Ln();
			$this->setFont('Arial','BI',8);
			$this->cell(70,4,'Keselamatan Tanggung Jawab Kita Bersama',0,0,'C');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(80,100));
$this->fpdf->SetMargins(5,5,5); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',90,40,30,0,'PNG');
$this->fpdf->Content($dt_antrian);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>