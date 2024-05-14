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
	
	function Content($detail_stiker){
		foreach($detail_stiker as $row){
			$daftar_uji = date("Y-m-d",strtotime($row->tgl_daftar_uji));
			
			$orang = $row->da_orang;
			
			$this->SetLeftMargin(15);
			$this->setFont('Arial','B',24);
			$this->setFillColor(0,0,0);
			$this->Ln(1);
			$this->Cell(179,6);
			$this->cell(40,6,'',0,1,'L',1);
			$this->Ln();
			$this->setFillColor(255,255,255);
			$this->Cell(155,0);
			$this->cell(40,0,strftime("%d %B %Y", strtotime($row->tgl_habis_uji)),0,0,'C');
			$this->setFont('Arial','B',16);
			$this->Ln(16);
			$this->Cell(140,0);
			$this->cell(70,0,$row->bk_total,0,0,'L');
			$this->Ln(13);
			$this->Cell(140,0);
			$this->cell(70,0,$row->uk_panjang,0,0,'L');
			$this->Ln(8);
			$this->Cell(140,0);
			$this->cell(70,0,$row->uk_lebar,0,0,'L');
			$this->Ln(8);
			$this->Cell(140,0);
			$this->cell(70,0,$row->uk_tinggi,0,0,'L');
			$this->Ln(8);
			$this->Cell(140,0);
			$this->cell(70,0,$row->jbb,0,0,'L');
			$this->Ln(8);
			$this->Cell(140,0);
			$this->cell(70,0,$row->jbi,0,0,'L');
			$this->Ln(8);
			$this->Cell(140,0);
			$this->cell(70,0,$row->mst,0,0,'L');
			$this->Ln(24);
			$this->Cell(120,0);
			$this->cell(60,0,$orang,0,0,'L');
			$this->cell(60,0,$row->jml_da_orang,0,0,'L');
			$this->Ln(8);
			$this->Cell(140,0);
			$this->cell(70,0,$row->da_barang,0,0,'L');
			$this->Ln(8);
			$this->Cell(140,0);
			$this->cell(70,0,$row->kelas_jalan,0,0,'L');
			
			$this->Ln(13);
			$this->Cell(120,0);
			$this->setFont('Arial','B',14);
			$this->cell(70,0,'DISHUB KAB. TEGAL',0,0,'L');
			$this->Image(base_url().'files/pendaftaran/'.$daftar_uji.'/'.$row->qr_kodeuji.'.png',105,153,45,0,'PNG');
		}
	}
	
	function Uji($detail_stiker){
		foreach($detail_stiker as $row){
			$this->setFont('Arial','B',28);
			$this->Ln(20);
			//$this->Cell(10,0);
			$this->cell(70,0,$row->no_uji,0,0,'L');
			$this->Ln(10);
			//$this->Cell(10,0);
			$this->cell(70,0,$row->no_kendaraan,0,0,'L');
			$this->setFont('Arial','B',12);
			$this->Ln(8);
			$this->Cell(148,0);
			$this->Cell(70,0,$row->penguji,0,0,'C');
			$this->Ln(5);
			$this->Cell(167,0);
			$this->Cell(75,0,$row->nrp,0,0,'L');
			//$this->Image(base_url().'files/qrcode/'.$row->qrcode,105,153,45,0,'PNG');
		}
	}
}

$this->fpdf = new PDF("L","mm",array(200,230));
$this->fpdf->SetMargins(10,5,10);
$this->fpdf->SetAutoPageBreak(true,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_stiker);
$this->fpdf->Uji($detail_stiker);
//$this->fpdf->AutoPrint($dt_printer);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>