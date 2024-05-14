<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Uji extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_app');
		$this->load->model('model_pengujian','pengujian');
		$this->load->model('model_kendaraan','kendaraan');
		$this->load->model('model_surat','surat');
		$this->load->model('akses');
		$this->load->library('fpdf');
		$this->load->library('pagination');
		$this->load->library('image_lib');
		$this->load->library('upload');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function index(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->pengujian->getJmlUji();
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
			'title'=>'Rekap Uji Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_uji'=>'active',
			'total_pengujian'=>$num,
			'dt_penguji'=>$this->pengujian->getSelectedData('penguji',array('flag_aktif'=>'1')),
			'data_pengujian'=>$this->pengujian->getDaftarPengujian($config['per_page'],$dari),
			'start'=>$dari,
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function cari(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Uji Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_uji'=>'active',
			'dt_penguji'=>$this->pengujian->getSelectedData('penguji',array('flag_aktif'=>'1')),
			'data_pengujian'=>$this->pengujian->getCariUji($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function hasilpengujian(){
		//$this->akses->akses_petugas();
		$match = $this->uri->segment(3);
		$data=array(
			'title'=>'Uji Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_uji'=>'active',
			'dt_penguji'=>$this->pengujian->getSelectedData('penguji',array('flag_aktif'=>'1')),
			'data_pengujian'=>$this->pengujian->getCariHasilUji($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_tanggal(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('caritgl');
		$data=array(
			'title'=>'Rekap Uji Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_uji'=>'active',
			'dt_penguji'=>$this->pengujian->getSelectedData('penguji',array('flag_aktif'=>'1')),
			'data_pengujian'=>$this->pengujian->getCariTanggalUji($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function pengujian(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Kendaraan Belum Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'belum_uji'=>'active',
			'dt_kendaraan'=>$this->pengujian->getKendaraanBelumUji(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_kendaraan_belum_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function cari_belum_uji(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Kendaraan Belum Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'belum_uji'=>'active',
			'dt_kendaraan'=>$this->pengujian->getCariBelumUji($match),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_kendaraan_belum_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function belumujiskrg(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Kendaraan Belum Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'belum_uji'=>'active',
			'dt_kendaraan'=>$this->pengujian->getSkrgKendaraanBelumUji(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_kendaraan_belum_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function rekapbelumuji(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('caritgl');
		$data=array(
			'title'=>'Kendaraan Belum Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'belum_uji'=>'active',
			'dt_kendaraan'=>$this->pengujian->getCariTanggalBelumUji($match),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_kendaraan_belum_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function massal(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Kendaraan Belum Uji Massal',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_massal'=>'active',
			'dt_kendaraan'=>$this->pengujian->getKendaraanUjiMassal(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji_massal');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_uji_massal(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Input Laporan Pengujian Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'belum_uji'=>'active',
			'dt_catatan'=>$this->pengujian->getCatatanUji($id),
			'catatan'=>$this->pengujian->getRowData('tbl_uji_catatan',$idx),
			'proses_uji_kendaraan'=>$this->pengujian->getProsesUjiKendaraan($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_uji_massal');
		$this->load->view('pages/v_footer');
	}
	
	public function tambah_proses_ujimassal(){
		$id['kode_uji'] = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$kode_uji = $this->input->get('kode', TRUE);
		$length = count($this->input->post('catatan'));
		for($i = 0; $i < $length; $i++){
			if(!empty($_POST['catatan'][$i])){
				$catatan[$i]=array(
					'kode_uji'=>$kode_uji,
					'jns'=>0,
					'catatan'=>$this->input->post('catatan')[$i],
				);
				$this->model_app->insertData('tbl_uji_catatan',$catatan[$i]);
			}
		}
		$data=array(
			'kode_uji'=>$kode_uji,
			'tint_meter'=>$this->input->post('tint_meter'),
			'sound_level'=>$this->input->post('sound_level'),
			'alur_ban'=>$this->input->post('alur_ban'),
			'asap'=>$this->input->post('asap'),
			'asap_co'=>$this->input->post('asap_co'),
			'asap_hc'=>$this->input->post('asap_hc'),
			'lampu_kiri'=>$this->input->post('lampu_kiri'),
			'derajat_lampu_kiri'=>$this->input->post('derajat_lampu_kiri'),
			'lampu_kanan'=>$this->input->post('lampu_kanan'),
			'derajat_lampu_kanan'=>$this->input->post('derajat_lampu_kanan'),
			'ax_total_s1'=>$this->input->post('axel_total_s1'),
			'ax_total_s2'=>$this->input->post('axel_total_s2'),
			'ax_total_s3'=>$this->input->post('axel_total_s3'),
			'ax_total_s4'=>$this->input->post('axel_total_s4'),
			'side_slip_in'=>$this->input->post('side_slip_in'),
			'br_kiri_s1'=>$this->input->post('brake_kiri_s1'),
			'br_kanan_s1'=>$this->input->post('brake_kanan_s1'),
			'br_kiri_s2'=>$this->input->post('brake_kiri_s2'),
			'br_kanan_s2'=>$this->input->post('brake_kanan_s2'),
			'br_kiri_s3'=>$this->input->post('brake_kiri_s3'),
			'br_kanan_s3'=>$this->input->post('brake_kanan_s3'),
			'br_kanan_s3'=>$this->input->post('brake_kanan_s3'),
			'br_kiri_s4'=>$this->input->post('brake_kiri_s4'),
			'br_kanan_s4'=>$this->input->post('brake_kanan_s4'),
			'br_tangan_kiri'=>$this->input->post('brake_kiri_parkir'),
			'br_tangan_kanan'=>$this->input->post('brake_kanan_parkir'),
			'br_kaki_kiri'=>$this->input->post('brake_kaki_kiri'),
			'br_kaki_kanan'=>$this->input->post('brake_kaki_kanan'),
			'speedometer'=>$this->input->post('kecepatan'),
		);
		$uji=array(
			'tgl_uji'=>date('Y-m-d'),
			'status'=>4,
		);
		$this->model_app->updateData('tbl_uji_detail',$data,$id);
		$this->model_app->updateData('tbl_uji',$uji,$id);
		$this->aktifitas_tambah($no_uji);
		
		redirect('uji/pengujian');
	}
	
	public function foto(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Foto Kendaraan Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'foto_kendaraan'=>'active',
			'dt_kendaraan'=>$this->pengujian->getDaftarFotoKendaraan(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_foto_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function fotoskrg(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Foto Kendaraan Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'foto_kendaraan'=>'active',
			'dt_kendaraan'=>$this->pengujian->getSkrgFotoKendaraan(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_foto_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function rekaptglfoto(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('caritgl');
		$data=array(
			'title'=>'Foto Kendaraan Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'foto_kendaraan'=>'active',
			'dt_kendaraan'=>$this->pengujian->getDaftarFotoTanggal($match),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_foto_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function ambil_foto_kendaraan(){
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Ambil Foto Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_kendaraan'=>'active',
			'now'=>time(),
			'proses_uji_kendaraan'=>$this->model_app->getProsesUjiKendaraan($id),
			'dt_foto'=>$this->model_app->getSelectedData('tbl_uji_foto',$idx)->result(),
			'redirect'=>$this->router->fetch_method(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_foto_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function get_foto_uji(){
		$kode_uji = $this->input->get('kode', TRUE);
		$kode_ujix['kode_uji'] = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$cek = $this->pengujian->getCekFoto($kode_uji);

		if($cek=="0"){
			for($i = 0; $i < 4; $i++){
				$data=array(
					'kode_uji'=>$kode_uji,
					'no_uji'=>$no_uji,
					'kamera' => $i,
					'foto'=>$kode_uji.'_CAM'.$i.'.jpeg',
				);
				$this->model_app->insertData('tbl_uji_foto',$data);
			}
		}
		
		$data=array(
			'kode' => $kode_uji,
			'redirect'=>'ambil_foto_kendaraan_jauh',
		);
		$this->load->view('pengujian/v_ambil_foto',$data);
	}
	
	public function ambil_foto_kendaraan_jauh(){
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Ambil Foto Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_kendaraan'=>'active',
			'now'=>time(),
			'proses_uji_kendaraan'=>$this->model_app->getProsesUjiKendaraan($id),
			'dt_foto'=>$this->model_app->getSelectedData('tbl_uji_foto',$idx)->result(),
			'redirect'=>$this->router->fetch_method(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_foto_kendaraan_jauh');
		$this->load->view('pages/v_footer');
	}
	
	public function get_foto_uji_jauh(){
		$kode_uji = $this->input->get('kode', TRUE);
		$kode_ujix['kode_uji'] = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$cek = $this->pengujian->getCekFoto($kode_uji);

		if($cek=="0"){
			for($i = 0; $i < 4; $i++){
				$data=array(
					'kode_uji'=>$kode_uji,
					'no_uji'=>$no_uji,
					'kamera' => $i,
					'foto'=>$kode_uji.'_CAM'.$i.'.jpeg',
				);
				$this->model_app->insertData('tbl_uji_foto',$data);
			}
		}
		
		$data=array(
			'kode' => $kode_uji,
			'redirect'=>'ambil_foto_kendaraan_jauh',
		);
		$this->load->view('pengujian/v_ambil_foto_jauh',$data);
	}
	
	public function ambil_foto_kendaraan_dekat(){
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Ambil Foto Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_kendaraan'=>'active',
			'now'=>time(),
			'proses_uji_kendaraan'=>$this->model_app->getProsesUjiKendaraan($id),
			'dt_foto'=>$this->model_app->getSelectedData('tbl_uji_foto',$idx)->result(),
			'redirect'=>$this->router->fetch_method(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_foto_kendaraan_dekat');
		$this->load->view('pages/v_footer');
	}
	
	public function get_foto_uji_dekat(){
		$kode_uji = $this->input->get('kode', TRUE);
		$kode_ujix['kode_uji'] = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$cek = $this->pengujian->getCekFoto($kode_uji);

		if($cek=="0"){
			for($i = 0; $i < 4; $i++){
				$data=array(
					'kode_uji'=>$kode_uji,
					'no_uji'=>$no_uji,
					'kamera' => $i,
					'foto'=>$kode_uji.'_CAM'.$i.'.jpeg',
				);
				$this->model_app->insertData('tbl_uji_foto',$data);
			}
		}
		
		$data=array(
			'kode' => $kode_uji,
			'redirect'=>'ambil_foto_kendaraan_dekat',
		);
		$this->load->view('pengujian/v_ambil_foto_dekat',$data);
	}
	
	public function get_foto_kamera(){
		$cam = $this->input->get('cam', TRUE);
		$kode_uji = $this->input->get('kode', TRUE);
		$kode_ujix['kode_uji'] = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$kodefoto = $kode_uji.'_CAM'.$cam.'.jpeg';
		$cek = $this->pengujian->getCekFotoKamera($kodefoto);
		if($cek=="0"){
			$data=array(
				'kode_uji'=>$kode_uji,
				'no_uji'=>$no_uji,
				'kamera' => $cam,
				'foto'=>$kodefoto,
			);
			$this->model_app->insertData('tbl_uji_foto',$data);
		}
		
		$data=array(
			'cam' => $cam,
			'kode' => $kode_uji,
			'redirect'=>'ambil_foto_kendaraan',
		);
		$this->load->view('pengujian/v_ambil_foto_kamera',$data);
	}
	
	public function uploadfoto(){
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Upload Foto Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'foto_kendaraan'=>'active',
			'dt_kendaraan'=>$this->model_app->getProsesUjiKendaraan($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_upload_foto_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_uploadfoto(){
		$kode_uji = $this->input->get('kode', TRUE);
		$id['kode_uji'] = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		
		if (!is_dir('files/foto/'.$kode_uji)) {
			mkdir('./files/foto/' . $kode_uji, 0777, TRUE);
		}
		
		for($i = 0; $i < 4; $i++){
			$_FILES['files']['name'] = $_FILES['foto']['name'][$i];
			$_FILES['files']['type'] = $_FILES['foto']['type'][$i];
			$_FILES['files']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
			$_FILES['files']['error'] = $_FILES['foto']['error'][$i];
			$_FILES['files']['size'] = $_FILES['foto']['size'][$i];
			
			$config=array(
				'file_name'=>$kode_uji.'_CAM'.$i,
				'upload_path'=>'./files/foto/'.$kode_uji,
				'allowed_types'=>'jpg|png|jpeg|bmp',
				'max_size'=>'0',
				'overwrite'=>TRUE,
			);
			$this->upload->initialize($config);
			if($this->upload->do_upload('files')){
				$upload = $this->upload->data();
				$foto[$i]=array(
					'kode_uji'=>$kode_uji,
					'no_uji'=>$no_uji,
					'foto'=>$upload['file_name'],
				);
				$this->model_app->insertData('tbl_uji_foto',$foto[$i]);
			}
		}
		$data=array(
			'foto'=>1,
		);
		$this->model_app->updateData('tbl_uji',$data,$id);
		redirect('uji/foto');
	}
	
	function proses_foto_kendaraan(){
		$idx['kode_uji'] = $this->input->get('kode', TRUE);
		$kode_uji = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		/*
		for($i = 1; $i < 5; $i++){
			if (!is_dir('files/uji/'.$kode_uji)) {
				mkdir('./files/uji/' . $kode_uji, 0777, TRUE);
			}
			
			$image=array(
				'image_library'=>'gd2',
				'source_image'=>'./files/foto/'.$kode_uji.'/'.$kode_uji.'_CAM'.$i.'.jpg',
				'new_image'=>'./files/uji/'.$kode_uji.'/'.$kode_uji.'_CAM'.$i.'.jpg',
				'maintain_ratio' => TRUE,
				'quality' => 40,
			);
			
			$this->image_lib->initialize($image);
			$this->image_lib->resize();
			$this->image_lib->clear();
		}
		
		$fotomentah=array(
			'nouji'=>$no_uji,
			'fotodepanmentah'=>file_get_contents(base_url().'/files/foto/'.$kode_uji.'/'.$kode_uji.'_CAM1.jpg'),
			'fotobelakangmentah'=>file_get_contents(base_url().'/files/foto/'.$kode_uji.'/'.$kode_uji.'_CAM2.jpg'),
			'fotokananmentah'=>file_get_contents(base_url().'/files/foto/'.$kode_uji.'/'.$kode_uji.'_CAM3.jpg'),
			'fotokirimentah'=>file_get_contents(base_url().'/files/foto/'.$kode_uji.'/'.$kode_uji.'_CAM4.jpg'),
		);
		$this->model_app->insertData('fotomentah',$fotomentah);
		*/
		
		$data=array(
			'foto'=>1,
		);
		$this->pengujian->updateData('tbl_uji',$data,$idx);
		redirect('uji/kendaraan');
	}
	
	public function hapusfoto(){
		$id = $this->input->get('id', TRUE);
		$idx['kode_uji'] = $this->input->get('id', TRUE);
		$redirect = $this->input->get('redirect', TRUE);
        $this->pengujian->deleteData('tbl_uji_foto',$idx);
		$this->pengujian->updateData('tbl_uji',array('foto'=>0),$idx);
		delete_files('files/foto/'.$id, TRUE);
        redirect('uji/'.$redirect.'/'.$id);
	}
	
	public function hapusfotokamera(){
		$id = $this->input->get('id', TRUE);
		$cam = $this->input->get('cam', TRUE);
		$redirect = $this->input->get('redirect', TRUE);
        $this->pengujian->getDeleteFotoKamera($id,$cam);
        redirect('uji/'.$redirect.'/'.$id);
	}
	
	// MENU PENGUJIAN
	public function visual(){
		$status = 0;
		$data=array(
			'title'=>'Pengujian Visual Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_visual'=>'active',
			'status'=>1,
			'dt_uji'=>$this->pengujian->getUjiItem($status),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_rekap_uji_visual');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_ujivisual(){
		$status = 0;
		$id = $this->input->get('id', TRUE);
		$jenis = $this->input->get('uji', TRUE);
		$status = $this->input->get('sts', TRUE);
		$idx['kode_uji'] = $this->input->get('id', TRUE);
		$data=array(
			'title'=>'Input Pengujian Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'belum_uji'=>'active',
			'jenis_uji'=>$jenis,
			'status'=>$status,
			'dt_catatan'=>$this->pengujian->getCatatanUji($id),
			'catatan'=>$this->pengujian->getRowData('tbl_uji_catatan',$idx),
			'proses_uji_kendaraan'=>$this->pengujian->getProsesUjiKendaraan($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_ujivisual');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahproses_ujivisual(){
		$id['kode_uji'] = $this->input->get('kode', TRUE);
		$kode_uji = $this->input->get('kode', TRUE);
		$jenis = $this->input->get('uji', TRUE);
		$status = $this->input->get('sts', TRUE);
		$length = count($this->input->post('catatan'));
		for($i = 0; $i < $length; $i++){
			if(!empty($_POST['catatan'][$i])){
				$catatan[$i]=array(
					'kode_uji'=>$kode_uji,
					'jns'=>0,
					'catatan'=>$this->input->post('catatan')[$i],
				);
				$this->model_app->insertData('tbl_uji_catatan',$catatan[$i]);
			}
		}

		$data=array(
			'no_chasis'=>$this->input->post('no_chasis'),
			'plat_pabrik_pembuat'=>$this->input->post('plat_pabrik_pembuat'),
			'plat_nomor'=>$this->input->post('plat_nomor'),
			'tulisan'=>$this->input->post('tulisan'),
			'penghapus_kaca_depan'=>$this->input->post('penghapus_kaca_depan'),
			'klakson'=>$this->input->post('klakson'),
			'kaca_spion'=>$this->input->post('kaca_spion'),
			'pandangan_kedepan'=>$this->input->post('pandangan_kedepan'),
			'kaca_penahan_sinar'=>$this->input->post('kaca_penahan_sinar'),
			'alat_alat_pengendalian'=>$this->input->post('alat_alat_pengendalian'),
			'lampu_indikasi'=>$this->input->post('lampu_indikasi'),
			'speedometer'=>$this->input->post('speedometer'),
			'perlengkapan'=>$this->input->post('perlengkapan'),
			'peralatan'=>$this->input->post('peralatan'),
			'lampu_jauh'=>$this->input->post('lampu_jauh'),
			'tambahan_lampu'=>$this->input->post('tambahan_lampu'),
			'lampu_dekat'=>$this->input->post('lampu_dekat'),
			'arah_lampu'=>$this->input->post('arah_lampu'),
			'lampu_kabut'=>$this->input->post('lampu_kabut'),
			'lampu_posisi'=>$this->input->post('lampu_posisi'),
			'lampu_belakang'=>$this->input->post('lampu_belakang'),
			'lampu_rem'=>$this->input->post('lampu_rem'),
			'lampu_plat_nomor'=>$this->input->post('lampu_plat_nomor'),
			'lampu_mundur'=>$this->input->post('lampu_mundur'),
			'lampu_kabut_belakang'=>$this->input->post('lampu_kabut_belakang'),
			'lampu_arah_peringatan'=>$this->input->post('lampu_arah_peringatan'),
			'reflektor_merah'=>$this->input->post('reflektor_merah'),
			'lampu_tambahan_lainnya'=>$this->input->post('lampu_tambahan_lainnya'),
			'sistem_penerangan'=>$this->input->post('sistem_penerangan'),
			'ukuran_dan_jenis_ban'=>$this->input->post('ukuran_dan_jenis_ban'),
			'keadaan_ban'=>$this->input->post('keadaan_ban'),
			'kedalaman_kembang_ban'=>$this->input->post('kedalaman_kembang_ban'),
			'ukuran_dan_jenis_pelek'=>$this->input->post('ukuran_dan_jenis_pelek'),
			'keadaan_pelek'=>$this->input->post('keadaan_pelek'),
			'penguatan_ban_pelek'=>$this->input->post('penguatan_ban_pelek'),
			'ban_dan_pelek'=>$this->input->post('ban_dan_pelek'),
			'rangka_penompang'=>$this->input->post('rangka_penompang'),
			'bamper'=>$this->input->post('bamper'),
			'tempat_roda_cadangan'=>$this->input->post('tempat_roda_cadangan'),
			'keadaan_body'=>$this->input->post('keadaan_body'),
			'kondisi_body'=>$this->input->post('kondisi_body'),
			'ruang_kemudi'=>$this->input->post('ruang_kemudi'),
			'tempat_duduk_berdiri'=>$this->input->post('tempat_duduk_berdiri'),
			'sam_krt_gandengan'=>$this->input->post('sam_krt_gandengan'),
			'rangka_dan_body'=>$this->input->post('rangka_dan_body'),
			'roda_kemudi'=>$this->input->post('roda_kemudi'),
			'speling_roda_kemudi'=>$this->input->post('speling_roda_kemudi'),
			'batang_kemudi'=>$this->input->post('batang_kemudi'),
			'roda_gigi_kemudi'=>$this->input->post('roda_gigi_kemudi'),
			'sambungan_kemudi'=>$this->input->post('sambungan_kemudi'),
			'penyambungan_sendi_peluru'=>$this->input->post('penyambungan_sendi_peluru'),
			'power_steering'=>$this->input->post('power_steering'),
			'slide_slipe'=>$this->input->post('slide_slipe'),
			'sistem_kemudi'=>$this->input->post('sistem_kemudi'),
			'suspensi_roda_depan'=>$this->input->post('suspensi_roda_depan'),
			'suspensi_roda_belakang'=>$this->input->post('suspensi_roda_belakang'),
			'sumbu'=>$this->input->post('sumbu'),
			'pemasangan_sumbu'=>$this->input->post('pemasangan_sumbu'),
			'pegas'=>$this->input->post('pegas'),
			'bantalan_bantalan_roda'=>$this->input->post('bantalan_bantalan_roda'),
			'as_dan_suspensi'=>$this->input->post('as_dan_suspensi'),
			'dudukan_mesin'=>$this->input->post('dudukan_mesin'),
			'kondisi_mesin'=>$this->input->post('kondisi_mesin'),
			'transmisi'=>$this->input->post('transmisi'),
			'sistem_gas_buang'=>$this->input->post('sistem_gas_buang'),
			'emisi_asap'=>$this->input->post('emisi_asap'),
			'emisi_co'=>$this->input->post('emisi_co'),
			'mesin_transmisi'=>$this->input->post('mesin_transmisi'),
			'pedal_rem'=>$this->input->post('pedal_rem'),
			'speling_pedal'=>$this->input->post('speling_pedal'),
			'kebocoran_kelemahan_1'=>$this->input->post('kebocoran_kelemahan_1'),
			'sambungan_tuas_kabel_1'=>$this->input->post('sambungan_tuas_kabel_1'),
			'pipa_selang'=>$this->input->post('pipa_selang'),
			'tromol_cakram'=>$this->input->post('tromol_cakram'),
			'silinder_katup'=>$this->input->post('silinder_katup'),
			'peroda_plat_pelapis'=>$this->input->post('peroda_plat_pelapis'),
			'sistem_vacum'=>$this->input->post('sistem_vacum'),
			'fungsi_1'=>$this->input->post('fungsi_1'),
			'kebocoran_kelemahan_2'=>$this->input->post('kebocoran_kelemahan_2'),
			'sistem_tekanan_angin'=>$this->input->post('sistem_tekanan_angin'),
			'kebocoran'=>$this->input->post('kebocoran'),
			'waktu_pengisian'=>$this->input->post('waktu_pengisian'),
			'penggerak_rem'=>$this->input->post('penggerak_rem'),
			'pengisian_krt_gandengan'=>$this->input->post('pengisian_krt_gandengan'),
			'tekanan_angin'=>$this->input->post('tekanan_angin'),
			'rem_parkir'=>$this->input->post('rem_parkir'),
			'tuas_tangan_pedal'=>$this->input->post('tuas_tangan_pedal'),
			'speling_tuas_tangan_pedal'=>$this->input->post('speling_tuas_tangan_pedal'),
			'kebocoran_kelemahan_3'=>$this->input->post('kebocoran_kelemahan_3'),
			'sambungan_tuas_kabel_2'=>$this->input->post('sambungan_tuas_kabel_2'),
			'sistem_ruang_gas_buang'=>$this->input->post('sistem_ruang_gas_buang'),
			'fungsi_2'=>$this->input->post('fungsi_2'),
			'sistem_rem'=>$this->input->post('sistem_rem'),
			'sistem_bahan_bakar'=>$this->input->post('sistem_bahan_bakar'),
			'sistem_kelistrikan'=>$this->input->post('sistem_kelistrikan'),
			'lain_lain'=>$this->input->post('lain_lain'),
		);

		$uji=array(
			'status'=>$status,
		);
		$this->model_app->updateData('tbl_uji_visual',$data,$id);
		$this->model_app->updateData('tbl_uji',$uji,$id);
		redirect('uji/'.$jenis);
	}
	
	public function kendaraan(){
		$data=array(
			'title'=>'Daftar Pengujian Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_kendaraan'=>'active',
			'dt_uji'=>$this->pengujian->getUjiItem(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji_item');
		$this->load->view('pages/v_footer');
	}
	
	public function carikendaraan(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Daftar Pengujian Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_kendaraan'=>'active',
			'dt_uji'=>$this->pengujian->getCariUjiItem($match),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji_item');
		$this->load->view('pages/v_footer');
	}
	
	public function semuakendaraan(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Daftar Pengujian Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_kendaraan'=>'active',
			'dt_uji'=>$this->pengujian->getSemuaUjiItem(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji_item');
		$this->load->view('pages/v_footer');
	}
	
	public function caritglkendaraan(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('caritgl');
		$data=array(
			'title'=>'Daftar Pengujian Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_kendaraan'=>'active',
			'dt_uji'=>$this->pengujian->getTglUjiItem($match),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji_item');
		$this->load->view('pages/v_footer');
	}
	
	public function emisi(){
		$status = 1;
		$data=array(
			'title'=>'Pengujian Pra Uji & Emisi Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_emisi'=>'active',
			'status'=>2,
			'dt_uji'=>$this->pengujian->getUjiItem($status),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji_item');
		$this->load->view('pages/v_footer');
	}
	
	public function sideslip(){
		$status = 2;
		$data=array(
			'title'=>'Pengujian Sideslip, Lampu, Kebisingan dan Alur Ban Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_sideslip'=>'active',
			'status'=>3,
			'dt_uji'=>$this->pengujian->getUjiItem($status),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji_item');
		$this->load->view('pages/v_footer');
	}
	
	public function rem(){
		$status = 3;
		$data=array(
			'title'=>'Pengujian Pengereman Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_rem'=>'active',
			'status'=>4,
			'dt_uji'=>$this->pengujian->getUjiItem($status),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji_item');
		$this->load->view('pages/v_footer');
	}
	
	public function kecepatan(){
		$status = 4;
		$data=array(
			'title'=>'Pengujian Kecepatan Kendaraan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_kecepatan'=>'active',
			'status'=>5,
			'dt_uji'=>$this->pengujian->getUjiItem($status),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_uji_item');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_uji(){
		$id = $this->input->get('id', TRUE);
		$idx['kode_uji'] = $this->input->get('id', TRUE);
		$no_uji = $this->input->get('nouji', TRUE);
		$jenis = $this->input->get('uji', TRUE);
		$jenisx['kategori_kerusakan'] = $this->input->get('uji', TRUE);
		$status = $this->input->get('sts', TRUE);
		$data=array(
			'title'=>'Input Pengujian Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'uji_kendaraan'=>'active',
			'jenis_uji'=>$jenis,
			'status'=>$status,
			'dt_catatan'=>$this->pengujian->getCatatanUji($id),
			'catatan'=>$this->pengujian->getRowData('tbl_uji_catatan',$idx),
			'proses_uji_kendaraan'=>$this->pengujian->getProsesUjiKendaraan($id),
			'dt_kerusakan'=>$this->pengujian->getSelectedData('tbl_kerusakan',$jenisx),
			'dt_foto'=>$this->pengujian->getRiwayatFotoUji($no_uji),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_uji_item');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_uji_item(){
		$id = $this->input->get('kode', TRUE);
		$idx['kode_uji'] = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$no_ujix['no_uji'] = $this->input->get('no', TRUE);
		$kode_uji = $this->input->get('kode', TRUE);
		$jenis = $this->input->get('uji', TRUE);
		$status = $this->input->get('sts', TRUE);
		$length = count($this->input->post('catatan'));
		for($i = 0; $i < $length; $i++){
			if(!empty($_POST['catatan'][$i])){
				$cat[$i] = $this->input->post('catatan')[$i];
				$cekcatatan[$i] = $this->pengujian->getCekCatatan($cat[$i],$id);
				if($cekcatatan[$i] == "0"){
					$catatan[$i]=array(
						'kode_uji'=>$kode_uji,
						'jns'=>0,
						'catatan'=>strtoupper($cat[$i]),
					);
					$this->pengujian->insertData('tbl_uji_catatan',$catatan[$i]);
				}
			}
		}
		if($status=='1'){
			$data=array(
				'alur_ban'=>$this->input->post('alur_ban'),
				'asap'=>$this->input->post('asap'),
				'asap_co'=>$this->input->post('asap_co'),
				'asap_hc'=>$this->input->post('asap_hc'),
				'tint_meter'=>$this->input->post('tint_meter'),
				'sound_level'=>$this->input->post('sound_level'),
			);
			$kendaraan=array(
				'uk_panjang'=>$this->input->post('uk_panjang'),
				'uk_lebar'=>$this->input->post('uk_lebar'),
				'uk_tinggi'=>$this->input->post('uk_tinggi'),
				'uk_roh'=>$this->input->post('uk_roh'),
				'uk_foh'=>$this->input->post('uk_foh'),
				'js_sumbu1'=>$this->input->post('js_sumbu1'),
			);
			$this->model_app->updateData('tbl_kendaraan',$kendaraan,$no_ujix);
		} else if($status=='2'){
			$data=array(
				'uji_bawah'=>1,
				'speedometer'=>$this->input->post('kecepatan'),
				'side_slip_in'=>$this->input->post('side_slip_in'),
				'ax_total_s1'=>$this->input->post('axel_total_s1'),
				'ax_total_s2'=>$this->input->post('axel_total_s2'),
				'ax_total_s3'=>$this->input->post('axel_total_s3'),
				'ax_total_s4'=>$this->input->post('axel_total_s4'),
			);
			$kendaraan=array(
				'bk_sumbu1'=>$this->input->post('axel_total_s1'),
				'bk_sumbu2'=>$this->input->post('axel_total_s2'),
				'bk_sumbu3'=>$this->input->post('axel_total_s3'),
				'bk_sumbu4'=>$this->input->post('axel_total_s4'),
				'bk_total'=>$this->input->post('axel_total'),
			);
			$this->model_app->updateData('tbl_kendaraan',$kendaraan,$no_ujix);
		} else if($status=='3'){
			$data=array(
				'lampu_kiri'=>$this->input->post('lampu_kiri'),
				'derajat_lampu_kiri'=>$this->input->post('derajat_lampu_kiri'),
				'lampu_kanan'=>$this->input->post('lampu_kanan'),
				'derajat_lampu_kanan'=>$this->input->post('derajat_lampu_kanan'),
				'br_kiri_s1'=>$this->input->post('brake_kiri_s1'),
				'br_kanan_s1'=>$this->input->post('brake_kanan_s1'),
				'br_kiri_s2'=>$this->input->post('brake_kiri_s2'),
				'br_kanan_s2'=>$this->input->post('brake_kanan_s2'),
				'br_kiri_s3'=>$this->input->post('brake_kiri_s3'),
				'br_kanan_s3'=>$this->input->post('brake_kanan_s3'),
				'br_kanan_s3'=>$this->input->post('brake_kanan_s3'),
				'br_kiri_s4'=>$this->input->post('brake_kiri_s4'),
				'br_kanan_s4'=>$this->input->post('brake_kanan_s4'),
				'br_tangan_kiri'=>$this->input->post('brake_kiri_parkir'),
				'br_tangan_kanan'=>$this->input->post('brake_kanan_parkir'),
				'br_kaki_kiri'=>$this->input->post('brake_kaki_kiri'),
				'br_kaki_kanan'=>$this->input->post('brake_kaki_kanan'),
				
			);
		}
		$uji=array(
			'status'=>$status,
		);
		$this->model_app->updateData('tbl_uji_detail',$data,$idx);
		$this->model_app->updateData('tbl_uji',$uji,$idx);
		if($status=='3'){
			$dtuji = $this->pengujian->getSelectedData('tbl_uji_detail',$idx);
			foreach($dtuji as $row){
				$riwayat=array(
					'no_uji'=>$no_uji,
					'kode_uji'=>$kode_uji,
					'tint_meter'=>$row->tint_meter,
					'sound_level'=>$row->sound_level,
					'alur_ban'=>$row->alur_ban,
					'asap'=>$row->asap,
					'asap_co'=>$row->asap_co,
					'asap_hc'=>$row->asap_hc,
					'lampu_kiri'=>$row->lampu_kiri,
					'derajat_lampu_kiri'=>$row->derajat_lampu_kiri,
					'lampu_kanan'=>$row->lampu_kanan,
					'derajat_lampu_kanan'=>$row->derajat_lampu_kanan,
					'ax_total_s1'=>$row->ax_total_s1,
					'ax_total_s2'=>$row->ax_total_s2,
					'ax_total_s3'=>$row->ax_total_s3,
					'ax_total_s4'=>$row->ax_total_s4,
					'side_slip_in'=>$row->side_slip_in,
					'br_kiri_s1'=>$row->br_kiri_s1,
					'br_kanan_s1'=>$row->br_kanan_s1,
					'br_kiri_s2'=>$row->br_kiri_s2,
					'br_kanan_s2'=>$row->br_kanan_s2,
					'br_kiri_s3'=>$row->br_kiri_s3,
					'br_kanan_s3'=>$row->br_kanan_s3,
					'br_kanan_s3'=>$row->br_kanan_s3,
					'br_kiri_s4'=>$row->br_kiri_s4,
					'br_kanan_s4'=>$row->br_kanan_s4,
					'br_tangan_kiri'=>$row->br_tangan_kiri,
					'br_tangan_kanan'=>$row->br_tangan_kanan,
					'br_kaki_kiri'=>$row->br_kaki_kiri,
					'br_kaki_kanan'=>$row->br_kaki_kanan,
					'speedometer'=>$row->speedometer,
				);
				$uji=array(
					'tgl_uji'=>date('Y-m-d'),
					'uji'=>1,
					'foto'=>1,
					'aktif'=>1,
				);
				$this->pengujian->insertData('tbl_uji_riwayat',$riwayat);
				$this->pengujian->updateData('tbl_uji',$uji,$idx);
			}
		}
		redirect('uji/kendaraan');
	}
	
	public function proses_pengujian(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Input Laporan Pengujian Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'belum_uji'=>'active',
			'dt_catatan'=>$this->pengujian->getCatatanUji($id),
			'catatan'=>$this->pengujian->getRowData('tbl_uji_catatan',$idx),
			'dt_foto'=>$this->model_app->getSelectedData('tbl_uji_foto',$idx)->result(),
			'proses_uji_kendaraan'=>$this->model_app->getProsesUjiKendaraan($id),
			'dt_kerusakan'=>$this->pengujian->getAllData('tbl_kerusakan'),
			'redirect'=>$this->router->fetch_method(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_uji_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_sktl(){
		$id = $this->input->get('id', TRUE);
		$idx['kode_uji'] = $this->input->get('id', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$surat=array(
			'kode_uji'=>$id,
			'no_surat'=>$this->surat->getKodeSuratSKTL(),
			'tgl_surat'=>date("Y-m-d"),
			'no_uji'=>$no_uji,
			'jenis_surat'=>'sktl',
			'aktif'=>2,
		);
		$uji=array(
			'id_penguji'=>$this->input->post('penguji'),
			'tgl_batas_perbaikan'=>$this->input->post('tgl_batas_perbaikan'),
			'aktif'=>4,
		);
		$this->surat->insertData('tbl_surat',$surat);
		$this->model_app->updateData('tbl_uji',$uji,$idx);
		$this->aktifitas_tambah($no_uji);
		redirect('uji/hasilpengujian/'.$id);
	}
	
	public function perbaikan(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Kendaraan Perbaikan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'perbaikan_uji'=>'active',
			'dt_penguji'=>$this->pengujian->getSelectedData('penguji',array('flag_aktif'=>'1')),
			'dt_kendaraan'=>$this->pengujian->getKendaraanPerbaikan(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_perbaikan');
		$this->load->view('pages/v_footer');
	}
	
	public function cariperbaikan(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Kendaraan Perbaikan',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'perbaikan_uji'=>'active',
			'dt_penguji'=>$this->pengujian->getSelectedData('penguji',array('flag_aktif'=>'1')),
			'dt_kendaraan'=>$this->pengujian->getCariPerbaikan($match),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_perbaikan');
		$this->load->view('pages/v_footer');
	}
	
	public function tambah_pengujian_kendaraan(){
		$idx['kode_uji'] = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$no_ujix['no_uji'] = $this->input->get('no', TRUE);
		$kode_uji = $this->input->get('kode', TRUE);
		$length = count($this->input->post('catatan'));
		for($i = 0; $i < $length; $i++){
			if(!empty($_POST['catatan'][$i])){
				$catatan[$i]=array(
					'kode_uji'=>$kode_uji,
					'jns'=>0,
					'catatan'=>strtoupper($this->input->post('catatan')[$i]),
				);
				$this->model_app->insertData('tbl_uji_catatan',$catatan[$i]);
			}
		}
		$data=array(
			'kode_uji'=>$kode_uji,
			'tint_meter'=>$this->input->post('tint_meter'),
			'sound_level'=>$this->input->post('sound_level'),
			'alur_ban'=>$this->input->post('alur_ban'),
			'asap'=>$this->input->post('asap'),
			'asap_co'=>$this->input->post('asap_co'),
			'asap_hc'=>$this->input->post('asap_hc'),
			'lampu_kiri'=>$this->input->post('lampu_kiri'),
			'derajat_lampu_kiri'=>$this->input->post('derajat_lampu_kiri'),
			'lampu_kanan'=>$this->input->post('lampu_kanan'),
			'derajat_lampu_kanan'=>$this->input->post('derajat_lampu_kanan'),
			'ax_total_s1'=>$this->input->post('axel_total_s1'),
			'ax_total_s2'=>$this->input->post('axel_total_s2'),
			'ax_total_s3'=>$this->input->post('axel_total_s3'),
			'ax_total_s4'=>$this->input->post('axel_total_s4'),
			'side_slip_in'=>$this->input->post('side_slip_in'),
			'br_kiri_s1'=>$this->input->post('brake_kiri_s1'),
			'br_kanan_s1'=>$this->input->post('brake_kanan_s1'),
			'br_kiri_s2'=>$this->input->post('brake_kiri_s2'),
			'br_kanan_s2'=>$this->input->post('brake_kanan_s2'),
			'br_kiri_s3'=>$this->input->post('brake_kiri_s3'),
			'br_kanan_s3'=>$this->input->post('brake_kanan_s3'),
			'br_kanan_s3'=>$this->input->post('brake_kanan_s3'),
			'br_kiri_s4'=>$this->input->post('brake_kiri_s4'),
			'br_kanan_s4'=>$this->input->post('brake_kanan_s4'),
			'br_tangan_kiri'=>$this->input->post('brake_kiri_parkir'),
			'br_tangan_kanan'=>$this->input->post('brake_kanan_parkir'),
			'br_kaki_kiri'=>$this->input->post('brake_kaki_kiri'),
			'br_kaki_kanan'=>$this->input->post('brake_kaki_kanan'),
			'speedometer'=>$this->input->post('kecepatan'),
		);
		$kendaraan=array(
			'bk_sumbu1'=>$this->input->post('axel_total_s1'),
			'bk_sumbu2'=>$this->input->post('axel_total_s2'),
			'bk_sumbu3'=>$this->input->post('axel_total_s3'),
			'bk_sumbu4'=>$this->input->post('axel_total_s4'),
			'bk_total'=>$this->input->post('axel_total'),
		);
		$riwayat=array(
			'no_uji'=>$no_uji,
			'kode_uji'=>$kode_uji,
			'tint_meter'=>$this->input->post('tint_meter'),
			'sound_level'=>$this->input->post('sound_level'),
			'alur_ban'=>$this->input->post('alur_ban'),
			'asap'=>$this->input->post('asap'),
			'asap_co'=>$this->input->post('asap_co'),
			'asap_hc'=>$this->input->post('asap_hc'),
			'lampu_kiri'=>$this->input->post('lampu_kiri'),
			'derajat_lampu_kiri'=>$this->input->post('derajat_lampu_kiri'),
			'lampu_kanan'=>$this->input->post('lampu_kanan'),
			'derajat_lampu_kanan'=>$this->input->post('derajat_lampu_kanan'),
			'ax_total_s1'=>$this->input->post('axel_total_s1'),
			'ax_total_s2'=>$this->input->post('axel_total_s2'),
			'ax_total_s3'=>$this->input->post('axel_total_s3'),
			'ax_total_s4'=>$this->input->post('axel_total_s4'),
			'side_slip_in'=>$this->input->post('side_slip_in'),
			'br_kiri_s1'=>$this->input->post('brake_kiri_s1'),
			'br_kanan_s1'=>$this->input->post('brake_kanan_s1'),
			'br_kiri_s2'=>$this->input->post('brake_kiri_s2'),
			'br_kanan_s2'=>$this->input->post('brake_kanan_s2'),
			'br_kiri_s3'=>$this->input->post('brake_kiri_s3'),
			'br_kanan_s3'=>$this->input->post('brake_kanan_s3'),
			'br_kanan_s3'=>$this->input->post('brake_kanan_s3'),
			'br_kiri_s4'=>$this->input->post('brake_kiri_s4'),
			'br_kanan_s4'=>$this->input->post('brake_kanan_s4'),
			'br_tangan_kiri'=>$this->input->post('brake_kiri_parkir'),
			'br_tangan_kanan'=>$this->input->post('brake_kanan_parkir'),
			'br_kaki_kiri'=>$this->input->post('brake_kaki_kiri'),
			'br_kaki_kanan'=>$this->input->post('brake_kaki_kanan'),
			'speedometer'=>$this->input->post('kecepatan'),
		);
		$uji=array(
			'tgl_uji'=>$this->input->get('tgluji', TRUE),
			'uji'=>1,
			'aktif'=>1,
		);
		$this->model_app->updateData('tbl_kendaraan',$kendaraan,$no_ujix);
		$this->model_app->updateData('tbl_uji_detail',$data,$idx);
		$this->pengujian->insertData('tbl_uji_riwayat',$riwayat);
		$this->model_app->updateData('tbl_uji',$uji,$idx);
		$this->aktifitas_tambah($no_uji);
		redirect('uji');
	}
	
	public function pengesahan(){
		//$this->akses->akses_petugas();
		$id = $this->session->userdata('id_penguji');
		$data=array(
			'title'=>'Pengesahan Hasil Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'pengesahan_uji'=>'active',
			'data_pengesahan'=>$this->pengujian->getPengesahanUji($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_pengesahan');
		$this->load->view('pages/v_footer');
	}
	
	public function pengesahanadmin(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Pengesahan Hasil Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'pengesahan_uji'=>'active',
			'data_pengesahan'=>$this->pengujian->getPengesahanAdmin(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_pengesahan');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_pengesahan(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Proses Pengesahan Hasil Pengujian',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'pengesahan_uji'=>'active',
			'dt_foto'=>$this->model_app->getSelectedData('tbl_uji_foto',$idx)->result(),
			'dt_catatan'=>$this->pengujian->getCatatanUji($id),
			'catatan'=>$this->pengujian->getRowData('tbl_uji_catatan',$idx),
			'dt_riwayat'=>$this->pengujian->getRiwayatUji($id),
			'data_pengujian'=>$this->pengujian->getProsesPengesahanUji($id),
			'dt_pengujism'=>$this->pengujian->getSelectedData('penguji',array('flag_aktif'=>'1')),
			'redirect'=>$this->router->fetch_method(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_pengesahan');
		$this->load->view('pages/v_footer');
	}
	
	public function hapuscatatan(){
		$id['id_catatan'] = $this->input->get('id', TRUE);
		$kode_uji = $this->input->get('kode', TRUE);
		$redirect = $this->input->get('redirect', TRUE);
		$data=array(
			'aktif'=>0,
		);
		$this->model_app->updateData('tbl_uji_catatan',$data,$id);
		redirect('uji/'.$redirect.'/'.$kode_uji);
	}
	
	public function get_hasiluji(){
		$hasil = str_replace("+"," ",$this->input->get('hsl', TRUE));
		$tgl = $this->input->get('tgl', TRUE);
		$data=array(
			'tgl'=>$tgl,
            'hasil'=>$hasil,
        );
        $this->load->view('pengujian/v_ajax_hasiluji',$data);
	}
	
	public function get_kirimhasil(){
        $this->load->view('pengujian/v_ajax_kirimhasil');
	}
	
	public function tambah_proses_pengesahan(){
		$id = $this->input->get('id', TRUE);
		$idx['kode_uji'] = $this->input->get('id', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$no_ujix['no_uji'] = $this->input->get('no', TRUE);
		$hasil = $this->input->post('hasil');
		
		$dtkendaraan = $this->pengujian->getProsesBerkas($id);
		foreach($dtkendaraan as $row){
			$nama = $row->nama;
			$telp = $row->telp;
			$nokend = $row->no_kendaraan;
			$nouji = $row->no_uji;
		}
		
		if($hasil=="LULUS"){
			$aktif = 2;
			$cekcatatan = $this->pengujian->getAktifCatatan($id);
			if($cekcatatan>0){
				$ctt=array(
					'aktif'=>0,
				);
				$this->model_app->updateData('tbl_uji_catatan',$ctt,$idx);
			}
			$habisuji = $this->input->post('tgl_habis_uji');
			if(($telp!='') && ($telp!='-')){
				$this->kirimnotiflulus($nama,$telp,$nokend,$nouji,$habisuji,$id);
			}
			
			$kendaraan=array(
				'temp_tgl_uji'=>$this->input->post('tgl_uji'),
				'temp_tgl_habis_uji'=>$this->input->post('tgl_habis_uji'),
			);
			$this->pengujian->updateData('tbl_kendaraan',$kendaraan,$no_ujix);
		} else if($hasil=="TIDAK LULUS"){
			$aktif = 4;
			$ceksurat = $this->pengujian->getRowData('tbl_surat',$idx);
			if($ceksurat>0){
				
			} else {
				$surat=array(
					'kode_uji'=>$id,
					'no_surat'=>$this->surat->getKodeSuratSKTL(),
					'tgl_surat'=>date("Y-m-d"),
					'no_uji'=>$no_uji,
					'jenis_surat'=>'sktl',
					'aktif'=>2,
				);
				$this->surat->insertData('tbl_surat',$surat);
			}
			$tglbatas = $this->input->post('tgl_batas_perbaikan');
			if(($telp!='') && ($telp!='-')){
				$this->kirimnotiftidaklulus($nama,$telp,$nokend,$nouji,$tglbatas,$id);
			}
		}
		
		$length = count($this->input->post('catatan'));
		for($i = 0; $i < $length; $i++){
			if(!empty($_POST['catatan'][$i])){
				$catatan[$i]=array(
					'kode_uji'=>$id,
					'jns'=>0,
					'catatan'=>strtoupper($this->input->post('catatan')[$i]),
				);
				$this->model_app->insertData('tbl_uji_catatan',$catatan[$i]);
			}
		}
		
		$length = count($this->input->post('perbaikan'));
		for($i = 0; $i < $length; $i++){
			if(!empty($_POST['perbaikan'][$i])){
				$catatan[$i]=array(
					'kode_uji'=>$id,
					'jns'=>1,
					'catatan'=>strtoupper($this->input->post('perbaikan')[$i]),
				);
				$this->model_app->insertData('tbl_uji_catatan',$catatan[$i]);
			}
		}
		
		$uji=array(
			'id_penguji'=>$this->input->post('penguji'),
			'hasil'=>$hasil,
			'tgl_habis_uji'=>$this->input->post('tgl_habis_uji'),
			'tgl_batas_perbaikan'=>$this->input->post('tgl_batas_perbaikan'),
			'aktif'=>$aktif,
		);
		
		$this->model_app->updateData('tbl_uji',$uji,$idx);
		$this->aktifitas_tambah($no_uji);
		
		redirect('uji/pengesahan');
		//redirect('uji/hasilpengujian/'.$kode_uji);
	}
	
	public function perso(){
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Perso Hasil Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_uji'=>'active',
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
			'dt_foto'=>$this->model_app->getSelectedData('tbl_uji_foto',$idx)->result(),
			'dt_wilayah'=>$this->model_app->getAlldata('kodewilayah'),
			'dt_kadis'=>$this->model_app->getAlldata('kepaladinas'),
			'dt_direktur'=>$this->model_app->getAlldata('direktur'),
			'dt_penguji'=>$this->pengujian->getSelectedData('penguji',array('flag_aktif'=>'1')),
			'dt_perso'=>$this->pengujian->getSmartCard($id),
			'dt_setting'=>$this->pengujian->getAllData('tbl_setting'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_perso');
		$this->load->view('pages/v_footer');
	}
	
	public function prosesperso(){
		$idx['kode_uji'] = $this->input->get('kode', TRUE);
		$id = $this->input->get('kode', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$id_pemilik['id_user'] = $this->input->get('idp', TRUE);
		$id_kendaraan['no_uji'] = $this->input->get('no', TRUE);
		
		$pemilik=array(
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama'=>$this->input->post('nama'),
		);
		
		$kendaraan=array(
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'no_rangka'=>$this->input->post('no_rangka'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'tahun'=>$this->input->post('tahun'),
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
			'isi_silinder'=>$this->input->post('isi_silinder'),
			'daya_motor'=>$this->input->post('daya_motor'),
			'no_sertifikasi_uji'=>$this->input->post('no_sertifikasi_uji'),
			'tgl_sertifikasi_uji'=>$this->input->post('tgl_sertifikasi_uji'),
			'jbb'=>$this->input->post('jbb'),
			'jbb_kombinasi'=>$this->input->post('jbb_kombinasi'),
			'jbi'=>$this->input->post('jbi'),
			'jbi_kombinasi'=>$this->input->post('jbi_kombinasi'),
			'mst'=>$this->input->post('mst'),
			'bk_total'=>$this->input->post('bk_total'),
			'konf_sumbu'=>$this->input->post('konf_sumbu'),
			'ban_sumbu1'=>$this->input->post('ban_sumbu1'),
			'uk_panjang'=>$this->input->post('uk_panjang'),
			'uk_lebar'=>$this->input->post('uk_lebar'),
			'uk_tinggi'=>$this->input->post('uk_tinggi'),
			'uk_roh'=>$this->input->post('uk_roh'),
			'uk_foh'=>$this->input->post('uk_foh'),
			'dbm_panjang'=>$this->input->post('dbm_panjang'),
			'dbm_lebar'=>$this->input->post('dbm_lebar'),
			'dbm_tinggi'=>$this->input->post('dbm_tinggi'),
			'js_sumbu1'=>$this->input->post('js_sumbu1'),
			'js_sumbu2'=>$this->input->post('js_sumbu2'),
			'js_sumbu3'=>$this->input->post('js_sumbu3'),
			'da_orang'=>$this->input->post('da_orang'),
			'da_barang'=>$this->input->post('da_barang'),
			'kelas_jalan'=>$this->input->post('kelas_jalan'),
		);
		$pengujian=array(
			'uji'=>2,
			'id_penguji'=>$this->input->post('penguji'),
		);
		$this->pengujian->updateData('tbl_pengguna',$pemilik,$id_pemilik);
		$this->pengujian->updateData('tbl_kendaraan',$kendaraan,$id_kendaraan);
		$this->pengujian->updateData('tbl_uji',$pengujian,$idx);
		
		$fotomentah=array(
			'nouji'=>$no_uji,
			'fotodepanmentah'=>file_get_contents(base_url().'/files/foto/'.$id.'/'.$id.'_CAM0.jpeg'),
			'fotobelakangmentah'=>file_get_contents(base_url().'/files/foto/'.$id.'/'.$id.'_CAM1.jpeg'),
			'fotokananmentah'=>file_get_contents(base_url().'/files/foto/'.$id.'/'.$id.'_CAM2.jpeg'),
			'fotokirimentah'=>file_get_contents(base_url().'/files/foto/'.$id.'/'.$id.'_CAM3.jpeg'),
		);
		$this->model_app->insertData('fotomentah',$fotomentah);
		
		$kendaraan = $this->pengujian->getSmartCard($id);
		foreach($kendaraan as $row){
			$total_pengereman = $row->br_kiri_s1+$row->br_kanan_s1+$row->br_kiri_s2+$row->br_kanan_s2+$row->br_kiri_s3+$row->br_kanan_s3+$row->br_kiri_s4+$row->br_kanan_s4;
			$selisih_s1 = str_replace(',','.',round(((abs($row->br_kiri_s1-$row->br_kanan_s1))/$row->ax_total_s1)*100,2));
			$selisih_s2 = str_replace(',','.',round(((abs($row->br_kiri_s2-$row->br_kanan_s2))/$row->ax_total_s2)*100,2));
			if($row->ax_total_s3 > "0") {
				$selisih_s3 = str_replace(',','.',round(((abs($row->br_kiri_s3-$row->br_kanan_s3))/$row->ax_total_s3)*100,2));
			} else {
				$selisih_s3 = 0;
			}
			if($row->ax_total_s4 > "0") {
				$selisih_s4 = str_replace(',','.',round(((abs($row->br_kiri_s4-$row->br_kanan_s4))/$row->ax_total_s4)*100,2));
			} else {
				$selisih_s4 = 0;
			}
			$br_parkir_tangan = $row->br_tangan_kiri + $row->br_tangan_kanan;
			$br_parkir_kaki = $row->br_kaki_kiri + $row->br_kaki_kanan;
			
			$parkir_tangan = str_replace(',','.',round(($br_parkir_tangan / ($row->ax_total_s1 + $row->ax_total_s2 + $row->ax_total_s3))*100,2));
			$parkir_kaki = round(($br_parkir_kaki / ($row->ax_total_s1 + $row->ax_total_s2 + $row->ax_total_s3))*100,0);
			echo $parkir_tangan;
			$pengujian=array(
				'statuspenerbitan'=>$row->status_terbit,
				'nouji'=>$no_uji,
				'nama'=>$row->pemilik,
				'alamat'=>$row->alamat,
				'noidentitaspemilik'=>$row->no_ktp,
				'nosertifikatreg'=>$row->no_sertifikasi_uji,
				'tglsertifikatreg'=>date("dmY",strtotime($row->tgl_sertifikasi_uji)),
				'noregistrasikendaraan'=>$row->no_kendaraan,
				'norangka'=>$row->no_rangka,
				'nomesin'=>$row->no_mesin,
				'merek'=>$row->merek,
				'tipe'=>$row->tipe,
				'jenis'=>$row->jenis_kendaraan,
				'thpembuatan'=>$row->tahun,
				'bahanbakar'=>$row->bahan_bakar,
				'isisilinder'=>$row->isi_silinder,
				'dayamotorpenggerak'=>$row->daya_motor,
				'jbb'=>$row->jbb,
				'jbkb'=>$row->jbb_kombinasi,
				'jbi'=>$row->jbi,
				'jbki'=>$row->jbi_kombinasi,
				'mst'=>$row->mst,
				'beratkosong'=>$row->bk_total,
				'konfigurasisumburoda'=>$row->konf_sumbu,
				'ukuranban'=>$row->ban_sumbu1,
				'panjangkendaraan'=>$row->uk_panjang,
				'lebarkendaraan'=>$row->uk_lebar,
				'tinggikendaraan'=>$row->uk_tinggi,
				'panjangbakatautangki'=>$row->dbm_panjang,
				'lebarbakatautangki'=>$row->dbm_lebar,
				'tinggibakatautangki'=>$row->dbm_tinggi,
				'julurdepan'=>$row->uk_foh,
				'julurbelakang'=>$row->uk_roh,
				'jaraksumbu1_2'=>$row->js_sumbu1,
				'jaraksumbu2_3'=>$row->js_sumbu2,
				'jaraksumbu3_4'=>$row->js_sumbu3,
				'dayaangkutorang'=>$row->da_orang,
				'dayaangkutbarang'=>$row->da_barang,
				'kelasjalanterendah'=>$row->kelas_jalan,
				'idpetugasuji'=>$this->input->post('penguji'),
				'idkepaladinas'=>$this->input->post('kadis'),
				'iddirektur'=>$this->input->post('direktur'),
				'kodewilayah'=>$this->input->post('kd_wilayah'),
				'kodewilayahasal'=>$this->input->post('kd_wilayah_asal'),
				'huv_nomordankondisirangka'=>1,
				'huv_nomordantipemotorpenggerak'=>1,
				'huv_kondisitangkicorongdanpipabahanbakar'=>1,
				'huv_kondisiconverterkit'=>1,
				'huv_kondisidanposisipipapembuangan'=>1,
				'huv_ukurandankondisiban'=>1,
				'huv_kondisisistemsuspensi'=>1,
				'huv_kondisisistemremutama'=>1,
				'huv_kondisipenutuplampudanalatpantulcahaya'=>1,
				'huv_kondisipanelinstrumentdashboard'=>1,
				'huv_kondisikacaspion'=>1,
				'huv_kondisispakbor'=>1,
				'huv_bentukbumper'=>1,
				'huv_keberadaandankondisiperlengkapan'=>1,
				'huv_rancanganteknis'=>1,
				'huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus'=>1,
				'huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup'=>1,
				'hum_kondisipenerusdaya'=>1,
				'hum_sudutbebaskemudi'=>1,
				'hum_kondisiremparkir'=>1,
				'hum_fungsilampudanalatpantulcahaya'=>1,
				'hum_fungsipenghapuskaca'=>1,
				'hum_tingkatkegelapankaca'=>1,
				'hum_fungsiklakson'=>1,
				'hum_kondisidanfungsisabukkeselamatan'=>1,
				'hum_ukurankendaraan'=>1,
				'hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus'=>1,
				'alatuji_emisiasapbahanbakarsolar'=>$row->asap,
				'alatuji_emisicobahanbakarbensin'=>$row->asap_co,
				'alatuji_emisihcbahanbakarbensin'=>$row->asap_hc,
				'alatuji_remutamatotalgayapengereman'=>$total_pengereman,
				'alatuji_remutamaselisihgayapengeremanrodakirikanan1'=>$selisih_s1,
				'alatuji_remutamaselisihgayapengeremanrodakirikanan2'=>$selisih_s2,
				'alatuji_remutamaselisihgayapengeremanrodakirikanan3'=>$selisih_s3,
				'alatuji_remutamaselisihgayapengeremanrodakirikanan4'=>$selisih_s4,
				'alatuji_remparkirtangan'=>$parkir_tangan,
				'alatuji_remparkirkaki'=>$parkir_tangan,
				'alatuji_kincuprodadepan'=>$row->side_slip_in,
				'alatuji_tingkatkebisingan'=>$row->sound_level,
				'alatuji_lampuutamakekuatanpancarlampukanan'=>$row->lampu_kanan,
				'alatuji_lampuutamakekuatanpancarlampukiri'=>$row->lampu_kiri,
				'alatuji_lampuutamapenyimpanganlampukanan'=>$row->derajat_lampu_kanan,
				'alatuji_lampuutamapenyimpanganlampukiri'=>$row->derajat_lampu_kiri,
				'alatuji_penunjukkecepatan'=>$row->speedometer,
				'alatuji_kedalamanalurban'=>$row->alur_ban,
				'masaberlakuuji'=>date("dmY",strtotime($row->tgl_habis_uji)),
				'tgluji'=>date("dmY",strtotime($row->tgl_uji)),
				'statuslulusuji'=>1,
			);
			$this->model_app->insertData('datapengujian',$pengujian);
		}
		$waktu=array(
			'waktu_selesai'=>date("Y-m-d H:i:s"),
		);
		$this->pengujian->updateData('tbl_pendaftaran',$waktu,$idx);
		redirect('uji/data');
	}
	
	public function editperso(){
		$id = $this->input->get('id', TRUE);
		$iduji = $this->input->get('nouji', TRUE);
		$idx['idx'] = $this->input->get('id', TRUE);
		$idujix['nouji'] = $this->input->get('nouji', TRUE);
		$data=array(
			'title'=>'Edit Perso Hasil Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_uji'=>'active',
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
			'dt_foto'=>$this->pengujian->getSelectedData('fotomentah',$idujix),
			'dt_wilayah'=>$this->pengujian->getAlldata('kodewilayah'),
			'dt_kadis'=>$this->pengujian->getAlldata('kepaladinas'),
			'dt_direktur'=>$this->pengujian->getAlldata('direktur'),
			'dt_penguji'=>$this->pengujian->getSelectedData('penguji',array('flag_aktif'=>'1')),
			'dt_perso'=>$this->pengujian->getSelectedData('datapengujian',$idx),
			'dt_setting'=>$this->pengujian->getAllData('tbl_setting'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_edit_perso');
		$this->load->view('pages/v_footer');
	}
	
	public function proseseditperso(){
		$id = $this->input->get('id', TRUE);
		$idx['idx'] = $this->input->get('id', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$no_ujix['nouji'] = $this->input->get('no', TRUE);
		
		$pengujian=array(
			'nouji'=>$this->input->post('nouji'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'noidentitaspemilik'=>$this->input->post('noidentitaspemilik'),
			'nosertifikatreg'=>$this->input->post('nosertifikatreg'),
			//'tglsertifikatreg'=>date("dmY",strtotime($row->tgl_sertifikasi_uji)),
			'noregistrasikendaraan'=>$this->input->post('noregistrasikendaraan'),
			'norangka'=>$this->input->post('norangka'),
			'nomesin'=>$this->input->post('nomesin'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'jenis'=>$this->input->post('jenis'),
			'thpembuatan'=>$this->input->post('thpembuatan'),
			'bahanbakar'=>$this->input->post('bahanbakar'),
			'isisilinder'=>$this->input->post('isisilinder'),
			'dayamotorpenggerak'=>$this->input->post('dayamotorpenggerak'),
			/*
			'jbb'=>$row->jbb,
			'jbkb'=>$row->jbb_kombinasi,
			'jbi'=>$row->jbi,
			'jbki'=>$row->jbi_kombinasi,
			'mst'=>$row->mst,
			'beratkosong'=>$row->bk_total,
			'konfigurasisumburoda'=>$row->konf_sumbu,
			'ukuranban'=>$row->ban_sumbu1,
			'panjangkendaraan'=>$row->uk_panjang,
			'lebarkendaraan'=>$row->uk_lebar,
			'tinggikendaraan'=>$row->uk_tinggi,
			'panjangbakatautangki'=>$row->dbm_panjang,
			'lebarbakatautangki'=>$row->dbm_lebar,
			'tinggibakatautangki'=>$row->dbm_tinggi,
			'julurdepan'=>$row->uk_foh,
			'julurbelakang'=>$row->uk_roh,
			'jaraksumbu1_2'=>$row->js_sumbu1,
			'jaraksumbu2_3'=>$row->js_sumbu2,
			'jaraksumbu3_4'=>$row->js_sumbu3,
			'dayaangkutorang'=>$row->da_orang,
			'dayaangkutbarang'=>$row->da_barang,
			'kelasjalanterendah'=>$row->kelas_jalan,
			*/
			'idpetugasuji'=>$this->input->post('penguji'),
			'idkepaladinas'=>$this->input->post('kadis'),
			'iddirektur'=>$this->input->post('direktur'),
			'kodewilayah'=>$this->input->post('kd_wilayah'),
			'kodewilayahasal'=>$this->input->post('kd_wilayah_asal'),
		);
		$foto=array(
			'nouji'=>$this->input->post('nouji'),
		);
		$this->pengujian->updateData('datapengujian',$pengujian,$idx);
		$this->pengujian->updateData('fotomentah',$foto,$no_ujix);
		redirect('uji/data');
	}
	
	public function data(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->pengujian->getJmlDataUji();
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
			'title'=>'Rekap Data Uji Perso Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_pengujian'=>'active',
			'total_pengujian'=>$num,
			'data_pengujian'=>$this->pengujian->getDaftarDataPengujian($config['per_page'],$dari),
			'start'=>$dari,
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_data_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function hapusperso(){
		$idx['idx'] = $this->input->get('id', TRUE);
		$iduji['nouji'] = $this->input->get('nouji', TRUE);
		$this->pengujian->deleteData('datapengujian',$idx);
		$this->pengujian->deleteData('fotomentah',$iduji);
		redirect('uji/data');
	}
	
	public function datarfid(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->pengujian->getJmlDataRFID();
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
			'title'=>'Rekap Data Uji RFID',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_rfid'=>'active',
			'total_pengujian'=>$num,
			'data_rfid'=>$this->pengujian->getDaftarDataRFID($config['per_page'],$dari),
			'start'=>$dari,
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_data_rfid');
		$this->load->view('pages/v_footer');
	}
	
	public function caridatarfid(){
		$idx['nouji'] = $this->input->post('cari');
		$data=array(
			'title'=>'Cari Data Uji RFID',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_rfid'=>'active',
			'data_rfid'=>$this->pengujian->getSelectedData('datarfid',$idx),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_data_rfid');
		$this->load->view('pages/v_footer');
	}
	
	public function hapusdatarfid(){
		$idx['idx'] = $this->input->get('id', TRUE);
		$iduji['nouji'] = $this->input->get('nouji', TRUE);
		$this->pengujian->deleteData('datarfid',$idx);
		$this->pengujian->deleteData('fotomentah',$iduji);
		redirect('uji/datarfid');
	}
	
	public function edit(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Input Laporan Pengujian Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'belum_uji'=>'active',
			'dt_catatan'=>$this->pengujian->getCatatanUji($id),
			'catatan'=>$this->pengujian->getRowData('tbl_uji_catatan',$idx),
			'dt_foto'=>$this->model_app->getSelectedData('tbl_uji_foto',$idx)->result(),
			'proses_uji_kendaraan'=>$this->model_app->getProsesUjiKendaraan($id),
			'dt_kerusakan'=>$this->pengujian->getAllData('tbl_kerusakan'),
			'redirect'=>$this->router->fetch_method(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_proses_uji_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function detail(){
		//$this->akses->akses_petugas();
		$this->load->helper('date');
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Laporan Pengujian Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_uji'=>'active',
			'detail_uji'=>$this->pengujian->getDetailPengujian($id),
			'dt_catatan'=>$this->pengujian->getCatatanUji($id),
			'dt_perbaikan'=>$this->pengujian->getPerbaikanUji($id),
			'dt_riwayat'=>$this->pengujian->getRiwayatUji($id),
			'dt_foto'=>$this->model_app->getSelectedData('tbl_uji_foto',$idx)->result(),
			'now'=>time()
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_detail_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function habis_uji(){
		//$this->akses->akses_petugas();
		$this->load->library('pagination');
		$this->load->helper('date');
		
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->model_app->getJmlHabisUji();
		$config=array(
			'base_url'=>base_url().'uji/habis_uji/',
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
			'title'=>'Kendaraan Habis Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'habis_uji'=>'active',
			'data_pengujian'=>$this->model_app->getDaftarHabisUji($config['per_page'],$dari),
			'now'=>time()
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_habis_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function caridata(){
		$idx['nouji'] = $this->input->post('cari');
		$data=array(
			'title'=>'Rekap Data Uji Perso Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'daftar_pengujian'=>'active',
			'data_pengujian'=>$this->pengujian->getSelectedData('datapengujian',$idx),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_data_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function cari_habis_uji(){
		//$this->akses->akses_petugas();
		$this->load->helper('date');
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Kendaraan Habis Uji',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'habis_uji'=>'active',
			'cari_pengujian'=>$this->model_app->getCariHabisUji($match),
			'now'=>time()
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_cari_habis_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function berkas(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->pengujian->getJmlUji();
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
			'title'=>'Serah Terima Berkas Uji Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'penyerahan_berkas'=>'active',
			'dt_berkas'=>$this->pengujian->getDaftarPengujian($config['per_page'],$dari),
			'start'=>$dari,
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_berkas');
		$this->load->view('pages/v_footer');
	}
	
	public function prosesberkas(){
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'waktu_selesai'=>date("Y-m-d H:i:s"),
		);
		$dtkendaraan = $this->pengujian->getProsesBerkas($id);
		foreach($dtkendaraan as $row){
			$nama = $row->nama;
			$telp = $row->telp;
			$nokend = $row->no_kendaraan;
			$nouji = $row->no_uji;
			$tgl = $row->tgl_habis_uji;
		}
		$this->pengujian->updateData('tbl_pendaftaran',$data,$idx);
		if(($telp!='') && ($telp!='-')){
			//$this->kirimnotifselesai($nama,$telp,$nokend,$nouji,$tgl,$id);
		}
		redirect('uji/berkas');
	}
	
	public function cariberkas(){
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Serah Terima Berkas Uji Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'penyerahan_berkas'=>'active',
			'dt_berkas'=>$this->pengujian->getCariUji($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_berkas');
		$this->load->view('pages/v_footer');
	}
	
	public function rekapberkas(){
		$match = $this->input->post('caritgl');
		$data=array(
			'title'=>'Serah Terima Berkas Uji Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'penyerahan_berkas'=>'active',
			'dt_berkas'=>$this->pengujian->getCariTanggalUji($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_berkas');
		$this->load->view('pages/v_footer');
	}
	
	public function riwayat_uji(){
		//$this->akses->akses_all();
		$this->load->helper('date');
		$id= $this->session->userdata('no_uji');
		$data=array(
			'title'=>'Riwayat Uji Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'riwayat_uji'=>'active',
			'data_pengujian'=>$this->model_app->getRiwayatUji($id),
			'now'=>time()
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_riwayat_uji');
		$this->load->view('pages/v_footer');
	}
	
	public function detail_riwayat(){
		//$this->akses->akses_all();
		$this->load->helper('date');
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Riwayat Uji Kendaraan Bermotor',
			'aktif_uji'=>'active',
			'open_uji'=>'open',
			'riwayat_uji'=>'active',
			'detail_uji'=>$this->model_app->getDetailPengujian($id),
			'now'=>time()
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_riwayat_uji_detail');
		$this->load->view('pages/v_footer');
	}
	
	
	public function cetak_stiker(){
		//$this->akses->akses_petugas();
		$id = $this->input->get('id', TRUE);
		$idx['id_user'] = $this->session->userdata('id_user');
		$no_uji = $this->input->get('no', TRUE);
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>$id."_stiker.pdf",
			'detail_stiker'=>$this->pengujian->getCetakStiker($id),
			'dt_printer'=>$this->model_app->getSelectedData('tbl_printer_setting',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_stiker',$data);
	}
	
	public function cetak_depan(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>$id."Buku_DEPAN.pdf",
			//'detail_buku'=>$this->model_app->getDetailBuku($id),
			'detail_dinas'=>$this->model_app->getAlldata('tbl_setting'),
		);
		$this->load->view('cetak/v_cetak_buku_depan',$data);
	}
	
	public function cetak_buku_uji(){
		///$this->akses->akses_petugas();
		$id = $this->input->get('id', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$this->aktifitas_cetak_buku($no_uji);
		$data=array(
			'title'=>$id."_buku_uji.pdf",
			'detail_buku'=>$this->pengujian->getCetakBukuUji($id),
			'detail_dinas'=>$this->model_app->getAlldata('tbl_setting'),
		);
		$this->load->view('cetak/v_cetak_buku_uji',$data);
	}
	
	public function cetak_buku_kanan(){
		$id = $this->input->get('id', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$this->aktifitas_cetak_buku($no_uji);
		$data=array(
			'title'=>$id."_buku_uji.pdf",
			'detail_buku'=>$this->pengujian->getCetakBukuUji($id),
		);
		$this->load->view('cetak/v_cetak_buku_kanan',$data);
	}
	
	public function cetak_buku_kiri(){
		$id = $this->input->get('id', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$this->aktifitas_cetak_buku($no_uji);
		$data=array(
			'title'=>$id."_buku_uji.pdf",
			'detail_buku'=>$this->pengujian->getCetakBukuUji($id),
		);
		$this->load->view('cetak/v_cetak_buku_kiri',$data);
	}
	
	public function cetak_buku_uji_numpang(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$cetak = $this->model_app->getCetakBukuNumpang($id);
		foreach($cetak as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_cetak_buku($no_uji);
		$data=array(
			'title'=>$id."_buku_uji.pdf",
			'now'=>time(),
			'detail_buku'=>$cetak,
		);
		$this->load->view('cetak/v_cetak_buku_numpang_uji',$data);
	}
	
	
	
	public function cetak_buku_hasil_numpang(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$cetak = $this->model_app->getCetakBukuUji($id);
		foreach($cetak as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_cetak_buku($no_uji);
		$data=array(
			'title'=>$id."_buku_uji.pdf",
			'now'=>time(),
			'detail_buku'=>$cetak,
		);
		$this->load->view('cetak/v_cetak_buku_hasil_numpang',$data);
	}
	
	public function cetak_bap(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$cetak = $this->model_app->getCetakBukuUji($id);
		foreach($cetak as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_cetak_bap($no_uji);
		$data=array(
			'title'=>$id."_buku_uji.pdf",
			'now'=>time(),
			'detail_bap'=>$cetak,
		);
		$this->load->view('cetak/v_cetak_bap',$data);
	}
	
	public function cetak_kartu_uji(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$baris = $this->input->post("baris");
		$cetak = $this->pengujian->getCetakKartuUji($id);
		foreach($cetak as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_cetak_kartu($no_uji);
		$data=array(
			'title'=>$id."_kartu_uji.pdf",
			'now'=>time(),
			'baris'=>$baris,
			'detail_kartu'=>$cetak,
		);
		$this->load->view('cetak/v_cetak_kartu_uji',$data);
	}
	
	public function cetak_kartu_uji_baru(){
		$id = $this->uri->segment(3);
		$baris = $this->input->post("baris");
		$cetak = $this->pengujian->getCetakKartuUji($id);
		foreach($cetak as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_cetak_kartu($no_uji);
		$data=array(
			'title'=>$id."_kartu_uji.pdf",
			'now'=>time(),
			'baris'=>$baris,
			'detail_kartu'=>$cetak,
		);
		$this->load->view('cetak/v_cetak_kartu_uji_baru',$data);
	}
	
	public function cetak_sktl(){
		//$this->akses->akses_petugas();
		$id = $this->input->get('id', TRUE);
		$idx['kode_uji'] = $this->input->get('id', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>$id."_sktl.pdf",
			'dt_sktl'=>$this->pengujian->getCetakSKTL($id),
			'dt_kerusakan'=>$this->pengujian->getCatKerusakan($id),
			'jml_kerusakan'=>$this->pengujian->getRowData('tbl_uji_catatan',$idx),
			'dt_perbaikan'=>$this->pengujian->getCatPerbaikan($id),
		);
		$this->load->view('cetak/v_cetak_sktl',$data);
	}
	
	public function cetak_lhp(){
		//$this->akses->akses_petugas();
		$id = $this->input->get('id', TRUE);
		$idx['kode_uji'] = $this->input->get('id', TRUE);
		$no_uji = $this->input->get('no', TRUE);
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>$id."_lhp.pdf",
			'dt_sktl'=>$this->pengujian->getCetakLhp($id),
			'dt_kerusakan'=>$this->pengujian->getCatKerusakan($id),
			'dt_perbaikan'=>$this->pengujian->getCatPerbaikan($id),
			'dt_hasil'=>$this->pengujian->getHasilUji($id),
		);
		$this->load->view('cetak/v_cetak_lhp',$data);
	}
	
	public function hapus(){
		//$this->akses->akses_admin();
		$id['kode_uji'] = $this->uri->segment(3);
		$uji = $this->model_app->getSelectedData('tbl_uji',$id)->result();
		foreach($uji as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_hapus($no_uji);
		$data=array(
			'aktif' => 0,
		);
		$this->model_app->updateData('tbl_uji',$data,$id);
		redirect('uji');	
	}
	
	// APPROVAL
	
	public function approv_cetakuji(){
		//$this->akses->akses_petugas();
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->pengujian->getJmlCetakuji();
		$config=array(
			'base_url'=>base_url().'uji/approv_cetakuji/',
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
			'title'=>'Persetujuan Cetak Hasil Uji Kendaraan Bermotor',
			'aktif_persetujuan'=>'active',
			'open_persetujuan'=>'open',
			'persetujuan_uji'=>'active',
			'dt_persetujuan'=>$this->pengujian->getDataCetakuji($config['per_page'],$dari),
			'start'=>$dari,
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pengujian/v_persetujuan_cetakuji');
		$this->load->view('pages/v_footer');
	}
	
	public function setujui_cetakuji(){
		//$this->akses->akses_petugas();
		$id['kode_uji'] = $this->uri->segment(3);
		$uji=array(
			'aktif'=>3,
		);
		$this->model_app->updateData('tbl_uji',$uji,$id);
		$this->aktifitas_tambah($no_uji);
		redirect('uji/approv_cetakuji');
	}
	
	private function aktifitas_tambah($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Membuat data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->model_app->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_ubah($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Merubah data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->model_app->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_hapus($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Menghapus data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->model_app->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_cetak($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Mencetak stiker '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->model_app->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_cetak_buku($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Mencetak buku '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->model_app->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_cetak_bap($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Mencetak berita acara pemeriksaan '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->model_app->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_cetak_kartu($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Mencetak kartu induk '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->model_app->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function kirimnotiflulus($nama,$telp,$nokend,$nouji,$habisuji,$id){
		$setting = $this->pengujian->getAllData('tbl_setting');
		foreach ($setting as $row){
			$api = $row->api_wa;
			$sender = $row->no_wa;
		}
		if(($telp!='') && ($telp!='-')){
			$message = 'Hi sdr/i *'.$nama.'* _(sesuai STNK)_ , '. PHP_EOL .'Terima kasih telah melakukan uji kendaraan di UPUBKB Disperkimhub Kabupaten Wonosobo. Kendaraan anda dengan nomor uji *'.$nouji.'('.$nokend.')* sudah *LULUS* uji berkala dengan masa berlaku uji sampai dengan tanggal *'.strftime("%d %B %Y", strtotime($habisuji)).'*. '. PHP_EOL .''. PHP_EOL .'Guna meningkatkan kualitas pelayanan kami. Dimohon kesediannya untuk mengisi formulir Survey Kepuasan Masyarakat.'. PHP_EOL .''. PHP_EOL .'Terima kasih.';
			$pesan = 'Hi sdr/i *'.$nama.'* _(sesuai STNK)_ , '. PHP_EOL .'Terima kasih telah melakukan uji kendaraan di UPUBKB Disperkimhub Kabupaten Wonosobo. Kendaraan anda dengan nomor uji *'.$nouji.'('.$nokend.')* sudah *LULUS* uji berkala dengan masa berlaku uji sampai dengan tanggal *'.strftime("%d %B %Y", strtotime($habisuji)).'*. '. PHP_EOL .''. PHP_EOL .'Guna meningkatkan kualitas pelayanan kami. Dimohon kesediannya untuk mengisi formulir Survey Kepuasan Masyarakat.'. PHP_EOL .''. PHP_EOL .'Terima kasih.';
			$data = [
				'api_key' => $api,
				'sender'  => $sender,
				'number'  => $telp,
				'message' => $message,
			];
			/*
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://wakita.aminsproject.com/api/send-message.php",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($data))
			);
			$response = curl_exec($curl);
			curl_close($curl);
			*/
			$whatsapp=array(
				'phone'=>$telp,
				'message'=>$pesan,
				'no_uji'=>$nouji,
				'jeniswa'=>'KELUAR',
			);
			$this->pengujian->insertData('tbl_wagateway',$whatsapp);
		}
	}
	
	private function kirimnotiftidaklulus($nama,$telp,$nokend,$nouji,$tglbatas,$id){
		$setting = $this->pengujian->getAllData('tbl_setting');
		foreach ($setting as $row){
			$api = $row->api_wa;
			$sender = $row->no_wa;
		}
		
		if(($telp!='') && ($telp!='-')){
			$no = 1;
			$dtcatatan = $this->pengujian->getCatKerusakan($id);
			foreach($dtcatatan as $row){ 
				$cat[] = $no++.'. '.$row->catatan.''. PHP_EOL .'';
			}
			$kerusakan = implode(' ', $cat);
			
			$message = 'Hi sdr/i *'.$nama.'* _(sesuai STNK)_ , '. PHP_EOL .'Terima kasih telah melakukan uji kendaraan di UPUBKB Disperkimhub Kabupaten Wonosobo. Setelah dilakukan pemeriksaan pengujian kendaraan bermotor pada kendaraan anda dengan nomor uji *'.$nouji.'('.$nokend.')* dinyatakan *TIDAK LULUS* uji berkala dengan didapatkan kekurangan sebagai berikut : '. PHP_EOL .''.$kerusakan.' '. PHP_EOL .''. PHP_EOL .'Sehingga,  diperintahkan  kepada  pemilik  kendaraan  untuk  melakukan  perbaikan  kekurangan  teknis  tersebut. Selanjutnya  kendaraan  tersebut  diharuskan  melakukan  pengujian  kendaraan  ulang  selambat-lambatnya  pada tanggal *'.strftime("%d %B %Y", strtotime($tglbatas)).'*. '. PHP_EOL .''. PHP_EOL .'Guna meningkatkan kualitas pelayanan kami. Dimohon kesediannya untuk mengisi formulir Survey Kepuasan Masyarakat.'. PHP_EOL .''. PHP_EOL .'Terima kasih.';
			$pesan = 'Hi sdr/i *'.$nama.'* _(sesuai STNK)_ , '. PHP_EOL .'Terima kasih telah melakukan uji kendaraan di UPUBKB Disperkimhub Kabupaten Wonosobo. Setelah dilakukan pemeriksaan pengujian kendaraan bermotor pada kendaraan anda dengan nomor uji *'.$nouji.'('.$nokend.')* dinyatakan *TIDAK LULUS* uji berkala dengan didapatkan kekurangan sebagai berikut : '. PHP_EOL .''.$kerusakan.' '. PHP_EOL .''. PHP_EOL .'Sehingga,  diperintahkan  kepada  pemilik  kendaraan  untuk  melakukan  perbaikan  kekurangan  teknis  tersebut. Selanjutnya  kendaraan  tersebut  diharuskan  melakukan  pengujian  kendaraan  ulang  selambat-lambatnya  pada tanggal *'.strftime("%d %B %Y", strtotime($tglbatas)).'*. '. PHP_EOL .''. PHP_EOL .'Guna meningkatkan kualitas pelayanan kami. Dimohon kesediannya untuk mengisi formulir Survey Kepuasan Masyarakat.'. PHP_EOL .''. PHP_EOL .'Terima kasih.';
			$data = [
				'api_key' => $api,
				'sender'  => $sender,
				'number'  => $telp,
				'message' => $message,
			];
			/*
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://wakita.aminsproject.com/api/send-message.php",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($data))
			);
			$response = curl_exec($curl);
			curl_close($curl);
			*/
			$whatsapp=array(
				'phone'=>$telp,
				'message'=>$pesan,
				'no_uji'=>$nouji,
				'jeniswa'=>'KELUAR',
			);
			$this->pengujian->insertData('tbl_wagateway',$whatsapp);
		}
	}
}