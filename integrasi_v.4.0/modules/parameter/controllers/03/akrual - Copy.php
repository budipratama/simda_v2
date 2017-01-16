<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akrual extends CI_Controller {
	
	public function __construct() {
		parent::__construct();	
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
			$container['content']['view']					= 'parameter/akrual/view';
			
			$container['akun'] 		= $this->Akun_model->get_akrual();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	public function kelompok($id) {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/kelompok';
			
			$container['akun']			= $this->Akun_model->get_list($id);			
			$container['completed']		= $this->Kelompok_model->get_list_tasks($id,true);
			$container['uncompleted'] 	= $this->Kelompok_model->get_list_tasks($id,false);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function jenis($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/jenis';					

			$container['kelompok'] 		= $this->Kelompok_model->get_list($id);
			$container['list'] 			= $this->Jenis_model->get_list($id);
			$container['completed']		= $this->Jenis_model->get_list_tasks($id,true);
			$container['uncompleted'] 	= $this->Jenis_model->get_list_tasks($id,false);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function addj($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Akun','trim|required|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kelompok','trim|xss_clean');
        $this->form_validation->set_rules('ccc_kode','No','trim|xss_clean');
        $this->form_validation->set_rules('fff_kode','Nomor','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','Jenis_nama','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Saldo_normal','trim|xss_clean');
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/addj';			
		{
			if($this->form_validation->run() == FALSE){
				
				$where_saldo								= 'tipe_sort IN (\'3\',\'4\')';
				$container['kelompok'] 						= $this->Kelompok_model->get_task($id);
				$container['jenis']							= $this->Jenis_model->uncompleted($id,true);
				$container['kode'] 							= $this->Jenis_model->get_task_data($id);
				$container['content']['dataset']['saldo']	= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);

				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'akun'   	 	=> $this->input->post('aaa_kode'),
					'kelompok'   	=> $this->input->post('bbb_kode'),
					'no'    	 	=> $this->input->post('ccc_kode'),
					'nomor'    	 	=> $this->input->post('fff_kode'),
					'jenis_nama'    => $this->input->post('ddd_kode'),
					'saldo_normal'  => $this->input->post('eee_kode'),
					'akun_sort'  	=> 2,
					'status'  		=> 1
				);
				$id_kode	= $this->input->post('bbb_kode');
				if($this->Jenis_model->insert($container)){
					$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "JENIS" telah berhasil ditambahkan</div>');
				    redirect('parameter/akrual/jenis/'.$id_kode, 'refresh');
				}
			}
		}
    }
	
	public function editj($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$jenis 		= $this->Jenis_model->getOnly('akun_sort, kelompok, status', array('kode'=>$kode));		
			
			if ($jenis->status == 1) {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/editj';
				
				$where_saldo								= 'tipe_sort IN (\'3\',\'4\')';
				$container['list_id'] 						= $this->Rincian_model->get_task_list_id($task_id);
				$container['this_task'] 					= $this->Jenis_model->get_task_data($id);				
				$container['content']['dataset']['saldo']	= $this->Tipe_model->grid_all('tipe_kode, tipe_nama', 'tipe_nama', '', '', '', $where_saldo);
				
				$jenis = $this->Jenis_model->get('jenis.*', array('jenis.kode'=>$this->uri->segment(4)));		
				$container['content']['dataset']['kode']		= $jenis->kode;
				$container['content']['dataset']['saldo_']		= $jenis->saldo_normal;
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');	
			} else {
				$this->session->set_flashdata('success','
				<div class="alert fresh-color alert-warning fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
				<strong>Warning!</strong> Data "PERMANENT"</div>');
				redirect('parameter/akrual/jenis/'.$jenis->kelompok.'/#warningEdit', 'refresh');
			}
		}
	}
	
	public function obyek($id) {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/obyek';
			
			$container['jenis'] 		= $this->Jenis_model->get_list($id);
			$container['completed']		= $this->Obyek_model->get_list_tasks($id,true);
			$container['uncompleted']	= $this->Obyek_model->get_list_tasks($id,false);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function addo($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Akun','trim|required|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kelompok','trim|xss_clean');
		$this->form_validation->set_rules('ccc_kode','Jenis','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','No','trim|xss_clean');
        $this->form_validation->set_rules('fff_kode','Nomor','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Obyek_nama','trim|xss_clean');
        
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/addo';			
		{
			if($this->form_validation->run() == FALSE){
				
				$container['jenis'] 						= $this->Jenis_model->get_task($id);
				$container['obyek']							= $this->Obyek_model->uncompleted($id,true);
				$container['kode'] 							= $this->Obyek_model->get_task_data($id);

				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'akun'   	 	=> $this->input->post('aaa_kode'),
					'kelompok'   	=> $this->input->post('bbb_kode'),
					'jenis'   		=> $this->input->post('ccc_kode'),					
					'no'    	 	=> $this->input->post('ddd_kode'),
					'nomor'    	 	=> $this->input->post('fff_kode'),
					'obyek_nama'    => $this->input->post('eee_kode'),
					'akun_sort'  	=> 2
				);
           
				if($this->Obyek_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "OBYEK" telah berhasil ditambahkan</div>');
				   redirect('parameter/akrual', 'refresh');
				}
			}
		}
    }
	
	public function edito($id) {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/edito';
			
			$this->form_validation->set_rules('ddd_kode','Obyek_nama','trim|xss_clean');       
			if($this->form_validation->run() == FALSE){	
			
				$container['this_task'] 					= $this->Obyek_model->get_task_data($id);
				
				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				
			$update['obyek_nama']	= $this->input->post('ddd_kode');
			
			$query = $this->Obyek_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "OBYEK" telah berhasil diubah</div>');
			
			redirect('parameter/akrual', 'refresh');
			}
		}
    }
	
	public function rincian($id){
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/rincian';
			
			$container['obyek'] 			= $this->Obyek_model->get_list($id);
			$container['list'] 				= $this->Rincian_model->get_list($id);
			$container['completed']			= $this->Rincian_model->get_list_tasks($id,true);
			$container['uncompleted']		= $this->Rincian_model->get_list_tasks($id,false);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function addr($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Akun','trim|required|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kelompok','trim|xss_clean');
		$this->form_validation->set_rules('ccc_kode','Jenis','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','No','trim|xss_clean');
        $this->form_validation->set_rules('fff_kode','Nomor','trim|xss_clean');
        $this->form_validation->set_rules('rrr_kode','Rincian_nama','trim|xss_clean');
        $this->form_validation->set_rules('ppp_kode','Peraturan','trim|xss_clean');
        
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/addr';			
		{
			if($this->form_validation->run() == FALSE){
				
				$container['obyek'] 						= $this->Obyek_model->completed($id);
				$container['rincian']						= $this->Rincian_model->uncompleted($id,true);
				$container['kode'] 							= $this->Rincian_model->get_task_data($id);

				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'akun'   	 	=> $this->input->post('aaa_kode'),
					'kelompok'   	=> $this->input->post('bbb_kode'),
					'jenis'   		=> $this->input->post('ccc_kode'),
					'obyek'   		=> $this->input->post('ddd_kode'),
					'no'    	 	=> $this->input->post('eee_kode'),
					'nomor'    	 	=> $this->input->post('fff_kode'),
					'rincian_nama'  => $this->input->post('rrr_kode'),
					'peraturan'    	=> $this->input->post('ppp_kode'),
					'akun_sort'  	=> 2
				);
           
				if($this->Rincian_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN" telah berhasil ditambahkan</div>');
				   redirect('parameter/akrual', 'refresh');
				}
			}
		}
    }
	
	public function editr($id) {
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/editr';
			
			$this->form_validation->set_rules('ddd_kode','Obyek_nama','trim|xss_clean');       
			if($this->form_validation->run() == FALSE){	
			
				$container['this_task'] 					= $this->Rincian_model->get_task_data($id);
				
				$header['admin_log']			= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				
			$update['rincian_nama']	= $this->input->post('rrr_kode');
			$update['peraturan']	= $this->input->post('ppp_kode');
			
			$query = $this->Rincian_model->update($update, $this->input->post('kode'));

			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "RINCIAN" telah berhasil diubah</div>');
			
			redirect('parameter/akrual', 'refresh');
			}
		}
    }
	
	public function delete() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$jenis 		= $this->Jenis_model->getOnly('akun_sort, kelompok, status', array('kode'=>$kode));
		if ($jenis->status == 1) {
			$this->Jenis_model->delete($this->uri->segment(4));
			$this->Jenis_model->delete1($this->uri->segment(4));
			$this->Jenis_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING JENIS" telah berhasil dihapus</div>');
		} else {
			$this->session->set_flashdata('success','
				<div class="alert fresh-color alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
				<strong>Warning!</strong> Data "PERMANENT"</div>');
			redirect('parameter/akrual/jenis/'.$jenis->kelompok.'/#warningHapus', 'refresh');
			}
			redirect('parameter/akrual/jenis/'.$jenis->kelompok, 'refresh');
		}
	}
	
	public function deleteo() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$obyek 		= $this->Obyek_model->getOnly('akun_sort, jenis, status', array('kode'=>$kode));
		if ($obyek->status == 1) {
			$this->Obyek_model->delete1($this->uri->segment(4));
			$this->Obyek_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING OBYEK" telah berhasil dihapus</div>');
		} else {
			redirect('parameter/akrual/obyek/'.$obyek->jenis.'/#warningHapus', 'refresh');
			}
			redirect('parameter/akrual/obyek/'.$obyek->jenis, 'refresh');
		}
	}
	
	public function deleter() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$rincian	= $this->Rincian_model->getOnly('akun_sort, obyek, status', array('kode'=>$kode));
		if ($rincian->status == 1) {
			$this->Rincian_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING RINCIAN" telah berhasil dihapus</div>');
		} else {				
			redirect('parameter/akrual/rincian/'.$rincian->obyek.'/#warningHapus', 'refresh');
			}
			redirect('parameter/akrual/rincian/'.$rincian->obyek, 'refresh');
		}
	}
	
	public function tampil_combobox_akun_by_kelompok(){
		$akun_kode = $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_all('kelompok.kode, kelompok.kelompok_nama', 'kelompok.kelompok_nama', '', '', '', array('kelompok.akun'=>$akun_kode));			
			echo '<label class="control-label col-md-3" for="bbb_kode">Kelompok :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'kelompok_nama', '', 'show_form_kelompok_by_jenis();', 'Pilih Kelompok ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_kelompok_by_jenis(){
		$kelompok_kode = $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('jenis.kode, jenis.jenis_nama', 'jenis.jenis_nama', '', '', '', array('jenis.kelompok'=>$kelompok_kode));
			echo '<label class="control-label col-md-3" for="ccc_kode">Jenis :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_jenis, 'ccc_kode', 'kode', 'jenis_nama', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_jenis_by_obyek(){
		$jenis_kode = $this->uri->segment(4);
		if ($jenis_kode){
			$data_obyek = $this->Obyek_model->grid_all('obyek.kode, obyek.obyek_nama', 'obyek.obyek_nama', '', '', '', array('obyek.jenis'=>$jenis_kode));
			echo '<label class="control-label col-md-3" for="ddd_kode">Obyek :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_obyek, 'ddd_kode', 'kode', 'obyek_nama', '', 'show_form_obyek_by_rincian();', 'Pilih Obyek ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_obyek_by_rincian(){
		$obyek_kode = $this->uri->segment(4);
		if ($obyek_kode){
			$data_rincian = $this->Rincian_model->grid_all('rincian.kode, rincian.rincian_nama', 'rincian.rincian_nama', '', '', '', array('rincian.obyek'=>$obyek_kode));
			echo '<label class="control-label col-md-3" for="ddd_kode">Rincian Obyek :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_rincian, 'eee_kode', 'kode', 'rincian_nama', '', '', 'Pilih Rincian Obyek ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_akun_by_jenis(){
		$akun_kode = $this->uri->segment(4);
		if ($akun_kode){
			$data_kelompok = $this->Kelompok_model->grid_alli('kelompok_.kode, kelompok_.kelompok_nama', 'kelompok_.kelompok_nama', '', '', '', array('kelompok_.akun'=>$akun_kode));			
			echo '<label class="control-label col-md-3" for="bbb_kode">Kelompok :</label>';
			echo '<div class="col-md-8">';
				combobox('db', $data_kelompok, 'bbb_kode', 'kode', 'kelompok_nama', '', 'show_form_jenis_by_kode();', 'Pilih Kelompok ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
	public function tampil_combobox_jenis_by_kode(){
		$kelompok_kode = $this->uri->segment(4);
		if ($kelompok_kode){
			$data_jenis = $this->Jenis_model->grid_all('jenis.no, jenis.jenis_nama', 'jenis.jenis_nama', '', '', '', array('jenis.kelompok'=>$kelompok_kode, 'akun_sort'=>2));			
			echo '<label class="control-label col-md-3" for="ccc_kode">Data Jenis</label>';
			echo '<div class="col-md-8">';
				listbox('db', $data_jenis, 'ccc_kode', 'no', 'jenis_nama', '', 'show_form_jenis_by_obyek();', 'Pilih Jenis ...', 'class="select2_category form-control" required="required"');
			echo '</div>';
		}
	}
	
}