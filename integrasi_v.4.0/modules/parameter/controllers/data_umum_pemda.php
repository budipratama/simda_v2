<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_umum_pemda extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Data_umum_pemda_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, kode, pemda, ibukota, alamat')
		->add_column('alamat', $this->get_alamat('$1'),'alamat')
		->add_column('Actions', $this->get_buttons($tipe, '$1'),'kode')
		->search_column('pemda, ibukota, alamat')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, parameter_dup.kode, parameter_dup.pemda, parameter_dup.ibukota, parameter_dup.alamat FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, parameter_dup ORDER BY parameter_dup.pemda ASC) parameter_dup');
        
        echo $this->datatables->generate();
    }
		
	function get_buttons($tipe, $id)
	{
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';		
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/data-umum-pemda/detail/'.$id) .'" class="btn btn-sm btn-info" title="Detail"><i class="material-icons">content_paste</i></a>';
		$html .= '</div>';
		return $html;
	}
	
	private function get_alamat($alamat){
		return ucwords($alamat);
	}

	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/data_umum_pemda/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
				
		$container['content']['dataset']['grid']		= $this->Data_umum_pemda_model->grid_all('*', 'pemda', 'ASC');
		
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/data_umum_pemda/detail';
		$container['content']['dataset']				= '';
		
		$parameter_dup = $this->Data_umum_pemda_model->get('parameter_dup.*', array('parameter_dup.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']					= $parameter_dup->kode;
		$container['content']['dataset']['pemda']					= $parameter_dup->pemda;
		$container['content']['dataset']['ibukota']					= $parameter_dup->ibukota;
		$container['content']['dataset']['alamat']					= $parameter_dup->alamat;
		$container['content']['dataset']['kepala_daerah']			= $parameter_dup->kepala_daerah;
		$container['content']['dataset']['jabatan_daerah']			= $parameter_dup->jabatan_daerah;
		$container['content']['dataset']['sekretaris_daerah']		= $parameter_dup->sekretaris_daerah;
		$container['content']['dataset']['sekretaris_nip']			= $parameter_dup->sekretaris_nip;
		$container['content']['dataset']['sekretaris_jabatan']		= $parameter_dup->sekretaris_jabatan;
		$container['content']['dataset']['kepala_keuangan']			= $parameter_dup->kepala_keuangan;
		$container['content']['dataset']['keuangan_nip']			= $parameter_dup->keuangan_nip;
		$container['content']['dataset']['keuangan_jabatan']		= $parameter_dup->keuangan_jabatan;
		$container['content']['dataset']['kepala_anggaran']			= $parameter_dup->kepala_anggaran;
		$container['content']['dataset']['anggaran_nip']			= $parameter_dup->anggaran_nip;
		$container['content']['dataset']['anggaran_jabatan']		= $parameter_dup->anggaran_jabatan;
		$container['content']['dataset']['kepala_verifikasi']		= $parameter_dup->kepala_verifikasi;
		$container['content']['dataset']['verifikasi_nip']			= $parameter_dup->verifikasi_nip;
		$container['content']['dataset']['verifikasi_jabatan']		= $parameter_dup->verifikasi_jabatan;
		$container['content']['dataset']['kepala_perbendaharaan']	= $parameter_dup->kepala_perbendaharaan;
		$container['content']['dataset']['perbendaharaan_nip']		= $parameter_dup->perbendaharaan_nip;
		$container['content']['dataset']['perbendaharaan_jabatan']	= $parameter_dup->perbendaharaan_jabatan;
		$container['content']['dataset']['kepala_pembukuan']		= $parameter_dup->kepala_pembukuan;
		$container['content']['dataset']['pembukuan_nip']			= $parameter_dup->pembukuan_nip;
		$container['content']['dataset']['pembukuan_jabatan']		= $parameter_dup->pembukuan_jabatan;
		$container['content']['dataset']['kuasa_bud']				= $parameter_dup->kuasa_bud;
		$container['content']['dataset']['bud_nip']					= $parameter_dup->bud_nip;
		$container['content']['dataset']['bud_jabatan']				= $parameter_dup->bud_jabatan;
		$container['content']['dataset']['atasan_bud']				= $parameter_dup->atasan_bud;
		$container['content']['dataset']['atasan_budnip']			= $parameter_dup->atasan_budnip;
		$container['content']['dataset']['atasan_budjabatan']		= $parameter_dup->atasan_budjabatan;
		$container['content']['dataset']['foto'] 					= explode(", ", $parameter_dup->foto);
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
		
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/data_umum_pemda/edit';
		$container['content']['dataset']				= '';
		
		$parameter_dup = $this->Data_umum_pemda_model->get('parameter_dup.*', array('parameter_dup.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['kode']					= $parameter_dup->kode;
		$container['content']['dataset']['pemda']					= $parameter_dup->pemda;
		$container['content']['dataset']['ibukota']					= $parameter_dup->ibukota;
		$container['content']['dataset']['alamat']					= $parameter_dup->alamat;
		$container['content']['dataset']['kepala_daerah']			= $parameter_dup->kepala_daerah;
		$container['content']['dataset']['jabatan_daerah']			= $parameter_dup->jabatan_daerah;
		$container['content']['dataset']['sekretaris_daerah']		= $parameter_dup->sekretaris_daerah;
		$container['content']['dataset']['sekretaris_nip']			= $parameter_dup->sekretaris_nip;
		$container['content']['dataset']['sekretaris_jabatan']		= $parameter_dup->sekretaris_jabatan;
		$container['content']['dataset']['kepala_keuangan']			= $parameter_dup->kepala_keuangan;
		$container['content']['dataset']['keuangan_nip']			= $parameter_dup->keuangan_nip;
		$container['content']['dataset']['keuangan_jabatan']		= $parameter_dup->keuangan_jabatan;
		$container['content']['dataset']['kepala_anggaran']			= $parameter_dup->kepala_anggaran;
		$container['content']['dataset']['anggaran_nip']			= $parameter_dup->anggaran_nip;
		$container['content']['dataset']['anggaran_jabatan']		= $parameter_dup->anggaran_jabatan;
		$container['content']['dataset']['kepala_verifikasi']		= $parameter_dup->kepala_verifikasi;
		$container['content']['dataset']['verifikasi_nip']			= $parameter_dup->verifikasi_nip;
		$container['content']['dataset']['verifikasi_jabatan']		= $parameter_dup->verifikasi_jabatan;
		$container['content']['dataset']['kepala_perbendaharaan']	= $parameter_dup->kepala_perbendaharaan;
		$container['content']['dataset']['perbendaharaan_nip']		= $parameter_dup->perbendaharaan_nip;
		$container['content']['dataset']['perbendaharaan_jabatan']	= $parameter_dup->perbendaharaan_jabatan;
		$container['content']['dataset']['kepala_pembukuan']		= $parameter_dup->kepala_pembukuan;
		$container['content']['dataset']['pembukuan_nip']			= $parameter_dup->pembukuan_nip;
		$container['content']['dataset']['pembukuan_jabatan']		= $parameter_dup->pembukuan_jabatan;
		$container['content']['dataset']['kuasa_bud']				= $parameter_dup->kuasa_bud;
		$container['content']['dataset']['bud_nip']					= $parameter_dup->bud_nip;
		$container['content']['dataset']['bud_jabatan']				= $parameter_dup->bud_jabatan;
		$container['content']['dataset']['atasan_bud']				= $parameter_dup->atasan_bud;
		$container['content']['dataset']['atasan_budnip']			= $parameter_dup->atasan_budnip;
		$container['content']['dataset']['atasan_budjabatan']		= $parameter_dup->atasan_budjabatan;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('pemda', 'Pemda', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ibukota', 'Ibukota', 'trim|required|xss_clean');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kepala_daerah', 'Kepala_daerah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jabatan_daerah', 'Jabatan_daerah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sekretaris_daerah', 'Sekretaris_daerah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sekretaris_nip', 'Sekretaris_nip', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sekretaris_jabatan', 'Sekretaris_jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kepala_keuangan', 'Kepala_keuangan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('keuangan_nip', 'Keuangan_nip', 'trim|required|xss_clean');
		$this->form_validation->set_rules('keuangan_jabatan', 'Keuangan_jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kepala_anggaran', 'Kepala_anggaran', 'trim|required|xss_clean');
		$this->form_validation->set_rules('anggaran_nip', 'Anggaran_nip', 'trim|required|xss_clean');
		$this->form_validation->set_rules('anggaran_jabatan', 'Anggaran_jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kepala_verifikasi', 'Kepala_verifikasi', 'trim|required|xss_clean');
		$this->form_validation->set_rules('verifikasi_nip', 'Verifikasi_nip', 'trim|required|xss_clean');
		$this->form_validation->set_rules('verifikasi_jabatan', 'Verifikasi_jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kepala_perbendaharaan', 'Kepala_perbendaharaan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('perbendaharaan_nip', 'Perbendaharaan_nip', 'trim|required|xss_clean');
		$this->form_validation->set_rules('perbendaharaan_jabatan', 'Perbendaharaan_jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kepala_pembukuan', 'Kepala_pembukuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pembukuan_nip', 'Pembukuan_nip', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pembukuan_jabatan', 'Pembukuan_jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kuasa_bud', 'Kuasa_bud', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bud_nip', 'Bud_nip', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bud_jabatan', 'Bud_jabatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('atasan_bud', 'Atasan_bud', 'trim|required|xss_clean');
		$this->form_validation->set_rules('atasan_budnip', 'Atasan_budnip', 'trim|required|xss_clean');
		$this->form_validation->set_rules('atasan_budjabatan', 'Atasan_budjabatan', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/data_umum_pemda/edit';
			$container['content']['dataset']				= '';
			
			$parameter_dup = $this->Data_umum_pemda_model->get('parameter_dup.*', array('parameter_dup.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['kode']					= $parameter_dup->kode;
			$container['content']['dataset']['pemda']					= $parameter_dup->pemda;
			$container['content']['dataset']['ibukota']					= $parameter_dup->ibukota;
			$container['content']['dataset']['alamat']					= $parameter_dup->alamat;
			$container['content']['dataset']['kepala_daerah']			= $parameter_dup->kepala_daerah;
			$container['content']['dataset']['jabatan_daerah']			= $parameter_dup->jabatan_daerah;
			$container['content']['dataset']['sekretaris_daerah']		= $parameter_dup->sekretaris_daerah;
			$container['content']['dataset']['sekretaris_nip']			= $parameter_dup->sekretaris_nip;
			$container['content']['dataset']['sekretaris_jabatan']		= $parameter_dup->sekretaris_jabatan;
			$container['content']['dataset']['kepala_keuangan']			= $parameter_dup->kepala_keuangan;
			$container['content']['dataset']['keuangan_nip']			= $parameter_dup->keuangan_nip;
			$container['content']['dataset']['keuangan_jabatan']		= $parameter_dup->keuangan_jabatan;
			$container['content']['dataset']['kepala_anggaran']			= $parameter_dup->kepala_anggaran;
			$container['content']['dataset']['anggaran_nip']			= $parameter_dup->anggaran_nip;
			$container['content']['dataset']['anggaran_jabatan']		= $parameter_dup->anggaran_jabatan;
			$container['content']['dataset']['kepala_verifikasi']		= $parameter_dup->kepala_verifikasi;
			$container['content']['dataset']['verifikasi_nip']			= $parameter_dup->verifikasi_nip;
			$container['content']['dataset']['verifikasi_jabatan']		= $parameter_dup->verifikasi_jabatan;
			$container['content']['dataset']['kepala_perbendaharaan']	= $parameter_dup->kepala_perbendaharaan;
			$container['content']['dataset']['perbendaharaan_nip']		= $parameter_dup->perbendaharaan_nip;
			$container['content']['dataset']['perbendaharaan_jabatan']	= $parameter_dup->perbendaharaan_jabatan;
			$container['content']['dataset']['kepala_pembukuan']		= $parameter_dup->kepala_pembukuan;
			$container['content']['dataset']['pembukuan_nip']			= $parameter_dup->pembukuan_nip;
			$container['content']['dataset']['pembukuan_jabatan']		= $parameter_dup->pembukuan_jabatan;
			$container['content']['dataset']['kuasa_bud']				= $parameter_dup->kuasa_bud;
			$container['content']['dataset']['bud_nip']					= $parameter_dup->bud_nip;
			$container['content']['dataset']['bud_jabatan']				= $parameter_dup->bud_jabatan;
			$container['content']['dataset']['atasan_bud']				= $parameter_dup->atasan_bud;
			$container['content']['dataset']['atasan_budnip']			= $parameter_dup->atasan_budnip;
			$container['content']['dataset']['atasan_budjabatan']		= $parameter_dup->atasan_budjabatan;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$update['pemda']					= $this->input->post('pemda');
			$update['ibukota']					= $this->input->post('ibukota');
			$update['alamat']					= $this->input->post('alamat');
			$update['kepala_daerah']			= $this->input->post('kepala_daerah');
			$update['jabatan_daerah']			= $this->input->post('jabatan_daerah');
			$update['sekretaris_daerah']		= $this->input->post('sekretaris_daerah');
			$update['sekretaris_nip']			= $this->input->post('sekretaris_nip');
			$update['sekretaris_jabatan']		= $this->input->post('sekretaris_jabatan');
			$update['kepala_keuangan']			= $this->input->post('kepala_keuangan');
			$update['keuangan_nip']				= $this->input->post('keuangan_nip');
			$update['keuangan_jabatan']			= $this->input->post('keuangan_jabatan');
			$update['kepala_anggaran']			= $this->input->post('kepala_anggaran');
			$update['anggaran_nip']				= $this->input->post('anggaran_nip');
			$update['anggaran_jabatan']			= $this->input->post('anggaran_jabatan');
			$update['kepala_verifikasi']		= $this->input->post('kepala_verifikasi');
			$update['verifikasi_nip']			= $this->input->post('verifikasi_nip');
			$update['verifikasi_jabatan']		= $this->input->post('verifikasi_jabatan');
			$update['kepala_perbendaharaan']	= $this->input->post('kepala_perbendaharaan');
			$update['perbendaharaan_nip']		= $this->input->post('perbendaharaan_nip');
			$update['perbendaharaan_jabatan']	= $this->input->post('perbendaharaan_jabatan');
			$update['kepala_pembukuan']			= $this->input->post('kepala_pembukuan');
			$update['pembukuan_nip']			= $this->input->post('pembukuan_nip');
			$update['pembukuan_jabatan']		= $this->input->post('pembukuan_jabatan');
			$update['kuasa_bud']				= $this->input->post('kuasa_bud');
			$update['bud_nip']					= $this->input->post('bud_nip');
			$update['bud_jabatan']				= $this->input->post('bud_jabatan');
			$update['atasan_bud']				= $this->input->post('atasan_bud');
			$update['atasan_budnip']			= $this->input->post('atasan_budnip');
			$update['atasan_budjabatan']		= $this->input->post('atasan_budjabatan');
						
			$query = $this->Data_umum_pemda_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><font color="green"><strong>Success!</strong></font> "Data Umum Pemda" telah berhasil diperbaharui !</div>');
			
			// redirect('parameter/data_umum_pemda/#successUpdate', 'refresh'); //
			redirect('parameter/data_umum_pemda', 'refresh');
		}
	}
	
}
