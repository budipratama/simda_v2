<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Murni extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
	//	$this->load->model('Rup_model');
		
		$this->load->model('Rka_model');
		$this->load->model('Tipe_model');
		$this->load->model('Akun_model');
		$this->load->model('Kelompok_model');
		$this->load->model('Jenis_model');
		$this->load->model('Obyek_model');
		$this->load->model('Rincian_model');
		$this->load->model('Tim_anggaran_model');
		
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
	//	$this->load->model('Data_model');
		$this->load->library('Datatables');
		$this->load->library('mpdf/mpdf');
	}
	
	function datatable()
	{
        $tahapan 	= 16;
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
		->add_column('Actions', $this->get_buttons($tipe, '$1'),'kode')
		->search_column('kegiatan, alamat, skpd_nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, anggaran.kode, anggaran.kegiatan, anggaran.alamat, anggaran.pelaksana_kode, anggaran.status, anggaran.sumber_kode FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, anggaran WHERE ('.$where_datatable.') ORDER BY anggaran.kode DESC) anggaran LEFT JOIN skpd ON anggaran.pelaksana_kode=skpd.skpd_kode LEFT JOIN status ON anggaran.status=status.status_kode LEFT JOIN sumber ON anggaran.sumber_kode=sumber.sumber_kode');
		
        echo $this->datatables->generate();
    }
	
	function get_buttons($tipe, $id)
	{
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';		
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/murni/belanja/'.$id) .'" class="btn btn-success btn-circle waves-effect waves-circle waves-float" title="Tambah"><i class="material-icons"></i></a>&nbsp;';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/murni/detail/'.$id) .'" class="btn btn-info btn-circle waves-effect waves-circle waves-float" title="Detail"><i class="material-icons">assignment</i></a>&nbsp;';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/murni/delete/'.$id) .'" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Delete" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data rencana kerja ini.\');"><i class="material-icons">delete_forever</i></a>';
		$html .= '</div>';
		return $html;
	}
	
	public function index()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 49;
		$container['content']['view']					= 'rka/murni/view';

			if ($admin_log['level_kode'] == 5 || $admin_log['level_kode'] == 4){
				$skpd_id										= 'skpd_kd IN ('.$admin_log['skpd_kode'].')';
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', $skpd_id, array('skpd_tahun' => $admin_log['tahun']));
				$container['content']['dataset']['skpd_kode']	= $skpd->skpd_kd;
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
		
				$where_skpd										= 'skpd_tahun IN ('.$admin_log['tahun'].', \'0000\')';
				$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kd as skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);
				$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
				$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
				$container['content']['dataset']['tahun_1']		= $admin_log['tahun'];
				$container['content']['dataset']['tahun_']		= '';
				$container['content']['dataset']['tipe_']		= '1';
				$container['content']['dataset']['skpd_']		= '';
				$container['content']['dataset']['kecamatan_']	= '';
				$container['content']['dataset']['deskel_']		= '';
				$container['content']['dataset']['kegiatan_']	= '';
			
		$header['admin_log']								= $admin_log;
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
		redirect('rka/murni/hasil-pencarian/'.$tahun.'/'.$tipe.'/'.$skpd.'/'.$kecamatan.'/'.$deskel.'/'.$kegiatan);
	}
	
	public function hasil_pencarian()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 49;
		$container['content']['view']					= 'rka/murni/view';
		
			if ($admin_log['level_kode'] == 5 || $admin_log['level_kode'] == 4){
				$skpd_id										= 'skpd_kd IN ('.$admin_log['skpd_kode'].')';
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', $skpd_id, array('skpd_tahun' => $admin_log['tahun']));
				$container['content']['dataset']['skpd_kode']	= $skpd->skpd_kd;
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
			
				$where_skpd										= 'skpd_tahun IN ('.$admin_log['tahun'].', \'0000\')';
				$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kd as skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);	
				$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
				$container['content']['dataset']['kecamatan']	= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', array('skpd_status' => 'Kecamatan'));
				$container['content']['dataset']['tahun_']		= $this->uri->segment(3);
				$container['content']['dataset']['tipe_']		= $this->uri->segment(4);
				$container['content']['dataset']['skpd_']		= $this->uri->segment(5);
				$container['content']['dataset']['kecamatan_']	= $this->uri->segment(6);
				$where											= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
				$like['skpd_kd']								= $this->uri->segment(6);
				$container['content']['dataset']['deskel']		= $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
				$container['content']['dataset']['deskel_']		= $this->uri->segment(7);
				$container['content']['dataset']['kegiatan_']	= str_replace("%20", " ", $this->uri->segment(8));
				$container['content']['dataset']['formCari']	= 'off';
				
		$header['admin_log']									= $admin_log;
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
		$tahun		= date("Y");
		$tahun_anggaran = $tahun + 1;
		
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 49;
		
			$where_skpd											= 'skpd_tahun IN ('.$admin_log['tahun'].', \'0000\')';
			$container['content']['dataset']['skpd']			= $this->Skpd_model->grid_all('skpd_kd as skpd_kode, skpd_nama', 'skpd_nama', 'ASC', '', '', $where_skpd);
		
			if ($admin_log['level_kode'] == 5 || $admin_log['level_kode'] == 4){
				$skpd_id										= 'skpd_kd IN ('.$admin_log['skpd_kode'].')';
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', $skpd_id, array('skpd_tahun' => $admin_log['tahun']));
				$container['content']['dataset']['skpd_kode']	= $skpd->skpd_kd;
				$container['content']['dataset']['skpd_nama']	= $skpd->skpd_nama;
				$container['content']['dataset']['skpd_aktive']	= 'no';
			} else {
				$container['content']['dataset']['skpd_aktive']	= 'yes';
			}
		
		if ($anggaran->tipe_kode == 1){
			$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode, anggaran.pelaksana_kode, anggaran.deskel_kode, anggaran.kecamatan_kode, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, visi.visi as visi_nama, misi.misi as misi_nama, prioritas.prioritas as prioritas_nama, tujuan.tujuan as tujuan_nama, sasaran.sasaran as sasaran_nama, indikator.indikator as indikator_nama, urusan.urusan as urusan_nama, program.program as program_nama, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan', array('anggaran.kode'=>$kode));
			$container['content']['view']					= 'rka/murni/belanja_langsung/detail';
			$container['content']['dataset']['kode'] 		= $anggaran_bl->kode;
			$container['content']['dataset']['tahun'] 		= $anggaran_bl->tahun;
			$container['content']['dataset']['skpd_']		= $anggaran_bl->pelaksana_kode;
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
			$container['content']['dataset']['deskel_kode'] 	= $anggaran_bl->deskel_kode;
			$container['content']['dataset']['deskel'] 		= $anggaran_bl->deskel_nama;
			$container['content']['dataset']['kecamatan_kode']	= $anggaran_bl->kecamatan_kode;
			$container['content']['dataset']['kecamatan'] 	= $anggaran_bl->kecamatan_nama;
			$container['content']['dataset']['proposal'] 	= ($anggaran_bl->proposal == 'a')?'checked':'';
			$container['content']['dataset']['verifikasi'] 	= ($anggaran_bl->verifikasi == 's')?'checked':'';
			$container['content']['dataset']['foto'] 		= explode(", ", $anggaran_bl->foto);
			$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
			$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;
			$container['content']['dataset']['tahun_sekarang'] 	= $tahun;
			$container['content']['dataset']['tahun_anggaran'] 	= $tahun_anggaran;
		} else {
			$anggaran_btl									= $this->Anggaran_model->get('2','anggaran.kode, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_btl.volume, anggaran_btl.biaya, anggaran_btl.penerima, pelaksana.skpd_nama', array('anggaran.kode'=>$kode));
			$container['content']['view']					= 'rka/murni/belanja_tidak_langsung/detail';
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
	
	public function delete() 
	{
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '11'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '11'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rka/murni/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('status, sumber_id', array('kode'=>$kode));
			if ($anggaran->status == 1){
				//Update Sumber Anggaran
				$this->Anggaran_model->update('anggaran', array('status'=>'1'), array('kode' => $anggaran->sumber_id)); 

				$this->Anggaran_model->delete('anggaran', array('kode' => $kode));
				$this->Anggaran_model->delete('anggaran_bl', array('anggaran_kode' => $kode));
				$this->Anggaran_model->delete('anggaran_btl', array('anggaran_kode' => $kode));
				
				redirect('rka/murni/#successDelete', 'refresh');
			} else {
				redirect('rka/murni/#warningTransfer', 'refresh');
			}
			redirect('rka/murni', 'refresh');
		}
	}
	
	public function belanja() 
	{
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode, skpd_kode', array('kode'=>$kode));
		
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 49;
		
		$skpd_id											= 'skpd_kd IN ('.$anggaran->skpd_kode.')';
		$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', $skpd_id, array('skpd_tahun' => $admin_log['tahun']));
		$container['content']['dataset']['skpd_kode']		= $skpd->skpd_kd;
		$container['content']['dataset']['skpd_nama']		= $skpd->skpd_nama;
		
		if ($anggaran->tipe_kode == 1){

			$container['anggaran_bl']	= $this->Rka_model->belanja($kode,true);
			$container['uncompleted']	= $this->Rka_model->belanja($kode,false);

			$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, visi.visi as visi_nama, misi.misi as misi_nama, prioritas.prioritas as prioritas_nama, tujuan.tujuan as tujuan_nama, sasaran.sasaran as sasaran_nama, indikator.indikator as indikator_nama, urusan.urusan as urusan_nama, program.program as program_nama, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan', array('anggaran.kode'=>$kode));
			$container['content']['view']					= 'rka/murni/belanja_langsung/belanja';
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
			$container['content']['view']					= 'rka/murni/belanja_tidak_langsung/belanja';
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
		$this->load->view('admin/tables');
	}
	
	public function belanja_langsung() {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode, skpd_kode', array('kode'=>$kode));
		
		$this->form_validation->set_rules('aaa_kode', 'Akun', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Kelompok', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ccc_kode', 'Jenis', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ddd_kode', 'Obyek', 'trim|required|xss_clean');
		$this->form_validation->set_rules('eee_kode', 'Rincian', 'trim|required|xss_clean|callback_check_insert');
		$this->form_validation->set_rules('id_kode', 'Kd_anggaran', 'trim|required|xss_clean|callback_check_insert');
		$this->form_validation->set_rules('sss_kode', 'Sumber', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_kode', 'No', 'trim|required|xss_clean');        		
		{
			if($this->form_validation->run() == FALSE){

			$container['sidebar']['view']						= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] 	= 49;	
			$container['content']['view']						= 'rka/murni/belanja_langsung/add';	

			$skpd_id											= 'skpd_kd IN ('.$anggaran->skpd_kode.')';
			$skpd = $this->Skpd_model->get('skpd_kode, skpd_kd, skpd_nama', $skpd_id, array('skpd_tahun' => $admin_log['tahun']));
			$container['content']['dataset']['skpd_kode']		= $skpd->skpd_kd;
			$container['content']['dataset']['skpd_nama']		= $skpd->skpd_nama;

			$where_akun										= 'kode IN (\'5\')';
			$container['content']['dataset']['akun']		= $this->Akun_model->grid_all('kode, nm_rek_1', 'nm_rek_1', '', '', '', $where_akun);
			$container['content']['dataset']['sumber']		= $this->Tipe_model->grid_all('kode, nm_sumber', 'nm_sumber', '', '', '', '');
			$container['bl']								= $this->Rka_model->get_bl($kode,true);
			
			$belanja										= $this->Anggaran_model->get('1','anggaran.kode, anggaran.skpd_kode, skpd.urusan as id_urusan, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, visi.visi as visi_nama, misi.misi as misi_nama, prioritas.prioritas as prioritas_nama, tujuan.tujuan as tujuan_nama, sasaran.sasaran as sasaran_nama, indikator.indikator as indikator_nama, urusan.urusan as urusan_nama, program.kode as program_kode, program.program as program_nama, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan', array('anggaran.kode'=>$kode));
			$container['content']['dataset']['kode'] 		= $belanja->kode;
			$container['content']['dataset']['program'] 	= $belanja->program_kode;
			$container['content']['dataset']['program_'] 	= $belanja->program_nama;
			$container['content']['dataset']['skpd'] 		= $belanja->skpd_kode;			
			$container['content']['dataset']['skpd_'] 		= $belanja->skpd_nama;
			$container['content']['dataset']['tahun'] 		= $belanja->tahun;
			$container['content']['dataset']['urusan'] 		= $belanja->id_urusan;			
			$container['content']['dataset']['kegiatan'] 	= $belanja->kegiatan;

				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(
					'kd_rek_1'		=> $this->input->post('aaa_kode'),
					'kd_rek_2'		=> $this->input->post('bbb_kode'),
					'kd_rek_3'		=> $this->input->post('ccc_kode'),
					'kd_rek_4'		=> $this->input->post('ddd_kode'),
					'kd_rek_5'		=> $this->input->post('eee_kode'),
					'kd_sumber'		=> $this->input->post('sss_kode'),
					'tahun'			=> $this->input->post('thn_kode'),
					'kd_skpd' 		=> $this->input->post('skpd_kode'),
					'no' 			=> $this->input->post('no_kode'),
					'kd_anggaran'	=> $this->input->post('id_kode'),					
					'kd_program'	=> $this->input->post('program_kode'),
					'kd_urusan'		=> $this->input->post('urusan_kode'),
					'tipe_bl'		=> 1
					);
				$id_kode			= $this->input->post('id_kode');
				if($this->Rka_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE RKA BELANJA" telah berhasil ditambahkan</div>');
				   redirect('rka/murni/belanja/'.$id_kode);
				}
			}
		}
    }
	
	public function check_insert1($rincian) {
		//query the database
		$rincian	= $this->input->post('eee_kode');
		$id_kode	= $this->input->post('id_kode');
		$result 	= $this->Rincian_model->count_all(array('kode' => $rincian));	
		if ($result == 0){
			return TRUE;	
		} else {
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "DATA RKA BELANJA" sudah ada</div>');
			redirect('rka/murni/belanja/'.$rincian);
			return FALSE;
		}
	}
	
	public function edit($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$jenis 		= $this->Jenis_model->getOnly('kode, akun_sort, kelompok, status', array('kode'=>$kode));	 {
		$this->form_validation->set_rules('ccc_kode','Jenis','trim|xss_clean');
		$this->form_validation->set_rules('ddd_kode','Obyek','trim|xss_clean');
		$this->form_validation->set_rules('eee_kode','Rincian','trim|xss_clean');
		$this->form_validation->set_rules('sss_kode','Sumber','trim|xss_clean');

		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 49;	
		$container['content']['view']						= 'rka/murni/belanja_langsung/edit';
		
			if($this->form_validation->run() == FALSE){	
				$rka = $this->Rka_model->get('rka.*', array('rka.kode'=>$this->uri->segment(4)));
				$container['content']['dataset']['kode']		= $rka->kode;
				$container['content']['dataset']['id_anggaran']	= $rka->anggaran_kode;
				$container['content']['dataset']['akun_']		= $rka->akun;
				$container['content']['dataset']['kelompok_']	= $rka->kelompok;
				$container['content']['dataset']['jenis_']		= $rka->jenis;
				$container['content']['dataset']['obyek_']		= $rka->obyek;
				$container['content']['dataset']['rincian_']	= $rka->rincian;
				$container['content']['dataset']['sumber_']		= $rka->sumber;
			
				$where_sumber									= 'tipe_sort IN (\'5\')';
				$where_akun										= 'kode IN (\'5\')';
				$where_kelompok 								= 'kode IN (\'16\')';
				$container['content']['dataset']['sumber']		= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_sumber);
				$container['content']['dataset']['akun']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
				$container['content']['dataset']['kelompok']	= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', '', '', '', $where_kelompok);				
				$container['content']['dataset']['jenis']		= $this->Jenis_model->grid_all('jenis.kode, jenis.jenis_nama', 'jenis.jenis_nama', '', '', '', array('jenis.kelompok'=>$rka->kelompok));
				$container['content']['dataset']['obyek'] 		= $this->Obyek_model->grid_all('obyek.kode, obyek.obyek_nama', 'obyek.obyek_nama', '', '', '', array('obyek.jenis'=>$rka->jenis));
				$container['content']['dataset']['rincian'] 	= $this->Rincian_model->grid_all('rincian.kode, rincian.rincian_nama', 'rincian.rincian_nama', '', '', '', array('rincian.obyek'=>$rka->obyek));		
				
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
			$update['jenis']	= $this->input->post('ccc_kode');
			$update['obyek']	= $this->input->post('ddd_kode');
			$update['rincian']	= $this->input->post('eee_kode');
			$update['sumber']	= $this->input->post('sss_kode');
			$id_kode 			= $this->input->post('id_kode');
			$query = $this->Rka_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RKA BELANJA" telah berhasil diubah</div>');
			redirect('rka/murni/belanja/'.$id_kode, 'refresh');
			}
		}
    }
	
	public function deleteb() {
		$admin_log 	= $this->auth->is_login_admin(); {
		$kode 		= $this->uri->segment(4);
		$rka 		= $this->Rka_model->getOnly('kd_anggaran', array('kode'=>$kode));
			$this->Rka_model->delete0($this->uri->segment(4));
		//	$this->Rka_model->delete1($this->uri->segment(4));
		//	$this->Rka_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RKA BELANJA" telah berhasil dihapus</div>');
			redirect('rka/murni/belanja/'.$rka->kd_anggaran, 'refresh');
		}
	}
	
	public function rincian() {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));		
		
		{
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 49;	
		$container['content']['view']						= 'rka/murni/belanja_langsung/rincian';		

			$container['rka']								= $this->Rka_model->bl($kode);
			$container['rincian']							= $this->Rka_model->rincian($kode,true);
			
			$belanja										= $this->Anggaran_model->get('1','anggaran.kode, anggaran.skpd_kode, skpd.urusan as id_urusan, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, visi.visi as visi_nama, misi.misi as misi_nama, prioritas.prioritas as prioritas_nama, tujuan.tujuan as tujuan_nama, sasaran.sasaran as sasaran_nama, indikator.indikator as indikator_nama, urusan.urusan as urusan_nama, program.kode as program_kode, program.program as program_nama, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan', array('anggaran.kode'=>$kode));
			$container['content']['dataset']['kode'] 		= $belanja->kode;
			$container['content']['dataset']['program'] 	= $belanja->program_kode;
			$container['content']['dataset']['program_'] 	= $belanja->program_nama;
			$container['content']['dataset']['skpd'] 		= $belanja->skpd_kode;			
			$container['content']['dataset']['skpd_'] 		= $belanja->skpd_nama;
			$container['content']['dataset']['tahun'] 		= $belanja->tahun;
			$container['content']['dataset']['urusan'] 		= $belanja->id_urusan;			
			$container['content']['dataset']['kegiatan'] 	= $belanja->kegiatan;
		
		}
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/tables');
	}
	
	public function addr() {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));		
		$this->form_validation->set_rules('aaa_kode', 'Uraian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_kode', 'Rka', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_kode', 'No', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ggg_kode', 'Anggaran_kode', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE) {
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 49;	
		$container['content']['view']						= 'rka/murni/belanja_langsung/addr';

			$container['bl']								= $this->Rka_model->bl($kode,true);
			$container['blr']								= $this->Rka_model->blr($kode,true);
			$container['rka']								= $this->Rka_model->bl($kode);
			$container['rincian']							= $this->Rka_model->rincian($kode,true);
			
			$belanja										= $this->Anggaran_model->get('1','anggaran.kode, anggaran.skpd_kode, skpd.urusan as id_urusan, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, visi.visi as visi_nama, misi.misi as misi_nama, prioritas.prioritas as prioritas_nama, tujuan.tujuan as tujuan_nama, sasaran.sasaran as sasaran_nama, indikator.indikator as indikator_nama, urusan.urusan as urusan_nama, program.kode as program_kode, program.program as program_nama, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan', array('anggaran.kode'=>$kode));
			$container['content']['dataset']['kode'] 		= $belanja->kode;
			$container['content']['dataset']['program'] 	= $belanja->program_kode;
			$container['content']['dataset']['program_'] 	= $belanja->program_nama;
			$container['content']['dataset']['skpd'] 		= $belanja->skpd_kode;
			$container['content']['dataset']['skpd_'] 		= $belanja->skpd_nama;
			$container['content']['dataset']['tahun'] 		= $belanja->tahun;
			$container['content']['dataset']['urusan'] 		= $belanja->id_urusan;
			$container['content']['dataset']['kegiatan'] 	= $belanja->kegiatan;
				
		} else {			
			$insert['uraian']		= $this->input->post('aaa_kode');
			$insert['no'] 			= $this->input->post('no_kode');
			$insert['rka'] 			= $this->input->post('id_kode');
			$insert['anggaran_kode']= $this->input->post('ggg_kode');
			$id_kode				= $this->input->post('id_kode');
			$insert['tipe_kode']	= 1;
			
			$query = $this->Rka_model->insertr($insert);			
			$this->session->set_flashdata('success','<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN BELANJA" baru telah berhasil ditambahkan.</div>');
			redirect('rka/murni/rincian/'.$id_kode);
		}
			
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function editr($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$jenis 		= $this->Jenis_model->getOnly('kode, akun_sort, kelompok, status', array('kode'=>$kode));	 {
		$this->form_validation->set_rules('aaa_kode','Uraian','trim|xss_clean');
		
			if($this->form_validation->run() == FALSE){	
				$container['sidebar']['view']						= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] 	= 49;	
				$container['content']['view']						= 'rka/murni/belanja_langsung/editr';
		
				$container['rincian']						= $this->Rka_model->getr($kode);

				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
			$update['uraian']	= $this->input->post('aaa_kode');
			$id_kode 			= $this->input->post('rka');
			$query = $this->Rka_model->updater($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN BELANJA" telah berhasil diubah</div>');
			redirect('rka/murni/rincian/'.$id_kode, 'refresh');
			}
		}
    }
	
	public function deleter() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$rincian	= $this->Rka_model->getOnlyr('kode, rka', array('kode'=>$kode));
			$this->Rka_model->delete4($this->uri->segment(4));
			$this->Rka_model->delete3($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN BELANJA" telah berhasil dihapus</div>');
			redirect('rka/murni/rincian/'.$rincian->rka, 'refresh');
		}
	}
	
	public function sub() {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));		
		
		{
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu']		= 49;	
		$container['content']['view']						= 'rka/murni/belanja_langsung/sub';		

			$container['rka']								= $this->Rka_model->bl($kode);
			$container['rincian']							= $this->Rka_model->get_rincian($kode);
			$container['sub']								= $this->Rka_model->sub($kode,true);
			$container['sum']								= $this->Rka_model->sum($kode,true);
			$container['jum']								= $this->Rka_model->jum($kode,true);
			
			$rka = $this->Rka_model->get('rka.*', array('rka.kode'=>$this->uri->segment(4)));		
			$container['content']['dataset']['kode']		= $rka->kode;
			$container['content']['dataset']['rka']			= $rka->anggaran_kode;
		
		} 			
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/tables');
	}
	
	public function adds($list_id = null) {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));		
		$this->form_validation->set_rules('aaa_kode', 'Uraian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_kode', 'No', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_kode', 'Rka', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rincian_kode', 'Anggaran_kode', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Harga', 'trim|required|xss_clean');
		$this->form_validation->set_rules('userMsg', 'Satuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('thirdBox', 'Volume', 'trim|required|xss_clean');
		$this->form_validation->set_rules('total_sum', 'Total', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE) {
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu']		= 49;	
		$container['content']['view']						= 'rka/murni/belanja_langsung/adds';

			$container['rka']								= $this->Rka_model->bl($kode);
			$container['rincian']							= $this->Rka_model->get_rincian($kode);
			$container['sub']								= $this->Rka_model->sub($kode,true);
			$container['bls']								= $this->Rka_model->bls($kode);	
			$container['sum'] 								= $this->Rka_model->get_sum($list_id);			
			
			$belanja										= $this->Anggaran_model->get('1','anggaran.kode, anggaran.skpd_kode, skpd.urusan as id_urusan, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, visi.visi as visi_nama, misi.misi as misi_nama, prioritas.prioritas as prioritas_nama, tujuan.tujuan as tujuan_nama, sasaran.sasaran as sasaran_nama, indikator.indikator as indikator_nama, urusan.urusan as urusan_nama, program.kode as program_kode, program.program as program_nama, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan', array('anggaran.kode'=>$kode));
			$container['content']['dataset']['kode'] 		= $belanja->kode;
			$container['content']['dataset']['program'] 	= $belanja->program_kode;
			$container['content']['dataset']['program_'] 	= $belanja->program_nama;
			$container['content']['dataset']['skpd'] 		= $belanja->skpd_kode;
			$container['content']['dataset']['skpd_'] 		= $belanja->skpd_nama;
			$container['content']['dataset']['tahun'] 		= $belanja->tahun;
			$container['content']['dataset']['urusan'] 		= $belanja->id_urusan;
			$container['content']['dataset']['kegiatan'] 	= $belanja->kegiatan;
			
		} else {			
			$insert['uraian']		= $this->input->post('aaa_kode');
			$insert['no']			= $this->input->post('no_kode');
			$insert['rka']			= $this->input->post('id_kode');			
			$insert['rka_rincian']	= $this->input->post('kode');			
			$insert['harga']		= $this->input->post('bbb_kode');
			$insert['satuan'] 		= $this->input->post('userMsg');
			$insert['volume']		= $this->input->post('thirdBox');
			$insert['total']		= $this->input->post('total_sum');
			$insert['anggaran_kode']= $this->input->post('rincian_kode');
			$id_kode				= $this->input->post('kode');
			$insert['tipe_kode']	= 1;
			
			$query = $this->Rka_model->inserts($insert);			
			$this->session->set_flashdata('success','<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB RINCIAN BELANJA" baru telah berhasil ditambahkan.</div>');
			redirect('rka/murni/sub/'.$id_kode);
		}
			
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function simpan() {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));	
		
		$total		= $this->input->post('total_sum');
		$sisa		= $this->input->post('sisa');
		$id_kode	= $this->input->post('kode');
		
		if($total > $sisa) {

			$this->session->set_flashdata('success','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> "ANGGARAN" Lebih</div>');
			redirect('rka/murni/adds/'.$id_kode);

		} else if($total < $sisa) {

		$this->form_validation->set_rules('aaa_kode', 'Uraian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_kode', 'No', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_kode', 'Rka', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rincian_kode', 'Anggaran_kode', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Harga', 'trim|required|xss_clean');
		$this->form_validation->set_rules('userMsg', 'Satuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('thirdBox', 'Volume', 'trim|required|xss_clean');
		$this->form_validation->set_rules('total_sum', 'Total', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE) {
			} else {			
			$insert['uraian']		= $this->input->post('aaa_kode');
			$insert['no']			= $this->input->post('no_kode');
			$insert['rka']			= $this->input->post('id_kode');			
			$insert['rka_rincian']	= $this->input->post('kode');			
			$insert['harga']		= $this->input->post('bbb_kode');
			$insert['satuan'] 		= $this->input->post('userMsg');
			$insert['volume']		= $this->input->post('thirdBox');
			$insert['total']		= $this->input->post('total_sum');
			$insert['anggaran_kode']= $this->input->post('rincian_kode');
			$insert['tipe_kode']	= 1;
			
			$query = $this->Rka_model->inserts($insert);
			$this->session->set_flashdata('success','<div class="alert alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> "ANGGARAN" Kurang</div>');
			redirect('rka/murni/sub/'.$id_kode); }
		} else {

		$this->form_validation->set_rules('aaa_kode', 'Uraian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_kode', 'No', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_kode', 'Rka', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rincian_kode', 'Anggaran_kode', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Harga', 'trim|required|xss_clean');
		$this->form_validation->set_rules('userMsg', 'Satuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('thirdBox', 'Volume', 'trim|required|xss_clean');
		$this->form_validation->set_rules('total_sum', 'Total', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE) {
			} else {			
			$insert['uraian']		= $this->input->post('aaa_kode');
			$insert['no']			= $this->input->post('no_kode');
			$insert['rka']			= $this->input->post('id_kode');			
			$insert['rka_rincian']	= $this->input->post('kode');			
			$insert['harga']		= $this->input->post('bbb_kode');
			$insert['satuan'] 		= $this->input->post('userMsg');
			$insert['volume']		= $this->input->post('thirdBox');
			$insert['total']		= $this->input->post('total_sum');
			$insert['anggaran_kode']= $this->input->post('rincian_kode');
			$insert['tipe_kode']	= 1;
			
			$query = $this->Rka_model->inserts($insert);
			$this->session->set_flashdata('success','<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> "ANGGARAN" Pas</div>');
			redirect('rka/murni/sub/'.$id_kode); }
		}
	}
	
	public function edits($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$jenis 		= $this->Jenis_model->getOnly('kode, akun_sort, kelompok, status', array('kode'=>$kode));	 {
		$this->form_validation->set_rules('aaa_kode','Uraian','trim|xss_clean');
	//	$this->form_validation->set_rules('bbb_kode','Harga','trim|xss_clean');
		$this->form_validation->set_rules('userMsg','Satuan','trim|xss_clean');
	//	$this->form_validation->set_rules('thirdBox','Volume','trim|xss_clean');
	//	$this->form_validation->set_rules('total_sum','Total','trim|xss_clean');

		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu']		= 49;	
		$container['content']['view']						= 'rka/murni/belanja_langsung/edits';
		
		$container['sub']									= $this->Rka_model->get_sub($kode);
		
			if($this->form_validation->run() == FALSE){	
				$sub = $this->Rka_model->gets('rka_sub.*', array('rka_sub.kode'=>$this->uri->segment(4)));
				$container['content']['dataset']['kode']	= $sub->kode;
				$container['content']['dataset']['no']		= $sub->no;
				$container['content']['dataset']['uraian']	= $sub->uraian;
				$container['content']['dataset']['rka']		= $sub->rka;
				$container['content']['dataset']['harga']	= $sub->harga;
				$container['content']['dataset']['satuan']	= $sub->satuan;
				$container['content']['dataset']['volume']	= $sub->volume;
				$container['content']['dataset']['total']	= $sub->total;
				$container['content']['dataset']['rincian']	= $sub->rka_rincian;
				$container['content']['dataset']['anggaran']= $sub->anggaran_kode;
								
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
			$update['uraian']		= $this->input->post('aaa_kode');			
		//	$update['harga']		= $this->input->post('bbb_kode');
			$update['satuan'] 		= $this->input->post('userMsg');
		//	$update['volume']		= $this->input->post('thirdBox');
		//	$update['total']		= $this->input->post('total_sum');
			$id_kode				= $this->input->post('id_kode');
			$query = $this->Rka_model->updates($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN BELANJA" telah berhasil diubah</div>');
			redirect('rka/murni/sub/'.$id_kode, 'refresh');
			}
		}
    }
	
	public function ubah_BELUM_JADI() {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));	
		
		$total		= $this->input->post('total_sum');
		$sisa		= $this->input->post('sisa');
		$id_kode	= $this->input->post('kode');
		
		if($total > $sisa) {

			$this->session->set_flashdata('success','<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> "ANGGARAN" Lebih</div>');
			redirect('rka/murni/adds/'.$id_kode);

		} else if($total < $sisa) {
			
		$this->form_validation->set_rules('aaa_kode', 'Uraian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_kode', 'No', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_kode', 'Rka', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rincian_kode', 'Anggaran_kode', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Harga', 'trim|required|xss_clean');
		$this->form_validation->set_rules('userMsg', 'Satuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('thirdBox', 'Volume', 'trim|required|xss_clean');
		$this->form_validation->set_rules('total_sum', 'Total', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE) {
			} else {			
			$insert['uraian']		= $this->input->post('aaa_kode');
			$insert['no']			= $this->input->post('no_kode');
			$insert['rka']			= $this->input->post('id_kode');			
			$insert['rka_rincian']	= $this->input->post('kode');			
			$insert['harga']		= $this->input->post('bbb_kode');
			$insert['satuan'] 		= $this->input->post('userMsg');
			$insert['volume']		= $this->input->post('thirdBox');
			$insert['total']		= $this->input->post('total_sum');
			$insert['anggaran_kode']= $this->input->post('rincian_kode');
			$insert['tipe_kode']	= 1;
			
			$query = $this->Rka_model->inserts($insert);
			$this->session->set_flashdata('success','<div class="alert alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> "ANGGARAN" Kurang</div>');
			redirect('rka/murni/sub/'.$id_kode);
			}
		
		} else {

		$this->form_validation->set_rules('aaa_kode', 'Uraian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_kode', 'No', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_kode', 'Rka', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rincian_kode', 'Anggaran_kode', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Harga', 'trim|required|xss_clean');
		$this->form_validation->set_rules('userMsg', 'Satuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('thirdBox', 'Volume', 'trim|required|xss_clean');
		$this->form_validation->set_rules('total_sum', 'Total', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE) {
			} else {			
			$insert['uraian']		= $this->input->post('aaa_kode');
			$insert['no']			= $this->input->post('no_kode');
			$insert['rka']			= $this->input->post('id_kode');			
			$insert['rka_rincian']	= $this->input->post('kode');			
			$insert['harga']		= $this->input->post('bbb_kode');
			$insert['satuan'] 		= $this->input->post('userMsg');
			$insert['volume']		= $this->input->post('thirdBox');
			$insert['total']		= $this->input->post('total_sum');
			$insert['anggaran_kode']= $this->input->post('rincian_kode');
			$insert['tipe_kode']	= 1;
			
			$query = $this->Rka_model->inserts($insert);
			$this->session->set_flashdata('success','<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> "ANGGARAN" Pas</div>');
			redirect('rka/murni/sub/'.$id_kode);
			}
		}
	}
	
	public function deletes() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$sub 		= $this->Rka_model->getOnlys('kode, rka_rincian', array('kode'=>$kode));
			$this->Rka_model->delete5($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "SUB RINCIAN BELANJA" telah berhasil dihapus</div>');
			redirect('rka/murni/sub/'.$sub->rka_rincian, 'refresh');
		}
	}
	
	public function view() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 49;
			$container['content']['view']					= 'rka/murni/belanja_langsung/view';
			
			$rka = $this->Rka_model->get('rka.*', array('rka.anggaran_kode'=>$this->uri->segment(4)));		
			$container['content']['dataset']['kode']		= $rka->kode;
			$container['content']['dataset']['tahun']		= $rka->tahun;
			$container['content']['dataset']['anggaran']	= $rka->anggaran_kode;
			$container['content']['dataset']['skpd']		= $rka->skpd;

		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
		}
	}
	
	public function rka() {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));		
		$this->form_validation->set_rules('aaa_kode', 'Akun', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Kelompok', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ccc_kode', 'Jenis', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ddd_kode', 'Obyek', 'trim|required|xss_clean');
		$this->form_validation->set_rules('eee_kode', 'Rincian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sss_kode', 'Sumber', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_kode', 'No', 'trim|required|xss_clean');
		{
			if($this->form_validation->run() == FALSE){
				
			$container['sidebar']['view']						= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] 	= 49;	
			$container['content']['view']						= 'rka/murni/belanja_langsung/view';		

			$where_akun										= 'kode IN (\'5\')';
			$where_sumber									= 'tipe_sort IN (\'5\')';
			$container['content']['dataset']['akun']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['sumber']		= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_sumber);
			$container['bl']								= $this->Rka_model->get_bl($kode,true);
			
			$rka = $this->Rka_model->get('rka.*', array('rka.anggaran_kode'=>$this->uri->segment(4)));		
			$container['content']['dataset']['id_kode']		= $rka->kode;

			$belanja										= $this->Anggaran_model->get('1','anggaran.kode, anggaran.skpd_kode, skpd.urusan as id_urusan, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, visi.visi as visi_nama, misi.misi as misi_nama, prioritas.prioritas as prioritas_nama, tujuan.tujuan as tujuan_nama, sasaran.sasaran as sasaran_nama, indikator.indikator as indikator_nama, urusan.urusan as urusan_nama, program.kode as program_kode, program.program as program_nama, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan', array('anggaran.kode'=>$kode));
			$container['content']['dataset']['kode'] 		= $belanja->kode;
			$container['content']['dataset']['program'] 	= $belanja->program_kode;
			$container['content']['dataset']['program_'] 	= $belanja->program_nama;
			$container['content']['dataset']['skpd'] 		= $belanja->skpd_kode;
			$container['content']['dataset']['skpd_'] 		= $belanja->skpd_nama;
			$container['content']['dataset']['tahun'] 		= $belanja->tahun;
			$container['content']['dataset']['urusan'] 		= $belanja->id_urusan;
			$container['content']['dataset']['kegiatan'] 	= $belanja->kegiatan;

				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(
					'akun'			=> $this->input->post('aaa_kode'),
					'kelompok'		=> $this->input->post('bbb_kode'),
					'jenis'			=> $this->input->post('ccc_kode'),
					'obyek'			=> $this->input->post('ddd_kode'),
					'rincian'		=> $this->input->post('eee_kode'),
					'sumber'		=> $this->input->post('sss_kode'),
					'tahun'			=> $this->input->post('thn_kode'),
					'skpd' 			=> $this->input->post('skpd_kode'),
					'no' 			=> $this->input->post('no_kode'),
					'anggaran_kode'	=> $this->input->post('id_kode'),					
					'program'		=> $this->input->post('program_kode'),
					'urusan'		=> $this->input->post('urusan_kode'),
					'tipe_kode'		=> 1
					);
				$id_kode			= $this->input->post('id_kode');
				if($this->Rka_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING OBYEK" telah berhasil ditambahkan</div>');
				   redirect('rka/murni/belanja/'.$id_kode);
				}
			}
		}
    }
	
	public function preview() {	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 49;
		$container['content']['view']					= 'rka/murni/belanja_langsung/preview';
		$header['admin_log']							= $admin_log;
		
		$rka = $this->Rka_model->get('rka.*', array('rka.anggaran_kode'=>$this->uri->segment(4)));
		$container['content']['dataset']['kode']		= $rka->kode;
		$container['content']['dataset']['tahun']		= $rka->tahun;
		$container['content']['dataset']['rka']			= $rka->anggaran_kode;
		$container['content']['dataset']['skpd'] 		= $rka->skpd;
		
		$sess_laporan = array(
			'laporan_tanggal'  	=> $this->input->post('tanggal'),
			'laporan_tahun' 	=> $this->input->post('tahun'),
			'laporan_anggaran' 	=> $this->input->post('anggaran_kode'),
			'laporan_kecamatan'	=> $this->input->post('kecamatan'),
			'laporan_skpd'		=> $this->input->post('skpd'),
			'laporan_kode'		=> $this->input->post('kode'),
			'laporan_pimpinan'  => $this->input->post('nama_pimpinan'),
			'laporan_pangkat'  	=> $this->input->post('pangkat'),
			'laporan_nip'  		=> $this->input->post('nip')
			);
		
		if ($this->input->post('tahun')) { 
			$this->session->unset_userdata('is_sess_laporan');
			$this->session->set_userdata('is_sess_laporan', $sess_laporan);			
			$container['content']['view']	= 'rka/murni/belanja_langsung/preview';
		}
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function hasil() {	
		$tipe 		= $this->uri->segment(4);
		if ($tipe == 'excel') {
			$laporan['excel']	= TRUE;
		} else if ($tipe == 'pdf'){ 
			$laporan['pdf']		= TRUE;
		} else {
			$laporan['excel']	= FALSE;
			$laporan['pdf']		= FALSE;
		}
		$admin_log 		= $this->auth->is_login_admin();
		$sess_laporan 	= $this->session->userdata('is_sess_laporan');

		$laporan['aa']					= $this->Data_model->get_rka($kode);
		$laporan['rka']					= $this->Rka_model->view($kode);
		
		$laporan['laporan_tanggal']		= $sess_laporan['laporan_tanggal'];
		$laporan['laporan_tahun']		= $sess_laporan['laporan_tahun'];
		$laporan['laporan_anggaran']	= $sess_laporan['laporan_anggaran'];
		$laporan['laporan_kecamatan']	= $sess_laporan['laporan_kecamatan'];
		$laporan['laporan_skpd']		= $sess_laporan['laporan_skpd'];
		$laporan['laporan_kode']		= $sess_laporan['laporan_kode'];
		$laporan['laporan_pimpinan']	= $sess_laporan['laporan_pimpinan'];
		$laporan['laporan_pangkat']		= $sess_laporan['laporan_pangkat'];
		$laporan['laporan_nip']			= $sess_laporan['laporan_nip'];
		
		$this->load->view('rka/murni/belanja_langsung/hasil', $laporan);
	}
	
	 function hasil2() {
        $this->load->helper('dompdf');      
		$admin_log 		= $this->auth->is_login_admin();
		$sess_laporan 	= $this->session->userdata('is_sess_laporan');

		$laporan['rka']					= $this->Rka_model->view($kode);

		$laporan['laporan_tanggal']		= $sess_laporan['laporan_tanggal'];
		$laporan['laporan_tahun']		= $sess_laporan['laporan_tahun'];
		$laporan['laporan_anggaran']	= $sess_laporan['laporan_anggaran'];
		
        $html = $this->load->view('rka/murni/belanja_langsung/hasil2', $laporan, true);
        $filename = 'Message';
        $paper = 'A4';
        $orientation = 'potrait';
        pdf_create($html, $filename, $paper, $orientation);
    }
	
	public function tim() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 49;
			$container['content']['view']					= 'rka/murni/belanja_langsung/tim';
			
			$this->form_validation->set_rules('aaa_kode','Kode_tim','trim|xss_clean');
			$this->form_validation->set_rules('bbb_kode','No','trim|xss_clean');
			$this->form_validation->set_rules('ccc_kode','Nama','trim|xss_clean');
			$this->form_validation->set_rules('ddd_kode','Nip','trim|xss_clean');
			$this->form_validation->set_rules('eee_kode','Jabatan','trim|xss_clean');
			if($this->form_validation->run() == FALSE){	
			
			$tim_anggaran = $this->Tim_anggaran_model->get('tim_anggaran.*', array('tim_anggaran.kode'=>$this->uri->segment(4)));		
			$container['content']['dataset']['kode']		= $tim_anggaran->kode;
			$container['content']['dataset']['aaa_kode']	= $tim_anggaran->kode_tim;
			$container['content']['dataset']['bbb_kode']	= $tim_anggaran->no;
			$container['content']['dataset']['ccc_kode']	= $tim_anggaran->nama;
			$container['content']['dataset']['ddd_kode']	= $tim_anggaran->nip;
			$container['content']['dataset']['eee_kode']	= $tim_anggaran->jabatan;
				
				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				
			$update['kode_tim']	= $this->input->post('aaa_kode');			
			$update['no']		= $this->input->post('bbb_kode');			
			$update['nama']		= $this->input->post('ccc_kode');			
			$update['nip']		= $this->input->post('ddd_kode');
			$update['jabatan']	= $this->input->post('eee_kode');
			
			$query = $this->Tim_anggaran_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "TIM ANGGARAN" telah berhasil diubah</div>');
			redirect('parameter/tim_anggaran', 'refresh');
			}
		}
    }
	
	public function penyedia() {
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '16'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '16'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rka/murni/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode, status', array('kode'=>$kode));
			
			if ($anggaran->status == 1){
				$container['sidebar']['view']						= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] 	= 49;
				if ($anggaran->tipe_kode == 1){
					$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode as kode_anggaran, anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.*', array('anggaran.kode'=>$kode));
					
					$container['content']['view']					= 'rka/murni/belanja_langsung/rup/penyedia';
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
					$container['content']['dataset']['paket']		= $this->Rup_model->grid_rka('rincian.kode, rincian.rincian_nama', 'rincian.rincian_nama', '', '', '', array('anggaran_kode'=>$kode));
					$container['content']['dataset']['belanja']		= $this->Rup_model->grid_jenis('kode, jenis_nama', 'jenis_nama', '', '', '', array('tipe_sort'=>'1'));
					$container['content']['dataset']['pengadaan']	= $this->Rup_model->grid_jenis('kode, jenis_nama', 'jenis_nama', '', '', '', array('tipe_sort'=>'2'));
					$container['content']['dataset']['sumber']		= $this->Rup_model->grid_jenis('kode, jenis_nama', 'jenis_nama', '', '', '', array('tipe_sort'=>'3'));
					$container['content']['dataset']['metode']		= $this->Rup_model->grid_metode('kode, metode_nama', 'metode_nama', '', '', '', array('tipe_sort'=>'1'));
					
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
					$container['content']['dataset']['foto_'] 		= explode(", ", $anggaran_bl->foto);
					$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;					
				}
				
				$header['admin_log']								= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
			} else {
				redirect('rka/murni/#warningTransfer', 'refresh');
			}
		}
	}
	
	public function addPenyedia(){
		$admin_log = $this->auth->is_login_admin();
		$type = $this->uri->segment(4);
		$kode = $this->uri->segment(5);
		if ($type == 'bl'){
			$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|xss_clean');
			$this->form_validation->set_rules('skpd_kode', 'SKPD Pelaksana', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$container['sidebar']['view']					= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] = 49;
				$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode as kode_anggaran, anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.*', array('anggaran.kode'=>$kode));
			
				$container['content']['view']					= 'rka/murni/belanja_langsung/rup/penyedia';
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
				$tahapan_kode = 22;
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
					$anggaran_id = $this->Anggaran_model->getOnly('lokasi_kode, kecamatan_kode, deskel_kode, rw, rt, foto, koordinat, sumber_kode, proposal, verifikasi', array('kode'=>$kode));
					$insert['skpd_kode']		= $this->input->post('skpd_kode');
					$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
					$insert['tahun']			= $this->input->post('tahun');
					
					if ($this->input->post('kegiatan') == 'Lainnya...'){
						$insert['kegiatan']			= $this->input->post('kegiatan_lainnya');
					} else {
						$insert['kegiatan']			= $this->input->post('kegiatan');
					}
					
					$insert['lokasi_kode']		= $anggaran_id->lokasi_kode;
					$insert['kecamatan_kode']	= $anggaran_id->kecamatan_kode;
					$insert['deskel_kode']		= $anggaran_id->deskel_kode;
					$insert['rw']				= $anggaran_id->rw;
					$insert['rt']				= $anggaran_id->rt;
					$insert['foto']				= $anggaran_id->foto;
					$insert['koordinat']		= $anggaran_id->koordinat;					
					$insert['alamat']			= $this->input->post('alamat');
					$insert['catatan']			= $this->input->post('catatan');
					$insert['status']			= 1;
					$insert['proses_kode']		= 1;
					$insert['sumber_kode']		= $anggaran_id->sumber_kode;
					$insert['sumber_id']		= $kode;
					$insert['tahapan_kode']		= 22;
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
					$anggaran_bl = $this->Anggaran_model->getOnli('kode, misi_kode, prioritas_kode, tujuan_kode, sasaran_kode, indikator_kode, urusan_kode, program_kode, sifat_kode, kesepakatan_kode, urutan, hp_ukur, hp_target, hp_satuan, kh_ukur, kh_target, kh_satuan, hk_ukur, hk_target, hk_satuan, apbd_kab, apbd_prov, apbn, sumberlain, perkiraan_maju', array('kode'=>$kode));
					$insert_bl['anggaran_kode']		= $anggaran->kode;
					$insert_bl['visi_kode']			= 1;
					$insert_bl['misi_kode']			= $anggaran_bl->misi_kode;
					$insert_bl['prioritas_kode']	= $anggaran_bl->prioritas_kode;
					$insert_bl['tujuan_kode']		= $anggaran_bl->tujuan_kode;
					$insert_bl['sasaran_kode']		= $anggaran_bl->sasaran_kode;
					$insert_bl['indikator_kode']	= $anggaran_bl->indikator_kode;
					$insert_bl['urusan_kode']		= $anggaran_bl->urusan_kode;
					$insert_bl['program_kode']		= $anggaran_bl->program_kode;
					$insert_bl['sifat_kode']		= $anggaran_bl->sifat_kode;
					$insert_bl['kesepakatan_kode']	= $anggaran_bl->kesepakatan_kode;
					$insert_bl['urutan']			= $anggaran_bl->urutan;
					$insert_bl['hp_ukur']			= $anggaran_bl->hp_ukur;
					$insert_bl['hp_target']			= $anggaran_bl->hp_target;
					$insert_bl['hp_satuan']			= $anggaran_bl->hp_satuan;
					$insert_bl['kh_ukur']			= $anggaran_bl->kh_ukur;
					$insert_bl['kh_target']			= $anggaran_bl->kh_target;
					$insert_bl['kh_satuan']			= $anggaran_bl->kh_satuan;
					$insert_bl['hk_ukur']			= $anggaran_bl->hk_ukur;
					$insert_bl['hk_target']			= $anggaran_bl->hk_target;
					$insert_bl['hk_satuan']			= $anggaran_bl->hk_satuan;
					$insert_bl['apbd_kab']			= $anggaran_bl->apbd_kab;
					$insert_bl['apbd_prov']			= $anggaran_bl->apbd_prov;
					$insert_bl['apbn']				= $anggaran_bl->apbn;
					$insert_bl['sumberlain']		= $anggaran_bl->sumberlain;
					$insert_bl['perkiraan_maju']	= $anggaran_bl->perkiraan_maju;
					$this->Anggaran_model->insert('anggaran_bl', $insert_bl); // Insert Anggaran_bl
					
					//Insert Rup
					$anggaran = $this->Anggaran_model->getOnly('kode', array('admin_user'=>$admin_log['username'], 'tipe_kode'=>1));
					$rup_id = $this->Anggaran_model->getOnli('kode, misi_kode, prioritas_kode, tujuan_kode, sasaran_kode, indikator_kode, urusan_kode, program_kode, sifat_kode, kesepakatan_kode, urutan, hp_ukur, hp_target, hp_satuan, kh_ukur, kh_target, kh_satuan, hk_ukur, hk_target, hk_satuan, apbd_kab, apbd_prov, apbn, sumberlain, perkiraan_maju', array('kode'=>$kode));
					$insert_rup['anggaran_kode']	= $anggaran->kode;
					$insert_rup['tipe_kode']		= 1;
					$insert_rup['aktif']			= 1;
					$insert_rup['umumkan']			= 1;
					$insert_rup['status']			= 1;
					$insert_rup['id_paket']			= $this->input->post('id_paket');
					$insert_rup['jenis_belanja']	= $this->input->post('belanja_kode');
					$insert_rup['jenis_pengadaan']	= $this->input->post('pengadaan_kode');
					$insert_rup['rincian']			= $this->input->post('paket_kode');
					$insert_rup['sumber_dana']		= $this->input->post('sumber_kode');
					$insert_rup['metode']			= $this->input->post('metode_kode');
					$insert_rup['asal_dana']		= $this->input->post('kode_dana');
					$insert_rup['kode_dpa']			= $this->input->post('kode_dpa');
					$insert_rup['volume']			= $this->input->post('volume');
					$insert_rup['pm_awal']			= $this->input->post('pm_awal');
					$insert_rup['pm_akhir']			= $this->input->post('pm_akhir');
					$insert_rup['pk_awal']			= $this->input->post('pk_awal');
					$insert_rup['pk_akhir']			= $this->input->post('pk_akhir');
					$this->Rup_model->insert('rup', $insert_rup); // Insert Rup
					redirect('rka/murni/#successPenyedia', 'refresh');
				} else {
					redirect('rka/murni/#warningAPBD', 'refresh');
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
				$container['sidebar']['dataset']['aktive_menu'] = 49;
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
				$insert['tahapan_kode']		= 22;
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
				redirect('rka/murni', 'refresh');
			}
		}
	}
	
	public function swakelola() {
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '16'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '16'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rka/murni/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode, status', array('kode'=>$kode));
			
			if ($anggaran->status == 1){
				$container['sidebar']['view']						= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] 	= 49;
				if ($anggaran->tipe_kode == 1){
					$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode as kode_anggaran, anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.*', array('anggaran.kode'=>$kode));
					
					$container['content']['view']					= 'rka/murni/belanja_langsung/rup/swakelola';
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
					$container['content']['dataset']['paket']		= $this->Rup_model->grid_rka('rincian.kode, rincian.rincian_nama', 'rincian.rincian_nama', '', '', '', array('anggaran_kode'=>$kode));
					$container['content']['dataset']['belanja']		= $this->Rup_model->grid_jenis('kode, jenis_nama', 'jenis_nama', '', '', '', array('tipe_sort'=>'1'));
					$container['content']['dataset']['pengadaan']	= $this->Rup_model->grid_jenis('kode, jenis_nama', 'jenis_nama', '', '', '', array('tipe_sort'=>'2'));
					$container['content']['dataset']['sumber']		= $this->Rup_model->grid_jenis('kode, jenis_nama', 'jenis_nama', '', '', '', array('tipe_sort'=>'3'));
					$container['content']['dataset']['metode']		= $this->Rup_model->grid_metode('kode, metode_nama', 'metode_nama', '', '', '', array('tipe_sort'=>'1'));
					
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
					$container['content']['dataset']['foto_'] 		= explode(", ", $anggaran_bl->foto);
					$container['content']['dataset']['koordinat'] 	= $anggaran_bl->koordinat;
					$container['content']['dataset']['catatan'] 	= $anggaran_bl->catatan;					
				}
				
				$header['admin_log']								= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');
			} else {
				redirect('rka/murni/#warningTransfer', 'refresh');
			}
		}
	}
	
	public function addSwakelola(){
		$admin_log = $this->auth->is_login_admin();
		$type = $this->uri->segment(4);
		$kode = $this->uri->segment(5);
		if ($type == 'bl'){
			$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|xss_clean');
			$this->form_validation->set_rules('skpd_kode', 'SKPD Pelaksana', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$container['sidebar']['view']					= 'admin/sidebar';
				$container['sidebar']['dataset']['aktive_menu'] = 49;
				$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode as kode_anggaran, anggaran.*, anggaran_bl.kode as bl_kode, anggaran_bl.*', array('anggaran.kode'=>$kode));
			
				$container['content']['view']					= 'rka/murni/belanja_langsung/rup/swakelola';
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
				$tahapan_kode = 22;
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
					$anggaran_id = $this->Anggaran_model->getOnly('lokasi_kode, kecamatan_kode, deskel_kode, rw, rt, foto, koordinat, sumber_kode, proposal, verifikasi', array('kode'=>$kode));
					$insert['skpd_kode']		= $this->input->post('skpd_kode');
					$insert['pelaksana_kode']	= $this->input->post('skpd_kode');
					$insert['tahun']			= $this->input->post('tahun');
					
					if ($this->input->post('kegiatan') == 'Lainnya...'){
						$insert['kegiatan']			= $this->input->post('kegiatan_lainnya');
					} else {
						$insert['kegiatan']			= $this->input->post('kegiatan');
					}
					
					$insert['lokasi_kode']		= $anggaran_id->lokasi_kode;
					$insert['kecamatan_kode']	= $anggaran_id->kecamatan_kode;
					$insert['deskel_kode']		= $anggaran_id->deskel_kode;
					$insert['rw']				= $anggaran_id->rw;
					$insert['rt']				= $anggaran_id->rt;
					$insert['foto']				= $anggaran_id->foto;
					$insert['koordinat']		= $anggaran_id->koordinat;					
					$insert['alamat']			= $this->input->post('alamat');
					$insert['catatan']			= $this->input->post('catatan');
					$insert['status']			= 1;
					$insert['proses_kode']		= 1;
					$insert['sumber_kode']		= $anggaran_id->sumber_kode;
					$insert['sumber_id']		= $kode;
					$insert['tahapan_kode']		= 22;
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
					$anggaran_bl = $this->Anggaran_model->getOnli('kode, misi_kode, prioritas_kode, tujuan_kode, sasaran_kode, indikator_kode, urusan_kode, program_kode, sifat_kode, kesepakatan_kode, urutan, hp_ukur, hp_target, hp_satuan, kh_ukur, kh_target, kh_satuan, hk_ukur, hk_target, hk_satuan, apbd_kab, apbd_prov, apbn, sumberlain, perkiraan_maju', array('kode'=>$kode));
					$insert_bl['anggaran_kode']		= $anggaran->kode;
					$insert_bl['visi_kode']			= 1;
					$insert_bl['misi_kode']			= $anggaran_bl->misi_kode;
					$insert_bl['prioritas_kode']	= $anggaran_bl->prioritas_kode;
					$insert_bl['tujuan_kode']		= $anggaran_bl->tujuan_kode;
					$insert_bl['sasaran_kode']		= $anggaran_bl->sasaran_kode;
					$insert_bl['indikator_kode']	= $anggaran_bl->indikator_kode;
					$insert_bl['urusan_kode']		= $anggaran_bl->urusan_kode;
					$insert_bl['program_kode']		= $anggaran_bl->program_kode;
					$insert_bl['sifat_kode']		= $anggaran_bl->sifat_kode;
					$insert_bl['kesepakatan_kode']	= $anggaran_bl->kesepakatan_kode;
					$insert_bl['urutan']			= $anggaran_bl->urutan;
					$insert_bl['hp_ukur']			= $anggaran_bl->hp_ukur;
					$insert_bl['hp_target']			= $anggaran_bl->hp_target;
					$insert_bl['hp_satuan']			= $anggaran_bl->hp_satuan;
					$insert_bl['kh_ukur']			= $anggaran_bl->kh_ukur;
					$insert_bl['kh_target']			= $anggaran_bl->kh_target;
					$insert_bl['kh_satuan']			= $anggaran_bl->kh_satuan;
					$insert_bl['hk_ukur']			= $anggaran_bl->hk_ukur;
					$insert_bl['hk_target']			= $anggaran_bl->hk_target;
					$insert_bl['hk_satuan']			= $anggaran_bl->hk_satuan;
					$insert_bl['apbd_kab']			= $anggaran_bl->apbd_kab;
					$insert_bl['apbd_prov']			= $anggaran_bl->apbd_prov;
					$insert_bl['apbn']				= $anggaran_bl->apbn;
					$insert_bl['sumberlain']		= $anggaran_bl->sumberlain;
					$insert_bl['perkiraan_maju']	= $anggaran_bl->perkiraan_maju;
					$this->Anggaran_model->insert('anggaran_bl', $insert_bl); // Insert Anggaran_bl
					
					//Insert Rup
					$anggaran = $this->Anggaran_model->getOnly('kode', array('admin_user'=>$admin_log['username'], 'tipe_kode'=>1));
					$rup_id = $this->Anggaran_model->getOnli('kode, misi_kode, prioritas_kode, tujuan_kode, sasaran_kode, indikator_kode, urusan_kode, program_kode, sifat_kode, kesepakatan_kode, urutan, hp_ukur, hp_target, hp_satuan, kh_ukur, kh_target, kh_satuan, hk_ukur, hk_target, hk_satuan, apbd_kab, apbd_prov, apbn, sumberlain, perkiraan_maju', array('kode'=>$kode));
					$insert_rup['anggaran_kode']	= $anggaran->kode;
					$insert_rup['tipe_kode']		= 2;
					$insert_rup['aktif']			= 1;
					$insert_rup['umumkan']			= 1;
					$insert_rup['status']			= 1;
					$insert_rup['id_paket']			= $this->input->post('id_paket');
					$insert_rup['jenis_belanja']	= $this->input->post('belanja_kode');
					$insert_rup['jenis_pengadaan']	= $this->input->post('pengadaan_kode');
					$insert_rup['rincian']			= $this->input->post('paket_kode');
					$insert_rup['sumber_dana']		= $this->input->post('sumber_kode');
					$insert_rup['metode']			= $this->input->post('metode_kode');
					$insert_rup['asal_dana']		= $this->input->post('kode_dana');
					$insert_rup['kode_dpa']			= $this->input->post('kode_dpa');
					$insert_rup['volume']			= $this->input->post('volume');
					$insert_rup['pm_awal']			= $this->input->post('pm_awal');
					$insert_rup['pm_akhir']			= $this->input->post('pm_akhir');
					$insert_rup['pk_awal']			= $this->input->post('pk_awal');
					$insert_rup['pk_akhir']			= $this->input->post('pk_akhir');
					$this->Rup_model->insert('rup', $insert_rup); // Insert Rup				
					redirect('rka/murni/#successSwakelola', 'refresh');
				} else {
					redirect('rka/murni/#warningAPBD', 'refresh');
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
				$container['sidebar']['dataset']['aktive_menu'] = 49;
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
				$insert['tahapan_kode']		= 22;
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
				redirect('rka/murni', 'refresh');
			}
		}
	}
	
	public function belanja_tidak_langsung() {
		$admin_log = $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '16'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '16'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rka/murni/#warningEntri', 'refresh');
		} else {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 49;
			$container['content']['view']					= 'rka/murni/belanja_tidak_langsung/add';
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
	
	public function tampil_combobox_akun_by_kelompok(){
		$where_kelompok = 'kode IN (\'16\')';
		$akun_kode	= $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('ms_rek_2.kode, ms_rek_2.nm_rek_2', 'ms_rek_2.nm_rek_2', '', '', '', $where_kelompok, array('ms_rek_2.kd_rek_1'=>$akun_kode));			
			combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'nm_rek_2', '', 'show_form_kelompok_by_jenis();', 'Pilih Kelompok ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}	
	
	public function tampil_combobox_kelompok_by_jenis(){
		$kelompok_kode 	= $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('ms_rek_3.kode, ms_rek_3.nm_rek_3', 'ms_rek_3.nm_rek_3', '', '', '', array('ms_rek_3.kd_rek_2'=>$kelompok_kode));
			combobox('db', $data_jenis, 'ccc_kode', 'kode', 'nm_rek_3', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_jenis_by_obyek(){
		$jenis_kode = $this->uri->segment(4);
		if ($jenis_kode){
			$data_obyek = $this->Obyek_model->grid_all('ms_rek_4.kode, ms_rek_4.nm_rek_4', 'ms_rek_4.nm_rek_4', '', '', '', array('ms_rek_4.kd_rek_3'=>$jenis_kode));
			combobox('db', $data_obyek, 'ddd_kode', 'kode', 'nm_rek_4', '', 'show_form_obyek_by_rincian();', 'Pilih Obyek ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="ddd_kode" id="ddd_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_obyek_by_rincian(){
		$obyek_kode = $this->uri->segment(4);
		if ($obyek_kode){
			$data_rincian = $this->Rincian_model->grid_all('ms_rek_5.kode, ms_rek_5.nm_rek_5', 'ms_rek_5.nm_rek_5', '', '', '', array('ms_rek_5.kd_rek_4'=>$obyek_kode));
			combobox('db', $data_rincian, 'eee_kode', 'kode', 'nm_rek_5', '', '', 'Pilih Rincian ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="eee_kode" id="eee_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_deskel_by_kecamatan(){
		$admin_log 	= $this->auth->is_login_admin();
		$kode		=  $this->uri->segment(4);
		if ($kode){
			echo '<label class="control-label col-md-4">Desa/Kelurahan</label>';
			echo '<div class="col-md-8">';
			$where											= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
			$like['skpd_kd']								= $kode;
			$data_skpd = $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
			combobox('db', $data_skpd, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Semua Desa/Kelurahan', 'class="select2_category form-control"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-4" for="deskel_kode">Desa/Kelurahan</label>
				<div class="col-md-8">
				<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
					<option value="">Semua Desa/Kelurahan</option>
				</select>
				</div>';
		}
	}	
	
	public function tampil_combobox_asal_by_sumber(){
		$sumber_kode	= $this->uri->segment(4);
		$query			= $this->db->query("SELECT kode, metode_nama FROM rup_metode WHERE tipe_sort='2'");
		$data_sumber	= $query->result();
		if ($sumber_kode == 15 || $sumber_kode == 21){
			echo '<div class="col-md-6">'; echo '<div class="form-line">';			
			echo '<label class="control-label" for="kode_dana">Asal Dana <span class="required">*</span> :</label>';
			combobox('db', $data_sumber, 'kode_dana', 'kode', 'metode_nama', '', '', 'Pilih ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
			echo '</div>'; echo '</div>';
				echo '<div class="col-md-5">'; echo '<div class="form-line">';
				echo '<label class="control-label" for="kode_dpa">Kode DIPA <span class="required">*</span> :</label>
					<input type="text" class="form-control" name="kode_dpa" id="kode_dpa" required="required">';
				echo '</div>'; echo '</div>';
		} else {
			echo '<div class="col-md-5">'; echo '<div class="form-line">';
			echo '<label class="control-label" for="kode_dpa">Kode DPA <span class="required">*</span> :</label>
				<input type="text" class="form-control" name="kode_dpa" id="kode_dpa" required="required">';
			echo '</div>'; echo '</div>';	
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