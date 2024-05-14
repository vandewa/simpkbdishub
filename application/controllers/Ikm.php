<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ikm extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_ikm','ikm');
		$this->load->model('akses');
		$this->load->library('pagination');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}

	public function rekap(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->ikm->getJmlIkm();
		$config=array(
			'base_url'=>base_url().$this->router->fetch_class().'/'.$this->router->fetch_method(),
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
			'title'=>'Rekap IKM',
			'aktif_ikm'=>'active',
			'open_ikm'=>'open',
			'aktif_rekap_ikm'=>'active',
			'start'=>$dari,
			'dt_ikm'=>$this->ikm->getRekapIkm($config['per_page'],$dari)
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('ikm/v_rekap_ikm');
		$this->load->view('pages/v_footer');
	}
	
	public function export_rekap(){
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$dtikm = $this->ikm->getExportIkm($awal,$akhir);
		$pengesahan = $this->ikm->getAllData('tbl_setting');
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()
			->setCreator("ADMIN - SIMPKB") //creator
			->setTitle("REKAP SURVEI IKM");  //file title

		$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
		$objget = $objPHPExcel->getActiveSheet();  //inisiasi get object

		$objget->setTitle('REKAP SURVEI IKM'); //sheet title
		
		$objget->getStyle("A1:K1")->applyFromArray(
			array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'ffffff')
				),
				'font' => array(
					'color' => array('rgb' => '000000'),
					'bold' => 'true',
					'underline' => 'true',
				)
			)
		);
		
		$objget->getStyle("A1:N2")->applyFromArray(
			array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'ffffff')
				),
				'font' => array(
					'color' => array('rgb' => '000000'),
					'bold' => 'true',
				)
			)
		);
		$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAP SURVEI IKM');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:N2');
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Tanggal : '.strftime("%d %B %Y",strtotime($awal)).' - '.strftime("%d %B %Y",strtotime($akhir)));
		
		//Warna header tabel
		$objget->getStyle("A4:N5")->applyFromArray(
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
		$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N");
		 
		$val = array("NO","TANGGAL","USIA","JENIS KELAMIN","PENDIDIKAN","PEKERJAAN","NILAI SURVEI IKM","","","","","","","SARAN");
		$val2 = array("","","","","","","KESESUAIAN","KEMUDAHAN","KECEPATAN","SISTEM","KOMPETENSI","KESOPANAN","SARANA","");
		
		for($a=0;$a<14; $a++) {
			$objset->setCellValue($cols[$a].'4', $val[$a]);
			$objset->setCellValue($cols[$a].'5', $val2[$a]);
			$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
		}
		$objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
		$objPHPExcel->getActiveSheet()->mergeCells('B4:B5');
		$objPHPExcel->getActiveSheet()->mergeCells('C4:C5');
		$objPHPExcel->getActiveSheet()->mergeCells('D4:D5');
		$objPHPExcel->getActiveSheet()->mergeCells('E4:E5');
		$objPHPExcel->getActiveSheet()->mergeCells('F4:F5');
		$objPHPExcel->getActiveSheet()->mergeCells('G4:M4');
		$objPHPExcel->getActiveSheet()->mergeCells('N4:N5');
		
		$baris  = 6;
		$no=1;
		foreach($dtikm as $row){
			$col = array($no++,strftime("%d %B %Y",strtotime($row->tgl_ikm)),$row->usia,$row->jenis_kelamin,$row->pendidikan,$row->pekerjaan,$row->kesesuaian,$row->kemudahan,$row->kecepatan,$row->sistem,$row->kompetensi,$row->kesopanan,$row->sarana,$row->saran);
			
			$style = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_DASHED
					)
				)
			);
			
			for($a=0;$a<14; $a++){
				$objset->setCellValue($cols[$a].$baris, $col[$a]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($cols[$a])->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getStyle($cols[$a].$baris)->applyFromArray($style);
			}
			$baris++;
		}
		
		/*
		foreach ($total_rekap as $row){
			$objset->setCellValue("H".$baris, "JUMLAH");
			$objset->setCellValue("I".$baris, $row->plat);
			$objset->setCellValue("J".$baris, $row->buku);
			$objset->setCellValue("K".$baris, $row->stiker);
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_DASHED
					)
				),
			);
			$objPHPExcel->getActiveSheet()->getStyle('H'.$baris.':H'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('I'.$baris.':I'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('J'.$baris.':J'.$baris)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('K'.$baris.':K'.$baris)->applyFromArray($style);
		}
		
		foreach($pengesahan as $row){
			$objset->setCellValue("H".($baris+2), "Slawi, ".date("d F Y",strtotime($id)));
			$objset->setCellValue("H".($baris+3), "Kepala Seksi Pengujian Kendaraan Bermotor");
			$objset->setCellValue("H".($baris+7), $row->kepala_uptd);
			$objset->setCellValue("H".($baris+8), $row->nip);
			
			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
			);
			$objPHPExcel->getActiveSheet()->getStyle('H'.($baris+2).':H'.($baris+2))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('H'.($baris+3).':H'.($baris+3))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('H'.($baris+7).':H'.($baris+7))->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle('H'.($baris+8).':H'.($baris+8))->applyFromArray($style);
		}
		*/	
		
		$objPHPExcel->getActiveSheet()->setTitle('REKAP IKM');

		$objPHPExcel->setActiveSheetIndex(0);  
		$filename = "REKAP IKM TANGGAL ".strftime("%d %B %Y",strtotime($awal)).' - '.strftime("%d %B %Y",strtotime($akhir)).".xlsx";
		   
		  header('Content-Type: application/vnd.ms-excel'); //mime type
		  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		  header('Cache-Control: max-age=0'); //no cache

		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');                
		$objWriter->save('php://output');
	}
	
	private function aktifitas_tambah($no_uji,$plat,$buku,$stiker){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Membuat data '.$this->router->fetch_class().' '.$no_uji .', Plat : '.$plat.', Buku '.$buku.' Stiker '.$stiker,
			'modul'=>$this->router->fetch_method()
		);
		$this->model_app->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	public function stok(){
		$this->akses->akses_admin();
		$data=array(
			'title'=>'Stok ikm',
			'aktif_ikm'=>'active',
			'open_ikm'=>'open',
			'stok_ikm'=>'active',
			'data_stok_ikm'=>$this->model_app->getAllData('tbl_ikm'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('ikm/v_stok_ikm');
		$this->load->view('pages/v_footer');
	}
	
	public function pengadaan(){
		$this->akses->akses_admin();
		$this->load->library('pagination');
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->model_app->getJmlPengadaan();
		$config=array(
			'base_url'=>base_url().'ikm/pengadaan',
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
			'title'=>'Pengadaaan ikm',
			'aktif_ikm'=>'active',
			'open_ikm'=>'open',
			'pengadaan_ikm'=>'active',
			'rekap_pengadaan'=>$this->model_app->getAllPengadaan($config['per_page'],$dari),
		);
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('ikm/v_rekap_pengadaan');
		$this->load->view('pages/v_footer');
		$this->cart->destroy();
	}
	
	public function tambah_pengadaan(){
		$this->load->library('cart');
		$this->load->helper('date');
		$data=array(
			'title'=>'Tambah Pengadaaan ikm',
			'aktif_ikm'=>'active',
			'open_ikm'=>'open',
			'pengadaan_ikm'=>'active',
			'now'=>time(),
			'id_pengadaan'=>"PG-".time(),
			'data_ikm'=>$this->model_app->getAllData('tbl_ikm'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('ikm/v_tambah_pengadaan');
		$this->load->view('pages/v_footer');
	}
	
	function get_detail_ikm(){
        $id['kd_ikm']=$this->input->post('kd_ikm');
        $data=array(
            'detail_ikm'=>$this->model_app->getSelectedData('tbl_ikm',$id)->result(),
        );
        $this->load->view('ikm/ajax_detail_ikm',$data);
    }
	
	function tambah_ikm_to_cart(){
        $data = array(
            'id'    => $this->input->post('kd_ikm'),
			'qty'   => $this->input->post('qty'),
			'price' => $this->input->post('harga'),
			'name'  => $this->input->post('nama'),
        );
        $this->cart->insert($data);
		redirect('ikm/tambah_pengadaan');
    }

	function hapus_pengadaan(){
        $id= $this->uri->segment(3);
        $bc=$this->model_app->getSelectedData("tbl_ikm_pengadaan",$id);
        foreach($bc->result() as $dph){
            $sess_data['id_pengadaan'] = $dph->id_pengadaan;
            $this->session->set_userdata($sess_data);
        }

        $kode = explode("/",$_GET['kode']);
        if($kode[0]=="tambah")
        {
            $data = array(
                'rowid' => $kode[1],
                'qty'   => 0
            );
            $this->cart->update($data);
        }
        else if($kode[0]=="edit")
        {
            $data = array(
                'rowid' => $kode[1],
                'qty'   => 0
            );
            $this->cart->update($data);
            $hps['id_pengadaan'] = $kode[2];
            $hps['kd_ikm'] = $kode[3];
            $this->model_app->deleteData("tbl_ikm_pengadaan_detail",$hps);

            $key_ikm['kd_ikm'] = $hps['kd_ikm'];
            $d_u['stok'] = $kode[4]+$kode[5];
            $this->model_app->updateData("tbl_ikm",$d_u,$key_ikm);
        }
        redirect('ikm/edit_pengadaan/'.$this->session->userdata('id_pengadaan'));
    }
	
	public function simpan_pengadaan(){
		$data = array(
            'id_pengadaan'=>$this->input->post('id_pengadaan'),
            'no_ktp'=>$this->input->post('no_ktp'),
			'total_pengadaan'=>$this->input->post('total_pengadaan'),
			'keterangan'=>$this->input->post('keterangan')
        );
		$this->db->set('tgl_pengadaan', 'NOW()',FALSE);
        $this->model_app->insertData("tbl_ikm_pengadaan",$data);
		
		foreach($this->cart->contents() as $items){
            $kd_ikm = $items['id'];
            $qty = $items['qty'];
            $data_detail = array(
                'id_pengadaan' => $this->input->post('id_pengadaan'),
                'kd_ikm'=> $kd_ikm,
                'qty'=>$qty,
            );
            $this->model_app->insertData("tbl_ikm_pengadaan_detail",$data_detail);

            $update['stok'] = $this->model_app->getTambahStok($kd_ikm,$qty);
            $key['kd_ikm'] = $kd_ikm;
            $this->model_app->updateData("tbl_ikm",$update,$key);
        }
        $this->cart->destroy();
        redirect('ikm/pengadaan');
	}
	
	public function detail_pengadaan(){
		$id = $this->uri->segment(3);
		$this->akses->akses_petugas();
		$data=array(
			'title'=>'Detail Pengadaaan ikm',
			'aktif_ikm'=>'active',
			'open_ikm'=>'open',
			'pengadaan_ikm'=>'active',
			'detail_pengadaan'=>$this->model_app->getDetailPengadaan($id),
			'ikm_detail'=>$this->model_app->getDetailikm($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('ikm/v_detail_pengadaan');
		$this->load->view('pages/v_footer');
	}
	
	public function cari(){
		$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Daftar Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'daftar_retribusi_header'=>'active',
			'cari_retribusi'=>$this->model_app->getCariRetribusi($match),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_cari_retribusi');
		$this->load->view('pages/v_footer');
	}
	
	public function pembayaran(){
		$this->akses->akses_admin();
		$data=array(
			'title'=>'Pembayaran Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'pembayaran_retribusi'=>'active',
			'daftar_retribusi'=>$this->model_app->getRetribusiBelumBayar(),
		);
		$this->cart->destroy();
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_belum_bayar');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_pembayaran(){
		$this->akses->akses_petugas();
		$this->load->helper('date');
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Pembayaran Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'pembayaran_retribusi'=>'active',
			'id_retribusi'=>$id,
			'now'=>time(),
			'detail_proses_pembayaran'=>$this->model_app->getDetailProsesPembayaran($id),
			'data_tarif'=>$this->model_app->getTarifAdd(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_proses_pembayaran');
		$this->load->view('pages/v_footer');
	}
	
	/*
	public function pembayaranretribusi(){
		$this->akses->akses_petugas();
		$this->load->helper('date');
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Pembayaran Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'pembayaran_retribusi'=>'active',
			'now'=>time(),
			'data_retribusi_kendaraan'=>$this->model_app->getCariUjiRetribusi($match),
			'data_tarif'=>$this->model_app->getTarifAdd(),
			'tarif_plat'=>$this->model_app->getTarifPlat(),
			'tarif_buku'=>$this->model_app->getTarifBuku(),
			'tarif_stiker'=>$this->model_app->getTarifStiker(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_retribusi_pembayaran_pengujian');
		$this->load->view('pages/v_footer');
	}
	
	public function pembayaran(){
		$this->akses->akses_petugas();
		$this->load->helper('date');
		
		$data=array(
			'title'=>'Pembayaran Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'pembayaran_retribusi'=>'active',
			'now'=>time(),
			'data_tarif'=>$this->model_app->getTarifAdd(),
			'tarif_plat'=>$this->model_app->getTarifPlat(),
			'tarif_buku'=>$this->model_app->getTarifBuku(),
			'tarif_stiker'=>$this->model_app->getTarifStiker(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_retribusi_pembayaran');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahpembayaran(){
		$this->akses->akses_petugas();
		$data=array(
			'no_retribusi'=>$this->input->post('no_retribusi'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'no_ktp'=>$this->input->post('no_ktp'),
			'no_uji'=>$this->input->post('no_uji'),
			'tgl_pembayaran'=>$this->input->post('tgl_retribusi'),
			'total_retribusi'=>$this->input->post('jumlah_retribusi'),
			'aktif'=>1
		);
		$detail=array(
			'no_retribusi'=>$this->input->post('no_retribusi'),
			'plat'=>$this->input->post('no_retribusi'),
		);
	}
	
	*/
	
	public function detailpembayaran(){
		$id = $this->uri->segment(3);
		$this->akses->akses_petugas();
		$data=array(
			'title'=>'Detail Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'daftar_retribusi_header'=>'active',
			'detail_pembayaran'=>$this->model_app->getDetailPembayaran($id),
			'retribusi_detail'=>$this->model_app->getDetailRetribusi($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_detail_retribusi');
		$this->load->view('pages/v_footer');
	}
	
	public function ubahpembayaran(){
		$this->akses->akses_petugas();
		
	}
	
	public function hapuspembayaran(){
		$this->akses->akses_petugas();
		$id['no_retribusi'] = $this->uri->segment(3);
		$data=array(
			'aktif' => 0,
		);
		$this->model_app->updateData('tbl_retribusi',$data,$id);
		redirect('retribusi');	
	}
	
	public function get_tarif($kd_tarif){
		$this->load->model('model_app','', TRUE);    
        header('Content-Type: application/x-json; charset=utf-8');
                echo(json_encode($this->model_app->get_tarif_by_id($kd_tarif)));
	}
	
	public function tarif(){
		$this->akses->akses_admin();
		$data=array(
			'title'=>'Tarif Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'tarif_retribusi'=>'active',
			'data_tarif_retribusi'=>$this->model_app->getAllData('tbl_retribusi_tarif'),
			'kd_tarif'=>$this->model_app->getKodeTarif(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_retribusi_tarif');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahtarif(){
		$this->akses->akses_admin();
		$data=array(
			'kd_tarif'=>$this->input->post('kd_tarif'),
			'jenis'=>$this->input->post('jenis'),
			'sifat'=>$this->input->post('form-field-radio'),
			'tarif'=>$this->input->post('tarif')
		);
		$this->model_app->insertData('tbl_retribusi_tarif',$data);
		redirect('retribusi/tarif');
	}
	
	public function ubahtarif(){
		$this->akses->akses_admin();
		$id['kd_tarif'] = $this->input->post('kd_tarif');
		$data=array(
			'jenis'=>$this->input->post('jenis'),
			'tarif'=>$this->input->post('tarif'),
			'sifat'=>$this->input->post('form-field-radio'),
		);
		$this->model_app->updateData('tbl_retribusi_tarif',$data,$id);
		redirect('retribusi/tarif');
	}
	
	public function hapustarif(){
		$this->akses->akses_admin();
		$id['kd_tarif'] = $this->uri->segment(3);
        $this->model_app->deleteData('tbl_retribusi_tarif',$id);
        redirect('retribusi/tarif');
	}
	
	public function denda(){
		$this->load->helper('date');
		
		$denda = 12500;
		$data = $this->model_app->getReminder();
		$now = time();
		foreach ($data as $row){
			$no_kendaraan = $row->no_kendaraan;
			$tgl_akhir = $row->tgl_habis_uji;
			if($tgl_akhir <= unix_to_human($now)){
				$date = new DateTime($tgl_akhir);
				$datenow = new DateTime();
				$selisih = $date->diff($datenow)->format("%m");
				//echo $selisih,$no_kendaraan;
				do{
					$sum = $selisih+1;
				}
				while ($sum<=$selisih);
				
				$bayar = $sum * $denda;
				echo $bayar;
			}
		}
	}
}