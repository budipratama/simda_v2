<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Admin_Level_model');
		$this->load->model('Skpd_model');
		$this->load->library('Datatables');
	}
	
	function datatable()
    {
        $this->datatables->select('nomor, admin_user, admin_nama, admin_level_nama')
		->add_column('Actions', get_buttons('$1'),'admin_user')
		->search_column('admin_user, admin_nama, admin_level_nama')
        ->from('(SELECT @ROW_NUMBER  := @ROW_NUMBER + 1 as nomor, admin_user, admin_nama, admin_level.admin_level_nama FROM (SELECT @ROW_NUMBER := 0) ROWNUMBER, admin LEFT JOIN admin_level ON admin.admin_level_kode=admin_level.admin_level_kode WHERE admin_status = \'A\' AND admin_user != \'dika\' ORDER BY admin_user ASC) admin');
        
        echo $this->datatables->generate();
    }
		
	public function index()
	{	
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/pengguna/view';
		$container['content']['dataset']				= '';
		$header['admin_log']							= $admin_log;
		
		$container['content']['dataset']['grid']		= $this->Admin_model->grid_all('admin.*, admin_level.admin_level_nama', 'admin_user', 'ASC', '', '', array('admin_status'=>'A', 'admin_user !='=>'dika'));
		
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
		$container['content']['view']					= 'pengaturan/pengguna/add';
		$container['content']['dataset']['admin_level']	= $this->Admin_Level_model->grid_all('admin_level_kode, admin_level_nama', 'admin_level_nama', 'ASC', '', '', array('admin_level_status'=>'A'));
		
		$header['admin_log']							= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function insert()
	{
		$admin_log = $this->auth->is_login_admin();

		$this->form_validation->set_rules('admin_user', 'Username', 'trim|required|xss_clean|callback_check_insert');
		$this->form_validation->set_rules('admin_pass', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admin_level_kode', 'Kelompok', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admin_nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admin_alamat', 'Alamat', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admin_telepon', 'Telepon', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/pengguna/add';
			$container['content']['dataset']['admin_level']	= $this->Admin_Level_model->grid_all('admin_level_kode, admin_level_nama', 'admin_level_nama', 'ASC', '', '', array('admin_level_status'=>'A'));
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			
			$insert['admin_user']		= $this->input->post('admin_user');
			if ($this->input->post('admin_pass')){
				$insert['admin_pass']		= md5($this->input->post('admin_pass'));
			}
			$insert['admin_nama']		= $this->input->post('admin_nama');
			$insert['admin_alamat']		= $this->input->post('admin_alamat');
			$insert['admin_telepon']	= $this->input->post('admin_telepon');
			$insert['admin_level_kode']	= $this->input->post('admin_level_kode');
			if (in_array($this->input->post('admin_level_kode'), array('4', '5', '14', '15')) == TRUE){
				$insert['skpd_kode']		= $this->input->post('skpd_kode');
			} else {
				$insert['skpd_kode']		= '';
			}
			$insert['admin_status']		= 'A';
						
			$query = $this->Admin_model->insert($insert);
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data pengguna baru telah berhasil ditambahkan.</div>');
			
			redirect('pengaturan/pengguna', 'refresh');
		}

	}
	
	public function check_insert($admin_user){
		//query the database
		$result = $this->Admin_model->count_all(array('admin_user' => $admin_user));
		
		if ($result == 0){
			return TRUE;	
		} else {
			$this->form_validation->set_message('check_insert', '<div class="alert alert-danger  fade in">
			<button class="close" data-close="alert" aria-hidden="true"></button>
			<strong>Error!</strong> <span>Username yang Anda masukan sudah terdaftar.</span>
			</div>');
			return FALSE;
		}
	}
	
	public function edit()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/pengguna/edit';
		$container['content']['dataset']['admin_level']	= $this->Admin_Level_model->grid_all('admin_level_kode, admin_level_nama', 'admin_level_nama', 'ASC', '', '', array('admin_level_status'=>'A'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC');
		
		$skpd = $this->Admin_model->get('admin.*, skpd.skpd_status', array('admin.admin_user'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['admin_user']			= $skpd->admin_user;
		$container['content']['dataset']['admin_pass']			= "";
		$container['content']['dataset']['admin_nama']			= $skpd->admin_nama;
		$container['content']['dataset']['admin_alamat']		= $skpd->admin_alamat;
		$container['content']['dataset']['admin_telepon']		= $skpd->admin_telepon;
		$container['content']['dataset']['admin_level_kode']	= $skpd->admin_level_kode;
		$container['content']['dataset']['skpd_kode']			= $skpd->skpd_kode;
		$container['content']['dataset']['skpd_status']			= $skpd->skpd_status;
		$container['content']['dataset']['admin_status']		= $skpd->admin_status;
		
		$header['admin_log']			= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	public function update()
	{
		$admin_log = $this->auth->is_login_admin();
		
		$this->form_validation->set_rules('admin_user', 'Username', 'trim|required|xss_clean|callback_check_update');
		$this->form_validation->set_rules('admin_level_kode', 'Kelompok', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admin_nama', 'Nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admin_alamat', 'Alamat', 'trim|required|xss_clean');
		$this->form_validation->set_rules('admin_telepon', 'Telepon', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 20;
			$container['content']['view']					= 'pengaturan/pengguna/edit';
			$container['content']['dataset']['admin_level']	= $this->Admin_Level_model->grid_all('admin_level_kode, admin_level_nama', 'admin_level_nama', 'ASC', '', '', array('admin_level_status'=>'A'));
			$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC');
			
			$skpd = $this->Admin_model->get('admin.*, skpd.skpd_status', array('admin.admin_user'=>$this->uri->segment(4)));
			
			$container['content']['dataset']['admin_user']			= $skpd->admin_user;
			$container['content']['dataset']['admin_pass']			= "";
			$container['content']['dataset']['admin_nama']			= $skpd->admin_nama;
			$container['content']['dataset']['admin_alamat']		= $skpd->admin_alamat;
			$container['content']['dataset']['admin_telepon']		= $skpd->admin_telepon;
			$container['content']['dataset']['admin_level_kode']	= $skpd->admin_level_kode;
			$container['content']['dataset']['skpd_kode']			= $skpd->skpd_kode;
			$container['content']['dataset']['skpd_status']			= $skpd->skpd_status;
			$container['content']['dataset']['admin_status']		= $skpd->admin_status;
			
			$header['admin_log']			= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/footer');
		} else {
			$update['admin_user']		= $this->input->post('admin_user');
			if ($this->input->post('admin_pass')){
				$update['admin_pass']		= md5($this->input->post('admin_pass'));
			}
			$update['admin_nama']		= $this->input->post('admin_nama');
			$update['admin_alamat']		= $this->input->post('admin_alamat');
			$update['admin_telepon']	= $this->input->post('admin_telepon');
			$update['admin_level_kode']	= $this->input->post('admin_level_kode');
			if (in_array($update['admin_level_kode'], array('4', '5', '14', '15')) == TRUE){
				$update['skpd_kode']		= $this->input->post('skpd_kode');
			} else {
				$update['skpd_kode']		= '';
			}
						
			$query = $this->Admin_model->update($update, $this->input->post('admin_user_hidden'));

			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data pengguna telah berhasil diubah.</div>');
			
			redirect('pengaturan/pengguna', 'refresh');
		}
	}
	
	public function check_update($admin_user){
		//query the database
		$result = $this->Admin_model->count_all(array('admin_user' => $admin_user));
		
		if ($result == 0){
			return TRUE;	
		} else if($result == 1 && $admin_user == $this->input->post('admin_user_hidden')) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_update', '<div class="alert alert-danger  fade in">
			<button class="close" data-close="alert" aria-hidden="true"></button>
			<strong>Error!</strong> <span>Username yang Anda masukan sudah terdaftar.</span>
			</div>');
			return FALSE;
		}
	}
	
	public function detail()
	{
		$admin_log = $this->auth->is_login_admin();
		$container['sidebar']['view']					= 'admin/sidebar';
		$container['sidebar']['dataset']['aktive_menu'] = 20;
		$container['content']['view']					= 'pengaturan/pengguna/detail';
		$container['content']['dataset']['admin_level']	= $this->Admin_Level_model->grid_all('admin_level_kode, admin_level_nama', 'admin_level_nama', 'ASC', '', '', array('admin_level_status'=>'A'));
		$container['content']['dataset']['skpd']		= $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_nama', 'ASC');
		
		$skpd = $this->Admin_model->get('admin.*, admin_level.admin_level_nama, skpd.skpd_status, skpd.skpd_nama', array('admin.admin_user'=>$this->uri->segment(4)));
		
		$container['content']['dataset']['admin_user']			= $skpd->admin_user;
		$container['content']['dataset']['admin_pass']			= $skpd->admin_pass;
		$container['content']['dataset']['admin_nama']			= $skpd->admin_nama;
		$container['content']['dataset']['admin_alamat']		= $skpd->admin_alamat;
		$container['content']['dataset']['admin_telepon']		= $skpd->admin_telepon;
		$container['content']['dataset']['admin_level_kode']	= $skpd->admin_level_kode;
		$container['content']['dataset']['admin_level_nama']	= $skpd->admin_level_nama;
		$container['content']['dataset']['skpd_kode']			= $skpd->skpd_kode;
		$container['content']['dataset']['skpd_nama']			= $skpd->skpd_nama;
		$container['content']['dataset']['skpd_status']			= $skpd->skpd_status;
		$container['content']['dataset']['admin_status']		= $skpd->admin_status;
		
		$header['admin_log']			= $admin_log;
		$this->load->view('admin/head');
		$this->load->view('admin/header', $header);
		$this->load->view('admin/container', $container);
		$this->load->view('admin/footer');
	}
	
	
	public function delete()
	{
		if ($this->uri->segment(4)){
			//$this->Admin_model->delete($this->uri->segment(4));
			
			$update['admin_status']	= 'H';			
			$this->Admin_model->update($update, $this->uri->segment(4));
			
			$this->session->set_flashdata('success','<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>Success!</strong> Data pengguna telah berhasil dihapus.</div>');
		} 

		redirect('pengaturan/pengguna', 'refresh');
	}
	
	public function tampil_combobox_skpd(){
		$admin_level_kode = $this->uri->segment(4);
		if (in_array($admin_level_kode, array('4', '5', '14', '15')) == TRUE){
			if($admin_level_kode == '4'){
				$skpd_status = 'Kecamatan';
			} else if($admin_level_kode == '5'){
				$skpd_status = 'SKPD';
			} else if($admin_level_kode == '14'){
				$skpd_status = 'Desa';
			} else if($admin_level_kode == '15'){
				$skpd_status = 'Kelurahan';
			}
			$data_skpd = $this->Skpd_model->grid_all('skpd_kode, skpd_nama', 'skpd_kode', 'ASC', '', '', array('skpd.skpd_status' => $skpd_status), '');
			echo '<label class="control-label" for="skpd_kode">Nama '.$skpd_status.' :</label>';
					combobox('db', $data_skpd, 'skpd_kode', 'skpd_kode', 'skpd_nama', '', '', 'Pilih '.$skpd_status, 'class="select2_category form-control" required="required"');
		}
	}
}
