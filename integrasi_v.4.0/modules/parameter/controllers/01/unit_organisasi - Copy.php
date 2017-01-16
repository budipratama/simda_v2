<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_organisasi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bidang_model');
		$this->load->model('Bidang_unit_model');
		$this->load->model('Bidang_sub_model');
		$this->load->library('Datatables');
	}
	
	function datatableunit()
    {
        $this->datatables->select('nomor, kode, bidang_unit, bidang_nama')
		->add_column('Actions', $this->get_buttonsunit($tipe, '$1'),'kode')
		->search_column('bidang_unit, bidang_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, bidang_unit.kode, bidang_unit.bidang_unit, bidang.bidang as bidang_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, bidang_unit LEFT JOIN bidang ON bidang_unit.bidang=bidang.kode ORDER BY bidang_unit.bidang_unit ASC) bidang_unit');
       		
        echo $this->datatables->generate();
    }
		
	function get_buttonsunit($tipe, $id)
	{
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';		
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/unit-organisasi/unitedit/'.$id) .'" class="btn btn-sm btn-warning" title="Ubah"><i class="fa fa-pencil"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/unit-organisasi/delete1/'.$id) .'" class="btn btn-sm btn-danger" title="Delete" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data rencana kerja ini.\');"><i class="fa fa-trash-o"></i></a>';
		$html .= '</div>';
		return $html;
	}
	
	function datatablesub()
    {
        $this->datatables->select('nomor, kode, bidang_sub, bidang_unit_nama')
		->add_column('Actions', $this->get_buttonssub($tipe, '$1'),'kode')
		->search_column('bidang_sub, bidang_unit_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, bidang_sub.kode, bidang_sub.bidang_sub, bidang_unit.bidang_unit as bidang_unit_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, bidang_sub LEFT JOIN bidang_unit ON bidang_sub.bidang_unit=bidang_unit.kode ORDER BY bidang_sub.bidang_sub ASC) bidang_sub');
        echo $this->datatables->generate();
    }
		
	function get_buttonssub($tipe, $id)
	{
		$ci= & get_instance();
		$ci->load->helper('url');
		$html  = '<div style="text-align:center;white-space: nowrap;">';		
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/unit-organisasi/subedit/'.$id) .'" class="btn btn-sm btn-warning" title="Ubah"><i class="fa fa-pencil"></i></a>';
		$html .= '<a href="'. site_url($ci->uri->segment(1) . '/unit-organisasi/delete2/'.$id) .'" class="btn btn-sm btn-danger" title="Delete" data-placement="left" onclick="return confirm(\'Apakah anda yakin? \nAkan menghapus data rencana kerja ini.\');"><i class="fa fa-trash-o"></i></a>';
		$html .= '</div>';
		return $html;
	}
	
	public function index()
	{
		$admin_log 	= $this->auth->is_login_admin();
		$waktuEntri	= $this->Tahapan_model->get('selesai', array('kode' => '14'));
		$tahapanSKPD = $this->Tahapan_skpd_model->count_all(array('skpd_kode' => $admin_log['skpd_kode'], 'tahapan_kode' => '14'));
		$waktuSekarang = date("Y-m-d H:i:s");
		
		if ($waktuEntri->selesai < $waktuSekarang && $tahapanSKPD == 0 && $admin_log['level_kode'] != 1){
			redirect('draf-apbd/murni/#warningEntri', 'refresh');
		} else {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/view';
			
			if ($admin_log['level_kode'] == 5 || $admin_log['level_kode'] == 4){
				$skpd = $this->Skpd_model->get('skpd_kode, skpd_nama', array('skpd_kode' => $admin_log['skpd_kode']));
				$container['content']['dataset']['skpd_kode']	= $skpd->skpd_kode;
				$container['content']['dataset']['skpd_nama']	= $skpd->skpd_nama;
				$container['content']['dataset']['skpd_aktive']	= 'no';
				$where_misi										= "skpd.skpd_kode='".$skpd->skpd_kode."' OR misi.kode='5'";
				$container['content']['dataset']['misi']		= $this->Indikator_skpd_model->grid_all('misi.kode as misi_kode, misi.misi as misi_nama', 'misi.misi', 'ASC', '', '', $where_misi, '', 'misi.kode');
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
	
	public function index1()
	{
		$admin_log 	= $this->auth->is_login_admin();		
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/view';			
			$container['content']['dataset']['urusan']		= $this->Bidang_model->grid_all('bidang_kd, bidang_status', 'bidang_status', '', '', '', array('bidang_status'=>'WAJIB'));			
			$container['content']['dataset']['bidang']		= $this->Bidang_model->grid_all('bidang_kd, bidang', 'bidang', '', '', '', array('bidang_status'=>'WAJIB'));			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function unit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/unit_organisasi/unit';
		$container['content']['dataset']['bidang']		= $this->Bidang_model->grid_all('bidang.kode, bidang.bidang', 'bidang.bidang', '');
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function unitadd()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/unit_organisasi/unitadd';
		$container['content']['dataset']['bidang']		= $this->Bidang_model->grid_all('bidang.kode, bidang.bidang', 'bidang.bidang', '');
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function addunit()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('aaa_kode', 'Bidang', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bidang_unit', 'Bidang_unit', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/unit';
			$container['content']['dataset']['bidang']		= $this->Bidang_model->grid_all('bidang.kode, bidang.bidang', 'bidang.bidang', '');
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['bidang']		= $this->input->post('aaa_kode');
			$insert['bidang_unit']	= $this->input->post('bidang_unit');

			$query = $this->Bidang_unit_model->insert($insert);			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "Unit" baru telah berhasil ditambahkan.</div>');
			redirect('parameter/unit_organisasi', 'refresh');
		}
	}	
	
	public function sub()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/unit_organisasi/sub';
		$container['content']['dataset']['unit']		= $this->Bidang_unit_model->grid_all('bidang_unit.kode, bidang_unit.bidang_unit', 'bidang_unit.bidang_unit', 'ASC');
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function subadd()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/unit_organisasi/subadd';
		$container['content']['dataset']['unit']		= $this->Bidang_unit_model->grid_all('bidang_unit.kode, bidang_unit.bidang_unit', 'bidang_unit.bidang_unit', 'ASC');
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function addsub()
	{
		$admin_log = $this->auth->is_login_admin();
		$this->form_validation->set_rules('bbb_kode', 'Bidang_unit', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bidang_sub', 'Bidang_sub', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/sub';
			$container['content']['dataset']				= '';
			$container['content']['dataset']['unit']		= $this->Bidang_unit_model->grid_all('bidang_unit.kode, bidang_unit.bidang_unit', 'bidang_unit.bidang_unit', 'ASC');
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['bidang_unit']		= $this->input->post('bbb_kode');
			$insert['bidang_sub']		= $this->input->post('bidang_sub');

			$query = $this->Bidang_sub_model->insert($insert);			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "Sub Unit" baru telah berhasil ditambahkan.</div>');
			redirect('parameter/unit_organisasi', 'refresh');
		}

	}
	
	public function delete1()
	{
		if ($this->uri->segment(4)){
			$this->Bidang_unit_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tujuan telah berhasil dihapus.</div>');
		} 

		redirect('parameter/unit-organisasi/unit', 'refresh');
	}
	
	public function delete2()
	{
		if ($this->uri->segment(4)){
			$this->Bidang_sub_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data tujuan telah berhasil dihapus.</div>');
		} 

		redirect('parameter/unit-organisasi/sub', 'refresh');
	}
	
	public function tampil_combobox_urusan_by_bidang2(){
		$bidang_kode 	= $this->uri->segment(4);
		$where 			= "bidang.bidang_kode='".$bidang_kode."' OR bidang_unit.kode='1'";
		$data_unit		= $this->Bidang_indikator_model->grid_all('bidang_unit.kode as unit_kode, bidang_unit.bidang_unit as unit_nama', 'bidang_unit.bidang_unit', 'ASC', '', '', $where, '', 'bidang_unit.kode');
		echo '<label class="control-label col-md-2" for="unit_kode">Unit :</label>';
		echo '<div class="col-md-10">';
		combobox('db', $data_unit, 'bidang_kode', 'unit_kode', 'unit_nama', '', 'show_form_sub_by_bidang();', 'Pilih Unit', 'class="select2_category form-control" tabindex="1" required="required"');
		echo '</div>';
	}
	
	public function tampil_combobox_unit_by_bidang2(){
		$bidang_kode 	= $this->uri->segment(4);
		$where 			= "bidang.bidang_kode='".$bidang_kode."' OR bidang_unit.kode='1'";
		$data_unit		= $this->Bidang_indikator_model->grid_all('bidang_unit.kode as unit_kode, bidang_unit.bidang_unit as unit_nama', 'bidang_unit.bidang_unit', 'ASC', '', '', $where, '', 'bidang_unit.kode');
		echo '<label class="control-label col-md-2" for="unit_kode">Unit :</label>';
		echo '<div class="col-md-10">';
		combobox('db', $data_unit, 'bidang_kode', 'unit_kode', 'unit_nama', '', 'show_form_sub_by_bidang();', 'Pilih Unit', 'class="select2_category form-control" tabindex="1" required="required"');
		echo '</div>';
	}
	
	public function tampil_combobox_sub_by_bidang2(){
		$bidang_kode 	= $this->uri->segment(4);
		$where 			= "bidang.bidang_kode='".$bidang_kode."' OR bidang_sub.kode='1'";
		$data_sub		= $this->Bidang_indikator_model->grid_all('bidang_sub.kode as sub_kode, bidang_sub.bidang_sub as sub_nama', 'bidang_sub.bidang_sub', 'ASC', '', '', $where, '', 'bidang_sub.kode');
		echo '<label class="control-label col-md-2" for="unit_kode">Sub Unit :</label>';
		echo '<div class="col-md-10">';
		combobox('db', $data_sub, 'bidang_kode', 'sub_kode', 'sub_nama', '', '', 'Pilih Sub Unit', 'class="select2_category form-control" tabindex="1" required="required"');
		echo '</div>';
	}

}