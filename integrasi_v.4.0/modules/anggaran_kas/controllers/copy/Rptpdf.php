<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rptpdf extends CI_Controller {
	
	public function __construct() {
		parent::__construct();	
		$this->load->model('Data_model');		
        $this->load->helper('form');
        $this->load->library('fpdf');
	}
	
	public function index()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'rka/rptpdf/view';
			
			$container['data']	= $this->Data_model->select_data();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
    
}    