<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_organisasi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tipe_model');
		$this->load->model('Skpd_model');
		$this->load->model('Misi_model');
		$this->load->model('Indikator_skpd_model');
		$this->load->model('Bidang_indikator_model');
	}
	
	public function index()
	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/view';

			$where_tipe									= 'tipe_sort IN (\'1\', \'2\')';
			$container['content']['dataset']['tipe']	= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_tipe);
			
			$header['admin_log']						= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function tampil_combobox_bidang_by_unit(){
		$tipe_kode 		= $this->uri->segment(4);
		$where 			= "tipe.tipe_kode='".$tipe_kode."' OR urusan.kode=''";
		$data_misi		= $this->Bidang_indikator_model->grid_all('urusan.kode as bidang_kode, urusan.urusan as bidang_nama', 'urusan.urusan', '', '', '', $where, '', 'urusan.kode');
		echo '<label class="control-label col-md-2" for="bidang_kode">Bidang :</label>';
		echo '<div class="col-md-10">';
		combobox('db', $data_misi, 'bbb_kode', 'bidang_kode', 'bidang_nama', '', 'show_form_unit_by_bidang();', 'Pilih Bidang', 'class="select2_category form-control" tabindex="1" required="required"');
		echo '</div>';
	}
	
	public function tampil_combobox_unit_by_bidang(){
		$tipe_kode 			= $this->uri->segment(4);
		$bidang_unit_kode	= $this->uri->segment(5);
		if ($bidang_unit_kode == 0){
			$where = "bidang_unit.urusan IN ('')";
		} else {
			$where = "urusan.kode='".$bidang_unit_kode."' AND tipe.tipe_kode='".$tipe_kode."'";
		}
		$data_unit = $this->Bidang_indikator_model->grid_all('bidang_unit.bidang_unit as unit_kode, bidang_unit.bidang_unit as unit_nama', 'bidang_unit.bidang_unit', 'ASC', '', '', $where, '', 'bidang_unit.bidang_unit');
		if (!empty($bidang_unit_kode)){
		echo '<label class="control-label col-md-2" for="ccc_kode">Unit :</label>';
		echo '<div class="col-md-10">';
			combobox('db', $data_unit, 'ccc_kode', 'unit_kode', 'unit_nama', '', 'show_form_sub_by_bidang();', 'Pilih Unit', 'class="select2_category form-control" tabindex="1" required="required"');	
		echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="ccc_kode">Unit :</label>';
			echo '<div class="col-md-10">';
			echo '</div>';
		}
	}
	
	public function tampil_combobox_sub_by_bidang(){
		$tipe_kode 			= $this->uri->segment(4);
		$bidang_unit_kode	= $this->uri->segment(5);
		if ($bidang_unit_kode == 0){
			$where = "bidang_sub.urusan IN ('')";
		} else {
			$where = "urusan.kode='".$bidang_unit_kode."' AND tipe.tipe_kode='".$tipe_kode."'";
		}
		$data_sub = $this->Bidang_indikator_model->grid_all('bidang_indikator.kode , bidang_indikator.bidang_sub', 'bidang_indikator.bidang_sub', 'ASC', '', '', $where, '', 'bidang_indikator.kode');
		if (!empty($bidang_unit_kode)){
		echo '<label class="control-label col-md-2" for="ddd_kode">Sub Unit :</label>';
		echo '<div class="col-md-10">';
			combobox('db', $data_sub, 'ddd_kode', 'kode', 'bidang_sub', '', '', 'Pilih Sub Unit', 'class="select2_category form-control" tabindex="1" required="required"');		
		echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="ddd_kode">Sub Unit :</label>';
			echo '<div class="col-md-10">';
			echo '</div>';
		}
	}

}