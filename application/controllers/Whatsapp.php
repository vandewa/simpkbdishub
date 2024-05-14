<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_whatsapp','model');
	}
	
	public function notifuji(){
		$setting = $this->model->getSelectedData('tbl_wagateway_server',array('aktif'=>1))->result();
		foreach ($setting as $row){
			$jenis_server = $row->jenis;
			$server = $row->server_wa;
			$api = $row->api_wa;
			$sender = $row->no_wa;
		}
		$count = $this->model->getDataNotif()->num_rows();
		$dtnotif = $this->model->getDataNotif()->result();
		foreach($dtnotif as $row){
			$id = $row->idx;
			$idx['idx'] = $row->idx;
			$telp = $row->phone;
			$message = $row->message;
			if(($telp!='') && ($telp!='-') && ($telp!='0')){		
				$curl = curl_init();
				$token = $api;

				//API V1
				$data = [
					'phone' => $row->phone,
					'message' => '*Dinas Perhubungan Kabupaten Wonosobo*'. PHP_EOL .''. PHP_EOL .$row->message,
				];
				curl_setopt(
					$curl,
					CURLOPT_HTTPHEADER,
					array(
						"Authorization: $token",
					)
				);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($curl, CURLOPT_URL, $server . "/api/send-message");
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
				$result = curl_exec($curl);
				curl_close($curl);
			}
			
			$whatsapp=array(
				'status'=>1,
			);
			$this->model->updateData('tbl_wagateway',$whatsapp,$idx);
		}
		if($count > 0){
			$this->cronlog($count);
		}
	}
	
	public function notifhabis(){
		$date1 = date("Y-m-d", strtotime("-24 month"));
		$date2 = date("Y-m-d", strtotime("-18 month"));
		$date3 = date("Y-m-d", strtotime("-12 month"));
		$date4 = date("Y-m-d", strtotime("-6 month"));
		$date5 = date("Y-m-d", strtotime("-3 month"));
		$date6 = date("Y-m-d", strtotime("-1 month"));
		$date7 = date("Y-m-d", strtotime("-14 days"));
		$date8 = date("Y-m-d", strtotime("+0 days"));
		$date9 = date("Y-m-d", strtotime("+7 days"));
		$tgl = array($date1,$date2,$date3,$date4,$date5,$date6,$date7,$date8,$date9);
		$kendaraan = $this->model->getKendaraan();
		
		$setting = $this->model->getSelectedData('tbl_wagateway_server',array('aktif'=>1))->result();
		foreach ($setting as $row){
			$jenis_server = $row->jenis;
			$server = $row->server_wa;
			$api = $row->api_wa;
			$sender = $row->no_wa;
		}
		
		$tglskrg = date('Y-m-d');
		$tglskrgx['tgl_libur'] = date('Y-m-d');
		$harilibur = $this->model->getSelectedData('tbl_harilibur',$tglskrgx)->result();
		if(!empty($harilibur)){
			foreach($harilibur as $lib){
				$tgllibur = $lib->tgl_libur;
				$ketlibur = $lib->keterangan;
			}
		} else {
			$tgllibur = '';
		}
		if($tglskrg==$tgllibur){
			$tglinfo = strftime("%A %d %B %Y", strtotime($tgllibur));
			$jaminfo = '';
			$statusinfo = 'TUTUP';
			$ketinfo = $ketlibur;
			
		} else {
			$kodeharix['kodehari'] = date('N');
			$jamkerja = $this->model->getSelectedData('tbl_jamkerja',$kodeharix)->result();
			foreach($jamkerja as $jam){
				$tglinfo = strftime("%A %d %B %Y", strtotime($tglskrg));
				$jaminfo = $jam->jam_kerja;
				$statusinfo = $jam->keterangan;
				$ketinfo = '';
			}
		}
		
		$dtinformasi = $this->model->getSelectedData('tbl_informasi',array('aktif'=>'1'))->result();
		if(!empty($dtinformasi)){
			foreach($dtinformasi as $inf){
				$informasi[] = $inf->informasi.''. PHP_EOL .'';
			}
		} else {
			$informasi[] ='';
		}
		$info = implode(' ', $informasi);
		
		for ($i=0;$i<9; $i++) {
			foreach($kendaraan as $row){
				if($row->tgl_habis_uji==$tgl[$i]){
					if($row->tgl_habis_uji < date("Y-m-d")){ $text = '*Sudah Habis*'; } else { $text = 'akan habis';}
					if(($row->telp!='') && ($row->telp!='-') && ($row->telp!='0')){
						$pertama = mb_substr($row->telp, 0, 1);
						if($pertama=="0"){
							$telp = substr_replace($row->telp,'62',0,1);
						} else {
							$telp = $row->telp;
						}
						
						$message = 'Hi sdr/i *'.$row->nama.'* _(sesuai STNK)_ , '. PHP_EOL .'Masa berlaku *UJI KIR* kendaraan anda dengan nomor kendaraan *'.$row->no_kendaraan.' ('.$row->no_uji.') - '.$row->bentuk.'*  '.$text.' pada tanggal *'.strftime("%d %B %Y", strtotime($row->tgl_habis_uji)).'*. Mohon untuk segera melakukan uji berkala kendaraan anda di Pengujian Kendaraan Bermotor Kabupaten Wonosobo. Pastikan kendaraan anda sudah siap diuji dan selalu dalam kondisi laik jalan. '. PHP_EOL .''. PHP_EOL .'Segera lakukan uji kir kendaraan anda agar tidak terkena *Sanksi Denda Administrasi*'. PHP_EOL .'Abaikan pesan ini jika sudah kir / numpang kir ke daerah lain.'. PHP_EOL .'Informasi dan pengaduan hubungi Call Center Admin Nomor Whatsapp https://wa.me/620895402951812'. PHP_EOL .''. PHP_EOL .'Terima kasih.';
						
						/*
						$curl = curl_init();
						$token = $api;

						//API V1
						$data = [
							'phone' => $row->phone,
							'message' => $row->message,
						];
						curl_setopt(
							$curl,
							CURLOPT_HTTPHEADER,
							array(
								"Authorization: $token",
							)
						);
						curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
						curl_setopt($curl, CURLOPT_URL, $server . "/api/send-message");
						curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
						$result = curl_exec($curl);
						curl_close($curl);
						*/

						$whatsapp=array(
							'phone'=>$row->telp,
							'message'=>$message,
							'no_uji'=>$row->no_uji,
							'jeniswa'=>'KELUAR',
							'status'=>0,
						);
						$this->model->insertData('tbl_wagateway',$whatsapp);
					}
				}
			}
		}
	}
	
	private function cronlog($count){
		$date = date("Y-m-d H:i:s");
		$cronlog=array(
			'cron'=>'Cronjob notifikasi modul '.$this->router->fetch_method().' '.$count.' pesan',
			'tanggal'=>$date,
		);
		$this->model->insertData('tbl_cronlog',$cronlog);
	}
}