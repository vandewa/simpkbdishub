<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_login');
		$this->load->model('model_app');
		$this->load->library('image_lib');
		$this->load->library('form_validation');
		$this->load->helper('captcha');
	}
	
	public function index(){		
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('captcha', "Kode keamanan", 'required|callback_captchacheck');

		if($this->form_validation->run()== FALSE){
 
			$original_string = array_merge(range(0,9));
			$original_string = implode("", $original_string);
			$captcha = substr(str_shuffle($original_string), 0, 6);
			
            $vals = array(
                'word' => $captcha,
                'img_path'	 => './files/captcha/',
				'img_url'	 => base_url().'files/captcha/',
				'font_path' => BASEPATH.'fonts/texb.ttf',
                'img_width'	 => '150',
                'img_height' => 34,
                'border' => 0, 
                'expiration' => 3600
            );
			
			$cap = create_captcha($vals);
			$img['image'] = $cap['image'];
			$this->session->set_userdata('mycaptcha', $cap['word']);

			$this->load->view('pages/v_login',array('title'=>'Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Tegal','image'=>$this->img['image']= $cap['image']));
		}
		
		else{
			$result = $this->login_user();
 
			$original_string = array_merge(range(0,9));
			$original_string = implode("", $original_string);
			$captcha = substr(str_shuffle($original_string), 0, 6);
			
            $vals = array(
                'word' => $captcha,
                'img_path'	 => './files/captcha/',
				'img_url'	 => base_url().'files/captcha/',
				'font_path' => BASEPATH.'fonts/texb.ttf',
                'img_width'	 => '150',
                'img_height' => 34,
                'border' => 0, 
                'expiration' => 3600
            );
			
			$cap = create_captcha($vals);
			$img['image'] = $cap['image'];
			$this->session->set_userdata('mycaptcha', $cap['word']);
			
			switch ($result){
				case 'login_sukses':
					redirect('dashboard','refresh');
				break;

				case 'password_salah':
					$this->load->view('pages/v_login',array('error' => 'Login gagal!!! Periksa kembali username dan password anda.','title'=>'Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Tegal','image'=>$this->img['image']= $cap['image']));
				break;
				
				case 'akun_tidak_aktif':
					$this->load->view('pages/v_login',array('error' => 'Login gagal!!! Akun tidak aktif. Silahkan aktivasi akun anda terlebih dahulu.','title'=>'Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Tegal','image'=>$this->img['image']= $cap['image']));
				break;
				
				case 'akun_tidak_ditemukan':
					$this->load->view('pages/v_login',array('error' => 'Login gagal!!! Akun tidak ditemukan. Periksa kembali username dan password anda.','title'=>'Sistem Informasi Pengujian Kendaraan Bermotor Kabupaten Tegal','image'=>$this->img['image']= $cap['image']));
				break;
			}			
		}
	}
	
	public function captchacheck(){
		$cap = $this->input->post('captcha');
		$capt = $this->session->userdata('mycaptcha');
		if($capt == $cap){
			return true;
		} else {
			 $this->form_validation->set_message('captchacheck','Kode keamanan tidak sama.');
			return false;
		}
	}
	
	private function login_user(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$sql = "SELECT * FROM tbl_user a inner join tbl_admin b ON a.id_user=b.id_user inner join tbl_akses c ON a.id_akses=c.id_akses WHERE username =".$this->db->escape($username)." LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		
		if ($result->num_rows() === 1){
			if($row->aktif == 1){
				if($this->bcrypt->check_password($password,$row->password)){
					$id['id_user'] = $row->id_user;
					$tgl_login = date('Y-m-d H:i:s');
					$login=array(
						'last_login'=>$tgl_login,
					);
					$this->model_app->updateData('tbl_user',$login,$id);
					$session_data = array(
						'id_user' => $row->id_user,
						'id_akses' => $row->id_akses,
						'id_penguji' => $row->id_penguji,
						'nama' => $row->nama,
						'username' => $row->username,
						'akses' => $row->akses,
					);
					$this->set_session($session_data);
					$this->aktifitas_login($session_data);
					return 'login_sukses';
				} else{
					return 'password_salah';
					}
			} else {
				return 'akun_tidak_aktif';
				}
		} else {
			return 'akun_tidak_ditemukan';
		}
	}
	
	private function set_session($session_data){
		$sess_data = array(
					'id_user' => $session_data['id_user'],
					'id_akses' => $session_data['id_akses'],
					'id_penguji' => $session_data['id_penguji'],
					'nama' => $session_data['nama'],
					'username' => $session_data['username'],
					'akses' => $session_data['akses'],
					'login' => 1
					);
		$this->session->set_userdata($sess_data);
	}
	
	private function aktifitas_login($session_data){
		$aktifitas = array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Login dari IP '.$this->input->ip_address(),
			'modul'=>$this->router->fetch_method()
		);
		$this->db->insert('tbl_log_aktifitas',$aktifitas);
	}
		
	function logout(){
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('id_akses');
		$this->session->unset_userdata('id_penguji');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('akses');
		$this->session->unset_userdata('login');
		$this->session->sess_destroy();
		redirect('');
	}
}