<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelompok_pengguna extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_Level_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, admin_level_kode, admin_level_nama')
        ->unset_column('admin_level_kode')
		->add_column('Actions', get_buttons('$1'),'admin_level_kode')
		->search_column('admin_level_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, admin_level_kode, admin_level_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, admin_level WHERE (admin_level_status = \'A\') ORDER BY admin_level_nama ASC) admin_level');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/kelompok_pengguna/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		
		$container['content']['dataset']['grid']		= $this->Admin_Level_model->grid_all('*', 'admin_level_nama', 'ASC', '', '', array('admin_level_status'=>'A'));
		
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
		$container['content']['view']					= 'pengaturan/kelompok_pengguna/add';
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

		$this->form_validation->set_rules('admin_level_nama', 'Kelompok', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/kelompok_pengguna/add';
			$container['content']['dataset']				= '';
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['admin_level_nama']		= $this->input->post('admin_level_nama');
			$insert['admin_level_status']	= 'A';
						
			$query = $this->Admin_Level_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data kelompok_pengguna baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/kelompok_pengguna', 'refresh');
		}

	}
	
	public function edit($filter1)
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/kelompok_pengguna/edit';
		$container['content']['dataset']				= '';
		
		$admin_level = $this->Admin_Level_model->get('admin_level.*', array('admin_level.admin_level_kode'=>$filter1));
		
		$container['content']['dataset']['admin_level_kode']	= $admin_level->admin_level_kode;
		$container['content']['dataset']['admin_level_nama']	= $admin_level->admin_level_nama;
		$container['content']['dataset']['admin_level_status']	= $admin_level->admin_level_status;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update($filter1)
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('admin_level_nama', 'Kelompok', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/kelompok_pengguna/edit';
			$container['content']['dataset']				= '';
			
			$admin_level = $this->Admin_Level_model->get('admin_level.*', array('admin_level.admin_level_kode'=>$filter1));
			
			$container['content']['dataset']['admin_level_kode']	= $admin_level->admin_level_kode;
			$container['content']['dataset']['admin_level_nama']	= $admin_level->admin_level_nama;
			$container['content']['dataset']['admin_level_status']	= $admin_level->admin_level_status;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['admin_level_nama']		= $this->input->post('admin_level_nama');	
						
			$query = $this->Admin_Level_model->update($update, $this->input->post('admin_level_kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data kelompok_pengguna telah berhasil diubah.</div>');
			
			redirect('pengaturan/kelompok_pengguna', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/kelompok_pengguna/detail';
		$container['content']['dataset']				= '';
		
		$admin_level = $this->Admin_Level_model->get('admin_level.*', array('admin_level.admin_level_kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['admin_level_kode']	= $admin_level->admin_level_kode;
		$container['content']['dataset']['admin_level_nama']	= $admin_level->admin_level_nama;
		$container['content']['dataset']['admin_level_status']	= $admin_level->admin_level_status;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			//$this->Skpd_model->delete($this->uri->segment(4));
			
			$update['admin_level_status']	= 'H';			
			$this->Admin_Level_model->update($update, $this->uri->segment(4));
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data kelompok_pengguna telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/kelompok_pengguna', 'refresh');
	}
}
