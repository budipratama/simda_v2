<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sasaran extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sasaran_model');
		$this->load->model('Tujuan_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, kode, sasaran, tujuan_nama')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('sasaran, tujuan_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, sasaran.kode, sasaran.sasaran, tujuan.tujuan as tujuan_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, sasaran LEFT JOIN tujuan ON sasaran.tujuan=tujuan.kode ORDER BY sasaran.sasaran ASC) sasaran');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/sasaran/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
				
		$container['content']['dataset']['grid']		= $this->Sasaran_model->grid_all('sasaran.*, tujuan.tujuan as tujuan_nama', 'sasaran', 'ASC');
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/sasaran/add';
		$container['content']['dataset']['tujuan']		= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('tujuan_kode', 'Tujuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sasaran', 'Sasaran', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']						= 'admin/sidebar';
			$container['content']['view']				= 'pengaturan/sasaran/add';
			$container['content']['dataset']['tujuan']	= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
			
			$header['admin_log']						= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['tujuan']		= $this->input->post('tujuan_kode');
			$insert['sasaran']		= $this->input->post('sasaran');
						
			$query = $this->Sasaran_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data sasaran baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/sasaran', 'refresh');
		}

	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']				= 'pengaturan/sasaran/edit';
		$container['content']['dataset']['tujuan']	= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
		
		$sasaran = $this->Sasaran_model->get('sasaran.*', array('sasaran.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $sasaran->kode;
		$container['content']['dataset']['sasaran']		= $sasaran->sasaran;
		$container['content']['dataset']['tujuan_kode']	= $sasaran->tujuan;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('tujuan_kode', 'Tujuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sasaran', 'Sasaran', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/sasaran/edit';
			$container['content']['dataset']['tujuan']		= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
			
			$sasaran = $this->Sasaran_model->get('sasaran.*', array('sasaran.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['kode']		= $sasaran->kode;
			$container['content']['dataset']['sasaran']		= $sasaran->sasaran;
			$container['content']['dataset']['tujuan_kode']	= $sasaran->tujuan;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['tujuan']			= $this->input->post('tujuan_kode');
			$update['sasaran']			= $this->input->post('sasaran');
						
			$query = $this->Sasaran_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data sasaran telah berhasil diubah.</div>');
			
			redirect('pengaturan/sasaran', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/sasaran/detail';
		$container['content']['dataset']				= '';
		
		$sasaran = $this->Sasaran_model->get('sasaran.*, tujuan.tujuan as tujuan_nama', array('sasaran.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $sasaran->kode;
		$container['content']['dataset']['sasaran']		= $sasaran->sasaran;
		$container['content']['dataset']['tujuan_kode']	= $sasaran->tujuan;
		$container['content']['dataset']['tujuan_nama']	= $sasaran->tujuan_nama;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Sasaran_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data sasaran telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/sasaran', 'refresh');
	}
}
