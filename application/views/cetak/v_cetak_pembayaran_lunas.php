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
	
	function atas(){
		$this->setFont('Arial','',10);
		$this->setFillColor(255,255,255);
		$this->cell(140,4,'DINAS PERHUBUNGAN',0,0,'L');
		$this->cell(30,4);
		$this->cell(20,4,'Model Bend. 26',0,0,'C');
		$this->ln();
		$this->setFillColor(255,255,255);
		$this->cell(140,4,'KABUPATEN JEPARA',0,0,'L');
		$this->cell(30,4);
		$this->cell(20,4,'DPD. II 22 A',0,0,'C');
		$this->ln();
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
			$total_retribusi = number_format($row->total_semua, 0, ",", ".");
			
			$this->ln(5);
			$this->setFont('Arial','BU',10);
			$this->cell(190,4,'TANDA BUKTI PEMBAYARAN',0,0,'C');
			$this->setFont('Arial','',10);
			$this->Ln();
			$this->cell(190,4,'No. : '.$row->no_kwitansi,0,0,'C');
			$this->Ln(10);
			$this->cell(60,5,'Bendahara Khusus Penerima',0,0,'L');
			$this->cell(120,5,': DINAS PERHUBUNGAN KABUPATEN JEPARA',0,0,'L');
			$this->Ln();
			$this->cell(60,5,'Dari Nama Pemohon',0,0,'L');
			$this->cell(120,5,': '.$row->nama_pemohon,0,0,'L');
			$this->Ln();
			$this->cell(60,5,'Alamat Pemohon',0,0,'L');
			$this->cell(120,5,': '.$row->alamat_pemohon,0,0,'L');
			$this->Ln();
			$this->cell(60,5,'Sebagai pembayaran',0,0,'L');
			$this->cell(120,5,': Retribusi Uji Kendaraan Bermotor '.$row->no_uji.'/'.$row->no_kendaraan,0,0,'L');
			$this->Ln();
			
			$this->cell(60,5);
			$this->cell(120,5,'  JBB : '.$row->jbb.' Kg / '.$row->bentuk.' / Habis Uji : '.strftime("%d %B %Y",strtotime($row->tgl_habis_uji)),0,0,'L');
			$this->Ln();
			$this->cell(60,5,'Telah membayar uang sebesar',0,0,'L');
			$this->cell(120,5,': Rp '.$total_retribusi,0,0,'L');
		}
	}
	
	function Terbilang($terbilang){
		$this->Ln();
		$this->cell(60,5);
		$this->cell(120,5,'  ('.$terbilang.' Rupiah)',0,0,'L');
	}
	
	function Content1($dt_pembayaran){
		foreach($dt_pembayaran as $row){
			
			$this->Ln();
			$this->cell(80,5,'Dengan rincian pembayaran sebagai berikut : ',0,0,'L');
			$this->Ln(7);
			$this->cell(20,5);
			$this->cell(40,5,'Retribusi Uji',0,0,'L');
			$this->cell(5,5,': Rp',0,0,'L');
			$this->cell(23,5,number_format($row->retribusi, 0, ",", "."),0,0,'R');
			$this->Ln();
			$this->cell(20,5);
			$this->cell(40,5,'Sanksi Administrasi',0,0,'L');
			$this->cell(5,5,': Rp',0,0,'L');
			$this->cell(23,5,number_format($row->jml_denda, 0, ",", "."),0,0,'R');
			$this->Ln();
			$this->cell(20,5);
			$this->cell(40,5,'Tanda Uji',0,0,'L');
			$this->cell(5,5,': Rp',0,0,'L');
			$this->cell(23,5,number_format($row->tanda, 0, ",", "."),0,0,'R');
			$this->Ln();
			$this->setFont('Arial','B',10);
			$this->cell(30,8);
			$this->cell(30,8,'Total Bayar',0,0,'L');
			$this->cell(5,5,': Rp',0,0,'L');
			$this->cell(23,5,number_format($row->total_semua, 0, ",", "."),0,0,'R');
			$this->setFont('Arial','',10);
			
			//Garis total atas
			$this->SetLineWidth(0.4);
			$this->Line(70,94,100,94);
			//Garis total bawah
			$this->SetLineWidth(0.4);
			$this->Line(70,253,100,253);
			//Garis batas
			$this->SetLineWidth(0.2);
			$this->Line(210,160,0,160);
		}
	}
	
	function Ttd($dt_ttd){
		foreach($dt_ttd as $row){
			$this->Ln(10);
			$this->cell(60,5,'Ayat Penerimaan',0,0,'C');
			$this->cell(70,5,'Uang Tersebut di atas diterima',0,0,'C');
			$this->cell(60,5,'Jepara, '.strftime("%d %B %Y"),0,0,'C');
			$this->Ln();
			$this->cell(60,5,'412.01.007',0,0,'C');
			$this->cell(70,5,strftime("%d %B %Y"),0,0,'C');
			$this->cell(60,5,'Penyetor/Pemohon',0,0,'C');
			$this->Ln(25);
			$this->cell(60,5);
			//$this->Image(base_url().'files/ttd/bendahara.jpg',85,100,40,0,'JPG');
			$this->cell(70,5,'('.$row->nama.')',0,0,'C');
			$this->cell(60,5,'(..................................)',0,0,'C');
			$this->Ln();
			$this->cell(60,5);
			$this->cell(70,5,'NIP. '.$row->nip,0,0,'C');
			$this->cell(60,5);
			$this->Ln(30);
			
		}
	}
	
	
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
//$this->fpdf->Image(base_url().'assets/images/logo-dishub.png',90,40,30,0,'PNG');
$this->fpdf->atas();
$this->fpdf->Content($dt_pembayaran);
$this->fpdf->Terbilang($terbilang);
$this->fpdf->Content1($dt_pembayaran);
$this->fpdf->Ttd($dt_ttd);
$this->fpdf->atas();
$this->fpdf->Content($dt_pembayaran);
$this->fpdf->Terbilang($terbilang);
$this->fpdf->Content1($dt_pembayaran);
$this->fpdf->Ttd($dt_ttd);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>