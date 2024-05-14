<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_login extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	public function login_user(){
		$no_kendaraan = $this->input->post('no_kendaraan');
		$password = $this->input->post('password');
		
		$sql = "SELECT id_user, no_ktp, no_uji, no_kendaraan, nama, email, level,password, aktif FROM tbl_pengguna WHERE no_kendaraan ='{$no_kendaraan}' OR no_ktp ='{$no_kendaraan}' OR no_uji ='{$no_kendaraan}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		
		if ($result->num_rows() === 1){
			if ($row->aktif) {
				if($this->bcrypt->check_password($password,$row->password)){
					$session_data = array(
					'id_user' => $row->id_user,
					'no_ktp' => $row->no_ktp,
					'no_uji' => $row->no_uji,
					'no_kendaraan' => $row->no_kendaraan,
					'nama' => $row->nama,
					'email' => $row->email,
					'level' => $row->level,
					);
					$this->set_session($session_data);
					$this->aktifitas_login($session_data);
					return 'login_sukses';
				} else{
					return 'password_salah';
					}
			} else {
				return 'akun_belum_aktif';
				}
		} else {
			return 'akun_tidak_ditemukan';
		}
	}
	
	private function set_session($session_data){
		$sess_data = array(
					'id_user' => $session_data['id_user'],
					'no_ktp' => $session_data['no_ktp'],
					'no_uji' => $session_data['no_uji'],
					'no_kendaraan' => $session_data['no_kendaraan'],
					'nama' => $session_data['nama'],
					'email' => $session_data['email'],
					'level' => $session_data['level'],
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
	
	public function email_ada($email){
		$sql = "SELECT nama,email,waktu_daftar FROM tbl_pengguna WHERE email = '{$email}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		
		return ($result->num_rows() === 1 && $row->email) ? $row->nama:false;
	}
	
	public function verifikasi_reset_password_kode($email, $code){
		$sql = "SELECT nama,no_kendaraan,email FROM tbl_pengguna WHERE email = '{$email}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		
		if ($result->num_rows() === 1){
			return ($code == md5($row->nama)) ? true : false;
		}
		else {
			return false;
		}
	}
	
	public function update_password(){
		$email = $this->input->post('email');
		$password = $this->bcrypt->hash_password($this->input->post('password'));
		
		$sql = "UPDATE tbl_pengguna SET password = '{$password}' WHERE email ='{$email}' LIMIT 1";
		$this->db->query($sql);
		
		if ($this->db->affected_rows() === 1){
			return true;
		}
		else{
			return false;
		}
	}
}