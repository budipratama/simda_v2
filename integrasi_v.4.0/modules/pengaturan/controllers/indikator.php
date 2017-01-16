<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indikator extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Indikator_model');
		$this->load->model('Sasaran_model');
		$this->load->model('Tujuan_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, kode, indikator, sasaran_nama')
		->add_column('Actions', get_buttons('$1'),'kode')
		->search_column('indikator, sasaran_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, indikator.*, sasaran.sasaran as sasaran_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, indikator LEFT JOIN sasaran ON indikator.sasaran=sasaran.kode ORDER BY indikator ASC) indikator');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/indikator/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
				
		$container['content']['dataset']['grid']		= $this->Indikator_model->grid_all('indikator.*, sasaran.sasaran as sasaran_nama', 'indikator.indikator', 'ASC');
		
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
		$container['content']['view']					= 'pengaturan/indikator/add';
		$container['content']['dataset']['tujuan']		= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('tujuan_kode', 'Tujuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sasaran_kode', 'Sasaran', 'trim|required|xss_clean');
		$this->form_validation->set_rules('indikator', 'Indikator', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/indikator/add';
			$container['content']['dataset']['tujuan']		= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['sasaran']			= $this->input->post('sasaran_kode');
			$insert['indikator']		= $this->input->post('indikator');
			$insert['tahun2013']		= $this->input->post('tahun2013');
			$insert['tahun2014']		= $this->input->post('tahun2014');
			$insert['tahun2015']		= $this->input->post('tahun2015');
			$insert['tahun2016']		= $this->input->post('tahun2016');
			$insert['tahun2017']		= $this->input->post('tahun2017');
			$insert['retahun2013']		= $this->input->post('retahun2013');
			$insert['retahun2014']		= $this->input->post('retahun2014');
			$insert['retahun2015']		= $this->input->post('retahun2015');
			$insert['retahun2016']		= $this->input->post('retahun2016');
			$insert['retahun2017']		= $this->input->post('retahun2017');
						
			$query = $this->Indikator_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data indikator baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/indikator', 'refresh');
		}

	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/indikator/edit';
		$container['content']['dataset']['tujuan']		= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
		$container['content']['dataset']['sasaran']		= $this->Sasaran_model->grid_all('sasaran.kode, sasaran.sasaran', 'sasaran.sasaran', 'ASC');
		
		$indikator = $this->Indikator_model->get('indikator.*, sasaran.kode as sasaran_kode, sasaran.tujuan as tujuan_kode', array('indikator.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['tujuan_kode']	= $indikator->tujuan_kode;
		$container['content']['dataset']['sasaran_kode']= $indikator->sasaran_kode;
		$container['content']['dataset']['kode']		= $indikator->kode;
		$container['content']['dataset']['indikator']	= $indikator->indikator;
		$container['content']['dataset']['tahun2013']	= $indikator->tahun2013;
		$container['content']['dataset']['tahun2014']	= $indikator->tahun2014;
		$container['content']['dataset']['tahun2015']	= $indikator->tahun2015;
		$container['content']['dataset']['tahun2016']	= $indikator->tahun2016;
		$container['content']['dataset']['tahun2017']	= $indikator->tahun2017;
		$container['content']['dataset']['retahun2013']	= $indikator->retahun2013;
		$container['content']['dataset']['retahun2014']	= $indikator->retahun2014;
		$container['content']['dataset']['retahun2015']	= $indikator->retahun2015;
		$container['content']['dataset']['retahun2016']	= $indikator->retahun2016;
		$container['content']['dataset']['retahun2017']	= $indikator->retahun2017;
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('tujuan_kode', 'Tujuan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sasaran_kode', 'Sasaran', 'trim|required|xss_clean');
		$this->form_validation->set_rules('indikator', 'Indikator', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/indikator/edit';
			$container['content']['dataset']['tujuan']		= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
			$container['content']['dataset']['sasaran']		= $this->Sasaran_model->grid_all('sasaran.kode, sasaran.sasaran', 'sasaran.sasaran', 'ASC');
			
			$indikator = $this->Indikator_model->get('indikator.*', array('indikator.kode'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['tujuan_kode']	= $indikator->tujuan_kode;
			$container['content']['dataset']['sasaran_kode']= $indikator->sasaran_kode;
			$container['content']['dataset']['kode']		= $indikator->kode;
			$container['content']['dataset']['indikator']	= $indikator->indikator;
			$container['content']['dataset']['tahun2013']	= $indikator->tahun2013;
			$container['content']['dataset']['tahun2014']	= $indikator->tahun2014;
			$container['content']['dataset']['tahun2015']	= $indikator->tahun2015;
			$container['content']['dataset']['tahun2016']	= $indikator->tahun2016;
			$container['content']['dataset']['tahun2017']	= $indikator->tahun2017;
			$container['content']['dataset']['retahun2013']	= $indikator->retahun2013;
			$container['content']['dataset']['retahun2014']	= $indikator->retahun2014;
			$container['content']['dataset']['retahun2015']	= $indikator->retahun2015;
			$container['content']['dataset']['retahun2016']	= $indikator->retahun2016;
			$container['content']['dataset']['retahun2017']	= $indikator->retahun2017;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['sasaran']			= $this->input->post('sasaran_kode');
			$update['indikator']		= $this->input->post('indikator');
			$update['tahun2013']		= $this->input->post('tahun2013');
			$update['tahun2014']		= $this->input->post('tahun2014');
			$update['tahun2015']		= $this->input->post('tahun2015');
			$update['tahun2016']		= $this->input->post('tahun2016');
			$update['tahun2017']		= $this->input->post('tahun2017');
			$update['retahun2013']		= $this->input->post('retahun2013');
			$update['retahun2014']		= $this->input->post('retahun2014');
			$update['retahun2015']		= $this->input->post('retahun2015');
			$update['retahun2016']		= $this->input->post('retahun2016');
			$update['retahun2017']		= $this->input->post('retahun2017');
						
			$query = $this->Indikator_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data indikator telah berhasil diubah.</div>');
			
			redirect('pengaturan/indikator', 'refresh');
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/indikator/detail';
		$container['content']['dataset']['tujuan']		= $this->Tujuan_model->grid_all('tujuan.kode, tujuan.tujuan', 'tujuan.tujuan', 'ASC');
			$container['content']['dataset']['sasaran']	= $this->Sasaran_model->grid_all('sasaran.kode, sasaran.sasaran', 'sasaran.sasaran', 'ASC');
		
		$indikator = $this->Indikator_model->get('indikator.*, sasaran.sasaran as sasaran_nama, tujuan.kode as tujuan_kode, tujuan.tujuan as tujuan_nama', array('indikator.kode'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['sasaran_kode']	= $indikator->sasaran;
		$container['content']['dataset']['sasaran_nama']	= $indikator->sasaran_nama;
		$container['content']['dataset']['tujuan_kode']		= $indikator->tujuan_kode;
		$container['content']['dataset']['tujuan_nama']		= $indikator->tujuan_nama;
		$container['content']['dataset']['kode']			= $indikator->kode;
		$container['content']['dataset']['indikator']		= $indikator->indikator;
		$container['content']['dataset']['tahun2013']		= $indikator->tahun2013;
		$container['content']['dataset']['tahun2014']		= $indikator->tahun2014;
		$container['content']['dataset']['tahun2015']		= $indikator->tahun2015;
		$container['content']['dataset']['tahun2016']		= $indikator->tahun2016;
		$container['content']['dataset']['tahun2017']		= $indikator->tahun2017;
		$container['content']['dataset']['retahun2013']		= $indikator->retahun2013;
		$container['content']['dataset']['retahun2014']		= $indikator->retahun2014;
		$container['content']['dataset']['retahun2015']		= $indikator->retahun2015;
		$container['content']['dataset']['retahun2016']		= $indikator->retahun2016;
		$container['content']['dataset']['retahun2017']		= $indikator->retahun2017;
		
		$header['admin_log']			= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			$this->Indikator_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data indikator telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/indikator', 'refresh');
	}
	
	public function tampil_combobox_sasaran(){
		$tujuan_kode = $this->uri->segment(4);
		if ($tujuan_kode){
			$data_sasaran = $this->Sasaran_model->grid_all('sasaran.kode, sasaran.sasaran', 'sasaran.sasaran', 'ASC', '', '', array('sasaran.tujuan'=>$tujuan_kode));
			echo '<label class="control-label" for="sasaran_kode">Sasaran<span class="required">*</span> :</label>';
					combobox('db', $data_sasaran, 'sasaran_kode', 'kode', 'sasaran', '', '', 'Pilih Sasaran', 'class="select2_category form-control" required="required"');
		} else {
			echo '<label class="control-label" for="sasaran_kode">Sasaran<span class="required">*</span> :</label>
					<select class="select2_category form-control" name="sasaran_kode" id="sasaran_kode" data-placeholder="Pilih Sasaran" required="required">
					</select>';
		}
	}
}
