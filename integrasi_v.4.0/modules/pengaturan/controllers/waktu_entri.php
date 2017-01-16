<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Waktu_entri extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Skpd_model');
		$this->load->model('Tahapan_model');
		$this->load->model('Tahapan_skpd_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, kode, nama, mulai, selesai')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('nama, mulai, selesai')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, kode, nama, mulai, selesai FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, tahapan ORDER BY kode ASC) tahapan');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/waktu_entri/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function add()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/waktu_entri/add';
		$container['content']['dataset']				= '';
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('nama', 'Nama Tahapan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mulai', 'Tanggal Mulai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('selesai', 'Tanggal Selesai', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/waktu_entri/add';
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$insert['nama']			= $this->input->post('nama');
			$insert['mulai']		= $this->input->post('mulai');
			$insert['selesai']		= $this->input->post('selesai');
						
			$query = $this->Tahapan_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data waktu entri baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/waktu_entri', 'refresh');
		}

	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/waktu_entri/edit';
		$container['content']['dataset']				= '';
		
		$waktu_entri = $this->Tahapan_model->get('tahapan.*', array('tahapan.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']		= $waktu_entri->kode;
		$container['content']['dataset']['nama']		= $waktu_entri->nama;
		$container['content']['dataset']['mulai']		= $waktu_entri->mulai;
		$container['content']['dataset']['selesai']		= $waktu_entri->selesai;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('nama', 'Nama Tahapan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mulai', 'Tanggal Mulai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('selesai', 'Tanggal Selesai', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/waktu_entri/edit';
			$container['content']['dataset']				= '';
			
			$waktu_entri = $this->Tahapan_model->get('tahapan.*', array('tahapan.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['kode']		= $waktu_entri->kode;
			$container['content']['dataset']['nama']		= $waktu_entri->nama;
			$container['content']['dataset']['mulai']		= $waktu_entri->mulai;
			$container['content']['dataset']['selesai']		= $waktu_entri->selesai;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['nama']			= $this->input->post('nama');
			$update['mulai']		= $this->input->post('mulai');
			$update['selesai']		= $this->input->post('selesai');	
						
			$query = $this->Tahapan_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data waktu entri telah berhasil diubah.</div>');
			
			redirect('pengaturan/waktu_entri', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/waktu_entri/detail';
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC');
		$waktu_entri = $this->Tahapan_model->get('tahapan.*', array('tahapan.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['tahapan_skpd']= $this->Tahapan_skpd_model->grid_all('tahapan_skpd.kode as kode, tahapan_skpd.tahapan_kode as tahapan_kode, skpd.skpd_nama', 'tahapan_skpd.kode', 'ASC', '', '', array('tahapan_kode'=>$waktu_entri->kode));	
		$container['content']['dataset']['kode']		= $waktu_entri->kode;
		$container['content']['dataset']['nama']		= $waktu_entri->nama;
		$container['content']['dataset']['mulai']		= $waktu_entri->mulai;
		$container['content']['dataset']['selesai']		= $waktu_entri->selesai;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Tahapan_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data waktu entri telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/waktu_entri', 'refresh');
	}
}
