<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Prioritas extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('prioritas_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$kode = $this->prioritas_model->grid_all('*', 'kode', 'ASC');
			if(empty($kode)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data kode', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $kode), 200);
			}
		}
	}

/* End of file kode.php */
/* Location: ./application/controllers/kode.php */