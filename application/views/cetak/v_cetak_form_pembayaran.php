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
	
	function AutoPrint($dt_printer,$printer=''){
		foreach($dt_printer as $row){
			$print = explode('-', $row->pembayaran);
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
	
	function Content($detail_pembayaran){
		foreach($detail_pembayaran as $row){
			$daftar_uji = date("Y-m-d",strtotime($row->tgl_daftar_uji));
			
			$total_retribusi = number_format($row->total_retribusi, 0, ".", ",");
			$total_pkb = number_format($row->retribusi, 0, ".", ",");
			$total_plat = number_format($row->plat, 0, ".", ",");
			$total_buku = number_format($row->buku, 0, ".", ",");			
			$total_stiker = number_format($row->stiker, 0, ".", ",");
			
			$this->setFont('Arial','',12);
			$this->setFillColor(255,255,255);
			$this->Ln(17);
			$this->cell(50,0);
			$this->cell(60,0,$row->no_kwitansi,0,0,'L');
			$this->Ln(25);
			$this->setFont('Arial','B',24);
			$this->cell(70,0);
			$this->cell(30,0,$total_retribusi,0,0,'L');
			$this->Ln(14);
			$this->setFont('Arial','',12);
			$this->cell(5,0);
			$this->cell(120,0,$row->terbilang,0,0,'L');
			$this->Ln(15);
			$this->cell(55,0);
			$this->cell(80,0,$row->nama,0,0,'L');
			$this->Ln(6);
			$this->cell(55,0);
			$this->cell(80,0,$row->no_kendaraan,0,0,'L');
			$this->Ln(5);
			$this->cell(55,0);
			$this->cell(80,0,$row->no_uji,0,0,'L');
			$this->Ln(6);
			$this->cell(55,0);
			$this->cell(80,0,$row->alamat.' '.$row->kecamatan,0,0,'L');
			$this->Ln(13);
			$this->cell(60,0);
			$this->cell(50,0,$total_pkb,0,0,'L');
			$this->Ln(6);
			$this->cell(60,0);
			$this->cell(50,0,$total_buku,0,0,'L');
			$this->Ln(6);
			$this->cell(60,0);
			$this->cell(50,0,$total_plat,0,0,'L');
			$this->Ln(6);
			$this->cell(60,0);
			$this->cell(50,0,$total_stiker,0,0,'L');
			$this->Ln(6);
			$this->cell(60,0);
			$this->cell(50,0,$total_retribusi,0,0,'L');
			
			$this->Ln(16);
			$this->cell(105,0);
			$this->cell(40,0,date("d M Y", strtotime($row->tgl_daftar_uji)),0,0,'L');
			$this->Image(base_url().'files/pendaftaran/'.$daftar_uji.'/'.$row->qr_kodeuji,20,150,25,0,'PNG');
		}
	}
	
	function pemohon($detail_pendaftaran){
		foreach($detail_pendaftaran as $row){
			$this->Ln(25);
			$this->setFont('Arial','',10);
			$this->cell(95,0);
			$this->cell(50,0,"SUGENG WIBOWO",0,0,'C');
			$this->Ln(5);
			$this->cell(95,0);
			$this->cell(50,0,"NIP. 19831103 201406 1 002",0,0,'C');
			//$this->Image(base_url().'files/ttd/ttd_boy.png',110,165,40,0,'PNG');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(160,200));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_pendaftaran);
$this->fpdf->pemohon($detail_pendaftaran);
$this->fpdf->AddPage();
$this->fpdf->Content($detail_pendaftaran);
$this->fpdf->pemohon($detail_pendaftaran);
$this->fpdf->AutoPrint($dt_printer);
$this->fpdf->Output("I",$title);
?>