<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_organisasi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tipe_model');
		$this->load->model('Urusan_model');
		$this->load->model('Bidang_model');
		$this->load->model('Bidang_unit_model');
		$this->load->model('Bidang_sub_model');
		$this->load->model('Bidang_indikator_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
		$this->datatables->select('nomor, kode, urusan_nama, skpd, bidang_sub')
		->add_column('Actions', $this->get_buttonsunit($tipe, '$1'),'kode')
		->search_column('nomor, kode, urusan, skpd, bidang_sub')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, bidang_indikator.kode, urusan.urusan as urusan_nama, bidang_indikator.skpd, bidang_indikator.bidang_sub FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, bidang_indikator LEFT JOIN urusan ON bidang_indikator.urusan=urusan.kode ORDER BY bidang_indikator.urusan ASC) bidang_indikator');
		echo $this->datatables->generate();	

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
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/view';
			
				$container['content']['dataset']['tipe_kode']	= $bidang_tipe->tipe_kode;
				$container['content']['dataset']['tipe_nama']	= $bidang_tipe->tipe_nama;

			$where_skpd											= 'tipe_sort IN (\'1\', \'2\')';
			$container['content']['dataset']['bidang_tipe']		= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_skpd);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function add()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 60;
		$container['content']['view']					= 'parameter/unit_organisasi/add';
		$container['content']['dataset']['bidang']		= $this->Bidang_model->grid_all('bidang.kode, bidang.bidang', 'bidang.bidang', '');
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
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
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/sub';
			
				$container['content']['dataset']['tipe_kode']	= $bidang_tipe->tipe_kode;
				$container['content']['dataset']['tipe_nama']	= $bidang_tipe->tipe_nama;

			$where_skpd											= 'tipe_sort IN (\'1\', \'2\')';
			$container['content']['dataset']['bidang_tipe']		= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_skpd);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function addsub()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('tipe_kode', 'Tipe', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Urusan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ccc_kode', 'Bidang_unit', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ddd_kode', 'Bidang_sub', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/unit_organisasi/sub';
			
			$header['admin_log']	= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$insert['tipe']			= $this->input->post('tipe_kode');
			$insert['urusan']		= $this->input->post('bbb_kode');
			$insert['bidang_unit']	= $this->input->post('ccc_kode');
			$insert['bidang_sub']	= $this->input->post('ddd_kode');

			$query = $this->Bidang_indikator_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "Sub Unit" baru telah berhasil ditambahkan.</div>');
			
			redirect('parameter/unit_organisasi', 'refresh');
		}

	}
	
	public function addsubxx()
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
	
	public function tampil_combobox_bidang_by_unit(){
		$tipe_kode 		= $this->uri->segment(4);
		$where 			= "tipe.tipe_kode='".$tipe_kode."' OR urusan.kode=''";
		$data_misi		= $this->Bidang_indikator_model->grid_all('urusan.kode as bidang_kode, urusan.urusan as bidang_nama', 'urusan.urusan', '', '', '', $where, '', 'urusan.kode');
		echo '<label class="control-label col-md-2" for="bidang_kode">Bidang :</label>';
		echo '<div class="col-md-10">';
		combobox('db', $data_misi, 'bbb_kode', 'bidang_kode', 'bidang_nama', '', 'show_form_unit_by_bidang();', 'Pilih Bidang', 'class="select2_category form-control" tabindex="1" required="required"');
		echo '</div>';
	}
	
	public function tampil_combobox_unit_by_bidang(){
		$tipe_kode 			= $this->uri->segment(4);
		$bidang_unit_kode	= $this->uri->segment(5);
		if ($bidang_unit_kode == 0){
			$where = "bidang_unit.urusan IN ('')";
		} else {
			$where = "urusan.kode='".$bidang_unit_kode."' AND tipe.tipe_kode='".$tipe_kode."'";
		}
		$data_unit = $this->Bidang_indikator_model->grid_all('bidang_unit.bidang_unit as unit_kode, bidang_unit.bidang_unit as unit_nama', 'bidang_unit.bidang_unit', 'ASC', '', '', $where, '', 'bidang_unit.bidang_unit');
		if (!empty($bidang_unit_kode)){
		echo '<label class="control-label col-md-2" for="ccc_kode">Unit :</label>';
		echo '<div class="col-md-10">';
			combobox('db', $data_unit, 'ccc_kode', 'unit_kode', 'unit_nama', '', 'show_form_sub_by_bidang();', 'Pilih Unit', 'class="select2_category form-control" tabindex="1" required="required"');	
		echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="ccc_kode">Unit :</label>';
			echo '<div class="col-md-10">';
			echo '</div>';
		}
	}
	
	public function tampil_combobox_sub_by_bidang(){
		$tipe_kode 			= $this->uri->segment(4);
		$bidang_unit_kode	= $this->uri->segment(5);
		if ($bidang_unit_kode == 0){
			$where = "bidang_sub.urusan IN ('')";
		} else {
			$where = "urusan.kode='".$bidang_unit_kode."' AND tipe.tipe_kode='".$tipe_kode."'";
		}
		$data_sub = $this->Bidang_indikator_model->grid_all('bidang_indikator.kode , bidang_indikator.bidang_sub', 'bidang_indikator.bidang_sub', 'ASC', '', '', $where, '', 'bidang_indikator.kode');
		if (!empty($bidang_unit_kode)){
		echo '<label class="control-label col-md-2" for="ddd_kode">Sub Unit :</label>';
		echo '<div class="col-md-10">';
			combobox('db', $data_sub, 'ddd_kode', 'kode', 'bidang_sub', '', '', 'Pilih Sub Unit', 'class="select2_category form-control" tabindex="1" required="required"');		
		echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="ddd_kode">Sub Unit :</label>';
			echo '<div class="col-md-10">';
			echo '</div>';
		}
	}

}