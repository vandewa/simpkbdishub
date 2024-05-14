<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	SIM PKB ONLINE
	DEVELOP BY GHANI NUR WICAKSONO 
	COPYRIGHT 2016
	PLEASE DONT COMMERCIAL THIS SCRIPT
	FOR MORE INFOMATION CALL 085742913814
*/

class Sms extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_app');
		$this->load->helper('date');
	}
	
	public function index(){
		$data = $this->model_app->getSms();
		$now = time();
		foreach ($data as $row){	
			$id = $row->ID;
			$idpengirim['ID'] = $row->ID;
			$noPengirim = $row->SenderNumber;
			$pesan = strtoupper($row->TextDecoded);
			
			$split = explode(" ",$pesan);
			if($split[0] == "KIR"){
				$no_uji = $split[1];
				$cek_data = $this->model_app->getSmsCekData($no_uji);
				$rows = $cek_data->row();
				if($cek_data->num_rows() === 0){
					$balas = 'Data KIR kendaraan tidak ditemukan, Cek format SMS anda : KIR<spasi>No Uji , Contoh : KIR<spasi>SLW1234';
				}
				else{
					$no_uji = $rows->no_uji;
					$habis_uji = $rows->tgl_habis_uji;
					$habis = date("d-m-Y", strtotime($habis_uji));
					$ret = $rows->retribusi;
					if($ret=='150000'){
						$n_ret = 40000;
					} else if ($ret=='200000'){
						$n_ret = 50000;
					} else if ($ret=='250000'){
						$n_ret = 60000;
					} else if ($ret=='300000'){
						$n_ret = 70000;
					} else if ($ret=='350000'){
						$n_ret = 80000;
					} else {
						$n_ret = $ret;
					}
					
					$buk = $rows->buku;
					$rbuk = 10000;
					$pla = $rows->plat;
					$sti = $rows->stiker;
					if($buk == '0'){
						$retribusi = $n_ret+$pla+$sti+$rbuk;
					}
					else{
						$retribusi = $n_ret+$pla+$sti;
					}
					
					$balas = 'Masa berlaku uji kir anda no uji '.$no_uji.' habis tanggal '.$habis.'. Retribusi sebesar Rp '.$retribusi.'.';
				}
				
				$kirim_balasan = array(
					'DestinationNumber' => $noPengirim,
					'TextDecoded' => $balas,
					'DeliveryReport' => 'yes',
				);
				$sudah_proses = array(
					'Processed' => 'true',
				);
				$this->model_app->insertData('outbox',$kirim_balasan);
				$this->model_app->updateData('inbox',$sudah_proses,$idpengirim);
			}
		}
		$this->load->view('pages/v_sms');
	}
}