<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Murni extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Rup_model');		
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
		$this->load->model('Data_model');
		$this->load->library('Datatables');
		$this->load->library('mpdf/mpdf');
	}
	
	function datatable() {
        $tahapan 	= 22;
        $tahun 		= $this->uri->segment(4);
		$tipe 		= $this->uri->segment(5);
		$skpd 		= $this->uri->segment(6);
		$kecamatan 	= $this->uri->segment(7);
		$deskel 	= $this->uri->segment(8);
		$key 		= str_replace("%20", " ", $this->uri->segment(9));

		if ($skpd == 'skpd' && $kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND rup.tipe_kode = \''.$tipe.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($kecamatan == 'kecamatan' && $deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND rup.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($skpd == 'skpd' && $deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND rup.tipe_kode = \''.$tipe.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else if ($deskel == 'deskel'){
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND rup.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		} else {
			$where_datatable = 'anggaran.tahun = \''.$tahun.'\' AND anggaran.tahapan_kode = \''.$tahapan.'\' AND rup.tipe_kode = \''.$tipe.'\' AND anggaran.pelaksana_kode = \''.$skpd.'\' AND anggaran.kecamatan_kode = \''.$kecamatan.'\' AND anggaran.deskel_kode = \''.$deskel.'\' AND anggaran.kegiatan LIKE \'%'.$key.'%\'';
		}
		
		$this->datatables->select('nomor, id_rup, id_rincian, id_kegiatan, id_bl, id_sumber, id_metode')
		->add_column('Actions', $this->get_buttons($tipe, '$1'),'id_rup')
		->search_column('')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, rup.kode as id_rup, rincian.rincian_nama as id_rincian, anggaran.kegiatan as id_kegiatan, SUM(anggaran_bl.apbd_kab+anggaran_bl.apbd_prov+anggaran_bl.sumberlain+anggaran_bl.apbn) as id_bl, rup_jenis.jenis_nama as id_sumber,
		rup_metode.metode_nama as id_metode		
		FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, rup LEFT JOIN anggaran ON rup.anggaran_kode=anggaran.kode LEFT JOIN rincian ON rup.rincian=rincian.kode LEFT JOIN anggaran_bl ON rup.anggaran_kode=anggaran_bl.anggaran_kode LEFT JOIN rup_jenis ON rup.sumber_dana=rup_jenis.kode LEFT JOIN rup_metode ON rup.metode=rup_metode.kode WHERE ('.$where_datatable.') ORDER BY rup.kode DESC) rup');
        echo $this->datatables->generate();
    }
	
	function get_buttons($tipe, $id) {
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/murni/detail/'.$id) .'" class="btn btn-info waves-effect" title="Detail"><i class="material-icons">description</i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/murni/edit/'.$id) .'" class="btn btn-success waves-effect" title="Kaji Ulang"><i class="material-icons">border_color</i></a>';
		$html .= '</div>';
		return $html;
	}
	
	public function index() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 65;
		$container['content']['view']					= 'rup/murni/view';
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
	
	public function cari() {
		$admin_log 	= $this->auth->is_login_admin();
		$tahun		= $this->input->post('tahun');
		$tipe		= $this->input->post('tipe_kode');
		$skpd		= ($this->input->post('skpd_kode'))?$this->input->post('skpd_kode'):'skpd';
		$kecamatan	= ($this->input->post('kecamatan_kode'))?$this->input->post('kecamatan_kode'):'kecamatan';
		$deskel		= ($this->input->post('deskel_kode'))?$this->input->post('deskel_kode'):'deskel';
		$kegiatan	= $this->input->post('kegiatan');
		redirect('rup/murni/hasil-pencarian/'.$tahun.'/'.$tipe.'/'.$skpd.'/'.$kecamatan.'/'.$deskel.'/'.$kegiatan);
	}
		
	public function hasil_pencarian() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 65;
		$container['content']['view']					= 'rup/murni/view';
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
	
	public function detail($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$rup	 	= $this->Rup_model->getOnly('tipe_kode', array('kode'=>$kode));
		
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 65;
		if ($rup->tipe_kode == 1){
			$penyedia										= $this->Rup_model->get('1','rup.kode, rup.anggaran_kode, rup.volume, rup.kode_dpa, rup.pm_awal, rup.pm_akhir, rup.pk_awal, rup.pk_akhir, skpd.skpd_nama, anggaran.tahun, anggaran.kegiatan, anggaran.alamat, rup_jenis.jenis_nama as id_belanja, rup_metode.metode_nama as id_metode, rincian.rincian_nama, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran.catatan', array('rup.kode'=>$kode));
			$container['id_get1'] 							= $this->Rup_model->get_list1($id);
			$container['id_get2'] 							= $this->Rup_model->get_list2($id);
			$container['content']['view']					= 'rup/murni/belanja_langsung/penyedia';
			$container['content']['dataset']['kode'] 		= $penyedia->kode;			
			$container['content']['dataset']['kode_id']		= $penyedia->anggaran_kode;
			$container['content']['dataset']['tahun'] 		= $penyedia->tahun;			
			$container['content']['dataset']['skpd'] 		= $penyedia->skpd_nama;
			$container['content']['dataset']['paket'] 		= $penyedia->rincian_nama;
			$container['content']['dataset']['kegiatan'] 	= $penyedia->kegiatan;
			$container['content']['dataset']['alamat'] 		= $penyedia->alamat;
			$container['content']['dataset']['belanja']		= $penyedia->id_belanja;
			$container['content']['dataset']['volume']		= $penyedia->volume;
			$container['content']['dataset']['mak']			= $penyedia->kode_dpa;
			$container['content']['dataset']['id_kab'] 		= $penyedia->apbd_kab;
			$container['content']['dataset']['id_prov'] 	= $penyedia->apbd_prov;
			$container['content']['dataset']['id_apbn'] 	= $penyedia->apbn;
			$container['content']['dataset']['id_sumber'] 	= $penyedia->sumberlain;
			$container['content']['dataset']['metode'] 		= $penyedia->id_metode;
			$container['content']['dataset']['pm_awal'] 	= $penyedia->pm_awal;
			$container['content']['dataset']['pm_akhir'] 	= $penyedia->pm_akhir;
			$container['content']['dataset']['pk_awal'] 	= $penyedia->pk_awal;
			$container['content']['dataset']['pk_akhir'] 	= $penyedia->pk_akhir;			
			$container['content']['dataset']['catatan'] 	= $penyedia->catatan;
		} else {
			$penyedia										= $this->Rup_model->get('2','rup.kode, rup.anggaran_kode, rup.volume, rup.kode_dpa, rup.pm_awal, rup.pm_akhir, rup.pk_awal, rup.pk_akhir, skpd.skpd_nama, anggaran.tahun, anggaran.kegiatan, anggaran.alamat, rup_jenis.jenis_nama as id_belanja, rup_metode.metode_nama as id_metode, rincian.rincian_nama, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran.catatan', array('rup.kode'=>$kode));
			$container['id_get1'] 							= $this->Rup_model->get_list1($id);
			$container['id_get2'] 							= $this->Rup_model->get_list2($id);
			$container['content']['view']					= 'rup/murni/belanja_langsung/swakelola';
			$container['content']['dataset']['kode'] 		= $penyedia->kode;			
			$container['content']['dataset']['kode_id']		= $penyedia->anggaran_kode;
			$container['content']['dataset']['tahun'] 		= $penyedia->tahun;			
			$container['content']['dataset']['skpd'] 		= $penyedia->skpd_nama;
			$container['content']['dataset']['paket'] 		= $penyedia->rincian_nama;
			$container['content']['dataset']['kegiatan'] 	= $penyedia->kegiatan;
			$container['content']['dataset']['alamat'] 		= $penyedia->alamat;
			$container['content']['dataset']['belanja']		= $penyedia->id_belanja;
			$container['content']['dataset']['volume']		= $penyedia->volume;
			$container['content']['dataset']['mak']			= $penyedia->kode_dpa;
			$container['content']['dataset']['id_kab'] 		= $penyedia->apbd_kab;
			$container['content']['dataset']['id_prov'] 	= $penyedia->apbd_prov;
			$container['content']['dataset']['id_apbn'] 	= $penyedia->apbn;
			$container['content']['dataset']['id_sumber'] 	= $penyedia->sumberlain;
			$container['content']['dataset']['metode'] 		= $penyedia->id_metode;
			$container['content']['dataset']['pm_awal'] 	= $penyedia->pm_awal;
			$container['content']['dataset']['pm_akhir'] 	= $penyedia->pm_akhir;
			$container['content']['dataset']['pk_awal'] 	= $penyedia->pk_awal;
			$container['content']['dataset']['pk_akhir'] 	= $penyedia->pk_akhir;			
			$container['content']['dataset']['catatan'] 	= $penyedia->catatan;
		}
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function delete() {
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '11'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '11'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('rup/murni/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('status, sumber_id', array('kode'=>$kode));
			if ($anggaran->status == 1){
				//Update Sumber Anggaran
				$this->Anggaran_model->update('anggaran', array('status'=>'1'), array('kode' => $anggaran->sumber_id)); 

				$this->Anggaran_model->delete('anggaran', array('kode' => $kode));
				$this->Anggaran_model->delete('anggaran_bl', array('anggaran_kode' => $kode));
				$this->Anggaran_model->delete('anggaran_btl', array('anggaran_kode' => $kode));
				
				redirect('rup/murni/#successDelete', 'refresh');
			} else {
				redirect('rup/murni/#warningTransfer', 'refresh');
			}
			redirect('rup/murni', 'refresh');
		}
	}
	
	public function belanja_langsung() {
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
			$container['sidebar']['dataset']['aktive_menu'] 	= 65;	
			$container['content']['view']						= 'rka/murni/belanja_langsung/add';		

			$where_akun										= 'kode IN (\'5\')';
			$where_sumber									= 'tipe_sort IN (\'5\')';
			$container['content']['dataset']['akun']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			$container['content']['dataset']['sumber']		= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_sumber);
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
				   redirect('rup/murni/belanja/'.$id_kode);
				}
			}
		}
    }
	
	public function edit($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$rup	 	= $this->Rup_model->getOnly('tipe_kode', array('kode'=>$kode)); {
		$this->form_validation->set_rules('ccc_kode','Jenis','trim|xss_clean');
		$this->form_validation->set_rules('ddd_kode','Obyek','trim|xss_clean');
		$this->form_validation->set_rules('eee_kode','Rincian','trim|xss_clean');
		$this->form_validation->set_rules('sss_kode','Sumber','trim|xss_clean');
		
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 65;
		
		if ($rup->tipe_kode == 1){
			$penyedia										= $this->Rup_model->get('1','rup.kode, rup.anggaran_kode, rup.volume, rup.kode_dpa, rup.pm_awal, rup.pm_akhir, rup.pk_awal, rup.pk_akhir, skpd.skpd_nama, anggaran.tahun, anggaran.kegiatan, anggaran.alamat, rup_jenis.jenis_nama as id_belanja, rup_metode.metode_nama as id_metode, rincian.rincian_nama, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran.catatan', array('rup.kode'=>$kode));
			$container['id_get1'] 							= $this->Rup_model->get_list1($id);
			$container['id_get2'] 							= $this->Rup_model->get_list2($id);
			$container['content']['view']					= 'rup/murni/belanja_langsung/editp';
			$container['content']['dataset']['kode'] 		= $penyedia->kode;			
			$container['content']['dataset']['kode_id']		= $penyedia->anggaran_kode;
			$container['content']['dataset']['tahun'] 		= $penyedia->tahun;			
			$container['content']['dataset']['skpd'] 		= $penyedia->skpd_nama;
			$container['content']['dataset']['paket'] 		= $penyedia->rincian_nama;
			$container['content']['dataset']['kegiatan'] 	= $penyedia->kegiatan;
			$container['content']['dataset']['alamat'] 		= $penyedia->alamat;
			$container['content']['dataset']['belanja']		= $penyedia->id_belanja;
			$container['content']['dataset']['volume']		= $penyedia->volume;
			$container['content']['dataset']['mak']			= $penyedia->kode_dpa;
			$container['content']['dataset']['id_kab'] 		= $penyedia->apbd_kab;
			$container['content']['dataset']['id_prov'] 	= $penyedia->apbd_prov;
			$container['content']['dataset']['id_apbn'] 	= $penyedia->apbn;
			$container['content']['dataset']['id_sumber'] 	= $penyedia->sumberlain;
			$container['content']['dataset']['metode'] 		= $penyedia->id_metode;
			$container['content']['dataset']['pm_awal'] 	= $penyedia->pm_awal;
			$container['content']['dataset']['pm_akhir'] 	= $penyedia->pm_akhir;
			$container['content']['dataset']['pk_awal'] 	= $penyedia->pk_awal;
			$container['content']['dataset']['pk_akhir'] 	= $penyedia->pk_akhir;			
			$container['content']['dataset']['catatan'] 	= $penyedia->catatan;
		} else {
			$penyedia										= $this->Rup_model->get('2','rup.kode, rup.anggaran_kode, rup.volume, rup.kode_dpa, rup.pm_awal, rup.pm_akhir, rup.pk_awal, rup.pk_akhir, skpd.skpd_nama, anggaran.tahun, anggaran.kegiatan, anggaran.alamat, rup_jenis.jenis_nama as id_belanja, rup_metode.metode_nama as id_metode, rincian.rincian_nama, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran.catatan', array('rup.kode'=>$kode));
			$container['id_get1'] 							= $this->Rup_model->get_list1($id);
			$container['id_get2'] 							= $this->Rup_model->get_list2($id);
			$container['content']['view']					= 'rup/murni/belanja_langsung/edits';
			$container['content']['dataset']['kode'] 		= $penyedia->kode;			
			$container['content']['dataset']['kode_id']		= $penyedia->anggaran_kode;
			$container['content']['dataset']['tahun'] 		= $penyedia->tahun;			
			$container['content']['dataset']['skpd'] 		= $penyedia->skpd_nama;
			$container['content']['dataset']['paket'] 		= $penyedia->rincian_nama;
			$container['content']['dataset']['kegiatan'] 	= $penyedia->kegiatan;
			$container['content']['dataset']['alamat'] 		= $penyedia->alamat;
			$container['content']['dataset']['belanja']		= $penyedia->id_belanja;
			$container['content']['dataset']['volume']		= $penyedia->volume;
			$container['content']['dataset']['mak']			= $penyedia->kode_dpa;
			$container['content']['dataset']['id_kab'] 		= $penyedia->apbd_kab;
			$container['content']['dataset']['id_prov'] 	= $penyedia->apbd_prov;
			$container['content']['dataset']['id_apbn'] 	= $penyedia->apbn;
			$container['content']['dataset']['id_sumber'] 	= $penyedia->sumberlain;
			$container['content']['dataset']['metode'] 		= $penyedia->id_metode;
			$container['content']['dataset']['pm_awal'] 	= $penyedia->pm_awal;
			$container['content']['dataset']['pm_akhir'] 	= $penyedia->pm_akhir;
			$container['content']['dataset']['pk_awal'] 	= $penyedia->pk_awal;
			$container['content']['dataset']['pk_akhir'] 	= $penyedia->pk_akhir;			
			$container['content']['dataset']['catatan'] 	= $penyedia->catatan;
		} if($this->form_validation->run() == FALSE){
				$rka = $this->Rka_model->get('rka.*', array('rka.kode'=>$this->uri->segment(4)));
				$container['content']['dataset']['kode']		= $rka->kode;
				$container['content']['dataset']['id_anggaran']	= $rka->anggaran_kode;
				$container['content']['dataset']['akun_']		= $rka->akun;
				$container['content']['dataset']['kelompok_']	= $rka->kelompok;
				$container['content']['dataset']['jenis_']		= $rka->jenis;
				$container['content']['dataset']['obyek_']		= $rka->obyek;
				$container['content']['dataset']['rincian_']	= $rka->rincian;
				$container['content']['dataset']['sumber_']		= $rka->sumber;
			
			$header['admin_log']								= $admin_log;
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
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "BELANJA" telah berhasil diubah</div>');
			redirect('rka/murni/belanja/'.$id_kode, 'refresh');
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
	
	public function tampil_combobox_akun_by_kelompok(){
		$where_kelompok = 'kode IN (\'16\')';
		$akun_kode	= $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('kelompok.kode, kelompok.kelompok_nama', 'kelompok.kelompok_nama', '', '', '', $where_kelompok, array('kelompok.akun'=>$akun_kode));			
			combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'kelompok_nama', '', 'show_form_kelompok_by_jenis();', 'Pilih Kelompok ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="bbb_kode" id="bbb_kode" class="form-control show-tick" data-live-search="true" tabindex="1" required="required"></select>';
		}
	}	
	
	public function tampil_combobox_kelompok_by_jenis(){
		$kelompok_kode 	= $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('jenis.kode, jenis.jenis_nama', 'jenis.jenis_nama', '', '', '', array('jenis.kelompok'=>$kelompok_kode));
			combobox('db', $data_jenis, 'ccc_kode', 'kode', 'jenis_nama', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="ccc_kode" id="ccc_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_jenis_by_obyek(){
		$jenis_kode = $this->uri->segment(4);
		if ($jenis_kode){
			$data_obyek = $this->Obyek_model->grid_all('obyek.kode, obyek.obyek_nama', 'obyek.obyek_nama', '', '', '', array('obyek.jenis'=>$jenis_kode));
			combobox('db', $data_obyek, 'ddd_kode', 'kode', 'obyek_nama', '', 'show_form_obyek_by_rincian();', 'Pilih Obyek ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="ddd_kode" id="ddd_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_obyek_by_rincian(){
		$obyek_kode = $this->uri->segment(4);
		if ($obyek_kode){
			$data_rincian = $this->Rincian_model->grid_all('rincian.kode, rincian.rincian_nama', 'rincian.rincian_nama', '', '', '', array('rincian.obyek'=>$obyek_kode));
			combobox('db', $data_rincian, 'eee_kode', 'kode', 'rincian_nama', '', '', 'Pilih Rincian ...', 'class="form-control show-tick" data-live-search="true" tabindex="1" required="required"');
		} else {
			echo '<select name="eee_kode" id="eee_kode" class="form-control show-tick" data-live-search="true" tabindex="1"></select>';
		}
	}
	
	public function tampil_combobox_deskel_by_kecamatan(){
		$admin_log 	= $this->auth->is_login_admin();
		$kode		=  $this->uri->segment(4);
		if ($kode){
			$where											= 'skpd_status IN (\'Desa\', \'Kelurahan\')';
			$like['skpd_kd']								= $kode;
			$data_skpd = $this->Skpd_model->grid_all('skpd_kd, skpd_nama', 'skpd_nama', 'ASC', '', '', $where, $like);
			combobox('db', $data_skpd, 'deskel_kode', 'skpd_kd', 'skpd_nama', '', '', 'Semua Desa/Kelurahan', 'class="select2_category form-control"');
		} else {
			echo '<select class="form-control select2_category" name="deskel_kode" id="deskel_kode">
					<option value="">Semua Desa/Kelurahan</option></select>';
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