<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class anggaran_rutin extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('anggaran_rutin_model');
		}
		
		public function get_get($anggaran_rutin_kode="")
		{
			if ($anggaran_rutin_kode){
				//query belum masih salah
				$anggaran_rutin = $this->anggaran_rutin_model->get('program_rutin.*', array('program_rutin.kode'=>$anggaran_rutin_kode));
				if(empty($anggaran_rutin)){
					$this->response(array('success' => false, 'message' => 'Tidak ada data program_rutin', 'responseCode' => 406), 406);
				} else {
					$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $anggaran_rutin), 200);
				}
			} else {
				$this->response(array('success' => false, 'message' => 'Paramter tidak ada', 'responseCode' => 400), 400);
			}
		}
		
	}

/* End of file anggaran_rutin.php */
/* Location: ./application/controllers/anggaran_rutin.php */