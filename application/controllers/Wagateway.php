<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Wagateway extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_wagateway','wagateway');
		$this->load->library('pagination');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function index(){
		$data=array(
			'title'=>'WhatsApp Gateway',
			'aktif_wagateway'=>'active',
			'open_wagateway'=>'open',
			'wagateway_status'=>'active',
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('wagateway/v_status');
		$this->load->view('pages/v_footer');
	}
	
	public function inbox(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};

		$num = $this->wagateway->getJmlPesanMasuk();
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
			'title'=>'WhatsApp Gateway - Pesan Masuk',
			'aktif_wagateway'=>'active',
			'open_wagateway'=>'open',
			'wagateway_inbox'=>'active',
			'dt_pesan'=>$this->wagateway->getPesanMasuk($config['per_page'],$dari),
			'start'=>$dari,
		);

		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('wagateway/v_pesan_masuk');
		$this->load->view('pages/v_footer');
	}
	
	public function lihatpesan(){
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Lihat Pesan',
			'aktif_wagateway'=>'active',
			'open_wagateway'=>'open',
			'wagateway_inbox'=>'active',
			'phone'=>$id,
			'dt_pesan'=>$this->wagateway->getLihatPesan($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('wagateway/v_lihat_pesan');
		$this->load->view('pages/v_footer');
	}
	
	public function outbox(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};

		$num = $this->wagateway->getJmlPesanKeluar();
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
			'title'=>'WhatsApp Gateway - Pesan Keluar',
			'aktif_wagateway'=>'active',
			'open_wagateway'=>'open',
			'wagateway_outbox'=>'active',
			'dt_pesan'=>$this->wagateway->getPesanKeluar($config['per_page'],$dari),
			'start'=>$dari,
		);

		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('wagateway/v_pesan_keluar');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_outbox(){
		$message = $this->input->post('message');
		$penerima = $this->input->post('jenis_penerima');
		if($penerima=="SEMUA"){
			$dt_penerima = $this->wagateway->getDataWhatsapp();
			foreach($dt_penerima as $row){
			$phone = $row->telp;
				$data=array(
					'phone' => $phone,
					'message' => $message,
					'jeniswa' => 'KELUAR',
				);
				$this->wagateway->insertData('tbl_wagateway',$data);
				//$this->kirim_pesankeluar($phone,$message);
			}
		} else if(($penerima=="PILIH") || ($penerima=="TULIS")){
			$phone = $this->input->post('phone');
			$data=array(
				'phone' => $phone,
				'message' => $message,
				'jeniswa' => 'KELUAR',
			);
			$this->wagateway->insertData('tbl_wagateway',$data);
			//$this->kirim_pesankeluar($phone,$message);
		}
		redirect('wagateway/outbox');
	}
	
	public function hapuspesan(){
		$idx['idx'] = $this->uri->segment(3);
		$table = array('tbl_wagateway');
        $this->wagateway->deleteData($table,$idx);
		redirect('wagateway/outbox');
	}
	
	private function kirim_pesankeluar($phone,$message){
		$pertama = mb_substr($phone, 0, 1);
		if($pertama=="0"){
			$telp = substr_replace($phone,'62',0,1);
		} else {
			$telp = $phone;
		}
		
		$setting = $this->wagateway->getAllData('tbl_setting');
		foreach ($setting as $row){
			$api = $row->api_wa;
			$sender = $row->no_wa;
		}

		$data = [
			'api_key' => $api,
			'sender'  => $sender,
			'number'  => $telp,
			'message' => $message,
		];

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
	}
	
	public function get_jenispenerima(){
		$id = $this->input->get('id', TRUE);
		$data=array(
			'dt_wa'=>$this->wagateway->getDataWhatsapp(),
			'id'=>$id,
		);
		$this->load->view('wagateway/v_ajax_jenispenerima',$data);
	}
	
	public function crontab(){
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};

		$num = $this->wagateway->getJmlCronlog();
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
			'title'=>'WhatsApp Gateway - Cronlog',
			'aktif_wagateway'=>'active',
			'open_wagateway'=>'open',
			'wagateway_crontab'=>'active',
			'dt_cronlog'=>$this->wagateway->getAllCronlog($config['per_page'],$dari),
			'start'=>$dari,
		);

		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('wagateway/v_cronlog');
		$this->load->view('pages/v_footer');
	}
}