<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktifitas extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_app');
		$this->load->model('akses');
		$this->load->helper('date');
		$this->load->library('encryption');
		$this->load->library('pagination');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function index(){
		$this->akses->akses_petugas();
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->model_app->getJmlAktifitas();
		$config=array(
			'base_url'=>base_url().'aktifitas/index/',
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
			'title'=>'Log Aktifitas',
			'data_aktifitas'=>$this->model_app->getAllAktifitas($config['per_page'],$dari),
			'now'=>time()
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('aktifitas/v_log_aktifitas');
		$this->load->view('pages/v_footer');
	}
	
	public function cari(){
		$kategori = $this->input->post('kategori');
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Cari Aktifitas',
			'cari_aktifitas'=>$this->model_app->getCariAktifitas($kategori, $match),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('aktifitas/v_cari_log_aktifitas');
		$this->load->view('pages/v_footer');
	}
}