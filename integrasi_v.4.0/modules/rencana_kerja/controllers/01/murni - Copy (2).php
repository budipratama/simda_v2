<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Murni extends CI_Controller {
	
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
        $tahapan 	= 6;
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
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('kegiatan, alamat, skpd_nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, anggaran.kode, anggaran.kegiatan, anggaran.alamat, anggaran.pelaksana_kode, anggaran.status, anggaran.sumber_kode FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, anggaran WHERE ('.$where_datatable.') ORDER BY anggaran.kode DESC) anggaran LEFT JOIN skpd ON anggaran.pelaksana_kode=skpd.skpd_kode LEFT JOIN status ON anggaran.status=status.status_kode LEFT JOIN sumber ON anggaran.sumber_kode=sumber.sumber_kode');
		
        echo $this->datatables->generate();
    }
	
	public function index()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 8;
		$container['content']['view']					= 'rencana_kerja/murni/view';
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
		redirect('rencana-kerja/murni/hasil-pencarian/'.$tahun.'/'.$tipe.'/'.$skpd.'/'.$kecamatan.'/'.$deskel.'/'.$kegiatan);
	}
	
	public function hasil_pencarian()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 8;
		$container['content']['view']					= 'rencana_kerja/murni/view';
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
	
	public function belanja_langsung()
	{
		$admin_log = $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '6'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '6'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rencana-kerja/murni/#warningEntri', 'refresh');
		} else {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 8;
			$container['content']['view']					= 'rencana_kerja/murni/belanja_langsung/add';
			$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
			$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
			$container['content']['dataset']['visi']		= $this->Visi_model->get('kode, visi', array('kode' => '1'));
			$container['content']['dataset']['prioritas']	= $this->Prioritas_model->grid_all('kode, prioritas', 'prioritas', 'ASC');
			$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
			$container['content']['dataset']['kesepakatan']	= $this->Kesepakatan_model->grid_all('kode, nama', 'kode', 'ASC');
			$container['content']['dataset']['sifat']		= $this->Sifat_model->grid_all('sifat_kode, sifat_nama', 'sifat_kode', 'ASC');

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function delete()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '6'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '6'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rencana-kerja/murni/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('status, sumber_id', array('kode'=>$kode));
			if ($anggaran->status == 1){
				//Update Sumber Anggaran
				$this->Anggaran_model->update('anggaran', array('status'=>'1'), array('kode' => $anggaran->sumber_id)); 

				$this->Anggaran_model->delete('anggaran', array('kode' => $kode));
				$this->Anggaran_model->delete('anggaran_bl', array('anggaran_kode' => $kode));
				$this->Anggaran_model->delete('anggaran_btl', array('anggaran_kode' => $kode));
				
				redirect('rencana-kerja/murni/#successDelete', 'refresh');
				
			} else {
				
				redirect('rencana-kerja/murni/#warningTransfer', 'refresh');
			}

			redirect('rencana-kerja/murni', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));
		
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 8;
		if ($anggaran->tipe_kode == 1){
			$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, visi.visi as visi_nama, misi.misi as misi_nama, prioritas.prioritas as prioritas_nama, tujuan.tujuan as tujuan_nama, sasaran.sasaran as sasaran_nama, indikator.indikator as indikator_nama, urusan.urusan as urusan_nama, program.program as program_nama, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan', array('anggaran.kode'=>$kode));
			$container['content']['view']					= 'rencana_kerja/murni/belanja_langsung/detail';
			$container['content']['dataset']['kode'] 		= $anggaran_bl->kode;
			$container['content']['dataset']['tahun'] 		= $anggaran_bl->tahun;
			$container['content']['dataset']['skpd'] 		= $anggaran_bl->skpd_nama;
			$container['content']['dataset']['visi'] 		= $anggaran_bl->visi_nama;
			$container['content']['dataset']['misi'] 		= $anggaran_bl->misi_nama;
			$container['content']['dataset']['prioritas'] 	= $anggaran_bl->prioritas_nama;
			$container['content']['dataset']['tujuan'] 		= $anggaran_bl->tujuan_nama;
			$container['content']['dataset']['sasaran'] 	= $anggaran_bl->sasaran_nama;
			$container['content']['dataset']['indikator'] 	= $anggaran_bl->indikator_nama;
			$container['content']['dataset']['urusan'] 		= $anggaran_bl->urusan_nama;
			$container['content']['dataset']['program'] 	= $anggaran_bl->program_nama;
			$container['content']['dataset']['kegiatan'] 	= $anggaran_bl->kegiatan;
			$container['content']['dataset']['jenis_kegiatan'] = $anggaran_bl->sifat_nama;
			$container['content']['dataset']['kesepakatan'] = $anggaran_bl->kesepakatan_nama;
			$container['content']['dataset']['urutan'] 		= $anggaran_bl->urutan;
			$container['content']['dataset']['apbd_kab'] 	= $anggaran_bl->apbd_kab;
			$container['content']['dataset']['apbd_prov'] 	= $anggaran_bl->apbd_prov;
			$container['content']['dataset']['apbn'] 		= $anggaran_bl->apbn;
			$container['content']['dataset']['sumberlain'] 	= $anggaran_bl->sumberlain;
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
			$container['content']['dataset']['deskel'] 		= $anggaran_bl->deskel_nama;
			$container['content']['dataset']['kecamatan'] 	= $anggaran_bl->kecamatan_nama;
			$container['content']['dataset']['proposal'] 	= ($anggaran_bl->proposal == 'a')?'checked':'';
			$container['content']['dataset']['verifikasi'] 	= ($anggaran_bl->verifikasi == 's')?'checked':'';
			$container['content']['dataset']['foto'] 		= explode(", ", $anggaran_bl->foto);
			$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
			$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
		} else {
			$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.kode, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_btl.volume, anggaran_btl.biaya, anggaran_btl.penerima, pelaksana.skpd_nama', array('anggaran.kode'=>$kode));
			$container['content']['view']					= 'rencana_kerja/murni/belanja_tidak_langsung/detail';
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
			$container['content']['dataset']['foto'] 		= explode(", ", $anggaran_btl->foto);
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
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '6'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '6'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rencana-kerja/murni/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode, status', array('kode'=>$kode));
			
			if ($anggaran->status == 1){
				$container['sidebar']['view']						= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] 	= 8;
				if ($anggaran->tipe_kode == 1){
					$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode as kode_anggaran, anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.*', array('anggaran.kode'=>$kode));
					
					$container['content']['view']					= 'rencana_kerja/murni/belanja_langsung/edit';
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
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_bl->kecamatan_kode));
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
					$container['content']['dataset']['tahun_'] 		= $anggaran_bl->tahun;
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
					$container['content']['dataset']['foto'] 		= explode(", ", $anggaran_bl->foto);
					$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
					
				} else {
					$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.*, anggaran_btl.biaya, anggaran_btl.volume, , anggaran_btl.penerima', array('anggaran.kode'=>$kode));
					$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
					
					$where_skpd										= 'skpd_status IN (\'SKPD\', \'Kecamatan\')';
					$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);
					$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_btl->kecamatan_kode));

					$container['content']['view']					= 'rencana_kerja/murni/belanja_tidak_langsung/edit';
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
					$container['content']['dataset']['foto'] 		= explode(", ", $anggaran_btl->foto);
					$container['content']['dataset']['koordinat'] 	= $anggaran_btl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_btl->catatan;
				}
				$header['admin_log']								= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
			} else {
				redirect('rencana-kerja/murni/#warningTransfer', 'refresh');
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
				$container['sidebar']['dataset']['aktive_menu'] = 8;
				$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode as kode_anggaran, anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.*', array('anggaran.kode'=>$kode));
				
				$container['content']['view']					= 'rencana_kerja/murni/belanja_langsung/edit';
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
				$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_bl->kecamatan_kode));
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
				$container['content']['dataset']['tahun_'] 		= $anggaran_bl->tahun;
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
				$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
				$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
				
				$header['admin_log']							= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
				
			} else {
				$update['skpd_kode']		= $this->input->post('skpd_kode');
				$update['pelaksana_kode']	= $this->input->post('skpd_kode');
				$update['tahun']			= $this->input->post('tahun');
				
				if ($this->input->post('kegiatan') == 'Lainnya...'){
					$update['kegiatan']			= $this->input->post('kegiatan_lainnya');
				} else {
					$update['kegiatan']			= $this->input->post('kegiatan');
				}
				
				$update['lokasi_kode']		= $this->input->post('lokasi_kode');
				$update['kecamatan_kode']	= $this->input->post('kecamatan_kode');
				$update['deskel_kode']		= $this->input->post('deskel_kode');
				$update['rw']				= $this->input->post('rw');
				$update['rt']				= $this->input->post('rt');
				$update['alamat']			= $this->input->post('alamat');
				$update['koordinat']		= $this->input->post('koordinat');
				$update['catatan']			= $this->input->post('catatan');
				$update['status']			= 1;
				$update['proses_kode']		= 1;
				$update['tahapan_kode']		= 6;
				$update['tanggal']			= date("Y-m-d h:i:s");
				$update['penambahan_kode']	= 1;
				$update['admin_user']		= $admin_log['username'];
				$update['tipe_kode']		= 1;
				$update['proposal']			= ($this->input->post('proposal'))?'a':'t';
				$update['verifikasi']		= ($this->input->post('verifikasi'))?'s':'b';
				$this->Anggaran_model->update('anggaran', $update, array('kode'=>$kode)); // Update Anggaran
				
				//Update Anggaran Belanja Langsung
				$update_bl['visi_kode']			= 1;
				$update_bl['misi_kode']			= $this->input->post('misi_kode');
				$update_bl['prioritas_kode']	= $this->input->post('prioritas_kode');
				$update_bl['tujuan_kode']		= $this->input->post('tujuan_kode');
				$update_bl['sasaran_kode']		= $this->input->post('sasaran_kode');
				$update_bl['indikator_kode']	= $this->input->post('indikator_kode');
				$update_bl['urusan_kode']		= $this->input->post('urusan_kode');
				$update_bl['program_kode']		= $this->input->post('program_kode');
				$update_bl['sifat_kode']		= $this->input->post('sifat_kode');
				$update_bl['kesepakatan_kode']	= $this->input->post('kesepakatan_kode');
				$update_bl['urutan']			= $this->input->post('urutan');
				$update_bl['hp_ukur']			= $this->input->post('hp_ukur');
				$update_bl['hp_target']			= $this->input->post('hp_target');
				$update_bl['hp_satuan']			= $this->input->post('hp_satuan');
				$update_bl['kh_ukur']			= $this->input->post('kh_ukur');
				$update_bl['kh_target']			= $this->input->post('kh_target');
				$update_bl['kh_satuan']			= $this->input->post('kh_satuan');
				$update_bl['hk_ukur']			= $this->input->post('hk_ukur');
				$update_bl['hk_target']			= $this->input->post('hk_target');
				$update_bl['hk_satuan']			= $this->input->post('hk_satuan');
				$update_bl['apbd_kab']			= $this->input->post('apbd_kab');
				$update_bl['apbd_prov']			= $this->input->post('apbd_prov');
				$update_bl['apbn']				= $this->input->post('apbn');
				$update_bl['sumberlain']		= $this->input->post('sumberlain');
				$update_bl['perkiraan_maju']	= $this->input->post('perkiraan_maju');
											
				$this->Anggaran_model->update('anggaran_bl', $update_bl, array('anggaran_kode'=>$kode));
				
				redirect('rencana-kerja/murni/#successUpdate', 'refresh');
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
				$container['sidebar']['dataset']['aktive_menu'] = 8;
				$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.kode, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_btl.volume, anggaran_btl.biaya, anggaran_btl.penerima, pelaksana.skpd_nama', array('anggaran.kode'=>$kode));
				
				$container['content']['view']					= 'rencana_kerja/murni/belanja_tidak_langsung/edit';
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
				
			} else {
				$update['skpd_kode']		= $this->input->post('skpd_kode');
				$update['pelaksana_kode']	= $this->input->post('skpd_kode');
				$update['tahun']			= $this->input->post('tahun');
				$update['kegiatan']			= $this->input->post('kegiatan');
				$update['lokasi_kode']		= $this->input->post('lokasi_kode');
				$update['kecamatan_kode']	= $this->input->post('kecamatan_kode');
				$update['deskel_kode']		= $this->input->post('deskel_kode');
				$update['rw']				= $this->input->post('rw');
				$update['rt']				= $this->input->post('rt');
				$update['alamat']			= $this->input->post('alamat');
				$update['koordinat']		= $this->input->post('koordinat');
				$update['catatan']			= $this->input->post('catatan');
				$update['status']			= 1;
				$update['proses_kode']		= 1;
				$update['tahapan_kode']		= 6;
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
				
				redirect('rencana-kerja/murni/#successUpdate', 'refresh');
			}
		}
	}
	
	public function belanja_tidak_langsung()
	{
		$admin_log = $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '6'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '6'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rencana-kerja/murni/#warningEntri', 'refresh');
		} else {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 8;
			$container['content']['view']					= 'rencana_kerja/murni/belanja_tidak_langsung/add';
			$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
			$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
			$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
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
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '8'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '8'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rencana-kerja/murni/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode, status', array('kode'=>$kode));
			
			if ($anggaran->status == 1){
				$container['sidebar']['view']						= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] 	= 8;
				if ($anggaran->tipe_kode == 1){
					$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode as kode_anggaran, anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.*', array('anggaran.kode'=>$kode));
					
					$container['content']['view']					= 'rencana_kerja/murni/belanja_langsung/transfer';
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
					$container['content']['dataset']['tahun_'] 		= $anggaran_bl->tahun;
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
					$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
					
				} else {
					$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.*, anggaran_btl.biaya, anggaran_btl.volume, , anggaran_btl.penerima', array('anggaran.kode'=>$kode));
					$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
					$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'SKPD'));
					$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status'=>'Kecamatan'));
					$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', 'skpd_status IN (\'Desa\', \'Kelurahan\')', array('skpd_kd'=>$anggaran_btl->kecamatan_kode));

					$container['content']['view']					= 'rencana_kerja/murni/belanja_tidak_langsung/transfer';
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
				redirect('rencana-kerja/murni/#warningTransfer', 'refresh');
			}
		}
	}
	
	public function doTransfer(){
		$admin_log = $this->auth->is_login_admin();
		$type = $this->uri->segment(4);
		$kode = $this->uri->segment(5);
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
				$container['sidebar']['dataset']['aktive_menu'] = 8;
				$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode as kode_anggaran, anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.*', array('anggaran.kode'=>$kode));
			
				$container['content']['view']					= 'rencana_kerja/murni/belanja_langsung/transfer';
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
				$container['content']['dataset']['tahun_'] 		= $anggaran_bl->tahun;
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
				$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
				$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
				
				$header['admin_log']							= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
				
			} else {
				$tahapan_kode = 8;
				if ($this->input->post('urusan_kode') == 1){
					
					$where_anggaran = "anggaran.tahun =  '".$this->input->post('tahun')."' AND anggaran_bl.urusan_kode = '1' AND anggaran.tahapan_kode =  '".$tahapan_kode."'";
					$anggaran		= $this->db->query("SELECT SUM(anggaran_bl.apbd_kab) total_anggaran FROM anggaran LEFT JOIN anggaran_bl ON anggaran.kode = anggaran_bl.anggaran_kode WHERE ".$where_anggaran)->row();
					
					$tahun_anggaran				= 'anggaran'.$this->input->post('tahun');
					$rutin						= $this->db->query("SELECT * FROM program_rutin WHERE kode='1'")->row();
					
					$sisa_anggaran				= $rutin->$tahun_anggaran - $anggaran->total_anggaran;
					
				} else {
					
					$where_anggaran = "anggaran.tahun =  '".$this->input->post('tahun')."' AND anggaran_bl.indikator_kode = '".$this->input->post('indikator_kode')."' AND anggaran.tahapan_kode =  '".$tahapan_kode."'";
					$anggaran		= $this->db->query("SELECT SUM(anggaran_bl.apbd_kab) total_anggaran FROM anggaran LEFT JOIN anggaran_bl ON anggaran.kode = anggaran_bl.anggaran_kode WHERE ".$where_anggaran)->row();

					$tahun_anggaran				= 'tahun'.$this->input->post('tahun');
					$indikator					= $this->db->query("SELECT * FROM indikator WHERE kode='".$this->input->post('indikator_kode')."'")->row();
					
					$sisa_anggaran				= $indikator->$tahun_anggaran - $anggaran->total_anggaran;
					
				}
				
				if ($this->input->post('apbd_kab') <= $sisa_anggaran){
					$sumber = $this->Anggaran_model->getOnly('sumber_kode', array('kode'=>$kode));
					$insert['skpd_kode']		= $this->input->post('skpd_kode');
					$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
					$insert['tahun']			= $this->input->post('tahun');
					
					if ($this->input->post('kegiatan') == 'Lainnya...'){
						$insert['kegiatan']			= $this->input->post('kegiatan_lainnya');
					} else {
						$insert['kegiatan']			= $this->input->post('kegiatan');
					}
					
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
					$insert['sumber_kode']		= $sumber->sumber_kode;
					$insert['sumber_id']		= $kode;
					$insert['tahapan_kode']		= 8;
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
					$insert_bl['perkiraan_maju']	= $this->input->post('perkiraan_maju');
												
					$this->Anggaran_model->insert('anggaran_bl', $insert_bl);
					
					redirect('rencana-kerja/murni/#successTransfer', 'refresh');
				} else {
					redirect('rencana-kerja/murni/#warningAPBD', 'refresh');
				}

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
				$container['sidebar']['dataset']['aktive_menu'] = 8;
				$container['content']['view']					= 'rencana_kerja/murni/belanja_langsung/add';
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
				$sumber = $this->Anggaran_model->getOnly('sumber_kode', array('kode'=>$kode));
				
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
				$insert['sumber_kode']		= $sumber->sumber_kode;
				$insert['sumber_id']		= $kode;
				$insert['tahapan_kode']		= 8;
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
				
				$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data rencana kerja anggaran belanja tidak langsung telah berhasil ditransfer ke musrenbang kabupaten.</div>');
				redirect('rencana-kerja/murni', 'refresh');
			}
		}
	}
	
	public function tampil_combobox_deskel_by_kecamatan(){
		$admin_log 	= $this->auth->is_login_admin();
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
	
	public function tampil_combobox_deskel_by_kecamatan2(){
		$admin_log = $this->auth->is_login_admin();
		echo '<label class="control-label">Desa/Kelurahan <span class="required">*</span> :</label>';
		$where											= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
		$like['skpd_kd']								= $this->uri->segment(4);
		$data_skpd = $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
		combobox('db', $data_skpd, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Pilih Desa/Kelurahan', 'class="select2_category form-control" tabindex="1" required="required"');
		
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
		$urusan_kode	= $this->uri->segment(4);
		$program_kode	= $this->uri->segment(5);
		$query			= $this->db->query("SELECT kegiatan FROM program_kegiatan WHERE program='".$program_kode."'");
		$data_kegiatan	= $query->result();
		if ($urusan_kode == 1){
			echo '<label class="control-label" for="program_kode">Nama Kegiatan <span class="required">*</span> :</label>';
			combobox('db', $data_kegiatan, 'kegiatan', 'kegiatan', 'kegiatan', '', '', 'Pilih Kegiatan', 'class="select2_category form-control" tabindex="1" required="required"');
		} else {
			echo '<label class="control-label" for="kegiatan">Nama Kegiatan <span class="required">*</span> :</label>
				<input type="text" class="form-control" name="kegiatan" id="kegiatan" required="required">';
		}
	}
	
	public function tampil_combobox_hasil_by_program(){
		$program_kode	= $this->uri->segment(4);
		$data_kegiatan	= $this->Program_model->get('program.hasil_program', array('program.kode' => $program_kode));
		echo '<label class="control-label" for="hp_ukur">Tolak Ukur :</label>
			<input type="text" class="form-control" name="hp_ukur" value="'.$data_kegiatan->hasil_program.'" id="hp_ukur" placeholder="">';
	}
}
