<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_barang extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	public function getKendaraanUji(){
		return $this->db->query("SELECT *, a.kode_uji as kode_uji, a.no_uji as no_uji, a.jenis_uji as jenis_uji FROM tbl_pendaftaran a inner join tbl_retribusi b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna e
		ON a.no_uji=e.no_uji left join tbl_pendaftaran_detail f
		ON a.kode_uji=f.kode_uji inner join tbl_uji g
		ON a.kode_uji=g.kode_uji where status_barang='0' and e.aktif='1'")->result();
	}
	
	function getNoBuku($kd_buku){
		return $this->db->query("SELECT max(no_buku) as no_buku from tbl_barang where kd_buku='$kd_buku'")->result();
	}
	
	function getNoStiker($kd_stiker){
		return $this->db->query("SELECT max(no_stiker) as no_stiker from tbl_barang where kd_stiker='$kd_stiker'")->result();
	}
	
	function getJmlPenggunaanBarang(){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_barang b on a.kode_uji=b.kode_uji group by tgl_daftar_uji")->num_rows();
	}
	
	public function getRekapPenggunaanBarang($sampai,$dari){
		return $this->db->query("SELECT tgl_daftar_uji, (select count(no_buku) from tbl_barang where no_buku!='' and tgl_pengeluaran=tgl_daftar_uji) as buku, (select count(no_stiker) from tbl_barang where no_stiker!='' and tgl_pengeluaran=tgl_daftar_uji) as stiker, sum(jml_plat) as plat 
		FROM tbl_pendaftaran a inner join tbl_barang b on a.kode_uji=b.kode_uji group by tgl_daftar_uji order by tgl_daftar_uji DESC LIMIT $dari, $sampai")->result();
	}
	
	public function getTotalRekap($id){
		return $this->db->query("SELECT tgl_daftar_uji, (select count(no_buku) from tbl_barang where no_buku!='' and tgl_pengeluaran=tgl_daftar_uji) as buku, (select count(no_stiker) from tbl_barang where no_stiker!='' and tgl_pengeluaran=tgl_daftar_uji) as stiker, sum(jml_plat) as plat 
		FROM tbl_pendaftaran a inner join tbl_barang b on a.kode_uji=b.kode_uji where tgl_daftar_uji='$id'")->result();
	}
	
	public function getLihatRekap($id){
		return $this->db->query("SELECT d.no_uji, d.no_kendaraan, bentuk, merek, tipe, jbb, bahan_bakar, jenis_uji, jml_plat, nama,
		kd_buku, no_buku, kd_stiker, no_stiker, id_barang, a.kode_uji, tgl_daftar_uji FROM tbl_pendaftaran a inner join tbl_retribusi b
		ON a.kode_uji=b.kode_uji inner join tbl_barang c
		ON a.kode_uji=c.kode_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji inner join tbl_pengguna f
		ON a.no_uji=f.no_uji where tgl_daftar_uji='$id' and f.aktif='1'")->result();
	}
	
	
	// BARANG
	
	public function getAllPengadaan($sampai,$dari){
		return $this->db->query("SELECT a.id_pengadaan, a.tgl_pengadaan, a.total_pengadaan, b.nama,
		(SELECT count(id_pengadaan) as qty FROM tbl_barang_pengadaan_detail WHERE id_pengadaan=a.id_pengadaan) as jumlah
		from tbl_barang_pengadaan a inner join tbl_pengguna b
		ON a.no_ktp=b.no_ktp order by a.tgl_pengadaan DESC LIMIT $dari, $sampai")->result();
	}
	
	
	function getDetailPengadaan($id){
		return $this->db->query("SELECT * from tbl_barang_pengadaan a inner join tbl_pengguna b
		ON a.no_ktp=b.no_ktp where a.id_pengadaan='$id'")->result();
	}
	
	function getDetailBarang($id){
		return $this->db->query("SELECT * from tbl_barang_pengadaan a inner join tbl_barang_pengadaan_detail b
		ON a.id_pengadaan=b.id_pengadaan inner join tbl_barang c
		ON b.kd_barang=c.kd_barang where a.id_pengadaan='$id'")->result();
	}
	
	function getJmlPengadaan(){
		return $this->db->query("SELECT * FROM tbl_barang_pengadaan")->num_rows();
	}
	
	
	
	public function getTotalPendapatanRetribusi(){
		return $this->db->query("SELECT sum(total_retribusi) as total FROM tbl_retribusi")->result();
	}
	
	public function getTotalRetribusiTanggal($match){
		return $this->db->query("SELECT sum(total_retribusi) as total FROM tbl_retribusi
		where tgl_pembayaran='$match'")->result();
	}
	
	public function getTotalBukuUji(){
		return $this->db->query("SELECT sum(qty) as total FROM tbl_log_barang where kd_barang='BR-001'")->result();
	}
	
	public function getTotalPlatUji(){
		return $this->db->query("SELECT sum(qty) as total FROM tbl_log_barang where kd_barang='BR-002'")->result();
	}
	
	public function getTotalStikerUji(){
		return $this->db->query("SELECT sum(qty) as total FROM tbl_log_barang where kd_barang='BR-003'")->result();
	}
	
	public function getTambahStok($kd_barang,$qty)
    {
        $q = $this->db->query("SELECT stok FROM tbl_barang WHERE kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok + $qty;
        }
        return $stok;
    }
    public function getKurangStok($kd_barang,$qty)
    {
        $q = $this->db->query("SELECT stok FROM tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok - $qty;
        }
        return $stok;
    }
    public function getKembalikanStok($kd_barang)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok;
        }
        return $stok;
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