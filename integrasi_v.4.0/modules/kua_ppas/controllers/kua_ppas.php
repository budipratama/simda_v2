<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kua_ppas extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
		
	public function index()
	{
		$this->auth->is_login_admin();
		redirect('kua-ppas/murni', 'refresh');
	}
	
}
