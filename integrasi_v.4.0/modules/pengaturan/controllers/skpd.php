<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skpd extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Tahun_model');
		$this->load->model('Skpd_model');
		$this->load->model('Urusan_model');
		$this->load->library('Datatables');
	}
	
	function datatable() {
        $admin_log 		 = $this->auth->is_login_admin();
		$tahun 			 = $admin_log['tahun'];
		$where_datatable = 'ms_urusan.tahun = \''.$tahun.'\' AND skpd.skpd_status = \'SKPD\'';

		$this->datatables->select('nomor, skpd_kode, skpd_nomor, skpd_nama, skpd_pimpinan, no')
		->add_column('Actions', get_buttons('$1'),'skpd_kode')
		->search_column('skpd_nama')
		->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, skpd.skpd_kode, skpd.skpd_nomor, skpd.skpd_nama, skpd.skpd_pimpinan, ms_urusan.no FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, skpd LEFT JOIN urusan ON skpd.urusan=urusan.kode LEFT JOIN ms_urusan ON urusan.kd_urusan=ms_urusan.kode WHERE ('.$where_datatable.') ORDER BY skpd.skpd_kode DESC) skpd');
		
        echo $this->datatables->generate();
    }
	
	public function index() {
		$admin_log 	= $this->auth->is_login_admin();
		$tahun		= $admin_log['tahun'];
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/skpd/view';
		
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun), 'urusan.kode');
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		$container['content']['dataset']['tahun_']		= $admin_log['tahun'];
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert() {
		$admin_log  = $this->auth->is_login_admin();
		$tahun		= $admin_log['tahun'];
		$this->form_validation->set_rules('aaa_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_nama', 'Nama SKPD', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_alamat', 'Alamat', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_nomor', 'Nomor', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/skpd/add';

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['urusan']			= $this->input->post('aaa_kode');
			$insert['skpd_nomor']		= $this->input->post('skpd_nomor');
			$insert['skpd_nama']		= $this->input->post('skpd_nama');
			$insert['skpd_kewenangan']	= $this->input->post('skpd_kewenangan');
			$insert['skpd_pimpinan']	= $this->input->post('skpd_pimpinan');
			$insert['skpd_telepon']		= '021-';
			$insert['skpd_fax']			= '021-';
			$insert['skpd_email']		= 'example@bekasikab.go.id';
			$insert['skpd_website']		= 'http://www.bekasikab.go.id';
			$insert['skpd_alamat']		= $this->input->post('skpd_alamat');
			$insert['skpd_status']		= 'SKPD';
			$insert['skpd_aktif']		= '0000';
			$insert['skpd_entri']		= 'Y';
			$insert['skpd_kegiatan']	= 'Y';
			$insert['skpd_lokasi']		= 'Y';

			$query = $this->Skpd_model->insert($insert);
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data skpd baru telah berhasil ditambahkan.</div>');
			redirect('pengaturan/skpd/', 'refresh');
		}
	}
	
	public function edit() {
		$admin_log  = $this->auth->is_login_admin();
		$tahun		= $admin_log['tahun'];
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/skpd/edit';
		
		$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun), 'urusan.kode');
		$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
		
		$skpd = $this->Skpd_model->get('skpd.*', array('skpd.skpd_kode'=>$this->uri->segment(4)));
		$container['content']['dataset']['urusan_kode']		= $skpd->urusan;
		$container['content']['dataset']['skpd_kode']		= $skpd->skpd_kode;
		$container['content']['dataset']['skpd_nomor']		= $skpd->skpd_nomor;
		$container['content']['dataset']['skpd_nama']		= $skpd->skpd_nama;
		$container['content']['dataset']['skpd_kewenangan']	= $skpd->skpd_kewenangan;
		$container['content']['dataset']['skpd_pimpinan']	= $skpd->skpd_pimpinan;
		$container['content']['dataset']['skpd_telepon']	= $skpd->skpd_telepon;
		$container['content']['dataset']['skpd_fax']		= $skpd->skpd_fax;
		$container['content']['dataset']['skpd_email']		= $skpd->skpd_email;
		$container['content']['dataset']['skpd_website']	= $skpd->skpd_website;
		$container['content']['dataset']['skpd_alamat']		= $skpd->skpd_alamat;
		$container['content']['dataset']['skpd_status']		= 'SKPD';
		$container['content']['dataset']['skpd_aktif']		= ($skpd->skpd_aktif == '0000')?'':$skpd->skpd_aktif;
		$container['content']['dataset']['skpd_entri']		= ($skpd->skpd_entri == 'Y')?'checked':'';
		$container['content']['dataset']['skpd_kegiatan']	= ($skpd->skpd_kegiatan == 'Y')?'checked':'';
		$container['content']['dataset']['skpd_lokasi']		= ($skpd->skpd_lokasi == 'Y')?'checked':'';
		
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update() {
		$admin_log = $this->auth->is_login_admin();
		$this->form_validation->set_rules('urusan_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_nama', 'Nama SKPD', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_alamat', 'Alamat', 'trim|required|xss_clean');
		$this->form_validation->set_rules('skpd_telepon', 'Telepon', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/skpd/edit';
			$container['content']['dataset']['urusan']		= $this->Urusan_model->grid_all('urusan.kode, urusan.urusan', 'urusan.urusan', '', '', '', '', array('ms_urusan.tahun'=>$tahun), 'urusan.kode');
			$container['content']['dataset']['tahun']		= $this->Tahun_model->grid_all('tahun', 'tahun', 'ASC', '', '', array('status'=>'1'));
			
			$skpd = $this->Skpd_model->get('skpd.*', array('skpd.skpd_kode'=>$this->uri->segment(4)));
			$container['content']['dataset']['urusan_kode']		= $skpd->urusan;
			$container['content']['dataset']['skpd_kode']		= $skpd->skpd_kode;
			$container['content']['dataset']['skpd_nomor']		= $skpd->skpd_nomor;
			$container['content']['dataset']['skpd_nama']		= $skpd->skpd_nama;
			$container['content']['dataset']['skpd_kewenangan']	= $skpd->skpd_kewenangan;
			$container['content']['dataset']['skpd_pimpinan']	= $skpd->skpd_pimpinan;
			$container['content']['dataset']['skpd_telepon']	= $skpd->skpd_telepon;
			$container['content']['dataset']['skpd_fax']		= $skpd->skpd_fax;
			$container['content']['dataset']['skpd_email']		= $skpd->skpd_email;
			$container['content']['dataset']['skpd_website']	= $skpd->skpd_website;
			$container['content']['dataset']['skpd_alamat']		= $skpd->skpd_alamat;
			$container['content']['dataset']['skpd_status']		= 'SKPD';
			$container['content']['dataset']['skpd_aktif']		= ($skpd->skpd_aktif == '0000')?'':$skpd->skpd_aktif;
			$container['content']['dataset']['skpd_entri']		= ($skpd->skpd_entri == 'Y')?'checked':'';
			$container['content']['dataset']['skpd_kegiatan']	= ($skpd->skpd_kegiatan == 'Y')?'checked':'';
			$container['content']['dataset']['skpd_lokasi']		= ($skpd->skpd_lokasi == 'Y')?'checked':'';
			
			$header['admin_log']								= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['urusan']			= $this->input->post('urusan_kode');
			$update['skpd_nomor']		= $this->input->post('skpd_nomor');
			$update['skpd_nama']		= $this->input->post('skpd_nama');
			$update['skpd_kewenangan']	= $this->input->post('skpd_kewenangan');
			$update['skpd_pimpinan']	= $this->input->post('skpd_pimpinan');
			$update['skpd_telepon']		= $this->input->post('skpd_telepon');
			$update['skpd_fax']			= $this->input->post('skpd_fax');
			$update['skpd_email']		= $this->input->post('skpd_email');
			$update['skpd_website']		= $this->input->post('skpd_website');
			$update['skpd_alamat']		= $this->input->post('skpd_alamat');
			$update['skpd_status']		= 'SKPD';
			$update['skpd_aktif']		= ($this->input->post('skpd_aktif'))?$this->input->post('skpd_aktif'):'0000';
			$update['skpd_entri']		= ($this->input->post('skpd_entri'))?'Y':'N';
			$update['skpd_kegiatan']	= ($this->input->post('skpd_kegiatan'))?'Y':'N';
			$update['skpd_lokasi']		= ($this->input->post('skpd_lokasi'))?'Y':'N';		

			$query = $this->Skpd_model->update($update, $this->input->post('skpd_kode'));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data skpd telah berhasil diubah.</div>');
			redirect('pengaturan/skpd', 'refresh');
		}
	}
	
	public function detail() {
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/skpd/detail';
		
		$skpd = $this->Skpd_model->get('skpd.*, urusan.urusan as urusan_nama', array('skpd.skpd_kode'=>$this->uri->segment(4)));
		$container['content']['dataset']['urusan_kode']		= $skpd->urusan;
		$container['content']['dataset']['urusan_nama']		= $skpd->urusan_nama;
		$container['content']['dataset']['skpd_kode']		= $skpd->skpd_kode;
		$container['content']['dataset']['skpd_nomor']		= $skpd->skpd_nomor;
		$container['content']['dataset']['skpd_nama']		= $skpd->skpd_nama;
		$container['content']['dataset']['skpd_kewenangan']	= $skpd->skpd_kewenangan;
		$container['content']['dataset']['skpd_pimpinan']	= $skpd->skpd_pimpinan;
		$container['content']['dataset']['skpd_telepon']	= $skpd->skpd_telepon;
		$container['content']['dataset']['skpd_fax']		= $skpd->skpd_fax;
		$container['content']['dataset']['skpd_email']		= $skpd->skpd_email;
		$container['content']['dataset']['skpd_website']	= $skpd->skpd_website;
		$container['content']['dataset']['skpd_alamat']		= $skpd->skpd_alamat;
		$container['content']['dataset']['skpd_status']		= 'SKPD';
		$container['content']['dataset']['skpd_aktif']		= ($skpd->skpd_aktif == '0000')?'Default':$skpd->skpd_aktif;
		$container['content']['dataset']['skpd_entri']		= ($skpd->skpd_entri == 'Y')?'checked':'';
		$container['content']['dataset']['skpd_kegiatan']	= ($skpd->skpd_kegiatan == 'Y')?'checked':'';
		$container['content']['dataset']['skpd_lokasi']		= ($skpd->skpd_lokasi == 'Y')?'checked':'';
		
		$header['admin_log']								= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function delete() {
		if ($this->uri->segment(4)){
			$this->Skpd_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data skpd telah berhasil dihapus.</div>');
		}
		redirect('pengaturan/skpd', 'refresh');
	}
	
}