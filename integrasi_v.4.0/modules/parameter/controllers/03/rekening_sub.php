<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekening_sub extends CI_Controller {
	
	public function __construct() {
		parent::__construct();	
		$this->load->model('Obyek_model');	
		$this->load->model('Rincian_model');
		$this->load->model('Sub_model');
		$this->load->library('Datatables');
	}
	
	public function index()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/view';
			
			$container['obyek']	= $this->Obyek_model->get_obyek();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function rincian($id){
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/rincian';
			
			$container['obyek']			= $this->Obyek_model->get_list($id);
			$container['list']			= $this->Rincian_model->get_list($id);
			$container['completed']		= $this->Rincian_model->get_list_tasks($id,true);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
    }
	
	public function sub($id){
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/sub';
			
			$container['rincian']		= $this->Rincian_model->get_list($id);
			$container['uncompleted']	= $this->Sub_model->get_rekening($id,true);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
    }
	
	public function add($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Akun','trim|required|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kelompok','trim|xss_clean');
		$this->form_validation->set_rules('ccc_kode','Jenis','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','Obyek','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Rincian','trim|xss_clean');
        $this->form_validation->set_rules('ggg_kode','No','trim|xss_clean');
        $this->form_validation->set_rules('fff_kode','Nomor','trim|xss_clean');
        $this->form_validation->set_rules('sss_kode','Sub_nama','trim|xss_clean');
        
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/add';			
		{
			if($this->form_validation->run() == FALSE){
				
				$container['rincian']	= $this->Rincian_model->get_task($id);
				$container['sub']		= $this->Sub_model->uncompleted($id,true);
				$container['kode']		= $this->Sub_model->get_task_data($id);

				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'akun'   	 	=> $this->input->post('aaa_kode'),
					'kelompok'   	=> $this->input->post('bbb_kode'),
					'jenis'   		=> $this->input->post('ccc_kode'),
					'obyek'   		=> $this->input->post('ddd_kode'),
					'rincian'  	 	=> $this->input->post('eee_kode'),
					'no'    	 	=> $this->input->post('ggg_kode'),
					'nomor'    	 	=> $this->input->post('fff_kode'),
					'sub_nama'     	=> $this->input->post('sss_kode'),
					'tipe_sort'  	=> 2
				);
           
				if($this->Sub_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB RINCIAN" telah berhasil ditambahkan</div>');
				   redirect('parameter/rekening-sub', 'refresh');
				}
			}
		}
    }
	
	public function edit($id) {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/edit';
			
			$this->form_validation->set_rules('sss_kode','Sub_nama','trim|xss_clean');       
			if($this->form_validation->run() == FALSE){	
			
				$container['this_task']	= $this->Sub_model->get_task_data($id);
				
				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				
			$update['sub_nama']	= $this->input->post('sss_kode');
			$query = $this->Sub_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB RINCIAN" telah berhasil diubah</div>');
			redirect('parameter/rekening-sub', 'refresh');
			}
		}
    }
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Sub_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB RINCIAN" telah berhasil dihapus</div>');
		} 
		redirect('parameter/rekening-sub', 'refresh');
	}
	
}