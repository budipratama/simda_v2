<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program_kegiatan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Program_kegiatan_model');
		$this->load->model('Program_model');
		$this->load->model('Urusan_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, kode, kegiatan, program_nama')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('kegiatan, program_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, program_kegiatan.kode, program_kegiatan.kegiatan, program.program as program_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, program_kegiatan LEFT JOIN program ON program_kegiatan.program=program.kode ORDER BY program_kegiatan.kegiatan ASC) program_kegiatan');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/program_kegiatan/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
				
		$container['content']['dataset']['grid']		= $this->Program_kegiatan_model->grid_all('program_kegiatan.*, program.program as program_nama, urusan.urusan as urusan_nama', 'program_kegiatan.kegiatan', 'ASC');
		
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
		$container['content']['view']					= 'pengaturan/program_kegiatan/add';
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.kode', 'ASC');
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('urusan_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('program_kode', 'Program', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no', 'Urutan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kegiatan', 'Nama kegiatan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/program_kegiatan/add';
			$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.kode', 'ASC');
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['urusan']		= $this->input->post('urusan_kode');
			$insert['program']		= $this->input->post('program_kode');
			$insert['no']			= $this->input->post('no');
			$insert['kegiatan']		= $this->input->post('kegiatan');
						
			$query = $this->Program_kegiatan_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data program_kegiatan baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/program_kegiatan', 'refresh');
		}

	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/program_kegiatan/edit';
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.kode', 'ASC');
		$container['content']['dataset']['program']		= $this->Program_model->grid_all('program.kode, program.program', 'program.program', 'ASC');
		
		$program_kegiatan = $this->Program_kegiatan_model->get('program_kegiatan.*, program.kode as program_kode, program.urusan as urusan_kode', array('program_kegiatan.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['urusan_kode']		= $program_kegiatan->urusan;
		$container['content']['dataset']['program_kode']	= $program_kegiatan->program;
		$container['content']['dataset']['kode']			= $program_kegiatan->kode;
		$container['content']['dataset']['no']				= $program_kegiatan->no;
		$container['content']['dataset']['kegiatan']		= $program_kegiatan->kegiatan;
		
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('urusan_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('program_kode', 'Program', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no', 'Urutan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kegiatan', 'Nama kegiatan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/program_kegiatan/edit';
			$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.kode', 'ASC');
			$container['content']['dataset']['program']		= $this->Program_model->grid_all('program.kode, program.program', 'program.program', 'ASC');
			
			$program_kegiatan = $this->Program_kegiatan_model->get('program_kegiatan.*', array('program_kegiatan.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['urusan_kode']		= $program_kegiatan->urusan;
			$container['content']['dataset']['program_kode']	= $program_kegiatan->program;
			$container['content']['dataset']['kode']			= $program_kegiatan->kode;
			$container['content']['dataset']['no']				= $program_kegiatan->no;
			$container['content']['dataset']['kegiatan']		= $program_kegiatan->kegiatan;
			
			$header['admin_log']								= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['urusan']		= $this->input->post('urusan_kode');
			$update['program']		= $this->input->post('program_kode');
			$update['no']			= $this->input->post('no');
			$update['kegiatan']		= $this->input->post('kegiatan');
						
			$query = $this->Program_kegiatan_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data program_kegiatan telah berhasil diubah.</div>');
			
			redirect('pengaturan/program_kegiatan', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/program_kegiatan/detail';
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.kode', 'ASC');
		$container['content']['dataset']['program']		= $this->Program_model->grid_all('program.kode, program.program', 'program.program', 'ASC');
		
		$program_kegiatan = $this->Program_kegiatan_model->get('program_kegiatan.*, program.program as program_nama, urusan.kode as urusan_kode, urusan.urusan as urusan_nama', array('program_kegiatan.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['program_kode']	= $program_kegiatan->program;
		$container['content']['dataset']['program_nama']	= $program_kegiatan->program_nama;
		$container['content']['dataset']['urusan_kode']		= $program_kegiatan->urusan_kode;
		$container['content']['dataset']['urusan_nama']		= $program_kegiatan->urusan_nama;
		$container['content']['dataset']['kode']			= $program_kegiatan->kode;
		$container['content']['dataset']['no']				= $program_kegiatan->no;
		$container['content']['dataset']['kegiatan']		= $program_kegiatan->kegiatan;
		
		
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Program_kegiatan_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data program_kegiatan telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/program_kegiatan', 'refresh');
	}
	
	public function tampil_combobox_program(){
		$urusan_kode = $this->uri->segment(4);
		if ($urusan_kode){
			$data_program = $this->Program_model->grid_all('program.kode, program.program', 'program.program', 'ASC', '', '', array('program.urusan'=>$urusan_kode));
			echo '<label class="control-label" for="program_kode">Program<span class="required">*</span> :</label>';
					combobox('db', $data_program, 'program_kode', 'kode', 'program', '', '', 'Pilih Program', 'class="select2_category form-control" required="required"');
		} else {
			echo '<label class="control-label" for="program_kode">Program<span class="required">*</span> :</label>
					<select class="select2_category form-control" name="program_kode" id="program_kode" data-placeholder="Pilih Program" required="required">
					</select>';
		}
	}
}
