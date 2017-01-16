<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validasi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
	}
		
	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_login');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('login/form');
		} else {
			$admin_log 	= $this->auth->is_login_admin();
			if ($admin_log['level_kode'] == '18'){
				redirect('home', 'refresh');
			} else {
				redirect('dashboard', 'refresh');
			}
		}
	}
	
	
	



//fungsi untuk outomatik logout
function login_validate() {
 //ukuran waktu dalam detik
 $timer=30;
 //untuk menambah masa validasi
 $_SESSION["expires_by"] = time() + $timer;
}

function login_check() {
 //mengambil nilai session pertama
 $exp_time = $_SESSION["expires_by"];
 
 //jika waktu sistem lebih kecil dari nilai waktu session
 if (time() < $exp_time) {
  //panggil fungsi dan tambah waktu session
  login_validate();
  return true;
 }else{
  //jika waktu session lebih kecil dari waktu session atau lewat batas
  //unset session
  unset($_SESSION["expires_by"]);
  return false;
 }
}
	
	
	
	
	
	function check_login($password)
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->Admin_model->validasi($username, $password);

		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
				'username' 		=> $row->admin_user,
				'nama' 			=> $row->admin_nama,
				'level_kode' 	=> $row->admin_level_kode,
				'skpd_kode' 	=> $row->skpd_kode
				);
				
			$this->session->set_userdata('is_logged_admin', $sess_array);
			}
			
			return TRUE;
		} else {
			$this->form_validation->set_message('check_login', '<div class="alert alert-danger display-show">
			<button class="close" data-close="alert"></button>
			<span>Username atau password tidak valid.</span>
			</div>');
			return false;
		}
	}
	
}
