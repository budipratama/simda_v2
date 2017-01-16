<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Skpd extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('skpd_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get($skpd_status="")
		{
			if ($skpd_status){
				$skpd = $this->skpd_model->grid_all('*', 'skpd_kode', 'ASC', '', '', "skpd_status LIKE '$skpd_status'");
			} else {
				$skpd = $this->skpd_model->grid_all('*', 'skpd_kode', 'ASC');
			}
			if(empty($skpd)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data SKPD', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $skpd), 200);
			}
		}
	}

/* End of file skpd.php */
/* Location: ./application/controllers/skpd.php */