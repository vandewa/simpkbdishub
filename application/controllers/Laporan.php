<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_laporan','laporan');
		$this->load->model('model_app');
		$this->load->model('akses');
		$this->load->library('encryption');
		$this->load->library('fpdf');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->helper('date');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function index(){
		$data=array(
			'aktif_laporan'=>'active',
			'title'=>'Laporan',
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan');
		$this->load->view('pages/v_footer');
	}
	
	public function uji_tka1(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tka1'=>'active',
			'title'=>'Laporan Pendaftaran Uji Harian TKA-1'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tka1');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitka1(){
		$this->akses->akses_petugas();
		$tglawal = $this->input->post('tgl_awal');
		$tglakhir = $this->input->post('tgl_akhir');
		$ttd = $this->input->post('ttd');
		$data=array(
			'dt_laporan_ujitka1'=>$this->laporan->getLapUjiTka1($tglawal,$tglakhir),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal'=> $tglawal,
			'tglakhir' => $tglakhir,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_pengujian_tka1',$data);
	}
	
	public function cetak_ujitka1(){
		$this->akses->akses_petugas();
		$tglawal = $this->input->get('awal', TRUE);
		$tglakhir = $this->input->get('akhir', TRUE);
		$ttd = $this->input->get('ttd', TRUE);
		$data=array(
			'title'=>'Laporan Uji Harian(TKA-1) Periode '.strftime("%d %B %Y", strtotime($tglawal)).' - '.strftime("%d %B %Y", strtotime($tglakhir)),
			'dt_laporan_ujitka1'=>$this->laporan->getLapUjiTka1($tglawal,$tglakhir),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal'=> $tglawal,
			'tglakhir' => $tglakhir,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_cetak_pengujian_tka1',$data);
	}
	
	public function ujipertama(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_pertama'=>'active',
			'title'=>'Laporan Pendaftaran Uji Pertama'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_pertama');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujipertama(){
		$this->akses->akses_petugas();
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'laporan_ujipertama'=>$this->laporan->getLapPenBaru($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('laporan/v_ajax_pengujian_ujipertama',$data);
	}
	
	public function exportpengujian_ujipertama(){
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$pendaftaran = $this->laporan->getLapPenBaru($awal,$akhir);
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("GHANI - SIM PKB") //creator
			->setTitle("Laporan Pengujian Uji Pertama periode ".$awal."-".$akhir." - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
		$objget->setTitle('Laporan Pengujian'); //sheet title
		
		$objget->getStyle("A1:H2")->applyFromArray(
			array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'font' => array(
					'bold' => 'true',
				)
			)
		);
		
		//table header
		$cols = array("A","B","C","D","E","F","G","H");
		 
		$val = array("No","Jenis Kendaraan","Merk/Tipe","Tahun","No Uji","No Rangka","Nama","Nomor SRUT");
		$val2 = array("","Bentuk","","","No Kendaraan","No Mesin","Alamat","");
		 
		for ($a=0;$a<8; $a++) {
			$objset->setCellValue($cols[$a].'1', $val[$a]);
			$objset->setCellValue($cols[$a].'2', $val2[$a]);
			$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
		}
		$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
		$objPHPExcel->getActiveSheet()->mergeCells('C1:C2');
		$objPHPExcel->getActiveSheet()->mergeCells('D1:D2');
		$objPHPExcel->getActiveSheet()->mergeCells('H1:H2');
		
		$urut=1;
		$no=3;
		foreach($pendaftaran as $row){
			$baris = $no++;
			$baris2 = $no++;
			$col = array($urut++,$row->jenis_kendaraan,$row->merek,$row->tahun,$row->no_uji,$row->no_rangka,$row->nama,$row->no_sertifikasi_uji);
			$col2 = array("",$row->bentuk,"","",$row->no_kendaraan,$row->no_mesin,$row->alamat,"");
			
			$style = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				
			);
			
			for ($a=0;$a<8; $a++) {
				$objset->setCellValue($cols[$a].$baris, $col[$a]);
				$objset->setCellValue($cols[$a].$baris2, $col2[$a]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
			}
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':H'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris2.':H'.$baris2)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':A'.$baris2);
			$objPHPExcel->getActiveSheet()->mergeCells('C'.$baris.':C'.$baris2);
			$objPHPExcel->getActiveSheet()->mergeCells('D'.$baris.':D'.$baris2);
			$objPHPExcel->getActiveSheet()->mergeCells('H'.$baris.':H'.$baris2);
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Laporan Pengujian');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = "Laporan Pengujian Uji Pertama Periode ".date("d F Y",strtotime($awal))." - ".date("d F Y",strtotime($akhir)).".xlsx";
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	public function uji_tkb4(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tkb4'=>'active',
			'title'=>'Laporan Jumlah Kendaraan Uji Berdasarkan Jenis dan Sifat Mingguan TKB-4'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tkb4');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitkb4(){
		$this->akses->akses_petugas();
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$rekap = $this->input->get('rekap', TRUE);
		$ttd = $this->input->get('ttd', TRUE);
		$data=array(
			'title'=>'Laporan Jumlah Kendaraan Uji (TKB-4) Periode '.strftime("%d %B %Y", strtotime($awal)).' - '.strftime("%d %B %Y", strtotime($akhir)),
			'laporan_ujitkb4'=>$this->laporan->getLapUjiTkb4($awal,$akhir),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal' => $awal,
			'tglakhir' => $akhir,
			'rekap' => $rekap,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_pengujian_tkb4',$data);
	}
	
	public function uji_tkb5(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tkb5'=>'active',
			'title'=>'Laporan Jumlah Kendaraan Uji Berdasarkan Jenis dan Sifat TKB-5'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tkb5');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitkb5(){
		$this->akses->akses_petugas();
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$rekap = $this->input->get('rekap', TRUE);
		$ttd = $this->input->get('ttd', TRUE);
		$data=array(
			'title'=>'Laporan Jumlah Kendaraan Uji (TKB-5) Periode '.strftime("%d %B %Y", strtotime($awal)).' - '.strftime("%d %B %Y", strtotime($akhir)),
			'laporan_ujitkb5'=>$this->laporan->getLapUjiTkb5($awal,$akhir,$rekap),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal' => $awal,
			'tglakhir' => $akhir,
			'rekap' => $rekap,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_pengujian_tkb5',$data);
	}
	
	public function uji_tkb7(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tkb7'=>'active',
			'title'=>'Laporan Jumlah Kendaraan Uji Berdasarkan Umur dan JBB TKB-7'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tkb7');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitkb7(){
		$this->akses->akses_petugas();
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$ttd = $this->input->get('ttd', TRUE);
		$data=array(
			'title'=>'Laporan Jumlah Kendaraan Uji (TKB-7) Periode '.strftime("%d %B %Y", strtotime($awal)).' - '.strftime("%d %B %Y", strtotime($akhir)),
			//'laporan_ujitkb5'=>$this->laporan->getLapUjiTkb5($awal,$akhir,$rekap),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal' => $awal,
			'tglakhir' => $akhir,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_pengujian_tkb7',$data);
	}
	
	public function uji_tkc2(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tkc2'=>'active',
			'title'=>'Laporan Pengujian Berdasarkan Jenis Kendaraan, JBB, dan Sifat Kendaraan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tkc2');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitkc2(){
		$this->akses->akses_petugas();
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$ttd = $this->input->get('ttd', TRUE);
		$data=array(
			'title'=>'Laporan Jumlah Kendaraan Uji Berdasarkan Jenis Kendaraan, JBB, dan Sifat Kendaraan (TKC-2) Periode '.strftime("%d %B %Y", strtotime($awal)).' - '.strftime("%d %B %Y", strtotime($akhir)),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal' => $awal,
			'tglakhir' => $akhir,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_pengujian_ujitkc2',$data);
	}
	
	public function uji_tkc3(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tkc3'=>'active',
			'title'=>'Laporan Pengujian Berdasarkan Jenis Kendaraan, Daya Angkut, dan Sifat Kendaraan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tkc3');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitkc3(){
		$this->akses->akses_petugas();
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$ttd = $this->input->get('ttd', TRUE);
		$data=array(
			'title'=>'Laporan Jumlah Kendaraan Uji Berdasarkan Jenis Kendaraan, Daya Angkut, dan Sifat Kendaraan (TKC-3) Periode '.strftime("%d %B %Y", strtotime($awal)).' - '.strftime("%d %B %Y", strtotime($akhir)),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal' => $awal,
			'tglakhir' => $akhir,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_pengujian_ujitkc3',$data);
	}
	
	public function uji_tkc4(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tkc4'=>'active',
			'title'=>'Laporan Pengujian Berdasarkan Muatan Sumbu, Jenis Kendaraan, dan Sifat Kendaraan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tkc4');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitkc4(){
		$this->akses->akses_petugas();
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$ttd = $this->input->get('ttd', TRUE);
		$data=array(
			'title'=>'Laporan Jumlah Kendaraan Uji Berdasarkan Muatan Sumbu, Jenis Kendaraan, dan Sifat Kendaraan (TKC-4) Periode '.strftime("%d %B %Y", strtotime($awal)).' - '.strftime("%d %B %Y", strtotime($akhir)),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal' => $awal,
			'tglakhir' => $akhir,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_pengujian_ujitkc4',$data);
	}
	
	public function uji_tkc5(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tkc5'=>'active',
			'title'=>'Laporan Jumlah KBWU Uji Pertama TKC5'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tkc5');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitkc5(){
		$this->akses->akses_petugas();
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$rekap = $this->input->get('rekap', TRUE);
		$ttd = $this->input->get('ttd', TRUE);
		$data=array(
			'laporan_ujitkc5'=>$this->laporan->getJmlUjiPertama($awal,$akhir,$rekap),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal' => $awal,
			'tglakhir' => $akhir,
			'rekap' => $rekap,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_pengujian_ujitkc5',$data);
	}
	
	public function uji_tkc6(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tkc6'=>'active',
			'title'=>'Laporan Jumlah KBWU Uji TKC6'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tkc6');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitkc6(){
		$this->akses->akses_petugas();
		$jenis = $this->input->post('jenis');
		$status = $this->input->post('status');
		$data=array(
			'dt_laporan'=>$this->laporan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>$jenis))->result(),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'kadis'))->result(),
			'kategori' => $jenis,
			'status' => $status,
		);
		$this->load->view('laporan/v_ajax_pengujian_ujitkc6',$data);
	}
	
	public function cetak_ujitkc6(){
		$this->akses->akses_petugas();
		$jenis = $this->input->get('jenis', TRUE);
		$status = $this->input->get('status', TRUE);
		$data=array(
			'title'=>'Laporan jumlah KBWU uji '.$status.' berdasarkan '.$jenis,
			'dt_laporan'=>$this->laporan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>$jenis))->result(),
			'pengesahan' =>$this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'kadis'))->result(),
			'kategori' => $jenis,
			'status' => $status,
		);
		$this->load->view('laporan/v_ajax_cetak_pengujian_ujitkc6',$data);
	}
	
	public function uji_tkc7(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_pengujian'=>'active',
			'aktif_uji_tkc7'=>'active',
			'title'=>'Laporan Pengujian Berdasarkan Daya Angkut Orang, Jenis Kendaraan, dan Sifat Kendaraan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_uji_tkc7');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_ujitkc7(){
		$this->akses->akses_petugas();
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$ttd = $this->input->get('ttd', TRUE);
		$data=array(
			'title'=>'Laporan Jumlah Kendaraan Uji Berdasarkan Daya Angkut Orang, Jenis Kendaraan, dan Sifat Kendaraan (TKC-7) Periode '.strftime("%d %B %Y", strtotime($awal)).' - '.strftime("%d %B %Y", strtotime($akhir)),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>$ttd))->result(),
			'tglawal' => $awal,
			'tglakhir' => $akhir,
			'ttd'=>$ttd,
		);
		$this->load->view('laporan/v_ajax_pengujian_ujitkc7',$data);
	}
	
	// PENDAFTARAN
	
	public function pendaftaran(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_pendaftaran'=>'active',
			'aktif_laporan_pendaftaran_periode'=>'active',
			'title'=>'Laporan Pendaftaran Periode'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_pendaftaran');
		$this->load->view('pages/v_footer');
	}
	
	public function pendaftaran_periode(){
		$this->akses->akses_petugas();
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_pendaftaran'=>'active',
			'aktif_laporan_pendaftaran_periode'=>'active',
			'title'=>'Laporan Pendaftaran Periode',
			'laporan_pendaftaran'=>$this->laporan->getLapPendaftaran($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_pendaftaran_tanggal');
		$this->load->view('pages/v_footer');
	}
	
	public function export_pendaftaran_periode(){
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$pendaftaran = $this->laporan->getLapPendaftaran($awal,$akhir);
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("GHANI - SIM PKB") //creator
			->setTitle("Laporan Pendaftaran Periode ".$awal."-".$akhir." - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('Laporan Pendaftaran'); //sheet title
		//Warna header tabel
		$objget->getStyle("A1:I1")->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => '00e4ff')
				),
				'font' => array(
					'color' => array('rgb' => '000000')
				)
			)
		);
		
		//table header
		$cols = array("A","B","C","D","E","F","G","H","I");
		 
		$val = array("No","Tanggal","No Uji","No Kendaraan","Jenis Kendaraan","Jenis Uji","Pemohon","Alamat Pemohon","Telepon");
		 
		for ($a=0;$a<9; $a++) {
			$objset->setCellValue($cols[$a].'1', $val[$a]);
		 
			//Setting lebar cell
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		 
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
		}
		
		$baris  = 2;
		$no=1;
		foreach($pendaftaran as $row){
			$objset->setCellValue("A".$baris, $no++);
			$objset->setCellValue("B".$baris, date("d M Y",strtotime($row->tgl_daftar_uji)));
			$objset->setCellValue("C".$baris, $row->no_uji);
			$objset->setCellValue("D".$baris, $row->no_kendaraan);
			$objset->setCellValue("E".$baris, $row->jenis);
			$objset->setCellValue("F".$baris, $row->jenis_uji);
			$objset->setCellValue("G".$baris, $row->nama_pemohon);
			$objset->setCellValue("H".$baris, $row->alamat_pemohon);
			$objset->setCellValue("I".$baris, $row->telp);
			
			//Set number value
			$objPHPExcel->getActiveSheet()->getStyle('I2:I'.$baris)->getNumberFormat()->setFormatCode('0');
			
			$baris++;
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Pendaftaran Periode');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = urlencode("Laporan Pendaftaran Periode".date("Y-m-d H:i:s").".xlsx");
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	public function pendaftaran_jenisuji(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_pendaftaran'=>'active',
			'aktif_laporan_pendaftaran_jenisuji'=>'active',
			'title'=>'Laporan Pendaftaran Jenis Permohonan Uji'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_pendaftaran_jenisuji');
		$this->load->view('pages/v_footer');
	}
	
	public function pendaftaran_jenisuji_cari(){
		$this->akses->akses_petugas();
		$jenis = $this->input->post('jenis_uji');
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		if($jenis=='Berkala'){
			$data=array(
				'aktif_laporan'=>'active',
				'aktif_laporan_pendaftaran'=>'active',
				'aktif_laporan_pendaftaran_jenisuji'=>'active',
				'title'=>'Laporan Pendaftaran Jenis Permohonan Uji',
				'laporan_pendaftaran'=>$this->laporan->getLapPendaftaranJenisUjiBerkala($awal,$akhir),
				'jenis'=> $jenis,
				'tgl_awal'=> $awal,
				'tgl_akhir' => $akhir,
			);
		} else {
			$data=array(
				'aktif_laporan'=>'active',
				'aktif_laporan_pendaftaran'=>'active',
				'aktif_laporan_pendaftaran_jenisuji'=>'active',
				'title'=>'Laporan Pendaftaran Jenis Permohonan Uji',
				'laporan_pendaftaran'=>$this->laporan->getLapPendaftaranJenisUji($jenis,$awal,$akhir),
				'jenis'=> $jenis,
				'tgl_awal'=> $awal,
				'tgl_akhir' => $akhir,
			);
		}
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_pendaftaran_jenisuji_tanggal');
		$this->load->view('pages/v_footer');
	}
	
	public function export_pendaftaran_jenisuji(){
		$jenis = $this->input->post('jenis_uji');
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$pendaftaran = $this->laporan->getLapPendaftaranJenisUji($jenis,$awal,$akhir);
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("GHANI - SIM PKB") //creator
			->setTitle("Laporan Pendaftaran Berdasarkan Permohonan Jenis uji ".$jenis." periode ".$awal."-".$akhir." - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
		$objget->setTitle('Laporan Pendaftaran'); //sheet title
		
		if(($jenis=="Numpang Masuk") || ($jenis=="Mutasi Masuk")){
			//Warna header tabel
			$objget->getStyle("A1:J1")->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => '00e4ff')
					),
					'font' => array(
						'color' => array('rgb' => '000000')
					)
				)
			);
			
			//table header
			$cols = array("A","B","C","D","E","F","G","H","I","J");
			 
			$val = array("No","Tanggal","No Uji","No Kendaraan","Jenis Kendaraan","Pemohon","Alamat Pemohon","Dari","Nomor","Tanggal");
			 
			for ($a=0;$a<10; $a++) {
				$objset->setCellValue($cols[$a].'1', $val[$a]);
			 
				//Setting lebar cell
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			 
				$style = array(
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					)
				);
				$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
			}
			
			$baris  = 2;
			$no=1;
			foreach($pendaftaran as $row){
				if($row->num_tgl=="0000-00-00"){
					$num_tgl = "";
				} else {
					$num_tgl = date("d M Y",strtotime($row->num_tgl));
				}
				$objset->setCellValue("A".$baris, $no++);
				$objset->setCellValue("B".$baris, date("d M Y",strtotime($row->tgl_daftar_uji)));
				$objset->setCellValue("C".$baris, $row->no_uji);
				$objset->setCellValue("D".$baris, $row->no_kendaraan);
				$objset->setCellValue("E".$baris, $row->jenis);
				$objset->setCellValue("F".$baris, $row->nama_pemohon);
				$objset->setCellValue("G".$baris, $row->alamat_pemohon);
				$objset->setCellValue("H".$baris, $row->num_dari);
				$objset->setCellValue("I".$baris, $row->num_nomor);
				$objset->setCellValue("J".$baris, $num_tgl);
				
				$baris++;
			}
		} else if($jenis=="Pertama") {	
			//Warna header tabel
			$objget->getStyle("A1:H2")->applyFromArray(
				array(
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					),
					'font' => array(
						'bold' => 'true',
					)
				)
			);
			
			//table header
			$cols = array("A","B","C","D","E","F","G","H");
			 
			$val = array("No","Jenis Kendaraan","Merk/Tipe","Tahun","No Uji","No Rangka","Nama","Nomor SRUT");
			$val2 = array("","Bentuk","","","No Kendaraan","No Mesin","Alamat","");
			 
			for ($a=0;$a<8; $a++) {
				$objset->setCellValue($cols[$a].'1', $val[$a]);
				$objset->setCellValue($cols[$a].'2', $val2[$a]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
			}
			$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
			$objPHPExcel->getActiveSheet()->mergeCells('C1:C2');
			$objPHPExcel->getActiveSheet()->mergeCells('D1:D2');
			$objPHPExcel->getActiveSheet()->mergeCells('H1:H2');
			
			$urut=1;
			$no=3;
			foreach($pendaftaran as $row){
				$baris = $no++;
				$baris2 = $no++;
				$col = array($urut++,$row->jenis_kendaraan,$row->merek,$row->tahun,$row->no_uji,$row->no_rangka,$row->nama,$row->no_sertifikasi_uji);
				$col2 = array("",$row->jenis,"","",$row->no_kendaraan,$row->no_mesin,$row->alamat,"");
				
				$style = array(
					'alignment' => array(
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					),
					
				);
				
				for ($a=0;$a<8; $a++) {
					$objset->setCellValue($cols[$a].$baris, $col[$a]);
					$objset->setCellValue($cols[$a].$baris2, $col2[$a]);
					$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
				}
				$objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':H'.$baris)->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$baris2.':H'.$baris2)->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':A'.$baris2);
				$objPHPExcel->getActiveSheet()->mergeCells('C'.$baris.':C'.$baris2);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.$baris.':D'.$baris2);
				$objPHPExcel->getActiveSheet()->mergeCells('H'.$baris.':H'.$baris2);
			}
			
			
			/*
			foreach($pendaftaran as $row){
				$objset->setCellValue("A".$baris, $no++);
				$objset->setCellValue("A".$baris, $no++);
				$objset->setCellValue("B".$baris, $row->jenis);
				$objset->setCellValue("B".$baris, $row->jenis);
				$objset->setCellValue("C".$baris, $row->merek);
				$objset->setCellValue("C".$baris, $row->merek);
				$objset->setCellValue("D".$baris, $row->tahun);
				$objset->setCellValue("D".$baris, $row->tahun);
				$objset->setCellValue("E".$baris, $row->no_uji);
				$objset->setCellValue("E".$baris, $row->no_uji);
				$objset->setCellValue("F".$baris, $row->no_rangka);
				$objset->setCellValue("F".$baris, $row->no_rangka);
				$objset->setCellValue("G".$baris, $row->nama);
				$objset->setCellValue("G".$baris, $row->nama);
				$objset->setCellValue("H".$baris, $row->no_sertifikasi_uji);
				$objset->setCellValue("H".$baris, $row->no_sertifikasi_uji);
				//$objset->setCellValue("I".$baris, $row->no_sertifikasi_uji);
				
				//Set number value
				//$objPHPExcel->getActiveSheet()->getStyle('H2:H'.$baris)->getNumberFormat()->setFormatCode('0');
				
				//$baris++;
			}
			*/
		} else {
			$objget->getStyle("A1:I1")->applyFromArray(
				array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => '00e4ff')
					),
					'font' => array(
						'color' => array('rgb' => '000000')
					)
				)
			);
			
			//table header
			$cols = array("A","B","C","D","E","F","G","H","I");
			 
			$val = array("No","Tanggal","No Uji","No Kendaraan","Nama","Jenis Kendaraan","No Rangka","No Mesin","No SRUT");
			 
			for ($a=0;$a<9; $a++) {
				$objset->setCellValue($cols[$a].'1', $val[$a]);
			 
				//Setting lebar cell
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(50);
			 
				$style = array(
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					)
				);
				$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
			}
			
			$baris  = 2;
			$no=1;
			foreach($pendaftaran as $row){
				$objset->setCellValue("A".$baris, $no++);
				$objset->setCellValue("B".$baris, date("d M Y",strtotime($row->tgl_daftar_uji)));
				$objset->setCellValue("C".$baris, $row->no_uji);
				$objset->setCellValue("D".$baris, $row->no_kendaraan);
				$objset->setCellValue("E".$baris, $row->nama);
				$objset->setCellValue("F".$baris, $row->jenis);
				$objset->setCellValue("G".$baris, $row->no_rangka);
				$objset->setCellValue("H".$baris, $row->no_mesin);
				$objset->setCellValue("I".$baris, $row->no_sertifikasi_uji);
				
				//Set number value
				//$objPHPExcel->getActiveSheet()->getStyle('H2:H'.$baris)->getNumberFormat()->setFormatCode('0');
				
				$baris++;
			}
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Pendaftaran Periode');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = urlencode("Laporan Pendaftaran Periode".date("Y-m-d H:i:s").".xlsx");
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	public function pendaftaran_jeniskendaraan(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_pendaftaran'=>'active',
			'aktif_laporan_pendaftaran_jeniskendaraan'=>'active',
			'title'=>'Laporan Pendaftaran Jenis Kendaraan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_pendaftaran_jeniskendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function pendaftaran_jeniskendaraan_cari(){
		$this->akses->akses_petugas();
		$kendaraan = $this->input->post('jenis_kendaraan');
		$jenis = join("','",$kendaraan);
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_pendaftaran'=>'active',
			'aktif_laporan_pendaftaran_jeniskendaraan'=>'active',
			'title'=>'Laporan Pendaftaran Jenis Kendaraan',
			'laporan_pendaftaran'=>$this->laporan->getLapPendaftaranJenisKendaraan($jenis,$awal,$akhir),
			'jenis'=> $jenis,
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_pendaftaran_jeniskendaraan_tanggal');
		$this->load->view('pages/v_footer');
	}
	
	public function export_pendaftaran_jeniskendaraan(){
		$jenis = $this->input->post('jenis_kendaraan');
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$pendaftaran = $this->laporan->getLapPendaftaranJenisKendaraan($jenis,$awal,$akhir);
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("GHANI - SIM PKB") //creator
			->setTitle("Laporan Pendaftaran Berdasarkan Jenis Kendaraan ".$awal."-".$akhir." - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('Laporan Pendaftaran'); //sheet title
		//Warna header tabel
		$objget->getStyle("A1:I1")->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => '00e4ff')
				),
				'font' => array(
					'color' => array('rgb' => '000000')
				)
			)
		);
		
		//table header
		$cols = array("A","B","C","D","E","F","G","H","I");
		 
		$val = array("No","Tanggal","No Uji","No Kendaraan","Jenis Kendaraan","Jenis Uji","Pemohon","Alamat Pemohon","Telepon");
		 
		for ($a=0;$a<9; $a++) {
			$objset->setCellValue($cols[$a].'1', $val[$a]);
		 
			//Setting lebar cell
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		 
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
		}
		
		$baris  = 2;
		$no=1;
		foreach($pendaftaran as $row){
			$objset->setCellValue("A".$baris, $no++);
			$objset->setCellValue("B".$baris, date("d M Y",strtotime($row->tgl_daftar_uji)));
			$objset->setCellValue("C".$baris, $row->no_uji);
			$objset->setCellValue("D".$baris, $row->no_kendaraan);
			$objset->setCellValue("E".$baris, $row->jenis);
			$objset->setCellValue("F".$baris, $row->jenis_uji);
			$objset->setCellValue("G".$baris, $row->nama_pemohon);
			$objset->setCellValue("H".$baris, $row->alamat_pemohon);
			$objset->setCellValue("I".$baris, $row->telp);
			
			//Set number value
			$objPHPExcel->getActiveSheet()->getStyle('I2:I'.$baris)->getNumberFormat()->setFormatCode('0');
			
			$baris++;
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Pendaftaran Jenis Kendaraan');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = urlencode("Laporan Pendaftaran Jenis Kendaraan".date("Y-m-d H:i:s").".xlsx");
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}

	public function kendaraan(){
		$this->akses->akses_petugas();
		$this->load->helper('date');
		$data=array(
			'aktif_laporan'=>'active',
			'title'=>'Laporan Kendaraan',
			'm_baru'=>$this->laporan->getLapMBaru(),
			'm_num'=>$this->laporan->getLapMNum(),
			'm_nuk'=>$this->laporan->getLapMNuk(),
			'm_mm'=>$this->laporan->getLapMMm(),
			'm_mk'=>$this->laporan->getLapMMk(),
			'm_pnm'=>$this->laporan->getLapMPnm(),
			'm_mbus4'=>$this->laporan->getLapMBus4(),
			'm_mtruck4'=>$this->laporan->getLapMTruck4(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function pengujian(){
		$this->akses->akses_petugas();
		$this->load->helper('date');
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_pengujian'=>'active',
			'aktif_pengujian_harian'=>'active',
			'title'=>'Laporan Pengujian'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_pengujian');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_pengujian_tanggal(){
		$this->akses->akses_petugas();
		$this->load->helper('date');
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'aktif_laporan'=>'active',
			'title'=>'Laporan Pengujian',
			'dt_pengujian'=>$this->laporan->getDataLapPengujianTanggal($awal,$akhir),
			'tgl_awal'=>$awal,
			'tgl_akhir'=>$akhir,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_pengujian_tanggal');
		$this->load->view('pages/v_footer');
	}
	
	public function export_pengujian(){
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$pengujian = $this->laporan->getDataLapPengujianTanggal($awal,$akhir);
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("GHANI - SIM PKB") //creator
			->setTitle("Rekap Laporan Pengujian Tanggal ".$awal."-".$akhir." - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('Pengujian'); //sheet title
		//Warna header tabel
		$objget->getStyle("A3:J3")->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'ffffff')
					//'color' => array('rgb' => '00e4ff')
				),
				'font' => array(
					'color' => array('rgb' => '000000')
				)
			)
		);
		
		//table header
		$cols = array("A","B","C","D","E","F","G","H","I","J");
		 
		$val = array("No","Tanggal","No Uji","No Kend","Jenis","Jenis Uji","Nama","Hasil Uji","Penguji","Habis Uji");
		 
		for ($a=0;$a<10; $a++) {
			$objset->setCellValue($cols[$a].'3', $val[$a]);
		 
			//Setting lebar cell
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9);
		 
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_DASHED
					)
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'3')->applyFromArray($style);
		}
		
		foreach ($retribusi as $row){    
		   //pemanggilan sesuaikan dengan nama kolom tabel
			$objset->setCellValue("B2", "Tanggal : ".date("d M Y",strtotime($row->tgl_daftar_uji)));
		}
		
		$baris  = 4;
		$no=1;
		foreach ($pengujian as $row){
			 
		   //pemanggilan sesuaikan dengan nama kolom tabel
			$objset->setCellValue("A".$baris, $no++);
			$objset->setCellValue("B".$baris, date("d M Y",strtotime($row->tgl_daftar_uji)));
			$objset->setCellValue("C".$baris, $row->no_uji);
			$objset->setCellValue("D".$baris, $row->no_kendaraan);
			$objset->setCellValue("E".$baris, $row->jenis);
			$objset->setCellValue("F".$baris, $row->jenis_uji);
			$objset->setCellValue("G".$baris, $row->nama);
			$objset->setCellValue("H".$baris, $row->hasil);
			$objset->setCellValue("I".$baris, $row->penguji);
			$objset->setCellValue("J".$baris, date("d M Y",strtotime($row->tgl_habis_uji)));

			$style = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_DASHED
					)
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':A'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$baris.':B'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$baris.':C'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$baris.':D'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$baris.':E'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$baris.':F'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$baris.':G'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('H'.$baris.':H'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('I'.$baris.':I'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('J'.$baris.':J'.$baris)->applyFromArray($style);
			
			$baris++;
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Pengujian');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = "Rekap Pengujian Tanggal ".date("d F Y",strtotime($awal)).".xlsx";
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	public function pengujian_bulanan(){
		$this->load->helper('date');
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_pengujian'=>'active',
			'aktif_pengujian_bulanan'=>'active',
			'title'=>'Laporan Pengujian Bulanan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_pengujian_bulanan');
		$this->load->view('pages/v_footer');
	}
	
	public function ajax_pengujian_bulanan(){
		$jns = $this->input->post('jenis_kendaraan');
		$stat = $this->input->post('status');
		$thaw = $this->input->post('tahun_awal');
		$thak = $this->input->post('tahun_akhir');
		$jbaw = $this->input->post('jbb_awal');
		$jbak = $this->input->post('jbb_akhir');
		$tgaw = $this->input->post('tgl_awal');
		$tgak = $this->input->post('tgl_akhir');
        $data=array(
            'dt_laporan'=>$this->laporan->getAjaxLaporanBulanan($jns,$stat,$thaw,$thak,$jbaw,$jbak,$tgaw,$tgak),
        );
        $this->load->view('laporan/v_ajax_pengujian_bulanan',$data);
	}
	
	public function retribusi(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_retribusi'=>'active',
			'aktif_retribusi_harian'=>'active',
			'title'=>'Laporan Retribusi Harian'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_retribusi');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_retribusi_tanggal(){
		$this->akses->akses_petugas();
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'laporan_retribusi'=>$this->laporan->getLapRetribusi($awal,$akhir),
			'total_retribusi'=>$this->laporan->getTotalRetribusi($awal,$akhir),
			//'dt_jenis_retribusi'=>$this->laporan->getLapJenisRetribusi($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('laporan/v_ajax_retribusi_harian',$data);
	}
	
	public function exportretribusi(){
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$retribusi = $this->laporan->getLapRetribusi($awal,$akhir);
		$total_retribusi = $this->laporan->getTotalRetribusi($awal,$akhir);
		//$pengesahan = $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'kabid'))->result();
		//$bendahara = $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'bendahara'))->result();
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("SIMPKB UNGARAN - SIM PKB") //creator
			->setTitle("Rekap Laporan Retribusi Tanggal ".$awal."-".$akhir." - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('Retribusi'); //sheet title
		//Warna header tabel
		$objget->getStyle("A4:J4")->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'ffffff')
					//'color' => array('rgb' => '00e4ff')
				),
				'font' => array(
					'color' => array('rgb' => '000000')
				)
			)
		);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'PEMERINTAH KABUPATEN WONOSOBO');
		$objPHPExcel->getActiveSheet()->mergeCells('G1:J1');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'DATA PENDAPATAN RETRIBUSI KENDARAAN');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'DINAS PERHUBUNGAN');
		$objPHPExcel->getActiveSheet()->mergeCells('G2:J2');
		$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Tanggal : '.strftime("%d %B %Y", strtotime($awal)).' - '.strftime("%d %B %Y", strtotime($akhir)));
		
		//table header
		$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M");
		 
		$val = array("NO","TGL UJI","NO UJI","NO KENDARAAN","JENIS UJI","JENIS KENDARAAN","JBB","JENIS RETRIBUSI","","","","","TOTAL RETRIBUSI");
		$val2 = array("","","","","","","","PLAT","BUKU","STIKER","DENDA","RETRIBUSI","");
				
		for ($a=0;$a<13; $a++) {
			$objset->setCellValue($cols[$a].'5', $val[$a]);
			$objset->setCellValue($cols[$a].'6', $val2[$a]);
			//Setting lebar cell
			$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
		 
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'font' => array(
					'bold' => 'true',
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'5')->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'6')->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'5')->getAlignment()->setWrapText(true);
		}
		
		$objPHPExcel->getActiveSheet()->mergeCells('A5:A6');
		$objPHPExcel->getActiveSheet()->mergeCells('B5:B6');
		$objPHPExcel->getActiveSheet()->mergeCells('C5:C6');
		$objPHPExcel->getActiveSheet()->mergeCells('D5:D6');
		$objPHPExcel->getActiveSheet()->mergeCells('E5:E6');
		$objPHPExcel->getActiveSheet()->mergeCells('F5:F6');
		$objPHPExcel->getActiveSheet()->mergeCells('G5:G6');
		$objPHPExcel->getActiveSheet()->mergeCells('H5:L5');
		$objPHPExcel->getActiveSheet()->mergeCells('M5:M6');
	
		$baris  = 7;
		$no=1;
		foreach($retribusi as $row){
			$col = array($no++,strftime("%d %B %Y", strtotime($row->tgl_pembayaran)),$row->no_uji,$row->no_kendaraan,$row->jenis_uji,$row->bentuk,$row->jbb,$row->plat,$row->buku,$row->stiker,$row->jml_denda,$row->retribusi,$row->total_semua);
			
			$style = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_DASHED
					)
				)
			);
			
			for($a=0;$a<13; $a++){
				$objset->setCellValue($cols[$a].$baris, $col[$a]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getStyle($cols[$a].$baris)->applyFromArray($style);
			}
			$baris++;
		}
		
		foreach ($total_retribusi as $row){
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':G'.$baris);
			$objset->setCellValue("A".$baris, "JUMLAH RETRIBUSI TOTAL");
			$objset->setCellValue("H".$baris, $row->total_plat);
			$objset->setCellValue("I".$baris, $row->total_buku);
			$objset->setCellValue("J".$baris, $row->total_stiker);
			$objset->setCellValue("K".$baris, $row->jml_total_denda);
			$objset->setCellValue("L".$baris, $row->jml_total_retribusi);
			$objset->setCellValue("M".$baris, $row->jml_total_semua);
			
			$objPHPExcel->getActiveSheet()->getStyle('H2:H'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('I2:I'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('J2:J'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('K2:K'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('L2:L'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('M2:M'.$baris)->getNumberFormat()->setFormatCode('0');
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'font' => array(
					'bold' => 'true',
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':G'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('H'.$baris.':H'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('I'.$baris.':I'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('J'.$baris.':J'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('K'.$baris.':K'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('L'.$baris.':L'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('M'.$baris.':M'.$baris)->applyFromArray($style);
		}
		
		/*
		foreach($pengesahan as $row){
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+2).':D'.($baris+2));
			$objset->setCellValue("B".($baris+2), "MENGETAHUI,");
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+3).':D'.($baris+3));
			$objset->setCellValue("B".($baris+3), "KEPALA BIDANG");
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+4).':D'.($baris+4));
			$objset->setCellValue("B".($baris+4), "ANGKUTAN DAN KESELAMATAN JALAN");
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+7).':D'.($baris+7));
			$objset->setCellValue("B".($baris+7), $row->nama);
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+8).':D'.($baris+8));
			$objset->setCellValue("B".($baris+8), "NIP. ".$row->nip);
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
			);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+2).':B'.($baris+2))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+3).':B'.($baris+3))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+4).':B'.($baris+4))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+7).':B'.($baris+7))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+8).':B'.($baris+8))->applyFromArray($style);
		}
		
		foreach($bendahara as $row){
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+2).':H'.($baris+2));
			$objset->setCellValue("F".($baris+2), "Mejayan, ".date("d F Y",strtotime($awal)));
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+3).':H'.($baris+3));
			$objset->setCellValue("F".($baris+3), "DINAS PERHUBUNGAN KAB. MADIUN");
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+4).':H'.($baris+4));
			$objset->setCellValue("F".($baris+4), "PEMBANTU BENDAHARA PENERIMA");
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+7).':H'.($baris+7));
			$objset->setCellValue("F".($baris+7), $row->nama);
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+8).':H'.($baris+8));
			$objset->setCellValue("F".($baris+8), "NIP. ".$row->nip);
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
			);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+2).':F'.($baris+2))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+3).':F'.($baris+3))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+4).':F'.($baris+4))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+7).':F'.($baris+7))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+8).':F'.($baris+8))->applyFromArray($style);
		}
		*/
		
		$objPHPExcel->getActiveSheet()->setTitle('Retribusi');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = "Rekap Retribusi Harian Tanggal ".strftime("%d %B %Y", strtotime($awal)).".xlsx";
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	public function retribusi_bulanan(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_retribusi'=>'active',
			'aktif_retribusi_bulanan'=>'active',
			'title'=>'Laporan Retribusi Bulanan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_retribusi_bulanan');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_retribusi_bulanan(){
		$this->akses->akses_petugas();
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'laporan_retribusi'=>$this->laporan->getLapRetribusiBulanan($awal,$akhir),
			'total_retribusi'=>$this->laporan->getTotalRetribusiBulanan($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('laporan/v_ajax_retribusi_bulanan',$data);
	}
	
	public function exportretribusibulanan(){
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$retribusi = $this->laporan->getLapRetribusiBulanan($awal,$akhir);
		$total_retribusi = $this->laporan->getTotalRetribusiBulanan($awal,$akhir);
		//$pengesahan = $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'kabid'))->result();
		//$bendahara = $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'bendahara'))->result();
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("SIMPKB UNGARAN - SIM PKB") //creator
			->setTitle("Rekap Laporan Retribusi Bulanan Tanggal ".$awal."-".$akhir." - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('Retribusi'); //sheet title
		//Warna header tabel
		$objget->getStyle("A4:J4")->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'ffffff')
					//'color' => array('rgb' => '00e4ff')
				),
				'font' => array(
					'color' => array('rgb' => '000000')
				)
			)
		);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAP BULANAN PENDAPATAN RETRIBUSI KENDARAAN');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Periode : '.date("F Y",strtotime($awal)).' - '.date("F Y",strtotime($akhir)));
		
		$objget->getStyle("A1:F2")->applyFromArray(
			array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'font' => array(
					'bold' => 'true',
				)
			)
		);
		
		//table header
		$cols = array("A","B","C","D","E","F");
		 
		$val = array("NO","TANGGAL PEMBAYARAN","JENIS RETRIBUSI","","","TOTAL RETRIBUSI");
		$val2 = array("","","BIAYA UJI","DENDA UJI","TANDA UJI","");
		 
		for ($a=0;$a<6; $a++) {
			$objset->setCellValue($cols[$a].'4', $val[$a]);
			$objset->setCellValue($cols[$a].'5', $val2[$a]);
			//Setting lebar cell
			$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
		 
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'font' => array(
					'bold' => 'true',
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'4')->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'5')->applyFromArray($style);
		}
		
		$objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
		$objPHPExcel->getActiveSheet()->mergeCells('B4:B5');
		$objPHPExcel->getActiveSheet()->mergeCells('C4:E4');
		$objPHPExcel->getActiveSheet()->mergeCells('F4:F5');
		
		$baris  = 6;
		$no=1;
		foreach($retribusi as $row){
			$col = array($no++,date("d F Y",strtotime($row->tgl_pembayaran)),$row->total_retribusi,$row->total_denda,$row->total_tanda,$row->total_retribusi+$row->total_tanda+$row->total_denda);
			
			$style = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_DASHED
					)
				)
			);
			
			for($a=0;$a<6; $a++){
				$objset->setCellValue($cols[$a].$baris, $col[$a]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getStyle($cols[$a].$baris)->applyFromArray($style);
			}
			$baris++;
		}
		
		foreach ($total_retribusi as $row){
			$jumlah_total = $row->total_retribusi+$row->total_tanda+$row->total_denda;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':B'.$baris);
			$objset->setCellValue("A".$baris, "JUMLAH NILAI RETRIBUSI TOTAL");
			$objset->setCellValue("C".$baris, $row->total_retribusi);
			$objset->setCellValue("D".$baris, $row->total_denda);
			$objset->setCellValue("E".$baris, $row->total_tanda);
			$objset->setCellValue("F".$baris, $jumlah_total);
			
			$objPHPExcel->getActiveSheet()->getStyle('C2:C'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('D2:D'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('E2:E'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('F2:F'.$baris)->getNumberFormat()->setFormatCode('0');
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'font' => array(
					'bold' => 'true',
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':B'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$baris.':C'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$baris.':D'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$baris.':E'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$baris.':F'.$baris)->applyFromArray($style);

		}
		
		/*
		foreach($pengesahan as $row){
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+2).':D'.($baris+2));
			$objset->setCellValue("B".($baris+2), "MENGETAHUI,");
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+3).':D'.($baris+3));
			$objset->setCellValue("B".($baris+3), "KEPALA BIDANG");
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+4).':D'.($baris+4));
			$objset->setCellValue("B".($baris+4), "ANGKUTAN DAN KESELAMATAN JALAN");
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+7).':D'.($baris+7));
			$objset->setCellValue("B".($baris+7), $row->nama);
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+8).':D'.($baris+8));
			$objset->setCellValue("B".($baris+8), "NIP. ".$row->nip);
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
			);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+2).':B'.($baris+2))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+3).':B'.($baris+3))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+4).':B'.($baris+4))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+7).':B'.($baris+7))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+8).':B'.($baris+8))->applyFromArray($style);
		}
		
		foreach($bendahara as $row){
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+2).':H'.($baris+2));
			$objset->setCellValue("F".($baris+2), "Mejayan, ".date("d F Y",strtotime($awal)));
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+3).':H'.($baris+3));
			$objset->setCellValue("F".($baris+3), "DINAS PERHUBUNGAN KAB. MADIUN");
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+4).':H'.($baris+4));
			$objset->setCellValue("F".($baris+4), "PEMBANTU BENDAHARA PENERIMA");
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+7).':H'.($baris+7));
			$objset->setCellValue("F".($baris+7), $row->nama);
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+8).':H'.($baris+8));
			$objset->setCellValue("F".($baris+8), "NIP. ".$row->nip);
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
			);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+2).':F'.($baris+2))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+3).':F'.($baris+3))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+4).':F'.($baris+4))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+7).':F'.($baris+7))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+8).':F'.($baris+8))->applyFromArray($style);
		}
		*/
		
		$objPHPExcel->getActiveSheet()->setTitle('Retribusi');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = "Rekap Retribusi Bulanan ".date("F Y",strtotime($awal)).".xlsx";
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	public function retribusi_tahunan(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_retribusi'=>'active',
			'aktif_retribusi_tahunan'=>'active',
			'title'=>'Laporan Retribusi Tahunan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_retribusi_tahunan');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_retribusi_tahunan(){
		$this->akses->akses_petugas();
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'laporan_retribusi'=>$this->laporan->getLapRetribusiTahunan($awal,$akhir),
			'total_tahunan'=>$this->laporan->getTotalRetribusiTahunan($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('laporan/v_ajax_retribusi_tahunan',$data);
	}
	
	public function exportretribusitahunan(){
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$retribusi = $this->laporan->getLapRetribusiTahunan($awal,$akhir);
		$total_retribusi = $this->laporan->getTotalRetribusiTahunan($awal,$akhir);
		//$pengesahan = $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'kabid'))->result();
		//$bendahara = $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'bendahara'))->result();
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("SIMPKB UNGARAN - SIM PKB") //creator
			->setTitle("Rekap Laporan Retribusi Tahunan ".$awal."-".$akhir." - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('Retribusi'); //sheet title
		
		$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAP TAHUNAN PENDAPATAN RETRIBUSI KENDARAAN');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Periode : '.date("F Y",strtotime($awal)).' - '.date("F Y",strtotime($akhir)));
		
		$objget->getStyle("A1:F2")->applyFromArray(
			array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'font' => array(
					'bold' => 'true',
				)
			)
		);
		
		//table header
		$cols = array("A","B","C","D","E","F");
		 
		$val = array("NO","TANGGAL PEMBAYARAN","JENIS RETRIBUSI","","","TOTAL RETRIBUSI");
		$val2 = array("","","BIAYA UJI","DENDA UJI","TANDA UJI","");
		 
		for ($a=0;$a<6; $a++) {
			$objset->setCellValue($cols[$a].'4', $val[$a]);
			$objset->setCellValue($cols[$a].'5', $val2[$a]);
			//Setting lebar cell
			$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
		 
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'font' => array(
					'bold' => 'true',
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'4')->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'5')->applyFromArray($style);
		}
		
		$objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
		$objPHPExcel->getActiveSheet()->mergeCells('B4:B5');
		$objPHPExcel->getActiveSheet()->mergeCells('C4:E4');
		$objPHPExcel->getActiveSheet()->mergeCells('F4:F5');
		
		$baris  = 6;
		$no=1;
		foreach($retribusi as $row){
			$col = array($no++,date("F Y",strtotime($row->tgl_pembayaran)),$row->total_retribusi,$row->total_denda,$row->total_tanda,$row->total_retribusi+$row->total_tanda+$row->total_denda);
			
			$style = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_DASHED
					)
				)
			);
			
			for($a=0;$a<6; $a++){
				$objset->setCellValue($cols[$a].$baris, $col[$a]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getStyle($cols[$a].$baris)->applyFromArray($style);
			}
			$baris++;
		}
		
		foreach ($total_retribusi as $row){
			$jumlah_total = $row->total_retribusi+$row->total_tanda+$row->total_denda;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':B'.$baris);
			$objset->setCellValue("A".$baris, "JUMLAH NILAI RETRIBUSI TOTAL");
			$objset->setCellValue("C".$baris, $row->total_retribusi);
			$objset->setCellValue("D".$baris, $row->total_denda);
			$objset->setCellValue("E".$baris, $row->total_tanda);
			$objset->setCellValue("F".$baris, $jumlah_total);
			
			$objPHPExcel->getActiveSheet()->getStyle('C2:C'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('D2:D'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('E2:E'.$baris)->getNumberFormat()->setFormatCode('0');
			$objPHPExcel->getActiveSheet()->getStyle('F2:F'.$baris)->getNumberFormat()->setFormatCode('0');
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'font' => array(
					'bold' => 'true',
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':B'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$baris.':C'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$baris.':D'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$baris.':E'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$baris.':F'.$baris)->applyFromArray($style);

		}
		
		/*
		foreach($pengesahan as $row){
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+2).':D'.($baris+2));
			$objset->setCellValue("B".($baris+2), "MENGETAHUI,");
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+3).':D'.($baris+3));
			$objset->setCellValue("B".($baris+3), "KEPALA BIDANG");
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+4).':D'.($baris+4));
			$objset->setCellValue("B".($baris+4), "ANGKUTAN DAN KESELAMATAN JALAN");
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+7).':D'.($baris+7));
			$objset->setCellValue("B".($baris+7), $row->nama);
			$objPHPExcel->getActiveSheet()->mergeCells('B'.($baris+8).':D'.($baris+8));
			$objset->setCellValue("B".($baris+8), "NIP. ".$row->nip);
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
			);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+2).':B'.($baris+2))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+3).':B'.($baris+3))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+4).':B'.($baris+4))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+7).':B'.($baris+7))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('B'.($baris+8).':B'.($baris+8))->applyFromArray($style);
		}
		
		foreach($bendahara as $row){
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+2).':H'.($baris+2));
			$objset->setCellValue("F".($baris+2), "Mejayan, ".date("d F Y",strtotime($awal)));
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+3).':H'.($baris+3));
			$objset->setCellValue("F".($baris+3), "DINAS PERHUBUNGAN KAB. MADIUN");
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+4).':H'.($baris+4));
			$objset->setCellValue("F".($baris+4), "PEMBANTU BENDAHARA PENERIMA");
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+7).':H'.($baris+7));
			$objset->setCellValue("F".($baris+7), $row->nama);
			$objPHPExcel->getActiveSheet()->mergeCells('F'.($baris+8).':H'.($baris+8));
			$objset->setCellValue("F".($baris+8), "NIP. ".$row->nip);
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
			);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+2).':F'.($baris+2))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+3).':F'.($baris+3))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+4).':F'.($baris+4))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+7).':F'.($baris+7))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('F'.($baris+8).':F'.($baris+8))->applyFromArray($style);
		}
		*/
		
		$objPHPExcel->getActiveSheet()->setTitle('Retribusi');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = "Rekap Retribusi Tahunan ".date("Y",strtotime($awal)).".xlsx";
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	public function retribusi_jeniskendaraan(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_retribusi'=>'active',
			'aktif_retribusi_jeniskendaraan'=>'active',
			'title'=>'Laporan Retribusi Jenis Kendaraan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_retribusi_jeniskendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_retribusi_jeniskendaraan(){
		$this->akses->akses_petugas();
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'laporan_retribusi'=>$this->laporan->getLapRetribusiBulanan($awal,$akhir),
			'total_retribusi'=>$this->laporan->getTotalRetribusiBulanan($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('laporan/v_ajax_retribusi_jeniskendaraan',$data);
	}
	
	public function cetakretribusijeniskendaraan(){
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$data=array(
			'laporan_retribusi'=>$this->laporan->getLapRetribusiBulanan($awal,$akhir),
			'total_retribusi'=>$this->laporan->getTotalRetribusiBulanan($awal,$akhir),
			'pengesahan'=>$this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'kasie'))->result(),
			'bendaharan'=>$this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'bendahara'))->result(),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('cetak/v_cetak_retribusi_jeniskendaraan',$data);
	}
	
	// KENDARAAN
	
	public function kendaraan_jenis_wilayah(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_kendaraan'=>'active',
			'aktif_laporan_kendaraan_jenis_wilayah'=>'active',
			'title'=>'Rekap kendaraan berdasarkan jenis kendaraan dan wilayah',
			'kendaraan'=>$this->laporan->getJenisKendaraan(),
			'wilayah'=>$this->laporan->getWilayahKendaraan(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_rekap_kendaraan_jenis_wilayah');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_kendaraan_jenis_wilayah(){
		$this->akses->akses_petugas();
		$kendaraan = $this->input->post('jenis_kendaraan');
		$kecamatan = $this->input->post('wilayah_kendaraan');
		$sorting = $this->input->post('sorting');
		if(($sorting=="") || ($sorting=="no_uji")){
			$sort = "a.no_uji";
		} else {
			$sort = $sorting;
		}
		$jenis = join("','",$kendaraan);
		$wilayah = join("','",$kecamatan);
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_kendaraan'=>'active',
			'aktif_laporan_kendaraan_jenis_wilayah'=>'active',
			'title'=>'Rekap kendaraan berdasarkan jenis kendaraan dan wilayah',
			'kendaraan'=>$this->laporan->getJenisKendaraan(),
			'wilayah'=>$this->laporan->getWilayahKendaraan(),
			'rekap_kendaraan'=>$this->laporan->getRekapKendaraanJenisWilayah($jenis,$wilayah,$sort),
			'jenis_kendaraan'=> $jenis,
			'wilayah_kendaraan'=> $wilayah,
			'sorting'=> $sort,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_rekap_kendaraan_jenis_wilayah_hasil');
		$this->load->view('pages/v_footer');
	}
	
	public function export_kendaraan_jenis_wilayah(){
		$kendaraan = $this->input->post('jenis_kendaraan');
		$kecamatan = $this->input->post('wilayah_kendaraan');
		$sorting = $this->input->post('sorting');
		$jenis = join("','",$kendaraan);
		$wilayah = join("','",$kecamatan);
		if(($sorting=="") || ($sorting=="no_uji")){
			$sort = "a.no_uji";
		} else {
			$sort = $sorting;
		}
		$rekap = $this->laporan->getRekapKendaraanJenisWilayah($jenis,$wilayah,$sort);
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("GHANI - SIM PKB") //creator
			->setTitle("Laporan Kendaraan Berdasarkan Jenis Wilayah - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('Rekap Kendaraan'); //sheet title
		//Warna header tabel
		$objget->getStyle("A1:I1")->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => '00e4ff')
				),
				'font' => array(
					'color' => array('rgb' => '000000')
				)
			)
		);
		
		//table header
		$cols = array("A","B","C","D","E","F","G","H","I");
		 
		$val = array("No","No Uji","No Kendaraan","Jenis Kendaraan","Merk/Tipe","Masa Berlaku","Nama Pemilik","Alamat","Wilayah");
		 
		for ($a=0;$a<9; $a++) {
			$objset->setCellValue($cols[$a].'1', $val[$a]);
		 
			//Setting lebar cell
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		 
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
		}
		
		$baris  = 2;
		$no=1;
		foreach($rekap as $row){
			$objset->setCellValue("A".$baris, $no++);
			$objset->setCellValue("B".$baris, $row->no_uji);
			$objset->setCellValue("C".$baris, $row->no_kendaraan);
			$objset->setCellValue("D".$baris, $row->jenis);
			$objset->setCellValue("E".$baris, $row->merek ."/". $row->tipe);
			$objset->setCellValue("F".$baris, date("d M Y",strtotime($row->tgl_habis_uji)));
			$objset->setCellValue("G".$baris, $row->nama);
			$objset->setCellValue("H".$baris, $row->alamat);
			$objset->setCellValue("I".$baris, $row->kecamatan);

			$baris++;
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Kendaraan Jenis Wilayah');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = urlencode("Rekap Kendaraan Jenis dan Wilayah".date("Y-m-d H:i:s").".xlsx");
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	public function kendaraan_jenis_umur(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_kendaraan'=>'active',
			'aktif_laporan_kendaraan_jenis_umur'=>'active',
			'title'=>'Rekap kendaraan berdasarkan jenis kendaraan dan umur kendaraan',
			'kendaraan'=>$this->laporan->getJenisKendaraan(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_rekap_kendaraan_jenis_umur');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_kendaraan_jenis_umur(){
		$this->akses->akses_petugas();
		$kendaraan = $this->input->post('jenis_kendaraan');
		$umur = $this->input->post('umur');
		$operasi = $this->input->post('operasi');
		$jenis = join("','",$kendaraan);
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_kendaraan'=>'active',
			'aktif_laporan_kendaraan_jenis_umur'=>'active',
			'title'=>'Rekap kendaraan berdasarkan jenis kendaraan dan umur kendaraan',
			'kendaraan'=>$this->laporan->getJenisKendaraan(),
			'rekap_kendaraan'=>$this->laporan->getRekapKendaraanJenisUmur($jenis,$operasi,$umur),
			'jenis_kendaraan'=> $jenis,
			'umur_kendaraan'=> $umur,
			'operasi_kendaraan'=> $operasi,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_rekap_kendaraan_jenis_umur_hasil');
		$this->load->view('pages/v_footer');
	}
	
	public function export_kendaraan_jenis_umur(){
		$kendaraan = $this->input->post('jenis_kendaraan');
		$kecamatan = $this->input->post('wilayah_kendaraan');
		$sorting = $this->input->post('sorting');
		$jenis = join("','",$kendaraan);
		$wilayah = join("','",$kecamatan);
		if(($sorting=="") || ($sorting=="no_uji")){
			$sort = "a.no_uji";
		} else {
			$sort = $sorting;
		}
		$rekap = $this->laporan->getRekapKendaraanJenisWilayah($jenis,$wilayah,$sort);
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("GHANI - SIM PKB") //creator
			->setTitle("Laporan Kendaraan Berdasarkan Jenis Wilayah - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('Rekap Kendaraan'); //sheet title
		//Warna header tabel
		$objget->getStyle("A1:I1")->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => '00e4ff')
				),
				'font' => array(
					'color' => array('rgb' => '000000')
				)
			)
		);
		
		//table header
		$cols = array("A","B","C","D","E","F","G","H","I");
		 
		$val = array("No","No Uji","No Kendaraan","Jenis Kendaraan","Merk/Tipe","Masa Berlaku","Nama Pemilik","Alamat","Wilayah");
		 
		for ($a=0;$a<9; $a++) {
			$objset->setCellValue($cols[$a].'1', $val[$a]);
		 
			//Setting lebar cell
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		 
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
		}
		
		$baris  = 2;
		$no=1;
		foreach($rekap as $row){
			$objset->setCellValue("A".$baris, $no++);
			$objset->setCellValue("B".$baris, $row->no_uji);
			$objset->setCellValue("C".$baris, $row->no_kendaraan);
			$objset->setCellValue("D".$baris, $row->jenis);
			$objset->setCellValue("E".$baris, $row->merek ."/". $row->tipe);
			$objset->setCellValue("F".$baris, date("d M Y",strtotime($row->tgl_habis_uji)));
			$objset->setCellValue("G".$baris, $row->nama);
			$objset->setCellValue("H".$baris, $row->alamat);
			$objset->setCellValue("I".$baris, $row->kecamatan);

			$baris++;
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Kendaraan Jenis Wilayah');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = urlencode("Rekap Kendaraan Jenis dan Wilayah".date("Y-m-d H:i:s").".xlsx");
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	public function kendaraan_no_kendaraan(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_kendaraan'=>'active',
			'aktif_laporan_kendaraan_no_kendaraan'=>'active',
			'title'=>'Rekap kendaraan berdasarkan no kendaraan / no uji',
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_rekap_kendaraan_no_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_kendaraan_no_kendaraan(){
		$this->akses->akses_petugas();
		$jenis = $this->input->post('jenis');
		$depan = $this->input->post('no_depan');
		$belakang = $this->input->post('no_belakang');
		$awal = $this->input->post('no_awal');
		$akhir = $this->input->post('no_akhir');
		$no_ken_awal = $depan."-".$awal."-".$belakang;
		$no_ken_akhir = $depan."-".$akhir."-".$belakang;
		$data=array(
			'aktif_laporan'=>'active',
			'aktif_laporan_kendaraan'=>'active',
			'aktif_laporan_kendaraan_no_kendaraan'=>'active',
			'title'=>'Rekap kendaraan berdasarkan no kendaraan / no uji',
			'rekap_kendaraan'=>$this->laporan->getRekapKendaraanNoKendaraan($jenis,$depan,$belakang,$no_ken_awal,$no_ken_akhir),
			'no_ken_awal'=> $no_ken_awal,
			'no_ken_akhir'=> $no_ken_akhir,
			//'operasi_kendaraan'=> $operasi,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_rekap_kendaraan_no_kendaraan_hasil');
		$this->load->view('pages/v_footer');
	}
	
	public function sts(){
		$this->akses->akses_petugas();
		$this->load->library('pagination');
		$this->load->helper('date');
		
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		$num = $this->laporan->getJmlSTS();
		
		$config=array(
			'base_url'=>base_url().'laporan/sts',
			'total_rows'=>$num,
			'per_page'=>20,
			'full_tag_open'=> "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>",
			'full_tag_close'=> "</ul>",
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => "<li class='disabled'><li class='active'><a href='#'>",
			'cur_tag_close' => "<span class='sr-only'></span></a></li>",
			'next_tag_open' => "<li>",
			'next_tagl_close' => "</li>",
			'prev_tag_open' => "<li>",
			'prev_tagl_close' => "</li>",
			'first_tag_open' => "<li>",
			'first_tagl_close' => "</li>",
			'last_tag_open' => "<li>",
			'last_tagl_close' => "</li>"
		);
		
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_sts'=>'active',
			'title'=>'Surat Tanda Setoran',
			'data_sts'=>$this->laporan->getDataSTS($config['per_page'],$dari),
			'start'=>$dari,
		);
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_sts');
		$this->load->view('pages/v_footer');
	}
	
	public function tambah_sts(){
		$this->akses->akses_petugas();
		$this->load->helper('date');
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'title'=>'Surat Tanda Setoran',
			'aktif_sts'=>'active',
			'no_sts'=>$this->laporan->getKodeSTS(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_sts_tambah');
		$this->load->view('pages/v_footer');
	}
	
	public function get_jumlah_sts(){
		$tgl = $this->input->get('tgl', TRUE);
		$data = $this->laporan->getTotalSts($tgl);
		echo json_encode($data);
	}
	
	public function get_total_sts(){
		$awal = $this->input->get('tgl', TRUE);
		$akhir = $this->input->get('tgl', TRUE);
		$data = $this->laporan->getTotalRetribusi($awal,$akhir);
		echo json_encode($data);
	}
	
	public function ajax_tambah_sts(){
        $tgl = $this->input->get('tgl', TRUE);
		$data=array(
			'tgl'=>$tgl,
			'dt_jbbkereta'=>$this->laporan->getStsKereta($tgl),
			'dt_jbbnumpang'=>$this->laporan->getStsNumpang($tgl),
		); 
        $this->load->view('laporan/v_ajax_tambah_sts',$data);
	}
	
	public function proses_tambah_sts(){
		$this->akses->akses_petugas();
		$data = array(
			'no_sts'=>$this->input->post('no_sts'),
			'tgl_sts'=>$this->input->post('tgl_sts'),
			'jbb0'=>$this->input->post('jbb0'),
			'jbb1'=>$this->input->post('jbb1'),
			'jbb2'=>$this->input->post('jbb2'),
			'jbb3'=>$this->input->post('jbb3'),
			'jbb4'=>$this->input->post('jbb4'),
			'nuk'=>$this->input->post('nuk'),
			'retribusi'=>$this->input->post('retribusi'),
			'tanda'=>$this->input->post('tanda'),
			'denda'=>$this->input->post('denda'),
			'total'=>$this->input->post('total'),
			'terbilang'=>$this->input->post('terbilang'),
		);
		$this->model_app->insertData('tbl_sts',$data);
		redirect('laporan/sts');
	}
	
	public function sts_cetak(){
		$id = $this->input->get('id', TRUE);
		$no = $this->input->get('no', TRUE);
		$idx['id_sts'] = $this->input->get('id', TRUE);
		$data=array(
			'title'=>"STS_".$no."_".date("dmy").".pdf",
			'dt_sts'=>$this->model_app->getSelectedData('tbl_sts',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_sts',$data);
	}
	
	public function sts_laporan(){
		$id = $this->uri->segment(3);
		$idx['id_sts'] = $this->uri->segment(3);
		$data=array(
			'title'=>$id."_laporan.pdf",
			'dt_sts'=>$this->model_app->getSelectedData('tbl_sts',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_sts_laporan',$data);
	}
	
	public function get_no_sts(){
		$id = $this->input->post('bidang');
		$data = $this->model_app->getKodeSTS($id);
		echo json_encode($data);
	}
	
	public function sts_hapus(){
		$id['id_sts'] = $this->uri->segment(3);
		$sts = $this->model_app->getSelectedData('tbl_sts',$id)->result();
        $this->model_app->deleteData('tbl_sts',$id);
        redirect('laporan/sts');
	}
	
	public function sts_bulanan(){
		$data=array(
			'aktif_laporan'=>'active',
			'title'=>'Surat Tanda Setoran Bulanan',
			'aktif_sts'=>'active',
			'aktif_sts_bulanan'=>'active',
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_sts_bulanan');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_sts_bulanan(){
		$this->akses->akses_petugas();
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'laporan_retribusi'=>$this->laporan->getLapRetribusiBulanan($awal,$akhir),
			'total_retribusi'=>$this->laporan->getTotalRetribusiBulanan($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('laporan/v_ajax_sts_bulanan',$data);
	}
	
	public function cetakstsbulanan(){
		$id = $this->uri->segment(3);
		$jenis = $this->input->get('jns', TRUE);
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$total = $this->laporan->getTotalRetribusiBulanan($awal,$akhir);
		foreach($total as $row){
			if($jenis=='retribusi'){
				$total_retribusi = $row->total_retribusi+$row->total_retribusi_terhutang+$row->total_tanda;
				$terbilang = $this->terbilang($total_retribusi);
			} else {
				$total_retribusi = $row->total_denda;
				$terbilang = $this->terbilang($total_retribusi);
			}
		}
		$data=array(
			'title'=>'laporan_sts_bulan_'.date("F-Y",strtotime($awal)).'.pdf',
			'total_retribusi'=>$total_retribusi,
			'terbilang'=>$terbilang,
			'tgl_akhir' => $akhir,
			'dt_sts'=>$this->laporan->getLapRetribusiBulanan($awal,$akhir),
		);
		if($jenis=='retribusi'){
			$this->load->view('cetak/v_cetak_sts_bulanan',$data);
		} else {
			$this->load->view('cetak/v_cetak_sts_bulanan_denda',$data);
		}
	}
	
	public function sts_tahunan(){
		$data=array(
			'aktif_laporan'=>'active',
			'title'=>'Surat Tanda Setoran Tahunan',
			'aktif_sts'=>'active',
			'aktif_sts_tahunan'=>'active',
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_sts_tahunan');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_sts_tahunan(){
		$this->akses->akses_petugas();
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'laporan_retribusi'=>$this->laporan->getLapRetribusiTahunan($awal,$akhir),
			'total_retribusi'=>$this->laporan->getTotalRetribusiTahunan($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('laporan/v_ajax_sts_tahunan',$data);
	}
	
	public function cetakststahunan(){
		$id = $this->uri->segment(3);
		$jenis = $this->input->get('jns', TRUE);
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$total = $this->laporan->getTotalRetribusiTahunan($awal,$akhir);
		foreach($total as $row){
			if($jenis=='retribusi'){
				$total_retribusi = $row->total_retribusi+$row->total_retribusi_terhutang+$row->total_tanda;
				$terbilang = $this->terbilang($total_retribusi);
			} else {
				$total_retribusi = $row->total_denda;
				$terbilang = $this->terbilang($total_retribusi);
			}
		}
		$data=array(
			'title'=>'laporan_sts_tahun_'.date("Y",strtotime($awal)).'.pdf',
			'total_retribusi'=>$total_retribusi,
			'terbilang'=>$terbilang,
			'tgl_akhir' => $akhir,
			'dt_sts'=>$this->laporan->getLapRetribusiTahunan($awal,$akhir),
		);
		if($jenis=='retribusi'){
			$this->load->view('cetak/v_cetak_sts_tahunan',$data);
		} else {
			$this->load->view('cetak/v_cetak_sts_tahunan_denda',$data);
		}
	}
	
	//SURAT-SURAT
	public function suratkeluar(){
		$this->akses->akses_petugas();
		$data=array(
			'aktif_laporan'=>'active',
			'open_laporan'=>'open',
			'aktif_laporan_surat'=>'active',
			'aktif_laporan_surat_keluar'=>'active',
			'title'=>'Laporan Surat Uji Keluar Kendaraan'
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('laporan/v_laporan_suratkeluar');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_suratkeluar(){
		$this->akses->akses_petugas();
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$jenis = $this->input->get('rekap', TRUE);
		$data=array(
			'awal'=> $awal,
			'akhir' => $akhir,
			'jenis'=>$jenis,
			'dtrekap'=>$this->laporan->getRekapSuratKeluar($jenis,$awal,$akhir),
			'pengesahan' => $this->laporan->getSelectedData('tbl_pejabat',array('jabatan'=>'kadis'))->result(),
		);
		$this->load->view('laporan/v_ajax_surat_numpang',$data);
	}
	
	public function exportsurat(){
		$awal = $this->input->get('awal', TRUE);
		$akhir = $this->input->get('akhir', TRUE);
		$jenis = $this->input->get('rekap', TRUE);
		$dtrekap = $this->laporan->getRekapSuratKeluar($jenis,$awal,$akhir);
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("SINGKEREN - SIM PKB") //creator
			->setTitle("Rekap Laporan Surat ".$awal."-".$akhir." - SIM PKB.");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('Laporan Surat'); //sheet title
		//Warna header tabel
		$objget->getStyle("A4:I4")->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'ffffff')
				),
				'font' => array(
					'color' => array('rgb' => '000000')
				)
			)
		);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'PEMERINTAH KABUPATEN TEGAL');
		$objPHPExcel->getActiveSheet()->mergeCells('E1:I1');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'REKAP KENDARAAN UJI KELUAR');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:D2');
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'DINAS PERHUBUNGAN');
		$objPHPExcel->getActiveSheet()->mergeCells('E2:I2');
		$objPHPExcel->getActiveSheet()->setCellValue('E2', 'Tanggal : '.strftime("%d %b %Y", strtotime($awal)).' - '.strftime("%d %b %Y", strtotime($akhir)));
		
		//table header
		$cols = array("A","B","C","D","E","F","G","H","I");
		 
		$val = array("NO","TGL SURAT","NO UJI","NO KENDARAAN","NAMA","JENIS KENDARAAN","NO SURAT","TUJUAN","KOTA");
				
		for ($a=0;$a<9; $a++) {
			$objset->setCellValue($cols[$a].'5', $val[$a]);
			//Setting lebar cell
			$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
		 
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'font' => array(
					'bold' => 'true',
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'5')->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'5')->getAlignment()->setWrapText(true);
		}
	
		$baris  = 6;
		$no=1;
		foreach($dtrekap as $row){
			$col = array($no++,strftime("%d %b %Y", strtotime($row->tgl_surat)),$row->no_uji,$row->no_kendaraan,$row->nama,$row->bentuk,$row->no_surat,$row->kota_dinas,$row->kota_tujuan);
			
			$style = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_DASHED
					)
				)
			);
			
			for($a=0;$a<9; $a++){
				$objset->setCellValue($cols[$a].$baris, $col[$a]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getStyle($cols[$a].$baris)->applyFromArray($style);
			}
			$baris++;
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Laporan Surat');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = "Rekap Surat Keluar Tanggal ".date("d F Y",strtotime($awal))."-".date("d F Y",strtotime($akhir)).".xlsx";
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	private function kekata($x) {
		$x = abs($x);
		$angka = array("", "Satu", "Dua", "Tiga", "Empat", "Lima",
		"Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($x <12) {
			$temp = " ". $angka[$x];
		} else if ($x <20) {
			$temp = $this->kekata($x - 10). " Belas";
		} else if ($x <100) {
			$temp = $this->kekata($x/10)." Puluh". $this->kekata($x % 10);
		} else if ($x <200) {
			$temp = " Seratus" . $this->kekata($x - 100);
		} else if ($x <1000) {
			$temp = $this->kekata($x/100) . " Ratus" . $this->kekata($x % 100);
		} else if ($x <2000) {
			$temp = " Seribu" . $this->kekata($x - 1000);
		} else if ($x <1000000) {
			$temp = $this->kekata($x/1000) . " Ribu" . $this->kekata($x % 1000);
		} else if ($x <1000000000) {
			$temp = $this->kekata($x/1000000) . " Juta" . $this->kekata($x % 1000000);
		} else if ($x <1000000000000) {
			$temp = $this->kekata($x/1000000000) . " Milyar" . $this->kekata(fmod($x,1000000000));
		} else if ($x <1000000000000000) {
			$temp = $this->kekata($x/1000000000000) . " Trilyun" . $this->kekata(fmod($x,1000000000000));
		}      
			return $temp;
	}
	
	private function terbilang($x, $style=4) {
		if($x<0) {
			$hasil = "minus ". trim($this->kekata($x));
		} else {
			$hasil = trim($this->kekata($x));
		}      
		switch ($style) {
			case 1:
				$hasil = strtoupper($hasil);
				break;
			case 2:
				$hasil = strtolower($hasil);
				break;
			case 3:
				$hasil = ucwords($hasil);
				break;
			default:
				$hasil = ucfirst($hasil);
				break;
		}      
		return $hasil;
	}
}