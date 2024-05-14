<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_ikm extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	function getJmlIkm(){
		return $this->db->query("SELECT * FROM tbl_ikm")->num_rows();
	}
	
	public function getRekapIkm($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_ikm order by id_ikm DESC LIMIT $dari, $sampai")->result();
	}
	
	public function getExportIkm($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_ikm where DATE(tgl_ikm) BETWEEN '$awal' AND '$akhir'")->result();
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