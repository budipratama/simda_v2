<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dprd extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Tahapan_model');
		$this->load->model('Skpd_model');
		$this->load->model('Anggaran_model');
		$this->load->model('Tahapan_skpd_model');
		$this->load->model('Kesepakatan_model');
		$this->load->model('Sifat_model');
		$this->load->library('Datatables');

	}
	
	function datatable()
	{
		$admin_log = $this->auth->is_login_admin();
        $tahapan 	= 13;
        $tahun 		= $this->uri->segment(4);
		$tipe 		= 2;
		$skpd 		= $this->uri->segment(5);
		$kecamatan 	= $this->uri->segment(6);
		$deskel 	= $this->uri->segment(7);
		$where_optional = "";
		if ($admin_log['level_kode'] == 1){	
			$where_optional .= "";
		} else if ($admin_log['level_kode'] == 5){
			$where_optional .= " anggaran.skpd_kode='".$admin_log['skpd_kode']."' AND ";
		} else {
			$where_optional .= " anggaran.admin_user='".$admin_log['username']."' AND ";
		}
		$key 		= str_replace("%20", " ", $this->uri->segment(8));
		
		if ($skpd == 'skpd' && $kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = $where_optional.' anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = $where_optional.' anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($skpd == 'skpd' && $deskel == 'deskel'){
			$where_datatable = $where_optional.' anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($deskel == 'deskel'){
			$where_datatable = $where_optional.' anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else {
			$where_datatable = $where_optional.' anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND anggaran.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.deskel_kode = \''.$deskel.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		}

		$this->datatables->select('nomor, anggaran.kode, anggaran.kegiatan, anggaran.alamat, skpd.skpd_nama, admin.admin_nama')
		->add_column('Actions', $this->get_buttons('$1'),'kode')
		->search_column('kegiatan, alamat, skpd_nama, admin_nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, anggaran.kode, anggaran.kegiatan, anggaran.alamat, anggaran.pelaksana_kode, anggaran.admin_user FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, anggaran WHERE ('.$where_datatable.') ORDER BY anggaran.kode DESC) anggaran LEFT JOIN skpd ON anggaran.pelaksana_kode=skpd.skpd_kode LEFT JOIN admin ON anggaran.admin_user=admin.admin_user');
		
        echo $this->datatables->generate();
    }
	
	function get_buttons($id)
	{
		$admin_log = $this->auth->is_login_admin();
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/detail/'.$id) .'" class="btn default btn-sm purple" title="Detail"><i class="fa fa-file-text"></i></a>';
		if ($admin_log['level_kode'] == 18 || $admin_log['level_kode'] == 1){
			$html .= '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/edit/'.$id) .'" class="btn default btn-sm yellow" title="Ubah"><i class="fa fa-pencil"></i></a>';
			$html .= '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/delete/'.$id) .'" class="btn default btn-sm red" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data rencana kerja ini.\');"><i class="fa fa-trash-o"></i></a>';
		}
		
		return $html;
	}
		
	public function index()
	{	
		redirect('usulan/dprd/tatacara', 'refresh');
	}
	
	public function tatacara()
	{	
		$admin_log 	= $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 29;
		$container['content']['view']					= 'dprd/tatacara';
		$container['content']['dataset']['']			= '';
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function form()
	{	
		$admin_log 	= $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 30;
		$container['content']['view']					= 'dprd/list';
		$container['content']['dataset']['']			= '';

		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function pengisian()
	{	
		$admin_log 		= $this->auth->is_login_admin();
		$tahun_anggaran	= date("Y") + 1;
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 30;
		$container['content']['view']					= 'dprd/form';
		$container['content']['dataset']['tahun_']		= $tahun_anggaran;
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
		$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));

		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert(){
		$admin_log 		= $this->auth->is_login_admin();
		
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
			$container['sidebar']['dataset']['aktive_menu'] = 3;
			$container['content']['view']					= 'usulan/dprd/form';
			$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
			$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
			$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
			$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
			$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
			
		} else {
			$insert['skpd_kode']		= $this->input->post('skpd_kode');
			$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
			$insert['tahun']			= $this->input->post('tahun');
			$insert['kegiatan']			= $this->input->post('kegiatan');
			$insert['lokasi_kode']		= $this->input->post('lokasi_kode');
			$insert['kecamatan_kode']	= $this->input->post('kecamatan_kode');
			$insert['deskel_kode']		= $this->input->post('deskel_kode');
			$insert['rw']				= $this->input->post('rw');
			$insert['rt']				= $this->input->post('rt');
			$insert['alamat']			= $this->input->post('alamat');
			$insert['foto']				= $this->input->post('foto');
			$insert['koordinat']		= $this->input->post('koordinat');
			$insert['catatan']			= $this->input->post('catatan');
			$insert['status']			= 1;
			$insert['proses_kode']		= 1;
			$insert['sumber_kode']		= 13;
			$insert['tahapan_kode']		= 13;
			$insert['tanggal']			= date("Y-m-d h:i:s");
			$insert['penambahan_kode']	= 1;
			$insert['admin_user']		= $admin_log['username'];
			$insert['tipe_kode']		= 2;
			$insert['proposal']			= ($this->input->post('proposal'))?'a':'t';
			$insert['verifikasi']		= ($this->input->post('verifikasi'))?'s':'b';
			$this->Anggaran_model->insert('anggaran', $insert); // Insert Anggaran
			
			//Insert Anggaran Belanja Langsung
			$anggaran = $this->Anggaran_model->get('2', 'anggaran.kode', array('anggaran.admin_user'=>$admin_log['username']));
			$insert_btl['anggaran_kode']	= $anggaran->kode;
			$insert_btl['volume']			= $this->input->post('volume');
			$insert_btl['biaya']			= $this->input->post('biaya');
			$this->Anggaran_model->insert('anggaran_btl', $insert_btl);
			
			redirect('usulan/dprd/form/#successInsert', 'refresh');
		}
	}
	
	public function hasil()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 31;
		$container['content']['view']					= 'usulan/dprd/view';
		if ($admin_log['level_kode'] == 5){
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
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'SKPD'));
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
		$admin_log 	= $this->auth->is_login_admin();
		$tahun		= $this->input->post('tahun');
		$tipe		= $this->input->post('tipe_kode');
		$skpd		= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'skpd';
		$kecamatan	= ($this->input->post('kecamatan_kode'))?$this->input->post('kecamatan_kode'):'kecamatan';
		$deskel		= ($this->input->post('deskel_kode'))?$this->input->post('deskel_kode'):'deskel';
		$kegiatan	= $this->input->post('kegiatan');
		redirect('usulan/dprd/hasil-pencarian/'.$tahun.'/'.$tipe.'/'.$skpd.'/'.$kecamatan.'/'.$deskel.'/'.$kegiatan);
	}
	
	public function hasil_pencarian()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 31;
		$container['content']['view']					= 'usulan/dprd/view';
		if ($admin_log['level_kode'] == 5){
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
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'SKPD'));
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
	
	public function detail()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));
		
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 31;

		$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.kode, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_btl.volume, anggaran_btl.biaya, anggaran_btl.penerima, pelaksana.skpd_nama', array('anggaran.kode'=>$kode));
		$container['content']['view']					= 'usulan/dprd/detail';
		$container['content']['dataset']['kode'] 		= $anggaran_btl->kode;
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
		$container['content']['dataset']['koordinat'] 	= $anggaran_btl->koordinat;
		$container['content']['dataset']['catatan'] 	= $anggaran_btl->catatan;

		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function transfer()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '6'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '6'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('usulan/dprd/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode, status', array('kode'=>$kode));
			
			if ($anggaran->status == 1){
				$container['sidebar']['view']						= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] 	= 31;
				$container['sidebar']['dataset']['admin_log'] 		= $admin_log;
				if ($anggaran->tipe_kode == 1){
				} else {
					$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.*, anggaran_btl.biaya, anggaran_btl.volume, , anggaran_btl.penerima', array('anggaran.kode'=>$kode));
					$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
					$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
					$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_btl->kecamatan_kode));

					$container['content']['view']					= 'usulan/dprd/transfer';
					$container['content']['dataset']['kode'] 		= $anggaran_btl->kode;
					$container['content']['dataset']['tahun_'] 		= $anggaran_btl->tahun;
					$container['content']['dataset']['skpd_'] 		= $anggaran_btl->pelaksana_kode;
					$container['content']['dataset']['kegiatan'] 	= $anggaran_btl->kegiatan;
					$container['content']['dataset']['biaya'] 		= $anggaran_btl->biaya;
					$container['content']['dataset']['volume'] 		= $anggaran_btl->volume;
					$container['content']['dataset']['penerima'] 	= $anggaran_btl->penerima;
					$container['content']['dataset']['alamat'] 		= $anggaran_btl->alamat;
					$container['content']['dataset']['rt'] 			= $anggaran_btl->rt;
					$container['content']['dataset']['rw'] 			= $anggaran_btl->rw;
					$container['content']['dataset']['deskel_'] 	= $anggaran_btl->deskel_kode;
					$container['content']['dataset']['kecamatan_'] 	= $anggaran_btl->kecamatan_kode;
					$container['content']['dataset']['proposal'] 	= ($anggaran_btl->proposal == 'a')?'checked':'';
					$container['content']['dataset']['verifikasi'] 	= ($anggaran_btl->verifikasi == 's')?'checked':'';
					$container['content']['dataset']['foto'] 		= $anggaran_btl->foto;
					$container['content']['dataset']['koordinat'] 	= $anggaran_btl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_btl->catatan;
				}
				$header['admin_log']								= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
			} else {
				redirect('usulan/dprd/#warningTransfer', 'refresh');
			}
		}
	}
	
	public function doTransfer(){
		$admin_log = $this->auth->is_login_admin();
		$type = $this->uri->segment(4);
		$kode = $this->uri->segment(5);
		if ($type == 'bl'){
		} else {
			$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|xss_clean');
			$this->form_validation->set_rules('skpd_kode', 'SKPD Pelaksana', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('volume', 'Volume', 'trim|required|xss_clean');
			$this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|xss_clean');
			$this->form_validation->set_rules('penerima', 'Calon Penerima', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kecamatan_kode', 'Kecamatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('deskel_kode', 'Desa/Kecamatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$container['sidebar']['view']						= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] 	= 31;
				$container['sidebar']['dataset']['admin_log'] 		= $admin_log;

				$anggaran_btl										= $this->Anggaran_model->get('2','anggaran.*, anggaran_btl.biaya, anggaran_btl.volume, , anggaran_btl.penerima', array('anggaran.kode'=>$kode));
				$container['content']['dataset']['tahun']			= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
				$container['content']['dataset']['skpd']			= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
				$container['content']['dataset']['kecamatan']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
				$container['content']['dataset']['deskel']			= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_btl->kecamatan_kode));
	
				$container['content']['view']						= 'usulan/dprd/transfer';
				$container['content']['dataset']['kode'] 			= $anggaran_btl->kode;
				$container['content']['dataset']['tahun_'] 			= $anggaran_btl->tahun;
				$container['content']['dataset']['skpd_'] 			= $anggaran_btl->pelaksana_kode;
				$container['content']['dataset']['kegiatan'] 		= $anggaran_btl->kegiatan;
				$container['content']['dataset']['biaya'] 			= $anggaran_btl->biaya;
				$container['content']['dataset']['volume'] 			= $anggaran_btl->volume;
				$container['content']['dataset']['penerima'] 		= $anggaran_btl->penerima;
				$container['content']['dataset']['alamat'] 			= $anggaran_btl->alamat;
				$container['content']['dataset']['rt'] 				= $anggaran_btl->rt;
				$container['content']['dataset']['rw'] 				= $anggaran_btl->rw;
				$container['content']['dataset']['deskel_'] 		= $anggaran_btl->deskel_kode;
				$container['content']['dataset']['kecamatan_'] 		= $anggaran_btl->kecamatan_kode;
				$container['content']['dataset']['proposal'] 		= ($anggaran_btl->proposal == 'a')?'checked':'';
				$container['content']['dataset']['verifikasi'] 		= ($anggaran_btl->verifikasi == 's')?'checked':'';
				$container['content']['dataset']['foto'] 			= $anggaran_btl->foto;
				$container['content']['dataset']['koordinat'] 		= $anggaran_btl->koordinat;
				$container['content']['dataset']['catatan'] 		= $anggaran_btl->catatan;
				
				$header['admin_log']								= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
				
			} else {
				$files 	= array();
				for($i=0;$i<6;$i++){
					$file	= $this->upload_file("photo".$i."", "./public/uploads/pictures/pokpir_dprd/");
					if ($file){
						$files[] = $file; 
					}
				}
				$file = implode(', ', $files);
				
				$skpd = $this->Skpd_model->get('skpd.skpd_kode', array('skpd.skpd_kd'=>$this->input->post('deskel_kode')));
				$insert['skpd_kode']		= $skpd->skpd_kode;
				$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
				$insert['tahun']			= $this->input->post('tahun');
				$insert['kegiatan']			= $this->input->post('kegiatan');
				$insert['lokasi_kode']		= $this->input->post('lokasi_kode');
				$insert['kecamatan_kode']	= $this->input->post('kecamatan_kode');
				$insert['deskel_kode']		= $this->input->post('deskel_kode');
				$insert['rw']				= $this->input->post('rw');
				$insert['rt']				= $this->input->post('rt');
				$insert['alamat']			= $this->input->post('alamat');
				$insert['foto']				= $file;
				$insert['koordinat']		= $this->input->post('koordinat');
				$insert['catatan']			= $this->input->post('catatan');
				$insert['status']			= 1;
				$insert['proses_kode']		= 1;
				$insert['sumber_kode']		= 2;
				$insert['sumber_id']		= $kode;
				$insert['tahapan_kode']		= 6;
				$insert['tanggal']			= date("Y-m-d h:i:s");
				$insert['penambahan_kode']	= 1;
				$insert['admin_user']		= $admin_log['username'];
				$insert['tipe_kode']		= 2;
				$insert['proposal']			= ($this->input->post('proposal'))?'a':'t';
				$insert['verifikasi']		= ($this->input->post('verifikasi'))?'s':'b';
				$this->Anggaran_model->insert('anggaran', $insert); // Insert Anggaran
				
				$this->Anggaran_model->update('anggaran', array('status'=>'2'), array('kode'=>$kode)); // Update Sumber Anggaran

				//Insert Anggaran Belanja Langsung
				$anggaran = $this->Anggaran_model->get('2', 'anggaran.kode', array('anggaran.admin_user'=>$admin_log['username']));
				$insert_btl['anggaran_kode']	= $anggaran->kode;
				$insert_btl['volume']			= $this->input->post('volume');
				$insert_btl['biaya']			= $this->input->post('biaya');
				$insert_btl['penerima']			= $this->input->post('penerima');
											
				$this->Anggaran_model->insert('anggaran_btl', $insert_btl);
				
				redirect('usulan/dprd/#successTransfer', 'refresh');
			}
		}
	}
	
	function upload_file($file, $direktori)
	{
		$lokasi_file    = $_FILES[$file]['tmp_name'];
		$tipe_file      = $_FILES[$file]['type'];
		$nama_file      = $_FILES[$file]['name'];
		
		// Apabila ada file yang diupload
		if (!empty($lokasi_file)){
			
			// Simpan gambar Asli
			move_uploaded_file($lokasi_file,$direktori . $nama_file);

			return $nama_file;
		} else {
			return "";
		}
	
	}
	
	public function tampil_combobox_deskel_by_kecamatan(){
		$admin_log 	= $this->auth->is_login_admin();
		$kode		= $this->uri->segment(4);
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
				</select>';
		}
	}
}
