<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anggaran_kas extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
		
	public function index()
	{
		$this->auth->is_login_admin();
		redirect('anggaran-kas/murni', 'refresh');
	}
	
}
