<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekening_sub extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Akun_model');	
		$this->load->model('Kelompok_model');	
		$this->load->model('Jenis_model');	
		$this->load->model('Obyek_model');	
		$this->load->model('Rincian_model');
		$this->load->model('Sub_model');
		$this->load->library('Datatables');
	}
	
	public function index() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/view';
			
			$container['obyek'] 							= $this->Obyek_model->get_list_obyek();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	public function rincian($id) {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/rincian';
			
			$container['rincian'] 							= $this->Rincian_model->get_list_rincian($id);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	public function sub($id) {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/sub';
			
			$container['rincian'] 							= $this->Rincian_model->get_rincian($id);
			$container['sub'] 								= $this->Sub_model->get_list_sub($id);
			$container['sub_']								= $this->Sub_model->get_task($id);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	public function ajax_sub($id) {
		$data = $this->Sub_model->get_by_id($id);
			echo json_encode($data);
	}
	
	public function add($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Kd_rek_1','trim|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kd_rek_2','trim|xss_clean');
        $this->form_validation->set_rules('ccc_kode','Kd_rek_3','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','Kd_rek_4','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Kd_rek_5','trim|xss_clean');
        $this->form_validation->set_rules('fff_kode','Kd_sub_modal','trim|xss_clean');
        $this->form_validation->set_rules('sss_kode','Nm_sub_modal','trim|xss_clean');
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sub/add';			
		{
			if($this->form_validation->run() == FALSE){
				
			$container['rincian'] 							= $this->Rincian_model->get_rincian($id);
			$container['sub'] 								= $this->Sub_model->get_list_sub($id);
			$container['sub_']								= $this->Sub_model->get_task($id);

				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'kd_rek_1'		=> $this->input->post('aaa_kode'),
					'kd_rek_2'   	=> $this->input->post('bbb_kode'),
					'kd_rek_3'    	=> $this->input->post('ccc_kode'),
					'kd_rek_4'    	=> $this->input->post('ddd_kode'),
					'kd_rek_5'    	=> $this->input->post('eee_kode'),
					'kd_sub_modal'  => $this->input->post('fff_kode'),
					'nm_sub_modal'  => $this->input->post('sss_kode'),
					'status' 		=> 2
				);
				$id_kode = $this->input->post('eee_kode');				
				if($this->Sub_model->insert($container)){
					$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING SUB RINCIAN BELANJA LANGSUNG" telah berhasil ditambahkan</div>');
				    redirect('parameter/rekening-sub/sub/'.$id_kode);
				}
			}
		}
    }
	
	public function edit($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$this->form_validation->set_rules('sss_kode','Nm_sub_modal','trim|xss_clean');
			$status					= $this->input->post('status');			
			$rincian				= $this->input->post('rincian');
			if ($status == 2) {
			if($this->form_validation->run() == FALSE){	

			} else {
			$update['nm_sub_modal']	= $this->input->post('sss_kode');
				$query = $this->Sub_model->update($update, $this->input->post('kode'));
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING SUB RINCIAN BELANJA LANGSUNG" telah berhasil diubah</div>');
				redirect('parameter/rekening-sub/sub/'.$rincian, 'refresh'); }
			
			} else if ($status == 1) {
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
				redirect('parameter/rekening-sub/sub/'.$rincian, 'refresh');
			}
		}
    }
	
	public function delete() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$sub		= $this->Sub_model->getOnlys('kd_rek_5, status', array('kode'=>$kode));
		if ($sub->status == 2) {
			$this->Sub_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING SUB RINCIAN BELANJA LANGSUNG" telah berhasil dihapus</div>');
		} else {
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
			redirect('parameter/rekening-sub/sub/'.$sub->kd_rek_5, 'refresh');
			}
			redirect('parameter/rekening-sub/sub/'.$sub->kd_rek_5, 'refresh');
		}
	}

	
}