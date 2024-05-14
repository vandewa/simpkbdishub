<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_whatsapp','model');
	}
	
	public function notifhabis1(){
		$date1 = date("Y-m-d", strtotime("-48 month"));
		$date2 = date("Y-m-d", strtotime("-42 month"));
		$date3 = date("Y-m-d", strtotime("-36 month"));
		$date4 = date("Y-m-d", strtotime("-30 month"));
		$date5 = date("Y-m-d", strtotime("-24 month"));
		$date6 = date("Y-m-d", strtotime("-21 month"));
		$date7 = date("Y-m-d", strtotime("-18 month"));
		$date8 = date("Y-m-d", strtotime("-15 month"));
		$tgl = array($date1,$date2,$date3,$date4,$date5,$date6,$date7,$date8);
		$kendaraan = $this->model->getKendaraan();
		
		$setting = $this->model->getAllData('tbl_setting');
		foreach ($setting as $row){
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
		
		for ($i=0;$i<8; $i++) {
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
		
						$message = 'Hi sdr/i *'.$row->nama.'* _(sesuai STNK)_ , '. PHP_EOL .'Masa berlaku *UJI KIR* kendaraan anda dengan nomor kendaraan *'.$row->no_kendaraan.' ('.$row->no_uji.') - '.$row->bentuk.'*  '.$text.' pada tanggal *'.strftime("%d %B %Y", strtotime($row->tgl_habis_uji)).'*. Mohon untuk segera melakukan uji berkala kendaraan anda di Pengujian Kendaraan Bermotor Kabupaten Wonosobo. Pastikan kendaraan anda sudah siap diuji dan laik jalan serta jangan lupa selalu menggunakan masker. '. PHP_EOL .''. PHP_EOL .'Segera lakukan uji kir kendaraan anda agar tidak terkena *Sanksi Denda Administrasi* '. PHP_EOL .'Jika habis uji kir melebihi 2 tahun, maka kendaraan akan *Dihapus* dari kendaraan bermotor wajib uji di Kabupaten Wonosobo (PM 133 Tahun 2015 Pasal 65) '. PHP_EOL .''. PHP_EOL .'*Informasi :* '. PHP_EOL .'*Pelayanan Uji Kendaraan Hari Ini '.$tglinfo.' '.$statusinfo.'* *'.$jaminfo.'* *'.$ketinfo.'* '. PHP_EOL .''.$info.''. PHP_EOL .''. PHP_EOL .'Terima kasih. '. PHP_EOL .'UPUBKB Disperkimhub Kab. Wonosobo '. PHP_EOL .''. PHP_EOL .'_Pesan ini dibuat secara otomatis oleh Disperkimhub Kab. Wonosobo_';
						$pesan = 'Hi '.$row->nama.', Masa berlaku UJI KIR kendaraan anda dengan nomor kendaraan '.$row->no_kendaraan.' ('.$row->no_uji.') - '.$row->bentuk.' '.$text.' pada tanggal '.strftime("%d %B %Y", strtotime($row->tgl_habis_uji)).'. Mohon untuk segera melakukan uji berkala kendaraan anda di UPT Pengujian Kendaraan Bermotor Kabupaten Wonosobo. Pastikan kendaraan anda sudah siap diuji dan laik jalan serta jangan lupa selalu menggunakan masker. Terima kasih. Uji Kendaraan (E-kir) Disperkimhub Kab. Wonosobo';
						
						$data = [
							'api_key' => $api,
							'sender'  => $sender,
							'number'  => $telp,
							'message' => $message,
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
						
						$whatsapp=array(
							'phone'=>$row->telp,
							'message'=>$pesan,
							'no_uji'=>$row->no_uji,
							'jeniswa'=>'KELUAR',
						);
						$this->model->insertData('tbl_wagateway',$whatsapp);
					}
				}
			}
		}
	}
	
	public function notifhabis2(){
		$date1 = date("Y-m-d", strtotime("-12 month"));
		$date2 = date("Y-m-d", strtotime("-10 month"));
		$date3 = date("Y-m-d", strtotime("-8 month"));
		$date4 = date("Y-m-d", strtotime("-6 month"));
		$date5 = date("Y-m-d", strtotime("-5 month"));
		$date6 = date("Y-m-d", strtotime("-4 month"));
		$date7 = date("Y-m-d", strtotime("-3 month"));
		$date8 = date("Y-m-d", strtotime("-2 month"));
		$tgl = array($date1,$date2,$date3,$date4,$date5,$date6,$date7,$date8);
		$kendaraan = $this->model->getKendaraan();
		
		$setting = $this->model->getAllData('tbl_setting');
		foreach ($setting as $row){
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
				$informasi[] = $inf->informasi.' \n1 ';
			}
		} else {
			$informasi[] ='';
		}
		$info = implode(' ', $informasi);
		
		for ($i=0;$i<8; $i++) {
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
		
						$message = 'Hi sdr/i *'.$row->nama.'* _(sesuai STNK)_ , '. PHP_EOL .'Masa berlaku *UJI KIR* kendaraan anda dengan nomor kendaraan *'.$row->no_kendaraan.' ('.$row->no_uji.') - '.$row->bentuk.'*  '.$text.' pada tanggal *'.strftime("%d %B %Y", strtotime($row->tgl_habis_uji)).'*. Mohon untuk segera melakukan uji berkala kendaraan anda di Pengujian Kendaraan Bermotor Kabupaten Wonosobo. Pastikan kendaraan anda sudah siap diuji dan laik jalan serta jangan lupa selalu menggunakan masker. '. PHP_EOL .''. PHP_EOL .'Segera lakukan uji kir kendaraan anda agar tidak terkena *Sanksi Denda Administrasi* '. PHP_EOL .'Jika habis uji kir melebihi 2 tahun, maka kendaraan akan *Dihapus* dari kendaraan bermotor wajib uji di Kabupaten Wonosobo (PM 133 Tahun 2015 Pasal 65) '. PHP_EOL .''. PHP_EOL .'*Informasi :* '. PHP_EOL .'*Pelayanan Uji Kendaraan Hari Ini '.$tglinfo.' '.$statusinfo.'* *'.$jaminfo.'* *'.$ketinfo.'* '. PHP_EOL .''.$info.''. PHP_EOL .''. PHP_EOL .'Terima kasih. '. PHP_EOL .'UPUBKB Disperkimhub Kab. Wonosobo '. PHP_EOL .''. PHP_EOL .'_Pesan ini dibuat secara otomatis oleh Disperkimhub Kab. Wonosobo_';
						$pesan = 'Hi '.$row->nama.', Masa berlaku UJI KIR kendaraan anda dengan nomor kendaraan '.$row->no_kendaraan.' ('.$row->no_uji.') - '.$row->bentuk.' '.$text.' pada tanggal '.strftime("%d %B %Y", strtotime($row->tgl_habis_uji)).'. Mohon untuk segera melakukan uji berkala kendaraan anda di UPT Pengujian Kendaraan Bermotor Kabupaten Wonosobo. Pastikan kendaraan anda sudah siap diuji dan laik jalan serta jangan lupa selalu menggunakan masker. Terima kasih. Uji Kendaraan (E-kir) Disperkimhub Kab. Wonosobo';
						
						$data = [
							'api_key' => $api,
							'sender'  => $sender,
							'number'  => $telp,
							'message' => $message,
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
						
						$whatsapp=array(
							'phone'=>$row->telp,
							'message'=>$pesan,
							'no_uji'=>$row->no_uji,
							'jeniswa'=>'KELUAR',
						);
						$this->model->insertData('tbl_wagateway',$whatsapp);
					}
				}
			}
		}
	}
	
	public function notifhabis3(){
		$date1 = date("Y-m-d", strtotime("-1 month"));
		$date2 = date("Y-m-d", strtotime("-14 days"));
		$date3 = date("Y-m-d", strtotime("-7 days"));
		$tgl = array($date1,$date2,$date3);
		$kendaraan = $this->model->getKendaraan();
		
		$setting = $this->model->getAllData('tbl_setting');
		foreach ($setting as $row){
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
				$informasi[] = $inf->informasi.' \n1 ';
			}
		} else {
			$informasi[] ='';
		}
		$info = implode(' ', $informasi);
		
		for ($i=0;$i<3; $i++) {
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
		
						$message = 'Hi sdr/i *'.$row->nama.'* _(sesuai STNK)_ , '. PHP_EOL .'Masa berlaku *UJI KIR* kendaraan anda dengan nomor kendaraan *'.$row->no_kendaraan.' ('.$row->no_uji.') - '.$row->bentuk.'*  '.$text.' pada tanggal *'.strftime("%d %B %Y", strtotime($row->tgl_habis_uji)).'*. Mohon untuk segera melakukan uji berkala kendaraan anda di Pengujian Kendaraan Bermotor Kabupaten Wonosobo. Pastikan kendaraan anda sudah siap diuji dan laik jalan serta jangan lupa selalu menggunakan masker. '. PHP_EOL .''. PHP_EOL .'Segera lakukan uji kir kendaraan anda agar tidak terkena *Sanksi Denda Administrasi* '. PHP_EOL .'Jika habis uji kir melebihi 2 tahun, maka kendaraan akan *Dihapus* dari kendaraan bermotor wajib uji di Kabupaten Wonosobo (PM 133 Tahun 2015 Pasal 65) '. PHP_EOL .''. PHP_EOL .'*Informasi :* '. PHP_EOL .'*Pelayanan Uji Kendaraan Hari Ini '.$tglinfo.' '.$statusinfo.'* *'.$jaminfo.'* *'.$ketinfo.'* '. PHP_EOL .''.$info.''. PHP_EOL .''. PHP_EOL .'Terima kasih. '. PHP_EOL .'UPUBKB Disperkimhub Kab. Wonosobo '. PHP_EOL .''. PHP_EOL .'_Pesan ini dibuat secara otomatis oleh Disperkimhub Kab. Wonosobo_';
						$pesan = 'Hi '.$row->nama.', Masa berlaku UJI KIR kendaraan anda dengan nomor kendaraan '.$row->no_kendaraan.' ('.$row->no_uji.') - '.$row->bentuk.' '.$text.' pada tanggal '.strftime("%d %B %Y", strtotime($row->tgl_habis_uji)).'. Mohon untuk segera melakukan uji berkala kendaraan anda di UPT Pengujian Kendaraan Bermotor Kabupaten Wonosobo. Pastikan kendaraan anda sudah siap diuji dan laik jalan serta jangan lupa selalu menggunakan masker. Terima kasih. Uji Kendaraan (E-kir) Disperkimhub Kab. Wonosobo';
						
						$data = [
							'api_key' => $api,
							'sender'  => $sender,
							'number'  => $telp,
							'message' => $message,
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
						
						$whatsapp=array(
							'phone'=>$row->telp,
							'message'=>$pesan,
							'no_uji'=>$row->no_uji,
							'jeniswa'=>'KELUAR',
						);
						$this->model->insertData('tbl_wagateway',$whatsapp);
					}
				}
			}
		}
	}
	
	public function notifhabis4(){
		$date1 = date("Y-m-d", strtotime("+0 days"));
		$date2 = date("Y-m-d", strtotime("+7 days"));
		$tgl = array($date1,$date2);
		$kendaraan = $this->model->getKendaraan();
		
		$setting = $this->model->getAllData('tbl_setting');
		foreach ($setting as $row){
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
				$informasi[] = $inf->informasi.' \n1 ';
			}
		} else {
			$informasi[] ='';
		}
		$info = implode(' ', $informasi);
		
		for ($i=0;$i<2; $i++) {
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
		
						$message = 'Hi sdr/i *'.$row->nama.'* _(sesuai STNK)_ , '. PHP_EOL .'Masa berlaku *UJI KIR* kendaraan anda dengan nomor kendaraan *'.$row->no_kendaraan.' ('.$row->no_uji.') - '.$row->bentuk.'*  '.$text.' pada tanggal *'.strftime("%d %B %Y", strtotime($row->tgl_habis_uji)).'*. Mohon untuk segera melakukan uji berkala kendaraan anda di Pengujian Kendaraan Bermotor Kabupaten Wonosobo. Pastikan kendaraan anda sudah siap diuji dan laik jalan serta jangan lupa selalu menggunakan masker. '. PHP_EOL .''. PHP_EOL .'Segera lakukan uji kir kendaraan anda agar tidak terkena *Sanksi Denda Administrasi* '. PHP_EOL .'Jika habis uji kir melebihi 2 tahun, maka kendaraan akan *Dihapus* dari kendaraan bermotor wajib uji di Kabupaten Wonosobo (PM 133 Tahun 2015 Pasal 65) '. PHP_EOL .''. PHP_EOL .'*Informasi :* '. PHP_EOL .'*Pelayanan Uji Kendaraan Hari Ini '.$tglinfo.' '.$statusinfo.'* *'.$jaminfo.'* *'.$ketinfo.'* '. PHP_EOL .''.$info.''. PHP_EOL .''. PHP_EOL .'Terima kasih. '. PHP_EOL .'UPUBKB Disperkimhub Kab. Wonosobo '. PHP_EOL .''. PHP_EOL .'_Pesan ini dibuat secara otomatis oleh Disperkimhub Kab. Wonosobo_';
						$pesan = 'Hi '.$row->nama.', Masa berlaku UJI KIR kendaraan anda dengan nomor kendaraan '.$row->no_kendaraan.' ('.$row->no_uji.') - '.$row->bentuk.' '.$text.' pada tanggal '.strftime("%d %B %Y", strtotime($row->tgl_habis_uji)).'. Mohon untuk segera melakukan uji berkala kendaraan anda di UPT Pengujian Kendaraan Bermotor Kabupaten Wonosobo. Pastikan kendaraan anda sudah siap diuji dan laik jalan serta jangan lupa selalu menggunakan masker. Terima kasih. Uji Kendaraan (E-kir) Disperkimhub Kab. Wonosobo';
						
						$data = [
							'api_key' => $api,
							'sender'  => $sender,
							'number'  => $telp,
							'message' => $message,
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
						
						$whatsapp=array(
							'phone'=>$row->telp,
							'message'=>$pesan,
							'no_uji'=>$row->no_uji,
							'jeniswa'=>'KELUAR',
						);
						$this->model->insertData('tbl_wagateway',$whatsapp);
					}
				}
			}
		}
	}
}