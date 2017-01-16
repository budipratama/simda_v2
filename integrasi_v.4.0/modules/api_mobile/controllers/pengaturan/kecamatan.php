<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Kecamatan extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('skpd_model');
		}
		
		public function get_get($kecamatan_kode="")
		{
			if ($kecamatan_kode){
				$kecamatan = $this->skpd_model->get('skpd.*', array('skpd_kd'=>$kecamatan_kode, 'skpd_status'=>'Kecamatan'));
				if(empty($kecamatan)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data kecamatan', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $kecamatan), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		//grid : url api
		// get : metode request
		public function grid_get()
		{
			$kecamatan = $this->skpd_model->grid_all('skpd.*', 'skpd.skpd_nama', 'ASC', 0, 0, 'skpd_status = \'Kecamatan\'');
			if(empty($kecamatan)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data kecamatan', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $kecamatan), 200);
			}
		}
	}

/* End of file kecamatan.php */
/* Location: ./application/controllers/kecamatan.php */