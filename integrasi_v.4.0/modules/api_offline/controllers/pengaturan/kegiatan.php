<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'/libraries/REST_Controller.php';

	class Kegiatan extends REST_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('program_kegiatan_model');
		}
		
		// grid = nama fungsi
		// get = metode request, yang digunakan get dan post.
		public function grid_get()
		{
			$kegiatan = $this->program_kegiatan_model->grid_all('program_kegiatan.*', 'kode', 'ASC');
			if(empty($kegiatan)){
				$this->response(array('success' => false, 'message' => 'Tidak ada data kegiatan', 'responseCode' => 406), 406);
			} else {
				$this->response(array('success' => true, 'message' => 'Success', 'responseCode' => 200, 'data' => $kegiatan), 200);
			}
		}
	}

/* End of file kegiatan.php */
/* Location: ./application/controllers/kegiatan.php */