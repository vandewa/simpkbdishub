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
	
	function catatan($detail_buku){
		foreach($detail_buku as $row){
			$this->setFont('ARIAL','B',10);
			$this->SetLeftMargin(5);
			$this->Ln(35);
			$this->Cell(20,5,'PERSETUJUAN NUMPANG UJI KE',0,0,'L');
			$this->Ln();
			$this->setFont('ARIAL','',9);
			$this->Cell(20,4,'TUJUAN',0,0,'L');
			$this->Cell(60,4,': '.$row->kota_dinas,0,0,'L');
			$this->Ln();
			$this->Cell(20,4,'NOMOR',0,0,'L');
			$this->Cell(60,4,': 551.2/'.$row->no_surat,0,0,'L');
			$this->Ln();
			$this->Cell(20,4,'TANGGAL',0,0,'L');
			$this->Cell(60,4,': '.date("d M Y",strtotime($row->tgl_surat)),0,0,'L');
			$this->Ln();
		}
	}
}

$this->fpdf = new PDF("L","mm",array(125,180));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,10,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->catatan($detail_buku);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>