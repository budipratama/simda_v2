<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Urusan extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('urusan_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$urusan = $this->urusan_model->grid_all('urusan.*', 'kode', 'ASC');
			if(empty($urusan)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data urusan', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $urusan), 200);
			}
		}
	}

/* End of file urusan.php */
/* Location: ./application/controllers/urusan.php */