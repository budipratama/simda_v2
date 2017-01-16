<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Anggaran_rutin extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('program_rutin_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$anggaran = $this->program_rutin_model->grid_all('*', 'kode', 'ASC');
			if(empty($anggaran)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data anggaran rutin', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $anggaran), 200);
			}
		}
	}

/* End of file anggaran_rutin.php */
/* Location: ./application/controllers/anggaran_rutin.php */