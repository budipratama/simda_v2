<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indikator_skpd extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$admin_log = $this->auth->is_login_admin();
		$this->load->model('Tahun_model');
		$this->load->model('Indikator_skpd_model');
		$this->load->model('Program_kegiatan_model');
		$this->load->model('Visi_model');
		$this->load->model('Misi_model');
		$this->load->model('Tujuan_model');
		$this->load->model('Sasaran_model');
		$this->load->model('Indikator_model');
		$this->load->model('Urusan_model');
		$this->load->model('Program_model');
		$this->load->model('Skpd_model');
		$this->load->library('Datatables');
	}
	
	function datatable() {
		$admin_log  = $this->auth->is_login_admin();
		$tahun		= $admin_log['tahun'];
	
		$where_datatable = 'ms_urusan.tahun = \''.$tahun.'\'';

		$this->datatables->select('nomor, kode, indikator_nama, skpd_nama, no')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('skpd_nama, indikator_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, skpd_indikator.kode, indikator.indikator as indikator_nama, skpd.skpd_nama, ms_urusan.no FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, skpd_indikator LEFT JOIN indikator ON skpd_indikator.indikator=indikator.kode LEFT JOIN skpd ON skpd_indikator.skpd=skpd.skpd_kode LEFT JOIN urusan ON skpd_indikator.urusan=urusan.kode LEFT JOIN ms_urusan ON urusan.kd_urusan=ms_urusan.kode WHERE ('.$where_datatable.') ORDER BY indikator.indikator ASC) indikator');
		
        echo $this->datatables->generate();
    }
		
	public function index() {	
		$admin_log  = $this->auth->is_login_admin();
		$tahun		= $admin_log['tahun'];
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/indikator_skpd/view';
		$container['content']['dataset']				= '';
		
		$where_skpd										= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
		$container['content']['dataset']['skpd']		= $this->Urusan_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd, array('ms_urusan.tahun'=>$tahun), 'skpd.skpd_kode');
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$container['content']['dataset']['visi']		= $this->Visi_model->grid_all('visi.kode, visi.visi', 'visi.visi', 'ASC');
		$container['content']['dataset']['misi']		= $this->Misi_model->grid_all('misi.kode, misi.misi', 'misi.misi', 'ASC');
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun), 'urusan.kode');
		$container['content']['dataset']['tahun_']		= $admin_log['tahun'];	
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert() {
		$admin_log = $this->auth->is_login_admin();
		$this->form_validation->set_rules('visi_kode', 'Visi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('misi_kode', 'Misi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tujuan_kode', 'Tujuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sasaran_kode', 'Sasaran', 'trim|required|xss_clean');
		$this->form_validation->set_rules('indikator_kode', 'Indikator', 'trim|required|xss_clean');
		$this->form_validation->set_rules('urusan_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('program_kode', 'Program', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_kode', 'SKPD', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$admin_log 	= $this->auth->is_login_admin();
			$tahun_kode	= $this->uri->segment(4);
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/indikator_skpd/view';
			
			$where_skpd										= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
			$container['content']['dataset']['skpd']		= $this->Urusan_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd, array('ms_urusan.tahun'=>$tahun_kode), 'skpd.skpd_kode');
			$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
			$container['content']['dataset']['visi']		= $this->Visi_model->grid_all('visi.kode, visi.visi', 'visi.visi', 'ASC');
			$container['content']['dataset']['misi']		= $this->Misi_model->grid_all('misi.kode, misi.misi', 'misi.misi', 'ASC');	
			$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun_kode), 'urusan.kode');
			$container['content']['dataset']['tahun_']		= $this->uri->segment(4);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$insert['visi']			= $this->input->post('visi_kode');
			$insert['misi']			= $this->input->post('misi_kode');
			$insert['tujuan']		= $this->input->post('tujuan_kode');
			$insert['urusan']		= $this->input->post('urusan_kode');
			$insert['sasaran']		= $this->input->post('sasaran_kode');
			$insert['indikator']	= $this->input->post('indikator_kode');
			$insert['program']		= $this->input->post('program_kode');
			$insert['skpd']			= $this->input->post('skpd_kode');
			$tahun					= $this->input->post('tahun');
			$query 					= $this->Indikator_skpd_model->insert($insert);
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data indikator baru telah berhasil ditambahkan.</div>');
			redirect('pengaturan/indikator-skpd/thn/'.$tahun, 'refresh');
		}
	}
	
	public function edit() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;	
		$container['content']['view']					= 'pengaturan/indikator_skpd/edit';
		$container['content']['dataset']['visi']		= $this->Visi_model->grid_all('visi.kode, visi.visi', 'visi.visi', 'ASC');
		$container['content']['dataset']['misi']		= $this->Misi_model->grid_all('misi.kode, misi.misi', 'misi.misi', 'ASC');
		$container['content']['dataset']['tujuan']		= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', 'ASC');
		$container['content']['dataset']['sasaran']		= $this->Sasaran_model->grid_all('sasaran.kode, sasaran.sasaran', 'sasaran.sasaran', 'ASC');
		$container['content']['dataset']['indikator']	= $this->Indikator_model->grid_all('indikator.kode, indikator.indikator', 'indikator.indikator', 'ASC');
		$container['content']['dataset']['program']		= $this->Program_model->grid_all('program.kode, program.program', 'program.program', 'ASC');
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd.skpd_nama', 'ASC');
		
		$indikator_skpd = $this->Indikator_skpd_model->get('skpd_indikator.*', array('skpd_indikator.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']			= $indikator_skpd->kode;
		$container['content']['dataset']['visi_kode']		= $indikator_skpd->visi;
		$container['content']['dataset']['misi_kode']		= $indikator_skpd->misi;
		$container['content']['dataset']['tujuan_kode']		= $indikator_skpd->tujuan;
		$container['content']['dataset']['urusan_kode']		= $indikator_skpd->urusan;
		$container['content']['dataset']['sasaran_kode']	= $indikator_skpd->sasaran;
		$container['content']['dataset']['indikator_kode']	= $indikator_skpd->indikator;
		$container['content']['dataset']['program_kode']	= $indikator_skpd->program;
		$container['content']['dataset']['skpd_kode']		= $indikator_skpd->skpd;
		
		$header['admin_log']			= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update() {
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('visi_kode', 'Visi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('misi_kode', 'Misi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tujuan_kode', 'Tujuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sasaran_kode', 'Sasaran', 'trim|required|xss_clean');
		$this->form_validation->set_rules('indikator_kode', 'Indikator', 'trim|required|xss_clean');
		$this->form_validation->set_rules('urusan_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('program_kode', 'Program', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_kode', 'SKPD', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/indikator_skpd/edit';
			$container['content']['dataset']['visi']		= $this->Visi_model->grid_all('visi.kode, visi.visi', 'visi.visi', 'ASC');
			$container['content']['dataset']['misi']		= $this->Misi_model->grid_all('misi.kode, misi.misi', 'misi.misi', 'ASC');
			$container['content']['dataset']['tujuan']		= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
			$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', 'ASC');
			$container['content']['dataset']['sasaran']		= $this->Sasaran_model->grid_all('sasaran.kode, sasaran.sasaran', 'sasaran.sasaran', 'ASC');
			$container['content']['dataset']['indikator']	= $this->Indikator_model->grid_all('indikator.kode, indikator.indikator', 'indikator.indikator', 'ASC');
			$container['content']['dataset']['program']		= $this->Program_model->grid_all('program.kode, program.program', 'program.program', 'ASC');
			$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd.skpd_nama', 'ASC');
			
			$indikator_skpd = $this->Indikator_skpd_model->get('skpd_indikator.*', array('skpd_indikator.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['kode']			= $indikator_skpd->kode;
			$container['content']['dataset']['visi_kode']		= $indikator_skpd->visi;
			$container['content']['dataset']['misi_kode']		= $indikator_skpd->misi;
			$container['content']['dataset']['tujuan_kode']		= $indikator_skpd->tujuan;
			$container['content']['dataset']['urusan_kode']		= $indikator_skpd->urusan;
			$container['content']['dataset']['sasaran_kode']	= $indikator_skpd->sasaran;
			$container['content']['dataset']['indikator_kode']	= $indikator_skpd->indikator;
			$container['content']['dataset']['program_kode']	= $indikator_skpd->program;
			$container['content']['dataset']['skpd_kode']		= $indikator_skpd->skpd;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['visi']			= $this->input->post('visi_kode');
			$update['misi']			= $this->input->post('misi_kode');
			$update['tujuan']		= $this->input->post('tujuan_kode');
			$update['urusan']		= $this->input->post('urusan_kode');
			$update['sasaran']		= $this->input->post('sasaran_kode');
			$update['indikator']	= $this->input->post('indikator_kode');
			$update['program']		= $this->input->post('program_kode');
			$update['skpd']			= $this->input->post('skpd_kode');
						
			$query = $this->Indikator_skpd_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data indikator skpd telah berhasil diubah.</div>');
			
			redirect('pengaturan/indikator_skpd', 'refresh');
		}
	}
	
	public function detail() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/indikator_skpd/detail';
		$container['content']['dataset']				= '';
		
		$indikator_skpd = $this->Indikator_skpd_model->get('skpd_indikator.*, visi.kode as visi_kode, visi.visi as visi_nama, misi.kode as misi_kode, misi.misi as misi_nama, tujuan.kode as tujuan_kode, tujuan.tujuan as tujuan_nama, urusan.kode as urusan_kode, urusan.urusan as urusan_nama, sasaran.kode as sasaran_kode, sasaran.sasaran as sasaran_nama, indikator.kode as indikator_kode, indikator.indikator as indikator_nama, program.kode as program_kode, program.program as program_nama, skpd_kode, skpd_nama', array('skpd_indikator.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']			= $indikator_skpd->kode;
		$container['content']['dataset']['visi_kode']		= $indikator_skpd->visi_kode;
		$container['content']['dataset']['misi_kode']		= $indikator_skpd->misi_kode;
		$container['content']['dataset']['tujuan_kode']		= $indikator_skpd->tujuan_kode;
		$container['content']['dataset']['urusan_kode']		= $indikator_skpd->urusan_kode;
		$container['content']['dataset']['sasaran_kode']	= $indikator_skpd->sasaran_kode;
		$container['content']['dataset']['indikator_kode']	= $indikator_skpd->indikator_kode;
		$container['content']['dataset']['program_kode']	= $indikator_skpd->program_kode;
		$container['content']['dataset']['skpd_kode']		= $indikator_skpd->skpd_kode;
		$container['content']['dataset']['visi_nama']		= $indikator_skpd->visi_nama;
		$container['content']['dataset']['misi_nama']		= $indikator_skpd->misi_nama;
		$container['content']['dataset']['tujuan_nama']		= $indikator_skpd->tujuan_nama;
		$container['content']['dataset']['urusan_nama']		= $indikator_skpd->urusan_nama;
		$container['content']['dataset']['sasaran_nama']	= $indikator_skpd->sasaran_nama;
		$container['content']['dataset']['indikator_nama']	= $indikator_skpd->indikator_nama;
		$container['content']['dataset']['program_nama']	= $indikator_skpd->program_nama;
		$container['content']['dataset']['skpd_nama']		= $indikator_skpd->skpd_nama;
		
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function delete() {
		if ($this->uri->segment(4)){
			$this->Indikator_skpd_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data indikator skpd telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/indikator_skpd', 'refresh');
	}
	
	public function tampil_combobox_misi_skpd() {
		$skpd_kode 		= $this->uri->segment(4);
		$where			= "skpd.skpd_kode='".$skpd_kode."' OR misi.kode='5'";
		$data_misi		= $this->Indikator_skpd_model->grid_all('misi.kode as misi_kode, misi.misi as misi_nama', 'misi.misi', 'ASC', '', '', $where, '', 'misi.kode');
		if (!empty($skpd_kode)){
		echo '<label class="control-label" for="urusan_kode">Misi Kabupaten Bekasi :</label>';
				combobox('db', $data_misi, 'misi_kode', 'misi_kode', 'misi_nama', '', 'show_form_tujuan();', 'Pilih Misi', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
		echo '<label class="control-label" for="misi_kode">Misi Kabupaten Bekasi :</label>
				<select class="select2_category form-control" name="misi_kode" id="misi_kode" data-placeholder="Pilih Misi Kabupaten Bekasi" tabindex="1">
				</select>';
		}
	}
	
	public function tampil_combobox_tujuan_misi() {
		$skpd_kode 		= $this->uri->segment(4);
		$misi_kode 		= $this->uri->segment(5);
		$where			= "skpd.skpd_kode='".$skpd_kode."' OR tujuan.kode='1'";
		$data_tujuan	= $this->Indikator_skpd_model->grid_all('tujuan.kode as tujuan_kode, tujuan.tujuan as tujuan_nama', 'tujuan.tujuan', 'ASC', '', '', $where, '', 'tujuan.kode');
		if (!empty($misi_kode)){
		echo '<label class="control-label" for="tujuan_kode">Tujuan Anggaran :</label>';
				combobox('db', $data_tujuan, 'tujuan_kode', 'tujuan_kode', 'tujuan_nama', '', 'show_form_sasaran();', 'Pilih Tujuan', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
		echo '<label class="control-label" for="tujuan_kode">Tujuan Anggaran :</label>
				<select class="select2_category form-control" name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan Anggaran" tabindex="1">
				</select>';
		}
	}
	
	public function tampil_combobox_sasaran_tujuan() {
		$skpd_kode 		= $this->uri->segment(4);
		$misi_kode 		= $this->uri->segment(5);
		$tujuan_kode 	= $this->uri->segment(6);
		if ($tujuan_kode == 1){
			$where = "sasaran.tujuan IN ('1')";
		} else {
			$where = "tujuan.kode='".$tujuan_kode."' AND skpd.skpd_kode='".$skpd_kode."'";
		}
		$data_sasaran	= $this->Indikator_skpd_model->grid_all('sasaran.kode as sasaran_kode, sasaran.sasaran as sasaran_nama', 'sasaran.sasaran', 'ASC', '', '', $where, '', 'sasaran.kode');
		if (!empty($tujuan_kode)){
		echo '<label class="control-label" for="sasaran_kode">Sasaran Daerah :</label>';
				combobox('db', $data_sasaran, 'sasaran_kode', 'sasaran_kode', 'sasaran_nama', '', 'show_form_indikator();', 'Pilih Sasaran', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
		echo '<label class="control-label" for="sasaran_kode">Sasaran Daerah :</label>
				<select class="select2_category form-control" name="sasaran_kode" id="sasaran_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1">
				</select>';	
		}
	}
	
	public function tampil_combobox_indikator_sasaran() {
		$skpd_kode 		= $this->uri->segment(4);
		$misi_kode 		= $this->uri->segment(5);
		$tujuan_kode 	= $this->uri->segment(6);
		$sasaran_kode 	= $this->uri->segment(7);
		if ($sasaran_kode == 1){
			$where = "sasaran.kode IN ('1')";
		} else {
			$where = "sasaran.kode='".$sasaran_kode."' AND skpd.skpd_kode='".$skpd_kode."'";
		}
		$data_indikator	= $this->Indikator_skpd_model->grid_all('indikator.kode as indikator_kode, indikator.indikator as indikator_nama', 'indikator.indikator', 'ASC', '', '', $where, '', 'indikator.kode');
		if ($sasaran_kode){
		echo '<label class="control-label" for="indikator_kode">Indikator Sasaran :</label>';
				combobox('db', $data_indikator, 'indikator_kode', 'indikator_kode', 'indikator_nama', '', 'show_form_urusan();', 'Pilih Indikator', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
		echo '<label class="control-label" for="indikator_kode">Indikator Sasaran :</label>
				<select class="select2_category form-control" name="indikator_kode" id="indikator_kode" data-placeholder="Pilih Indikator Sasaran" tabindex="1">
				</select>';
		}
	}
	
	public function tampil_combobox_urusan_skpd() {
		$skpd_kode 		= $this->uri->segment(4);
		$tujuan_kode	= $this->uri->segment(5);
		$indikator_kode	= $this->uri->segment(6);
		if ($tujuan_kode == 1){
			$where = "urusan.kode='1'";
		} else {
			$where = "skpd.skpd_kode='".$skpd_kode."' AND indikator.kode='".$indikator_kode."'";
		}
		$data_urusan 	= $this->Indikator_skpd_model->grid_all('urusan.kode as urusan_kode, urusan.urusan as urusan_nama', 'urusan.urusan', 'ASC', '', '', $where, '', 'urusan.kode');
		if ($tujuan_kode){
		echo '<label class="control-label" for="urusan_kode">Urusan :</label>';
				combobox('db', $data_urusan, 'urusan_kode', 'urusan_kode', 'urusan_nama', '', 'show_form_program();', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
		echo '<label class="control-label" for="urusan_kode">Urusan :</label>
				<select class="select2_category form-control" name="urusan_kode" id="urusan_kode" data-placeholder="Pilih Sasaran Daerah" tabindex="1">
				</select>';	
		}
	}
	
	public function tampil_combobox_program_urusan_skpd() {
		$skpd_kode 		= $this->uri->segment(4);
		$urusan_kode	= $this->uri->segment(5);
		if ($urusan_kode == 1){
			$where = "urusan.kode IN ('1')";
		} else {
			$where = "urusan.kode='".$urusan_kode."' AND skpd.skpd_kode='".$skpd_kode."' OR program.kode='136'";
		}
		$data_program	= $this->Indikator_skpd_model->grid_all('program.kode as program_kode, program.program as program_nama', 'program.program', 'ASC', '', '', $where, '', 'program.kode');
		if (!empty($urusan_kode) && !empty($skpd_kode)){
			echo '<label class="control-label" for="program_kode">Program :</label>';
				combobox('db', $data_program, 'program_kode', 'program_kode', 'program_nama', '', 'show_form_kegiatan();', 'Pilih Program', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
			echo '<label class="control-label" for="program_kode">Program :</label>
				<select class="select2_category form-control" name="program_kode" id="program_kode" data-placeholder="Pilih Program" tabindex="1" required="required">
				</select>';
		}
	}
	
	public function tampil_combobox_kegiatan_program() {
		$urusan_kode 	= $this->uri->segment(4);
		$program_kode	= $this->uri->segment(5);
		$data_kegiatan	= $this->Program_kegiatan_model->grid_all('program_kegiatan.kode as kegiatan_kode, program_kegiatan.kegiatan as kegiatan_nama', 'program_kegiatan.no', 'ASC', '', '', array('program_kegiatan.urusan' => $urusan_kode, 'program_kegiatan.program' => $program_kode), '', 'program_kegiatan.kode');
		if (!empty($program_kode) && $this->Program_kegiatan_model->count_all(array('program_kegiatan.urusan' => $urusan_kode, 'program_kegiatan.program' => $program_kode)) > 0){
			echo '<label class="control-label" for="program_kode">Nama Kegiatan :</label>';
				combobox('db', $data_kegiatan, 'kegiatan_kode', 'kegiatan_kode', 'kegiatan_nama', '', '', 'Pilih Kegiatan', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
			echo '<label class="control-label" for="kegiatan">Nama Kegiatan :</label>
				<input type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="">';
		}
	}
	
	public function tampil_combobox_urusan_musrenbang() {
		$skpd_kode 		= $this->uri->segment(4);
		$data_urusan 	= $this->Indikator_skpd_model->grid_all('urusan.kode as urusan_kode, urusan.urusan as urusan_nama', 'urusan.urusan', 'ASC', '', '', array('skpd.skpd_kode' => $skpd_kode), '', 'urusan.kode');
		echo '<label class="control-label" for="urusan_kode">Urusan :</label>';
				combobox('db', $data_urusan, 'urusan_kode', 'urusan_kode', 'urusan_nama', '', 'show_form_program();', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required"');		
	}

	public function tampil_combobox_program_musrenbang() {
		$skpd_kode 		= $this->uri->segment(4);
		$urusan_kode	= $this->uri->segment(5);
		$data_program	= $this->Indikator_skpd_model->grid_all('program.kode as program_kode, program.program as program_nama', 'program.program', 'ASC', '', '', array('skpd.skpd_kode' => $skpd_kode, 'urusan.kode' => $urusan_kode), '', 'program.kode');
		if (!empty($urusan_kode) && !empty($skpd_kode)){
			echo '<label class="control-label" for="program_kode">Program :</label>';
				combobox('db', $data_program, 'program_kode', 'program_kode', 'program_nama', '', '', 'Pilih Program', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
			echo '<label class="control-label" for="program_kode">Program :</label>
				<select class="select2_category form-control" name="program_kode" id="program_kode" data-placeholder="Pilih Program" tabindex="1" required="required">
				</select>';
		}
	}
	
	public function tampil_combobox_tujuan_by_misi() {
		$misi_kode = $this->uri->segment(4);
		if ($misi_kode){
			$data_tujuan = $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC', '', '', array('tujuan.misi'=>$misi_kode));
			echo '<label class="control-label" for="tujuan_kode">Tujuan<span class="required">*</span> :</label>';
					combobox('db', $data_tujuan, 'tujuan_kode', 'kode', 'tujuan', '', 'show_form_sasaran_by_tujuan();', 'Pilih Tujuan', 'class="select2_category form-control" required="required"');
		} else {
			echo '<label class="control-label" for="tujuan_kode">Tujuan<span class="required">*</span> :</label>
					<select class="select2_category form-control" name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Tujuan" required="required">
					</select>';
		}
	}
	
	public function tampil_combobox_sasaran_by_tujuan() {
		$tujuan_kode = $this->uri->segment(4);
		if ($tujuan_kode){
			$data_sasaran = $this->Sasaran_model->grid_all('sasaran.kode, sasaran.sasaran', 'sasaran.sasaran', 'ASC', '', '', array('sasaran.tujuan'=>$tujuan_kode));
			echo '<label class="control-label" for="tujuan_kode">Sasaran<span class="required">*</span> :</label>';
					combobox('db', $data_sasaran, 'sasaran_kode', 'kode', 'sasaran', '', 'show_form_indikator_by_sasaran();', 'Pilih Sasaran', 'class="select2_category form-control" required="required"');
		} else {
			echo '<label class="control-label" for="tujuan_kode">Sasaran<span class="required">*</span> :</label>
					<select class="select2_category form-control" name="tujuan_kode" id="tujuan_kode" data-placeholder="Pilih Sasaran" required="required">
					</select>';
		}
	}
	
	public function tampil_combobox_indikator_by_sasaran() {
		$sasaran_kode = $this->uri->segment(4);
		if ($sasaran_kode){
			$data_indikator = $this->Indikator_model->grid_all('indikator.kode, indikator.indikator', 'indikator.indikator', 'ASC', '', '', array('indikator.sasaran'=>$sasaran_kode));
			echo '<label class="control-label" for="sasaran_kode">Indikator<span class="required">*</span> :</label>';
					combobox('db', $data_indikator, 'indikator_kode', 'kode', 'indikator', '', '', 'Pilih Indikator', 'class="select2_category form-control" required="required"');
		} else {
			echo '<label class="control-label" for="sasaran_kode">Indikator<span class="required">*</span> :</label>
					<select class="select2_category form-control" name="sasaran_kode" id="sasaran_kode" data-placeholder="Pilih Indikator" required="required">
					</select>';
		}
	}
	
	public function tampil_combobox_program_by_urusan() {
		$urusan_kode = $this->uri->segment(4);
		if ($urusan_kode){
			$data_program = $this->Program_model->grid_all('program.kode, program.program', 'program.program', 'ASC', '', '', array('program.urusan'=>$urusan_kode));
			echo '<label class="control-label" for="urusan_kode">Program<span class="required">*</span> :</label>';
					combobox('db', $data_program, 'program_kode', 'kode', 'program', '', '', 'Pilih Program', 'class="select2_category form-control" required="required"');
		} else {
			echo '<label class="control-label" for="urusan_kode">Program<span class="required">*</span> :</label>
					<select class="select2_category form-control" name="urusan_kode" id="urusan_kode" data-placeholder="Pilih Program" required="required">
					</select>';
		}
	}
	
}