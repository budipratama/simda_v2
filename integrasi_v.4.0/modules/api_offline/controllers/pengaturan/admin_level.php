<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Admin_level extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_level_model');
		}
		
		public function grid_get($param1="")
		{
			if ($param1){
				$admin_level = $this->admin_level_model->grid_all('admin_level.*', 'admin_level_kode', 'ASC', 0, 0, array('admin_level_kode'=>$param1));
			} else {
				$admin_level = $this->admin_level_model->grid_all('admin_level.*', 'admin_level_kode', 'ASC');
			}
			if(empty($admin_level)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data admin level', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $admin_level), 200);
			}
		}
	}

/* End of file admin_level.php */
/* Location: ./application/controllers/admin_level.php */