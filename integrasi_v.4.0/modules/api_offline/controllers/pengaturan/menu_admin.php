<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Menu_admin extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('menu_admin_model');
		}
		
		public function grid_get($param1="")
		{
			if ($param1){
				$menu_admin = $this->menu_admin_model->grid_all('menu_admin.*', 'menu_admin_kode', 'ASC', 0, 0, array('menu_admin.admin_level_kode'=>$param1));
			} else {
				$menu_admin = $this->menu_admin_model->grid_all('menu_admin.*', 'menu_admin_kode', 'ASC');
			}
			if(empty($menu_admin)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data admin level', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $menu_admin), 200);
			}
		}
	}

/* End of file menu_admin.php */
/* Location: ./application/controllers/menu_admin.php */