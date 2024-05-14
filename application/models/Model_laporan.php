<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_laporan extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	// SURAT-SURAT
	public function getRekapSuratKeluar($jenis,$awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_surat a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji where c.aktif='1' AND a.jenis_surat='$jenis' and tgl_surat between '$awal' and '$akhir'")->result();
	}
	
	// LAPORAN
	
	public function getLapUjiTka1($tglawal,$tglakhir){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_uji b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d
		ON a.no_uji=d.no_uji where a.tgl_daftar_uji between '$tglawal' and '$tglakhir' AND d.aktif='1'")->result();
	}
	
	public function getJmlSifatTka1($tglawal,$tglakhir){
		return $this->db->query("SELECT sifat, count(sifat) as jumlah FROM tbl_pendaftaran a inner join tbl_kendaraan b
		on a.no_uji=b.no_uji where tgl_daftar_uji between '$tglawal' and '$tglakhir' group by sifat")->result();
	}
	
	public function getJmlJenisTka1($tglawal,$tglakhir){
		return $this->db->query("SELECT jenis_uji, count(jenis_uji) as jumlah FROM tbl_pendaftaran where tgl_daftar_uji between '$tglawal' and '$tglakhir' group by jenis_uji")->result();
	}
	
	public function getLapUjiTkb4($awal,$akhir){
		return $this->db->query("SELECT WEEK(tgl_daftar_uji) minggu, tgl_daftar_uji FROM tbl_pendaftaran 
		WHERE tgl_daftar_uji BETWEEN '$awal' and '$akhir' GROUP BY WEEK(tgl_daftar_uji)")->result();
	}
	
	public function getUjiTkb4($week,$tglyear,$jns,$sft){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where WEEK(tgl_daftar_uji)='$week' and year(tgl_daftar_uji)='$tglyear' and bentuk IN ('$jns') and sifat='$sft'")->num_rows();
	}
	
	public function getJmlUjiTkb4($week,$tglyear,$sft){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where WEEK(tgl_daftar_uji)='$week' and year(tgl_daftar_uji)='$tglyear' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeUjiTkb4($tglawal,$tglakhir,$jns,$sft){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_daftar_uji between '$tglawal' and '$tglakhir' and bentuk IN ('$jns') and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlUjiTkb4($tglawal,$tglakhir,$sft){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_daftar_uji between '$tglawal' and '$tglakhir' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlTotalUjiTkb4($tglawal,$tglakhir){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_daftar_uji between '$tglawal' and '$tglakhir'")->num_rows();
	}
	
	public function getJmlTotalUjiTkb4($week,$tglyear){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where WEEK(tgl_daftar_uji)='$week' and year(tgl_daftar_uji)='$tglyear'")->num_rows();
	}
	
	public function getLapUjiTkb5($awal,$akhir,$rekap){
		return $this->db->query("SELECT tgl_daftar_uji FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_daftar_uji BETWEEN '$awal' and '$akhir' GROUP BY $rekap(tgl_daftar_uji)")->result();
	}
	
	public function getUjiTkb5($tgl,$tglyear,$rekap,$jns,$sft){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where $rekap(tgl_daftar_uji)='$tgl' and year(tgl_daftar_uji)='$tglyear' and bentuk IN ('$jns') and sifat='$sft'")->num_rows();
	}
	
	public function getJmlUjiTkb5($tgl,$tglyear,$rekap,$sft){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where $rekap(tgl_daftar_uji)='$tgl'and year(tgl_daftar_uji)='$tglyear' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlTotalUjiTkb5($tgl,$tglyear,$rekap){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where $rekap(tgl_daftar_uji)='$tgl'and year(tgl_daftar_uji)='$tglyear'")->num_rows();
	}
	
	public function getRangeUjiTkb5($tglawal,$tglakhir,$jns,$sft){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_daftar_uji between '$tglawal' and '$tglakhir' and bentuk IN ('$jns') and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlUjiTkb5($tglawal,$tglakhir,$sft){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_daftar_uji between '$tglawal' and '$tglakhir' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlTotalUjiTkb5($tglawal,$tglakhir){
		return $this->db->query("SELECT bentuk FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_daftar_uji between '$tglawal' and '$tglakhir'")->num_rows();
	}
	
	public function getTahunKendTkb7($tglawal,$tglakhir,$jbb1,$jbb2,$umur1,$umur2,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jbb between '$jbb1' and '$jbb2' and tahun between '$umur1' and '$umur2' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlTahunKendTkb7($tglawal,$tglakhir,$umur1,$umur2,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and tahun between '$umur1' and '$umur2' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlTotalTahunKendTkb7($tglawal,$tglakhir,$umur1,$umur2,$jns){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and tahun between '$umur1' and '$umur2' and jenis='$jns'")->num_rows();
	}
	
	public function getJmlKendTkb7($tglawal,$tglakhir,$jbb1,$jbb2,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jbb between '$jbb1' and '$jbb2' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlSifatKendTkb7($tglawal,$tglakhir,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlTotalSifatKendTkb7($tglawal,$tglakhir,$jns){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis='$jns'")->num_rows();
	}
	
	public function getTotalKendTkb7($tglawal,$tglakhir,$jbb1,$jbb2,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jbb between '$jbb1' and '$jbb2' and sifat='$sft'")->num_rows();
	}
	
	public function getTotalJmlKendTkb7($tglawal,$tglakhir,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and sifat='$sft'")->num_rows();
	}
	
	public function getSemuaKendTkb7($tglawal,$tglakhir){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir'")->num_rows();
	}
	
	public function getKendTkc2($tglawal,$tglakhir,$jbb1,$jbb2,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jbb between '$jbb1' and '$jbb2' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlKendTkc2($tglawal,$tglakhir,$jbb1,$jbb2,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jbb between '$jbb1' and '$jbb2' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlTotalKendTkc2($tglawal,$tglakhir,$jbb1,$jbb2){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jbb between '$jbb1' and '$jbb2'")->num_rows();
	}
	
	public function getRangeKendTkc2($tglawal,$tglakhir,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlKendTkc2($tglawal,$tglakhir,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlTotalKendTkc2($tglawal,$tglakhir){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir'")->num_rows();
	}
	
	public function getBbmKendTkc2($tglawal,$tglakhir,$bbm,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and bahan_bakar='$bbm' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getBbmJmlKendTkc2($tglawal,$tglakhir,$bbm,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and bahan_bakar='$bbm' and sifat='$sft'")->num_rows();
	}
	
	public function getBbmJmlTotalKendTkc2($tglawal,$tglakhir,$bbm){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and bahan_bakar='$bbm'")->num_rows();
	}
	
	public function getKendTkc3($tglawal,$tglakhir,$da1,$da2,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and (da_barang+jml_da_orang) between '$da1' and '$da2' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlKendTkc3($tglawal,$tglakhir,$da1,$da2,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and (da_barang+jml_da_orang) between '$da1' and '$da2' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlTotalKendTkc3($tglawal,$tglakhir,$da1,$da2){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and (da_barang+jml_da_orang) between '$da1' and '$da2'")->num_rows();
	}
	
	public function getRangeKendTkc3($tglawal,$tglakhir,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlKendTkc3($tglawal,$tglakhir,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlTotalKendTkc3($tglawal,$tglakhir){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir'")->num_rows();
	}
	
	public function getKendTkc4($tglawal,$tglakhir,$mst1,$mst2,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and mst between '$mst1' and '$mst2' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlKendTkc4($tglawal,$tglakhir,$mst1,$mst2,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and mst between '$mst1' and '$mst2' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlTotalKendTkc4($tglawal,$tglakhir,$mst1,$mst2){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and mst between '$mst1' and '$mst2'")->num_rows();
	}
	
	public function getRangeKendTkc4($tglawal,$tglakhir,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlKendTkc4($tglawal,$tglakhir,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlTotalKendTkc4($tglawal,$tglakhir){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir'")->num_rows();
	}
	
	public function getUjiTkc5($tgl,$tglyear,$rekap,$jns,$sft){
		return $this->db->query("SELECT tgl_daftar_uji, jenis FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where jenis_uji='Pertama' and $rekap(tgl_daftar_uji)='$tgl' and year(tgl_daftar_uji)='$tglyear' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlUjiTkc5($tgl,$tglyear,$rekap,$sft){
		return $this->db->query("SELECT tgl_daftar_uji, jenis FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where jenis_uji='Pertama' and $rekap(tgl_daftar_uji)='$tgl'and year(tgl_daftar_uji)='$tglyear' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlTotalUjiTkc5($tgl,$tglyear,$rekap){
		return $this->db->query("SELECT tgl_daftar_uji, jenis FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where jenis_uji='Pertama' and $rekap(tgl_daftar_uji)='$tgl'and year(tgl_daftar_uji)='$tglyear'")->num_rows();
	}
	
	public function getRangeUjiTkc5($tglawal,$tglakhir,$jns,$sft){
		return $this->db->query("SELECT tgl_daftar_uji, jenis FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where jenis_uji='Pertama' and tgl_daftar_uji between '$tglawal' and '$tglakhir' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlUjiTkc5($tglawal,$tglakhir,$sft){
		return $this->db->query("SELECT tgl_daftar_uji, jenis FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where jenis_uji='Pertama' and tgl_daftar_uji between '$tglawal' and '$tglakhir' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlTotalUjiTkc5($tglawal,$tglakhir){
		return $this->db->query("SELECT tgl_daftar_uji, jenis FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where jenis_uji='Pertama' and tgl_daftar_uji between '$tglawal' and '$tglakhir'")->num_rows();
	}
	
	public function getJmlAktifTkc6($kat,$jns,$tgl){
		return $this->db->query("SELECT no_uji FROM tbl_kendaraan where status='0' AND $kat='$jns' AND temp_tgl_habis_uji>'$tgl'")->num_rows();
	}
	
	public function getJmlTkc6($kat,$jns){
		return $this->db->query("SELECT no_uji FROM tbl_kendaraan where status='0' AND $kat='$jns'")->num_rows();
	}
	
	public function getTotalJmlAktifTkc6($kat,$tgl){
		return $this->db->query("SELECT no_uji FROM tbl_kendaraan where status='0' AND  $kat!='' AND temp_tgl_habis_uji>'$tgl'")->num_rows();
	}
	
	public function getTotalJmlTkc6($kat){
		return $this->db->query("SELECT no_uji FROM tbl_kendaraan where status='0' AND $kat!=''")->num_rows();
	}
	
	public function getKendTkc7($tglawal,$tglakhir,$do1,$do2,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and da_orang between '$do1' and '$do2' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlKendTkc7($tglawal,$tglakhir,$do1,$do2,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis in ('MOBIL PENUMPANG','MOBIL BUS') and da_orang between '$do1' and '$do2' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlTotalKendTkc7($tglawal,$tglakhir,$do1,$do2){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis in ('MOBIL PENUMPANG','MOBIL BUS') and da_orang between '$do1' and '$do2'")->num_rows();
	}
	
	public function getRangeKendTkc7($tglawal,$tglakhir,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlKendTkc7($tglawal,$tglakhir,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis in ('MOBIL PENUMPANG','MOBIL BUS') and sifat='$sft'")->num_rows();
	}
	
	public function getRangeJmlTotalKendTkc7($tglawal,$tglakhir){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis in ('MOBIL PENUMPANG','MOBIL BUS')")->num_rows();
	}
	
	public function getBbmKendTkc7($tglawal,$tglakhir,$bbm,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and bahan_bakar='$bbm' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getBbmJmlKendTkc7($tglawal,$tglakhir,$bbm,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis in ('MOBIL PENUMPANG','MOBIL BUS') and bahan_bakar='$bbm' and sifat='$sft'")->num_rows();
	}
	
	public function getBbmJmlTotalKendTkc7($tglawal,$tglakhir,$bbm){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran between '$tglawal' and '$tglakhir' and jenis in ('MOBIL PENUMPANG','MOBIL BUS') and bahan_bakar='$bbm'")->num_rows();
	}
	
	public function getJmlKend($tgl,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran='$tgl' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlKendTahunan($mtgl,$ytgl,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where month(tgl_pembayaran)='$mtgl' and year(tgl_pembayaran)='$ytgl' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getTotalJmlKend($awal,$akhir,$jns,$sft){
		return $this->db->query("SELECT a.no_uji FROM tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran BETWEEN '$awal' AND '$akhir' and jenis='$jns' and sifat='$sft'")->num_rows();
	}
	
	public function getJmlUjiPertama($tglawal,$tglakhir,$rekap){
		return $this->db->query("SELECT tgl_daftar_uji FROM tbl_pendaftaran a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_daftar_uji BETWEEN '$tglawal' and '$tglakhir' GROUP BY $rekap(tgl_daftar_uji)")->result();
	}
	
	// LAPORAN
	public function getLapPenBaru($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji where c.aktif='1' AND jenis_uji='Pertama' AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir'")->result();
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
		ON a.no_uji=d.no_uji where c.aktif='1' AND a.jenis_uji IN ('Berkala','Numpang Masuk','Mutasi Masuk','Kehilangan buku uji atau stiker') AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir' order by tgl_daftar_uji asc")->result();
	}
	
	public function getLapPendaftaranJenisKendaraan($jenis,$awal,$akhir){
		return $this->db->query("SELECT *,a.no_uji as no_uji, a.jenis_uji as jenis_uji FROM tbl_pendaftaran a inner join tbl_kendaraan b
		ON a.no_uji=b.no_uji inner join tbl_pengguna c
		ON a.no_uji=c.no_uji left join tbl_pendaftaran_detail d
		ON a.no_uji=d.no_uji where c.aktif='1' AND b.jenis IN ('$jenis') AND tgl_daftar_uji BETWEEN '$awal' AND '$akhir' order by tgl_daftar_uji asc")->result();
	}
	
	//RETRIBUSI
	
	public function getLapRetribusi($awal,$akhir){
		return $this->db->query("SELECT * FROM tbl_retribusi a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pendaftaran d 
		ON a.kode_uji=d.kode_uji where b.aktif='1' AND tgl_pembayaran BETWEEN '$awal' AND '$akhir' order by a.kode_uji asc")->result();
	}
	
	public function getTotalRetribusi($awal,$akhir){
		return $this->db->query("SELECT sum(retribusi) as total_retribusi, sum(plat) as total_plat, sum(buku) as total_buku, sum(stiker) as total_stiker, sum(retribusi) as total_retribusi, sum(jml_denda) as jml_total_denda,
		sum(total_retribusi) as jml_total_retribusi, sum(total_semua) as jml_total_semua from tbl_retribusi where tgl_pembayaran BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getLapJenisRetribusi($awal,$akhir){
		return $this->db->query("select jenis_kendaraan, kategori, retribusi, buku, count(retribusi) as jumlah, sum(total_retribusi) as total from tbl_retribusi a inner join tbl_kendaraan b 
		on a.no_uji=b.no_uji where tgl_pembayaran BETWEEN '$awal' AND '$akhir' group by retribusi, buku, jenis_kendaraan order by jenis_kendaraan desc, kategori, retribusi asc, buku asc")->result();
	}
	
	public function getLapRetribusiBulanan($awal,$akhir){
		return $this->db->query("SELECT tgl_pembayaran, count(retribusi) as jml_kb, sum(retribusi) as total_retribusi, sum(tanda) as total_tanda, sum(jml_denda) as total_denda, 
		sum(total_retribusi) as jml_total_retribusi, sum(total_semua) as jml_total_semua FROM tbl_retribusi where tgl_pembayaran BETWEEN '$awal' AND '$akhir' group by DATE(tgl_pembayaran) order by tgl_pembayaran asc")->result();
	}
	
	public function getTotalRetribusiBulanan($awal,$akhir){
		return $this->db->query("SELECT count(retribusi) as jml_kb, sum(retribusi) as total_retribusi, sum(tanda) as total_tanda, sum(jml_denda) as total_denda, 
		sum(total_retribusi) as jml_total_retribusi, sum(total_semua) as jml_total_semua FROM tbl_retribusi where tgl_pembayaran BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getLapRetribusiTahunan($awal,$akhir){
		return $this->db->query("SELECT DATE_FORMAT(tgl_pembayaran, '%Y-%m') as tgl_pembayaran, sum(retribusi) as total_retribusi, sum(tanda) as total_tanda, sum(jml_denda) as total_denda, 
		sum(total_retribusi) as jml_total_retribusi, sum(total_semua) as jml_total_semua FROM tbl_retribusi where YEAR(tgl_pembayaran) BETWEEN '$awal' AND '$akhir' GROUP BY DATE_FORMAT(tgl_pembayaran, '%Y-%m')")->result();
	}
	
	public function getTotalRetribusiTahunan($awal,$akhir){
		return $this->db->query("SELECT DATE_FORMAT(tgl_pembayaran, '%Y-%m') as tgl_pembayaran, sum(retribusi) as total_retribusi, sum(tanda) as total_tanda, sum(jml_denda) as total_denda, 
		sum(total_retribusi) as jml_total_retribusi, sum(total_semua) as jml_total_semua FROM tbl_retribusi where tgl_pembayaran BETWEEN '$awal' AND '$akhir'")->result();
	}
	
	public function getJenisKendaraan(){
		return $this->db->query("SELECT jenis from tbl_kendaraan group by jenis")->result();
	}
	
	public function getWilayahKendaraan(){
		return $this->db->query("SELECT kecamatan from tbl_pengguna group by kecamatan")->result();
	}
	
	public function getRekapKendaraanJenisWilayah($jenis,$wilayah,$sort){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji inner join (SELECT MAX(kode_uji) as kode_uji, no_uji from tbl_pendaftaran group by no_uji) c
		ON a.no_uji=c.no_uji inner join tbl_uji d
		ON c.kode_uji=d.kode_uji where b.aktif='1' AND a.jenis IN ('$jenis') AND b.kecamatan IN ('$wilayah') order by $sort asc")->result();
	}
	
	public function getRekapKendaraanJenisUmur($jenis,$operasi,$umur){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji where b.aktif='1' AND jenis IN ('$jenis') AND tahun $operasi YEAR(CURDATE()) - $umur order by tahun desc")->result();
	}
	
	public function getRekapKendaraanNoKendaraan($jenis,$depan,$belakang,$no_ken_awal,$no_ken_akhir){
		return $this->db->query("SELECT * FROM tbl_kendaraan a inner join tbl_pengguna b
		ON a.no_uji=b.no_uji where b.aktif='1' AND a.$jenis BETWEEN '$no_ken_awal' AND '$no_ken_akhir' AND a.$jenis REGEXP '^$depan' 
		AND a.$jenis REGEXP '$belakang$' order by a.$jenis asc")->result();
	}
	
	public function getDataLapPengujianTanggal($awal,$akhir){
		return $this->db->query("SELECT *,e.nama as penguji, d.nama as nama FROM tbl_pendaftaran a inner join tbl_uji b
		ON a.kode_uji=b.kode_uji inner join tbl_kendaraan c
		ON a.no_uji=c.no_uji inner join tbl_pengguna d 
		ON a.no_uji=d.no_uji inner join tbl_penguji e
		ON b.no_reg=e.no_reg where b.aktif='1' AND a.tgl_daftar_uji BETWEEN '$awal' AND '$akhir' AND a.jenis_uji NOT IN ('Mutasi Keluar,Numpang Keluar,Penggantian buku uji atau stiker,Kehilangan buku uji atau stiker') order by a.kode_uji asc")->result();
	}
	
	public function getAjaxLaporanBulanan($jns,$stat,$thaw,$thak,$jbaw,$jbak,$tgaw,$tgak){
		return $this->db->query("SELECT COUNT(*) as jumlah FROM tbl_pendaftaran a INNER JOIN tbl_kendaraan b 
		ON a.no_uji = b.no_uji inner join tbl_kendaraan_ban c 
		ON b.no_uji=c.no_uji where jbb BETWEEN '$jbaw' AND '$jbak' AND jenis_kendaraan='$jns' 
		AND status='$stat' AND tahun BETWEEN '$thaw' AND '$thak' AND tgl_daftar_uji BETWEEN '$tgaw' AND '$tgak'")->result();
	}
	
	
	// STS
	
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
		$bul = $this->romawi($m);
		
		return $kd."/".$bul."/".$y;
	}
	
	public function getDataSTS($sampai,$dari){
		return $this->db->query("SELECT * FROM tbl_sts order by id_sts DESC LIMIT $dari, $sampai")->result();
	}
	
	public function getJmlSTS(){
		return $this->db->query("SELECT * FROM tbl_sts")->num_rows();
	}
	
	public function getTotalSts($tgl){
		return $this->db->query("SELECT sum(retribusi) as total_retribusi, sum(tanda) as total_tanda, sum(jml_denda) as total_denda, 
		sum(total_retribusi) as jml_total_retribusi from tbl_retribusi a inner join tbl_pendaftaran b
		ON a.kode_uji=b.kode_uji where jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') AND tgl_pembayaran='$tgl'")->result();
	}
	
	public function getStsJbb($tgl,$jbb1,$jbb2){
		return $this->db->query("SELECT sum(total_retribusi) as total FROM tbl_kendaraan a inner join tbl_retribusi b
		ON a.no_uji=b.no_uji inner join tbl_pendaftaran c
		ON b.kode_uji=c.kode_uji where jenis NOT IN ('KERETA GANDENGAN','KERETA TEMPELAN') AND jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') AND tgl_pembayaran='$tgl' AND jbb between '$jbb1' and '$jbb2'")->result();
	}
	
	public function getStsKereta($tgl){
		return $this->db->query("SELECT sum(total_semua) as total FROM tbl_kendaraan a inner join tbl_retribusi b
		ON a.no_uji=b.no_uji inner join tbl_pendaftaran c
		ON b.kode_uji=c.kode_uji where jenis IN ('KERETA GANDENGAN','KERETA TEMPELAN') AND jenis_uji NOT IN ('Mutasi Keluar','Numpang Keluar') AND tgl_pembayaran='$tgl'")->result();
	}
	
	public function getStsNumpang($tgl){
		return $this->db->query("SELECT sum(total_semua) as total FROM tbl_kendaraan a inner join tbl_retribusi b
		ON a.no_uji=b.no_uji inner join tbl_pendaftaran c
		ON b.kode_uji=c.kode_uji where jenis_uji IN ('Mutasi Keluar','Numpang Keluar') AND tgl_pembayaran='$tgl'")->result();
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