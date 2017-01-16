<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class SKPD extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('skpd_model');
		}
		
		public function get_get($skpd_kode="")
		{
			if ($skpd_kode){
				$skpd = $this->skpd_model->get('skpd.*', array('skpd_kode'=>$skpd_kode, 'skpd_status'=>'SKPD'));
				if(empty($skpd)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data SKPD', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $skpd), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		//grid : url api
		// get : metode request
		public function grid_get()
		{
			$skpd = $this->skpd_model->grid_all('skpd.*', 'skpd.skpd_nama', 'ASC', 0, 0, 'skpd_status = \'SKPD\'');
			if(empty($skpd)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data SKPD', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $skpd), 200);
			}
		}
	}

/* End of file SKPD.php */
/* Location: ./application/controllers/SKPD.php */