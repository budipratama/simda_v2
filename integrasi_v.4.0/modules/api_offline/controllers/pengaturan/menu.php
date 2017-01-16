<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Menu extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('menu_model');
		}
		
		public function grid_get()
		{
			$menu = $this->menu_model->grid_all('menu.*', 'menu_kode', 'ASC');
			if(empty($menu)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data menu', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $menu), 200);
			}
		}
	}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */