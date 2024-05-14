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
			$tgl_habis = $row->tgl_habis_uji;
			$habis = date("d-m-Y", strtotime($tgl_habis));
			
			$d = date("d", strtotime($tgl_habis));
			$m = date("m", strtotime($tgl_habis));
			$y = date("Y", strtotime($tgl_habis));
			
			$jd = gregoriantojd($m,$d,$y);
			$mn = jdmonthname($jd,0);
			
			$orang = $row->da_orang;
			
			$this->SetLeftMargin(15);
			$this->setFont('Arial','B',24);
			$this->Ln(10);
			$this->setFillColor(255,255,255);
			$this->Cell(110,0);
			$this->cell(50,0,$d." ".$mn." ".$y,0,0,'C');
			$this->setFont('Arial','B',16);
			$this->Ln(11);
			$this->Cell(120,0);
			$this->cell(30,0,$row->bk_total,0,0,'L');
			$this->Ln(9);
			$this->Cell(120,0);
			$this->cell(30,0,$row->uk_panjang,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->uk_lebar,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->uk_tinggi,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->jbb,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->jbi,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->muatan_sum_berat,0,0,'L');
			$this->Ln(15);
			$this->Cell(100,0);
			$this->cell(50,0,$orang,0,0,'L');
			$this->cell(30,0,$row->jml_da_orang,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->da_barang,0,0,'L');
			$this->Ln(6);
			$this->Cell(120,0);
			$this->cell(30,0,$row->kelas_jl_min,0,0,'L');
			$this->Image(base_url().'files/pendaftaran/'.$daftar_uji.'/'.$row->kode_uji.'.png',95,115,35,0,'PNG');
		}
	}
	
	function Dinas($detail_dinas){
		foreach($detail_dinas as $row){
			$this->setFont('Arial','B',12);
			$this->Ln(10);
			$this->Cell(100,0);
			$this->cell(50,0,$row->dinas,0,0,'L');
		}
	}
	
	function Uji($detail_stiker){
		foreach($detail_stiker as $row){
			$this->setFont('Arial','B',24);
			$this->Ln(14);
			//$this->Cell(20,0);
			$this->cell(90,0,$row->no_uji,0,0,'L');
			$this->Ln(9);
			//$this->Cell(20,0);
			$this->cell(90,0,$row->no_kendaraan,0,0,'L');
			$this->setFont('Arial','B',12);
			$this->Ln(3);
			$this->Cell(126,0);
			$this->Cell(70,0,$row->nama,0,0,'C');
			$this->Ln(5);
			$this->Cell(145,0);
			$this->Cell(70,0,$row->no_reg,0,0,'L');
			//$this->Image(base_url().'files/qrcode/'.$row->qrcode,95,115,35,0,'PNG');
		}
	}
}

$this->fpdf = new PDF("L","mm",array(150,200));
$this->fpdf->SetMargins(10,10,10);
$this->fpdf->SetAutoPageBreak(true,5); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_stiker);
$this->fpdf->Dinas($detail_dinas);
$this->fpdf->Uji($detail_stiker);
//$this->fpdf->AutoPrint($dt_printer);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>