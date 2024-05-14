<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_kendaraan extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	function getJenisKendaraan($jenis){
		return $this->db->query("SELECT * FROM tbl_jenis_kendaraan where id_jenis='$jenis' AND kategori='JENIS'")->result();
	}
	
	function getBentukKendaraan($jenis){
		return $this->db->query("SELECT * FROM tbl_jenis_kendaraan where id_jenis='$jenis' AND kategori='BENTUK'")->result();
	}
	
	function getCekQr($id){
		return $this->db->query("select * from tbl_kendaraan where no_uji='$id' and qrcode=''")->num_rows();
	}
	
	function getLastFoto($id){
		return $this->db->query("select * from tbl_uji_foto where no_uji='$id' order by id_uji_foto desc limit 1")->result();
	}
	
	function getDataFotoKendaraan($id){
		return $this->db->query("select * from tbl_uji_foto where no_uji='$id' order by id_uji_foto desc limit 4")->result();
	}
	
	// KENDARAAN 
	function getNoKartu($id){
		$q = $this->db->query("SELECT count(*) as kd_max from tbl_kartu_induk where no_uji='$id'");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
		return $id."".$kd;
	}
	
	function getNoUji(){
		$no = $this->db->query("SELECT MAX(CAST(SUBSTRING(no_uji,4) AS UNSIGNED)) as no_uji FROM `tbl_kendaraan` WHERE no_uji REGEXP '^JPA'")->result();
		foreach($no as $row){
			$nouji = $row->no_uji+1;
		}
		return "WS".$nouji;
	}
	
	function getNoUjiBaru($jns){
		$jns = $this->db->query("SELECT kode from tbl_kendaraan_jenis where jenis='$jns'")->result();
		foreach($jns as $row){
			$j = $row->kode;
		}
		$y = date("y");
		$q = $this->db->query("SELECT MAX(CAST(SUBSTRING(no_uji, 2) AS UNSIGNED)) as kd_max
		FROM `tbl_kendaraan` WHERE no_uji REGEXP '^PK'");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }else{
            $kd = "00001";
        }
		return "WS".$kd;
	}
	
	function getAllDataMasKendaraan($sampai,$dari){
		return $this->db->query("SELECT * from
		tbl_kendaraan_master LIMIT $dari, $sampai")->result();
	}
	
	function getJmlMasterKendaraan(){
		return $this->db->query("SELECT * from tbl_kendaraan_master")->num_rows();
	}
	
	function getAllDataMutasi($sampai,$dari){
		return $this->db->query("SELECT * from tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_pendaftaran c
		ON a.no_uji=c.no_uji where status='3' AND jenis_uji='Mutasi Keluar' order by tgl_daftar_uji desc LIMIT $dari, $sampai")->result();
	}

	function getJmlMutasi(){
		return $this->db->query("SELECT * from tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_pendaftaran c
		ON a.no_uji=c.no_uji where status='3' AND jenis_uji='Mutasi Keluar'")->num_rows();
	}
	
	function getCariMutasiKendaraan($match){
		return $this->db->query("SELECT * from tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_pendaftaran c
		ON a.no_uji=c.no_uji where status='3' AND jenis_uji='Mutasi Keluar' and a.no_uji like '%$match%' OR a.no_kendaraan like '%$match%' OR a.tipe like '%$match%' LIMIT 0,5000")->result();
	}
	
	function getAllDataPemilik($sampai,$dari){
		return $this->db->query("SELECT * from
		tbl_pengguna where aktif='1' LIMIT $dari, $sampai")->result();
	}

	function getJmlPemilik(){
		return $this->db->query("SELECT * from
		tbl_pengguna where aktif='1'")->num_rows();
	}
	
	function getPemilik($id){
		return $this->db->query("SELECT * from
		tbl_pengguna where id_user = '$id'")->result();
	}
	
	function getCariPemilik($match){
		return $this->db->query("SELECT * from tbl_pengguna 
		where aktif='1' AND nama like '%$match%' OR no_uji like '%$match%' OR no_uji like '%$match%'")->result();
	}
	
	function getDataPemilik($id){
		return $this->db->query("SELECT * from
		tbl_pengguna where no_uji = '$id' order by aktif desc")->result();
	}
	
	function getDataPendaftaranUji($id){
		return $this->db->query("SELECT * from tbl_pendaftaran a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji WHERE a.aktif='1' AND a.no_uji='$id' GROUP by a.kode_uji")->result();
	}
	
	function getDataWhatsapp($id){
		return $this->db->query("SELECT * from tbl_wagateway WHERE no_uji='$id' and jeniswa='KELUAR' order by idx desc")->result();
	}
	
	//	DEL
	function getKendaraan($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_uji as max_no_uji, no_kendaraan as max_no_kendaraan,max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) c
		ON b.no_uji = c.max_no_uji where a.aktif = '1' AND b.aktif = '1' order by max_tgl_habis_uji desc LIMIT $dari, $sampai")->result();
	}
	//
	
	function getDaftarKendaraan($sampai,$dari){
		return $this->db->query("SELECT *, a.no_uji as no_uji, a.aktif as aktif FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_uji, max(tgl_habis_uji) as tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) c
		ON b.no_uji = c.no_uji where b.aktif = '1' order by tgl_habis_uji desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlKendaraan(){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_uji as max_no_uji, no_kendaraan as max_no_kendaraan,max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) c
		ON b.no_uji = c.max_no_uji where b.aktif = '1'")->num_rows();
	}
	
	function getCariKendaraan($match){
		return $this->db->query("SELECT *, a.no_uji as no_uji, a.aktif as aktif FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_uji, max(tgl_habis_uji) as tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) c
		ON b.no_uji = c.no_uji where b.aktif = '1' and a.no_uji like '%$match%' OR a.no_kendaraan like '%$match%' OR a.tipe like '%$match%' OR no_rangka like '%$match%' LIMIT 0,5000")->result();
	}
	
	function getDataKend($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b 
		ON a.no_uji = b.no_uji where a.no_uji = '$id' and a.aktif = '1' AND b.aktif = '1' ")->result();
	}
	
	function getDataKartuKend($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b 
		ON a.no_uji = b.no_uji inner join tbl_kartu_induk c
		ON a.no_uji = c.no_uji where a.no_uji = '$id' and a.aktif = '1' AND b.aktif = '1' order by id_kartu desc limit 1")->result();
	}
	
	function getCetakKartuKendaraan($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b 
		ON a.no_uji = b.no_uji where a.no_uji = '$id' AND b.aktif = '1'")->result();
	}
	
	// DEL
	function getDataKendaraan($id){
		return $this->db->query("SELECT * FROM tbl_pengguna a left join tbl_kendaraan b 
		ON a.no_uji = b.no_uji (
		select no_uji as max_no_uji, no_kendaraan as max_no_kendaraan ,max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) f
		ON e.no_uji = f.max_no_uji where a.no_uji = '$id' and a.aktif = '1' AND b.aktif = '1' ")->result();
	}
	//
	
	function getDataPengujianKendaraan($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_uji_detail b
		ON a.kode_uji=b.kode_uji inner join penguji c
		ON a.id_penguji=c.idx inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji where a.no_uji= '$id' order by tgl_uji desc")->result();
	}
	
	function getDataUjiKeluar($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_uji_keluar b
		ON a.kode_uji=b.kode_uji inner join tbl_surat c
		ON a.kode_uji=c.kode_uji where a.no_uji= '$id' AND jenis_uji_keluar='numpang' group by a.kode_uji order by tgl_uji desc")->result();
	}
	
	function getJmlKenBlokir(){
		return $this->db->query("SELECT * FROM tbl_kendaraan_blokir a inner join tbl_kendaraan b
		ON a.no_uji = b.no_uji inner join tbl_pengguna c
		ON a.no_uji = c.no_uji where a.aktif = '1' AND b.aktif = '1' AND c.aktif='1' AND b.status='2'")->num_rows();
	}
	
	function getKendaraanBlokir($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_kendaraan_blokir a inner join tbl_kendaraan b
		ON a.no_uji = b.no_uji inner join tbl_pengguna c
		ON a.no_uji = c.no_uji where a.aktif = '1' AND b.aktif = '1' AND c.aktif='1' AND b.status='2' order by tgl_blokir desc LIMIT $dari, $sampai")->result();
	}
	
	function getUkuranKendaraan($bentuk,$tipe){
		return $this->db->query("SELECT * FROM tbl_kendaraan_master 
		where bentuk='$bentuk' AND tipe='$tipe'")->result();
	}
	
	function getJmlKendaraanHapus(){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji where a.aktif = '0' AND b.aktif = '1'")->num_rows();
	}
	
	function getKendaraanHapus($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji where a.aktif = '0' AND b.aktif = '1' LIMIT $dari, $sampai")->result();
	}
	
	// CRUD DATA
	public function getAllData($table)
    {
        return $this->db->get($table)->result();
    }
	public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data)->result();
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
	function countAll($table){
		$this->db->count_all($table);
	}
}