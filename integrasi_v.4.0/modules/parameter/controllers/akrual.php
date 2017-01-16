<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akrual extends CI_Controller {
	
	public function __construct() {
		parent::__construct();	
		$this->load->model('Akun_akrual_model');	
		$this->load->model('Kelompok_akrual_model');
		$this->load->model('Jenis_akrual_model');
		$this->load->model('Obyek_akrual_model');
		$this->load->model('Rincian_akrual_model');
		$this->load->library('Datatables');
	}
	
	public function index()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/view';
			
			$container['akun'] 								= $this->Akun_akrual_model->get_list();
			
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
			
			$container['akun'] 								= $this->Akun_akrual_model->get_akun($id);			
			$container['kelompok']							= $this->Kelompok_akrual_model->get_list($id);

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
			
			$where_saldo									= 'kode IN (\'1\',\'2\')';
			$container['content']['dataset']['saldo']		= $this->Jenis_akrual_model->grid_all('saldo_normal, saldo_normal', 'saldo_normal', 'ASC', '', '', $where_saldo, '', 'ms_akrual_3.kode');

			$container['kelompok']							= $this->Kelompok_akrual_model->get_kelompok($id);
			$container['jenis']								= $this->Jenis_akrual_model->get_list($id);
			$container['jenis_']							= $this->Jenis_akrual_model->get_task($id);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function ajax_jenis($id) {
		$data = $this->Jenis_akrual_model->get_by_id($id);
			echo json_encode($data);
	}
	
	public function addj($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Kd_akrual_1','trim|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kd_akrual_2','trim|xss_clean');
        $this->form_validation->set_rules('ccc_kode','Kd_akrual_3','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','Nm_akrual_3','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Saldo_normal','trim|xss_clean');
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/addj';			
		{
			if($this->form_validation->run() == FALSE){
				
			} else {
				$container = array(             
					'kd_akrual_1'	=> $this->input->post('aaa_kode'),
					'kd_akrual_2'   => $this->input->post('bbb_kode'),
					'kd_akrual_3'   => $this->input->post('ccc_kode'),
					'nm_akrual_3'   => $this->input->post('ddd_kode'),
					'saldo_normal'  => $this->input->post('eee_kode'),
					'status' 		=> 2
				);
				$id_kode = $this->input->post('bbb_kode');				
				if($this->Jenis_akrual_model->insert($container)){
					$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING AKRUAL JENIS" telah berhasil ditambahkan</div>');
				    redirect('parameter/akrual/jenis/'.$id_kode);
				}
			}
		}
    }
	
	public function editj($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$this->form_validation->set_rules('ddd_kode','Nm_akrual_3','trim|xss_clean');
			$this->form_validation->set_rules('eee_kode1','Saldo_normal','trim|xss_clean');
			$status					= $this->input->post('status');			
			$kelompok				= $this->input->post('kelompok');
			if ($status == 2) {
			if($this->form_validation->run() == FALSE){	

			} else {
			$update['nm_akrual_3']	= $this->input->post('ddd_kode');
			$update['saldo_normal']	= $this->input->post('eee_kode1');
				$query = $this->Jenis_akrual_model->update($update, $this->input->post('kode'));
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING AKRUAL JENIS" telah berhasil diubah</div>');
				redirect('parameter/akrual/jenis/'.$kelompok, 'refresh'); }
			
			} else if ($status == 1) {
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
				redirect('parameter/akrual/jenis/'.$kelompok.'/#warningEdit', 'refresh');
			}
		}
    }
	
	public function obyek($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/obyek';
			
			$container['jenis']								= $this->Jenis_akrual_model->get_jenis($id);
			$container['obyek']								= $this->Obyek_akrual_model->get_list($id);
			$container['obyek_']							= $this->Obyek_akrual_model->get_task($id);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function ajax_obyek($id) {
		$data = $this->Obyek_akrual_model->get_by_id($id);
			echo json_encode($data);
	}
	
	public function addo($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Kd_akrual_1','trim|required|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kd_akrual_2','trim|xss_clean');
		$this->form_validation->set_rules('ccc_kode','Kd_akrual_3','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','Kd_akrual_4','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Nm_akrual_4','trim|xss_clean');        
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/addo';			
		{
			if($this->form_validation->run() == FALSE){
						
			} else {
				$container = array(             
					'kd_akrual_1'	=> $this->input->post('aaa_kode'),
					'kd_akrual_2'  	=> $this->input->post('bbb_kode'),
					'kd_akrual_3'  	=> $this->input->post('ccc_kode'),
					'kd_akrual_4'   => $this->input->post('ddd_kode'),
					'nm_akrual_4'  	=> $this->input->post('eee_kode'),
					'status' 		=> 2
				);
				$id_kode = $this->input->post('ccc_kode');
				if($this->Obyek_akrual_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING AKRUAL OBYEK" telah berhasil ditambahkan</div>');
				   redirect('parameter/akrual/obyek/'.$id_kode);
				}
			}
		}
    }
	
	public function edito($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$this->form_validation->set_rules('eee_kode','Nm_akrual_4','trim|xss_clean');
			$status					= $this->input->post('status');	
			$jenis					= $this->input->post('jenis');

			if ($status == 2) {
			if($this->form_validation->run() == FALSE){		

			} else {
			$update['nm_akrual_4']	= $this->input->post('eee_kode');
				$query = $this->Obyek_akrual_model->update($update, $this->input->post('kode'));
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING AKRUAL OBYEK" telah berhasil diubah</div>');
				redirect('parameter/akrual/obyek/'.$jenis, 'refresh'); }
				
			} else if ($status == 1) {
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
				redirect('parameter/akrual/obyek/'.$jenis.'/#warningEdit', 'refresh');
			}
		}
    }
	
	public function rincian($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/rincian';
			
			$container['obyek'] 							= $this->Obyek_akrual_model->get_obyek($id);
			$container['rincian']							= $this->Rincian_akrual_model->get_list($id);
			$container['rincian_']							= $this->Rincian_akrual_model->get_task($id);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function ajax_rincian($id) {
		$data = $this->Rincian_akrual_model->get_by_id($id);
			echo json_encode($data);
	}
	
	public function addr($id) {
		$admin_log 	= $this->auth->is_login_admin();
        $this->form_validation->set_rules('aaa_kode','Kd_akrual_1','trim|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kd_akrual_2','trim|xss_clean');
        $this->form_validation->set_rules('ccc_kode','Kd_akrual_3','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','Kd_akrual_4','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Kd_akrual_5','trim|xss_clean');
        $this->form_validation->set_rules('rrr_kode','Nm_akrual_5','trim|xss_clean');
        $this->form_validation->set_rules('ppp_kode','Peraturan','trim|xss_clean');
        
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/akrual/addr';			
		{
			if($this->form_validation->run() == FALSE){
					
			} else {
				$container = array(             
					'kd_akrual_1'   => $this->input->post('aaa_kode'),
					'kd_akrual_2'   => $this->input->post('bbb_kode'),
					'kd_akrual_3'   => $this->input->post('ccc_kode'),
					'kd_akrual_4'   => $this->input->post('ddd_kode'),
					'kd_akrual_5'   => $this->input->post('eee_kode'),
					'nm_akrual_5'  	=> $this->input->post('rrr_kode'),
					'peraturan'    	=> $this->input->post('ppp_kode'),
					'status'		=> 2
				);
				$id_kode = $this->input->post('ddd_kode');
				if($this->Rincian_akrual_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING AKRUAL RINCIAN" telah berhasil ditambahkan</div>');
				   redirect('parameter/akrual/rincian/'.$id_kode);
				}
			}
		}
    }
	
	public function editr($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$this->form_validation->set_rules('eee_kode','Nm_akrual_5','trim|xss_clean');
			$this->form_validation->set_rules('ppp_kode','Peraturan','trim|xss_clean');
			$status					= $this->input->post('status');
			$obyek					= $this->input->post('obyek');

			if ($status == 2) {
			if($this->form_validation->run() == FALSE){

			} else {				
			$update['nm_akrual_5']	= $this->input->post('eee_kode');
			$update['peraturan']	= $this->input->post('ppp_kode');
				$query = $this->Rincian_akrual_model->update($update, $this->input->post('kode'));
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING AKRUAL RINCIAN" telah berhasil diubah</div>');
				redirect('parameter/akrual/rincian/'.$obyek, 'refresh'); }
			
			} else if ($status == 1) {
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
				redirect('parameter/akrual/rincian/'.$obyek.'/#warningEdit', 'refresh');
			}
		}
    }
	
	public function delete() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$jenis 		= $this->Jenis_akrual_model->getOnly('kd_akrual_2, status', array('kode'=>$kode));
		if ($jenis->status == 2) {
			$this->Jenis_akrual_model->delete($this->uri->segment(4));
			$this->Jenis_akrual_model->delete1($this->uri->segment(4));
			$this->Jenis_akrual_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING AKRUAL JENIS" telah berhasil dihapus</div>');
		} else {
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
			redirect('parameter/akrual/jenis/'.$jenis->kd_akrual_2.'/#warningHapus', 'refresh');
			}
			redirect('parameter/akrual/jenis/'.$jenis->kd_akrual_2, 'refresh');
		}
	}
	
	public function deleteo() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$obyek 		= $this->Obyek_akrual_model->getOnly('kd_akrual_3, status', array('kode'=>$kode));
		if ($obyek->status == 2) {
			$this->Obyek_akrual_model->delete1($this->uri->segment(4));
			$this->Obyek_akrual_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING AKRUAL OBYEK" telah berhasil dihapus</div>');
		} else {
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
			redirect('parameter/akrual/obyek/'.$obyek->kd_akrual_3.'/#warningHapus', 'refresh');
			}
			redirect('parameter/akrual/obyek/'.$obyek->kd_akrual_3, 'refresh');
		}
	}
	
	public function deleter() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$rincian	= $this->Rincian_akrual_model->getOnly('kd_akrual_4, status', array('kode'=>$kode));
		if ($rincian->status == 2) {
			$this->Rincian_akrual_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING AKRUAL RINCIAN" telah berhasil dihapus</div>');
		} else {
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
			redirect('parameter/akrual/rincian/'.$rincian->kd_akrual_4.'/#warningHapus', 'refresh');
			}
			redirect('parameter/akrual/rincian/'.$rincian->kd_akrual_4, 'refresh');
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