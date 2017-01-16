<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Admin extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Admin_model');
		}
				
		public function get_get($admin_user="")
		{
			if ($admin_user){
			$admin = $this->Admin_model->get('admin.admin_user, admin.admin_nama, admin.admin_level_kode, admin.skpd_kode, skpd_nama', array('admin_user'=>$admin_user));
				if(empty($admin)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data user', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $admin), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
	}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */