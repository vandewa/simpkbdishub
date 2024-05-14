<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_pengujian');
		$this->load->model('model_dashboard','dashboard');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function index(){
		$data=array(
			'aktif_dashboard'=>'active',
			'title'=>'Dashboard',
			//'dt_retribusi'=>$this->model->getRetribusi(),
			//'dt_total_retribusi'=>$this->model->getTotalRetribusi(),
			//'dt_pendaftaran'=>$this->model->getPendaftaran(),
			'dt_pelayanan'=>$this->dashboard->getPelayanan(),
			'dt_kbwu'=>$this->dashboard->getDashboardKbwu(),
			'dt_kbwu_habis'=>$this->dashboard->getDashboardHbsUji(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pages/v_dashboard');
		$this->load->view('pages/v_footer');
	}
	
	public function kirim_pesan(){
		$data=array(
			'id_user'=>$this->session->userdata('id_user'),
			'pesan'=>$this->input->post('pesan'),
		);
		$this->model_app->insertData('tbl_chat',$data);
		redirect("");
	}
	
}