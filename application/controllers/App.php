<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_beranda','model');
		$this->load->model('model_wagateway','wagateway');
		$this->load->model('model_pengujian');
		$this->load->helper('date');
		$this->load->library('fpdf');
	}
	
	public function index(){
		$data=array(
			'title'=>'SIMPKB App Integrasi',
			'aktif_dashboard'=>'active',
			'header'=>'SIMPKB',
			'headertitle'=>'App Integrasi',
			'dt_grafik'=>$this->model->getGrafikRetribusi(),
			'dt_retribusi_tahun'=>$this->model->getRetribusiTahun(),
		);
		$this->load->view('app/v_header',$data);
		$this->load->view('app/v_dashboard');
		$this->load->view('app/v_footer');
	}
	
	public function pendaftaran(){
		$data=array(
			'title'=>'Pendaftaran Uji Kendaraan Online',
			'aktif_daftar'=>'active',
			'header'=>'Pendaftaran',
			'headertitle'=>'Uji Kendaraan Online',
			'dt_libur'=>$this->model->getAllData('tbl_harilibur'),
		);
		$this->load->view('app/v_header',$data);
		$this->load->view('app/v_daftar_online');
		$this->load->view('app/v_footer');
	}
	
	public function petunjukpembayaran(){
		$data=array(
			'title'=>'Petunjuk Pembayaran Uji Kendaraan',
			'aktif_petunjukpembayaran'=>'active',
			'open_pembayaran'=>'nav-item-expanded nav-item-open',
			'header'=>'Pembayaran',
			'headertitle'=>'Petunjuk Pembayaran',
		);
		$this->load->view('app/v_header',$data);
		$this->load->view('app/v_formikm');
		$this->load->view('app/v_footer');
	}
	
	public function hasiluji(){
		$id = $this->uri->segment(3);
		$idx['kode_uji'] = $this->uri->segment(3);
		$data=array(
			'title'=>'Hasil Uji Kendaraan',
			'dt_foto'=>$this->model->getSelectedData('tbl_uji_foto',$idx)->result(),
			'dt_kendaraan'=>$this->model->getHasilUji(),
		);
		$this->load->view('app/v_hasil_uji',$data);
	}
	
	public function get_fotouji(){
		$idx['kode_uji'] = $this->input->get('id', TRUE);
		$data=array(
			'dt_foto'=>$this->model->getSelectedData('tbl_uji_foto',$idx)->result(),
		);
		$this->load->view('app/v_ajax_foto_uji',$data);
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
			'usia'=>$this->input->post('usia'),
			'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
			'pendidikan'=>$this->input->post('pendidikan'),
			'pekerjaan'=>$this->input->post('pekerjaan'),
			'kesesuaian'=>$this->input->post('kesesuaian'),
			'kemudahan'=>$this->input->post('kemudahan'),
			'kecepatan'=>$this->input->post('kecepatan'),
			'sistem'=>$this->input->post('sistem'),
			'kompetensi'=>$this->input->post('kompetensi'),
			'kesopanan'=>$this->input->post('kesopanan'),
			'sarana'=>$this->input->post('sarana'),
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
			//'dt_grafik_kolom'=>$this->model->getColumnChartIKM($jenis),
			//'dt_grafik_pie'=>$this->model->getPieChartIKM(),
		);
		$this->load->view('app/v_header',$data);
		$this->load->view('app/v_surveyikm');
		$this->load->view('app/v_footer');
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