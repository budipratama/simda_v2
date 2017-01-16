<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Anggaran_model');
		$this->load->model('Skpd_model');
		$this->load->model('Anggaran_model');

	}
		
	public function index()
	{	
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		$tahun 						= date("Y");
		$tahun_anggaran 			= $tahun + 1;
		$tahun						= date("Y") + 1;
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 23;
		$container['content']['view']					= 'home/home';
		$container['content']['dataset']['tahun_anggaran']	= $tahun_anggaran;
		$container['content']['dataset']['hasil_musrenbang']= $this->Anggaran_model->count_all(array('anggaran.tahun'=>$tahun_anggaran, 'anggaran.tahapan_kode'=>'4'));
		$container['content']['dataset']['hasil_musrenbang_proses']= $this->Anggaran_model->count_all(array('anggaran.tahun'=>$tahun_anggaran, 'anggaran.tahapan_kode'=>'4', 'anggaran.status'=>'2'));

		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/home');
	}
	
}
