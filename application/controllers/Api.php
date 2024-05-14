<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestApi/RestController.php';
use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
		$this->load->model('model_api','model');
    }

    function index_get() {
		$this->response([
			'status' => '00',
			'pesan' => 'Service Tersedia',
		], RestController::HTTP_OK);
    }
	
	function kendaraan_get() {
		$id = $this->get('id');
		$kendaraan = $this->model->getKendaraan($id);
        if ($id === null) {
            $this->response([
				'status' => 'S3',
				'pesan' => 'Data Tidak Ditemukan Masukan Nomor Uji Kendaraan',
			], RestController::HTTP_OK);
        } else {
            if($kendaraan){
				$kend = $this->model->getCekKendaraan($id);		
				if($kend>0){
					$this->response([
						'status' => 'S1',
						'pesan' => 'Data Ditemukan',
						'data' => $kendaraan,
					], RestController::HTTP_OK);
				} else {
					$this->response([
						'status' => 'S2',
						'pesan' => 'Kendaraan Ganda',
					], RestController::HTTP_OK);
				}
			} else {
				$this->response([
					'status' => 'S3',
					'pesan' => 'Data Tidak Ditemukan',
				], RestController::HTTP_OK);
			}
        }
    }
	
	function retribusi_get(){
		$id = $this->get('data');
        if ($id === null) {
            $this->response([
				'status' => 'S3',
				'pesan' => 'Data Tidak Ditemukan, Harap Masukan Jenis Retribusi',
			], RestController::HTTP_OK);
        } else if($id == 'harian'){
			$ret = $this->model->getGrafikRetribusi();		
			$this->response([
				'status' => 'S1',
				'pesan' => 'Data Ditemukan',
				'data' => $ret,
			], RestController::HTTP_OK);
		} else if($id == 'bulanan'){
			$ret = $this->model->getGrafikRetribusiTahun();		
			$this->response([
				'status' => 'S1',
				'pesan' => 'Data Ditemukan',
				'data' => $ret,
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => 'S3',
				'pesan' => 'Data Tidak Ditemukan, Harap Masukan Jenis Retribusi',
			], RestController::HTTP_OK);
		}
	}
		
	function pembayaran_get() {
		$id = $this->get('id');
		$transaksi = $this->model->getTransaksi($id);
		
        if ($id === null) {
            $this->response([
				'status' => 'S3',
				'pesan' => 'Data Tidak Ditemukan',
			], RestController::HTTP_OK);
        } else {
            if($transaksi){
				$bayar = $this->model->getCekBayar($id);		
				foreach($bayar as $row){
					$sta_bayar = $row->status_bayar;
				}
				if($sta_bayar == "0"){
					foreach($transaksi as $row){
						$exp = $row->exp_billing;
					}
					if($exp < date("Y-m-d H:i:s")){
						$this->response([
							'status' => 'S6',
							'pesan' => 'Kode Pembayaran Kadaluarsa',
						], RestController::HTTP_OK);
					} else {
						$this->response([
							'status' => '00',
							'pesan' => 'Data Ditemukan',
							'data' => $transaksi,
						], RestController::HTTP_OK);
					}
				} else {
					$this->response([
						'status' => 'S4',
						'pesan' => 'Pembayaran Sudah Terbayar',
					], RestController::HTTP_OK);
				}
			} else {
				$this->response([
					'status' => 'S3',
					'pesan' => 'Data Tidak Ditemukan',
				], RestController::HTTP_OK);
			}
        }
    }
	
	function transaksi_put(){
		$id = $this->put('id');
		
		if ($id === null) {
            $this->response([
				'status' => 'S3',
				'pesan' => 'Kode pembayaran tidak ada',
			], RestController::HTTP_OK);
        } else {
			$bayar = $this->model->getCekBayar($id);		
			foreach($bayar as $row){
				$sta_bayar = $row->status_bayar;
			}
			if($sta_bayar == "0"){
				$data = [
					'id_billing' => $id,
					'noreff' => $this->put('no_reff'),
					'tgl_reff' => $this->put('tanggal'),
					'status_bayar'=>1,
				];
			
				if($this->model->UpdateTransaksi($data, $id) > 0){
					$this->response([
						'status' => '00',
						'pesan' => 'Pembayaran Sukses',
					], RestController::HTTP_OK);
				} else {
					$this->response([
						'status' => 'S1',
						'pesan' => 'Pembayaran Gagal',
					], RestController::HTTP_OK);
				}
			} else {
				$this->response([
					'status' => 'S4',
					'pesan' => 'Pembayaran Sudah Terbayar',
				], RestController::HTTP_OK);
			}
		}
	}
}
