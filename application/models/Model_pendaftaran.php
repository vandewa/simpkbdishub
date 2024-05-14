<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_pendaftaran extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	// PENDAFTARAN
	
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
	
	public function getKodeKwitansi(){
		$d = date("d");
		$m = date("m");
		$y = date("Y");
		
		$q = $this->db->query("select MAX(LEFT(no_kwitansi,3)) as kd_max from tbl_retribusi where DATE(tgl_pembayaran)=CURDATE()");
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
		
        return $kd."/".$d."/".$bul."/KW/".$y;
	}
	
	public function getNomorAntrian(){
        $q = $this->db->query("select MAX(no_antrian) as kd_max from tbl_antrian where DATE(tgl_antrian)=CURDATE()");
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
	
	public function getKodeBilling(){		
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
        return '07'.date("ymd").''.$kd;
	}
	
	function getCekDaftarSkrg($no_uji){
		return $this->db->query("SELECT * FROM tbl_pendaftaran where no_uji='$no_uji' and tgl_daftar_uji=CURDATE()")->num_rows();
	}
	
	function getCekPendaftaran($id){
		return $this->db->query("SELECT EXISTS(SELECT * FROM tbl_pendaftaran WHERE no_ktp_pemohon='$id' and tgl_daftar_uji=CURDATE()) as cek")->result();
	}
	
	function getCekBilling($no_uji,$kode_uji){
		return $this->db->query("SELECT EXISTS(SELECT * FROM tbl_retribusi WHERE no_uji='$no_uji' and kode_uji='$kode_uji') as cek")->result();
	}
	
	function getJmlDaftarOnline(){
		return $this->db->query("SELECT * FROM tbl_pra_pendaftaran a inner join tbl_pra_retribusi b 
		ON a.kode_uji=b.kode_uji where a.aktif = '1'")->num_rows();
	}
	
	function getRekapPendaftaranOnline($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_pra_pendaftaran a inner join tbl_pra_retribusi b 
		ON a.kode_uji=b.kode_uji where a.aktif='1' order by id_pra_pendaftaran desc LIMIT $dari, $sampai")->result();
	}
	
	function getCekOnline($no_uji){
		return $this->db->query("SELECT * FROM tbl_pra_pendaftaran WHERE no_uji='$no_uji' and aktif='1'")->num_rows();
	}
	
	function getRekapDaftar(){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji inner join tbl_retribusi d
		ON a.kode_uji=d.kode_uji where a.aktif='0' AND c.aktif='1' AND tgl_daftar_uji=CURDATE() order by a.id_daftar desc")->result();
	}
	
	function getJmlDaftar(){
		return $this->db->query("SELECT * FROM tbl_pendaftaran 
		where aktif = '1' AND tgl_daftar_uji=CURDATE()")->num_rows();
	}
	
	function getRekapPendaftaran($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji inner join tbl_retribusi d
		ON a.kode_uji=d.kode_uji where a.aktif='1' AND c.aktif='1' AND tgl_daftar_uji=CURDATE() 
		order by a.id_daftar desc LIMIT $dari, $sampai")->result();
	}
	
	function getCariDaftar($match){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_retribusi c 
		ON a.kode_uji=c.kode_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji where a.aktif='1' AND b.aktif='1' AND a.no_uji like '$match' OR a.kode_uji like '$match' OR a.no_kendaraan like '$match'")->result();
	}
	
	function getCariDaftarUji($id){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji where a.aktif='1' AND b.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getCariTanggalDaftar($match){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji where tgl_daftar_uji='$match' AND a.aktif='1' AND b.aktif='1' order by a.kode_uji ASC")->result();
	}
	
	function getDetailPendaftaran($id){
		return $this->db->query("SELECT * from tbl_pendaftaran a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji inner join tbl_kendaraan c
		ON a.no_uji = c.no_uji inner join (
		SELECT no_uji, sifat_uji, MAX(tgl_habis_uji) AS max_tgl_habis_uji FROM tbl_uji AS tbl_uji GROUP BY no_uji) d
		ON c.no_uji = d.no_uji where b.aktif='1' and a.kode_uji='$id'")->result();
	}
	
	function getDataPendaftaran($id){
		return $this->db->query("SELECT *, a.no_uji as no_uji, a.kode_uji as kode_uji, a.jenis_uji as jenis_uji, h.nama as penguji from tbl_pendaftaran a inner join tbl_retribusi b
		ON a.kode_uji = b.kode_uji inner join tbl_uji c
		ON a.kode_uji = c.kode_uji inner join tbl_kendaraan d
		ON a.no_uji = d.no_uji inner join tbl_pengguna e
		ON a.no_uji = e.no_uji inner join kodepenerbitan f
		ON a.status_terbit = f.statuspenerbitan left join tbl_pendaftaran_detail g
		ON a.kode_uji=g.kode_uji left join penguji h
		ON c.id_penguji=h.idx WHERE e.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getDataPendaftaranUji($id){
		return $this->db->query("SELECT * from tbl_pendaftaran a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji WHERE a.aktif='1' AND a.no_uji='$id' GROUP by a.kode_uji")->result();
	}
	
	function getCetakPendaftaran($id){
		return $this->db->query("SELECT * FROM tbl_retribusi a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji inner join tbl_uji d
		ON a.kode_uji=d.kode_uji where id_retribusi='$id' AND b.aktif='1' AND c.aktif='1'")->result();
	}
	
	function getCetakFormPendaftaran($id){
		return $this->db->query("SELECT *,d.nama as nama, f.nama as penguji FROM tbl_pendaftaran a inner join tbl_retribusi b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji inner join tbl_uji e
		ON a.kode_uji=e.kode_uji left join penguji f
		ON e.id_penguji=f.idx where a.kode_uji='$id' AND c.aktif='1' AND d.aktif='1'")->result();
	}
	
	function getCetakPembayaran($id){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_retribusi b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji inner join tbl_uji e
		ON a.kode_uji=e.kode_uji where a.kode_uji='$id' AND c.aktif='1' AND d.aktif='1'")->result();
	}
	
	function getCetakAntrian($id){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_retribusi b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where a.kode_uji='$id'")->result();
	}
	
	function getCekPemohon($ktp){
		return $this->db->query("SELECT * FROM tbl_pemohon WHERE no_ktp='$ktp'")->num_rows();
	}
	
	function getCekNomorUji($no_uji){
		return $this->db->query("SELECT EXISTS(SELECT * FROM tbl_kendaraan WHERE no_uji='$no_uji') as cek")->result();
	}
	
	function getCekNomorKendaraan($no_kendaraan){
		return $this->db->query("SELECT EXISTS(SELECT * FROM tbl_kendaraan WHERE no_kendaraan='$no_kendaraan') as cek")->result();
	}
	
	function getCekDetailPendaftaran($kode_uji){
		return $this->db->query("SELECT EXISTS(SELECT * FROM tbl_pendaftaran_detail WHERE kode_uji='$kode_uji') as cek")->result();
	}
	
	function getDataPemohon($cari){
		return $this->db->query("SELECT * FROM tbl_pemohon where no_ktp='$cari'")->result();
	}
	
	function getCariDataUji($match){
		return $this->db->query("SELECT *, a.no_uji as no_uji, a.no_kendaraan as no_kendaraan, a.status as blokir, (select datediff(NOW(),c.tgl_daftar_uji)) as selisih FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji left join tbl_pendaftaran c
        ON a.no_uji=c.no_uji left join tbl_uji d
        ON c.kode_uji=d.kode_uji left join tbl_retribusi e
		ON c.kode_uji=e.kode_uji left join tbl_kendaraan_blokir f
		ON a.no_uji=f.no_uji where b.aktif='1' AND a.no_uji like '$match' order by id_daftar desc limit 1")->result();
	}
	
	function getPengujiAktif(){
		return $this->db->query("SELECT * from penguji where flag_aktif='1' order by rand()")->result();
	}
	
	function getPengujian($id){
		return $this->db->query("SELECT *, a.no_uji as nomor_uji, d.jenis_uji as jns_uji from tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji = b.no_uji inner join tbl_pengguna c
		ON a.no_uji = c.no_uji inner join tbl_pendaftaran d 
		ON a.kode_uji=d.kode_uji left join tbl_pendaftaran_detail e
		ON a.kode_uji=e.kode_uji where c.aktif='1' and a.kode_uji='$id'")->result();
	}
	
	function getCetakPenguji($id){
		return $this->db->query("SELECT * from tbl_uji a left join tbl_penguji b
		ON a.no_reg = b.no_reg where a.kode_uji='$id'")->result();
	}
	
	function getWilayahAsal($kodeuji){
		return $this->db->query("SELECT kode_uji, kodewilayah, namawilayah from tbl_pendaftaran a inner join kodewilayah b
		ON a.kd_wil_asal=b.kodewilayah where a.kode_uji='$kodeuji'")->result();
	}
	
	function getCariDaftarOnline($nouji){
		return $this->db->query("SELECT *, a.telp as telp, c.no_uji as no_uji, c.no_kendaraan as no_kendaraan FROM tbl_pra_pendaftaran a inner join tbl_pra_retribusi b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c 
        ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where d.aktif='1' AND c.no_uji='$nouji'")->result();
	}
	
	// RETRIBUSI
	
	function getTarifBerkala(){
		return $this->db->query("SELECT * from tbl_retribusi_tarif
		where jenis_retribusi='Retribusi' AND sifat='Berkala' OR sifat='Teknis'")->result();
	}
	
	function getTarifStiker(){
		return $this->db->query("SELECT * FROM `tbl_retribusi_tarif` 
		where jenis_retribusi='Stiker' order by kd_tarif desc")->result();
	}
	
	function getTarifPlat(){
		return $this->db->query("SELECT * FROM `tbl_retribusi_tarif` 
		where jenis_retribusi='Plat' order by kd_tarif desc")->result();
	}
	
	function getTarifBuku(){
		return $this->db->query("SELECT * FROM `tbl_retribusi_tarif` 
		where jenis_retribusi='Buku' order by kd_tarif desc")->result();
	}
	
	function getTarifRetribusi(){
		return $this->db->query("SELECT * from tbl_retribusi_tarif
		where jenis_retribusi='Retribusi' order by kd_tarif desc")->result();
	}
	
	function getJenisTarifRetribusi($uji,$jns,$jbb){
		return $this->db->query("SELECT * from tbl_retribusi_tarif
		where jenis_retribusi='Retribusi' and jenis_uji='$uji' and jenis='$jns' and jbb_awal <= '$jbb' and jbb_akhir >='$jbb'")->result();
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