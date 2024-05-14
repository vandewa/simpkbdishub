<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_app');
		$this->load->model('model_kendaraan','kendaraan');
		$this->load->model('model_pendaftaran','pendaftaran');
		$this->load->model('akses');
		$this->load->library('fpdf');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function index(){
		$this->akses->akses_petugas();
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};

		$num = $this->pendaftaran->getJmlDaftar();
		$config=array(
			'base_url'=>base_url().$this->router->fetch_class().'/'.$this->router->fetch_method(),
			'total_rows'=>$num,
			'per_page'=>20,
			'full_tag_open'=> "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>",
			'full_tag_close'=> "</ul>",
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => "<li class='disabled'><li class='active'><a href='#'>",
			'cur_tag_close' => "<span class='sr-only'></span></a></li>",
			'next_tag_open' => "<li>",
			'next_tagl_close' => "</li>",
			'prev_tag_open' => "<li>",
			'prev_tagl_close' => "</li>",
			'first_tag_open' => "<li>",
			'first_tagl_close' => "</li>",
			'last_tag_open' => "<li>",
			'last_tagl_close' => "</li>"
		);

		$data=array(
			'title'=>'Rekap Pendaftaran Uji Kendaraan Bermotor',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'rekap_pendaftaran'=>'active',
			'dt_pendaftaran'=>$this->pendaftaran->getRekapPendaftaran($config['per_page'],$dari),
			'start'=>$dari,
		);

		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_rekap_daftar');
		$this->load->view('pages/v_footer');
	}

	public function cari(){
		$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Rekap Pendaftaran Uji Kendaraan Bermotor',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'rekap_pendaftaran'=>'active',
			'dt_pendaftaran'=>$this->pendaftaran->getCariDaftar($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_rekap_daftar');
		$this->load->view('pages/v_footer');
	}

	public function datapendaftaran(){
		$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Rekap Pendaftaran Uji Kendaraan Bermotor',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'rekap_pendaftaran'=>'active',
			'dt_pendaftaran'=>$this->pendaftaran->getCariDaftarUji($id),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_rekap_daftar');
		$this->load->view('pages/v_footer');
	}

	public function rekap_tanggal(){
		$this->akses->akses_petugas();
		$match = $this->input->post('caritgl');
		$data=array(
			'title'=>'Rekap Pendaftaran Uji Kendaraan Bermotor',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'rekap_pendaftaran'=>'active',
			'dt_pendaftaran'=>$this->pendaftaran->getCariTanggalDaftar($match),
			'start'=>0,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_rekap_daftar');
		$this->load->view('pages/v_footer');
	}
	
	public function prosesdaftaruji(){
		$match = $this->uri->segment(3);
		$data=array(
			'title'=>'Pendaftaran Uji Kendaraan Bermotor',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'pendaftaran'=>'active',
			'kode_uji'=>time(),
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'), 
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
			'terbit'=>$this->pendaftaran->getAllData('kodepenerbitan'),
			'cari_pengujian'=>$this->pendaftaran->getCariDataUji($match),
			'data_penguji'=>$this->pendaftaran->getAllData('tbl_penguji'),
			'data_tarif'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Retribusi'))->result(),
			'denda'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Denda'))->result(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_daftar_uji_berkala');
		$this->load->view('pages/v_footer');
	}

	public function daftarulang(){
		$this->akses->akses_petugas();
		$match = $this->uri->segment(3);
		$data=array(
			'title'=>'Pendaftaran Uji Kendaraan Bermotor',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'pendaftaran'=>'active',
			'kode_uji'=>time(),
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'),
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'terbit'=>$this->pendaftaran->getAllData('kodepenerbitan'),
			'cari_pengujian'=>$this->pendaftaran->getCariDataUji($match),
			'data_penguji'=>$this->pendaftaran->getAllData('tbl_penguji'),
			'data_tarif'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Retribusi'))->result(),
			'denda'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Denda'))->result(),
			'tglpendaftaran'=>$tgl,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_daftar_uji_berkala_ulang');
		$this->load->view('pages/v_footer');
	}
	
	public function uji(){
		$this->akses->akses_petugas();
		$data=array(
			'title'=>'Pendaftaran Uji Kendaraan Bermotor',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'daftar'=>'active',
			'kode_uji'=>time(),
			'dt_kota'=>$this->kendaraan->getAllData('tbl_kabupaten'),
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'),
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
			'terbit'=>$this->pendaftaran->getAllData('kodepenerbitan'),
			'data_tarif'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Retribusi'))->result(),
			'plat'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Plat'))->result(),
			'buku'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Buku'))->result(),
			'stiker'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Stiker'))->result(),
			'denda'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Denda'))->result(),
			'penguji'=>$this->pendaftaran->getPengujiAktif(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_daftar_uji');
		$this->load->view('pages/v_footer');
	}

	public function daftar_uji(){
		$this->akses->akses_petugas();
		$jns_kend = $this->input->post('jenis');
		if($this->input->post('jenis_nouji')=='BARU'){
			$no_uji = $this->kendaraan->getNoUjiBaru($jns_kend);
		} else {
			$no_uji = $this->input->post('no_uji');
		}
		$jenis_uji = $this->input->post('jenis_uji');
		$kode_uji = $this->input->post('kode_uji');
		$tanggal_daftar = $this->input->post('tgl_daftar_uji');
		$status_pemohon = $this->input->post('status_pemohon');
		$antrian = $this->pendaftaran->getNomorAntrian();
		$no_kw = $this->pendaftaran->getKodeKwitansi();
		$hbs_uji = date('Y-m-d', strtotime("+6 month"));
		
		if($this->input->post('jenis_uji')=='Numpang Masuk'){
			$status_kendaraan = 1;
		} else {
			$status_kendaraan = 0;
		}
		
		$billing = $this->pendaftaran->getKodeBilling();
		$expired = strtotime("+2 day");
		$tgl_dftr = date('Y-m-d H:i:s');
		$tgl_exp = date('Y-m-d H:i:s',$expired);
		
		$kode = $this->generate_kode();
		$idb['kode'] = $this->generate_kode();
		$cek_kode = $this->pendaftaran->getSelectedData('tbl_kode',$idb)->num_rows();
		if($cek_kode > 0){
			$kode = $this->generate_kode();
		}
		$qrcode_data = "http://192.168.1.250/beranda/cekuji/".$kode;
		
		$status_terbit = $this->input->post('status_terbit');
		$setting = $this->pendaftaran->getAllData('tbl_setting');
		foreach($setting as $set){
			if(($status_terbit=="5") || ($status_terbit=="6")){
				$kd_wil_asal = $this->input->post('kd_wil_asal');
			} else {
				$kd_wil_asal = $set->kodewilayah;
			}
		}
		
		if($status_pemohon=='pemilik'){
			$ktp = $this->input->post('no_ktp');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
		} else if($status_pemohon=='dikuasakan'){
			$ktp = $this->input->post('no_ktp_pemohon');
			$nama = $this->input->post('nama_pemohon');
			$alamat =$this->input->post('alamat_pemohon');
		}
		
		$pendaftaran=array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'no_antrian'=>$antrian,
			'no_ktp_pemohon'=>$ktp,
			'nama_pemohon'=>$nama,
			'alamat_pemohon'=>$alamat,
			'tgl_daftar_uji'=>$tanggal_daftar,
			'waktu_pendaftaran'=>date("Y-m-d H:i:s"),
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'qr_kodeuji'=>$kode,
			'status_terbit'=>$this->input->post('status_terbit'),
			'kd_wil_asal'=>$kd_wil_asal,
			'aktif'=>1,
		);
		
		$uji_masuk = array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'num_dari'=>$this->input->post('num_dari'),
			'num_nomor'=>$this->input->post('num_nomor'),
			'num_tgl'=>$this->input->post('num_tgl'),
		);

		$uji_kehilangan = array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'num_nomor'=>$this->input->post('no_kehilangan'),
			'num_tgl'=>$this->input->post('tgl_kehilangan'),
		);

		$pengguna=array(
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_stnk'=>$this->input->post('tgl_stnk'),
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
			'telp'=>$this->input->post('no_telp'),
			'aktif'=>1,
		);

		$kendaraan=array(
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'jenis'=>$this->input->post('jenis'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'bentuk'=>$this->input->post('bentuk'),
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
			'tahun'=>$this->input->post('tahun'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'no_rangka'=>$this->input->post('no_rangka'),
			'jbb'=>$this->input->post('jbb'),
			'sifat'=>$this->input->post('sifat'),
			'status'=>$status_kendaraan,
		);

		$uji=array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'id_penguji'=>$this->input->post('penguji'),
			'tgl_uji'=>$this->input->post('tgl_daftar_uji'),
			'tgl_daftar_uji'=>$this->input->post('tgl_daftar_uji'),
			'tgl_hbs_uji_sebelum'=>$this->input->post('tgl_habis_uji'),
			'tgl_habis_uji'=>$this->input->post('tgl_habis_uji'),
			'aktif'=>0,
		);

		$detail_uji=array(
			'kode_uji'=>$kode_uji,
		);
		
		$retribusi=array(
			'kode_uji'=>$kode_uji,
			'no_kwitansi'=>$no_kw,
			'no_uji'=>$no_uji,
			'id_billing'=>$billing,
			'exp_billing'=>$tgl_exp,
			'tgl_pembayaran'=>$this->input->post('tgl_daftar_uji'),
			'status_bayar'=>0,
			'retribusi'=>$this->input->post('retribusi'),
			'plat'=>$this->input->post('plat'),
			'buku'=>$this->input->post('buku'),
			'stiker'=>$this->input->post('stiker'),
			'denda'=>$this->input->post('denda'),
			'jml_denda'=>$this->input->post('jml_denda'),
			'total_retribusi'=>$this->input->post('total_retribusi'),
			'total_semua'=>$this->input->post('total_semua'),
			'terbilang'=>$this->input->post('terbilang'),
			'aktif'=>1,
		);

		$pemohon=array(
			'no_ktp'=>$ktp,
			'nama'=>$nama,
			'alamat'=>$alamat,
			'telp'=>$this->input->post('no_telp'),
		);
		
		$tblantrian=array(
			'tgl_antrian'=>$tanggal_daftar,
			'kode_uji'=>$kode_uji,
			'no_antrian'=>$antrian,
		);
		
		$tblkode=array(
			'kode'=>$kode,
		);
		
		if($ktp!=""){
			$ktpx['no_ktp'] = $ktp;
			$cek_ktp = $this->pendaftaran->getCekPemohon($ktp);
			if($cek_ktp == "0"){
				$this->pendaftaran->insertData('tbl_pemohon',$pemohon);
			} else {
				$this->pendaftaran->updateData('tbl_pemohon',$pemohon,$ktpx);
			}
		}
		
		if(($jenis_uji=='Numpang Masuk') || ($jenis_uji=='Mutasi Masuk')){
			$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_masuk);
		} else if ($jenis_uji=="Kehilangan"){
			$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_kehilangan);
		}
		
		$this->pendaftaran->insertData('tbl_pendaftaran',$pendaftaran);
		$this->pendaftaran->insertData('tbl_retribusi',$retribusi);
		$this->pendaftaran->insertData('tbl_uji',$uji);
		$this->pendaftaran->insertData('tbl_uji_detail',$detail_uji);
		$this->pendaftaran->insertData('tbl_pengguna',$pengguna);
		$this->pendaftaran->insertData('tbl_kendaraan',$kendaraan);
		$this->pendaftaran->insertData('tbl_antrian',$tblantrian);
		$this->pendaftaran->insertData('tbl_kode',$tblkode);
		$this->generate_qrcode($qrcode_data,$kode,$tanggal_daftar);
		$this->generate_qrbilling($billing,$tanggal_daftar);
		$this->aktifitas_tambah($no_uji);
		redirect('pendaftaran/datapendaftaran/'.$kode_uji);
	}

	public function ujiberkala(){
		$this->akses->akses_petugas();
		$match = $this->input->post('cari');
		$data=array(
			'title'=>'Pendaftaran Uji Kendaraan Bermotor',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'daftar'=>'active',
			'kode_uji'=>time(),
			'no_uji'=>$match,
			'dt_kota'=>$this->kendaraan->getAllData('tbl_kabupaten'),
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'),
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
			'terbit'=>$this->pendaftaran->getAllData('kodepenerbitan'),
			'cari_pengujian'=>$this->pendaftaran->getCariDataUji($match),
			'data_penguji'=>$this->pendaftaran->getAllData('tbl_penguji'),
			'data_tarif'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Retribusi'))->result(),
			'v_daftar'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Daftar'))->result(),
			'plat'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Plat'))->result(),
			'buku'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Buku'))->result(),
			'stiker'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Stiker'))->result(),
			'denda'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Denda'))->result(),
			'penguji'=>$this->pendaftaran->getPengujiAktif(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_daftar_uji_berkala');
		$this->load->view('pages/v_footer');
	}

	public function daftar_uji_berkala(){
		$this->akses->akses_petugas();
		$idp = $this->input->get('idp', TRUE);
		$idpx['id_user'] = $this->input->get('idp', TRUE);
		$no_uji = $this->input->post('no_uji');
		$no_ujix['no_uji'] = $this->input->post('no_uji');
		$jenis_uji = $this->input->post('jenis_uji');
		$status_pemilik = $this->input->post('status_pemilik');
		$status_pemohon = $this->input->post('status_pemohon');
		$tanggal_daftar = $this->input->post('tgl_daftar_uji');
		$kode_uji = $this->input->post('kode_uji');
		$antrian = $this->pendaftaran->getNomorAntrian();
		$no_kw = $this->pendaftaran->getKodeKwitansi();
		$hbs_uji = date('Y-m-d', strtotime("+6 month"));
		
		if($this->input->post('jenis_uji')=='Numpang Masuk'){
			$status_kendaraan = 1;
		} else {
			$status_kendaraan = 0;
		}
		
		$billing = $this->pendaftaran->getKodeBilling();
		$expired = strtotime("+2 day");
		$tgl_dftr = date('Y-m-d H:i:s');
		$tgl_exp = date('Y-m-d H:i:s',$expired);
		
		$kode = $this->generate_kode();
		$idb['kode'] = $this->generate_kode();
		$cek_kode = $this->pendaftaran->getSelectedData('tbl_kode',$idb)->num_rows();
		if($cek_kode > 0){
			$kode = $this->generate_kode();
		}
		$qrcode_data = "http://192.168.1.250/beranda/cekuji/".$kode;
		
		$cekonline = $this->pendaftaran->getCekOnline($no_uji);
		if($cekonline > 0){
			$online=array(
				'aktif'=>0,
			);
			$this->model_app->updateData('tbl_pra_pendaftaran',$online,$no_ujix);
		}
		
		$status_terbit = $this->input->post('status_terbit');
		$setting = $this->pendaftaran->getAllData('tbl_setting');
		foreach($setting as $set){
			if(($status_terbit=="5") || ($status_terbit=="6")){
				$kd_wil_asal = $this->input->post('kd_wil_asal');
			} else {
				$kd_wil_asal = $set->kodewilayah;
			}
		}
		
		$uji_masuk = array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'num_dari'=>$this->input->post('num_dari'),
			'num_nomor'=>$this->input->post('num_nomor'),
			'num_tgl'=>$this->input->post('num_tgl'),
		);
		
		$uji_keluar=array(
			'kode_uji'=>$kode_uji,
			'jenis_uji_keluar'=>$jenis_uji,
			'no_uji'=>$no_uji,
			'tujuan_num'=>$this->input->post('nuk_tujuan'),
			'kota_num'=>$this->input->post('nuk_kota'),
			'tgl'=>date("Y-m-d"),
		);
		
		$mutasi_keluar=array(
			'no_uji'=>$no_uji,
			'nama_baru'=>$this->input->post('nm_baru'),
			'alamat_baru'=>$this->input->post('nm_alamat'),
			'dasar'=>$this->input->post('mk_dasar'),
			'no_dasar'=>$this->input->post('mk_dasar_no'),
			'tgl_dasar'=>$this->input->post('tgl_dasar'),
			'kota_dasar'=>$this->input->post('mk_dasar_kota'),
			'kode_uji'=>$kode_uji,
			'tgl_mutasi'=>date("Y-m-d"),
		);
		
		$uji_kehilangan = array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'num_nomor'=>$this->input->post('no_kehilangan'),
			'num_tgl'=>$this->input->post('tgl_kehilangan'),
		);

		$pengguna=array(
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'telp'=>$this->input->post('no_telp'),
		);

		$pengguna_baru = array(
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_stnk'=>$this->input->post('tgl_stnk'),
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
			'telp'=>$this->input->post('no_telp'),
			'aktif'=>1,
		);

		$kendaraan=array(
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'jenis'=>$this->input->post('jenis'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'bentuk'=>$this->input->post('bentuk'),
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'no_rangka'=>$this->input->post('no_rangka'),
			'sifat'=>$this->input->post('sifat'),
			'jbb'=>$this->input->post('jbb'),
			'status'=>$status_kendaraan,
		);
		
		if($status_pemohon=='pemilik'){
			$ktp = $this->input->post('no_ktp_pemilik');
			$nama = $this->input->post('nama_pemilik');
			$alamat = $this->input->post('alamat_pemilik');
		} else if($status_pemohon=='dikuasakan'){
			$ktp = $this->input->post('no_ktp_pemohon');
			$nama = $this->input->post('nama_pemohon');
			$alamat =$this->input->post('alamat_pemohon');
		}
		
		$pendaftaran=array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'no_antrian'=>$antrian,
			'no_ktp_pemohon'=>$ktp,
			'nama_pemohon'=>$nama,
			'alamat_pemohon'=>$alamat,
			'tgl_daftar_uji'=>$tanggal_daftar,
			'waktu_pendaftaran'=>date("Y-m-d H:i:s"),
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'qr_kodeuji'=>$kode,
			'status_terbit'=>$this->input->post('status_terbit'),
			'kd_wil_asal'=>$kd_wil_asal,
			'aktif'=>1,
		);

		$retribusi=array(
			'kode_uji'=>$kode_uji,
			'no_kwitansi'=>$no_kw,
			'no_uji'=>$no_uji,
			'id_billing'=>$billing,
			'exp_billing'=>$tgl_exp,
			'tgl_pembayaran'=>$this->input->post('tgl_daftar_uji'),
			'status_bayar'=>0,
			'retribusi'=>$this->input->post('retribusi'),
			'plat'=>$this->input->post('plat'),
			'buku'=>$this->input->post('buku'),
			'stiker'=>$this->input->post('stiker'),
			'denda'=>$this->input->post('denda'),
			'jml_denda'=>$this->input->post('jml_denda'),
			'total_retribusi'=>$this->input->post('total_retribusi'),
			'total_semua'=>$this->input->post('total_semua'),
			'terbilang'=>$this->input->post('terbilang'),
			'aktif'=>1,
		);

		$uji=array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'id_penguji'=>$this->input->post('penguji'),
			'tgl_uji'=>$this->input->post('tgl_daftar_uji'),
			'tgl_daftar_uji'=>date("Y-m-d H:i:s"),
			'tgl_hbs_uji_sebelum'=>$this->input->post('tgl_habis_uji'),
			'tgl_habis_uji'=>$this->input->post('tgl_habis_uji'),
			'aktif'=>0,
		);

		$uji_numpang=array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_uji'=>$this->input->post('tgl_daftar_uji'),
			'tgl_daftar_uji'=>date("Y-m-d H:i:s"),
			'tgl_habis_uji'=>$this->input->post('tgl_habis_uji'),
			'aktif'=>1,
		);
		
		$detail_uji=array(
			'kode_uji'=>$kode_uji,
		);

		$pemohon=array(
			'no_ktp'=>$ktp,
			'nama'=>$nama,
			'alamat'=>$alamat,
			'telp'=>$this->input->post('no_telp'),
		);
		
		$tblantrian=array(
			'tgl_antrian'=>$tanggal_daftar,
			'kode_uji'=>$kode_uji,
			'no_antrian'=>$antrian,
		);
		
		$tblkode=array(
			'kode'=>$kode,
		);
		
		$this->pendaftaran->insertData('tbl_pendaftaran',$pendaftaran);
		$this->pendaftaran->insertData('tbl_retribusi',$retribusi);
		$this->pendaftaran->updateData('tbl_kendaraan',$kendaraan,$no_ujix);
		$this->pendaftaran->insertData('tbl_antrian',$tblantrian);
		$this->pendaftaran->insertData('tbl_kode',$tblkode);
		
		if(($jenis_uji=='Numpang Masuk') || ($jenis_uji=='Mutasi Masuk')){
			$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_masuk);
		} else if(($jenis_uji=='Numpang Keluar') || ($jenis_uji=='Mutasi Keluar')){
			$this->pendaftaran->insertData('tbl_uji_keluar',$uji_keluar);
			if($jenis_uji=='Mutasi Keluar'){
				$this->pendaftaran->insertData('tbl_mutasi',$mutasi_keluar);
			}
		} else if ($jenis_uji=="Kehilangan"){
			$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_kehilangan);
		}
		
		if($ktp!=""){
			$ktpx['no_ktp'] = $ktp;
			$cek_ktp = $this->pendaftaran->getCekPemohon($ktp);
			if($cek_ktp == "0"){
				$this->pendaftaran->insertData('tbl_pemohon',$pemohon);
			} else {
				$this->pendaftaran->updateData('tbl_pemohon',$pemohon,$ktpx);
			}
		}

		if($status_pemilik=='ganti_nama'){
			$this->pendaftaran->updateData('tbl_pengguna',array('aktif' => 0),$idpx);
			$this->pendaftaran->insertData('tbl_pengguna',$pengguna_baru);
		} else if ($status_pemilik=='ubah_data'){
			$this->pendaftaran->updateData('tbl_pengguna',$pengguna_baru,$idpx);
		} else {
			$this->pendaftaran->updateData('tbl_pengguna',$pengguna,$idpx);
		}
		
		if(($jenis_uji=='Numpang Keluar') || ($jenis_uji=='Mutasi Keluar')){
			$this->pendaftaran->insertData('tbl_uji',$uji_numpang);
		} else {
			$this->pendaftaran->insertData('tbl_uji',$uji);
		}
		$this->pendaftaran->insertData('tbl_uji_detail',$detail_uji);
		
		$this->generate_qrcode($qrcode_data,$kode,$tanggal_daftar);
		$this->generate_qrbilling($billing,$tanggal_daftar);
		$this->aktifitas_tambah($no_uji);
		redirect('pendaftaran/datapendaftaran/'.$kode_uji);
	}
	
	public function edit(){
		$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Edit Pendaftaran',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'daftar'=>'active',
			'edit_pendaftaran'=>$this->pendaftaran->getDataPendaftaran($id),
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'),
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'terbit'=>$this->pendaftaran->getAllData('kodepenerbitan'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
			'data_tarif'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Retribusi'))->result(),
			'v_daftar'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Daftar'))->result(),
			'plat'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Plat'))->result(),
			'buku'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Buku'))->result(),
			'stiker'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Stiker'))->result(),
			'denda'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Denda'))->result(),
			'penguji'=>$this->pendaftaran->getPengujiAktif(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_edit_pendaftaran');
		$this->load->view('pages/v_footer');
	}

	public function edit_data_pendaftaran(){
		$this->akses->akses_petugas();
		$idp = $this->input->get('idp', TRUE);
		$idpx['id_user'] = $this->input->get('idp', TRUE);
		$kodeuji = $this->input->get('kodeuji', TRUE);
		$kodeujix['kode_uji'] = $this->input->get('kodeuji', TRUE);
		$tanggal_daftar = $this->input->get('tgldaftar', TRUE);
		$no_uji = $this->input->post('no_uji');
		$no_ujix['no_uji'] = $this->input->post('no_uji');
		$ktp = $this->input->post('no_ktp_pemohon');
		$ktpx['no_ktp'] = $this->input->post('no_ktp_pemohon');
		$status_pemilik = $this->input->post('status_pemilik');
		$jenis_uji = $this->input->post('jenis_uji');
		$hbs_uji = date('Y-m-d', strtotime("+6 month"));
		
		if($this->input->post('jenis_uji')=='Numpang Masuk'){
			$status_kendaraan = 1;
		} else {
			$status_kendaraan = 0;
		}
		
		$kode = $this->generate_kode();
		$idb['kode'] = $this->generate_kode();
		$cek_kode = $this->pendaftaran->getSelectedData('tbl_kode',$idb)->num_rows();
		if($cek_kode > 0){
			$kode = $this->generate_kode();
		}
		$qrcode_data = "http://192.168.1.250/beranda/cekuji/".$kode;
		
		$status_billing = $this->input->post('status_billing');
		if($status_billing=="TETAP"){
			$billing = $this->input->post('kode_billing');
			$tgl_exp = $this->input->post('exp_billing');
		} else {
			$billing = $this->pendaftaran->getKodeBilling();
			$expired = strtotime("+2 day");
			$tgl_dftr = date('Y-m-d H:i:s');
			$tgl_exp = date('Y-m-d H:i:s',$expired);
		}
		
		$status_terbit = $this->input->post('status_terbit');
		$setting = $this->pendaftaran->getAllData('tbl_setting');
		foreach($setting as $set){
			if(($status_terbit=="5") || ($status_terbit=="6")){
				$kd_wil_asal = $this->input->post('kd_wil_asal');
			} else {
				$kd_wil_asal = $set->kodewilayah;
			}
		}
				
		$pengguna=array(
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'telp'=>$this->input->post('no_telp'),
		);

		$pengguna_baru = array(
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_stnk'=>$this->input->post('tgl_stnk'),
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
			'telp'=>$this->input->post('no_telp'),
			'aktif'=>1,
		);

		$kendaraan=array(
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'jenis'=>$this->input->post('jenis'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'bentuk'=>$this->input->post('bentuk'),
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
			'tahun'=>$this->input->post('tahun'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'no_rangka'=>$this->input->post('no_rangka'),
			'jbb'=>$this->input->post('jbb'),
			'sifat'=>$this->input->post('sifat'),
			'status'=>$status_kendaraan,
		);
		
		$pendaftaran=array(
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'no_ktp_pemohon'=>$this->input->post('no_ktp_pemohon'),
			'nama_pemohon'=>$this->input->post('nama_pemohon'),
			'alamat_pemohon'=>$this->input->post('alamat_pemohon'),
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'qr_kodeuji'=>$kode,
			'status_terbit'=>$this->input->post('status_terbit'),
			'kd_wil_asal'=>$kd_wil_asal,
			'aktif'=>1,
		);
		
		$retribusi=array(
			'id_billing'=>$billing,
			'exp_billing'=>$tgl_exp,
			'retribusi'=>$this->input->post('retribusi'),
			'plat'=>$this->input->post('plat'),
			'buku'=>$this->input->post('buku'),
			'stiker'=>$this->input->post('stiker'),
			'denda'=>$this->input->post('denda'),
			'jml_denda'=>$this->input->post('jml_denda'),
			'total_retribusi'=>$this->input->post('total_retribusi'),
			'total_semua'=>$this->input->post('total_semua'),
			'terbilang'=>$this->input->post('terbilang'),
			'aktif'=>1,
		);
		
		$uji_masuk = array(
			'kode_uji'=>$kodeuji,
			'no_uji'=>$no_uji,
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'num_dari'=>$this->input->post('num_dari'),
			'num_nomor'=>$this->input->post('num_nomor'),
			'num_tgl'=>$this->input->post('num_tgl'),
		);
		
		$uji_keluar=array(
			'kode_uji'=>$kodeuji,
			'jenis_uji_keluar'=>$jenis_uji,
			'no_uji'=>$no_uji,
			'tujuan_num'=>$this->input->post('nuk_tujuan'),
			'kota_num'=>$this->input->post('nuk_kota'),
			'tgl'=>date("Y-m-d"),
		);
		
		$mutasi_keluar=array(
			'no_uji'=>$no_uji,
			'nama_baru'=>$this->input->post('nm_baru'),
			'alamat_baru'=>$this->input->post('nm_alamat'),
			'dasar'=>$this->input->post('mk_dasar'),
			'no_dasar'=>$this->input->post('mk_dasar_no'),
			'tgl_dasar'=>$this->input->post('tgl_dasar'),
			'kota_dasar'=>$this->input->post('mk_dasar_kota'),
			'kode_uji'=>$kodeuji,
			'tgl_mutasi'=>date("Y-m-d"),
		);
		
		$uji_kehilangan = array(
			'kode_uji'=>$kodeuji,
			'no_uji'=>$no_uji,
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'num_nomor'=>$this->input->post('no_kehilangan'),
			'num_tgl'=>$this->input->post('tgl_kehilangan'),
		);
		
		$uji=array(
			'kode_uji'=>$kodeuji,
			'no_uji'=>$no_uji,
			'id_penguji'=>$this->input->post('penguji'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_uji'=>$tanggal_daftar,
			'tgl_daftar_uji'=>$tanggal_daftar,
			'tgl_hbs_uji_sebelum'=>$this->input->post('tgl_habis_uji'),
		);

		$uji_numpang=array(
			'kode_uji'=>$kodeuji,
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_uji'=>$tanggal_daftar,
			'tgl_daftar_uji'=>$tanggal_daftar,
			'aktif'=>1,
		);
		
		$detail_uji=array(
			'kode_uji'=>$kodeuji,
		);

		$pemohon=array(
			'no_ktp'=>$this->input->post('no_ktp_pemohon'),
			'nama'=>$this->input->post('nama_pemohon'),
			'alamat'=>$this->input->post('alamat_pemohon'),
			'telp'=>$this->input->post('no_telp'),
		);
	
		$cek_ktp = $this->pendaftaran->getCekPemohon($ktp);
		if($cek_ktp == "0"){
			$this->pendaftaran->insertData('tbl_pemohon',$pemohon);
		} else {
			$this->pendaftaran->updateData('tbl_pemohon',$pemohon,$ktpx);
		}

		if($status_pemilik=='ganti_nama'){
			$this->pendaftaran->updateData('tbl_pengguna',array('aktif' => 0),$idpx);
			$this->pendaftaran->insertData('tbl_pengguna',$pengguna_baru);
		} else if ($status_pemilik=='ubah_data'){
			$this->pendaftaran->updateData('tbl_pengguna',$pengguna_baru,$idpx);
		} else {
			$this->pendaftaran->updateData('tbl_pengguna',$pengguna,$idpx);
		}
		
		if(($jenis_uji=='Numpang Masuk') || ($jenis_uji=='Mutasi Masuk')){
			$cekdetail = $this->pendaftaran->getSelectedData('tbl_pendaftaran_detail',$kodeujix)->num_rows();
			if($cekdetail == "0"){
				$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_masuk);
			} else {
				$this->pendaftaran->deleteData('tbl_pendaftaran_detail',$kodeujix);
				$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_masuk);
			}
			$cekujikeluar = $this->pendaftaran->getSelectedData('tbl_uji_keluar',$kodeujix)->num_rows();
			if($cekujikeluar > 0){
				$this->pendaftaran->deleteData('tbl_uji_keluar',$kodeujix);
			}
			$cekmutasi = $this->pendaftaran->getSelectedData('tbl_mutasi',$kodeujix)->num_rows();
			if($cekmutasi > 0){
				$this->pendaftaran->deleteData('tbl_mutasi',$kodeujix);
			}
		} else if(($jenis_uji=='Numpang Keluar') || ($jenis_uji=='Mutasi Keluar')){
			$cekdetail = $this->pendaftaran->getSelectedData('tbl_pendaftaran_detail',$kodeujix)->num_rows();
			if($cekdetail > 0){
				$this->pendaftaran->deleteData('tbl_pendaftaran_detail',$kodeujix);
			}
			$cekujikeluar = $this->pendaftaran->getSelectedData('tbl_uji_keluar',$kodeujix)->num_rows();
			if($cekujikeluar == "0"){
				$this->pendaftaran->insertData('tbl_uji_keluar',$uji_keluar);
			} else {
				$this->pendaftaran->deleteData('tbl_uji_keluar',$kodeujix);
				$this->pendaftaran->insertData('tbl_uji_keluar',$uji_keluar);
			}
			$cekmutasi = $this->pendaftaran->getSelectedData('tbl_mutasi',$kodeujix)->num_rows();
			if($cekmutasi > 0){
				$this->pendaftaran->deleteData('tbl_mutasi',$kodeujix);
			}
			if($jenis_uji=='Mutasi Keluar'){
				$this->pendaftaran->insertData('tbl_mutasi',$mutasi_keluar);
			}
		} else if ($jenis_uji=="Kehilangan"){
			$cekdetail = $this->pendaftaran->getSelectedData('tbl_pendaftaran_detail',$kodeujix)->num_rows();
			if($cekdetail == "0"){
				$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_kehilangan);
			} else {
				$this->pendaftaran->deleteData('tbl_pendaftaran_detail',$kodeujix);
				$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_kehilangan);
			}
			$cekujikeluar = $this->pendaftaran->getSelectedData('tbl_uji_keluar',$kodeujix)->num_rows();
			if($cekujikeluar > 0){
				$this->pendaftaran->deleteData('tbl_uji_keluar',$kodeujix);
			}
			$cekmutasi = $this->pendaftaran->getSelectedData('tbl_mutasi',$kodeujix)->num_rows();
			if($cekmutasi > 0){
				$this->pendaftaran->deleteData('tbl_mutasi',$kodeujix);
			}
		}
		
		$this->pendaftaran->updateData('tbl_pengguna',$pengguna,$idpx);
		$this->pendaftaran->updateData('tbl_kendaraan',$kendaraan,$no_ujix);
		$this->pendaftaran->updateData('tbl_uji',$uji,$kodeujix);
		$this->pendaftaran->updateData('tbl_pendaftaran',$pendaftaran,$kodeujix);
		$this->pendaftaran->updateData('tbl_retribusi',$retribusi,$kodeujix);
		$this->generate_qrcode($qrcode_data,$kode,$tanggal_daftar);
		$this->generate_qrbilling($billing,$tanggal_daftar);
		$this->aktifitas_ubah($no_uji);
		redirect('pendaftaran/datapendaftaran/'.$kodeuji);
	}

	public function hapus(){
		$table = array('tbl_pendaftaran','tbl_pendaftaran_detail','tbl_retribusi','tbl_uji','tbl_uji_detail','tbl_uji_keluar','tbl_barang','tbl_uji_catatan','tbl_uji_riwayat');
		$id = $this->uri->segment(3);
        $idx['kode_uji'] = $this->uri->segment(3);
		$daftar = $this->pendaftaran->getDataPendaftaran($id);
		foreach($daftar as $row){
			$no_uji = $row->no_uji;
			$kode = $row->qr_kodeuji;
			$tgl = date("Y-m-d",strtotime($row->tgl_daftar_uji));
			$billing = $row->id_billing;
		}
		$this->aktifitas_hapus($no_uji);
        $this->pendaftaran->deleteData($table,$idx);
        unlink('files/pendaftaran/'.$tgl.'/'.$kode.'.png');
		unlink('files/pembayaran/'.$tgl.'/'.$billing.'.png');
		redirect('pendaftaran');
	}

	public function detail(){
		$this->akses->akses_petugas();
		$this->load->helper('date');
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>$id,
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'rekap_pendaftaran'=>'active',
			'detail_pendaftaran'=>$this->pendaftaran->getDetailPendaftaran($id),
			'now'=>time()
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_detail_pendaftaran');
		$this->load->view('pages/v_footer');
	}
	
	public function daftaronline(){
		$this->akses->akses_petugas();
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};

		$num = $this->pendaftaran->getJmlDaftarOnline();
		$config=array(
			'base_url'=>base_url().'pendaftaran/daftaronline',
			'total_rows'=>$num,
			'per_page'=>20,
			'full_tag_open'=> "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>",
			'full_tag_close'=> "</ul>",
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => "<li class='disabled'><li class='active'><a href='#'>",
			'cur_tag_close' => "<span class='sr-only'></span></a></li>",
			'next_tag_open' => "<li>",
			'next_tagl_close' => "</li>",
			'prev_tag_open' => "<li>",
			'prev_tagl_close' => "</li>",
			'first_tag_open' => "<li>",
			'first_tagl_close' => "</li>",
			'last_tag_open' => "<li>",
			'last_tagl_close' => "</li>"
		);

		$data=array(
			'title'=>'Rekap Pendaftaran Online Uji',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'daftar_online'=>'active',
			'dt_pendaftaran'=>$this->pendaftaran->getRekapPendaftaranOnline($config['per_page'],$dari),
			'start'=>$dari,
		);

		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_rekap_daftar_online');
		$this->load->view('pages/v_footer');
	}
	
	public function prosespra(){
		$nouji = $this->input->get('no_uji', TRUE);
		$kodeuji = $this->input->get('kode', TRUE);
		$data=array(
			'title'=>'Pendaftaran Uji Kendaraan Bermotor',
			'aktif_pendaftaran'=>'active',
			'open_pendaftaran'=>'open',
			'daftar'=>'active',
			'kode_uji'=>$kodeuji,
			'no_uji'=>$nouji,
			'dt_kota'=>$this->kendaraan->getAllData('tbl_kabupaten'),
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'),
			'dt_bahanbakar'=>$this->kendaraan->getAllData('tbl_bahan_bakar'),
			'dt_jenis'=>$this->kendaraan->getAllData('tbl_kendaraan_jenis'),
			'dt_jenis_kendaraan'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'JENIS')),
			'dt_jenis_bentuk'=>$this->kendaraan->getSelectedData('tbl_jenis_kendaraan',array('kategori'=>'BENTUK')),
			'terbit'=>$this->pendaftaran->getAllData('kodepenerbitan'),
			'cari_pengujian'=>$this->pendaftaran->getCariDaftarOnline($nouji),
			'data_penguji'=>$this->pendaftaran->getAllData('tbl_penguji'),
			'data_tarif'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Retribusi'))->result(),
			'v_daftar'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Daftar'))->result(),
			'denda'=>$this->pendaftaran->getSelectedData('tbl_retribusi_tarif',array('jenis_retribusi'=>'Denda'))->result(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pendaftaran/v_proses_daftar_online');
		$this->load->view('pages/v_footer');
	}
	
	public function hapuspra(){
		$id = $this->input->get('id', TRUE);
		$kode = $this->input->get('kode', TRUE);
        $kodex['kode_uji'] = $this->input->get('kode', TRUE);
		$table = array('tbl_pra_pendaftaran','tbl_pra_retribusi');
		$daftar = $this->pendaftaran->getSelectedData('tbl_pra_retribusi',$kodex)->result();
		foreach($daftar as $row){
			$tgl = date("Y-m-d",strtotime($row->tgl_pembayaran));
			$billing = $row->id_billing;
		}
		$this->pendaftaran->deleteData($table,$kodex);
        unlink('files/booking/'.$id.'.png');
		unlink('files/pembayaran/'.$tgl.'/'.$billing.'.png');
		redirect('pendaftaran/daftaronline');
	}
	
	public function proses_daftaronline(){
		$this->akses->akses_petugas();
		$idp = $this->input->get('idp', TRUE);
		$idpx['id_user'] = $this->input->get('idp', TRUE);
		$booking = $this->input->get('booking', TRUE);
		$no_uji = $this->input->post('no_uji');
		$no_ujix['no_uji'] = $this->input->post('no_uji');
		$jenis_uji = $this->input->post('jenis_uji');
		$status_pemilik = $this->input->post('status_pemilik');
		$status_pemohon = $this->input->post('status_pemohon');
		$tanggal_daftar = $this->input->post('tgl_daftar_uji');
		$kode_uji = $this->input->post('kode_uji');
		$kode_ujix['kode_uji'] = $this->input->post('kode_uji');
		
		$no_kw = $this->pendaftaran->getKodeKwitansi();
		$hbs_uji = date('Y-m-d', strtotime("+6 month"));
		
		$billing = $this->pendaftaran->getKodeBilling();
		$expired = strtotime("+2 day");
		$tgl_dftr = date('Y-m-d H:i:s');
		$tgl_exp = date('Y-m-d H:i:s',$expired);
		
		$kode = $this->generate_kode();
		$idb['kode'] = $this->generate_kode();
		$cek_kode = $this->pendaftaran->getSelectedData('tbl_kode',$idb)->num_rows();
		if($cek_kode > 0){
			$kode = $this->generate_kode();
		}
		$qrcode_data = "http://192.168.1.250/beranda/cekuji/".$kode;
		
		$cekonline = $this->pendaftaran->getCekOnline($no_uji);
		if($cekonline > 0){
			$online=array(
				'aktif'=>0,
			);
			$this->model_app->updateData('tbl_pra_pendaftaran',$online,$no_ujix);
		}
		
		$status_terbit = $this->input->post('status_terbit');
		$setting = $this->pendaftaran->getAllData('tbl_setting');
		foreach($setting as $set){
			if(($status_terbit=="5") || ($status_terbit=="6")){
				$kd_wil_asal = $this->input->post('kd_wil_asal');
			} else {
				$kd_wil_asal = $set->kodewilayah;
			}
		}
		
		if($booking!=$tanggal_daftar){
			$antrian = $this->pendaftaran->getNomorAntrian();
			$tblantrian=array(
				'tgl_antrian'=>$tanggal_daftar,
				'kode_uji'=>$kode_uji,
				'no_antrian'=>$antrian,
			);
			$this->pendaftaran->updateData('tbl_antrian',$tblantrian,$kode_ujix);
		} else {
			$antrian = $this->input->get('antrian', TRUE);
		}
		
		$uji_masuk = array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'num_dari'=>$this->input->post('num_dari'),
			'num_nomor'=>$this->input->post('num_nomor'),
			'num_tgl'=>$this->input->post('num_tgl'),
		);
		
		$uji_keluar=array(
			'kode_uji'=>$kode_uji,
			'jenis_uji_keluar'=>$jenis_uji,
			'no_uji'=>$no_uji,
			'tujuan_num'=>$this->input->post('nuk_tujuan'),
			'kota_num'=>$this->input->post('nuk_kota'),
			'tgl'=>date("Y-m-d"),
		);
		
		$mutasi_keluar=array(
			'no_uji'=>$no_uji,
			'nama_baru'=>$this->input->post('nm_baru'),
			'alamat_baru'=>$this->input->post('nm_alamat'),
			'dasar'=>$this->input->post('mk_dasar'),
			'no_dasar'=>$this->input->post('mk_dasar_no'),
			'tgl_dasar'=>$this->input->post('tgl_dasar'),
			'kota_dasar'=>$this->input->post('mk_dasar_kota'),
			'kode_uji'=>$kode_uji,
			'tgl_mutasi'=>date("Y-m-d"),
		);
		
		$uji_kehilangan = array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'num_nomor'=>$this->input->post('no_kehilangan'),
			'num_tgl'=>$this->input->post('tgl_kehilangan'),
		);

		$pengguna=array(
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'telp'=>$this->input->post('no_telp'),
		);

		$pengguna_baru = array(
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_stnk'=>$this->input->post('tgl_stnk'),
			'no_ktp'=>$this->input->post('no_ktp'),
			'nama'=>$this->input->post('nama'),
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
			'telp'=>$this->input->post('no_telp'),
			'aktif'=>1,
		);

		$kendaraan=array(
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'jenis'=>$this->input->post('jenis'),
			'jenis_kendaraan'=>$this->input->post('jenis_kendaraan'),
			'bentuk'=>$this->input->post('bentuk'),
			'bahan_bakar'=>$this->input->post('bahan_bakar'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'no_rangka'=>$this->input->post('no_rangka'),
			'sifat'=>$this->input->post('sifat'),
			'jbb'=>$this->input->post('jbb'),
		);
		
		if($status_pemohon=='pemilik'){
			$ktp = $this->input->post('no_ktp_pemilik');
			$nama = $this->input->post('nama_pemilik');
			$alamat = $this->input->post('alamat_pemilik');
		} else if($status_pemohon=='dikuasakan'){
			$ktp = $this->input->post('no_ktp_pemohon');
			$nama = $this->input->post('nama_pemohon');
			$alamat =$this->input->post('alamat_pemohon');
		}
		
		$pendaftaran=array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'no_antrian'=>$antrian,
			'no_ktp_pemohon'=>$ktp,
			'nama_pemohon'=>$nama,
			'alamat_pemohon'=>$alamat,
			'tgl_daftar_uji'=>$tanggal_daftar,
			'waktu_pendaftaran'=>date("Y-m-d H:i:s"),
			'jenis_uji'=>$this->input->post('jenis_uji'),
			'qr_kodeuji'=>$kode,
			'status_terbit'=>$this->input->post('status_terbit'),
			'kd_wil_asal'=>$kd_wil_asal,
			'aktif'=>1,
		);

		$retribusi=array(
			'kode_uji'=>$kode_uji,
			'no_kwitansi'=>$no_kw,
			'no_uji'=>$no_uji,
			'id_billing'=>$billing,
			'exp_billing'=>$tgl_exp,
			'tgl_pembayaran'=>$this->input->post('tgl_daftar_uji'),
			'status_bayar'=>0,
			'retribusi'=>$this->input->post('retribusi'),
			'denda'=>$this->input->post('denda'),
			'jml_denda'=>$this->input->post('jml_denda'),
			'total_retribusi'=>$this->input->post('total_retribusi'),
			'total_semua'=>$this->input->post('total_semua'),
			'terbilang'=>$this->input->post('terbilang'),
			'aktif'=>1,
		);

		$uji=array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_uji'=>$this->input->post('tgl_daftar_uji'),
			'tgl_daftar_uji'=>date("Y-m-d H:i:s"),
			'tgl_habis_uji'=>$this->input->post('tgl_habis_uji'),
			'aktif'=>0,
		);

		$uji_numpang=array(
			'kode_uji'=>$kode_uji,
			'no_uji'=>$no_uji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'tgl_uji'=>$this->input->post('tgl_daftar_uji'),
			'tgl_daftar_uji'=>date("Y-m-d H:i:s"),
			'tgl_habis_uji'=>$this->input->post('tgl_habis_uji'),
			'aktif'=>1,
		);
		
		$detail_uji=array(
			'kode_uji'=>$kode_uji,
		);

		$pemohon=array(
			'no_ktp'=>$ktp,
			'nama'=>$nama,
			'alamat'=>$alamat,
			'telp'=>$this->input->post('no_telp'),
		);
		
		$this->pendaftaran->insertData('tbl_pendaftaran',$pendaftaran);
		$this->pendaftaran->insertData('tbl_retribusi',$retribusi);
		$this->pendaftaran->updateData('tbl_kendaraan',$kendaraan,$no_ujix);
		
		
		if(($jenis_uji=='Numpang Masuk') || ($jenis_uji=='Mutasi Masuk')){
			$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_masuk);
		} else if(($jenis_uji=='Numpang Keluar') || ($jenis_uji=='Mutasi Keluar')){
			$this->pendaftaran->insertData('tbl_uji_keluar',$uji_keluar);
			if($jenis_uji=='Mutasi Keluar'){
				$this->pendaftaran->insertData('tbl_mutasi',$mutasi_keluar);
			}
		} else if ($jenis_uji=="Kehilangan"){
			$this->pendaftaran->insertData('tbl_pendaftaran_detail',$uji_kehilangan);
		}
		
		if($ktp!=""){
			$ktpx['no_ktp'] = $ktp;
			$cek_ktp = $this->pendaftaran->getCekPemohon($ktp);
			if($cek_ktp == "0"){
				$this->pendaftaran->insertData('tbl_pemohon',$pemohon);
			} else {
				$this->pendaftaran->updateData('tbl_pemohon',$pemohon,$ktpx);
			}
		}

		if($status_pemilik=='ganti_nama'){
			$this->pendaftaran->updateData('tbl_pengguna',array('aktif' => 0),$idpx);
			$this->pendaftaran->insertData('tbl_pengguna',$pengguna_baru);
		} else if ($status_pemilik=='ubah_data'){
			$this->pendaftaran->updateData('tbl_pengguna',$pengguna_baru,$idpx);
		} else {
			$this->pendaftaran->updateData('tbl_pengguna',$pengguna,$idpx);
		}
		
		if(($jenis_uji=='Numpang Keluar') || ($jenis_uji=='Mutasi Keluar')){
			$this->pendaftaran->insertData('tbl_uji',$uji_numpang);
		} else {
			$this->pendaftaran->insertData('tbl_uji',$uji);
		}
		$this->pendaftaran->insertData('tbl_uji_detail',$detail_uji);
		
		$this->generate_qrcode($qrcode_data,$kode,$tanggal_daftar);
		$this->generate_qrbilling($billing,$tanggal_daftar);
		$this->aktifitas_tambah($no_uji);
		redirect('pendaftaran/datapendaftaran/'.$kode_uji);
	}
	
	public function get_kota_tujuan(){
		$id['nama_kabupaten'] = $this->input->post('tujuan');
		$kota= $this->pendaftaran->getSelectedData('tbl_kabupaten',$id)->result();
		echo json_encode($kota);
	}
	
	public function uji_masuk(){
		$data=array(
			'dt_kabupaten'=>$this->kendaraan->getAllData('tbl_kabupaten'),
		);
		$this->load->view('pendaftaran/ajax_uji_masuk',$data);
	}
	
	public function uji_numpang(){
		$data=array(
			'dt_kabupaten'=>$this->kendaraan->getAllData('tbl_kabupaten'),
		);
		$this->load->view('pendaftaran/ajax_uji_keluar',$data);
	}
	
	public function uji_mutasi(){
		$data=array(
			'dt_kabupaten'=>$this->kendaraan->getAllData('tbl_kabupaten'),
		);
		$this->load->view('pendaftaran/ajax_uji_mutasi',$data);
	}
	
	public function uji_kehilangan(){
		$this->load->view('pendaftaran/ajax_uji_kehilangan');
	}
	
	public function numpang(){
		$data=array(
			'dt_kabupaten'=>$this->kendaraan->getAllData('kodewilayah'),
		);
		$this->load->view('pendaftaran/ajax_smart_numpang',$data);
	}
	
	public function edit_uji_masuk(){
		$kodeujix['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'dt_ujimasuk'=>$this->pendaftaran->getSelectedData('tbl_pendaftaran_detail',$kodeujix)->result(),
			'dt_kabupaten'=>$this->kendaraan->getAllData('tbl_kabupaten'),
		);
		$this->load->view('pendaftaran/ajax_edit_uji_masuk',$data);
	}
	
	public function edit_uji_numpang(){
		$kodeujix['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'dt_ujikeluar'=>$this->pendaftaran->getSelectedData('tbl_uji_keluar',$kodeujix)->result(),
			'dt_kabupaten'=>$this->kendaraan->getAllData('tbl_kabupaten'),
		);
		$this->load->view('pendaftaran/ajax_edit_uji_keluar',$data);
	}
	
	public function edit_uji_mutasi(){
		$kodeujix['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'dt_ujikeluar'=>$this->pendaftaran->getSelectedData('tbl_uji_keluar',$kodeujix)->result(),
			'dt_ujimutasi'=>$this->pendaftaran->getSelectedData('tbl_mutasi',$kodeujix)->result(),
			'dt_kabupaten'=>$this->kendaraan->getAllData('tbl_kabupaten'),
		);
		$this->load->view('pendaftaran/ajax_edit_uji_mutasi',$data);
	}
	
	public function edit_uji_kehilangan(){
		$kodeujix['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'dt_kehilangan'=>$this->pendaftaran->getSelectedData('tbl_pendaftaran_detail',$kodeujix)->result(),
		);
		$this->load->view('pendaftaran/ajax_edit_uji_kehilangan',$data);
	}
	
	public function edit_numpang(){
		$kodeuji = $this->uri->segment(3);
		$kodeujix['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'dt_wilayahasal'=>$this->pendaftaran->getWilayahAsal($kodeuji),
			'dt_kabupaten'=>$this->kendaraan->getAllData('kodewilayah'),
		);
		$this->load->view('pendaftaran/ajax_edit_smart_numpang',$data);
	}
	
	public function ubah_data(){
		$idx['id_user'] = $this->uri->segment(3);
		$data=array(
			'dt_pengguna'=>$this->pendaftaran->getSelectedData('tbl_pengguna',$idx)->result(),
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'),
			'dt_kota'=>$this->kendaraan->getAllData('tbl_kabupaten'),
		);
		$this->load->view('pendaftaran/ajax_ubah_data',$data);
	}
	
	public function ganti_nama(){
		$data=array(
			'dt_kecamatan'=>$this->kendaraan->getAllData('tbl_kecamatan'),
			'dt_kota'=>$this->kendaraan->getAllData('tbl_kabupaten'),
		);
		$this->load->view('pendaftaran/ajax_ganti_nama',$data);
	}
	
	public function cetak_antrian(){
		$idx['id_user'] = $this->session->userdata('id_user');
		$id = $this->input->get('id', TRUE);;
		$no_uji = $this->input->get('nouji', TRUE);
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>"ANTRIAN_".$id.".pdf",
			'dt_antrian'=>$this->pendaftaran->getCetakAntrian($id),
			'dt_printer'=>$this->model_app->getSelectedData('tbl_printer_setting',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_antrian_php',$data);
	}
	
	public function cetak_antrian_pdf(){
		$idx['id_user'] = $this->session->userdata('id_user');
		$id = $this->uri->segment(3);
		$antrian = $this->pendaftaran->getCetakAntrian($id);
		foreach($antrian as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>"ANTRIAN_".$id.".pdf",
			'dt_antrian'=>$antrian,
			'dt_printer'=>$this->model_app->getSelectedData('tbl_printer_setting',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_antrian',$data);
	}
	
	public function cetak_skrd(){
		$this->akses->akses_petugas();
		$idx['id_user'] = $this->session->userdata('id_user');
		$id = $this->input->get('id', TRUE);;
		$no_uji = $this->input->get('nouji', TRUE);
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>"LHP_".$id.".pdf",
			'detail_pendaftaran'=>$this->pendaftaran->getCetakFormPendaftaran($id),
			'dt_printer'=>$this->model_app->getSelectedData('tbl_printer_setting',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_skrd',$data);
	}

	public function cetak_lhp(){
		$this->akses->akses_petugas();
		$idx['id_user'] = $this->session->userdata('id_user');
		$id = $this->input->get('id', TRUE);;
		$no_uji = $this->input->get('nouji', TRUE);
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>"LHP_".$id.".pdf",
			'detail_pendaftaran'=>$this->pendaftaran->getCetakFormPendaftaran($id),
			'dt_printer'=>$this->model_app->getSelectedData('tbl_printer_setting',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_lembar_hasil',$data);
	}

	public function cetak_pembayaran(){
		$this->akses->akses_petugas();
		$idx['id_user'] = $this->session->userdata('id_user');
		$id = $this->uri->segment(3);
		$daftar = $this->pendaftaran->getCetakPembayaran($id);
		foreach($daftar as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>"PEMBAYARAN_".$id.".pdf",
			'dt_pembayaran'=>$daftar,
			'dt_printer'=>$this->pendaftaran->getSelectedData('tbl_printer_setting',$idx)->result(),
			'dt_setting'=>$this->pendaftaran->getAllData('tbl_setting'),
		);
		$this->load->view('cetak/v_cetak_pembayaran',$data);
	}
	
	public function cetak_pembayaran_lunas(){
		$this->akses->akses_petugas();
		$idx['id_user'] = $this->session->userdata('id_user');
		$id = $this->uri->segment(3);
		$daftar = $this->pendaftaran->getCetakPembayaran($id);
		foreach($daftar as $row){
			$no_uji = $row->no_uji;
			$total_retribusi = $row->total_semua;
		}
		$this->aktifitas_cetak($no_uji);
		$data=array(
			'title'=>"PEMBAYARAN_LUNAS_".$id."_.pdf",
			'dt_pembayaran'=>$daftar,
			'dt_printer'=>$this->pendaftaran->getSelectedData('tbl_printer_setting',$idx)->result(),
			'dt_ttd'=>$this->pendaftaran->getSelectedData('tbl_pejabat',array('jabatan'=>'bendahara'))->result(),
			'terbilang'=> $this->terbilang($total_retribusi),
		);
		$this->load->view('cetak/v_cetak_pembayaran_lunas',$data);
	}
	
	public function get_cek_pemohon(){
		$id = $this->input->post('no_ktp');
		$cek = $this->pendaftaran->getCekPendaftaran($id);
		echo json_encode($cek);
	}

	public function get_pemohon(){
		$id['no_ktp'] = $this->input->post('no_ktp');
		$data = $this->pendaftaran->getSelectedData('tbl_pemohon',$id)->result();
		echo json_encode($data);
	}

	public function get_pemilik(){
		$id['no_ktp'] = $this->input->post('no_ktp');
		$pemilik = $this->pendaftaran->getSelectedData('tbl_pengguna',$id)->result();
		echo json_encode($pemilik);
	}
	
	public function get_nouji(){
		$jns = $this->input->get('jns', TRUE);
		echo $this->kendaraan->getNoUjiBaru($jns);
	}
	
	public function get_retribusi(){
		$uji = str_replace("+"," ",$this->input->get('uji', TRUE));
		$jns = str_replace("+"," ",$this->input->get('jns', TRUE));
		$jbb = $this->input->get('jbb', TRUE);
		$data = $this->pendaftaran->getJenisTarifRetribusi($uji,$jns,$jbb);
		echo json_encode($data);
	}

	public function cek_nomor_uji(){
		$no_uji = $this->input->post('no_uji');
		$cek_data = $this->pendaftaran->getCekNomorUji($no_uji);
		echo json_encode($cek_data);
	}

	public function cek_nomor_kendaraan(){
		$no_kendaraan = $this->input->post('no_kendaraan');
		$cek_data = $this->pendaftaran->getCekNomorKendaraan($no_kendaraan);
		echo json_encode($cek_data);
	}
	
	public function ceklibur(){
		$libur = $this->pendaftaran->getAllData('tbl_harilibur');
		$tgl = '2020-05-30';
		foreach($libur as $row){
			$tgllibur = $row->tgl_libur;
			if($tgllibur==$tgl){
				echo "1";
			}
		}
		
	}
	
	private function generate_kode(){
		$length = 10;
		$characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	private function generate_barcode($no_uji, $barcode_type, $scale=6, $fontsize=18, $thickness=30,$dpi=72) {
    // CREATE BARCODE GENERATOR
    // Including all required classes
    require_once( APPPATH . 'libraries/barcodegen/BCGFontFile.php');
    require_once( APPPATH . 'libraries/barcodegen/BCGColor.php');
    require_once( APPPATH . 'libraries/barcodegen/BCGDrawing.php');

    // Including the barcode technology
    // Ini bisa diganti-ganti mau yang 39, ato 128, dll, liat di folder barcodegen
    require_once( APPPATH . 'libraries/barcodegen/BCGcode39.barcode.php');

    // Loading Font
    // kalo mau ganti font, jangan lupa tambahin dulu ke folder font, baru loadnya di sini
    $font = new BCGFontFile(APPPATH . 'libraries/font/Arial.ttf', $fontsize);

    // Text apa yang mau dijadiin barcode, biasanya kode produk
    $text = $no_uji;

    // The arguments are R, G, B for color.
    $color_black = new BCGColor(0, 0, 0);
    $color_white = new BCGColor(255, 255, 255);

    $drawException = null;
    try {
        $code = new BCGcode39(); // kalo pake yg code39, klo yg lain mesti disesuaikan
        $code->setScale($scale); // Resolution
        $code->setThickness($thickness); // Thickness
        $code->setForegroundColor($color_black); // Color of bars
        $code->setBackgroundColor($color_white); // Color of spaces
        $code->setFont($font); // Font (or 0)
        $code->parse($text); // Text
    } catch(Exception $exception) {
        $drawException = $exception;
    }

    /* Here is the list of the arguments
    1 - Filename (empty : display on screen)
    2 - Background color */
    $drawing = new BCGDrawing('', $color_white);
    if($drawException) {
        $drawing->drawException($drawException);
    } else {
        $drawing->setDPI($dpi);
        $drawing->setBarcode($code);
        $drawing->draw();
    }
    // ini cuma labeling dari sisi aplikasi saya, penamaan file menjadi png barcode.
    $filename_img_barcode = $no_uji .'_'.$barcode_type.'.png';
    // folder untuk menyimpan barcode
    $drawing->setFilename( FCPATH . 'files/barcode/'. $filename_img_barcode);
    // proses penyimpanan barcode hasil generate
    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

    return $filename_img_barcode;
	}
	
	private function generate_qrbilling($billing,$tanggal_daftar){
		$this->load->library('ciqrcode');

		if (!is_dir('files/pembayaran/'.$tanggal_daftar)) {
		mkdir('./files/pembayaran/' . $tanggal_daftar, 0777, TRUE);
		}

		$params['data'] = $billing;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'files/pembayaran/'.$tanggal_daftar.'/'. $billing.'.png';
		$this->ciqrcode->generate($params);
	}

	private function generate_qrcode($qrcode_data,$kode,$tanggal_daftar){
		$this->load->library('ciqrcode');

		if (!is_dir('files/pendaftaran/'.$tanggal_daftar)) {
		mkdir('./files/pendaftaran/' . $tanggal_daftar, 0777, TRUE);
		}

		$params['data'] = $qrcode_data;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'files/pendaftaran/'.$tanggal_daftar.'/'. $kode.'.png';
		$this->ciqrcode->generate($params);
	}

	private function aktifitas_tambah($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Membuat data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->pendaftaran->insertData('tbl_log_aktifitas',$aktifitas);
	}

	private function aktifitas_ubah($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Merubah data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->pendaftaran->insertData('tbl_log_aktifitas',$aktifitas);
	}

	private function aktifitas_hapus($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Menghapus data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->pendaftaran->insertData('tbl_log_aktifitas',$aktifitas);
	}

	private function aktifitas_cetak($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Mencetak data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->pendaftaran->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function kekata($x) {
		$x = abs($x);
		$angka = array("", "Satu", "Dua", "Tiga", "Empat", "Lima",
		"Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($x <12) {
			$temp = " ". $angka[$x];
		} else if ($x <20) {
			$temp = $this->kekata($x - 10). " Belas";
		} else if ($x <100) {
			$temp = $this->kekata($x/10)." Puluh". $this->kekata($x % 10);
		} else if ($x <200) {
			$temp = " Seratus" . $this->kekata($x - 100);
		} else if ($x <1000) {
			$temp = $this->kekata($x/100) . " Ratus" . $this->kekata($x % 100);
		} else if ($x <2000) {
			$temp = " Seribu" . $this->kekata($x - 1000);
		} else if ($x <1000000) {
			$temp = $this->kekata($x/1000) . " Ribu" . $this->kekata($x % 1000);
		} else if ($x <1000000000) {
			$temp = $this->kekata($x/1000000) . " Juta" . $this->kekata($x % 1000000);
		} else if ($x <1000000000000) {
			$temp = $this->kekata($x/1000000000) . " Milyar" . $this->kekata(fmod($x,1000000000));
		} else if ($x <1000000000000000) {
			$temp = $this->kekata($x/1000000000000) . " Trilyun" . $this->kekata(fmod($x,1000000000000));
		}      
			return $temp;
	}
	
	private function terbilang($x, $style=4) {
		if($x<0) {
			$hasil = "minus ". trim($this->kekata($x));
		} else {
			$hasil = trim($this->kekata($x));
		}      
		switch ($style) {
			case 1:
				$hasil = strtoupper($hasil);
				break;
			case 2:
				$hasil = strtolower($hasil);
				break;
			case 3:
				$hasil = ucwords($hasil);
				break;
			default:
				$hasil = ucfirst($hasil);
				break;
		}      
		return $hasil;
	}
}