<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Musrenbang_desa extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Skpd_model');
		$this->load->model('Visi_model');
		$this->load->model('Prioritas_model');
		$this->load->model('Kesepakatan_model');
		$this->load->model('Sifat_model');
		$this->load->model('Lokasi_model');
		$this->load->model('Kecamatan_model');
		$this->load->model('Indikator_skpd_model');
		$this->load->model('Anggaran_model');
		$this->load->model('Tahapan_model');
		$this->load->model('Tahapan_skpd_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
	{
        $tahapan 	= 2;
        $tahun 		= $this->uri->segment(4);
		$tipe 		= $this->uri->segment(5);
		$skpd 		= $this->uri->segment(6);
		$kecamatan 	= $this->uri->segment(7);
		$deskel 	= $this->uri->segment(8);
		$key 		= str_replace("%20", " ", $this->uri->segment(9));
		
		$like_kecamatan = "";
		if ($kecamatan != 'kecamatan'){
			$dsKecamatan = $this->Skpd_model->get('skpd_nama', array('skpd_kd'=>$kecamatan));
			$like_kecamatan = " anggaran.alamat LIKE '%KEC. " . $dsKecamatan->skpd_nama . "%'";
		}
		
		$like_deskel = "";
		if ($deskel != 'deskel'){
			$dsDeskel = $this->Skpd_model->get('skpd_nama', array('skpd_kd'=>$deskel));
			$like_deskel = " anggaran.alamat LIKE '%DESA/KEL. " . $dsDeskel->skpd_nama . "%'";
		}
		
		if ($skpd == 'skpd' && $kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($skpd == 'skpd' && $deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND ( anggaran.kecamatan_kode = \''.$kecamatan.'\' OR '.$like_kecamatan.' ) AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($skpd == 'skpd'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND ( anggaran.kecamatan_kode = \''.$kecamatan.'\' OR '.$like_kecamatan.' ) AND ( anggaran.deskel_kode = \''.$deskel.'\' OR '.$like_deskel.' ) AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND ( anggaran.kecamatan_kode = \''.$kecamatan.'\' OR '.$like_kecamatan.' ) AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else {
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND ( anggaran.kecamatan_kode = \''.$kecamatan.'\' OR '.$like_kecamatan.' ) AND ( anggaran.deskel_kode = \''.$deskel.'\' OR '.$like_deskel.' ) AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		}

		$this->datatables->select('nomor, anggaran.kode, anggaran.kegiatan, anggaran.alamat, skpd.skpd_nama, status.status_nama')
		->add_column('Actions', $this->get_buttons('$1'),'kode')
		->search_column('kegiatan, alamat, skpd_nama, status_nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, anggaran.kode, anggaran.kegiatan, anggaran.alamat, anggaran.pelaksana_kode, anggaran.status FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, anggaran WHERE ('.$where_datatable.') ORDER BY anggaran.kode DESC) anggaran LEFT JOIN skpd ON anggaran.pelaksana_kode=skpd.skpd_kode LEFT JOIN status ON anggaran.status=status.status_kode');
		
		
        echo $this->datatables->generate();
    }
	
	function get_buttons($id)
	{
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<center><a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/detail/'.$id) .'" class="btn default btn-sm purple btn-xs" title="Detail"><i class="fa fa-file-text"></i> View </a>';
		return $html;
	}	
	
	public function index()
	{
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		$header['admin_log']		= $admin_log;
		
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 41;
		$container['content']['view']					= 'eksekutif/musrenbang/desa/view';
		
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'SKPD'));
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
		$container['content']['dataset']['tahun_']		= '';
		$container['content']['dataset']['tipe_']		= '1';
		$container['content']['dataset']['skpd_']		= '';
		$container['content']['dataset']['kecamatan_']	= '';
		$container['content']['dataset']['deskel_']		= '';
		$container['content']['dataset']['kegiatan_']	= '';
		
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
		$header['admin_log']		= $admin_log;
		
		$tahun		= $this->input->post('tahun');
		$tipe		= $this->input->post('tipe_kode');
		$skpd		= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'skpd';
		$kecamatan	= ($this->input->post('kecamatan_kode'))?$this->input->post('kecamatan_kode'):'kecamatan';
		$deskel		= ($this->input->post('deskel_kode'))?$this->input->post('deskel_kode'):'deskel';
		$kegiatan	= $this->input->post('kegiatan');
		redirect('eksekutif/musrenbang-desa/hasil-pencarian/'.$tahun.'/'.$tipe.'/'.$skpd.'/'.$kecamatan.'/'.$deskel.'/'.$kegiatan);
	}
	
	public function hasil_pencarian()
	{
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		$header['admin_log']		= $admin_log;
		
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 41;
		$container['content']['view']					= 'eksekutif/musrenbang/desa/view';
		
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'SKPD'));
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
		$container['content']['dataset']['tahun_']		= $this->uri->segment(4);
		$container['content']['dataset']['tipe_']		= $this->uri->segment(5);
		$container['content']['dataset']['skpd_']		= $this->uri->segment(6);
		$container['content']['dataset']['kecamatan_']	= $this->uri->segment(7);
		
		$where											= 'skpd_status IN (\'Desa\')';
		$like['skpd_kd']								= $this->uri->segment(7);
		$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
		
		$container['content']['dataset']['deskel_']		= $this->uri->segment(8);
		$container['content']['dataset']['kegiatan_']	= str_replace("%20", " ", $this->uri->segment(9));
		$container['content']['dataset']['formCari']	= 'off';
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function detail()
	{
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		$header['admin_log']		= $admin_log;
		
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));
		
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 41;
		if ($anggaran->tipe_kode == 1){
			$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode, anggaran.nomor, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.file, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, urusan.urusan as urusan_nama, program.program as program_nama', array('anggaran.kode'=>$kode));
			$container['content']['view']					= 'eksekutif/musrenbang/desa/detail';
			$container['content']['dataset']['kode'] 		= $anggaran_bl->kode;
			$container['content']['dataset']['nomor'] 		= intval(substr($anggaran_bl->nomor, -5));
			$container['content']['dataset']['nomor_'] 		= $anggaran_bl->nomor;
			$container['content']['dataset']['tahun'] 		= $anggaran_bl->tahun;
			$container['content']['dataset']['skpd'] 		= $anggaran_bl->skpd_nama;
			$container['content']['dataset']['kegiatan'] 	= $anggaran_bl->kegiatan;
			$container['content']['dataset']['jenis_kegiatan'] = $anggaran_bl->sifat_nama;
			$container['content']['dataset']['kesepakatan'] = $anggaran_bl->kesepakatan_nama;
			$container['content']['dataset']['urutan'] 		= $anggaran_bl->urutan;
			$container['content']['dataset']['biaya'] 		= $anggaran_bl->apbd_kab;
			$container['content']['dataset']['hk_ukur'] 	= $anggaran_bl->hk_ukur;
			$container['content']['dataset']['hk_target'] 	= $anggaran_bl->hk_target;
			$container['content']['dataset']['hk_satuan'] 	= $anggaran_bl->hk_satuan;
			$container['content']['dataset']['alamat'] 		= $anggaran_bl->alamat;
			$container['content']['dataset']['rt'] 			= $anggaran_bl->rt;
			$container['content']['dataset']['rw'] 			= $anggaran_bl->rw;
			$container['content']['dataset']['deskel'] 		= $anggaran_bl->deskel_nama;
			$container['content']['dataset']['kecamatan'] 	= $anggaran_bl->kecamatan_nama;
			$container['content']['dataset']['proposal'] 	= ($anggaran_bl->proposal == 'a')?'checked':'';
			$container['content']['dataset']['verifikasi'] 	= ($anggaran_bl->verifikasi == 's')?'checked':'';
			$container['content']['dataset']['foto'] 		= $anggaran_bl->foto;
			$container['content']['dataset']['file'] 		= $anggaran_bl->file;
			$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
			$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
		} else {
			$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.kode, anggaran.nomor, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.file, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_btl.volume, anggaran_btl.biaya, anggaran_btl.penerima, pelaksana.skpd_nama', array('anggaran.kode'=>$kode));
			$container['content']['view']					= 'eksekutif/musrenbang/desa/detail_btl';
			$container['content']['dataset']['kode'] 		= $anggaran_btl->kode;
			$container['content']['dataset']['nomor'] 		= intval(substr($anggaran_btl->nomor, -5));
			$container['content']['dataset']['tahun'] 		= $anggaran_btl->tahun;
			$container['content']['dataset']['skpd'] 		= $anggaran_btl->skpd_nama;
			$container['content']['dataset']['kegiatan'] 	= $anggaran_btl->kegiatan;
			$container['content']['dataset']['biaya'] 		= $anggaran_btl->biaya;
			$container['content']['dataset']['volume'] 		= $anggaran_btl->volume;
			$container['content']['dataset']['penerima'] 	= $anggaran_btl->penerima;
			$container['content']['dataset']['alamat'] 		= $anggaran_btl->alamat;
			$container['content']['dataset']['rt'] 			= $anggaran_btl->rt;
			$container['content']['dataset']['rw'] 			= $anggaran_btl->rw;
			$container['content']['dataset']['deskel'] 		= $anggaran_btl->deskel_nama;
			$container['content']['dataset']['kecamatan'] 	= $anggaran_btl->kecamatan_nama;
			$container['content']['dataset']['proposal'] 	= ($anggaran_btl->proposal == 'a')?'checked':'';
			$container['content']['dataset']['verifikasi'] 	= ($anggaran_btl->verifikasi == 's')?'checked':'';
			$container['content']['dataset']['foto'] 		= $anggaran_btl->foto;
			$container['content']['dataset']['file'] 		= $anggaran_btl->file;
			$container['content']['dataset']['koordinat'] 	= $anggaran_btl->koordinat;
			$container['content']['dataset']['catatan'] 	= $anggaran_btl->catatan;
		}
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function tampil_combobox_deskel_by_kecamatan(){
		$kode		= $this->uri->segment(4);
		if ($kode){
			echo '<label class="control-label col-md-3">Desa</label>';
			echo '<div class="col-md-9">';
			$where											= 'skpd_status IN (\'Desa\')';
			$like['skpd_kd']								= $kode;
			$data_skpd = $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
			combobox('db', $data_skpd, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Semua Desa', 'class="select2_category form-control"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-3" for="deskel_kode">Desa</label>
				<div class="col-md-9">
					<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
					<option value="">Semua Desa</option>
					</select>
				</div>';
		}
	}
	
	public function previewfile(){
		$kode = $this->uri->segment(4);
		$anggaran_ = $this->Anggaran_model->getOnly('anggaran.file', array('anggaran.kode'=>$kode));
		if ($anggaran_->file != ""){
			echo '<iframe src="https://docs.google.com/gview?url='.base_url('public/uploads/documents/musrenbang_desa/'.$anggaran_->file).'&embedded=true" width="100%" height="100%" style="border: none;"></iframe>';
		} else {
			echo 'Tidak ada file';
		}
	}
}