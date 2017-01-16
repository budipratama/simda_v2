<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indikator extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Skpd_model');
		$this->load->model('Anggaran_model');
		$this->load->model('Anggaran_rutin_model');
		$this->load->model('Tahapan_model');
		$this->load->library('Datatables');
	}
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/indikator/view';
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
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
		$container['content']['view']					= 'laporan/indikator/preview';
		$container['content']['dataset']['tanggal']		= $this->input->post('tanggal');
		$container['content']['dataset']['tahun']		= $this->input->post('tahun');
		$container['content']['dataset']['tahapan']		= $this->input->post('tahapan');
		$header['admin_log']							= $admin_log;
		
		$sess_laporan = array(
			'laporan_tanggal'  	=> $this->input->post('tanggal'),
			'laporan_tahun' 	=> $this->input->post('tahun'),
			'laporan_tahapan' 	=> $this->input->post('tahapan')
			);
		
		if ($this->input->post('tahun')) { 
			$this->session->unset_userdata('is_sess_laporan');
			$this->session->set_userdata('is_sess_laporan', $sess_laporan);
			redirect('laporan/indikator/preview', 'refresh');
		}
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function hasil()
	{	
		$tipe 		= $this->uri->segment(4);
		if ($tipe == 'excel') {
			$laporan['excel']	= TRUE;
		} else if ($tipe == 'pdf'){ 
			$laporan['pdf']		= TRUE;
		} else {
			$laporan['excel']	= FALSE;
			$laporan['pdf']		= FALSE;
		}
		$admin_log 		= $this->auth->is_login_admin();
		$sess_laporan 	= $this->session->userdata('is_sess_laporan');
		$tahapan		= $this->Tahapan_model->get('tahapan.nama as tahapan_nama', array('tahapan.kode' => $sess_laporan['laporan_tahapan']));
		
		$laporan['laporan_tanggal']		= $sess_laporan['laporan_tanggal'];
		$laporan['laporan_tahun']		= $sess_laporan['laporan_tahun'];
		$laporan['laporan_tahapan']		= $tahapan->tahapan_nama;
		$laporan['laporan_tahapan_kode']= $sess_laporan['laporan_tahapan'];
		
		$this->load->view('laporan/indikator/hasil', $laporan);
	}
}
