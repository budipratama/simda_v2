<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pra_rencana_kerja extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Skpd_model');
		$this->load->model('Visi_model');
		$this->load->model('Misi_model');
		$this->load->model('Prioritas_model');
		$this->load->model('Kesepakatan_model');
		$this->load->model('Sifat_model');
		$this->load->model('Lokasi_model');
		$this->load->model('Kecamatan_model');
		$this->load->model('Indikator_skpd_model');
		$this->load->model('Program_model');
		$this->load->model('Anggaran_model');
		$this->load->library('Datatables');
	}
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/pra_rencana_kerja/view';
		if ($admin_log['level_kode'] == 5 || $admin_log['level_kode'] == 4){
			$skpd = $this->Skpd_model->get('skpd_kode, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
			$container['content']['dataset']['skpd_kode']	= $skpd->skpd_kode;
			$container['content']['dataset']['skpd_nama']	= $skpd->skpd_nama;
			$container['content']['dataset']['skpd_aktive']	= 'no';
		} else {
			$container['content']['dataset']['skpd_aktive']	= 'yes';
		}
		
		if ($admin_log['level_kode'] == 4){
			$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
			$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
			$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
			$container['content']['dataset']['kecamatan_aktive']= 'no';
		} else {
			$container['content']['dataset']['kecamatan_aktive']= 'yes';
		}
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$where_skpd										= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function preview()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/pra_rencana_kerja/preview';
		$container['content']['dataset']['tanggal']		= $this->input->post('tanggal');
		$container['content']['dataset']['tahun']		= $this->input->post('tahun');
		$container['content']['dataset']['skpd_kode']	= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'semua';
		$container['content']['dataset']['kecamatan_kode']	= ($this->input->post('kecamatan_kode'))?$this->input->post('kecamatan_kode'):'semua';
		$container['content']['dataset']['deskel_kode']		= ($this->input->post('deskel_kode'))?$this->input->post('deskel_kode'):'semua';
		$container['content']['dataset']['tipe_kode']	= $this->input->post('tipe_kode');
		$container['content']['dataset']['transfer']	= $this->input->post('transfer');
		$container['content']['dataset']['nama_pimpinan']= $this->input->post('nama_pimpinan');
		$container['content']['dataset']['pangkat']		= $this->input->post('pangkat');
		$container['content']['dataset']['nip']			= $this->input->post('nip');
		$header['admin_log']							= $admin_log;
		
		$sess_laporan = array(
			'laporan_tanggal'  	=> $this->input->post('tanggal'),
			'laporan_tahun' 	=> $this->input->post('tahun'),
			'laporan_skpd' 		=> $container['content']['dataset']['skpd_kode'],
			'laporan_kecamatan' => $container['content']['dataset']['kecamatan_kode'],
			'laporan_deskel'  	=> $container['content']['dataset']['deskel_kode'],
			'laporan_tipe'  	=> $this->input->post('tipe_kode'),
			'laporan_transfer'  => $this->input->post('transfer'),
			'laporan_pimpinan'  => $this->input->post('nama_pimpinan'),
			'laporan_pangkat'  	=> $this->input->post('pangkat'),
			'laporan_nip'  		=> $this->input->post('nip')
			);
		
		if ($this->input->post('tahun')) { 
			$this->session->unset_userdata('is_sess_laporan');
			$this->session->set_userdata('is_sess_laporan', $sess_laporan);
			redirect('laporan/pra-rencana-kerja/preview', 'refresh');
		}
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function hasil()
	{	
		$tipe 		= $this->uri->segment(4);
		if ($tipe == 'excel'){
			$laporan['excel']		= TRUE;
		} else {
			$laporan['excel']		= FALSE;
		}
		$admin_log 		= $this->auth->is_login_admin();
		$sess_laporan 	= $this->session->userdata('is_sess_laporan');
		
		$laporan['laporan_tanggal']		= $sess_laporan['laporan_tanggal'];
		$laporan['laporan_tahun']		= $sess_laporan['laporan_tahun'];
		$laporan['laporan_skpd']		= $sess_laporan['laporan_skpd'];
		$laporan['laporan_kecamatan']	= $sess_laporan['laporan_kecamatan'];
		$laporan['laporan_deskel']		= $sess_laporan['laporan_deskel'];
		$laporan['laporan_tipe']		= $sess_laporan['laporan_tipe'];
		$laporan['laporan_transfer']	= $sess_laporan['laporan_transfer'];
		$laporan['laporan_pimpinan']	= $sess_laporan['laporan_pimpinan'];
		$laporan['laporan_pangkat']		= $sess_laporan['laporan_pangkat'];
		$laporan['laporan_nip']			= $sess_laporan['laporan_nip'];
		
		if ($laporan['laporan_skpd'] != 'semua'){
			$skpd	= $this->Skpd_model->get('skpd_kode, skpd_nama, skpd_status', array('skpd_kode' => $sess_laporan['laporan_skpd']));
			$laporan['skpd_kode']		= $skpd->skpd_kode;
			$laporan['skpd_nama']		= $skpd->skpd_nama;
			$laporan['skpd_status']		= $skpd->skpd_status;
		} else {
			$laporan['skpd_kode']		= 'semua';
			$laporan['skpd_nama']		= 'SATUAN KERJA PERANGKAT DAERAH';
			$laporan['skpd_status']		= 'SKPD/Kecamatan';
		}
		
		if ($laporan['skpd_kode'] == 'semua'){
			$laporan['nama_skpd'] = $laporan['skpd_nama'];
		} else if ($laporan['skpd_status'] == 'Kecamatan'){
			$laporan['nama_skpd'] = $laporan['skpd_status'].' '.$laporan['skpd_nama'];
		} else {
			$laporan['nama_skpd'] = $laporan['skpd_nama'];
		}
		
		
		$laporan['jumlah_data']			= 1;
		
		
		$this->load->view('laporan/pra_rencana_kerja/hasil', $laporan);
	}
	
	public function tampil_combobox_deskel_by_kecamatan(){
		$admin_log = $this->auth->is_login_admin();
		echo '<label class="control-label">Desa/Kelurahan :</label>';
		$where_kecamatan	= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
		$like['skpd_kd']	= $this->uri->segment(4);
		$data_skpd = $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_kecamatan, $like);
		combobox('db', $data_skpd, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Semua Desa/Kelurahan', 'class="select2_category form-control" tabindex="1"');
		
	}
}