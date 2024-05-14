<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_pengujian');
		$this->load->model('model_kendaraan');
		$this->load->model('model_beranda','model');
		$this->load->model('model_wagateway','wagateway');
		$this->load->model('model_pendaftaran','pendaftaran');
		$this->load->helper('date');
		$this->load->library('fpdf');
	}
	
	public function index(){
		$data=array(
			'title'=>'Sistem Informasi Pengujian Kendaraan Bermotor',
			'aktif_beranda'=>'active',
			'dt_grafik'=>$this->model->getGrafikRetribusi(),
		);
		$this->load->view('home/v_header',$data);
		$this->load->view('home/v_beranda');
		$this->load->view('home/v_footer');
	}
	
	public function kendaraan(){
		$no = $this->input->post('no_uji');
		if($no!=""){
			$data=array(
				'dt_kendaraan'=>$this->model->getCekKendaraan($no),
			);
			$this->load->view('home/v_ajax_cek',$data);
		}
	}
	
	public function berkas(){
		$data=array(
			'title'=>'Status Berkas Pengujian Kendaraan Bermotor Kabupaten Wonosobo',
			'aktif_berkas'=>'active',
			'dt_pendaftaran'=>$this->model->getStatusBerkas(),
		);
		$this->load->view('home/v_header',$data);
		$this->load->view('home/v_status_berkas');
		$this->load->view('home/v_footer');
	}
	
	public function cekuji(){
		$id = $this->uri->segment(3);
		$data=array(
			'dt_cek'=>$this->model->getCekUji($id),
		);
		$this->load->view('home/v_cek_data',$data);
	}
	
	public function datauji(){
		$id = $this->uri->segment(3);
		$data=array(
			'dt_cek'=>$this->model->getCekDataUji($id),
		);
		$this->load->view('home/v_cek_data',$data);
	}
	
	public function ceksurat(){
		$id = $this->uri->segment(3);
		$data=array(
			'dt_cek'=>$this->model->getCekSurat($id),
		);
		$this->load->view('home/v_cek_surat',$data);
	}
	
	public function ceknumpang(){
		$this->load->view('home/v_cek_numpang');
	}
	
	public function data(){
		$data=array(
			'title'=>'Data Pendapatan Pengujian Kendaraan Bermotor Kabupaten Wonosobo',
			'aktif_data'=>'active',
			'dt_retribusi'=>$this->model->getDataRetribusi(),
			'dt_pengujian'=>$this->model->getDataPengujian(),
			'dt_retribusi_bulan'=>$this->model->getRetribusiBulan(),
			'dt_retribusi_tahun'=>$this->model->getRetribusiTahun(),
			'dt_target'=>$this->model->getTargetRetribusi(),
			'dt_target_total'=>$this->model->getTarget(),
		);
		$this->load->view('home/v_header',$data);
		$this->load->view('home/v_data_pendapatan');
		$this->load->view('home/v_footer');
	}
	
	public function pendaftaran(){
		$data=array(
			'title'=>'Informasi Pendaftaran Uji Kendaraan Bermotor',
			'aktif_info'=>'active',
		);
		$this->load->view('home/v_header',$data);
		$this->load->view('home/v_info_pendaftaran');
		$this->load->view('home/v_footer');
	}
	
	public function retribusi(){
		$data=array(
			'title'=>'Informasi Biaya Pengujian Kendaraan Bermotor',
			'aktif_tarif'=>'active',
		);
		$this->load->view('home/v_header',$data);
		$this->load->view('home/v_info_retribusi');
		$this->load->view('home/v_footer');
	}
	
	public function statusuji(){
		$data=array(
			'title'=>'Status Pengujian',
			'dt_uji'=>$this->model_pengujian->getStatusUji(),
		);
		$this->load->view('pengujian/v_status_uji',$data);
	}
	
	public function booking(){
		$data=array(
			'title'=>'Booking Pendaftaran Uji Kendaraan',
			'dt_libur'=>$this->model->getAllData('tbl_harilibur'),
		);
		$this->load->view('pendaftaran/v_daftar_online',$data);
	}
	
	public function prosesbooking(){
		$tgl = $this->input->post('tgl_booking');
		$kode = $this->model->getKodeBooking($tgl);
		$kode_uji = time()."OL";
		$nama = $this->input->post('nama');
		$telp = $this->input->post('telp');
		$metode = $this->input->post('metode_bayar');
		
		$antrian = $this->model->getNomorAntrian($tgl);
		$no_kw = $this->model->getKodeKwitansiOnline();
		$billing = $this->model->getKodeBillingOnline();
		$tgl_dftr = date('Y-m-d H:i:s');
		$expired = strtotime("+2 day");
		
		if($metode=="tunai"){
			$tgl_exp = date($tgl,$expired);
		} else {
			$tgl_exp = date('Y-m-d').' 23:00:00';
		}
		
		$data=array(
			'kode_booking'=>$kode,
			'no_antrian'=>$antrian,
			'kode_uji'=>$kode_uji,
			'tgl_booking'=>$tgl,
			'jenis_pendaftaran'=>$this->input->post('jenis_pendaftaran'),
			'no_uji'=>$this->input->post('no_uji'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'nama'=>$nama,
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'telp'=>$telp,
			'metode_bayar'=>$metode,
			'pernyataan'=>$this->input->post('pernyataan'),
		);
		
		$retribusi=array(
			'kode_uji'=>$kode_uji,
			'no_kwitansi'=>$no_kw,
			'no_uji'=>$this->input->post('no_uji'),
			'id_billing'=>$billing,
			'exp_billing'=>$tgl_exp,
			'tgl_pembayaran'=>$tgl_dftr,
			'status_bayar'=>0,
			'retribusi'=>$this->input->post('retribusi'),
			'tanda'=>$this->input->post('tanda'),
			'denda'=>$this->input->post('denda'),
			'jml_denda'=>$this->input->post('jml_denda'),
			'total_retribusi'=>$this->input->post('total_retribusi'),
			'total_semua'=>$this->input->post('total_semua'),
			'terbilang'=>$this->terbilang($this->input->post('total_semua')),
			'aktif'=>1,
		);
		
		$tblantrian=array(
			'tgl_antrian'=>$tgl,
			'kode_uji'=>$kode_uji,
			'no_antrian'=>$antrian,
		);
		
		$this->model->insertData('tbl_pra_pendaftaran',$data);
		$this->model->insertData('tbl_pra_retribusi',$retribusi);
		$this->model->insertData('tbl_antrian',$tblantrian);
		$this->kirimnotif($billing,$antrian,$nama,$telp,$tgl);
		$this->generate_qrcode($kode);
		$this->generate_qrbilling($billing,$tanggal_daftar);
		redirect('bookingonline/sukses?id='.$kode);
	}
	
	public function cekantrian(){
		$id = $this->input->get('tgl', TRUE);
		$data=array(
            'dt_antrian'=>$this->model->getDataAntrian($id),
        );
        $this->load->view('pendaftaran/v_ajax_cekbooking',$data);
	}
	
	public function get_retribusi(){
		$uji = str_replace("+"," ",$this->input->get('uji', TRUE));
		$jns = str_replace("+"," ",$this->input->get('jns', TRUE));
		$jbb = $this->input->get('jbb', TRUE);
		$data = $this->pendaftaran->getJenisTarifRetribusi($uji,$jns,$jbb);
		echo json_encode($data);
	}
	
	public function get_kendaraan(){
		$id = $this->input->post('no_uji');
		$kendaraan = $this->model_kendaraan->getDataKend($id);
		echo json_encode($kendaraan);
	}
	
	public function cekkendaraan(){
		$id = $this->input->post('no_uji');
		if($id!=""){
			$data=array(
				'dt_kendaraan'=>$this->model->getCekDaftarOnline($id),
			);
			$this->load->view('pendaftaran/v_ajax_cekkendaraan',$data);
		}
	}
	
	public function cekbiaya(){
		$no = $this->input->post('no_uji');
		if($no!=""){
			$data=array(
				'dt_kendaraan'=>$this->model->getCekKendaraan($no),
			);
			$this->load->view('pendaftaran/v_ajax_cekretribusi',$data);
		}
	}
	
	public function booking_sukses(){
		$id = $this->input->get('id', TRUE);
		$data=array(
			'title'=>'Cetak Kode Booking Pendaftaran Uji Kendaraan',
			'id'=>$id,
		);
		$this->load->view('pendaftaran/v_sukses_booking',$data);
	}
	
	public function cetak_booking(){
		$id = $this->input->get('id', TRUE);
		$idx['kode_booking'] = $this->input->get('id', TRUE);
		$data=array(
			'title'=>"BuktiPendaftaran_".$id.".pdf",
			'dt_booking'=>$this->model->getSelectedData('tbl_pra_pendaftaran',$idx)->result(),
		);
		$this->load->view('cetak/v_cetak_pendaftaran_online',$data);
	}
	
	private function generate_qrcode($kode){
		$this->load->library('ciqrcode');
		
		$params['data'] = $kode;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'files/booking/'.$kode.'.png';
		$this->ciqrcode->generate($params);
	}
	
	public function datakendaraan(){
		$data=array(
			'title'=>'Cek Data Kendaraan',
		);
		$this->load->view('home/v_cek_data_kendaraan',$data);
	}
	
	public function bookingmobile(){
		$data=array(
			'title'=>'Booking Pendaftaran Uji Kendaraan',
			'dt_libur'=>$this->model->getAllData('tbl_harilibur'),
		);
		$this->load->view('pendaftaran/v_daftar_online_mobile',$data);
	}
	
	public function prosesbookingmobile(){
		$tgl = $this->input->post('tgl_booking');
		$kode = $this->model->getKodeBooking($tgl);
		$nama = $this->input->post('nama');
		$telp = $this->input->post('telp');
		$data=array(
			'kode_booking'=>$kode,
			'tgl_booking'=>$tgl,
			'jenis_pendaftaran'=>$this->input->post('jenis_pendaftaran'),
			'no_uji'=>$this->input->post('no_uji'),
			'no_kendaraan'=>$this->input->post('no_kendaraan'),
			'nama'=>$nama,
			'alamat'=>$this->input->post('alamat'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'telp'=>$telp,
			'pernyataan'=>$this->input->post('pernyataan'),
		);
		$this->model->insertData('tbl_pra_pendaftaran',$data);
		$this->kirimnotif($kode,$nama,$telp,$tgl);
		$this->generate_qrcode($kode);
		$this->session->set_flashdata('sukses', '<script>alert("Terima kasih pendaftaran berhasil, silahkan lakukan verifikasi pada kantor pelayanan uji dengan menunjukan WhatsApp bukti pendaftaran.");</script>');
		redirect('beranda/bookingmobile');
	}
	
	public function informasimobile(){
		$data=array(
			'title'=>'Booking Pendaftaran Uji Kendaraan',
			'dt_informasi'=>$this->model->getSelectedData('tbl_informasi',array('aktif'=>1))->result(),
		);
		$this->load->view('home/v_informasi_mobile',$data);
	}
	
	public function app(){
		$data=array(
			'title'=>'Sistem Informasi Pengujian Kendaraan Bermotor',
			'aktif_dashboard'=>'active',
			'header'=>'App',
			'headertitle'=>'Dashboard',
		);
		$this->load->view('app/v_header',$data);
		$this->load->view('app/v_dashboard');
		$this->load->view('app/v_footer');
	}
	
	public function formikm(){
		$data=array(
			'title'=>'Indeks Kepuasan Masyarakat',
			'aktif_formikm'=>'active',
			'open_ikm'=>'nav-item-expanded nav-item-open',
			'header'=>'IKM',
			'headertitle'=>'Survey Kepuasan Masyarakat',
		);
		$this->load->view('app/v_header',$data);
		$this->load->view('app/v_formikm');
		$this->load->view('app/v_footer');
	}
	
	public function prosesikm(){
		$kode = $this->uri->segment(3);
		if($kode != null) {
			$id = $kode;
			$idx['kode_uji'] = $kode;
			$ikm=array(
				'ikm'=>1,
			);
			$this->model->updateData('tbl_pendaftaran',$ikm,$idx);
			$dt_kendaraan = $this->model->getPengguna($id);
			foreach($dt_kendaraan as $row){
				$nama = $row->nama;
				$telp = $row->telp;
			}
			$this->kirimnotifikm($nama,$telp);
			$this->session->set_flashdata('sukses', $nama);
        }
		$data=array(
			'kode_uji'=>$kode,
			'kepuasan'=>$this->input->post('kepuasan'),
			'kecepatan'=>$this->input->post('kecepatan'),
			'saran'=>$this->input->post('saran'),
		);
		$this->model->insertData('tbl_ikm',$data);
		redirect('beranda/ikmsukses');
	}
	
	public function ikmsukses(){
		$data=array(
			'title'=>'Indeks Kepuasan Masyarakat',
			'aktif_formikm'=>'active',
			'open_ikm'=>'nav-item-expanded nav-item-open',
			'header'=>'IKM',
			'headertitle'=>'Survey Kepuasan Masyarakat',
		);
		$this->load->view('app/v_header',$data);
		$this->load->view('app/v_ikmsukses');
		$this->load->view('app/v_footer');
	}
	
	public function surveyikm(){
		$data=array(
			'title'=>'Indeks Kepuasan Masyarakat',
			'aktif_surveyikm'=>'active',
			'open_ikm'=>'nav-item-expanded nav-item-open',
			'header'=>'IKM',
			'headertitle'=>'Survey Kepuasan Masyarakat',
			'dt_grafik'=>$this->model->getGrafikSurvey(),
		);
		$this->load->view('app/v_header',$data);
		$this->load->view('app/v_surveyikm');
		$this->load->view('app/v_footer');
	}
	
	public function kirimnotif_ulang(){
		$id = $this->input->get('id', TRUE);
		$dt_booking = $this->model->getDataBooking($id);
		foreach($dt_booking as $row){
			$billing = $row->id_billing;
			$antrian = $row->no_antrian;
			$nama = $row->nama;
			$telp = $this->input->post('no_wa');
			$tgl = $row->tgl_booking;
		}
		$data=array(
			'title'=>'Cetak Kode Booking Pendaftaran Uji Kendaraan',
			'id'=>$id,
		);
		$this->session->set_flashdata('kirimulang', '<script>alert("Bukti pendaftaran online berhasil dikirimkan ulang melalui pesan WhatsApp.");</script>');
		$this->kirimnotif($billing,$antrian,$nama,$telp,$tgl);
		$this->load->view('pendaftaran/v_sukses_booking',$data);
	}
	
	private function kirimnotif($billing,$nama,$telp,$tgl){
		$setting = $this->model->getAllData('tbl_setting');
		foreach ($setting as $row){
			$api = $row->api_wa;
			$sender = $row->no_wa;
		}

		$data = [
			'api_key' => $api,
			'sender'  => $sender,
			'number'  => $telp,
			'message' => 'Hi '.$nama.', '. PHP_EOL .'Terima kasih telah melakukan pendaftaran online uji kendaraan di UPUBKB Disperkimhub Kabupaten Wonosobo. '. PHP_EOL .''. PHP_EOL .'Nomor Antrian Anda: '. PHP_EOL .'Kode Pembayaran : '.$billing.'. '. PHP_EOL .'Tanggal Booking Uji : '.strftime("%d %B %Y", strtotime($tgl)).' '. PHP_EOL .'Wajib datang sesuai tanggal booking uji kendaraan dan Harap tunjukan bukti pendaftaran ini kepada petugas saat melakukan uji. '. PHP_EOL .''. PHP_EOL .'Harap datang sesuai dengan antrian pada jam berikut : '. PHP_EOL .'1. Antrian 1-20 pukul 07.00 - 08.00 '. PHP_EOL .'2. Antrian 21-40 pukul 08.00 - 09.00 '. PHP_EOL .'3. Antrian 41-60 pukul 09.00 - 10.00 '. PHP_EOL .'4. Antrian 61-80 pukul 10.00 - 11.00 '. PHP_EOL .'5. Antrian 81-100 pukul 11.00 - 12.00 '. PHP_EOL .'Terima kasih. '. PHP_EOL .'UPUBKB Disperkimhub Kab. Wonosobo '. PHP_EOL .''. PHP_EOL .'_Pesan ini dibuat secara otomatis oleh Disperkimhub Kab. Wonosobo_',
		];
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wakita.aminsproject.com/api/send-message.php",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data))
		);
		$response = curl_exec($curl);
		curl_close($curl);
	}
	
	
	private function kirimnotifikm($nama,$telp){
		$setting = $this->model->getAllData('tbl_setting');
		foreach ($setting as $row){
			$api = $row->api_wa;
			$sender = $row->no_wa;
		}

		$data = [
			'api_key' => $api,
			'sender'  => $sender,
			'number'  => $telp,
			'message' => 'Hi '.$nama.', '. PHP_EOL .'Terima kasih telah berpartisipasi mengisi formulir survey kepuasan pelayanan kami. Tetap patuhi peraturan lalu lintas dan segera lakukan uji kendaraan kembali sebelum masa ujinya habis. '. PHP_EOL .''. PHP_EOL .'Terima kasih. '. PHP_EOL .'UPUBKB Disperkimhub Kab. Wonosobo '. PHP_EOL .''. PHP_EOL .'_Pesan ini dibuat secara otomatis oleh Disperkimhub Kab. Wonosobo_',
		];
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wakita.aminsproject.com/api/send-message.php",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data))
		);
		$response = curl_exec($curl);
		curl_close($curl);
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