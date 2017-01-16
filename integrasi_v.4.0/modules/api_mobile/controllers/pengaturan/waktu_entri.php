<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Waktu_entri extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Tahapan_model');
		}
		
		public function get_get($waktu_kode="")
		{
			if ($waktu_kode){
				//query belum masih salah
				$waktu_entri = $this->Tahapan_model->get('*', array('kode'=>$waktu_kode));
				if(empty($waktu_entri)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data Waktu Entry', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $waktu_entri), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		//grid : url api
		// get : metode request
		public function grid_get()
		{				
			$waktu_entri = $this->Tahapan_model->grid_all('*', 'kode', 'ASC');
			
			if(empty($waktu_entri)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data Waktu Entry', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $waktu_entri), 200);
			}
		}
	}

/* End of file Waktu_entri.php */
/* Location: ./application/controllers/Waktu_entri.php */