<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Hak_akses {
	
	public function cek_akses(){
		$level = $this->session->user_data('level');

		if($level=='pengguna'){
			echo "pengguna";
		}
		else if($level=='admin'){
			echo "admin";
		}
		else if($level=='petugas'){
			echo "Petugas";
		}
	}
}

?>