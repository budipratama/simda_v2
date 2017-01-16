<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kecamatan extends CI_Controller {
	
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
		$this->load->model('Anggaran_Rutin_model');
		$this->load->model('Tahapan_model');
		$this->load->model('Tahapan_skpd_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
	{
		$admin_log = $this->auth->is_login_admin();
        $tahapan 	= 4;
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
		$admin_log = $this->auth->is_login_admin();
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/detail/'.$id) .'" class="btn default btn-sm purple" title="Detail"><i class="fa fa-file-text"></i></a>';
		if ($admin_log['level_kode'] == 4 || $admin_log['level_kode'] == 1){
			$html .= '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/edit/'.$id) .'" class="btn default btn-sm yellow" title="Ubah"><i class="fa fa-pencil"></i></a>';
			$html .= '<a href="'. site_url($ci->uri->segment(1) . '/' . $ci->uri->segment(2) . '/delete/'.$id) .'" class="btn default btn-sm red" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data rencana kerja ini.\');"><i class="fa fa-trash-o"></i></a>';
		}
		
		return $html;
	}
	
	public function index()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 5;
		$container['content']['view']					= 'musrenbang/kecamatan/view';
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
		
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
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
		redirect('musrenbang/kecamatan/hasil-pencarian/'.$tahun.'/'.$tipe.'/'.$skpd.'/'.$kecamatan.'/'.$deskel.'/'.$kegiatan);
	}
	
	public function hasil_pencarian()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 5;
		$container['content']['view']					= 'musrenbang/kecamatan/view';
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
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
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
	
	public function sync()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 5;
		$container['content']['view']					= 'musrenbang/kecamatan/sync';
		
		if ($admin_log['level_kode'] == 4){
			$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
			$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kd' => substr($deskel->skpd_kd, 0, 6)));
			$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
			$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
			$container['content']['dataset']['kecamatan_aktive']= 'no';
		} else {
			$container['content']['dataset']['kecamatan_aktive']= 'yes';
		}
		
		if ($admin_log['level_kode'] == 5){
			$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '6'));
			$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '6'));
		} else {
			$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '4'));
			$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '4'));
		}
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			$container['content']['dataset']['jenis']		= array('4'=>'Export Data');
		} else {
			if ($admin_log['level_kode'] == 4){
				$container['content']['dataset']['jenis']		= array('3'=>'Import Data', '4'=>'Export Data');
			} else {
				$container['content']['dataset']['jenis']		= array('3'=>'Import Data', '4'=>'Export Data');
			}
		}
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));			
		
		$container['content']['dataset']['jenis_']		= $this->uri->segment(4);
		$container['content']['dataset']['tahun_']		= $this->uri->segment(5);
		$container['content']['dataset']['tipe_']		= $this->uri->segment(6);
		$container['content']['dataset']['kecamatan_']	= $this->uri->segment(7);
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function sync_process()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$jenis_		= $this->input->post('jenis');
		$tahun_		= $this->input->post('tahun');
		$tipe_		= $this->input->post('tipe');
		$kecamatan_	= $this->input->post('kecamatan_kode');
		redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_);
	}
	
	public function sync_preview()
	{
		$admin_log = $this->auth->is_login_admin();
		if ($admin_log['level_kode'] == 5){
			$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '6'));
			$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '6'));
		} else {
			$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '4'));
			$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '4'));
		}
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1 && $this->uri->segment(4) != 4){
			redirect('musrenbang/kecamatan/#warningEntri', 'refresh');
		} else {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 5;
			$container['content']['view']					= 'musrenbang/kecamatan/sync';
			
			if ($admin_log['level_kode'] == 4){
				$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kd' => substr($deskel->skpd_kd, 0, 6)));
				$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
				$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
				$container['content']['dataset']['kecamatan_aktive']= 'no';
			} else {
				$container['content']['dataset']['kecamatan_aktive']= 'yes';
			}
			
			if ($admin_log['level_kode'] == 5){
				$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '6'));
				$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '6'));
			} else {
				$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '4'));
				$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '4'));
			}
			$waktuSekarang = date("Y-m-d H:i:s");
			if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
				$container['content']['dataset']['jenis']		= array('4'=>'Export Data');
			} else {
				if ($admin_log['level_kode'] == 4){
					$container['content']['dataset']['jenis']		= array('3'=>'Import Data', '4'=>'Export Data');
				} else {
					$container['content']['dataset']['jenis']		= array('3'=>'Import Data', '4'=>'Export Data');
				}
			}
			$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
			
			$jenis_		= $this->uri->segment(4);
			$tahun_		= $this->uri->segment(5);
			$tipe_		= $this->uri->segment(6);
			$tipe_nama	= ($this->uri->segment(6) == 1)?'Belanja Langsung':'Belanja Tidak Langsung';
			$kecamatan_	= $this->uri->segment(7);
			
			if ($admin_log['level_kode'] == 4){
				$kecamatan_kode	= $admin_log['skpd_kode'];
			} else {
				$skpd 			= $this->Skpd_model->get('skpd_kode', array('skpd_kd' => $kecamatan_));
				$kecamatan_kode	= $skpd->skpd_kode;
			}
			
			$container['content']['dataset']['jenis_']		= $jenis_;
			$container['content']['dataset']['tahun_']		= $tahun_;
			$container['content']['dataset']['tipe_']		= $tipe_;
			$container['content']['dataset']['tipe_nama']	= $tipe_nama;
			$container['content']['dataset']['kecamatan_']	= $kecamatan_;
			
			if ($jenis_ == 1){
				if (get_server_status(parseurl($this->config->item('api_url')))){
					$container['content']['dataset']['connection_status']	= true;
					$container['content']['dataset']['jumlah_data']			= 0;
					
					$this->rest->initialize(array('server' => $this->config->item('api_url')));
					$get_key = $this->rest->post('auth/damel-keys', array('username'=>$admin_log['username'], 'skpd'=>$kecamatan_kode));
					if ($get_key){
						$key = $get_key->data->key_value;
						$name = $this->config->item('api_name');
						
						$this->rest->api_key($key, $name); 
						$count_musrenbang = $this->rest->get('musrenbang_kecamatan/count/'.$tahun_.'/'.$tipe_);
						if ($count_musrenbang->success === true){
							$container['content']['dataset']['jumlah_data']	= $count_musrenbang->data;
							
							$this->rest->api_key($key, $name); 
							$grid_musrenbang = $this->rest->get('musrenbang_kecamatan/grid/'.$tahun_.'/'.$tipe_);
							$sama 				= 0;
							$grid_musrenbang_ 	= new stdClass();
							$grid_sumber_ 		= new stdClass();
							if ($grid_musrenbang->success === true){
								$container['content']['dataset']['grid_musrenbang']		= $grid_musrenbang->data;
								foreach($grid_musrenbang->data as $row_musrenbang){
									if ($this->Anggaran_model->count_all(array('nomor'=>$row_musrenbang->nomor)) > 0){
										$sama++;
										$nomor = $row_musrenbang->nomor;
										$grid_musrenbang_->$nomor	= $this->Anggaran_model->getOnly("*", array('nomor'=>$row_musrenbang->nomor));
									}
									
									if ($row_musrenbang->sumber_nomor){	
										if ($this->Anggaran_model->count_all(array('nomor'=>$row_musrenbang->sumber_nomor, 'status'=>'2')) > 0){
											$nomor = $row_musrenbang->nomor;
											$grid_sumber_->$nomor	= $this->Anggaran_model->getOnly("*", array('nomor'=>$row_musrenbang->nomor));
										}
									}
								}
							}
							$container['content']['dataset']['grid_musrenbang_']	= $grid_musrenbang_;
							$container['content']['dataset']['grid_sumber_']		= $grid_sumber_;
							$container['content']['dataset']['jumlah_sama']			= $sama;
						}
						
						$this->rest->post('auth/hapus-keys', array('keys'=>$key));
					}
				} else {
					$container['content']['dataset']['connection_status']	= false;
				}
			} else if ($jenis_ == 2){
				if (get_server_status(parseurl($this->config->item('api_url')))){
					$container['content']['dataset']['connection_status']	= true;
					$container['content']['dataset']['jumlah_data']			= 0;
					
					$this->rest->initialize(array('server' => $this->config->item('api_url')));
					$get_key = $this->rest->post('auth/damel-keys', array('username'=>$admin_log['username'], 'skpd'=>$kecamatan_kode));
					if ($get_key){
						$key = $get_key->data->key_value;
						$name = $this->config->item('api_name');
						
						$count_musrenbang = $this->Anggaran_model->count_all(array('anggaran.skpd_kode'=>$kecamatan_kode, 'anggaran.tahun'=>$tahun_, 'anggaran.tipe_kode'=>$tipe_));
						if ($count_musrenbang > 0){
							$container['content']['dataset']['jumlah_data']	= $count_musrenbang;
							
							$grid_musrenbang = $this->Anggaran_model->grid_all($tipe_, 'anggaran.*', 'anggaran.kode', 'ASC', 0, 0, array('anggaran.skpd_kode'=>$kecamatan_kode, 'anggaran.tahun'=>$tahun_, 'anggaran.tipe_kode'=>$tipe_));
							$container['content']['dataset']['grid_musrenbang']		= $grid_musrenbang;
							$sama 				= 0;
							$grid_musrenbang_ 	= new stdClass();
							$grid_sumber_	 	= new stdClass();
							if ($grid_musrenbang){
								foreach($grid_musrenbang as $row_musrenbang){
									$this->rest->api_key($key, $name); 
									$get_musrenbang = $this->rest->get('musrenbang_kecamatan/get/'.$row_musrenbang->nomor);
									if ($get_musrenbang->success === true){
										$sama++;
										$nomor = $row_musrenbang->nomor;
										$grid_musrenbang_->$nomor	= $get_musrenbang->data;
									}
									
									if ($row_musrenbang->sumber_nomor){										
										$this->rest->api_key($key, $name);
										$get_sumber = $this->rest->get('musrenbang_kecamatan/get/'.$row_musrenbang->sumber_nomor);
										if ($get_sumber->success === true){
											if ($get_sumber->data->status == '2'){
												$nomor = $row_musrenbang->nomor;
												$grid_sumber_->$nomor	= $get_sumber->data;
											}
										}
									}
								}
							}
							$container['content']['dataset']['grid_musrenbang_']	= $grid_musrenbang_;
							$container['content']['dataset']['grid_sumber_']		= $grid_sumber_;
							$container['content']['dataset']['jumlah_sama']			= $sama;
						}
						
						$this->rest->post('auth/hapus-keys', array('keys'=>$key));
					}
				} else {
					$container['content']['dataset']['connection_status']	= true;
				}
			} else if ($jenis_ == 3){
				$container['content']['dataset']['jumlah_data'] = 0;
				if ($this->input->post('import_data')){
					$uploaddir = './public/uploads/temp/';
					$filename = $_FILES['userfile']['name'];
					$container['content']['dataset']['filename'] = $filename;
					if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$filename)) {
						$fp 		= fopen($uploaddir.$filename, 'rb');
						$i 			= 1;
						$tmp_column	= "";
						$tmp_grid 	= array();
						while ( ($line = fgets($fp)) !== false) {
							if ($i == 1){
								$tmp_column = explode(",", $this->encryption->decode($line));
							} else {
								$tmp_grid[$i] = explode(",", $this->encryption->decode($line));
							}
							$i++;
						}
						
						if (count($tmp_column) > 0){
							if (isset($tmp_column[0])){
								if ($tmp_column[0] == 'kode'){
									if (count($tmp_grid) > 0){
										$container['content']['dataset']['jumlah_data'] = count($tmp_grid);
										$grid_musrenbang_tmp = array();
										$i = 0;
										foreach($tmp_grid as $row_grid){
											if ($row_grid[2] == $kecamatan_kode){
												$grid_musrenbang_tmp[$i]['kode']					= $row_grid[0];
												$grid_musrenbang_tmp[$i]['nomor']					= $row_grid[1];
												$grid_musrenbang_tmp[$i]['skpd_kode']				= $row_grid[2];
												$grid_musrenbang_tmp[$i]['pelaksana_kode']			= $row_grid[3];
												$grid_musrenbang_tmp[$i]['tahun']					= $row_grid[4];
												$grid_musrenbang_tmp[$i]['kegiatan']				= $row_grid[5];
												$grid_musrenbang_tmp[$i]['lokasi_kode']				= $row_grid[6];
												$grid_musrenbang_tmp[$i]['kecamatan_kode']			= $row_grid[7];
												$grid_musrenbang_tmp[$i]['deskel_kode']				= $row_grid[8];
												$grid_musrenbang_tmp[$i]['rw']						= $row_grid[9];
												$grid_musrenbang_tmp[$i]['rt']						= $row_grid[10];
												$grid_musrenbang_tmp[$i]['alamat']					= $row_grid[11];
												$grid_musrenbang_tmp[$i]['foto']					= $row_grid[12];
												$grid_musrenbang_tmp[$i]['file']					= $row_grid[13];
												$grid_musrenbang_tmp[$i]['koordinat']				= $row_grid[14];
												$grid_musrenbang_tmp[$i]['catatan']					= $row_grid[15];
												$grid_musrenbang_tmp[$i]['status']					= $row_grid[16];
												$grid_musrenbang_tmp[$i]['proses_kode']				= $row_grid[17];
												$grid_musrenbang_tmp[$i]['sumber_kode']				= $row_grid[18];
												$grid_musrenbang_tmp[$i]['sumber_id']				= $row_grid[19];
												$grid_musrenbang_tmp[$i]['sumber_nomor']			= $row_grid[20];
												$grid_musrenbang_tmp[$i]['tahapan_kode']			= $row_grid[21];
												$grid_musrenbang_tmp[$i]['tanggal']					= $row_grid[22];
												$grid_musrenbang_tmp[$i]['penambahan_kode']			= $row_grid[23];
												$grid_musrenbang_tmp[$i]['perubahan_id']			= $row_grid[24];
												$grid_musrenbang_tmp[$i]['perubahan_status_kode']	= $row_grid[25];
												$grid_musrenbang_tmp[$i]['admin_user']				= $row_grid[26];
												$grid_musrenbang_tmp[$i]['tipe_kode']				= $row_grid[27];
												$grid_musrenbang_tmp[$i]['proposal']				= $row_grid[28];
												$grid_musrenbang_tmp[$i]['verifikasi']				= $row_grid[29];
												$grid_musrenbang_tmp[$i]['anggaran_kode']			= $row_grid[30];
												$grid_musrenbang_tmp[$i]['visi_kode']				= $row_grid[31];
												$grid_musrenbang_tmp[$i]['misi_kode']				= $row_grid[32];
												$grid_musrenbang_tmp[$i]['prioritas_kode']			= $row_grid[33];
												$grid_musrenbang_tmp[$i]['tujuan_kode']				= $row_grid[34];
												$grid_musrenbang_tmp[$i]['sasaran_kode']			= $row_grid[35];
												$grid_musrenbang_tmp[$i]['indikator_kode']			= $row_grid[36];
												$grid_musrenbang_tmp[$i]['urusan_kode']				= $row_grid[37];
												$grid_musrenbang_tmp[$i]['program_kode']			= $row_grid[38];
												$grid_musrenbang_tmp[$i]['sifat_kode']				= $row_grid[39];
												$grid_musrenbang_tmp[$i]['kesepakatan_kode']		= $row_grid[40];
												$grid_musrenbang_tmp[$i]['urutan']					= $row_grid[41];
												$grid_musrenbang_tmp[$i]['hp_ukur']					= $row_grid[42];
												$grid_musrenbang_tmp[$i]['hp_target']				= $row_grid[43];
												$grid_musrenbang_tmp[$i]['hp_satuan']				= $row_grid[44];
												$grid_musrenbang_tmp[$i]['kh_ukur']					= $row_grid[45];
												$grid_musrenbang_tmp[$i]['kh_target']				= $row_grid[46];
												$grid_musrenbang_tmp[$i]['kh_satuan']				= $row_grid[47];
												$grid_musrenbang_tmp[$i]['hk_ukur']					= $row_grid[48];
												$grid_musrenbang_tmp[$i]['hk_target']				= $row_grid[49];
												$grid_musrenbang_tmp[$i]['hk_satuan']				= $row_grid[50];
												$grid_musrenbang_tmp[$i]['apbd_kab']				= $row_grid[51];
												$grid_musrenbang_tmp[$i]['apbd_prov']				= $row_grid[52];
												$grid_musrenbang_tmp[$i]['apbn']					= $row_grid[53];
												$grid_musrenbang_tmp[$i]['sumberlain']				= $row_grid[54];
												$grid_musrenbang_tmp[$i]['perkiraan_maju']			= $row_grid[55];
												$grid_musrenbang_tmp[$i]['foto_']					= $row_grid[56];
												$grid_musrenbang_tmp[$i]['file_']					= $row_grid[57];
												$i++;
											} else {
												$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload salah. File tersebut bukan hasil musrenbang kecamatan yang Anda pilih.</div>');
												redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
											}
										}
										$grid_musrenbang 	= json_decode(json_encode($grid_musrenbang_tmp));
										$sama 				= 0;
										$grid_musrenbang_ 	= new stdClass();
										if ($grid_musrenbang){
											$container['content']['dataset']['grid_musrenbang']		= $grid_musrenbang;
											foreach($grid_musrenbang as $row_musrenbang){
												if ($this->Anggaran_model->count_all(array('nomor'=>$row_musrenbang->nomor)) > 0){
													$sama++;
													$nomor = $row_musrenbang->nomor;
													$grid_musrenbang_->$nomor	= $this->Anggaran_model->getOnly("*", array('nomor'=>$row_musrenbang->nomor));
												}
											}
										}
										$container['content']['dataset']['grid_musrenbang_']	= $grid_musrenbang_;
										$container['content']['dataset']['jumlah_sama']			= $sama;
									} else {
										$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload tidak ada data.</div>');
										redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
									}
								} else {
									$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload formatnya tidak sesuai.,</div>');
									redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
								}
							} else {
								$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload formatnya tidak sesuai.</div>');
								redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
							}
						} else {
							$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload formatnya tidak sesuai,</div>');
							redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
						}
					} else {
						$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File gagal di-upload.</div>');
						redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
					}
				} else if ($this->input->post('btnimport_all')){
					redirect('musrenbang/kecamatan/sync_do/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_.'/semua/'.$this->input->post('filename'));
				} else if ($this->input->post('btnimport_part')){
					redirect('musrenbang/kecamatan/sync_do/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_.'/sebagian/'.$this->input->post('filename'));
				}
			} else if ($jenis_ == 4){
				$count_musrenbang = $this->Anggaran_model->count_all(array('anggaran.skpd_kode'=>$kecamatan_kode, 'anggaran.tahun'=>$tahun_, 'anggaran.tipe_kode'=>$tipe_));
				if ($count_musrenbang > 0){
					$container['content']['dataset']['jumlah_data']			= $count_musrenbang;
					$grid_musrenbang = $this->Anggaran_model->grid_all($tipe_, 'anggaran.*', 'anggaran.kode', 'ASC', 0, 0, array('anggaran.skpd_kode'=>$kecamatan_kode, 'anggaran.tahun'=>$tahun_, 'anggaran.tipe_kode'=>$tipe_));
					$container['content']['dataset']['grid_musrenbang']		= $grid_musrenbang;
				} else {
					$container['content']['dataset']['jumlah_data']	= 0;
				}
			}
			
			$container['content']['dataset']['formCari']	= 'off';
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function sync_do()
	{
		$admin_log = $this->auth->is_login_admin();
		
		$jenis_		= $this->uri->segment(4);
		$tahun_		= $this->uri->segment(5);
		$tipe_		= $this->uri->segment(6);
		$tipe_nama	= ($this->uri->segment(6) == 1)?'Belanja Langsung':'Belanja Tidak Langsung';
		$kecamatan_	= $this->uri->segment(7);
		$sync		= $this->uri->segment(8);
		$file		= $this->uri->segment(9);
		
		if ($admin_log['level_kode'] == 4){
			$kecamatan_kode	= $admin_log['skpd_kode'];
		} else {
			$skpd 			= $this->Skpd_model->get('skpd_kode', array('skpd_kd' => $kecamatan_));
			$kecamatan_kode	= $skpd->skpd_kode;
		}
		
		$container['content']['dataset']['jenis_']		= $jenis_;
		$container['content']['dataset']['tahun_']		= $tahun_;
		$container['content']['dataset']['tipe_']		= $tipe_;
		$container['content']['dataset']['tipe_nama']	= $tipe_nama;
		$container['content']['dataset']['kecamatan_']	= $kecamatan_;
		
		if ($jenis_ == 3){
			$fp 		= fopen('./public/uploads/temp/'.$file, 'rb');
			$i 			= 1;
			$tmp_column	= "";
			$tmp_grid 	= array();
			while ( ($line = fgets($fp)) !== false) {
				if ($i == 1){
					$tmp_column = explode(",", $this->encryption->decode($line));
				} else {
					$tmp_grid[$i] = explode(",", $this->encryption->decode($line));
				}
				$i++;
			}
			
			//unlink('./public/uploads/temp/'.$file);
									
			if (count($tmp_column) > 0){
				if (isset($tmp_column[0])){
					if ($tmp_column[0] == 'kode'){
						if (count($tmp_grid) > 0){
							$container['content']['dataset']['jumlah_data'] = count($tmp_grid);
							$grid_musrenbang_tmp = array();
							$i = 0;
							foreach($tmp_grid as $row_grid){
								if ($row_grid[2] == $kecamatan_kode){
									$grid_musrenbang_tmp[$i]['kode']					= $row_grid[0];
									$grid_musrenbang_tmp[$i]['nomor']					= $row_grid[1];
									$grid_musrenbang_tmp[$i]['skpd_kode']				= $row_grid[2];
									$grid_musrenbang_tmp[$i]['pelaksana_kode']			= $row_grid[3];
									$grid_musrenbang_tmp[$i]['tahun']					= $row_grid[4];
									$grid_musrenbang_tmp[$i]['kegiatan']				= $row_grid[5];
									$grid_musrenbang_tmp[$i]['lokasi_kode']				= $row_grid[6];
									$grid_musrenbang_tmp[$i]['kecamatan_kode']			= $row_grid[7];
									$grid_musrenbang_tmp[$i]['deskel_kode']				= $row_grid[8];
									$grid_musrenbang_tmp[$i]['rw']						= $row_grid[9];
									$grid_musrenbang_tmp[$i]['rt']						= $row_grid[10];
									$grid_musrenbang_tmp[$i]['alamat']					= $row_grid[11];
									$grid_musrenbang_tmp[$i]['foto']					= $row_grid[12];
									$grid_musrenbang_tmp[$i]['file']					= $row_grid[13];
									$grid_musrenbang_tmp[$i]['koordinat']				= $row_grid[14];
									$grid_musrenbang_tmp[$i]['catatan']					= $row_grid[15];
									$grid_musrenbang_tmp[$i]['status']					= $row_grid[16];
									$grid_musrenbang_tmp[$i]['proses_kode']				= $row_grid[17];
									$grid_musrenbang_tmp[$i]['sumber_kode']				= $row_grid[18];
									$grid_musrenbang_tmp[$i]['sumber_id']				= $row_grid[19];
									$grid_musrenbang_tmp[$i]['sumber_nomor']			= $row_grid[20];
									$grid_musrenbang_tmp[$i]['tahapan_kode']			= $row_grid[21];
									$grid_musrenbang_tmp[$i]['tanggal']					= $row_grid[22];
									$grid_musrenbang_tmp[$i]['penambahan_kode']			= $row_grid[23];
									$grid_musrenbang_tmp[$i]['perubahan_id']			= $row_grid[24];
									$grid_musrenbang_tmp[$i]['perubahan_status_kode']	= $row_grid[25];
									$grid_musrenbang_tmp[$i]['admin_user']				= $row_grid[26];
									$grid_musrenbang_tmp[$i]['tipe_kode']				= $row_grid[27];
									$grid_musrenbang_tmp[$i]['proposal']				= $row_grid[28];
									$grid_musrenbang_tmp[$i]['verifikasi']				= $row_grid[29];
									$grid_musrenbang_tmp[$i]['anggaran_kode']			= $row_grid[30];
									$grid_musrenbang_tmp[$i]['visi_kode']				= $row_grid[31];
									$grid_musrenbang_tmp[$i]['misi_kode']				= $row_grid[32];
									$grid_musrenbang_tmp[$i]['prioritas_kode']			= $row_grid[33];
									$grid_musrenbang_tmp[$i]['tujuan_kode']				= $row_grid[34];
									$grid_musrenbang_tmp[$i]['sasaran_kode']			= $row_grid[35];
									$grid_musrenbang_tmp[$i]['indikator_kode']			= $row_grid[36];
									$grid_musrenbang_tmp[$i]['urusan_kode']				= $row_grid[37];
									$grid_musrenbang_tmp[$i]['program_kode']			= $row_grid[38];
									$grid_musrenbang_tmp[$i]['sifat_kode']				= $row_grid[39];
									$grid_musrenbang_tmp[$i]['kesepakatan_kode']		= $row_grid[40];
									$grid_musrenbang_tmp[$i]['urutan']					= $row_grid[41];
									$grid_musrenbang_tmp[$i]['hp_ukur']					= $row_grid[42];
									$grid_musrenbang_tmp[$i]['hp_target']				= $row_grid[43];
									$grid_musrenbang_tmp[$i]['hp_satuan']				= $row_grid[44];
									$grid_musrenbang_tmp[$i]['kh_ukur']					= $row_grid[45];
									$grid_musrenbang_tmp[$i]['kh_target']				= $row_grid[46];
									$grid_musrenbang_tmp[$i]['kh_satuan']				= $row_grid[47];
									$grid_musrenbang_tmp[$i]['hk_ukur']					= $row_grid[48];
									$grid_musrenbang_tmp[$i]['hk_target']				= $row_grid[49];
									$grid_musrenbang_tmp[$i]['hk_satuan']				= $row_grid[50];
									$grid_musrenbang_tmp[$i]['apbd_kab']				= $row_grid[51];
									$grid_musrenbang_tmp[$i]['apbd_prov']				= $row_grid[52];
									$grid_musrenbang_tmp[$i]['apbn']					= $row_grid[53];
									$grid_musrenbang_tmp[$i]['sumberlain']				= $row_grid[54];
									$grid_musrenbang_tmp[$i]['perkiraan_maju']			= $row_grid[55];
									$grid_musrenbang_tmp[$i]['foto_']					= $row_grid[56];
									$grid_musrenbang_tmp[$i]['file_']					= $row_grid[57];
									$i++;
								} else {
									$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload salah. File tersebut bukan hasil musrenbang kecamatan yang Anda pilih.</div>');
									redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun_.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
								}
							}
							$grid_musrenbang 	= json_decode(json_encode($grid_musrenbang_tmp));
							$sama 				= 0;
							$grid_musrenbang_ 	= new stdClass();
							if ($grid_musrenbang){
								$container['content']['dataset']['grid_musrenbang']		= $grid_musrenbang;
								foreach($grid_musrenbang as $row_musrenbang){
									if ($sync == 'semua'){
										$where_delete['anggaran.tahun']		= $tahun_;
										$where_delete['anggaran.tipe_kode']	= $tipe_;
										$where_delete['anggaran.skpd_kode']	= $kecamatan_kode;
										$where_delete['anggaran.nomor']		= $row_musrenbang->nomor; 
										$anggaran = $this->Anggaran_model->grid_all($tipe_, 'anggaran.kode, anggaran.foto, anggaran.file', 'anggaran.kode', 'ASC', 0, 0, $where_delete);
										if ($anggaran){
											foreach($anggaran as $row){
											if ($row->foto){
												$foto = explode(';', $row->foto);
												if ($foto){
													foreach($foto as $row2){
														if ($row2){
															if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row2)){
																unlink('./public/uploads/pictures/musrenbang_kecamatan/'.$row2);
															}
														}
													}
												}
											}
											if ($row->file){
												if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$row->file)){
													unlink('./public/uploads/documents/musrenbang_kecamatan/'.$row->file);
												}
											}
											
											if ($tipe_ == 1){
												$this->Anggaran_model->delete('anggaran_bl', array('anggaran_kode' => $row->kode)); 
											} else {
												$this->Anggaran_model->delete('anggaran_btl', array('anggaran_kode' => $row->kode));
											}
										}
											$this->Anggaran_model->delete('anggaran', $where_delete);
										}
											
										if ($row_musrenbang->file){
											$timestamp = explode(" ",microtime());
											$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
											
											$new_file		=  $row_musrenbang->nomor. '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($row_musrenbang->file)));
											file_put_content('./public/uploads/documents/musrenbang_kecamatan/'.$new_file, $row_musrenbang->file_);
											$insert['file'] = $new_file;
										} else {
											$insert['file'] = $row_musrenbang->file;
										}
										if ($row_musrenbang->foto){
											$foto = $row_musrenbang->foto;
											$foto_ = $row_musrenbang->foto_;
											$filename = array();
											$i = 0;
											$ds_foto = explode(';', $foto);
											$ds_foto_ = explode(';', $foto_);
											foreach($ds_foto_ as $row_foto){
												$timestamp = explode(" ",microtime());
												$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
											
												$new_file		=  $row_musrenbang->nomor. '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($ds_foto[$i])));
												$filename[] 	= $new_file;
												file_put_content('./public/uploads/pictures/musrenbang_kecamatan/'.$new_file, $row_foto);
												$i++;
											} 
											$insert['foto']					= implode(';', $filename);
										} else {
											$insert['foto']					= $row_musrenbang->foto;
										}
										
										$insert['nomor']				= $row_musrenbang->nomor;
										$insert['skpd_kode']			= $row_musrenbang->skpd_kode;
										$insert['pelaksana_kode']		= $row_musrenbang->pelaksana_kode;
										$insert['tahun']				= $row_musrenbang->tahun;
										$insert['kegiatan']				= $row_musrenbang->kegiatan;
										$insert['lokasi_kode']			= $row_musrenbang->lokasi_kode;
										$insert['kecamatan_kode']		= $row_musrenbang->kecamatan_kode;
										$insert['deskel_kode']			= $row_musrenbang->deskel_kode;
										$insert['rw']					= $row_musrenbang->rw;
										$insert['rt']					= $row_musrenbang->rt;
										$insert['alamat']				= $row_musrenbang->alamat;
										$insert['koordinat']			= $row_musrenbang->koordinat;
										$insert['catatan']				= $row_musrenbang->catatan;
										$insert['status']				= $row_musrenbang->status;
										$insert['proses_kode']			= $row_musrenbang->proses_kode;
										$insert['sumber_kode']			= $row_musrenbang->sumber_kode;
										$insert['sumber_id']			= $row_musrenbang->sumber_id;
										$insert['sumber_nomor']			= $row_musrenbang->sumber_nomor;
										$insert['tahapan_kode']			= $row_musrenbang->tahapan_kode;
										$insert['tanggal']				= $row_musrenbang->tanggal;
										$insert['penambahan_kode']		= $row_musrenbang->penambahan_kode;
										$insert['perubahan_id']			= $row_musrenbang->perubahan_id;
										$insert['perubahan_status_kode']= $row_musrenbang->perubahan_status_kode;
										$insert['admin_user']			= $row_musrenbang->admin_user;
										$insert['tipe_kode']			= $row_musrenbang->tipe_kode;
										$insert['proposal']				= $row_musrenbang->proposal;
										$insert['verifikasi']			= $row_musrenbang->verifikasi;
										$this->Anggaran_model->insert('anggaran', $insert);
										
										$anggaran = $this->Anggaran_model->getOnly('kode', array('nomor'=>$row_musrenbang->nomor, 'tipe_kode'=>$row_musrenbang->tipe_kode));
										if ($tipe_ == 1){
											$insert_bl['anggaran_kode']		= $anggaran->kode;
											$insert_bl['visi_kode']			= $row_musrenbang->visi_kode;
											$insert_bl['misi_kode']			= $row_musrenbang->misi_kode;
											$insert_bl['prioritas_kode']	= $row_musrenbang->prioritas_kode;
											$insert_bl['tujuan_kode']		= $row_musrenbang->tujuan_kode;
											$insert_bl['sasaran_kode']		= $row_musrenbang->sasaran_kode;
											$insert_bl['indikator_kode']	= $row_musrenbang->indikator_kode;
											$insert_bl['urusan_kode']		= $row_musrenbang->urusan_kode;
											$insert_bl['program_kode']		= $row_musrenbang->program_kode;
											$insert_bl['sifat_kode']		= $row_musrenbang->sifat_kode;
											$insert_bl['kesepakatan_kode']	= $row_musrenbang->kesepakatan_kode;
											$insert_bl['urutan']			= $row_musrenbang->urutan;
											$insert_bl['hp_ukur']			= $row_musrenbang->hp_ukur;
											$insert_bl['hp_target']			= $row_musrenbang->hp_target;
											$insert_bl['hp_satuan']			= $row_musrenbang->hp_satuan;
											$insert_bl['kh_ukur']			= $row_musrenbang->kh_ukur;
											$insert_bl['kh_target']			= $row_musrenbang->kh_target;
											$insert_bl['kh_satuan']			= $row_musrenbang->kh_satuan;
											$insert_bl['hk_ukur']			= $row_musrenbang->hk_ukur;
											$insert_bl['hk_target']			= $row_musrenbang->hk_target;
											$insert_bl['hk_satuan']			= $row_musrenbang->hk_satuan;
											$insert_bl['apbd_kab']			= $row_musrenbang->apbd_kab;
											$insert_bl['apbd_prov']			= $row_musrenbang->apbd_prov;
											$insert_bl['apbn']				= $row_musrenbang->apbn;
											$insert_bl['sumberlain']		= $row_musrenbang->sumberlain;
											$insert_bl['perkiraan_maju']	= $row_musrenbang->perkiraan_maju;
											$this->Anggaran_model->insert('anggaran_bl', $insert_bl);
										} else {
											$insert_btl['anggaran_kode']	= $anggaran->kode;
											$insert_btl['volume']			= $row_musrenbang->volume;
											$insert_btl['biaya']			= $row_musrenbang->biaya;
											$insert_btl['penerima']			= $row_musrenbang->penerima;
											$this->Anggaran_model->insert('anggaran_btl', $insert_btl);
										}
									} else if ($sync == 'sebagian'){
										$where_anggaran['anggaran.nomor']		= $row_musrenbang->nomor;
										$count_anggaran = $this->Anggaran_model->count_all($where_anggaran);
										if ($count_anggaran < 1){
											if ($row_musrenbang->file){
												$timestamp = explode(" ",microtime());
												$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
												
												$new_file		=  $row_musrenbang->nomor. '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($row_musrenbang->file)));
												file_put_content('./public/uploads/documents/musrenbang_kecamatan/'.$new_file, $row_musrenbang->file_);
												$insert['file'] = $new_file;
											} else {
												$insert['file'] = $row_musrenbang->file;
											}
											if ($row_musrenbang->foto){
												$foto = $row_musrenbang->foto;
												$foto_ = $row_musrenbang->foto_;
												$filename = array();
												$i = 0;
												$ds_foto = explode(';', $foto);
												$ds_foto_ = explode(';', $foto_);
												foreach($ds_foto_ as $row_foto){
													$timestamp = explode(" ",microtime());
													$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
													
													$new_file		=  $row_musrenbang->nomor. '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($ds_foto[$i])));
													$filename[] 	= $new_file;
													file_put_content('./public/uploads/pictures/musrenbang_kecamatan/'.$new_file, $row_foto);
													$i++;
												} 
												$insert['foto']					= implode(';', $filename);
											} else {
												$insert['foto']					= $row_musrenbang->foto;
											}
											
											$insert['nomor']				= $row_musrenbang->nomor;
											$insert['skpd_kode']			= $row_musrenbang->skpd_kode;
											$insert['pelaksana_kode']		= $row_musrenbang->pelaksana_kode;
											$insert['tahun']				= $row_musrenbang->tahun;
											$insert['kegiatan']				= $row_musrenbang->kegiatan;
											$insert['lokasi_kode']			= $row_musrenbang->lokasi_kode;
											$insert['kecamatan_kode']		= $row_musrenbang->kecamatan_kode;
											$insert['deskel_kode']			= $row_musrenbang->deskel_kode;
											$insert['rw']					= $row_musrenbang->rw;
											$insert['rt']					= $row_musrenbang->rt;
											$insert['alamat']				= $row_musrenbang->alamat;
											$insert['koordinat']			= $row_musrenbang->koordinat;
											$insert['catatan']				= $row_musrenbang->catatan;
											$insert['status']				= $row_musrenbang->status;
											$insert['proses_kode']			= $row_musrenbang->proses_kode;
											$insert['sumber_kode']			= $row_musrenbang->sumber_kode;
											$insert['sumber_id']			= $row_musrenbang->sumber_id;
											$insert['sumber_nomor']			= $row_musrenbang->sumber_nomor;
											$insert['tahapan_kode']			= $row_musrenbang->tahapan_kode;
											$insert['tanggal']				= $row_musrenbang->tanggal;
											$insert['penambahan_kode']		= $row_musrenbang->penambahan_kode;
											$insert['perubahan_id']			= $row_musrenbang->perubahan_id;
											$insert['perubahan_status_kode']= $row_musrenbang->perubahan_status_kode;
											$insert['admin_user']			= $row_musrenbang->admin_user;
											$insert['tipe_kode']			= $row_musrenbang->tipe_kode;
											$insert['proposal']				= $row_musrenbang->proposal;
											$insert['verifikasi']			= $row_musrenbang->verifikasi;
											$this->Anggaran_model->insert('anggaran', $insert);
											
											$anggaran = $this->Anggaran_model->getOnly('kode', array('nomor'=>$row_musrenbang->nomor, 'tipe_kode'=>$row_musrenbang->tipe_kode));
											if ($tipe_ == 1){
												$insert_bl['anggaran_kode']		= $anggaran->kode;
												$insert_bl['visi_kode']			= $row_musrenbang->visi_kode;
												$insert_bl['misi_kode']			= $row_musrenbang->misi_kode;
												$insert_bl['prioritas_kode']	= $row_musrenbang->prioritas_kode;
												$insert_bl['tujuan_kode']		= $row_musrenbang->tujuan_kode;
												$insert_bl['sasaran_kode']		= $row_musrenbang->sasaran_kode;
												$insert_bl['indikator_kode']	= $row_musrenbang->indikator_kode;
												$insert_bl['urusan_kode']		= $row_musrenbang->urusan_kode;
												$insert_bl['program_kode']		= $row_musrenbang->program_kode;
												$insert_bl['sifat_kode']		= $row_musrenbang->sifat_kode;
												$insert_bl['kesepakatan_kode']	= $row_musrenbang->kesepakatan_kode;
												$insert_bl['urutan']			= $row_musrenbang->urutan;
												$insert_bl['hp_ukur']			= $row_musrenbang->hp_ukur;
												$insert_bl['hp_target']			= $row_musrenbang->hp_target;
												$insert_bl['hp_satuan']			= $row_musrenbang->hp_satuan;
												$insert_bl['kh_ukur']			= $row_musrenbang->kh_ukur;
												$insert_bl['kh_target']			= $row_musrenbang->kh_target;
												$insert_bl['kh_satuan']			= $row_musrenbang->kh_satuan;
												$insert_bl['hk_ukur']			= $row_musrenbang->hk_ukur;
												$insert_bl['hk_target']			= $row_musrenbang->hk_target;
												$insert_bl['hk_satuan']			= $row_musrenbang->hk_satuan;
												$insert_bl['apbd_kab']			= $row_musrenbang->apbd_kab;
												$insert_bl['apbd_prov']			= $row_musrenbang->apbd_prov;
												$insert_bl['apbn']				= $row_musrenbang->apbn;
												$insert_bl['sumberlain']		= $row_musrenbang->sumberlain;
												$insert_bl['perkiraan_maju']	= $row_musrenbang->perkiraan_maju;
												$this->Anggaran_model->insert('anggaran_bl', $insert_bl);
											} else {
												$insert_btl['anggaran_kode']	= $anggaran->kode;
												$insert_btl['volume']			= $row_musrenbang->volume;
												$insert_btl['biaya']			= $row_musrenbang->biaya;
												$insert_btl['penerima']			= $row_musrenbang->penerima;
												$this->Anggaran_model->insert('anggaran_btl', $insert_btl);
											}
										}
									}
								}
								$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data telah berhasil di-import.</div>');
								redirect('musrenbang/kecamatan/sync', 'refresh');
							} else {
								$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> Data gagal di-import.</div>');
								redirect('musrenbang/kecamatan/sync', 'refresh');
							}
						} else {
							$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload tidak ada data.</div>');
							redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
						}
					} else {
						$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload formatnya tidak sesuai.,</div>');
						redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
					}
				} else {
					$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload formatnya tidak sesuai.</div>');
					redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
				}
			} else {
				$this->session->set_flashdata('error','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Error!</strong> File yang diupload formatnya tidak sesuai,</div>');
				redirect('musrenbang/kecamatan/sync_preview/'.$jenis_.'/'.$tahun.'/'.$tipe_.'/'.$kecamatan_.'/'.$deskel_);
			}
		}
	}
	
	public function sync_do_()
	{
		$admin_log = $this->auth->is_login_admin();
		
		$jenis_	= $this->input->post('jenis');
		$tahun_	= $this->input->post('tahun');
		$tipe_	= $this->input->post('tipe');
		$tipe_nama	= ($this->input->post('tipe') == 1)?'Belanja Langsung':'Belanja Tidak Langsung';
		$sync	= $this->input->post('sync');
		$nomor	= $this->input->post('nomor');
		
		$container['content']['dataset']['jenis_']		= $jenis_;
		$container['content']['dataset']['tahun_']		= $tahun_;
		$container['content']['dataset']['tipe_']		= $tipe_;
		$container['content']['dataset']['tipe_nama']	= $tipe_nama;
		
		if ($jenis_ && $tahun_ && $tipe_ && $sync && $nomor){
			if ($jenis_ == 1){
				$this->rest->initialize(array('server' => $this->config->item('api_url')));
				$get_key = $this->rest->post('auth/damel-keys', array('username'=>$admin_log['username'], 'skpd'=>$admin_log['skpd_kode']));
				if ($get_key){
					$key = $get_key->data->key_value;
					$name = $this->config->item('api_name');
					
					$this->rest->api_key($key, $name); 
					$count_musrenbang = $this->rest->get('musrenbang_kecamatan/get/'.$nomor);
					if ($count_musrenbang->success === true){
						if ($sync == 'semua'){
							$where_delete['anggaran.tahun']		= $tahun_;
							$where_delete['anggaran.tipe_kode']	= $tipe_;
							$where_delete['anggaran.skpd_kode']	= $admin_log['skpd_kode'];
							$where_delete['anggaran.nomor']		= $nomor; 
							$anggaran = $this->Anggaran_model->grid_all($tipe_, 'anggaran.kode, anggaran.foto, anggaran.file', 'anggaran.kode', 'ASC', 0, 0, $where_delete);
							if ($anggaran){
								foreach($anggaran as $row){
								if ($row->foto){
									$foto = explode(';', $row->foto);
									if ($foto){
										foreach($foto as $row2){
											if ($row2){
												if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row2)){
													unlink('./public/uploads/pictures/musrenbang_kecamatan/'.$row2);
												}
											}
										}
									}
								}
								if ($row->file){
									if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$row->file)){
										unlink('./public/uploads/documents/musrenbang_kecamatan/'.$row->file);
									}
								}
								
								if ($tipe_ == 1){
									$this->Anggaran_model->delete('anggaran_bl', array('anggaran_kode' => $row->kode)); 
								} else {
									$this->Anggaran_model->delete('anggaran_btl', array('anggaran_kode' => $row->kode));
								}
							}
								$this->Anggaran_model->delete('anggaran', $where_delete);
							}
							
							$this->rest->api_key($key, $name); 
							$grid_musrenbang = $this->rest->get('musrenbang_kecamatan/get_full/'.$nomor);
							$sama = 0;
							if ($grid_musrenbang->success === true){
								$row_musrenbang = $grid_musrenbang->data;
								
								if ($row_musrenbang->file){
									$timestamp = explode(" ",microtime());
									$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
									
									$new_file		=  $row_musrenbang->nomor. '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($row_musrenbang->file)));
									file_put_contents('./public/uploads/documents/musrenbang_kecamatan/'.$new_file, file_get_contents($this->config->item('api_media').'documents/musrenbang_kecamatan/'.$row_musrenbang->file));
									$insert['file'] = $new_file;
								} else {
									$insert['file'] = $row_musrenbang->file;
								}
								if ($row_musrenbang->foto){
									$foto = $row_musrenbang->foto;
									$filename = array();
									$i = 0;
									$ds_foto = explode(';', $foto); 
									foreach($ds_foto as $row_foto){
										$timestamp = explode(" ",microtime());
										$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
										
										$new_file		=  $row_musrenbang->nomor. '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($row_foto)));
										$filename[] 	= $new_file;
										file_put_contents('./public/uploads/pictures/musrenbang_kecamatan/'.$new_file, file_get_contents($this->config->item('api_media').'pictures/musrenbang_kecamatan/'.$row_foto));
										$i++;
									} 
									$insert['foto']					= implode(';', $filename);
								} else {
									$insert['foto']					= $row_musrenbang->foto;
								}
								
								$insert['nomor']				= $row_musrenbang->nomor;
								$insert['skpd_kode']			= $row_musrenbang->skpd_kode;
								$insert['pelaksana_kode']		= $row_musrenbang->pelaksana_kode;
								$insert['tahun']				= $row_musrenbang->tahun;
								$insert['kegiatan']				= $row_musrenbang->kegiatan;
								$insert['lokasi_kode']			= $row_musrenbang->lokasi_kode;
								$insert['kecamatan_kode']		= $row_musrenbang->kecamatan_kode;
								$insert['deskel_kode']			= $row_musrenbang->deskel_kode;
								$insert['rw']					= $row_musrenbang->rw;
								$insert['rt']					= $row_musrenbang->rt;
								$insert['alamat']				= $row_musrenbang->alamat;
								$insert['koordinat']			= $row_musrenbang->koordinat;
								$insert['catatan']				= $row_musrenbang->catatan;
								$insert['status']				= $row_musrenbang->status;
								$insert['proses_kode']			= $row_musrenbang->proses_kode;
								$insert['sumber_kode']			= $row_musrenbang->sumber_kode;
								$insert['sumber_id']			= $row_musrenbang->sumber_id;
								$insert['sumber_nomor']			= $row_musrenbang->sumber_nomor;
								$insert['tahapan_kode']			= $row_musrenbang->tahapan_kode;
								$insert['tanggal']				= $row_musrenbang->tanggal;
								$insert['penambahan_kode']		= $row_musrenbang->penambahan_kode;
								$insert['perubahan_id']			= $row_musrenbang->perubahan_id;
								$insert['perubahan_status_kode']= $row_musrenbang->perubahan_status_kode;
								$insert['admin_user']			= $row_musrenbang->admin_user;
								$insert['tipe_kode']			= $row_musrenbang->tipe_kode;
								$insert['proposal']				= $row_musrenbang->proposal;
								$insert['verifikasi']			= $row_musrenbang->verifikasi;
								$this->Anggaran_model->insert('anggaran', $insert);
								
								$anggaran = $this->Anggaran_model->getOnly('kode', array('nomor'=>$row_musrenbang->nomor, 'tipe_kode'=>$row_musrenbang->tipe_kode));
								if ($tipe_ == 1){
									$insert_bl['anggaran_kode']		= $anggaran->kode;
									$insert_bl['visi_kode']			= $row_musrenbang->visi_kode;
									$insert_bl['misi_kode']			= $row_musrenbang->misi_kode;
									$insert_bl['prioritas_kode']	= $row_musrenbang->prioritas_kode;
									$insert_bl['tujuan_kode']		= $row_musrenbang->tujuan_kode;
									$insert_bl['sasaran_kode']		= $row_musrenbang->sasaran_kode;
									$insert_bl['indikator_kode']	= $row_musrenbang->indikator_kode;
									$insert_bl['urusan_kode']		= $row_musrenbang->urusan_kode;
									$insert_bl['program_kode']		= $row_musrenbang->program_kode;
									$insert_bl['sifat_kode']		= $row_musrenbang->sifat_kode;
									$insert_bl['kesepakatan_kode']	= $row_musrenbang->kesepakatan_kode;
									$insert_bl['urutan']			= $row_musrenbang->urutan;
									$insert_bl['hp_ukur']			= $row_musrenbang->hp_ukur;
									$insert_bl['hp_target']			= $row_musrenbang->hp_target;
									$insert_bl['hp_satuan']			= $row_musrenbang->hp_satuan;
									$insert_bl['kh_ukur']			= $row_musrenbang->kh_ukur;
									$insert_bl['kh_target']			= $row_musrenbang->kh_target;
									$insert_bl['kh_satuan']			= $row_musrenbang->kh_satuan;
									$insert_bl['hk_ukur']			= $row_musrenbang->hk_ukur;
									$insert_bl['hk_target']			= $row_musrenbang->hk_target;
									$insert_bl['hk_satuan']			= $row_musrenbang->hk_satuan;
									$insert_bl['apbd_kab']			= $row_musrenbang->apbd_kab;
									$insert_bl['apbd_prov']			= $row_musrenbang->apbd_prov;
									$insert_bl['apbn']				= $row_musrenbang->apbn;
									$insert_bl['sumberlain']		= $row_musrenbang->sumberlain;
									$insert_bl['perkiraan_maju']	= $row_musrenbang->perkiraan_maju;
									$this->Anggaran_model->insert('anggaran_bl', $insert_bl);
								} else {
									$insert_btl['anggaran_kode']	= $anggaran->kode;
									$insert_btl['volume']			= $row_musrenbang->volume;
									$insert_btl['biaya']			= $row_musrenbang->biaya;
									$insert_btl['penerima']			= $row_musrenbang->penerima;
									$this->Anggaran_model->insert('anggaran_btl', $insert_btl);
								}
								
								$data_json['success']	= true;
								$data_json['nomor']		= $nomor;
								$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
								$data_json['message']	= "<span class=\"label label-success\">Berhasil</span>";
								
							}
						} else if ($sync == 'sebagian'){
							$where_anggaran['anggaran.nomor']		= $nomor;
							$count_anggaran = $this->Anggaran_model->count_all($where_anggaran);
							if ($count_anggaran < 1){
								$this->rest->api_key($key, $name); 
								$grid_musrenbang = $this->rest->get('musrenbang_kecamatan/get_full/'.$nomor);
								$sama = 0;
								if ($grid_musrenbang->success === true){
									$row_musrenbang = $grid_musrenbang->data;
									
									if ($row_musrenbang->file){
										$timestamp = explode(" ",microtime());
										$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
										
										$new_file		=  $row_musrenbang->nomor. '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($row_musrenbang->file)));
										file_put_contents('./public/uploads/documents/musrenbang_kecamatan/'.$new_file, file_get_contents($this->config->item('api_media').'documents/musrenbang_kecamatan/'.$row_musrenbang->file));
										$insert['file'] = $new_file;
									} else {
										$insert['file'] = $row_musrenbang->file;
									}
									if ($row_musrenbang->foto){
										$foto = $row_musrenbang->foto;
										$filename = array();
										$i = 0;
										$ds_foto = explode(';', $foto); 
										foreach($ds_foto as $row_foto){
											$timestamp = explode(" ",microtime());
											$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
											
											$new_file		=  $row_musrenbang->nomor. '' . $currenttimemilis . '' . str_shuffle($currenttimemilis) . '.' . end(explode(".", basename($row_foto)));
											$filename[] 	= $new_file;
											file_put_contents('./public/uploads/pictures/musrenbang_kecamatan/'.$new_file, file_get_contents($this->config->item('api_media').'pictures/musrenbang_kecamatan/'.$row_foto));
											$i++;
										} 
										$insert['foto']					= implode(';', $filename);
									} else {
										$insert['foto']					= $row_musrenbang->foto;
									}
									
									$insert['nomor']				= $row_musrenbang->nomor;
									$insert['skpd_kode']			= $row_musrenbang->skpd_kode;
									$insert['pelaksana_kode']		= $row_musrenbang->pelaksana_kode;
									$insert['tahun']				= $row_musrenbang->tahun;
									$insert['kegiatan']				= $row_musrenbang->kegiatan;
									$insert['lokasi_kode']			= $row_musrenbang->lokasi_kode;
									$insert['kecamatan_kode']		= $row_musrenbang->kecamatan_kode;
									$insert['deskel_kode']			= $row_musrenbang->deskel_kode;
									$insert['rw']					= $row_musrenbang->rw;
									$insert['rt']					= $row_musrenbang->rt;
									$insert['alamat']				= $row_musrenbang->alamat;
									$insert['koordinat']			= $row_musrenbang->koordinat;
									$insert['catatan']				= $row_musrenbang->catatan;
									$insert['status']				= $row_musrenbang->status;
									$insert['proses_kode']			= $row_musrenbang->proses_kode;
									$insert['sumber_kode']			= $row_musrenbang->sumber_kode;
									$insert['sumber_id']			= $row_musrenbang->sumber_id;
									$insert['sumber_nomor']			= $row_musrenbang->sumber_nomor;
									$insert['tahapan_kode']			= $row_musrenbang->tahapan_kode;
									$insert['tanggal']				= $row_musrenbang->tanggal;
									$insert['penambahan_kode']		= $row_musrenbang->penambahan_kode;
									$insert['perubahan_id']			= $row_musrenbang->perubahan_id;
									$insert['perubahan_status_kode']= $row_musrenbang->perubahan_status_kode;
									$insert['admin_user']			= $row_musrenbang->admin_user;
									$insert['tipe_kode']			= $row_musrenbang->tipe_kode;
									$insert['proposal']				= $row_musrenbang->proposal;
									$insert['verifikasi']			= $row_musrenbang->verifikasi;
									$this->Anggaran_model->insert('anggaran', $insert);
									
									$anggaran = $this->Anggaran_model->getOnly('kode', array('nomor'=>$row_musrenbang->nomor, 'tipe_kode'=>$row_musrenbang->tipe_kode));
									if ($tipe_ == 1){
										$insert_bl['anggaran_kode']		= $anggaran->kode;
										$insert_bl['visi_kode']			= $row_musrenbang->visi_kode;
										$insert_bl['misi_kode']			= $row_musrenbang->misi_kode;
										$insert_bl['prioritas_kode']	= $row_musrenbang->prioritas_kode;
										$insert_bl['tujuan_kode']		= $row_musrenbang->tujuan_kode;
										$insert_bl['sasaran_kode']		= $row_musrenbang->sasaran_kode;
										$insert_bl['indikator_kode']	= $row_musrenbang->indikator_kode;
										$insert_bl['urusan_kode']		= $row_musrenbang->urusan_kode;
										$insert_bl['program_kode']		= $row_musrenbang->program_kode;
										$insert_bl['sifat_kode']		= $row_musrenbang->sifat_kode;
										$insert_bl['kesepakatan_kode']	= $row_musrenbang->kesepakatan_kode;
										$insert_bl['urutan']			= $row_musrenbang->urutan;
										$insert_bl['hp_ukur']			= $row_musrenbang->hp_ukur;
										$insert_bl['hp_target']			= $row_musrenbang->hp_target;
										$insert_bl['hp_satuan']			= $row_musrenbang->hp_satuan;
										$insert_bl['kh_ukur']			= $row_musrenbang->kh_ukur;
										$insert_bl['kh_target']			= $row_musrenbang->kh_target;
										$insert_bl['kh_satuan']			= $row_musrenbang->kh_satuan;
										$insert_bl['hk_ukur']			= $row_musrenbang->hk_ukur;
										$insert_bl['hk_target']			= $row_musrenbang->hk_target;
										$insert_bl['hk_satuan']			= $row_musrenbang->hk_satuan;
										$insert_bl['apbd_kab']			= $row_musrenbang->apbd_kab;
										$insert_bl['apbd_prov']			= $row_musrenbang->apbd_prov;
										$insert_bl['apbn']				= $row_musrenbang->apbn;
										$insert_bl['sumberlain']		= $row_musrenbang->sumberlain;
										$insert_bl['perkiraan_maju']	= $row_musrenbang->perkiraan_maju;
										$this->Anggaran_model->insert('anggaran_bl', $insert_bl);
									} else {
										$insert_btl['anggaran_kode']	= $anggaran->kode;
										$insert_btl['volume']			= $row_musrenbang->volume;
										$insert_btl['biaya']			= $row_musrenbang->biaya;
										$insert_btl['penerima']			= $row_musrenbang->penerima;
										$this->Anggaran_model->insert('anggaran_btl', $insert_btl);
									}
									
									$data_json['success']	= true;
									$data_json['nomor']		= $nomor;
									$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
									$data_json['message']	= "<span class=\"label label-success\">Berhasil</span>";
								} else {
									$data_json['success']	= false;
									$data_json['nomor']		= $nomor;
									$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
									$data_json['message']	= "<span class=\"label label-danger\">Duplikat</span>";
								}
							} else {
								$data_json['success']	= false;
								$data_json['nomor']		= $nomor;
								$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
								$data_json['message']	= "<span class=\"label label-danger\">Duplikat</span>";
							}
						} else {
							$data_json['success']	= false;
							$data_json['nomor']		= $nomor;
							$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
							$data_json['message']	= "<span class=\"label label-danger\">Gagal</span>";
						}
					} else {
						$data_json['success']	= false;
						$data_json['nomor']		= $nomor;
						$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
						$data_json['message']	= "<span class=\"label label-danger\">Gagal</span>";
					}
					$this->rest->post('auth/hapus-keys', array('keys'=>$key));
				} else {
					$data_json['success']	= false;
					$data_json['nomor']		= $nomor;
					$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
					$data_json['message']	= "<span class=\"label label-danger\">Gagal</span>";
				}
			} else if ($jenis_ == 2){
				$this->rest->initialize(array('server' => $this->config->item('api_url')));
				$get_key = $this->rest->post('auth/damel-keys', array('username'=>$admin_log['username'], 'skpd'=>$admin_log['skpd_kode']));
				if ($get_key){
					$key = $get_key->data->key_value;
					$name = $this->config->item('api_name');
					$where['anggaran.skpd_kode'] 	= $admin_log['skpd_kode'];
					$where['anggaran.tahun'] 		= $tahun_;
					$where['anggaran.tipe_kode'] 	= $tipe_;
					$where['anggaran.nomor'] 		= $nomor;
					$count_musrenbang = $this->Anggaran_model->count_all($where);
					if ($count_musrenbang > 0){
						if ($tipe_ == 1){
							$grid_musrenbang = $this->Anggaran_model->grid_all($tipe_, 'anggaran.*, anggaran_bl.*', 'anggaran.nomor', 'ASC', 0, 0, $where);
						} else {
							$grid_musrenbang = $this->Anggaran_model->grid_all($tipe_, 'anggaran.*, anggaran_btl.*', 'anggaran.nomor', 'ASC', 0, 0, $where);
						}
						$sama = 0;
						if ($grid_musrenbang){
							foreach($grid_musrenbang as $row_musrenbang){
								if ($sync == 'semua'){
									$param_delete['tahun']	= $tahun_;
									$param_delete['tipe']	= $tipe_;
									$param_delete['nomor']	= $row_musrenbang->nomor;
									$this->rest->api_key($key, $name); 
									$this->rest->post('musrenbang_kecamatan/delete', $param_delete);
									
									$param_insert['nomor']					= $row_musrenbang->nomor;
									$param_insert['skpd_kode']				= $row_musrenbang->skpd_kode;
									$param_insert['pelaksana_kode']			= $row_musrenbang->pelaksana_kode;
									$param_insert['tahun']					= $row_musrenbang->tahun;
									$param_insert['kegiatan']				= $row_musrenbang->kegiatan;
									$param_insert['lokasi_kode']			= $row_musrenbang->lokasi_kode;
									$param_insert['kecamatan_kode']			= $row_musrenbang->kecamatan_kode;
									$param_insert['deskel_kode']			= $row_musrenbang->deskel_kode;
									$param_insert['rw']						= $row_musrenbang->rw;
									$param_insert['rt']						= $row_musrenbang->rt;
									$param_insert['alamat']					= $row_musrenbang->alamat;
									$param_insert['foto']					= $row_musrenbang->foto;
									$param_insert['file']					= $row_musrenbang->file;
									$param_insert['koordinat']				= $row_musrenbang->koordinat;
									$param_insert['catatan']				= $row_musrenbang->catatan;
									$param_insert['status']					= $row_musrenbang->status;
									$param_insert['proses_kode']			= $row_musrenbang->proses_kode;
									$param_insert['sumber_kode']			= $row_musrenbang->sumber_kode;
									$param_insert['sumber_id']				= $row_musrenbang->sumber_id;
									$param_insert['sumber_nomor']			= $row_musrenbang->sumber_nomor;
									$param_insert['tahapan_kode']			= $row_musrenbang->tahapan_kode;
									$param_insert['tanggal']				= $row_musrenbang->tanggal;
									$param_insert['penambahan_kode']		= $row_musrenbang->penambahan_kode;
									$param_insert['perubahan_id']			= $row_musrenbang->perubahan_id;
									$param_insert['perubahan_status_kode']	= $row_musrenbang->perubahan_status_kode;
									$param_insert['admin_user']				= $row_musrenbang->admin_user;
									$param_insert['tipe_kode']				= $row_musrenbang->tipe_kode;
									$param_insert['proposal']				= $row_musrenbang->proposal;
									$param_insert['verifikasi']				= $row_musrenbang->verifikasi;
									
									if ($tipe_ == 1){
										$param_insert['visi_kode']				= $row_musrenbang->visi_kode;
										$param_insert['misi_kode']				= $row_musrenbang->misi_kode;
										$param_insert['prioritas_kode']			= $row_musrenbang->prioritas_kode;
										$param_insert['tujuan_kode']			= $row_musrenbang->tujuan_kode;
										$param_insert['sasaran_kode']			= $row_musrenbang->sasaran_kode;
										$param_insert['indikator_kode']			= $row_musrenbang->indikator_kode;
										$param_insert['urusan_kode']			= $row_musrenbang->urusan_kode;
										$param_insert['program_kode']			= $row_musrenbang->program_kode;
										$param_insert['sifat_kode']				= $row_musrenbang->sifat_kode;
										$param_insert['kesepakatan_kode']		= $row_musrenbang->kesepakatan_kode;
										$param_insert['urutan']					= $row_musrenbang->urutan;
										$param_insert['hp_ukur']				= $row_musrenbang->hp_ukur;
										$param_insert['hp_target']				= $row_musrenbang->hp_target;
										$param_insert['hp_satuan']				= $row_musrenbang->hp_satuan;
										$param_insert['kh_ukur']				= $row_musrenbang->kh_ukur;
										$param_insert['kh_target']				= $row_musrenbang->kh_target;
										$param_insert['kh_satuan']				= $row_musrenbang->kh_satuan;
										$param_insert['hk_ukur']				= $row_musrenbang->hk_ukur;
										$param_insert['hk_target']				= $row_musrenbang->hk_target;
										$param_insert['hk_satuan']				= $row_musrenbang->hk_satuan;
										$param_insert['apbd_kab']				= $row_musrenbang->apbd_kab;
										$param_insert['apbd_prov']				= $row_musrenbang->apbd_prov;
										$param_insert['apbn']					= $row_musrenbang->apbn;
										$param_insert['sumberlain']				= $row_musrenbang->sumberlain;
										$param_insert['perkiraan_maju']			= $row_musrenbang->perkiraan_maju;
									} else {
										$param_insert['volume']					= $row_musrenbang->volume;
										$param_insert['biaya']					= $row_musrenbang->biaya;
										$param_insert['penerima']				= $row_musrenbang->penerima;
									}
									
									if ($row_musrenbang->file){
										if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$row_musrenbang->file)){
											$param_insert['file_']				= file_get_content(base_url("public/uploads/documents/musrenbang_kecamatan/".$row_musrenbang->file));
										}
									}
									$param_insert_	= array();
									$foto = explode(';', $row_musrenbang->foto);
									$i = 0;
									foreach($foto as $row_foto){
										if ($row_foto){
											if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row_foto)){
												$param_insert_[$i]				= file_get_content(base_url("/public/uploads/pictures/musrenbang_kecamatan/".$row_foto));
												$i++;
											}
										}
									}
									if ($param_insert_){
										$param_insert['foto_']					= $param_insert_;
									}
									
									$this->rest->api_key($key, $name); 
									$this->rest->post('musrenbang_kecamatan/save', $param_insert);
									
									$data_json['success']	= true;
									$data_json['nomor']		= $nomor;
									$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
									$data_json['message']	= "<span class=\"label label-success\">Berhasil</span>";
								} else if ($sync == 'sebagian'){
									$this->rest->api_key($key, $name); 
									$get_musrenbang = $this->rest->get('musrenbang_kecamatan/get/'.$row_musrenbang->nomor);
									if (isset($get_musrenbang->success)){
										if ($get_musrenbang->success === false){
											// $param_delete['tahun']	= $tahun_;
											// $param_delete['tipe']	= $tipe_;
											// $param_delete['nomor']	= $row_musrenbang->nomor;
											// $this->rest->api_key($key, $name); 
											// $this->rest->post('musrenbang_kecamatan/delete', $param_delete);
											
											$param_insert['nomor']					= $row_musrenbang->nomor;
											$param_insert['skpd_kode']				= $row_musrenbang->skpd_kode;
											$param_insert['pelaksana_kode']			= $row_musrenbang->pelaksana_kode;
											$param_insert['tahun']					= $row_musrenbang->tahun;
											$param_insert['kegiatan']				= $row_musrenbang->kegiatan;
											$param_insert['lokasi_kode']			= $row_musrenbang->lokasi_kode;
											$param_insert['kecamatan_kode']			= $row_musrenbang->kecamatan_kode;
											$param_insert['deskel_kode']			= $row_musrenbang->deskel_kode;
											$param_insert['rw']						= $row_musrenbang->rw;
											$param_insert['rt']						= $row_musrenbang->rt;
											$param_insert['alamat']					= $row_musrenbang->alamat;
											$param_insert['foto']					= $row_musrenbang->foto;
											$param_insert['file']					= $row_musrenbang->file;
											$param_insert['koordinat']				= $row_musrenbang->koordinat;
											$param_insert['catatan']				= $row_musrenbang->catatan;
											$param_insert['status']					= $row_musrenbang->status;
											$param_insert['proses_kode']			= $row_musrenbang->proses_kode;
											$param_insert['sumber_kode']			= $row_musrenbang->sumber_kode;
											$param_insert['sumber_id']				= $row_musrenbang->sumber_id;
											$param_insert['sumber_nomor']			= $row_musrenbang->sumber_nomor;
											$param_insert['tahapan_kode']			= $row_musrenbang->tahapan_kode;
											$param_insert['tanggal']				= $row_musrenbang->tanggal;
											$param_insert['penambahan_kode']		= $row_musrenbang->penambahan_kode;
											$param_insert['perubahan_id']			= $row_musrenbang->perubahan_id;
											$param_insert['perubahan_status_kode']	= $row_musrenbang->perubahan_status_kode;
											$param_insert['admin_user']				= $row_musrenbang->admin_user;
											$param_insert['tipe_kode']				= $row_musrenbang->tipe_kode;
											$param_insert['proposal']				= $row_musrenbang->proposal;
											$param_insert['verifikasi']				= $row_musrenbang->verifikasi;
											
											if ($tipe_ == 1){
												$param_insert['visi_kode']				= $row_musrenbang->visi_kode;
												$param_insert['misi_kode']				= $row_musrenbang->misi_kode;
												$param_insert['prioritas_kode']			= $row_musrenbang->prioritas_kode;
												$param_insert['tujuan_kode']			= $row_musrenbang->tujuan_kode;
												$param_insert['sasaran_kode']			= $row_musrenbang->sasaran_kode;
												$param_insert['indikator_kode']			= $row_musrenbang->indikator_kode;
												$param_insert['urusan_kode']			= $row_musrenbang->urusan_kode;
												$param_insert['program_kode']			= $row_musrenbang->program_kode;
												$param_insert['sifat_kode']				= $row_musrenbang->sifat_kode;
												$param_insert['kesepakatan_kode']		= $row_musrenbang->kesepakatan_kode;
												$param_insert['urutan']					= $row_musrenbang->urutan;
												$param_insert['hp_ukur']				= $row_musrenbang->hp_ukur;
												$param_insert['hp_target']				= $row_musrenbang->hp_target;
												$param_insert['hp_satuan']				= $row_musrenbang->hp_satuan;
												$param_insert['kh_ukur']				= $row_musrenbang->kh_ukur;
												$param_insert['kh_target']				= $row_musrenbang->kh_target;
												$param_insert['kh_satuan']				= $row_musrenbang->kh_satuan;
												$param_insert['hk_ukur']				= $row_musrenbang->hk_ukur;
												$param_insert['hk_target']				= $row_musrenbang->hk_target;
												$param_insert['hk_satuan']				= $row_musrenbang->hk_satuan;
												$param_insert['apbd_kab']				= $row_musrenbang->apbd_kab;
												$param_insert['apbd_prov']				= $row_musrenbang->apbd_prov;
												$param_insert['apbn']					= $row_musrenbang->apbn;
												$param_insert['sumberlain']				= $row_musrenbang->sumberlain;
												$param_insert['perkiraan_maju']			= $row_musrenbang->perkiraan_maju;
											} else {
												$param_insert['volume']					= $row_musrenbang->volume;
												$param_insert['biaya']					= $row_musrenbang->biaya;
												$param_insert['penerima']				= $row_musrenbang->penerima;
											}
											
											if ($row_musrenbang->file){
												if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$row_musrenbang->file)){
													$param_insert['file_']				= file_get_content(base_url("public/uploads/documents/musrenbang_kecamatan/".$row_musrenbang->file));
												}
											}
											$param_insert_	= array();
											$foto = explode(';', $row_musrenbang->foto);
											$i = 0;
											foreach($foto as $row_foto){
												if ($row_foto){
													if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row_foto)){
														$param_insert_[$i]				= file_get_content(base_url("/public/uploads/pictures/musrenbang_kecamatan/".$row_foto));
														$i++;
													}
												}
											}
											if ($param_insert_){
												$param_insert['foto_']					= $param_insert_;
											}
											
											$this->rest->api_key($key, $name); 
											$this->rest->post('musrenbang_kecamatan/save', $param_insert);
											
											$data_json['success']	= true;
											$data_json['nomor']		= $nomor;
											$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
											$data_json['message']	= "<span class=\"label label-success\">Berhasil</span>";
										} else {
											$data_json['success']	= false;
											$data_json['nomor']		= $nomor;
											$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
											$data_json['message']	= "<span class=\"label label-danger\">Duplikat</span>";
										}
									} else {
										$data_json['success']	= false;
										$data_json['nomor']		= $nomor;
										$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
										$data_json['message']	= "<span class=\"label label-danger\">Duplikat</span>";
									}
								} else {
									$data_json['success']	= false;
									$data_json['nomor']		= $nomor;
									$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
									$data_json['message']	= "<span class=\"label label-danger\">Gagal</span>";
								}
							}
						} else {
							$data_json['success']	= false;
							$data_json['nomor']		= $nomor;
							$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
							$data_json['message']	= "<span class=\"label label-danger\">Gagal</span>";
						}
					} else {
						$data_json['success']	= false;
						$data_json['nomor']		= $nomor;
						$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
						$data_json['message']	= "<span class=\"label label-danger\">Gagal</span>";
					}
					
					$this->rest->post('auth/hapus-keys', array('keys'=>$key));
				} else {
					$data_json['success']	= false;
					$data_json['nomor']		= $nomor;
					$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ".ucwords($sync);
					$data_json['message']	= "<span class=\"label label-danger\">Gagal</span>";
				}
			}
		} else {
			$data_json['success']	= false;
			$data_json['nomor']		= $nomor;
			$data_json['button']	= "<i class=\"fa fa-check\"></i> Proses ";
			$data_json['message']	= "<span class=\"label label-danger\">Gagal</span>";
		}
		echo json_encode($data_json, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}
	
	public function export_do()
	{
		$admin_log = $this->auth->is_login_admin();
		$jenis_		= $this->uri->segment(4);
		$tahun_		= $this->uri->segment(5);
		$tipe_		= $this->uri->segment(6);
		$tipe_nama	= ($this->uri->segment(6) == 1)?'Belanja Langsung':'Belanja Tidak Langsung';
		$kecamatan_	= $this->uri->segment(7);
		
		if ($admin_log['level_kode'] == 4){
			$kecamatan_kode	= $admin_log['skpd_kode'];
		} else {
			$skpd 			= $this->Skpd_model->get('skpd_kode', array('skpd_kd' => $kecamatan_));
			$kecamatan_kode	= $skpd->skpd_kode;
		}
		
		if ($jenis_ == 4){
			
			$where['anggaran.tahun']		= $tahun_;
			$where['anggaran.tipe_kode']	= $tipe_;
			$where['anggaran.skpd_kode']	= $kecamatan_kode;
			
			$timestamp = explode(" ",microtime());
			$currenttimemilis = round(($timestamp[0]*1000000) + ($timestamp[1]*1000));
			
			$now = gmdate("D, d M Y H:i:s");
			header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
			header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
			header("Last-Modified: ".$now." GMT");
			
			header("Content-Type: application/force-download");
			header("Content-Type: application/octet-stream");
			header("Content-Type: application/download");
			
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename='.substr(nomorKegiatan($kecamatan_kode, $tahun_, 2, $tipe_, ""), 0, 11).$currenttimemilis.'.csv');
			
			$column = array();
			if ($tipe_ == 1){
				$get_column = $this->Anggaran_model->get($tipe_, 'anggaran.*, anggaran_bl.*', $where);
			} else {
				$get_column = $this->Anggaran_model->get($tipe_, 'anggaran.*, anggaran_btl.*', $where);
			}
			if ($get_column){
				foreach($get_column as $key => $row){
					$column[]	= $key;
				}
			}
			
			$column[]	= 'foto_';
			$column[]	= 'file_';
			echo $this->encryption->encode(implode(",", $column));
			echo "\n";
			
			if ($tipe_ == 1){
				$grid_data = $this->Anggaran_model->grid_all($tipe_, 'anggaran.*, anggaran_bl.*', 'anggaran.nomor', 'ASC', 0, 0, $where);
			} else {
				$grid_data = $this->Anggaran_model->grid_all($tipe_, 'anggaran.*, anggaran_btl.*', 'anggaran.nomor', 'ASC', 0, 0, $where);
			}
			
			if ($grid_data){
				foreach($grid_data as $row){
					$tmp['kode'] 					= $row->kode;
					$tmp['nomor'] 					= $row->nomor;
					$tmp['skpd_kode'] 				= $row->skpd_kode;
					$tmp['pelaksana_kode'] 			= $row->pelaksana_kode;
					$tmp['tahun'] 					= $row->tahun;
					$tmp['kegiatan'] 				= $row->kegiatan;
					$tmp['lokasi_kode'] 			= $row->lokasi_kode;
					$tmp['kecamatan_kode'] 			= $row->kecamatan_kode;
					$tmp['deskel_kode'] 			= $row->deskel_kode;
					$tmp['rw'] 						= $row->rw;
					$tmp['rt'] 						= $row->rt;
					$tmp['alamat'] 					= $row->alamat;
					$tmp['foto'] 					= $row->foto;
					$tmp['file'] 					= $row->file;
					$tmp['koordinat'] 				= $row->koordinat;
					$tmp['catatan'] 				= $row->catatan;
					$tmp['status'] 					= $row->status;
					$tmp['proses_kode'] 			= $row->proses_kode;
					$tmp['sumber_kode'] 			= $row->sumber_kode;
					$tmp['sumber_id'] 				= $row->sumber_id;
					$tmp['sumber_nomor'] 			= $row->sumber_nomor;
					$tmp['tahapan_kode'] 			= $row->tahapan_kode;
					$tmp['tanggal'] 				= $row->tanggal;
					$tmp['penambahan_kode'] 		= $row->penambahan_kode;
					$tmp['perubahan_id'] 			= $row->perubahan_id;
					$tmp['perubahan_status_kode'] 	= $row->perubahan_status_kode;
					$tmp['admin_user'] 				= $row->admin_user;
					$tmp['tipe_kode'] 				= $row->tipe_kode;
					$tmp['proposal'] 				= $row->proposal;
					$tmp['verifikasi'] 				= $row->verifikasi;
					$tmp['anggaran_kode'] 			= $row->anggaran_kode;
					$tmp['visi_kode'] 				= $row->visi_kode;
					$tmp['misi_kode'] 				= $row->misi_kode;
					$tmp['prioritas_kode'] 			= $row->prioritas_kode;
					$tmp['tujuan_kode'] 			= $row->tujuan_kode;
					$tmp['sasaran_kode'] 			= $row->sasaran_kode;
					$tmp['indikator_kode'] 			= $row->indikator_kode;
					$tmp['urusan_kode'] 			= $row->urusan_kode;
					$tmp['program_kode'] 			= $row->program_kode;
					$tmp['sifat_kode'] 				= $row->sifat_kode;
					$tmp['kesepakatan_kode'] 		= $row->kesepakatan_kode;
					$tmp['urutan'] 					= $row->urutan;
					$tmp['hp_ukur'] 				= $row->hp_ukur;
					$tmp['hp_target'] 				= $row->hp_target;
					$tmp['hp_satuan'] 				= $row->hp_satuan;
					$tmp['kh_ukur'] 				= $row->kh_ukur;
					$tmp['kh_target'] 				= $row->kh_target;
					$tmp['kh_satuan'] 				= $row->kh_satuan;
					$tmp['hk_ukur'] 				= $row->hk_ukur;
					$tmp['hk_target'] 				= $row->hk_target;
					$tmp['hk_satuan'] 				= $row->hk_satuan;
					$tmp['apbd_kab'] 				= $row->apbd_kab;
					$tmp['apbd_prov'] 				= $row->apbd_prov;
					$tmp['apbn'] 					= $row->apbn;
					$tmp['sumberlain'] 				= $row->sumberlain;
					$tmp['perkiraan_maju'] 			= $row->perkiraan_maju;
					
					if ($row->foto){
						$tmp_foto	= array();
						$foto 		= explode(";",$row->foto);
						$i 			= 0;
						foreach($foto as $row_foto){
							if ($row_foto){
								if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row_foto)){
									$tmp_foto[$i]	= file_get_content(base_url("/public/uploads/pictures/musrenbang_kecamatan/".$row_foto));
									$i++;
								}
							}
						}
						$tmp['foto_'] 				= implode(";",$tmp_foto);
					} else {
						$tmp['foto_'] 				= '';
					}
					
					
					if ($row->file){
						if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$row->file)){
							$tmp['file_'] 			= file_get_content(base_url("public/uploads/documents/musrenbang_kecamatan/".$row->file));;
						}
					} else {
						$tmp['file_'] 				= '';
					}
					
					echo $this->encryption->encode(implode(",", (array)$tmp));
					echo "\n"; 
				}
			}
		}
	}
	
	public function belanja_langsung()
	{
		$admin_log = $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '4'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '4'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('musrenbang/kecamatan/#warningEntri', 'refresh');
		} else {
			
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 5;
			$container['content']['view']					= 'musrenbang/kecamatan/belanja_langsung/add';
			
			if ($admin_log['level_kode'] == 4){
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
				$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
				$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
				$container['content']['dataset']['kecamatan_aktive']= 'no';
			} else {
				$container['content']['dataset']['kecamatan_aktive']= 'yes';
			}
			
			$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
			$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
			$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
			if ($admin_log['level_kode'] == 4){
				$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
				$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$deskel->skpd_kd));
			}
			$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
			$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function insert(){
		$admin_log = $this->auth->is_login_admin();
		$type = $this->uri->segment(4);
		if ($type == 'bl'){
			$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|xss_clean');
			$this->form_validation->set_rules('skpd_kode', 'SKPD Pelaksana', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sifat_kode', 'Jenis Kegiatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kesepakatan_kode', 'Kesepakatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('apbd_kab', 'Asumsi Biaya', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kecamatan_kode', 'Kecamatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('deskel_kode', 'Desa/Kecamatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$container['sidebar']['view']					= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] = 5;
				$container['content']['view']					= 'musrenbang/kecamatan/belanja_langsung/add';
				if ($admin_log['level_kode'] == 4){
					$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
					$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
					$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
					$container['content']['dataset']['kecamatan_aktive']= 'no';
				} else {
					$container['content']['dataset']['kecamatan_aktive']= 'yes';
				}
				$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
				$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
				$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
				if ($admin_log['level_kode'] == 4){
					$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$deskel->skpd_kd));
				}
				$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
				$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');
				$header['admin_log']							= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
				
			} else {
				$file = upload_file("file", "./public/uploads/documents/musrenbang_kecamatan/");
				if ($file){
					$insert['file']		= $file;
				}
				
				$delete_file 	= $this->input->post('delete_file');
				if ($delete_file != ""){
					if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$delete_file)){
						unlink('./public/uploads/documents/musrenbang_kecamatan/'.$delete_file);
					}
					$insert['file']		= '';
				}
				
				$filename 		= array();
				$foto 			= $this->input->post('foto');
				$delete_foto 	= $this->input->post('delete_foto');
				if ($foto){
					foreach($foto as $row){
						if ($row){
							$filename[]	= $row;
						}
					}
				} 
				$files = $_FILES;
				$cpt = count($_FILES['photo']['tmp_name']);
				if ($cpt > 0){				
					for($i=0; $i<$cpt; $i++)
					{
						$_FILES['photo']['name']		= $files['photo']['name'][$i];
						$_FILES['photo']['type']		= $files['photo']['type'][$i];
						$_FILES['photo']['tmp_name']	= $files['photo']['tmp_name'][$i];
						$_FILES['photo']['error']		= $files['photo']['error'][$i];
						$_FILES['photo']['size']		= $files['photo']['size'][$i];
						$file_name 						= upload_image_thumb('photo', './public/uploads/pictures/musrenbang_kecamatan/', '800x600');
						if ($file_name){
							$filename[] = $file_name;
						}
					}
					$insert['foto']				= implode(';', $filename);
				}
				
				if ($delete_foto){
					foreach($delete_foto as $row){
						if ($row){
							if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row)){
								unlink('./public/uploads/pictures/musrenbang_kecamatan/'.$row);
							}
						}
					}
				}
				
				$skpd = $this->Skpd_model->get('skpd.skpd_kode', array('skpd.skpd_kd'=>$this->input->post('kecamatan_kode')));
				$insert['skpd_kode']		= $skpd->skpd_kode;
				$insert['nomor']			= nomorKegiatan($skpd->skpd_kode, $this->input->post('tahun'), 4, 1, $this->input->post('nomor'));
				$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
				$insert['tahun']			= $this->input->post('tahun');
				$insert['kegiatan']			= $this->input->post('kegiatan');
				$insert['lokasi_kode']		= $this->input->post('lokasi_kode');
				$insert['kecamatan_kode']	= $this->input->post('kecamatan_kode');
				$insert['deskel_kode']		= $this->input->post('deskel_kode');
				$insert['alamat']			= $this->input->post('alamat');
				$insert['koordinat']		= $this->input->post('koordinat');
				$insert['catatan']			= $this->input->post('catatan');
				$insert['status']			= 1;
				$insert['proses_kode']		= 1;
				$insert['sumber_kode']		= 2;
				$insert['tahapan_kode']		= 4;
				$insert['tanggal']			= date("Y-m-d h:i:s");
				$insert['penambahan_kode']	= 1;
				$insert['admin_user']		= $admin_log['username'];
				$insert['tipe_kode']		= 1;
				$insert['proposal']			= ($this->input->post('proposal'))?'a':'t';
				$insert['verifikasi']		= ($this->input->post('verifikasi'))?'s':'b';
				$this->Anggaran_model->insert('anggaran', $insert); // Insert Anggaran
				
				//Insert Anggaran Belanja Langsung
				$anggaran = $this->Anggaran_model->getOnly('kode', array('admin_user'=>$admin_log['username'], 'tipe_kode'=>1));
				$insert_bl['anggaran_kode']		= $anggaran->kode;
				$insert_bl['sifat_kode']		= $this->input->post('sifat_kode');
				$insert_bl['kesepakatan_kode']	= $this->input->post('kesepakatan_kode');
				$insert_bl['urutan']			= $this->input->post('urutan');
				$insert_bl['hk_ukur']			= $this->input->post('hk_ukur');
				$insert_bl['hk_target']			= $this->input->post('hk_target');
				$insert_bl['hk_satuan']			= $this->input->post('hk_satuan');
				$insert_bl['apbd_kab']			= $this->input->post('apbd_kab');
											
				$this->Anggaran_model->insert('anggaran_bl', $insert_bl);
				
				redirect('musrenbang/kecamatan/#successInsert', 'refresh');
			}
			
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
				$container['sidebar']['view']					= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] = 5;
				$container['content']['view']					= 'musrenbang/kecamatan/belanja_langsung/add';
				if ($admin_log['level_kode'] == 4){
					$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
					$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
					$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
					$container['content']['dataset']['kecamatan_aktive']= 'no';
				} else {
					$container['content']['dataset']['kecamatan_aktive']= 'yes';
				}
				$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
				$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
				$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
				if ($admin_log['level_kode'] == 4){
					$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$deskel->skpd_kd));
				}
				$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
				$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');
				$header['admin_log']							= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
				
			} else {
				$file = upload_file("file", "./public/uploads/documents/musrenbang_kecamatan/");
				if ($file){
					$insert['file']		= $file;
				}
				
				$delete_file 	= $this->input->post('delete_file');
				if ($delete_file != ""){
					if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$delete_file)){
						unlink('./public/uploads/documents/musrenbang_kecamatan/'.$delete_file);
					}
					$insert['file']		= '';
				}
				
				$filename 		= array();
				$foto 			= $this->input->post('foto');
				$delete_foto 	= $this->input->post('delete_foto');
				if ($foto){
					foreach($foto as $row){
						if ($row){
							$filename[]	= $row;
						}
					}
				} 
				$files = $_FILES;
				$cpt = count($_FILES['photo']['tmp_name']);
				if ($cpt > 0){				
					for($i=0; $i<$cpt; $i++)
					{
						$_FILES['photo']['name']		= $files['photo']['name'][$i];
						$_FILES['photo']['type']		= $files['photo']['type'][$i];
						$_FILES['photo']['tmp_name']	= $files['photo']['tmp_name'][$i];
						$_FILES['photo']['error']		= $files['photo']['error'][$i];
						$_FILES['photo']['size']		= $files['photo']['size'][$i];
						$file_name 						= upload_image_thumb('photo', './public/uploads/pictures/musrenbang_kecamatan/', '800x600');
						if ($file_name){
							$filename[] = $file_name;
						}
					}
					$insert['foto']				= implode(';', $filename);
				}
				
				if ($delete_foto){
					foreach($delete_foto as $row){
						if ($row){
							if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row)){
								unlink('./public/uploads/pictures/musrenbang_kecamatan/'.$row);
							}
						}
					}
				}
				
				$skpd = $this->Skpd_model->get('skpd.skpd_kode', array('skpd.skpd_kd'=>$this->input->post('kecamatan_kode')));
				$insert['skpd_kode']		= $skpd->skpd_kode;
				$insert['nomor']			= nomorKegiatan($skpd->skpd_kode, $this->input->post('tahun'), 4, 2, $this->input->post('nomor'));
				$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
				$insert['tahun']			= $this->input->post('tahun');
				$insert['kegiatan']			= $this->input->post('kegiatan');
				$insert['lokasi_kode']		= $this->input->post('lokasi_kode');
				$insert['kecamatan_kode']	= $this->input->post('kecamatan_kode');
				$insert['deskel_kode']		= $this->input->post('deskel_kode');
				$insert['alamat']			= $this->input->post('alamat');
				$insert['koordinat']		= $this->input->post('koordinat');
				$insert['catatan']			= $this->input->post('catatan');
				$insert['status']			= 1;
				$insert['proses_kode']		= 1;
				$insert['sumber_kode']		= 2;
				$insert['tahapan_kode']		= 4;
				$insert['tanggal']			= date("Y-m-d h:i:s");
				$insert['penambahan_kode']	= 1;
				$insert['admin_user']		= $admin_log['username'];
				$insert['tipe_kode']		= 2;
				$insert['proposal']			= ($this->input->post('proposal'))?'a':'t';
				$insert['verifikasi']		= ($this->input->post('verifikasi'))?'s':'b';
				$this->Anggaran_model->insert('anggaran', $insert); // Insert Anggaran
				
				//Insert Anggaran Belanja Langsung
				$anggaran = $this->Anggaran_model->getOnly('kode', array('admin_user'=>$admin_log['username'], 'tipe_kode'=>2));
				$insert_btl['anggaran_kode']	= $anggaran->kode;
				$insert_btl['volume']			= $this->input->post('volume');
				$insert_btl['biaya']			= $this->input->post('biaya');
				$insert_btl['penerima']			= $this->input->post('penerima');
											
				$this->Anggaran_model->insert('anggaran_btl', $insert_btl);
				
				redirect('musrenbang/kecamatan/#successInsert', 'refresh');
			}
		}
	}
	
	public function delete()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('status, sumber_id, foto, file', array('kode'=>$kode));
		if ($anggaran->status == 1){
			//Update Sumber Anggaran
			$this->Anggaran_model->update('anggaran', array('status'=>'1'), array('kode' => $anggaran->sumber_id)); 
			
			if ($anggaran->foto){
				$foto = explode(';', $anggaran->foto);
				if ($foto){
					foreach($foto as $row){
						if ($row){
							if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row)){
								unlink('./public/uploads/pictures/musrenbang_kecamatan/'.$row);
							}
						}
					}
				}
			}
			if ($anggaran->file){
				if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$anggaran->file)){
					unlink('./public/uploads/documents/musrenbang_kecamatan/'.$anggaran->file);
				}
			}
			$this->Anggaran_model->delete('anggaran', array('kode' => $this->uri->segment(4)));
			$this->Anggaran_model->delete('anggaran_bl', array('anggaran_kode' => $this->uri->segment(4)));
			$this->Anggaran_model->delete('anggaran_btl', array('anggaran_kode' => $this->uri->segment(4)));
			redirect('musrenbang/kecamatan/#successDelete', 'refresh');
		} else {
			redirect('musrenbang/kecamatan/#warningTransfer', 'refresh');
		}

		redirect('musrenbang/kecamatan', 'refresh');
	}
	
	public function detail()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));
		
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 5;
		if ($anggaran->tipe_kode == 1){
			$anggaran_bl										= $this->Anggaran_model->get('1','anggaran.kode, anggaran.deskel_kode, anggaran.kecamatan_kode, anggaran.nomor, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.file, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran_bl.hk_ukur, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, urusan.urusan as urusan_nama, program.program as program_nama', array('anggaran.kode'=>$kode));
			$container['content']['view']						= 'musrenbang/kecamatan/belanja_langsung/detail';
			$container['content']['dataset']['kode'] 			= $anggaran_bl->kode;
			$container['content']['dataset']['nomor'] 			= intval(substr($anggaran_bl->nomor, -5));
			$container['content']['dataset']['nomor_'] 			= $anggaran_bl->nomor;
			$container['content']['dataset']['tahun'] 			= $anggaran_bl->tahun;
			$container['content']['dataset']['skpd'] 			= $anggaran_bl->skpd_nama;
			$container['content']['dataset']['kegiatan'] 		= $anggaran_bl->kegiatan;
			$container['content']['dataset']['jenis_kegiatan'] 	= $anggaran_bl->sifat_nama;
			$container['content']['dataset']['kesepakatan'] 	= $anggaran_bl->kesepakatan_nama;
			$container['content']['dataset']['urutan'] 			= $anggaran_bl->urutan;
			$container['content']['dataset']['biaya'] 			= $anggaran_bl->apbd_kab;
			$container['content']['dataset']['hk_ukur'] 		= $anggaran_bl->hk_ukur;
			$container['content']['dataset']['hk_target'] 		= $anggaran_bl->hk_target;
			$container['content']['dataset']['hk_satuan'] 		= $anggaran_bl->hk_satuan;
			$container['content']['dataset']['alamat'] 			= $anggaran_bl->alamat;
			$container['content']['dataset']['rt'] 				= $anggaran_bl->rt;
			$container['content']['dataset']['rw'] 				= $anggaran_bl->rw;
			$container['content']['dataset']['deskel_kode'] 	= $anggaran_bl->deskel_kode;
			$container['content']['dataset']['deskel'] 			= $anggaran_bl->deskel_nama;
			$container['content']['dataset']['kecamatan_kode']	= $anggaran_bl->kecamatan_kode;
			$container['content']['dataset']['kecamatan'] 		= $anggaran_bl->kecamatan_nama;
			$container['content']['dataset']['proposal'] 		= ($anggaran_bl->proposal == 'a')?'checked':'';
			$container['content']['dataset']['verifikasi'] 		= ($anggaran_bl->verifikasi == 's')?'checked':'';
			$container['content']['dataset']['foto'] 			= $anggaran_bl->foto;
			$container['content']['dataset']['file'] 			= $anggaran_bl->file;
			$container['content']['dataset']['koordinat'] 		= $anggaran_bl->koordinat;
			$container['content']['dataset']['catatan'] 		= $anggaran_bl->catatan;
		} else { 
			$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.kode, anggaran.nomor, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.file, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_btl.volume, anggaran_btl.biaya, anggaran_btl.penerima, pelaksana.skpd_nama', array('anggaran.kode'=>$kode));
			$container['content']['view']					= 'musrenbang/kecamatan/belanja_tidak_langsung/detail';
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
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function edit()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '4'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '4'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('musrenbang/kecamatan/#warningEntri', 'refresh');
		} else {
			
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode, status', array('kode'=>$kode));
			
			if ($anggaran->status == 1){
				$container['sidebar']['view']						= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] 	= 5;
				if ($anggaran->tipe_kode == 1){
					$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.urusan_kode, anggaran_bl.program_kode, anggaran_bl.sifat_kode, anggaran_bl.kesepakatan_kode, anggaran_bl.urutan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, anggaran_bl.apbd_kab', array('anggaran.kode'=>$kode));
					
					$container['content']['view']					= 'musrenbang/kecamatan/belanja_langsung/edit';
					
					if ($admin_log['level_kode'] == 4){
						$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
						$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
						$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
						$container['content']['dataset']['kecamatan_aktive']= 'no';
					} else {
						$container['content']['dataset']['kecamatan_aktive']= 'yes';
					}
					
					$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
					$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
					$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
					if ($admin_log['level_kode'] == 4){
						$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
						$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$deskel->skpd_kd));
					} else {
						$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_bl->kecamatan_kode));
					}
					$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
					$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');

					$container['content']['dataset']['kode'] 		= $anggaran_bl->kode;
					$container['content']['dataset']['nomor'] 		= intval(substr($anggaran_bl->nomor, -5));
					$container['content']['dataset']['nomor_'] 		= $anggaran_bl->nomor;
					$container['content']['dataset']['tahun_'] 		= $anggaran_bl->tahun;
					$container['content']['dataset']['skpd_kode'] 	= $anggaran_bl->skpd_kode;
					$container['content']['dataset']['skpd_'] 		= $anggaran_bl->pelaksana_kode;
					$container['content']['dataset']['kegiatan'] 	= $anggaran_bl->kegiatan;
					$container['content']['dataset']['sifat_'] 		= $anggaran_bl->sifat_kode;
					$container['content']['dataset']['kesepakatan_'] = $anggaran_bl->kesepakatan_kode;
					$container['content']['dataset']['urutan'] 		= $anggaran_bl->urutan;
					$container['content']['dataset']['apbd_kab'] 	= $anggaran_bl->apbd_kab;
					$container['content']['dataset']['hk_ukur'] 	= $anggaran_bl->hk_ukur;
					$container['content']['dataset']['hk_target'] 	= $anggaran_bl->hk_target;
					$container['content']['dataset']['hk_satuan'] 	= $anggaran_bl->hk_satuan;
					$container['content']['dataset']['alamat'] 		= $anggaran_bl->alamat;
					$container['content']['dataset']['rt'] 			= $anggaran_bl->rt;
					$container['content']['dataset']['rw'] 			= $anggaran_bl->rw;
					$container['content']['dataset']['deskel_'] 	= $anggaran_bl->deskel_kode;
					$container['content']['dataset']['kecamatan_'] 	= $anggaran_bl->kecamatan_kode;
					$container['content']['dataset']['proposal'] 	= ($anggaran_bl->proposal == 'a')?'checked':'';
					$container['content']['dataset']['verifikasi'] 	= ($anggaran_bl->verifikasi == 's')?'checked':'';
					$container['content']['dataset']['foto'] 		= $anggaran_bl->foto;
					$container['content']['dataset']['file'] 		= $anggaran_bl->file;
					$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
				} else {
					$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.*, anggaran_btl.biaya, anggaran_btl.volume, , anggaran_btl.penerima', array('anggaran.kode'=>$kode));
					$container['content']['view']					= 'musrenbang/kecamatan/belanja_tidak_langsung/edit';
					
					if ($admin_log['level_kode'] == 4){
						$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
						$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
						$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
						$container['content']['dataset']['kecamatan_aktive']= 'no';
					} else {
						$container['content']['dataset']['kecamatan_aktive']= 'yes';
					}
					
					$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
					$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
					$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
					if ($admin_log['level_kode'] == 4){
						$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
						$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$deskel->skpd_kd));
					} else {
						$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_btl->kecamatan_kode));
					}

					$container['content']['dataset']['kode'] 		= $anggaran_btl->kode;
					$container['content']['dataset']['nomor'] 		= intval(substr($anggaran_btl->nomor, -5));
					$container['content']['dataset']['tahun_'] 		= $anggaran_btl->tahun;
					$container['content']['dataset']['skpd_kode'] 	= $anggaran_btl->skpd_kode;
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
					$container['content']['dataset']['file'] 		= $anggaran_btl->file;
					$container['content']['dataset']['koordinat'] 	= $anggaran_btl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_btl->catatan;
				}
				$header['admin_log']								= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
			} else {
				redirect('musrenbang/kecamatan/#warningTransfer', 'refresh');
			}
		}
	}
	
	public function update(){
		$admin_log 	= $this->auth->is_login_admin();
		$type 		= $this->uri->segment(4);
		$kode 		= $this->uri->segment(5);
		if ($type == 'bl'){
			$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|xss_clean');
			$this->form_validation->set_rules('skpd_kode', 'SKPD Pelaksana', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sifat_kode', 'Jenis Kegiatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kesepakatan_kode', 'Kesepakatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('apbd_kab', 'Asumsi Biaya', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kecamatan_kode', 'Kecamatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('deskel_kode', 'Desa/Kecamatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$container['sidebar']['view']					= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] = 5;
				$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.urusan_kode, anggaran_bl.program_kode, anggaran_bl.sifat_kode, anggaran_bl.kesepakatan_kode, anggaran_bl.urutan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, anggaran_bl.apbd_kab', array('anggaran.kode'=>$kode));
			
				$container['content']['view']					= 'musrenbang/kecamatan/belanja_langsung/edit';
				
				if ($admin_log['level_kode'] == 4){
					$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
					$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
					$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
					$container['content']['dataset']['kecamatan_aktive']= 'no';
				} else {
					$container['content']['dataset']['kecamatan_aktive']= 'yes';
				}
				
				$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
				$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
				$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
				if ($admin_log['level_kode'] == 4){
					$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$deskel->skpd_kd));
				} else {
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_bl->kecamatan_kode));
				}
				$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
				$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');

				$container['content']['dataset']['kode'] 		= $anggaran_bl->kode;
				$container['content']['dataset']['nomor'] 		= intval(substr($anggaran_bl->nomor, -5));
				$container['content']['dataset']['nomor_'] 		= $anggaran_bl->nomor;
				$container['content']['dataset']['tahun_'] 		= $anggaran_bl->tahun;
				$container['content']['dataset']['skpd_kode'] 	= $anggaran_bl->skpd_kode;
				$container['content']['dataset']['skpd_'] 		= $anggaran_bl->pelaksana_kode;
				$container['content']['dataset']['kegiatan'] 	= $anggaran_bl->kegiatan;
				$container['content']['dataset']['sifat_'] 		= $anggaran_bl->sifat_kode;
				$container['content']['dataset']['kesepakatan_'] = $anggaran_bl->kesepakatan_kode;
				$container['content']['dataset']['urutan'] 		= $anggaran_bl->urutan;
				$container['content']['dataset']['apbd_kab'] 	= $anggaran_bl->apbd_kab;
				$container['content']['dataset']['hk_ukur'] 	= $anggaran_bl->hk_ukur;
				$container['content']['dataset']['hk_target'] 	= $anggaran_bl->hk_target;
				$container['content']['dataset']['hk_satuan'] 	= $anggaran_bl->hk_satuan;
				$container['content']['dataset']['alamat'] 		= $anggaran_bl->alamat;
				$container['content']['dataset']['rt'] 			= $anggaran_bl->rt;
				$container['content']['dataset']['rw'] 			= $anggaran_bl->rw;
				$container['content']['dataset']['deskel_'] 	= $anggaran_bl->deskel_kode;
				$container['content']['dataset']['kecamatan_'] 	= $anggaran_bl->kecamatan_kode;
				$container['content']['dataset']['proposal'] 	= ($anggaran_bl->proposal == 'a')?'checked':'';
				$container['content']['dataset']['verifikasi'] 	= ($anggaran_bl->verifikasi == 's')?'checked':'';
				$container['content']['dataset']['foto'] 		= $anggaran_bl->foto;
				$container['content']['dataset']['file'] 		= $anggaran_bl->file;
				$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
				$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
				
				$header['admin_log']							= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
				
			} else {
				$file = upload_file("file", "./public/uploads/documents/musrenbang_kecamatan/");
				if ($file){
					$update['file']		= $file;
				}
				
				$delete_file 	= $this->input->post('delete_file');
				if ($delete_file != ""){
					if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$delete_file)){
						unlink('./public/uploads/documents/musrenbang_kecamatan/'.$delete_file);
					}
					$update['file']		= '';
				}
				
				$filename 		= array();
				$foto 			= $this->input->post('foto');
				$delete_foto 	= $this->input->post('delete_foto');
				if ($foto){
					foreach($foto as $row){
						if ($row){
							$filename[]	= $row;
						}
					}
				} 
				$files = $_FILES;
				$cpt = count($_FILES['photo']['tmp_name']);
				if ($cpt > 0){				
					for($i=0; $i<$cpt; $i++)
					{
						$_FILES['photo']['name']		= $files['photo']['name'][$i];
						$_FILES['photo']['type']		= $files['photo']['type'][$i];
						$_FILES['photo']['tmp_name']	= $files['photo']['tmp_name'][$i];
						$_FILES['photo']['error']		= $files['photo']['error'][$i];
						$_FILES['photo']['size']		= $files['photo']['size'][$i];
						$file_name 						= upload_image_thumb('photo', './public/uploads/pictures/musrenbang_kecamatan/', '800x600');
						if ($file_name){
							$filename[] = $file_name;
						}
					}
					$update['foto']				= implode(';', $filename);
				}
				
				if ($delete_foto){
					foreach($delete_foto as $row){
						if ($row){
							if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row)){
								unlink('./public/uploads/pictures/musrenbang_kecamatan/'.$row);
							}
						}
					}
				}
				
				$skpd = $this->Skpd_model->get('skpd.skpd_kode', array('skpd.skpd_kd'=>$this->input->post('kecamatan_kode')));
				$update['skpd_kode']		= $skpd->skpd_kode;
				$update['pelaksana_kode']	= $this->input->post('skpd_kode');
				$update['tahun']			= $this->input->post('tahun');
				$update['kegiatan']			= $this->input->post('kegiatan');
				$update['lokasi_kode']		= $this->input->post('lokasi_kode');
				$update['kecamatan_kode']	= $this->input->post('kecamatan_kode');
				$update['deskel_kode']		= $this->input->post('deskel_kode');
				$update['alamat']			= $this->input->post('alamat');
				$update['koordinat']		= $this->input->post('koordinat');
				$update['catatan']			= $this->input->post('catatan');
				$update['status']			= 1;
				$update['proses_kode']		= 1;
				$update['sumber_kode']		= 2;
				$update['tahapan_kode']		= 4;
				$update['tanggal']			= date("Y-m-d h:i:s");
				$update['penambahan_kode']	= 1;
				$update['admin_user']		= $admin_log['username'];
				$update['tipe_kode']		= 1;
				$update['proposal']			= ($this->input->post('proposal'))?'a':'t';
				$update['verifikasi']		= ($this->input->post('verifikasi'))?'s':'b';
				$this->Anggaran_model->update('anggaran', $update, array('kode'=>$kode)); // Update Anggaran
				
				//Update Anggaran Belanja Langsung
				$update_bl['sifat_kode']		= $this->input->post('sifat_kode');
				$update_bl['kesepakatan_kode']	= $this->input->post('kesepakatan_kode');
				$update_bl['urutan']			= $this->input->post('urutan');
				$insert_bl['hk_ukur']			= $this->input->post('hk_ukur');
				$insert_bl['hk_target']			= $this->input->post('hk_target');
				$insert_bl['hk_satuan']			= $this->input->post('hk_satuan');
				$update_bl['apbd_kab']			= $this->input->post('apbd_kab');
											
				$this->Anggaran_model->update('anggaran_bl', $update_bl, array('anggaran_kode'=>$kode));
				
				redirect('musrenbang/kecamatan/#successUpdate', 'refresh');
			}
			
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
				$container['sidebar']['view']					= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] = 5;
				$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.kode, anggaran.nomor, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.file, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran_bl.hk_ukur, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_btl.volume, anggaran_btl.biaya, anggaran_btl.penerima, pelaksana.skpd_nama', array('anggaran.kode'=>$kode));
				
				$container['content']['view']					= 'musrenbang/kecamatan/belanja_tidak_langsung/edit';
				
				if ($admin_log['level_kode'] == 4){
					$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
					$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
					$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
					$container['content']['dataset']['kecamatan_aktive']= 'no';
				} else {
					$container['content']['dataset']['kecamatan_aktive']= 'yes';
				}
				
				$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
				$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
				$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
				if ($admin_log['level_kode'] == 4){
					$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$deskel->skpd_kd));
				} else {
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_btl->kecamatan_kode));
				}

				$container['content']['dataset']['kode'] 		= $anggaran_btl->kode;
				$container['content']['dataset']['nomor'] 		= intval(substr($anggaran_btl->nomor, -5));
				$container['content']['dataset']['tahun_'] 		= $anggaran_btl->tahun;
				$container['content']['dataset']['skpd_kode'] 	= $anggaran_btl->skpd_kode;
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
				$container['content']['dataset']['file'] 		= $anggaran_btl->file;
				$container['content']['dataset']['koordinat'] 	= $anggaran_btl->koordinat;
				$container['content']['dataset']['catatan'] 	= $anggaran_btl->catatan;

				$header['admin_log']							= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
				
			} else {
				$file = upload_file("file", "./public/uploads/documents/musrenbang_kecamatan/");
				if ($file){
					$update['file']		= $file;
				}
				
				$delete_file 	= $this->input->post('delete_file');
				if ($delete_file != ""){
					if (file_exists('./public/uploads/documents/musrenbang_kecamatan/'.$delete_file)){
						unlink('./public/uploads/documents/musrenbang_kecamatan/'.$delete_file);
					}
					$update['file']		= '';
				}
				
				$filename 		= array();
				$foto 			= $this->input->post('foto');
				$delete_foto 	= $this->input->post('delete_foto');
				if ($foto){
					foreach($foto as $row){
						if ($row){
							$filename[]	= $row;
						}
					}
				} 
				$files = $_FILES;
				$cpt = count($_FILES['photo']['tmp_name']);
				if ($cpt > 0){				
					for($i=0; $i<$cpt; $i++)
					{
						$_FILES['photo']['name']		= $files['photo']['name'][$i];
						$_FILES['photo']['type']		= $files['photo']['type'][$i];
						$_FILES['photo']['tmp_name']	= $files['photo']['tmp_name'][$i];
						$_FILES['photo']['error']		= $files['photo']['error'][$i];
						$_FILES['photo']['size']		= $files['photo']['size'][$i];
						$file_name 						= upload_image_thumb('photo', './public/uploads/pictures/musrenbang_kecamatan/', '800x600');
						if ($file_name){
							$filename[] = $file_name;
						}
					}
					$update['foto']				= implode(';', $filename);
				}
				
				if ($delete_foto){
					foreach($delete_foto as $row){
						if ($row){
							if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row)){
								unlink('./public/uploads/pictures/musrenbang_kecamatan/'.$row);
							}
						}
					}
				}
				
				$skpd = $this->Skpd_model->get('skpd.skpd_kode', array('skpd.skpd_kd'=>$this->input->post('kecamatan_kode')));
				$update['skpd_kode']		= $skpd->skpd_kode;
				$update['pelaksana_kode']	= $this->input->post('skpd_kode');
				$update['tahun']			= $this->input->post('tahun');
				$update['kegiatan']			= $this->input->post('kegiatan');
				$update['lokasi_kode']		= $this->input->post('lokasi_kode');
				$update['kecamatan_kode']	= $this->input->post('kecamatan_kode');
				$update['deskel_kode']		= $this->input->post('deskel_kode');
				$update['alamat']			= $this->input->post('alamat');
				$update['koordinat']		= $this->input->post('koordinat');
				$update['catatan']			= $this->input->post('catatan');
				$update['status']			= 1;
				$update['proses_kode']		= 1;
				$update['sumber_kode']		= 2;
				$update['tahapan_kode']		= 4;
				$update['tanggal']			= date("Y-m-d h:i:s");
				$update['penambahan_kode']	= 1;
				$update['admin_user']		= $admin_log['username'];
				$update['tipe_kode']		= 2;
				$update['proposal']			= ($this->input->post('proposal'))?'a':'t';
				$update['verifikasi']		= ($this->input->post('verifikasi'))?'s':'b';
				$this->Anggaran_model->update('anggaran', $update, array('kode'=>$kode)); // Insert Anggaran
				
				//Update Anggaran Belanja Tidak Langsung
				$update_btl['volume']			= $this->input->post('volume');
				$update_btl['biaya']			= $this->input->post('biaya');
				$update_btl['penerima']			= $this->input->post('penerima');
											
				$this->Anggaran_model->update('anggaran_btl', $update_btl, array('anggaran_kode' => $kode));
				
				redirect('musrenbang/kecamatan/#successUpdate', 'refresh');
			}
		}
	}
	
	public function belanja_tidak_langsung()
	{
		$admin_log = $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '4'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '4'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('musrenbang/kecamatan/#warningEntri', 'refresh');
		} else {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 5;
			$container['content']['view']					= 'musrenbang/kecamatan/belanja_tidak_langsung/add';
			
			if ($admin_log['level_kode'] == 4){
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
				$container['content']['dataset']['kecamatan_kode']	= $skpd->skpd_kd;
				$container['content']['dataset']['kecamatan_nama']	= $skpd->skpd_nama;
				$container['content']['dataset']['kecamatan_aktive']= 'no';
			} else {
				$container['content']['dataset']['kecamatan_aktive']= 'yes';
			}
			
			$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
			$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
			$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
			if ($admin_log['level_kode'] == 4){
				$deskel = $this->Skpd_model->get('skpd_kd', array('skpd_kode' => $admin_log['skpd_kode']));
				$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$deskel->skpd_kd));
			}
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function transfer()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '6'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '6'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('musrenbang/kecamatan/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode, status', array('kode'=>$kode));
			
			if ($anggaran->status == 1){
				$container['sidebar']['view']						= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] 	= 5;
				$container['sidebar']['dataset']['admin_log'] 		= $admin_log;
				if ($anggaran->tipe_kode == 1){
					$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode as kode_anggaran, anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.*', array('anggaran.kode'=>$kode));
					
					$container['content']['view']					= 'musrenbang/kecamatan/belanja_langsung/transfer';
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
					$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
					$where_skpd										= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
					$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);
					$container['content']['dataset']['visi']		= $this->Visi_model->get('kode, visi', array('kode' => '1'));
					$where_misi										= "skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."' OR misi.kode='5'";
					$container['content']['dataset']['misi']		= $this->Indikator_skpd_model->grid_all('misi.kode as misi_kode, misi.misi as misi_nama', 'misi.misi', 'ASC', '', '', $where_misi, '', 'misi.kode');
					$container['content']['dataset']['prioritas']	= $this->Prioritas_model->grid_all('kode, prioritas', 'prioritas', 'ASC');
					$where_tujuan									= "skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."' OR tujuan.kode='1'";
					$container['content']['dataset']['tujuan']		= $this->Indikator_skpd_model->grid_all('tujuan.kode as tujuan_kode, tujuan.tujuan as tujuan_nama', 'tujuan.tujuan', 'ASC', '', '', $where_tujuan, '', 'tujuan.kode');
					if ($anggaran_bl->tujuan_kode == 1){
						$where_sasaran = "sasaran.tujuan IN ('1')";
					} else {
						$where_sasaran = "tujuan.kode='".$anggaran_bl->tujuan_kode."' AND skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."'";
					}
					$container['content']['dataset']['sasaran']		= $this->Indikator_skpd_model->grid_all('sasaran.kode as sasaran_kode, sasaran.sasaran as sasaran_nama', 'sasaran.sasaran', 'ASC', '', '', $where_sasaran, '', 'sasaran.kode');
					if ($anggaran_bl->sasaran_kode == 1){
						$where_indikator = "sasaran.kode IN ('1')";
					} else {
						$where_indikator = "sasaran.kode='".$anggaran_bl->sasaran_kode."' AND skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."'";
					}
					$container['content']['dataset']['indikator']	= $this->Indikator_skpd_model->grid_all('indikator.kode as indikator_kode, indikator.indikator as indikator_nama', 'indikator.indikator', 'ASC', '', '', $where_indikator, '', 'indikator.kode');
					$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
					$where_deskel									= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
					$like_deskel['skpd_kd']							= $anggaran_bl->kecamatan_kode;
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_deskel, $like_deskel);
					$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
					$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');
					if ($anggaran_bl->tujuan_kode == 1){
						$where_urusan = "urusan.kode='1'";
					} else {
						$where_urusan = "skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."' AND skpd_indikator.indikator='".$anggaran_bl->indikator_kode."'";
					}
					$container['content']['dataset']['urusan']		= $this->Indikator_skpd_model->grid_all('urusan.kode as urusan_kode, urusan.urusan as urusan_nama', 'urusan.urusan', 'ASC', '', '', $where_urusan, '', 'urusan.kode');
					if ($anggaran_bl->urusan_kode == 1){
						$where_program	= "program.urusan IN ('1')";
					} else {
						$where_program 	= "urusan.kode='".$anggaran_bl->urusan_kode."' AND skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."' OR program.kode='136'";
					}
					$container['content']['dataset']['program']		= $this->Indikator_skpd_model->grid_all('program.kode as program_kode, program.program as program_nama', 'program.program', 'ASC', '', '', $where_program, '', 'program.kode');
					
					if ($anggaran_bl->urusan_kode == 1){
						$container['content']['dataset']['key'] 			= 'yes';
						$jml_kegiatan										= $this->db->query("SELECT kegiatan FROM program_kegiatan WHERE program='".$anggaran_bl->program_kode."' AND kegiatan='".$anggaran_bl->kegiatan."'")->num_rows();
						$container['content']['dataset']['jml_kegiatan']	= $jml_kegiatan;
						if ($jml_kegiatan == 0){
							$where_kegiatan = "program='".$anggaran_bl->program_kode."' OR no='999'";
							$container['content']['dataset']['kegiatan'] 			= 'Lainnya...';
							$container['content']['dataset']['kegiatan_lainnya'] 	= $anggaran_bl->kegiatan;
						} else {
							$where_kegiatan = "program='".$anggaran_bl->program_kode."'";
							$container['content']['dataset']['kegiatan'] 	= $anggaran_bl->kegiatan;

						}
						
						$container['content']['dataset']['data_kegiatan']	= $this->db->query("SELECT kegiatan FROM program_kegiatan WHERE ".$where_kegiatan)->result();
					
					} else {
						$container['content']['dataset']['key'] 			= 'no';
						$container['content']['dataset']['kegiatan'] 		= $anggaran_bl->kegiatan;
					}

					$container['content']['dataset']['kode'] 		= $anggaran_bl->kode_anggaran;
					$container['content']['dataset']['nomor'] 		= '';
					$container['content']['dataset']['nomor_'] 		= intval(substr($anggaran_bl->nomor, -5));
					$container['content']['dataset']['tahun_'] 		= $anggaran_bl->tahun;
					$container['content']['dataset']['skpd_kode'] 	= $anggaran_bl->skpd_kode;
					$container['content']['dataset']['skpd_'] 		= $anggaran_bl->pelaksana_kode;
					$container['content']['dataset']['misi_'] 		= $anggaran_bl->misi_kode;
					$container['content']['dataset']['prioritas_'] 	= $anggaran_bl->prioritas_kode;
					$container['content']['dataset']['tujuan_'] 	= $anggaran_bl->tujuan_kode;
					$container['content']['dataset']['sasaran_'] 	= $anggaran_bl->sasaran_kode;
					$container['content']['dataset']['indikator_'] 	= $anggaran_bl->indikator_kode;
					$container['content']['dataset']['urusan_'] 	= $anggaran_bl->urusan_kode;
					$container['content']['dataset']['program_'] 	= $anggaran_bl->program_kode;
					$container['content']['dataset']['sifat_'] 		= $anggaran_bl->sifat_kode;
					$container['content']['dataset']['kesepakatan_'] = $anggaran_bl->kesepakatan_kode;
					$container['content']['dataset']['urutan'] 		= $anggaran_bl->urutan;
					$container['content']['dataset']['apbd_kab'] 	= $anggaran_bl->apbd_kab;
					$container['content']['dataset']['apbd_prov'] 	= $anggaran_bl->apbd_prov;
					$container['content']['dataset']['apbn'] 		= $anggaran_bl->apbn;
					$container['content']['dataset']['sumberlain'] 	= $anggaran_bl->sumberlain;
					$container['content']['dataset']['total_asumsi'] = $anggaran_bl->apbd_kab + $anggaran_bl->apbd_prov + $anggaran_bl->apbn + $anggaran_bl->sumberlain;
					$container['content']['dataset']['perkiraan_maju'] 	= $anggaran_bl->perkiraan_maju;
					$container['content']['dataset']['hp_ukur'] 	= $anggaran_bl->hp_ukur;
					$container['content']['dataset']['hp_target'] 	= $anggaran_bl->hp_target;
					$container['content']['dataset']['hp_satuan'] 	= $anggaran_bl->hp_satuan;
					$container['content']['dataset']['kh_ukur'] 	= $anggaran_bl->kh_ukur;
					$container['content']['dataset']['kh_target'] 	= $anggaran_bl->kh_target;
					$container['content']['dataset']['kh_satuan'] 	= $anggaran_bl->kh_satuan;
					$container['content']['dataset']['hk_ukur'] 	= $anggaran_bl->hk_ukur;
					$container['content']['dataset']['hk_target'] 	= $anggaran_bl->hk_target;
					$container['content']['dataset']['hk_satuan'] 	= $anggaran_bl->hk_satuan;
					$container['content']['dataset']['alamat'] 		= $anggaran_bl->alamat;
					$container['content']['dataset']['rt'] 			= $anggaran_bl->rt;
					$container['content']['dataset']['rw'] 			= $anggaran_bl->rw;
					$container['content']['dataset']['deskel_'] 	= $anggaran_bl->deskel_kode;
					$container['content']['dataset']['kecamatan_'] 	= $anggaran_bl->kecamatan_kode;
					$container['content']['dataset']['proposal'] 	= ($anggaran_bl->proposal == 'a')?'checked':'';
					$container['content']['dataset']['verifikasi'] 	= ($anggaran_bl->verifikasi == 's')?'checked':'';
					$container['content']['dataset']['foto'] 		= $anggaran_bl->foto;
					$container['content']['dataset']['file'] 		= $anggaran_bl->file;
					$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
				} else {
					$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.*, anggaran_btl.biaya, anggaran_btl.volume, , anggaran_btl.penerima', array('anggaran.kode'=>$kode));
					$container['content']['view']					= 'musrenbang/kecamatan/belanja_tidak_langsung/transfer';
					
					$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
					$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
					$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_btl->kecamatan_kode));

					$container['content']['dataset']['kode'] 		= $anggaran_btl->kode;
					$container['content']['dataset']['nomor'] 		= '';
					$container['content']['dataset']['nomor_'] 		= intval(substr($anggaran_btl->nomor, -5));
					$container['content']['dataset']['tahun_'] 		= $anggaran_btl->tahun;
					$container['content']['dataset']['skpd_kode'] 	= $anggaran_btl->skpd_kode;
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
					$container['content']['dataset']['file'] 		= $anggaran_btl->file;
					$container['content']['dataset']['koordinat'] 	= $anggaran_btl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_btl->catatan;
				}
				$header['admin_log']								= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
			} else {
				redirect('musrenbang/kecamatan/#warningTransfer', 'refresh');
			}
		}
	}
	
	public function doTransfer(){
		$admin_log = $this->auth->is_login_admin();
		$type = $this->uri->segment(4);
		$kode = $this->uri->segment(5);
		$nomor = $this->uri->segment(6);
		if ($type == 'bl'){
			$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|xss_clean');
			$this->form_validation->set_rules('skpd_kode', 'SKPD Pelaksana', 'trim|required|xss_clean');
			$this->form_validation->set_rules('misi_kode', 'Misi', 'trim|required|xss_clean');
			$this->form_validation->set_rules('prioritas_kode', 'Prioritas', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tujuan_kode', 'Tujuan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sasaran_kode', 'Sasaran', 'trim|required|xss_clean');
			$this->form_validation->set_rules('indikator_kode', 'Indikator', 'trim|required|xss_clean');
			$this->form_validation->set_rules('urusan_kode', 'Urusan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('program_kode', 'Program', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sifat_kode', 'Jenis Kegiatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kesepakatan_kode', 'Kesepakatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('apbd_kab', 'Asumsi Biaya', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kecamatan_kode', 'Kecamatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('deskel_kode', 'Desa/Kecamatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$container['sidebar']['view']					= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] = 5;
				$container['content']['view']					= 'musrenbang/kecamatan/belanja_langsung/transfer';
				
				$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.urusan_kode, anggaran_bl.program_kode, anggaran_bl.sifat_kode, anggaran_bl.kesepakatan_kode, anggaran_bl.urutan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan, anggaran_bl.apbd_kab', array('anggaran.kode'=>$kode));
			
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
				$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
				$where_skpd										= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
				$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);
				$container['content']['dataset']['visi']		= $this->Visi_model->get('kode, visi', array('kode' => '1'));
				$where_misi										= "skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."' OR misi.kode='5'";
				$container['content']['dataset']['misi']		= $this->Indikator_skpd_model->grid_all('misi.kode as misi_kode, misi.misi as misi_nama', 'misi.misi', 'ASC', '', '', $where_misi, '', 'misi.kode');
				$container['content']['dataset']['prioritas']	= $this->Prioritas_model->grid_all('kode, prioritas', 'prioritas', 'ASC');
				$where_tujuan									= "skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."' OR tujuan.kode='1'";
				$container['content']['dataset']['tujuan']		= $this->Indikator_skpd_model->grid_all('tujuan.kode as tujuan_kode, tujuan.tujuan as tujuan_nama', 'tujuan.tujuan', 'ASC', '', '', $where_tujuan, '', 'tujuan.kode');
				if ($anggaran_bl->tujuan_kode == 1){
					$where_sasaran = "sasaran.tujuan IN ('1')";
				} else {
					$where_sasaran = "tujuan.kode='".$anggaran_bl->tujuan_kode."' AND skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."'";
				}
				$container['content']['dataset']['sasaran']		= $this->Indikator_skpd_model->grid_all('sasaran.kode as sasaran_kode, sasaran.sasaran as sasaran_nama', 'sasaran.sasaran', 'ASC', '', '', $where_sasaran, '', 'sasaran.kode');
				if ($anggaran_bl->sasaran_kode == 1){
					$where_indikator = "sasaran.kode IN ('1')";
				} else {
					$where_indikator = "sasaran.kode='".$anggaran_bl->sasaran_kode."' AND skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."'";
				}
				$container['content']['dataset']['indikator']	= $this->Indikator_skpd_model->grid_all('indikator.kode as indikator_kode, indikator.indikator as indikator_nama', 'indikator.indikator', 'ASC', '', '', $where_indikator, '', 'indikator.kode');
				$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
				$where_deskel									= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
				$like_deskel['skpd_kd']							= $anggaran_bl->kecamatan_kode;
				$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_deskel, $like_deskel);
				$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
				$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');
				if ($anggaran_bl->tujuan_kode == 1){
					$where_urusan = "urusan.kode='1'";
				} else {
					$where_urusan = "skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."' AND skpd_indikator.indikator='".$anggaran_bl->indikator_kode."'";
				}
				$container['content']['dataset']['urusan']		= $this->Indikator_skpd_model->grid_all('urusan.kode as urusan_kode, urusan.urusan as urusan_nama', 'urusan.urusan', 'ASC', '', '', $where_urusan, '', 'urusan.kode');
				if ($anggaran_bl->urusan_kode == 1){
					$where_program	= "program.urusan IN ('1')";
				} else {
					$where_program 	= "urusan.kode='".$anggaran_bl->urusan_kode."' AND skpd.skpd_kode='".$anggaran_bl->pelaksana_kode."' OR program.kode='136'";
				}
				$container['content']['dataset']['program']		= $this->Indikator_skpd_model->grid_all('program.kode as program_kode, program.program as program_nama', 'program.program', 'ASC', '', '', $where_program, '', 'program.kode');
				
				if ($anggaran_bl->urusan_kode == 1){
					$container['content']['dataset']['key'] 			= 'yes';
					$jml_kegiatan										= $this->db->query("SELECT kegiatan FROM program_kegiatan WHERE program='".$anggaran_bl->program_kode."' AND kegiatan='".$anggaran_bl->kegiatan."'")->num_rows();
					$container['content']['dataset']['jml_kegiatan']	= $jml_kegiatan;
					if ($jml_kegiatan == 0){
						$where_kegiatan = "program='".$anggaran_bl->program_kode."' OR no='999'";
						$container['content']['dataset']['kegiatan'] 			= 'Lainnya...';
						$container['content']['dataset']['kegiatan_lainnya'] 	= $anggaran_bl->kegiatan;
					} else {
						$where_kegiatan = "program='".$anggaran_bl->program_kode."'";
						$container['content']['dataset']['kegiatan'] 	= $anggaran_bl->kegiatan;

					}
					
					$container['content']['dataset']['data_kegiatan']	= $this->db->query("SELECT kegiatan FROM program_kegiatan WHERE ".$where_kegiatan)->result();
				
				} else {
					$container['content']['dataset']['key'] 			= 'no';
					$container['content']['dataset']['kegiatan'] 		= $anggaran_bl->kegiatan;
				}

				$container['content']['dataset']['kode'] 		= $anggaran_bl->kode_anggaran;
				$container['content']['dataset']['nomor'] 		= '';
				$container['content']['dataset']['nomor_'] 		= intval(substr($anggaran_bl->nomor, -5));
				$container['content']['dataset']['tahun_'] 		= $anggaran_bl->tahun;
				$container['content']['dataset']['skpd_kode'] 	= $anggaran_bl->skpd_kode;
				$container['content']['dataset']['skpd_'] 		= $anggaran_bl->pelaksana_kode;
				$container['content']['dataset']['misi_'] 		= $anggaran_bl->misi_kode;
				$container['content']['dataset']['prioritas_'] 	= $anggaran_bl->prioritas_kode;
				$container['content']['dataset']['tujuan_'] 	= $anggaran_bl->tujuan_kode;
				$container['content']['dataset']['sasaran_'] 	= $anggaran_bl->sasaran_kode;
				$container['content']['dataset']['indikator_'] 	= $anggaran_bl->indikator_kode;
				$container['content']['dataset']['urusan_'] 	= $anggaran_bl->urusan_kode;
				$container['content']['dataset']['program_'] 	= $anggaran_bl->program_kode;
				$container['content']['dataset']['sifat_'] 		= $anggaran_bl->sifat_kode;
				$container['content']['dataset']['kesepakatan_'] = $anggaran_bl->kesepakatan_kode;
				$container['content']['dataset']['urutan'] 		= $anggaran_bl->urutan;
				$container['content']['dataset']['apbd_kab'] 	= $anggaran_bl->apbd_kab;
				$container['content']['dataset']['apbd_prov'] 	= $anggaran_bl->apbd_prov;
				$container['content']['dataset']['apbn'] 		= $anggaran_bl->apbn;
				$container['content']['dataset']['sumberlain'] 	= $anggaran_bl->sumberlain;
				$container['content']['dataset']['total_asumsi'] = $anggaran_bl->apbd_kab + $anggaran_bl->apbd_prov + $anggaran_bl->apbn + $anggaran_bl->sumberlain;
				$container['content']['dataset']['perkiraan_maju'] 	= $anggaran_bl->perkiraan_maju;
				$container['content']['dataset']['hp_ukur'] 	= $anggaran_bl->hp_ukur;
				$container['content']['dataset']['hp_target'] 	= $anggaran_bl->hp_target;
				$container['content']['dataset']['hp_satuan'] 	= $anggaran_bl->hp_satuan;
				$container['content']['dataset']['kh_ukur'] 	= $anggaran_bl->kh_ukur;
				$container['content']['dataset']['kh_target'] 	= $anggaran_bl->kh_target;
				$container['content']['dataset']['kh_satuan'] 	= $anggaran_bl->kh_satuan;
				$container['content']['dataset']['hk_ukur'] 	= $anggaran_bl->hk_ukur;
				$container['content']['dataset']['hk_target'] 	= $anggaran_bl->hk_target;
				$container['content']['dataset']['hk_satuan'] 	= $anggaran_bl->hk_satuan;
				$container['content']['dataset']['alamat'] 		= $anggaran_bl->alamat;
				$container['content']['dataset']['rt'] 			= $anggaran_bl->rt;
				$container['content']['dataset']['rw'] 			= $anggaran_bl->rw;
				$container['content']['dataset']['deskel_'] 	= $anggaran_bl->deskel_kode;
				$container['content']['dataset']['kecamatan_'] 	= $anggaran_bl->kecamatan_kode;
				$container['content']['dataset']['proposal'] 	= ($anggaran_bl->proposal == 'a')?'checked':'';
				$container['content']['dataset']['verifikasi'] 	= ($anggaran_bl->verifikasi == 's')?'checked':'';
				$container['content']['dataset']['foto'] 		= $anggaran_bl->foto;
				$container['content']['dataset']['file'] 		= $anggaran_bl->file;
				$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
				$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
				
				$header['admin_log']							= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
				
			} else {
				$anggaran_	= $this->Anggaran_model->getOnly('anggaran.*', array('anggaran.kode'=>$kode));
				$file = upload_file("file", "./public/uploads/documents/rencana_kerja/");
				if ($file){
					$insert['file']		= $file;
				} else if ($anggaran_->file != "") {
					$insert['file']		= $anggaran_->file;
					copy('./public/uploads/documents/musrenbang_kecamatan/'.$anggaran_->file, './public/uploads/documents/rencana_kerja/'.$anggaran_->file);
				}
				
				$filename 		= array();
				$foto 			= $this->input->post('foto');
				$delete_foto 	= $this->input->post('delete_foto');
				if ($foto){
					foreach($foto as $row){
						if ($row){
							$filename[]	= $row;
							if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row)){
								copy('./public/uploads/pictures/musrenbang_kecamatan/'.$row, './public/uploads/pictures/rencana_kerja/'.$row);
							}
						}
					}
				} 
				$files = $_FILES;
				$cpt = count($_FILES['photo']['tmp_name']);
				if ($cpt > 0){				
					for($i=0; $i<$cpt; $i++)
					{
						$_FILES['photo']['name']		= $files['photo']['name'][$i];
						$_FILES['photo']['type']		= $files['photo']['type'][$i];
						$_FILES['photo']['tmp_name']	= $files['photo']['tmp_name'][$i];
						$_FILES['photo']['error']		= $files['photo']['error'][$i];
						$_FILES['photo']['size']		= $files['photo']['size'][$i];
						$file_name 						= upload_image_thumb('photo', './public/uploads/pictures/rencana_kerja/', '800x600');
						if ($file_name){
							$filename[] = $file_name;
						}
					}
					$insert['foto']				= implode(';', $filename);
				}
				
				$insert['skpd_kode']		= $this->input->post('skpd_kode');
				$insert['nomor']			= nomorKegiatan($this->input->post('skpd_kode'), $this->input->post('tahun'), 6, 1, $this->input->post('nomor'));
				$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
				$insert['tahun']			= $this->input->post('tahun');
				$insert['kegiatan']			= $this->input->post('kegiatan');
				$insert['lokasi_kode']		= $this->input->post('lokasi_kode');
				$insert['kecamatan_kode']	= $this->input->post('kecamatan_kode');
				$insert['deskel_kode']		= $this->input->post('deskel_kode');
				$insert['alamat']			= $this->input->post('alamat');
				$insert['koordinat']		= $this->input->post('koordinat');
				$insert['catatan']			= $this->input->post('catatan');
				$insert['status']			= 1;
				$insert['proses_kode']		= 1;
				$insert['sumber_kode']		= 2;
				$insert['sumber_id']		= $kode;
				$insert['sumber_nomor']		= nomorKegiatan($anggaran_->skpd_kode, $anggaran_->tahun, 4, 1, $nomor);
				$insert['tahapan_kode']		= 6;
				$insert['tanggal']			= date("Y-m-d h:i:s");
				$insert['penambahan_kode']	= 1;
				$insert['admin_user']		= $admin_log['username'];
				$insert['tipe_kode']		= 1;
				$insert['proposal']			= ($this->input->post('proposal'))?'a':'t';
				$insert['verifikasi']		= ($this->input->post('verifikasi'))?'s':'b';
				$this->Anggaran_model->insert('anggaran', $insert); // Insert Anggaran
				
				$this->Anggaran_model->update('anggaran', array('status'=>'2'), array('kode'=>$kode)); // Update Sumber Anggaran
				
				//Insert Anggaran Belanja Langsung
				$anggaran = $this->Anggaran_model->getOnly('kode', array('admin_user'=>$admin_log['username'], 'tipe_kode'=>1));
				$insert_bl['anggaran_kode']		= $anggaran->kode;
				$insert_bl['visi_kode']			= 1;
				$insert_bl['misi_kode']			= $this->input->post('misi_kode');
				$insert_bl['prioritas_kode']	= $this->input->post('prioritas_kode');
				$insert_bl['tujuan_kode']		= $this->input->post('tujuan_kode');
				$insert_bl['sasaran_kode']		= $this->input->post('sasaran_kode');
				$insert_bl['indikator_kode']	= $this->input->post('indikator_kode');
				$insert_bl['urusan_kode']		= $this->input->post('urusan_kode');
				$insert_bl['program_kode']		= $this->input->post('program_kode');
				$insert_bl['sifat_kode']		= $this->input->post('sifat_kode');
				$insert_bl['kesepakatan_kode']	= $this->input->post('kesepakatan_kode');
				$insert_bl['urutan']			= $this->input->post('urutan');
				$insert_bl['hp_ukur']			= $this->input->post('hp_ukur');
				$insert_bl['hp_target']			= $this->input->post('hp_target');
				$insert_bl['hp_satuan']			= $this->input->post('hp_satuan');
				$insert_bl['kh_ukur']			= $this->input->post('kh_ukur');
				$insert_bl['kh_target']			= $this->input->post('kh_target');
				$insert_bl['kh_satuan']			= $this->input->post('kh_satuan');
				$insert_bl['hk_ukur']			= $this->input->post('hk_ukur');
				$insert_bl['hk_target']			= $this->input->post('hk_target');
				$insert_bl['hk_satuan']			= $this->input->post('hk_satuan');
				$insert_bl['apbd_kab']			= $this->input->post('apbd_kab');
				$insert_bl['apbd_prov']			= $this->input->post('apbd_prov');
				$insert_bl['apbn']				= $this->input->post('apbn');
				$insert_bl['sumberlain']		= $this->input->post('sumberlain');
											
				$this->Anggaran_model->insert('anggaran_bl', $insert_bl);
				
				redirect('musrenbang/kecamatan/#successTransfer', 'refresh');
			}
			
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
				$container['sidebar']['view']					= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] = 5;
				$container['content']['view']					= 'musrenbang/kecamatan/belanja_tidak_langsung/transfer';
				
				$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.*, anggaran_btl.biaya, anggaran_btl.volume, , anggaran_btl.penerima', array('anggaran.kode'=>$kode));
				
				$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('murni'=>'1'));
				$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
				$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
				$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_btl->kecamatan_kode));

				$container['content']['dataset']['kode'] 		= $anggaran_btl->kode;
				$container['content']['dataset']['nomor'] 		= '';
				$container['content']['dataset']['nomor_'] 		= intval(substr($anggaran_btl->nomor, -5));
				$container['content']['dataset']['tahun_'] 		= $anggaran_btl->tahun;
				$container['content']['dataset']['skpd_kode'] 	= $anggaran_btl->skpd_kode;
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
				$container['content']['dataset']['file'] 		= $anggaran_btl->file;
				$container['content']['dataset']['koordinat'] 	= $anggaran_btl->koordinat;
				$container['content']['dataset']['catatan'] 	= $anggaran_btl->catatan;
					
				$header['admin_log']							= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
				
			} else {
				$anggaran_	= $this->Anggaran_model->getOnly('anggaran.*', array('anggaran.kode'=>$kode));
				$file = upload_file("file", "./public/uploads/documents/rencana_kerja/");
				if ($file){
					$insert['file']		= $file;
				} else if ($anggaran_->file != "") {
					$insert['file']		= $anggaran_->file;
					copy('./public/uploads/documents/musrenbang_kecamatan/'.$anggaran_->file, './public/uploads/documents/rencana_kerja/'.$anggaran_->file);
				}
				
				$filename 		= array();
				$foto 			= $this->input->post('foto');
				$delete_foto 	= $this->input->post('delete_foto');
				if ($foto){
					foreach($foto as $row){
						if ($row){
							$filename[]	= $row;
							if (file_exists('./public/uploads/pictures/musrenbang_kecamatan/'.$row)){
								copy('./public/uploads/pictures/musrenbang_kecamatan/'.$row, './public/uploads/pictures/rencana_kerja/'.$row);
							}
						}
					}
				} 
				$files = $_FILES;
				$cpt = count($_FILES['photo']['tmp_name']);
				if ($cpt > 0){				
					for($i=0; $i<$cpt; $i++)
					{
						$_FILES['photo']['name']		= $files['photo']['name'][$i];
						$_FILES['photo']['type']		= $files['photo']['type'][$i];
						$_FILES['photo']['tmp_name']	= $files['photo']['tmp_name'][$i];
						$_FILES['photo']['error']		= $files['photo']['error'][$i];
						$_FILES['photo']['size']		= $files['photo']['size'][$i];
						$file_name 						= upload_image_thumb('photo', './public/uploads/pictures/rencana_kerja/', '800x600');
						if ($file_name){
							$filename[] = $file_name;
						}
					}
					$insert['foto']				= implode(';', $filename);
				}
				
				$insert['skpd_kode']		= $this->input->post('skpd_kode');
				$insert['nomor']			= nomorKegiatan($this->input->post('skpd_kode'), $this->input->post('tahun'), 6, 2, $this->input->post('nomor'));
				$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
				$insert['tahun']			= $this->input->post('tahun');
				$insert['kegiatan']			= $this->input->post('kegiatan');
				$insert['lokasi_kode']		= $this->input->post('lokasi_kode');
				$insert['kecamatan_kode']	= $this->input->post('kecamatan_kode');
				$insert['deskel_kode']		= $this->input->post('deskel_kode');
				$insert['alamat']			= $this->input->post('alamat');
				$insert['koordinat']		= $this->input->post('koordinat');
				$insert['catatan']			= $this->input->post('catatan');
				$insert['status']			= 1;
				$insert['proses_kode']		= 1;
				$insert['sumber_kode']		= 2;
				$insert['sumber_id']		= $kode;
				$insert['sumber_nomor']		= nomorKegiatan($anggaran_->skpd_kode, $anggaran_->tahun, 4, 2, $nomor);
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
				$anggaran = $this->Anggaran_model->getOnly('kode', array('admin_user'=>$admin_log['username'], 'tipe_kode'=>2));
				$insert_btl['anggaran_kode']	= $anggaran->kode;
				$insert_btl['volume']			= $this->input->post('volume');
				$insert_btl['biaya']			= $this->input->post('biaya');
				$insert_btl['penerima']			= $this->input->post('penerima');
											
				$this->Anggaran_model->insert('anggaran_btl', $insert_btl);
				
				redirect('musrenbang/kecamatan/#successTransfer', 'refresh');
			}
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
	
	public function tampil_combobox_deskel_by_kecamatan2(){
		$admin_log = $this->auth->is_login_admin();
		echo '<label class="control-label">Desa/Kelurahan <span class="required">*</span> :</label>';
		$where											= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
		$like['skpd_kd']								= $this->uri->segment(4);
		$data_skpd = $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
		combobox('db', $data_skpd, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Pilih Desa/Kelurahan', 'class="select2_category form-control"');
		
	}
	
	public function tampil_combobox_misi_by_skpd(){
		$skpd_kode 		= $this->uri->segment(4);
		$where 			= "skpd.skpd_kode='".$skpd_kode."' OR misi.kode='5'";
		$data_misi		= $this->Indikator_skpd_model->grid_all('misi.kode as misi_kode, misi.misi as misi_nama', 'misi.misi', 'ASC', '', '', $where, '', 'misi.kode');
		echo '<label class="control-label" for="misi_kode">Misi Kabupaten Bekasi <span class="required">*</span> :</label>';
		combobox('db', $data_misi, 'misi_kode', 'misi_kode', 'misi_nama', '', 'show_form_tujuan_by_misi();', 'Pilih Misi', 'class="select2_category form-control" tabindex="1" required="required"');
	}
	
	public function tampil_combobox_tujuan_by_misi(){
		$skpd_kode 		= $this->uri->segment(4);
		$misi_kode 		= $this->uri->segment(5);
		$where			= "skpd.skpd_kode='".$skpd_kode."'";
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
		$sasaran_kode 	= $this->uri->segment(5);
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
	
	public function tampil_combobox_urusan_by_skpd(){
		$skpd_kode 		= $this->uri->segment(4);
		$where = "skpd.skpd_kode='".$skpd_kode."'";
		$data_urusan 	= $this->Indikator_skpd_model->grid_all('urusan.kode as urusan_kode, urusan.urusan as urusan_nama', 'urusan.urusan', 'ASC', '', '', $where, '', 'urusan.kode');
		echo '<label class="control-label" for="urusan_kode">Urusan <span class="required">*</span> :</label>';
		combobox('db', $data_urusan, 'urusan_kode', 'urusan_kode', 'urusan_nama', '', 'show_form_program_by_urusan();', 'Pilih Urusan', 'class="select2_category form-control" tabindex="1" required="required"');

	}
	
	public function tampil_combobox_program_by_urusan(){
		$skpd_kode 		= $this->uri->segment(4);
		$urusan_kode	= $this->uri->segment(5);
		$where 			= "urusan.kode='".$urusan_kode."' AND skpd.skpd_kode='".$skpd_kode."'";
		$data_program	= $this->Indikator_skpd_model->grid_all('program.kode as program_kode, program.program as program_nama', 'program.program', 'ASC', '', '', $where, '', 'program.kode');
		if ($urusan_kode){
			echo '<label class="control-label" for="program_kode">Program <span class="required">*</span> :</label>';
			combobox('db', $data_program, 'program_kode', 'program_kode', 'program_nama', '', 'show_form_kegiatan_by_program();', 'Pilih Program', 'class="select2_category form-control" tabindex="1" required="required"');
		} else {
			echo '<label class="control-label" for="program_kode">Program <span class="required">*</span> :</label>';
			echo '<select class="select2_category form-control" name="program_kode" id="program_kode" data-placeholder="Pilih Program" tabindex="1" required="required"></select>';
		}
	}
	
	public function cek_nomor_kegiatan()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$token		= $this->uri->segment(4);
		$getSkpd	= $this->Skpd_model->get('skpd_kode', "md5(skpd_kode) = '$token'");
		$skpd		= ($getSkpd)?$getSkpd->skpd_kode:0;
		$tahun		= ($this->uri->segment(5) != 'tahun')?$this->uri->segment(5):'';
		$tahapan	= 4;
		$tipe 		= $this->uri->segment(6);
		$inc 		= $this->uri->segment(7);
		$inc_lama 	= $this->uri->segment(8);
		$nomor		= nomorKegiatan($skpd, $tahun, $tahapan, $tipe, $inc);
		$nomor_lama	= nomorKegiatan($skpd, $tahun, $tahapan, $tipe, $inc_lama);
		if ($inc_lama){
			$jumlah 	= $this->Anggaran_model->count_all("nomor = '$nomor' AND nomor != '$nomor_lama'");
		} else {
			$jumlah 	= $this->Anggaran_model->count_all("nomor = '$nomor'");
		}
		
		if ($inc && $tahun){
			if ($jumlah > 0){
				echo '<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
					  <input type="text" class="form-control nomor-error" name="nomor" id="nomor" required="required" onchange="show_nomor();" value="'.$inc.'">';
			} else {
				echo '<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
					  <input type="text" class="form-control nomor-success" name="nomor" id="nomor" required="required" onchange="show_nomor();" value="'.$inc.'">';
			}
		} else if ($tahun){
			$nomor_ = substr($nomor, 0, 11);
			$ds_nomor = $this->db->query("SELECT nomor FROM anggaran WHERE nomor LIKE '$nomor_%' ORDER BY nomor DESC LIMIT 1")->row();
			if ($ds_nomor){
				$inc = intval(substr($ds_nomor->nomor, -5)) + 1;
			} else {
				$inc = 1;
			}
			echo '<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
				  <input type="text" class="form-control" name="nomor" id="nomor" required="required" onchange="show_nomor();" value="'.$inc.'">';
		} else {
			echo '<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
				  <input type="text" class="form-control" name="nomor" id="nomor" required="required" onchange="show_nomor();" value="'.$inc.'">';
		}
	}
	
	public function cek_nomor_kegiatan_transfer()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$token		= $this->uri->segment(4);
		$getSkpd	= $this->Skpd_model->get('skpd_kode', "md5(skpd_kode) = '$token'");
		$skpd		= ($getSkpd)?$getSkpd->skpd_kode:0;
		$tahun		= ($this->uri->segment(5) != 'tahun')?$this->uri->segment(5):'';
		$tahapan	= 6;
		$tipe 		= $this->uri->segment(6);
		$inc 		= $this->uri->segment(7);
		$inc_lama 	= $this->uri->segment(8);
		$nomor		= nomorKegiatan($skpd, $tahun, $tahapan, $tipe, $inc);
		$nomor_lama	= nomorKegiatan($skpd, $tahun, $tahapan, $tipe, $inc_lama);
		if ($inc_lama){
			$jumlah 	= $this->Anggaran_model->count_all("nomor = '$nomor' AND nomor != '$nomor_lama'");
		} else {
			$jumlah 	= $this->Anggaran_model->count_all("nomor = '$nomor'");
		}
		
		if ($inc && $tahun){
			if ($jumlah > 0){
				echo '<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
					  <input type="text" class="form-control nomor-error" name="nomor" id="nomor" required="required" onchange="show_nomor();" value="'.$inc.'">';
			} else {
				echo '<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
					  <input type="text" class="form-control nomor-success" name="nomor" id="nomor" required="required" onchange="show_nomor();" value="'.$inc.'">';
			}
		} else if ($tahun){
			$nomor_ = substr($nomor, 0, 11);
			$ds_nomor = $this->db->query("SELECT nomor FROM anggaran WHERE nomor LIKE '$nomor_%' ORDER BY nomor DESC LIMIT 1")->row();
			if ($ds_nomor){
				$inc = intval(substr($ds_nomor->nomor, -5)) + 1;
			} else {
				$inc = 1;
			}
			echo '<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
				  <input type="text" class="form-control" name="nomor" id="nomor" required="required" onchange="show_nomor();" value="'.$inc.'">';
		} else {
			echo '<label class="control-label" for="nomor">Nomor <span class="required">*</span> :</label>
				  <input type="text" class="form-control" name="nomor" id="nomor" required="required" onchange="show_nomor();" value="'.$inc.'">';
		}
	}
	
	public function previewfile(){
		$kode = $this->uri->segment(4);
		$anggaran_ = $this->Anggaran_model->getOnly('anggaran.file', array('anggaran.kode'=>$kode));
		if ($anggaran_->file != ""){
			echo '<iframe src="https://docs.google.com/gview?url='.base_url('public/uploads/documents/musrenbang_kecamatan/'.$anggaran_->file).'&embedded=true" width="100%" height="100%" style="border: none;"></iframe>';
		} else {
			echo 'Tidak ada file';
		}
	}
}
