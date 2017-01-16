<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tujuan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Misi_model');
		$this->load->model('Tujuan_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, kode, tujuan, misi_nama')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('tujuan, misi_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, tujuan.kode, tujuan.tujuan, misi.misi as misi_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, tujuan LEFT JOIN misi ON tujuan.misi=misi.kode ORDER BY tujuan.tujuan ASC) tujuan');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/tujuan/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
				
		$container['content']['dataset']['grid']		= $this->Tujuan_model->grid_all('tujuan.*, misi.misi as misi_nama', 'tujuan', 'ASC');
		
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
		$container['content']['view']					= 'pengaturan/tujuan/add';
		$container['content']['dataset']['misi']		= $this->Misi_model->grid_all('misi.kode, misi.misi', 'misi.misi', 'ASC');
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('misi_kode', 'Misi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/tujuan/add';
			$container['content']['dataset']['misi']		= $this->Misi_model->grid_all('misi.kode, misi.misi', 'misi.misi', 'ASC');
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['misi']			= $this->input->post('misi_kode');
			$insert['tujuan']		= $this->input->post('tujuan');
						
			$query = $this->Tujuan_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tujuan baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/tujuan', 'refresh');
		}

	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/tujuan/edit';
		$container['content']['dataset']['misi']		= $this->Misi_model->grid_all('misi.kode, misi.misi', 'misi.misi', 'ASC');
		
		$tujuan = $this->Tujuan_model->get('tujuan.*', array('tujuan.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $tujuan->kode;
		$container['content']['dataset']['tujuan']		= $tujuan->tujuan;
		$container['content']['dataset']['misi_kode']	= $tujuan->misi;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('misi_kode', 'Misi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/tujuan/edit';
			$container['content']['dataset']['misi']		= $this->Misi_model->grid_all('misi.kode, misi.misi', 'misi.misi', 'ASC');
			
			$tujuan = $this->Tujuan_model->get('tujuan.*', array('tujuan.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['kode']		= $tujuan->kode;
			$container['content']['dataset']['tujuan']		= $tujuan->tujuan;
			$container['content']['dataset']['misi_kode']	= $tujuan->misi;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['misi']			= $this->input->post('misi_kode');
			$update['tujuan']		= $this->input->post('tujuan');
						
			$query = $this->Tujuan_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tujuan telah berhasil diubah.</div>');
			
			redirect('pengaturan/tujuan', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/tujuan/detail';
		$container['content']['dataset']				= '';
		
		$tujuan = $this->Tujuan_model->get('tujuan.*, misi.misi as misi_nama', array('tujuan.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $tujuan->kode;
		$container['content']['dataset']['tujuan']		= $tujuan->tujuan;
		$container['content']['dataset']['misi_kode']	= $tujuan->misi;
		$container['content']['dataset']['misi_nama']	= $tujuan->misi_nama;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Tujuan_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tujuan telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/tujuan', 'refresh');
	}
}
