<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rka extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rup_model');
		$this->load->model('Akun_model');
		$this->load->model('Kelompok_model');
		$this->load->model('Jenis_model');
		
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
		$this->load->library('Datatables');
		$this->load->library('mpdf/mpdf');
	}
		
	public function index() {	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/rka/view';
		
		if ($admin_log['level_kode'] == 5 || $admin_log['level_kode'] == 4){
			$skpd = $this->Skpd_model->get('skpd_kode, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
			$container['content']['dataset']['skpd_kode']	= $skpd->skpd_kode;
			$container['content']['dataset']['skpd_nama']	= $skpd->skpd_nama;
			$container['content']['dataset']['skpd_aktive']	= 'no';
		} else {
			$container['content']['dataset']['skpd_aktive']	= 'yes';
		}
		
		if ($admin_log['level_kode'] == 4){
			$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
			$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
			$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
			$container['content']['dataset']['kecamatan_aktive']= 'no';
		} else {
			$container['content']['dataset']['kecamatan_aktive']= 'yes';
		}
		
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$where_skpd										= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
			

		$container['content']['dataset']['program']		= $this->Rup_model->get_bl('anggaran.kode, anggaran.kegiatan', 'anggaran.kegiatan', '', '', '', $where_kelompok1);
	
	//	$container['content']['dataset']['program'] 	= $this->Rup_model->get_bl('anggaran_bl.kode as id_kode, skpd.skpd_kode as kode_skpd, anggaran.kode as id_anggaran, program.kode as id_program, program.program as nama_program', 'nama_program', '', '', '', $where_kelompok1);
	
	//	$container['content']['dataset']['program']		= $this->Rup_model->get_p('kode, program_kode', 'program_kode', 'ASC', '', '', $where_anggaran1);
		
	//	$where_anggaran									= 'tahapan_kode IN (\'16\') AND skpd_kode IN (\'40\')';
	//	$where_anggaran									= 'tahapan_kode IN (\'16\')';
	//	$container['content']['dataset']['kegiatan']	= $this->Rup_model->get_k('kode, kegiatan', 'kegiatan', 'ASC', '', '', $where_anggaran, array('skpd_kode'=>'40'));
		
		$where_akun										= 'kode IN (\'5\')';
		$container['content']['dataset']['akun']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function preview2() {	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/rka/preview2';
		
		$container['content']['dataset']['tanggal']		= $this->input->post('tanggal');
		$container['content']['dataset']['tahun']		= $this->input->post('tahun');
		$container['content']['dataset']['skpd_kode']	= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'semua';
		$container['content']['dataset']['kecamatan_kode']	= ($this->input->post('kecamatan_kode'))?$this->input->post('kecamatan_kode'):'semua';
		$container['content']['dataset']['deskel_kode']		= ($this->input->post('deskel_kode'))?$this->input->post('deskel_kode'):'semua';
		$container['content']['dataset']['jenis_anggaran']	= $this->input->post('jenis_anggaran');
		$container['content']['dataset']['tipe_kode']	= $this->input->post('tipe_kode');
		$container['content']['dataset']['transfer']	= $this->input->post('transfer');
		$container['content']['dataset']['nama_pimpinan']= $this->input->post('nama_pimpinan');
		$container['content']['dataset']['pangkat']		= $this->input->post('pangkat');
		$container['content']['dataset']['nip']			= $this->input->post('nip');
		
		$container['content']['dataset']['skpd_kode']	= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'semua';
		
		$header['admin_log']							= $admin_log;
		
		$sess_laporan = array(
			'laporan_tanggal'  	=> $this->input->post('tanggal'),
			'laporan_tahun' 	=> $this->input->post('tahun'),
			'laporan_skpd' 		=> $container['content']['dataset']['skpd_kode'],
			'laporan_kecamatan' => $container['content']['dataset']['kecamatan_kode'],
			'laporan_deskel'  	=> $container['content']['dataset']['deskel_kode'],
			'laporan_jenis'  	=> $this->input->post('jenis_anggaran'),
			'laporan_tipe'  	=> $this->input->post('tipe_kode'),
			'laporan_transfer'  => $this->input->post('transfer'),
			'laporan_pimpinan'  => $this->input->post('nama_pimpinan'),
			'laporan_pangkat'  	=> $this->input->post('pangkat'),
			'laporan_nip'  		=> $this->input->post('nip'),
			
			'laporan_anggaran'	=> $container['content']['dataset']['anggaran_kode']
			);
		
		if ($this->input->post('tahun')) { 
			$this->session->unset_userdata('is_sess_laporan');
			$this->session->set_userdata('is_sess_laporan', $sess_laporan);
			redirect('laporan/rka/preview2', 'refresh');
		}
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function rka_221() {	
		$tipe 		= $this->uri->segment(4);
		if ($tipe == 'excel'){
			$laporan['excel']	= TRUE;
		} else {
			$laporan['pdf']		= FALSE;
		}
		$admin_log 		= $this->auth->is_login_admin();
		$sess_laporan 	= $this->session->userdata('is_sess_laporan');
		
		$laporan['laporan_tanggal']		= $sess_laporan['laporan_tanggal'];
		$laporan['laporan_tahun']		= $sess_laporan['laporan_tahun'];
		$laporan['laporan_skpd']		= $sess_laporan['laporan_skpd'];
		$laporan['laporan_kecamatan']	= $sess_laporan['laporan_kecamatan'];
		$laporan['laporan_deskel']		= $sess_laporan['laporan_deskel'];
		$laporan['laporan_jenis']		= $sess_laporan['laporan_jenis'];
		$laporan['laporan_tipe']		= $sess_laporan['laporan_tipe'];
		$laporan['laporan_transfer']	= $sess_laporan['laporan_transfer'];
		$laporan['laporan_pimpinan']	= $sess_laporan['laporan_pimpinan'];
		$laporan['laporan_pangkat']		= $sess_laporan['laporan_pangkat'];
		$laporan['laporan_nip']			= $sess_laporan['laporan_nip'];
		
		$laporan['laporan_anggaran']	= $sess_laporan['laporan_anggaran'];
		
		if ($laporan['laporan_jenis'] == '1'){
			$this->load->view('laporan/rka/perubahan_221', $laporan);
		} else {
			$this->load->view('laporan/rka/murni_221', $laporan);
		}
	}
	
	public function tampil_combobox_program_by_skpd(){
		$rio_kode		= $this->uri->segment(4);
		$where 			= "anggaran.skpd_kode='".$rio_kode."' AND anggaran.tahapan_kode='16'";
		if ($rio_kode){
			$data_kelompok = $this->Rup_model->get_bl('program.kode, program.program', 'program.program', '', '', '', $where, '', 'program.kode');
			combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'program', '', 'show_form_kegiatan_by_program();', 'Pilih Program ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_kegiatan_by_program1(){
		$kelompok_kode 	= $this->uri->segment(4);
		
		$query_data = mysql_query("SELECT anggaran.skpd_kode as id_skpd
		FROM anggaran
		INNER JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode 
		INNER JOIN program ON anggaran_bl.program_kode=program.kode 
		
		WHERE anggaran.tahapan_kode= '16' AND anggaran_bl.program_kode='".$kelompok_kode."' ORDER BY anggaran.kode ASC"); 
		$data = mysql_fetch_array($query_data);
		$id_skpd = $data[id_skpd];
	
		$where 			= "anggaran.skpd_kode='".$id_skpd."' AND anggaran.tahapan_kode='16'";
		if ($kelompok_kode){
			$data_jenis = $this->Rup_model->get_bl('anggaran.kode, anggaran.kegiatan', 'anggaran.kegiatan', '', '', '', $where, array('anggaran_bl.program_kode'=>$kelompok_kode));
			combobox('db', $data_jenis, 'ccc_kode', 'kode', 'kegiatan', '', '', 'Pilih Kegiatan ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	

	
	
	
	
	
	public function tampil_combobox_program_by_skpd1(){
		$skpd_kode 		= $this->uri->segment(4);
		$where 			= "anggaran.skpd_kode='".$skpd_kode."' AND anggaran.tahapan_kode='16'";
		$data_misi		= $this->Rup_model->get_bl('program.kode, program.program', 'program.program', 'ASC', '', '', $where, '', 'program.kode');
		combobox('db', $data_misi, 'misi_kode', 'kode', 'program', '', 'show_form_kegiatan_by_program();', 'Pilih Program ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
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
	

	
	
	
	
	
	
	
}
