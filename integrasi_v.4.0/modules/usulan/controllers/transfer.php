<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfer extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Skpd_model');
		$this->load->model('Visi_model');
		$this->load->model('Prioritas_model');
		$this->load->model('Kesepakatan_model');
		$this->load->model('Sifat_model');
		$this->load->model('Lokasi_model');
		$this->load->model('Kecamatan_model');
	}
		
	public function index()
	{
		redirect('transfer/murni', 'refresh');
	}
	
	public function murni()
	{
		$admin_log = $this->auth->is_login_admin();
 		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 2;
		$container['content']['view']					= 'usulan/renja_murni';
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC');
		$container['content']['dataset']['visi']		= $this->Visi_model->get('kode, visi', array('kode' => '1'));
		$container['content']['dataset']['prioritas']	= $this->Prioritas_model->grid_all('kode, prioritas', 'prioritas', 'ASC');
		$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
		$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');
		$container['content']['dataset']['lokasi']		= $this->Lokasi_model->grid_all('lokasi_kode, lokasi_nama', 'lokasi_kode', 'ASC');
		$container['content']['dataset']['kecamatan']	= $this->Kecamatan_model->grid_all('kecamatan_kode, kecamatan_nama', 'kecamatan_nama', 'ASC');
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function perubahan()
	{
		$admin_log = $this->auth->is_login_admin();
 		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 2;
		$container['content']['view']					= 'usulan/renja_perubahan';
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC');
		$container['content']['dataset']['visi']		= $this->Visi_model->get('kode, visi', array('kode' => '1'));
		$container['content']['dataset']['prioritas']	= $this->Prioritas_model->grid_all('kode, prioritas', 'prioritas', 'ASC');
		$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
		$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');
		$container['content']['dataset']['lokasi']		= $this->Lokasi_model->grid_all('lokasi_kode, lokasi_nama', 'lokasi_kode', 'ASC');
		$container['content']['dataset']['kecamatan']	= $this->Kecamatan_model->grid_all('kecamatan_kode, kecamatan_nama', 'kecamatan_nama', 'ASC');
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
}
