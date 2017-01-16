<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Admin extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_model');
		}
		
		public function Id_get($admin_user="")
		{
			if ($admin_user){
			$admin = $this->admin_model->get('admin_user', array('admin_user'=>$admin_user));
				if(empty($admin)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data user', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $admin), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		public function grid_get($param1="")
		{
			if ($param1){
				$admin = $this->admin_model->grid_all('admin.*', 'admin_user', 'ASC', 0, 0, array('admin.admin_level_kode'=>$param1));
			} else {
				$admin = $this->admin_model->grid_all('admin.*', 'admin_user', 'ASC');
			}
			if(empty($admin)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data admin', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $admin), 200);
			}
		}
	}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */