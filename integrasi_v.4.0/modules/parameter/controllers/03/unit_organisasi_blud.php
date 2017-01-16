<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_organisasi_blud extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Tipe_model');
		$this->load->model('Urusan_model');
		$this->load->model('Skpd_model');
		$this->load->model('Sub_model');
		$this->load->model('Organisasi_blud_model');
		$this->load->library('Datatables');
	}
	
	public function index() {	
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi_buld/view';					

			$container['sub']	= $this->Organisasi_blud_model->get_all_lists();

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}	
	
	public function add() {
		$admin_log = $this->auth->is_login_admin();	
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi_buld/add';
			
			$container['unit']	= $this->Skpd_model->get_all_lists();
						
			$header['admin_log']	= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function sub($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode', 'Tipe', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ccc_kode', 'Skpd', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ddd_kode', 'Sub_nama', 'trim|required|xss_clean');
	
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi_buld/sub';
			
			$container['unit']		= $this->Skpd_model->get_task($id);
			$container['list']		= $this->Sub_model->get_list($id);
			$container['completed']	= $this->Sub_model->get_organisasi($id,true);
						
			$header['admin_log']	= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$insert['tipe']		= $this->input->post('aaa_kode');
			$insert['urusan']	= $this->input->post('bbb_kode');
			$insert['skpd']		= $this->input->post('ccc_kode');
			$insert['sub']		= $this->input->post('ddd_kode');
			$insert['tipe_sort']= 1;
			
			$query = $this->Organisasi_blud_model->insert($insert);			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data indikator baru telah berhasil ditambahkan.</div>');
			redirect('parameter/unit_organisasi_blud', 'refresh');
		}
	}
	
}