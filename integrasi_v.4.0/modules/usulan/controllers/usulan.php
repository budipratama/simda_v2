<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usulan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Skpd_model');
		$this->load->model('Kesepakatan_model');
		$this->load->model('Sifat_model');
		$this->load->model('Lokasi_model');
		$this->load->model('Kecamatan_model');
		$this->load->model('Usulan_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
	{
		$admin_log = $this->auth->is_login_admin();
        $tahun 		= $this->uri->segment(3);
		$skpd 		= $this->uri->segment(4);
		$kecamatan 	= $this->uri->segment(5);
		$deskel 	= $this->uri->segment(6);
		$key 		= str_replace("%20", " ", $this->uri->segment(7));
		
		if ($skpd == 'skpd' && $kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = 'tahun = \''.$tahun.'\' AND kegiatan LIKE \'%'.$key.'%\'';
		} else if ($kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = 'tahun = \''.$tahun.'\' AND pelaksana_kode = \''.$skpd.'\' AND kegiatan LIKE \'%'.$key.'%\'';
		} else if ($skpd == 'skpd' && $deskel == 'deskel'){
			$where_datatable = 'tahun = \''.$tahun.'\' AND kecamatan_kode = \''.$kecamatan.'\' AND kegiatan LIKE \'%'.$key.'%\'';
		} else if ($deskel == 'deskel'){
			$where_datatable = 'tahun = \''.$tahun.'\' AND pelaksana_kode = \''.$skpd.'\' AND kecamatan_kode = \''.$kecamatan.'\' AND kegiatan LIKE \'%'.$key.'%\'';
		} else {
			$where_datatable = 'tahun = \''.$tahun.'\' AND pelaksana_kode = \''.$skpd.'\' AND kecamatan_kode = \''.$kecamatan.'\' AND deskel_kode = \''.$deskel.'\' AND kegiatan LIKE \'%'.$key.'%\'';
		}

		$this->datatables->select('nomor, kode, kegiatan, alamat, biaya, nama')
		->add_column('Actions', $this->get_button_detail('$1'),'kode')
		->search_column('kegiatan, alamat, biaya, nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, kode, kegiatan, alamat, biaya, nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, usulan WHERE ('.$where_datatable.') ORDER BY kode DESC) usulan');
		
        echo $this->datatables->generate();
    }
	
	function get_button_detail($id)
	{
		$html  = '<center><a href="'. site_url('usulan/detail/'.$id) .'" class="btn default btn-sm purple" title="Detail"><i class="fa fa-file-text"></i></a></center>';
		
		return $html;
	}
	
	public function index()
	{
		$admin_log = $this->auth->is_login_admin();
 		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 2;
		$container['content']['view']					= 'usulan/view';
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'SKPD'));
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
		$container['content']['dataset']['tahun_']		= '';
		$container['content']['dataset']['skpd_']		= '';
		$container['content']['dataset']['kecamatan_']	= '';
		$container['content']['dataset']['kegiatan_']	= '';
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function cari()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$tahun		= $this->input->post('tahun');
		$skpd		= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'skpd';
		$kecamatan	= ($this->input->post('kecamatan_kode'))?$this->input->post('kecamatan_kode'):'kecamatan';
		$deskel		= ($this->input->post('deskel_kode'))?$this->input->post('deskel_kode'):'deskel';
		$kegiatan	= $this->input->post('kegiatan');
		redirect('usulan/hasil-pencarian/'.$tahun.'/'.$skpd.'/'.$kecamatan.'/'.$deskel.'/'.$kegiatan);
	}
	
	public function hasil_pencarian()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 2;
		$container['content']['view']					= 'usulan/view';
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'SKPD'));
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
		$container['content']['dataset']['tahun_']		= $this->uri->segment(3);
		$container['content']['dataset']['skpd_']		= $this->uri->segment(4);
		$container['content']['dataset']['kecamatan_']	= $this->uri->segment(5);
		$where											= 'skpd_status IN (\'Desa\')';
		$like['skpd_kd']								= $this->uri->segment(4);
		$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
		$container['content']['dataset']['deskel_']		= $this->uri->segment(6);
		$container['content']['dataset']['kegiatan_']	= str_replace("%20", " ", $this->uri->segment(7));
		$container['content']['dataset']['formCari']	= 'off';
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$kode 											= $this->uri->segment(3);
		$usulan											= $this->Usulan_model->get('*, pelaksana.skpd_nama as nama_pelaksana, kecamatan.skpd_nama as nama_kecamatan, deskel.skpd_nama as nama_deskel', array('kode'=>$kode));
		
 		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 2;
		$container['content']['view']					= 'usulan/detail';
		$container['content']['dataset']				= '';
		$container['content']['dataset']['kode'] 			= $usulan->kode;
		$container['content']['dataset']['nama'] 			= $usulan->nama;
		$container['content']['dataset']['instansi'] 		= $usulan->instansi;
		$container['content']['dataset']['alamat_pengusul'] = $usulan->alamat_pengusul;
		$container['content']['dataset']['jabatan'] 		= $usulan->jabatan;
		$container['content']['dataset']['telepon'] 		= $usulan->telepon;
		$container['content']['dataset']['tahun'] 			= $usulan->tahun;
		$container['content']['dataset']['kegiatan'] 		= $usulan->kegiatan;
		$container['content']['dataset']['volume'] 			= $usulan->volume;
		$container['content']['dataset']['biaya'] 			= $usulan->biaya;
		$container['content']['dataset']['nama_kecamatan'] 	= $usulan->nama_kecamatan;
		$container['content']['dataset']['nama_deskel'] 	= $usulan->nama_deskel;
		$container['content']['dataset']['rw'] 				= $usulan->rw;
		$container['content']['dataset']['rt'] 				= $usulan->rt;
		$container['content']['dataset']['alamat'] 			= $usulan->alamat;
		$container['content']['dataset']['nama_pelaksana'] 	= $usulan->nama_pelaksana;
		$container['content']['dataset']['foto'] 			= explode(", ", $usulan->foto);
		$container['content']['dataset']['koordinat'] 		= $usulan->koordinat;
		$container['content']['dataset']['catatan'] 		= $usulan->catatan;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
}