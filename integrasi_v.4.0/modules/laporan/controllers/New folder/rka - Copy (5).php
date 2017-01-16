<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rka extends CI_Controller {
	
	public function __construct() {
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
			
		$where_tipe										= 'tipe.tipe_kode IN (\'1\')';
		$container['content']['dataset']['tipe']		= $this->Rup_model->get_bl('tipe.tipe_kode, tipe.tipe_nama', 'tipe.tipe_nama', '', '', '', $where_tipe, '', 'tipe.tipe_kode');
			
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
	
	public function tampil_combobox_tahapan_by_skpd(){
		$kode_skpd		= $this->uri->segment(4);
		$where 			= "tahapan.kode='16'";
		if ($kode_skpd){
			$data_kelompok = $this->Rup_model->get_bl('tahapan.kode, tahapan.nama', 'tahapan.nama', '', '', '', $where, '', 'tahapan.kode');
			combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'nama', '', 'show_form_tahapan_by_tipe();', 'Pilih Jenis Anggaran ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_tahapan_by_tipe(){
		$kode_tipe		= $this->uri->segment(4);
		$where 			= "tahapan.kode='16'";
		if ($kode_tipe){
			$data_kelompok = $this->Rup_model->get_bl('tipe.tipe_kode, tipe.tipe_nama', 'tipe.tipe_nama', '', '', '', $where, '', 'tipe.tipe_kode');
			combobox('db', $data_kelompok, 'bbb_kode', 'tipe_kode', 'tipe_nama', '', 'show_form_tipe_by_tahun();', 'Pilih Jenis Belanja ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_tipe_by_tahun(){
		$kode_tahun		= $this->uri->segment(4);
		$where 			= "tahapan.kode='16'";
		if ($kode_tahun){
			$data_kelompok = $this->Rup_model->get_bl('tahun.tahun, tahun.tahun', 'tahun.tahun', '', '', '', $where, '', 'tahun.tahun');
			combobox('db', $data_kelompok, 'bbb_kode', 'tahun', 'tahun', '', 'show_form_tahun_by_program();', 'Pilih Jenis Belanja ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_tahun_by_program(){
		$kode_tahun		= $this->uri->segment(4);
		$where 			= "anggaran.tahapan_kode='16'";
		if ($kode_tahun){
			$data_kelompok = $this->Rup_model->get_bl('program.kode, program.program', 'program.program', '', '', '', $where, '', 'program.kode');
			echo '<label class="control-label" for="lokasi_alamat">".$kode_tahun."</label>';
			combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'program', '', 'show_form_kegiatan_by_program();', 'Pilih Program ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_kegiatan_by_program(){
		$kelompok_kode 	= $this->uri->segment(4);		
		$query_data = mysql_query("SELECT anggaran.skpd_kode as id_skpd FROM anggaran INNER JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode WHERE anggaran.tahapan_kode= '16' AND anggaran_bl.program_kode='".$kelompok_kode."' ORDER BY anggaran.kode ASC"); 
		$data = mysql_fetch_array($query_data); $id_skpd = $data[id_skpd];
		$where 			= "anggaran.skpd_kode='".$id_skpd."' AND anggaran.tahapan_kode='16'";
		if ($kelompok_kode){
			$data_jenis = $this->Rup_model->get_bl('anggaran.kode, anggaran.kegiatan', 'anggaran.kegiatan', '', '', '', $where, array('anggaran_bl.program_kode'=>$kelompok_kode));
			combobox('db', $data_jenis, 'ccc_kode', 'kode', 'kegiatan', '', '', 'Pilih Kegiatan ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}

	
	
	
	
	
	
	
	
	
	
	
	public function tampil_combobox_skpd_by_laporan2(){
		$tipe_kode		= $this->uri->segment(4);
		$where			= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
		if ($tipe_kode){
			$data_kelompok = $this->Rup_model->get_bl('skpd.skpd_kode, skpd.skpd_nama', 'skpd.skpd_nama', '', '', '', $where, '', 'skpd.skpd_kode');
			combobox('db', $data_kelompok, 'bbb_kode', 'skpd_kode', 'skpd_nama', '', 'show_form_laporan2_by_tahun();', 'Pilih SKPD Pelaksana ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_laporan2_by_tahun(){
		$skpd_kode		= $this->uri->segment(4);
		$where 			= "anggaran.skpd_kode='".$skpd_kode."' ";
		if ($skpd_kode){
			$data_kelompok = $this->Rup_model->get_bl('tahun.tahun, tahun.tahun', 'tahun.tahun', '', '', '', $where1, array('anggaran.skpd_kode'=>$skpd_kode));
			combobox('db', $data_kelompok, 'tahun_kode', 'tahun', 'tahun', '', 'xxx();', 'Pilih Tahun Anggaran ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	
	
	
	
	
	
	
	public function tampil_combobox_program_by_skpd(){
		$skpd_kode		= $this->uri->segment(4);
		$where 			= "anggaran.skpd_kode='".$skpd_kode."' AND anggaran.tahapan_kode='16'";
		if ($skpd_kode){
			$data_kelompok = $this->Rup_model->get_bl('program.kode, program.program', 'program.program', '', '', '', $where, '', 'program.kode');
			combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'program', '', 'show_form_kegiatan_by_program();', 'Pilih Program ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}
	
	public function tampil_combobox_kegiatan_by_program1(){
		$kelompok_kode 	= $this->uri->segment(4);		
		$query_data = mysql_query("SELECT anggaran.skpd_kode as id_skpd FROM anggaran INNER JOIN anggaran_bl ON anggaran.kode=anggaran_bl.anggaran_kode WHERE anggaran.tahapan_kode= '16' AND anggaran_bl.program_kode='".$kelompok_kode."' ORDER BY anggaran.kode ASC"); 
		$data = mysql_fetch_array($query_data); $id_skpd = $data[id_skpd];
		$where 			= "anggaran.skpd_kode='".$id_skpd."' AND anggaran.tahapan_kode='16'";
		if ($kelompok_kode){
			$data_jenis = $this->Rup_model->get_bl('anggaran.kode, anggaran.kegiatan', 'anggaran.kegiatan', '', '', '', $where, array('anggaran_bl.program_kode'=>$kelompok_kode));
			combobox('db', $data_jenis, 'ccc_kode', 'kode', 'kegiatan', '', '', 'Pilih Kegiatan ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}

}