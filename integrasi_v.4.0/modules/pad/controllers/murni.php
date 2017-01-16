<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Murni extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Rup_model');
		$this->load->model('Rka_pad_model');
		
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
        $tahun 		= $this->uri->segment(4);
		$tipe 		= $this->uri->segment(5);
		$skpd 		= $this->uri->segment(6);
		$key 		= str_replace("%20", " ", $this->uri->segment(7));
	
		if ($skpd == 'skpd'){
			$where_datatable = 'rka_pad.tahun = \''.$tahun.'\' AND rka_pad.tipe_kode = \''.$tipe.'\' AND rka_pad.rincian LIKE \'%'.$key.'%\'';
		} else {
			$where_datatable = 'rka_pad.tahun = \''.$tahun.'\' AND rka_pad.tipe_kode = \''.$tipe.'\' AND rka_pad.skpd = \''.$skpd.'\' AND rka_pad.rincian LIKE \'%'.$key.'%\'';
		}

		$this->datatables->select('nomor, rka_pad.kode, id_akun, id_kelompok, id_jenis, id_obyek, id_rincian, nama_rincian')
		->add_column('Actions', $this->get_buttons($tipe, '$1'),'kode')
		->search_column('nama_rincian')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, rka_pad.kode, akun.no as id_akun, kelompok.no as id_kelompok, jenis.no as id_jenis, obyek.no as id_obyek, rincian.no as id_rincian, rincian.rincian_nama as nama_rincian FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, rka_pad LEFT JOIN akun ON rka_pad.akun=akun.kode LEFT JOIN kelompok ON rka_pad.kelompok=kelompok.kode LEFT JOIN jenis ON rka_pad.jenis=jenis.kode	LEFT JOIN obyek ON rka_pad.obyek=obyek.kode	LEFT JOIN rincian ON rka_pad.rincian=rincian.kode WHERE ('.$where_datatable.') ORDER BY rka_pad.kode DESC) rka_pad');		
        echo $this->datatables->generate();
    }
	
	function get_buttons($tipe, $id) {
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';
	//	$html .= '<a href="'. site_url($ci->uri->segment(1) . '/murni/detail/'.$id) .'" class="btn btn-sm btn-info" title="Detail"><i class="fa fa-file-text"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/murni/rincian/'.$id) .'" class="btn btn-sm btn-success" title="Tambah"><i class="fa fa-pencil"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/murni/delete/'.$id) .'" class="btn btn-sm btn-danger" title="Delete" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data rencana kerja ini.\');"><i class="fa fa-trash-o"></i></a>';
		$html .= '</div>';
		return $html;
	}
	
	public function index() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 66;
		$container['content']['view']					= 'pad/murni/view';
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
		redirect('pad/murni/hasil-pencarian/'.$tahun.'/'.$tipe.'/'.$skpd.'/'.$kegiatan);
	}
	
	public function pad() {
		$admin_log 	= $this->auth->is_login_admin();
		$tahun		= $this->input->post('tahun');		
		$tipe		= $this->input->post('tipe_kode');
		$skpd		= $this->input->post('skpd_kode');
		redirect('pad/murni/add/add/'.$tahun.'/'.$tipe.'/'.$skpd);
	}
	
	public function hasil_pencarian() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 66;
		$container['content']['view']					= 'pad/murni/view';
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
	
	public function detail() {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));
		
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 49;
		if ($anggaran->tipe_kode == 1){
			$anggaran_bl									= $this->Anggaran_model->get('1','anggaran.kode, anggaran.deskel_kode, anggaran.kecamatan_kode, anggaran.tahun, anggaran.kegiatan, anggaran.catatan, anggaran.proposal, anggaran.verifikasi, anggaran.foto, anggaran.koordinat, kecamatan.skpd_nama as kecamatan_nama, deskel.skpd_nama as deskel_nama, anggaran.alamat, anggaran.rt, , anggaran.rw, anggaran_bl.urutan, anggaran_bl.apbd_kab, anggaran_bl.apbd_prov, anggaran_bl.apbn, anggaran_bl.sumberlain, anggaran_bl.perkiraan_maju, anggaran_bl.hp_ukur, anggaran_bl.hp_target, anggaran_bl.hp_satuan, sifat.sifat_nama, kesepakatan.nama as kesepakatan_nama, pelaksana.skpd_nama, visi.visi as visi_nama, misi.misi as misi_nama, prioritas.prioritas as prioritas_nama, tujuan.tujuan as tujuan_nama, sasaran.sasaran as sasaran_nama, indikator.indikator as indikator_nama, urusan.urusan as urusan_nama, program.program as program_nama, anggaran_bl.kh_ukur, anggaran_bl.kh_target, anggaran_bl.kh_satuan, anggaran_bl.hk_ukur, anggaran_bl.hk_target, anggaran_bl.hk_satuan', array('anggaran.kode'=>$kode));
			$container['content']['view']					= 'pad/murni/belanja_langsung/detail';
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
			$container['content']['view']					= 'pad/murni/belanja_tidak_langsung/detail';
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
	
	public function delete() {
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '11'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '11'));
		$waktuSekarang = date("Y-m-d H:i:s");
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('pad/murni/#warningEntri', 'refresh');
		} else {
			$kode 		= $this->uri->segment(4);
			$anggaran 	= $this->Anggaran_model->getOnly('status, sumber_id', array('kode'=>$kode));
			if ($anggaran->status == 1){
				//Update Sumber Anggaran
				$this->Anggaran_model->update('anggaran', array('status'=>'1'), array('kode' => $anggaran->sumber_id)); 

				$this->Anggaran_model->delete('anggaran', array('kode' => $kode));
				$this->Anggaran_model->delete('anggaran_bl', array('anggaran_kode' => $kode));
				$this->Anggaran_model->delete('anggaran_btl', array('anggaran_kode' => $kode));
				
				redirect('pad/murni/#successDelete', 'refresh');
			} else {
				redirect('pad/murni/#warningTransfer', 'refresh');
			}
			redirect('pad/murni', 'refresh');
		}
	}
	
	public function add() {
		$admin_log 	= $this->auth->is_login_admin();
		$tahun 		= $this->uri->segment(5);
		$tipe 		= $this->uri->segment(6);
		$skpd 		= $this->uri->segment(7);		
		
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 66;
		
		if ($tipe == 1){
			$container['content']['view']					= 'pad/murni/belanja_langsung/add';
			$where_akun										= 'kode IN (\'4\')';
			$container['content']['dataset']['akun']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_akun);
			if ($skpd == $skpd ){
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_nama', array('skpd_kode' => $skpd));
				$container['content']['dataset']['skpd_kode']	= $skpd->skpd_kode;
				$container['content']['dataset']['skpd_nama']	= $skpd->skpd_nama;
				$container['content']['dataset']['skpd_aktive']	= 'no';
			} else {
				$container['content']['dataset']['skpd_aktive']	= 'yes';
			}
			$container['content']['dataset']['tahun_']		= $this->uri->segment(5);
			$container['content']['dataset']['tipe_']		= $this->uri->segment(6);
			$container['content']['dataset']['skpd_']		= $this->uri->segment(7);
		} else {
			$container['content']['view']					= 'pad/murni/belanja_tidak_langsung/add';
		}

		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert() {
		$admin_log 	= $this->auth->is_login_admin();
		$id_kode 	= $this->input->post('tipe_kode');		
		if ($id_kode == '1'){
			$this->form_validation->set_rules('eee_kode','Rincian','trim|xss_clean');
			
			if($this->form_validation->run() == FALSE) {
			$container['sidebar']['view']						= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] 	= 66;		
			
			} else {	
				$insert['no'] 			= $this->input->post('no_kode');
				$insert['akun']			= $this->input->post('aaa_kode');
				$insert['kelompok']		= $this->input->post('bbb_kode');
				$insert['jenis']		= $this->input->post('ccc_kode');
				$insert['obyek']		= $this->input->post('ddd_kode');
				$insert['rincian']		= $this->input->post('eee_kode');
				$insert['tipe_kode']	= $this->input->post('tipe_kode');
				$insert['tahun']		= $this->input->post('tahun_kode');
				$insert['skpd']			= $this->input->post('skpd_kode');
				$query = $this->Rka_pad_model->insert($insert);			
				$this->session->set_flashdata('success','<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "PENDAPATAN ASLI DAERAH" baru telah berhasil ditambahkan.</div>');
				redirect('pad/murni');
			}
		} else {
			redirect('pad/murni');
		}	

		$header['admin_log']			= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
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
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "BELANJA" telah berhasil diubah</div>');
			redirect('rka/murni/belanja/'.$id_kode, 'refresh');
			}
		}
    }
	
	public function deleteb() {
		$admin_log 	= $this->auth->is_login_admin(); {
		$kode 		= $this->uri->segment(4);
		$rka 		= $this->Rka_model->getOnly('anggaran_kode', array('kode'=>$kode));
			$this->Rka_model->delete0($this->uri->segment(4));
			$this->Rka_model->delete1($this->uri->segment(4));
			$this->Rka_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "BELANJA" telah berhasil dihapus</div>');
			redirect('rka/murni/belanja/'.$rka->anggaran_kode, 'refresh');
		}
	}
	
	public function rincian() {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));		
		
		{
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] 	= 49;	
		$container['content']['view']						= 'pad/murni/belanja_langsung/rincian';		

			$container['pad']								= $this->Rka_pad_model->bl($kode);
			$container['rincian']							= $this->Rka_pad_model->rincian($kode,true);
			
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
	
	public function addr($list_id) {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$anggaran 	= $this->Anggaran_model->getOnly('tipe_kode', array('kode'=>$kode));		
		$this->form_validation->set_rules('aaa_kode', 'Uraian', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_kode', 'No', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_kode', 'Rka', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Harga', 'trim|required|xss_clean');
		$this->form_validation->set_rules('userMsg', 'Satuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('thirdBox', 'Volume', 'trim|required|xss_clean');
		$this->form_validation->set_rules('total_sum', 'Total', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE) {
		$container['sidebar']['view']						= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu']		= 49;	
		$container['content']['view']						= 'pad/murni/belanja_langsung/addr';

			$container['pad']								= $this->Rka_pad_model->bl($kode);
			$container['blr']								= $this->Rka_pad_model->blr($kode);
			$container['rincian']							= $this->Rka_pad_model->get_rincian($kode);

		} else {			
			$insert['uraian']		= $this->input->post('aaa_kode');
			$insert['no']			= $this->input->post('no_kode');
			$insert['rka_pad']		= $this->input->post('id_kode');
			$insert['harga']		= $this->input->post('bbb_kode');
			$insert['satuan'] 		= $this->input->post('userMsg');
			$insert['volume']		= $this->input->post('thirdBox');
			$insert['total']		= $this->input->post('total_sum');
			$id_kode				= $this->input->post('id_kode');
			$insert['tipe_kode']	= 1;
			
			$query = $this->Rka_pad_model->insertr($insert);			
			$this->session->set_flashdata('success','<div class="alert alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN PAD" baru telah berhasil ditambahkan.</div>');
			redirect('pad/murni/rincian/'.$id_kode);
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
		$where_kelompok = 'kode IN (\'12\')';
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
	
}