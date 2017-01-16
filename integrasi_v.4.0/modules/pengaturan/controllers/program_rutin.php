<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program_rutin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Program_rutin_model');
	}
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/program_rutin/edit';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
				
		$program_rutin = $this->Program_rutin_model->get('program_rutin.*', array('program_rutin.kode'=>1));
		
		$container['content']['dataset']['kode']				= $program_rutin->kode;
		$container['content']['dataset']['anggaran2013']		= $program_rutin->anggaran2013;
		$container['content']['dataset']['anggaran2014']		= $program_rutin->anggaran2014;
		$container['content']['dataset']['anggaran2015']		= $program_rutin->anggaran2015;
		$container['content']['dataset']['anggaran2016']		= $program_rutin->anggaran2016;
		$container['content']['dataset']['anggaran2017']		= $program_rutin->anggaran2017;
		$container['content']['dataset']['reanggaran2013']		= $program_rutin->reanggaran2013;
		$container['content']['dataset']['reanggaran2014']		= $program_rutin->reanggaran2014;
		$container['content']['dataset']['reanggaran2015']		= $program_rutin->reanggaran2015;
		$container['content']['dataset']['reanggaran2016']		= $program_rutin->reanggaran2016;
		$container['content']['dataset']['reanggaran2017']		= $program_rutin->reanggaran2017;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('anggaran2013', 'Anggaran Murni Tahun 2013', 'trim|required|xss_clean');
		$this->form_validation->set_rules('anggaran2014', 'Anggaran Murni Tahun 2014', 'trim|required|xss_clean');
		$this->form_validation->set_rules('anggaran2015', 'Anggaran Murni Tahun 2015', 'trim|required|xss_clean');
		$this->form_validation->set_rules('anggaran2016', 'Anggaran Murni Tahun 2016', 'trim|required|xss_clean');
		$this->form_validation->set_rules('anggaran2017', 'Anggaran Murni Tahun 2017', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reanggaran2013', 'Anggaran Perubahan Tahun 2013', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reanggaran2014', 'Anggaran Perubahan Tahun 2014', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reanggaran2015', 'Anggaran Perubahan Tahun 2015', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reanggaran2016', 'Anggaran Perubahan Tahun 2016', 'trim|required|xss_clean');
		$this->form_validation->set_rules('reanggaran2017', 'Anggaran Perubahan Tahun 2017', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/program_rutin/edit';
			
			$program_rutin = $this->Program_rutin_model->get('program_rutin.*', array('program_rutin.kode'=>1));
		
			$container['content']['dataset']['kode']				= $program_rutin->kode;
			$container['content']['dataset']['anggaran2013']		= $program_rutin->anggaran2013;
			$container['content']['dataset']['anggaran2014']		= $program_rutin->anggaran2014;
			$container['content']['dataset']['anggaran2015']		= $program_rutin->anggaran2015;
			$container['content']['dataset']['anggaran2016']		= $program_rutin->anggaran2016;
			$container['content']['dataset']['anggaran2017']		= $program_rutin->anggaran2017;
			$container['content']['dataset']['reanggaran2013']		= $program_rutin->reanggaran2013;
			$container['content']['dataset']['reanggaran2014']		= $program_rutin->reanggaran2014;
			$container['content']['dataset']['reanggaran2015']		= $program_rutin->reanggaran2015;
			$container['content']['dataset']['reanggaran2016']		= $program_rutin->reanggaran2016;
			$container['content']['dataset']['reanggaran2017']		= $program_rutin->reanggaran2017;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['anggaran2013']		= $this->input->post('anggaran2013');
			$update['anggaran2014']		= $this->input->post('anggaran2014');
			$update['anggaran2015']		= $this->input->post('anggaran2015');
			$update['anggaran2016']		= $this->input->post('anggaran2016');
			$update['anggaran2017']		= $this->input->post('anggaran2017');
			$update['reanggaran2013']	= $this->input->post('reanggaran2013');
			$update['reanggaran2014']	= $this->input->post('reanggaran2014');
			$update['reanggaran2015']	= $this->input->post('reanggaran2015');
			$update['reanggaran2016']	= $this->input->post('reanggaran2016');
			$update['reanggaran2017']	= $this->input->post('reanggaran2017');
						
			$query = $this->Program_rutin_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data program rutin telah berhasil diubah.</div>');
			
			redirect('pengaturan/program_rutin', 'refresh');
		}
	}
}
