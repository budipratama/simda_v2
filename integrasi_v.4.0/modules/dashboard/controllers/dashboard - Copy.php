<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Anggaran_model');
	}
		
	public function index()
	{	
		$admin_log 	= $this->auth->is_login_admin();
		$tahun		= date("Y") + 1;
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 1;
		$container['content']['view']					= 'dashboard/dashboard';
		if ($admin_log['level_kode'] == 1){
			$queryM	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '4' AND anggaran.tahun='".$tahun."'");
			$queryP	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '5' AND anggaran.tahun='".$tahun."'");
			$queryR	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '6' AND anggaran.tahun='".$tahun."'");
			$queryB	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '8' AND anggaran.tahun='".$tahun."'");
			$queryD	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '9' AND anggaran.tahun='".$tahun."'");
			$queryK	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '11' AND anggaran.tahun='".$tahun."'");
			$musrenbangKecamatan 	= $queryM->row();
			$praRecanaKerja			= $queryP->row();
			$rencanaKerja 			= $queryR->row();
			$musrenbangKabupaten 	= $queryB->row();
			$rkpd 					= $queryD->row();
			$kuaPPAS 				= $queryK->row();
		} else if ($admin_log['level_kode'] == 4){
			$queryM	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '4' AND anggaran.tahun='".$tahun."' AND anggaran.skpd_kode='".$admin_log['skpd_kode']."'");
			$queryP	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '5' AND anggaran.tahun='".$tahun."' AND anggaran.skpd_kode='".$admin_log['skpd_kode']."'");
			$queryR	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '6' AND anggaran.tahun='".$tahun."' AND anggaran.skpd_kode='".$admin_log['skpd_kode']."'");
			$queryB	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '8' AND anggaran.tahun='".$tahun."' AND anggaran.skpd_kode='".$admin_log['skpd_kode']."'");
			$queryD	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '9' AND anggaran.tahun='".$tahun."' AND anggaran.skpd_kode='".$admin_log['skpd_kode']."'");
			$queryK	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '11' AND anggaran.tahun='".$tahun."' AND anggaran.skpd_kode='".$admin_log['skpd_kode']."'");
			$musrenbangKecamatan 	= $queryM->row();
			$praRecanaKerja			= $queryP->row();
			$rencanaKerja 			= $queryR->row();
			$musrenbangKabupaten 	= $queryB->row();
			$rkpd 					= $queryD->row();
			$kuaPPAS 				= $queryK->row();
		} else {
			$queryM	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '4' AND anggaran.tahun='".$tahun."' AND anggaran.pelaksana_kode='".$admin_log['skpd_kode']."'");
			$queryP	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '5' AND anggaran.tahun='".$tahun."' AND anggaran.pelaksana_kode='".$admin_log['skpd_kode']."'");
			$queryR	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '6' AND anggaran.tahun='".$tahun."' AND anggaran.pelaksana_kode='".$admin_log['skpd_kode']."'");
			$queryB	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '8' AND anggaran.tahun='".$tahun."' AND anggaran.pelaksana_kode='".$admin_log['skpd_kode']."'");
			$queryD	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '9' AND anggaran.tahun='".$tahun."' AND anggaran.pelaksana_kode='".$admin_log['skpd_kode']."'");
			$queryK	= $this->db->query("SELECT SUM( anggaran_bl.apbd_kab) as total_apbd FROM  anggaran_bl LEFT JOIN anggaran ON anggaran_bl.anggaran_kode=anggaran.kode WHERE anggaran.tahapan_kode = '11' AND anggaran.tahun='".$tahun."' AND anggaran.pelaksana_kode='".$admin_log['skpd_kode']."'");
			$musrenbangKecamatan 	= $queryM->row();
			$praRecanaKerja			= $queryP->row();
			$rencanaKerja 			= $queryR->row();
			$musrenbangKabupaten 	= $queryB->row();
			$rkpd 					= $queryD->row();
			$kuaPPAS 				= $queryK->row();
		}
		
		$container['content']['dataset']['musrenbang_kecamatan']= $musrenbangKecamatan->total_apbd;
			$container['content']['dataset']['pra_rencana_kerja'] 	= $praRecanaKerja->total_apbd;
			$container['content']['dataset']['rencana_kerja'] 		= $rencanaKerja->total_apbd;
			$container['content']['dataset']['musrenbang_kabupaten']= $musrenbangKabupaten->total_apbd;
			$container['content']['dataset']['rkpd'] 				= $rkpd->total_apbd;
			$container['content']['dataset']['kua_ppas'] 			= $kuaPPAS->total_apbd;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/home');
	}
	
}
