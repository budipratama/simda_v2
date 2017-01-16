<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Belanja_wajib extends CI_Controller {
	
	public function __construct() {
		parent::__construct();	
		$this->load->model('Belanja_wajib_model');
		$this->load->model('Tipe_model');	
		$this->load->model('Akun_model');	
		$this->load->model('Kelompok_model');	
		$this->load->model('Jenis_model');	
		$this->load->model('Obyek_model');	
		$this->load->model('Rincian_model');
		$this->load->library('Datatables');
	}
	
	public function index()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/belanja_wajib/view';
			
			$container['belanja']	= $this->Belanja_wajib_model->get_all();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function add(){
		$admin_log 	= $this->auth->is_login_admin();
		$this->load->helper('text');
		$this->form_validation->set_rules('aaa_kode', 'Akun', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Kelompok', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ccc_kode', 'Jenis', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ddd_kode', 'Obyek', 'trim|required|xss_clean');
		$this->form_validation->set_rules('eee_kode', 'Rincian', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/belanja_wajib/add';
			
			$container['akun'] 								= $this->Akun_model->get_belanja();

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$insert['akun']		= $this->input->post('aaa_kode');
			$insert['kelompok']	= $this->input->post('bbb_kode');
			$insert['jenis']	= $this->input->post('ccc_kode');
			$insert['obyek']	= $this->input->post('ddd_kode');
			$insert['rincian']	= $this->input->post('eee_kode');
			
			$query = $this->Belanja_wajib_model->insert($insert);			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "BELANJA WAJIB" baru telah berhasil ditambahkan.</div>');
			redirect('parameter/belanja-wajib', 'refresh');
		}
	}
	
	public function edit() {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode', 'Akun', 'trim|required|xss_clean');
		$this->form_validation->set_rules('bbb_kode', 'Kelompok', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ccc_kode', 'Jenis', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ddd_kode', 'Obyek', 'trim|required|xss_clean');
		$this->form_validation->set_rules('eee_kode', 'Rincian', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/belanja_wajib/edit';
			
			$container['akun'] 								= $this->Akun_model->get_belanja();
			$container['content']['dataset']['kelompok']	= $this->Kelompok_model->grid_all('kode, kelompok_nama', 'kelompok_nama', 'ASC');
			
			$belanja_wajib = $this->Belanja_wajib_model->get('belanja_wajib.*', array('belanja_wajib.kode'=>$this->uri->segment(4)));
			$container['content']['dataset']['kode']		= $belanja_wajib->kode;
			$container['content']['dataset']['akun_']		= $belanja_wajib->akun;
			$container['content']['dataset']['kelompok_']	= $belanja_wajib->kelompok;
			$container['content']['dataset']['jenis_']		= $belanja_wajib->jenis;
			$container['content']['dataset']['obyek_']		= $belanja_wajib->obyek;
			$container['content']['dataset']['rincian_']	= $belanja_wajib->rincian;
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['akun']		= $this->input->post('aaa_kode');
			$update['kelompok']	= $this->input->post('bbb_kode');
			$update['jenis']	= $this->input->post('ccc_kode');
			$update['obyek']	= $this->input->post('ddd_kode');
			$update['rincian']	= $this->input->post('eee_kode');
			
			$query = $this->Belanja_wajib_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "BELANJA WAJIB" telah berhasil diubah</div>');
			redirect('parameter/belanja-wajib', 'refresh');
		}
	}
	
	public function delete() {
		if ($this->uri->segment(4)){
			$this->Belanja_wajib_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "BELANJA WAJIB" telah berhasil dihapus</div>');
		} 
		redirect('parameter/belanja-wajib', 'refresh');
	}
	
	public function tampil_combobox_akun_by_kelompok(){
		$akun_kode	= $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('kelompok.kode, kelompok.kelompok_nama', 'kelompok.kelompok_nama', '', '', '', array('kelompok.akun'=>$akun_kode));			
			echo '<label class="control-label col-md-2" for="bbb_kode">Kelompok:</label>';
			echo '<div class="col-md-10">';
				combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'kelompok_nama', '', 'show_form_kelompok_by_jenis();', 'Pilih Kelompok ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="bbb_kode">Kelompok:</label>
				<div class="col-md-10"><select class="select2_category form-control" name="bbb_kode" id="bbb_kode" data-placeholder="Pilih Kelompok ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_kelompok_by_jenis(){
		$kelompok_kode 	= $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('jenis.kode, jenis.jenis_nama', 'jenis.jenis_nama', '', '', '', array('jenis.kelompok'=>$kelompok_kode));
			echo '<label class="control-label col-md-2" for="ccc_kode">Jenis:</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_jenis, 'ccc_kode', 'kode', 'jenis_nama', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="ccc_kode">Jenis:</label>
				<div class="col-md-8"><select class="select2_category form-control" name="ccc_kode" id="ccc_kode" data-placeholder="Pilih Jenis ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_jenis_by_obyek(){
		$jenis_kode = $this->uri->segment(4);
		if ($jenis_kode){
			$data_obyek = $this->Obyek_model->grid_all('obyek.kode, obyek.obyek_nama', 'obyek.obyek_nama', '', '', '', array('obyek.jenis'=>$jenis_kode));
			echo '<label class="control-label col-md-2" for="ddd_kode">Obyek:</label>';
			echo '<div class="col-md-10">';
				combobox('db', $data_obyek, 'ddd_kode', 'kode', 'obyek_nama', '', 'show_form_obyek_by_rincian();', 'Pilih Obyek ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="ddd_kode">Obyek:</label>
				<div class="col-md-10"><select class="select2_category form-control" name="ddd_kode" id="ddd_kode" data-placeholder="Pilih Kelompok ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_obyek_by_rincian(){
		$obyek_kode = $this->uri->segment(4);
		if ($obyek_kode){
			$data_rincian = $this->Rincian_model->grid_all('rincian.kode, rincian.rincian_nama', 'rincian.rincian_nama', '', '', '', array('rincian.obyek'=>$obyek_kode));
			echo '<label class="control-label col-md-2" for="eee_kode">Rincian:</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_rincian, 'eee_kode', 'kode', 'rincian_nama', '', '', 'Pilih Rincian ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="eee_kode">Rincian:</label>
				<div class="col-md-8"><select class="select2_category form-control" name="eee_kode" id="eee_kode" data-placeholder="Pilih Jenis ..." tabindex="1"></select></div>';
		}
	}
	
}