<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sumber_dana extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Sumber_dana_model');
		$this->load->library('Datatables');
	}
	
	public function index() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/sumber_dana/view';
			
			$container['sumber'] 							= $this->Sumber_dana_model->get_list();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	public function add($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('rek1_kode','Kd_rek_1','trim|xss_clean');
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/sumber_dana/add';			
		{
			if($this->form_validation->run() == FALSE){
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'kd_sumber'		=> $this->input->post('kkk_kode'),
					'nm_sumber	'	=> $this->input->post('aaa_kode')
				);		
				if($this->Sumber_dana_model->insert($container)){
					$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUMBER DANA" telah berhasil ditambahkan</div>');
				    redirect('parameter/sumber-dana');
				}
			}
		}
    }
	
}