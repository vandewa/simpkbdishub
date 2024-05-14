<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_wagateway extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	function getPesanMasuk($sampai,$dari){
		return $this->db->query("SELECT * from tbl_wagateway where jeniswa='MASUK' group by phone order by idx desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlPesanMasuk(){
		return $this->db->query("SELECT * from tbl_wagateway where jeniswa='MASUK' group by phone order by idx desc")->num_rows();
	}
	
	function getPesanKeluar($sampai,$dari){
		return $this->db->query("SELECT * from tbl_wagateway where jeniswa='KELUAR' order by idx desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlPesanKeluar(){
		return $this->db->query("SELECT * from tbl_wagateway where jeniswa='KELUAR' order by idx desc")->num_rows();
	}
	
	function getLihatPesan($id){
		return $this->db->query("SELECT * from tbl_wagateway where phone='$id' order by tgl_pesan desc")->result();
	}
	
	function getDataWhatsapp(){
		return $this->db->query("SELECT * from tbl_pengguna where telp not in('','-','0','00','000','0000')")->result();
	}
	
	function getSmsKeluar($sampai,$dari){
		return $this->db->query("SELECT * from tbl_wagateway where jeniswa='SMS' order by idx desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlSmsKeluar(){
		return $this->db->query("SELECT * from tbl_wagateway where jeniswa='SMS' order by idx desc")->num_rows();
	}
	
	function getAllCronlog($sampai,$dari){
		return $this->db->query("SELECT * from tbl_cronlog order by id_cronlog desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlCronlog(){
		return $this->db->query("SELECT * from tbl_cronlog order by id_cronlog")->num_rows();
	}
	
	// CRUD DATA
	public function getAllData($table)
    {
        return $this->db->get($table)->result();
    }
	 public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }
    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }
    function deleteData($table,$data)
    {
        $this->db->delete($table,$data);
    }
    function insertData($table,$data)
    {
        $this->db->insert($table,$data);
    }
    function manualQuery($q)
    {
        return $this->db->query($q);
    }
}