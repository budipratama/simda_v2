<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Tahun_anggaran extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Tahun_model');
		}
		
		public function get_get($tahun_nomor="")
		{
			if ($tahun_nomor){
				$tahun_anggaran = $this->Tahun_model->get('tahun.*', 'nomor = \''.$tahun_nomor.'\' and status IN (\'Enabled\', \'Disabled\')');
				if(empty($tahun_anggaran)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data Tahun Anggaran', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $tahun_anggaran), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
		//grid : url api
		// get : metode request
		public function grid_get()
		{
			$tahun_anggaran = $this->Tahun_model->grid_all('tahun.*', 'tahun.tahun',  'status = (\'Enabled\', \'Disabled\')');
			if(empty($tahun_anggaran)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data Tahun Anggaran', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $tahun_anggaran), 200);
			}
		}
	}

/* End of file Tahun_anggaran.php */
/* Location: ./application/controllers/Tahun_anggaran.php */