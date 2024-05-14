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
	
	function tanggal($now){
		$tanggal = unix_to_human($now);
		$sekarang = date("d-m-Y", strtotime($tanggal));
		$d = date("d", strtotime($tanggal));
		$m = date("m", strtotime($tanggal));
		$y = date("Y", strtotime($tanggal));
		$jd = gregoriantojd($m,$d,$y);
		$mn = jdmonthname($jd,0);
		
		$this->setFont('Arial','',12);
		$this->setFillColor(255,255,255);
		$this->cell(130,0);
		//$this->cell(40,0,'SLAWI',0,0,'L');
		$this->Ln(11);
		$this->cell(130,0);
		$this->cell(40,0,$d." ".$mn." ".$y,0,0,'L');
		$this->Ln(21);
		$this->cell(125,0);
		//$this->cell(40,0,'HUBKOMINFO',0,0,'C');
		$this->Ln(4);
		$this->cell(125,0);
		//$this->cell(40,0,'KAB. TEGAL',0,0,'C');
	}
	
	function Dinas($detail_dinas){
		foreach($detail_dinas as $row){
			$this->setFont('Arial','',11);
			$this->Ln(17);
			$this->cell(105,0);
			//$this->cell(40,0,$row->ka_dinas,0,0,'C');
			$this->setFont('Arial','',9);
			$this->Ln(4);
			$this->cell(105,0);
			//$this->cell(40,0,$row->status_kadinas,0,0,'C');
			$this->setFont('Arial','',10);
			$this->Ln(4);
			$this->cell(105,0);
			//$this->cell(40,0,$row->nip_kadinas,0,0,'C');
		}
	}
	
	function Depan($detail_buku){
		foreach($detail_buku as $row){
			$this->setFont('Arial','',12);
			$this->Ln(22);
			$this->setFillColor(255,255,255);
			$this->Cell(100,0);
			$this->Cell(40,0,$row->no_uji,0,0,'C');
			//$this->Image(base_url().'files/barcode/'.$row->barcode,110,78,0,12,'PNG');
			$this->setFont('Arial','',7);
			/*
			$this->Ln(4);
			$this->cell(102,0);
			$this->cell(15,3,'PARAF','LTR',0,'C');
			$this->cell(15,3,'UPTD PKB','TRB',0,'C');
			$this->cell(15,3,'SEKDIN','TRB',0,'C');
			$this->Ln();
			$this->cell(102,0);
			$this->cell(15,7,'HIRARKI','LRB',0,'C');
			$this->cell(15,7,'','RB',0,'C');
			$this->cell(15,7,'','RB',0,'C');
			*/
			$this->Ln(20);
			$this->setFont('Arial','',8);
			$this->Cell(90,0);
			$this->Cell(75,0,"Dicetak tanggal ".date("d M Y H:i:s"),0,0,'C');
		}
	}
	
	function Buku($detail_buku){
		foreach($detail_buku as $row){
			$sertifikasi = $row->tgl_sertifikasi_uji;
			$tgl_sertifikasi = date("d M Y", strtotime($sertifikasi));
			if($tgl_sertifikasi=='01 Jan 1970'){
				$ser = "";
			}
			else {
				$ser = $tgl_sertifikasi;
			}
			
			$alamat = $row->alamat_pemilik;
			if(strpos($alamat,"-")){
				$addr = explode("-",$alamat);
			} else {
				$addr[0] = $alamat;
				$addr[1] = "";
			}
			$this->Image(base_url().'files/qrcode/'.$row->qrcode,10,82,22,0,'PNG');
			//$this->SetLeftMargin(15);
			$this->setFont('Arial','',12);
			$this->setFillColor(255,255,255);
			$this->Ln(9);
			$this->Cell(80,0);
			$this->Cell(90,0,$row->jenis_kendaraan,0,0,'C');
			$this->Ln(7);
			$this->setFont('Arial','',10);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->merek,0,0,'L');
			$this->Ln(5);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->tipe,0,0,'L');
			$this->Ln(8);
			$this->setFont('Arial','',12);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->no_uji,0,0,'L');
			$this->Ln(3);
			$this->setFont('Arial','',10);
			$this->Cell(85,0);
			$this->Cell(30,0,$row->jenis,0,0,'L');
			$this->Ln(2);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->isi_silinder,0,0,'L');
			$this->Ln(5);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->daya_motor,0,0,'L');
			$this->Ln(2);
			$this->setFont('Arial','',12);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->no_kendaraan,0,0,'L');
			$this->Ln(5);
			$this->setFont('Arial','',10);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->bahan_bakar,0,0,'L');
			$this->Ln(5);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->tahun,0,0,'L');
			$this->Ln(1);
			$this->setFont('Arial','',11);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->pemilik,0,0,'L');
			$this->setFont('Arial','',10);
			$this->Ln(7);
			$this->Cell(132,0);
			$this->Cell(30,0,$row->status,0,0,'L');
			$this->Ln(5);
			$this->setFont('Arial','',11);
			$this->Cell(32,0);
			$this->Cell(30,0,$addr[0],0,0,'L');
			$this->Ln(4);
			$this->setFont('Arial','',11);
			$this->Cell(32,0);
			$this->Cell(30,0,$addr[1],0,0,'L');
			$this->Ln(3);
			$this->setFont('Arial','',10);
			$this->Cell(127,0);
			$this->Cell(30,0,$row->no_rangka,0,0,'L');
			$this->Ln(4);
			$this->setFont('Arial','',11);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->kecamatan,0,0,'L');
			$this->setFont('Arial','',10);
			$this->Ln(4);
			$this->Cell(127,0);
			$this->Cell(30,0,$row->no_mesin,0,0,'L');
			$this->Ln(7);
			$this->setFont('Arial','',11);
			$this->Cell(32,0);
			$this->Cell(30,0,$row->kota,0,0,'L');
			$this->setFont('Arial','',10);
			$this->Cell(65,0);
			$this->Multicell(37,3,$row->no_sertifikasi_uji,0,'L');
			$this->Ln(5);
			$this->Cell(135,0);
			$this->Cell(15,0,$ser,0,0,'L');
			$this->Ln(10);
			$this->Cell(32,0);
			$this->setFont('Arial','',10);
			//$this->Cell(30,0,$row->no_ktp,0,0,'L');
			$this->Cell(68,0);
			$this->setFont('Arial','',9);
			//$this->Cell(15,0,$row->no_registrasi_uji,0,0,'L');
			//$this->Cell(15,0,$row->tgl_registrasi_uji,0,0,'L');
		}
	}
	
	function Detail($detail_buku){
		foreach($detail_buku as $row){
			
			//$this->SetLeftMargin(40);
			$this->setFont('','',10);
			$this->Ln(3);
			$this->setFillColor(255,255,255);
			$this->Cell(50,0);
			$this->Cell(20,0,$row->uk_panjang,0,0,'L');
			$this->Ln(2);
			$this->Cell(60,0);
			$this->Cell(20,0,$row->uk_lebar,0,0,'L');
			$this->Cell(55,0);
			$this->Cell(20,0,$row->bk_sumbu1,0,0,'L');
			$this->Ln(3);
			$this->Cell(50,0);
			$this->Cell(20,0,$row->uk_tinggi,0,0,'L');
			$this->Ln(3);
			$this->Cell(60,0);
			$this->Cell(20,0,$row->uk_julur_belakang,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(20,0,$row->bk_sumbu2,0,0,'L');
			$this->Ln(2);
			$this->Cell(50,0);
			$this->Cell(20,0,$row->uk_julur_depan,0,0,'L');
			$this->Ln(3);
			$this->Cell(70,0);
			$this->Cell(65,0);
			$this->Cell(20,0,$row->bk_sumbu3,0,0,'L');
			$this->Ln(3);
			$this->Cell(50,0);
			$this->Cell(20,0,$row->js_sumbu1,0,0,'L');
			$this->Cell(75,0);
			$this->Cell(20,0,$row->bk_sumbu4,0,0,'L');
			$this->Ln(2);
			$this->Cell(60,0);
			$this->Cell(20,0,$row->js_sumbu2,0,0,'L');
			$this->Ln(2);
			$this->Cell(50,0);
			$this->Cell(20,0,$row->js_sumbu3,0,0,'L');
			$this->Ln(4);
			$this->Cell(60,0);
			$this->Cell(20,0,$row->js_sumbuq,0,0,'L');	
			$this->Cell(55,0);
			$this->Cell(20,0,$row->bk_total,0,0,'L');
			$this->Ln(7);
			$this->Cell(40,0);
			$this->Cell(25,0,$row->dbm_panjang,0,0,'L');
			$this->Ln(2);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->dbm_lebar,0,0,'L');
			$this->Ln(2);
			$this->Cell(40,0);
			$this->Cell(25,0,$row->dbm_tinggi,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(25,0,$row->da_orang,0,0,'L');
			$this->Ln(3);
			$this->Cell(40,0);
			$this->Cell(25,0,$row->dbm_bahan_bak,0,0,'L');
			$this->Ln(5);
			$this->Cell(40,0);
			$this->Cell(25,0,$row->dt_panjang,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(25,0,$row->da_barang,0,0,'L');
			$this->Ln(3);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->dt_lebar,0,0,'L');
			$this->Ln(3);
			$this->Cell(40,0);
			$this->Cell(25,0,$row->dt_tinggi,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(25,0,$row->jbi,0,0,'L');
			$this->Ln(2);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->dt_volume,0,0,'L');
			
			$this->Ln(4);
			$this->Cell(40,0);
			$this->Cell(25,0,$row->dt_jenis_muatan,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(25,0,$row->jbi_kombinasi,0,0,'L');
			$this->Ln(2);
			$this->Cell(40,0);
			$this->Cell(25,0,$row->dt_berat_jenis_muatan,0,0,'L');
			$this->Ln(2);
			$this->Cell(40,0);
			$this->Cell(25,0,$row->dt_bahan_tangki,0,0,'L');
			$this->Ln(13);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->ban_sumbu1,0,0,'L');
			$this->Ln(3);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->ban_sumbu2,0,0,'L');
			$this->Ln(3);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->ban_sumbu3,0,0,'L');
			$this->Ln(3);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->ban_sumbu4,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(25,0,$row->muatan_sum_berat,0,0,'L');
			$this->Ln(4);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->konf_sumbu,0,0,'L');
			$this->Ln(7);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->jbb,0,0,'L');
			$this->Cell(65,0);
			$this->Cell(25,0,$row->kelas_jl_min,0,0,'L');
			$this->Ln(6);
			$this->Cell(50,0);
			$this->Cell(25,0,$row->jbb_kombinasi,0,0,'L');
			$this->Ln(16);
			//$this->Cell(155,0,"DINAS PERHUBUNGAN KABUPATEN TEGAL dicetak tanggal ".date("d M Y H:i:s"),0,0,'C');
		}
	}
	
	function catatan($detail_buku){
		foreach($detail_buku as $row){
			$this->setFont('ARIAL','B',10);
			$this->SetLeftMargin(5);
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
$this->fpdf->tanggal($now);
$this->fpdf->Dinas($detail_dinas);
$this->fpdf->Depan($detail_buku);
$this->fpdf->AddPage();
$this->fpdf->Buku($detail_buku);
$this->fpdf->AddPage();
$this->fpdf->Detail($detail_buku);
$this->fpdf->AddPage();
//$this->fpdf->keterangan($detail_buku);
$this->fpdf->catatan($detail_buku);
//$this->fpdf->AutoPrint($dt_printer);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>