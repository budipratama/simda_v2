<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class indikator extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('indikator_model');
		}
					
		//grid : url api 
		// get : metode request 
		public function grid_get($sasaran_kode="")
		{
			if ($sasaran_kode){
				$where_indikator['indikator.sasaran']	= $sasaran_kode;
				$indikator = $this->indikator_model->grid_all('indikator.*', 'indikator.indikator', 'ASC', 0, 0, $where_indikator);
			} else {
				$indikator = $this->indikator_model->grid_all('indikator.*', 'indikator.indikator', 'ASC');
			}
			
			if(empty($indikator)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data indikator', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $indikator), 200);
			}
		}

	}

/* End of file indikator.php */
/* Location: ./application/controllers/indikator.php */