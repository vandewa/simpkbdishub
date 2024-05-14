<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_app');
		$this->load->helper('date');
	}
	
	public function index(){
		
	}
	
	public function page_not_found(){
		$data = array(
			'title'=>"Halaman Tidak Tersedia",
			'now'=>time(),
		);
		$this->load->view('pages/v_404',$data);
	}
}