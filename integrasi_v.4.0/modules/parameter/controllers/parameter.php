<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parameter extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Skpd_model');
		$this->load->model('Visi_model');
		$this->load->model('Misi_model');
		$this->load->model('Prioritas_model');
		$this->load->model('Kesepakatan_model');
		$this->load->model('Sifat_model');
		$this->load->model('Lokasi_model');
		$this->load->model('Kecamatan_model');
		$this->load->model('Indikator_skpd_model');
		$this->load->model('Program_model');
		$this->load->model('Anggaran_model');
		$this->load->model('Tahapan_model');
		$this->load->model('Tahapan_skpd_model');
		$this->load->library('Datatables');
	}
		
	public function index(){	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/list';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function tampil_combobox_deskel_by_kecamatan(){
		$admin_log 	= $this->auth->is_login_admin();
		$kode		=  $this->uri->segment(4);
		if ($kode){
			echo '<label class="control-label col-md-3">Desa/Kelurahan</label>';
			echo '<div class="col-md-9">';
			$where											= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
			$like['skpd_kd']								= $kode;
			$data_skpd = $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
			combobox('db', $data_skpd, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Semua Desa/Kelurahan', 'class="select2_category form-control"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-3" for="deskel_kode">Desa/Kelurahan</label>
				<div class="col-md-9">
				<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
					<option value="">Semua Desa/Kelurahan</option>
				</select>
				</div>';
		}
	}
	
	public function tampil_combobox_deskel_by_kecamatan2(){
		$admin_log = $this->auth->is_login_admin();
		echo '<label class="control-label">Desa/Kelurahan <span class="required">*</span> :</label>';
		$where											= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
		$like['skpd_kd']								= $this->uri->segment(4);
		$data_skpd = $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
		combobox('db', $data_skpd, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Pilih Desa/Kelurahan', 'class="select2_category form-control" tabindex="1" required="required"');
		
	}
	
	public function tampil_combobox_misi_by_skpd(){
		$skpd_kode 		= $this->uri->segment(4);
		$where 			= "skpd.skpd_kode='".$skpd_kode."' OR misi.kode='5'";
		$data_misi		= $this->Indikator_skpd_model->grid_all('misi.kode as misi_kode, misi.misi as misi_nama', 'misi.misi', 'ASC', '', '', $where, '', 'misi.kode');
		echo '<label class="control-label" for="misi_kode">Misi Kabupaten Bekasi <span class="required">*</span> :</label>';
		combobox('db', $data_misi, 'misi_kode', 'misi_kode', 'misi_nama', '', 'show_form_tujuan_by_misi();', 'Pilih Misi Kabupaten Bekasi', 'class="select2_category form-control" tabindex="1" required="required"');
	}
	
	public function tampil_combobox_tujuan_by_misi(){
		$skpd_kode 		= $this->uri->segment(4);
		$misi_kode 		= $this->uri->segment(5);
		$where			= "skpd.skpd_kode='".$skpd_kode."' OR tujuan.kode='1'";
		$data_tujuan	= $this->Indikator_skpd_model->grid_all('tujuan.kode as tujuan_kode, tujuan.tujuan as tujuan_nama', 'tujuan.tujuan', 'ASC', '', '', $where, '', 'tujuan.kode');
		if (!empty($misi_kode)){
		echo '<label class="control-label" for="tujuan_kode">Tujuan Anggaran <span class="required">*</span> :</label>';
			combobox('db', $data_tujuan, 'tujuan_kode', 'tujuan_kode', 'tujuan_nama', '', 'show_form_sasaran_by_tujuan();', 'Pilih Tujuan', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
		echo '<label class="control-label" for="tujuan_kode">Tujuan Anggaran <span class="required">*</span> :</label>
			<select class="select2_category form-control" name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan Anggaran" tabindex="1">
			</select>';
		}
	}
	
	public function tampil_combobox_sasaran_by_tujuan(){
		$skpd_kode 		= $this->uri->segment(4);
		$tujuan_kode 	= $this->uri->segment(5);
		if ($tujuan_kode == 1){
			$where = "sasaran.tujuan IN ('1')";
		} else {
			$where = "tujuan.kode='".$tujuan_kode."' AND skpd.skpd_kode='".$skpd_kode."'";
		}
		$data_sasaran	= $this->Indikator_skpd_model->grid_all('sasaran.kode as sasaran_kode, sasaran.sasaran as sasaran_nama', 'sasaran.sasaran', 'ASC', '', '', $where, '', 'sasaran.kode');
		if (!empty($tujuan_kode)){
		echo '<label class="control-label" for="sasaran_kode">Sasaran Daerah <span class="required">*</span> :</label>';
			combobox('db', $data_sasaran, 'sasaran_kode', 'sasaran_kode', 'sasaran_nama', '', 'show_form_indikator_by_sasaran();', 'Pilih Sasaran', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
		echo '<label class="control-label" for="sasaran_kode">Sasaran Daerah <span class="required">*</span> :</label>
			<select class="select2_category form-control" name="sasaran_kode" id="sasaran_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1">
			</select>';	
		}
	}
	
	public function tampil_combobox_indikator_by_sasaran(){
		$skpd_kode 		= $this->uri->segment(4);
		$tujuan_kode 	= $this->uri->segment(5);
		$sasaran_kode 	= $this->uri->segment(6);
		if ($sasaran_kode == 1){
			$where = "sasaran.kode IN ('1')";
		} else {
			$where = "sasaran.kode='".$sasaran_kode."' AND skpd.skpd_kode='".$skpd_kode."'";
		}
		$data_indikator	= $this->Indikator_skpd_model->grid_all('indikator.kode as indikator_kode, indikator.indikator as indikator_nama', 'indikator.indikator', 'ASC', '', '', $where, '', 'indikator.kode');
		if ($sasaran_kode){
		echo '<label class="control-label" for="indikator_kode">Indikator Sasaran <span class="required">*</span> :</label>';
				combobox('db', $data_indikator, 'indikator_kode', 'indikator_kode', 'indikator_nama', '', 'show_form_urusan_by_indikator();', 'Pilih Indikator', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
		echo '<label class="control-label" for="indikator_kode">Indikator Sasaran <span class="required">*</span> :</label>
			<select class="select2_category form-control" name="indikator_kode" id="indikator_kode" data-placeholder="Pilih Indikator Sasaran" tabindex="1" required="required">
			</select>';
		}
	}
	
	public function tampil_combobox_urusan_by_indikator(){
		$skpd_kode 		= $this->uri->segment(4);
		$tujuan_kode 	= $this->uri->segment(5);
		$indikator_kode = $this->uri->segment(6);
		if ($tujuan_kode == 1){
			$where = "urusan.kode='1'";
		} else {
			$where = "skpd.skpd_kode='".$skpd_kode."' AND skpd_indikator.indikator='".$indikator_kode."'";
		}
		$data_urusan 	= $this->Indikator_skpd_model->grid_all('urusan.kode as urusan_kode, urusan.urusan as urusan_nama', 'urusan.urusan', 'ASC', '', '', $where, '', 'urusan.kode');
		echo '<label class="control-label" for="urusan_kode">Urusan <span class="required">*</span> :</label>';
		combobox('db', $data_urusan, 'urusan_kode', 'urusan_kode', 'urusan_nama', '', 'show_form_program_by_urusan();', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required"');		
		
	}
	
	public function tampil_combobox_program_by_urusan(){
		$skpd_kode 		= $this->uri->segment(4);
		$urusan_kode	= $this->uri->segment(5);
		if ($urusan_kode == 1){
			$where 			= "program.urusan IN ('1')";
		} else {
			$where 			= "urusan.kode='".$urusan_kode."' AND skpd.skpd_kode='".$skpd_kode."' OR program.kode='136'";
		}
		$data_program	= $this->Indikator_skpd_model->grid_all('program.kode as program_kode, program.program as program_nama', 'program.program', 'ASC', '', '', $where, '', 'program.kode');
		if ($urusan_kode){
			echo '<label class="control-label" for="program_kode">Program <span class="required">*</span> :</label>';
			combobox('db', $data_program, 'program_kode', 'program_kode', 'program_nama', '', 'show_form_kegiatan_by_program();', 'Pilih Program', 'class="select2_category form-control" tabindex="1" required="required"');
		} else {
			echo '<label class="control-label" for="program_kode">Program <span class="required">*</span> :</label>';
			echo '<select class="select2_category form-control" name="program_kode" id="program_kode" data-placeholder="Pilih Program" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_kegiatan_by_program(){
		$admin_log = $this->auth->is_login_admin();
		$urusan_kode	= $this->uri->segment(4);
		$program_kode	= $this->uri->segment(5);
		$skpd_kode		= $this->uri->segment(6);
		$skpd 			= $this->Skpd_model->get('skpd.skpd_kegiatan', array('skpd.skpd_kode'=>$skpd_kode));
		if ($skpd->skpd_kegiatan == 'Y' || $admin_log['level_kode'] == 1){
			$where_kegiatan = "program='".$program_kode."' OR no='999'";
		} else {
			$where_kegiatan = "program='".$program_kode."'";
		}
		$query			= $this->db->query("SELECT kegiatan FROM program_kegiatan WHERE ".$where_kegiatan." ORDER BY no ASC");
		$data_kegiatan	= $query->result();
		if ($urusan_kode == 1 && $query->num_rows() > 0){
			echo '<label class="control-label" for="program_kode">Nama Kegiatan <span class="required">*</span> :</label>';
			combobox('db', $data_kegiatan, 'kegiatan', 'kegiatan', 'kegiatan', '', 'show_form_kegiatan_lainnya();', 'Pilih Kegiatan', 'class="select2_category form-control" tabindex="1" required="required"');
		} else {
			echo '<label class="control-label" for="kegiatan">Nama Kegiatan <span class="required">*</span> :</label>
				<input type="text" class="form-control" name="kegiatan" id="kegiatan" required="required">';
		}
	}
	
	public function tampil_kegiatan_lainnya(){
		$admin_log = $this->auth->is_login_admin();
		$kegiatan	= $this->uri->segment(4);
		if ($kegiatan == 'Lainnya...'){
		echo '<label class="control-label" for="kegiatan_lainnya">Kegiatan Lainnya <span class="required">*</span> :</label><input type="text" class="form-control" name="kegiatan_lainnya" id="kegiatan_lainnya" required="required">';
		} else {
			echo "";
		}
	}
	
	public function tampil_combobox_hasil_by_program(){
		$program_kode	= $this->uri->segment(4);
		$data_kegiatan	= $this->Program_model->get('program.hasil_program', array('program.kode' => $program_kode));
		echo '<label class="control-label" for="hp_ukur">Tolak Ukur :</label>
			<input type="text" class="form-control" name="hp_ukur" value="'.$data_kegiatan->hasil_program.'" id="hp_ukur" placeholder="">';
	}
	
}