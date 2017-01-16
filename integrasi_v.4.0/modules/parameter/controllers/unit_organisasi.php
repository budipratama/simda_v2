<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_organisasi extends CI_Controller {
	
	public function __construct() {
		parent::__construct();		
		$this->load->model('Tahun_model');
		$this->load->model('Tipe_model');
		$this->load->model('Urusan_model');
		$this->load->model('Skpd_model');
		$this->load->model('Sub_model');
		$this->load->library('Datatables');
	}
	
	function datatable() {
        $admin_log 		 = $this->auth->is_login_admin();
		$tahun 			 = $admin_log['tahun'];
		$where_datatable = 'ms_urusan.tahun = \''.$tahun.'\'';

		$this->datatables->select('nomor, no, kode, nm_urusan')
		->add_column('Actions', $this->get_buttons($tipe, '$1'),'kode')
		->search_column('nm_urusan')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, ms_urusan.kode, ms_urusan.no, ms_urusan.nm_urusan FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, ms_urusan WHERE ('.$where_datatable.') ORDER BY ms_urusan.kode DESC) ms_urusan');
		
        echo $this->datatables->generate();
    }
	
	function get_buttons($tipe, $id) {
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/unit-organisasi/bidang/'.$id) .'" class="btn bg-brown btn-circle waves-effect waves-circle waves-float" title="Bidang"><i class="material-icons">arrow_forward</i></a>';
		$html .= '</div>';
		return $html;
	}

	public function index() {
		$admin_log 	= $this->auth->is_login_admin();
		$tahun		= $admin_log['tahun'];
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/unit_organisasi/view';
		
		$container['content']['dataset']['tahun_']		= $admin_log['tahun'];
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function bidang($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/bidang';
			
			$container['tipe']								= $this->Tipe_model->get_list($id);			
			$container['bidang']							= $this->Urusan_model->get_list_tasks($id);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function unit($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/unit';					

			$container['urusan']							= $this->Urusan_model->get_list($id);
			$container['unit']								= $this->Skpd_model->get_list_tasks($id);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	public function sub($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/sub';					

			$container['unit']								= $this->Skpd_model->get_list($id);
			$container['sub']								= $this->Sub_model->get_list_tasks($id,true);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	public function add($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Kd_urusan','trim|required|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Urusan','trim|xss_clean');
		$this->form_validation->set_rules('ccc_kode','Kd_skpd','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','No','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Nomor','trim|xss_clean');
        $this->form_validation->set_rules('sss_kode','Nm_sub','trim|xss_clean');
        
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/add';
			
		if($this->form_validation->run() == FALSE){		
			$sub = $this->Sub_model->get('kode, no', array('ms_sub.kd_skpd'=>$this->uri->segment(4)));		
			$container['content']['dataset']['id_sub']		= $sub->kode;
			$container['content']['dataset']['no_sub']		= $sub->no;
			$container['unit'] 								= $this->Skpd_model->get_list($id);	

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');			
		} else {
			$container = array(             
				'kd_urusan'   	=> $this->input->post('aaa_kode'),
				'urusan'   		=> $this->input->post('bbb_kode'),
				'kd_skpd'   	=> $this->input->post('ccc_kode'),
				'no'    	 	=> $this->input->post('ddd_kode'),
				'nomor'    	 	=> $this->input->post('eee_kode'),
				'nm_sub'  		=> $this->input->post('sss_kode'),
				'tipe_sort'  	=> 1,
				'status'  		=> 2 );
			$id_kode = $this->input->post('ccc_kode');
			if($this->Sub_model->inserts($container)){
			   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB UNIT" telah berhasil ditambahkan</div>');
			   redirect('parameter/unit-organisasi/sub/'.$id_kode);
			}
		}
    }
	
	public function edits($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
		$kode 		= $this->uri->segment(4);
		$sub 		= $this->Sub_model->getOnly('kd_skpd, status', array('kode'=>$kode));

		if ($sub->status == 2) {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/edits';			
			$container['sub']								= $this->Sub_model->get_task_data($id);
		} else {
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
			redirect('parameter/unit-organisasi/sub/'.$sub->kd_skpd.'/#warningEdit', 'refresh');
		}			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function ubahs($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/edits';
			
			$this->form_validation->set_rules('sss_kode','Nm_sub','trim|xss_clean');       
			if($this->form_validation->run() == FALSE){	
			
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$update['nm_sub']	= $this->input->post('sss_kode');
				$id_kode = $this->input->post('ccc_kode');
				$query = $this->Sub_model->updates($update, $this->input->post('kode'));
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB UNIT" telah berhasil diubah</div>');		
				redirect('parameter/unit_organisasi/sub/'.$id_kode);
			}
		}
    }
	
	public function deletes() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$sub 		= $this->Sub_model->getOnly('kode, kd_skpd, status', array('kode'=>$kode));
			if ($sub->status == 1) {				
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
				redirect('parameter/unit-organisasi/sub/'.$sub->kd_skpd.'/#warningDelete', 'refresh');				
			} else if ($sub->status == 2) {
				$this->Sub_model->delete1($this->uri->segment(4));
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB UNIT" telah berhasil dihapus</div>');
				redirect('parameter/unit-organisasi/sub/'.$sub->kd_skpd.'/#successDelete', 'refresh');
			}
		}
	}	
	
}