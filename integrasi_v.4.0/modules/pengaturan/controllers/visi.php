<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Visi_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, kode, visi')
		->add_column('Actions', $this->get_buttons('$1'),'kode')
		->search_column('visi')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, visi.kode, visi.visi FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, visi ORDER BY visi.visi ASC) visi');
        
        echo $this->datatables->generate();
    }
	
	private function get_buttons($id)
	{
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/detail/'.$id) .'" class="btn default btn-sm purple" title="Detail"><i class="fa fa-file-text"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/edit/'.$id) .'" class="btn default btn-sm yellow" title="Ubah"><i class="fa fa-pencil"></i></a>';
		
		return $html;
	}
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/visi/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
				
		$container['content']['dataset']['grid']		= $this->Visi_model->grid_all('*', 'visi', 'ASC');
		
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
		$container['content']['view']					= 'pengaturan/visi/add';
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

		$this->form_validation->set_rules('visi', 'Visi', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/visi/add';
			$container['content']['dataset']				= '';
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['visi']		= $this->input->post('visi');
						
			$query = $this->Visi_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data visi baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/visi', 'refresh');
		}

	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/visi/edit';
		$container['content']['dataset']				= '';
		
		$visi = $this->Visi_model->get('visi.*', array('visi.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $visi->kode;
		$container['content']['dataset']['visi']		= $visi->visi;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('visi', 'Visi', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/visi/edit';
			$container['content']['dataset']				= '';
			
			$visi = $this->Visi_model->get('visi.*', array('visi.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['kode']		= $visi->kode;
			$container['content']['dataset']['visi']		= $visi->visi;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['visi']		= $this->input->post('visi');
						
			$query = $this->Visi_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data visi telah berhasil diubah.</div>');
			
			redirect('pengaturan/visi', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/visi/detail';
		$container['content']['dataset']				= '';
		
		$visi = $this->Visi_model->get('visi.*', array('visi.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $visi->kode;
		$container['content']['dataset']['visi']		= $visi->visi;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Visi_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data visi telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/visi', 'refresh');
	}
}
