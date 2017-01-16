<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Visi extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Visi_model');
		}
				
		
		
		//grid : url api
		// get : metode request
		public function grid_get()
		{
			$visi = $this->Visi_model->grid_all('visi.*', 'visi.visi');
			if(empty($visi)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data Visi', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $visi), 200);
			}
		}

	}

/* End of file visi.php */
/* Location: ./application/controllers/visi.php */