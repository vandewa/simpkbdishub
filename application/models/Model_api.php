<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_api extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	public function getTransaksi($id){
		return $this->db->query("SELECT id_billing, exp_billing, no_kwitansi as no_bukti, no_kendaraan, nama, alamat, a.no_uji, ayat_penerimaan, jml_denda as nominal_denda, total_retribusi as nominal_total from tbl_retribusi a inner join tbl_pengguna b 
		ON a.no_uji=b.no_uji where b.aktif='1' AND id_billing='$id'")->result();
	}
	
	public function getCekBayar($id){
		return $this->db->query("SELECT id_billing, status_bayar from tbl_retribusi where id_billing='$id'")->result();
	}
	
	public function BayarTransaksi($data){
		$this->db->insert('tbl_transaksi',$data);
		return $this->db->affected_rows();
	}
	
	public function UpdateTransaksi($data, $id){
		$this->db->update('tbl_retribusi',$data, ['id_billing' => $id]);
		return $this->db->affected_rows();
	}
	
	function CekBayar($id){
		return $this->db->query("SELECT EXISTS(SELECT * FROM tbl_retribusi WHERE id_billing='$id' and status_bayar='0') as cek")->result();
	}
	
	public function getKendaraan($id){
		return $this->db->query("SELECT no_uji, no_kendaraan, jenis_kendaraan, bentuk, merek, tipe, tahun FROM tbl_kendaraan where no_uji = '$id'")->result();
	}
	
	public function getPendaftaran($id){
		return $this->db->query("SELECT a.no_uji, a.no_kendaraan, jenis_kendaraan, merek, tipe, nama, alamat, kecamatan, telp FROM tbl_kendaraan a
		inner join tbl_pengguna b on a.no_uji=b.no_uji where b.aktif='1' and a.no_uji = '$id'")->result();
	}
	
	public function getCekKendaraan($id){
		return $this->db->query("SELECT no_uji from tbl_kendaraan where no_uji='$id'")->num_rows();
	}
	
	function getGrafikRetribusi(){
		return $this->db->query("SELECT tgl_pembayaran as tanggal, count(total_semua) as jumlah_uji, sum(total_semua) as total_retribusi from tbl_retribusi
		WHERE tgl_pembayaran BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() group by tgl_pembayaran")->result();
	}
	
	function getGrafikRetribusiTahun(){
		return $this->db->query("SELECT tgl_pembayaran as tanggal, count(total_semua) as jumlah_uji, sum(total_semua) as total_retribusi from tbl_retribusi
		WHERE year(tgl_pembayaran)=year(curdate()) group by month(tgl_pembayaran)")->result();
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