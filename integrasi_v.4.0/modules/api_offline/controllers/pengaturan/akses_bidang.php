<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Akses_bidang extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('akses_bidang_model');
		}
		
		public function grid_get()
		{
			$akses_bidang = $this->akses_bidang_model->grid_all('akses_bidang.*', 'akses_bidang_kode', 'ASC');
			if(empty($akses_bidang)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data admin level', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $akses_bidang), 200);
			}
		}
	}

/* End of file akses_bidang.php */
/* Location: ./application/controllers/akses_bidang.php */