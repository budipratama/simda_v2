<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rka extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Rup_model');
		$this->load->model('Rka_model');
		$this->load->model('Akun_model');
		$this->load->model('Kelompok_model');
		$this->load->model('Jenis_model');
		$this->load->model('Rincian_model');
		
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
				$where_misi										= "skpd.skpd_kode='".$skpd->skpd_kode."' OR tahapan.kode='16'";
				$container['content']['dataset']['tahapan']		= $this->Rup_model->grid_all('tahapan.kode, tahapan.nama', 'tahapan.nama', 'ASC', '', '', $where_misi, '', 'tahapan.kode');
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
	
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function v_22() {	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/rka/view_22';
		
		if ($admin_log['level_kode'] == 5 || $admin_log['level_kode'] == 4){
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
				$container['content']['dataset']['skpd_kode']	= $skpd->skpd_kode;
				$container['content']['dataset']['skpd_nama']	= $skpd->skpd_nama;
				$container['content']['dataset']['skpd_aktive']	= 'no';
				$where_misi										= "skpd.skpd_kode='".$skpd->skpd_kode."' OR tahapan.kode='16'";
				$container['content']['dataset']['tahapan']		= $this->Rup_model->grid_all('tahapan.kode, tahapan.nama', 'tahapan.nama', 'ASC', '', '', $where_misi, '', 'tahapan.kode');
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
	
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function preview_22() {	
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
	
	public function h_22() {	
		$tipe 		= $this->uri->segment(4);
		if ($tipe == 'excel'){
			$laporan['excel']		= TRUE;
		} else {
			$laporan['excel']		= FALSE;
		}
		$admin_log 		= $this->auth->is_login_admin();
		$sess_laporan 	= $this->session->userdata('is_sess_laporan');
		
		$laporan['laporan_skpd']		= $sess_laporan['laporan_skpd'];
		$laporan['laporan_program']		= $sess_laporan['laporan_program'];
		$laporan['laporan_kegiatan']	= $sess_laporan['laporan_kegiatan'];
		$laporan['laporan_tahapan']		= $sess_laporan['laporan_tahapan'];
		$laporan['laporan_belanja']		= $sess_laporan['laporan_belanja'];
		$laporan['laporan_tahun']		= $sess_laporan['laporan_tahun'];
		$laporan['laporan_tanggal']		= $sess_laporan['laporan_tanggal'];
		$laporan['laporan_pimpinan']	= $sess_laporan['laporan_pimpinan'];
		$laporan['laporan_pangkat']		= $sess_laporan['laporan_pangkat'];
		$laporan['laporan_nip']			= $sess_laporan['laporan_nip'];
		
		if ($laporan['laporan_skpd'] != 'semua'){
			$skpd	= $this->Skpd_model->get('skpd_kode, skpd_nama, skpd_status', array('skpd_kode' => $sess_laporan['laporan_skpd']));
			$laporan['skpd_kode']		= $skpd->skpd_kode;
			$laporan['skpd_nama']		= $skpd->skpd_nama;
			$laporan['skpd_status']		= $skpd->skpd_status;

		} else {
			$laporan['skpd_kode']		= 'semua';
			$laporan['skpd_nama']		= 'SATUAN KERJA PERANGKAT DAERAH';
			$laporan['skpd_status']		= 'SKPD/Kecamatan';
		}
		
		if ($laporan['laporan_program'] != 'semua'){
			$program = $this->Rup_model->get_laporan('program.kode, program.program, program.program', array('program.kode' => $sess_laporan['laporan_program']));
			$laporan['kode']			= $program->kode;
			$laporan['program']			= $program->program;
		} else {
			$laporan['kode']			= 'semua';
			$laporan['program']			= 'SATUAN KERJA PERANGKAT DAERAH';
		}
		
		if ($laporan['laporan_kegiatan'] != 'semua'){
			$kegiatan = $this->Rup_model->get_laporan('anggaran.kode, anggaran.kegiatan, anggaran.kegiatan', array('anggaran.kode' => $sess_laporan['laporan_kegiatan']));
			$laporan['kode']			= $kegiatan->kode;
			$laporan['kegiatan']		= $kegiatan->kegiatan;
		} else {
			$laporan['kode']			= 'semua';
			$laporan['skpd_nama']		= 'SATUAN KERJA PERANGKAT DAERAH';
		}
		
		if ($laporan['skpd_kode'] == 'semua'){
			$laporan['nama_skpd'] = $laporan['skpd_nama'];
		} else if ($laporan['skpd_status'] == 'Kecamatan'){
			$laporan['nama_skpd'] = $laporan['skpd_status'].' '.$laporan['skpd_nama'];
		} else {
			$laporan['nama_skpd'] = $laporan['skpd_nama'];
		}
		
		$laporan['jumlah_data']			= 1;
		
		if ($laporan['laporan_belanja'] == '1'){
			$this->load->view('laporan/rka/hasil_22', $laporan);
		} else {
			$this->load->view('laporan/rka/hasil_22_', $laporan);
		}
	} 
	
	public function v_221() {	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/rka/view_221';
		
		if ($admin_log['level_kode'] == 5 || $admin_log['level_kode'] == 4){
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
				$container['content']['dataset']['skpd_kode']	= $skpd->skpd_kode;
				$container['content']['dataset']['skpd_nama']	= $skpd->skpd_nama;
				$container['content']['dataset']['skpd_aktive']	= 'no';
				$where_misi										= "skpd.skpd_kode='".$skpd->skpd_kode."' OR tahapan.kode='16'";
				$container['content']['dataset']['tahapan']		= $this->Rup_model->grid_all('tahapan.kode, tahapan.nama', 'tahapan.nama', 'ASC', '', '', $where_misi, '', 'tahapan.kode');
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
	
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function preview_221() {	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/rka/preview_221';
		
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
			redirect('laporan/rka/preview_221', 'refresh');
		}
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function h_221() {	
		$tipe 		= $this->uri->segment(4);
		if ($tipe == 'excel'){
			$laporan['excel']		= TRUE;
		} else {
			$laporan['excel']		= FALSE;
		}
		$admin_log 		= $this->auth->is_login_admin();
		$sess_laporan 	= $this->session->userdata('is_sess_laporan');
		
		$laporan['laporan_skpd']		= $sess_laporan['laporan_skpd'];
		$laporan['laporan_program']		= $sess_laporan['laporan_program'];
		$laporan['laporan_kegiatan']	= $sess_laporan['laporan_kegiatan'];
		$laporan['laporan_tahapan']		= $sess_laporan['laporan_tahapan'];
		$laporan['laporan_belanja']		= $sess_laporan['laporan_belanja'];
		$laporan['laporan_tahun']		= $sess_laporan['laporan_tahun'];
		$laporan['laporan_tanggal']		= $sess_laporan['laporan_tanggal'];
		$laporan['laporan_pimpinan']	= $sess_laporan['laporan_pimpinan'];
		$laporan['laporan_pangkat']		= $sess_laporan['laporan_pangkat'];
		$laporan['laporan_nip']			= $sess_laporan['laporan_nip'];
		
		if ($laporan['laporan_skpd'] != 'semua'){
			$skpd	= $this->Skpd_model->get('skpd_kode, skpd_nama, skpd_status', array('skpd_kode' => $sess_laporan['laporan_skpd']));
			$laporan['skpd_kode']		= $skpd->skpd_kode;
			$laporan['skpd_nama']		= $skpd->skpd_nama;
			$laporan['skpd_status']		= $skpd->skpd_status;

		} else {
			$laporan['skpd_kode']		= 'semua';
			$laporan['skpd_nama']		= 'SATUAN KERJA PERANGKAT DAERAH';
			$laporan['skpd_status']		= 'SKPD/Kecamatan';
		}
		
		if ($laporan['laporan_program'] != 'semua'){
			$program = $this->Rup_model->get_laporan('program.kode, program.program, program.program', array('program.kode' => $sess_laporan['laporan_program']));
			$laporan['kode']			= $program->kode;
			$laporan['program']			= $program->program;
		} else {
			$laporan['kode']			= 'semua';
			$laporan['program']			= 'SATUAN KERJA PERANGKAT DAERAH';
		}
		
		if ($laporan['laporan_kegiatan'] != 'semua'){
			$kegiatan = $this->Rup_model->get_laporan('anggaran.kode, anggaran.kegiatan, anggaran.kegiatan', array('anggaran.kode' => $sess_laporan['laporan_kegiatan']));
			$laporan['kode']			= $kegiatan->kode;
			$laporan['kegiatan']		= $kegiatan->kegiatan;
		} else {
			$laporan['kode']			= 'semua';
			$laporan['skpd_nama']		= 'SATUAN KERJA PERANGKAT DAERAH';
		}
		
		if ($laporan['skpd_kode'] == 'semua'){
			$laporan['nama_skpd'] = $laporan['skpd_nama'];
		} else if ($laporan['skpd_status'] == 'Kecamatan'){
			$laporan['nama_skpd'] = $laporan['skpd_status'].' '.$laporan['skpd_nama'];
		} else {
			$laporan['nama_skpd'] = $laporan['skpd_nama'];
		}
		
		$laporan['jumlah_data']			= 1;
		
		if ($laporan['laporan_belanja'] == '1'){			
			if ($laporan['laporan_tahapan'] == '16'){
				$this->load->view('laporan/rka/hasil_221', $laporan);
			} else {
				$this->load->view('laporan/rka/hasilp_221', $laporan);
			}
		} else {
			$this->load->view('laporan/rka/hasil_221_', $laporan);
		}
	} 
	
	public function tampil_combobox_tahapan_by_skpd(){
		$skpd_kode 		= $this->uri->segment(4);
		$where_tahapan	= 'tahapan.kode IN (\'16\', \'17\')';
		$where 			= "skpd.skpd_kode='".$skpd_kode."' AND ".$where_tahapan."";
		$data_tahapan	= $this->Rup_model->grid_all('tahapan.kode, tahapan.nama', 'tahapan.nama', 'ASC', '', '', $where, '', 'tahapan.kode');
		combobox('db', $data_tahapan, 'kode_tahapan', 'kode', 'nama', '', 'show_form_belanja_by_tahapan();', 'Pilih ...', 'class="select2_category form-control" tabindex="1" required="required"');
	}
	
	public function tampil_combobox_belanja_by_tahapan(){
		$skpd_kode 		= $this->uri->segment(4);
		$kode_tahapan 	= $this->uri->segment(5);
		$where_bl		= "skpd.skpd_kode='".$skpd_kode."' AND tahapan.kode='16'";
		$where_btl		= "skpd.skpd_kode='".$skpd_kode."' AND tahapan.kode='17'";
		$data_bl		= $this->Rup_model->grid_all('tipe.tipe_kode, tipe.tipe_nama', 'tipe.tipe_nama', '', '', '', $where_bl, '', 'tipe.tipe_kode');
		$data_btl		= $this->Rup_model->grid_all('tipe.tipe_kode, tipe.tipe_nama', 'tipe.tipe_nama', '', '', '', $where_btl, '', 'tipe.tipe_kode');
		if (!empty($kode_tahapan == 16)){
			combobox('db', $data_bl, 'belanja_kode', 'tipe_kode', 'tipe_nama', '', 'show_form_tahun_by_belanja();', 'Pilih ...', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
			combobox('db', $data_btl, 'belanja_kode', 'tipe_kode', 'tipe_nama', '', 'show_form_tahun_by_belanja();', 'Pilih ...', 'class="select2_category form-control" tabindex="1" required="required"');		
		}
	}
	
	public function tampil_combobox_tahun_by_belanja(){
		$skpd_kode 		= $this->uri->segment(4);
		$belanja_kode 	= $this->uri->segment(5);
		$kode_tahapan 	= $this->uri->segment(6);
		$where_bl		= "skpd.skpd_kode='".$skpd_kode."' AND tipe.tipe_kode='".$belanja_kode."' AND tahapan.kode='16'";		
		$where_btl		= "skpd.skpd_kode='".$skpd_kode."' AND tipe.tipe_kode='".$belanja_kode."' AND tahapan.kode='17'";		
		$data_bl	= $this->Rup_model->grid_all('tahun.tahun, tahun.tahun', 'tahun.tahun', 'ASC', '', '', $where_bl, '', 'tahun.tahun');
		$data_btl	= $this->Rup_model->grid_all('tahun.tahun, tahun.tahun', 'tahun.tahun', 'ASC', '', '', $where_btl, '', 'tahun.tahun');
		if (!empty($kode_tahapan == 16)){
			combobox('db', $data_bl, 'tahun_kode', 'tahun', 'tahun', '', 'show_form_program_by_tahun();', 'Pilih ...', 'class="select2_category form-control" tabindex="1" required="required"');		
		} else {
			combobox('db', $data_btl, 'tahun_kode', 'tahun', 'tahun', '', 'show_form_program_by_tahun();', 'Pilih ...', 'class="select2_category form-control" tabindex="1" required="required"');		
		}
	}
	
	public function tampil_combobox_program_by_tahun(){
		$skpd_kode 		= $this->uri->segment(4);
		$tahun_kode 	= $this->uri->segment(5);
		$belanja_kode 	= $this->uri->segment(6);
		$kode_tahapan 	= $this->uri->segment(7);
		$where_bl		= "skpd.skpd_kode='".$skpd_kode."' AND tipe.tipe_kode='".$belanja_kode."' AND tahun.tahun='".$tahun_kode."' AND tahapan.kode='16'";
		$where_btl		= "skpd.skpd_kode='".$skpd_kode."' AND tipe.tipe_kode='".$belanja_kode."' AND tahun.tahun='".$tahun_kode."' AND tahapan.kode='17'";
		$data_bl		= $this->Rup_model->grid_all('program.kode, program.program', 'program.program', 'ASC', '', '', $where_bl, '', 'program.kode');
		$data_btl		= $this->Rup_model->grid_all('program.kode, program.program', 'program.program', 'ASC', '', '', $where_btl, '', 'program.kode');		
		if (!empty($kode_tahapan == 16)){
			combobox('db', $data_bl, 'program_kode', 'kode', 'program', '', 'show_form_kegiatan_by_program();', 'Semua Program', 'class="select2_category form-control" tabindex="1"');		
		} else {
			combobox('db', $data_btl, 'program_kode', 'kode', 'program', '', 'show_form_kegiatan_by_program();', 'Semua Program', 'class="select2_category form-control" tabindex="1"');		
		}
	}
	
	public function tampil_combobox_kegiatan_by_program(){
		$skpd_kode 		= $this->uri->segment(4);
		$program_kode 	= $this->uri->segment(5);
		$tahun_kode 	= $this->uri->segment(6);
		$belanja_kode 	= $this->uri->segment(7);
		$kode_tahapan 	= $this->uri->segment(8);
		$where_bl		= "skpd.skpd_kode='".$skpd_kode."' AND tipe.tipe_kode='".$belanja_kode."' AND tahun.tahun='".$tahun_kode."' AND program.kode='".$program_kode."' AND tahapan.kode='16'";
		$where_btl		= "skpd.skpd_kode='".$skpd_kode."' AND tipe.tipe_kode='".$belanja_kode."' AND tahun.tahun='".$tahun_kode."' AND program.kode='".$program_kode."' AND tahapan.kode='17'";
		$data_bl		= $this->Rup_model->grid_all('anggaran.kode, anggaran.kegiatan', 'anggaran.kegiatan', 'ASC', '', '', $where_bl, '', 'anggaran.kode');
		$data_btl		= $this->Rup_model->grid_all('anggaran.kode, anggaran.kegiatan', 'anggaran.kegiatan', 'ASC', '', '', $where_btl, '', 'anggaran.kode');
		if (!empty($kode_tahapan == 16)){
			combobox('db', $data_bl, 'kegiatan_kode', 'kode', 'kegiatan', '', '', 'Semua Kegiatan', 'class="select2_category form-control" tabindex="1"');		
		} else {
			combobox('db', $data_btl, 'kegiatan_kode', 'kode', 'kegiatan', '', '', 'Semua Kegiatan', 'class="select2_category form-control" tabindex="1"');		
		}
	}
	
}