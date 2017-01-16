<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Indikator extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('indikator_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$indikator = $this->indikator_model->grid_all('indikator.*', 'kode', 'ASC');
			if(empty($indikator)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data indikator', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $indikator), 200);
			}
		}
	}

/* End of file indikator.php */
/* Location: ./application/controllers/indikator.php */