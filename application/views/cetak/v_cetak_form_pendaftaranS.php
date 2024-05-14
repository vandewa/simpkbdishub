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
	
	function Content($detail_pendaftaran){
		foreach($detail_pendaftaran as $row){
			$daftar_uji = date("Y-m-d",strtotime($row->tgl_daftar_uji));
			$tgl_akhir = $row->tgl_habis_uji;
			$habis = date("d M Y", strtotime($tgl_akhir));
			if($habis=='01 Jan 1970'){
				$tgl = "";
			} else {
				$tgl = $habis;
			}
			
			/*
			if($row->qr_kodeuji==""){
				$qr = "";
			} else {
				$qr = $this->Image(base_url().'files/pendaftaran/'.$row->qr_kodeuji,95,280,25,0,'PNG');
			}
			*/
			
			$this->SetLeftMargin(60);
			$this->setFont('Arial','B',12);
			$this->Ln(5);
			$this->Ln(4);
			$this->Ln(45);
			$this->setFillColor(255,255,255);	
			$this->cell(100,0,$row->no_uji,0,0,'L');
			$this->Cell(60,0,$row->no_kendaraan,0,0,'L');
			$this->Ln(8);
			$this->setFont('Arial','',10);
			$this->cell(100,0,$row->nama,0,0,'L');
			$this->Cell(60,0,$row->no_mesin,0,0,'L');
			$this->Ln(6);
			$this->cell(100,0,$row->alamat,0,0,'L');
			$this->Cell(60,0,$row->no_rangka,0,0,'L');
			$this->Ln(6);
			$this->cell(100,0,$row->merek.' / '.$row->tipe,0,0,'L');
			$this->Cell(60,0,$row->jenis_uji,0,0,'L');
			$this->Ln(6);
			$this->cell(100,0,$row->tahun,0,0,'L');
			$this->Cell(60,0,$tgl,0,0,'L');
			$this->Ln(6);
			$this->cell(60,0,$row->jenis,0,0,'L');
			$this->Ln(31);
			$this->cell(75,0);
			$this->cell(40,0,date("d M Y", strtotime($row->tgl_daftar_uji)),0,0,'C');
			$this->Image(base_url().'files/pendaftaran/'.$daftar_uji.'/'.$row->qr_kodeuji,95,275,25,0,'PNG');
		}
	}
	
	function tanggal($now){
		$tanggal = unix_to_human($now);
		$sekarang = date("d M Y", strtotime($tanggal));
	}
	
	function pemohon($detail_pendaftaran){
		foreach($detail_pendaftaran as $row){
			$this->Ln(24);
			$this->cell(80,0);
			$this->setFont('Arial','B',10);
			$this->cell(40,0,$row->nama_pemohon,0,0,'C');
		}
	}
	
	function retribusi($detail_pendaftaran){
		foreach($detail_pendaftaran as $row){
			$total_pkb = number_format($row->retribusi, 0, ".", ",");
			$this->SetLeftMargin(20);
			$this->setFont('Arial','',10);
			$this->Ln(20);
			$this->cell(180,0,date("d M Y H:i:s",strtotime($row->waktu_pendaftaran)),0,0,'C');
			$this->Ln(23);
			$this->setFont('Arial','',12);
			$this->cell(180,0,"KWITANSI NO : ".$row->no_kwitansi,0,0,'C');
			
			$this->Ln(20);
			$this->cell(50,0,"Rp ".$total_pkb,0,0,'L');
			
			$total_plat = number_format($row->plat, 0, ".", ",");
			$this->cell(55,0,"Rp ".$total_plat,0,0,'L');

			$total_buku = number_format($row->buku, 0, ".", ",");			
			$this->cell(45,0,"Rp ".$total_buku,0,0,'L');

			$total_stiker = number_format($row->stiker, 0, ".", ",");
			$this->cell(40,0,"Rp ".$total_stiker,0,0,'L');
			
			$total_retribusi = number_format($row->total_retribusi, 0, ".", ",");
			$this->Ln(18);
			$this->cell(60,0,"Rp ".$total_retribusi,0,0,'L');
			$this->Ln(14);
			$this->setFont('Arial','B',12);
			$this->cell(40,0);
			$this->cell(100,0,$row->terbilang,0,0,'L');
			
			$this->setFont('Arial','',10);
			$this->Ln(11);
			$this->cell(125,0);
			$this->cell(40,0,date("d M Y", strtotime($row->tgl_daftar_uji)),0,0,'C');
			
		}
	}
	
	function kadis($kauptd){
		foreach($kauptd as $row){
			$this->Ln(39);
			$this->cell(117,0);
			$this->cell(40,0,$row->kepala_uptd,0,0,'C');
			$this->Ln(4);
			$this->cell(117,0);
			$this->cell(40,0,$row->nip,0,0,'C');
			//$this->Image(base_url().'files/ttd/ttd-kabid.png',135,275,40,0,'PNG');
		}
	}
	
	function kodeuji($detail_pendaftaran){
		foreach($detail_pendaftaran as $row){
			$this->setFont('Arial','',9);
			$this->Ln(8);
			$this->cell(75,0);
			$this->cell(15,0,$row->kode_uji,0,0,'L');
		}
	}
	
	function Pengujian($detail_uji){
		foreach($detail_uji as $row){
			$daftar_uji = date("Y-m-d",strtotime($row->tgl_daftar_uji));
			$tgl_daftar = $row->tgl_daftar_uji;
			$daftar = date("d M Y", strtotime($tgl_daftar));
			if(($row->jenis_uji=='Numpang Masuk') || ($row->jenis_uji=='Mutasi Masuk')){
				$dari = $row->num_dari;
				$no = $row->num_nomor;
				$tgl = date("d M Y", strtotime($row->num_tgl));
			} else {
				$dari = "";
				$no = "";
				$tgl = "";
			}
			
			$this->SetLeftMargin(30);
			$this->setFont('Arial','B',16);
			$this->Ln(5);
			$this->Ln(5);
			$this->setFillColor(255,255,255);
			$this->Cell(30,0);			
			$this->cell(50,0,$row->nomor_uji,0,0,'L');
			$this->Cell(10,0,"|",0,0,'C');
			$this->Cell(30,0,$row->jns_uji,0,0,'L');
			$this->Ln(15);
			$this->Cell(30,0);
			$this->cell(95,0,$row->no_kendaraan,0,0,'L');
			$this->Cell(55,0,date("d M Y"),0,0,'L');
			$this->setFont('Arial','',10);
			$this->Ln(12);
			$this->Cell(30,0);
			$this->Cell(10,0);
			$this->cell(90,0,$row->nama,0,0,'L');
			$this->Ln(6);
			$this->Cell(30,0);
			$this->Cell(10,0);
			$this->cell(90,0,$row->alamat,0,0,'L');
			$this->Ln(6);
			$this->Cell(30,0);
			$this->Cell(10,0);
			$this->cell(90,0,$row->jenis,0,0,'L');
			$this->Ln(6);
			$this->Cell(30,0);
			$this->Cell(10,0);
			$this->cell(95,0,$row->merek.' / '.$row->tipe,0,0,'L');
			$this->Ln(6);
			$this->Cell(30,0);
			$this->Cell(10,0);
			$this->cell(90,0,$row->tahun,0,0,'L');
			$this->Ln(6);
			$this->Cell(30,0);
			$this->Cell(10,0);
			$this->cell(90,0,$row->no_mesin,0,0,'L');
			$this->Ln(6);
			$this->Cell(30,0);
			$this->Cell(10,0);
			$this->cell(90,0,$row->no_rangka,0,0,'L');

			$this->Ln(10);
			$this->Ln(202);
			$this->Cell(10,0);
			$this->cell(40,0,$dari,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			$this->cell(40,0,$no,0,0,'L');
			$this->Ln(6);
			$this->Cell(10,0);
			$this->cell(40,0,$tgl,0,0,'L');
			
			$this->setFont('Arial','B',12);
			$this->Ln(1);
			$this->Cell(77,0);			
			$this->cell(20,0,$row->nomor_uji,0,0,'C');
			$this->Image(base_url().'files/pendaftaran/'.$daftar_uji.'/'.$row->qr_kodeuji,105,288,25,0,'PNG');
		}
	}
	
	function Penguji($data_penguji){
		foreach($data_penguji as $row){
			$this->setFont('Arial','B',10);
			
			//$this->Ln(10);
			$this->Ln();
			$this->Cell(30,0);
			$this->Cell(90,0);
			$this->cell(40,0,$row->nama,0,0,'C');
			$this->Ln(4);
			$this->Cell(30,0);
			$this->Cell(90,0);
			$this->cell(40,0,$row->no_reg,0,0,'C');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_pendaftaran);
$this->fpdf->tanggal($now);
$this->fpdf->pemohon($detail_pendaftaran);
$this->fpdf->retribusi($detail_pendaftaran);
$this->fpdf->kadis($kauptd);
$this->fpdf->kodeuji($detail_pendaftaran);
$this->fpdf->AddPage();
$this->fpdf->Content($detail_pendaftaran);
$this->fpdf->tanggal($now);
$this->fpdf->pemohon($detail_pendaftaran);
$this->fpdf->retribusi($detail_pendaftaran);
$this->fpdf->kadis($kauptd);
$this->fpdf->kodeuji($detail_pendaftaran);
$this->fpdf->AddPage();
$this->fpdf->Pengujian($detail_uji);
$this->fpdf->Penguji($data_penguji);
$this->fpdf->AutoPrint();
/*
$this->fpdf->AddPage();
$this->fpdf->Pengujian($detail_uji);
$this->fpdf->Penguji($data_penguji);
*/
$this->fpdf->Output("I",$title);
?>