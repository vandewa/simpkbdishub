<?php
class PDF extends FPDF
{
	
	function Content($detail_sts){
		foreach($detail_sts as $row){
			//$this->SetLeftMargin(60);
			$this->setFont('Arial','',10);
			$this->Ln(31);
			$this->setFillColor(255,255,255);	
			$this->cell(20,0);
			$this->Cell(40,0,$row->no_sts,0,0,'L');
		}
	}
	
	function bank($detail_bank){
		foreach($detail_bank as $row){
			$this->Ln(2);
			$this->Cell(160,0);
			$this->Cell(30,0,$row->nama_bank,0,0,'L');
			$this->Ln(6);
			$this->Cell(160,0);
			$this->Cell(30,0,$row->no_rek,0,0,'L');
		}
	}
	
	function rincian($detail_sts){
		foreach($detail_sts as $row){
			$jml_retribusi = number_format($row->jml_retribusi, 0, ".", ",");
			$mob_pen = number_format($row->mob_pen, 0, ".", ",");
			$mob_min_bus = number_format($row->mob_min_bus, 0, ".", ",");
			$mob_bus = number_format($row->mob_bus, 0, ".", ",");
			$mob_bar_pick = number_format($row->mob_bar_pick, 0, ".", ",");
			$mob_bar_truck = number_format($row->mob_bar_truck, 0, ".", ",");
			
			$this->setFont('Arial','B' ,12);
			$this->Ln(11);
			$this->Cell(65,0);
			$this->Cell(30,0,"Rp ".$jml_retribusi,0,0,'L');
			$this->Ln(6);
			$this->Cell(65,0);
			$this->Cell(100,0,$row->terbilang,0,0,'L');
			$this->Ln(39);
			$this->setFont('Arial','',10);
			//$this->Cell(5,0);
			$this->Cell(7,0,'1',0,0,'L');
			$this->Cell(15,0,'4',0,0,'L');
			$this->Cell(10,0,'1',0,0,'L');
			$this->Cell(10,0,'2',0,0,'L');
			$this->Cell(5,0,'01',0,0,'L');
			$this->Cell(20,0,'23',0,0,'L');
			$this->Cell(30,0,'MOBIL PENUMPANG/TAXI',0,0,'L');
			$this->Cell(70,0);
			$this->Cell(30,0,"Rp ".$mob_pen,0,0,'L');
			$this->Ln(6);
			//$this->Cell(5,0);
			$this->Cell(7,0,'2',0,0,'L');
			$this->Cell(15,0,'4',0,0,'L');
			$this->Cell(10,0,'1',0,0,'L');
			$this->Cell(10,0,'2',0,0,'L');
			$this->Cell(5,0,'01',0,0,'L');
			$this->Cell(20,0,'25',0,0,'L');
			$this->Cell(30,0,'MOBIL MINI BUS',0,0,'L');
			$this->Cell(70,0,'(JBB 0 - 4000)',0,0,'L');
			$this->Cell(30,0,"Rp ".$mob_min_bus,0,0,'L');
			$this->Ln(6);
			//$this->Cell(5,0);
			$this->Cell(7,0,'3',0,0,'L');
			$this->Cell(15,0,'4',0,0,'L');
			$this->Cell(10,0,'1',0,0,'L');
			$this->Cell(10,0,'2',0,0,'L');
			$this->Cell(5,0,'01',0,0,'L');
			$this->Cell(20,0,'27',0,0,'L');
			$this->Cell(30,0,'MOBIL BUS',0,0,'L');
			$this->Cell(70,0,'(JBB 4001 - 8000)',0,0,'L');
			$this->Cell(30,0,"Rp ".$mob_bus,0,0,'L');
			$this->Ln(6);
			$this->Cell(97,0);
			$this->Cell(70,0,'(JBB 8001 - 14000)',0,0,'L');
			$this->Ln(6);
			$this->Cell(97,0);
			$this->Cell(70,0,'(JBB 14001 KE ATAS)',0,0,'L');
			$this->Ln(7);
			//$this->Cell(5,0);
			$this->Cell(7,0,'4',0,0,'L');
			$this->Cell(15,0,'4',0,0,'L');
			$this->Cell(10,0,'1',0,0,'L');
			$this->Cell(10,0,'2',0,0,'L');
			$this->Cell(5,0,'01',0,0,'L');
			$this->Cell(20,0,'28',0,0,'L');
			$this->Cell(30,0,'MOBIL BARANG',0,0,'L');
			$this->Cell(70,0,'(PICK UP)',0,0,'L');
			$this->Cell(30,0,"Rp ".$mob_bar_pick,0,0,'L');
			$this->Ln(6);
			$this->Cell(97,0);
			$this->Cell(70,0,'(JBB 0 - 4000)',0,0,'L');
			$this->Ln(6);
			//$this->Cell(5,0);
			$this->Cell(7,0,'5',0,0,'L');
			$this->Cell(15,0,'4',0,0,'L');
			$this->Cell(10,0,'1',0,0,'L');
			$this->Cell(10,0,'2',0,0,'L');
			$this->Cell(5,0,'01',0,0,'L');
			$this->Cell(20,0,'30',0,0,'L');
			$this->Cell(30,0,'MOBIL BARANG',0,0,'L');
			$this->Cell(70,0,'(TRUCK)',0,0,'L');
			$this->Cell(30,0,"Rp ".$mob_bar_truck,0,0,'L');
			$this->Ln(6);
			$this->Cell(97,0);
			$this->Cell(70,0,'(JBB 4001 - 8000)',0,0,'L');
			$this->Ln(6);
			$this->Cell(97,0);
			$this->Cell(70,0,'(JBB 8001 - 14000)',0,0,'L');
			$this->Ln(6);
			$this->Cell(97,0);
			$this->Cell(70,0,'(JBB 14001 KE ATAS)',0,0,'L');
			$this->Ln(6);
			$this->Cell(67,0);
			$this->Cell(30,0,'GANDENG & KERETA TEMPELAN',0,0,'L');
			//$this->Cell(5,0);
			/*
			$this->Cell(7,0,'6',0,0,'L');
			$this->Cell(15,0,'4',0,0,'L');
			$this->Cell(10,0,'1',0,0,'L');
			$this->Cell(10,0,'2',0,0,'L');
			$this->Cell(5,0,'01',0,0,'L');
			$this->Cell(20,0,'30',0,0,'L');
			$this->Cell(30,0,'GANDENG & KERETA TEMPELAN',0,0,'L');
			$this->Cell(70,0);
			$this->Cell(30,0,$row->gan_tem,0,0,'L');
			*/
			$this->Ln(75);
			$this->Cell(130,0);
			$this->Cell(35,0);
			$this->Cell(30,0,"Rp ".$jml_retribusi,0,0,'L');
			
			$sekarang = date("d M Y", strtotime($row->tgl_sts));
			$this->Ln(7);
			$this->cell(110,0);
			$this->cell(40,0,$sekarang,0,0,'L');
			$this->Ln(32);
			$this->Cell(27,0);
			$this->Cell(40,0,'WIDODO TRIONO',0,0,'C');
			$this->Cell(77,0);
			$this->Cell(40,0,'SUGENG WIBOWO',0,0,'C');
			$this->Ln(5);
			$this->Cell(27,0);
			$this->Cell(40,0,'19630127 198903 1 004',0,0,'C');
			$this->Cell(77,0);
			$this->Cell(40,0,'19831103 201406 1 002',0,0,'C');
		}
	}
}

$this->fpdf = new PDF("P","mm",array(210,330));
$this->fpdf->SetMargins(8,10,10); 
$this->fpdf->SetTitle($title);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->Content($detail_sts);
$this->fpdf->bank($detail_bank);
$this->fpdf->rincian($detail_sts);
$this->fpdf->Output("I",$title);
?>