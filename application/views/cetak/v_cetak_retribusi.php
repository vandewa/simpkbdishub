<?php
class PDF extends FPDF
{
	
	function rpkb($pkb){
		foreach($pkb as $row){
			$total_pkb = number_format($row->total_pkb, 0, ".", ",");
			
			$this->SetLeftMargin(20);
			$this->setFont('Arial','',10);
			$this->Ln(195);
			$this->setFillColor(255,255,255);	
			$this->cell(50,0,"Rp ".$total_pkb,0,0,'L');
		}
	}
	
	function rplat($plat){
		foreach($plat as $row){
			$total_plat = number_format($row->total_plat, 0, ".", ",");
			
			$this->cell(55,0,"Rp ".$total_plat,0,0,'L');
		}
	}
	
	function rbuku($buku){
		foreach($buku as $row){
			$total_buku = number_format($row->total_buku, 0, ".", ",");
			
			$this->cell(45,0,"Rp ".$total_buku,0,0,'L');
		}
	}
	
	function rstiker($stiker){
		foreach($stiker as $row){
			$total_stiker = number_format($row->total_stiker, 0, ".", ",");
			
			$this->cell(40,0,"Rp ".$total_stiker,0,0,'L');
		}
	}
	
	function rtotal($total){
		foreach($total as $row){
			$total_retribusi = number_format($row->total_retribusi, 0, ".", ",");
			
			$this->Ln(17);
			$this->cell(60,0,"Rp ".$total_retribusi,0,0,'L');
			$this->Ln(14);
			$this->cell(40,0);
			$this->cell(100,0,$row->terbilang,0,0,'L');
		}
	}
	
	function tanggal($now){
		$tanggal = unix_to_human($now);
		$sekarang = date("d-m-Y", strtotime($tanggal));
		$this->Ln(9);
		$this->cell(125,0);
		$this->cell(40,0,$sekarang,0,0,'C');
	}
	
	function kadis($kauptd){
		foreach($kauptd as $row){
			$this->Ln(38);
			$this->cell(117,0);
			$this->cell(40,0,$row->kepala_uptd,0,0,'C');
			$this->Ln(8);
			$this->cell(117,0);
			$this->cell(40,0,$row->nip,0,0,'C');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetMargins(10,10,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->rpkb($pkb);
$this->fpdf->rplat($plat);
$this->fpdf->rbuku($buku);
$this->fpdf->rstiker($stiker);
$this->fpdf->rtotal($total);
$this->fpdf->tanggal($now);
$this->fpdf->kadis($kauptd);
$this->fpdf->Output("I",$title);
?>