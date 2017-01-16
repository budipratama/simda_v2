<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Tujuan extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('tujuan_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$tujuan = $this->tujuan_model->grid_all('tujuan.*', 'kode', 'ASC');
			if(empty($tujuan)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data tujuan', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $tujuan), 200);
			}
		}
	}

/* End of file tujuan.php */
/* Location: ./application/controllers/tujuan.php */