<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Akses extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	public function akses_admin(){
		$level = $this->session->userdata('id_akses');
		if($level=='4'){
			redirect('dashboard');
		}
		else if($level=='2'){
			redirect('dashboard');
		}
		else if($level=='1'){
			return;
		}
	}
	
	public function akses_petugas(){
		$level = $this->session->userdata('id_akses');
		if($level=='4'){
			redirect('dashboard');
		}
		else if($level=='2'){
			return;
		}
		else if($level=='1'){
			return;
		}
	}
	
	public function akses_all(){
		$level = $this->session->userdata('id_akses');
		if($level=='4'){
			return;
		}
		else if($level=='2'){
			return;
		}
		else if($level=='1'){
			return;
		}
	}
}