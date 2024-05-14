<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_kendaraan','kendaraan');
		$this->load->model('akses');
		$this->load->helper('date');
		$this->load->library('encryption');
		$this->load->library('google_url_api');
		$this->load->library('fpdf');
		$this->load->library('pagination');
		$this->load->library('upload');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function index(){
		//$this->akses->akses_petugas();
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		$num = $this->kendaraan->getJmlKendaraan();
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
			'title'=>'Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_kendaraan'=>'active',
			'dt_kendaraan'=>$this->kendaraan->getDaftarKendaraan($config['per_page'],$dari),
			'jml_kendaraan'=>$num,
			'start'=>$dari,
			'now'=>time(),
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function cari(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Cari Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_kendaraan'=>'active',
			'dt_kendaraan'=>$this->kendaraan->getCariKendaraan($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function lihatkendaraan(){
		$id = $this->uri->segment(3);
		$idx['no_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Lihat Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_kendaraan'=>'active',
			'dt_foto'=>$this->kendaraan->getDataFotoKendaraan($id),
			'dt_kendaraan'=>$this->kendaraan->getDataKend($id),
			'data_pengujian'=>$this->kendaraan->getDataPengujianKendaraan($id),
			'data_uji_keluar'=>$this->kendaraan->getDataUjiKeluar($id),
			'dt_pemilik'=>$this->kendaraan->getDataPemilik($id),
			'data_pendaftaran'=>$this->kendaraan->getDataPendaftaranUji($id),
			'dt_berkas'=>$this->kendaraan->getSelectedData('tbl_berkas',$idx),
			'dt_whatsapp'=>$this->kendaraan->getDataWhatsapp($id),
			'dt_status_kendaraan'=>$this->kendaraan->getAllData('tbl_kendaraan_status'),
			'nouji'=>$id,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_lihat_kendaraan',$data);
		$this->load->view('pages/v_footer');
	}
	
	public function edit_statuskendaraan(){
		$id = $this->uri->segment(3);
		$idx['no_uji'] = $this->uri->segment(3);
		$data=array(
			'status'=>$this->input->post('status'),
		);
		$this->kendaraan->updateData('tbl_kendaraan',$data,$idx);
		redirect('kendaraan/lihatkendaraan/'.$id);
	}
	
	public function prosesberkas(){
		$nouji = $this->uri->segment(3);
		$jenis = $this->input->post('jenis_berkas');
		if(!is_dir('files/berkas/'.$nouji)) {
			mkdir('./files/berkas/'.$nouji, 0777, TRUE);
		}
		$files = 'berkas';
		$config=array(
			'encrypt_name'=>TRUE,
			'upload_path'=>'./files/berkas/'.$nouji,
			'allowed_types'=>'pdf|jpg|png|jpeg|bmp',
			'overwrite'=>TRUE,
			'max_size'=>'0',
		);
		$this->upload->initialize($config);
		if($this->upload->do_upload($files)){
			$upload = $this->upload->data();
			$data=array(
				'no_uji'=>$nouji,
				'jenis_berkas'=>$this->input->post('jenis_berkas'),
				'nama_berkas'=>$nouji.'_'.$jenis.''.$upload['file_ext'],
				'raw_berkas'=>$upload['file_name'],
			);
			$this->kendaraan->insertData('tbl_berkas',$data);
		}
		redirect('kendaraan/lihatkendaraan/'.$nouji);
	}
	
	public function lihatberkas(){
		$idx['id_berkas'] = $this->uri->segment(3);
		$data=array(
			'dt_berkas'=>$this->kendaraan->getSelectedData('tbl_berkas',$idx),
		);
		$this->load->view('kendaraan/v_lihat_berkas',$data);
	}
	
	public function hapusberkas(){
		$table = array('tbl_berkas');
		$id = $this->input->get('id', TRUE);
        $idx['id_berkas'] = $this->input->get('id', TRUE);
		$nouji = $this->input->get('no', TRUE);
		$berkas = $this->input->get('raw', TRUE);
        $this->kendaraan->deleteData($table,$idx);
        unlink('files/berkas/'.$nouji.'/'.$berkas);
		redirect('kendaraan/lihatkendaraan/'.$nouji);
	}
	
	public function detail(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Detail Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_kendaraan'=>'active',
			'detail_kendaraan'=>$this->kendaraan->getDataKend($id),
			'data_pengujian'=>$this->kendaraan->getDataPengujianKendaraan($id),
			'data_uji_keluar'=>$this->kendaraan->getDataUjiKeluar($id),
			'data_pemilik'=>$this->kendaraan->getDataPemilik($id),
			'data_pendaftaran'=>$this->kendaraan->getDataPendaftaranUji($id),
			'no_uji'=>$id,
		);
		$this->load->view('kendaraan/v_kartu_induk',$data);
	}
	
	public function tambah(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Tambah Data Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_kendaraan'=>'active',
			'now'=>time(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_tambah_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function tambah_kendaraan(){
		//$this->akses->akses_petugas();
		$no_uji = $this->input->post('no_uji');
		$barcode_type = "Code39";
		$qrcode_data = $no_uji;
		$pengguna=array(
			'no_uji'=>$this->input->post('no_uji'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_stnk'=>$this->input->post('tgl_stnk'),
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
			'telp'=>$this->input->post('telp'),
		);
		$kendaraan=array(
			'no_uji'=>$this->input->post('no_uji'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_pemakaian_pertama'=>$this->input->post('tgl_pemakaian_pertama'),
			'tempat_pemakaian_pertama'=>$this->input->post('tempat_pemakaian_pertama'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'jenis'=>$this->input->post('jenis'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'bentuk'=>$this->input->post('bentuk'),
			'tahun'=>$this->input->post('tahun'),
			'isi_silinder'=>$this->input->post('isi_silinder'),
			'daya_motor'=>$this->input->post('daya_motor'),
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
			'status'=>$this->input->post('status'),
			'no_rangka'=>$this->input->post('no_rangka'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'no_sertifikasi_uji'=>$this->input->post('no_sertifikasi_uji'),
			'tgl_sertifikasi_uji'=>$this->input->post('tgl_sertifikasi_uji'),
			'penerbit_sertifikasi_uji'=>$this->input->post('penerbit_sertifikasi_uji'),
			'nama_komersiil'=>$this->input->post('nama_komersiil'),
			'warna'=>$this->input->post('warna'),
			'jarak_terendah'=>$this->input->post('jarak_terendah'),
			'dimensi_kendaraan'=>$this->input->post('dimensi_muatan'),
			'uk_panjang'=>$this->input->post('uk_panjang'),
			'uk_lebar'=>$this->input->post('uk_lebar'),
			'uk_tinggi'=>$this->input->post('uk_tinggi'),
			'uk_roh'=>$this->input->post('uk_roh'),
			'uk_foh'=>$this->input->post('uk_foh'),
			'js_sumbu1'=>$this->input->post('js_sumbu1'),
			'js_sumbu2'=>$this->input->post('js_sumbu2'),
			'js_sumbu3'=>$this->input->post('js_sumbu3'),
			'js_sumbuq'=>$this->input->post('js_sumbuq'),
			'dbm_panjang'=>$this->input->post('dbm_panjang'),
			'dbm_lebar'=>$this->input->post('dbm_lebar'),
			'dbm_tinggi'=>$this->input->post('dbm_tinggi'),
			'karoseri'=>$this->input->post('karoseri'),
			'dbm_bahan_bak'=>$this->input->post('dbm_bahan_bak'),
			'tempat_duduk'=>$this->input->post('tempat_duduk'),
			'tempat_berdiri'=>$this->input->post('tempat_berdiri'),
			'dt_panjang'=>$this->input->post('dt_panjang'),
			'dt_lebar'=>$this->input->post('dt_lebar'),
			'dt_tinggi'=>$this->input->post('dt_tinggi'),
			'dt_volume'=>$this->input->post('dt_volume'),
			'dt_jenis_muatan'=>$this->input->post('dt_jenis_muatan'),
			'dt_berat_jenis_muatan'=>$this->input->post('dt_berat_jenis_muatan'),
			'dt_bahan_tangki'=>$this->input->post('dt_bahan_tangki'),
			'ban_sumbu1'=>$this->input->post('ban_sumbu1'),
			'ban_sumbu2'=>$this->input->post('ban_sumbu2'),
			'ban_sumbu3'=>$this->input->post('ban_sumbu3'),
			'ban_sumbu4'=>$this->input->post('ban_sumbu4'),
			'konf_sumbu'=>$this->input->post('konf_sumbu'),
			'jbb'=>$this->input->post('jbb'),
			'jbb_kombinasi'=>$this->input->post('jbb_kombinasi'),
			'bk_sumbu1'=>$this->input->post('bk_sumbu1'),
			'bk_sumbu2'=>$this->input->post('bk_sumbu2'),
			'bk_sumbu3'=>$this->input->post('bk_sumbu3'),
			'bk_sumbu4'=>$this->input->post('bk_sumbu4'),
			'bk_total'=>$this->input->post('bk_total'),
			'da_orang'=>$this->input->post('da_orang'),
			'jml_da_orang'=>$this->input->post('jml_da_orang'),
			'da_barang'=>$this->input->post('da_barang'),
			'jbi'=>$this->input->post('jbi'),
			'jbi_kombinasi'=>$this->input->post('jbi_kombinasi'),
			'mst'=>$this->input->post('mst'),
			'kelas_jalan'=>$this->input->post('kelas_jalan'),
			'barcode'=>$no_uji."_Code39.png",
			'qrcode'=>$no_uji.".png",
		);
		$this->kendaraan->insertData('tbl_pengguna',$pengguna);
		$this->kendaraan->insertData('tbl_kendaraan',$kendaraan);
		$this->generate_barcode($no_uji,$barcode_type);
		$this->generate_qrcode($qrcode_data,$no_uji);
		$this->aktifitas_tambah($no_uji);
		redirect('kendaraan');
	}
	
	public function edit(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Edit Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_kendaraan'=>'active',
			'nouji'=>$id,
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'),
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
			'dt_kendaraan'=>$this->kendaraan->getDataKend($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_edit_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function edit_kendaraan(){
		//$this->akses->akses_petugas();
		$id['id_user'] = $this->input->post('id_user');
		$id_kendaraan['no_uji'] = $this->input->post('no_uji');
		$no_uji = $this->input->post('no_uji');
		$status_pemilik = $this->input->post('status_pemilik');
		$barcode_type = "Code39";
		$qrcode_data = $no_uji;
		$pengguna_baru = array(
			'no_uji'=>$this->input->post('no_uji'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_stnk'=>$this->input->post('tgl_stnk'),
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
			'telp'=>$this->input->post('telp'),
		);
		$pengguna=array(
			'tgl_stnk'=>$this->input->post('tgl_stnk'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
			'telp'=>$this->input->post('telp'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
		);
		$kendaraan=array(
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_pemakaian_pertama'=>$this->input->post('tgl_pemakaian_pertama'),
			'tempat_pemakaian_pertama'=>$this->input->post('tempat_pemakaian_pertama'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'jenis'=>$this->input->post('jenis'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'bentuk'=>$this->input->post('bentuk'),
			'tahun'=>$this->input->post('tahun'),
			'isi_silinder'=>$this->input->post('isi_silinder'),
			'daya_motor'=>$this->input->post('daya_motor'),
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
			'sifat'=>$this->input->post('sifat'),
			'no_rangka'=>$this->input->post('no_rangka'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'no_ut'=>$this->input->post('no_ut'),
			'tgl_ut'=>$this->input->post('tgl_ut'),
			'penerbit_ut'=>$this->input->post('penerbit_ut'),
			'no_rb'=>$this->input->post('no_rb'),
			'tgl_rb'=>$this->input->post('tgl_rb'),
			'penerbit_rb'=>$this->input->post('penerbit_rb'),
			'no_sertifikasi_uji'=>$this->input->post('no_sertifikasi_uji'),
			'tgl_sertifikasi_uji'=>$this->input->post('tgl_sertifikasi_uji'),
			'penerbit_sertifikasi_uji'=>$this->input->post('penerbit_sertifikasi_uji'),
			'nama_komersiil'=>$this->input->post('nama_komersiil'),
			'warna'=>$this->input->post('warna'),
			'jarak_terendah'=>$this->input->post('jarak_terendah'),
			'dimensi_kendaraan'=>$this->input->post('dimensi_muatan'),
			'kema_sumbu1'=>$this->input->post('kem_sumbu1'),
			'kema_sumbu2'=>$this->input->post('kem_sumbu2'),
			'kema_sumbu3'=>$this->input->post('kem_sumbu3'),
			'kema_sumbu4'=>$this->input->post('kem_sumbu4'),
			'uk_panjang'=>$this->input->post('uk_panjang'),
			'uk_lebar'=>$this->input->post('uk_lebar'),
			'uk_tinggi'=>$this->input->post('uk_tinggi'),
			'uk_roh'=>$this->input->post('uk_roh'),
			'uk_foh'=>$this->input->post('uk_foh'),
			'js_sumbu1'=>$this->input->post('js_sumbu1'),
			'js_sumbu2'=>$this->input->post('js_sumbu2'),
			'js_sumbu3'=>$this->input->post('js_sumbu3'),
			'js_sumbu4'=>$this->input->post('js_sumbu4'),
			'js_sumbup'=>$this->input->post('js_sumbup'),
			'js_sumbuq'=>$this->input->post('js_sumbuq'),
			'js_sumbur'=>$this->input->post('js_sumbur'),
			'js_sumbub'=>$this->input->post('js_sumbub'),
			'dbm_panjang'=>$this->input->post('dbm_panjang'),
			'dbm_lebar'=>$this->input->post('dbm_lebar'),
			'dbm_tinggi'=>$this->input->post('dbm_tinggi'),
			'dbm_jenis'=>$this->input->post('dbm_jenis'),
			'karoseri'=>$this->input->post('karoseri'),
			'dbm_bahan_bak'=>$this->input->post('dbm_bahan_bak'),
			'tempat_duduk'=>$this->input->post('tempat_duduk'),
			'tempat_berdiri'=>$this->input->post('tempat_berdiri'),
			'dt_panjang'=>$this->input->post('dt_panjang'),
			'dt_lebar'=>$this->input->post('dt_lebar'),
			'dt_tinggi'=>$this->input->post('dt_tinggi'),
			'dt_volume'=>$this->input->post('dt_volume'),
			'dt_jenis_muatan'=>$this->input->post('dt_jenis_muatan'),
			'dt_berat_jenis_muatan'=>$this->input->post('dt_berat_jenis_muatan'),
			'dt_bahan_tangki'=>$this->input->post('dt_bahan_tangki'),
			'ban_sumbu1'=>$this->input->post('ban_sumbu1'),
			'ban_sumbu2'=>$this->input->post('ban_sumbu2'),
			'ban_sumbu3'=>$this->input->post('ban_sumbu3'),
			'ban_sumbu4'=>$this->input->post('ban_sumbu4'),
			'konf_sumbu'=>$this->input->post('konf_sumbu'),
			'jbb'=>$this->input->post('jbb'),
			'jbb_kombinasi'=>$this->input->post('jbb_kombinasi'),
			'bk_sumbu1'=>$this->input->post('bk_sumbu1'),
			'bk_sumbu2'=>$this->input->post('bk_sumbu2'),
			'bk_sumbu3'=>$this->input->post('bk_sumbu3'),
			'bk_sumbu4'=>$this->input->post('bk_sumbu4'),
			'bk_total'=>$this->input->post('bk_total'),
			'jml_da_orang'=>$this->input->post('jml_da_orang'),
			'da_orang'=>$this->input->post('da_orang'),
			'da_barang'=>$this->input->post('da_barang'),
			'jbi'=>$this->input->post('jbi'),
			'jbi_kombinasi'=>$this->input->post('jbi_kombinasi'),
			'mst'=>$this->input->post('mst'),
			'kelas_jalan'=>$this->input->post('kelas_jalan'),
			'barcode'=>$no_uji."_Code39.png",
			'qrcode'=>$no_uji.".png",
		);
		$aktif = array(
			'aktif' => 0,
		);
		if($status_pemilik=='ganti_nama'){
			$this->kendaraan->updateData('tbl_pengguna',$aktif,$id);
			$this->kendaraan->insertData('tbl_pengguna',$pengguna_baru);
		}
		else {
			$this->kendaraan->updateData('tbl_pengguna',$pengguna,$id);
		}
		$this->kendaraan->updateData('tbl_kendaraan',$kendaraan,$id_kendaraan);
		$this->generate_barcode($no_uji,$barcode_type);
		$this->generate_qrcode($qrcode_data,$no_uji);
		$this->aktifitas_ubah($no_uji);
		redirect('kendaraan');
	}
	
	public function editnomoruji(){
		$id['no_uji'] = $this->uri->segment(3);
		$no_uji = $this->input->post('no_uji');
		$no_uji_baru = $this->input->post('no_uji_baru');
		$data=array(
			'no_uji'=>$no_uji_baru,
		);
		$this->kendaraan->updateData('tbl_kendaraan',$data,$id);
		$this->kendaraan->updateData('tbl_pengguna',$data,$id);
		$this->aktifitas_ubah($no_uji);
		redirect('kendaraan/edit/'.$no_uji_baru);
	}
	
	public function blokir_kendaraan(){
		//$this->akses->akses_petugas();
		$id['no_uji'] = $this->uri->segment(3);
		$no_uji = $this->uri->segment(3);
		$data=array(
			'status'=>2,
		);
		$blokir=array(
			'no_uji'=>$this->input->post('no_uji'),
			'ket_blokir'=>$this->input->post('ket_blokir'),
			'tgl_blokir'=>date('Y-m-d H:i:s'),
			'aktif'=>1,
		);
		$this->kendaraan->updateData('tbl_kendaraan',$data,$id);
		$this->kendaraan->insertData('tbl_kendaraan_blokir',$blokir);
		$this->aktifitas_blokir($no_uji);
		redirect('kendaraan/rekap_blokir');
	}
	
	public function hapus_blokir(){
		//$this->akses->akses_petugas();
		$id['no_uji'] = $this->uri->segment(3);
		$no_uji = $this->uri->segment(3);
		$data=array(
			'status' => 0,
		);
		$blokir=array(
			'tgl_hapus_blokir'=>date('Y-m-d H:i:s'),
			'aktif' => 0,
		);
		$this->kendaraan->updateData('tbl_kendaraan',$data,$id);
		$this->kendaraan->updateData('tbl_kendaraan_blokir',$blokir,$id);
		$this->aktifitas_hapus_blokir($no_uji);
		redirect('kendaraan');	
	}
	
	public function rekap_blokir(){
		//$this->akses->akses_petugas();
		
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->kendaraan->getJmlKenBlokir();
		$config=array(
			'base_url'=>base_url().'kendaraan/rekap_blokir',
			'total_rows'=>$num,
			'per_page'=>10,
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
			'title'=>'Rekap Kendaraan Diblokir',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_kendaraan_diblokir'=>'active',
			'dt_kendaraan'=>$this->kendaraan->getKendaraanBlokir($config['per_page'],$dari),
			'now'=>time(),
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_kendaraan_blokir');
		$this->load->view('pages/v_footer');
	}
	
	public function mutasi(){
		//$this->akses->akses_petugas();
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->kendaraan->getJmlMutasi();
		$config=array(
			'base_url'=>base_url().'kendaraan/mutasi',
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
			'title'=>'Daftar Mutasi Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_kendaraan_mutasi'=>'active',
			'dt_mutasi'=>$this->kendaraan->getAllDataMutasi($config['per_page'],$dari),
			'start'=>$dari,
		);
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_mutasi');
		$this->load->view('pages/v_footer');
	}
	
	public function carimutasi(){
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Cari Mutasi Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_kendaraan_mutasi'=>'active',
			'dt_mutasi'=>$this->kendaraan->getCariMutasiKendaraan($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_mutasi');
		$this->load->view('pages/v_footer');
	}
	
	public function prosesmutasi(){
		$no_uji = $this->uri->segment(3);
		$no_ujix['no_uji'] = $this->uri->segment(3);
		$data=array(
			'status' => 3,
		);
		$this->kendaraan->updateData('tbl_kendaraan',$data,$no_ujix);
		$this->aktifitas_blokir($no_uji);
		redirect('kendaraan/mutasi');
	}
	
	public function batalmutasi(){
		$no_uji = $this->uri->segment(3);
		$no_ujix['no_uji'] = $this->uri->segment(3);
		$data=array(
			'status' => 0,
		);
		$this->kendaraan->updateData('tbl_kendaraan',$data,$no_ujix);
		$this->aktifitas_hapus_blokir($no_uji);
		redirect('kendaraan/mutasi');
	}
	
	public function pemilik(){
		//$this->akses->akses_petugas();
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->kendaraan->getJmlPemilik();
		$config=array(
			'base_url'=>base_url().'kendaraan/pemilik',
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
			'title'=>'Daftar Pemilik Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_pemilik'=>'active',
			'dt_pemilik'=>$this->kendaraan->getAllDataPemilik($config['per_page'],$dari),
			'start'=>$dari,
			'jml_pemilik'=>$num,
		);
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_pemilik');
		$this->load->view('pages/v_footer');
	}
	
	public function caripemilik(){
		//$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Cari Pengguna',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_pemilik'=>'active',
			'dt_pemilik'=>$this->kendaraan->getCariPemilik($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_pemilik');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahpemilik(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Tambah Data Pemilik Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_pemilik'=>'active',
			'now'=>time(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_pemilik_tambah');
		$this->load->view('pages/v_footer');
	}
	
	function prosestambahpemilik(){
		//$this->akses->akses_petugas();
		$data=array(
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
			'telp'=>$this->input->post('telp'),
			'no_uji'=>$this->input->post('no_uji'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_stnk'=>$this->input->post('tgl_stnk'),
		);
		$this->kendaraan->insertData('tbl_pengguna',$data);
		redirect('kendaraan/pemilik');
	}
	
	public function editpemilik(){
		//$this->akses->akses_petugas();
		$id['id_user'] = $this->uri->segment(3);
		$data=array(
            'title'=>'Edit Pemilik Kendaraan',
			'aktif_kendaraan'=>'active',
			'open_kendaraan'=>'open',
			'daftar_pemilik'=>'active',
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'),
            'data_pemilik'=>$this->kendaraan->getSelectedData('tbl_pengguna',$id),
        );
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_pemilik_edit');
		$this->load->view('pages/v_footer');
	}
	
	public function proseseditpemilik(){
		//$this->akses->akses_petugas();
		$id['id_user'] = $this->uri->segment(3);
		$data=array(
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
			'telp'=>$this->input->post('telp'),
			'no_uji'=>$this->input->post('no_uji'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_stnk'=>$this->input->post('tgl_stnk'),
		);
		$this->kendaraan->updateData('tbl_pengguna',$data,$id);
		redirect('kendaraan/pemilik');
	}
	
	public function hapuspemilik(){
		$idx['id_user'] = $this->uri->segment(3);
		$data=array(
			'aktif' => 0,
		);
		$this->kendaraan->updateData('tbl_pengguna',$data,$idx);
		redirect('kendaraan/pemilik');
	}
	
	public function batalhapuspemilik(){
		$id['id_user'] = $this->uri->segment(3);
		$data=array(
			'aktif' => 1,
		);
		$this->kendaraan->updateData('tbl_pengguna',$data,$idx);
		redirect('kendaraan/pemilik');
	}
	
	public function hapuskendaraan(){
		$id['no_uji'] = $this->uri->segment(3);
		$data=array(
			'aktif' => 0,
		);
		$this->kendaraan->updateData('tbl_kendaraan',$data,$id);
		redirect('kendaraan');
	}
	
	public function batalhapus(){
		$id['no_uji'] = $this->uri->segment(3);
		$data=array(
			'aktif' => 1,
		);
		$this->kendaraan->updateData('tbl_kendaraan',$data,$id);
		redirect('kendaraan/approv_hapus');
	}
	
	public function proses_hapuskendaraan(){
		$table = array('tbl_kendaraan','tbl_pengguna','tbl_barang','tbl_kartu_induk','tbl_mutasi','tbl_pendaftaran','tbl_pendaftaran_detail','tbl_pra_pendaftaran','tbl_retribusi','tbl_uji','tbl_uji_foto','tbl_uji_keluar','tbl_uji_riwayat','tbl_surat','tbl_mutasi');
        $id['no_uji'] = $this->uri->segment(3);
        $this->kendaraan->deleteData($table,$id);
        redirect('kendaraan/approv_hapus');
	}
	
	public function approv_hapus(){
		//$this->akses->akses_petugas();
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->kendaraan->getJmlKendaraanHapus();
		$config=array(
			'base_url'=>base_url().'kendaraan/approv_hapus',
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
			'title'=>'Hapus Kendaraan',
			'aktif_persetujuan'=>'active',
			'open_persetujuan'=>'open',
			'persetujuan_hapus'=>'active',
			'dt_kendaraan'=>$this->kendaraan->getKendaraanHapus($config['per_page'],$dari),
			'start'=>$dari,
		);
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('kendaraan/v_kendaraan_hapus');
		$this->load->view('pages/v_footer');
	}
	
	public function get_kendaraan(){
		$id = $this->input->post('no_uji');
		$kendaraan = $this->kendaraan->getDataKend($id);
		echo json_encode($kendaraan);
	}
	
	public function get_jenis_kendaraan(){
		$jenis = $this->input->get('jenis', TRUE);
		$jeniskend = $this->kendaraan->getJenisKendaraan($jenis);
		echo json_encode($jeniskend);
	}
	
	public function get_bentuk_kendaraan(){
		$jenis = $this->input->get('jenis', TRUE);
		$jeniskend = $this->kendaraan->getBentukKendaraan($jenis);
		echo json_encode($jeniskend);
	}
	
	public function get_tipe_kendaraan(){
		$tipe = $this->input->post('tipe');
		$bentuk = $this->input->post('bentuk');
		$kendaraan = $this->kendaraan->getUkuranKendaraan($bentuk,$tipe);
		echo json_encode($kendaraan);
	}
	
	public function cetak_kartu_induk(){
		$id = $this->uri->segment(3);
		$cekqr = $this->kendaraan->getCekQr($id);
		if($cekqr=="1"){
			$this->session->set_flashdata('sukses', '<script>alert("Data kendaraan belum lengkap, silahkan lengkap data kendaraan terlebih dahulu.");</script>');
			redirect('kendaraan/edit/'.$id);
		} else {
			$nokartu = $this->kendaraan->getNoKartu($id);
			$data=array(
				'no_kartu'=>$nokartu,
				'no_uji'=>$id,
				'tgl_cetak'=>date("Y-m-d H:i:s"),
				'keterangan'=>$this->session->userdata('nama')."_".date("Y-m-d H:i:s")."_".$nokartu,
			);
			$this->kendaraan->insertData('tbl_kartu_induk',$data);
			$this->aktifitas_cetak($id);
			$data=array(
				'title'=>"KARTUINDUK_".$id.".pdf",
				'detail_kendaraan'=>$this->kendaraan->getCetakKartuKendaraan($id),
				'dt_foto'=>$this->kendaraan->getLastFoto($id),
			);
			$this->load->view('cetak/v_cetak_kartu_induk_baru',$data);
			//$this->load->view('cetak/v_cetak_kartu_induk',$data);
		}
	}
	
	public function cetak_kartu_induk_baru(){
		//$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$this->aktifitas_cetak($id);
		$data=array(
			'title'=>"KARTUINDUK_".$id.".pdf",
			'detail_kendaraan'=>$this->kendaraan->getCetakKartuKendaraan($id),
		);
		$this->load->view('cetak/v_cetak_kartu_induk_baru',$data);
	}
	
	private function generate_barcode($no_uji, $barcode_type, $scale=6, $fontsize=18, $thickness=30,$dpi=72) {
    // CREATE BARCODE GENERATOR
    // Including all required classes
    require_once( APPPATH . 'libraries/Barcodegen/BCGFontFile.php');
    require_once( APPPATH . 'libraries/Barcodegen/BCGColor.php');
    require_once( APPPATH . 'libraries/Barcodegen/BCGDrawing.php');

    // Including the barcode technology
    // Ini bisa diganti-ganti mau yang 39, ato 128, dll, liat di folder barcodegen
    require_once( APPPATH . 'libraries/Barcodegen/BCGcode39.barcode.php');

    // Loading Font
    // kalo mau ganti font, jangan lupa tambahin dulu ke folder font, baru loadnya di sini
    $font = new BCGFontFile(APPPATH . 'libraries/font/Arial.ttf', $fontsize);
    
    // Text apa yang mau dijadiin barcode, biasanya kode produk
    $text = $no_uji;

    // The arguments are R, G, B for color.
    $color_black = new BCGColor(0, 0, 0);
    $color_white = new BCGColor(255, 255, 255);

    $drawException = null;
    try {
        $code = new BCGcode39(); // kalo pake yg code39, klo yg lain mesti disesuaikan
        $code->setScale($scale); // Resolution
        $code->setThickness($thickness); // Thickness
        $code->setForegroundColor($color_black); // Color of bars
        $code->setBackgroundColor($color_white); // Color of spaces
        $code->setFont($font); // Font (or 0)
        $code->parse($text); // Text
    } catch(Exception $exception) {
        $drawException = $exception;
    }

    /* Here is the list of the arguments
    1 - Filename (empty : display on screen)
    2 - Background color */
    $drawing = new BCGDrawing('', $color_white);
    if($drawException) {
        $drawing->drawException($drawException);
    } else {
        $drawing->setDPI($dpi);
        $drawing->setBarcode($code);
        $drawing->draw();
    }
    // ini cuma labeling dari sisi aplikasi saya, penamaan file menjadi png barcode.
    $filename_img_barcode = $no_uji .'_'.$barcode_type.'.png';
    // folder untuk menyimpan barcode
    $drawing->setFilename( FCPATH . 'files/barcode/'. $filename_img_barcode);
    // proses penyimpanan barcode hasil generate
    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

    return $filename_img_barcode;
	}
	
	private function generate_qrcode($qrcode_data,$no_uji){
		$this->load->library('ciqrcode');
		
		$params['data'] = $qrcode_data;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'files/qrcode/'. $no_uji .'.png';
		$this->ciqrcode->generate($params);
	}
	
	private function aktifitas_tambah($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Membuat data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->kendaraan->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_ubah($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Merubah data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->kendaraan->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_blokir($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Memblokir data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->kendaraan->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_hapus_blokir($id){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Menghapus blokir data '.$this->router->fetch_class().' '.$id,
			'modul'=>$this->router->fetch_method()
		);
		$this->kendaraan->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_cetak($id){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Mencetak data kartu induk '.$this->router->fetch_class().' '.$id,
			'modul'=>$this->router->fetch_method()
		);
		$this->kendaraan->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_batal($id){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Membatalkan '.$this->router->fetch_class().' '.$id,
			'modul'=>$this->router->fetch_method()
		);
		$this->kendaraan->insertData('tbl_log_aktifitas',$aktifitas);
	}
}