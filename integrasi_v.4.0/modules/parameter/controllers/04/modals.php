<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modals extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('person_model','person');
		$this->load->model('Akun_model');
	}
	
	public function index()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/modals/view';
			
			$container['akun'] 								= $this->Akun_model->get_list();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	
	
	public function edit() {	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/rka/preview_22';
		
		$container['content']['dataset']['skpd_kode']		= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'semua';
		$container['content']['dataset']['kode_tahapan']	= $this->input->post('kode_tahapan');
		$container['content']['dataset']['belanja_kode']	= $this->input->post('belanja_kode');
		$container['content']['dataset']['tahun_kode']		= $this->input->post('tahun_kode');
		$container['content']['dataset']['program_kode']	= ($this->input->post('program_kode'))?$this->input->post('program_kode'):'semua';
		$container['content']['dataset']['kegiatan_kode']	= ($this->input->post('kegiatan_kode'))?$this->input->post('kegiatan_kode'):'semua';
		$container['content']['dataset']['tanggal']			= $this->input->post('tanggal');
		$container['content']['dataset']['nama_pimpinan']	= $this->input->post('nama_pimpinan');
		$container['content']['dataset']['pangkat']			= $this->input->post('pangkat');
		$container['content']['dataset']['nip']				= $this->input->post('nip');
		$header['admin_log']								= $admin_log;

		$sess_laporan = array(
			'laporan_skpd' 		=> $container['content']['dataset']['skpd_kode'],
			'laporan_program'	=> $container['content']['dataset']['program_kode'],
			'laporan_kegiatan' 	=> $container['content']['dataset']['kegiatan_kode'],
			'laporan_tahapan'  	=> $this->input->post('kode_tahapan'),
			'laporan_belanja'  	=> $this->input->post('belanja_kode'),
			'laporan_tahun' 	=> $this->input->post('tahun_kode'),			
			'laporan_tanggal'  	=> $this->input->post('tanggal'),
			'laporan_pimpinan'  => $this->input->post('nama_pimpinan'),
			'laporan_pangkat'  	=> $this->input->post('pangkat'),
			'laporan_nip'  		=> $this->input->post('nip')
			);
		
		if ($this->input->post('tahun_kode')) { 
			$this->session->unset_userdata('is_sess_laporan');
			$this->session->set_userdata('is_sess_laporan', $sess_laporan);
			redirect('laporan/rka/preview_22', 'refresh');
		}
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

   public function update() {            
     $dd = substr($this->input->post('dtFrom'),0,2);  
     $mm = substr($this->input->post('dtFrom'),3,2);  
     $yy = substr($this->input->post('dtFrom'),6,4);  
     $date_from = $yy."-".$mm."-".$dd;  
     $dd2 = substr($this->input->post('dtTo'),0,2);  
     $mm2 = substr($this->input->post('dtTo'),3,2);  
     $yy2 = substr($this->input->post('dtTo'),6,4);  
     $date_to = $yy2."-".$mm2."-".$dd2;  
     $dtFrom = date('Y-m-d', strtotime($date_from));  
     $dtTo = date('Y-m-d', strtotime($date_to));        
     $data['post']['position'] = $this->input->post('Eposition');    
     $data['post']['designation'] = $this->input->post('Edesignation');     
     $data['post']['workplace'] = $this->input->post('Eworkplace');    
     $data['post']['date_from'] = $dtFrom;            
     $data['post']['date_to'] = $dtTo;        
     $data['post']['sector'] = $this->input->post('Esector');      
     $data['post']['grade'] = $this->input->post('Egrade');  
     // form validation  
     $this->form_validation->set_rules('Eposition', '<b>Position Held</b>', 'required');    
     $this->form_validation->set_rules('Edesignation', '<b>Designation</b>', 'required');      
     $this->form_validation->set_rules('Eworkplace', '<b>Place of Work</b>', 'required');      
     $this->form_validation->set_rules('dtFrom', '<b>Duration Form</b>', 'required');      
     $this->form_validation->set_rules('dtTo', '<b>Duration To</b>', 'required');      
     $this->form_validation->set_rules('Esector', '<b>Sector</b>', 'required');  
     $this->form_validation->set_rules('Egrade', '<b>Sector</b>', 'integer');          
     $result = array();  
     if ($this->input->is_ajax_request()) {  
       if ($this->form_validation->run() == FALSE) {  
         $result['error'] = true;  
         $result['message'] = validation_errors();                  
       } else {                  
         $result['error'] = false;  
         $this->applicant_model->update_data('tr_applicantpc_experience', array('id_applicantpc_experience'=>$this->input->post('id')), $data['post']);               
       }   
       $json = json_encode($result);  
       die($json);  
     } else {  
       redirect('applicant_work', 'refresh');  
     }      
   }  


}
