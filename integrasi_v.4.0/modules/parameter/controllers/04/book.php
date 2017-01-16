<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

	public function __construct() {
		parent::__construct();
			$this->load->helper('url');
	 		$this->load->model('book_model');
	}

	public function index1() {
		$data['books']=$this->book_model->get_all_books();
		$this->load->view('parameter/book/book_view',$data);
	}
	
	public function index()	{
		$admin_log 	= $this->auth->is_login_admin();
		{
			$container['sidebar']['view']					= 'admin/sidebar';
			$container['sidebar']['dataset']['aktive_menu'] = 60;
			$container['content']['view']					= 'parameter/book/book_view';
			
			$container['books'] 							= $this->book_model->get_all_books();
			
			$header['admin_log']							= $admin_log;
			$this->load->view('admin/head');
			$this->load->view('admin/header', $header);
			$this->load->view('admin/container', $container);
			$this->load->view('admin/tables');
		}
	}
	
	public function book_add() {
		$data = array(
			'kd_rek_1' 		=> 5,
			'kd_rek_2' 		=> 16,
			'no' 			=> $this->input->post('ccc_kode'),
			'nm_rek_3'		=> $this->input->post('ddd_kode'),
			'saldo_normal' 	=> $this->input->post('eee_kode'),
			'status' 		=> 2
		);
		$insert = $this->book_model->book_add($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id) {
		$data = $this->book_model->get_by_id($id);
			echo json_encode($data);
	}

	public function book_update() {
		$data = array(
			'kd_rek_1' 		=> 5,
			'kd_rek_2' 		=> 16,
			'no' 			=> $this->input->post('ccc_kode'),
			'nm_rek_3'		=> $this->input->post('ddd_kode'),
			'saldo_normal' 	=> $this->input->post('eee_kode'),
			'status' 		=> 2
		);
		$this->book_model->book_update(array('kode' => $this->input->post('kode')), $data);
		echo json_encode(array("status" => TRUE));
	}
}