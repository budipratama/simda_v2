<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekening_sap extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Akun_model');
		$this->load->model('Kelompok_model');
		$this->load->model('Jenis_model');
		$this->load->model('Obyek_model');
		$this->load->model('Rincian_model');
		$this->load->model('Rekening_sap_model');
		$this->load->library('Datatables');
	}
	
	public function index() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sap/view';
			
			$container['sap'] 								= $this->Rekening_sap_model->get_list();			
			$where_rek										= 'kode IN (\'4\',\'5\',\'6\')';
			$container['content']['dataset']['rek']			= $this->Akun_model->grid_all('kode, nm_rek_1', 'nm_rek_1', '', '', '', $where_rek);
			$where_drek										= 'kode IN (\'1\',\'2\',\'3\')';
			$container['content']['dataset']['lra']			= $this->Akun_model->grid_all('kode, nm_rek_1', 'nm_rek_1', '', '', '', $where_drek);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	public function add($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('rek1_kode','Kd_rek_1','trim|xss_clean');
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening_sap/add';			
		{
			if($this->form_validation->run() == FALSE){
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'kd_rek_1'		=> $this->input->post('rek1_kode'),
					'kd_rek_2'		=> $this->input->post('rek2_kode'),
					'kd_rek_3'		=> $this->input->post('rek3_kode'),
					'kd_rek_4'		=> $this->input->post('rek4_kode'),
					'kd_rek_5'		=> $this->input->post('rek5_kode'),					
					'kd_lra_1'		=> $this->input->post('lra1_kode'),
					'kd_lra_2'		=> $this->input->post('lra2_kode'),
					'kd_lra_3'		=> $this->input->post('lra3_kode'),
					'kd_lra_4'		=> $this->input->post('lra4_kode'),
					'kd_lra_5'		=> $this->input->post('lra5_kode'),
				);		
				if($this->Rekening_sap_model->insert($container)){
					$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING SAP" telah berhasil ditambahkan</div>');
				    redirect('parameter/rekening-sap');
				}
			}
		}
    }
	
	public function tampil_combobox_akun_by_kelompok1(){
		$where_kelompok = 'kode IN (\'12\',\'13\',\'14\',\'15\',\'16\',\'17\',\'18\')';
		$akun_kode	= $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('ms_rek_2.kode, ms_rek_2.nm_rek_2', 'ms_rek_2.nm_rek_2', '', '', '', $where_kelompok, array('ms_rek_2.kd_rek_1'=>$akun_kode));			
			combobox('db', $data_kelompok, 'rek2_kode', 'kode', 'nm_rek_2', '', 'show_form_kelompok_by_jenis1();', 'Pilih Kelompok ...', 'class="form-control" required');
		} else {
			echo '<select name="rek2_kode" id="rek2_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_kelompok_by_jenis1(){
		$kelompok_kode 	= $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('ms_rek_3.kode, ms_rek_3.nm_rek_3', 'ms_rek_3.nm_rek_3', '', '', '', array('ms_rek_3.kd_rek_2'=>$kelompok_kode));
			combobox('db', $data_jenis, 'rek3_kode', 'kode', 'nm_rek_3', '', 'show_form_jenis_by_obyek1();', 'Pilih Jenis ...', 'class="form-control" required');
		} else {
			echo '<select name="rek3_kode" id="rek3_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_jenis_by_obyek1(){
		$jenis_kode = $this->uri->segment(4);
		if ($jenis_kode){
			$data_obyek = $this->Obyek_model->grid_all('ms_rek_4.kode, ms_rek_4.nm_rek_4', 'ms_rek_4.nm_rek_4', '', '', '', array('ms_rek_4.kd_rek_3'=>$jenis_kode));
			combobox('db', $data_obyek, 'rek4_kode', 'kode', 'nm_rek_4', '', 'show_form_obyek_by_rincian1();', 'Pilih Obyek ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="rek4_kode" id="rek4_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_obyek_by_rincian1(){
		$obyek_kode = $this->uri->segment(4);
		if ($obyek_kode){
			$data_rincian = $this->Rincian_model->grid_all('ms_rek_5.kode, ms_rek_5.nm_rek_5', 'ms_rek_5.nm_rek_5', '', '', '', array('ms_rek_5.kd_rek_4'=>$obyek_kode));
			combobox('db', $data_rincian, 'rek5_kode', 'kode', 'nm_rek_5', '', '', 'Pilih Rincian ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="rek5_kode" id="rek5_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_akun_by_kelompok2(){
		$akun_kode	= $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('ms_rek_2.kode, ms_rek_2.nm_rek_2', 'ms_rek_2.nm_rek_2', '', '', '', array('ms_rek_2.kd_rek_1'=>$akun_kode));			
			combobox('db', $data_kelompok, 'drek2_kode', 'kode', 'nm_rek_2', '', 'show_form_kelompok_by_jenis2();', 'Pilih Kelompok ...', 'class="form-control" required');
		} else {
			echo '<select name="drek2_kode" id="drek2_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_kelompok_by_jenis2(){
		$kelompok_kode 	= $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('ms_rek_3.kode, ms_rek_3.nm_rek_3', 'ms_rek_3.nm_rek_3', '', '', '', array('ms_rek_3.kd_rek_2'=>$kelompok_kode));
			combobox('db', $data_jenis, 'drek3_kode', 'kode', 'nm_rek_3', '', 'show_form_jenis_by_obyek2();', 'Pilih Jenis ...', 'class="form-control" required');
		} else {
			echo '<select name="drek3_kode" id="drek3_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_jenis_by_obyek2(){
		$jenis_kode = $this->uri->segment(4);
		if ($jenis_kode){
			$data_obyek = $this->Obyek_model->grid_all('ms_rek_4.kode, ms_rek_4.nm_rek_4', 'ms_rek_4.nm_rek_4', '', '', '', array('ms_rek_4.kd_rek_3'=>$jenis_kode));
			combobox('db', $data_obyek, 'drek4_kode', 'kode', 'nm_rek_4', '', 'show_form_obyek_by_rincian2();', 'Pilih Obyek ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="drek4_kode" id="drek4_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_obyek_by_rincian2(){
		$obyek_kode = $this->uri->segment(4);
		if ($obyek_kode){
			$data_rincian = $this->Rincian_model->grid_all('ms_rek_5.kode, ms_rek_5.nm_rek_5', 'ms_rek_5.nm_rek_5', '', '', '', array('ms_rek_5.kd_rek_4'=>$obyek_kode));
			combobox('db', $data_rincian, 'drek5_kode', 'kode', 'nm_rek_5', '', '', 'Pilih Rincian ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="drek5_kode" id="drek5_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	
}