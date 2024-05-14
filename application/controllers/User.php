<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_app');
		$this->load->model('model_user','user');
		$this->load->model('akses');
		$this->load->library('datatables');
		$this->load->library('pagination');
		$this->load->helper('date');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function profile(){
		//$this->akses->akses_all();
		$id = $this->session->userdata('id_user');
		$idx['id_user'] = $this->session->userdata('id_user');
		$data=array(
			'title'=>'Profile User',
			'data_user'=>$this->model_app->getUser($id),
			'data_printset'=>$this->model_app->getSelectedData('tbl_printer_setting',$idx)->result(),
			'data_printer'=>$this->model_app->getAlldata('tbl_printer'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('user/v_profile_user');
		$this->load->view('pages/v_footer');
	}
	
	public function updateprofile(){
		//$this->akses->akses_all();
		$id['id_user'] = $this->session->userdata('id_user');
        $data=array(
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),			
			'email' => $this->input->post('email'),
			'telp' => $this->input->post('telp'),
        );
        $this->model_app->updateData('tbl_admin',$data,$id);
        redirect('user/profile');
	}
	
	public function updatepassword(){
		//$this->akses->akses_all();
		$id['id_user']= $this->session->userdata('id_user');
        $data=array(
			'username'=> $this->input->post('username'),
			'password'=> $this->bcrypt->hash_password($this->input->post('newpass')),
        );
        $this->model_app->updateData('tbl_user',$data,$id);
        redirect('user/profile');
	}
	
	public function simpanprinter(){
		$id = $this->uri->segment(3);
		$idx['id_user'] = $this->uri->segment(3);
		$data=array(
			'pendaftaran'=>$this->input->post('ip_print_daftar'),
			'pembayaran'=>$this->input->post('ip_print_bayar'),
			'stiker'=>$this->input->post('ip_print_stiker'),
			'buku_uji'=>$this->input->post('ip_print_buku'),
			'kartu_induk'=>$this->input->post('ip_print_kartu'),
			'surat'=>$this->input->post('ip_print_surat'),
		);
		$this->model_app->updateData('tbl_printer_setting',$data,$idx);
		redirect('user/profile');
	}
	
	public function carideleted(){
		//$this->akses->akses_admin();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Rekap User Tidak Aktif',
			'aktif_user'=>'active',
			'open_master'=>'open',
			'rekap_deleted'=>'active',
			'cari_user'=>$this->model_app->getCariDeletedUser($match),
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
			'open_master'=>'open',
			'rekap_deleted'=>'active',
			'data_deleted'=>$this->model_app->getDataDeletedUser(),
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
		$this->model_app->updateData('tbl_user',$data,$id);
		$this->model_app->updateData('tbl_admin',$data,$id);
		redirect('user/deleteduser');	
	}
	
	public function hapusdata(){
		$table = array('tbl_user','tbl_admin');
		$id['id_user'] = $this->uri->segment(3);
		$this->model_app->deleteData($table,$id);
		redirect('user/deleteduser');
	}
	
	
}