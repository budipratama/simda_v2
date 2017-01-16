<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Urusan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Urusan_model');
		$this->load->library('Datatables');
	}
	
	function datatable() {
 		$admin_log	 	 = $this->auth->is_login_admin();
		$tahun			 = $admin_log['tahun'];	
		$where_datatable = 'ms_urusan.tahun = \''.$tahun.'\'';

		$this->datatables->select('no, kode, nm_urusan, urusan')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('urusan, nm_urusan')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, urusan.kode, ms_urusan.no, ms_urusan.nm_urusan, urusan.urusan FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, urusan LEFT JOIN ms_urusan ON urusan.kd_urusan=ms_urusan.kode WHERE ('.$where_datatable.') ORDER BY urusan.kode DESC) urusan');
		
        echo $this->datatables->generate();
    }
	
	public function index()	{	
		$admin_log 	= $this->auth->is_login_admin();
		$tahun		= $admin_log['tahun'];
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/urusan/view';

		$container['content']['dataset']['fungsi']		= $this->Urusan_model->grid_fs('kode, nm_fungsi', 'nm_fungsi', '', '', '', '');
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_us('ms_urusan.kode, ms_urusan.nm_urusan', 'ms_urusan.nm_urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun));
		$container['content']['dataset']['tahun_']		= $admin_log['tahun'];
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert() {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('nomor', 'Nomor', 'trim|required|xss_clean');
		$this->form_validation->set_rules('urusan', 'Urusan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/urusan/add';
			$container['content']['dataset']				= '';
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {			
			$insert['nomor']		= $this->input->post('nomor');
			$insert['urusan']		= $this->input->post('urusan');
			$insert['kd_urusan']	= $this->input->post('bbb_kode');
			$insert['kd_fungsi']	= $this->input->post('fungsi');
			$tahun 					= $this->input->post('tahun');
			
			$query 					= $this->Urusan_model->insert($insert);			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data urusan baru telah berhasil ditambahkan.</div>');
			redirect('pengaturan/urusan', 'refresh');
		}
	}
	
	public function edit() {
		$admin_log  = $this->auth->is_login_admin();
		$tahun		= $admin_log['tahun'];
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/urusan/edit';
		$container['content']['dataset']				= '';
		
		$container['content']['dataset']['fungsi']		= $this->Urusan_model->grid_fs('kode, nm_fungsi', 'nm_fungsi', '', '', '', '');
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_us('ms_urusan.kode, ms_urusan.nm_urusan', 'ms_urusan.nm_urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun));
		
		$urusan = $this->Urusan_model->get('urusan.*', array('urusan.kode'=>$this->uri->segment(4)));		
		$container['content']['dataset']['kode']		= $urusan->kode;
		$container['content']['dataset']['nomor']		= $urusan->nomor;
		$container['content']['dataset']['nm_urusan']	= $urusan->urusan;
		$container['content']['dataset']['kd_urusan']	= $urusan->kd_urusan;
		$container['content']['dataset']['kd_fungsi']	= $urusan->kd_fungsi;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update() {
		$admin_log = $this->auth->is_login_admin();
		$this->form_validation->set_rules('nomor', 'Nomor', 'trim|required|xss_clean');
		$this->form_validation->set_rules('urusan', 'Urusan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/urusan/edit';
			$container['content']['dataset']				= '';
			
			$urusan = $this->Urusan_model->get('urusan.*', array('urusan.kode'=>$this->uri->segment(4)));		
			$container['content']['dataset']['kode']		= $urusan->kode;
			$container['content']['dataset']['nomor']		= $urusan->nomor;
			$container['content']['dataset']['nm_urusan']	= $urusan->urusan;
			$container['content']['dataset']['kd_urusan']	= $urusan->kd_urusan;
			$container['content']['dataset']['kd_fungsi']	= $urusan->kd_fungsi;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$update['kd_urusan']	= $this->input->post('bbb_kode');
			$update['kd_fungsi']	= $this->input->post('fungsi');
			$update['nomor']		= $this->input->post('nomor');
			$update['urusan']		= $this->input->post('urusan');
			
			$query = $this->Urusan_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data urusan telah berhasil diubah.</div>');
			redirect('pengaturan/urusan', 'refresh');
		}
	}
	
	public function detail() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/urusan/detail';
		$container['content']['dataset']				= '';
		
		$urusan = $this->Urusan_model->get('urusan.*', array('urusan.kode'=>$this->uri->segment(4)));		
		$container['content']['dataset']['kode']		= $urusan->kode;
		$container['content']['dataset']['nomor']		= $urusan->nomor;
		$container['content']['dataset']['nm_urusan']	= $urusan->urusan;
		$container['content']['dataset']['kd_urusan']	= $urusan->kd_urusan;
		$container['content']['dataset']['kd_fungsi']	= $urusan->kd_fungsi;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function delete() {
		if ($this->uri->segment(4)){
			$this->Urusan_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data urusan telah berhasil dihapus.</div>');
		}
		redirect('pengaturan/urusan', 'refresh');
	}

}