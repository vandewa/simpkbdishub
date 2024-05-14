<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_pengujian extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	function getSmartCard($id){
		return $this->db->query("SELECT *,e.nama as pemilik, f.idx as penguji, f.nama as nama_penguji FROM tbl_pendaftaran a inner join tbl_uji b 
		ON a.kode_uji=b.kode_uji inner join tbl_uji_detail c
		ON a.kode_uji=c.kode_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji inner join tbl_pengguna e 
		ON a.no_uji=e.no_uji inner join penguji f
		ON b.id_penguji=f.idx where e.aktif='1' AND a.kode_uji='$id'")->result();
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
	
	function getJmlDataUji(){
		return $this->db->query("SELECT * FROM datapengujian")->num_rows();
	}
	
	function getDaftarDataPengujian($sampai,$dari){
		return $this->db->query("SELECT * from datapengujian order by idx desc LIMIT $dari, $sampai")->result();
	}
	
	function getJmlUji(){
		return $this->db->query("SELECT *, a.aktif as aktif FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where a.aktif in ('2','3','4') AND a.tgl_uji=CURDATE()")->num_rows();
	}
	
	function getJmlHabisUji(){
		return $this->db->query("SELECT * FROM (SELECT no_uji, kode_uji, no_kendaraan, tgl_uji, MAX(tgl_habis_uji) AS max_tgl_habis_uji, hasil, aktif FROM tbl_uji AS tbl_uji GROUP BY no_uji) a 
		inner join tbl_kendaraan b ON a.no_uji=b.no_uji 
		inner join tbl_pengguna c ON a.no_uji=c.no_uji where max_tgl_habis_uji <= NOW() AND c.aktif='1'")->num_rows();
	}
	
	function getDaftarPengujian($sampai,$dari){
		return $this->db->query("SELECT *, a.aktif as aktif, d.idx as penguji, d.nama as nama_penguji FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji left join penguji d
		ON a.id_penguji = d.idx where a.aktif in ('2','3','4') AND a.tgl_uji=CURDATE() order by a.aktif asc, uji asc, id_uji desc LIMIT $dari, $sampai")->result();
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
		ON a.no_uji=d.no_uji inner join tbl_kendaraan e
		ON a.no_uji=e.no_uji where a.aktif='0' AND a.status='5' AND d.aktif='1' AND b.jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') AND a.no_uji like '$match'")->result();
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
		return $this->db->query("SELECT *, a.aktif as aktif, d.idx as penguji, d.nama as nama_penguji FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join penguji d
		ON a.id_penguji=d.idx where tgl_uji='$match' AND a.aktif in ('2','3','4') AND c.aktif='1' order by a.tgl_uji DESC")->result();
	}
	
	function getCariUji($match){
		return $this->db->query("SELECT *, a.aktif as aktif, d.idx as penguji, d.nama as nama_penguji FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join penguji d
		ON a.id_penguji=d.idx where a.aktif in ('2','3','4') AND c.aktif='1' AND a.no_uji like '%$match%' OR a.no_kendaraan like '%$match%' order by a.tgl_daftar_uji DESC")->result();
	}
	
	function getCariHasilUji($match){
		return $this->db->query("SELECT *, a.aktif as aktif, d.idx as penguji, d.nama as nama_penguji FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join penguji d
		ON a.id_penguji=d.idx where a.kode_uji='$match' order by a.tgl_daftar_uji DESC")->result();
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
	
	function getSkrgFotoKendaraan(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where foto='0' AND d.aktif='1' AND b.tgl_daftar_uji=CURDATE() order by a.kode_uji asc")->result();
	}
	
	function getDaftarFotoKendaraan(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where foto='0' AND d.aktif='1' order by a.kode_uji desc")->result();
	}
	
	function getDaftarFotoTanggal($match){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where foto='0' AND d.aktif='1' AND b.tgl_daftar_uji='$match' order by a.kode_uji asc")->result();
	}
	
	function getCekFoto($kode_uji){
		return $this->db->query("select * from tbl_uji_foto where kode_uji='$kode_uji'")->num_rows();
	}
	
	function getCekFotoKamera($kodefoto){
		return $this->db->query("select * from tbl_uji_foto where foto='$kodefoto'")->num_rows();
	}
	
	function getDeleteFotoKamera($id,$cam){
		return $this->db->query("DELETE FROM tbl_uji_foto WHERE kode_uji='$id' and kamera='$cam'");
	}
	
	function getSkrgKendaraanBelumUji(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji inner join tbl_kendaraan e
		ON a.no_uji=e.no_uji where a.aktif='0' AND a.status='5' AND d.aktif='1' AND b.jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') AND b.tgl_daftar_uji=CURDATE() order by id_uji asc")->result();
	}
	
	function getKendaraanBelumUji(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji inner join tbl_kendaraan e
		ON a.no_uji=e.no_uji where a.aktif='0' AND a.status='5' AND d.aktif='1' AND b.jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') order by id_uji asc")->result();
	}
	
	function getCariTanggalBelumUji($match){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_retribusi c
		ON a.kode_uji=c.kode_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji inner join tbl_kendaraan e
		ON a.no_uji=e.no_uji where a.aktif='0' AND a.status='5' AND d.aktif='1' AND b.jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') AND b.tgl_daftar_uji='$match' order by id_uji asc")->result();
	}
	
	function getKendaraanUjiMassal(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji where a.aktif='0' AND a.status<5 AND c.aktif='1' AND b.jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') and b.tgl_daftar_uji=CURDATE() order by id_uji asc")->result();
	}
	
	function getUjiItem($status){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji where a.aktif='0' AND c.aktif='1' AND b.jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') and a.status<='$status' order by a.kode_uji desc")->result();
	}
	
	function getCatatanUji($id){
		return $this->db->query("SELECT * FROM tbl_uji_catatan where kode_uji='$id' AND jns='0'")->result();
	}
	
	function getPerbaikanUji($id){
		return $this->db->query("SELECT * FROM tbl_uji_catatan where kode_uji='$id' AND jns='1'")->result();
	}
	
	function getStatusUji(){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_uji b
		ON a.kode_uji=b.kode_uji inner join tbl_uji_detail c
		ON a.kode_uji=c.kode_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji inner join tbl_pengguna e
		ON a.no_uji=e.no_uji where d.aktif='1' AND tgl_uji=CURDATE() AND jenis_uji IN('Pertama','Berkala','Numpang Masuk','Mutasi Masuk')")->result();
	}
	
	// PERSETUJUAN
	
	function getJmlCetakuji(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where d.aktif='2' and a.aktif='1'")->num_rows();
	}
	
	function getDataCetakUji($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where d.aktif='1' and a.aktif='2' order by id_uji desc LIMIT $dari, $sampai")->result();
	}
	
	// PENGESAHAN
	
	function getPengesahanUji(){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji where a.aktif='1'  AND c.aktif='1' order by a.kode_uji desc")->result();
	}
	
	function getProsesPengesahanUji($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_uji_detail b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where a.aktif='1' AND d.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getKendaraanPerbaikan(){
		return $this->db->query("SELECT *, a.aktif as aktif, e.idx as penguji, e.nama as nama_penguji FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji inner join penguji e
		ON a.id_penguji=e.idx where a.aktif IN ('3','4') AND hasil='TIDAK LULUS' AND c.aktif='1' order by a.kode_uji desc")->result();
	}
	
	function getCariPerbaikan($match){
		return $this->db->query("SELECT *, a.aktif as aktif, e.idx as penguji, e.nama as nama_penguji FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji inner join penguji e
		ON a.id_penguji=e.idx where a.aktif IN ('3','4') AND hasil='TIDAK LULUS' AND c.aktif='1' AND a.no_uji like '%$match%'")->result();
	}
	
	function getRiwayatUji($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_uji_riwayat b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji where c.aktif='1' AND a.kode_uji='$id' order by id_riwayat desc")->result();
	}
	
	function getDetailPengujian($id){
		return $this->db->query("SELECT *,d.nama as pengguna, e.nama as penguji FROM tbl_uji a inner join tbl_uji_detail b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c 
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji inner join penguji e
		ON a.id_penguji=e.idx where d.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getCetakStiker($id){
		return $this->db->query("SELECT * FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_penguji d
		ON a.no_reg=d.no_reg where a.kode_uji='$id'")->result();
	}
	
	function getCetakBukuUji($id){
		return $this->db->query("SELECT *, a.kode_uji as kode_uji, a.no_uji as no_uji, g.nama as pemilik, e.nama as penguji FROM tbl_uji a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji inner join tbl_uji_detail c
		ON a.kode_uji=c.kode_uji inner join tbl_retribusi d
		ON a.kode_uji=d.kode_uji inner join tbl_penguji e
		ON a.no_reg=e.no_reg inner join tbl_kendaraan f
		ON a.no_uji=f.no_uji inner join tbl_pengguna g
		ON a.no_uji=g.no_uji left join tbl_pendaftaran_detail h
		ON a.kode_uji=h.kode_uji where a.kode_uji='$id' and g.aktif='1' and a.aktif='3'")->result();
	}
	
	function getCetakBukuUjis($id){
		return $this->db->query("SELECT *, b.no_uji as no_uji, b.no_kendaraan as no_kendaraan, f.nama as pemilik, f.alamat as alamat_pemilik FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna f
        ON a.no_uji = f.no_uji left join tbl_penguji g
		ON a.no_reg=g.no_reg inner join tbl_pendaftaran h
		ON a.kode_uji=h.kode_uji inner join tbl_retribusi i
		ON a.kode_uji=i.kode_uji left join tbl_pendaftaran_detail j
		ON a.kode_uji=j.kode_uji left join tbl_uji_detail k
		ON a.kode_uji=k.kode_uji where a.kode_uji='$id' and f.aktif='1' AND a.aktif='3'")->result();
	}
	
	function getDetailBuku($id){
		return $this->db->query("SELECT *, f.nama as pemilik, f.alamat as alamat_pemilik FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna f
        ON a.no_uji = f.no_uji left join tbl_penguji g
		ON a.no_reg=g.no_reg where kode_uji='$id' and f.aktif='1'")->result();
	}

	function getCetakBukuNumpang($id){
		return $this->db->query("SELECT *, f.nama as pemilik, f.alamat as alamat_pemilik FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna f
        ON a.no_uji = f.no_uji inner join tbl_surat g
		ON a.kode_uji=g.kode_uji where a.kode_uji='$id' and f.aktif='1'")->result();
	} 
	
	function getDataKendaraan($id){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji where a.no_uji='$id'")->result();
	}
	
	function getDataInputPengujian($id){
		return $this->db->query("SELECT *,b.nama as penguji FROM tbl_uji a left join tbl_penguji b
		ON a.no_reg=b.no_reg where a.no_uji= '$id' group by a.kode_uji order by tgl_uji asc")->result();
	}
	
	function getCetakKartuUji($id){
		return $this->db->query("SELECT *, b.no_uji as no_uji, b.no_kendaraan as no_kendaraan, f.nama as pemilik, f.alamat as alamat_pemilik,g.nama as penguji, h.jenis_uji as jenis_uji FROM tbl_uji a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna f
        ON a.no_uji = f.no_uji left join penguji g
		ON a.id_penguji=g.idx inner join tbl_pendaftaran h
		ON a.kode_uji=h.kode_uji inner join tbl_retribusi i
		ON a.kode_uji=i.kode_uji left join tbl_pendaftaran_detail j
		ON a.kode_uji=j.kode_uji left join tbl_uji_detail k
		ON a.kode_uji=k.kode_uji left join tbl_surat l
		ON a.kode_uji=l.kode_uji left join tbl_uji_keluar m
		ON a.kode_uji=m.kode_uji left join tbl_barang n
		ON a.kode_uji=n.kode_uji where a.kode_uji='$id' and f.aktif='1'")->result();
	}
	
	function getCetakSKTL($id){
		return $this->db->query("Select *,c.nama as penguji, d.no_kendaraan as no_kendaraan From tbl_pendaftaran a inner join tbl_uji b
		on a.kode_uji=b.kode_uji inner join penguji c
		ON b.id_penguji=c.idx inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji inner join tbl_pengguna e
		ON a.no_uji=e.no_uji inner join tbl_surat f
		ON a.kode_uji=f.kode_uji where e.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getCetakLhp($id){
		return $this->db->query("Select *,c.nama as penguji, d.no_kendaraan as no_kendaraan From tbl_pendaftaran a inner join tbl_uji b
		on a.kode_uji=b.kode_uji inner join penguji c
		ON b.id_penguji=c.idx inner join tbl_kendaraan d
		ON a.no_uji=d.no_uji inner join tbl_pengguna e
		ON a.no_uji=e.no_uji where e.aktif='1' AND a.kode_uji='$id'")->result();
	}
	
	function getCatKerusakan($id){
		return $this->db->query("Select * from tbl_uji_catatan where kode_uji='$id' AND jns='0'")->result();
	}
	
	function getCatPerbaikan($id){
		return $this->db->query("Select * from tbl_uji_catatan where kode_uji='$id' AND jns='1'")->result();
	}
	
	function getCekCatatan($kode_uji){
		return $this->db->query("SELECT * FROM tbl_uji_catatan WHERE kode_uji='$kode_uji' and aktif='1'")->num_rows();
	}
	
	function getHasilUji($id){
		return $this->db->query("SELECT * FROM tbl_uji_riwayat a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji where kode_uji='$id' order by id_riwayat desc limit 1")->result();
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
	public function getRowData($table,$data)
    {
        return $this->db->get_where($table, $data)->num_rows();
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