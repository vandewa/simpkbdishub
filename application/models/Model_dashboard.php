<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_dashboard extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	function getJmlDaftar(){
		return $this->db->query("select * from tbl_pendaftaran where tgl_daftar_uji=curdate()")->num_rows();
	}
	
	function getJmlBelumUji(){
		return $this->db->query("SELECT * FROM tbl_uji where aktif='0' AND tgl_uji=CURDATE()")->num_rows();
	}
	
	function getJmlPengesahan(){
		return $this->db->query("SELECT * FROM tbl_uji where aktif='1' AND tgl_uji=CURDATE()")->num_rows();
	}
	
	function getJmlUji(){
		return $this->db->query("SELECT * FROM tbl_uji where aktif in ('2','3','4') AND tgl_uji=CURDATE()")->num_rows();
	}
	
	function getJmlLulus(){
		return $this->db->query("SELECT * FROM tbl_uji where aktif='2' AND tgl_uji=CURDATE()")->num_rows();
	}
	
	function getJmlTidakLulus(){
		return $this->db->query("SELECT * FROM tbl_uji where aktif in ('3','4') AND tgl_uji=CURDATE()")->num_rows();
	}
	
	function getJmlPerso(){
		return $this->db->query("SELECT * FROM tbl_uji where uji='2' AND tgl_uji=CURDATE()")->num_rows();
	}
	
	function getDashboardKbwu(){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_uji b on a.no_uji=b.no_uji where year(tgl_habis_uji)=year(curdate()) and month(tgl_habis_uji)=month(curdate()) 
		and year(a.tgl_daftar_uji)=year(curdate()) and month(a.tgl_daftar_uji)=month(curdate()) and a.no_kendaraan REGEXP '^G' AND a.no_kendaraan REGEXP 'Z$|P$|F$'")->num_rows();
	}
	
	function getDashboardHbsUji(){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_uji b on a.kode_uji=b.kode_uji where year(tgl_habis_uji)=year(curdate()) and month(tgl_habis_uji)=month(curdate())
		and a.no_kendaraan REGEXP '^G' AND a.no_kendaraan REGEXP 'Z$|P$|F$'")->num_rows();
	}
	
	function getPelayanan(){
		return $this->db->query("select * from tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji where waktu_selesai !='' AND tgl_daftar_uji=curdate()")->result();
	}
	
	function getTarget(){
		return $this->db->query("select sum(total_retribusi) as total, (select sum(target) from tbl_retribusi_target) as target from tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where year(tgl_pembayaran)=year(curdate())")->result();
	}
	
	function getTargetRetribusi(){
		return $this->db->query("select jenis_kendaraan, dpa, b.kategori, count(retribusi) as jumlah, sum(total_retribusi) as total, target from tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji inner join tbl_retribusi_target  c on b.kategori=c.kategori where year(tgl_pembayaran)=year(curdate()) and dpa=year(curdate()) group by b.kategori order by jenis_kendaraan desc, b.kategori,  retribusi asc")->result();
	}
	
	function getRetribusiTahun(){
		return $this->db->query("SELECT tgl_pembayaran, count(retribusi) as jumlah, sum(total_retribusi) as total from tbl_retribusi
		WHERE year(tgl_pembayaran)=year(curdate()) group by month(tgl_pembayaran)")->result();
	}
	
	function getRetribusiBulan(){
		return $this->db->query("SELECT tgl_pembayaran, count(retribusi) as jumlah, sum(total_retribusi) as total from tbl_retribusi
		WHERE year(tgl_pembayaran)=year(curdate()) and month(tgl_pembayaran)=month(curdate()) group by tgl_pembayaran")->result();
	}
	
	function getKategoriRetribusiBulan(){
		return $this->db->query("select jenis_kendaraan, kategori, count(retribusi) as jumlah, sum(total_retribusi) as total from tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where month(tgl_pembayaran)=month(curdate()) and year(tgl_pembayaran)=year(curdate()) group by kategori order by jenis_kendaraan desc, kategori,  retribusi asc")->result();
	}
	
	function getDataRetribusi(){
		return $this->db->query("select jenis_kendaraan, kategori, count(retribusi) as jumlah, sum(total_retribusi) as total from tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran=curdate() group by kategori order by jenis_kendaraan desc, kategori, retribusi asc")->result();
	}
	
	function getDataPengujian(){
		return $this->db->query("select jenis_kendaraan, jenis, count(retribusi) as jumlah from tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran=curdate() group by jenis order by jenis_kendaraan desc, jenis asc, retribusi asc")->result();
	}
	
	function getRetribusi(){
		return $this->db->query("select jenis_kendaraan, kategori, retribusi, count(retribusi) as jumlah, sum(total_retribusi) as total from tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran=curdate() group by retribusi, jenis_kendaraan order by jenis_kendaraan desc, kategori, retribusi asc")->result();
	}
	
	function getTotalRetribusi(){
		return $this->db->query("select count(retribusi) as jumlah, sum(total_retribusi) as total from tbl_retribusi where tgl_pembayaran=curdate()")->result();
	}
	
	function getPendaftaran(){
		return $this->db->query("select jenis_uji, count(jenis_uji) as jumlah, sum(total_retribusi) as total from tbl_pendaftaran a inner join tbl_retribusi b 
		on a.kode_uji=b.kode_uji where tgl_daftar_uji=curdate() group by jenis_uji order by jenis_uji")->result();
	}
	
	function getPengujian(){
		return $this->db->query("select jenis_kendaraan, kategori, hasil, count(hasil) as jumlah from tbl_uji a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_daftar_uji=curdate() group by jenis_kendaraan, kategori, hasil order by jenis_kendaraan desc, kategori")->result();
	}
	
	function getGrafikRetribusi(){
		return $this->db->query("SELECT tgl_pembayaran, count(retribusi) as jumlah, sum(total_retribusi) as total from tbl_retribusi
		WHERE tgl_pembayaran BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() group by tgl_pembayaran")->result();
	}
	
	function getCekKendaraan($no){
		return $this->db->query("SELECT * from tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join (
		SELECT no_uji, max(kode_uji) as kode_uji from tbl_pendaftaran group by no_uji) c
		ON a.no_uji=c.no_uji inner join tbl_retribusi d
        ON c.kode_uji=d.kode_uji inner join tbl_uji e
        ON d.kode_uji=e.kode_uji where b.aktif='1' AND a.no_uji='$no' OR a.no_kendaraan='$no'")->result();
	}
	
	function getStatusBerkas(){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji where a.aktif='1' AND c.aktif='1' AND DATE(tgl_daftar_uji)=curdate()
		order by a.id_daftar desc")->result();
	}
	
	function getCekUji($id){
		return $this->db->query("SELECT * FROM tbl_uji a INNER JOIN tbl_penguji b
		ON a.no_reg=b.no_reg INNER JOIN tbl_kendaraan c
		ON a.no_uji=c.no_uji WHERE a.kode_uji='$id'")->result();
	}
	
	function getCekDataUji($id){
		return $this->db->query("SELECT * FROM tbl_uji a INNER JOIN tbl_penguji b
		ON a.no_reg=b.no_reg INNER JOIN tbl_kendaraan c
		ON a.no_uji=c.no_uji WHERE a.no_uji='$id' order by tgl_uji desc LIMIT 1")->result();
	}
	
	function getCekSurat($id){
		return $this->db->query("SELECT * FROM tbl_surat a INNER JOIN tbl_uji_keluar b
		ON a.kode_uji=b.kode_uji INNER JOIN tbl_kendaraan c
		ON a.no_uji=c.no_uji WHERE a.kode_uji='$id'")->result();
	}
	
	public function getDataAntrian($id){
		return $this->db->query("SELECT count(*) as jumlah from tbl_pra_pendaftaran where tgl_booking='$id'")->result();
	}
	
	public function getKodeBooking($id){
		$q = $this->db->query("SELECT MAX(RIGHT(kode_booking,3)) AS kd_max FROM tbl_pra_pendaftaran WHERE tgl_booking='$id'");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
		$tglbook = date("ymd",strtotime($id));
        return $tglbook.''.$kd;
	}
	
	public function getNotifPengesahan($idpenguji){
		return $this->db->query("SELECT * from tbl_uji where id_penguji='$idpenguji' and aktif='1'")->num_rows();
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