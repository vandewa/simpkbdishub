<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_master extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	function getJenisKendaraan(){
		return $this->db->query("SELECT * FROM tbl_jenis_kendaraan a inner join tbl_kendaraan_jenis b
		ON a.id_jenis=b.id_jenis")->result();
	}
	
	function getJmlPemohon(){
		return $this->db->query("SELECT * from tbl_pemohon")->num_rows();
	}
	
	function getDaftarPemohon($sampai,$dari){
		return $this->db->query("SELECT * from tbl_pemohon LIMIT $dari, $sampai")->result();
	}
	
	function getCariPemohon($match){
		return $this->db->query("SELECT * from tbl_pemohon where nama like '%$match%' OR no_ktp like '%$match%'")->result();
	}
	
	function getDataOperator(){
		return $this->db->query("SELECT *, d.nama as penguji FROM tbl_admin a inner join tbl_user b
		ON a.id_user=b.id_user inner join tbl_akses c
		ON b.id_akses=c.id_akses left join penguji d
		ON b.id_penguji=d.idx where b.id_akses in(2,3,4,5,6,7) and a.aktif='1'")->result();
	}
	
	function getDataAdmin(){
		return $this->db->query("SELECT * FROM tbl_admin a inner join tbl_user b
		ON a.id_user=b.id_user where id_akses='1' and a.aktif='1'")->result();
	}
	
	function getJmlKerusakan(){
		return $this->db->query("SELECT * from tbl_kerusakan")->num_rows();
	}
	
	function getDataKerusakan($sampai,$dari){
		return $this->db->query("SELECT * from tbl_kerusakan order by id_kerusakan desc LIMIT $dari, $sampai")->result();
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