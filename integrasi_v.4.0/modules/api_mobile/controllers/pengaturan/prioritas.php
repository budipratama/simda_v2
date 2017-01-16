<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class prioritas extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('prioritas_model');
		}
		
		//grid : url api
		// get : metode request
		public function grid_get()
		{
			$prioritas = $this->prioritas_model->grid_all('prioritas.*', 'prioritas.prioritas');
			if(empty($prioritas)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data prioritas', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $prioritas), 200);
			}
		}

	}

/* End of file prioritas.php */
/* Location: ./application/controllers/prioritas.php */