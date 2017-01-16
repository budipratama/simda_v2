<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tahapan_skpd extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahapan_skpd_model');
	}
	
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		redirect('pengaturan/waktu_entri', 'refresh');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();
		$tahapan_kode = $this->input->post('tahapan_kode');
		$this->form_validation->set_rules('skpd_kode', 'SKPD Pelaksana', 'trim|required|xss_clean|callback_check_insert');
		
		if($this->form_validation->run() == FALSE)
		{
			redirect('pengaturan/waktu_entri/detail/'.$tahapan_kode.'#warningEntri', 'refresh');
		} else {
			$insert['tahapan_kode']	= $tahapan_kode;
			$insert['skpd_kode']	= $this->input->post('skpd_kode');
						
			$query = $this->Tahapan_skpd_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tahapan skpd baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/waktu_entri/detail/'.$tahapan_kode.'#successInsert', 'refresh');
		}

	}
	
	public function check_insert($skpd_kode){
		//query the database
		$tahapan_kode = $this->input->post('tahapan_kode');
		$result = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $skpd_kode, 'tahapan_kode'=>$tahapan_kode));
		
		if ($result == 0){
			return TRUE;	
		} else {
			return FALSE;
		}
	}
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Tahapan_skpd_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tahapan skpd telah berhasil dihapus.</div>');
		} 
		
		redirect('pengaturan/waktu_entri/detail/'.$this->uri->segment(5).'#successDelete', 'refresh');
	}
}
