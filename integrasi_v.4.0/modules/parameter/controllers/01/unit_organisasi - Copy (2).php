<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_organisasi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bidang_tipe_model');
		$this->load->model('Bidang_unit_model');
		$this->load->model('Bidang_indikator_model');
	}
	
	public function index()
	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/view';
			
				$container['content']['dataset']['tipe_kode']	= $bidang_tipe->tipe_kode;
				$container['content']['dataset']['tipe_nama']	= $bidang_tipe->tipe_nama;
				$where_misi										= "bidang_tipe.tipe_kode='".$bidang_tipe->tipe_kode."' OR bidang.kode=''";
				$container['content']['dataset']['bidang']		= $this->Bidang_indikator_model->grid_all('bidang.kode as bidang_kode, bidang.bidang as bidang_nama', 'bidang.bidang', 'ASC', '', '', $where_misi, '', 'bidang.kode');

			$where_skpd											= 'tipe_status IN (\'1\', \'2\')';
			$container['content']['dataset']['bidang_tipe']		= $this->Bidang_tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_skpd);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function tampil_combobox_misi_by_skpd(){
		$tipe_kode 		= $this->uri->segment(4);
		$where 			= "bidang_tipe.tipe_kode='".$tipe_kode."' OR bidang.kode=''";
		$data_misi		= $this->Bidang_indikator_model->grid_all('bidang.kode as bidang_kode, bidang.bidang as bidang_nama', 'bidang.bidang', '', '', '', $where, '', 'bidang.kode');
		echo '<label class="control-label col-md-2" for="bidang_kode">Bidang :</label>';
		echo '<div class="col-md-10">';
		combobox('db', $data_misi, 'bidang_kode', 'bidang_kode', 'bidang_nama', '', 'show_form_tujuan_by_misi();', 'Pilih Bidang', 'class="select2_category form-control" tabindex="1" required="required"');
		echo '</div>';
	}
	
	public function tampil_combobox_tujuan_by_misi(){
		$tipe_kode 		= $this->uri->segment(4);
		$where 			= "bidang_tipe.tipe_kode='".$tipe_kode."' OR bidang_unit.kode=''";
		$data_misi		= $this->Bidang_indikator_model->grid_all('bidang_unit.kode as bidang_unit_kode, bidang_unit.bidang_unit as bidang_unit_nama', 'bidang_unit.bidang_unit', '', '', '', $where, '', 'bidang_unit.kode');
		echo '<label class="control-label col-md-2" for="bidang_unit_kode">Unit :</label>';
		echo '<div class="col-md-10">';
		combobox('db', $data_misi, 'bidang_unit_kode', 'bidang_unit_kode', 'bidang_unit_nama', '', 'show_form_sasaran_by_tujuan();', 'Pilih Unit', 'class="select2_category form-control" tabindex="1" required="required"');
		echo '</div>';
	}
	
	public function tampil_combobox_sasaran_by_tujuan(){
		$tipe_kode 			= $this->uri->segment(4);
		$bidang_unit_kode	= $this->uri->segment(5);
		if ($bidang_unit_kode == 0){
			$where = "bidang_sub.bidang_unit IN ('')";
		} else {
			$where = "bidang_unit.kode='".$bidang_unit_kode."' AND bidang_tipe.tipe_kode='".$tipe_kode."'";
		}
		$data_sasaran	= $this->Bidang_indikator_model->grid_all('bidang_sub.kode as bidang_sub_kode, bidang_sub.bidang_sub as bidang_sub_nama', 'bidang_sub.bidang_sub', 'ASC', '', '', $where, '', 'bidang_sub.kode');
		if (!empty($bidang_unit_kode)){
		echo '<label class="control-label col-md-2" for="bidang_sub_kode">Sub Unit :</label>';
		echo '<div class="col-md-10">';
			combobox('db', $data_sasaran, 'bidang_sub_kode', 'bidang_sub_kode', 'bidang_sub_nama', '', 'show_form_indikator_by_sasaran();', 'Pilih Sub Unit', 'class="select2_category form-control" tabindex="1" required="required"');		
		echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="bidang_sub_kode">Sub Unit :</label>';
			echo '<div class="col-md-10">';
			combobox('db', $data_sasaran, 'bidang_sub_kode', 'bidang_sub_kode', 'bidang_sub_nama', '', 'show_form_indikator_by_sasaran();', 'Pilih Sub Unit', 'class="select2_category form-control" tabindex="1" required="required"');
			echo '</div>';
		}
	}

}