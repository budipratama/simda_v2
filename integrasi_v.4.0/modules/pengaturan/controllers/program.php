<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Program_model');
		$this->load->model('Urusan_model');
		$this->load->library('Datatables');
	}
	
	function datatable() {
		$admin_log 		 = $this->auth->is_login_admin();
		$tahun			 = $admin_log['tahun'];
		$where_datatable = 'ms_urusan.tahun = \''.$tahun.'\'';

		$this->datatables->select('nomor, no, no_program, kode, urusan, program, hasil_program')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('program, hasil_program')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, program.nomor as no_program, program.kode, urusan.urusan, program.program, program.hasil_program, ms_urusan.no FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, program LEFT JOIN urusan ON program.urusan=urusan.kode LEFT JOIN ms_urusan ON urusan.kd_urusan=ms_urusan.kode WHERE ('.$where_datatable.') ORDER BY program.kode DESC) program');
		
        echo $this->datatables->generate();
    }
	
	public function index() {	
		$admin_log  = $this->auth->is_login_admin();
		$tahun		= $admin_log['tahun'];
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/program/view';
		$container['content']['dataset']				= '';

		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun), 'urusan.kode');
		$container['content']['dataset']['tahun_']		= $admin_log['tahun'];
		
		$header['admin_log']							= $admin_log;		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert() {
		$admin_log = $this->auth->is_login_admin();
		$this->form_validation->set_rules('urusan_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nomor', 'Nomor', 'trim|required|xss_clean');
		$this->form_validation->set_rules('program', 'Program', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hasil_program', 'Hasil program', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/program/add';
			$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun), 'urusan.kode');
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['urusan']			= $this->input->post('urusan_kode');
			$insert['program']			= $this->input->post('program');
			$insert['nomor']			= $this->input->post('nomor');
			$insert['hasil_program']	= $this->input->post('hasil_program');

			$query = $this->Program_model->insert($insert);
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data program baru telah berhasil ditambahkan.</div>');
			redirect('pengaturan/program', 'refresh');
		}

	}
	
	public function edit() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/program/edit';
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun), 'urusan.kode');
		
		$program = $this->Program_model->get('program.*', array('program.kode'=>$this->uri->segment(4)));		
		$container['content']['dataset']['urusan_kode']		= $program->urusan;
		$container['content']['dataset']['kode']			= $program->kode;
		$container['content']['dataset']['nomor']			= $program->nomor;
		$container['content']['dataset']['program']			= $program->program;
		$container['content']['dataset']['hasil_program']	= $program->hasil_program;
		
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update() {
		$admin_log = $this->auth->is_login_admin();
		$this->form_validation->set_rules('urusan_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nomor', 'Nomor', 'trim|required|xss_clean');
		$this->form_validation->set_rules('program', 'Program', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hasil_program', 'Hasil program', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/program/edit';
			$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun), 'urusan.kode');
			
			$program = $this->Program_model->get('program.*', array('program.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['urusan_kode']		= $program->urusan;
			$container['content']['dataset']['kode']			= $program->kode;
			$container['content']['dataset']['nomor']			= $program->nomor;
			$container['content']['dataset']['program']			= $program->program;
			$container['content']['dataset']['hasil_program']	= $program->hasil_program;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['urusan']			= $this->input->post('urusan_kode');
			$update['program']			= $this->input->post('program');
			$update['nomor']			= $this->input->post('nomor');
			$update['hasil_program']	= $this->input->post('hasil_program');

			$query = $this->Program_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data program telah berhasil diubah.</div>');	
			redirect('pengaturan/program', 'refresh');
		}
	}
	
	public function detail() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/program/detail';
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.kode', 'ASC');
		
		$program = $this->Program_model->get('program.*, urusan.kode as urusan_kode, urusan.urusan as urusan_nama', array('program.kode'=>$this->uri->segment(4)));
		$container['content']['dataset']['urusan_kode']		= $program->urusan_kode;
		$container['content']['dataset']['urusan_nama']		= $program->urusan_nama;
		$container['content']['dataset']['kode']			= $program->kode;
		$container['content']['dataset']['nomor']			= $program->nomor;
		$container['content']['dataset']['program']			= $program->program;
		$container['content']['dataset']['hasil_program']	= $program->hasil_program;
		
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function delete() {
		if ($this->uri->segment(4)){
			$this->Program_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data program telah berhasil dihapus.</div>');
		} 
		redirect('pengaturan/program', 'refresh');
	}
	
}