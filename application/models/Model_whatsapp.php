<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_whatsapp extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	function getDataKendaraan($text){
		return $this->db->query("SELECT a.no_uji, a.no_kendaraan, a.jenis, a.jenis_kendaraan, a.bentuk, a.merek, a.tipe, 
		a.jbb, a.tahun, d.tgl_habis_uji, c.total_semua from tbl_kendaraan a left join (
		SELECT no_uji, max(kode_uji) as kode_uji from tbl_pendaftaran group by no_uji) b
		ON a.no_uji=b.no_uji left join tbl_retribusi c
        ON b.kode_uji=c.kode_uji left join tbl_uji d
        ON b.kode_uji=d.kode_uji where a.no_uji='$text' OR a.no_kendaraan='$text'")->result();
	}
	
	function getLastMessage($phone){
		return $this->db->query("SELECT * from tbl_wagateway where DATE(tgl_pesan)=CURDATE() AND phone='$phone' order by idx desc LIMIT 1")->result();
	}
	
	function getKendaraan(){
		return $this->db->query("SELECT a.no_uji, a.no_kendaraan, bentuk, nama, tgl_habis_uji, telp FROM tbl_kendaraan a inner join (
		select no_kendaraan, no_uji ,max(tgl_habis_uji) as tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) b
		ON a.no_uji = b.no_uji inner join tbl_pengguna c
		ON a.no_uji = c.no_uji where c.aktif = '1' and a.status='0' and telp not in ('','-')")->result();
	}
	
	function getDataNotif(){
		return $this->db->query("SELECT * FROM tbl_wagateway where status='0' order by idx asc LIMIT 30");
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