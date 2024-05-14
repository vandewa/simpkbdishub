<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	// DATA KODE
	
	public function getNomorUji(){
		$q = $this->db->query("SELECT MAX(RIGHT(no_uji,5)) AS kd_max FROM tbl_kendaraan WHERE no_uji like '%SLW%'");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return "SLW".$kd;
	}
	
	public function getKodeUser(){
        $q = $this->db->query("select MAX(RIGHT(id_user,3)) as kd_max from tbl_pengguna");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "USER-".$kd;
    }
	
	public function getKodeUji(){
		$dt = $this->db->query("SELECT DATE_FORMAT(CURDATE() + 0,'%y%m%d') AS date");
		foreach($dt->result() as $row){
			$tgl = $row->date;
		}
		
		$q = $this->db->query("SELECT MAX(RIGHT(kode_uji,4)) AS kd_max FROM tbl_pendaftaran WHERE DATE(tgl_daftar_uji)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return $tgl."".$kd;
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
	
	public function getKodeSuratMutasi(){
		$m = $this->db->query("SELECT MONTH(CURDATE()) AS bulan");
		$y = $this->db->query("SELECT YEAR(CURDATE()) AS tahun");
		foreach($y->result() as $row){
			$th = $row->tahun;
		}
		foreach($m->result() as $row){
			$mn = $row->bulan;
		}
		
		$q = $this->db->query("select MAX(LEFT(no_surat,3)) as kd_max from tbl_surat where jenis_surat='mutasi' AND MONTH(tgl_surat)=$mn");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
		$bul = $this->romawi($mn);
		
        return $kd."/".$bul."/MK/".$th;
	}
	
	public function getKodeSuratNumpang(){
		$m = $this->db->query("SELECT MONTH(CURDATE()) AS bulan");
		$y = $this->db->query("SELECT YEAR(CURDATE()) AS tahun");
		foreach($y->result() as $row){
			$th = $row->tahun;
		}
		foreach($m->result() as $row){
			$mn = $row->bulan;
		}
		
		$q = $this->db->query("select MAX(LEFT(no_surat,3)) as kd_max from tbl_surat where jenis_surat='numpang' AND MONTH(tgl_surat)=$mn");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
		$bul = $this->romawi($mn);
		
        return $kd."/".$bul."/NUK/".$th;
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
	
	function getKodeSTS(){
		$m = date("m");
		$y = date("Y");
		$q = $this->db->query("select MAX(LEFT(no_sts,3)) as kd_max from tbl_sts where YEAR(tgl_sts)=$y");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
		
		/*
		$qts = $this->db->query("select count(*) as total_sts from tbl_sts where YEAR(tgl_sts)=$y")->result();
		foreach($qts as $row){
			$t_sts = $row->total_sts;
		}
		if($t_sts == 0){
			$ts = "001";
		} else {
			$ts = sprintf("%03s",$t_sts+1);
		}
		*/
		
		// return $ts."/".$kd."/2.09.01.01/STS/".$m."/".$y;
		return $kd."/".$m."/".$y;
	}
	
	// CARI KETERANGAN PKB
	
	// DEL
	function getCariData($match){
		return $this->db->query("SELECT *, a.aktif as blokir FROM tbl_kendaraan a left join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_uji as max_no_uji, no_kendaraan as max_no_kendaraan ,max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) c
		ON a.no_uji = c.max_no_uji where b.aktif = '1' and a.no_uji like '%$match%' OR a.no_kendaraan like '%$match%'")->result();
	}
	//
	
	function getCekKendaraan($match){
		return $this->db->query("SELECT * from tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join (
		SELECT no_uji, max(kode_uji) as kode_uji from tbl_pendaftaran group by no_uji) c
		ON a.no_uji=c.no_uji inner join tbl_retribusi d
        ON c.kode_uji=d.kode_uji inner join tbl_uji e
        ON d.kode_uji=e.kode_uji where a.no_uji='$match' OR a.no_kendaraan='$match'")->result();
	}
	
	// PENGGUNA	
	
	function getUser($id){
		return $this->db->query("SELECT * FROM tbl_user a left join tbl_admin b
		ON a.id_user=b.id_user where a.id_user = '$id'")->result();
	}
	
	function getDataPemilik($id){
		return $this->db->query("SELECT * from
		tbl_pengguna where no_uji = '$id' order by aktif desc")->result();
	}
	
	function getCariDeletedUser($match){
		return $this->db->query("SELECT * FROM tbl_user a left join tbl_admin b
		ON a.id_user=b.id_user where a.aktif='0' AND nip like '%$match%' OR nama like '%$match%'")->result();
	}
	
	function getDataDeletedUser(){
		return $this->db->query("SELECT * FROM tbl_user a left join tbl_admin b
		ON a.id_user=b.id_user where a.aktif='0'")->result();
	}
	
	// OPERATOR
	
	function getDataOperator(){
		return $this->db->query("SELECT * FROM tbl_admin a inner join tbl_user b
		ON a.id_user=b.id_user inner join tbl_akses c
		ON b.id_akses=c.id_akses where b.id_akses in(2,3) and a.aktif='1'")->result();
	}
	
	// ADMIN
	
	function getDataAdmin(){
		return $this->db->query("SELECT * FROM tbl_admin a inner join tbl_user b
		ON a.id_user=b.id_user where id_akses='1' and a.aktif='1'")->result();
	}
	
	// KENDARAAN 
	
	function getAllDataMasKendaraan($sampai,$dari){
		return $this->db->query("SELECT * from
		tbl_kendaraan_master LIMIT $dari, $sampai")->result();
	}
	
	function getJmlMasKendaraan(){
		return $this->db->query("SELECT * from tbl_kendaraan_master")->num_rows();
	}
	
	function getDataMasterKendaraan($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan_master
		where id_kendaraan='$id'")->result();
	}
	
	function getMasMerekKendaraan($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan_master
		where tipe='$id'")->result();
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
		where aktif='1' AND nama like '%$match%' OR no_uji like '%$match%' OR no_kendaraan like '%$match%'")->result();
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
		return $this->db->query("SELECT *, a.no_uji as no_uji FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_uji, max(tgl_habis_uji) as tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) c
		ON b.no_uji = c.no_uji where a.aktif = '1' AND b.aktif = '1' order by tgl_habis_uji desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlKendaraan(){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_uji as max_no_uji, no_kendaraan as max_no_kendaraan,max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) c
		ON b.no_uji = c.max_no_uji where a.aktif = '1' AND b.aktif = '1'")->num_rows();
	}
	
	function getCariKendaraan($match){
		return $this->db->query("SELECT *, a.aktif as blokir, a.no_uji as no_uji FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_uji, max(tgl_habis_uji) as tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) c
		ON b.no_uji = c.no_uji left join tbl_kendaraan_blokir d
		ON a.no_uji = d.no_uji where b.aktif = '1' and a.no_uji like '%$match%' OR a.no_kendaraan like '%$match%' OR a.tipe like '%$match%' LIMIT 0,200")->result();
	}
	
	function getDataKend($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b 
		ON a.no_uji = b.no_uji where a.no_uji = '$id' and a.aktif = '1' AND b.aktif = '1' ")->result();
	}
	
	// DEL
	function getDataKendaraan($id){
		return $this->db->query("SELECT * FROM tbl_pengguna a left join tbl_kendaraan b 
		ON a.no_uji = b.no_uji left join (
		select no_uji as max_no_uji, no_kendaraan as max_no_kendaraan ,max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) f
		ON e.no_uji = f.max_no_uji where a.no_uji = '$id' and a.aktif = '1' AND b.aktif = '1' ")->result();
	}
	//
	
	function getDataPengujianKendaraan($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON b.no_uji=c.no_uji where a.no_uji= '$id' group by a.kode_uji order by tgl_uji desc")->result();
	}
	
	function getJmlKenBlokir(){
		return $this->db->query("SELECT * FROM tbl_kendaraan_blokir a inner join tbl_kendaraan b
		ON a.no_uji = b.no_uji inner join tbl_pengguna c
		ON a.no_uji = c.no_uji where a.jenis_blokir='BLOKIR' AND a.aktif = '1' AND b.aktif = '0' AND c.aktif='1'")->num_rows();
	}
	
	function getKendaraanBlokir($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_kendaraan_blokir a inner join tbl_kendaraan b
		ON a.no_uji = b.no_uji inner join tbl_pengguna c
		ON a.no_uji = c.no_uji where a.jenis_blokir='BLOKIR' AND a.aktif = '1' AND b.aktif = '0' AND c.aktif='1' order by tgl_blokir desc LIMIT $dari, $sampai")->result();
	}
	
	function getUkuranKendaraan($jenis,$tipe){
		return $this->db->query("SELECT * FROM tbl_kendaraan_master 
		where jenis='$jenis' AND tipe='$tipe'")->result();
	}
	
	// PENDAFTARAN
	
	function getJmlDaftar(){
		return $this->db->query("SELECT * FROM tbl_pendaftaran 
		where aktif = '1'")->num_rows();
	}
	
	function getRekapPendaftaran($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji where a.aktif='1' AND b.aktif='1' 
		order by a.id_daftar desc LIMIT $dari, $sampai")->result();
	}
	
	function getCariDaftar($match){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a left join tbl_pengguna b
		ON a.no_uji=b.no_uji where a.aktif='1' AND b.aktif='1' AND a.no_uji like '$match' OR a.kode_uji like '$match' OR a.no_kendaraan like '$match'")->result();
	}
	
	function getCariDaftarUji($id){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a left join tbl_pengguna b
		ON a.no_uji=b.no_uji where a.aktif='1' AND b.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getCariTanggalDaftar($match){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji where tgl_daftar_uji='$match' AND a.aktif='1' AND b.aktif='1' order by kode_uji ASC")->result();
	}
	
	function getDetailPendaftaran($id){
		return $this->db->query("SELECT * from tbl_pendaftaran a inner join tbl_pengguna b
		ON a.no_uji = b.no_uji inner join tbl_kendaraan c
		ON a.no_uji = c.no_uji inner join (
		SELECT no_uji, sifat_uji, MAX(tgl_habis_uji) AS max_tgl_habis_uji FROM tbl_uji AS tbl_uji GROUP BY no_uji) d
		ON c.no_uji = d.no_uji where b.aktif='1' and a.kode_uji='$id'")->result();
	}
	
	function getDataPendaftaran($id){
		return $this->db->query("SELECT *, a.no_uji as no_uji, a.kode_uji as kode_uji, a.jenis_uji as jenis_uji from tbl_pendaftaran a inner join tbl_retribusi b
		ON a.kode_uji = b.kode_uji inner join tbl_uji c
		ON a.kode_uji = c.kode_uji inner join tbl_kendaraan d
		ON a.no_uji = d.no_uji inner join tbl_pengguna e
		ON a.no_uji = e.no_uji left join tbl_pendaftaran_detail f
		ON a.kode_uji=f.kode_uji WHERE e.aktif='1' AND a.kode_uji='$id'")->result();
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
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_retribusi b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji inner join tbl_uji e
		ON a.kode_uji=e.kode_uji where a.kode_uji='$id' AND c.aktif='1' AND d.aktif='1'")->result();
	}
	
	function getCekPemohon($ktp){
		return $this->db->query("SELECT EXISTS(SELECT * FROM tbl_pemohon WHERE no_ktp='$ktp') as cek")->result();
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
	
	// PENGUJIAN
	
	function getPenguji(){
		return $this->db->query("SELECT * FROM tbl_penguji
		order by rand()")->result();
	}
	
	function getPengujiPenyelia($tgl){
		return $this->db->query("SELECT *, (SELECT COUNT(*) FROM tbl_uji 
		where no_reg=a.no_reg AND tgl_daftar_uji='$tgl') as jml FROM tbl_penguji a where aktif='1' order by rand()")->result();
	}
	
	
	function getDataPengujian($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON b.no_uji=c.no_uji
		where c.aktif='1' AND a.kode_uji= '$id'")->result();
	}
	
	function getJmlUji(){
		return $this->db->query("SELECT * FROM tbl_uji 
		where aktif = '1'")->num_rows();
	}
	
	function getJmlHabisUji(){
		return $this->db->query("SELECT * FROM (SELECT no_uji, kode_uji, no_kendaraan, tgl_uji, MAX(tgl_habis_uji) AS max_tgl_habis_uji, hasil, aktif FROM tbl_uji AS tbl_uji GROUP BY no_uji) a 
		inner join tbl_kendaraan b ON a.no_uji=b.no_uji 
		inner join tbl_pengguna c ON a.no_uji=c.no_uji where max_tgl_habis_uji <= NOW() AND a.aktif='1' AND c.aktif='1'")->num_rows();
	}
	
	function getDaftarPengujian($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_retribusi c
        ON a.kode_uji=c.kode_uji where a.aktif='1' order by id_retribusi desc LIMIT $dari, $sampai")->result();
	}
	
	function getDaftarHabisUji($sampai,$dari){
		return $this->db->query("SELECT *,(SELECT COUNT(*) from tbl_log_notif where kode_uji=a.kode_uji) as notif FROM (SELECT no_uji, kode_uji, no_kendaraan, tgl_uji, MAX(tgl_habis_uji) AS max_tgl_habis_uji, hasil, aktif FROM tbl_uji AS tbl_uji GROUP BY no_uji) a 
		inner join tbl_kendaraan b ON a.no_uji=b.no_uji 
		inner join tbl_pengguna c ON a.no_uji=c.no_uji where max_tgl_habis_uji <= NOW() AND a.aktif='1' AND c.aktif='1' order by max_tgl_habis_uji desc LIMIT $dari, $sampai")->result();
	}
	
	function getCariDataUji($match){
		return $this->db->query("SELECT *, a.no_uji as no_uji, a.no_kendaraan as no_kendaraan, a.aktif as blokir, (select datediff(NOW(),tgl_daftar_uji)) as selisih FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji left join (SELECT no_uji, max(kode_uji) as kode_uji from tbl_pendaftaran group by no_uji) c
        ON a.no_uji=c.no_uji left join tbl_uji d
        ON c.kode_uji=d.kode_uji left join tbl_retribusi e
		ON c.kode_uji=e.kode_uji left join tbl_kendaraan_blokir f
		ON a.no_uji=f.no_uji where b.aktif='1' AND a.no_uji like '$match'")->result();
	}
	
	/*
	function getCariDataUji($match){
		return $this->db->query("SELECT *, a.aktif as blokir, (select datediff(NOW(),tgl_daftar_uji)) as selisih FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji left join (select no_uji as max_no_uji, no_kendaraan as max_no_kendaraan, max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) c
		ON a.no_uji=c.max_no_uji left join (select max(no_uji) as max_no_uji_daftar, max(kode_uji) as kode_uji, max(tgl_daftar_uji) as tgl_daftar_uji from tbl_pendaftaran group by no_uji) d
        ON a.no_uji=d.max_no_uji_daftar where b.aktif='1' AND a.no_uji like '$match'")->result();
	}
	*/
	
	function getCariBelumUji($match){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where a.aktif='0' AND d.aktif='1' AND a.no_uji like '$match'")->result();
	}
	
	function getProsesUjiKendaraan($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_uji_detail b
		on a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where d.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getCariUjiKendaraan($match){
		return $this->db->query("SELECT * FROM (
		SELECT max(kode_uji) as kode_uji, kode_penguji, no_uji, no_kendaraan, max(tgl_daftar_uji) as tgl_daftar_uji, tempat, sifat_uji, jenis_uji, tgl_habis_uji from tbl_uji as tbl_uji group by no_uji) 
		a left join tbl_kendaraan b
		ON a.no_uji=b.no_uji left join tbl_pengguna c
		ON b.no_uji=c.no_uji where c.aktif='1' AND a.no_uji like '$match'")->result();
	}
	
	function getCariTanggalUji($match){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON b.no_uji=c.no_uji inner join tbl_retribusi d
		ON a.kode_uji=d.kode_uji where tgl_uji='$match' AND a.aktif='1' AND c.aktif='1' order by tgl_daftar_uji DESC")->result();
	}
	
	function getCariUji($match){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON b.no_uji=c.no_uji inner join tbl_retribusi d
		ON a.kode_uji=d.kode_uji where a.aktif='1' AND c.aktif='1' AND a.no_uji like '%$match%' OR a.no_kendaraan like '%$match%' order by tgl_daftar_uji DESC")->result();
	}
	
	function getCariHasilUji($match){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON b.no_uji=c.no_uji inner join tbl_retribusi d
		ON a.kode_uji=d.kode_uji where c.aktif='1' AND a.kode_uji='$match' order by tgl_daftar_uji DESC")->result();
	}
	
	function getCariHabisUji($match){
		return $this->db->query("SELECT * FROM (SELECT no_uji, kode_uji, no_kendaraan, tgl_uji, MAX(tgl_habis_uji) AS max_tgl_habis_uji, hasil, aktif FROM tbl_uji AS tbl_uji GROUP BY no_uji) a 
		inner join tbl_kendaraan b ON a.no_uji=b.no_uji where a.no_uji like '$match' AND max_tgl_habis_uji <= NOW() AND a.aktif='1' order by max_tgl_habis_uji desc")->result();
	}
	
	function getCariCetakUji($match){
		return $this->db->query("SELECT * FROM tbl_uji a left join tbl_kendaraan b
		ON a.no_uji=b.no_uji left join tbl_pengguna c
		ON b.no_uji=c.no_uji where c.aktif='1' AND a.no_uji like '$match' order by tgl_uji DESC")->result();
	}
	
	/*function getDataPenguji($match){
		return $this->db->query("SELECT nama, nip from tbl_penguji a inner join tbl_uji b
		ON a.kode_penguji = b.kode_penguji where b.kode_uji='$match'")->result();
	}*/
	
	function getPengujian($id){
		return $this->db->query("SELECT *, a.no_uji as nomor_uji from tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji = b.no_uji inner join tbl_pengguna c
		ON a.no_uji = c.no_uji inner join tbl_pendaftaran d 
		ON a.kode_uji=d.kode_uji left join tbl_pendaftaran_detail e
		ON a.kode_uji=e.kode_uji where c.aktif='1' and a.kode_uji='$id'")->result();
	}
	
	function getCetakPenguji($id){
		return $this->db->query("SELECT * from tbl_uji a left join tbl_penguji b
		ON a.no_reg = b.no_reg where a.kode_uji='$id'")->result();
	}
	
	function getKendaraanPraUji(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where a.aktif='0' AND prauji='0' AND d.aktif='1' order by id_retribusi desc")->result();
	}
	
	function getKendaraanBelumUji(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where a.aktif='0'  AND d.aktif='1' AND b.jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') order by id_retribusi desc")->result();
	}
	
	// PENGESAHAN
	
	function getPengesahanUji(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji where a.aktif='2'  AND c.aktif='1' order by a.kode_uji desc")->result();
	}
	
	function getProsesPengesahanUji($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_uji_detail b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where a.aktif='2' AND d.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getKendaraanPerbaikan(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where a.aktif='1' AND hasil='PERBAIKAN' AND d.aktif='1' order by id_retribusi desc")->result();
	}
	
	function getCariPerbaikan($match){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where a.aktif='1' AND hasil='PERBAIKAN' AND d.aktif='1' AND a.no_uji like '%$match%'")->result();
	}
	
	function getDetailPengujian($id){
		return $this->db->query("SELECT *,d.nama as pengguna, e.nama as penguji FROM tbl_uji a inner join tbl_uji_detail b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c 
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji inner join tbl_penguji e
		ON a.no_reg=e.no_reg where d.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getDetailStiker($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji left join tbl_penguji f
		ON a.no_reg = f.no_reg where kode_uji='$id'")->result();
	}
	
	function getDetailBuku($id){
		return $this->db->query("SELECT *, f.nama as pemilik, f.alamat as alamat_pemilik FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna f
        ON a.no_uji = f.no_uji left join tbl_penguji g
		ON a.no_reg=g.no_reg where kode_uji='$id' and f.aktif='1'")->result();
	}
	
	function getCetakBukuUji($id){
		return $this->db->query("SELECT *, b.no_uji as no_uji, b.no_kendaraan as no_kendaraan, f.nama as pemilik, f.alamat as alamat_pemilik FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna f
        ON a.no_uji = f.no_uji left join tbl_penguji g
		ON a.no_reg=g.no_reg inner join tbl_pendaftaran h
		ON a.kode_uji=h.kode_uji inner join tbl_retribusi i
		ON a.kode_uji=i.kode_uji left join tbl_pendaftaran_detail j
		ON a.kode_uji=j.kode_uji left join tbl_uji_detail k
		ON a.kode_uji=k.kode_uji where a.kode_uji='$id' and f.aktif='1' AND a.hasil='LULUS'")->result();
	}
	
	function getCetakKartuUji($id){
		return $this->db->query("SELECT *, b.no_uji as no_uji, b.no_kendaraan as no_kendaraan, f.nama as pemilik, f.alamat as alamat_pemilik,g.nama as penguji, h.jenis_uji as jenis_uji FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna f
        ON a.no_uji = f.no_uji left join tbl_penguji g
		ON a.no_reg=g.no_reg inner join tbl_pendaftaran h
		ON a.kode_uji=h.kode_uji inner join tbl_retribusi i
		ON a.kode_uji=i.kode_uji left join tbl_pendaftaran_detail j
		ON a.kode_uji=j.kode_uji left join tbl_uji_detail k
		ON a.kode_uji=k.kode_uji left join tbl_surat l
		ON a.kode_uji=l.kode_uji left join tbl_uji_keluar m
		ON a.kode_uji=m.kode_uji where a.kode_uji='$id' and f.aktif='1'")->result();
	}

	function getCetakBukuNumpang($id){
		return $this->db->query("SELECT *, f.nama as pemilik, f.alamat as alamat_pemilik FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna f
        ON a.no_uji = f.no_uji inner join tbl_surat g
		ON a.kode_uji=g.kode_uji where a.kode_uji='$id' and f.aktif='1'")->result();
	} 
	
	function getRiwayatUji($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji where a.no_uji='$id' AND a.aktif='1' order by kode_uji asc")->result();
	}
	
	function getDaftarTesting($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_testing order by id_testing desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlTesting(){
		return $this->db->query("SELECT * FROM tbl_testing")->num_rows();
	}
	
	function getCetakHasilUji($id){
		return $this->db->query("SELECT * from tbl_testing
		where no_uji='$id'")->result();
	}
	
	function getDataTesting($id){
		return $this->db->query("SELECT * from tbl_testing
		where id_testing='$id'")->result();
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
		
	function getDataTarif($id){
		return $this->db->query("SELECT b.jenis, b.tarif from
		tbl_kendaraan a left join tbl_retribusi_tarif b 
		ON a.kd_tarif = b.kd_tarif where a.no_uji = '$id'")->result();
	}
	
	function getTarifAdd(){
		return $this->db->query("SELECT * from tbl_retribusi_tarif")->result();
	}
	
	function getTarifBaru(){
		return $this->db->query("SELECT * from tbl_retribusi_tarif
		where jenis_retribusi='Retribusi' AND sifat='Baru'")->result();
	}
	
	function getTarifBerkala(){
		return $this->db->query("SELECT * from tbl_retribusi_tarif
		where jenis_retribusi='Retribusi' AND sifat='Berkala' OR sifat='Teknis'")->result();
	}
	
	function getTarifRetribusi(){
		return $this->db->query("SELECT * from tbl_retribusi_tarif
		where jenis_retribusi='Retribusi' order by kd_tarif desc")->result();
	}
	
	function getStikerBaru(){
		return $this->db->query("SELECT * FROM `tbl_retribusi_tarif` 
		where kd_tarif='TF-020'")->result();
	}
	
	function getPlatBaru(){
		return $this->db->query("SELECT * FROM `tbl_retribusi_tarif` 
		where kd_tarif='TF-019'")->result();
	}
	
	function getBukuBaru(){
		return $this->db->query("SELECT * FROM `tbl_retribusi_tarif` 
		where kd_tarif='TF-018'")->result();
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
	
	function get_tarif_by_id($kd_tarif){
		return $this->db->query("SELECT tarif FROM tbl_retribusi
		where kd_tarif='$kd_tarif'")->result();
	}
	
	function getRetribusiPKB($id){
		return $this->db->query("SELECT tarif*qty as total_pkb from tbl_retribusi a inner join tbl_retribusi_detail b
		ON a.id_retribusi=b.id_retribusi inner join tbl_retribusi_tarif c
		ON b.kd_tarif=c.kd_tarif where a.id_retribusi='$id' AND kd_barang=''")->result();
	}
	
	function getRetribusiPlat($id){
		return $this->db->query("SELECT tarif*qty as total_plat from tbl_retribusi a inner join tbl_retribusi_detail b
		ON a.id_retribusi=b.id_retribusi inner join tbl_retribusi_tarif c
		ON b.kd_tarif=c.kd_tarif where a.id_retribusi='$id' AND kd_barang='BR-002'")->result();
	}
	
	function getRetribusiBuku($id){
		return $this->db->query("SELECT tarif*qty as total_buku from tbl_retribusi a inner join tbl_retribusi_detail b
		ON a.id_retribusi=b.id_retribusi inner join tbl_retribusi_tarif c
		ON b.kd_tarif=c.kd_tarif where a.id_retribusi='$id' AND kd_barang='BR-001'")->result();
	}
	
	function getRetribusiStiker($id){
		return $this->db->query("SELECT tarif*qty as total_stiker from tbl_retribusi a inner join tbl_retribusi_detail b
		ON a.id_retribusi=b.id_retribusi inner join tbl_retribusi_tarif c
		ON b.kd_tarif=c.kd_tarif where a.id_retribusi='$id' AND kd_barang='BR-003'")->result();
	}
	
	function getRetribusiTotal($id){
		return $this->db->query("SELECT * FROM tbl_retribusi where id_retribusi='$id'")->result();
	}
	
	// PENGADUAN
	
	function getDataPengaduan($id){
		return $this->db->query("SELECT * FROM tbl_pengaduan
		where no_pengaduan= '$id'")->result();
	}
	
	function getAllDAtaPengaduan(){
		return $this->db->query("SELECT * FROM tbl_pengaduan
		where aktif='1'")->result();
	}
	
	// REMINDER
	
	function getReminder(){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join (
		select no_kendaraan, no_uji, max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_kendaraan) b
		ON a.no_uji = b.no_uji inner join tbl_pengguna c
		ON a.no_uji = c.no_uji where c.aktif = '1' ")->result();
	}
	
	function getReminderPengguna($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join (
		SELECT no_uji, max(kode_uji) as kode_uji from tbl_pendaftaran group by no_uji) c
		ON a.no_uji = c.no_uji inner join tbl_uji d
		ON c.kode_uji = d.kode_uji where a.no_uji='$id' AND tgl_habis_uji <= NOW() AND d.aktif = '1' AND telp<>'' ")->result();
	}
	
	function getJmlNotif(){
		return $this->db->query("SELECT * FROM tbl_log_notif")->num_rows();
	}
	
	function getRekapReminder($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_log_notif a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji where b.aktif='1' order by tgl_notif desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlKenUji(){
		return $this->db->query("SELECT * FROM tbl_uji 
		where tgl_habis_uji=CURDATE() AND aktif = '1'")->num_rows();
	}
	
	function getDaftarKenUji($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_kendaraan b 
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji where tgl_uji=CURDATE() AND a.aktif='1' AND c.aktif='1' order by kode_uji desc LIMIT $dari, $sampai")->result();
	}
	
	function getKenHariIni(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji where tgl_uji=CURDATE() AND a.aktif='1' AND b.aktif='1' AND telp<>'' ")->result();
	}
	
	// SETTING
	function getSetting(){
		return $this->db->query("SELECT * FROM tbl_setting")->result();
	}
	
	// CARI LAPORAN
	
	function getCariLaporan($kategori,$match){
		return $this->db->query("SELECT * FROM tbl_kendaraan a left join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_kendaraan, jenis_uji, max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_kendaraan) c
		ON b.no_uji = c.no_uji where b.aktif = '1' and $kategori like '%$match%' order by $kategori desc")->result();
	}
	
	function getJmlCariLaporan($kategori,$match){
		return $this->db->query("SELECT * FROM tbl_kendaraan a left join tbl_pengguna b
		ON a.no_uji = b.no_uji left join(
		select no_kendaraan, jenis_uji, max(tgl_uji) as max_tgl_uji ,max(tgl_habis_uji) as max_tgl_habis_uji from tbl_uji as tbl_uji group by no_kendaraan) c
		ON b.no_uji = c.no_uji where b.aktif = '1' and $kategori like '%$match%' order by $kategori desc")->num_rows();
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
	
	function getJmlPenggunaanBarang(){
		return $this->db->query("SELECT * FROM tbl_log_barang WHERE kd_barang='BR-001' OR kd_barang='BR-002' OR kd_barang='BR-003'")->num_rows();
	}
	
	public function getRekapPenggunaanBarang($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_log_barang a inner join tbl_barang b
		ON a.kd_barang=b.kd_barang ORDER BY tgl_penggunaan DESC LIMIT $dari, $sampai")->result();
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
	
	// LAPORAN
	
	public function getDataSTS($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_sts order by id_sts DESC LIMIT $dari, $sampai")->result();
	}
	
	public function getJmlSTS(){
		return $this->db->query("SELECT * FROM tbl_sts")->num_rows();
	}
	
	public function getJmlKenSTS(){
		return $this->db->query("SELECT * FROM tbl_retribusi where tgl_pembayaran=CURDATE()")->num_rows();
	}
	
	public function getJmlRetSTS(){
		return $this->db->query("SELECT SUM(total_retribusi) AS total_retribusi FROM tbl_retribusi where tgl_pembayaran=CURDATE()")->result();
	}
	
	public function getJmlMobPen(){
		return $this->db->query("SELECT sum(total_retribusi) as total FROM tbl_retribusi a inner join tbl_kendaraan b ON a.no_uji=b.no_uji
		WHERE a.tgl_pembayaran=CURDATE() AND b.kategori='Mobil Penumpang'")->result();
	}
	
	public function getJmlMobMinBus(){
		return $this->db->query("SELECT sum(total_retribusi) as total FROM tbl_retribusi a inner join tbl_kendaraan b ON a.no_uji=b.no_uji
		WHERE a.tgl_pembayaran=CURDATE() AND b.kategori='Mobil Mini Bus'")->result();
	}
	
	public function getJmlMobBus(){
		return $this->db->query("SELECT sum(total_retribusi) as total FROM tbl_retribusi a inner join tbl_kendaraan b ON a.no_uji=b.no_uji
		WHERE a.tgl_pembayaran=CURDATE() AND b.kategori='Mobil Bus'")->result();
	}
	
	public function getJmlMobBarPick(){
		return $this->db->query("SELECT sum(total_retribusi) as total FROM tbl_retribusi a inner join tbl_kendaraan b ON a.no_uji=b.no_uji
		WHERE a.tgl_pembayaran=CURDATE() AND b.kategori='Mobil Barang Pick Up'")->result();
	}
	
	public function getJmlMobBarTruck(){
		return $this->db->query("SELECT sum(total_retribusi) as total FROM tbl_retribusi a inner join tbl_kendaraan b ON a.no_uji=b.no_uji
		WHERE a.tgl_pembayaran=CURDATE() AND b.kategori='Mobil Barang Truck'")->result();
	}
	
	public function getJmlGanTem(){
		return $this->db->query("SELECT sum(total_retribusi) as total FROM tbl_retribusi a inner join tbl_kendaraan b ON a.no_uji=b.no_uji
		WHERE a.tgl_pembayaran=CURDATE() AND b.kategori='Gandeng & Kereta Tempelan'")->result();
	}
	
	public function getCetakSTS($id){
		return $this->db->query("SELECT * FROM tbl_sts a inner join tbl_sts_detail b
		ON a.id_sts=b.id_sts where a.id_sts='$id'")->result();
	}
	
	public function getLapPengujianTanggal($awal,$akhir){
		return $this->db->query("
		select 
			count(case when 'a' = tabel then no_uji end) mbaru,
			count(case when 'b' = tabel then no_uji end) mnum,
			count(case when 'c' = tabel then no_uji end) mnuk,
			count(case when 'd' = tabel then no_uji end) mmm,
			count(case when 'e' = tabel then no_uji end) mmk,
			count(case when 'f' = tabel then no_uji end) mpnm,
			count(case when 'g' = tabel then no_uji end) mbus1,
			count(case when 'h' = tabel then no_uji end) mtruck1, 
			count(case when 'i' = tabel then no_uji end) mbus2,
			count(case when 'j' = tabel then no_uji end) mtruck2,
			count(case when 'k' = tabel then no_uji end) mbus3,
			count(case when 'l' = tabel then no_uji end) mtruck3,
			count(case when 'm' = tabel then no_uji end) mbus4,
			count(case when 'n' = tabel then no_uji end) mtruck4,
			count(case when 'o' = tabel then no_uji end) gandeng,
			count(case when 'p' = tabel then no_uji end) tempelan
			From (
				select 'a' as tabel, a.no_uji from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Pertama' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'b' as tabel, a.no_uji from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Numpang Masuk' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'c' as tabel, a.no_uji from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Numpang Keluar' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'd' as tabel, a.no_uji from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Mutasi Masuk' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'e' as tabel, a.no_uji from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Mutasi Keluar' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'f' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbbpnm' AND kategori='Mobil Penumpang Taxi' AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'g' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb0kg' AND kategori='Mobil Mini Bus'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION 
				select 'h' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb0kg' AND (kategori='Mobil Barang Pick Up' 	OR kategori='Mobil Barang Truck')  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'i' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb4kg' AND kategori='Mobil Micro Bus'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'j' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb4kg' AND kategori='Mobil Barang Truck'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'k' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb8kg' AND kategori='Mobil Bus Sedang'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION 
				select 'l' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb8kg' AND kategori='Mobil Barang Truck'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION 
				select 'm' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb14kg' AND kategori='Mobil Bus'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'n' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb14kg' AND kategori='Mobil Barang Truck'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'o' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='GN' AND kategori='Kereta Gandeng'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'p' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='TP' AND kategori='Kereta Tempelan'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
			) as tt
		")->result();
	}
	
	public function getDataLapPengujianTanggal($awal,$akhir){
		return $this->db->query("
		select 
			(case when 'a' = tabel then no_uji end) mbaru,
			(case when 'b' = tabel then no_uji end) mnum,
			(case when 'c' = tabel then no_uji end) mnuk,
			(case when 'd' = tabel then no_uji end) mmm,
			(case when 'e' = tabel then no_uji end) mmk,
			(case when 'f' = tabel then no_uji end) mpnm,
			(case when 'g' = tabel then no_uji end) mbus1,
			(case when 'h' = tabel then no_uji end) mtruck1, 
			(case when 'i' = tabel then no_uji end) mbus2,
			(case when 'j' = tabel then no_uji end) mtruck2,
			(case when 'k' = tabel then no_uji end) mbus3,
			(case when 'l' = tabel then no_uji end) mtruck3,
			(case when 'm' = tabel then no_uji end) mbus4,
			(case when 'n' = tabel then no_uji end) mtruck4,
			(case when 'o' = tabel then no_uji end) gandeng,
			(case when 'p' = tabel then no_uji end) tempelan
			From (
				select 'p' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='TP' AND kategori='Kereta Tempelan'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'a' as tabel, a.no_kendaraan from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Pertama' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'b' as tabel, a.no_kendaraan from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Numpang Masuk' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'c' as tabel, a.no_kendaraan from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Numpang Keluar' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'd' as tabel, a.no_kendaraan from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Mutasi Masuk' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'e' as tabel, a.no_kendaraan from tbl_pendaftaran a inner join tbl_uji b ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where b.jenis_uji='Mutasi Keluar' AND (a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'f' as tabel, a.no_kendaraan from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbbpnm' AND kategori='Mobil Penumpang Taxi' AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'g' as tabel, a.no_kendaraan from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb0kg' AND kategori='Mobil Mini Bus'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION 
				select 'h' as tabel, a.no_kendaraan from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb0kg' AND (kategori='Mobil Barang Pick Up' 	OR kategori='Mobil Barang Truck')  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'i' as tabel, a.no_kendaraan from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb4kg' AND kategori='Mobil Micro Bus'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'j' as tabel, a.no_kendaraan from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb4kg' AND kategori='Mobil Barang Truck'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'k' as tabel, a.no_kendaraan from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb8kg' AND kategori='Mobil Bus Sedang'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION 
				select 'l' as tabel, a.no_kendaraan from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb8kg' AND kategori='Mobil Barang Truck'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION 
				select 'm' as tabel, a.no_kendaraan from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb14kg' AND kategori='Mobil Bus'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'n' as tabel, a.no_kendaraan from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='jbb14kg' AND kategori='Mobil Barang Truck'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				UNION
				select 'o' as tabel, a.no_uji from tbl_kendaraan a inner join tbl_pendaftaran b ON a.no_uji=b.no_uji where jenis_jbb='GN' AND kategori='Kereta Gandeng'  AND (b.tgl_daftar_uji BETWEEN '$awal' AND '$akhir')
				
			) as tt
		")->result();
	}
	
	public function getLapPenBaru($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pendaftaran b
		ON a.no_uji=b.no_uji where jenis_uji='Pertama' AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getLapPenBerkala($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pendaftaran b
		ON a.no_uji=b.no_uji where jenis_uji='Berkala' AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getLapPenNum($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pendaftaran b
		ON a.no_uji=b.no_uji where jenis_uji='Numpang Masuk' AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getLapPenNuk($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pendaftaran b
		ON a.no_uji=b.no_uji where jenis_uji='Numpang Keluar' AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getLapPenMM($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pendaftaran b
		ON a.no_uji=b.no_uji where jenis_uji='Mutasi Masuk' AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getLapPenMK($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pendaftaran b
		ON a.no_uji=b.no_uji where jenis_uji='Mutasi Keluar' AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getLapPendaftaran($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji where c.aktif='1' AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir' order by tgl_daftar_uji asc")->result();
	}
	
	public function getLapPendaftaranJenisUji($jenis,$awal,$akhir){
		return $this->db->query("SELECT *,a.no_uji as no_uji, a.jenis_uji as jenis_uji FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji left join tbl_pendaftaran_detail d
		ON a.no_uji=d.no_uji where c.aktif='1' AND a.jenis_uji='$jenis' AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir' order by tgl_daftar_uji asc")->result();
	}
	
	public function getLapPendaftaranJenisUjiBerkala($awal,$akhir){
		return $this->db->query("SELECT *,a.no_uji as no_uji, a.jenis_uji as jenis_uji FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji left join tbl_pendaftaran_detail d
		ON a.no_uji=d.no_uji where c.aktif='1' AND a.jenis_uji IN ('Berkala','Numpang Masuk','Mutasi Masuk') AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir' order by tgl_daftar_uji asc")->result();
	}
	
	public function getLapPendaftaranJenisKendaraan($jenis,$awal,$akhir){
		return $this->db->query("SELECT *,a.no_uji as no_uji, a.jenis_uji as jenis_uji FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji left join tbl_pendaftaran_detail d
		ON a.no_uji=d.no_uji where c.aktif='1' AND b.jenis IN ('$jenis') AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir' order by tgl_daftar_uji asc")->result();
	}
	
	public function getLapRetribusi($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_retribusi a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where b.aktif='1' AND tgl_pembayaran BETWEEN '$awal' AND '$akhir' order by tgl_pembayaran asc")->result();
	}
	
	public function getLapRetribusiBulanan($awal,$akhir){
		return $this->db->query("SELECT DATE(tgl_pembayaran) as tgl_pembayaran, count('total_retribusi') total_kendaraan, 
		sum(retribusi) retribusi, sum(stiker) stiker, sum(plat) plat, sum(buku) buku, sum(total_retribusi) total_retribusi
		FROM tbl_retribusi where tgl_pembayaran BETWEEN '$awal' AND '$akhir' group by DATE(tgl_pembayaran) order by tgl_pembayaran asc")->result();
	}
	
	public function getTotalRetribusiBulanan($awal,$akhir){
		return $this->db->query("SELECT sum(retribusi) as jml_retribusi, sum(buku) as jml_buku, sum(stiker) as jml_stiker, 
		sum(plat) as jml_plat, sum(total_retribusi) as jml_total_retribusi, count('total_retribusi') as jml_kendaraan from tbl_retribusi 
		where tgl_pembayaran BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getLapRetribusiTahunan($awal,$akhir){
		return $this->db->query("SELECT DATE_FORMAT(tgl_pembayaran, '%Y-%m') as tgl_pembayaran, SUM(total_retribusi) total_retribusi, 
		count('total_retribusi') total_kendaraan, SUM(retribusi) retribusi, SUM(stiker) stiker, SUM(plat) plat, SUM(buku) buku
		FROM tbl_retribusi where YEAR(tgl_pembayaran) BETWEEN '$awal' AND '$akhir' GROUP BY DATE_FORMAT(tgl_pembayaran, '%Y-%m')")->result();
	}
	
	public function getTotalRetribusiTahunan($awal,$akhir){
		return $this->db->query("SELECT sum(retribusi) as jml_retribusi, sum(buku) as jml_buku, sum(stiker) as jml_stiker, 
		sum(plat) as jml_plat, sum(total_retribusi) as jml_total_retribusi, count('total_retribusi') as jml_kendaraan from tbl_retribusi 
		where tgl_pembayaran BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getTotalRetribusi($awal,$akhir){
		return $this->db->query("SELECT sum(retribusi) as jml_retribusi, sum(buku) as jml_buku, sum(stiker) as jml_stiker, 
		sum(plat) as jml_plat, sum(total_retribusi) as jml_total_retribusi from tbl_retribusi 
		where tgl_pembayaran BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getJenisKendaraan(){
		return $this->db->query("SELECT jenis from tbl_kendaraan group by jenis")->result();
	}
	
	public function getWilayahKendaraan(){
		return $this->db->query("SELECT kecamatan from tbl_pengguna group by kecamatan")->result();
	}
	
	public function getRekapKendaraanJenisWilayah($jenis,$wilayah){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji where b.aktif='1' AND a.jenis IN ('$jenis') AND b.kecamatan IN ('$wilayah') order by a.no_uji asc")->result();
	}
	
	// SURAT
	public function getJmlMutasi(){
		return $this->db->query("SELECT * FROM tbl_surat where jenis_surat='mutasi' AND aktif='1'")->num_rows();
	}
	
	public function getDaftarMutasi($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where jenis_surat='mutasi' AND b.aktif='1' order by kode_uji desc LIMIT $dari, $sampai")->result();
	}
	
	public function getCariKendaraanSurat($match){
		return $this->db->query("SELECT * FROM tbl_pengguna a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji WHERE a.aktif='1' AND b.no_uji like '$match'")->result();
	}
	
	public function getCariKendaraanRekom($match){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji WHERE c.aktif='1' AND a.kode_uji='$match'")->result();
	}
	
	public function getJmlNumpang(){
		return $this->db->query("SELECT * FROM tbl_surat where jenis_surat='numpang' AND aktif='1'")->num_rows();
	}
	
	public function getDaftarNumpang($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where jenis_surat='numpang' AND b.aktif='1' order by kode_uji desc LIMIT $dari, $sampai")->result();
	}
	
	public function getSurat($id){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where id_surat='$id' AND b.aktif='1'")->result();
	}
	
	public function getEditSurat($id){
		return $this->db->query("SELECT * FROM tbl_surat a left join tbl_pengguna b 
		ON a.no_uji=b.no_uji left join tbl_kendaraan c
		ON a.no_uji=c.no_uji WHERE id_surat='$id' AND b.aktif='1'")->result();
	}
	
	public function getStatistikaJenis(){
		return $this->db->query("select jenis, count(*) as c from tbl_kendaraan 
		group by jenis having c >1 order by c desc")->result();
	}
	
	public function getStatistikaKategori(){
		return $this->db->query("select kategori, count(*) as c from tbl_kendaraan 
		group by kategori having c >1 order by c desc")->result();
	}
	
	public function getStatistikaJBB(){
		return $this->db->query("select jenis_jbb, count(*) as c from tbl_kendaraan 
		group by jenis_jbb having c >1 order by c desc")->result();
	}
	
	public function getStatistikaStatus(){
		return $this->db->query("select status, count(*) as c from tbl_kendaraan 
		group by status having c >1 order by c desc")->result();
	}
	
	//SMS
	
	public function getSms(){
		return $this->db->query("SELECT * FROM inbox 
		Where Processed = 'false'")->result();
	}
	
	public function getSmsCekData($no_uji){
		return $this->db->query("SELECT * from tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join (
		SELECT no_uji, max(kode_uji) as kode_uji, max(retribusi) as retribusi, max(stiker) as stiker, max(plat) as plat, max(buku) as buku from tbl_retribusi group by no_uji) c
		ON a.no_uji=c.no_uji inner join (
		SELECT no_uji, max(kode_uji) as kode_uji, max(tgl_habis_uji) as tgl_habis_uji from tbl_uji group by no_uji) d
		ON a.no_uji=d.no_uji where a.no_uji='$no_uji'");
	}
	
	//BERANDA
	
	function getRiwayatBlokir($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan_blokir a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji where a.no_uji='$id' AND a.aktif='1' order by a.tgl_blokir asc")->result();
	}
	
	function getAktifitas(){
		return $this->db->query("SELECT *,(select timediff(NOW(),tanggal)) as selisih from tbl_log_aktifitas a
		inner join tbl_admin b ON a.id_user=b.id_user order by id_log desc LIMIT 0, 25")->result();
	}
	
	function getChatting(){
		return $this->db->query("SELECT *,(select timediff(NOW(),waktu)) as selisih from tbl_chat a
		inner join tbl_pengguna b ON a.id_user=b.id_user order by id_chat desc LIMIT 0, 25")->result();
	}
	
	function getAllPesan($id){
		return $this->db->query("SELECT * FROM tbl_pesan a inner join tbl_admin b
		ON a.id_penerima=b.id_user where a.id_user='$id' OR a.id_penerima='$id' group by id_pesan order by max(waktu) desc")->result();
	}
	
	function getDataUser(){
		return $this->db->query("SELECT * FROM tbl_admin 
		where aktif='1'")->result();
	}
	
	function getDataPesan($id){
		return $this->db->query("SELECT * FROM tbl_pesan a inner join tbl_pengguna b
		ON a.id_user=b.id_user where a.id_pesan='$id' order by waktu desc")->result();
	}
	
	//AKTIFITAS
	
	function getAllAktifitas($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_log_aktifitas a inner join tbl_admin b
		ON a.id_user=b.id_user order by id_log desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlAktifitas(){
		return $this->db->query("SELECT * FROM tbl_log_aktifitas a inner join tbl_admin b
		ON a.id_user=b.id_user")->num_rows();
	}
	
	function getCariAktifitas($kategori,$match){
		return $this->db->query("SELECT * FROM tbl_log_aktifitas a inner join tbl_admin b
		ON a.id_user = b.id_user where $kategori like '%$match%' order by tanggal desc LIMIT 0, 200")->result();
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