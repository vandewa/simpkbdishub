<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_registrasi extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	public function insert_user(){
		$id_user = $this->input->post('id_user');
		$no_ktp = $this->input->post('no_ktp');
		$no_kendaraan = $this->input->post('no_kendaraan');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		
		$sql = "INSERT INTO tbl_pengguna (id_user,no_ktp,no_kendaraan,nama,email,password)
		VALUES (" . $this->db->escape($id_user) . ",
		" . $this->db->escape($no_ktp) . ",
		" . $this->db->escape($no_kendaraan) . ",
		" . $this->db->escape($nama) . ",
		'" . $email . "',
		'" . $password . "')";
		
		$sqlk = "INSERT INTO tbl_kendaraan (no_kendaraan,no_ktp)
		VALUES (" . $this->db->escape($no_kendaraan) . ",
		" . $this->db->escape($no_ktp) . ")";
		
		$result = $this->db->query($sql);
		$result = $this->db->query($sqlk);
		
		if ($this->db->affected_rows() === 1){
			$this->set_session($nama,$email,$no_ktp,$no_kendaraan);
			$this->send_validation_email();
			return $nama;
		}
	}
	
	private function set_session($nama, $email, $no_ktp, $no_kendaraan) {
		$sql = "SELECT id_user,nama,no_ktp,waktu_daftar FROM tbl_pengguna WHERE email ='" . $email . "' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		
		$sess_data = array(
			'id_user' => $row->id_user,
			'no_ktp' => $no_ktp,
			'no_kendaraan' => $no_kendaraan,
			'nama' => $nama,
			'email' => $email,
			'logged_in' => 0
			);
			
		$this->email_code = md5((string)$row->waktu_daftar);
		$this->session->set_userdata($sess_data);
	}
	
	private function send_validation_email(){
		$this->load->library('email');
		$email = $this->session->userdata('email');
		$email_code = $this->email_code;
		
		$this->email->set_mailtype('html');
		$this->email->from($this->config->item('bot_email'),'DISHUBKOMINFO Kabupaten Tegal');
		$this->email->to($email);
		$this->email->subject('Aktivasi Akun PKB Online DISHUBKOMINFO Kabupaten Tegal');
		
		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
		<meta http-equiv="Content-Type" content="text/html"; charset=utf-8" />
		</head><body>';
		$message .= '<p>Dear ' . $this->session->userdata('nama').',</p>';
		$message .= '<p>Terimakasih sudah mendaftar di PKB  Online DISHUBKOMINFO Kabupaten Tegal! Silahkan <strong><a href="' . base_url() .'registrasi/validasi_email/' . $email . '/'.
		$email_code . '"> klik disini</a></strong> untuk aktivasi akun anda. Setelah mengaktifkan akun anda, anda dapat masuk ke layanan PKB Online dan Silahkan melengkapi
		data yang diperlukan untuk Pemeriksaan Kendaraan Bermotor anda</p>';
		$message .= '<p>Terimakasih</p>';
		$message .= '<p>Pelayanan PKB Online DISHUBKOMINFO Kabupaten Tegal<p>';
		$message .= '</body></html>';
		
		$this->email->message($message);
		$this->email->send();
	}
	
	public function validasi_email($email_address, $email_code) {
		$sql = "SELECT email, waktu_daftar, nama FROM tbl_pengguna WHERE email ='{$email_address}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		
		if ($result->num_rows() === 1 && $row->nama) {
			if (md5((string)$row->waktu_daftar) === $email_code)
				$result = $this->aktivasi_akun($email_address);
			if ($result === true){
				return true;	
			} else {
			echo 'Gagal mengaktifkan akun anda, silahkan menghubungi administrator ' . $this->config->item('admin_email');
			return false;
			}
		} else {
			echo 'Gagal validasi email anda, silahkan menghubungi administrator ' . $this->config->item('admin_email');
		}	
	}
	
	private function aktivasi_akun($email_address){
		$sql = "UPDATE tbl_pengguna SET aktif = 1 WHERE email = '" . $email_address . "' LIMIT 1";
		$this->db->query($sql);
		if($this->db->affected_rows() === 1){
			return true;
		} else {
			echo 'Gagal mengaktifkan akun anda, silahkan menghubungi administrator ' . $this->config->item('admin_email');
			return false;
		}
	}
}