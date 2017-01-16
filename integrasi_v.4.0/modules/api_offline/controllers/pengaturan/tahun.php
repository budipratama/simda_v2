<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Tahun extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('tahun_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$tahun = $this->tahun_model->grid_all('*', 'tahun', 'ASC');
			if(empty($tahun)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data tahun', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $tahun), 200);
			}
		}
	}

/* End of file tahun.php */
/* Location: ./application/controllers/tahun.php */