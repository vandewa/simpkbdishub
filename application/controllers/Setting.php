<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_app');
		$this->load->model('akses');
		$this->load->library('fpdf');
		if($this->session->userdata('login') != 1 ){
            redirect('login');
        };
	}
	
	public function index(){
		//$this->akses->akses_admin();
		$idx['id_user'] = $this->session->userdata('id_user');
		$data=array(
			'title'=>'Pengaturan Pengujian Kendaraan Bermotor Online',
			'data_setting'=>$this->model_app->getSetting(),
			'data_printset'=>$this->model_app->getSelectedData('tbl_printer_setting',$idx)->result(),
			'data_printer'=>$this->model_app->getAlldata('tbl_printer'),
			'data_target'=>$this->model_app->getAlldata('tbl_retribusi_target'),
			'data_pejabat'=>$this->model_app->getAlldata('tbl_pejabat'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('pages/v_setting');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahtarget(){
		$data=array(
			'dpa'=>$this->input->post('tahun'),
			'kategori'=>$this->input->post('kategori'),
			'target'=>$this->input->post('target'),
		);
		$this->model_app->insertData('tbl_retribusi_target',$data);
		redirect('setting');
	}
	
	public function simpantarget(){
		$id = $this->uri->segment(3);
		$idx['id_user'] = $this->uri->segment(3);
		$data=array(
			'pendaftaran'=>$this->input->post('ip_print_daftar'),
			'pembayaran'=>$this->input->post('ip_print_bayar'),
			'stiker'=>$this->input->post('ip_print_stiker'),
			'buku_uji'=>$this->input->post('ip_print_buku'),
			'kartu_induk'=>$this->input->post('ip_print_kartu'),
			'surat'=>$this->input->post('ip_print_surat'),
		);
		$this->model_app->updateData('tbl_printer_setting',$data,$idx);
		redirect('setting');
	}
	
	public function tambahpejabat(){
		$data=array(
			'nip'=>$this->input->post('nip'),
			'nama'=>$this->input->post('nama'),
			'pangkat'=>$this->input->post('pangkat'),
			'jabatan'=>$this->input->post('jabatan'),
		);
		$this->model_app->insertData('tbl_pejabat',$data);
		redirect('setting');
	}
	
	public function editpejabat(){
		$id['id_pejabat'] = $this->uri->segment(3);
		$data=array(
			'nip'=>$this->input->post('nip'),
			'nama'=>$this->input->post('nama'),
			'pangkat'=>$this->input->post('pangkat'),
			'jabatan'=>$this->input->post('jabatan'),
		);
		$this->model_app->updateData('tbl_pejabat',$data,$id);
		redirect('setting');
	}
	
	public function umum(){
		$data=array(
			'title'=>'Pengaturan Pengujian Kendaraan Bermotor Online',
			'aktif_pengaturan'=>'active',
			'open_pengaturan'=>'open',
			'pengaturan_umum'=>'active',
			'dt_setting'=>$this->model_app->getSetting(),
			'dt_wilayah'=>$this->model_app->getAlldata('kodewilayah'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('setting/v_setting');
		$this->load->view('pages/v_footer');
	}
	
	public function updateumum(){
		$id['id'] = $this->uri->segment(3);
		$data=array(
			'dinas'=>$this->input->post('dinas'),
			'alamat'=>$this->input->post('alamat'),
			'telepon'=>$this->input->post('telepon'),
			'email'=>$this->input->post('email'),
			'kd_buku'=>$this->input->post('kd_buku'),
			'kd_stiker'=>$this->input->post('kd_stiker'),
			'kodewilayah'=>$this->input->post('kodewilayah'),
			'namawilayah'=>$this->input->post('namawilayah'),
			'no_wa'=>$this->input->post('no_wa'),
			'api_wa'=>$this->input->post('api_wa'),
		);
		$this->model_app->updateData('tbl_setting',$data,$id);
		redirect('setting/umum');
	}
	
	public function wilayah(){
		$data=array(
			'title'=>'Pengaturan Kode Wilayah',
			'aktif_pengaturan'=>'active',
			'open_pengaturan'=>'open',
			'pengaturan_wilayah'=>'active',
			'dt_wilayah'=>$this->model_app->getAlldata('kodewilayah'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('setting/v_wilayah');
		$this->load->view('pages/v_footer');
	}
	
	public function kadis(){
		$data=array(
			'title'=>'Pengaturan Kepala Dinas',
			'aktif_pengaturan'=>'active',
			'open_pengaturan'=>'open',
			'pengaturan_kadis'=>'active',
			'dt_kadis'=>$this->model_app->getAlldata('kepaladinas'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('setting/v_kadis');
		$this->load->view('pages/v_footer');
	}
	
	public function harilibur(){
		$data=array(
			'title'=>'Pengaturan Hari Libur',
			'aktif_pengaturan'=>'active',
			'open_pengaturan'=>'open',
			'pengaturan_harilibur'=>'active',
			'dt_libur'=>$this->model_app->getAlldata('tbl_harilibur'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('setting/v_harilibur');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahlibur(){
		$data=array(
			'tgl_libur'=>$this->input->post('tgl_libur'),
			'keterangan'=>$this->input->post('keterangan'),
		);
		$this->model_app->insertData('tbl_harilibur',$data);
		redirect('setting/harilibur');
	}
	
	public function editlibur(){
		$id['id_harilibur'] = $this->uri->segment(3);
		$data=array(
			'tgl_libur'=>$this->input->post('tgl_libur'),
			'keterangan'=>$this->input->post('keterangan'),
		);
		$this->model_app->updateData('tbl_harilibur',$data,$id);
		redirect('setting/harilibur');
	}
	
	public function hapuslibur(){
		$id['id_harilibur'] = $this->uri->segment(3);
		$table = array('tbl_harilibur');
        $this->master->deleteData($table,$id);
		redirect('setting/harilibur');
	}
	
	public function informasi(){
		$data=array(
			'title'=>'Pengaturan Informasi',
			'aktif_pengaturan'=>'active',
			'open_pengaturan'=>'open',
			'pengaturan_informasi'=>'active',
			'dt_informasi'=>$this->model_app->getAlldata('tbl_informasi'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('setting/v_informasi');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahinformasi(){
		$data=array(
			'informasi'=>$this->input->post('informasi'),
			'tgl_informasi'=>$this->input->post('tgl_informasi'),
		);
		$this->model_app->insertData('tbl_informasi',$data);
		redirect('setting/informasi');
	}
	
	public function editinformasi(){
		$id['id_informasi'] = $this->uri->segment(3);
		$data=array(
			'informasi'=>$this->input->post('informasi'),
			'tgl_informasi'=>$this->input->post('tgl_informasi'),
		);
		$this->model_app->updateData('tbl_informasi',$data,$id);
		redirect('setting/informasi');
	}
	
	public function hapusinformasi(){
		$id['id_informasi'] = $this->uri->segment(3);
		$table = array('tbl_informasi');
        $this->master->deleteData($table,$id);
		redirect('setting/informasi');
	}
	
	public function ttdsurat(){
		$data=array(
			'title'=>'Pengaturan Tanda Tangan Surat',
			'aktif_pengaturan'=>'active',
			'open_pengaturan'=>'open',
			'ttd_surat'=>'active',
			'dt_ttd'=>$this->model_app->getAlldata('tbl_surat_setting'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('setting/v_setting_surat');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahttdsurat(){
		$data=array(
			'jnsttd'=>$this->input->post('jnsttd'),
			'ttd'=>$this->input->post('ttd'),
		);
		$this->model_app->insertData('tbl_surat_setting',$data);
		redirect('setting/ttdsurat');
	}
	
	public function updatettdsurat(){
		$id['id_surat_setting'] = $this->uri->segment(3);
		$data=array(
			'jnsttd'=>$this->input->post('jnsttd'),
			'ttd'=>$this->input->post('ttd'),
		);
		$this->model_app->updateData('tbl_surat_setting',$data,$id);
		redirect('setting/ttdsurat');
	}
	
	public function wagateway(){
		$data=array(
			'title'=>'Pengaturan WhatsApp Gateway',
			'aktif_pengaturan'=>'active',
			'open_pengaturan'=>'open',
			'pengaturan_wagateway'=>'active',
			'dt_wagateway'=>$this->model_app->getAlldata('tbl_wagateway_server'),
		);
		$this->load->view('pages/v_header',$data);
		$this->load->view('setting/v_wagateway');
		$this->load->view('pages/v_footer');
	}
	
	public function tambahwagateway(){
		$data=array(
			'jenis'=>$this->input->post('jenis'),
			'server_wa'=>$this->input->post('server_wa'),
			'no_wa'=>$this->input->post('no_wa'),
			'api_wa'=>$this->input->post('api_wa'),
		);
		$this->model_app->insertData('tbl_wagateway_server',$data);
		redirect('setting/wagateway');
	}
	
	public function editwagateway(){
		$idx['id_server'] = $this->uri->segment(3);
		$data=array(
			'jenis'=>$this->input->post('jenis'),
			'server_wa'=>$this->input->post('server_wa'),
			'no_wa'=>$this->input->post('no_wa'),
			'api_wa'=>$this->input->post('api_wa'),
			'aktif'=>$this->input->post('aktif'),
		);
		$this->model_app->updateData('tbl_wagateway_server',$data,$idx);
		redirect('setting/wagateway');
	}
	
	public function hapuswagateway(){
		$idx['id_server'] = $this->uri->segment(3);
		$table = array('tbl_wagateway_server');
        $this->model_app->deleteData($table,$idx);
		redirect('setting/wagateway');
	}
	
	public function get_kode_wilayah(){
		$id['kodewilayah'] = $this->input->post('kdwil');
		$kota= $this->model_app->getSelectedData('kodewilayah',$id)->result();
		echo json_encode($kota);
	}
}