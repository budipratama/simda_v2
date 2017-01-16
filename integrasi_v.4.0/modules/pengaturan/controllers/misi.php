<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Misi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Misi_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, kode, misi')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('misi')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, misi.kode, misi.misi FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, misi ORDER BY misi.misi ASC) misi');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/misi/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
				
		$container['content']['dataset']['grid']		= $this->Misi_model->grid_all('*', 'misi', 'ASC');
		
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
		$container['content']['view']					= 'pengaturan/misi/add';
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

		$this->form_validation->set_rules('misi', 'Misi', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/misi/add';
			$container['content']['dataset']				= '';
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['misi']		= $this->input->post('misi');
						
			$query = $this->Misi_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data misi baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/misi', 'refresh');
		}

	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/misi/edit';
		$container['content']['dataset']				= '';
		
		$misi = $this->Misi_model->get('misi.*', array('misi.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $misi->kode;
		$container['content']['dataset']['misi']		= $misi->misi;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('misi', 'Misi', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/misi/edit';
			$container['content']['dataset']				= '';
			
			$misi = $this->Misi_model->get('misi.*', array('misi.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['kode']		= $misi->kode;
			$container['content']['dataset']['misi']		= $misi->misi;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['misi']		= $this->input->post('misi');
						
			$query = $this->Misi_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data misi telah berhasil diubah.</div>');
			
			redirect('pengaturan/misi', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/misi/detail';
		$container['content']['dataset']				= '';
		
		$misi = $this->Misi_model->get('misi.*', array('misi.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $misi->kode;
		$container['content']['dataset']['misi']		= $misi->misi;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Misi_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data misi telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/misi', 'refresh');
	}
}
