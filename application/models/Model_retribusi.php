<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_retribusi extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	public function getKodeTarif(){
        $q = $this->db->query("select MAX(RIGHT(kd_tarif,3)) as kd_max from tbl_retribusi_tarif");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "01";
        }
        return "TF-".$kd;
    }
	
	// RETRIBUSI
	
	function getDataRetribusi($id){
		return $this->db->query("SELECT * FROM tbl_retribusi
		where no_uji= '$id' and aktif='1'")->result();
	}
	
	function getCariUjiRetribusi($match){
		return $this->db->query("SELECT a.no_uji,b.no_kendaraan,c.nama FROM tbl_uji a left join tbl_kendaraan b
		ON a.no_uji=b.no_uji left join tbl_pengguna c
		ON b.no_uji=c.no_uji where c.aktif='1' AND a.no_uji like '$match' group by a.no_uji")->result();
	}
	
	function getCariRetribusi($match){
		return $this->db->query("SELECT * FROM tbl_retribusi a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where a.aktif='1' AND b.aktif='1' AND a.no_uji like '$match'")->result();
	}
	
	function getRekapTanggalRetribusi($match){
		return $this->db->query("SELECT * FROM tbl_retribusi a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where tgl_pembayaran='$match' AND a.aktif='1' AND b.aktif='1'")->result();
	}
	
	function getJmlRetribusi(){
		return $this->db->query("SELECT * FROM tbl_retribusi a left join tbl_pengguna b
		ON a.no_uji = b.no_uji where a.aktif and b.aktif = '1'")->num_rows();
	}
	
	function getDaftarRetribusi($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_retribusi a left join tbl_pengguna b
		ON a.no_uji = b.no_uji where a.aktif = '1' and b.aktif='1' order by tgl_pembayaran DESC LIMIT $dari, $sampai")->result();
	}
	
	function getRetribusiBelumBayar(){
		return $this->db->query("SELECT * FROM tbl_retribusi a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_pengguna c 
		ON a.no_uji=c.no_uji where a.aktif='0'")->result();
	}
	
	function getDetailProsesPembayaran($id){
		return $this->db->query("SELECT * from tbl_retribusi a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji inner join tbl_kendaraan c 
		ON a.no_uji = c.no_uji inner join tbl_uji d
		ON a.kode_uji = d.kode_uji where a.id_retribusi='$id'")->result();
	}
	
	function getDetailPembayaran($id){
		return $this->db->query("SELECT * from tbl_retribusi a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji where c.aktif=1 AND a.id_retribusi='$id'")->result();
	}
	
	function getDetailRetribusi($id){
		return $this->db->query("SELECT * from tbl_retribusi a inner join tbl_retribusi_detail b
		ON a.id_retribusi=b.id_retribusi inner join tbl_retribusi_tarif c
		ON b.kd_tarif=c.kd_tarif where a.id_retribusi='$id'")->result();
	}
	
	function getCetakAntrian($id){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_retribusi b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where a.kode_uji='$id'")->result();
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