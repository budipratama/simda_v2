<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 19;
		$container['content']['view']					= 'laporan/list';
		$container['content']['dataset']['admin_log']	= $admin_log;
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function cetakLaporan(){
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Pra Rencana Kerja');
		$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR RENCANA PROGRAM DAN KEGIATAN PRIORITAS TAHUN 2016');
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->mergeCells('A1:X1');
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$filename='laporan_pra_rencana_kerja_'.date("Y_m_d_H_i_s").'.pdf';
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'PDF');
		$objWriter->save('php://output');
	}
}
