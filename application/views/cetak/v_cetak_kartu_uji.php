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
	
	function Kartu_uji($detail_kartu,$baris){
		foreach($detail_kartu as $row){
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
			$br_kiri_parkir = $row->br_tangan_kiri;
			$br_kanan_parkir = $row->br_tangan_kanan;
			$br_total_parkir = $br_kiri_parkir + $br_kanan_parkir;
			
			$rem_utama = ($br_total_s1 + $br_total_s2 + $br_total_s3)/$row->bk_total*100;
			$bef = ($rem_utama * $row->bk_total)/100;
			$rem_parkir = ($br_total_parkir / $row->bk_total)*100;
			
			if($rem_utama != "0"){
				$rem = "BEF : ".round($rem_utama,2)."% ";
			} else {
				$rem = "";
			}
			
			if($rem_parkir != "0"){
				$parkir = "PEF : ".round($rem_parkir,2)."% ";
			} else {
				$parkir = "";
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
			
			$asap = $row->asap;
			$asap_co = $row->asap_co;
			$asap_hc = $row->asap_hc;
			
			if($asap != ""){
				$smoke = "SMOKE : ".$row->asap."% ";
			} else {
				$smoke = "";
			}
			
			if($asap_co != ""){
				$co = "CO : ".$row->asap_co."% ";
			} else {
				$co = "";
			}
			
			if($asap_hc != ""){
				$hc = "HC : ".$row->asap_hc." ppm ";
			} else {
				$hc = "";
			}
			
			if($row->buku=="0"){
				$buku = "";
			} else {
				$buku = "No Buku : ".$row->kd_buku."".$row->no_buku;
			}
			
			if($row->stiker=="0"){
				$stiker = "";
			} else {
				$stiker = "No Stiker : ".$row->kd_stiker.''.$row->no_stiker;;
			}
			
			if($row->penguji==""){
				$penguji = "";
			} else {
				$penguji = "Penguji : ".$row->penguji." NRP : ".$row->no_reg;
			}
			
			if($row->jenis_surat=="numpang"){
				$tgl_daftar = "";
				$num = "SLAWI, ".date("d M Y",strtotime($row->tgl_daftar_uji))." Numpang Uji Ke ".$row->tujuan_num." No 551.2/".$row->no_surat." ".$buku;
				$berlaku = "";
				$hasil = "";
			} else if($row->jenis_surat=="mutasi"){
				$tgl_daftar = "";
				$num = "SLAWI, ".date("d M Y",strtotime($row->tgl_daftar_uji))." Mutasi Ke ".$row->tujuan_num." No 551.2/".$row->no_surat." ".$buku;
				$berlaku = "";
				$hasil = "";				
			} else {
				$tgl_daftar = "SLAWI, ".date("d M Y",strtotime($row->tgl_uji));
				$num = "";
				$berlaku = "BERLAKU 6 (ENAM) BULAN";
			}
			
			if($row->tgl_habis_uji==""){
				$tgl_habis = "";
			} else {
				$tgl_habis = date("d M Y",strtotime($row->tgl_habis_uji));
			}
			
			if($row->jenis_uji=="Pertama"){
				$hasil = $row->jenis_uji.", SRUT Nomor : ".$row->no_sertifikasi_uji.", ".$buku.", ".$smoke."".$co."".$hc."".$rem."".$parkir." ".$penguji;
			} else if($row->jenis_uji=="Berkala"){
				$hasil = $row->jenis_uji.", ".$buku.", ".$smoke."".$co."".$hc."".$rem."".$parkir." ".$penguji;
			} else if($row->jenis_uji=="Mutasi Masuk"){
				$hasil = $row->jenis_uji.", Mutasi : ".$row->num_dari." Nomor : ".$row->num_nomor.", ".$buku.", ".$smoke."".$co."".$hc."".$rem."".$parkir." ".$penguji;
			}
			
			$ln = ($baris*10)+87;
			$brs = $baris+1;
			$this->ln($ln);
			$this->setFont('Arial','',11);
			$this->cell(10,6,$brs,0,'L');
			$this->cell(75,6,$berlaku,0,0,'L');
			//$this->cell(75,6,'',0,0,'L');
			$this->Multicell(120,6,$num,0,'L');
			$this->cell(10);
			$this->cell(45,6,$tgl_daftar,0,0,'L');
			$this->cell(30,6,$tgl_habis,0,0,'L');
			$this->Multicell(120,6,$hasil,0,'L');
			//$this->cell(10,6,$row->penguji,0,'L');
			$this->ln();
			
		}
	}
}

$this->fpdf = new PDF("L","mm",array(210,330));
$this->fpdf->SetAutoPageBreak(false);
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Kartu_uji($detail_kartu,$baris);
$this->fpdf->AutoPrint();
$this->fpdf->Output("I",$title);
?>