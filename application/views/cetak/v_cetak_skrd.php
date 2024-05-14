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
			$print = explode('-', $row->pendaftaran);
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
	
	function Content($detail_pendaftaran){
		foreach($detail_pendaftaran as $row){
			$daftar_uji = date("Y-m-d",strtotime($row->tgl_daftar_uji));
			$total_retribusi = number_format($row->total_semua, 0, ".", ",");
			
			$this->setFont('Arial','B',10);
			$this->Ln(42);
			$this->setFillColor(255,255,255);
			$this->cell(45,0);
			$this->cell(60,0,$row->no_uji,0,0,'L');
			$this->Cell(60,0,$row->no_kendaraan,0,0,'L');
			$this->Ln(7);
			$this->setFont('Arial','',10);
			$this->cell(45,0);
			$this->cell(60,0,$row->nama,0,0,'L');
			$this->Cell(60,0,$row->no_mesin,0,0,'L');
			$this->Ln(5);
			$this->cell(40,0);
			$this->cell(60,0,$row->alamat,0,0,'L');
			$this->Cell(60,0,$row->no_rangka,0,0,'L');
			$this->Ln(4);
			$this->cell(40,0);
			$this->cell(60,0,$row->merek.' / '.$row->tipe,0,0,'L');
			$this->Cell(60,0,$row->sifat,0,0,'L');
			$this->Ln(5);
			$this->cell(40,0);
			$this->cell(60,0,$row->tahun,0,0,'L');
			$this->Cell(60,0,strftime("%d %B %Y", strtotime($row->temp_tgl_habis_uji)),0,0,'L');
			$this->Ln(4);
			$this->cell(40,0);
			$this->cell(60,0,$row->bentuk,0,0,'L');
			$this->cell(60,0,$row->jenis_uji,0,0,'L');
			//$this->Image(base_url().'files/pendaftaran/'.$daftar_uji.'/'.$row->qr_kodeuji.'.png',95,130,25,0,'PNG');

			$this->Ln(20);
			$this->cell(90,0);
			$this->setFont('Arial','',10);
			$this->cell(20,0,'Wonosobo',0,0,'L');
			$this->cell(40,0,strftime("%d %B %Y", strtotime($row->tgl_daftar_uji)),0,0,'L');
			$this->Ln(18);
			$this->cell(100,0);
			$this->setFont('Arial','B',10);
			$this->cell(40,0,$row->nama_pemohon,0,0,'C');
		}
	}
	
	function retribusi($detail_pendaftaran){
		foreach($detail_pendaftaran as $row){
			$this->SetLeftMargin(0);
			$this->Ln(25);
			$this->setFont('Arial','',10);
			$this->cell(35,0);
			$this->cell(20,0,$row->denda,0,0,'C');
			$this->Ln(5);
			$this->cell(35,0);
			$this->cell(20,0,$row->denda,0,0,'C');
			$this->cell(20,0,number_format($row->jml_denda, 0, ".", ","),0,0,'C');
			$this->Ln(6);
			$this->cell(30,0);
			$this->cell(30,0,number_format($row->retribusi, 0, ".", ","),0,0,'L');
			$this->cell(30,0,number_format($row->jml_denda, 0, ".", ","),0,0,'L');
			$this->cell(30,0,number_format($row->plat, 0, ".", ","),0,0,'L');
			$this->cell(30,0,number_format($row->stiker, 0, ".", ","),0,0,'L');
			$this->cell(30,0,number_format($row->buku, 0, ".", ","),0,0,'L');
			$this->Ln(15);
			$this->cell(30,0);
			$this->setFont('Arial','B',10);
			$this->cell(40,0,number_format($row->total_semua, 0, ".", ","),0,0,'L');
			$this->Ln(10);
			$this->setFont('Arial','',10);
			$this->cell(45,0);
			$this->cell(100,0,$row->terbilang." Rupiah",0,0,'L');
			$this->Ln(10);
			$this->cell(25,0);
			$this->cell(40,0,strftime("%d %B %Y", strtotime($row->tgl_daftar_uji)),0,0,'C');
			$this->cell(40,0,date("H:i:s",strtotime($row->waktu_pendaftaran)),0,0,'C');
		}
	}
	
	
}

$this->fpdf = new PDF("P","mm",array(165,215));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_pendaftaran);
$this->fpdf->retribusi($detail_pendaftaran);
$this->fpdf->AutoPrint($dt_printer);
$this->fpdf->Output("I",$title);
?>