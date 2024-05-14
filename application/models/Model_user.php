<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	function ajax_pemohon(){
		$this->datatables->select('*');
        $this->datatables->from('tbl_pemohon');
        return $this->datatables->generate();
	}
	
	function getJmlPemohon(){
		return $this->db->query("SELECT * from tbl_pemohon")->num_rows();
	}
	
	function getDaftarPemohon($sampai,$dari){
		return $this->db->query("SELECT * from tbl_pemohon LIMIT $dari, $sampai")->result();
	}
	
	function getJmlPemilik(){
		return $this->db->query("SELECT * from tbl_pemilik")->num_rows();
	}
	
	function getDaftarPemilik($sampai,$dari){
		return $this->db->query("SELECT * from tbl_pemilik LIMIT $dari, $sampai")->result();
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