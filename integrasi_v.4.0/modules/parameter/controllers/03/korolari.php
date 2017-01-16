<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Korolari extends CI_Controller {
	
	public function __construct() {
		parent::__construct();	
		$this->load->model('Tipe_model');	
		$this->load->model('Akun_model');	
		$this->load->model('Kelompok_model');	
		$this->load->model('Jenis_model');	
		$this->load->model('Obyek_model');	
		$this->load->model('Rincian_model');
		$this->load->model('Korolari_model');
		$this->load->library('Datatables');
	}
	
	public function index()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/korolari/view';
			
			$container['rek']		= $this->Korolari_model->get_rek();
			$container['debet']		= $this->Korolari_model->get_debet();
			$container['kredit']	= $this->Korolari_model->get_kredit();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		}
	}
	
	public function rek()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/korolari/rek';
			
			$where_rek									= 'kode IN (\'5\',\'7\')';
			$container['content']['dataset']['rek']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_rek);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/popup', $header);
			$this->load->view('admin/container', $container);
		}
	}
	
	public function debet()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/korolari/debet';
			
			$where_rek									= 'kode IN (\'1\',\'2\')';
			$container['content']['dataset']['rek']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_rek);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/popup', $header);
			$this->load->view('admin/container', $container);
		}
	}
	
	public function kredit() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/korolari/kredit';
			
			$where_rek									= 'kode IN (\'3\',\'7\')';
			$container['content']['dataset']['rek']		= $this->Akun_model->grid_all('kode, akun_nama', 'akun_nama', '', '', '', $where_rek);
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/popup', $header);
			$this->load->view('admin/container', $container);
		}
	}
	
	public function add() {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('rek1_kode','Akun_rek','trim|required|xss_clean');
        $this->form_validation->set_rules('rek2_kode','Kelompok_rek','trim|xss_clean');
		$this->form_validation->set_rules('rek3_kode','Jenis_rek','trim|xss_clean');
        $this->form_validation->set_rules('rek4_kode','Obyek_rek','trim|xss_clean');
        $this->form_validation->set_rules('rek5_kode','Rincian_rek','trim|xss_clean');		
		$this->form_validation->set_rules('debet1_kode','Akun_debet','trim|required|xss_clean');
        $this->form_validation->set_rules('debet2_kode','Kelompok_debet','trim|xss_clean');
		$this->form_validation->set_rules('debet3_kode','Jenis_debet','trim|xss_clean');
        $this->form_validation->set_rules('debet4_kode','Obyek_debet','trim|xss_clean');
        $this->form_validation->set_rules('debet5_kode','Rincian_debet','trim|xss_clean');
		$this->form_validation->set_rules('kredit1_kode','Akun_kredit','trim|required|xss_clean');
        $this->form_validation->set_rules('kredit2_kode','Kelompok_kredit','trim|xss_clean');
		$this->form_validation->set_rules('kredit3_kode','Jenis_kredit','trim|xss_clean');
        $this->form_validation->set_rules('kredit4_kode','Obyek_kredit','trim|xss_clean');
        $this->form_validation->set_rules('kredit5_kode','Rincian_kredit','trim|xss_clean');			
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/korolari/add';
		{
			if($this->form_validation->run() == FALSE){

				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'akun_rek'   	 	=> $this->input->post('rek1_kode'),
					'kelompok_rek'   	=> $this->input->post('rek2_kode'),
					'jenis_rek'   		=> $this->input->post('rek3_kode'),
					'obyek_rek'   		=> $this->input->post('rek4_kode'),
					'rincian_rek'    	=> $this->input->post('rek5_kode'),					
					'akun_debet'    	=> $this->input->post('debet1_kode'),
					'kelompok_debet'	=> $this->input->post('debet2_kode'),
					'jenis_debet'    	=> $this->input->post('debet3_kode'),
					'obyek_debet'    	=> $this->input->post('debet4_kode'),
					'rincian_debet'    	=> $this->input->post('debet5_kode'),					
					'akun_kredit'    	=> $this->input->post('kredit1_kode'),
					'kelompok_kredit'	=> $this->input->post('kredit2_kode'),
					'jenis_kredit'    	=> $this->input->post('kredit3_kode'),
					'obyek_kredit'    	=> $this->input->post('kredit4_kode'),
					'rincian_kredit'	=> $this->input->post('kredit5_kode'),
				);
           
				if($this->Korolari_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "REKENING KOROLARI" telah berhasil ditambahkan</div>');
				   redirect('parameter/korolari', 'refresh');
				}
			}
		}
    }
	
	public function edit() {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/korolari/edit';
			
			$this->form_validation->set_rules('ddd_kode','Obyek_nama','trim|xss_clean');       
			if($this->form_validation->run() == FALSE){	
			
				$container['this_task'] 					= $this->Rincian_model->get_task_data();
				
				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				
			$update['rincian_nama']	= $this->input->post('rrr_kode');
			$update['peraturan']	= $this->input->post('ppp_kode');
			
			$query = $this->Korolari_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN" telah berhasil diubah</div>');
			
			redirect('parameter/korolari', 'refresh');
			}
		}
    }
	
	public function delete() {
		if ($this->uri->segment(4)){
			$this->Korolari_model->delete($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN" telah berhasil dihapus</div>');
		} 
		redirect('parameter/rekening', 'refresh');
	}
	
	public function tampil_combobox_rek_by_kelompok(){
		$where_rek = 'kode IN (\'16\',\'21\',\'22\')';
		$akun_kode	= $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('kelompok.kode, kelompok.kelompok_nama', 'kelompok.kelompok_nama', '', '', '', $where_rek, array('kelompok.akun'=>$akun_kode));			
			echo '<label class="control-label col-md-2" for="hidden2">Kelompok:</label>';
			echo '<div class="col-md-10">';
				combobox('db', $data_kelompok, 'hidden2', 'kode', 'kelompok_nama', '', 'show_form_rek_by_jenis();', 'Pilih Kelompok ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="hidden2">Kelompok:</label>
				<div class="col-md-10"><select class="select2_category form-control" name="hidden2" id="hidden2" data-placeholder="Pilih Kelompok ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_debet_by_kelompok(){
		$where_rek = 'kode IN (\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\')';
		$akun_kode	= $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('kelompok.kode, kelompok.kelompok_nama', 'kelompok.kelompok_nama', '', '', '', $where_rek, array('kelompok.akun'=>$akun_kode));			
			echo '<label class="control-label col-md-2" for="hidden2">Kelompok:</label>';
			echo '<div class="col-md-10">';
				combobox('db', $data_kelompok, 'hidden2', 'kode', 'kelompok_nama', '', 'show_form_debet_by_jenis();', 'Pilih Kelompok ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="hidden2">Kelompok:</label>
				<div class="col-md-10"><select class="select2_category form-control" name="hidden2" id="hidden2" data-placeholder="Pilih Kelompok ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_kredit_by_kelompok(){
		$where_rek = 'kode IN (\'8\',\'9\',\'10\',\'11\',\'21\',\'22\')';
		$akun_kode	= $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('kelompok.kode, kelompok.kelompok_nama', 'kelompok.kelompok_nama', '', '', '', $where_rek, array('kelompok.akun'=>$akun_kode));			
			echo '<label class="control-label col-md-2" for="hidden2">Kelompok:</label>';
			echo '<div class="col-md-10">';
				combobox('db', $data_kelompok, 'hidden2', 'kode', 'kelompok_nama', '', 'show_form_kredit_by_jenis();', 'Pilih Kelompok ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="hidden2">Kelompok:</label>
				<div class="col-md-10"><select class="select2_category form-control" name="hidden2" id="hidden2" data-placeholder="Pilih Kelompok ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_rek_by_jenis(){
		$where_rek = 'kode IN (\'65\',\'78\',\'79\')';
		$kelompok_kode 	= $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('jenis.kode, jenis.jenis_nama', 'jenis.jenis_nama', '', '', '', $where_rek, array('jenis.kelompok'=>$kelompok_kode));
			echo '<label class="control-label col-md-2" for="hidden3">Jenis:</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_jenis, 'hidden3', 'kode', 'jenis_nama', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="hidden3">Jenis:</label>
				<div class="col-md-8"><select class="select2_category form-control" name="hidden3" id="hidden3" data-placeholder="Pilih Jenis ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_debet_by_jenis(){
		$where_rek = 'kode IN (\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\',\'8\',\'9\',\'10\',\'11\',\'12\',\'13\',\'14\',\'15\',\'16\',\'17\',\'18\',\'19\',\'20\',\'21\',\'22\',\'23\',\'24\',\'25\',\'26\',\'27\',\'28\',\'29\',\'30\')';
		$kelompok_kode 	= $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('jenis.kode, jenis.jenis_nama', 'jenis.jenis_nama', '', '', '', $where_rek, array('jenis.kelompok'=>$kelompok_kode));
			echo '<label class="control-label col-md-2" for="hidden3">Jenis:</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_jenis, 'hidden3', 'kode', 'jenis_nama', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="hidden3">Jenis:</label>
				<div class="col-md-8"><select class="select2_category form-control" name="hidden3" id="hidden3" data-placeholder="Pilih Jenis ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_kredit_by_jenis(){
		$where_rek = 'kode IN (\'31\',\'32\',\'33\',\'34\',\'35\',\'36\',\'37\',\'38\',\'39\',\'40\',\'41\',\'78\',\'79\')';
		$kelompok_kode 	= $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('jenis.kode, jenis.jenis_nama', 'jenis.jenis_nama', '', '', '', $where_rek, array('jenis.kelompok'=>$kelompok_kode));
			echo '<label class="control-label col-md-2" for="hidden3">Jenis:</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_jenis, 'hidden3', 'kode', 'jenis_nama', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="hidden3">Jenis:</label>
				<div class="col-md-8"><select class="select2_category form-control" name="hidden3" id="hidden3" data-placeholder="Pilih Jenis ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_jenis_by_obyek(){
		$jenis_kode = $this->uri->segment(4);
		if ($jenis_kode){
			$data_obyek = $this->Obyek_model->grid_all('obyek.kode, obyek.obyek_nama', 'obyek.obyek_nama', '', '', '', array('obyek.jenis'=>$jenis_kode));
			echo '<label class="control-label col-md-2" for="hidden4">Obyek:</label>';
			echo '<div class="col-md-10">';
				combobox('db', $data_obyek, 'hidden4', 'kode', 'obyek_nama', '', 'show_form_obyek_by_rincian();', 'Pilih Obyek ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="hidden4">Obyek:</label>
				<div class="col-md-10"><select class="select2_category form-control" name="hidden4" id="hidden4" data-placeholder="Pilih Kelompok ..." tabindex="1"></select></div>';
		}
	}
	
	public function tampil_combobox_obyek_by_rincian(){
		$obyek_kode = $this->uri->segment(4);
		if ($obyek_kode){
			$data_rincian = $this->Rincian_model->grid_all('rincian.kode, rincian.rincian_nama', 'rincian.rincian_nama', '', '', '', array('rincian.obyek'=>$obyek_kode));
			echo '<label class="control-label col-md-2" for="hidden5">Rincian: <input type="hidden" name="cek1" id="cek1" checked /></label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_rincian, 'hidden5', 'kode', 'rincian_nama', '', '', 'Pilih Rincian ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		} else {
			echo '<label class="control-label col-md-2" for="hidden5">Rincian:</label>
				<div class="col-md-8"><select class="select2_category form-control" name="hidden5" id="hidden5" data-placeholder="Pilih Jenis ..." tabindex="1"></select></div>';
		}
	}
	
}