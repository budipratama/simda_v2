<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prioritas extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Prioritas_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, kode, prioritas')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('prioritas')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, prioritas.kode, prioritas.prioritas FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, prioritas ORDER BY prioritas.prioritas ASC) prioritas');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/prioritas/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
				
		$container['content']['dataset']['grid']		= $this->Prioritas_model->grid_all('*', 'prioritas', 'ASC');
		
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
		$container['content']['view']					= 'pengaturan/prioritas/add';
		$container['content']['dataset']				= '';
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('prioritas', 'Prioritas', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/prioritas/add';
			$container['content']['dataset']				= '';
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['prioritas']		= $this->input->post('prioritas');
						
			$query = $this->Prioritas_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data prioritas baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/prioritas', 'refresh');
		}

	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/prioritas/edit';
		$container['content']['dataset']				= '';
		
		$prioritas = $this->Prioritas_model->get('prioritas.*', array('prioritas.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $prioritas->kode;
		$container['content']['dataset']['prioritas']	= $prioritas->prioritas;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('prioritas', 'Prioritas', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/prioritas/edit';
			$container['content']['dataset']				= '';
			
			$prioritas = $this->Prioritas_model->get('prioritas.*', array('prioritas.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['kode']		= $prioritas->kode;
			$container['content']['dataset']['prioritas']	= $prioritas->prioritas;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['prioritas']		= $this->input->post('prioritas');
						
			$query = $this->Prioritas_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data prioritas telah berhasil diubah.</div>');
			
			redirect('pengaturan/prioritas', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/prioritas/detail';
		$container['content']['dataset']				= '';
		
		$prioritas = $this->Prioritas_model->get('prioritas.*', array('prioritas.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $prioritas->kode;
		$container['content']['dataset']['prioritas']	= $prioritas->prioritas;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Prioritas_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data prioritas telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/prioritas', 'refresh');
	}
}
