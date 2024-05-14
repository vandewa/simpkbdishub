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
	
	function hasil_uji($detail_buku){
		foreach($detail_buku as $row){
			if($row->waktu_daftar==""){
				$tgl = date("d M Y H:i:s");
			} else {
				$tgl = date("d M Y H:i:s");
				//$tgl = date("d M Y H:i:s",strtotime($row->waktu_daftar));
			}
			
			$ax_s1 = $row->ax_total_s1;
			$ax_s2 = $row->ax_total_s2;
			$ax_s3 = $row->ax_total_s3;
			$br_kiri_s1 = $row->br_kiri_s1;
			$br_kanan_s1 = $row->br_kanan_s1;
			$br_kiri_s2 = $row->br_kiri_s2;
			$br_kanan_s2 = $row->br_kanan_s2;
			$br_kiri_s3 = $row->br_kiri_s3;
			$br_kanan_s3 = $row->br_kanan_s3;
			$br_total_s1 = $br_kiri_s1 + $br_kanan_s1;
			$br_total_s2 = $br_kiri_s2 + $br_kanan_s2;
			$br_total_s3 = $br_kiri_s3 + $br_kanan_s3;
			
			$rem_utama = ($br_total_s1 + $br_total_s2 + $br_total_s3)/$row->bk_total*100;
			$bef = ($rem_utama * $row->bk_total)/100;
			
			if($bef != "0"){
				$rem = round($rem_utama,1);
			} else {
				$rem = "";
			}
			
			if($br_kanan_s1 > "0") {
				$ps1 = round((((abs($br_kiri_s1-$br_kanan_s1))/$ax_s1)*100),2);
			} else {
				$ps1 = "";
			}
			if($br_kanan_s2 > "0") {
				$ps2 = round((((abs($br_kiri_s2-$br_kanan_s2))/$ax_s2)*100),2);
			} else {
				$ps2 = "";
			}
			if($br_kanan_s3 > "0") {
				$ps3 = round((((abs($br_kiri_s3-$br_kanan_s3))/$ax_s3)*100),2);
			} else {
				$ps3 = "";
			}
			if($row->tahun > "2010"){
				$lampu = 14000;
			} else if (($row->tahun <= "2010") && ($row->tahun >= "2000")){
				$lampu = 13000;
			} else if ($row->tahun < "2000"){
				$lampu = 12000;
			}
			
			if($row->tahun < 2007){
				$co_a = $row->asap_co;
				$hc_a = $row->asap_hc;
				$co_b = "";
				$hc_b = "";
			} else {
				$co_a = "";
				$hc_a = "";
				$co_b = $row->asap_co;
				$hc_b = $row->asap_hc;
			}
			
			$this->AddFont('bebasneue','','bebasneue.php');
			$this->setFont('Times','B',12);
			$this->SetLeftMargin(4);
			$this->Ln(10);
			$this->Cell(135,0);
			$this->Cell(5,0,$rem,0,0,'C');
			$this->Ln(7);
			$this->Cell(135,0);
			$this->Cell(5,0,$ps1,0,0,'C');
			$this->Cell(8,0);
			$this->Cell(23,0,'LULUS',0,0,'C');
			$this->Ln(4);
			$this->Cell(135,0);
			$this->Cell(5,0,$ps2,0,0,'C');
			$this->Ln(4);
			$this->Cell(135,0);
			$this->Cell(5,0,$ps3,0,0,'C');
			$this->Ln(2);
			$this->Cell(148,0);
			$this->Cell(23,0,'SLAWI',0,0,'C');
			$this->Ln(5);
			$this->Cell(148,0);
			$this->Cell(23,0,date("d M Y",strtotime($row->tgl_uji)),0,0,'C');
			$this->Ln(5);
			$this->Cell(135,0);
			//$this->Cell(5,0);
			$this->Cell(5,0,$row->lampu_kanan,0,0,'C');
			$this->Ln(7);
			$this->Cell(135,0);
			//$this->Cell(5,0);
			$this->Cell(5,0,$row->lampu_kiri,0,0,'C');
			$this->Ln(13);
			$this->Cell(148,0);
			$this->Cell(23,0,date("d M Y",strtotime($row->tgl_habis_uji)),0,0,'C');
			$this->Ln(5);
			$this->Cell(135,0);
			//$this->Cell(5,0);
			$this->Cell(5,0,$row->asap,0,0,'C');
			$this->Ln(15);
			$this->Cell(135,0);
			$this->Cell(5,0,$co_a,0,0,'C');
			$this->Ln(5);
			$this->Cell(135,0);
			$this->Cell(5,0,$hc_a,0,0,'C');
			$this->Ln(7);
			$this->Cell(135,0);
			$this->Cell(5,0,$co_b,0,0,'C');
			$this->Cell(7,0);
			$this->setFont('bebasneue','U',12);
			$this->Cell(23,0,$row->penguji,0,0,'C');
			$this->setFont('bebasneue','',9);
			$this->Ln(4);
			$this->Cell(135,0);
			$this->setFont('Times','B',12);
			$this->Cell(5,0,$hc_b,0,0,'C');
			$this->Cell(7,0);
			$this->setFont('bebasneue','',9);
			$this->Cell(23,0,"NRP. ".$row->nrp,0,0,'C');
			$this->setFont('Arial','',7);
			$this->Ln(10);
			$this->Cell(100,0);
			$this->Cell(80,4,$row->no_uji.' | '.$row->no_kendaraan.' | '.$tgl.' | '.$row->nama,0,0,'C');
		}
	}
}

$this->fpdf = new PDF("L","mm",array(125,180));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,10,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->hasil_uji($detail_buku);
//$this->fpdf->AutoPrint($dt_printer);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>