<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tahun_anggaran extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, tahun, status, status_label, murni, perubahan, murni_label, perubahan_label')
		// ->add_column('status', $this->get_status('$1'),'status')
		->add_column('Actions', get_buttons('$1'),'tahun')
		->search_column('tahun, status')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, tahun.tahun, tahun.status, tahun.murni, tahun.perubahan, (case when (tahun.status = \'1\') THEN \'<span class="label label-sm label-success">Enabled</span>\' ELSE \'<span class="label label-sm label-default">Disabled</span>\' END) AS status_label, (case when (tahun.murni = \'1\') THEN \'<span class="label label-sm label-success">Enabled</span>\' ELSE \'<span class="label label-sm label-default">Disabled</span>\' END) AS murni_label, (case when (tahun.perubahan = \'1\') THEN \'<span class="label label-sm label-success">Enabled</span>\' ELSE \'<span class="label label-sm label-default">Disabled</span>\' END) AS perubahan_label FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, tahun ORDER BY tahun.tahun DESC) tahun');
        
        echo $this->datatables->generate();
    }
	
	private function get_status($status){
		return $view_status = ($status == 1)?'<span class="label label-sm label-success">Enabled</span>':'<span class="label label-sm label-default">Disabled</span>';
	}
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/tahun_anggaran/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;

		$container['content']['dataset']['grid']		= $this->Tahun_model->grid_all('*', 'tahun', 'DESC');
		
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
		$container['content']['view']					= 'pengaturan/tahun_anggaran/add';
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

		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|xss_clean|callback_check_insert');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/tahun_anggaran/add';
			$container['content']['dataset']				= '';
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$insert['tahun']		= $this->input->post('tahun');
			$insert['status']		= ($this->input->post('status'))?'1':'0';
			$insert['murni']		= ($this->input->post('murni'))?'1':'0';
			$insert['perubahan']	= ($this->input->post('perubahan'))?'1':'0';
						
			$query = $this->Tahun_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tahun anggaran baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/tahun_anggaran', 'refresh');
		}

	}
	
	public function check_insert($tahun){
		//query the database
		$result = $this->Tahun_model->count_all(array('tahun' => $tahun));
		
		if ($result == 0){
			return TRUE;	
		} else {
			$this->form_validation->set_message('check_insert', '<div class="alert alert-danger  fade in">
			<button class="close" data-close="alert" aria-hidden="true"></button>
			<strong>Error!</strong> <span>Tahun yang Anda masukan sudah terdaftar.</span>
			</div>');
			return FALSE;
		}
	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/tahun_anggaran/edit';
		$container['content']['dataset']				= '';
		
		$tahun_anggaran = $this->Tahun_model->get('tahun.*', array('tahun.tahun'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['tahun']		= $tahun_anggaran->tahun;
		$container['content']['dataset']['status']		= ($tahun_anggaran->status)?'checked':'';
		$container['content']['dataset']['murni']		= ($tahun_anggaran->murni)?'checked':'';
		$container['content']['dataset']['perubahan']	= ($tahun_anggaran->perubahan)?'checked':'';
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|xss_clean|callback_check_update');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/tahun_anggaran/edit';
			$container['content']['dataset']				= '';
			
			$tahun_anggaran = $this->Tahun_model->get('tahun.*', array('tahun.tahun'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['tahun']		= $tahun_anggaran->tahun;
			$container['content']['dataset']['status']		= ($tahun_anggaran->status)?'checked':'';
			$container['content']['dataset']['murni']		= ($tahun_anggaran->murni)?'checked':'';
			$container['content']['dataset']['perubahan']	= ($tahun_anggaran->perubahan)?'checked':'';
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['tahun']		= $this->input->post('tahun');
			$update['status']		= ($this->input->post('status'))?'1':'0';
			$update['murni']		= ($this->input->post('murni'))?'1':'0';
			$update['perubahan']	= ($this->input->post('perubahan'))?'1':'0';
						
			$query = $this->Tahun_model->update($update, $this->input->post('tahun_hidden'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tahun anggaran telah berhasil diubah.</div>');
			
			redirect('pengaturan/tahun_anggaran', 'refresh');
		}
	}
	
	public function check_update($tahun){
		//query the database
		$result = $this->Tahun_model->count_all(array('tahun' => $tahun));
		
		if ($result == 0){
			return TRUE;	
		} else if($result == 1 && $tahun == $this->input->post('tahun_hidden')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_update', '<div class="alert alert-danger  fade in">
			<button class="close" data-close="alert" aria-hidden="true"></button>
			<strong>Error!</strong> <span>Tahun yang Anda masukan sudah terdaftar.</span>
			</div>');
			return FALSE;
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/tahun_anggaran/detail';
		$container['content']['dataset']				= '';
		
		$tahun_anggaran = $this->Tahun_model->get('tahun.*', array('tahun.tahun'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['tahun']		= $tahun_anggaran->tahun;
		$container['content']['dataset']['status']		= $tahun_anggaran->status;
		$container['content']['dataset']['murni']		= $tahun_anggaran->murni;
		$container['content']['dataset']['perubahan']	= $tahun_anggaran->perubahan;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Tahun_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tahun anggaran telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/tahun_anggaran', 'refresh');
	}
}
