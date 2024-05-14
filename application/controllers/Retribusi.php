<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Retribusi extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_retribusi','retribusi');
		$this->load->model('akses');
		$this->load->library('pagination');
		$this->load->library('cart');
		$this->load->library('fpdf');
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
		
		$num = $this->retribusi->getJmlRetribusi();
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
			'title'=>'Rekap Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'rekap_retribusi'=>'active',
			'dt_retribusi'=>$this->retribusi->getDaftarRetribusi($config['per_page'],$dari),
			'start'=>$dari,
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_retribusi');
		$this->load->view('pages/v_footer');
	}
	
	public function cari(){
		$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Rekap Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'rekap_retribusi'=>'active',
			'dt_retribusi'=>$this->retribusi->getCariRetribusi($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_retribusi');
		$this->load->view('pages/v_footer');
	}
	
	public function rekap_tanggal(){
		$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Rekap Retribusi',
			'aktif_retribusi'=>'active',
			'open_retribusi'=>'open',
			'rekap_retribusi'=>'active',
			'dt_retribusi'=>$this->retribusi->getRekapTanggalRetribusi($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('retribusi/v_retribusi');
		$this->load->view('pages/v_footer');
	}
	
	public function prosespembayaran(){
		$id['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'noreff'=>$this->input->post('noreff'),
			'tgl_reff'=>$this->input->post('tgl_reff'),
			'status_bayar'=>1,
		);
		$this->retribusi->updateData('tbl_retribusi',$data,$id);
		redirect('retribusi');
	}
	
	public function cetak(){
		$idx['id_user'] = $this->session->userdata('id_user');
		$id = $this->uri->segment(3);
		$antrian = $this->retribusi->getCetakAntrian($id);
		foreach($antrian as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>"ANTRIAN_".$id.".pdf",
			'dt_antrian'=>$antrian,
			'dt_printer'=>$this->retribusi->getSelectedData('tbl_printer_setting',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_antrian_php',$data);
	}
	
	public function cetaklunas(){
		$idx['id_user'] = $this->session->userdata('id_user');
		$id = $this->uri->segment(3);
		$antrian = $this->retribusi->getCetakAntrian($id);
		foreach($antrian as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>"ANTRIAN_".$id.".pdf",
			'dt_antrian'=>$antrian,
			'dt_printer'=>$this->retribusi->getSelectedData('tbl_printer_setting',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_antrian_lunas',$data);
	}
	
	private function aktifitas_cetak($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Mencetak data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->retribusi->insertData('tbl_log_aktifitas',$aktifitas);
	}
}