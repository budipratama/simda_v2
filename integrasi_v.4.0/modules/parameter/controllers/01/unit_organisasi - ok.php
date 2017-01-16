<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_organisasi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bidang_model');
	}
	
	public function index()
	{
		$admin_log 	= $this->auth->is_login_admin();		
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/view';
			
			$container['content']['dataset']['bidang']		= $this->Bidang_model->grid_all('bidang_kd, bidang_nama', 'bidang_nama', 'ASC', '', '', array('bidang_status'=>'Bidang'));

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function tampil_combobox_deskel_by_kecamatan2(){
		$admin_log = $this->auth->is_login_admin();
		echo '<label class="control-label">Unit :</label>';
		$where											= 'bidang_status IN (\'Unit\')';
		$like['bidang_kd']								= $this->uri->segment(4);
		$data_skpd = $this->Bidang_model->grid_all('bidang_kd, bidang_nama', 'bidang_nama', 'ASC', '', '', $where, $like);
		combobox('db', $data_skpd, 'deskel_kode', 'bidang_kd', 'bidang_nama', '', 'show_form_deskel_by_kecamatan1()', 'Pilih Unit', 'class="select2_category form-control" tabindex="1" required="required"');
		
	}
	
	public function tampil_combobox_deskel_by_kecamatan3(){
		$admin_log = $this->auth->is_login_admin();
		echo '<label class="control-label">Sub Unit :</label>';
		$where											= 'bidang_status IN (\'Sub\')';
		$like['bidang_kd']								= $this->uri->segment(4);
		$data_skpd = $this->Bidang_model->grid_all('bidang_kd, bidang_nama', 'bidang_nama', 'ASC', '', '', $where, $like);
		combobox('db', $data_skpd, 'deskel_kode', 'bidang_kd', 'bidang_nama', '', '', 'Pilih Sub Unit', 'class="select2_category form-control" tabindex="1" required="required"');
		
	}
	
}