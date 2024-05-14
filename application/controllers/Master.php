<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_master','master');
		$this->load->model('model_kendaraan','kendaraan');
		$this->load->model('akses');
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->helper('date');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function pemohon(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->master->getJmlPemohon();
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
			'title'=>'Rekap Pemohon',
			'aktif_user'=>'active',
			'open_master'=>'open',
			'rekap_pemohon'=>'active',
			'data_pemohon'=>$this->master->getDaftarPemohon($config['per_page'],$dari),
			'start'=>$dari,
		);
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_rekap_pemohon');
		$this->load->view('pages/v_footer');
	}
	
	public function caripemohon(){
		$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Rekap Pemohon',
			'aktif_user'=>'active',
			'open_master'=>'open',
			'rekap_pemohon'=>'active',
			'data_pemohon'=>$this->master->getCariPemohon($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_rekap_pemohon');
		$this->load->view('pages/v_footer');
	}
	
	public function penguji(){
		$data=array(
			'title'=>'Rekap Penguji',
			'aktif_user'=>'active',
			'open_master'=>'open',
			'rekap_penguji'=>'active',
			'data_penguji'=>$this->master->getAllData('penguji'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_rekap_penguji');
		$this->load->view('pages/v_footer');
	}
	
	public function disablepenguji(){
		$id['idx'] = $this->uri->segment(3);
		$data=array(
			'flag_aktif' => 0,
		);
		$this->master->updateData('penguji',$data,$id);
		redirect('master/penguji');
	}
	
	public function enablepenguji(){
		$id['idx'] = $this->uri->segment(3);
		$data=array(
			'flag_aktif' => 1,
		);
		$this->master->updateData('penguji',$data,$id);
		redirect('master/penguji');
	}
	
	public function editpenguji(){
		$id = $this->uri->segment(3);
		$idx['idx'] = $this->uri->segment(3);
		$data=array(
			'nrp'=>$this->input->post('nrp'),
			'nama'=>$this->input->post('nama'),
			'pangkat'=>$this->input->post('pangkat'),
			'ttd'=>'penguji_'.$id,
		);
		
		$_FILES['files']['name'] = $_FILES['ttd']['name'];
		$_FILES['files']['type'] = $_FILES['ttd']['type'];
		$_FILES['files']['tmp_name'] = $_FILES['ttd']['tmp_name'];
		$_FILES['files']['error'] = $_FILES['ttd']['error'];
		$_FILES['files']['size'] = $_FILES['ttd']['size'];
		
		$config=array(
			'file_name'=>'penguji_'.$id,
			'upload_path'=>'./files/ttd',
			'allowed_types'=>'jpg|png|jpeg|bmp',
			'max_size'=>'0',
			'overwrite'=>TRUE,
		);
		$this->upload->initialize($config);
		if($this->upload->do_upload('files')){
			$upload = $this->upload->data();
		}
	
		$this->master->updateData('penguji',$data,$idx);
		redirect('master/penguji');
	}
	
	public function operator(){
		$data=array(
			'title'=>'Rekap Operator SIM PKB',
			'aktif_user'=>'active',
			'open_master'=>'open',
			'master_operator'=>'active',
			'dt_penguji'=>$this->master->getAllData('penguji'),
			'data_operator'=>$this->master->getDataOperator(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_rekap_operator');
		$this->load->view('pages/v_footer');
	}
	
	function tambahoperator(){
		$id_user = "ADM-".time();
		$tgl_aktif = date('Y-m-d H:i:s');
		$data=array(
			'id_user'=>$id_user,
			'nip'=>$this->input->post('nip'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'telp'=>$this->input->post('telp'),
			'email'=>$this->input->post('email'),
		);
		$user=array(
			'id_user'=>$id_user,
			'id_akses'=>$this->input->post('akses'),
			'username'=>$this->input->post('username'),
			'password'=>$this->bcrypt->hash_password($this->input->post('password')),
			'tgl_aktif'=>$tgl_aktif,
		);
		$printer=array(
			'id_user'=>$id_user,
		);
		$this->master->insertData('tbl_admin',$data);
		$this->master->insertData('tbl_user',$user);
		$this->master->insertData('tbl_printer_setting',$printer);
		redirect('master/operator');
	}
	
	public function editoperatordata(){
		$id['id_user'] = $this->uri->segment(3);
		$data=array(
			'nip'=>$this->input->post('nip'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'telp'=>$this->input->post('telp'),
			'email'=>$this->input->post('email'),
		);
		$user=array(
			'id_penguji'=>$this->input->post('penguji'),
		);
		$this->master->updateData('tbl_admin',$data,$id);
		$this->master->updateData('tbl_user',$user,$id);
		redirect('master/operator');
	}
	
	public function editoperatorpassword(){
		$id['id_user'] = $this->uri->segment(3);
		$user=array(
			'username'=>$this->input->post('username'),
			'password'=>$this->bcrypt->hash_password($this->input->post('password')),
		);
		$this->master->updateData('tbl_user',$user,$id);
		redirect('master/operator');
	}
	
	public function hapusoperator(){
		$id['id_user'] = $this->uri->segment(3);
		$table = array('tbl_admin','tbl_user');
        $this->master->deleteData($table,$id);
		redirect('master/operator');
	}
	
	public function admin(){
		$data=array(
			'title'=>'Rekap Admin SIM PKB',
			'aktif_user'=>'active',
			'open_master'=>'open',
			'master_admin'=>'active',
			'data_admin'=>$this->master->getDataAdmin(),
			'now'=>time(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_rekap_admin');
		$this->load->view('pages/v_footer');
	}
	
	function tambahadmin(){
		$id_user = "ADM-".time();
		$tgl_aktif = date('Y-m-d H:i:s');
		$data=array(
			'id_user'=>$id_user,
			'nip'=>$this->input->post('nip'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'telp'=>$this->input->post('telp'),
			'email'=>$this->input->post('email'),
		);
		$user=array(
			'id_user'=>$id_user,
			'id_akses'=>1,
			'username'=>$this->input->post('username'),
			'password'=>$this->bcrypt->hash_password($this->input->post('password')),
			'tgl_aktif'=>$tgl_aktif,
		);
		$printer=array(
			'id_user'=>$id_user,
		);
		$this->master->insertData('tbl_admin',$data);
		$this->master->insertData('tbl_user',$user);
		$this->master->insertData('tbl_printer_setting',$printer);
		redirect('master/admin');
	}
	
	public function editadmin(){
		$id['id_user'] = $this->uri->segment(3);
		$data=array(
			'nip'=>$this->input->post('nip'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'telp'=>$this->input->post('telp'),
			'email'=>$this->input->post('email'),
		);
		$user=array(
			'username'=>$this->input->post('username'),
			'password'=>$this->bcrypt->hash_password($this->input->post('password')),
		);
		$this->master->updateData('tbl_admin',$data,$id);
		$this->master->updateData('tbl_user',$user,$id);
		redirect('master/admin');
	}
	
	public function hapusadmin(){
		$id['id_user'] = $this->uri->segment(3);
		$table = array('tbl_admin','tbl_user');
        $this->master->deleteData($table,$id);
		redirect('master/admin');
	}
	
	public function tarif(){
		$this->akses->akses_admin();
		$data=array(
			'title'=>'Tarif Retribusi',
			'open_master'=>'open',
			'master_retribusi'=>'active',
			'dt_jenis'=>$this->master->getAllData('tbl_kendaraan_jenis'),
			'dt_retribusi'=>$this->master->getAllData('tbl_retribusi_tarif'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_retribusi_tarif');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahtarif(){
		$this->akses->akses_admin();
		$data=array(	
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'jenis_retribusi'=>$this->input->post('jenis_retribusi'),
			'jenis'=>$this->input->post('jenis'),
			'nama_retribusi'=>$this->input->post('nama_retribusi'),
			'jbb_awal'=>$this->input->post('jbb_awal'),
			'jbb_akhir'=>$this->input->post('jbb_akhir'),
			'tarif'=>$this->input->post('tarif')
		);
		$this->master->insertData('tbl_retribusi_tarif',$data);
		redirect('master/tarif');
	}
	
	public function edittarif(){
		$this->akses->akses_admin();
		$id['kd_tarif'] = $this->uri->segment(3);
		$data=array(
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'jenis_retribusi'=>$this->input->post('jenis_retribusi'),
			'jenis'=>$this->input->post('jenis'),
			'nama_retribusi'=>$this->input->post('nama_retribusi'),
			'jbb_awal'=>$this->input->post('jbb_awal'),
			'jbb_akhir'=>$this->input->post('jbb_akhir'),
			'tarif'=>$this->input->post('tarif')
		);
		$this->master->updateData('tbl_retribusi_tarif',$data,$id);
		redirect('master/tarif');
	}
	
	public function hapustarif(){
		$this->akses->akses_admin();
		$id['kd_tarif'] = $this->uri->segment(3);
        $this->master->deleteData('tbl_retribusi_tarif',$id);
        redirect('master/tarif');
	}
	
	public function bahan_bakar(){
		$data=array(
			'title'=>'Master Bahan Bakar',
			'aktif_master'=>'active',
			'open_master'=>'open',
			'master_bahanbakar'=>'active',
			'dt_bahanbakar'=>$this->master->getAllData('tbl_bahan_bakar'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_bahanbakar');
		$this->load->view('pages/v_footer');
	}
	
	function tambah_bahanbakar(){
		$data=array(
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
		);
		$this->master->insertData('tbl_bahan_bakar',$data);
		redirect('master/bahan_bakar');
	}
	
	public function edit_bahanbakar(){
		$id['id_bahan_bakar'] = $this->uri->segment(3);
		$data=array(
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
		);
		$this->master->updateData('tbl_bahan_bakar',$data,$id);
		redirect('master/bahan_bakar');
	}
	
	public function hapus_bahanbakar(){
		$id['id_bahan_bakar'] = $this->uri->segment(3);
		$table = array('tbl_bahan_bakar');
        $this->master->deleteData($table,$id);
		redirect('master/bahan_bakar');
	}
	
	public function jenis_kendaraan(){
		$data=array(
			'title'=>'Master Jenis Kendaraan',
			'aktif_master'=>'active',
			'open_master'=>'open',
			'master_jeniskendaraan'=>'active',
			'dt_jenis'=>$this->master->getAllData('tbl_kendaraan_jenis'),
			'dt_jeniskendaraan'=>$this->master->getJenisKendaraan(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_jeniskendaraan');
		$this->load->view('pages/v_footer');
	}
	
	function tambah_jeniskendaraan(){
		$data=array(
			'id_jenis'=>$this->input->post('jenis'),
			'kategori'=>$this->input->post('kategori'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'kode_jenis_kendaraan'=>$this->input->post('kode_jenis_kendaraan'),
		);
		$this->master->insertData('tbl_jenis_kendaraan',$data);
		redirect('master/jenis_kendaraan');
	}
	
	public function edit_jeniskendaraan(){
		$id['id_jenis_kendaraan'] = $this->uri->segment(3);
		$data=array(
			'id_jenis'=>$this->input->post('jenis'),
			'kategori'=>$this->input->post('kategori'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'kode_jenis_kendaraan'=>$this->input->post('kode_jenis_kendaraan'),
		);
		$this->master->updateData('tbl_jenis_kendaraan',$data,$id);
		redirect('master/jenis_kendaraan');
	}
	
	public function hapus_jeniskendaraan(){
		$id['id_jenis_kendaraan'] = $this->uri->segment(3);
		$table = array('tbl_jenis_kendaraan');
        $this->master->deleteData($table,$id);
		redirect('master/jenis_kendaraan');
	}
	
	public function pejabat(){
		$data=array(
			'title'=>'Master Pejabat',
			'aktif_master'=>'active',
			'open_master'=>'open',
			'master_pejabat'=>'active',
			'dt_pejabat'=>$this->master->getAllData('tbl_pejabat'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_pejabat');
		$this->load->view('pages/v_footer');
	}
	
	function tambah_pejabat(){
		$data=array(
			'nip'=>$this->input->post('nip'),
			'nama'=>$this->input->post('nama'),
			'pangkat'=>$this->input->post('pangkat'),
			'jabatan'=>$this->input->post('jabatan'),
			'nama_jabatan'=>$this->input->post('nama_jabatan'),
		);
		$this->master->insertData('tbl_pejabat',$data);
		redirect('master/pejabat');
	}
	
	public function edit_pejabat(){
		$id['id_pejabat'] = $this->uri->segment(3);
		$data=array(
			'nip'=>$this->input->post('nip'),
			'nama'=>$this->input->post('nama'),
			'pangkat'=>$this->input->post('pangkat'),
			'jabatan'=>$this->input->post('jabatan'),
			'nama_jabatan'=>$this->input->post('nama_jabatan'),
			'aktif'=>$this->input->post('status'),
		);
		$this->master->updateData('tbl_pejabat',$data,$id);
		redirect('master/pejabat');
	}
	
	public function hapus_pejabat(){
		$id['id_pejabat'] = $this->uri->segment(3);
		$table = array('tbl_pejabat');
        $this->master->deleteData($table,$id);
		redirect('master/pejabat');
	}
	
	public function master_kendaraan(){
		//$this->akses->akses_petugas();
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->kendaraan->getJmlMasterKendaraan();
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
			'title'=>'Master Kendaraan',
			'master_kendaraan'=>'active',
			'open_master'=>'open',
			'master_kendaraan'=>'active',
			'dt_kendaraan'=>$this->kendaraan->getAllDataMasKendaraan($config['per_page'],$dari),
			'start'=>$dari,
		);
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_master_kendaraan');
		$this->load->view('pages/v_footer');
	}
	
	public function tambah_master_kendaraan(){
		//$this->akses->akses_petugas();
		$data=array(
			'title'=>'Tambah Master Kendaraan',
			'master_kendaraan'=>'active',
			'open_master'=>'open',
			'master_kendaraan'=>'active',
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_master_kendaraan_tambah');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_tambah_master_kendaraan(){
		$kendaraan=array(
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'jenis'=>$this->input->post('jenis'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'bentuk'=>$this->input->post('bentuk'),
			'isi_silinder'=>$this->input->post('isi_silinder'),
			'daya_motor'=>$this->input->post('daya_motor'),
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
			'nama_komersiil'=>$this->input->post('nama_komersiil'),
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
			'da_orang'=>$this->input->post('da_orang'),
			'jml_da_orang'=>$this->input->post('jml_da_orang'),
			'da_barang'=>$this->input->post('da_barang'),
			'jbi'=>$this->input->post('jbi'),
			'jbi_kombinasi'=>$this->input->post('jbi_kombinasi'),
			'mst'=>$this->input->post('mst'),
			'kelas_jalan'=>$this->input->post('kelas_jalan'),
		);
		$this->kendaraan->insertData('tbl_kendaraan_master',$kendaraan);
		redirect('master/master_kendaraan');
	}
	
	public function edit_master_kendaraan(){
		//$this->akses->akses_petugas();
		$id['id_kendaraan'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Edit Master Kendaraan',
			'master_kendaraan'=>'active',
			'open_master'=>'open',
			'master_kendaraan'=>'active',
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
			'detail_kendaraan'=>$this->kendaraan->getSelectedData('tbl_kendaraan_master',$id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_master_kendaraan_edit');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_edit_master_kendaraan(){
		$id_kendaraan['id_kendaraan'] = $this->uri->segment(3);
		$kendaraan=array(
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'jenis'=>$this->input->post('jenis'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'bentuk'=>$this->input->post('bentuk'),
			'isi_silinder'=>$this->input->post('isi_silinder'),
			'daya_motor'=>$this->input->post('daya_motor'),
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
			'nama_komersiil'=>$this->input->post('nama_komersiil'),
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
			'da_orang'=>$this->input->post('da_orang'),
			'jml_da_orang'=>$this->input->post('jml_da_orang'),
			'da_barang'=>$this->input->post('da_barang'),
			'jbi'=>$this->input->post('jbi'),
			'jbi_kombinasi'=>$this->input->post('jbi_kombinasi'),
			'mst'=>$this->input->post('mst'),
			'kelas_jalan'=>$this->input->post('kelas_jalan'),
		);
		$this->kendaraan->updateData('tbl_kendaraan_master',$kendaraan,$id_kendaraan);
		redirect('master/master_kendaraan');
	}
	
	public function hapus_master_kendaraan(){
		$table = array('tbl_kendaraan_master');
        $id['id_kendaraan'] = $this->uri->segment(3);
        $this->kendaraan->deleteData($table,$id);
        redirect('master/master_kendaraan');
	}
	
	public function kecamatan(){
		$data=array(
			'title'=>'Master Kecamatan',
			'aktif_master'=>'active',
			'open_master'=>'open',
			'master_kecamatan'=>'active',
			'dt_kecamatan'=>$this->master->getAllData('tbl_kecamatan'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_kecamatan');
		$this->load->view('pages/v_footer');
	}
	
	function tambah_kecamatan(){
		$data=array(
			'kecamatan'=>$this->input->post('kecamatan'),
		);
		$this->master->insertData('tbl_kecamatan',$data);
		redirect('master/kecamatan');
	}
	
	public function edit_kecamatan(){
		$id['id_kecamatan'] = $this->uri->segment(3);
		$data=array(
			'kecamatan'=>$this->input->post('kecamatan'),
		);
		$this->master->updateData('tbl_kecamatan',$data,$id);
		redirect('master/kecamatan');
	}
	
	public function hapus_kecamatan(){
		$id['id_kecamatan'] = $this->uri->segment(3);
		$table = array('tbl_kecamatan');
        $this->master->deleteData($table,$id);
		redirect('master/kecamatan');
	}
	
	public function kerusakan(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->master->getJmlKerusakan();
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
			'title'=>'Master Kerusakan',
			'aktif_master'=>'active',
			'open_master'=>'open',
			'master_kerusakan'=>'active',
			'dt_kerusakan'=>$this->master->getDataKerusakan($config['per_page'],$dari),
			'start'=>$dari,
		);
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_kerusakan');
		$this->load->view('pages/v_footer');
	}
	
	function tambah_kerusakan(){
		$data=array(
			'kategori_kerusakan'=>$this->input->post('kategori_kerusakan'),
			'kerusakan'=>$this->input->post('kerusakan'),
		);
		$this->master->insertData('tbl_kerusakan',$data);
		redirect('master/kerusakan');
	}
	
	public function edit_kerusakan(){
		$id['id_kerusakan'] = $this->uri->segment(3);
		$data=array(
			'kategori_kerusakan'=>$this->input->post('kategori_kerusakan'),
			'kerusakan'=>$this->input->post('kerusakan'),
		);
		$this->master->updateData('tbl_kerusakan',$data,$id);
		redirect('master/kerusakan');
	}
	
	public function hapus_kerusakan(){
		$id['id_kerusakan'] = $this->uri->segment(3);
		$table = array('tbl_kerusakan');
        $this->master->deleteData($table,$id);
		redirect('master/kerusakan');
	}
	
	public function printer(){
		$data=array(
			'title'=>'Master Printer',
			'aktif_master'=>'active',
			'open_master'=>'open',
			'master_printer'=>'active',
			'dt_printer'=>$this->master->getAllData('tbl_printer'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('master/v_printer');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahprinter(){
		$data=array(
			'ip_printer'=>$this->input->post('ip_printer'),
			'nama_printer'=>$this->input->post('nama_printer'),
		);
		$this->master->insertData('tbl_printer',$data);
		redirect('master/printer');
	}
	
	public function editprinter(){
		$id['id_printer'] = $this->uri->segment(3);
		$data=array(
			'ip_printer'=>$this->input->post('ip_printer'),
			'nama_printer'=>$this->input->post('nama_printer'),
		);
		$this->master->updateData('tbl_printer',$data,$id);
		redirect('master/printer');
	}
	
	public function hapus_printer(){
		$id['id_printer'] = $this->uri->segment(3);
		$table = array('tbl_printer');
        $this->master->deleteData($table,$id);
		redirect('master/printer');
	}
	
	public function carideleted(){
		//$this->akses->akses_admin();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Rekap User Tidak Aktif',
			'aktif_user'=>'active',
			'open_user'=>'open',
			'rekap_deleted'=>'active',
			'cari_user'=>$this->master->getCariDeletedUser($match),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('user/v_cari_user_deleted');
		$this->load->view('pages/v_footer');
	}
	
	public function deleteduser(){
		//$this->akses->akses_admin();
		$data=array(
			'title'=>'Rekap User Tidak Aktif',
			'aktif_user'=>'active',
			'open_user'=>'open',
			'rekap_deleted'=>'active',
			'data_deleted'=>$this->master->getDataDeletedUser(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('user/v_rekap_deleted_user');
		$this->load->view('pages/v_footer');
	}
	
	public function aktifkanuser(){
		//$this->akses->akses_admin();
		$id['id_user'] = $this->uri->segment(3);
		$data=array(
			'aktif' => 1,
		);
		$this->master->updateData('tbl_user',$data,$id);
		$this->master->updateData('tbl_admin',$data,$id);
		redirect('user/deleteduser');	
	}
	
	public function hapusdata(){
		$table = array('tbl_user','tbl_admin');
		$id['id_user'] = $this->uri->segment(3);
		$this->master->deleteData($table,$id);
		redirect('user/deleteduser');
	}
	
	
}