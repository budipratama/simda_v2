<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masyarakat extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Skpd_model');
		$this->load->model('Anggaran_model');
		$this->load->model('Tahun_model');
		$this->load->model('Usulan_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
	{
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		
        $tahun 		= $this->uri->segment(4);
		$skpd 		= $this->uri->segment(5);
		$kecamatan 	= $this->uri->segment(6);
		$deskel 	= $this->uri->segment(7);
		$key 		= str_replace("%20", " ", $this->uri->segment(8));
		
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
		$html  = '<center><a href="'. site_url('usulan/masyarakat/detail/'.$id) .'" class="btn default btn-sm purple" title="Detail"><i class="fa fa-file-text"></i></a>';
		
		return $html;
	}
		
	public function index()
	{	
		redirect('masyarakat/tatacara', 'refresh');
	}
	
	public function tatacara()
	{	
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 24;
		$container['content']['view']					= 'masyarakat/tatacara';
		$container['content']['dataset']['']			= '';

		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function form()
	{	
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 25;
		$container['content']['view']					= 'masyarakat/list';
		$container['content']['dataset']['']			= '';

		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function pengisian()
	{	
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_kode', 'SKPD Pelaksana', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('volume', 'Volume', 'trim|required|xss_clean');
		$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kecamatan_kode', 'Kecamatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('deskel_kode', 'Desa/Kecamatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 25;
			$container['content']['view']					= 'masyarakat/form';
						
			$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
			$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
			$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
			$container['content']['dataset']['skpd_']		= $this->uri->segment(4);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
			
		} else {
			$files 	= array();
			for($i=0;$i<6;$i++){
				$file	= $this->upload_file("photo".$i."", "./public/uploads/pictures/usulan_masyarakat/");
				if ($file){
					$files[] = $file;
				}
			}
			$file = implode(', ', $files);
			
			$insert['nama']				= $this->input->post('nama');
			$insert['instansi']			= $this->input->post('instansi');
			$insert['jabatan']			= $this->input->post('jabatan');
			$insert['alamat_pengusul']	= $this->input->post('alamat_pengusul');
			$insert['telepon']			= $this->input->post('telepon');
			$insert['tahun']			= $this->input->post('tahun');
			$insert['kegiatan']			= $this->input->post('kegiatan');
			$insert['volume']			= $this->input->post('volume');
			$insert['biaya']			= $this->input->post('biaya');
			$insert['kecamatan_kode']	= $this->input->post('kecamatan_kode');
			$insert['deskel_kode']		= $this->input->post('deskel_kode');
			$insert['rw']				= $this->input->post('rw');
			$insert['rt']				= $this->input->post('rt');
			$insert['alamat']			= $this->input->post('alamat');
			$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
			$insert['foto']				= $file;
			$insert['koordinat']		= $this->input->post('koordinat');
			$insert['catatan']			= $this->input->post('catatan');

			$this->Usulan_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data hasil musrenbang desa anggaran belanja tidak langsung telah berhasil ditambahkan.</div>');
			redirect('usulan/masyarakat/form/#successInsert', 'refresh');
		}
	}
	
	public function hasil()
	{	
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;

		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 26;
		$container['content']['view']					= 'masyarakat/hasil';
		
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
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;

		$tahun		= $this->input->post('tahun');
		$skpd		= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'skpd';
		$kecamatan	= ($this->input->post('kecamatan_kode'))?$this->input->post('kecamatan_kode'):'kecamatan';
		$deskel		= ($this->input->post('deskel_kode'))?$this->input->post('deskel_kode'):'deskel';
		$kegiatan	= $this->input->post('kegiatan');
		redirect('usulan/masyarakat/hasil-pencarian/'.$tahun.'/'.$skpd.'/'.$kecamatan.'/'.$deskel.'/'.$kegiatan);
	}
	
	public function hasil_pencarian()
	{
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;

		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 26;
		$container['content']['view']					= 'masyarakat/hasil';
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'SKPD'));
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
		$container['content']['dataset']['tahun_']		= $this->uri->segment(4);
		$container['content']['dataset']['skpd_']		= $this->uri->segment(5);
		$container['content']['dataset']['kecamatan_']	= $this->uri->segment(6);
		$where											= 'skpd_status IN (\'Desa\')';
		$like['skpd_kd']								= $this->uri->segment(5);
		$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
		$container['content']['dataset']['deskel_']		= $this->uri->segment(7);
		$container['content']['dataset']['kegiatan_']	= str_replace("%20", " ", $this->uri->segment(8));
		$container['content']['dataset']['formCari']	= 'off';
		$header['admin_log']							= $admin_log;
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

		$kode 											= $this->uri->segment(4);
		$usulan											= $this->Usulan_model->get('*, pelaksana.skpd_nama as nama_pelaksana, kecamatan.skpd_nama as nama_kecamatan, deskel.skpd_nama as nama_deskel', array('kode'=>$kode));
		
 		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 26;
		$container['content']['view']					= 'masyarakat/detail';
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
	
	public function peta()
	{	
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		$admin_log 					= ($this->session->userdata('is_logged_admin') == true)?$this->auth->is_login_admin():$admin_tamu;
		
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 27;
		$container['content']['view']					= 'masyarakat/peta';
		$container['content']['dataset']['usulan']		= $this->Usulan_model->grid_all('*, pelaksana.skpd_nama as nama_pelaksana, kecamatan.skpd_nama as nama_kecamatan, deskel.skpd_nama as nama_deskel', 'kode', 'ASC', 200, '', "koordinat != ''");

		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	function upload_file($file, $direktori)
	{
		$lokasi_file    = $_FILES[$file]['tmp_name'];
		$tipe_file      = $_FILES[$file]['type'];
		$nama_file      = $_FILES[$file]['name'];
		$desiredExt		= 'jpg';
		$fileNameNew 	= rand(333, 999) . time() . ".$desiredExt";
		
		// Apabila ada file yang diupload
		if (!empty($lokasi_file)){
			
			// Simpan gambar Asli
			move_uploaded_file($lokasi_file,$direktori . $fileNameNew);

			return $fileNameNew;
		} else {
			return "";
		}
	
	}
	
	public function tampil_combobox_deskel_by_kecamatan(){
		echo '<label class="control-label">Desa <span class="required">*</span> :</label>';
		$where											= 'skpd_status IN (\'Desa\')';
		$like['skpd_kd']								= $this->uri->segment(4);
		$data_skpd = $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
		combobox('db', $data_skpd, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Pilih Desa/Kelurahan', 'class="select2_category form-control"');
		
	}
}
