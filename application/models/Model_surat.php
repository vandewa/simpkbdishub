<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_surat extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	// DATA KODE
	
	public function getKodeSuratMutasi(){
		$mn = date("m");
		$th = date("Y");
		
		$q = $this->db->query("select MAX(LEFT(no_surat,2)) as kd_max from tbl_surat where jenis_surat='mutasi' AND MONTH(tgl_surat)=$mn AND YEAR(tgl_surat)=$th");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%02s", $tmp);
            }
        }else{
            $kd = "01";
        }
		
		$qts = $this->db->query("select count(*) as total_surat from tbl_surat where jenis_surat='mutasi' AND YEAR(tgl_surat)=$th")->result();
		foreach($qts as $row){
			$t_surat = $row->total_surat;
		}
		if($t_surat == 0){
			$ts = 1;
		} else {
			$ts = $t_surat+1;
		}
		
		$bul = $this->romawi($mn);
		
        return $kd."/".$ts."/".$bul."/MK/".$th;
	}
	
	public function getKodeSuratNumpang(){		
		$mn = date("m");
		$th = date("Y");
		
		$qms = $this->db->query("select count(*) as total_surat from tbl_surat where jenis_surat='numpang' AND MONTH(tgl_surat)=$mn AND YEAR(tgl_surat)=$th")->result();
		foreach($qms as $row){
			$m_surat = $row->total_surat;
		}
		if($m_surat == 0){
			$kd = 1;
		} else {
			$kd = $m_surat+1;
		}
		
		$qts = $this->db->query("select count(*) as total_surat from tbl_surat where jenis_surat='numpang' AND YEAR(tgl_surat)=$th")->result();
		foreach($qts as $row){
			$t_surat = $row->total_surat;
		}
		if($t_surat == 0){
			$ts = 1;
		} else {
			$ts = $t_surat+1;
		}
		
		$bul = $this->romawi($mn);
		
        return $kd."/".$ts."/".$bul."/NUK/".$th;
	}
	
	public function getKodeSuratRekom(){
		$mn = date("m");
		$th = date("Y");
		
		$q = $this->db->query("select MAX(LEFT(no_rekom,3)) as kd_max from tbl_kendaraan_baru where YEAR(tgl_rekom)=$th");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
		
        return $kd."/402.106/".$th;
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
	
	public function getKodeSuratSKTL(){
		$mn = date("m");
		$th = date("Y");
		
		$q = $this->db->query("select MAX(LEFT(no_surat,4)) as kd_max from tbl_surat where jenis_surat='sktl' AND YEAR(tgl_surat)=$th");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
		
		$bul = $this->romawi($mn);
		
        return $kd."/".$bul."/SKTL/".$th;
	}
	
	public function getProsesRekom($id){
		return $this->db->query("SELECT *,a.no_uji as no_uji, a.kode_uji as kode_uji FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji left join tbl_uji_keluar d
		ON a.kode_uji=d.kode_uji left join tbl_mutasi e
		ON a.kode_uji=e.kode_uji WHERE c.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	public function getEditMutasi($id){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_mutasi d
		ON a.kode_uji=d.kode_uji inner join tbl_uji_keluar e
		ON a.kode_uji=e.kode_uji where id_surat='$id' AND b.aktif='1'")->result();
	}
	
	public function getEditNumpang($id){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_uji_keluar d
		ON a.kode_uji=d.kode_uji where id_surat='$id' AND b.aktif='1'")->result();
	}
	
	// SURAT
	public function getUjiBerkala($ids){
		return $this->db->query("select * from tbl_uji a inner join tbl_penguji b on a.no_reg=b.no_reg 
		where no_uji='$ids' ORDER BY kode_uji DESC LIMIT 1")->result();
	}
	
	public function getTanggalRekom($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c ON a.no_uji=c.no_uji where jenis_surat IN ('numpang','mutasi') AND b.aktif='1' AND tgl_surat BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getJmlRekom(){
		return $this->db->query("SELECT * FROM tbl_surat where jenis_surat IN ('numpang','mutasi') AND aktif='1'")->num_rows();
	}
	
	public function getDaftarRekom($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where jenis_surat IN ('numpang','mutasi') AND b.aktif='1' order by id_surat desc LIMIT $dari, $sampai")->result();
	}
	
	public function getCariRekom($id){
		return $this->db->query("SELECT * FROM tbl_pengguna a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji WHERE a.aktif='1' AND b.no_uji like '$match'")->result();
	}
	
	public function getTanggalSktl($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_uji d
		ON a.kode_uji=d.kode_uji where jenis_surat='sktl' AND b.aktif='1' AND tgl_surat BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getJmlSktl(){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_uji d
		ON a.kode_uji=d.kode_uji where jenis_surat='sktl' AND b.aktif='1'")->num_rows();
	}
	
	public function getDaftarSktl($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_uji d
		ON a.kode_uji=d.kode_uji where jenis_surat='sktl' AND b.aktif='1' order by a.kode_uji desc LIMIT $dari, $sampai")->result();
	}
	
	public function getCariSktl($id){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_uji d
		ON a.kode_uji=d.kode_uji where jenis_surat='sktl' AND b.aktif='1' AND a.no_uji like '$id'")->result();
	}
	
	public function getSurat($id){
		return $this->db->query("SELECT *,a.no_uji as no_uji, a.no_kendaraan as no_kendaraan, b.nama as nama FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_mutasi d
		ON a.kode_uji=d.kode_uji where id_surat='$id' AND b.aktif='1'")->result();
	}
	
	public function getSuratNumpang($id){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_uji d
		ON a.kode_uji=d.kode_uji where id_surat='$id' AND b.aktif='1'")->result();
	}
	
	public function getAllTeknis($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_kendaraan_baru LIMIT $dari, $sampai")->result();
	}
	
	public function getJmlTeknis(){
		return $this->db->query("SELECT * FROM tbl_kendaraan_baru")->num_rows();
	}
	
	public function getTtdSurat($ttd){
		return $this->db->query("SELECT * FROM tbl_pejabat where jabatan='$ttd' and aktif='1'")->result();
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