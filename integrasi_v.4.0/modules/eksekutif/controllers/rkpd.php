<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rkpd extends CI_Controller {
	
	public function __construct()
	{
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
	
	function datatable()
	{
        $tahapan 	= 9;
        $tahun 		= $this->uri->segment(4);
		$tipe 		= $this->uri->segment(5);
		$skpd 		= $this->uri->segment(6);
		$kecamatan 	= $this->uri->segment(7);
		$deskel 	= $this->uri->segment(8);
		$key 		= str_replace("%20", " ", $this->uri->segment(9));
	
		if ($skpd == 'skpd' && $kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($skpd == 'skpd' && $deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else {
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.deskel_kode = \''.$deskel.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		}

		$this->datatables->select('nomor, anggaran.kode, anggaran.kegiatan, anggaran.alamat, skpd.skpd_nama, sumber.sumber_nama, status.status_nama')
		->search_column('kegiatan, alamat, skpd_nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, anggaran.kode, anggaran.kegiatan, anggaran.alamat, anggaran.pelaksana_kode, anggaran.status, anggaran.sumber_kode FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, anggaran WHERE ('.$where_datatable.') ORDER BY anggaran.kode DESC) anggaran LEFT JOIN skpd ON anggaran.pelaksana_kode=skpd.skpd_kode LEFT JOIN status ON anggaran.status=status.status_kode LEFT JOIN sumber ON anggaran.sumber_kode=sumber.sumber_kode');
		
        echo $this->datatables->generate();
    }
	
	public function index()
	{
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 37;
		$container['content']['view']					= 'eksekutif/rkpd/view';
		$container['content']['dataset']['skpd_aktive']	= 'yes';
		$container['content']['dataset']['kecamatan_aktive']= 'yes';
		
		
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$where_skpd										= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
		$container['content']['dataset']['tahun_']		= '';
		$container['content']['dataset']['tipe_']		= '1';
		$container['content']['dataset']['skpd_']		= '';
		$container['content']['dataset']['kecamatan_']	= '';
		$container['content']['dataset']['deskel_']		= '';
		$container['content']['dataset']['kegiatan_']	= '';
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function cari()
	{
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		$tahun		= $this->input->post('tahun');
		$tipe		= $this->input->post('tipe_kode');
		$skpd		= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'skpd';
		$kecamatan	= ($this->input->post('kecamatan_kode'))?$this->input->post('kecamatan_kode'):'kecamatan';
		$deskel		= ($this->input->post('deskel_kode'))?$this->input->post('deskel_kode'):'deskel';
		$kegiatan	= $this->input->post('kegiatan');
		redirect('eksekutif/rkpd/hasil-pencarian/'.$tahun.'/'.$tipe.'/'.$skpd.'/'.$kecamatan.'/'.$deskel.'/'.$kegiatan);
	}
	
	public function hasil_pencarian()
	{
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 37;
		$container['content']['view']					= 'eksekutif/rkpd/view';
		$container['content']['dataset']['skpd_aktive']	= 'yes';
		$container['content']['dataset']['kecamatan_aktive']= 'yes';
		
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$where_skpd										= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
		$container['content']['dataset']['tahun_']		= $this->uri->segment(4);
		$container['content']['dataset']['tipe_']		= $this->uri->segment(5);
		$container['content']['dataset']['skpd_']		= $this->uri->segment(6);
		$container['content']['dataset']['kecamatan_']	= $this->uri->segment(7);
		$where											= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
		$like['skpd_kd']								= $this->uri->segment(7);
		$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
		$container['content']['dataset']['deskel_']		= $this->uri->segment(8);
		$container['content']['dataset']['kegiatan_']	= str_replace("%20", " ", $this->uri->segment(9));
		$container['content']['dataset']['formCari']	= 'off';
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function tampil_combobox_deskel_by_kecamatan(){
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
}