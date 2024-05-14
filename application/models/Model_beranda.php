<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_beranda extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	private function romawi($mn){
		$n = intval($mn);
		$rom = '';
		$rom_num = array (
			'X'  => 10,
			'X'  => 10,
			'IX' => 9,
			'V'  => 5,
			'IV' => 4,
			'I'  => 1
		);
		foreach ($rom_num as $roman => $nomor){
			$match = intval($n / $nomor);
			$rom .= str_repeat($roman, $match);
			$n = $n % $nomor;
		}
		return $rom;
	}
	
	public function getKodeKwitansiOnline(){
		$d = date("d");
		$m = date("m");
		$y = date("Y");
		
		$q = $this->db->query("select MAX(LEFT(no_kwitansi,3)) as kd_max from tbl_pra_retribusi where DATE(tgl_pembayaran)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
		$bul = $this->romawi($m);
		
        return $kd."/".$d."/".$bul."/KW/OL/".$y;
	}
	
	public function getKodeBillingOnline(){		
		$q = $this->db->query("SELECT MAX(RIGHT(id_billing,3)) AS kd_max FROM tbl_retribusi WHERE DATE(tgl_pembayaran)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return '20'.date("ymd").''.$kd;
	}
	
	public function getNomorAntrian($tgl){
        $q = $this->db->query("select MAX(no_antrian) as kd_max from tbl_antrian where DATE(tgl_antrian)='$tgl'");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return $kd;
    }
	
	function getInformasi(){
		return $this->db->query("select * from tbl_informasi where aktif='1'")->result();
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
		return $this->db->query("SELECT tgl_pembayaran, count(total_semua) as jumlah, sum(total_semua) as total from tbl_retribusi
		WHERE year(tgl_pembayaran)=year(curdate()) group by month(tgl_pembayaran)")->result();
	}
	
	function getRetribusiBulan(){
		return $this->db->query("SELECT tgl_pembayaran, count(total_semua) as jumlah, sum(total_semua) as total_semua from tbl_retribusi
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
		return $this->db->query("SELECT tgl_pembayaran, count(total_semua) as jumlah, sum(total_semua) as total from tbl_retribusi
		WHERE tgl_pembayaran BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() group by tgl_pembayaran")->result();
	}
	
	function getGrafikKendaraan(){
		return $this->db->query("SELECT tgl_daftar_uji, count(*) as kendaraan, jenis from tbl_retribusi a inner join tbl_kendaraan b
		ON a.no_uji = b.no_uji WHERE tgl_pembayaran BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() group by tgl_daftar_uji")->result();
	}
	
	function getCekKendaraan($no){
		return $this->db->query("SELECT a.no_uji, a.no_kendaraan, a.jenis, a.jenis_kendaraan, a.bentuk, a.merek, a.tipe, 
		a.jbb, a.tahun, d.tgl_habis_uji from tbl_kendaraan a left join (
		SELECT no_uji, max(kode_uji) as kode_uji from tbl_pendaftaran group by no_uji) b
		ON a.no_uji=b.no_uji left join tbl_retribusi c
        ON b.kode_uji=c.kode_uji left join tbl_uji d
        ON b.kode_uji=d.kode_uji where a.no_uji='$no' OR a.no_kendaraan='$no'")->result();
	}
	
	function getStatusBerkas(){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji where a.aktif='1' AND c.aktif='1' AND DATE(tgl_daftar_uji)=curdate()
		order by a.id_daftar desc")->result();
	}
	
	function getCekUji($id){
		return $this->db->query("SELECT *, b.nama as penguji, d.nama as nama FROM tbl_uji a INNER JOIN penguji b
		ON a.id_penguji=b.idx INNER JOIN tbl_kendaraan c
		ON a.no_uji=c.no_uji INNER JOIN tbl_pengguna d
		ON a.no_uji=d.no_uji INNER JOIN tbl_uji_detail e
		ON a.kode_uji=e.kode_uji WHERE a.kode_uji='$id' and d.aktif='1'")->result();
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
	
	function getPengguna($id){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a INNER JOIN tbl_pengguna b
		ON a.no_uji=b.no_uji WHERE a.kode_uji='$id'")->result();
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
	
	function getCekDaftarOnline($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b 
		ON a.no_uji = b.no_uji where a.no_uji='$id' and a.aktif ='1' AND b.aktif ='1'")->result();
	}
	
	function getDataBooking($id){
		return $this->db->query("SELECT * FROM tbl_pra_pendaftaran a inner join tbl_pra_retribusi b
		ON a.kode_uji=b.kode_uji where kode_booking='$id' and a.aktif='1'")->result();
	}
	
	function getHasilUji(){
		return $this->db->query("SELECT *, a.aktif as status FROM tbl_uji a INNER JOIN tbl_kendaraan b
		ON a.no_uji=b.no_uji INNER JOIN tbl_pengguna c
		ON a.no_uji=c.no_uji INNER JOIN tbl_uji_detail d
		ON a.kode_uji=d.kode_uji INNER JOIN tbl_pendaftaran e
		ON a.kode_uji=e.kode_uji where a.aktif>0 AND e.jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') and c.aktif='1' and tgl_uji=CURDATE() order by rand() limit 1")->result();
	}
	
	function getColumnChartIKM($jenis){
		return $this->db->query("SELECT AVG($jenis) as $jenis from tbl_ikm")->result();
	}
	
	function getPieChartIKM($jenis){
		return $this->db->query("select $jenis as jenis, count($jenis) as jumlah from tbl_ikm group by $jenis")->result();
	}
	
	function getUjiToday(){
		return $this->db->query("SELECT count(*) as uji FROM tbl_pendaftaran where tgl_daftar_uji=CURDATE()")->result();
	}
	
	function getUjiTotal(){
		return $this->db->query("SELECT count(*) as uji FROM tbl_pendaftaran where YEAR(tgl_daftar_uji)=YEAR(CURDATE())")->result();
	}
	
	function getRetribusiTotal(){
		return $this->db->query("SELECT sum(total_semua) as total FROM tbl_retribusi where status_bayar='1' and YEAR(tgl_pembayaran)=YEAR(CURDATE())")->result();
	}
	
	function getRetribusiToday(){
		return $this->db->query("SELECT sum(total_semua) as total FROM tbl_retribusi where status_bayar='1' and tgl_pembayaran=CURDATE()")->result();
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
	function CountData($table)
    {
        return $this->db->count_all($table);
    }
	
	function CountWhere($table,$data){
		return $this->db->get_where($table, $data)->num_rows();
    }
}