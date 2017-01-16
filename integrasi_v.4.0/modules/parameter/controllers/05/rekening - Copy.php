<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekening extends CI_Controller {
	
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
			$container['content']['view']					= 'parameter/rekening/view';
			
			$container['akun'] 								= $this->Akun_model->get_list();
			
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
			$container['content']['view']					= 'parameter/rekening/kelompok';
			
			$container['akun'] 								= $this->Akun_model->get_akun($id);			
			$container['kelompok']							= $this->Kelompok_model->get_list($id);

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
			$container['content']['view']					= 'parameter/rekening/jenis';

			$container['kelompok']							= $this->Kelompok_model->get_kelompok($id);
			$container['jenis']								= $this->Jenis_model->get_list($id);
			$container['jenis_']							= $this->Jenis_model->get_task($id);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function book_add() {
		$data = array(		
			'kd_rek_1' 		=> $this->input->post('aaa_kode'),
			'kd_rek_2' 		=> $this->input->post('bbb_kode'),
			'no' 			=> $this->input->post('ccc_kode'),
			'saldo_normal'	=> $this->input->post('eee_kode'),
			'nm_rek_3'		=> $this->input->post('ddd_kode'),
			'status'		=> 2,
		);
		$insert = $this->Jenis_model->book_add($data);
			echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id) {
		$data = $this->Jenis_model->get_by_id($id);
			echo json_encode($data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function addj($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Kd_rek_1','trim|required|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kd_rek_2','trim|xss_clean');
        $this->form_validation->set_rules('ccc_kode','No','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','Nm_rek_3','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Saldo_normal','trim|xss_clean');
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/addj';			
		{
			if($this->form_validation->run() == FALSE){
				
			$container['kelompok']							= $this->Kelompok_model->get_kelompok($id);
			$container['jenis']								= $this->Jenis_model->get_list($id);
			$container['jenis_']							= $this->Jenis_model->get_task($id);

				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'kd_rek_1'		=> $this->input->post('aaa_kode'),
					'kd_rek_2'   	=> $this->input->post('bbb_kode'),
					'no'    	 	=> $this->input->post('ccc_kode'),
					'nm_rek_3'    	=> $this->input->post('ddd_kode'),
					'saldo_normal'  => $this->input->post('eee_kode'),
					'status' 		=> 2
				);
				$id_kode = $this->input->post('bbb_kode');				
				if($this->Jenis_model->insert($container)){
					$this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING JENIS" telah berhasil ditambahkan</div>');
				    redirect('parameter/rekening/jenis/'.$id_kode);
				}
			}
		}
    }
	
	public function editj($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$jenis 		= $this->Jenis_model->getOnly('kd_rek_2, status', array('kode'=>$kode));
			
			if ($jenis->status == 2) {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/editj';
			
				$where_saldo								= 'kode IN (\'1\',\'22\')';			
				$container['content']['dataset']['saldo']	= $this->Jenis_model->grid_all('saldo_normal, saldo_normal', 'saldo_normal', 'ASC', '', '', $where_saldo, '', 'ms_rek_3.kode');
				
				$jenis = $this->Jenis_model->get('ms_rek_3.*', array('ms_rek_3.kode'=>$this->uri->segment(4)));		
				$container['content']['dataset']['kode']		= $jenis->kode;
				$container['content']['dataset']['saldo_']		= $jenis->saldo_normal;
				$container['content']['dataset']['no']			= $jenis->no;
				$container['content']['dataset']['nama']		= $jenis->nm_rek_3;
				$container['content']['dataset']['kelompok']	= $jenis->kd_rek_2;
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');	
			} else if ($jenis->status == 1) {
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
				redirect('parameter/rekening/jenis/'.$jenis->kd_rek_2.'/#warningEdit', 'refresh');
			}
		}
	}
	
	public function ubahj($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$kode 		= $this->uri->segment(4);
		$jenis 		= $this->Jenis_model->getOnly('kd_rek_2', array('kode'=>$kode)); {			
			$this->form_validation->set_rules('ddd_kode','Nm_rek_3','trim|xss_clean');       
			$this->form_validation->set_rules('eee_kode','Saldo_normal','trim|xss_clean');       
			if($this->form_validation->run() == FALSE){	
			
				$where_saldo								= 'kode IN (\'1\',\'22\')';			
				$container['content']['dataset']['saldo']	= $this->Jenis_model->grid_all('saldo_normal, saldo_normal', 'saldo_normal', 'ASC', '', '', $where_saldo, '', 'ms_rek_3.kode');
				
				$jenis = $this->Jenis_model->get('ms_rek_3.*', array('ms_rek_3.kode'=>$this->uri->segment(4)));		
				$container['content']['dataset']['kode']		= $jenis->kode;
				$container['content']['dataset']['saldo_']		= $jenis->saldo_normal;
				$container['content']['dataset']['no']			= $jenis->no;
				$container['content']['dataset']['nama']		= $jenis->nm_rek_3;
				$container['content']['dataset']['kelompok']	= $jenis->kd_rek_2;
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {				
			$update['nm_rek_3']		= $this->input->post('ddd_kode');
			$update['saldo_normal']	= $this->input->post('eee_kode');
			$kelompok				= $this->input->post('kelompok');
			$query = $this->Jenis_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING JENIS" telah berhasil diubah</div>');
			redirect('parameter/rekening/jenis/'.$kelompok, 'refresh');
			}
		}
    }
	
	public function obyek($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/obyek';
			
			$container['jenis']								= $this->Jenis_model->get_jenis($id);
			$container['obyek']								= $this->Obyek_model->get_list($id);
			$container['obyek_']							= $this->Obyek_model->get_task($id);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function addo($id) {
		$admin_log 	= $this->auth->is_login_admin();
		$this->form_validation->set_rules('aaa_kode','Kd_rek_1','trim|required|xss_clean');
        $this->form_validation->set_rules('bbb_kode','Kd_rek_2','trim|xss_clean');
		$this->form_validation->set_rules('ccc_kode','Kd_rek_3','trim|xss_clean');
        $this->form_validation->set_rules('ddd_kode','No','trim|xss_clean');
        $this->form_validation->set_rules('eee_kode','Nm_rek_4','trim|xss_clean');        
		
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/addo';			
		{
			if($this->form_validation->run() == FALSE){
				
			$container['jenis']								= $this->Jenis_model->get_jenis($id);
			$container['obyek']								= $this->Obyek_model->get_list($id);
			$container['obyek_']							= $this->Obyek_model->get_task($id);

				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'kd_rek_1'		=> $this->input->post('aaa_kode'),
					'kd_rek_2'   	=> $this->input->post('bbb_kode'),
					'kd_rek_3'    	=> $this->input->post('ccc_kode'),
					'no'    	 	=> $this->input->post('ddd_kode'),
					'nm_rek_4'    	=> $this->input->post('eee_kode'),
					'status' 		=> 2
				);
				$id_kode = $this->input->post('ccc_kode');
				if($this->Obyek_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING OBYEK" telah berhasil ditambahkan</div>');
				   redirect('parameter/rekening/obyek/'.$id_kode);
				}
			}
		}
    }
	
	public function edito($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$obyek 		= $this->Obyek_model->getOnly('kd_rek_3, status', array('kode'=>$kode));
			
			if ($obyek->status == 2) {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/edito';
				
				$obyek = $this->Obyek_model->get('ms_rek_4.*', array('ms_rek_4.kode'=>$this->uri->segment(4)));		
				$container['content']['dataset']['kode']	= $obyek->kode;
				$container['content']['dataset']['no']		= $obyek->no;
				$container['content']['dataset']['nama']	= $obyek->nm_rek_4;
				$container['content']['dataset']['jenis']	= $obyek->kd_rek_3;
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');	
			} else if ($obyek->status == 1) {
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
				redirect('parameter/rekening/obyek/'.$obyek->kd_rek_3.'/#warningEdit', 'refresh');
			}
		}
	}
	
	public function ubaho($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
		$kode 		= $this->uri->segment(4);
		$obyek 		= $this->Obyek_model->getOnly('kd_rek_3, status', array('kode'=>$kode));
			$this->form_validation->set_rules('ddd_kode','Nm_rek_4','trim|xss_clean');       
			if($this->form_validation->run() == FALSE){		
			
				$obyek = $this->Obyek_model->get('ms_rek_4.*', array('ms_rek_4.kode'=>$this->uri->segment(4)));		
				$container['content']['dataset']['kode']	= $obyek->kode;
				$container['content']['dataset']['no']		= $obyek->no;
				$container['content']['dataset']['nama']	= $obyek->nm_rek_4;
				$container['content']['dataset']['jenis']	= $obyek->kd_rek_3;
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				
			$update['nm_rek_4']	= $this->input->post('ddd_kode');
			$jenis				= $this->input->post('jenis');
			$query = $this->Obyek_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING OBYEK" telah berhasil diubah</div>');
			redirect('parameter/rekening/obyek/'.$jenis, 'refresh');
			}
		}
    }
	
	public function rincian($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/rincian';
			
			$container['obyek'] 							= $this->Obyek_model->get_obyek($id);
			$container['rincian']							= $this->Rincian_model->get_list($id);
			$container['rincian_']							= $this->Rincian_model->get_task($id);

			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
    }
	
	public function addr($id) {
		$admin_log 	= $this->auth->is_login_admin();
        $this->form_validation->set_rules('eee_kode','No','trim|xss_clean');
        $this->form_validation->set_rules('rrr_kode','Rincian nama','trim|xss_clean');
        $this->form_validation->set_rules('ppp_kode','Peraturan','trim|xss_clean');
        
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/addr';			
		{
			if($this->form_validation->run() == FALSE){
				
			$container['obyek'] 							= $this->Obyek_model->get_obyek($id);
			$container['rincian']							= $this->Rincian_model->get_list($id);
			$container['rincian_']							= $this->Rincian_model->get_task($id);
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				$container = array(             
					'kd_rek_1'   	=> $this->input->post('aaa_kode'),
					'kd_rek_2'   	=> $this->input->post('bbb_kode'),
					'kd_rek_3'   	=> $this->input->post('ccc_kode'),
					'kd_rek_4'   	=> $this->input->post('ddd_kode'),
					'no'    	 	=> $this->input->post('eee_kode'),
					'nm_rek_5'  	=> $this->input->post('rrr_kode'),
					'peraturan'    	=> $this->input->post('ppp_kode'),
					'status'		=> 2
				);
				$id_kode = $this->input->post('ddd_kode');
				if($this->Rincian_model->insert($container)){
				   $this->session->set_flashdata('success','<div class="alert fresh-color alert-info fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING RINCIAN" telah berhasil ditambahkan</div>');
				   redirect('parameter/rekening/rincian/'.$id_kode);
				}
			}
		}
    }
	
	public function editr($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$rincian 	= $this->Rincian_model->getOnly('kd_rek_4, status', array('kode'=>$kode));
			
			if ($rincian->status == 2) {
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/rekening/editr';
				
				$rincian = $this->Rincian_model->get('ms_rek_5.*', array('ms_rek_5.kode'=>$this->uri->segment(4)));		
				$container['content']['dataset']['kode']	= $rincian->kode;
				$container['content']['dataset']['no']		= $rincian->no;
				$container['content']['dataset']['nama']	= $rincian->nm_rek_5;
				$container['content']['dataset']['peraturan']= $rincian->peraturan;
				$container['content']['dataset']['obyek']	= $rincian->kd_rek_4;
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');	
			} else if ($rincian->status == 1) {
				$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
				redirect('parameter/rekening/rincian/'.$rincian->kd_rek_4.'/#warningEdit', 'refresh');
			}
		}
	}
	
	public function ubahr($id) {
		$admin_log 	= $this->auth->is_login_admin(); {
		$kode 		= $this->uri->segment(4);
		$rincian 	= $this->Rincian_model->getOnly('kd_rek_4, status', array('kode'=>$kode));
			$this->form_validation->set_rules('ddd_kode','Nm_rek_5','trim|xss_clean');
			$this->form_validation->set_rules('ppp_kode','Peraturan','trim|xss_clean');
			if($this->form_validation->run() == FALSE){	
			
				$rincian = $this->Rincian_model->get('ms_rek_5.*', array('ms_rek_5.kode'=>$this->uri->segment(4)));		
				$container['content']['dataset']['kode']	= $rincian->kode;
				
				$header['admin_log']						= $admin_log;
				$this->load->view('admin/head');
				$this->load->view('admin/header', $header);
				$this->load->view('admin/container', $container);
				$this->load->view('admin/footer');			
			} else {
				
			$update['nm_rek_5']		= $this->input->post('ddd_kode');
			$update['peraturan']	= $this->input->post('ppp_kode');
			$obyek					= $this->input->post('obyek');
			$query = $this->Rincian_model->update($update, $this->input->post('kode'));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-warning fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING RINCIAN" telah berhasil diubah</div>');
			redirect('parameter/rekening/rincian/'.$obyek, 'refresh');
			}
		}
    }
	
	public function delete() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$jenis 		= $this->Jenis_model->getOnly('kd_rek_2, status', array('kode'=>$kode));
		if ($jenis->status == 2) {
			$this->Jenis_model->delete($this->uri->segment(4));
			$this->Jenis_model->delete1($this->uri->segment(4));
			$this->Jenis_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING JENIS" telah berhasil dihapus</div>');
		} else {
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
			redirect('parameter/rekening/jenis/'.$jenis->kd_rek_2.'/#warningHapus', 'refresh');
			}
			redirect('parameter/rekening/jenis/'.$jenis->kd_rek_2, 'refresh');
		}
	}
	
	public function deleteo() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$obyek 		= $this->Obyek_model->getOnly('kd_rek_3, status', array('kode'=>$kode));
		if ($obyek->status == 2) {
			$this->Obyek_model->delete1($this->uri->segment(4));
			$this->Obyek_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING OBYEK" telah berhasil dihapus</div>');
		} else {
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
			redirect('parameter/rekening/obyek/'.$obyek->kd_rek_3.'/#warningHapus', 'refresh');
			}
			redirect('parameter/rekening/obyek/'.$obyek->kd_rek_3, 'refresh');
		}
	}
	
	public function deleter() {
		$admin_log 	= $this->auth->is_login_admin(); {
			$kode 		= $this->uri->segment(4);
			$rincian	= $this->Rincian_model->getOnly('kd_rek_4, status', array('kode'=>$kode));
		if ($rincian->status == 2) {
			$this->Rincian_model->delete2($this->uri->segment(4));
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data "KODE REKENING RINCIAN" telah berhasil dihapus</div>');
		} else {
			$this->session->set_flashdata('success','<div class="alert fresh-color alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Warning!</strong> Data "PERMANENT"</div>');
			redirect('parameter/rekening/rincian/'.$rincian->kd_rek_4.'/#warningHapus', 'refresh');
			}
			redirect('parameter/rekening/rincian/'.$rincian->kd_rek_4, 'refresh');
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