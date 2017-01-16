<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Deskel extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('skpd_model');
		}
		
		public function get_get($deskel_kode="")
		{
			if ($deskel_kode){
				$deskel = $this->skpd_model->get('skpd.*', 'skpd_kd = \''.$deskel_kode.'\' and skpd_status IN (\'Desa\', \'Kelurahan\')');
				if(empty($deskel)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data deskel', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $deskel), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		//grid : url api
		// get : metode request
		public function grid_get($kecamatan_kode="")
		{
			if ($kecamatan_kode){
				$deskel = $this->skpd_model->grid_all('skpd.*', 'skpd.skpd_nama', 'ASC', 0, 0, 'skpd_status IN (\'Desa\', \'Kelurahan\') AND skpd_kd LIKE \''.$kecamatan_kode.'%\'');
			} else {
				$deskel = $this->skpd_model->grid_all('skpd.*', 'skpd.skpd_nama', 'ASC', 0, 0, 'skpd_status IN (\'Desa\', \'Kelurahan\')');
			}
			
			if(empty($deskel)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data deskel', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $deskel), 200);
			}
		}
	}

/* End of file deskel.php */
/* Location: ./application/controllers/deskel.php */