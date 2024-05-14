<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_surat','surat');
		$this->load->model('model_pendaftaran','pendaftaran');
		$this->load->model('akses');
		$this->load->helper('date');
		$this->load->library('fpdf');
		$this->load->library('pagination');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function rekomendasi(){
		$this->akses->akses_petugas();		
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->surat->getJmlRekom();
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
			'title'=>'Surat Numpang dan Mutasi Uji',
			'aktif_surat'=>'active',
			'open_surat'=>'open',
			'surat_rekomendasi'=>'active',
			'dt_rekom'=>$this->surat->getDaftarRekom($config['per_page'],$dari),
			'now'=>time()
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('surat/v_rekomendasi_ujikeluar');
		$this->load->view('pages/v_footer');
	}
	
	public function numpangkeluar(){
		$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Surat Numpang Uji',
			'aktif_surat'=>'active',
			'open_surat'=>'open',
			'surat_rekomendasi'=>'active',
			'dt_kabupaten'=>$this->surat->getAllData('tbl_kabupaten'),
			'dt_surat'=>$this->surat->getProsesRekom($id),
			'kode_surat'=>$this->surat->getKodeSuratNumpang(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('surat/v_tambah_surat_numpang');
		$this->load->view('pages/v_footer');
	}
	
	public function mutasikeluar(){
		$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Surat Mutasi Uji',
			'aktif_surat'=>'active',
			'open_surat'=>'open',
			'surat_rekomendasi'=>'active',
			'dt_kabupaten'=>$this->surat->getAllData('tbl_kabupaten'),
			'dt_surat'=>$this->surat->getProsesRekom($id),
			'kode_surat'=>$this->surat->getKodeSuratMutasi(),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('surat/v_tambah_surat_mutasi');
		$this->load->view('pages/v_footer');
	}

	public function prosesmutasi(){
		$this->akses->akses_petugas();
		$nouji = $this->input->post('no_uji');
		$noujix['no_uji'] = $this->input->get('nouji', TRUE);
		$iduserx['id_user'] = $this->input->post('iduser');
		$kodeuji = $this->input->get('kd', TRUE);
		$kodeujix ['kode_uji'] = $this->input->get('kd', TRUE);
		$kode_surat = "551.2/".$this->input->post('no_surat');
		$qrcode_data = "http://pkbwonosobo.ip-dynamic.com/beranda/ceksurat/".$kodeuji;
		$tgl_surat = $this->input->post('tgl_surat');
		
		$data=array(
			'kode_uji'=>$kodeuji,
			'no_surat'=>$this->input->post('no_surat'),
			'tgl_surat'=>$this->input->post('tgl_surat'),
			'no_uji'=>$nouji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'jenis_surat'=>'mutasi',
			'kota_dinas'=>$this->input->post('kota_dinas'),
			'kota_tujuan'=>$this->input->post('kota_tujuan'),
			'qr_surat'=>$nouji."_".$kodeuji.".png",
			'aktif'=>1,
		);
		$pengguna=array(
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
		);
		$kendaraan=array(
			'no_rangka'=>$this->input->post('no_rangka'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'status'=>3,
		);
		$mutasi_keluar=array(
			'no_uji'=>$nouji,
			'nama_baru'=>$this->input->post('nm_baru'),
			'alamat_baru'=>$this->input->post('nm_alamat'),
			'dasar'=>$this->input->post('mk_dasar'),
			'no_dasar'=>$this->input->post('mk_dasar_no'),
			'tgl_dasar'=>$this->input->post('tgl_dasar'),
			'kota_dasar'=>$this->input->post('kota_dasar'),
			'kode_uji'=>$kodeuji,
			'tgl_mutasi'=>$tgl_surat,
		);
		$uji=array(
			'foto'=>1,
			'uji'=>2,
			'aktif'=>2,
		);
		$this->surat->insertData('tbl_surat',$data);
		$this->surat->updateData('tbl_pengguna',$pengguna,$iduserx);
		$this->surat->updateData('tbl_kendaraan',$kendaraan,$noujix);
		$this->surat->updateData('tbl_mutasi',$mutasi_keluar,$kodeujix);
		$this->surat->updateData('tbl_uji',$uji,$kodeujix);
		$this->generate_qrcode($qrcode_data,$nouji,$kodeuji,$tgl_surat);
		redirect('surat/rekomendasi');
	}
	
	public function editmutasi(){
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Edit Surat Mutasi Keluar',
			'aktif_surat'=>'active',
			'open_surat'=>'open',
			'surat_rekomendasi'=>'active',
			'dt_kabupaten'=>$this->surat->getAllData('tbl_kabupaten'),
			'dt_surat'=>$this->surat->getEditMutasi($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('surat/v_edit_surat_mutasi');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_editmutasi(){
		$this->akses->akses_petugas();
		$nouji = $this->input->post('no_uji');
		$noujix['no_uji'] = $this->input->get('nouji', TRUE);
		$iduserx['id_user'] = $this->input->post('iduser');
		$kodeuji = $this->input->get('kd', TRUE);
		$kodeujix ['kode_uji'] = $this->input->get('kd', TRUE);
		$kode_surat = "551.2/".$this->input->post('no_surat');
		$qrcode_data = "http://pkbwonosobo.ip-dynamic.com/beranda/ceksurat/".$kodeuji;
		$tgl_surat = $this->input->post('tgl_surat');
		$data=array(
			'kode_uji'=>$kodeuji,
			'no_surat'=>$this->input->post('no_surat'),
			'tgl_surat'=>$this->input->post('tgl_surat'),
			'no_uji'=>$nouji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'jenis_surat'=>'mutasi',
			'kota_dinas'=>$this->input->post('kota_dinas'),
			'kota_tujuan'=>$this->input->post('kota_tujuan'),
			'qr_surat'=>$nouji."_".$kodeuji.".png",
			'aktif'=>1,
		);
		$pengguna=array(
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
		);
		$kendaraan=array(
			'no_rangka'=>$this->input->post('no_rangka'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
			'status'=>3,
		);
		$mutasi_keluar=array(
			'no_uji'=>$nouji,
			'nama_baru'=>$this->input->post('nm_baru'),
			'alamat_baru'=>$this->input->post('nm_alamat'),
			'dasar'=>$this->input->post('mk_dasar'),
			'no_dasar'=>$this->input->post('mk_dasar_no'),
			'tgl_dasar'=>$this->input->post('tgl_dasar'),
			'kota_dasar'=>$this->input->post('kota_dasar'),
			'kode_uji'=>$kodeuji,
			'tgl_mutasi'=>$tgl_surat,
		);
		$uji_keluar=array(
			'tujuan_num'=>$this->input->post('kota_dinas'),
			'kota_num'=>$this->input->post('kota_tujuan'),
		);
		$this->surat->updateData('tbl_surat',$data,$kodeujix);
		$this->surat->updateData('tbl_pengguna',$pengguna,$iduserx);
		$this->surat->updateData('tbl_kendaraan',$kendaraan,$noujix);
		$this->surat->updateData('tbl_mutasi',$mutasi_keluar,$kodeujix);
		$this->surat->updateData('tbl_uji_keluar',$uji_keluar,$kodeujix);
		$this->generate_qrcode($qrcode_data,$nouji,$kodeuji,$tgl_surat);
		redirect('surat/rekomendasi');
	}
	
	public function prosesnumpang(){
		$this->akses->akses_petugas();
		$nouji = $this->input->post('no_uji');
		$noujix['no_uji'] = $this->input->get('nouji', TRUE);
		$iduserx['id_user'] = $this->input->post('iduser');
		$kodeuji = $this->input->get('kd', TRUE);
		$kodeujix ['kode_uji'] = $this->input->get('kd', TRUE);
		$kode_surat = "551.2/".$this->input->post('no_surat');
		$qrcode_data = "http://pkbwonosobo.ip-dynamic.com/beranda/ceksurat/".$kodeuji;
		$tgl_surat = $this->input->post('tgl_surat');
		$data=array(
			'kode_uji'=>$kodeuji,
			'no_surat'=>$this->input->post('no_surat'),
			'tgl_surat'=>$this->input->post('tgl_surat'),
			'no_uji'=>$nouji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'jenis_surat'=>'numpang',
			'kota_dinas'=>$this->input->post('kota_dinas'),
			'kota_tujuan'=>$this->input->post('kota_tujuan'),
			'qr_surat'=>$nouji."_".$kodeuji.".png",
			'aktif'=>1,
		);
		
		$pengguna=array(
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
		);
		
		$kendaraan=array(
			'no_rangka'=>$this->input->post('no_rangka'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
		);
		$uji=array(
			'foto'=>1,
			'uji'=>2,
			'aktif'=>2,
		);
		$this->surat->insertData('tbl_surat',$data);
		$this->surat->updateData('tbl_pengguna',$pengguna,$iduserx);
		$this->surat->updateData('tbl_kendaraan',$kendaraan,$noujix);
		$this->surat->updateData('tbl_uji',$uji,$kodeujix);
		$this->generate_qrcode($qrcode_data,$nouji,$kodeuji,$tgl_surat);
		redirect('surat/rekomendasi');
	}
	
	public function editnumpang(){
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>'Edit Surat Numpang Uji',
			'aktif_surat'=>'active',
			'open_surat'=>'open',
			'surat_rekomendasi'=>'active',
			'dt_kabupaten'=>$this->surat->getAllData('tbl_kabupaten'),
			'dt_surat'=>$this->surat->getEditNumpang($id),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('surat/v_edit_surat_numpang');
		$this->load->view('pages/v_footer');
	}
	
	public function proses_editnumpang(){
		$this->akses->akses_petugas();
		$nouji = $this->input->post('no_uji');
		$noujix['no_uji'] = $this->input->get('nouji', TRUE);
		$iduserx['id_user'] = $this->input->post('iduser');
		$kodeuji = $this->input->get('kd', TRUE);
		$kodeujix ['kode_uji'] = $this->input->get('kd', TRUE);
		$kode_surat = "551.2/".$this->input->post('no_surat');
		$qrcode_data = "http://pkbwonosobo.ip-dynamic.com/beranda/ceksurat/".$kodeuji;
		$tgl_surat = $this->input->post('tgl_surat');
		$data=array(
			'kode_uji'=>$kodeuji,
			'no_surat'=>$this->input->post('no_surat'),
			'tgl_surat'=>$this->input->post('tgl_surat'),
			'no_uji'=>$nouji,
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'jenis_surat'=>'numpang',
			'kota_dinas'=>$this->input->post('kota_dinas'),
			'kota_tujuan'=>$this->input->post('kota_tujuan'),
			'qr_surat'=>$nouji."_".$kodeuji.".png",
			'aktif'=>1,
		);
		$pengguna=array(
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'kota'=>$this->input->post('kota'),
		);
		$kendaraan=array(
			'no_rangka'=>$this->input->post('no_rangka'),
			'no_mesin'=>$this->input->post('no_mesin'),
			'merek'=>$this->input->post('merek'),
			'tipe'=>$this->input->post('tipe'),
		);
		$uji_keluar=array(
			'tujuan_num'=>$this->input->post('kota_dinas'),
			'kota_num'=>$this->input->post('kota_tujuan'),
		);
		$this->surat->updateData('tbl_surat',$data,$kodeujix);
		$this->surat->updateData('tbl_pengguna',$pengguna,$iduserx);
		$this->surat->updateData('tbl_kendaraan',$kendaraan,$noujix);
		$this->surat->updateData('tbl_uji_keluar',$uji_keluar,$kodeujix);
		$this->generate_qrcode($qrcode_data,$nouji,$kodeuji,$tgl_surat);
		redirect('surat/rekomendasi');
	}
	
	public function filter_tanggalrekomendasi(){
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'title'=>'Surat Numpang dan Mutasi Uji',
			'aktif_surat'=>'active',
			'open_surat'=>'open',
			'surat_rekomendasi'=>'active',
			'dt_rekom'=>$this->surat->getTanggalRekom($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('surat/v_rekomendasi_ujikeluar');
		$this->load->view('pages/v_footer');
	}
	
	public function sktl(){
		$this->akses->akses_petugas();		
		if($this->uri->segment(3)==FALSE){
			$dari = 0;
		} else {
			$dari = $this->uri->segment(3);
		};
		
		$num = $this->surat->getJmlSktl();
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
			'title'=>'Surat Keterangan Tidak Lulus Uji',
			'aktif_surat'=>'active',
			'open_surat'=>'open',
			'surat_sktl'=>'active',
			'dt_sktl'=>$this->surat->getDaftarSktl($config['per_page'],$dari),
		);
		
		$this->pagination->initialize($config);
		$this->load->view('pages/v_header',$data);
		$this->load->view('surat/v_sktl');
		$this->load->view('pages/v_footer');
	}
	
	public function filter_tanggalSktl(){
		$awal = $this->input->post('tgl_awal');
		$akhir = $this->input->post('tgl_akhir');
		$data=array(
			'title'=>'Surat Keterangan Tidak Lulus Uji',
			'aktif_surat'=>'active',
			'open_surat'=>'open',
			'surat_sktl'=>'active',
			'dt_sktl'=>$this->surat->getTanggalSktl($awal,$akhir),
			'tgl_awal'=> $awal,
			'tgl_akhir' => $akhir,
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('surat/v_sktl');
		$this->load->view('pages/v_footer');
	}
	
	// CETAK
	public function cetak_amplop(){
		$this->akses->akses_petugas();
		$id = $this->uri->segment(3);
		$idx['id_surat'] = $this->uri->segment(3);
		$data=array(
			'title'=>"Surat_amplop_".$id.".pdf",
			'detail_surat'=>$this->surat->getSelectedData('tbl_surat',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_suratamplop',$data);
	}
	
	public function cetak(){
		$this->akses->akses_petugas();
		$surat = $this->surat->getSelectedData('tbl_surat_setting',array('jnsttd'=>'surat'))->result();
		foreach($surat as $row){
			$ttd = $row->ttd;
		}
		$id = $this->uri->segment(3);
		$idx['id_surat'] = $this->uri->segment(3);
		$uji = $this->surat->getSelectedData('tbl_surat',$idx)->result();
		foreach($uji as $row){
			$ids = $row->no_uji;
		}
		$data=array(
			'title'=>"Surat_mutasi_".$id.".pdf",
			//'berkala'=>$this->surat->getUjiBerkala($ids),
			'detail_surat'=>$this->surat->getSurat($id),
			'dt_ttd'=>$this->surat->getTtdSurat($ttd),
		);
		$this->load->view('cetak/v_cetak_suratmutasi',$data);
	}
	
	public function cetaknumpang(){
		$this->akses->akses_petugas();
		$surat = $this->surat->getSelectedData('tbl_surat_setting',array('jnsttd'=>'surat'))->result();
		foreach($surat as $row){
			$ttd = $row->ttd;
		}
		$id = $this->uri->segment(3);
		$data=array(
			'title'=>"Surat_numpang_".$id.".pdf",
			'detail_surat'=>$this->surat->getSuratNumpang($id),
			'dt_ttd'=>$this->surat->getTtdSurat($ttd),
		);
		$this->load->view('cetak/v_cetak_suratnumpang',$data);
	}
	
	public function hapusrekom(){
        $id['id_surat'] = $this->uri->segment(3);
		$surat = $this->surat->getSelectedData('tbl_surat',$id)->result();
		foreach($surat as $row){
			$no_uji = $row->no_uji;
		}
		$this->aktifitas_hapus($no_uji);
        $this->surat->deleteData('tbl_surat',$id);
        redirect('surat/rekomendasi');
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
	
	private function generate_qrcode($qrcode_data,$nouji,$kodeuji,$tgl_surat){
		$this->load->library('ciqrcode');
		
		$y = date('Y',strtotime($tgl_surat));
		$m = date('F',strtotime($tgl_surat));
		if (!is_dir('files/surat/'.$y.'/'.$m)) {
		mkdir('./files/surat/'.$y.'/'.$m, 0777, TRUE);
		}
		
		$params['data'] = $qrcode_data;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'files/surat/'.$y.'/'.$m.'/'.$nouji.'_'.$kodeuji.'.png';
		$this->ciqrcode->generate($params);
	}
	
	private function generate_qrcoderekom($qrcode_data,$kode){
		$this->load->library('ciqrcode');
		
		$y = date('Y');
		$m = date('F');
		if (!is_dir('files/surat/'.$y.'/'.$m)) {
		mkdir('./files/surat/'.$y.'/'.$m, 0777, TRUE);
		}
		
		$params['data'] = $qrcode_data;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'files/surat/'.$y.'/'.$m.'/'.$kode.'.png';
		$this->ciqrcode->generate($params);
	}
	
	private function aktifitas_tambah($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Membuat data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->surat->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_ubah($no_uji){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Merubah data '.$this->router->fetch_class().' '.$no_uji,
			'modul'=>$this->router->fetch_method()
		);
		$this->surat->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_hapus($id){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Menghapus data '.$this->router->fetch_class().' '.$id,
			'modul'=>$this->router->fetch_method()
		);
		$this->surat->insertData('tbl_log_aktifitas',$aktifitas);
	}
	
	private function aktifitas_cetak($id){
		$aktifitas=array(
			'id_user'=>$this->session->userdata('id_user'),
			'aktifitas'=>'Mencetak data '.$this->router->fetch_class().' '.$id,
			'modul'=>$this->router->fetch_method()
		);
		$this->surat->insertData('tbl_log_aktifitas',$aktifitas);
	}
}