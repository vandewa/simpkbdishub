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
		$this->setFont('Times','B',14);
		$this->setFillColor(255,255,255);
		$this->cell(20,0);
		$this->cell(160,5,'PEMERINTAH KABUPATEN MADIUN',0,0,'C');
		$this->ln();
		$this->setFont('Times','',14);
		$this->cell(20,0);
		$this->cell(160,5,'DINAS PERHUBUNGAN',0,0,'C');
		$this->ln();
		$this->setFont('Times','',10);
		$this->cell(20,0);
		$this->cell(160,4,'Jl. Panglima Sudirman No 50 Mejayan Telp. (0351) 383903',0,0,'C');
		$this->ln();
		$this->setFont('Times','B',12);
		$this->cell(20,0);
		$this->cell(160,5,'C A R U B A N',0,0,'C');
		$this->setFont('Times','',12);
		$this->ln();
		$this->SetLineWidth(0.5);
		$this->Line(200,25,10,25);
		$this->SetLineWidth(0.3);
		$this->Line(200,26,10,26);
		$this->Image(base_url().'assets/images/logo-kab-madiun.png',10,5,17,0,'PNG');
	}
	
	function Content($dt_pembayaran){
		foreach($dt_pembayaran as $row){
			$daftar_uji = date("Y-m-d",strtotime($row->tgl_daftar_uji));
			$habis = date("d M Y", strtotime($row->tgl_habis_uji));
			if($habis=='01 Jan 1970'){
				$tgl_habis = "";
			} else {
				$tgl_habis = $habis;
			}
			if($row->nama_pemohon==""){
				$pemohon = $row->nama;
			} else {
				$pemohon = $row->nama_pemohon;
			}
			$total_pkb = number_format($row->retribusi, 0, ".", ",");
			$total_buku = number_format($row->buku, 0, ".", ",");
			$total_denda = number_format($row->jml_denda, 0, ".", ",");
			$total_retribusi = number_format($row->total_retribusi, 0, ".", ",");
			$this->ln(3);
			$this->setFont('Arial','BU',12);
			$this->cell(20,0);
			$this->cell(160,5,'(INVOICE PEMBAYARAN RETRIBUSI)',0,0,'C');
			$this->Ln(6);
			$this->setFont('Arial','B',10);
			$this->cell(120,5,'DATA KENDARAAN',0,0,'L');
			$this->Ln();
			$this->setFont('Arial','',10);
			$this->cell(35,5,'No. Uji',0,0,'L');
			$this->cell(80,5,': '.$row->no_uji,0,0,'L');
			$this->cell(35,5,'Jenis Pendaftaran',0,0,'L');
			$this->cell(40,5,': '.$row->jenis_uji,0,0,'L');
			$this->Ln();
			$this->cell(35,5,'No. Kendaraan',0,0,'L');
			$this->cell(80,5,': '.$row->no_kendaraan,0,0,'L');
			$this->cell(35,5,'Tanggal Pendaftaran',0,0,'L');
			$this->cell(40,5,': '.date("d F Y",strtotime($row->tgl_daftar_uji)),0,0,'L');
			$this->Ln();
			$this->cell(35,5,'Nama Pemilik',0,0,'L');
			$this->cell(80,5,': '.$row->nama,0,0,'L');
			$this->cell(35,5,'Kode Pembayaran',0,0,'L');
			$this->setFont('Arial','B',10);
			$this->cell(40,5,': '.$row->id_billing,0,0,'L');
			$this->setFont('Arial','',10);
			$this->Ln();
			$this->cell(35,5,'Alamat Pemilik',0,0,'L');
			$this->cell(80,5,': '.$row->alamat,0,0,'L');
			$this->cell(35,5,'Batas Pembayaran',0,0,'L');
			$this->setFont('Arial','B',10);
			$this->cell(40,5,': '.date("d M Y H:i:s",strtotime($row->exp_billing)),0,0,'L');
			$this->setFont('Arial','',10);
			$this->Ln();
			$this->cell(35,5,'Jenis Kendaraan',0,0,'L');
			$this->cell(75,5,': '.$row->jenis.' ('.$row->jenis_kendaraan.')',0,0,'L');
			$this->Ln();
			$this->cell(35,5,'Tanggal Habis Uji',0,0,'L');
			$this->cell(75,5,': '.date("d F Y",strtotime($row->tgl_habis_uji)),0,0,'L');
			$this->Ln();
			$this->setFont('Arial','B',10);
			$this->cell(35,5,'RETRIBUSI PKB',0,0,'L');
			$this->cell(80,5,': Rp '.$total_pkb,0,0,'L');
			$this->Ln();
			$this->cell(35,5,'DENDA',0,0,'L');
			$this->setFont('Arial','B',10);
			$this->cell(40,5,': Rp '.$total_denda,0,0,'L');
			$this->Ln();
			$this->cell(35,5,'BUKU UJI',0,0,'L');
			$this->setFont('Arial','B',10);
			$this->cell(35,5,': Rp '.$total_buku,0,0,'L');
			$this->setFont('Arial','',12);
			$this->cell(60,5,'KODE PEMBAYARAN','LTR',0,'C');
			$this->Ln();
			$this->cell(35,5,'TOTAL BAYAR',0,0,'L');
			$this->setFont('Arial','B',10);
			$this->cell(35,5,': Rp '.$total_retribusi,0,0,'L');
			$this->setFont('Arial','B',14);
			$this->cell(60,5,$row->id_billing,'LBR',0,'C');
			$this->setFont('Arial','',10);
			$this->Ln(6);
			$this->multicell(180,7,'NB : *Harap melakukan pembayaran sebelum batas waktu pembayaran habis '.date("d F Y H:i:s",strtotime($row->exp_billing)),0,'J');
			$this->Image(base_url().'files/pembayaran/'.$daftar_uji.'/'.$row->id_billing.'.png',150,65,0,25,'PNG');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetMargins(10,5,10); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',90,40,30,0,'PNG');
$this->fpdf->Content($dt_pembayaran);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>