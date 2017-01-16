<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tim_anggaran extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Tim_anggaran_model');
		$this->load->library('Datatables');
	}
	
	public function index() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/tim_anggaran/view';
			
			$container['tim']	= $this->Tim_anggaran_model->get_tim();
			
			$header['admin_log']						= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function add() {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Kode_tim','trim|required|xss_clean');
        $this->form_validation->set_rules('bbb_kode','No','trim|xss_clean');
		$this->form_validation->set_rules('ccc_kode','Nama','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','Nip','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Jabatan','trim|xss_clean');
        
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/tim_anggaran/add';			
		{
			if($this->form_validation->run() == FALSE){
				
				$container['nomor']	= $this->Tim_anggaran_model->completed();
				
				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'kode_tim'	=> $this->input->post('aaa_kode'),
					'no'   		=> $this->input->post('bbb_kode'),
					'nama'		=> $this->input->post('ccc_kode'),
					'nip'		=> $this->input->post('ddd_kode'),
					'jabatan'	=> $this->input->post('eee_kode')
				);
           
				if($this->Tim_anggaran_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "Tim Anggaran" telah berhasil ditambahkan</div>');
				   redirect('parameter/tim-anggaran', 'refresh');
				}
			}
		}
    }
	
	public function edit() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/tim_anggaran/edit';
			
			$this->form_validation->set_rules('aaa_kode','Kode_tim','trim|xss_clean');
			$this->form_validation->set_rules('bbb_kode','No','trim|xss_clean');
			$this->form_validation->set_rules('ccc_kode','Nama','trim|xss_clean');
			$this->form_validation->set_rules('ddd_kode','Nip','trim|xss_clean');
			$this->form_validation->set_rules('eee_kode','Jabatan','trim|xss_clean');
			if($this->form_validation->run() == FALSE){	
			
			$tim_anggaran = $this->Tim_anggaran_model->get('tim_anggaran.*', array('tim_anggaran.kode'=>$this->uri->segment(4)));		
			$container['content']['dataset']['kode']		= $tim_anggaran->kode;
			$container['content']['dataset']['aaa_kode']	= $tim_anggaran->kode_tim;
			$container['content']['dataset']['bbb_kode']	= $tim_anggaran->no;
			$container['content']['dataset']['ccc_kode']	= $tim_anggaran->nama;
			$container['content']['dataset']['ddd_kode']	= $tim_anggaran->nip;
			$container['content']['dataset']['eee_kode']	= $tim_anggaran->jabatan;
				
				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				
			$update['kode_tim']	= $this->input->post('aaa_kode');			
			$update['no']		= $this->input->post('bbb_kode');			
			$update['nama']		= $this->input->post('ccc_kode');			
			$update['nip']		= $this->input->post('ddd_kode');
			$update['jabatan']	= $this->input->post('eee_kode');
			
			$query = $this->Tim_anggaran_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "TIM ANGGARAN" telah berhasil diubah</div>');
			redirect('parameter/tim_anggaran', 'refresh');
			}
		}
    }
	
	public function delete() {
		if ($this->uri->segment(4)){
			$this->Tim_anggaran_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "TIM ANGGARAN" telah berhasil dihapus</div>');
		} 
		redirect('parameter/tim_anggaran', 'refresh');
	}
	
}